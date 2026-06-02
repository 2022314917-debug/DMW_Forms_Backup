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
</style>

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

    <form method="POST" action="" enctype="multipart/form-data">
        @csrf

        {{-- SECTION I --}}
        <div class="form-section">
            <h5 class="fw-bold mb-4">I. DATOS TUNGKOL SA OFW</h5>

            <h6 class="section-subheading">Pangalan ng OFW</h6>

            <div class="row g-2 mb-3">
                <div class="col-6 col-md-3">
                    <label class="section-label">Last Name</label>
                    <input type="text" class="form-control"
                        value="{{ $ofw->ofw_lname ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-3">
                    <label class="section-label">First Name</label>
                    <input type="text" class="form-control"
                        value="{{ $ofw->ofw_fname ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Suffix</label>
                    <input type="text" class="form-control"
                        value="{{ $ofw->ofw_ename ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-4">
                    <label class="section-label">Middle Name</label>
                    <input type="text" class="form-control"
                        value="{{ $ofw->ofw_mname ?? null }}" readonly>
                </div>
            </div>

            <div class="row g-2 mb-3">

                <div class="col-6 col-md-3">
                    <label class="section-label">Birthdate</label>
                    <input type="date" class="form-control"
                        value="{{ $ofw->ofw_bday ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Age</label>
                    <input type="number" class="form-control"
                        name="elpor_ofw_age"
                        value="{{ $entries['elpor_ofw_age'] ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Gender</label>
                    <input type="text" class="form-control"
                        value="{{ $ofw->ofw_gender ?? null }}">
                </div>

                <div class="col-6 col-md-2">
                    <label class="section-label">Civil Status</label>
                    <input type="text" class="form-control"
                        value="{{ $ofw->ofw_civil_status ?? null }}" readonly>
                </div>

                <div class="col-12 col-md-3">
                    <label class="section-label">Other Data</label>
                    <input type="text" class="form-control" value="{{ $entries['elpor_ofw_other_data'] ?? '' }}" readonly>

                </div>

            </div>

            <!-- Address -->
            <h6 class="section-subheading mt-4">Address in the Philippines</h6>

            <div class="mb-2">
                <label class="section-label">Unit/Room/House Number/Street Name</label>

                <input type="text"
                    class="form-control"
                    value="{{ $ofw_address->house_no ?? null }}" readonly/>
            </div>

            <div class="row g-2 mb-2">

                <div class="col-6 col-md-3">
                    <label class="section-label">Province</label>

                    <input type="text"
                        class="form-control"
                        value="{{ $ofw_address->province ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-3">
                    <label class="section-label">City / Municipality</label>

                    <input type="text"
                        class="form-control"
                        value="{{ $ofw_address->municipality ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-3">
                    <label class="section-label">Barangay</label>

                    <input type="text"
                        class="form-control"
                        value="{{ $ofw_address->brgy ?? null }}" readonly>
                </div>

                <div class="col-6 col-md-3">
                    <label class="section-label">Zip Code</label>

                    <input type="text"
                        class="form-control"
                        value="{{ $ofw_address->zip_code ?? null }}"
                        placeholder="ex. 2016" readonly/>
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

                    <!-- <select class="form-select" name="elpor_jobsite" id="elpor_jobsite">
                        <option selected disabled>Select</option>
                    </select> -->

                    <!-- <input type="hidden"
                        name="elpor_jobsite_name"
                        id="elpor_jobsite_name"> -->

                    <input type="text" class="form-control"
                        name="elpor_jobsite"
                        id="elpor_jobsite"
                        value="{{ $entries['elpor_jobsite'] ?? null }} " readonly>


                </div>

                <div class="col-12 col-md-6">

                    <label class="section-label">
                        Position/Uri ng Trabaho
                    </label>

                    <input type="text"
                        class="form-control"
                        name="elpor_job_position"
                        value="{{ $entries['elpor_job_position'] ?? null }}" readonly>

                </div>

            </div>

            <div class="row g-2">

                <div class="col-12 col-md-6">
                    <label class="section-label">
                        Latest Date of Departure in the Philippines
                    </label>

                    <input type="date"
                        class="form-control"
                        name="elpor_latest_date_departure_ph"
                        value="{{ $entries['elpor_latest_date_departure_ph'] ?? null }}" readonly>
                </div>

                <div class="col-12 col-md-6">
                    <label class="section-label">
                        Latest Date of Arrival in the Philippines
                    </label>

                    <input type="date"
                        class="form-control"
                        name="elpor_latest_date_return_ph"
                        value="{{ $entries['elpor_latest_date_return_ph'] ?? null }}" readonly>
                </div>

            </div>
        </div>

        {{-- SECTION III --}}
        <div class="form-section">

            <h5 class="fw-bold mb-4">
                III. DATOS TUNGKOL SA NEGOSYO
            </h5>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Type Of Business o Uri ng Negosyo Na Nais Umpisahan
                </label>

                <input type="text"
                    class="form-control"
                    name="elpor_business_type"
                    value="{{ $entries['elpor_business_type'] ?? null }}" readonly>

            </div>

            <div class="mb-3">

                <label class="form-label fw-bold">
                    Business Site o Kumpletong Lokasyon ng Negosyo
                </label>

                <input type="text"
                    class="form-control"
                    name="elpor_business_site"
                    value="{{ $entries['elpor_business_site'] ?? null }}" readonly>

            </div>

        </div>

        {{-- SECTION IV --}}
        <div class="form-section">

            <h5 class="fw-bold mb-4">
                IV. MGA PAGSASANAY SA NEGOSYO
            </h5>


            <div class="table-responsive mb-4">

                <table class="table table-bordered align-middle mb-0"
                    id="trainingTable"
                    style="background:#fff; font-size:0.95rem;">

                    <thead>
                        <tr style="background:#e8eef7;">
                            <th>KIND OF TRAINING</th>
                            <th>VENUE</th>
                            <th>ISSUED BY</th>
                            <th>DATE</th>
                        </tr>
                    </thead>

                    <tbody id="trainingTableBody">

                        @forelse($training_records as $index => $training)

                            <tr>
                                <td>
                                    {{ $training->training_name }}

                                    <input type="hidden"
                                        name="trainings[{{ $index }}][training_name]"
                                        value="{{ $training->training_name }}">
                                </td>

                                <td>
                                    {{ $training->venue }}

                                    <input type="hidden"
                                        name="trainings[{{ $index }}][venue]"
                                        value="{{ $training->venue }}">
                                </td>

                                <td>
                                    {{ $training->issued_by }}

                                    <input type="hidden"
                                        name="trainings[{{ $index }}][issued_by]"
                                        value="{{ $training->issued_by }}">
                                </td>

                                <td>
                                    {{ $training->training_date }}

                                    <input type="hidden"
                                        name="trainings[{{ $index }}][training_date]"
                                        value="{{ $training->training_date }}">
                                </td>

                            </tr>
                        @empty

                            <tr id="trainingEmptyRow">
                                <td colspan="5"
                                    class="text-center text-muted py-3">
                                    No training records added yet.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>


    </form>

