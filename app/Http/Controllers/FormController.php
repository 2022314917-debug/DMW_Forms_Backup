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
use App\Models\Request_Ofw_Address;
use App\Models\Request_Status_History;
use App\Models\Requirements;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
Use App\Mail\SubmittedFormsSuccessfully;


class FormController extends Controller
{
    public function index()
    {
        session()->flush();
        return view('forms.index');
    }

    public function dataprivacy()
    {
        return view('forms.dataprivacy');
    }

    public function generalForm(){
        return view('forms.general');
    }


    public function storeGeneralForm(HttpRequest $request)
    {

        //     // Create Request_Form record (linking request to the "OFFICIAL DMW-RO3 RFA FORM")
        //     $requestForm = Request_Form::where('form_name', 'OFFICIAL DMW-RO3 RFA FORM')->first();
        //     if (!$requestForm) {
        //         // If the form doesn't exist, create it with default division_id
        //         $requestForm = Request_Form::create([
        //             'division_id' => 0,
        //             'form_name' => 'OFFICIAL DMW-RO3 RFA FORM'
        //         ]);
        //     }
        //     Log::info('Request_Form record found/created with ID: ' . $requestForm->id);

        //     // Process Section C - Nature of Request
        //     // Collect all selected field values with their field names
        //     $sectionCFields = [];

        //     // Add MWPD checkbox selections (values already match database field_names)
        //     if (!empty($validated['mwpd'])) {
        //         foreach ($validated['mwpd'] as $fieldName) {
        //             $sectionCFields[] = [
        //                 'field_name' => $fieldName,
        //                 'value' => 'yes'
        //             ];
        //         }
        //     }

        //     // Add WRSD checkbox selections - map 'others' to 'other_concerns_wrsd'
        //     if (!empty($validated['wrsd'])) {
        //         foreach ($validated['wrsd'] as $fieldName) {
        //             // 'others' checkbox for "Other Concerns" maps to 'other_concerns_wrsd'
        //             $dbFieldName = ($fieldName === 'others') ? 'other_concerns_wrsd' : $fieldName;
        //             $sectionCFields[] = [
        //                 'field_name' => $dbFieldName,
        //                 'value' => 'yes'
        //             ];
        //         }
        //     }

        //     // Add MWPD Protection checkbox selections - map 'others' to 'other_concerns_mwpd_protection'
        //     if (!empty($validated['mwpd_protection'])) {
        //         foreach ($validated['mwpd_protection'] as $fieldName) {
        //             // 'others' checkbox for "Other Concerns" maps to 'other_concerns_mwpd_protection'
        //             $dbFieldName = ($fieldName === 'others') ? 'other_concerns_mwpd_protection' : $fieldName;
        //             $sectionCFields[] = [
        //                 'field_name' => $dbFieldName,
        //                 'value' => 'yes'
        //             ];
        //         }
        //     }

        //     // Add G2G Country radio button if selected
        //     if (!empty($validated['g2g_country'])) {
        //         $sectionCFields[] = [
        //             'field_name' => $validated['g2g_country'],
        //             'value' => 'yes'
        //         ];
                
        //         // Add G2G Others text if specified (form sends 'g2g_others_text', db field is 'g2g_others_specify')
        //         if (!empty($validated['g2g_others_text'])) {
        //             $sectionCFields[] = [
        //                 'field_name' => 'g2g_others_specify',
        //                 'value' => $validated['g2g_others_text']
        //             ];
        //         }
        //     }

        //     // Add Reintegration Services text if provided
        //     if (!empty($validated['reint_serv_text'])) {
        //         $sectionCFields[] = [
        //             'field_name' => 'reint_serv_text',
        //             'value' => $validated['reint_serv_text']
        //         ];
        //     }

        //     // Add Assistance Type radio button if selected
        //     if (!empty($validated['assistance_type'])) {
        //         $sectionCFields[] = [
        //             'field_name' => $validated['assistance_type'],
        //             'value' => 'yes'
        //         ];
                
        //         // Add Assistance Others text if specified
        //         if (!empty($validated['assistance_others_text'])) {
        //             $sectionCFields[] = [
        //                 'field_name' => 'assistance_others_text',
        //                 'value' => $validated['assistance_others_text']
        //             ];
        //         }
        //     }

        //     // Add Other Concerns text fields
        //     if (!empty($validated['other_concerns_mwpd_text'])) {
        //         $sectionCFields[] = [
        //             'field_name' => 'other_concerns_mwpd_text',
        //             'value' => $validated['other_concerns_mwpd_text']
        //         ];
        //     }

        //     if (!empty($validated['other_concerns_wrsd_text'])) {
        //         $sectionCFields[] = [
        //             'field_name' => 'other_concerns_wrsd_text',
        //             'value' => $validated['other_concerns_wrsd_text']
        //         ];
        //     }

        //     if (!empty($validated['other_concerns_mwpd_protection_text'])) {
        //         $sectionCFields[] = [
        //             'field_name' => 'other_concerns_mwpd_protection_text',
        //             'value' => $validated['other_concerns_mwpd_protection_text']
        //         ];
        //     }

        //     // Store form entries with proper field IDs
        //     foreach ($sectionCFields as $field) {
        //         // Find the Request_Form_Field matching the field_name
        //         $formField = Request_Form_Field::where('request_form_id', $requestForm->id)
        //             ->where('field_name', $field['field_name'])
        //             ->first();

        //         if ($formField) {
        //             // Create Request_Form_Entries record - store the field ID in value column
        //             $formEntry = Request_Form_Entries::create([
        //                 'request_id' => $newRequest->id,
        //                 'request_form_field_id' => $formField->id,
        //                 'value' => $formField->id  // Store field ID instead of value
        //             ]);
        //             Log::info('Request_Form_Entries created - Field ID: ' . $formField->id . ', Field Name: ' . $field['field_name']);

        //             // Create Request_Form_Field_Values record - store the actual value
        //             Request_Form_Field_Values::create([
        //                 'request_form_entry_id' => $formEntry->id,
        //                 'request_form_field_id' => $formField->id,
        //                 'value' => $field['value']  // Store actual submitted value here
        //             ]);
        //             Log::info('Request_Form_Field_Values created - Entry ID: ' . $formEntry->id . ', Actual Value: ' . $field['value']);
        //         } else {
        //             Log::warning('Request_Form_Field not found for field_name: ' . $field['field_name']);
        //         }
        //     }


            $mwpd = $request->input('mwpd', []);
            $wrsd = $request->input('wrsd', []);
            $mwpd_protection = $request->input('mwpd_protection', []);

            $selectedForms = array_merge($mwpd, $wrsd, $mwpd_protection);

            $total = count($selectedForms);

            $steps = [];

            foreach ($selectedForms as $form) {
                $steps[] = $form;
            }

            session([
                'forms.steps' => $steps
            ]);

            session([
                'forms.current_step' => 0
            ]);

            session([
                'general_form_data' => $request->all()
            ]);


        //     // return redirect()->route('forms.processing')->with('success', 'Form submitted successfully! Your Request ID is: ' . $total);
            return redirect('/forms/step/' . $steps[0]);


    }
    public function showStep($step)
    {
        $steps = session('forms.steps', []);

        // Ensure 'general' is first
        $steps = array_diff($steps, ['general']);
        array_unshift($steps, 'general');

        // Ensure 'requirements' is last (auto include)
        $steps = array_diff($steps, ['requirements']);
        $steps[] = 'requirements';

        session(['forms.steps' => $steps]);

        if (!in_array($step, $steps)) {
            return redirect()->route('forms.index')
                ->with('error', 'Invalid step.');
        }

        $formViews = [
            'general' => 'forms.general',
            'ofw_info_sheet_mwpd' => 'forms.processing',
            'aksyon' => 'forms.aksyon',
            'ofw_info_sheet_mwpd_protection' => 'forms.ofw_info_sheet_mwpd_protection',
            'sena' => 'forms.sena',
            'requirements' => 'forms.requirements', // auto included
        ];

        if (!isset($formViews[$step])) {
            abort(404, 'Form view not found');
        }

        $formData = session("forms.data", []);

        return view($formViews[$step], compact('formData', 'step'));
    }

