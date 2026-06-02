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
      overflow-x: hidden;
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

    .pagination .completed .page-link {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }

    .pagination .active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .page-item.completed .page-link {
        /* background-color: #6c757d;
        color: white; */
        background-color: white;
        border-color: #DEE2E6;
        color: #0d6efd;

    }

    .page-item.active .page-link {
        background-color: #0d6efd; /* blue for current step */
        color: white;
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

    <div class="form-header text-center">
      <h4 class="fw-bold">REQUEST FOR VERIFICATION/CERTIFICATION OF OFW RECORDS</h4>
      <p>
        Gamitin ang form na ito para humingi ng tulong. Siguraduhing tama at kumpleto ang lahat ng impormasyon ilalagay upang maproseso agad ng aming team ang inyong request.
      </p>
      <small>
        Regional Office Contact Details: (045) 963-4394 | (045) 455-0832 | pampanga@dmw.gov.ph | www.ro3.dmw.gov.ph
      </small>
    </div>

    <form method="POST" action="">
      @csrf
      <div class="form-section">
        <h5>FULL NAME (Pangalan ng OFW)</h5>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control disabled" name="ofw_lname" placeholder="Dela Cruz" id="ofw_lname" value="{{ old('ofw_lname') }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control disabled" name="ofw_fname" placeholder="Juan" id="ofw_fname" value="{{ old('ofw_fname') }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control disabled" name="ofw_mname" placeholder="Santos" id="ofw_mname" value="{{ old('ofw_mname') }}">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Jobsite (Bansang Pinagtatrabahuhan)</label>
            <input type="text" class="form-control disabled" name="ofw_country_name" id="ofw_country_name" value="{{ old('ofw_country_name') }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Record Needed - Year (Kailangang Record - Taon)</label>
            <input type="text" class="form-control" name="record_needed_mwpd_protection" placeholder="ex. 2024" id="record_needed_mwpd_protection" value="{{ session('forms.data.ofw_info_sheet_mwpd_protection.record_needed_mwpd_protection') }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Purpose (Saan gagamitin ang kinakuhang record)</label>
            <input type="text" class="form-control" name="record_purpose_mwpd_protection" placeholder="ex. Employment Verification" id="record_purpose_mwpd_protection" value="{{ session('forms.data.ofw_info_sheet_mwpd_protection.record_purpose_mwpd_protection') }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Name of Agency</label>
          <input type="text" class="form-control disabled" name="ofw_agency" placeholder="ex. ABC Agency" id="ofw_agency" value="{{ old('ofw_agency') }}">
        </div>
      </div>

      <div class="form-section">
        <h5>FOR THE REQUESTING PARTY (Ang Kumukuha ng Record ay hindi mismong OFW)</h5>
          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label">Surname</label>
              <input type="text" class="form-control disabled" name="party_lname" placeholder="Dela Cruz" id="party_lname" value="{{ old('party_lname') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control disabled" name="party_fname" placeholder="Juan" id="party_fname" value="{{ old('party_fname') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control disabled" name="party_mname" placeholder="Santos" id="party_mname" value="{{ old('party_mname') }}">
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Relationship to OFW</label>
              <input type="text" class="form-control disabled" name="party_relationship" placeholder="ex. Brother" id="relationship_ofw" value="{{ old('party_relationship') }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Contact Number</label>
              <input type="text" class="form-control disabled" name="party_phone" placeholder="ex. 09123456789" id="contact_number" value="{{ old('party_phone') }}">
            </div>
          </div>

          <div class="mb-3 mt-4">
            <label class="form-label"> <strong>Complete Address in the Philippines</strong> </label> 
            <div class="m-0 p-0">
              <label class="form-label">House Number/Street name</label>
              <input type="text" class="form-control disabled" name="ofw_address_street" placeholder="Unit/Room/House Number/Street name" id="address_street" value="{{ old('ofw_address_street') }}">
            </div>
            

            <div class="row g-3">
              <div class="col-md-3">
                <label class="form-label">Province</label>
                <input type="text" class="form-control disabled" name="ofw_province_name" id="party_province_name" value="{{ old('ofw_province_name') }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">City/Municipality</label>
                <input type="text" class="form-control disabled" name="ofw_municipality_name" id="party_municipality_name" value="{{ old('ofw_municipality_name') }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">Barangay</label>
                <input type="text" class="form-control disabled" name="ofw_barangay_name" id="party_barangay_name" value="{{ old('ofw_barangay_name') }}">
              </div>
              <div class="col-md-3">
                <label class="form-label">Zip Code</label>
                <input type="text" class="form-control disabled" name="ofw_zip_code" placeholder="ex. 2016" id="zipcode" value="{{ old('ofw_zip_code') }}">
              </div>
            </div>

            <div class="row g-3 mt-2">
              <div class="col-md-6">
                <label class="form-label">Telephone Number</label>
                <input type="text" class="form-control" name="telephone_mwpd_protection" placeholder="ex. (045) 123-4567" id="telephone_mwpd_protection" value="{{ session('forms.data.ofw_info_sheet_mwpd_protection.telephone_mwpd_protection') }}">
              </div>
              <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control disabled" name="party_email" placeholder="ex. sample@email.com" id="party_email" value="{{ old('party_email') }}">
              </div>
            </div>
          </div>
      </div>
      <div class="d-grid gap-2 mt-4">
          <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Submit</button>
      </div>


    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    
  </script>
@endsection