</div>

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

<script>
document.addEventListener("DOMContentLoaded", function () {

    const addTrainingRowBtn = document.getElementById("addTrainingRow");
    const confirmTrainingBtn = document.getElementById("confirmTrainingBtn");

    const trainingTableBody = document.getElementById("trainingTableBody");
    const trainingEmptyRow = document.getElementById("trainingEmptyRow");

    const trainingModalElement = document.getElementById("trainingModal");
    const trainingModal = new bootstrap.Modal(trainingModalElement);

    const modalError = document.getElementById("trainingModalError");

    let rowIndex = "{{ isset($training_records) ? $training_records->count() : 0 }}";

    /*
    |--------------------------------------------------------------------------
    | OPEN MODAL
    |--------------------------------------------------------------------------
    */

    addTrainingRowBtn.addEventListener("click", function () {

        clearModalFields();

        modalError.classList.add("d-none");

        trainingModal.show();
    });

    /*
    |--------------------------------------------------------------------------
    | CONFIRM ADD ROW
    |--------------------------------------------------------------------------
    */

    confirmTrainingBtn.addEventListener("click", function () {

        const kind = document.getElementById("modal_kind").value.trim();
        const venue = document.getElementById("modal_venue").value.trim();
        const issuedBy = document.getElementById("modal_issued_by").value.trim();
        const date = document.getElementById("modal_date").value;

        /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

        if (!kind || !venue || !issuedBy || !date) {

            modalError.classList.remove("d-none");

            return;
        }

        modalError.classList.add("d-none");

        /*
        |--------------------------------------------------------------------------
        | REMOVE EMPTY ROW
        |--------------------------------------------------------------------------
        */

        const emptyRow = document.getElementById("trainingEmptyRow");

        if (emptyRow) {
            emptyRow.remove();
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE NEW ROW
        |--------------------------------------------------------------------------
        */

        const row = `
            <tr>

                <td>
                    ${kind}

                    <input type="hidden"
                        name="trainings[${rowIndex}][training_name]"
                        value="${kind}">
                </td>

                <td>
                    ${venue}

                    <input type="hidden"
                        name="trainings[${rowIndex}][venue]"
                        value="${venue}">
                </td>

                <td>
                    ${issuedBy}

                    <input type="hidden"
                        name="trainings[${rowIndex}][issued_by]"
                        value="${issuedBy}">
                </td>

                <td>
                    ${date}

                    <input type="hidden"
                        name="trainings[${rowIndex}][training_date]"
                        value="${date}">
                </td>

                <td class="text-center">

                    <button type="button"
                        class="btn btn-sm btn-danger remove-training">
                        ×
                    </button>

                </td>

            </tr>
        `;

        trainingTableBody.insertAdjacentHTML("beforeend", row);

        rowIndex++;

        trainingModal.hide();

        clearModalFields();
    });

    /*
    |--------------------------------------------------------------------------
    | REMOVE ROW
    |--------------------------------------------------------------------------
    */

    document.addEventListener("click", function (e) {

        if (e.target.classList.contains("remove-training")) {

            e.target.closest("tr").remove();

            checkEmptyTable();
        }
    });

    /*
    |--------------------------------------------------------------------------
    | CHECK EMPTY TABLE
    |--------------------------------------------------------------------------
    */

    function checkEmptyTable() {

        const rows = trainingTableBody.querySelectorAll("tr");

        if (rows.length === 0) {

            trainingTableBody.innerHTML = `
                <tr id="trainingEmptyRow">
                    <td colspan="5"
                        class="text-center text-muted py-3">
                        No training records added yet.
                    </td>
                </tr>
            `;
        }
    }

    /*
    |--------------------------------------------------------------------------
    | CLEAR MODAL
    |--------------------------------------------------------------------------
    */

    function clearModalFields() {

        document.getElementById("modal_kind").value = "";
        document.getElementById("modal_venue").value = "";
        document.getElementById("modal_issued_by").value = "";
        document.getElementById("modal_date").value = "";
    }

});
</script>
@endsection