    public function storeStep(Request $request, $step)
    {
        $steps = session('forms.steps', []);

        // ensure order
        $steps = array_diff($steps, ['general']);
        array_unshift($steps, 'general');

        $steps = array_diff($steps, ['requirements']);
        $steps[] = 'requirements';

        session(['forms.steps' => $steps]);

        $currentIndex = array_search($step, $steps);

        // SAVE FORM DATA FIRST
        session([
            "forms.data.$step" => $request->except('_token')
        ]);

        $action = $request->input('action');

        // -------------------------
        // BACK BUTTON
        // -------------------------
        if ($action === 'back') {

            $prevIndex = $currentIndex - 1;

            if (isset($steps[$prevIndex])) {
                return redirect('/forms/step/' . $steps[$prevIndex]);
            }

            return redirect('/forms');
        }

        // -------------------------
        // FINAL SUBMIT BUTTON
        // -------------------------
        if ($action === 'submit') {
            return redirect()->route('forms.submit.all');
        }

        // -------------------------
        // DEFAULT: NEXT STEP
        // -------------------------
        $nextIndex = $currentIndex + 1;

        if (!isset($steps[$nextIndex])) {
            return redirect('/forms/preview');
        }

        return redirect('/forms/step/' . $steps[$nextIndex]);
    }

