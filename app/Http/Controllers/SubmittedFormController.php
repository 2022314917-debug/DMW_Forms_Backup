<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request_Number;
use App\Models\Request_Party;
use App\Models\Request_OFW;
use App\Models\Request_Party_Address;
use App\Models\Request_Form;
use App\Models\Request_Form_Field;
use App\Models\Request_Form_Entries;
use App\Models\Request_Form_Field_Values;
use App\Models\Ofw_Training_Record;
use App\Models\Startup_Equipment_Products;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ProcessingRequest;
use App\Models\Requirements;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use App\Mail\EmployeeSelectForms;
use App\Mail\ApprovedRequest;
use App\Mail\RejectedRequest;
use App\Models\BankAccountDetails;
use App\Models\Employees;
use App\Models\Request_Status_History;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class SubmittedFormController extends Controller
{
    

    public function index(HttpRequest $httpRequest)
    {
        $status = $httpRequest->query('status');
        
        $query = Request_Number::with([
            'requestOfw',
            'requestParty'
        ])->latest(); // order by created_at desc
        
        // Filter by status if provided
        if ($status) {
            $query->where('status', $status);
        }
        
        $requests = $query->get();

        return view('forms-submitted.index', compact('requests', 'status'));
    }

    public function show($id)
    {
        $requestNumber = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestOfwAddress',
            'requestPartyAddress',
            'requestFormEntries.form.division',
            'statusHistory.employee',
            'requirements'
        ])->findOrFail($id);

        $evaluator = $requestNumber->statusHistory->last()?->employee;

        $forms = $requestNumber->requestFormEntries
            ->groupBy('request_form_id')
            ->map(fn($entries) => [
                'form'         => $entries->first()->form,
                'division_id'  => $entries->first()->form->division_id,
                'division_name'=> $entries->first()->form->division_name,
            ]);
        
        return view('forms-submitted.show', compact('requestNumber', 'forms', 'evaluator'));
    }

    /*
    |-------------------------------------------------------
    | OPEN FORM — Show a specific form's entries
    |-------------------------------------------------------
    */
    public function openForm($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestFormEntries',
            'bankAccountDetails',
        ])->findOrFail($requestId);

        $form    = Request_Form::findOrFail($formId);
        $ofw     = $request->requestOfw;
        $party   = $request->requestParty;
        $ofw_address = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;
        $bank = $request->bankAccountDetails;


        // Get the entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value, e.g. $entries['party_lname']
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        // // Keyed by field_name => full fieldValue model, e.g. $sectionC['party_lname']->value
        // $sectionC = $allFieldValues->keyBy(fn($fv) => $fv->field->field_name);

        $training_records = Ofw_Training_Record::where('request_id', $requestId)->get();
        $startup_items = Startup_Equipment_Products::where('request_id', $requestId)->get();
        return match ($form->id) {
            100 =>
                view('forms-submitted.show.rfa', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'bank'
                )),
            101 =>
                view('forms-submitted.show.aksyon', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'bank' ,
                )),
            102 =>
                view('forms-submitted.show.sena', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'bank'
                )),
            103 =>
                view('forms-submitted.show.elpor', compact(
                    'request', 'entries', 'form',
                    'ofw', 'ofw_address', 'training_records'
                )),
            104 =>
                view('forms-submitted.show.ofw_statement', compact(
                    'request', 'entries', 'form',
                    'ofw', 'ofw_address'
                )),
            105 =>
                view('forms-submitted.show.elporb1', compact(
                    'request', 'entries', 'form',
                    'ofw', 'ofw_address', 'startup_items'
                )),
            106 =>
                view('forms-submitted.show.business_canvas', compact(
                    'request', 'entries', 'form',
                    'ofw', 'ofw_address',
                )),
            107 =>
                view('forms-submitted.show.commitment', compact(
                    'request', 'entries', 'form',
                    'ofw', 'ofw_address',
                )),

            108 =>
                view('forms-submitted.show.kasulatan', compact(
                    'request', 'entries', 'form',
                    'ofw', 'ofw_address',
                )),
            default => abort(404, 'Form view not found'),
        };
    }
    public function viewFile($id)
    {
        $requirement = Requirements::findOrFail($id);

        return response()->json([
            'url' => asset('storage/' . $requirement->file_path),
            'name' => $requirement->file_name
        ]);
    }

    public function downloadFile($id){
        $requirement = Requirements::findOrFail($id);

        return response()->json([
            'url' => asset('storage/' . $requirement->file_path),
            'name' => $requirement->file_name
        ]);
    }

    public function approveRequestStatus($id)
    {
        $requestNumber = Request_Number::findOrFail($id);
        $employeeId = Auth::id();
        DB::beginTransaction();
        try {
            $requestNumber->update([
                'status' => 'APPROVED'
            ]);

            Request_Status_History::create([
                'request_id' => $requestNumber->id,
                'employee_id'       => $employeeId,
                'status'            => 'APPROVED'
            ]);
            DB::commit();
            $rfaDataOfw = $requestNumber->requestOfw;
            $rfaDataParty = $requestNumber->requestParty;
            $to = $rfaDataOfw->ofw_email ?? null;
                $ofw_full_name = trim(($rfaDataOfw->ofw_fname ?? '') . ' ' . ($rfaDataOfw->ofw_mname ?? '') . ' ' . ($rfaDataOfw->ofw_lname ?? ''));
                $partyEmail = $rfaDataParty->party_email ?? null;
                $party_full_name = trim(($rfaDataParty->party_fname ?? '') . ' ' . ($rfaDataParty->party_mname ?? '') . ' ' . ($rfaDataParty->party_lname ?? ''));
            
            // Check if party filled up
            if (!empty($partyEmail) && !empty($party_full_name)) {
                // Send email to both OFW and party with their respective names
                $recipients = [
                    [
                        'email' => $to,
                        'name' => $ofw_full_name,
                    ],
                    [
                        'email' => $partyEmail,
                        'name' => $party_full_name,
                    ]
                ];
                
                foreach ($recipients as $recipient) {
                    Mail::to($recipient['email'])->send(new ApprovedRequest($requestNumber->id, $recipient['name']));
                }
            } else {
                // Send email to OFW only
                Mail::to($to)->send(new ApprovedRequest($requestNumber->id, $ofw_full_name));
            }
            return response()->json([
                'success' => true,
                'message' => 'Request Approved.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function rejectRequestStatus($id)
    {
        $requestNumber = Request_Number::findOrFail($id);
        $employeeId = Auth::id();
        DB::beginTransaction();
        try {
            $requestNumber->update([
                'status' => 'REJECTED'
            ]);

            Request_Status_History::create([
                'request_id' => $requestNumber->id,
                'employee_id'       => $employeeId,
                'status'            => 'REJECTED'
            ]);
            DB::commit();
            $rfaDataOfw = $requestNumber->requestOfw;
            $rfaDataParty = $requestNumber->requestParty;
            $to = $rfaDataOfw->ofw_email ?? null;
                $ofw_full_name = trim(($rfaDataOfw->ofw_fname ?? '') . ' ' . ($rfaDataOfw->ofw_mname ?? '') . ' ' . ($rfaDataOfw->ofw_lname ?? ''));
                $partyEmail = $rfaDataParty->party_email ?? null;
                $party_full_name = trim(($rfaDataParty->party_fname ?? '') . ' ' . ($rfaDataParty->party_mname ?? '') . ' ' . ($rfaDataParty->party_lname ?? ''));
            
            // Check if party filled up
            if (!empty($partyEmail) && !empty($party_full_name)) {
                // Send email to both OFW and party with their respective names
                $recipients = [
                    [
                        'email' => $to,
                        'name' => $ofw_full_name,
                    ],
                    [
                        'email' => $partyEmail,
                        'name' => $party_full_name,
                    ]
                ];
                
                foreach ($recipients as $recipient) {
                    Mail::to($recipient['email'])->send(new RejectedRequest($requestNumber->id, $recipient['name']));
                }
            } else {
                // Send email to OFW only
                Mail::to($to)->send(new RejectedRequest($requestNumber->id, $ofw_full_name));
            }
            return response()->json([
                'success' => true,
                'message' => 'Request Rejected.'
            ]);

        } catch (\Exception $e) {

            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function editGeneral($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;
        $party         = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        // Keyed by field_name => full fieldValue model
        $sectionC = $allFieldValues->keyBy(fn($fv) => $fv->field->field_name);

        return match ($formId) {
            '100' =>
                view('forms-submitted.edit.general', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'sectionC'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }



    
    public function saveEditGeneral(Request $request, $requestId, $formId)
    {
        $requestNumber = Request_Number::findOrFail($requestId);

        DB::beginTransaction();

        try {

            // UPDATE PARTY
            $requestNumber->update([
                'nature_of_request' => $request->nature_of_request
            ]);
            $requestNumber->requestParty->update([
                'party_lname' => $request->party_lname,
                'party_fname' => $request->party_fname,
                'party_mname' => $request->party_mname,
                'party_ename' => $request->party_ename,
                'party_bday'  => $request->party_bday,
                'party_gender'=> $request->party_gender,
                'party_relationship'=> $request->party_relationship,
                'party_phone' => $request->party_phone,
                'party_email' => $request->party_email,
            ]);

            $requestNumber->requestPartyAddress->update([
                'province' => $request->party_province_name,
                'municipality' => $request->party_municipality_name,
                'brgy' => $request->party_barangay_name,
                'house_no' => $request->party_house_no,
                'zip_code' => $request->party_zip_code
            ]);

            // UPDATE OFW
            $requestNumber->requestOfw->update([
                'ofw_lname' => $request->ofw_lname,
                'ofw_fname' => $request->ofw_fname,
                'ofw_mname' => $request->ofw_mname,
                'ofw_ename' => $request->ofw_ename,
                'ofw_gender'=> $request->ofw_gender,
                'ofw_phone' => $request->ofw_phone,
                'ofw_email' => $request->ofw_email,
                'ofw_bday'  => $request->ofw_bday,
                'ofw_agency'=> $request->ofw_agency,
                'ofw_employer'=> $request->ofw_employer,
                'ofw_country'=> $request->ofw_country,
                'ofw_job'   => $request->ofw_job,
            ]);

            $requestNumber->requestOfwAddress->update([
                'province' => $request->ofw_province_name,
                'municipality' => $request->ofw_municipality_name,
                'brgy' => $request->ofw_barangay_name,
                'house_no' => $request->ofw_house_no,
                'zip_code' => $request->ofw_zip_code
            ]);

            DB::commit();

            return redirect()
                ->route('forms-submitted.show', $requestId)
                ->with('success', 'Form updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function editOFWInfoSheetMWPSD($requestId, $formId){
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;
        $party         = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        // Keyed by field_name => full fieldValue model
        $sectionC = $allFieldValues->keyBy(fn($fv) => $fv->field->field_name);

        return match ($formId) {
            '101' =>
                view('forms-submitted.edit.processing', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'sectionC'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditOFWInfoSheetMWPSD(Request $request, $requestId, $formId){
        
    }

    public function editRFA($requestId, $formId){
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;
        $party         = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;
        $bank   = $request->bankAccountDetails;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });


        return match ($formId) {
            '100' => 
                view('forms-submitted.edit.rfa', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'formId', 'bank'
                )),
            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditRFA(Request $request, $requestId, $formId)
    {
        $requestNumber = Request_Number::findOrFail($requestId);

        DB::beginTransaction();

        try {
            $requestNumber->update([
                'maikling_salaysay' => $request->maikling_salaysay
            ]);

            $requestNumber->requestParty->update([
                'party_lname'              => $request->party_lname,
                'party_fname'              => $request->party_fname,
                'party_mname'              => $request->party_mname,
                'party_ename'              => $request->party_ename,
                'party_email'              => $request->party_email,
                'party_phone'              => $request->party_phone,
                'party_bday'               => $request->party_bday,
                'party_relationship'       => $request->party_relationship,
                'party_relationship_other' => $request->party_relationship_other,
                'party_fb_acc'             => $request->party_fb_acc,
                'party_valid_id'           => $request->party_valid_id,
            ]);

            $requestNumber->requestPartyAddress->update([
                'province'     => $request->party_province_name,
                'municipality' => $request->party_municipality_name,
                'brgy'         => $request->party_barangay_name,
                'house_no'     => $request->party_house_no,
                'zip_code'     => $request->party_zip_code,
            ]);

            $requestNumber->requestOfw->update([
                'ofw_lname'          => $request->ofw_lname,
                'ofw_fname'          => $request->ofw_fname,
                'ofw_mname'          => $request->ofw_mname,
                'ofw_ename'          => $request->ofw_ename,
                'ofw_passport_no'    => $request->ofw_passport_no,
                'ofw_gender'         => $request->ofw_gender,
                'ofw_civil_status'   => $request->ofw_civil_status,
                'ofw_email'          => $request->ofw_email,
                'ofw_phone'          => $request->ofw_phone,
                'ofw_bday'           => $request->ofw_bday,
                'ofw_fb_acc'         => $request->ofw_fb_acc,
                'ofw_address_abroad' => $request->ofw_address_abroad,
            ]);

            $requestNumber->requestOfwAddress->update([
                'province'     => $request->ofw_province_name,
                'municipality' => $request->ofw_municipality_name,
                'brgy'         => $request->ofw_barangay_name,
                'house_no'     => $request->ofw_house_no,
                'zip_code'     => $request->ofw_zip_code,
            ]);

            // if(empty('bank_name') && empty('bank_branch') && empty('bank_acc_num') && empty('bank_acc_name')){
            //     if ($requestNumber->bankAccountDetails){
            //         $requestNumber->bankAccountDetails->delete();
            //     }
            // }

            if(!empty('bank_name') || !empty('bank_branch') || !empty('bank_acc_num') || !empty('bank_acc_name')){

                if ($requestNumber->bankAccountDetails) {
                    $requestNumber->bankAccountDetails->update([
                        'bank_name'     => $request->bank_name,
                        'bank_branch'   => $request->bank_branch,
                        'bank_acc_num'  => $request->bank_acc_num,
                        'bank_acc_name' => $request->bank_acc_name,
                    ]);
                }else{
                    BankAccountDetails::create([
                        'request_id'    => $requestId,
                        'bank_name'     => $request->bank_name,
                        'bank_branch'   => $request->bank_branch,
                        'bank_acc_num'  => $request->bank_acc_num,
                        'bank_acc_name' => $request->bank_acc_name,
                    ]);
                }
            }

            


            DB::commit();

            return response()->json([
                'success'  => true,
                'message'  => 'Form updated successfully.',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function editAksyon ($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;
        $party         = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        return match ($formId) {
            '101' =>
                view('forms-submitted.edit.aksyon', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'formId'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditAksyon(Request $request, $requestId, $formId)
    {
        $requestNumber = Request_Number::findOrFail($requestId);

        DB::beginTransaction();

        try {
            $requestRecord = Request_Number::with([
                'requestFormEntries' => function ($query) use ($formId) {
                    $query->where('request_form_id', $formId);
                }
            ])->findOrFail($requestId);

            // Get entry IDs
            $entryIds = $requestRecord->requestFormEntries->pluck('id');

            // Get all fields for this form
            $fields = Request_Form_Field::where('request_form_id', $formId)->get()->keyBy('field_name');

            /*
            |--------------------------------------------------------------------------
            | 1. HANDLE CHECKBOXES (DELETE FIRST)
            |--------------------------------------------------------------------------
            */
            $checkboxFields = [
                'aksyon_hanapbuhay_program',
                'aksyon_nrco_livehood_program',
                'aksyon_fund',
            ];

            // Delete old checkbox values
            foreach ($checkboxFields as $fieldName) {
                if (isset($fields[$fieldName])) {
                    Request_Form_Field_Values::whereIn('request_form_entry_id', $entryIds)
                        ->where('request_form_field_id', $fields[$fieldName]->id)
                        ->delete();
                }
            }

            /*
            |--------------------------------------------------------------------------
            | 2. LOOP THROUGH REQUEST INPUTS
            |--------------------------------------------------------------------------
            */
            foreach ($request->all() as $fieldName => $value) {

                if (!isset($fields[$fieldName])) {
                    continue; // skip non-form fields
                }

                $field = $fields[$fieldName];

                // Handle checkbox (only insert if checked)
                if (in_array($fieldName, $checkboxFields)) {

                    if ($value) {
                        foreach ($entryIds as $entryId) {
                            Request_Form_Field_Values::create([
                                'request_form_entry_id' => $entryId,
                                'request_form_field_id' => $field->id,
                                'value' => 'checked',
                            ]);
                        }
                    }

                    continue;
                }

                /*
                |--------------------------------------------------------------------------
                | 3. HANDLE RADIO BUTTONS & NORMAL INPUTS
                |--------------------------------------------------------------------------
                */
                foreach ($entryIds as $entryId) {

                    Request_Form_Field_Values::updateOrCreate(
                        [
                            'request_form_entry_id' => $entryId,
                            'request_form_field_id' => $field->id,
                        ],
                        [
                            'value' => $value,
                        ]
                    );
                }
            }

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Form updated successfully.']);
            }

            return redirect()
                ->route('forms-submitted.show', $requestId)
                ->with('success', 'Form updated successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
    public function editSENA($requestId, $formId){
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;
        $party         = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        // Keyed by field_name => full fieldValue model
        $sectionC = $allFieldValues->keyBy(fn($fv) => $fv->field->field_name);

        return match ($formId) {
            '102' =>
                view('forms-submitted.edit.sena', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'formId'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditSENA(Request $request, $requestId, $formId)
    {
        DB::beginTransaction();

        try {
            $requestRecord = Request_Number::with([
                'requestFormEntries' => function ($query) use ($formId) {
                    $query->where('request_form_id', $formId);
                }
            ])->findOrFail($requestId);

            $entryIds = $requestRecord->requestFormEntries->pluck('id');
            $fields = Request_Form_Field::where('request_form_id', $formId)->get()->keyBy('field_name');

            $checkboxFields = [
                'sena_non_payment',
                'sena_salary',
                'sena_overtime',
                'sena_rest_day',
                'sena_sick_leave',
                'sena_vacation_leave',
                'sena_holiday_pay',
                'sena_illegal_deduct',
                'sena_non_provision_transport',
                'sena_non_provision_food',
                'sena_others_contract_violations',
                'sena_end_service_benefits',
                'sena_airfare',
                'sena_unexpired_contract',
                'sena_illegal_fees',
                'sena_disability_benefits',
                'sena_holding_of_passport',
                'sena_holding_of_documents',
                'sena_transfer_company',        
                'sena_illegal_contract_termination',
            ];

            foreach ($checkboxFields as $fieldName) {
                if (isset($fields[$fieldName])) {
                    Request_Form_Field_Values::whereIn('request_form_entry_id', $entryIds)
                        ->where('request_form_field_id', $fields[$fieldName]->id)
                        ->delete();
                }
            }

            foreach ($request->all() as $fieldName => $value) {
                if (!isset($fields[$fieldName])) continue;

                $field = $fields[$fieldName];

                if (in_array($fieldName, $checkboxFields)) {
                    if ($value) {
                        foreach ($entryIds as $entryId) {
                            Request_Form_Field_Values::create([
                                'request_form_entry_id' => $entryId,
                                'request_form_field_id' => $field->id,
                                'value' => 'checked',
                            ]);
                        }
                    }
                    continue;
                }

                foreach ($entryIds as $entryId) {
                    Request_Form_Field_Values::updateOrCreate(
                        [
                            'request_form_entry_id' => $entryId,
                            'request_form_field_id' => $field->id,
                        ],
                        ['value' => $value ?? '']
                    );
                }
            }

            DB::commit();

            // Always return JSON — no redirect
            return response()->json([
                'success' => true,
                'message' => 'SENA form updated successfully.',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            
            // Always return JSON — no back()
            return response()->json([
                'success' => false,
                'message' => 'Error updating form: ' . $e->getMessage(),
            ], 500);
        }
    }

    

    public function editElpor($requestId, $formId){
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestPartyAddress',
            'requestOfwAddress',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;
        $party         = $request->requestParty;
        $ofw_address   = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        // Keyed by field_name => full fieldValue model
        $training_records = Ofw_Training_Record::where('request_id', $requestId)->get();

        return match ($formId) {
            '103' =>
                view('forms-submitted.edit.elpor', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'formId',
                    'training_records'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }


    public function saveEditElpor(Request $httpRequest, $requestId, $formId)
    {
        // ── 1. Load the parent request & its form entries ─────────────────────
        $requestRecord = Request_Number::with([
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);
    
        $entryIds = $requestRecord->requestFormEntries->pluck('id');
    
        // ── 2. Fields that are editable (read-only OFW fields are excluded) ───
        $editableFields = [
            'elpor_ofw_age',
            'elpor_ofw_other_data',
            'elpor_jobsite',
            'elpor_job_position',
            'elpor_latest_date_departure_ph',
            'elpor_latest_date_return_ph',
            'elpor_business_type',
            'elpor_business_site',
        ];
    
        // ── 3. Update each editable field value ───────────────────────────────
        foreach ($editableFields as $fieldName) {
            if (!$httpRequest->has($fieldName)) {
                continue;
            }
    
            // Find the field definition by field_name
            $field = Request_Form_Field::where('field_name', $fieldName)
                ->where('request_form_id', $formId)
                ->first();
    
            if (!$field) {
                continue; // field not registered in this form — skip safely
            }
    
            // Find the existing value row for this entry + field
            $fieldValue = Request_Form_Field_Values::whereIn('request_form_entry_id', $entryIds)
                ->where('request_form_field_id', $field->id)
                ->first();
    
            $newValue = $httpRequest->input($fieldName);
    
            if ($fieldValue) {
                $fieldValue->update(['value' => $newValue]);
            } else {
                // If for some reason the row doesn't exist yet, create it
                // (use the first entry id as the parent)
                $firstEntryId = $entryIds->first();
                if ($firstEntryId) {
                    Request_Form_Field_Values::create([
                        'request_form_entry_id'  => $firstEntryId,
                        'request_form_field_id'  => $field->id,
                        'value'                  => $newValue,
                    ]);
                }
            }
        }
    
        // ── 4. Training records — only touch if the user modified the table ───
        $trainingsModified = $httpRequest->input('trainings_modified', '0');
    
        if ($trainingsModified === '1') {
            // Delete all existing training records for this request
            Ofw_Training_Record::where('request_id', $requestId)->delete();
    
            // Re-insert whatever is currently in the table
            $trainings = $httpRequest->input('trainings', []);
    
            foreach ($trainings as $training) {
                // Basic sanity check — skip empty/incomplete rows
                if (
                    empty($training['training_name']) &&
                    empty($training['venue']) &&
                    empty($training['issued_by']) &&
                    empty($training['training_date'])
                ) {
                    continue;
                }
    
                Ofw_Training_Record::create([
                    'request_id'    => $requestId,
                    'training_name' => $training['training_name'] ?? null,
                    'venue'         => $training['venue']         ?? null,
                    'issued_by'     => $training['issued_by']     ?? null,
                    'training_date' => $training['training_date'] ?? null,
                ]);
            }
        }
    
        // ── 5. Respond ────────────────────────────────────────────────────────
        if ($httpRequest->wantsJson() || $httpRequest->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Request updated successfully.',
            ]);
        }
    
        return redirect()
            ->route('forms-submitted.show', $requestId)
            ->with('success', 'Request updated successfully.');
    }

    public function editOFWStatement($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestOfwAddress',
            // Load entries for THIS form (104) — used for the editable fields
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);
    
        $form        = Request_Form::findOrFail($formId);
        $ofw         = $request->requestOfw;
        $ofw_address = $request->requestOfwAddress;
    
        // ── Entries for this form (104) — editable fields ─────────────────────
        $entryIds = $request->requestFormEntries->pluck('id');
    
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();
    
        $entries = $allFieldValues->mapWithKeys(fn($fv) => [$fv->field->field_name => $fv->value]);
    
        // ── Cross-form read-only display fields from ELPOR (form 103) ─────────
        // elpor_jobsite, elpor_job_position, departure/arrival dates live in
        // form 103's entries. Merge them into $entries so the blade can display
        // them without changing the save logic (these are never submitted back).
        $elporFormId = 103;
    
        $elporEntryIds = Request_Form_Entries::where('request_id', $requestId)
            ->where('request_form_id', $elporFormId)
            ->pluck('id');
    
        if ($elporEntryIds->isNotEmpty()) {
            $elporFieldValues = Request_Form_Field_Values::with('field')
                ->whereIn('request_form_entry_id', $elporEntryIds)
                ->get();
    
            $elporEntries = $elporFieldValues->mapWithKeys(fn($fv) => [$fv->field->field_name => $fv->value]);
    
            // Only pull in the display-only keys; don't overwrite any form-104 keys
            $displayKeys = [
                'elpor_jobsite',
                'elpor_jobsite_name',
                'elpor_job_position',
                'elpor_latest_date_departure_ph',
                'elpor_latest_date_return_ph',
            ];
    
            foreach ($displayKeys as $key) {
                if (!$entries->has($key) && $elporEntries->has($key)) {
                    $entries[$key] = $elporEntries[$key];
                }
            }
        }
    
        return match ($formId) {
            '104' => view('forms-submitted.edit.ofw_statement', compact(
                'request', 'entries', 'form',
                'ofw', 'ofw_address', 'formId'
            )),
    
            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditOFWStatement(Request $httpRequest, $requestId, $formId)
    {
        // ── 1. Load the parent request & its form entries ─────────────────────
        $requestRecord = Request_Number::with([
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);
    
        $entryIds = $requestRecord->requestFormEntries->pluck('id');
    
        // ── 2. Editable fields for this form ──────────────────────────────────
        $editableFields = [
            'elpor_return_reason',
            'elpor_return_reason_details',
        ];
    
        // ── 3. Update each field value ────────────────────────────────────────
        foreach ($editableFields as $fieldName) {
            if (!$httpRequest->has($fieldName)) {
                continue;
            }
    
            $field = Request_Form_Field::where('field_name', $fieldName)
                ->where('request_form_id', $formId)
                ->first();
    
            if (!$field) {
                continue;
            }
    
            $fieldValue = Request_Form_Field_Values::whereIn('request_form_entry_id', $entryIds)
                ->where('request_form_field_id', $field->id)
                ->first();
    
            $newValue = $httpRequest->input($fieldName);
    
            if ($fieldValue) {
                $fieldValue->update(['value' => $newValue]);
            } else {
                $firstEntryId = $entryIds->first();
                if ($firstEntryId) {
                    Request_Form_Field_Values::create([
                        'request_form_entry_id' => $firstEntryId,
                        'request_form_field_id' => $field->id,
                        'value'                 => $newValue,
                    ]);
                }
            }
        }
    
        // ── 4. Respond ────────────────────────────────────────────────────────
        if ($httpRequest->wantsJson() || $httpRequest->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Request updated successfully.',
            ]);
        }
    
        return redirect()
            ->route('forms-submitted.show', $requestId)
            ->with('success', 'Request updated successfully.');
    }


    public function editElporB1($requestId, $formId)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);
    
        $form = Request_Form::findOrFail($formId);
        $ofw  = $request->requestOfw;
    
        // ── Form field values (signature fields) ──────────────────────────────
        $entryIds = $request->requestFormEntries->pluck('id');
    
        $entries = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get()
            ->mapWithKeys(fn($fv) => [$fv->field->field_name => $fv->value]);
    
        // ── Startup items from dedicated table ────────────────────────────────
        $startup_items = Startup_Equipment_Products::where('request_id', $requestId)->get();
    
        return match ($formId) {
            '105' => view('forms-submitted.edit.elporb1', compact(
                'request', 'entries', 'form',
                'ofw', 'formId',
                'startup_items'
            )),
    
            default => abort(404, 'Edit view not found'),
        };
    }
    
    
    public function saveEditElporB1(Request $httpRequest, $requestId, $formId)
    {
        // ── 1. Load form entries ──────────────────────────────────────────────
        $requestRecord = Request_Number::with([
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);
    
        $entryIds = $requestRecord->requestFormEntries->pluck('id');
    
        // ── 2. Update signature fields ────────────────────────────────────────
        $editableFields = [
            'elpor_b1_full_name',
            'elpor_b1_date',
        ];
    
        foreach ($editableFields as $fieldName) {
            if (!$httpRequest->has($fieldName)) {
                continue;
            }
    
            $field = Request_Form_Field::where('field_name', $fieldName)
                ->where('request_form_id', $formId)
                ->first();
    
            if (!$field) {
                continue;
            }
    
            $fieldValue = Request_Form_Field_Values::whereIn('request_form_entry_id', $entryIds)
                ->where('request_form_field_id', $field->id)
                ->first();
    
            $newValue = $httpRequest->input($fieldName);
    
            if ($fieldValue) {
                $fieldValue->update(['value' => $newValue]);
            } else {
                $firstEntryId = $entryIds->first();
                if ($firstEntryId) {
                    Request_Form_Field_Values::create([
                        'request_form_entry_id' => $firstEntryId,
                        'request_form_field_id' => $field->id,
                        'value'                 => $newValue,
                    ]);
                }
            }
        }
    
        // ── 3. Startup items — only sync if the table was modified ────────────
        $itemsModified = $httpRequest->input('items_modified', '0');
    
        if ($itemsModified === '1') {
            // Delete all existing rows for this request and re-insert current ones
            Startup_Equipment_Products::where('request_id', $requestId)->delete();
    
            $items = $httpRequest->input('items', []);
    
            foreach ($items as $item) {
                // Skip completely empty rows
                if (
                    empty($item['supplier_name']) &&
                    empty($item['item_name'])
                ) {
                    continue;
                }
    
                Startup_Equipment_Products::create([
                    'request_id'    => $requestId,
                    'item_category' => $item['category']      ?? null,
                    'supplier_name' => $item['supplier_name'] ?? null,
                    'item_name'     => $item['item_name']     ?? null,
                    'item_price'    => $item['item_price']    ?? 0,
                    'item_qty'      => $item['item_qty']      ?? 0,
                    'item_total'    => $item['item_total']    ?? 0,
                ]);
            }
        }
    
        // ── 4. Respond ────────────────────────────────────────────────────────
        if ($httpRequest->wantsJson() || $httpRequest->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Request updated successfully.',
            ]);
        }
    
        return redirect()
            ->route('forms-submitted.show', $requestId)
            ->with('success', 'Request updated successfully.');
    }

    public function editBusinessCanvas($requestId, $formId){
        $request = Request_Number::with([
            'requestOfw',
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        $form          = Request_Form::findOrFail($formId);
        $ofw           = $request->requestOfw;

        // Get entry IDs for this form
        $entryIds = $request->requestFormEntries->pluck('id');

        // Get all field values from request_form_field_values directly
        $allFieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        // Keyed by field_name => value
        $entries = $allFieldValues->mapWithKeys(function ($fv) {
            return [$fv->field->field_name => $fv->value];
        });

        // Keyed by field_name => full fieldValue model
        $training_records = Ofw_Training_Record::where('request_id', $requestId)->get();

        return match ($formId) {
            '106' =>
                view('forms-submitted.edit.business_canvas', compact(
                    'request', 'entries', 'form',
                    'ofw', 'formId',
                )),

            default => abort(404, 'Edit view not found'),
        };
    }


    public function saveEditBusinessCanvas(Request $httpRequest, $requestId, $formId)
    {
        try {

            $request = Request_Number::with([
                'requestFormEntries' => function ($query) use ($formId) {
                    $query->where('request_form_id', $formId);
                },
            ])->findOrFail($requestId);

            // Validation
            $validated = $httpRequest->validate([
                'elpor_bc_customer'   => 'nullable|string',
                'elpor_bc_place'      => 'nullable|string',
                'elpor_bc_promotions' => 'nullable|string',
                'elpor_bc_price'      => 'nullable|string',

                'elpor_bc_idea'       => 'required|string',

                'elpor_bc_process'    => 'nullable|string',
                'elpor_bc_resources'  => 'nullable|string',
                'elpor_bc_partners'   => 'nullable|string',

                'elpor_bc_cost'       => 'nullable|string',
                'elpor_bc_investment' => 'nullable|string',
                'elpor_bc_budget'     => 'nullable|string',
                'elpor_bc_profit'     => 'nullable|string',
            ]);

            // Get the form entry
            $formEntry = $request->requestFormEntries->first();

            if (!$formEntry) {
                return response()->json([
                    'success' => false,
                    'message' => 'Form entry not found.',
                ], 404);
            }

            // Loop through all submitted fields
            foreach ($validated as $fieldName => $value) {

                // Find field definition
                $field = Request_Form_Field::where('field_name', $fieldName)->first();

                if (!$field) {
                    continue;
                }

                // Find existing value
                $fieldValue = Request_Form_Field_Values::where([
                    'request_form_entry_id' => $formEntry->id,
                    'request_form_field_id' => $field->id,
                ])->first();

                if ($fieldValue) {

                    // Update existing
                    $fieldValue->update([
                        'value' => $value,
                    ]);

                } else {

                    // Create if missing
                    Request_Form_Field_Values::create([
                        'request_form_entry_id' => $formEntry->id,
                        'request_form_field_id' => $field->id,
                        'value'                 => $value,
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Business Canvas updated successfully.',
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Failed to update Business Canvas.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $query = $request->get('q', '');

        $results = Request_Number::with(['requestOfw', 'requestParty'])
            ->where(function($q) use ($query) {
                $q->where('id', 'like', "%{$query}%")
                ->orWhere('status', 'like', "%{$query}%")
                ->orWhereHas('requestOfw', function($q) use ($query) {
                    $q->where('ofw_fname', 'like', "%{$query}%")
                        ->orWhere('ofw_lname', 'like', "%{$query}%")
                        ->orWhere('ofw_mname', 'like', "%{$query}%")
                        ->orWhere('request_id', 'like', "%{$query}%");
                })
                ->orWhereHas('requestParty', function($q) use ($query) {
                    $q->where('party_fname', 'like', "%{$query}%")
                        ->orWhere('party_lname', 'like', "%{$query}%")
                        ->orWhere('party_mname', 'like', "%{$query}%")
                        ->orWhere('request_id', 'like', "%{$query}%");
                });
            })
            ->latest()
            ->get();

        // Explicitly shape the response so JS keys are guaranteed
        $data = $results->map(function($r) {
            return [
                'id'         => $r->id,
                'status'     => $r->status,
                'created_at' => $r->created_at,
                'ofw'        => $r->requestOfw ? [
                    'fname' => $r->requestOfw->ofw_fname,
                    'mname' => $r->requestOfw->ofw_mname,
                    'lname' => $r->requestOfw->ofw_lname,
                    'ename' => $r->requestOfw->ofw_ename,
                    'request_id' => $r->requestOfw->request_id,
                ] : null,
                'party'      => $r->requestParty ? [
                    'fname' => $r->requestParty->party_fname,
                    'mname' => $r->requestParty->party_mname,
                    'lname' => $r->requestParty->party_lname,
                    'ename' => $r->requestParty->party_ename,
                    'request_id' => $r->requestParty->request_id,
                ] : null,
            ];
        });

        return response()->json($data);
    }
    /*
    |-------------------------------------------------------
    | GENERAL — Static landing page
    |-------------------------------------------------------
    */
    // public function generalFormSubmitted()
    // {
    //     return view('forms-submitted.general');
    // }

    // public function updateNewSubmission(Request $request, $id)
    // {
    //     $requestNumber = Request_Number::with(['requestOfw', 'requestParty'])->findOrFail($id);

    //     $validated = $request->validate([
    //         'selected_forms' => 'required|array|min:1',
    //         'selected_forms.*' => 'string',
    //     ]);

    //     $selectedForms = collect($validated['selected_forms'])->unique()->values();

    //     $encryptedId = Crypt::encryptString($id);

    //     $formUrls = [
    //         'REQUEST FOR ASSISTANCE (RFA) FORM' => route('forms.aksyon', ['request_id' => $encryptedId]),
    //         'REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS' => route('forms.processing', ['request_id' => $encryptedId]),
    //         'SINGLE-ENTRY APPROACH (SENA)' => route('forms.sena', ['request_id' => $encryptedId]),
    //         'ENHANCED LIVEHOOD PROGRAM FOR OFW REINTEGRATION (ELPOR) APPLICATION FORM' => route('forms.sena', ['request_id' => $encryptedId]),
    //     ];

    //     $selectedFormLinks = $selectedForms->map(function ($label) use ($formUrls, $encryptedId) {
    //         return [
    //             'label' => $label,
    //             'url' => $formUrls[$label] ?? route('forms.index', ['request_id' => $encryptedId]),
    //         ];
    //     })->toArray();


    //     $recipientEmail = $requestNumber->requestOfw->ofw_email;
    //     $recipientName = $requestNumber->requestOfw->ofw_fname.' '.$requestNumber->requestOfw->ofw_lname;

    //     DB::beginTransaction();
        
    //     try {
    //         $requestNumber->update([
    //             'status' => 'FORMS_REQUESTED'
    //         ]);

    //         if ($recipientEmail) {
    //             Mail::to($recipientEmail)
    //                 ->send(new EmployeeSelectForms($id, $recipientName, $selectedFormLinks));
    //         }

    //         DB::commit();
    //         return response()->json(['success' => true, 'message' => 'Status updated successfully']);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         dd($recipientEmail, $recipientName, $selectedFormLinks);
    //         return response()->json(['success' => false, 'message' => $e->getMessage()]);
    //     }
    // }
    // app/Http/Controllers/YourController.php

    public function updateNewSubmission(Request $request, $id)
    {
        $requestNumber = Request_Number::with(['requestOfw', 'requestParty'])->findOrFail($id);

        $validated = $request->validate([
            'selected_forms'   => 'required|array|min:1',
            'selected_forms.*' => 'string',
        ]);

        // Deduplicate while preserving order
        $selectedForms = collect($validated['selected_forms'])->unique()->values();

        // Persist the ordered steps on the record
        $encryptedId = Crypt::encryptString($id);

        // Build a SINGLE entry-point URL for the multi-step flow
        // $entryUrl = route('forms.multi-step', [
        //     'request_id' => $encryptedId,
        //     'step'       => 1,
        // ]);

        $entryUrl = URL::temporarySignedRoute(
            'forms.multi-step',
            now()->addMinutes(1),   // ← 5 minutes for testing; change to addDays(7) for production
            [
                'request_id' => $encryptedId,
                'step'       => 1,
            ]
        );

        $selectedFormsWithUrls = [
            [
                'label' => 'Click here to complete your required form(s)',
                'url'   => $entryUrl,
            ]
        ];

        $recipientEmail = $requestNumber->requestOfw->ofw_email;
        $recipientName  = $requestNumber->requestOfw->ofw_fname
                        . ' '
                        . $requestNumber->requestOfw->ofw_lname;

        DB::beginTransaction();

        try {
            $requestNumber->update([
                // 'status'     => 'FORMS_REQUESTED',
                'form_step' => $selectedForms->toArray(), // store ordered steps
            ]);

            $requestNumber->refresh();
            //dd($requestNumber->form_step); // is it null or the array?

            if ($recipientEmail) {
                Mail::to($recipientEmail)
                    ->send(new EmployeeSelectForms($id, $recipientName, $selectedFormsWithUrls));
            }

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);

        } catch (\Exception $e) {
            DB::rollBack();
            dd($requestNumber->form_step);
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
