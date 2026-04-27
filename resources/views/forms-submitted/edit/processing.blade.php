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

    .btn-submit {
      background-color: #4e73df;
      color: #fff;
      padding: 0.5rem 2rem;
    }

    .btn-submit:hover {
      background-color: #3f60c4;
      color: #fff;
    }

    .btn-cancel {
      background-color: #6c757d;
      color: #fff;
      padding: 0.5rem 2rem;
    }

    .btn-cancel:hover {
      background-color: #5a6268;
      color: #fff;
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

    <form action="{{ route('forms-submitted.save-edit-processing', [$request->id, $form->id]) }}" method="POST">
      @csrf
      @method('PUT')


      <div class="form-section">

        <h5>FULL NAME (Pangalan ng OFW)</h5>
        <div class="row g-3 mb-3">

          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control" name="ofw_lname" id="ofw_lname" value="{{ $ofw->ofw_lname ?? '' }}">
          </div>

          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="ofw_fname" id="ofw_fname" value="{{ $ofw->ofw_fname ?? '' }}">
          </div>

          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="ofw_mname" id="ofw_mname" value="{{ $ofw->ofw_mname ?? '' }}">
          </div>

        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Jobsite (Bansang Pinagtatrabahuhan)</label>
            <input type="text" class="form-control" name="ofw_country_name" id="jobsite" value="{{ $ofw->ofw_country ?? '' }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Record Needed - Year (Kailangang Record - Taon)</label>
            <input type="text" class="form-control" name="record_needed_mwpd_processing" id="records_needed" value="{{ $entries['record_needed_mwpd_processing'] ?? '' }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Purpose (Saan gagamitin ang kinakuhang record)</label>
            <input type="text" class="form-control" name="record_purpose_mwpd_processing" id="record_purpose" value="{{ $entries['record_purpose_mwpd_processing'] ?? '' }}">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Name of Agency</label>
          <input type="text" class="form-control" name="ofw_agency" id="ofw_agency" value="{{ $ofw->ofw_agency ?? '' }}">
        </div>
    </div>
    <div class="form-section">
      <h5>FOR THE REQUESTING PARTY (Ang Kumukuha ng Record ay hindi mismong OFW)</h5>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control" name="party_lname" id="req_family_name" value="{{ $party->party_lname ?? '' }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="party_fname" id="req_first_name" value="{{ $party->party_fname ?? '' }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="party_mname" id="req_middle_name" value="{{ $party->party_mname ?? '' }}">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Relationship to OFW</label>
            <input type="text" class="form-control" name="party_relationship" id="relationship_ofw" value="{{ $party->party_relationship ?? '' }}">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="party_phone" id="contact_number" value="{{ $party->party_phone ?? '' }}">
          </div>
        </div>

        <div class="mb-3 mt-4">
          <label class="form-label"> <strong>Complete Address in the Philippines</strong> </label> 
          <div class="m-0 p-0">
            <label class="form-label">House Number/Street name</label>
            <input type="text" class="form-control mb-2" name="party_house_no" id="phil_address" value="{{ $party_address->house_no ?? '' }}">
          </div>
          

          <div class="row g-3">
            <div class="col-md-3">
              <label class="form-label">Province</label>
              <input type="text" class="form-control" name="party_province_name" id="party_province_name" value="{{ $party_address->province ?? '' }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">City/Municipality</label>
              <input type="text" class="form-control" name="party_municipality_name" id="party_municipality_name" value="{{ $party_address->municipality ?? '' }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Barangay</label>
              <input type="text" class="form-control" name="party_barangay_name" id="party_barangay_name" value="{{ $party_address->brgy ?? '' }}">
            </div>
            <div class="col-md-3">
              <label class="form-label">Zip Code</label>
              <input type="text" class="form-control" name="party_zip_code" id="party_zip_code" value="{{ $party_address->zip_code ?? '' }}">
            </div>
          </div>

          <div class="row g-3 mt-2">
            <div class="col-md-6">
              <label class="form-label">Telephone Number</label>
              <input type="text" class="form-control" name="telephone_mwpd_processing"  id="telephone_number" value="{{ $entries['telephone_mwpd_processing'] ?? '' }}">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="party_email" id="party_email" value="{{ $party->party_email ?? '' }}">
            </div>
          </div>
        </div>
    </div>

    <!-- ACTION BUTTONS -->
    <div class="d-flex justify-content-end gap-3 mb-5">
        <a href="{{ route('forms-submitted.show', $request->id) }}" class="btn btn-cancel">
            Cancel
        </a>
        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmEditModal">
            Update Form
        </button>
    </div>

    <!-- Confirm Edit Modal -->
    <div class="modal fade" id="confirmEditModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-warning">
                    <h5 class="modal-title">
                        Confirm Update
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <p class="mb-2">
                        You are about to modify <strong>sensitive information</strong>.
                    </p>

                    <p class="text-muted small">
                        Please make sure all details are correct before proceeding.
                        This action will update the OFW and Request Party records.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-warning">
                        Yes, Update Information
                    </button>
                </div>

            </div>
        </div>
    </div>

    </form>

</div>
    
@endsection