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

    .btn-confirm {
        background-color: #2F5BB7;
        border-color: #2F5BB7;
        color: #fff;
    }

    .btn-confirm:hover {
        background-color: #24448f;
        border-color: #24448f;
        color: #fff;
    }
</style>

<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">



<div class="container my-5">

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
    <!-- Header Section -->
    <div class="form-header text-center">
        <h4>Agarang Kalinga at Saklolo para sa mga OFW's na Nangangailangan (AKSYON)</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>

    <form id="rfaForm" action="{{ route('forms-submitted.save-edit-aksyon', [$request->id, $formId]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-section mb-5">
            <h5 class="fw-bold mb-4">OFW's PERSONAL INFORMATION</h5>

            <div class="aksyon-section-content">
                <!-- Pangalan ng OFW -->
                <div class="mb-3"> 
                    <h6 class="fw-bold mb-3">Pangalan ng OFW</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control disabled" name="ofw_lname" value="{{ $ofw->ofw_lname }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control disabled" name="ofw_fname" value="{{ $ofw->ofw_fname }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Name extension</label>
                            <input type="text" class="form-control disabled" name="ofw_ename" value="{{ $ofw->ofw_ename }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control disabled" name="ofw_mname" value="{{ $ofw->ofw_mname }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Birthday, Sex, Civil Status -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Birthday</label>
                        <input type="date" class="form-control disabled" name="ofw_bday" value="{{ $ofw->ofw_bday }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control disabled" name="aksyon_ofw_age" value="{{ $entries['aksyon_ofw_age'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control disabled" name="ofw_gender" value="{{ $ofw->ofw_gender }}" readonly>
                    </div>
                    
                </div>

                <!-- Address in the Philippines -->
                <div class="mb-3">
                    <h6 class="fw-bold mb-3">Address in the Philippines</h6>
                    <div class="mb-2">
                        <label class="form-label">Unit/Room/House Number/Street name</label>
                        <input type="text" class="form-control disabled" name="ofw_house_no" value="{{ $ofw_address->house_no }}" readonly>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control disabled" name="ofw_province_name" id="ofw_province_name" value="{{ $ofw_address->province }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">City/ Municipality</label>
                            <input type="text" class="form-control disabled" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ $ofw_address->municipality }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Barangay</label>
                            <input type="text" class="form-control disabled" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ $ofw_address->brgy }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control disabled" id="ofw_zipcode" name="ofw_zip_code" value="{{ $ofw_address->zip_code }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Contact Number, Email, Facebook -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control disabled" name="ofw_phone" value="{{ $ofw->ofw_phone }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control disabled" name="ofw_email" value="{{ $ofw->ofw_email }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Facebook/Messenger Acc.</label>
                        <input type="text" class="form-control disabled" placeholder="ex. Juan Dela Cruz" name="ofw_fb_acc" value="{{ $ofw->ofw_fb_acc }}" readonly>
                    </div>
                </div>

                <!-- Passport and Return Date -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Pinakahuling Petsa ng Pag-alis sa Pilipinas</label>
                        <input type="date" class="form-control" placeholder="" name="aksyon_latest_date_departure_ph" value="{{ $entries['aksyon_latest_date_departure_ph'] ?? '' }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pinakahuling Petsa ng Pagbalik sa Pilipinas</label>
                        <input type="date" class="form-control" name="aksyon_latest_date_return_ph" value="{{ $entries['aksyon_latest_date_return_ph'] ?? '' }}">
                    </div>
                </div>

                <!-- Years and Jobsite -->
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label">Jobsite / Bansang Pinagtatrabahuhan</label>
                        <input type="text" class="form-control" name="aksyon_jobsite" id="aksyon_jobsite" value="{{ $entries['aksyon_jobsite'] ?? '' }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Job Position</label>
                        <input type="text" class="form-control" placeholder="Factory Worker" name="aksyon_job_position" value="{{ $entries['aksyon_job_position'] ?? '' }}">
                    </div>
                </div>

                <!-- OWWA and Return Reason -->
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Kadahilanan ng Pagbalik sa Pilipinas</label>
                        <select class="form-select" name="aksyon_return_reason" id="aksyon_return_reason">
                            <option selected disabled>Select</option>
                            <option value="Natapos ang Kontrata" {{ $entries['aksyon_return_reason'] == 'Natapos ang Kontrata' ? 'selected' : '' }}>Natapos ang Kontrata</option>
                            <option value="Dahilan sa Kalusugan" {{ $entries['aksyon_return_reason'] == 'Dahilan sa Kalusugan' ? 'selected' : '' }}>Dahilan sa Kalusugan</option>
                            <option value="Paglabag sa Kontrata" {{ $entries['aksyon_return_reason'] == 'Paglabag sa Kontrata' ? 'selected' : '' }}>Paglabag sa Kontrata</option>
                            <option value="Ilegal na Pagre-recruit / Pag-deploy" {{ $entries['aksyon_return_reason'] == 'Ilegal na Pagre-recruit / Pag-deploy' ? 'selected' : '' }}>Ilegal na Pagre-recruit / Pag-deploy</option>
                            <option value="Inabuso" {{ $entries['aksyon_return_reason'] == 'Inabuso' ? 'selected' : '' }}>Inabuso</option>
                            <option value="Digmaan / Kaguluhang Sibil" {{ $entries['aksyon_return_reason'] == 'Digmaan / Kaguluhang Sibil' ? 'selected' : '' }}>Digmaan / Kaguluhang Sibil</option>
                            <option value="Pagkatanggal sa Trabaho" {{ $entries['aksyon_return_reason'] == 'Pagkatanggal sa Trabaho' ? 'selected' : '' }}>Pagkatanggal sa Trabaho</option>
                            <option value="Active OFW" {{ $entries['aksyon_return_reason'] == 'Active OFW' ? 'selected' : '' }}>Active OFW</option>
                            <option value="Others / Iba pang Kadahilanan ng Pagbalik" {{ $entries['aksyon_return_reason'] == 'Others / Iba pang Kadahilanan ng Pagbalik' ? 'selected' : '' }}>Others / Iba pang Kadahilanan ng Pagbalik</option>
                        </select>
                        
                    </div>
                </div>

                <!-- Maikling Salaysay -->
                <div class="mb-3">
                    <label class="form-label">Others / Iba pang Kadahilanan ng Pagbalik</label>
                    <textarea class="form-control" rows="4" id="aksyon_return_reason_others_specify" name="aksyon_return_reason_others_specify" disabled>{{ $entries['aksyon_return_reason_others_specify'] ?? '' }}</textarea>
                </div>

                <!-- Programs -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nakapag-avail ka na ba ng alinman sa mga sumusunod na programa o tulong?</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_hanapbuhay_program" id="aksyon_hanapbuhay_program" value="checked" {{ ($entries['aksyon_hanapbuhay_program'] ?? '') === 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aksyon_hanapbuhay_program">
                            Nakakapag-avail na ako ng OWWA Balik Pinas, Balik Hanapbuhay Program
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_nrco_livehood_program" id="aksyon_nrco_livehood_program" value="checked" {{ ($entries['aksyon_nrco_livehood_program'] ?? '') === 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aksyon_nrco_livehood_program">
                            Nakakapag-avail na ako ng NRCO Livelihood Program para sa Reintegration ng mga OFW
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_fund" id="aksyon_fund" value="checked" {{ ($entries['aksyon_fund'] ?? '') === 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aksyon_fund">
                            Nakakapag-avail na ako ng AKSYON Fund sa Jobsite / Pagdating sa Pilipinas
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <!-- Update Button -->
        <div class="d-flex justify-content-end mt-3 mb-5">
            <button type="button" class="btn btn-confirm px-4" id="updateBtn" onclick="validateAndSubmit()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                Update Request
            </button>
        </div>
    </form>

    <!-- Toast Notification -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="resultToast" class="toast align-items-center border-0 text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold" id="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Confirm Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to save the changes to this request?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-confirm btn-sm" id="confirmSubmitBtn">Yes, Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 mb-1" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Incomplete Fields
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-muted small">Please fill in the following required fields before submitting:</p>
                    <ul id="validationErrorList" class="mb-0 ps-3 small text-danger"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // ENABLE AND DISABLED TEXT AREA WHEN "OTHERS" IS SELECTED IN RETURN REASON
        const reasonSelect = document.getElementById("aksyon_return_reason");
        const descriptionTextarea = document.getElementById("aksyon_return_reason_others_specify");
        const descriptionTextAreaValue = descriptionTextarea.value;
        function toggleTextarea() {
            if (reasonSelect.value === "Others / Iba pang Kadahilanan ng Pagbalik") {
                descriptionTextarea.disabled = false;
                descriptionTextarea.value = descriptionTextAreaValue;
                reasonSelect.addEventListener("change", function(){
                    descriptionTextarea.focus();
                });
            } else {
                descriptionTextarea.disabled = true;
                descriptionTextarea.value = "";
            }
        }

        // run on change
        reasonSelect.addEventListener("change", toggleTextarea);

        // run on page load (for session restore)
        toggleTextarea();

        const successMsg = "{{ session('success') }}";
        const errorMsg   = "{{ session('error') }}";
        if (successMsg) showToast(successMsg, 'success');
        else if (errorMsg) showToast(errorMsg, 'danger');


        // ======================== AJAX SUBMIT ========================
        document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
            const modal      = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
            const form       = document.getElementById('rfaForm');
            const formData   = new FormData(form);
            const submitBtn  = document.getElementById('confirmSubmitBtn');
            const updateBtn  = document.getElementById('updateBtn');

            // Disable buttons to prevent double submission
            submitBtn.disabled = true;
            updateBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                Updating...
            `;

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                 ?? '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                modal.hide();

                if (data.success) {
                    showToast(data.message ?? 'Request updated successfully.', 'success');
                } else {
                    showToast(data.message ?? 'Something went wrong.', 'danger');
                }

                // Re-enable buttons regardless of outcome
                submitBtn.disabled = false;
                updateBtn.disabled = false;
                submitBtn.innerHTML = 'Yes, Update';
            })
            .catch(() => {
                modal.hide();
                showToast('A network error occurred. Please try again.', 'danger');
                submitBtn.disabled = false;
                updateBtn.disabled = false;
                submitBtn.innerHTML = 'Yes, Update';
            });
        });
    });

    // ======================== VALIDATE / OPEN MODAL ========================
    function validateAndSubmit() {
        const errors = [];

        const trim = name => (document.querySelector(`[name="${name}"]`)?.value ?? '').trim();

        // ── Section A: OFW Name ───────────────────────────────────────────
        // if (!trim('aksyon_ofw_age'))  errors.push('Age is required.');
        if (!trim('aksyon_latest_date_departure_ph'))  errors.push('Pinakahuling Petsa ng Pag-alis sa Pilipinas is required.');
        if (!trim('aksyon_latest_date_return_ph'))   errors.push('Pinakahuling Petsa ng Pagbalik sa Pilipinas is required.');
        if (!trim('aksyon_jobsite')) errors.push('Jobsite / Bansang Pinagtatrabahuhan is required.');
        if (!trim('aksyon_job_position')) errors.push('Job Position is required.');


        // ── Section A: OFW Contact Details ───────────────────────────────
        if (!trim('aksyon_return_reason'))          errors.push('Kadahilanan ng Pagbalik sa Pilipinas is required.');


        // ── Section D: Brief Description ──────────────────────────────────
        const returnReason = (document.querySelector('[name="aksyon_return_reason_others_specify"]')?.value ?? '').trim();
        if(returnReason.value === 'Others / Iba pang Kadahilanan ng Pagbalik is required.'){
            if (!returnReason) errors.push('Others / Iba pang Kadahilanan ng Pagbalik is required.');
        }
        

        // ── Show errors or proceed ────────────────────────────────────────
        if (errors.length > 0) {
            const list = document.getElementById('validationErrorList');
            list.innerHTML = errors.map(e => `<li class="mb-1">${e}</li>`).join('');
            new bootstrap.Modal(document.getElementById('validationModal')).show();
            return;
        }

        new bootstrap.Modal(document.getElementById('confirmationModal')).show();
    }

    // ======================== TOAST ========================
    function showToast(message, type = 'success') {
        const toastEl  = document.getElementById('resultToast');
        const toastMsg = document.getElementById('toastMessage');
        toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
        toastEl.classList.add('bg-' + type);
        toastMsg.textContent = message;
        new bootstrap.Toast(toastEl, { delay: 4000 }).show();
    }





  </script>
@endsection
