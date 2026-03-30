<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProcessingRequest;

class FormController extends Controller
{
    public function index()
    {
        return view('forms.index');
    }

    public function generalForm(){
        return view('forms.general');
    }

    public function senaForm(){
        return view('forms.sena');
    }

    public function processingForm(){
        return view('forms.processing');
    }

    public function storeProcessing(Request $request){
        $data = $request->validate([
            'ofw_family_name' => 'nullable|string|max:255',
            'ofw_first_name' => 'nullable|string|max:255',
            'ofw_middle_name' => 'nullable|string|max:255',
            'jobsite' => 'nullable|string|max:255',
            'record_year' => 'nullable|string|max:20',
            'purpose' => 'nullable|string|max:255',
            'agency_name' => 'nullable|string|max:255',
            'req_family_name' => 'nullable|string|max:255',
            'req_first_name' => 'nullable|string|max:255',
            'req_middle_name' => 'nullable|string|max:255',
            'relationship_ofw' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'phil_address' => 'nullable|string|max:1024',
            'province' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'telephone_number' => 'nullable|string|max:50',
            'email_address' => 'nullable|email|max:255',
        ]);

        \App\Models\ProcessingRequest::create($data);

        return redirect()->route('forms.processing')->with('success', 'Your request has been submitted successfully.');
    }

    public function storeSena(Request $request)
    {
        $data = $request->validate([
            'last_name' => 'nullable|string|max:255',
            'first_name' => 'nullable|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'name_ext' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'zip_code' => 'nullable|string|max:20',
            'contact_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:1024',
            'deployment_status' => 'nullable|string|in:deployed,not_deployed',
            'gender' => 'nullable|string|in:Male,Female',
            'age' => 'nullable|integer|min:0|max:130',
            'nature_of_work' => 'nullable|array',
            'nature_of_work.*' => 'string|max:255',
            'nature_of_work_others' => 'nullable|string|max:255',
            'jobsite_country' => 'nullable|string|max:255',
            'contract_start' => 'nullable|date',
            'contract_end' => 'nullable|date',
            'contract_length' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'monthly_salary' => 'nullable|string|max:255',
            'action_employer' => 'nullable|string|max:1024',
            'action_mwo' => 'nullable|string|max:1024',
            'agency_name_ph' => 'nullable|string|max:255',
            'agency_address' => 'nullable|string|max:1024',
            'agency_province' => 'nullable|string|max:100',
            'agency_municipality' => 'nullable|string|max:100',
            'agency_barangay' => 'nullable|string|max:100',
            'agency_zip_code' => 'nullable|string|max:20',
            'agency_contact_person' => 'nullable|string|max:255',
            'agency_contact_number' => 'nullable|string|max:50',
            'agency_email' => 'nullable|email|max:255',
            'agency_facebook' => 'nullable|string|max:255',
            'agency_position' => 'nullable|string|max:255',
            'agency_business_nature' => 'nullable|string|max:255',
            'complaint_date' => 'nullable|date',
            'complaint_office' => 'nullable|string|max:255',
            'complaint_nature' => 'nullable|string|max:255',
            'contract_violations' => 'nullable|array',
            'contract_violations.*' => 'string|max:255',
            'contract_violations_others' => 'nullable|string|max:255',
            'other_money_claims' => 'nullable|array',
            'other_money_claims.*' => 'string|max:255',
            'delayed_payment' => 'nullable|string|max:1024',
            'non_monetary_issues' => 'nullable|array',
            'non_monetary_issues.*' => 'string|max:255',
            'other_issues' => 'nullable|string|max:1024',
        ]);

        // Map to a storage model. Use ProcessingRequest as basic temporary storage for now.
        ProcessingRequest::create([
            'req_family_name' => $data['last_name'] ?? null,
            'req_first_name' => $data['first_name'] ?? null,
            'req_middle_name' => $data['middle_name'] ?? null,
            'relationship_ofw' => $data['name_ext'] ?? null,
            'jobsite' => $data['jobsite_country'] ?? null,
            'contact_number' => $data['contact_number'] ?? null,
            'phil_address' => $data['address'] ?? null,
            'province' => $data['province'] ?? null,
            'municipality' => $data['municipality'] ?? null,
            'barangay' => $data['barangay'] ?? null,
            'zipcode' => $data['zip_code'] ?? null,
            'email_address' => $data['email'] ?? null,
        ]);

        return redirect()->route('forms.sena')->with('success', 'Your SENA request has been submitted successfully.');
    }

    public function aksyonForm()
    {
        return view('forms.aksyon');
    }

    public function storeAksyon(Request $request)
    {
        $data = $request->validate([
            'agency_name' => 'nullable|string|max:255',
            'agency_address' => 'nullable|string|max:1024',
            'province' => 'nullable|string|max:100',
            'municipality' => 'nullable|string|max:100',
            'barangay' => 'nullable|string|max:100',
            'zipcode' => 'nullable|string|max:20',
            'contact_person' => 'nullable|string|max:255',
            'contact_number' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'facebook' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
            'nature_of_business' => 'nullable|string|max:255',
            'complaint_date' => 'nullable|date',
            'complaint_office' => 'nullable|string|max:255',
            'complaint_nature' => 'nullable|string|max:255',
        ]);

        // Optional: store or use processing model for now
        ProcessingRequest::create([
            'agency_name' => $data['agency_name'] ?? null,
            'phil_address' => $data['agency_address'] ?? null,
            'province' => $data['province'] ?? null,
            'municipality' => $data['municipality'] ?? null,
            'barangay' => $data['barangay'] ?? null,
            'zipcode' => $data['zipcode'] ?? null,
            'contact_number' => $data['contact_number'] ?? null,
            'email_address' => $data['email'] ?? null,
        ]);

        return redirect()->route('forms.aksyon')->with('success', 'Your aksyon data has been submitted successfully.');
    }
}

