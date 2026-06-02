@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet"/>

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

    .form-header h4 {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .form-section {
        background-color: #d9e4f5;
        padding: 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        border: 1px solid #b0c4de;
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

    .gabay-banner {
        background-color: #FDFFD4;
        border: 1px solid #ccc;
        border-radius: 0.25rem;
        padding: 0.5rem 0.75rem;
        font-size: 0.82rem;
        margin-bottom: 1rem;
    }

    .section-label {
        font-size: 1rem;
        font-weight: 400;
        margin-bottom: 0.5rem;
        display: block;
        color: #212529;
    }

    .section-subheading {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    input.disabled, input[readonly] {
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

    {{-- HEADER --}}
    <div class="form-header text-center">
        <h4>ENHANCED LIVELIHOOD PROGRAM FOR OFW REINTEGRATION (ELPOR) APPLICATION FORM</h4>
        <p class="mb-0">
            Use this form to submit a request for assistance. Please ensure that all information
            provided is accurate and complete so that our team can process your request efficiently.
        </p>
    </div>

    {{-- GABAY --}}
    <div class="gabay-banner">
        <strong>GABAY SA PAGSAGOT:</strong>
        Kumpletuhing sagutin ang lahat ng mga hinihiling impormasyon gamit ang block ball-point pen.
        Siguraduhin na naintindihan at tama ang impormasyon.
    </div>

    <form method="POST"
          action="{{ route('forms-submitted.save-edit-elpor', ['requestId' => $request->id, 'formId' => $formId]) }}"
          id="elporForm"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- SECTION I --}}
        <div class="form-section">
            <h5 class="fw-bold mb-4">I. DATOS TUNGKOL SA OFW</h5>

            <h6 class="section-subheading">Pangalan ng OFW</h6>

            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3">
                    <label class="section-label">Last Name</label>
                    <input type="text" class="form-control" value="{{ $ofw->ofw_lname ?? '' }}" readonly>
                </div>
                <div class="col-6 col-md-3">
                    <label class="section-label">First Name</label>
                    <input type="text" class="form-control" value="{{ $ofw->ofw_fname ?? '' }}" readonly>
                </div>
                <div class="col-6 col-md-2">
                    <label class="section-label">Suffix</label>
                    <input type="text" class="form-control" value="{{ $ofw->ofw_ename ?? '' }}" readonly>
                </div>
                <div class="col-6 col-md-4">
                    <label class="section-label">Middle Name</label>
                    <input type="text" class="form-control" value="{{ $ofw->ofw_mname ?? '' }}" readonly>
                </div>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3">
                    <label class="section-label">Birthdate</label>
                    <input type="date" class="form-control" value="{{ $ofw->ofw_bday ?? '' }}" readonly>
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Age</label>
                    <input type="number" class="form-control"
                        name="elpor_ofw_age"
                        value="{{ $entries['elpor_ofw_age'] ?? '' }}">
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Gender</label>
                    <input type="text" class="form-control" value="{{ $ofw->ofw_gender ?? '' }}" readonly>
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Civil Status</label>
                    <input type="text" class="form-control" value="{{ $ofw->ofw_civil_status ?? '' }}" readonly>
                </div>

                <div class="col-12 col-md-3">
                    <label class="section-label">Other Data</label>
                    <select class="form-select" name="elpor_ofw_other_data">
                        <option value="" disabled {{ empty($entries['elpor_ofw_other_data']) ? 'selected' : '' }}>Select</option>
                        @foreach(['Person With Disability', 'Senior Citizen', 'Solo Parent', 'Indigenous People', 'LGBTQIA+'] as $option)
                            <option value="{{ $option }}" {{ ($entries['elpor_ofw_other_data'] ?? '') === $option ? 'selected' : '' }}>
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Address -->
            <h6 class="section-subheading mt-4">Address in the Philippines</h6>

            <div class="mb-2">
                <label class="section-label">Unit/Room/House Number/Street Name</label>
                <input type="text" class="form-control" value="{{ $ofw_address->house_no ?? '' }}" readonly>
            </div>

            <div class="row g-2 mb-2">
                <div class="col-6 col-md-3">
                    <label class="section-label">Province</label>
                    <input type="text" class="form-control" value="{{ $ofw_address->province ?? '' }}" readonly>
                </div>
                <div class="col-6 col-md-3">
                    <label class="section-label">City / Municipality</label>
                    <input type="text" class="form-control" value="{{ $ofw_address->municipality ?? '' }}" readonly>
                </div>
                <div class="col-6 col-md-3">
                    <label class="section-label">Barangay</label>
                    <input type="text" class="form-control" value="{{ $ofw_address->brgy ?? '' }}" readonly>
                </div>
                <div class="col-6 col-md-3">
                    <label class="section-label">Zip Code</label>
                    <input type="text" class="form-control" value="{{ $ofw_address->zip_code ?? '' }}" readonly>
                </div>
            </div>
        </div>

        {{-- SECTION II --}}
        <div class="form-section">
            <h5 class="fw-bold mb-4">II. DATOS TUNGKOL SA OFW EMPLOYMENT</h5>

            <div class="row g-2 mb-2">
                <div class="col-12 col-md-6">
                    <label class="section-label">
                        <span class="d-none d-md-inline">Jobsite/</span>
                        Bansang Pinagtatrabahuhan
                    </label>
                    <select class="form-select" name="elpor_jobsite" id="elpor_jobsite">
                        <option value="" disabled selected>Loading countries...</option>
                    </select>
                </div>

                <div class="col-12 col-md-6">
                    <label class="section-label">Position/Uri ng Trabaho</label>
                    <input type="text" class="form-control"
                        name="elpor_job_position"
                        value="{{ $entries['elpor_job_position'] ?? '' }}">
                </div>
            </div>

            <div class="row g-2">
                <div class="col-12 col-md-6">
                    <label class="section-label">Latest Date of Departure in the Philippines</label>
                    <input type="date" class="form-control"
                        name="elpor_latest_date_departure_ph"
                        value="{{ $entries['elpor_latest_date_departure_ph'] ?? '' }}">
                </div>
                <div class="col-12 col-md-6">
                    <label class="section-label">Latest Date of Arrival in the Philippines</label>
                    <input type="date" class="form-control"
                        name="elpor_latest_date_return_ph"
                        value="{{ $entries['elpor_latest_date_return_ph'] ?? '' }}">
                </div>
            </div>
        </div>

        {{-- SECTION III --}}
        <div class="form-section">
            <h5 class="fw-bold mb-4">III. DATOS TUNGKOL SA NEGOSYO</h5>

            <div class="mb-3">
                <label class="form-label fw-bold">Type Of Business o Uri ng Negosyo Na Nais Umpisahan</label>
                <input type="text" class="form-control"
                    name="elpor_business_type"
                    value="{{ $entries['elpor_business_type'] ?? '' }}">
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Business Site o Kumpletong Lokasyon ng Negosyo</label>
                <input type="text" class="form-control"
                    name="elpor_business_site"
                    value="{{ $entries['elpor_business_site'] ?? '' }}">
            </div>
        </div>

        {{-- SECTION IV --}}
        <div class="form-section">
            <h5 class="fw-bold mb-4">IV. MGA PAGSASANAY SA NEGOSYO</h5>

            {{-- Hidden field to track whether trainings were modified --}}
            <input type="hidden" name="trainings_modified" id="trainingsModified" value="0">

            <div class="table-responsive mb-3">
                <table class="table table-bordered align-middle mb-0"
                    id="trainingTable"
                    style="background:#fff; font-size:0.95rem;">
                    <thead>
                        <tr style="background:#e8eef7;">
                            <th>KIND OF TRAINING</th>
                            <th>VENUE</th>
                            <th>ISSUED BY</th>
                            <th>DATE</th>
                            <th style="width:50px;"></th>
                        </tr>
                    </thead>
                    <tbody id="trainingTableBody">
                        @forelse($training_records as $index => $training)
                            <tr
                                data-training-name="{{ $training->training_name }}"
                                data-venue="{{ $training->venue }}"
                                data-issued-by="{{ $training->issued_by }}"
                                data-training-date="{{ $training->training_date }}">
                                <td>
                                    {{ $training->training_name }}
                                    <input type="hidden" name="trainings[{{ $index }}][training_name]" value="{{ $training->training_name }}">
                                </td>
                                <td>
                                    {{ $training->venue }}
                                    <input type="hidden" name="trainings[{{ $index }}][venue]" value="{{ $training->venue }}">
                                </td>
                                <td>
                                    {{ $training->issued_by }}
                                    <input type="hidden" name="trainings[{{ $index }}][issued_by]" value="{{ $training->issued_by }}">
                                </td>
                                <td>
                                    {{ $training->training_date }}
                                    <input type="hidden" name="trainings[{{ $index }}][training_date]" value="{{ $training->training_date }}">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-danger remove-training" title="Remove">
                                        &times;
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr id="trainingEmptyRow">
                                <td colspan="5" class="text-center text-muted py-3">No training records added yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-confirm btn-sm px-3" id="addTrainingRow">
                    + Add Training
                </button>
            </div>
        </div>

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

{{-- Training Modal --}}
<div class="modal fade" id="trainingModal" tabindex="-1" aria-labelledby="trainingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="trainingModalLabel" style="font-size:1rem;">Add Training Record</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="background-color:#D9E4F5;">
                <div id="trainingModalError" class="alert alert-danger py-2 px-3 d-none" style="font-size:0.88rem;">
                    Please fill in all fields before confirming.
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:0.9rem;">KIND OF TRAINING / URI NG PAGSASANAY</label>
                    <input type="text" class="form-control" id="modal_kind" placeholder="e.g. FAS-SBMT, Entrepreneurship Training..."/>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:0.9rem;">VENUE / LUGAR</label>
                    <input type="text" class="form-control" id="modal_venue" placeholder="e.g. Manila, Metro Manila"/>
                </div>
                <div class="mb-3">
                    <label class="form-label fw-semibold" style="font-size:0.9rem;">ISSUED BY / NAGBIGAY NG PAGSASANAY</label>
                    <input type="text" class="form-control" id="modal_issued_by" placeholder="e.g. TESDA, OWWA"/>
                </div>
                <div class="mb-1">
                    <label class="form-label fw-semibold" style="font-size:0.9rem;">DATE / PETSA</label>
                    <input type="date" class="form-control" id="modal_date"/>
                </div>
            </div>
            <div class="modal-footer" style="background-color:#D9E4F5; border-top:1px solid #b0c4de;">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-confirm btn-sm px-4" id="confirmTrainingBtn">Confirm</button>
            </div>
        </div>
    </div>
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

    // ── Country select ───────────────────────────────────────────────────────
    const countrySelect = document.getElementById('elpor_jobsite');

    // Value stored in DB — country name (older records may have stored the code)
    const savedJobsite = "{{ trim($entries['elpor_jobsite'] ?? '') }}";

    function populateSelect(select, items, placeholder) {
        select.innerHTML = `<option value="" disabled>${placeholder}</option>`;
        items.forEach(item => {
            const opt = document.createElement('option');
            // Always store the country NAME as the value — that is what gets saved to the DB
            opt.value = item.name;
            opt.textContent = item.name;
            select.appendChild(opt);
        });
    }

    function preselectCountry(countries) {
        if (!savedJobsite) return;

        // Match by name (exact, case-insensitive) — DB stores the name
        // Also try matching by code for backward compatibility with old records
        const byName = countries.find(c => c.name.toLowerCase() === savedJobsite.toLowerCase());
        const byCode = countries.find(c => c.code.toUpperCase() === savedJobsite.toUpperCase());
        const match  = byName || byCode;

        if (match) {
            countrySelect.value = match.name;
        } else {
            // Saved value doesn't match any country — add it as a custom option so data isn't lost
            const opt = document.createElement('option');
            opt.value = savedJobsite;
            opt.textContent = savedJobsite;
            opt.selected = true;
            countrySelect.appendChild(opt);
        }
    }

    fetch('https://api.first.org/data/v1/countries?limit=250')
        .then(response => {
            if (!response.ok) throw new Error(`Country API status: ${response.status}`);
            return response.json();
        })
        .then(data => {
            if (!data || !data.data) throw new Error('No countries found');

            const countries = Object.entries(data.data)
                .map(([code, value]) => {
                    let name = (value.country || '').trim();
                    name = name.replace(/\s*\(.*?\)/g, '').trim();
                    name = name.replace(/^the\s+/i, '').trim();
                    name = name.replace(/\s{2,}/g, ' ').trim();
                    if (!name && value.name && typeof value.name === 'object') {
                        name = (value.name.common || value.name.official || '').trim();
                    }
                    return { code: code.toUpperCase(), name };
                })
                .filter(c => c.code && c.name)
                .reduce((acc, item) => {
                    const found = acc.find(i => i.name.toLowerCase() === item.name.toLowerCase());
                    if (!found) acc.push(item);
                    return acc;
                }, [])
                .sort((a, b) => a.name.localeCompare(b.name, 'en', { sensitivity: 'base' }));

            if (!countries.length) throw new Error('No selectable countries found after mapping');

            populateSelect(countrySelect, countries, 'Select Country');
            preselectCountry(countries);
        })
        .catch(error => {
            console.error('Error fetching countries:', error);
            const fallbackCountries = [
                { code: 'PH', name: 'Philippines' },
                { code: 'US', name: 'United States' },
                { code: 'CA', name: 'Canada' },
                { code: 'GB', name: 'United Kingdom' },
                { code: 'AU', name: 'Australia' },
            ];
            console.warn('Using fallback country list');
            populateSelect(countrySelect, fallbackCountries, 'Select Country');
            preselectCountry(fallbackCountries);
        });

    // No extra sync needed — the select value IS the country name

    // ── Training table state ─────────────────────────────────────────────
    const trainingTableBody  = document.getElementById('trainingTableBody');
    const trainingsModified  = document.getElementById('trainingsModified');
    const trainingModal      = new bootstrap.Modal(document.getElementById('trainingModal'));
    const trainingModalError = document.getElementById('trainingModalError');

    // Snapshot the original rows from the server for dirty-check
    const originalTrainings = getTrainingSnapshot();

    let rowIndex = "{{ isset($training_records) ? $training_records->count() : 0 }}";

    // ── Add training button ──────────────────────────────────────────────
    document.getElementById('addTrainingRow').addEventListener('click', function () {
        clearModalFields();
        trainingModalError.classList.add('d-none');
        trainingModal.show();
    });

    // ── Confirm add training ─────────────────────────────────────────────
    document.getElementById('confirmTrainingBtn').addEventListener('click', function () {
        const kind     = document.getElementById('modal_kind').value.trim();
        const venue    = document.getElementById('modal_venue').value.trim();
        const issuedBy = document.getElementById('modal_issued_by').value.trim();
        const date     = document.getElementById('modal_date').value;

        if (!kind || !venue || !issuedBy || !date) {
            trainingModalError.classList.remove('d-none');
            return;
        }
        trainingModalError.classList.add('d-none');

        // Remove empty-row placeholder
        const emptyRow = document.getElementById('trainingEmptyRow');
        if (emptyRow) emptyRow.remove();

        // Insert new row
        trainingTableBody.insertAdjacentHTML('beforeend', buildRow(rowIndex, kind, venue, issuedBy, date));
        rowIndex++;

        markTrainingsModified();
        trainingModal.hide();
        clearModalFields();
    });

    // ── Remove training row (event delegation) ───────────────────────────
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-training')) {
            e.target.closest('tr').remove();
            markTrainingsModified();
            checkEmptyTable();
            reIndexTrainingInputs();
        }
    });

    // ── AJAX submit ──────────────────────────────────────────────────────
    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        const modal     = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
        const form      = document.getElementById('elporForm');
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
            showToast(data.message ?? (data.success ? 'Request updated successfully.' : 'Something went wrong.'), data.success ? 'success' : 'danger');

            if (data.success) {
                // Reset dirty flag so a second save won't re-delete
                trainingsModified.value = '0';
            }
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

    // ── Helpers ──────────────────────────────────────────────────────────

    function buildRow(index, kind, venue, issuedBy, date) {
        return `
            <tr data-training-name="${escHtml(kind)}"
                data-venue="${escHtml(venue)}"
                data-issued-by="${escHtml(issuedBy)}"
                data-training-date="${escHtml(date)}">
                <td>
                    ${escHtml(kind)}
                    <input type="hidden" name="trainings[${index}][training_name]" value="${escHtml(kind)}">
                </td>
                <td>
                    ${escHtml(venue)}
                    <input type="hidden" name="trainings[${index}][venue]" value="${escHtml(venue)}">
                </td>
                <td>
                    ${escHtml(issuedBy)}
                    <input type="hidden" name="trainings[${index}][issued_by]" value="${escHtml(issuedBy)}">
                </td>
                <td>
                    ${escHtml(date)}
                    <input type="hidden" name="trainings[${index}][training_date]" value="${escHtml(date)}">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-sm btn-danger remove-training" title="Remove">&times;</button>
                </td>
            </tr>
        `;
    }

    function reIndexTrainingInputs() {
        trainingTableBody.querySelectorAll('tr[data-training-name]').forEach((row, i) => {
            row.querySelectorAll('input[type="hidden"]').forEach(input => {
                input.name = input.name.replace(/trainings\[\d+\]/, `trainings[${i}]`);
            });
        });
    }

    function getTrainingSnapshot() {
        return Array.from(trainingTableBody.querySelectorAll('tr[data-training-name]')).map(row => ({
            training_name: row.dataset.trainingName,
            venue:         row.dataset.venue,
            issued_by:     row.dataset.issuedBy,
            training_date: row.dataset.trainingDate,
        }));
    }

    function markTrainingsModified() {
        trainingsModified.value = '1';
    }

    function checkEmptyTable() {
        const rows = trainingTableBody.querySelectorAll('tr[data-training-name]');
        if (rows.length === 0) {
            trainingTableBody.innerHTML = `
                <tr id="trainingEmptyRow">
                    <td colspan="5" class="text-center text-muted py-3">No training records added yet.</td>
                </tr>`;
        }
    }

    function clearModalFields() {
        ['modal_kind', 'modal_venue', 'modal_issued_by', 'modal_date'].forEach(id => {
            document.getElementById(id).value = '';
        });
    }

    function escHtml(str) {
        const d = document.createElement('div');
        d.appendChild(document.createTextNode(str));
        return d.innerHTML;
    }
});

// ── Validate & open confirm modal ────────────────────────────────────────
function validateAndSubmit() {
    const errors = [];
    const trim   = name => (document.querySelector(`[name="${name}"]`)?.value ?? '').trim();

    if (!trim('elpor_jobsite'))                    errors.push('Jobsite / Bansang Pinagtatrabahuhan is required.');
    if (!trim('elpor_job_position'))               errors.push('Position / Uri ng Trabaho is required.');
    if (!trim('elpor_latest_date_departure_ph'))   errors.push('Latest Date of Departure in the Philippines is required.');
    if (!trim('elpor_latest_date_return_ph'))      errors.push('Latest Date of Arrival in the Philippines is required.');
    if (!trim('elpor_business_type'))              errors.push('Type of Business is required.');
    if (!trim('elpor_business_site'))              errors.push('Business Site / Location is required.');

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