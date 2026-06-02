@extends('layouts.app')
@section('content')
  <style>
    body {
      background-color: #f4f4f4;
      /* font-family: 'Assistant', Arial, sans-serif; */
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

    .btn-confirm{
      background-color: hsl(220, 49%, 51%);
      color: #fff;
    }
    .btn-confirm:hover {
      background-color: hsl(220, 49%, 55%);
      color: #fff;
    }

 
  </style>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
 
  <div class="container my-5" style="font-family: 'Assistant', Arial, sans-serif;" data-request-id="{{ $request->id }}">

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

    <div class="form-section">
      <h5>A. IMPORMASYON NG OFW</h5>
        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control disabled" name="ofw_lname" value="{{ $ofw->ofw_lname }}" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control disabled" name="ofw_fname" value="{{ $ofw->ofw_fname }}" required>
          </div>
          <div class="col-md-2">
            <label class="form-label">Name Ext.</label>
            <input type="text" class="form-control disabled" name="ofw_ename" value="{{ $ofw->ofw_ename }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control disabled" name="ofw_mname" value="{{ $ofw->ofw_mname }}">
          </div>
        </div>



        <div class="row g-3 mb-3">

          <div class="col-12 col-md-4">
            <label class="form-label">Passport No.</label>
            <input type="text" class="form-control disabled" name="ofw_passport_no" placeholder="ex. 123456789" value="{{ $ofw->ofw_passport_no }}">
          </div>

          <div class="col-6 col-md-4">
            <label class="form-label">Sex</label>
            <input type="text" class="form-control disabled" value="{{ $ofw->ofw_gender}}">
          </div>

          <div class="col-6 col-md-4">
              <label class="form-label">Civil Status</label>
              <input type="text" class="form-control disabled" value="{{ $ofw->ofw_civil_status }}">
          </div>

        </div>

        <div class="row g-3 mb-3">

          <div class="col-12 col-md-4">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control disabled" name="ofw_email" placeholder="ex. sample@email.com" value="{{ $ofw->ofw_email }}">
          </div>

          <div class="col-6 col-md-4">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control disabled" name="ofw_phone" placeholder="ex. 09123456768" value="{{ $ofw->ofw_phone }}">
          </div>
            
          <div class="col-6 col-md-4">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control disabled" name="ofw_bday" value="{{ $ofw->ofw_bday }}">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-6 col-md-3">
            <label class="form-label">Agency</label>
            <input type="text" class="form-control disabled" name="ofw_agency " value="{{ $ofw->ofw_agency }}" required>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">Employer</label>
            <input type="text" class="form-control disabled" name="ofw_employer" value="{{ $ofw->ofw_employer }}" required>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">Bansa</label>
            <input type="text" class="form-control disabled" name="ofw_country_name" id="country_name" value="{{ $ofw->ofw_country }}">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">Trabaho</label>
            <input type="text" class="form-control disabled" name="ofw_job" value="{{ $ofw->ofw_job }}" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address in the Philippines</label>
          <input type="text" class="form-control mb-2 disabled" name="ofw_house_no" value="{{ $ofw_address->house_no }}" required>
          <div class="row g-3">
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="ofw_province_name" id="ofw_province_name" value="{{ $ofw_address->province }}">
            </div>
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ $ofw_address->municipality }}">
            </div>
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ $ofw_address->brgy }}">
            </div>
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="ofw_zip_code" value="{{ $ofw_address->zip_code }}" 
                            minlength="4" maxlength="4" pattern="\d{4}" inputmode="numeric" required>
            </div>
          </div>
        </div>
    </div>

    <!-- Section A -->
    <div class="form-section">
      <h5>B. IMPORMASYON NG HUMIHILING (Kung hindi OFW ang humihiling)</h5>

        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control disabled" name="party_lname" value="{{ $party->party_lname ?? '' }}" required>
          </div>
          <div class="col-md-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control disabled" name="party_fname" value="{{ $party->party_fname ?? '' }}" required>
          </div>
          <div class="col-md-2">
            <label class="form-label">Name Ext.</label>
            <input type="text" class="form-control disabled" name="party_ename" value="{{ $party->party_ename ?? ''   }}">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control disabled" name="party_mname" value="{{ $party->party_mname ?? '' }}">
          </div>
        </div>

        <div class="row g-3 mb-3">

          <div class="col-6 col-md-3">
            <label class="form-label">Birthday</label>
            <input type="date" class="form-control disabled" name="party_bday" value="{{ $party->party_bday ?? '' }}" required>
          </div>

          <div class="col-6 col-md-3">
            <label class="form-label">Sex</label>
            <input type="text" class="form-control disabled" value="{{ $party->party_gender ?? '' }}">
          </div>

          <div class="col-md-6">
            <label class="form-label">Relationship to OFW</label>
            <input type="text" class="form-control disabled" name="party_relationship" value="{{ $party->party_relationship ?? '' }}" required>
          </div>

        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control disabled" name="party_phone" value="{{ $party->party_phone ?? '' }}" required>
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control disabled" name="party_email" value="{{ $party->party_email ?? '' }}" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address in the Philippines</label>
          <input type="text" class="form-control mb-2 disabled" name="party_house_no" value="{{ $party_address->house_no ?? '' }}" required>
          <div class="row g-3">
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="party_province_name" id="party_province_name" value="{{ $party_address->province ?? '' }}">
            </div>
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="party_municipality_name" id="party_municipality_name" value="{{ $party_address->municipality ?? '' }}">
            </div>
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="party_barangay_name" id="party_barangay_name" value="{{ $party_address->brgy ?? '' }}">
            </div>
            <div class="col-6 col-md-3">
              <input type="text" class="form-control disabled" name="zip_code" value="{{ $party_address->zip_code ?? '' }}" 
                            minlength="4" maxlength="4" pattern="\d{4}" inputmode="numeric" required>
            </div>
          </div>
        </div>
    </div>

    

    <div class="form-section">
        <div class="mb-3">
            <h5>C. PALIWANAG NG HILING (Nature of Request)</h5>
                <p class="mb-3">Ilahad dito ang maikling paliwanag kung anong uri ng tulong ang inyong hinihingi, kasama ang mahahalagang detalye tulad ng dahilan, kailan at saan ito kinakailangan.</p>
                <textarea class="form-control" rows="7" placeholder="Text here..." name="nature_of_request" disabled>{{ $request->nature_of_request }}</textarea>
        </div>
    </div>

    @if($request->status == 'NEW_SUBMISSION')
      
        <div class="d-grid gap-2">
            <button type="button" id="nextButton" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Next</button>
        </div>
        
    @else
        <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">New Submission</h4>
            <p>This request has been submitted and is awaiting review. Please check back later for updates on the status of this request.</p>
        </div> 
    @endif
   
    <!-- Forms selection modal -->
    <div class="modal fade" id="formsSelectionModal" tabindex="-1" aria-labelledby="formsSelectionModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background-color: hsl(220, 49%, 51%); color: white;">
            <h5 class="modal-title" id="formsSelectionModalLabel">Choose Forms to Fill</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p class="mb-3">Please select the form(s) that the client will fill out next.</p>
            <div class="row g-3">
              <div class="col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="REQUEST FOR ASSISTANCE (RFA) FORM" id="formOptionRfa">
                  <label class="form-check-label" for="formOptionRfa">REQUEST FOR ASSISTANCE (RFA) FORM</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS" id="formOptionProcessing">
                  <label class="form-check-label" for="formOptionProcessing">REQUEST FOR VERIFICATION / CERTIFICATION OF OFW RECORDS</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="SINGLE-ENTRY APPROACH (SENA)" id="formOptionSena">
                  <label class="form-check-label" for="formOptionSena">SINGLE-ENTRY APPROACH (SENA)</label>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="ENHANCED LIVEHOOD PROGRAM FOR OFW REINTEGRATION (ELPOR) APPLICATION FORM" id="formOptionElpor">
                  <label class="form-check-label" for="formOptionElpor">ENHANCED LIVEHOOD PROGRAM FOR OFW REINTEGRATION (ELPOR) APPLICATION FORM</label>
                </div>
              </div>
            </div>
            <div id="selectedFormsSummary" class="mt-4" style="display:none;">
              <h6 class="mb-2">Selected forms:</h6>
              <ul class="list-group" id="selectedFormsList"></ul>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-confirm" id="confirmFormSelectionButton">Confirm Selection</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Full-screen Loader Overlay -->
    <div id="submissionLoader" style="display:none; position:fixed; inset:0; z-index:9999; background:rgba(255,255,255,0.92); backdrop-filter:blur(4px); flex-direction:column; align-items:center; justify-content:center;">
      <div style="background:#fff; border-radius:16px; box-shadow:0 8px 40px rgba(0,0,0,0.13); padding:2.5rem 3rem; text-align:center; max-width:380px; width:90%;">
        
        <!-- Spinner -->
        <div style="margin-bottom:1.5rem;">
          <div id="loaderSpinner" style="width:64px;height:64px;border:5px solid #e2e8f0;border-top-color:hsl(220,49%,51%);border-radius:50%;animation:spin 0.85s linear infinite;margin:0 auto;"></div>
          <div id="loaderCheckmark" style="display:none; width:64px;height:64px;margin:0 auto;">
            <svg viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:64px;height:64px;">
              <circle cx="32" cy="32" r="30" fill="#2d7a2d" opacity="0.1"/>
              <circle cx="32" cy="32" r="30" stroke="#2d7a2d" stroke-width="4" fill="none" stroke-dasharray="188" stroke-dashoffset="0"/>
              <polyline points="18,33 28,43 46,22" stroke="#2d7a2d" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none" style="stroke-dasharray:50;stroke-dashoffset:0;animation:drawCheck 0.4s ease forwards;"/>
            </svg>
          </div>
        </div>

        <!-- Step label -->
        <h5 id="loaderTitle" style="font-family:'Assistant',sans-serif;font-weight:700;color:#1a202c;margin-bottom:0.5rem;">Saving Records</h5>
        <p id="loaderDesc" style="font-family:'Assistant',sans-serif;font-size:0.9rem;color:#64748b;margin-bottom:1.5rem;">Please wait while we record the selected forms...</p>

        <!-- Step indicators -->
        <div style="display:flex;align-items:center;justify-content:center;gap:0.5rem;">
          <div class="loader-step" id="step1" style="display:flex;align-items:center;gap:0.35rem;font-size:0.78rem;font-family:'Assistant',sans-serif;color:#94a3b8;">
            <span id="step1Icon" style="width:18px;height:18px;border-radius:50%;background:#e2e8f0;display:inline-flex;align-items:center;justify-content:center;font-size:0.65rem;">1</span>
            <span>Saving</span>
          </div>
          <div style="width:28px;height:2px;background:#e2e8f0;border-radius:2px;"></div>
          <div class="loader-step" id="step2" style="display:flex;align-items:center;gap:0.35rem;font-size:0.78rem;font-family:'Assistant',sans-serif;color:#94a3b8;">
            <span id="step2Icon" style="width:18px;height:18px;border-radius:50%;background:#e2e8f0;display:inline-flex;align-items:center;justify-content:center;font-size:0.65rem;">2</span>
            <span>Sending Email</span>
          </div>
          <div style="width:28px;height:2px;background:#e2e8f0;border-radius:2px;"></div>
          <div class="loader-step" id="step3" style="display:flex;align-items:center;gap:0.35rem;font-size:0.78rem;font-family:'Assistant',sans-serif;color:#94a3b8;">
            <span id="step3Icon" style="width:18px;height:18px;border-radius:50%;background:#e2e8f0;display:inline-flex;align-items:center;justify-content:center;font-size:0.65rem;">3</span>
            <span>Done</span>
          </div>
        </div>
      </div>
    </div>

    <style>
      @keyframes spin { to { transform: rotate(360deg); } }
      @keyframes drawCheck { from { stroke-dashoffset: 50; } to { stroke-dashoffset: 0; } }
    </style>

  </div>

  <!-- Bootstrap JS -->


  <script>
      document.addEventListener('DOMContentLoaded', function () {
        var nextButton = document.getElementById('nextButton');
        var confirmButton = document.getElementById('confirmFormSelectionButton');
        var modalElement = document.getElementById('formsSelectionModal');
        var formsSelectionModal = new bootstrap.Modal(modalElement);

        nextButton.addEventListener('click', function () {
          formsSelectionModal.show();
        });

        confirmButton.addEventListener('click', function () {
          var selected = Array.from(modalElement.querySelectorAll('input[type="checkbox"]'))
            .filter(cb => cb.checked)
            .map(cb => cb.value);

          if (selected.length === 0) {
            alert('Please choose at least one form to continue.');
            return;
          }

          // Close modal first, then show loader
          formsSelectionModal.hide();
          modalElement.addEventListener('hidden.bs.modal', function onHidden() {
            modalElement.removeEventListener('hidden.bs.modal', onHidden);
            showLoader();
            updateNewSubmission(selected);
          });
        });
      });

      // --- Loader helpers ---
      function showLoader() {
        document.getElementById('submissionLoader').style.display = 'flex';
        setStep(1, 'active');
      }

      function setStep(stepNum, state) {
        // state: 'active' | 'done'
        const el = document.getElementById('step' + stepNum + 'Icon');
        if (state === 'active') {
          el.style.background = 'hsl(220,49%,51%)';
          el.style.color = '#fff';
          document.getElementById('step' + stepNum).style.color = 'hsl(220,49%,51%)';
        } else if (state === 'done') {
          el.style.background = '#2d7a2d';
          el.style.color = '#fff';
          el.textContent = '✓';
          document.getElementById('step' + stepNum).style.color = '#2d7a2d';
        }
      }

      function setLoaderMessage(title, desc) {
        document.getElementById('loaderTitle').textContent = title;
        document.getElementById('loaderDesc').textContent = desc;
      }

      function showSuccess(redirectUrl) {
        document.getElementById('loaderSpinner').style.display = 'none';
        document.getElementById('loaderCheckmark').style.display = 'block';
        setStep(1, 'done');
        setStep(2, 'done');
        setStep(3, 'done');
        setLoaderMessage('All Done!', 'Redirecting you now...');
        setTimeout(() => { window.location.href = redirectUrl; }, 1800);
      }

      // --- API call ---
      function updateNewSubmission(selectedForms) {
        const requestId = parseInt(document.querySelector('.container').dataset.requestId);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Step 1: Saving
        setLoaderMessage('Saving Records', 'Recording the selected forms to the database...');
        setStep(1, 'active');

        fetch(`/forms-submitted/${requestId}/updateNewSubmission`, {
          method: 'PUT',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
          },
          body: JSON.stringify({
            selected_forms: selectedForms,
            status: 'FORMS_REQUESTED'
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Step 2: Sending email
            setStep(1, 'done');
            setStep(2, 'active');
            setLoaderMessage('Sending Email', 'Notifying the client via email...');

            // Small delay to let the "sending email" state be visible
            // (your backend handles the mail; this just gives visual feedback)
            setTimeout(() => {
              setStep(2, 'done');
              setStep(3, 'active');
              setLoaderMessage('Finishing Up', 'Almost there...');

              setTimeout(() => {
                const redirectUrl = data.redirect_url || `/forms-submitted/request/${requestId}`;
                showSuccess(redirectUrl);
              }, 800);
            }, 1200);

          } else {
            hideLoaderWithError(data.message || 'Unknown error');
          }
        })
        .catch(error => {
          console.error('Error:', error);
          hideLoaderWithError('A network error occurred. Please try again.');
        });
      }

      function hideLoaderWithError(message) {
        document.getElementById('submissionLoader').style.display = 'none';
        alert('Error: ' + message);
      }
    </script>

@endsection