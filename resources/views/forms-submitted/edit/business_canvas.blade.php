@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Assistant', Arial, sans-serif;
    }

    .canvas-wrapper {
        background-color: #d9e4f5;
        border: 1px solid #b0c4de;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .canvas-title {
        text-align: center;
        font-weight: bold;
        font-size: 1rem;
        letter-spacing: 0.06em;
        margin-bottom: 0.75rem;
    }

    .canvas-cell {
        background-color: #d9e4f5;
        border: 1px solid #b0c4de;
        border-radius: 0.25rem;
        padding: 0.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .canvas-cell .cell-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #222;
        line-height: 1.2;
    }

    .canvas-cell textarea {
        width: 100%;
        flex: 1;
        min-height: 55px;
        border: 1px solid #b0c4de;
        background-color: #fff;
        border-radius: 0.2rem;
        font-size: 0.8rem;
        padding: 0.3rem;
        resize: vertical;
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

    @media (max-width: 767.98px) {
        .canvas-main-row {
            flex-direction: column !important;
        }
        .canvas-col {
            width: 100% !important;
        }
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

    <form method="POST"
          action="{{ route('forms-submitted.save-edit-business_canvas', ['requestId' => $request->id, 'formId' => $formId]) }}"
          id="businessCanvasForm"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="canvas-wrapper">
            <div class="canvas-title">BUSINESS CANVAS</div>

            <div class="d-flex gap-2 canvas-main-row">

                {{-- Column 1: MARKETING --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell">
                        <span class="cell-label">2. Marketing</span>
                        <span class="cell-label" style="font-weight:500;">2.1 Customer</span>
                        <textarea name="elpor_bc_customer">{{ $entries['elpor_bc_customer'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.2 Pwesto o Lugar</span>
                        <textarea name="elpor_bc_place">{{ $entries['elpor_bc_place'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.3 Promotions</span>
                        <textarea name="elpor_bc_promotions">{{ $entries['elpor_bc_promotions'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.4 Presyo</span>
                        <textarea name="elpor_bc_price">{{ $entries['elpor_bc_price'] ?? '' }}</textarea>
                    </div>

                </div>

                {{-- Column 2: BUSINESS IDEA + OPERATIONS --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell">
                        <span class="cell-label">1. Business Idea</span>
                        <textarea name="elpor_bc_idea">{{ $entries['elpor_bc_idea'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3. Business Operations</span>
                        <span class="cell-label" style="font-weight:500;">3.1 Proseso</span>
                        <textarea name="elpor_bc_process">{{ $entries['elpor_bc_process'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3.2 Resources</span>
                        <textarea name="elpor_bc_resources">{{ $entries['elpor_bc_resources'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3.3 Key Partners</span>
                        <textarea name="elpor_bc_partners">{{ $entries['elpor_bc_partners'] ?? '' }}</textarea>
                    </div>

                </div>

                {{-- Column 3: FINANCE --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell">
                        <span class="cell-label">4. Finance</span>
                        <span class="cell-label" style="font-weight:500;">4.1 Start Up Cost</span>
                        <textarea name="elpor_bc_cost">{{ $entries['elpor_bc_cost'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.2 Pagkukuhanan ng Puhunan</span>
                        <textarea name="elpor_bc_investment">{{ $entries['elpor_bc_investment'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.3 Budget</span>
                        <textarea name="elpor_bc_budget">{{ $entries['elpor_bc_budget'] ?? '' }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.4 Kita</span>
                        <textarea name="elpor_bc_profit">{{ $entries['elpor_bc_profit'] ?? '' }}</textarea>
                    </div>

                </div>

            </div>{{-- end canvas-main-row --}}
        </div>{{-- end canvas-wrapper --}}

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

    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        const modal     = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
        const form      = document.getElementById('businessCanvasForm');
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

function validateAndSubmit() {
    const errors = [];
    const trim   = name => (document.querySelector(`[name="${name}"]`)?.value ?? '').trim();

    if (!trim('elpor_bc_idea')) errors.push('Business Idea is required.');

    if (errors.length > 0) {
        document.getElementById('validationErrorList').innerHTML =
            errors.map(e => `<li class="mb-1">${e}</li>`).join('');
        new bootstrap.Modal(document.getElementById('validationModal')).show();
        return;
    }

    new bootstrap.Modal(document.getElementById('confirmationModal')).show();
}

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