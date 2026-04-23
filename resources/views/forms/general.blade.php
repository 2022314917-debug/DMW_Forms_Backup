@extends('layouts.app')
@section('content')


  <style>
    body {
      background-color: #f4f4f4;
      font-family: 'Assistant', Arial, sans-serif;
    }

    .form-header {
      background-color: #e2e2e2;
      padding: 1rem;
      border-radius: 0.25rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
    }

    .form-section {
      background-color: #d9e4f5;
      padding: 1rem;
      border-radius: 0.25rem;
      margin-bottom: 1rem;
      border: 1px solid #b0c4de;
    }

    .form-section h5 {
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .form-control::placeholder {
      font-size: 0.85rem;
    }

    .form-label {
      font-weight: 500;
    }

   
 
  </style>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
 
  <div class="container my-5">
    <form action="{{ route('forms.general.store') }}" method="POST">
      @csrf
      <!-- Header -->
      <div class="form-header text-center">
        <h4 class="fw-bold">ONLINE REQUEST FOR ASSISTANCE</h4>
        <p>
          Gamitin ang form na ito para humingi ng tulong. Siguraduhing tama at kumpleto ang lahat ng impormasyon ilalagay upang maproseso agad ng aming team ang inyong request.
        </p>
        <small>
          Regional Office Contact Details: (045) 963-4394 | (045) 455-0832 | pampanga@dmw.gov.ph | www.ro3.dmw.gov.ph
        </small>
      </div>

      <!-- Display Success Message -->
      @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Display Error Messages -->
      @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Please fix the following errors:</strong>
          <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Section A -->
      <div class="form-section">
        <h5>A. IMPORMASYON NG HUMIHILING (Request Party)</h5>

          <div class="row g-3 mb-3">
            <div class="col-md-3">
              <label class="form-label">Last Name</label>
              <!-- <input type="text" class="form-control uppercase" name="party_lname" placeholder="Dela Cruz" value="{{ old('party_lname') }}" required> -->
              <input type="text" class="form-control uppercase" name="party_lname" placeholder="Dela Cruz" value="{{ session('general_form_data.party_lname') }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control uppercase" name="party_fname" placeholder="Juan" value="{{ session('general_form_data.party_fname') }}">
            </div>
            <div class="col-md-2">
              <label class="form-label">Name Ext.</label>
              <input type="text" class="form-control uppercase" name="party_ename" placeholder="Jr/Sr/III" value="{{ session('general_form_data.party_ename') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control uppercase" name="party_mname" placeholder="Santos" value="{{ session('general_form_data.party_mname') }}">
            </div>
          </div>

          <div class="row g-3 mb-3">

            <div class="col-6 col-md-3">
              <label class="form-label">Birthday</label>
              <input type="date" class="form-control" name="party_bday" value="{{ session('general_form_data.party_bday') }}">
            </div>

            <div class="col-6 col-md-3">
              <label class="form-label">Sex</label>
              <select class="form-select" name="party_gender">
                <option selected disabled>Select</option>
                <option value="Male" {{ session('general_form_data.party_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ session('general_form_data.party_gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Relationship to OFW</label>
              <input type="text" class="form-control uppercase" name="party_relationship" placeholder="ex. Brother" value="{{ session('general_form_data.party_relationship') }}">
            </div>

          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Contact Number</label>
              <input type="text" class="form-control" name="party_phone" placeholder="ex. 09123456768" value="{{ session('general_form_data.party_phone') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="party_email" placeholder="ex. sample@email.com" value="{{ session('general_form_data.party_email') }}">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Address in the Philippines</label>
            <input type="text" class="form-control mb-2 uppercase" name="party_address_street" placeholder="Unit/Room/House Number/Street name" value="{{ session('general_form_data.party_address_street') }}">
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <select class="form-select" name="party_province" id="party_province">
                  <option value="">Province</option>
                </select>
                <input type="hidden" name="party_province_name" id="party_province_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="party_municipality" id="party_municipality" disabled>
                  <option value="">City / Municipality</option>
                </select>
                <input type="hidden" name="party_municipality_name" id="party_municipality_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="party_barangay" id="party_barangay" disabled>
                  <option value="">Barangay</option>
                </select>
                <input type="hidden" name="party_barangay_name" id="party_barangay_name" value="{{ session('general_form_data.party_barangay_name') }}">
              </div>
              <div class="col-6 col-md-3">
                <input 
                    type="text" 
                    class="form-control" 
                    name="party_zip_code" 
                    placeholder="ex. 2016" 
                    value="{{ session('general_form_data.party_zip_code') }}" 
                    maxlength="4"          
                    pattern="\d{4}"         
                    inputmode="numeric"     
                    oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);" 
                    
                >
              </div>
            </div>
          </div>
      </div>

      <!-- Section B -->
      <div class="form-section">
        <h5>B. IMPORMASYON NG OFW (Kung Iba sa Humihiling)</h5>
          <div class="row g-3 mb-3">
            <div class="col-md-3">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control uppercase" name="ofw_lname" placeholder="Dela Cruz" value="{{ session('general_form_data.ofw_lname') }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control uppercase" name="ofw_fname" placeholder="Juan" value="{{ session('general_form_data.ofw_fname') }}">
            </div>
            <div class="col-md-2">
              <label class="form-label">Name Ext.</label>
              <input type="text" class="form-control uppercase" name="ofw_ename" placeholder="Jr/Sr/III" value="{{ session('general_form_data.ofw_ename') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control uppercase" name="ofw_mname" placeholder="Santos" value="{{ session('general_form_data.ofw_mname') }}">
            </div>
          </div>

          <div class="row g-3 mb-3">

            <div class="col-12 col-md-4">
              <label class="form-label">Passport No.</label>
              <input type="text" class="form-control uppercase" name="ofw_passport_no" placeholder="ex. 123456789" value="{{ session('general_form_data.ofw_passport_no') }}">
            </div>

            <div class="col-6 col-md-4">
              <label class="form-label">Sex</label>
              <select class="form-select" name="ofw_gender">
                <option selected disabled>Select</option>
                <option value="Male" {{ session('general_form_data.ofw_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ session('general_form_data.ofw_gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <div class="col-6 col-md-4">
                <label class="form-label">Civil Status</label>
                <select class="form-select" name="ofw_civil_status">
                    <option selected {{ session('general_form_data.ofw_civil_status') == 'Select' ? 'selected' : '' }} disabled>Select</option>
                    <option value="Single" {{ session('general_form_data.ofw_civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Married" {{ session('general_form_data.ofw_civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                    <option value="Widowed" {{ session('general_form_data.ofw_civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                </select>
            </div>

          </div>

          <div class="row g-3 mb-3">

            <div class="col-12 col-md-4">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="ofw_email" placeholder="ex. sample@email.com" value="{{ session('general_form_data.ofw_email') }}">
            </div>

            <div class="col-6 col-md-4">
              <label class="form-label">Contact Number</label>
              <input type="text" class="form-control" name="ofw_phone" placeholder="ex. 09123456768" value="{{ session('general_form_data.ofw_phone') }}">
            </div>
              
            <div class="col-6 col-md-4">
              <label class="form-label">Date of Birth</label>
              <input type="date" class="form-control" name="ofw_bday" value="{{ session('general_form_data.ofw_bday') }}">
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-12 col-md-3">
              <label class="form-label">Agency</label>
              <input type="text" class="form-control uppercase" name="ofw_agency" placeholder="ex. Agency Name" value="{{ session('general_form_data.ofw_agency') }}">
            </div>
            <div class="col-12 col-md-3">
              <label class="form-label">Employer</label>
              <input type="text" class="form-control uppercase" name="ofw_employer" placeholder="ex. Employer/Company Name" value="{{ session('general_form_data.ofw_employer') }}">
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">Bansa</label>
              <select class="form-select" name="ofw_country" id="ofw_country">
                <option selected disabled>Select</option>
              </select>
              <input type="hidden" name="ofw_country_name" id="ofw_country_name">
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">Trabaho</label>
              <input type="text" class="form-control uppercase" name="ofw_job" placeholder="ex. Driver" value="{{ session('general_form_data.ofw_job') }}">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Address in the Philippines</label>
            <input type="text" class="form-control mb-2 uppercase" name="ofw_address_street" placeholder="Unit/Room/House Number/Street name" value="{{ session('general_form_data.party_address_street') }}">
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <select class="form-select" name="ofw_province" id="ofw_province">
                  <option value="">Province</option>
                </select>
                <input type="hidden" name="ofw_province_name" id="ofw_province_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="ofw_municipality" id="ofw_municipality" disabled>
                  <option value="">City / Municipality</option>
                </select>
                <input type="hidden" name="ofw_municipality_name" id="ofw_municipality_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="ofw_barangay" id="ofw_barangay" disabled>
                  <option value="">Barangay</option>
                </select>
                <input type="hidden" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ session('general_form_data.ofw_barangay_name') }}">
              </div>
              <div class="col-6 col-md-3">
                <input 
                    type="text" 
                    class="form-control" 
                    name="ofw_zip_code" 
                    placeholder="ex. 2016" 
                    value="{{ session('general_form_data.ofw_zip_code') }}" 
                    maxlength="4"          
                    pattern="\d{4}"         
                    inputmode="numeric"     
                    oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);" 

                >
              </div>
            </div>
          </div>
      </div>

      <!-- Section C -->
      <div class="form-section form-section-c">
        <h5>C. URI NG TULONG (Nature Of Request)</h5>
        <p style="font-size: 0.9rem; margin-bottom: 1rem;">
          <strong>Halagi o Naturang ng Concern:</strong> Piliin ang lahat ng bagay na sumusunod halaki handi siguruduhin sa uring <em>Concern, Pakialam ng aming PAOs information na nakahintay sa Applicant sa lahat ng impormasyon Dept. Applicant sa nakahihintay tumutulong upang makabuo at dibhiyon pura at pa maiggi oras.</em>
        </p>
          <!-- MIGRANT WORKERS PROCESSING DIVISION -->
          <div style="border: 1px solid #b0c4de; border-radius: 0.25rem; padding: 0.75rem; margin-bottom: 1rem; background-color: #e8f1fb;">
            <h6 style="font-weight: bold; margin-bottom: 0.75rem; text-decoration: underline;">MIGRANT WORKERS PROCESSING DIVISION</h6>
            
            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="ofw_info_sheet_mwpd" name="mwpd[]" value="checked" {{ in_array('ofw_info_sheet_mwpd', session('general_form_data.mwpd', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="ofw_info_sheet_mwpd">OFW Records/OFW Information Sheet</label>
              </div>
            </div>

            <!-- <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="oec_processing" name="mwpd[]" value="oec_processing" disabled>
                <label class="form-check-label" for="oec_processing">Direct-Hire OEC processing concerns</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gov_to_gov" name="mwpd[]" value="gov_to_gov" onchange="toggleG2GCountries()" disabled>
                <label class="form-check-label" for="gov_to_gov">Submission of Government-to-Government application</label>
              </div>
              <div style="margin-left: 1.5rem; margin-top: 0.5rem;">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="g2g_country" id="taiwan" value="taiwan" onchange="toggleG2GOthers()" disabled>
                  <label class="form-check-label" for="taiwan">Taiwan</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="g2g_country" id="moh_ksa" value="moh_ksa" onchange="toggleG2GOthers()" disabled>
                  <label class="form-check-label" for="moh_ksa">MOH-KSA</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="g2g_country" id="japan" value="japan" onchange="toggleG2GOthers()" disabled>
                  <label class="form-check-label" for="japan">JPEPA-Japan</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="g2g_country" id="israel" value="israel" onchange="toggleG2GOthers()" disabled>
                  <label class="form-check-label" for="israel">Israel</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="g2g_country" id="germany" value="germany" onchange="toggleG2GOthers()" disabled>
                  <label class="form-check-label" for="germany">Germany</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="g2g_country" id="g2g_others" value="g2g_others" onchange="toggleG2GOthers()" disabled>
                  <label class="form-check-label" for="g2g_others">Others:</label>
                </div>
                <input type="text" id="g2g_others_text" class="form-control" name="g2g_others_text" style="margin-left: 1.5rem; margin-top: 0.25rem; width: calc(100% - 1.5rem);" placeholder="Specify others" readonly>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="other_concerns_mwpd" name="mwpd[]" value="other_concerns_mwpd" onchange="toggleTextbox('other_concerns_mwpd_text', this.checked)" disabled>
                <label class="form-check-label" for="other_concerns_mwpd">Other Concerns</label>
              </div>
              <input type="text" class="form-control" id="other_concerns_mwpd_text" name="other_concerns_mwpd_text" placeholder="Specify other concerns" style="margin-top: 0.25rem; padding-left: 1.5rem;" readonly>
            </div> -->
          </div>

          <!-- WELFARE AND REINTEGRATION SERVICES DIVISION -->
          <div style="border: 1px solid #b0c4de; border-radius: 0.25rem; padding: 0.75rem; margin-bottom: 1rem; background-color: #e8f1fb;">
            <h6 style="font-weight: bold; margin-bottom: 0.75rem; text-decoration: underline;">WELFARE AND REINTEGRATION SERVICES DIVISION</h6>
            
            <!-- <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="reint_serv" name="wrsd[]" value="reint_serv" onchange="toggleTextbox('reint_serv_text', this.checked)" disabled>
                <label class="form-check-label" for="reint_serv">Reintegration Services:</label>
              </div>
              <input type="text" id="reint_serv_text" name="reint_serv_text" class="form-control" placeholder="Specify services" style="width: calc(100% - 1.5rem); margin-left: 1.5rem; margin-top: 0.25rem; margin-bottom: 0.75rem;" readonly>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="spims" name="wrsd[]" value="spims" disabled>
                <label class="form-check-label" for="spims">Sa Pinas, Ikaw ang Ma'am at Sir (SPIMS)</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="assistance_nationals" name="wrsd[]" value="assistance_nationals" onchange="toggleAssistanceTypeRadios()" disabled>
                <label class="form-check-label" for="assistance_nationals">Assistance to Nationals:</label>
              </div>
              <div style="margin-left: 1.5rem; margin-top: 0.5rem;">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="assistance_type" id="shipment_remains" value="shipment_remains" onchange="toggleAssistanceOthers()" disabled>
                  <label class="form-check-label" for="shipment_remains">Request for shipment or remains / belongs</label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="assistance_type" id="assistance_other" value="assistance_other" onchange="toggleAssistanceOthers()" disabled>
                  <label class="form-check-label" for="assistance_other">Others:</label>
                </div>
                <input type="text" id="assistance_others_text" name="assistance_others_text" class="form-control" placeholder="Specify others" style="margin-left: 1.5rem; margin-top: 0.25rem; width: calc(100% - 1.5rem); margin-bottom: 0.75rem;" readonly>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="repatriation" name="wrsd[]" value="repatriation" disabled>
                <label class="form-check-label" for="repatriation">Repatriation</label>
              </div>
            </div> -->

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="aksyon" name="wrsd[]" value="checked" {{ in_array('aksyon', session('general_form_data.wrsd', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="aksyon">Financial Assistance through AKSYON fund</label>
              </div>
            </div>

            <!-- <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="other_concerns_wrsd" name="wrsd[]" value="others" onchange="toggleTextbox('other_concerns_wrsd_text', this.checked)" disabled>
                <label class="form-check-label" for="other_concerns_wrsd">Others</label>
              </div>
              <input type="text" class="form-control" id="other_concerns_wrsd_text" name="other_concerns_wrsd_text" placeholder="Specify other concerns" style="margin-top: 0.25rem; padding-left: 1.5rem;" readonly>
            </div> -->
          </div>

          <!-- MIGRANT WORKERS PROTECTION DIVISION -->
          <div style="border: 1px solid #b0c4de; border-radius: 0.25rem; padding: 0.75rem; margin-bottom: 1rem; background-color: #e8f1fb;">
            <h6 style="font-weight: bold; margin-bottom: 0.75rem; text-decoration: underline;">MIGRANT WORKERS PROTECTION DIVISION</h6>
            
            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="ofw_info_sheet_mwpd_protection" name="mwpd_protection[]" value="checked" {{ in_array('ofw_info_sheet_mwpd_protection', session('general_form_data.mwpd_protection', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="ofw_info_sheet_mwpd_protection">Request for OFW Information Sheet for legal purposes</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="sena" name="mwpd_protection[]" value="checked" {{ in_array('sena', session('general_form_data.mwpd_protection', [])) ? 'checked' : '' }}>
                <label class="form-check-label" for="sena">Request for Assistance for SEnA/Conciliation</label>
              </div>
            </div>

            <!-- <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="legal_assistance" name="mwpd_protection[]" value="legal_assistance" disabled>
                <label class="form-check-label" for="legal_assistance">Request for legal assistance/counseling</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="illegal_recruitment" name="mwpd_protection[]" value="illegal_recruitment" disabled>
                <label class="form-check-label" for="illegal_recruitment">Request for the issuance of Illegal Recruitment Certification</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="disc_action" name="mwpd_protection[]" value="disc_action" disabled>
                <label class="form-check-label" for="disc_action">Request for the issuance of Disciplinary Action Agains Employer / Work and/or Recruitment Violation</label>
              </div>
            </div>

            <div class="mb-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="other_concerns_mwpd_protection" name="mwpd_protection[]" value="others" onchange="toggleTextbox('other_concerns_mwpd_protection_text', this.checked)" disabled>
                <label class="form-check-label" for="other_concerns_mwpd_protection">Others</label>
              </div>
              <input type="text" class="form-control" id="other_concerns_mwpd_protection_text" name="other_concerns_mwpd_protection_text" placeholder="Specify other concerns" style="margin-top: 0.25rem; padding-left: 1.5rem;" readonly>
            </div>
          </div> -->


        
      </div>

      <div class="d-grid gap-2">
        <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Next</button>
      </div>
    </form>

    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #2F5BB7; color: white;">
            <h5 class="modal-title text-uppercase" id="validationModalLabel">REQUIRED FIELD MISSING!</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            Please select at least one concern under Nature of Request (Section C) to proceed.
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" 
                    style="background-color: #2F5BB7; border: none;">OK</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

  <script>

    document.querySelectorAll('.uppercase').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
    window.toggleTextbox = function(textboxId, isChecked) {
        const textbox = document.getElementById(textboxId);
        if (isChecked) {
        textbox.removeAttribute('readonly');
        textbox.focus();
        } else {
        textbox.setAttribute('readonly', 'readonly');
        textbox.value = '';
        }
    }

    window.toggleG2GOthers = function() {
        const radios = document.getElementsByName('g2g_country');
        const textbox = document.getElementById('g2g_others_text');
        let selected = false;
        for (let radio of radios) {
        if (radio.checked && radio.value === 'g2g_others') {
            selected = true;
            break;
        }
        }
        if (selected) {
        textbox.removeAttribute('readonly');
        } else {
        textbox.setAttribute('readonly', true);
        textbox.value = '';
        }
    }

    window.toggleG2GCountries = function() {
        const isChecked = document.getElementById('gov_to_gov').checked;
        const radios = document.getElementsByName('g2g_country');
        for (let radio of radios) {
        radio.disabled = !isChecked;
        if (!isChecked) {
            radio.checked = false;
        }
        }
        window.toggleG2GOthers();
    }

    window.toggleAssistanceOthers = function() {
        const radios = document.getElementsByName('assistance_type');
        const textbox = document.getElementById('assistance_others_text');
        let selected = false;
        for (let radio of radios) {
        if (radio.checked && radio.value === 'assistance_other') {
            selected = true;
            break;
        }
        }
        if (selected) {
        textbox.removeAttribute('readonly');
        } else {
        textbox.setAttribute('readonly', true);
        textbox.value = '';
        }
    }

    window.toggleAssistanceTypeRadios = function() {
        const isChecked = document.getElementById('assistance_nationals').checked;
        const radios = document.getElementsByName('assistance_type');
        for (let radio of radios) {
        radio.disabled = !isChecked;
        if (!isChecked) {
            radio.checked = false;
        }
        }
        window.toggleAssistanceOthers();
    }

    

    document.addEventListener('DOMContentLoaded', function() {
        const partyProvinceSelect = document.getElementById('party_province');
        const partyMunicipalitySelect = document.getElementById('party_municipality');
        const partyBarangaySelect = document.getElementById('party_barangay');

        const countrySelect = document.getElementById('ofw_country');

        const oldProvince = "{{ session('general_form_data.party_province') }}";
        const oldMunicipality = "{{ session('general_form_data.party_municipality') }}";
        const oldBarangay = "{{ session('general_form_data.party_barangay') }}";
        const oldCountry = "{{ session('general_form_data.ofw_country') }}";

        function resetSelect(selectEl, text) {
            selectEl.innerHTML = '';
            
            const option = document.createElement('option');
            option.value = '';
            option.textContent = text;
            option.selected = true;
            
            selectEl.appendChild(option);
            selectEl.disabled = true;
        }

      function populateSelect(selectEl, items, valueKey, labelKey) {
          const defaultText = selectEl === partyProvinceSelect
              ? 'Province'
              : selectEl === partyMunicipalitySelect
              ? 'City / Municipality'
              : selectEl === partyBarangaySelect
              ? 'Barangay'
              : 'Select';

          resetSelect(selectEl, defaultText);
          items.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueKey];
            option.textContent = item[labelKey];
            selectEl.appendChild(option);
          });
          selectEl.disabled = false;

          if(selectEl === partyProvinceSelect && oldProvince){
              selectEl.value = oldProvince;
              selectEl.dispatchEvent(new Event('change'));
          }

          if(selectEl === partyMunicipalitySelect && oldMunicipality){
              selectEl.value = oldMunicipality;
              selectEl.dispatchEvent(new Event('change'));
          }

          if(selectEl === partyBarangaySelect && oldBarangay){
              selectEl.value = oldBarangay;
          }

          // ===================== OFW AUTO RESTORE =====================
          if (selectEl === ofwProvinceSelect && oldOfwProvince) {
              selectEl.value = oldOfwProvince;
              selectEl.dispatchEvent(new Event('change'));
          }

          if (selectEl === ofwMunicipalitySelect && oldOfwMunicipality) {
              selectEl.value = oldOfwMunicipality;
              selectEl.dispatchEvent(new Event('change'));
          }

          if (selectEl === ofwBarangaySelect && oldOfwBarangay) {
              selectEl.value = oldOfwBarangay;
          }
          if(selectEl === countrySelect && oldCountry){
              selectEl.value = oldCountry;

              // also update hidden country name
              const countryName = selectEl.options[selectEl.selectedIndex]?.text || '';
              document.getElementById('ofw_country_name').value = countryName;
          }
      }

          resetSelect(partyProvinceSelect, 'Loading provinces...');
          resetSelect(partyMunicipalitySelect, 'City / Municipality');
          resetSelect(partyBarangaySelect, 'Barangay');
          resetSelect(countrySelect, 'Loading countries...');

          // Load country list from first.org (free, no payment, good CORS)
      //   console.log('Loading countries from first.org API...');
          fetch('https://api.first.org/data/v1/countries?limit=250')
          .then(response => {
              if (!response.ok) {
              throw new Error(`Country API status: ${response.status}`);
              }
              return response.json();
          })
          .then(data => {
              if (!data || !data.data) {
              throw new Error('No countries found');
              }

              const countries = Object.entries(data.data)
              .map(([code, value]) => {
                  let name = (value.country || '').trim();

                  // Normalize to remove parentheses/annotations and reduce to base country name
                  // Examples: "Congo (the Democratic Republic of the)" => "Congo"
                  //           "the Bahamas" => "Bahamas"
                  //           "(French Southern Territories)" => "French Southern Territories"
                  name = name.replace(/\s*\(.*?\)/g, '').trim();
                  name = name.replace(/^the\s+/i, '').trim();
                  name = name.replace(/\s{2,}/g, ' ').trim();

                  // If parentheses stripped to nothing, fallback to values from name fields
                  if (!name && value.name && typeof value.name === 'object') {
                  name = (value.name.common || value.name.official || '').trim();
                  }

                  return { code: code.toUpperCase(), name };
              })
              .filter(c => c.code && c.name)
              .reduce((acc, item) => {
                  // dedupe by normalized name
                  const found = acc.find(i => i.name.toLowerCase() === item.name.toLowerCase());
                  if (!found) acc.push(item);
                  return acc;
              }, [])
              .sort((a, b) => a.name.localeCompare(b.name, 'en', { sensitivity: 'base' }));

              if (!countries.length) {
              throw new Error('No selectable countries found after mapping');
              }

          //   console.log(`Loaded ${countries.length} countries`);
              populateSelect(countrySelect, countries, 'code', 'name');
          })
          .catch(error => {
              console.error('Error fetching countries:', error);
              const fallbackCountries = [
              { code: 'PH', name: 'Philippines' },
              { code: 'US', name: 'United States' },
              { code: 'CA', name: 'Canada' },
              { code: 'GB', name: 'United Kingdom' },
              { code: 'AU', name: 'Australia' }
              ];
              console.warn('Using fallback country list');
              populateSelect(countrySelect, fallbackCountries, 'code', 'name');
          });

          // Sync country name when selected
          countrySelect.addEventListener('change', function() {
          const countryName = this.options[this.selectedIndex].text;
          document.getElementById('ofw_country_name').value = countryName;
        });

        const staticRegion3Provinces = [
        { code: '030800000', name: 'Bataan' },
        { code: '031400000', name: 'Bulacan' },
        { code: '034900000', name: 'Nueva Ecija' },
        { code: '035400000', name: 'Pampanga' },
        { code: '036900000', name: 'Tarlac' },
        { code: '037100000', name: 'Zambales' },
        { code: '037700000', name: 'Aurora' }
        ];

        fetch('https://psgc.gitlab.io/api/provinces/')
        .then(response => response.json())
        .then(data => {
            const provinceData = Array.isArray(data)
            ? data
            : (Array.isArray(data.value) ? data.value : []);

            const region3Provinces = provinceData.filter(p => {
            if (!p || !p.regionCode) return false;
            // Accept exact Region 3 code or prefix style
            return p.regionCode === '030000000' || String(p.regionCode).startsWith('030');
            });

            if (!region3Provinces.length) {
            console.warn('PSGC returned no Region 3 provinces, using static fallback');
            populateSelect(partyProvinceSelect, staticRegion3Provinces, 'code', 'name');
            return;
            }

            populateSelect(partyProvinceSelect, region3Provinces, 'code', 'name');
        })
        .catch(error => {
            console.error('Error fetching provinces:', error);
            populateSelect(partyProvinceSelect, staticRegion3Provinces, 'code', 'name');
        });

        partyProvinceSelect.addEventListener('change', function() {
          const provinceCode = this.value;
          const provinceName = this.options[this.selectedIndex].text;
          document.getElementById('party_province_name').value = provinceName;

          
          resetSelect(partyMunicipalitySelect, 'Loading municipalities...');
          resetSelect(partyBarangaySelect, 'Barangay');

          if (!provinceCode) {
              resetSelect(partyMunicipalitySelect, 'City / Municipality');
              return;
          }

          fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
              .then(response => response.json())
              .then(data => {
              if (!Array.isArray(data) || !data.length) {
                  throw new Error('No municipalities found');
              }
              populateSelect(partyMunicipalitySelect, data, 'code', 'name');
              })
              .catch(error => {
              console.error('Error fetching municipalities:', error);
              resetSelect(partyMunicipalitySelect, 'City / Municipality');
              });
          });

          partyMunicipalitySelect.addEventListener('change', function() {
          const cityCode = this.value;
          const cityName = this.options[this.selectedIndex].text;
          document.getElementById('party_municipality_name').value = cityName;
          
          resetSelect(partyBarangaySelect, 'Loading barangays...');

          if (!cityCode) {
              resetSelect(partyBarangaySelect, 'Barangay');
              return;
          }

          fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
              .then(response => response.json())
              .then(data => {
              if (!Array.isArray(data) || !data.length) {
                  throw new Error('No barangays found');
              }
              populateSelect(partyBarangaySelect, data, 'code', 'name');
              })
              .catch(error => {
              console.error('Error fetching barangays:', error);
              resetSelect(partyBarangaySelect, 'Barangay');
              });
        });

        // Sync barangay name when selected
        partyBarangaySelect.addEventListener('change', function() {
            const barangayCode = this.value;
            const barangayName = this.options[this.selectedIndex].text;

            document.getElementById('party_barangay_name').value = barangayName;


        });

        const ofwProvinceSelect = document.getElementById('ofw_province');
        const ofwMunicipalitySelect = document.getElementById('ofw_municipality');
        const ofwBarangaySelect = document.getElementById('ofw_barangay');
   

        // Old values (for session restore)
        const oldOfwProvince = "{{ session('general_form_data.ofw_province') }}";
        const oldOfwMunicipality = "{{ session('general_form_data.ofw_municipality') }}";
        const oldOfwBarangay = "{{ session('general_form_data.ofw_barangay') }}";

        // Reset & populate already exist in your code, reuse them

        // ===================== LOAD PROVINCES =====================
        const staticRegion3ProvincesOFW = [
            { code: '030800000', name: 'Bataan' },
            { code: '031400000', name: 'Bulacan' },
            { code: '034900000', name: 'Nueva Ecija' },
            { code: '035400000', name: 'Pampanga' },
            { code: '036900000', name: 'Tarlac' },
            { code: '037100000', name: 'Zambales' },
            { code: '037700000', name: 'Aurora' }
        ];

        fetch('https://psgc.gitlab.io/api/provinces/')
            .then(res => res.json())
            .then(data => {
                const provinceData = Array.isArray(data)
                    ? data
                    : (Array.isArray(data.value) ? data.value : []);

                const region3 = provinceData.filter(p =>
                    p?.regionCode &&
                    (p.regionCode === '030000000' || String(p.regionCode).startsWith('030'))
                );

                if (!region3.length) {
                    populateSelect(ofwProvinceSelect, staticRegion3ProvincesOFW, 'code', 'name');
                    return;
                }

                populateSelect(ofwProvinceSelect, region3, 'code', 'name');
            })
            .catch(err => {
                console.error('OFW province error:', err);
                populateSelect(ofwProvinceSelect, staticRegion3ProvincesOFW, 'code', 'name');
            });

        // ===================== PROVINCE CHANGE =====================
        ofwProvinceSelect.addEventListener('change', function () {
            const provinceCode = this.value;
            const provinceName = this.options[this.selectedIndex].text;

            document.getElementById('ofw_province_name').value = provinceName;

            resetSelect(ofwMunicipalitySelect, 'Loading municipalities...');
            resetSelect(ofwBarangaySelect, 'Barangay');

            if (!provinceCode) {
                resetSelect(ofwMunicipalitySelect, 'City / Municipality');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) {
                        throw new Error('No municipalities found');
                    }
                    populateSelect(ofwMunicipalitySelect, data, 'code', 'name');
                })
                .catch(err => {
                    console.error('OFW municipality error:', err);
                    resetSelect(ofwMunicipalitySelect, 'City / Municipality');
                });
        });

        // ===================== MUNICIPALITY CHANGE =====================
        ofwMunicipalitySelect.addEventListener('change', function () {
            const cityCode = this.value;
            const cityName = this.options[this.selectedIndex].text;

            document.getElementById('ofw_municipality_name').value = cityName;

            resetSelect(ofwBarangaySelect, 'Loading barangays...');

            if (!cityCode) {
                resetSelect(ofwBarangaySelect, 'Barangay');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) {
                        throw new Error('No barangays found');
                    }
                    populateSelect(ofwBarangaySelect, data, 'code', 'name');
                })
                .catch(err => {
                    console.error('OFW barangay error:', err);
                    resetSelect(ofwBarangaySelect, 'Barangay');
                });
        });

        // ===================== BARANGAY CHANGE =====================
        ofwBarangaySelect.addEventListener('change', function () {
            const barangayName = this.options[this.selectedIndex].text;
            document.getElementById('ofw_barangay_name').value = barangayName;
        });
      


        document.querySelector('form').addEventListener('submit', function(e) {
            let isChecked = false;
            // Select all checkboxes inside Section C
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => {
                if (cb.checked) isChecked = true;
            });

            if (!isChecked) {
                e.preventDefault(); // Prevent form submission

                // Show the Bootstrap modal
                const validationModal = new bootstrap.Modal(document.getElementById('validationModal'));
                validationModal.show();
            }
        });

    });


  </script>

@endsection