    public function processingForm(){
        return view('forms.processing');
    }

  

    public function ofw_info_sheet_mwpd_protection(){
        return view('forms.ofw_info_sheet_mwpd_protection');
    }

    public function senaForm(){
        return view('forms.sena');
    }

    

    public function aksyonForm()
    {
        return view('forms.aksyon');
    }


   

    public function requirements(){
        return view('forms.requirements');
    }

    public function generalFormSubmitted(){
        return view('forms-submitted.general');
    }

    public function submitAllForms(Request $request)
    {
        $generalFormData = session('general_form_data', []);
        $steps = session('forms.steps', []);
        $formsData = session('forms.data', []);

        DB::beginTransaction();
        // dd([
        //     'general_form_data' => session('general_form_data', []),
        //     'forms_steps'       => session('forms.steps', []),
        //     'forms_data'        => session('forms.data', []),
        //     'request_all'       => $request->except('_token'),
        //     'files'             => $request->allFiles(),
        // ]);
        try {
            $requestNumber = Request_Number::create([
                'status' => 'Pending'
            ]);

            $requestOFW = Request_OFW::create([
                'request_id' => $requestNumber->id,
                'ofw_lname'    => $generalFormData['ofw_lname'] ?? null,
                'ofw_fname'    => $generalFormData['ofw_fname'] ?? null,
                'ofw_ename'    => $generalFormData['ofw_ename'] ?? null,
                'ofw_mname'    => $generalFormData['ofw_mname'] ?? null,
                'ofw_passport_no' => $generalFormData['ofw_passport_no'] ?? null,
                'ofw_gender'   => $generalFormData['ofw_gender'] ?? null,
                'ofw_civil_status' => $generalFormData['ofw_civil_status'] ?? null,
                'ofw_email'    => $generalFormData['ofw_email'] ?? null,
                'ofw_phone'    => $generalFormData['ofw_phone'] ?? null,
                'ofw_bday'     => $generalFormData['ofw_bday'] ?? null,
                'ofw_country'  => $generalFormData['ofw_country_name'] ?? null,
                'ofw_job'      => $generalFormData['ofw_job'] ?? null,
                'ofw_employer' => $generalFormData['ofw_employer'] ?? null,
                'ofw_agency'   => $generalFormData['ofw_agency'] ?? null,
            ]);

            Request_Ofw_Address::create([
                'request_id'      => $requestNumber->id,
                'request_ofw_id'  => $requestOFW->id,
                'house_no'        => $generalFormData['ofw_address_street'] ?? null,
                'province'        => $generalFormData['ofw_province_name'] ?? null,
                'municipality'    => $generalFormData['ofw_municipality_name'] ?? null,
                'brgy'            => $generalFormData['ofw_barangay_name'] ?? null,
                'zip_code'        => $generalFormData['ofw_zip_code'] ?? null,
            ]);

            // Only create party record if party data is not empty
            if (!empty($generalFormData['party_lname']) || !empty($generalFormData['party_fname']) || !empty($generalFormData['party_email']) || !empty($generalFormData['party_phone']) || !empty($generalFormData['party_bday']) || !empty($generalFormData['party_gender']) || !empty($generalFormData['party_relationship'])) {
                $requestParty = Request_Party::create([
                    'request_id'          => $requestNumber->id,
                    'party_lname'         => $generalFormData['party_lname'] ?? null,
                    'party_fname'         => $generalFormData['party_fname'] ?? null,
                    'party_ename'         => $generalFormData['party_ename'] ?? null,
                    'party_mname'         => $generalFormData['party_mname'] ?? null,
                    'party_email'         => $generalFormData['party_email'] ?? null,
                    'party_phone'         => $generalFormData['party_phone'] ?? null,
                    'party_bday'          => $generalFormData['party_bday'] ?? null,
                    'party_gender'        => $generalFormData['party_gender'] ?? null,
                    'party_relationship'  => $generalFormData['party_relationship'] ?? null,
                ]);

                Request_Party_Address::create([
                    'request_id'       => $requestNumber->id,
                    'request_party_id' => $requestParty->id,
                    'house_no'         => $generalFormData['party_address_street'] ?? null,
                    'province'         => $generalFormData['party_province_name'] ?? null,
                    'municipality'     => $generalFormData['party_municipality_name'] ?? null,
                    'brgy'             => $generalFormData['party_barangay_name'] ?? null,
                    'zip_code'         => $generalFormData['party_zip_code'] ?? null,
                ]);
            }

            // Pre-load field map: ['field_name' => ['id' => x, 'form_id' => y]]
            $fieldMap = Request_Form_Field::with('form')
                ->get()
                ->keyBy('field_name')
                ->map(fn($f) => ['id' => $f->id, 'form_id' => $f->request_form_id]);

            // Handle checkbox arrays stored in general_form_data
            $checkboxGroups = ['mwpd', 'wrsd', 'mwpd_protection'];

            // Group checkboxes by their form_id first
            $checkboxesByForm = [];
            foreach ($checkboxGroups as $group) {
                if (!empty($generalFormData[$group]) && is_array($generalFormData[$group])) {
                    foreach ($generalFormData[$group] as $value) {
                        $fieldData = $fieldMap[$value] ?? null;

                        if (!$fieldData) {
                            Log::warning("Missing checkbox field mapping: " . $value);
                            continue;
                        }

                        $checkboxesByForm[$fieldData['form_id']][] = [
                            'field_id' => $fieldData['id'],
                            'value'    => 'checked',
                        ];
                    }
                }
            }

            // Create 1 entry per form for checkboxes
            foreach ($checkboxesByForm as $formId => $checkboxFields) {
                $entry = Request_Form_Entries::create([
                    'request_id'      => $requestNumber->id,
                    'request_form_id' => $formId,
                    'status'          => 'Pending',
                ]);

                foreach ($checkboxFields as $field) {
                    Request_Form_Field_Values::create([
                        'request_form_entry_id' => $entry->id,
                        'request_form_field_id' => $field['field_id'],
                        'value'                 => $field['value'],
                    ]);
                }
            }

            // Handle formsData — group fields by form_id, 1 entry per form
            foreach ($formsData as $step => $fields) {
                $fieldsByForm = [];

                foreach ($fields as $fieldKey => $value) {
                    $fieldData = $fieldMap[$fieldKey] ?? null;

                    if (!$fieldData) {
                        Log::warning("Missing field mapping: " . $fieldKey);
                        continue;
                    }

                    $fieldsByForm[$fieldData['form_id']][] = [
                        'field_id' => $fieldData['id'],
                        'value'    => is_array($value) ? json_encode($value) : $value,
                    ];
                }

                foreach ($fieldsByForm as $formId => $formFields) {
                    $entry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => $formId,
                        'status'          => 'Pending',
                    ]);

                    foreach ($formFields as $field) {
                        Request_Form_Field_Values::create([
                            'request_form_entry_id' => $entry->id,
                            'request_form_field_id' => $field['field_id'],
                            'value'                 => $field['value'],
                        ]);
                    }
                }
            }

