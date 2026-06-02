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
use App\Models\BankAccountDetails;
use App\Models\Request_Status_History;
use App\Models\Startup_Equipment_Products;
use App\Models\Ofw_Training_Record;
use App\Models\Requirements;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
Use App\Mail\SubmittedFormsSuccessfully;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

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

    public function RFAForm(){
        return view('forms.rfa');
    }


    public function storeRFAForm(Request $request)
    {
        $assistance = $request->input('uri_ng_tulong', []);
        $steps = ['rfa'];

        if (in_array('LEGAL ASSISTANCE', $assistance)) {
            $steps[] = 'sena';
        }
        if (
            in_array('MEDICAL ASSISTANCE', $assistance) ||
            in_array('TEMPORARY SHELTER', $assistance) ||
            in_array('TRANSPORTATION ASSISTANCE', $assistance)
        ) {
            $steps[] = 'aksyon';
        }
        if (in_array('WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES', $assistance)){
            $steps[] = 'elpor';
            $steps[] = 'ofw_statement';
            $steps[] = 'elporb1';
            $steps[] = 'business_canvas';
            $steps[] = 'commitment';
            $steps[] = 'kasulatan';
        }

        $steps[] = 'requirements';
        $steps = array_values(array_unique($steps));

        // ── Prune stale session data for steps that were removed ──────────────
        $previousSteps = session('forms.steps', []);
        $removedSteps  = array_diff($previousSteps, $steps);

        foreach ($removedSteps as $removed) {
            session()->forget("forms.data.$removed");
        }
        // ─────────────────────────────────────────────────────────────────────

        session([
            'forms.steps'      => $steps,
            'forms.data.rfa'   => $request->except('_token'),
        ]);
        return redirect()->route('forms.step', ['step' => $steps[1]]);
    }

    public function showStep($step)
    {
        $steps = session('forms.steps', []);

        if (!in_array($step, $steps)) {

            return redirect()
                ->route('forms.index')
                ->with('error', 'Session expired.');
        }

        $views = [
            'rfa' => 'forms.rfa',
            'sena' => 'forms.sena',
            'aksyon' => 'forms.aksyon',
            'elpor' => 'forms.elpor',
            'ofw_statement' => 'forms.ofw_statement',
            'elporb1' => 'forms.elporb1',
            'business_canvas' => 'forms.business_canvas',
            'commitment' => 'forms.commitment',
            'requirements' => 'forms.requirements',
            'kasulatan' => 'forms.kasulatan'
        ];

        $formData = session("forms.data.$step", []);

        $currentIndex = array_search($step, $steps);

        return view($views[$step], [
            'step' => $step,
            'steps' => $steps,
            'currentStep' => $currentIndex + 1,
            'totalSteps' => count($steps),
            'formData' => $formData,
        ]);
    }

    public function storeStep(Request $request, $step)
    {
        $steps = session('forms.steps', []);

        if (!in_array($step, $steps)) {
            return redirect()
                ->route('forms.index')
                ->with('error', 'Session expired.');
        }

        session(["forms.data.$step" => $request->except('_token')]);
        
        $currentIndex = array_search($step, $steps);
        $action       = $request->input('action');

        if ($action === 'back') {
            $prevIndex = $currentIndex - 1;

            if (isset($steps[$prevIndex])) {
                return redirect()->route('forms.step', ['step' => $steps[$prevIndex]]);
            }

            // Going back to the selection page — clear everything so
            // storeRFAForm gets a clean slate for pruning
            session()->forget('forms.data');
            session()->forget('forms.steps');

            return redirect()->route('forms.index');
        }

        if ($action === 'submit') {
            return redirect()->route('forms.submit.all');
        }

        $nextIndex = $currentIndex + 1;

        if (isset($steps[$nextIndex])) {
            return redirect()->route('forms.step', ['step' => $steps[$nextIndex]]);
        }

        return redirect()->route('forms.submit.all');
    }




    public function processingForm(Request $request){

    }

    public function ofw_info_sheet_mwpd_protection(){

    }
    public function generalFormSubmitted(){
        return view('forms-submitted.general');
    }

    


   
    public function aksyonForm(Request $request)
    {
        return view('forms.aksyon');
    }

    public function senaForm(Request $request){
        return view('forms.sena');
    }

    public function elporForm(){
        return view('forms.elpor');
    }

    public function ofwStatementForm(){
        return view('forms.ofw_statement');
    }
    public function elporFormB1(){
        return view('forms.elporb1');
    }

    public function businessCanvas(){
        return view('forms.business_canvas');
    }


    public function commitment(){
        return view('forms.commitment');
    }

    public function kasulatan(){
        return view('forms.kasulatan');
    }
    

    

    public function requirements(Request $request)
    {
        return view('forms.requirements');
    }

    public function submitAllForms(Request $request)
    {
        // ── FIXED: was 'forms.rfa', data is stored under 'forms.data.*' ──────
        $rfaData        = session('forms.data.rfa', []);
        $aksyonData     = session('forms.data.aksyon', []);
        $senaData       = session('forms.data.sena', []);
        $elporData      = session('forms.data.elpor', []);
        $ofwStatementData   = session('forms.data.ofw_statement', []);
        $elporb1Data    = session('forms.data.elporb1', []);
        $businessCanvasData = session('forms.data.business_canvas', []);
        $processingData = session('forms.data.processing', []);
        // ─────────────────────────────────────────────────────────────────────

        try {
            DB::beginTransaction();
            if (!empty($rfaData)) {

                $requestNumber = Request_Number::create([
                    'status'            => 'NEW_SUBMISSION',
                    'uri_ng_tulong'     => isset($rfaData['uri_ng_tulong']) 
                            ? json_encode($rfaData['uri_ng_tulong']) 
                            : null,
                    'maikling_salaysay' => $rfaData['maikling_salaysay'] ?? null,
                ]);

                $requestOfwId = Request_OFW::create([
                    'request_id'         => $requestNumber->id,
                    'ofw_lname'          => $rfaData['ofw_lname'] ?? null,
                    'ofw_fname'          => $rfaData['ofw_fname'] ?? null,
                    'ofw_ename'          => $rfaData['ofw_ename'] ?? null,
                    'ofw_mname'          => $rfaData['ofw_mname'] ?? null,
                    'ofw_bday'           => $rfaData['ofw_bday'] ?? null,
                    'ofw_gender'         => $rfaData['ofw_gender'] ?? null,
                    'ofw_civil_status'   => $rfaData['ofw_civil_status'] ?? null,
                    'ofw_phone'          => $rfaData['ofw_phone'] ?? null,
                    'ofw_email'          => $rfaData['ofw_email'] ?? null,
                    'ofw_fb_acc'         => $rfaData['ofw_fb_acc'] ?? null,
                    'ofw_passport_no'    => $rfaData['ofw_passport_no'] ?? null,
                    'ofw_address_abroad' => $rfaData['ofw_address_abroad'] ?? null,
                ]);

                Request_Ofw_Address::create([
                    'request_id'   => $requestNumber->id,
                    'request_ofw_id' => $requestOfwId->id,
                    'house_no'     => $rfaData['ofw_house_no'] ?? null,
                    'province'     => $rfaData['ofw_province_name'] ?? null,
                    'municipality' => $rfaData['ofw_municipality_name'] ?? null,
                    'brgy'         => $rfaData['ofw_barangay_name'] ?? null,
                    'zip_code'     => $rfaData['ofw_zip_code'] ?? null,
                ]);

                if (
                    !empty($rfaData['party_lname'])        ||
                    !empty($rfaData['party_fname'])        ||
                    !empty($rfaData['party_email'])        ||
                    !empty($rfaData['party_phone'])        ||
                    !empty($rfaData['party_bday'])         ||
                    !empty($rfaData['party_relationship'])
                ) {
                    $requestPartyId =Request_Party::create([
                        'request_id'       => $requestNumber->id,
                        'party_lname'      => $rfaData['party_lname'] ?? null,
                        'party_fname'      => $rfaData['party_fname'] ?? null,
                        'party_ename'      => $rfaData['party_ename'] ?? null,
                        'party_mname'      => $rfaData['party_mname'] ?? null,
                        'party_bday'       => $rfaData['party_bday'] ?? null,
                        'party_relationship' => $rfaData['party_relationship'] ?? null,
                        'party_relationship_other' => $rfaData['party_relationship_other'] ?? null,
                        'party_valid_id'   => $rfaData['party_valid_id'] ?? null,
                        'party_email'      => $rfaData['party_email'] ?? null,
                        'party_phone'      => $rfaData['party_phone'] ?? null,
                        'party_fb_acc' => $rfaData['party_fb_acc'] ?? null,
                    ]);

                    Request_Party_Address::create([
                        'request_id'   => $requestNumber->id,
                        'request_party_id' => $requestPartyId->id,
                        'house_no'     => $rfaData['party_house_no'] ?? null,
                        'province'     => $rfaData['party_province_name'] ?? null,
                        'municipality' => $rfaData['party_municipality_name'] ?? null,
                        'brgy'         => $rfaData['party_barangay_name'] ?? null,
                        'zip_code'     => $rfaData['party_zip_code'] ?? null,
                    ]);
                }

                Request_Form_Entries::create([
                    'request_id'      => $requestNumber->id,
                    'request_form_id' => 100,
                ]);

                if (
                    !empty($rfaData['bank_name'])    ||
                    !empty($rfaData['bank_branch'])  ||
                    !empty($rfaData['bank_acc_num'])  ||
                    !empty($rfaData['bank_acc_name'])
                ) {
                    BankAccountDetails::create([
                        'request_id'   => $requestNumber->id,
                        'bank_name'    => $rfaData['bank_name'] ?? null,
                        'bank_branch'  => $rfaData['bank_branch'] ?? null,
                        'bank_acc_num' => $rfaData['bank_acc_num'] ?? null,
                        'bank_acc_name'=> $rfaData['bank_acc_name'] ?? null,
                    ]);
                }

                // ── AKSYON ───────────────────────────────────────────────────────
                if (!empty($aksyonData)) {

                    $aksyonFields = Request_Form_Field::where('request_form_id', 101)
                                        ->pluck('id', 'field_name');

                    $aksyonEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 101,
                    ]);

                    $aksyonMap = [
                        'aksyon_ofw_age'                    => $aksyonData['aksyon_ofw_age']                    ?? null,
                        'aksyon_latest_date_departure_ph'   => $aksyonData['aksyon_latest_departure_ph']        ?? null,
                        'aksyon_latest_date_return_ph'      => $aksyonData['aksyon_latest_return_ph']           ?? null,
                        'aksyon_jobsite'                    => $aksyonData['aksyon_jobsite']                    ?? null,
                        'aksyon_job_position'               => $aksyonData['aksyon_job_position']               ?? null,
                        'aksyon_return_reason'              => $aksyonData['aksyon_return_reason']              ?? null,
                        'aksyon_return_reason_others_specify' => $aksyonData['aksyon_return_reason_others_specify'] ?? null,
                        'aksyon_hanapbuhay_program'         => $aksyonData['aksyon_hanapbuhay_program']         ?? null,
                        'aksyon_nrco_livehood_program'      => $aksyonData['aksyon_nrco_livehood_program']      ?? null,
                        'aksyon_fund'                       => $aksyonData['aksyon_fund']                       ?? null,
                    ];

                    $aksyonValues = [];
                    foreach ($aksyonMap as $fieldName => $value) {
                        if (!isset($aksyonFields[$fieldName])) continue;
                        if (is_null($value)) continue; // ── Skip null values entirely ──
                        $aksyonValues[] = [
                            'request_form_entry_id'         => $aksyonEntry->id,
                            'request_form_field_id' => $aksyonFields[$fieldName],
                            'value'                 => $value,
                            'created_at'            => now(),
                            'updated_at'            => now(),
                        ];
                    }

                    Request_Form_Field_Values::insert($aksyonValues);
                }

                // ── SENA ─────────────────────────────────────────────────────────
                if (!empty($senaData)) {

                    $senaFields = Request_Form_Field::where('request_form_id', 102)
                                    ->pluck('id', 'field_name');

                    $senaEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 102,
                    ]);

                    $senaMap = [
                        'sena_deployment_status'                 => $senaData['ofw_deployment_status']                  ?? null,
                        'sena_ofw_age'                           => $senaData['sena_ofw_age']                           ?? null,
                        'sena_nature_of_work'                    => $senaData['sena_nature_of_work']                    ?? null,
                        'sena_nature_of_work_other_specify'      => $senaData['other_professional_specify']             ?? null,
                        'sena_jobsite'                           => $senaData['sena_country_name']                      ?? null,
                        'sena_job_position'                      => $senaData['sena_job_position']                      ?? null,
                        'sena_monthly_salary'                    => $senaData['sena_monthly_salary']                    ?? null,
                        'sena_contract_start'                    => $senaData['sena_contract_start']                    ?? null,
                        'sena_contract_end'                      => $senaData['sena_contract_end']                      ?? null,
                        'sena_length_contract_served'            => $senaData['sena_length_contract_served']            ?? null,
                        'sena_action_taken_employer_level'       => $senaData['sena_action_taken_employer_level']       ?? null,
                        'sena_action_taken_mwo'                  => $senaData['sena_action_taken_mwo']                  ?? null,
                        'sena_ph_agency_name'                    => $senaData['sena_ph_agency_name']                    ?? null,
                        'sena_ph_agency_address'                 => $senaData['sena_ph_agency_address']                 ?? null,
                        'sena_ph_contact_person_name'            => $senaData['sena_ph_contact_person_name']            ?? null,
                        'sena_ph_contact_person_position'        => $senaData['sena_ph_contact_person_position']        ?? null,
                        'sena_ph_contact_info'                   => $senaData['sena_ph_contact_info']                   ?? null,
                        'sena_foreign_agency_name_employer_name' => $senaData['sena_foreign_agency_name_employer_name'] ?? null,
                        'sena_foreign_agency_address'            => $senaData['sena_foreign_agency_address']            ?? null,
                        'sena_foreign_contact_person_name'       => $senaData['sena_foreign_contact_person_name']       ?? null,
                        'sena_foreign_contact_person_position'   => $senaData['sena_foreign_contact_person_position']   ?? null,
                        'sena_foreign_contact_info'              => $senaData['sena_foreign_contact_info']              ?? null,
                        'sena_nature_of_business'                => $senaData['sena_nature_of_business']                ?? null,
                        'sena_complaints_other_office_date'      => $senaData['sena_complaints_other_office_date']      ?? null,
                        'sena_complaints_other_office_name'      => $senaData['sena_complaints_other_office_name']      ?? null,
                        'sena_complaints_other_office_case'      => $senaData['sena_complaints_other_office_case']      ?? null,
                    ];

                    $senaValues = [];
                    foreach ($senaMap as $fieldName => $value) {
                        if (!isset($senaFields[$fieldName])) continue;
                        if (is_null($value)) continue; // ── Skip null values entirely ──
                        $senaValues[] = [
                            'request_form_entry_id'         => $senaEntry->id,
                            'request_form_field_id' => $senaFields[$fieldName],
                            'value'                 => $value,
                            'created_at'            => now(),
                            'updated_at'            => now(),
                        ];
                    }

                    Request_Form_Field_Values::insert($senaValues);
                }

                if (!empty($elporData) && !empty($ofwStatementData) && !empty($elporb1Data) && !empty($businessCanvasData)){
                    $elporFields          = Request_Form_Field::where('request_form_id', 103)->pluck('id', 'field_name');
                    $ofwStatementFields   = Request_Form_Field::where('request_form_id', 104)->pluck('id', 'field_name');
                    //$elporb1Fields        = Request_Form_Field::where('request_form_id', 105)->pluck('id', 'field_name');
                    $businessCanvasFields = Request_Form_Field::where('request_form_id', 106)->pluck('id', 'field_name');

                    $elporEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 103,
                    ]);

                    

                    $ofwStatementEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 104,
                    ]);

                    $elporb1Entry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 105,
                    ]);

                    $businessCanvasEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 106,
                    ]);

                    $commitmentEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 107,
                    ]);

                    $kasulatanEntry = Request_Form_Entries::create([
                        'request_id'      => $requestNumber->id,
                        'request_form_id' => 108,
                    ]);


                    $elporMap = [
                        'elpor_ofw_age'                  => $elporData['elpor_ofw_age']                   ?? null,
                        'elpor_ofw_other_data'           => $elporData['elpor_ofw_other_data']            ?? null,
                        'elpor_phone_secondary'          => $elporData['elpor_phone_secondary']           ?? null,
                        'elpor_jobsite'                  => $elporData['elpor_jobsite_name']              ?? null,
                        'elpor_job_position'             => $elporData['elpor_job_position']              ?? null,
                        'elpor_latest_date_departure_ph' => $elporData['elpor_latest_date_departure_ph']  ?? null,
                        'elpor_latest_date_return_ph'    => $elporData['elpor_latest_date_return_ph']     ?? null,
                        'elpor_contract_start'           => $elporData['elpor_contract_start']            ?? null,
                        'elpor_contract_end'             => $elporData['elpor_contract_end']              ?? null,
                        'elpor_business_type'            => $elporData['elpor_business_type']             ?? null,
                        'elpor_business_site'            => $elporData['elpor_business_site']             ?? null,
                        'elpor_existing_business'        => $elporData['elpor_existing_business']         ?? null,
                        'elpor_existing_business_specify'=> $elporData['elpor_existing_business_specify'] ?? null,
                        
                        
                    ];

                    $ofwStatementMap = [
                        'elpor_return_reason'             => $ofwStatementData['elpor_return_reason']         ?? null,
                        'elpor_return_reason_details'     => $ofwStatementData['elpor_return_reason_details'] ?? null,
                    ];

                    $businessCanvasMap = [
                        'elpor_bc_idea'        => $businessCanvasData['elpor_bc_idea']        ?? null,
                        'elpor_bc_customer'    => $businessCanvasData['elpor_bc_customer']    ?? null,
                        'elpor_bc_place'       => $businessCanvasData['elpor_bc_place']       ?? null,
                        'elpor_bc_promotions'  => $businessCanvasData['elpor_bc_promotions']  ?? null,
                        'elpor_bc_price'       => $businessCanvasData['elpor_bc_price']       ?? null,
                        'elpor_bc_process'     => $businessCanvasData['elpor_bc_process']     ?? null,
                        'elpor_bc_resources'   => $businessCanvasData['elpor_bc_resources']   ?? null,
                        'elpor_bc_partners'    => $businessCanvasData['elpor_bc_partners']    ?? null,
                        'elpor_bc_cost'        => $businessCanvasData['elpor_bc_cost']        ?? null,
                        'elpor_bc_investment'  => $businessCanvasData['elpor_bc_investment']  ?? null,
                        'elpor_bc_budget'      => $businessCanvasData['elpor_bc_budget']      ?? null,
                        'elpor_bc_profit'      => $businessCanvasData['elpor_bc_profit']      ?? null,
                    ];

                    $elporValues = [];
                    foreach ($elporMap as $fieldName => $value) {
                        if (!isset($elporFields[$fieldName])) continue;
                        if (is_null($value)) continue; // ── Skip null values entirely ──
                        $elporValues[] = [
                            'request_form_entry_id' => $elporEntry->id,
                            'request_form_field_id' => $elporFields[$fieldName],
                            'value'                 => $value,
                            'created_at'            => now(),
                            'updated_at'            => now(),
                        ];
                    }

                    Request_Form_Field_Values::insert($elporValues);

                    $ofwStatementValues = [];
                    foreach ($ofwStatementMap as $fieldName => $value) {
                        if (!isset($ofwStatementFields[$fieldName])) continue;
                        if (is_null($value)) continue; // ── Skip null values entirely ──
                        $ofwStatementValues[] = [
                            'request_form_entry_id'         => $ofwStatementEntry->id,
                            'request_form_field_id' => $ofwStatementFields[$fieldName],
                            'value'                 => $value,
                            'created_at'            => now(),
                            'updated_at'            => now(),
                        ];
                    }

                    Request_Form_Field_Values::insert($ofwStatementValues);

                    $businessCanvasValues = [];
                    foreach ($businessCanvasMap as $fieldName => $value) {
                        if (!isset($businessCanvasFields[$fieldName])) continue;
                        if (is_null($value)) continue;
                        $businessCanvasValues[] = [
                            'request_form_entry_id' => $businessCanvasEntry->id,
                            'request_form_field_id' => $businessCanvasFields[$fieldName],
                            'value'                 => $value,
                            'created_at'            => now(),
                            'updated_at'            => now(),
                        ];
                    }
                    Request_Form_Field_Values::insert($businessCanvasValues);

                    $elporb1Items = $elporb1Data['items'] ?? [];

                    if (!empty($elporb1Items)) {

                        $elporb1Rows = [];
                        $now = now();

                        foreach ($elporb1Items as $item) {
                            $elporb1Rows[] = [
                                'request_id'    => $requestNumber->id,
                                'item_category' => $item['category']      ?? null,
                                'supplier_name' => $item['supplier_name'] ?? null,
                                'item_name'     => $item['item_name']     ?? null,
                                'item_price'    => $item['item_price']    ?? 0,
                                'item_qty'      => $item['item_qty']      ?? 0,
                                'item_total'    => $item['item_total']    ?? 0,
                                'created_at'    => $now,
                                'updated_at'    => $now,
                            ];
                        }

                        Startup_Equipment_Products::insert($elporb1Rows);
                    }

                    // ── OFW Training Records ─────────────────────────────────────────
                    $trainingKinds    = $elporData['training_kind']      ?? [];
                    $trainingVenues   = $elporData['training_venue']     ?? [];
                    $trainingIssuedBy = $elporData['training_issued_by'] ?? [];
                    $trainingDates    = $elporData['training_date']      ?? [];

                    if (!empty($trainingKinds)) {
                        $trainingRows = [];
                        $now = now();

                        foreach ($trainingKinds as $index => $kind) {
                            $trainingRows[] = [
                                'request_id'    => $requestNumber->id,
                                'training_name' => $kind,
                                'venue'         => $trainingVenues[$index]   ?? null,
                                'issued_by'     => $trainingIssuedBy[$index] ?? null,
                                'training_date' => $trainingDates[$index]    ?? null,
                                'created_at'    => $now,
                                'updated_at'    => $now,
                            ];
                        }

                        Ofw_Training_Record::insert($trainingRows);
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

                Request_Status_History::create([
                    'request_id'      => $requestNumber->id,
                    'status' => 'NEW_SUBMISSION'
                ]);

                $to = $rfaData['ofw_email'] ?? null;
                $ofw_full_name = trim(($rfaData['ofw_fname'] ?? '') . ' ' . ($rfaData['ofw_mname'] ?? '') . ' ' . ($rfaData['ofw_lname'] ?? ''));
                $partyEmail = $rfaData['party_email'] ?? null;
                $party_full_name = trim(($rfaData['party_fname'] ?? '') . ' ' . ($rfaData['party_mname'] ?? '') . ' ' . ($rfaData['party_lname'] ?? ''));
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
                        Mail::to($recipient['email'])->send(new SubmittedFormsSuccessfully($requestNumber->id, $recipient['name'], $dateSubmitted));
                    }
                } else {
                    // Send email to OFW only
                    Mail::to($to)->send(new SubmittedFormsSuccessfully($requestNumber->id, $ofw_full_name, $dateSubmitted));
                }

            }
            DB::commit();

        } catch (\Exception $e) {
            Log::error('Error saving form data: ' . $e->getMessage());
            dd($e->getMessage());
            DB::rollBack();
            return redirect()->route('forms.index')->with('error', 'An error occurred while saving your request. Please try again.');
        }

        // ── FIXED: clear using the correct session keys ───────────────────────
        session()->forget('forms');

        return redirect()->route('forms.success');
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

