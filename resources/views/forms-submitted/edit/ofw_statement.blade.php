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
        font-weight: 600;
    }

    .sub-label {
        font-size: 0.75rem;
        color: #555;
        margin-bottom: 0.2rem;
        font-weight: 400;
    }

    .section-divider {
        border-top: 2px solid #b0c4de;
        margin: 1.25rem 0;
    }

    .brief-statement-label {
        font-weight: bold;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    .input-group .form-control {
        border-right: 0;
    }

    .input-group-text {
        background-color: #fff;
        border-left: 0;
        color: #555;
        font-size: 0.9rem;
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
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

    input[readonly], input.disabled {
        background-color: #e9ecef;
        cursor: not-allowed;
    }
</style>

{{-- Toast --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
    <div id="resultToast" class="toast text-white align-items-center border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<div class="container py-4">

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

    {{-- Form Header --}}
    <div class="form-header">
        <strong>OFW STATEMENT FORM</strong>
    </div>

    {{-- Main Form --}}
    <form method="POST"
          action="{{ route('forms-submitted.save-edit-ofw_statement', ['requestId' => $request->id, 'formId' => $formId]) }}"
          id="ofwStatementForm"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-section">

            {{-- Pangalan ng OFW --}}
            <div class="mb-3">
                <div class="form-label">Pangalan ng OFW</div>
                <div class="row g-2">
                    <div class="col-12 col-sm-4">
                        <div class="sub-label">Last Name</div>
                        <input type="text" class="form-control" value="{{ $ofw->ofw_lname ?? '' }}" readonly>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="sub-label">First Name</div>
                        <input type="text" class="form-control" value="{{ $ofw->ofw_fname ?? '' }}" readonly>
                    </div>
                    <div class="col-6 col-sm-2">
                        <div class="sub-label">Name Extension</div>
                        <input type="text" class="form-control" value="{{ $ofw->ofw_ename ?? '' }}" readonly>
                    </div>
                    <div class="col-6 col-sm-2">
                        <div class="sub-label">Middle Name</div>
                        <input type="text" class="form-control" value="{{ $ofw->ofw_mname ?? '' }}" readonly>
                    </div>
                </div>
            </div>

            {{-- Jobsite / Job Position --}}
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Jobsite / Bansang Pinagtrabahuhan</label>
                    <input type="text" class="form-control" value="{{ $entries['elpor_jobsite'] ?? null }}" readonly>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Job Position / Uri ng Trabaho</label>
                    <input type="text" class="form-control" value="{{ $entries['elpor_job_position'] ?? null }}" readonly>
                </div>
            </div>

            {{-- Latest Date of Departure / Arrival --}}
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-6">
                    <label class="form-label">Latest Date of Departure in Philippines</label>
                    <input type="date" class="form-control" value="{{ $entries['elpor_latest_date_departure_ph'] ?? '' }}" readonly>
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label">Latest Date of Arrival in Philippines</label>
                    <input type="date" class="form-control" value="{{ $entries['elpor_latest_date_return_ph'] ?? '' }}" readonly>
                </div>
            </div>

            {{-- Reason for Return --}}
            <div class="mb-3">
                <label class="form-label">Reason for Return to the Philippines (Latest Return)</label>
                <div class="sub-label">Dahilan ng Huling Pagbalik sa Pilipinas</div>
                <input type="text" class="form-control"
                    name="elpor_return_reason"
                    value="{{ $entries['elpor_return_reason'] ?? '' }}">
            </div>

            {{-- Divider --}}
            <div class="section-divider"></div>

            {{-- Brief Statement --}}
            <div class="mb-2">
                <div class="brief-statement-label">
                    BRIEF STATEMENT (Salaysay o Detalye kung ano ang dahilan ng balik sa Pilipinas)
                </div>
                <textarea class="form-control"
                    name="elpor_return_reason_details"
                    rows="4">{{ $entries['elpor_return_reason_details'] ?? '' }}</textarea>
            </div>

        </div>{{-- end .form-section --}}

        {{-- Update Button --}}
        <div class="d-flex justify-content-end mt-3 mb-5">
            <button type="button" class="btn btn-confirm px-4" id="updateBtn" onclick="validateAndSubmit()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                Update Request
            </button>
        </div>

    </form>
</div>

{{-- Confirmation Modal --}}
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

{{-- Validation Modal --}}
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

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ── AJAX submit ──────────────────────────────────────────────────────
    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        const modal     = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
        const form      = document.getElementById('ofwStatementForm');
        const formData  = new FormData(form);
        const submitBtn = document.getElementById('confirmSubmitBtn');
        const updateBtn = document.getElementById('updateBtn');

        submitBtn.disabled = true;
        updateBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
            Updating...
        `;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            },
            body: formData,
        })
        .then(res => res.json())
        .then(data => {
            modal.hide();
            showToast(
                data.message ?? (data.success ? 'Request updated successfully.' : 'Something went wrong.'),
                data.success ? 'success' : 'danger'
            );
        })
        .catch(() => {
            modal.hide();
            showToast('A network error occurred. Please try again.', 'danger');
        })
        .finally(() => {
            submitBtn.disabled = false;
            updateBtn.disabled = false;
            submitBtn.innerHTML = 'Yes, Update';
        });
    });
});

// ── Validate & open confirm modal ────────────────────────────────────────
function validateAndSubmit() {
    const errors = [];
    const trim   = name => (document.querySelector(`[name="${name}"]`)?.value ?? '').trim();

    if (!trim('elpor_return_reason'))         errors.push('Reason for Return to the Philippines is required.');
    if (!trim('elpor_return_reason_details')) errors.push('Brief Statement / Salaysay is required.');

    if (errors.length > 0) {
        document.getElementById('validationErrorList').innerHTML =
            errors.map(e => `<li class="mb-1">${e}</li>`).join('');
        new bootstrap.Modal(document.getElementById('validationModal')).show();
        return;
    }

    new bootstrap.Modal(document.getElementById('confirmationModal')).show();
}

// ── Toast ─────────────────────────────────────────────────────────────────
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