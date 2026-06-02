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

    {{-- Form Header --}}
    <div class="form-header">
        <strong>OFW STATEMENT FORM</strong>
    </div>

    {{-- Main Form Section --}}
    <div class="form-section">

        <form method="POST" action="{{ route('forms.step.store', $step) }}" enctype="multipart/form-data">
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
                                value="{{ session('forms.data.rfa.ofw_lname') }}">
                        </div>
                        {{-- First Name --}}
                        <div class="col-12 col-sm-4">
                            <div class="sub-label">First Name</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_fname"
                                value="{{ session('forms.data.rfa.ofw_fname') }}">
                        </div>
                        {{-- Name Extension --}}
                        <div class="col-6 col-sm-2">
                            <div class="sub-label">Name extension</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_ename"
                                value="{{ session('forms.data.rfa.ofw_ename') }}">
                        </div>
                        {{-- Middle Name --}}
                        <div class="col-6 col-sm-2">
                            <div class="sub-label">Middle Name</div>
                            <input
                                type="text"
                                class="form-control disabled"
                                name="ofw_mname"
                                value="{{ session('forms.data.rfa.ofw_mname') }}">
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
                            value="{{ session('forms.data.elpor.elpor_jobsite_name') }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Job Position / Uri ng Trabaho</label>
                        <input
                            type="text"
                            class="form-control disabled"
                            name="elpor_job_position"
                            value="{{ session('forms.data.elpor.elpor_job_position') }}">
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
                                value="{{ session('forms.data.elpor.elpor_latest_date_departure_ph') }}">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Latest Date of Arrival in Philippines</label>
                        <div class="input-group">
                            <input
                                type="date"
                                class="form-control disabled"
                                name="elpor_latest_date_return_ph"
                                value="{{ session('forms.data.elpor.elpor_latest_date_return_ph') }}">
                        </div>
                    </div>
                </div>

                {{-- Reason for Return --}}
                <div class="mb-3">
                    <label class="form-label">Reason for Return to the Philippines (Latest Return)</label>
                    <div class="sub-label">Dahilan ng Huling Pagbalik sa Pilipinas</div>
                    <input type="text" class="form-control" name="elpor_return_reason" value="{{ session('forms.data.ofw_statement.elpor_return_reason') }}">
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
                        rows="4">{{ session('forms.data.ofw_statement.elpor_return_reason_details') ?? '' }}</textarea>
                </div>

            </div>{{-- end .form-section --}}

            @php
                $steps = session('forms.steps', []);
                $currentStep = request()->segment(3); // /forms/step/{step}
                $currentIndex = array_search($currentStep, $steps);
                $previousStep = ($currentIndex !== false && $currentIndex > 0) ? $steps[$currentIndex - 1] : null;
                $nextStep = ($currentIndex !== false && $currentIndex < count($steps) - 1) ? $steps[$currentIndex + 1] : null;
            @endphp

            <div class="step-wrapper">
                <ul class="steps">
                    @foreach($steps as $index => $step)
                        <li class="step 
                            {{ $step == $currentStep ? 'active' : '' }}
                            {{ array_search($step,$steps) < array_search($currentStep,$steps) ? 'completed' : '' }}">
                            <span>{{ $index + 1 }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" name="action" value="back"
                    class="btn btn-back {{ $previousStep ? '' : 'disabled' }}">
                        ← BACK
                </button>

                <button type="submit" name="action" value="next"
                        class="btn btn-next">
                    NEXT →
                </button>
            </div>

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