            // -------------------------
            // HANDLE FILE UPLOADS
            // -------------------------
            // Map each input name to a human-readable type label
            $fileInputs = [
                'passport'    => 'Philippine Passport / Travel Document',
                'boarding'    => 'Arrival Stamp / Boarding Pass',
                'contract'    => 'Employment Contract',
                'visa'        => 'VISA / Latest OEC',
                'medical'     => 'Medical Record / Abstract',
                'endorsement' => 'Endorsement Certificate/Letter',
                'distress'    => 'Other Proof of Distressed',
                'valid_id'    => 'Valid ID',
            ];

            foreach ($fileInputs as $inputName => $fileType) {

                if ($request->hasFile($inputName)) {

                    foreach ($request->file($inputName) as $file) {

                        if (!$file->isValid()) {
                            Log::warning("Invalid file upload for input: {$inputName}");
                            continue;
                        }

                        $originalName = $file->getClientOriginalName();

                        // ✅ Store inside: storage/app/public/requirements/{request_id}/{type}/
                        $path = $file->storeAs(
                            'requirements/' . $requestNumber->id . '/' . $inputName,
                            $originalName,
                            'public'
                        );

                        Requirements::create([
                            'request_id' => $requestNumber->id,
                            'file_name'  => $originalName,
                            'file_path'  => $path, // IMPORTANT (use file_path now)
                            'file_type'  => $fileType,
                        ]);
                    }
                }
            }
            // -------------------------
            // END FILE UPLOADS
            // -------------------------
            
