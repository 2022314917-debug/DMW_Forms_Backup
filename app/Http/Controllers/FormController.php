<?php

namespace App\Http\Controllers;

use App\Models\Request;
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

class FormController extends Controller
{
    public function index()
    {
        return view('forms.index');
    }

    public function generalForm(){
        return view('forms.general');
    }

    public function storeGeneralForm(HttpRequest $request)
    {
        Log::info('Form submission received', ['data' => $request->except(['_token'])]);
        
        // Validate the request
        $validated = $request->validate([
            // Section A - Request Party
            'party_lname' => 'required|string|max:255',
            'party_fname' => 'required|string|max:255',
            'party_ename' => 'nullable|string|max:255',
            'party_mname' => 'nullable|string|max:255',
            'party_bday' => 'required|date',
            'party_gender' => 'required|string',
            'party_relationship' => 'required|string|max:255',
            'party_phone' => 'required|string|max:20',
            'party_email' => 'required|email|max:255',
            'party_address_street' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'province_name' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'municipality_name' => 'required|string|max:255',
            'barangay' => 'required|string|max:255',
            'barangay_name' => 'required|string|max:255',
            'zip_code' => 'nullable|string|max:10',

            // Section B - OFW Info
            'ofw_lname' => 'required|string|max:255',
            'ofw_fname' => 'nullable|string|max:255',
            'ofw_ename' => 'nullable|string|max:255',
            'ofw_mname' => 'nullable|string|max:255',
            'ofw_bday' => 'required|date',
            'ofw_gender' => 'required|string',
            'ofw_passport_no' => 'required|string|max:255',
            'ofw_agency' => 'required|string|max:255',
            'ofw_employer' => 'required|string|max:255',
            'ofw_country' => 'required|string|max:255',
            'ofw_country_name' => 'required|string|max:255',
            'ofw_job' => 'required|string|max:255',

            // Section C - Nature of Request (Checkboxes)
            'mwpd' => 'nullable|array',
            'wrsd' => 'nullable|array',
            'mwpd_protection' => 'nullable|array',
            'g2g_country' => 'nullable|string',
            'g2g_others_text' => 'nullable|string',
            'reint_serv_text' => 'nullable|string',
            'assistance_type' => 'nullable|string',
            'assistance_others_text' => 'nullable|string',
            'other_concerns_mwpd_text' => 'nullable|string',
            'other_concerns_wrsd_text' => 'nullable|string',
            'other_concerns_mwpd_protection_text' => 'nullable|string',
        ]);

        Log::info('Form validation passed');

        try {
            DB::beginTransaction();
            Log::info('Database transaction started');

            // Create Request record
            /** @var \App\Models\Request $newRequest */
            $newRequest = Request::create([
                'status' => 'pending'
            ]);
            Log::info('Request created with ID: ' . $newRequest->id);

            // Create Request_Party record
            Request_Party::create([
                'request_id' => $newRequest->id,
                'party_lname' => $validated['party_lname'],
                'party_fname' => $validated['party_fname'],
                'party_ename' => $validated['party_ename'] ?? null,
                'party_mname' => $validated['party_mname'] ?? null,
                'party_email' => $validated['party_email'],
                'party_phone' => $validated['party_phone'],
                'party_bday' => $validated['party_bday'],
                'party_gender' => $validated['party_gender'],
                'party_relationship' => $validated['party_relationship'],
            ]);
            Log::info('Request_Party record created');

            // Create Request_Party_Address record
            $requestParty = Request_Party::where('request_id', $newRequest->id)->first();
            Request_Party_Address::create([
                'request_id' => $newRequest->id,
                'request_party_id' => $requestParty->id,
                'province' => $validated['province_name'],
                'municipality' => $validated['municipality_name'],
                'brgy' => $validated['barangay_name'],
                'house_no' => $validated['party_address_street'],
                'zip_code' => $validated['zip_code'] ?? null,
            ]);

            // Create Request_OFW record
            Request_OFW::create([
                'request_id' => $newRequest->id,
                'ofw_lname' => $validated['ofw_lname'],
                'ofw_fname' => $validated['ofw_fname'],
                'ofw_ename' => $validated['ofw_ename'] ?? null,
                'ofw_mname' => $validated['ofw_mname'] ?? null,
                'ofw_passport_no' => $validated['ofw_passport_no'],
                'ofw_country' => $validated['ofw_country_name'],
                'ofw_job' => $validated['ofw_job'],
                'ofw_employer' => $validated['ofw_employer'],
                'ofw_agency' => $validated['ofw_agency'],
                'bday' => $validated['ofw_bday'],
                'gender' => $validated['ofw_gender'],
            ]);
            Log::info('Request_OFW record created');

            // Create Request_Form record (linking request to the "OFFICIAL DMW-RO3 RFA FORM")
            $requestForm = Request_Form::where('form_name', 'OFFICIAL DMW-RO3 RFA FORM')->first();
            if (!$requestForm) {
                // If the form doesn't exist, create it with default division_id
                $requestForm = Request_Form::create([
                    'division_id' => 0,
                    'form_name' => 'OFFICIAL DMW-RO3 RFA FORM'
                ]);
            }
            Log::info('Request_Form record found/created with ID: ' . $requestForm->id);

            // Process Section C - Nature of Request
            // Collect all selected field values with their field names
            $sectionCFields = [];

            // Add MWPD checkbox selections (values already match database field_names)
            if (!empty($validated['mwpd'])) {
                foreach ($validated['mwpd'] as $fieldName) {
                    $sectionCFields[] = [
                        'field_name' => $fieldName,
                        'value' => 'yes'
                    ];
                }
            }

            // Add WRSD checkbox selections - map 'others' to 'other_concerns_wrsd'
            if (!empty($validated['wrsd'])) {
                foreach ($validated['wrsd'] as $fieldName) {
                    // 'others' checkbox for "Other Concerns" maps to 'other_concerns_wrsd'
                    $dbFieldName = ($fieldName === 'others') ? 'other_concerns_wrsd' : $fieldName;
                    $sectionCFields[] = [
                        'field_name' => $dbFieldName,
                        'value' => 'yes'
                    ];
                }
            }

            // Add MWPD Protection checkbox selections - map 'others' to 'other_concerns_mwpd_protection'
            if (!empty($validated['mwpd_protection'])) {
                foreach ($validated['mwpd_protection'] as $fieldName) {
                    // 'others' checkbox for "Other Concerns" maps to 'other_concerns_mwpd_protection'
                    $dbFieldName = ($fieldName === 'others') ? 'other_concerns_mwpd_protection' : $fieldName;
                    $sectionCFields[] = [
                        'field_name' => $dbFieldName,
                        'value' => 'yes'
                    ];
                }
            }

            // Add G2G Country radio button if selected
            if (!empty($validated['g2g_country'])) {
                $sectionCFields[] = [
                    'field_name' => $validated['g2g_country'],
                    'value' => 'yes'
                ];
                
                // Add G2G Others text if specified (form sends 'g2g_others_text', db field is 'g2g_others_specify')
                if (!empty($validated['g2g_others_text'])) {
                    $sectionCFields[] = [
                        'field_name' => 'g2g_others_specify',
                        'value' => $validated['g2g_others_text']
                    ];
                }
            }

            // Add Reintegration Services text if provided
            if (!empty($validated['reint_serv_text'])) {
                $sectionCFields[] = [
                    'field_name' => 'reint_serv_text',
                    'value' => $validated['reint_serv_text']
                ];
            }

            // Add Assistance Type radio button if selected
            if (!empty($validated['assistance_type'])) {
                $sectionCFields[] = [
                    'field_name' => $validated['assistance_type'],
                    'value' => 'yes'
                ];
                
                // Add Assistance Others text if specified
                if (!empty($validated['assistance_others_text'])) {
                    $sectionCFields[] = [
                        'field_name' => 'assistance_others_text',
                        'value' => $validated['assistance_others_text']
                    ];
                }
            }

            // Add Other Concerns text fields
            if (!empty($validated['other_concerns_mwpd_text'])) {
                $sectionCFields[] = [
                    'field_name' => 'other_concerns_mwpd_text',
                    'value' => $validated['other_concerns_mwpd_text']
                ];
            }

            if (!empty($validated['other_concerns_wrsd_text'])) {
                $sectionCFields[] = [
                    'field_name' => 'other_concerns_wrsd_text',
                    'value' => $validated['other_concerns_wrsd_text']
                ];
            }

            if (!empty($validated['other_concerns_mwpd_protection_text'])) {
                $sectionCFields[] = [
                    'field_name' => 'other_concerns_mwpd_protection_text',
                    'value' => $validated['other_concerns_mwpd_protection_text']
                ];
            }

            // Store form entries with proper field IDs
            foreach ($sectionCFields as $field) {
                // Find the Request_Form_Field matching the field_name
                $formField = Request_Form_Field::where('request_form_id', $requestForm->id)
                    ->where('field_name', $field['field_name'])
                    ->first();

                if ($formField) {
                    // Create Request_Form_Entries record - store the field ID in value column
                    $formEntry = Request_Form_Entries::create([
                        'request_id' => $newRequest->id,
                        'request_form_field_id' => $formField->id,
                        'value' => $formField->id  // Store field ID instead of value
                    ]);
                    Log::info('Request_Form_Entries created - Field ID: ' . $formField->id . ', Field Name: ' . $field['field_name']);

                    // Create Request_Form_Field_Values record - store the actual value
                    Request_Form_Field_Values::create([
                        'request_form_entry_id' => $formEntry->id,
                        'request_form_field_id' => $formField->id,
                        'value' => $field['value']  // Store actual submitted value here
                    ]);
                    Log::info('Request_Form_Field_Values created - Entry ID: ' . $formEntry->id . ', Actual Value: ' . $field['value']);
                } else {
                    Log::warning('Request_Form_Field not found for field_name: ' . $field['field_name']);
                }
            }

            DB::commit();
            Log::info('Database transaction committed successfully');

            return redirect()->route('forms.general')->with('success', 'Form submitted successfully! Your Request ID is: ' . $newRequest->id);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Form submission error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Error submitting form: ' . $e->getMessage())->withInput();
        }
    }
}
