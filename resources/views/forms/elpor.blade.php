@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet"/>
<style>
    body {
      background-color: #f4f4f4;
      font-family: 'Assistant', Arial, sans-serif;
    }
 
    .form-header {
      background-color: #FDFFD4;
      padding: 1rem;
      border-radius: 0.25rem;
      margin-bottom: 1rem;
      border: 1px solid #ccc;
    }
 
    .form-header h4 {
      font-weight: bold;
      margin-bottom: 0.5rem;
    }
 
    /* ── ELPOR ACCORDION CLASSES ── */
 
    .elpor-accordion-button {
      background-color: #EFF2FF !important;
      color: #000 !important;
      border: 1px solid #b0c4de !important;
      font-weight: 600;
      font-size: 1rem;
    }
 
    .elpor-accordion-button[aria-expanded="true"],
    .elpor-accordion-button:not(.collapsed),
    .elpor-accordion-button.show {
      background-color: #D9E4F5 !important;
      color: #000 !important;
      box-shadow: none;
    }
 
    .elpor-accordion-button:focus {
      border-color: #b0c4de !important;
      box-shadow: none;
    }
 
    .elpor-accordion-item {
      margin-bottom: 0.5rem;
      border: none !important;
    }
 
    .elpor-accordion-body,
    .elpor-accordion-collapse .elpor-accordion-body,
    .elpor-accordion-collapse.show .elpor-accordion-body,
    .elpor-accordion-collapse.collapsing .elpor-accordion-body {
      background-color: #D9E4F5 !important;
      border-top: 1px solid #b0c4de;
    }
 
    .elpor-section-content {
      background-color: transparent;
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
 
    /* ── GABAY banner ── */
    .gabay-banner {
      background-color: #FDFFD4;
      border: 1px solid #ccc;
      border-radius: 0.25rem;
      padding: 0.5rem 0.75rem;
      font-size: 0.82rem;
      margin-bottom: 1rem;
    }
 
    /* ── Upload image box ── */
    .upload-box {
      width: 110px;
      height: 110px;
      border: 1.5px dashed #aaa;
      border-radius: 0.25rem;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      color: #666;
      background: #fff;
      cursor: pointer;
      text-align: center;
    }
 
    .upload-box span.plus {
      font-size: 1.8rem;
      line-height: 1;
      color: #aaa;
    }
 
    /* ── Program component header grid ── */
    .program-component-grid {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 1rem;
    }
 
    .program-fields label {
      font-size: 0.82rem;
      margin-bottom: 0.1rem;
    }
 
    .program-fields .field-row {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      margin-bottom: 0.35rem;
    }
 
    .program-fields .field-row label {
      min-width: 90px;
      margin: 0;
    }
 
    .program-fields .field-row input {
      flex: 1;
      height: 24px;
      font-size: 0.82rem;
      border: 1px solid #ccc;
      border-radius: 3px;
      padding: 0 4px;
    }
 
    /* ── Section form labels — match blade's .form-label ── */
    .section-label {
      font-size: 1rem;
      font-weight: 400;
      margin-bottom: 0.5rem;
      display: block;
      color: #212529;
    }
 
    /* ── Sub-section headings — match blade's h6.fw-bold ── */
    .section-subheading {
      font-size: 1rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }
 
    /* make accordion items look card-like */
    .elpor-accordion-item {
      border-radius: 0.25rem !important;
      overflow: hidden;
    }
</style>

<div class="container py-4">
 
  <!-- ── Form Header ── -->

    <div class="form-header text-center">
        <h4>ENHANCED LIVELIHOOD PROGRAM FOR OFW REINTEGRATION (ELPOR) APPLICATION FORM</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>
 
    <!-- ── Gabay Banner ── -->
    <div class="gabay-banner">
        <strong>GABAY SA PAGSAGOT:</strong> Kumpletuhing sagutin ang lahat ng mga hinihiling impormasyon gamit ang block ball-point pen. Siguraduhin na naintindihan at tama ang impormasyon.
    </div>

    <form method="POST" action="{{ route('forms.step.store', $step) }}" enctype="multipart/form-data">
        @csrf
        <!-- ── Accordion ── -->
        <div class="accordion" id="ofwAccordion">
        
            <!-- Section I -->
            <div class="accordion-item elpor-accordion-item">
            <h2 class="accordion-header" id="headingI">
                <button
                class="accordion-button elpor-accordion-button"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseI"
                aria-expanded="true"
                aria-controls="collapseI">
                I. DATOS TUNGKOL SA OFW
                </button>
            </h2>
            <div id="collapseI" class="accordion-collapse collapse show elpor-accordion-collapse" aria-labelledby="headingI" data-bs-parent="#ofwAccordion">
                <div class="accordion-body elpor-accordion-body">
                    <div class="elpor-section-content">
        
                        <!-- Pangalan ng OFW -->
                        <h6 class="section-subheading">Pangalan ng OFW</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-6 col-md-3">
                                <label class="section-label">Last Name</label>
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_lname') }}"/>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">First Name</label>
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_fname') }}"/>
                            </div>
                            <div class="col-6 col-md-2">
                                <label class="section-label">Suffix</label>
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_ename') }}"/>
                            </div>
                            <div class="col-6 col-md-4">
                                <label class="section-label">Middle Name</label>
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_mname') }}"/>
                            </div>
                        </div>
            
                        <!-- Address -->
                        
            
                        <div class="row g-2 mb-3">
                            <div class="col-6 col-md-3">
                                <label class="section-label">Birthdate</label>
                                <input type="date" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_bday') }}" readonly/>
                            </div>
                            <div class="col-6 col-md-2">
                                <label class="section-label">Age</label>
                                <input type="number" class="form-control" name="elpor_ofw_age" value="{{ session ('forms.data.elpor.elpor_ofw_age') }}"/>
                            </div>
                            <div class="col-6 col-md-2">
                                <label class="section-label">Gender</label>
                                <!-- <select class="form-select">
                                    <option value="">Select</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select> -->
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_gender') }}"/>
                            </div>
                            <div class="col-6 col-md-2">
                                <label class="section-label">Civil Status</label>
                                <!-- <select class="form-select">
                                    <option value="">Select</option>
                                    <option>Single</option><option>Married</option>
                                    <option>Widowed</option>
                                </select> -->
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_civil_status') }}">
                            </div>
                            <div class="col-12 col-md-3">
                                <label class="section-label">Other Data</label>
                                <select class="form-select" name="elpor_ofw_other_data">
                                    <option value="" selected disabled>Select</option>
                                    <option value="Person With Disability" {{ session('forms.data.elpor.elpor_ofw_other_data') === 'Person With Disability' ? 'selected' : ''}}>Person With Disability</option>
                                    <option value="Senior Citizen" {{ session('forms.data.elpor.elpor_ofw_other_data') === 'Senior Citizen' ? 'selected' : ''}}>Senior Citizen</option>
                                    <option value="Solo Parent" {{ session('forms.data.elpor.elpor_ofw_other_data') === 'Solo Parent' ? 'selected' : ''}}>Solo Parent</option>
                                    <option value="Indigenous People" {{ session('forms.data.elpor.elpor_ofw_other_data') === 'Indigenous People' ? 'selected' : ''}}>Indigenous People</option>
                                    <option value="LGBTQIA+" {{ session('forms.data.elpor.elpor_ofw_other_data') === 'LGBTQIA+' ? 'selected' : ''}}>LGBTQIA+</option>
                                </select>
                            </div>
                        </div>
            
                        <!-- Contact -->
                        <h6 class="section-subheading">Contact Information</h6>
                        <div class="row g-2">
                            <div class="col-6 col-md-3">
                                <label class="section-label">Cellphone Number 1:</label>
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_phone') }}"/>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">Cellphone Number 2:</label>
                                <input type="text" class="form-control" name="elpor_phone_secondary" value="{{ session('forms.data.elpor.elpor_phone_secondary') }}"/>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">Email Address</label>
                                <input type="email" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_email') }}"/>
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">Facebook Account</label>
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_fb_acc') }}"/>
                            </div>
                        </div>

                        <h6 class="section-subheading">Address in the Philippines</h6>
                        <div class="mb-2">
                            <label class="section-label">Unit/Room/House Number/ Street name</label>
                            <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_house_no') }}"/>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6 col-md-3">
                                <label class="section-label">Province</label>
                                <!-- <select class="form-select"><option value="">Select</option></select> -->
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_province_name') }}">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">City/ Municipality</label>
                                <!-- <select class="form-select"><option value="">Select</option></select> -->
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_municipality_name') }}">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">Barangay</label>
                                <!-- <select class="form-select"><option value="">Select</option></select> -->
                                <input type="text" class="form-control disabled" value="{{ session('forms.data.rfa.ofw_barangay_name') }}">
                            </div>
                            <div class="col-6 col-md-3">
                                <label class="section-label">Zip Code</label>
                                <input type="text" class="form-control disabled" placeholder="ex. 2016" value="{{ session('forms.data.rfa.ofw_zip_code') }}"/>
                            </div>
                        </div>
            
                    </div>
                    </div>
                </div>
            </div>
        
            <!-- Section II -->
            <div class="accordion-item elpor-accordion-item">
                <h2 class="accordion-header" id="headingII">
                    <button
                    class="accordion-button elpor-accordion-button collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#collapseII"
                    aria-expanded="false"
                    aria-controls="collapseII">
                    II. DATOS TUNGKOL SA OFW EMPLOYMENT
                    </button>
                </h2>
                <div id="collapseII" class="accordion-collapse collapse elpor-accordion-collapse" aria-labelledby="headingII" data-bs-parent="#ofwAccordion">
                    <div class="accordion-body elpor-accordion-body">
                        <div class="elpor-section-content">
                            <div class="row g-2 mb-2">
                                <div class="col-12 col-md-6">
                                    @if(session('forms.data.aksyon.aksyon_jobsite') || session('forms.data.sena.sena_jobsite'))
                                        <label class="section-label"><span class="d-none d-md-inline">Jobsite/</span>Bansang Pinagtatrabahuhan</label>
                                        <input type="text" class="form-control disabled" name="elpor_jobsite" value="{{ session('forms.data.aksyon.aksyon_jobsite') ??  session('forms.data.sena.sena_jobsite')}}"/>
                                    @else
                                        <label class="section-label"><span class="d-none d-md-inline">Jobsite/</span>Bansang Pinagtatrabahuhan</label>
                                        <!-- <input type="text" class="form-control" name="elpor_jobsite" value="{{ session('forms.data.aksyon.aksyon_jobsite') ??  session('forms.data.sena.sena_jobsite')}}"/> -->
                                        <select class="form-select" name="elpor_jobsite" id="elpor_jobsite">
                                            <option selected disabled>Select</option>
                                        </select>
                                        <input type="hidden" name="elpor_jobsite_name" id="elpor_jobsite_name">
                                    @endif
                                </div>
                                <div class="col-12 col-md-6">
                                    @if(session('forms.data.aksyon.aksyon_jobsite') || session('forms.data.sena.sena_jobsite'))
                                        <label class="section-label">Position/Uri ng Trabaho</label>
                                        <input type="text" class="form-control disabled" name="elpor_job_position" value="{{ session('forms.data.aksyon.akyon_job_position') ?? session('forms.data.sena.sena_job_position') }}"/>
                                    @else
                                        <label class="section-label">Position/Uri ng Trabaho</label>
                                        <input type="text" class="form-control" name="elpor_job_position" value="{{ session('forms.data.elpor.elpor_job_position') }}"/>
                                    @endif
                                </div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="col-12 col-md-6">
                                    <label class="section-label">Latest Date of Departure in the Philippines</label>
                                    <input type="date" class="form-control" name="elpor_latest_date_departure_ph" value="{{ session('forms.data.elpor.elpor_latest_date_departure_ph') }}"/>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="section-label">Latest Date of Arrival in the Philippines</label>
                                    <input type="date" class="form-control" name="elpor_latest_date_return_ph" value="{{ session('forms.data.elpor.elpor_latest_date_return_ph') }}"/>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col-12 col-md-6">
                                    <label class="section-label">Latest Contract Duration <span class="fst-italic">(Start)</span></label>
                                    <input type="date" class="form-control" name="elpor_contract_start" value="{{ session('forms.data.elpor.elpor_contract_start') }}"/>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label class="section-label">Latest Contract Duration <span class="fst-italic">(End)</span></label>
                                    <input type="date" class="form-control" name="elpor_contract_end" value="{{ session('forms.data.elpor.elpor_contract_end') }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Section III -->
            <div class="accordion-item elpor-accordion-item">
            <h2 class="accordion-header" id="headingIII">
                <button
                class="accordion-button elpor-accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseIII"
                aria-expanded="false"
                aria-controls="collapseIII">
                III. DATOS TUNGKOL SA NEGOSYO
                </button>
            </h2>
            <div id="collapseIII" class="accordion-collapse collapse elpor-accordion-collapse" aria-labelledby="headingIII" data-bs-parent="#ofwAccordion">
                <div class="accordion-body elpor-accordion-body">
                    <div class="elpor-section-content">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Type Of Business o Uri ng Negosyo Na Nais Umpisahan</label>
                            <input type="text" class="form-control" name="elpor_business_type" value="{{ session('forms.data.elpor.elpor_business_type') }}"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Business Site o Kumpletong Lokasyon ng Negosyo</label>
                            <input type="text" class="form-control" name="elpor_business_site" value="{{ session('forms.data.elpor.elpor_business_site') }}"/>
                        </div>
                        <div class="mb-2">
                            <label class="form-label fw-bold">Meron bang Existing Business o Kasalukusay Negosyo</label>
                            <div class="d-flex gap-3 mb-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="elpor_existing_business" id="bizYes" value="Yes" {{ session('forms.data.elpor.elpor_existing_business') === 'Yes' ? 'checked' : ''}}/>
                                    <label class="form-check-label" for="bizYes">YES</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="elpor_existing_business" id="bizNo" value="No" {{ session('forms.data.elpor.elpor_existing_business') === 'No' ? 'checked' : ''}}/>
                                    <label class="form-check-label" for="bizNo">NO</label>
                                </div>
                            </div>
                            <label class="section-label">Please Specify (If yes)</label>
                            <input type="text" class="form-control" name="elpor_existing_business_specify" value="{{ session('forms.data.elpor.elpor_existing_business_specify') }}"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- Section IV -->
            <div class="accordion-item elpor-accordion-item">
            <h2 class="accordion-header" id="headingIV">
                <button
                class="accordion-button elpor-accordion-button collapsed"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapseIV"
                aria-expanded="false"
                aria-controls="collapseIV">
                IV. MGA PAGSASANAY SA NEGOSYO
                </button>
            </h2>
            <div id="collapseIV" class="accordion-collapse collapse elpor-accordion-collapse" aria-labelledby="headingIV" data-bs-parent="#ofwAccordion">
                <div class="accordion-body elpor-accordion-body">
                    <div class="elpor-section-content">
            
                        <!-- ADD button -->
                        <div class="d-flex justify-content-end mb-2">
                            <button type="button" class="btn btn-confirm btn-sm px-3" id="addTrainingRow">+ ADD</button>
                        </div>
            
                        <!-- Training table -->
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered align-middle mb-0" id="trainingTable" style="background:#fff; font-size:0.95rem;">
                                <thead>
                                    <tr style="background:#e8eef7;">
                                        <th style="width:30%; font-weight:700; font-size:0.9rem;">
                                        KIND OF TRAINING / URI NG PAGSASANAY
                                        <div style="font-weight:400; font-size:0.78rem; color:#555;">(i.e FAS-SBMT, Entrepreneurship Training, Skills Training, etc.)</div>
                                        </th>
                                        <th style="font-weight:700; font-size:0.9rem; text-align:center;">VENUE / LUGAR</th>
                                        <th style="font-weight:700; font-size:0.9rem; text-align:center;">ISSUED BY / NAGBIGAY NG PAGSASANAY</th>
                                        <th style="font-weight:700; font-size:0.9rem; text-align:center;">DATE / PETSA</th>
                                    </tr>
                                </thead>
                                <tbody id="trainingTableBody">

                                    @php
                                        $trainingKinds = session('forms.data.elpor.training_kind', []);
                                        $trainingVenues = session('forms.data.elpor.training_venue', []);
                                        $trainingIssuedBy = session('forms.data.elpor.training_issued_by', []);
                                        $trainingDates = session('forms.data.elpor.training_date', []);
                                    @endphp

                                    @if(count($trainingKinds) > 0)
                                        @foreach($trainingKinds as $index => $kind)
                                            <tr>
                                                <td style="font-size:0.9rem;">
                                                    {{ $kind }}
                                                    <input type="hidden" name="training_kind[]" value="{{ $kind }}">
                                                </td>

                                                <td style="font-size:0.9rem;">
                                                    {{ $trainingVenues[$index] ?? '' }}
                                                    <input type="hidden" name="training_venue[]" value="{{ $trainingVenues[$index] ?? '' }}">
                                                </td>

                                                <td style="font-size:0.9rem;">
                                                    {{ $trainingIssuedBy[$index] ?? '' }}
                                                    <input type="hidden" name="training_issued_by[]" value="{{ $trainingIssuedBy[$index] ?? '' }}">
                                                </td>

                                                <td style="font-size:0.9rem;">
                                                    {{ $trainingDates[$index] ?? '' }}
                                                    <input type="hidden" name="training_date[]" value="{{ $trainingDates[$index] ?? '' }}">
                                                </td>

                                                <td class="text-center">
                                                    <button type="button"
                                                            class="btn btn-sm btn-link text-danger p-0 remove-row"
                                                            title="Remove">
                                                        &times;
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr id="trainingEmptyRow">
                                            <td colspan="5"
                                                class="text-center text-muted py-3"
                                                style="font-size:0.88rem;">
                                                No training records added yet. Click <strong>+ ADD</strong> to add one.
                                            </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
            
                            <!-- Signature / name + date fields -->
                            <div class="row g-3" style="border-top: 1px solid #b0c4de; padding-top: 1rem;">
                                    <div class="col-6 text-center">
                                        <input type="text" class="form-control text-center" name="applicant_name"
                                            value="{{ session('forms.data.rfa.ofw_fname') . ' ' . session('forms.data.rfa.ofw_mname') . ' ' . session('forms.data.rfa.ofw_lname') . ' ' . session('forms.data.rfa.ofw_ename') }}"/>
                                        <div class="mt-1" style="font-weight:700; font-size:0.9rem; letter-spacing:0.03em;">KUMPLETONG PANGALAN</div>
                                    </div>
                                    <div class="col-6 text-center">
                                        <input type="date" class="form-control text-center" name="applicant_date" value="{{ date('Y-m-d') }}"/>
                                    <div class="mt-1" style="font-weight:700; font-size:0.9rem; letter-spacing:0.03em;">PETSA</div>
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>
        
        </div><!-- /accordion -->

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

    document.addEventListener("DOMContentLoaded", function(){
        // ── Section IV: Training Modal ──
        const trainingModal = new bootstrap.Modal(document.getElementById('trainingModal'));
        
        document.getElementById('addTrainingRow').addEventListener('click', function () {
            // Clear modal fields
            document.getElementById('modal_kind').value = '';
            document.getElementById('modal_venue').value = '';
            document.getElementById('modal_issued_by').value = '';
            document.getElementById('modal_date').value = '';
            document.getElementById('trainingModalError').classList.add('d-none');
            trainingModal.show();
        });
        
        document.getElementById('confirmTrainingBtn').addEventListener('click', function () {
            const kind     = document.getElementById('modal_kind').value.trim();
            const venue    = document.getElementById('modal_venue').value.trim();
            const issuedBy = document.getElementById('modal_issued_by').value.trim();
            const date     = document.getElementById('modal_date').value.trim();
            const errorEl  = document.getElementById('trainingModalError');
        
            if (!kind || !venue || !issuedBy || !date) {
            errorEl.classList.remove('d-none');
            return;
            }
        
            errorEl.classList.add('d-none');
        
            // Remove empty-state row if present
            const emptyRow = document.getElementById('trainingEmptyRow');
            if (emptyRow) emptyRow.remove();
        
            const tbody = document.getElementById('trainingTableBody');
            const tr = document.createElement('tr');
            tr.innerHTML = `
            <td style="font-size:0.9rem;">${escHtml(kind)}<input type="hidden" name="training_kind[]" value="${escHtml(kind)}"/></td>
            <td style="font-size:0.9rem;">${escHtml(venue)}<input type="hidden" name="training_venue[]" value="${escHtml(venue)}"/></td>
            <td style="font-size:0.9rem;">${escHtml(issuedBy)}<input type="hidden" name="training_issued_by[]" value="${escHtml(issuedBy)}"/></td>
            <td style="font-size:0.9rem;">${escHtml(date)}<input type="hidden" name="training_date[]" value="${escHtml(date)}"/></td>
            <td class="text-center">
                <button type="button" class="btn btn-sm btn-link text-danger p-0 remove-row" title="Remove">&times;</button>
            </td>
            `;
            tbody.appendChild(tr);
            trainingModal.hide();
        });
        
        document.getElementById('trainingTableBody').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-row')) {
            e.target.closest('tr').remove();
            if (this.querySelectorAll('tr').length === 0) {
                const emptyTr = document.createElement('tr');
                emptyTr.id = 'trainingEmptyRow';
                emptyTr.innerHTML = `<td colspan="5" class="text-center text-muted py-3" style="font-size:0.88rem;">No training records added yet. Click <strong>+ ADD</strong> to add one.</td>`;
                this.appendChild(emptyTr);
            }
            }
        });
        
        function escHtml(str) {
            return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
        }

        const countrySelect = document.getElementById('elpor_jobsite');
        const oldCountry = "{{ session('forms.data.elpor.elpor_jobsite') }}";
        function resetSelect(selectEl, text) {
            selectEl.innerHTML = '';
            
            const option = document.createElement('option');
            option.value = '';
            option.textContent = text;
            option.selected = true;
            
            selectEl.appendChild(option);
            selectEl.disabled = true;
        }

        function populateSelect(selectEl, items, valueKey, labelKey, defaultText = 'Select') {
            resetSelect(selectEl, defaultText);

            items.forEach(item => {
                const option = document.createElement('option');
                option.value = item[valueKey];
                option.textContent = item[labelKey];
                selectEl.appendChild(option);
            });

            selectEl.disabled = false;

            if(selectEl === countrySelect && oldCountry){
              selectEl.value = oldCountry;

              // also update hidden country name
              const countryName = selectEl.options[selectEl.selectedIndex]?.text || '';
              document.getElementById('elpor_jobsite_name').value = countryName;
          }
        }

        resetSelect(countrySelect, 'Loading countries...');

        fetch('https://api.first.org/data/v1/countries?limit=250')
          .then(response => {
              if (!response.ok) {
              throw new Error(`Country API status: ${response.status}`);
              }
              return response.json();
          })
          .then(data => {
              if (!data || !data.data) {
              throw new Error('No countries found');
              }

              const countries = Object.entries(data.data)
              .map(([code, value]) => {
                  let name = (value.country || '').trim();

                  // Normalize to remove parentheses/annotations and reduce to base country name
                  // Examples: "Congo (the Democratic Republic of the)" => "Congo"
                  //           "the Bahamas" => "Bahamas"
                  //           "(French Southern Territories)" => "French Southern Territories"
                  name = name.replace(/\s*\(.*?\)/g, '').trim();
                  name = name.replace(/^the\s+/i, '').trim();
                  name = name.replace(/\s{2,}/g, ' ').trim();

                  // If parentheses stripped to nothing, fallback to values from name fields
                  if (!name && value.name && typeof value.name === 'object') {
                  name = (value.name.common || value.name.official || '').trim();
                  }

                  return { code: code.toUpperCase(), name };
              })
              .filter(c => c.code && c.name)
              .reduce((acc, item) => {
                  // dedupe by normalized name
                  const found = acc.find(i => i.name.toLowerCase() === item.name.toLowerCase());
                  if (!found) acc.push(item);
                  return acc;
              }, [])
              .sort((a, b) => a.name.localeCompare(b.name, 'en', { sensitivity: 'base' }));

              if (!countries.length) {
              throw new Error('No selectable countries found after mapping');
              }

          //   console.log(`Loaded ${countries.length} countries`);
              populateSelect(countrySelect, countries, 'code', 'name', 'Select Country');
          })
          .catch(error => {
              console.error('Error fetching countries:', error);
              const fallbackCountries = [
              { code: 'PH', name: 'Philippines' },
              { code: 'US', name: 'United States' },
              { code: 'CA', name: 'Canada' },
              { code: 'GB', name: 'United Kingdom' },
              { code: 'AU', name: 'Australia' }
              ];
              console.warn('Using fallback country list');
              populateSelect(countrySelect, fallbackCountries, 'code', 'name', 'Select Country');
          });

          // Sync country name when selected
          countrySelect.addEventListener('change', function() {
          const countryName = this.options[this.selectedIndex].text;
          document.getElementById('elpor_jobsite_name').value = countryName;
        });
    });
  
</script>
@endsection