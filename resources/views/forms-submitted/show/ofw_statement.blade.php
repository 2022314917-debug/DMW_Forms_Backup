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

    /* Sub-label styling (small gray labels above inputs) */
    .sub-label {
        font-size: 0.75rem;
        color: #555;
        margin-bottom: 0.2rem;
        font-weight: 400;
    }

    /* Divider between reason and brief statement sections */
    .section-divider {
        border-top: 2px solid #b0c4de;
        margin: 1.25rem 0;
    }

    /* Brief statement section label styling */
    .brief-statement-label {
        font-weight: bold;
        font-size: 1rem;
        margin-bottom: 0.5rem;
    }

    /* Date input icon alignment */
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
    {{-- Form Header --}}
    <div class="form-header">
        <strong>OFW STATEMENT FORM</strong>
    </div>

    {{-- Main Form Section --}}
    <div class="form-section">

        <form method="POST" action="" enctype="multipart/form-data">
            @csrf
            {{-- Pangalan ng OFW --}}
            <div class="mb-3">
                <div class="form-label">Pangalan ng OFW</div>
                    <div class="row g-2">
                        {{-- Last Name --}}
                        <div class="col-12 col-sm-4">
                            <div class="sub-label">Last Name</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_lname"
                                value="{{ $ofw->ofw_lname ?? null }}">
                        </div>
                        {{-- First Name --}}
                        <div class="col-12 col-sm-4">
                            <div class="sub-label">First Name</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_fname"
                                value="{{ $ofw->ofw_fname ?? null }}">
                        </div>
                        {{-- Name Extension --}}
                        <div class="col-6 col-sm-2">
                            <div class="sub-label">Name extension</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_ename"
                                value="{{ $ofw->ofw_ename ?? null }}">
                        </div>
                        {{-- Middle Name --}}
                        <div class="col-6 col-sm-2">
                            <div class="sub-label">Middle Name</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_mname"
                                value="{{ $ofw->ofw_mname ?? null }}">
                        </div>
                    </div>
                </div>

                {{-- Jobsite / Job Position --}}
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Jobsite / Bansang Pinagtrabahuhan</label>
                        <input
                            type="text"
                            class="form-control disabled"
                            name="elpor_jobsite"
                            value="{{ $entries['elpor_jobsite'] ?? null }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Job Position / Uri ng Trabaho</label>
                        <input
                            type="text"
                            class="form-control disabled"
                            name="elpor_job_position"
                            value="{{ $entries['elpor_job_position'] ?? null }}">
                    </div>
                </div>

                {{-- Latest Date of Departure / Arrival --}}
                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Latest Date of Departure in Philippines</label>
                        <div class="input-group">
                            <input
                                type="date"
                                class="form-control disabled"
                                name="elpor_latest_date_departure_ph"
                                value="{{ $entries['elpor_latest_date_departure_ph'] ?? null }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Latest Date of Arrival in Philippines</label>
                        <div class="input-group">
                            <input
                                type="date"
                                class="form-control disabled"
                                name="elpor_latest_date_return_ph"
                                value="{{ $entries['elpor_latest_date_return_ph'] ?? null }}">
                        </div>
                    </div>
                </div>

                {{-- Reason for Return --}}
                <div class="mb-3">
                    <label class="form-label">Reason for Return to the Philippines (Latest Return)</label>
                    <div class="sub-label">Dahilan ng Huling Pagbalik sa Pilipinas</div>
                    <input type="text" class="form-control" name="elpor_return_reason" value="{{ $entries['elpor_return_reason'] ?? null }}">
                </div>

                {{-- Divider --}}
                <div class="section-divider"></div>

                {{-- Brief Statement --}}
                <div class="mb-2">
                    <div class="brief-statement-label">
                        BRIEF STATEMENT (Salaysay o Detalye kung ano ang dahilan ng balik sa Pilipinas)
                    </div>
                    <textarea
                        class="form-control"
                        name="elpor_return_reason_details"
                        rows="4">{{ $entries['elpor_return_reason_details'] ?? null }}</textarea>
                </div>

            </div>{{-- end .form-section --}}

           

            <div class="modal fade" id="senaValidationModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color: #2F5BB7; color: white;">
                            <h5 class="modal-title text-uppercase">Required Field Missing!</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            Please fill up all required fields before proceeding.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                    style="background-color: #2F5BB7; border: none;">OK</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        

</div>


@endsection