            // Collect all form IDs that were actually filled by the user
            $usedFormIds = [];

            // Add form IDs from checkboxes (selected forms)
            foreach ($checkboxesByForm as $formId => $checkboxFields) {
                $usedFormIds[] = $formId;
            }

            // Add form IDs from form data (filled data)
            foreach ($formsData as $step => $fields) {
                $fieldsByForm = [];
                foreach ($fields as $fieldKey => $value) {
                    $fieldData = $fieldMap[$fieldKey] ?? null;
                    if (!$fieldData) {
                        continue;
                    }
                    $fieldsByForm[$fieldData['form_id']][] = [
                        'field_id' => $fieldData['id'],
                        'value'    => is_array($value) ? json_encode($value) : $value,
                    ];
                }
                foreach ($fieldsByForm as $formId => $formFields) {
                    $usedFormIds[] = $formId;
                }
            }

            // Get unique form IDs only from forms that were actually used
            $usedFormIds = array_unique($usedFormIds);

            // Get form names for only the forms filled by the user
            $form_names = Request_Form::whereIn('id', $usedFormIds)->pluck('form_name', 'id')->toArray();
            
            $to = $generalFormData['ofw_email'] ?? null;
            $ofw_full_name = trim(($generalFormData['ofw_fname'] ?? '') . ' ' . ($generalFormData['ofw_mname'] ?? '') . ' ' . ($generalFormData['ofw_lname'] ?? ''));
            $partyEmail = $generalFormData['party_email'] ?? null;
            $party_full_name = trim(($generalFormData['party_fname'] ?? '') . ' ' . ($generalFormData['party_mname'] ?? '') . ' ' . ($generalFormData['party_lname'] ?? ''));
            $dateSubmitted = now()->toDateTimeString();
            
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
                    Mail::to($recipient['email'])->send(new SubmittedFormsSuccessfully($form_names, $requestNumber->id, $recipient['name'], $dateSubmitted));
                }
            } else {
                // Send email to OFW only
                Mail::to($to)->send(new SubmittedFormsSuccessfully($form_names, $requestNumber->id, $ofw_full_name, $dateSubmitted));
            }

            Request_Status_History::create([
                'request_id' => $requestNumber->id,
                'status'     => 'Pending',
                'remarks'    => 'Initial submission',
            ]);

            DB::commit();

            session()->flush();

            return redirect()->route('forms.success')
                ->with('success', 'Forms submitted successfully! Your Request ID is: ' . $requestNumber->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error submitting all forms: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            // dd([
            //     'general_form_data' => session('general_form_data', []),
            //     'forms_steps'       => session('forms.steps', []),
            //     'forms_data'        => session('forms.data', []),
            //     'request_all'       => $request->except('_token'),
            //     'files'             => $request->allFiles(),
            // ]);

            dd($e->getMessage());
            return redirect()->route('forms.index')
                ->with('error', 'Error submitting forms: ' . $e->getMessage());
        }
    }

    public function submissionSuccess()
    {
        return view('forms.success');
    }


    function formsSubmittedSuccess()
    {
        return view('mail.forms_submitted_success');
    }
}

