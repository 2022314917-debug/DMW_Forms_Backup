@extends('layouts.app')

@php
    $steps = session('forms.steps', []);
    $currentStep = request()->segment(3); // /forms/step/{step}
@endphp



@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    html, body {
      width: 100%;
      /* overflow-x: hidden; */
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #f4f4f4;
      font-family: 'Assistant', Arial, sans-serif;
    }

    .form-header {
      background-color: rgba(0, 114, 8, 0.1);
      padding: 1rem;
      border-radius: 0.25rem;
      margin-bottom: 1rem;
      border: 1px solid rgba(0, 114, 8, 0.4);
    }

    .form-section {
      background-color: rgba(219, 232, 255, 0.9);
      padding: 1rem;
      border-radius: 0.25rem;
      margin-bottom: 1rem;
      border: 1px solid #b0c4de;
    }

    .form-section h5 {
      font-weight: bold;
      margin-bottom: 1rem;
    }

    .form-control::placeholder,
    .form-select option {
      font-size: 0.85rem;
    }

    .form-label {
      font-weight: 600;
    }

    .form-check,
    .form-check-inline {
      display: inline-flex;
      align-items: center;
      margin-right: 0.5rem;
      margin-bottom: 0.35rem;
      max-width: calc(100% - 25px);
      white-space: normal;
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    .form-check-input {
      margin-top: 0;
      margin-right: 0.25rem;
      flex-shrink: 0;
    }

    .form-check-label {
      margin-bottom: 0;
      white-space: normal;
    }

    .row.align-items-center {
      margin-left: 0;
      margin-right: 0;
      width: 100%;
    }



    .row.align-items-center .col-md-3 .form-label,
    .row.align-items-center .col-md-3 h6,
    .row.align-items-center .col-md-3 strong {
      white-space: normal;
    }

    .row.align-items-center .col-md-9 {
      flex: 0 0 calc(100% - 170px);
      max-width: calc(100% - 170px);
      padding-left: 0;
      margin-left: 0;
    }

    

    @media (max-width: 992px) and (min-width: 768px) {
      .row.text-center .col-md-3 {
        flex: 0 0 50% !important;
        max-width: 50% !important;
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(176, 196, 222, 0.5);
      }

      .row.text-center .col-md-3:nth-child(n+3) {
        border-bottom: none;
      }
    }

    @media (max-width: 767px) {
      .row.align-items-center .col-md-3,
      .row.align-items-center .col-md-9 {
        flex: 0 0 100%;
        max-width: 100%;
        width: 100%;
        padding-left: 0;
        padding-right: 0;
      }

      .row.align-items-center .col-md-3 .form-label,
      .row.align-items-center .col-md-3 h6,
      .row.align-items-center .col-md-3 strong {
        white-space: normal;
      }

      .row.text-center .col-md-3 {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(176, 196, 222, 0.5);
      }

      .row.text-center .col-md-3:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
      }
    }

    .badge-lightblue {
      background-color: #eef7ff;
      color: #3a6a8c;
      font-weight: 600;
      padding: 0.2rem 0.5rem;
      border-radius: 0.25rem;
    }
  </style>

  <div class="container my-5">
    @if(session('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    @endif

    <div class="position-relative d-flex align-items-center justify-content-center mb-3" style="min-height: 38px;">
        <a href="{{ route('forms-submitted.show', $request->id) }}" 
          class="btn btn-secondary btn-sm position-absolute start-0 d-flex align-items-center gap-1"
          style="border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back to Request
        </a>
        <h4 class="h2 mb-0 fw-bold">REQUEST #{{ $request->id }}</h4>
    </div>
    <div class="form-header text-center">
      <h4 class="fw-bold">REQUEST FOR VERIFICATION/CERTIFICATION OF OFW RECORDS</h4>
      <p>
        Gamitin ang form na ito para humingi ng tulong. Siguraduhing tama at kumpleto ang lahat ng impormasyon ilalagay upang maproseso agad ng aming team ang inyong request.
      </p>
      <small>
        Regional Office Contact Details: (045) 963-4394 | (045) 455-0832 | pampanga@dmw.gov.ph | www.ro3.dmw.gov.ph
      </small>
    </div>


      <div class="form-section">

        <h5>FULL NAME (Pangalan ng OFW)</h5>
        <div class="row g-3 mb-3">

          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control disabled" name="ofw_lname" id="ofw_lname" value="{{ $ofw->ofw_lname }}">
          </div>

          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control disabled" name="ofw_fname" id="ofw_fname" value="{{ $ofw->ofw_fname }}">
          </div>

          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control disabled" name="ofw_mname" id="ofw_mname" value="{{ $ofw->ofw_mname }}">
          </div>

        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Jobsite (Bansang Pinagtatrabahuhan)</label>
            <input type="text" class="form-control disabled" name="ofw_country_name" id="jobsite" value="{{ $ofw->ofw_country }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Record Needed - Year (Kailangang Record - Taon)</label>
            <input type="text" class="form-control disabled" name="record_needed_mwpd_processing" placeholder="ex. 2024" id="records_needed" value="{{ $entries['record_needed_mwpd_processing'] ?? '' }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Purpose (Saan gagamitin ang kinakuhang record)</label>
            <input type="text" class="form-control disabled" name="record_purpose_mwpd_processing" placeholder="ex. Employment Verification" id="record_purpose" value="{{ $entries['record_purpose_mwpd_processing'] ?? '' }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Name of Agency</label>
          <input type="text" class="form-control disabled" name="ofw_agency" placeholder="ex. ABC Agency" id="ofw_agency" value="{{ $ofw->ofw_agency }}">
        </div>
    </div>
    <div class="form-section">
      <h5>FOR THE REQUESTING PARTY (Ang Kumukuha ng Record ay hindi mismong OFW)</h5>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control disabled" name="party_lname" placeholder="Dela Cruz" id="req_family_name" value="{{ $party->party_lname }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control disabled" name="party_fname" placeholder="Juan" id="req_first_name" value="{{ $party->party_fname }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control disabled" name="party_mname" placeholder="Santos" id="req_middle_name" value="{{ $party->party_mname }}">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Relationship to OFW</label>
            <input type="text" class="form-control disabled" name="party_relationship" placeholder="ex. Brother" id="relationship_ofw" value="{{ $party->party_relationship }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control disabled" name="party_phone" placeholder="ex. 09123456789" id="contact_number" value="{{ $party->party_phone }}">
          </div>
        </div>

        <div class="mb-3 mt-4">
          <label class="form-label"> <strong>Complete Address in the Philippines</strong> </label> 
          <div class="m-0 p-0">
            <label class="form-label">House Number/Street name</label>
            <input type="text" class="form-control mb-2 disabled" name="party_house_no" placeholder="Unit/Room/House Number/Street name" id="phil_address" value="{{ $party_address->house_no }}">
          </div>
          

          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Province</label>
              <input type="text" class="form-control disabled" name="party_province_name" id="party_province_name" value="{{ $party_address->province }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">City/Municipality</label>
              <input type="text" class="form-control disabled" name="party_municipality_name" id="party_municipality_name" value="{{ $party_address->municipality }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Barangay</label>
              <input type="text" class="form-control disabled" name="party_barangay_name" id="party_barangay_name" value="{{ $party_address->brgy }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Zip Code</label>
              <input type="text" class="form-control disabled" name="party_zip_code" placeholder="ex. 2016" id="party_zip_code" value="{{ $party_address->zip_code }}">
            </div>
          </div>

          <div class="row g-3 mt-2">
            <div class="col-md-6">
              <label class="form-label">Telephone Number</label>
              <input type="text" class="form-control disabled" name="telephone_mwpd_processing" placeholder="ex. (045) 123-4567" id="telephone_number" value="{{ $entries['telephone_mwpd_processing'] ?? '' }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control disabled" name="party_email" placeholder="ex. sample@email.com" id="party_email" value="{{ $party->party_email }}">
            </div>
          </div>
        </div>
    </div>

      
      
    <form method="POST" action="">
      @csrf
      <div class="form-section" style="background-color: rgba(219, 232, 255, 0.95);">
        <h5 class="text-center fw-bold">Do not fill out this portion: FOR DMW PERSONNEL ONLY</h5>

          <div class="row g-2 justify-content-end py-3">
              <div class="col-md-3">
                  <label class="form-label mb-0">Time Received:</label>
                  <input type="text" name="time_received_mwpd_processing" class="form-control form-control-sm" placeholder="hh:mm AM/PM" id="time_received_mwpd_processing">
              </div>

              <div class="col-md-3">
                  <label class="form-label mb-0">Time Released:</label>
                  <input type="text" name="time_released_mwpd_processing" class="form-control form-control-sm" placeholder="hh:mm AM/PM">
              </div>

              <div class="col-md-3">
                  <label class="form-label mb-0">Total PCT:</label>
                  <input type="text" name="total_pct_mwpd_processing" class="form-control form-control-sm">
              </div>
          </div>
               <!-- ── Section 1: Worker Category / Requested Record / Purpose ── -->
          <div class="container my-3">
              <div class="row g-3">

                  <!-- Worker Category -->
                  <div class="col-md-3">
                      <h5>Worker Category</h5>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="radio" name="landbased_mwpd_processing" id="landbased_mwpd_processing" value="landbased_mwpd_processing">
                          <label class="form-check-label ms-2" for="landbased_mwpd_processing">Landbased (Newhire)</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="radio" name="rehire_mwpd_processing" id="rehire_mwpd_processing" value="rehire_mwpd_processing">
                          <label class="form-check-label ms-2" for="rehire_mwpd_processing">Rehire (Balik Manggagawa)</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="radio" name="seafarer_mwpd_processing" id="seafarer_mwpd_processing" value="seafarer_mwpd_processing">
                          <label class="form-check-label ms-2" for="seafarer_mwpd_processing">Seafarer</label>
                      </div>
                  </div>

                  <!-- Requested Record -->
                  <div class="col-md-3">
                      <h5>Requested Record:</h5>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="info_sheet_mwpd_processing" id="info_sheet_mwpd_processing" value="info_sheet_mwpd_processing">
                          <label class="form-check-label ms-2" for="info_sheet_mwpd_processing">Information Sheet</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="requested_record[]" id="rr_emp" value="employment_contract">
                          <label class="form-check-label ms-2" for="rr_emp">Employment Contract</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="requested_record[]" id="rr_oec" value="oec">
                          <label class="form-check-label ms-2" for="rr_oec">OEC</label>
                      </div>
                  </div>

                  <!-- Purpose of Request -->
                  <div class="col-md-6">
                      <h5>Purpose of Request:</h5>
                      <div class="row g-0">
                          <div class="col-6">
                              <div class="form-check d-flex align-items-start mb-1">
                                  <input class="form-check-input mt-1" type="checkbox" name="complaint_mwpd_processing" id="complaint_mwpd_processing" value="complaint_mwpd_processing">
                                  <label class="form-check-label ms-2" for="complaint_mwpd_processing">Complaint/Legal Action</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="welf_assist_mwpd_processing" id="welf_assist_mwpd_processing" value="welf_assist_mwpd_processing">
                                  <label class="form-check-label ms-2" for="welf_assist_mwpd_processing">Welfare Assistance</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="valid_bm_mwpd_processing" id="valid_bm_mwpd_processing" value="valid_bm_mwpd_processing">
                                  <label class="form-check-label ms-2" for="valid_bm_mwpd_processing">Validation - BM</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="app_loan_mwpd_processing" id="app_loan_mwpd_processing" value="app_loan_mwpd_processing">
                                  <label class="form-check-label ms-2" for="app_loan_mwpd_processing">Application for Loan</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="red_trav_tax_mwpd_processing" id="red_trav_tax_mwpd_processing" value="red_trav_tax_mwpd_processing">
                                  <label class="form-check-label ms-2" for="red_trav_tax_mwpd_processing">Reduce Travel Tax</label>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="investigation_mwpd_processing" id="investigation_mwpd_processing" value="investigation_mwpd_processing">
                                  <label class="form-check-label ms-2" for="investigation_mwpd_processing">Investigation</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="owwa_claims_mwpd_processing" id="owwa_claims_mwpd_processing" value="owwa_claims_mwpd_processing">
                                  <label class="form-check-label ms-2" for="pur_owwa">OWWA Claims</label>
                              </div>
                              <div class="form-check d-flex align-items-start mb-1">
                                  <input class="form-check-input mt-1" type="checkbox" name="work_exp_mwpd_processing" id="work_exp_mwpd_processing" value="work_exp_mwpd_processing">
                                  <label class="form-check-label ms-2" for="owwa_claims_mwpd_processing">Validation of Work Experience</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="prc_mwpd_processing" id="prc_mwpd_processing" value="prc_mwpd_processing">
                                  <label class="form-check-label ms-2" for="prc_mwpd_processing">PRC</label>
                              </div>
                              <div class="d-flex align-items-center gap-1 mt-1">
                                  <input class="form-check-input" type="checkbox" name="purpose_req_others_mwpd_processing" id="purpose_req_others_mwpd_processing" value="purpose_req_others_mwpd_processing">
                                  <label class="form-check-label ms-1" for="pur_others">Others:</label>
                                  <input type="text" name="purpose_req_others_specify_mwpd_processing" class="form-control form-control-sm" >
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>

          <!-- ── Section 2: Processing Site / Year(s) / Documents Presented ── -->
          <div class="">
              <div class="row g-3">

                  <!-- Processing Site -->
                  <div class="col-md-3">
                      <h5>Processing Site</h5>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="central_office_mwpd_processing" id="central_office_mwpd_processing" value="central_office_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_central">Central Office</label>
                      </div>
                      <div class="d-flex align-items-center mb-1 gap-1">
                          <input class="form-check-input" type="checkbox" name="regional_office_mwpd_processing" id="regional_office_mwpd_processing" value="regional_office_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_regional">Regional Office</label>
                          <input type="text" name="regional_office_no_mwpd_processing" class="form-control form-control-sm inline-text" style="width: 55%;">
                      </div>
                      <div class="d-flex align-items-center mb-1 gap-1">
                          <input class="form-check-input" type="checkbox" name="polo_mwpd_processing" id="polo_mwpd_processing" value="polo_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_polo">POLO</label>
                          <input type="text" name="polo_specify_mwpd_processing" class="form-control form-control-sm inline-text">
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="inhouse_mwpd_processing" id="inhouse_mwpd_processing" value="inhouse_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_inhouse">In-house</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="lac_mwpd_processing" id="lac_mwpd_processing" value="lac_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_lac">LAC</label>
                      </div>
                      
                  </div>

                  <!-- Year(s) -->
                  <div class="col-md-3">
                      <h5>Year/s:</h5>
                      <input type="text" name="years" class="form-control form-control-sm" placeholder="e.g. 2023, 2024">
                  </div>

                  <!-- Documents Presented -->
                  <div class="col-md-6">
                      <h5>Documents Presented:</h5>
                      <div class="form-check d-flex align-items-start mb-1">
                          <input class="form-check-input mt-1" type="checkbox" name="passport_mwpd_processing" id="passport_mwpd_processing" value="passport_mwpd_processing">
                          <label class="form-check-label ms-2" for="passport_mwpd_processing">Company ID, Passport, SSRB, NBI, SSS, etc.</label>
                      </div>
                      <div class="form-check d-flex align-items-start mb-1">
                          <input class="form-check-input mt-1" type="checkbox" name="Authorization, Special Power of Attorney (SPA)" id="Authorization, Special Power of Attorney (SPA)" value="Authorization, Special Power of Attorney (SPA)">
                          <label class="form-check-label ms-2" for="Authorization, Special Power of Attorney (SPA)">Authorization, Special Power of Attorney (SPA)</label>
                      </div>
                      
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="marriage_contract_mwpd_processing" id="marriage_contract_mwpd_processing" value="marriage_contract_mwpd_processing">
                          <label class="form-check-label ms-2" for="marriage_contract_mwpd_processing">Marriage Contract</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="psa_mwpd_processing" id="psa_mwpd_processing" value="psa_mwpd_processing">
                          <label class="form-check-label ms-2" for="psa_mwpd_processing">Birth Certificate</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="letter_req_mwpd_processing" id="letter_req_mwpd_processing" value="letter_req_mwpd_processing">
                          <label class="form-check-label ms-2" for="letter_req_mwpd_processing">Letter Request</label>
                      </div>
                      <div class="d-flex align-items-center gap-1 mb-1">
                          <input class="form-check-input" type="checkbox" name="docs_presented_others_mwpd_processing" id="docs_presented_others_mwpd_processing" value="docs_presented_others_mwpd_processing">
                          <label class="form-check-label ms-1" for="docs_presented_others_mwpd_processing">Others:</label>
                          <input type="text" name="docs_presented_others_specify_mwpd_processing" class="form-control form-control-sm" style="flex:1;">
                      </div>
                  </div>

              </div>
          </div>

          <!-- ── Section 3: Action Taken ── -->
          <div class="mt-3">
              <h5>ACTION TAKEN:</h5>

              <div class="row g-3">

                  <!-- Column 1: OFW Record Released -->
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-center mb-2">
                          <input class="form-check-input" type="checkbox" name="ofw_record_released_mwpd_processing" id="ofw_record_released_mwpd_processing" value="ofw_record_released_mwpd_processing">
                          <label class="form-check-label ms-2 fw-semibold" for="at_ofw">Ofw Record Released:</label>
                      </div>
                      <div class="row sub-options ps-4">
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="print-out_mwpd_processing" id="print-out_mwpd_processing" value="print-out_mwpd_processing">
                              <label class="form-check-label" for="print-out_mwpd_processing">Print-out</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="copy_orig_mwpd_processing" id="copy_orig_mwpd_processing" value="copy_orig_mwpd_processing">
                              <label class="form-check-label" for="copy_orig_mwpd_processing">Copy of Original</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="digi_img_mwpd_processing" id="digi_img_mwpd_processing" value="digi_img_mwpd_processing">
                              <label class="form-check-label" for="digi_img_mwpd_processing">Digital Image</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="cert_no_record_mwpd_processing" id="cert_no_record_mwpd_processing" value="cert_no_record_mwpd_processing">
                              <label class="form-check-label" for="cert_no_record_mwpd_processing">Cert of No Record</label>
                          </div>
                      </div>
                  </div>

                  <!-- Column 2: No Record -->
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-start mb-2">
                          <input class="form-check-input mt-1" type="checkbox" name="action_no_record" id="at_no_record" value="1">
                          <label class="form-check-label ms-2 fw-semibold" for="at_no_record">
                              No Record: Request endorsed to other units for further verification:
                          </label>
                      </div>
                      <div class="row ps-4">
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="no_rec_ict_mwpd_processing" id="no_rec_ict_mwpd_processing" value="no_rec_ict_mwpd_processing">
                              <label class="form-check-label" for="no_rec_ict_mwpd_processing">ICT Branch</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="roco_mwpd_processing" id="roco_mwpd_processing" value="roco_mwpd_processing">
                              <label class="form-check-label" for="roco_mwpd_processing">ROCO</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                            <div class="d-flex align-items-center gap-1">
                                <input class="form-check-input" type="radio" name="for_edit_others_mwpd_processing" id="for_edit_others_mwpd_processing" value="for_edit_others_mwpd_processing">
                                <label class="form-check-label ms-1" for="for_edit_others_mwpd_processing">Others</label>
                                <input type="text" name="for_edit_others_specify_mwpd_processing" class="form-control form-control-sm" style="width:110px;">
                            </div>
                        </div>
                      </div>
                  </div>

                  <!-- Column 3: Documents Submitted / For Editing -->
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-start mb-2">
                          <input class="form-check-input mt-1" type="checkbox" name="further_evaluation_mwpd_processing" id="further_evaluation_mwpd_processing" value="further_evaluation_mwpd_processing">
                          <label class="form-check-label ms-2 fw-semibold" for="at_docs">
                              Documents submitted for further evaluation of Superior
                          </label>
                      </div>


                      
                      
                  </div>
                  
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-center mb-2">
                          <input class="form-check-input" type="checkbox" name="edit_encode_mwpd_processing" id="edit_encode_mwpd_processing" value="edit_encode_mwpd_processing">
                          <label class="form-check-label ms-2 fw-semibold" for="edit_encode_mwpd_processing">For Editing/Encoding:</label>
                      </div>
                      <div class="row ps-4">
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="edit_unit_ict_mwpd_processing" id="edit_unit_ict_mwpd_processing" value="edit_unit_ict_mwpd_processing">
                              <label class="form-check-label" for="edit_unit_ict_mwpd_processing">ICT Branch</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="landbased_mwpd_processing" id="landbased_mwpd_processing" value="landbased_mwpd_processing">
                              <label class="form-check-label" for="landbased_mwpd_processing">Landbased Center</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="seabased_mwpd_processing" id="seabased_mwpd_processing" value="seabased_mwpd_processing">
                              <label class="form-check-label" for="seabased_mwpd_processing">Seabased Center</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                            <div class="d-flex align-items-center gap-1">
                              <input class="form-check-input" type="radio" name="for_edit_others_mwpd_processing" id="for_edit_others_mwpd_processing" value="for_edit_others_mwpd_processing">
                              <label class="form-check-label ms-1" for="for_edit_others_mwpd_processing">Others</label>
                              <input type="text" name="for_edit_others_specify_mwpd_processing" class="form-control form-control-sm" style="width:100px;">
                            </div>
                              
                          </div>
                      </div>
                  </div>

              </div>

              <!-- Number of Records -->
              <div class="row align-items-center mt-3">
                  <div class="col-auto">
                      <div class="d-block d-lg-flex align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" name="num_records_mwpd_processing" id="num_records_mwpd_processing" value="num_records_mwpd_processing">
                          <label class="form-check-label fw-semibold" for="num_records_mwpd_processing">
                              Number of Records Retrieved/Printed:
                          </label>
                      </div>
                  </div>
                  <div class="col">
                      <input type="text" name="num_records_specify_mwpd_processing" class="form-control form-control-sm">
                  </div>
              </div>

              <!-- Remarks -->
              <div class="mt-3">
                  <span class="fw-semibold me-2">Remarks:</span>
                  <span class="me-1">Reason if target PCT is not achieved:</span>

                  <div class="row flex-wrap align-items-center mt-2">
                      <div class="col-md-12 form-check">
                          <input class="form-check-input" type="radio" name="server_error_mwpd_processing" id="server_error_mwpd_processing" value="server_error_mwpd_processing">
                          <label class="form-check-label" for="server_error_mwpd_processing">Server Error</label>
                      </div>
                      <div class="col-md-12 form-check">
                          <input class="form-check-input" type="radio" name="remarkprint_error_mwpd_processing_reason" id="print_error_mwpd_processing" value="print_error_mwpd_processing">
                          <label class="form-check-label" for="print_error_mwpd_processing">Printer Error</label>
                      </div>
                      <div class="col-md-12 form-check">
                          <input class="form-check-input" type="radio" name="reverify_mwpd_processing" id="reverify_mwpd_processing" value="reverify_mwpd_processing">
                          <label class="form-check-label" for="reverify_mwpd_processing">
                              Re-verification (due to wrong spelling of name, change of name, etc.)
                          </label>
                      </div>
                      <div class="col-md-12 form-check">
                          <div class="d-flex align-items-center gap-1">
                            <input class="form-check-input" type="radio" name="remarks_others_mwpd_processing" id="remarks_others_mwpd_processing" value="remarks_others_mwpd_processing">
                            <label class="form-check-label" for="rem_others">Others </label>
                            <input type="text" name="remarks_others_specify_mwpd_processing" class="form-control form-control-sm" style="width: 100%;">
                          </div>
                          
                      </div>
                  </div>

              </div>
          </div>
        </div> 

        <div class="d-grid">
          <button type="button" class="btn btn-primary" id="openReviewModalBtn">UPDATE REQUEST</button>
        </div>

        <!-- Review Modal -->
        <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
              <div class="modal-header" style="background-color: rgba(219, 232, 255, 0.95); border-bottom: 1px solid #b0c4de;">
                <h5 class="modal-title fw-bold" id="reviewModalLabel">Review: FOR DMW PERSONNEL ONLY</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="reviewModalBody">
                <!-- Populated dynamically -->
                <div class="form-section" style="background-color: rgba(219, 232, 255, 0.95);">
        <h5 class="text-center fw-bold">Do not fill out this portion: FOR DMW PERSONNEL ONLY</h5>

          <div class="row g-2 justify-content-end py-3">
              <div class="col-md-3">
                  <label class="form-label mb-0">Time Received:</label>
                  <input type="text" name="time_received_mwpd_processing" class="form-control form-control-sm" placeholder="hh:mm AM/PM" id="time_received_mwpd_processing">
              </div>

              <div class="col-md-3">
                  <label class="form-label mb-0">Time Released:</label>
                  <input type="text" name="time_released_mwpd_processing" class="form-control form-control-sm" placeholder="hh:mm AM/PM">
              </div>

              <div class="col-md-3">
                  <label class="form-label mb-0">Total PCT:</label>
                  <input type="text" name="total_pct_mwpd_processing" class="form-control form-control-sm">
              </div>
          </div>
               <!-- ── Section 1: Worker Category / Requested Record / Purpose ── -->
          <div class="container my-3">
              <div class="row g-3">

                  <!-- Worker Category -->
                  <div class="col-md-3">
                      <h5>Worker Category</h5>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="landbased_mwpd_processing" id="landbased_mwpd_processing" value="landbased_mwpd_processing">
                          <label class="form-check-label ms-2" for="landbased_mwpd_processing">Landbased (Newhire)</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="rehire_mwpd_processing" id="rehire_mwpd_processing" value="rehire_mwpd_processing">
                          <label class="form-check-label ms-2" for="rehire_mwpd_processing">Rehire (Balik Manggagawa)</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="seafarer_mwpd_processing" id="seafarer_mwpd_processing" value="seafarer_mwpd_processing">
                          <label class="form-check-label ms-2" for="seafarer_mwpd_processing">Seafarer</label>
                      </div>
                  </div>

                  <!-- Requested Record -->
                  <div class="col-md-3">
                      <h5>Requested Record:</h5>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="info_sheet_mwpd_processing" id="info_sheet_mwpd_processing" value="info_sheet_mwpd_processing">
                          <label class="form-check-label ms-2" for="info_sheet_mwpd_processing">Information Sheet</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="requested_record[]" id="rr_emp" value="employment_contract">
                          <label class="form-check-label ms-2" for="rr_emp">Employment Contract</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="requested_record[]" id="rr_oec" value="oec">
                          <label class="form-check-label ms-2" for="rr_oec">OEC</label>
                      </div>
                  </div>

                  <!-- Purpose of Request -->
                  <div class="col-md-6">
                      <h5>Purpose of Request:</h5>
                      <div class="row g-0">
                          <div class="col-6">
                              <div class="form-check d-flex align-items-start mb-1">
                                  <input class="form-check-input mt-1" type="checkbox" name="complaint_mwpd_processing" id="complaint_mwpd_processing" value="complaint_mwpd_processing">
                                  <label class="form-check-label ms-2" for="complaint_mwpd_processing">Complaint/Legal Action</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="welf_assist_mwpd_processing" id="welf_assist_mwpd_processing" value="welf_assist_mwpd_processing">
                                  <label class="form-check-label ms-2" for="welf_assist_mwpd_processing">Welfare Assistance</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="valid_bm_mwpd_processing" id="valid_bm_mwpd_processing" value="valid_bm_mwpd_processing">
                                  <label class="form-check-label ms-2" for="valid_bm_mwpd_processing">Validation - BM</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="app_loan_mwpd_processing" id="app_loan_mwpd_processing" value="app_loan_mwpd_processing">
                                  <label class="form-check-label ms-2" for="app_loan_mwpd_processing">Application for Loan</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="red_trav_tax_mwpd_processing" id="red_trav_tax_mwpd_processing" value="red_trav_tax_mwpd_processing">
                                  <label class="form-check-label ms-2" for="red_trav_tax_mwpd_processing">Reduce Travel Tax</label>
                              </div>
                          </div>
                          <div class="col-6">
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="investigation_mwpd_processing" id="investigation_mwpd_processing" value="investigation_mwpd_processing">
                                  <label class="form-check-label ms-2" for="investigation_mwpd_processing">Investigation</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="owwa_claims_mwpd_processing" id="owwa_claims_mwpd_processing" value="owwa_claims_mwpd_processing">
                                  <label class="form-check-label ms-2" for="pur_owwa">OWWA Claims</label>
                              </div>
                              <div class="form-check d-flex align-items-start mb-1">
                                  <input class="form-check-input mt-1" type="checkbox" name="work_exp_mwpd_processing" id="work_exp_mwpd_processing" value="work_exp_mwpd_processing">
                                  <label class="form-check-label ms-2" for="owwa_claims_mwpd_processing">Validation of Work Experience</label>
                              </div>
                              <div class="form-check d-flex align-items-center mb-1">
                                  <input class="form-check-input" type="checkbox" name="prc_mwpd_processing" id="prc_mwpd_processing" value="prc_mwpd_processing">
                                  <label class="form-check-label ms-2" for="prc_mwpd_processing">PRC</label>
                              </div>
                              <div class="d-flex align-items-center gap-1 mt-1">
                                  <input class="form-check-input" type="checkbox" name="purpose_req_others_mwpd_processing" id="purpose_req_others_mwpd_processing" value="purpose_req_others_mwpd_processing">
                                  <label class="form-check-label ms-1" for="pur_others">Others:</label>
                                  <input type="text" name="purpose_req_others_specify_mwpd_processing" class="form-control form-control-sm" >
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
          </div>

          <!-- ── Section 2: Processing Site / Year(s) / Documents Presented ── -->
          <div class="">
              <div class="row g-3">

                  <!-- Processing Site -->
                  <div class="col-md-3">
                      <h5>Processing Site</h5>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="central_office_mwpd_processing" id="central_office_mwpd_processing" value="central_office_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_central">Central Office</label>
                      </div>
                      <div class="d-flex align-items-center mb-1 gap-1">
                          <input class="form-check-input" type="checkbox" name="regional_office_mwpd_processing" id="regional_office_mwpd_processing" value="regional_office_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_regional">Regional Office</label>
                          <input type="text" name="regional_office_no_mwpd_processing" class="form-control form-control-sm inline-text" style="width: 55%;">
                      </div>
                      <div class="d-flex align-items-center mb-1 gap-1">
                          <input class="form-check-input" type="checkbox" name="polo_mwpd_processing" id="polo_mwpd_processing" value="polo_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_polo">POLO</label>
                          <input type="text" name="polo_specify_mwpd_processing" class="form-control form-control-sm inline-text">
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="inhouse_mwpd_processing" id="inhouse_mwpd_processing" value="inhouse_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_inhouse">In-house</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="lac_mwpd_processing" id="lac_mwpd_processing" value="lac_mwpd_processing">
                          <label class="form-check-label ms-2" for="ps_lac">LAC</label>
                      </div>
                      
                  </div>

                  <!-- Year(s) -->
                  <div class="col-md-3">
                      <h5>Year/s:</h5>
                      <input type="text" name="years" class="form-control form-control-sm" placeholder="e.g. 2023, 2024">
                  </div>

                  <!-- Documents Presented -->
                  <div class="col-md-6">
                      <h5>Documents Presented:</h5>
                      <div class="form-check d-flex align-items-start mb-1">
                          <input class="form-check-input mt-1" type="checkbox" name="passport_mwpd_processing" id="passport_mwpd_processing" value="passport_mwpd_processing">
                          <label class="form-check-label ms-2" for="passport_mwpd_processing">Company ID, Passport, SSRB, NBI, SSS, etc.</label>
                      </div>
                      <div class="form-check d-flex align-items-start mb-1">
                          <input class="form-check-input mt-1" type="checkbox" name="Authorization, Special Power of Attorney (SPA)" id="Authorization, Special Power of Attorney (SPA)" value="Authorization, Special Power of Attorney (SPA)">
                          <label class="form-check-label ms-2" for="Authorization, Special Power of Attorney (SPA)">Authorization, Special Power of Attorney (SPA)</label>
                      </div>
                      
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="marriage_contract_mwpd_processing" id="marriage_contract_mwpd_processing" value="marriage_contract_mwpd_processing">
                          <label class="form-check-label ms-2" for="marriage_contract_mwpd_processing">Marriage Contract</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="psa_mwpd_processing" id="psa_mwpd_processing" value="psa_mwpd_processing">
                          <label class="form-check-label ms-2" for="psa_mwpd_processing">Birth Certificate</label>
                      </div>
                      <div class="form-check d-flex align-items-center mb-1">
                          <input class="form-check-input" type="checkbox" name="letter_req_mwpd_processing" id="letter_req_mwpd_processing" value="letter_req_mwpd_processing">
                          <label class="form-check-label ms-2" for="letter_req_mwpd_processing">Letter Request</label>
                      </div>
                      <div class="d-flex align-items-center gap-1 mb-1">
                          <input class="form-check-input" type="checkbox" name="docs_presented_others_mwpd_processing" id="docs_presented_others_mwpd_processing" value="docs_presented_others_mwpd_processing">
                          <label class="form-check-label ms-1" for="docs_presented_others_mwpd_processing">Others:</label>
                          <input type="text" name="docs_presented_others_specify_mwpd_processing" class="form-control form-control-sm" style="flex:1;">
                      </div>
                  </div>

              </div>
          </div>

          <!-- ── Section 3: Action Taken ── -->
          <div class="mt-3">
              <h5>ACTION TAKEN:</h5>

              <div class="row g-3">

                  <!-- Column 1: OFW Record Released -->
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-center mb-2">
                          <input class="form-check-input" type="checkbox" name="ofw_record_released_mwpd_processing" id="ofw_record_released_mwpd_processing" value="ofw_record_released_mwpd_processing">
                          <label class="form-check-label ms-2 fw-semibold" for="at_ofw">Ofw Record Released:</label>
                      </div>
                      <div class="row sub-options ps-4">
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="print-out_mwpd_processing" id="print-out_mwpd_processing" value="print-out_mwpd_processing">
                              <label class="form-check-label" for="print-out_mwpd_processing">Print-out</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="copy_orig_mwpd_processing" id="copy_orig_mwpd_processing" value="copy_orig_mwpd_processing">
                              <label class="form-check-label" for="copy_orig_mwpd_processing">Copy of Original</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="digi_img_mwpd_processing" id="digi_img_mwpd_processing" value="digi_img_mwpd_processing">
                              <label class="form-check-label" for="digi_img_mwpd_processing">Digital Image</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="cert_no_record_mwpd_processing" id="cert_no_record_mwpd_processing" value="cert_no_record_mwpd_processing">
                              <label class="form-check-label" for="cert_no_record_mwpd_processing">Cert of No Record</label>
                          </div>
                      </div>
                  </div>

                  <!-- Column 2: No Record -->
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-start mb-2">
                          <input class="form-check-input mt-1" type="checkbox" name="action_no_record" id="at_no_record" value="1">
                          <label class="form-check-label ms-2 fw-semibold" for="at_no_record">
                              No Record: Request endorsed to other units for further verification:
                          </label>
                      </div>
                      <div class="row ps-4">
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="no_rec_ict_mwpd_processing" id="no_rec_ict_mwpd_processing" value="no_rec_ict_mwpd_processing">
                              <label class="form-check-label" for="no_rec_ict_mwpd_processing">ICT Branch</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="roco_mwpd_processing" id="roco_mwpd_processing" value="roco_mwpd_processing">
                              <label class="form-check-label" for="roco_mwpd_processing">ROCO</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                            <div class="d-flex align-items-center gap-1">
                                <input class="form-check-input" type="radio" name="for_edit_others_mwpd_processing" id="for_edit_others_mwpd_processing" value="for_edit_others_mwpd_processing">
                                <label class="form-check-label ms-1" for="for_edit_others_mwpd_processing">Others</label>
                                <input type="text" name="for_edit_others_specify_mwpd_processing" class="form-control form-control-sm" style="width:110px;">
                            </div>
                        </div>
                      </div>
                  </div>

                  <!-- Column 3: Documents Submitted / For Editing -->
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-start mb-2">
                          <input class="form-check-input mt-1" type="checkbox" name="further_evaluation_mwpd_processing" id="further_evaluation_mwpd_processing" value="further_evaluation_mwpd_processing">
                          <label class="form-check-label ms-2 fw-semibold" for="at_docs">
                              Documents submitted for further evaluation of Superior
                          </label>
                      </div>


                      
                      
                  </div>
                  
                  <div class="col-md-3">
                      <div class="form-check d-flex align-items-center mb-2">
                          <input class="form-check-input" type="checkbox" name="edit_encode_mwpd_processing" id="edit_encode_mwpd_processing" value="edit_encode_mwpd_processing">
                          <label class="form-check-label ms-2 fw-semibold" for="edit_encode_mwpd_processing">For Editing/Encoding:</label>
                      </div>
                      <div class="row ps-4">
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="edit_unit_ict_mwpd_processing" id="edit_unit_ict_mwpd_processing" value="edit_unit_ict_mwpd_processing">
                              <label class="form-check-label" for="edit_unit_ict_mwpd_processing">ICT Branch</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="landbased_mwpd_processing" id="landbased_mwpd_processing" value="landbased_mwpd_processing">
                              <label class="form-check-label" for="landbased_mwpd_processing">Landbased Center</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                              <input class="form-check-input" type="radio" name="seabased_mwpd_processing" id="seabased_mwpd_processing" value="seabased_mwpd_processing">
                              <label class="form-check-label" for="seabased_mwpd_processing">Seabased Center</label>
                          </div>
                          <div class="col-md-12 form-check mb-1">
                            <div class="d-flex align-items-center gap-1">
                              <input class="form-check-input" type="radio" name="for_edit_others_mwpd_processing" id="for_edit_others_mwpd_processing" value="for_edit_others_mwpd_processing">
                              <label class="form-check-label ms-1" for="for_edit_others_mwpd_processing">Others</label>
                              <input type="text" name="for_edit_others_specify_mwpd_processing" class="form-control form-control-sm" style="width:100px;">
                            </div>
                              
                          </div>
                      </div>
                  </div>

              </div>

              <!-- Number of Records -->
              <div class="row align-items-center mt-3">
                  <div class="col-auto">
                      <div class="d-block d-lg-flex align-items-center gap-2">
                          <input class="form-check-input" type="checkbox" name="num_records_mwpd_processing" id="num_records_mwpd_processing" value="num_records_mwpd_processing">
                          <label class="form-check-label fw-semibold" for="num_records_mwpd_processing">
                              Number of Records Retrieved/Printed:
                          </label>
                      </div>
                  </div>
                  <div class="col">
                      <input type="text" name="num_records_specify_mwpd_processing" class="form-control form-control-sm">
                  </div>
              </div>

              <!-- Remarks -->
              <div class="mt-3">
                  <span class="fw-semibold me-2">Remarks:</span>
                  <span class="me-1">Reason if target PCT is not achieved:</span>

                  <div class="row flex-wrap align-items-center mt-2">
                      <div class="col-md-12 form-check">
                          <input class="form-check-input" type="radio" name="server_error_mwpd_processing" id="server_error_mwpd_processing" value="server_error_mwpd_processing">
                          <label class="form-check-label" for="server_error_mwpd_processing">Server Error</label>
                      </div>
                      <div class="col-md-12 form-check">
                          <input class="form-check-input" type="radio" name="remarkprint_error_mwpd_processing_reason" id="print_error_mwpd_processing" value="print_error_mwpd_processing">
                          <label class="form-check-label" for="print_error_mwpd_processing">Printer Error</label>
                      </div>
                      <div class="col-md-12 form-check">
                          <input class="form-check-input" type="radio" name="reverify_mwpd_processing" id="reverify_mwpd_processing" value="reverify_mwpd_processing">
                          <label class="form-check-label" for="reverify_mwpd_processing">
                              Re-verification (due to wrong spelling of name, change of name, etc.)
                          </label>
                      </div>
                      <div class="col-md-12 form-check">
                          <div class="d-flex align-items-center gap-1">
                            <input class="form-check-input" type="radio" name="remarks_others_mwpd_processing" id="remarks_others_mwpd_processing" value="remarks_others_mwpd_processing">
                            <label class="form-check-label" for="rem_others">Others </label>
                            <input type="text" name="remarks_others_specify_mwpd_processing" class="form-control form-control-sm" style="width: 100%;">
                          </div>
                          
                      </div>
                  </div>

              </div>
          </div>
        </div> 


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Go Back & Edit</button>
                <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Confirm & Submit</button>
              </div>
            </div>
          </div>
        </div>




      </div>

      
                      
    </form>


  <script>
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');

    document.getElementById("time_received_mwpd_processing").value = `${hours}:${minutes}`;

    document.getElementById('openReviewModalBtn').addEventListener('click', function () {
        const modal = new bootstrap.Modal(document.getElementById('reviewModal'));
        modal.show();
    });

    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        document.querySelector('form[method="POST"]').submit();
    });


   
</script>
@endsection