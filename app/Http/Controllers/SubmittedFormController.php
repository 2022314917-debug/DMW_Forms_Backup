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
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\ProcessingRequest;
use Illuminate\Support\Facades\Http;

class SubmittedFormController extends Controller
{
    // public function index()
    // {
    //     $requests = Request_Number::latest()->paginate(10);

    //     return view('forms-submitted.index', compact('requests'));
    // }


    // /**
    //  * Show list of submitted GENERAL forms
    //  */
    // public function general()
    // {
    //     $requests = Request_Number::with([
    //         'requestParty',
    //         'requestOFW'
    //     ])
    //     ->latest()
    //     ->paginate(10);

    //     return view('forms-submitted.general.index', compact('requests'));
    // }


    // /**
    //  * Show specific GENERAL form
    //  */
    // public function showGeneral($id){
    //     // Main request
    //     $request = Request_Number::findOrFail($id);

    //     // Party info
    //     $party = Request_Party::where('request_id', $id)->first();

    //     // Party address
    //     $address = Request_Party_Address::where('request_id', $id)->first();

    //     // OFW info
    //     $ofw = Request_OFW::where('request_id', $id)->first();

    //     // Section C values
    //     $sectionC = DB::table('request_form_entries as rfe')
    //         ->join('request_form_field_values as rffv', 'rffv.request_form_entry_id', '=', 'rfe.id')
    //         ->join('request_form_field as rff', 'rff.id', '=', 'rffv.request_form_field_id')
    //         ->where('rfe.request_id', $id)
    //         ->select(
    //             'rff.field_name',
    //             'rff.field_label',
    //             'rffv.value'
    //         )
    //         ->get()
    //         ->keyBy('field_name'); // IMPORTANT

    //     return view('forms-submitted.general', compact(
    //         'request',
    //         'party',
    //         'address',
    //         'ofw',
    //         'sectionC'
    //     ));
    // }

    public function index()
    {
        $requests = Request_Number::with([
            'requestOfw',
            'requestParty'
        ])
        ->latest() // order by created_at desc
        ->get();

        return view('forms-submitted.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Request_Number::with([
            'requestOfw',
            'requestParty',
            'requestOfwAddress',
            'requestPartyAddress',
            'requestFormEntries.form.division', // added .division here
            'statusHistory',
        ])->findOrFail($id);

        $forms = $request->requestFormEntries
            ->groupBy('request_form_id')
            ->map(fn($entries) => [
                'form'        => $entries->first()->form,
                'division_id' => $entries->first()->form->division_id,
                'division_name'    => $entries->first()->form->division_name,
                'status'      => $entries->first()->status,
            ]);
            

        return view('forms-submitted.show', compact('request', 'forms'));
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
        ])->findOrFail($requestId);

        $form    = Request_Form::findOrFail($formId);
        $ofw     = $request->requestOfw;
        $party   = $request->requestParty;
        $ofw_address = $request->requestOfwAddress;
        $party_address = $request->requestPartyAddress;


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

        // Keyed by field_name => full fieldValue model, e.g. $sectionC['party_lname']->value
        $sectionC = $allFieldValues->keyBy(fn($fv) => $fv->field->field_name);

        return match ($form->id) {
            100 =>
                view('forms-submitted.show.general', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),
            101 =>
                view('forms-submitted.show.processing', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),
            102 =>
                view('forms-submitted.show.aksyon', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),
            103 =>
                view('forms-submitted.show.ofw_info_sheet_mwpd_protection', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),
            104 =>
                view('forms-submitted.show.sena', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address' ,'sectionC'
                )),
            default => abort(404, 'Form view not found'),
        };
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
            '104' =>
                view('forms-submitted.edit.sena', compact(
                    'request', 'entries', 'form',
                    'ofw', 'party', 'ofw_address', 'party_address', 'sectionC'
                )),

            default => abort(404, 'Edit view not found'),
        };
    }

    public function saveEditSENA(Request $request, $requestId, $formId)
    {
        $requestModel = Request_Number::with([
            'requestFormEntries' => function ($query) use ($formId) {
                $query->where('request_form_id', $formId);
            },
        ])->findOrFail($requestId);

        // Get entry IDs
        $entryIds = $requestModel->requestFormEntries->pluck('id');

        // Get all existing field values for this form
        $fieldValues = Request_Form_Field_Values::with('field')
            ->whereIn('request_form_entry_id', $entryIds)
            ->get();

        foreach ($fieldValues as $fv) {
            $fieldName = $fv->field->field_name;

            // Only update if present in request
            if ($request->has($fieldName)) {

                $value = $request->input($fieldName);

                // Handle checkboxes (unchecked = null → store empty or 0)
                if (is_null($value)) {
                    $value = '';
                }

                // Save updated value
                $fv->value = $value;
                $fv->save();
            } else {
                // Optional: for unchecked checkboxes (not sent in request)
                if (str_contains($fieldName, '_mwpd_protection')) {
                    $fv->value = ''; // or null / 0 depending on your system
                    $fv->save();
                }
            }
        }

        return redirect()
            ->route('forms-submitted.show', $requestId)
            ->with('success', 'SENA form updated successfully.');
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
}
