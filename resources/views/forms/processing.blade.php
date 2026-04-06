@extends('layouts.app')

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

    <form method="POST" action="{{ route('forms.processing.store') }}">
      @csrf
      <div class="form-section">
        <h5>FULL NAME (Pangalan ng OFW)</h5>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control" name="ofw_family_name" placeholder="Dela Cruz" id="ofw_family_name">
          </div>
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" placeholder="Juan" id="ofw_first_name">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" placeholder="Santos" id="ofw_middle_name">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Jobsite (Bansang Pinagtatrabahuhan)</label>
            <input type="text" class="form-control" name="jobsite" placeholder="ex. UAE" id="jobsite">
          </div>
          <div class="col-md-4">
            <label class="form-label">Record Needed - Year (Kailangang Record - Taon)</label>
            <input type="text" class="form-control" name="record_year" placeholder="ex. 2024" id="record_year">
          </div>
          <div class="col-md-4">
            <label class="form-label">Purpose (Saan gagamitin ang kinakuhang record)</label>
            <input type="text" class="form-control" name="purpose" placeholder="ex. Employment Verification" id="purpose">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Name of Agency</label>
          <input type="text" class="form-control" name="agency_name" placeholder="ex. ABC Agency" id="agency_name">
        </div>
    </div>

    <div class="form-section">
      <h5>FOR THE REQUESTING PARTY (Ang Kumukuha ng Record ay hindi mismong OFW)</h5>
        <div class="row g-3 mb-3">
          <div class="col-md-4">
            <label class="form-label">Surname</label>
            <input type="text" class="form-control" name="req_family_name" placeholder="Dela Cruz" id="req_family_name">
          </div>
          <div class="col-md-4">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="req_first_name" placeholder="Juan" id="req_first_name">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="req_middle_name" placeholder="Santos" id="req_middle_name">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Relationship to OFW</label>
            <input type="text" class="form-control" name="relationship_ofw" placeholder="ex. Brother" id="relationship_ofw">
          </div>
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contact_number" placeholder="ex. 09123456789" id="contact_number">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Complete Address in the Philippines</label>
          <input type="text" class="form-control mb-2" name="phil_address" placeholder="Unit/Room/House Number/Street name" id="phil_address">

          <div class="row g-3">
            <div class="col-md-3">
              <select class="form-select" name="province" id="province">
                <option selected disabled>Province</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="municipality" id="municipality" disabled>
                <option selected disabled>City / Municipality</option>
              </select>
            </div>
            <div class="col-md-3">
              <select class="form-select" name="barangay" id="barangay" disabled>
                <option selected disabled>Barangay</option>
              </select>
            </div>
            <div class="col-md-3">
              <input type="text" class="form-control" name="zipcode" placeholder="ex. 2016" id="zipcode">
            </div>
          </div>

          <div class="row g-3 mt-2">
            <div class="col-md-6">
              <label class="form-label">Telephone Number</label>
              <input type="text" class="form-control" name="telephone_number" placeholder="ex. (045) 123-4567" id="telephone_number">
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="email_address" placeholder="ex. sample@email.com" id="email_address">
            </div>
          </div>
        </div>
    </div>

    <div class="form-section" style="background-color: rgba(219, 232, 255, 0.95);">
      <h5 class="text-center fw-bold">Do not fill out this portion: FOR POEA PERSONNEL ONLY</h5>

      <div class="row g-3 mb-3">
        <div class="col-md-4">
          <label class="form-label">Time Received</label>
          <input type="time" class="form-control" name="time_received">
        </div>
        <div class="col-md-4">
          <label class="form-label">Time Released</label>
          <input type="time" class="form-control" name="time_released">
        </div>
        <div class="col-md-4">
          <label class="form-label">Total PCT</label>
          <input type="text" class="form-control" name="total_pct" placeholder="00:00:00">
        </div>
      </div>

      <div class="mb-3">
        <div class="row align-items-center mb-2">
          <div class="col-md-3 fw-bold">Worker Category</div>
          <div class="col-md-9">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="worker_category[]" value="landbased" id="wc_landbased">
              <label class="form-check-label" for="wc_landbased">Landbased (Newhire)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="worker_category[]" value="rehire" id="wc_rehire">
              <label class="form-check-label" for="wc_rehire">Rehire (Balik Manggaagawa)</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="worker_category[]" value="seafarer" id="wc_seafarer">
              <label class="form-check-label" for="wc_seafarer">Seafarer</label>
            </div>
          </div>
        </div>

        <div class="row align-items-center mb-2">
          <div class="col-md-3 fw-bold">Processing Site</div>
          <div class="col-md-9">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="processing_site[]" value="central_office" id="ps_central">
              <label class="form-check-label" for="ps_central">Central Office</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="processing_site[]" value="regional_office" id="ps_regional">
              <label class="form-check-label" for="ps_regional">Regional Office</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="processing_site[]" value="polo" id="ps_polo">
              <label class="form-check-label" for="ps_polo">POLO</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="processing_site[]" value="inhouse" id="ps_inhouse">
              <label class="form-check-label" for="ps_inhouse">In-house</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="processing_site[]" value="lac" id="ps_lac">
              <label class="form-check-label" for="ps_lac">LAC</label>
            </div>
          </div>
        </div>

        <div class="row align-items-center mb-2">
          <div class="col-md-3 fw-bold">Requested Record</div>
          <div class="col-md-9">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="requested_record[]" value="information_sheet" id="rr_info">
              <label class="form-check-label" for="rr_info">Information Sheet</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="requested_record[]" value="employment_contract" id="rr_contract">
              <label class="form-check-label" for="rr_contract">Employment Contract</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="requested_record[]" value="oec" id="rr_oec">
              <label class="form-check-label" for="rr_oec">OEC</label>
            </div>
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-2 fw-bold">Year/s</div>
          <div class="col-md-10">
            <input type="text" class="form-control" name="requested_year" placeholder="Enter Year(s)">
          </div>
        </div>

        <div class="mb-3">
          <div class="fw-bold mb-1">Purpose of Request</div>
          <div class="row g-2">
            <div class="col-md-4">
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="complaint_legal" id="purpose_complaint"><label class="form-check-label" for="purpose_complaint">Complaint/Legal Action</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="welfare" id="purpose_welfare"><label class="form-check-label" for="purpose_welfare">Welfare Assistance</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="validation_bm" id="purpose_validation_bm"><label class="form-check-label" for="purpose_validation_bm">Validation - BM</label></div>
            </div>
            <div class="col-md-4">
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="investigation" id="purpose_investigation"><label class="form-check-label" for="purpose_investigation">Investigation</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="owwa_claims" id="purpose_owwa"><label class="form-check-label" for="purpose_owwa">OWWA Claims</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="others" id="purpose_others"><label class="form-check-label" for="purpose_others">Others</label></div>
              <input type="text" class="form-control mt-1" name="purpose_others_text" placeholder="Specify others">
            </div>
            <div class="col-md-4">
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="val_work_exp" id="purpose_val_work_exp"><label class="form-check-label" for="purpose_val_work_exp">Validation of Work Experience</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="application_loan" id="purpose_loan"><label class="form-check-label" for="purpose_loan">Application for Loan</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="purpose_request[]" value="prc" id="purpose_prc"><label class="form-check-label" for="purpose_prc">PRC</label></div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div class="fw-bold mb-1">Documents Presented</div>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="form-check"><input class="form-check-input" type="checkbox" name="documents_presented[]" value="company_id" id="doc_company_id"><label class="form-check-label" for="doc_company_id">Company ID, Passport, SSRB, NBI, SSS, etc.</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="documents_presented[]" value="authorization_spa" id="doc_spa"><label class="form-check-label" for="doc_spa">Authorization / SPA</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="documents_presented[]" value="others" id="doc_others"><label class="form-check-label" for="doc_others">Others</label></div>
              <input type="text" class="form-control mt-1" name="documents_others_text" placeholder="Specify others">
            </div>
            <div class="col-md-6">
              <div class="form-check"><input class="form-check-input" type="checkbox" name="documents_presented[]" value="marriage_contract" id="doc_marriage"><label class="form-check-label" for="doc_marriage">Marriage Contract</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="documents_presented[]" value="birth_certificate" id="doc_birth"><label class="form-check-label" for="doc_birth">Birth Certificate</label></div>
              <div class="form-check"><input class="form-check-input" type="checkbox" name="documents_presented[]" value="letter_request" id="doc_letter"><label class="form-check-label" for="doc_letter">Letter Request</label></div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <div class="fw-bold mb-1">Action Taken</div>
          <div class="form-check"><input class="form-check-input" type="checkbox" name="action_taken[]" value="ofw_record_released" id="action_released"><label class="form-check-label" for="action_released">OFW Record Released</label></div>
          <div class="form-check form-check-inline ms-4"><input class="form-check-input" type="radio" name="release_type" value="printout" id="at_printout"><label class="form-check-label" for="at_printout">Print-out</label></div>
          <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="release_type" value="copy_original" id="at_copy_original"><label class="form-check-label" for="at_copy_original">Copy of Original</label></div>
          <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="release_type" value="digital_image" id="at_digital"><label class="form-check-label" for="at_digital">Digital Image</label></div>
          <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="release_type" value="cert_no_record" id="at_cert_no"><label class="form-check-label" for="at_cert_no">Cert of No Record</label></div>

          <div class="mt-2">
            <div class="form-check"><input class="form-check-input" type="checkbox" name="action_taken[]" value="records_retrieved" id="action_printed"><label class="form-check-label" for="action_printed">Number of Records Retrieved/Printer</label></div>
            <input type="text" class="form-control mt-1" name="records_retrieved_detail" placeholder="Enter details">
          </div>

          <div class="mt-2">
            <div class="form-check"><input class="form-check-input" type="checkbox" name="action_taken[]" value="no_record" id="action_no_record"><label class="form-check-label" for="action_no_record">No Record: Request endorsed to other units for further verification</label></div>
            <div class="form-check form-check-inline ms-4"><input class="form-check-input" type="radio" name="no_record_branch" value="ict" id="no_record_ict"><label class="form-check-label" for="no_record_ict">ICT Branch</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="no_record_branch" value="roco" id="no_record_roco"><label class="form-check-label" for="no_record_roco">ROCO</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="no_record_branch" value="others" id="no_record_others"><label class="form-check-label" for="no_record_others">Others</label></div>
          </div>

          <div class="mt-2">
            <div class="form-check"><input class="form-check-input" type="checkbox" name="action_taken[]" value="for_edit_encoding" id="action_edit"><label class="form-check-label" for="action_edit">For Editing/Encoding</label></div>
            <div class="form-check form-check-inline ms-4"><input class="form-check-input" type="radio" name="edit_branch" value="ict" id="edit_ict"><label class="form-check-label" for="edit_ict">ICT Branch</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="edit_branch" value="landbased" id="edit_landbased"><label class="form-check-label" for="edit_landbased">Landbased Center</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="edit_branch" value="seabased" id="edit_seabased"><label class="form-check-label" for="edit_seabased">Seabased Center</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="edit_branch" value="others" id="edit_others"><label class="form-check-label" for="edit_others">Others</label></div>
          </div>

          <div class="mt-2">
            <div class="form-check"><input class="form-check-input" type="checkbox" name="action_taken[]" value="documents_submitted" id="action_docs"><label class="form-check-label" for="action_docs">Documents submitted for further evaluation of Supervisor</label></div>
          </div>

          <div class="mt-3">
            <div class="fw-bold">Remarks</div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="remarks" value="reverification" id="remarks_reverification"><label class="form-check-label" for="remarks_reverification">Re-verification (due to wrong spelling, change of name, etc.)</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="remarks" value="server_error" id="remarks_server"><label class="form-check-label" for="remarks_server">Server Error</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="remarks" value="printer_error" id="remarks_printer"><label class="form-check-label" for="remarks_printer">Printer Error</label></div>
            <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="remarks" value="others" id="remarks_others"><label class="form-check-label" for="remarks_others">Others</label></div>
            <input type="text" class="form-control mt-1" name="remarks_others_text" placeholder="Specify other remark">
          </div>

          <div class="mt-3 row text-center">
            <div class="col-md-3">Evaluated by:<br><input type="text" class="form-control mt-1" name="evaluated_by"></div>
            <div class="col-md-3">Verified by:<br><input type="text" class="form-control mt-1" name="verified_by"></div>
            <div class="col-md-3">Reviewed/Approved by:<br><input type="text" class="form-control mt-1" name="reviewed_by"></div>
            <div class="col-md-3">Received/Acknowledge by:<br><input type="text" class="form-control mt-1" name="received_by"></div>
          </div>

        </div>
      </div>
    </div>

    <div class="d-grid gap-2">
      <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d; color: #ffffff; box-shadow: none;">Submit Request</button>
    </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const provinceSelect = document.getElementById('province');
      const municipalitySelect = document.getElementById('municipality');
      const barangaySelect = document.getElementById('barangay');

      function resetSelect(selectEl, text) {
        selectEl.innerHTML = `<option selected disabled>${text}</option>`;
        selectEl.disabled = true;
      }

      function sortItems(items, labelKey) {
        return [...items].sort((a, b) => {
          const aVal = String(a[labelKey] || '').toLowerCase();
          const bVal = String(b[labelKey] || '').toLowerCase();
          return aVal.localeCompare(bVal, undefined, { sensitivity: 'base' });
        });
      }

      function populateSelect(selectEl, items, valueKey, labelKey) {
        const sortedItems = sortItems(items, labelKey);
        selectEl.innerHTML = `<option selected disabled>${selectEl === provinceSelect ? 'Province' : selectEl === municipalitySelect ? 'City / Municipality' : 'Barangay'}</option>`;
        sortedItems.forEach(item => {
          const option = document.createElement('option');
          option.value = item[valueKey];
          option.textContent = item[labelKey];
          selectEl.appendChild(option);
        });
        selectEl.disabled = false;
      }

      function toggleOtherInput(checkboxId, inputName) {
        const checkbox = document.getElementById(checkboxId);
        const input = document.querySelector(`[name="${inputName}"]`);
        if (!checkbox || !input) return;

        input.disabled = !checkbox.checked;
        if (!checkbox.checked) {
          input.value = '';
        }

        checkbox.addEventListener('change', () => {
          input.disabled = !checkbox.checked;
          if (!checkbox.checked) {
            input.value = '';
          }
        });
      }

      function toggleRadioGroup(checkboxId, radioName) {
        const checkbox = document.getElementById(checkboxId);
        const radios = document.querySelectorAll(`input[name="${radioName}"]`);
        if (!checkbox || !radios.length) return;

        radios.forEach(radio => {
          radio.disabled = !checkbox.checked;
          if (!checkbox.checked) {
            radio.checked = false;
          }
        });

        checkbox.addEventListener('change', () => {
          radios.forEach(radio => {
            radio.disabled = !checkbox.checked;
            if (!checkbox.checked) {
              radio.checked = false;
            }
          });
        });
      }

      toggleOtherInput('purpose_others', 'purpose_others_text');
      toggleOtherInput('doc_others', 'documents_others_text');
      toggleOtherInput('remarks_others', 'remarks_others_text');

      toggleRadioGroup('action_released', 'release_type');
      toggleRadioGroup('action_no_record', 'no_record_branch');
      toggleRadioGroup('action_edit', 'edit_branch');

      resetSelect(provinceSelect, 'Loading provinces...');
      resetSelect(municipalitySelect, 'City / Municipality');
      resetSelect(barangaySelect, 'Barangay');

      fetch('https://psgc.gitlab.io/api/provinces/')
        .then(response => response.json())
        .then(data => {
          populateSelect(provinceSelect, data, 'code', 'name');
        })
        .catch(error => {
          console.error('Error fetching provinces:', error);
          resetSelect(provinceSelect, 'Province');
        });

      provinceSelect.addEventListener('change', function() {
        const provinceCode = this.value;
        resetSelect(municipalitySelect, 'Loading municipalities...');
        resetSelect(barangaySelect, 'Barangay');

        if (!provinceCode) {
          resetSelect(municipalitySelect, 'City / Municipality');
          return;
        }

        fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
          .then(response => response.json())
          .then(data => {
            populateSelect(municipalitySelect, data, 'code', 'name');
          })
          .catch(error => {
            console.error('Error fetching municipalities:', error);
            resetSelect(municipalitySelect, 'City / Municipality');
          });
      });

      municipalitySelect.addEventListener('change', function() {
        const cityCode = this.value;
        resetSelect(barangaySelect, 'Loading barangays...');

        if (!cityCode) {
          resetSelect(barangaySelect, 'Barangay');
          return;
        }

        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
          .then(response => response.json())
          .then(data => {
            populateSelect(barangaySelect, data, 'code', 'name');
          })
          .catch(error => {
            console.error('Error fetching barangays:', error);
            resetSelect(barangaySelect, 'Barangay');
          });
      });
    });
  </script>
@endsection