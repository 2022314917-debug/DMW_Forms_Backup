@extends('layouts.app')

@section('content')
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


    .aksyon-accordion-button {
        background-color: #EFF2FF !important;
        color: #000 !important;
        border: 1px solid #b0c4de !important;
        font-weight: 500;
    }

    .aksyon-accordion-button[aria-expanded="true"],
    .aksyon-accordion-button:not(.collapsed),
    .aksyon-accordion-button.show {
        background-color: #D9E4F5 !important;
        color: #000 !important;
        box-shadow: none;
    }

    .aksyon-accordion-button:focus {
        border-color: #b0c4de !important;
        box-shadow: none;
    }


    .aksyon-accordion-item {
        margin-bottom: 0.5rem;
    }

    .aksyon-accordion-body,
    .aksyon-accordion-collapse .aksyon-accordion-body,
    .aksyon-accordion-collapse.show .aksyon-accordion-body,
    .aksyon-accordion-collapse.collapsing .aksyon-accordion-body {
        background-color: #D9E4F5 !important;
        border-top: 1px solid #b0c4de;
    }

    .aksyon-section-content {
        background-color: transparent;
    }

    
</style>

<link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">



<div class="container my-5">
    <!-- Header Section -->
    <div class="form-header text-center">
        <h4>ONLINE REQUEST FOR ASSISTANCE</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Accordion Form -->
        <div class="accordion mb-5" id="requestAccordion">
        <!-- Section A: Personal Information -->
        <div class="accordion-item aksyon-accordion-item">
            <h2 class="accordion-header" id="headingA">
                <button 
                    class="accordion-button aksyon-accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseA" 
                    aria-expanded="false" 
                    aria-controls="collapseA">
                    A. PERSONAL INFORMATION
                </button>
            </h2>
            <div 
                id="collapseA" 
                class="accordion-collapse collapse aksyon-accordion-collapse" 
                aria-labelledby="headingA" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body aksyon-accordion-body aksyon-section-content">
                    <!-- Pangalan ng OFW -->
                    <div class="mb-3"> 
                        <h6 class="fw-bold mb-3">Pangalan ng OFW</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control disabled" placeholder="Dela Cruz" name="ofw_lname" value="{{ session('general_form_data.ofw_lname') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control disabled" placeholder="Juan" name="ofw_fname" value="{{ session('general_form_data.ofw_fname') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name extension</label>
                                <input type="text" class="form-control disabled" placeholder="Jr/Sr/III" name="ofw_ename" value="{{ session('general_form_data.ofw_ename') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control disabled" placeholder="Santos" name="ofw_mname" value="{{ session('general_form_data.ofw_mname') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Birthday, Sex, Civil Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control disabled" name="ofw_bday" value="{{ session('general_form_data.ofw_bday') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sex</label>
                            <select class="form-select disabled" name="ofw_sex" value="{{ session('general_form_data.ofw_sex') }}">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Civil Status</label>
                            <select class="form-select" name="ofw_civil_status">
                                <option value="">Select</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                            </select>
                        </div>
                    </div>

                    <!-- Address in the Philippines -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Address in the Philippines</h6>
                        <div class="mb-2">
                            <label class="form-label">Unit/Room/House Number/Street name</label>
                            <input type="text" class="form-control" name="ofw_address_street">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Province</label>
                                <select class="form-select" name="ofw_province" id="ofw_province">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" name="ofw_province_name" id="ofw_province_name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City/ Municipality</label>
                                <select class="form-select" name="ofw_municipality" id="ofw_municipality">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" name="ofw_municipality_name" id="ofw_municipality_name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barangay</label>
                                <select class="form-select" name="ofw_barangay" id="ofw_barangay">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" name="ofw_barangay_name" id="ofw_barangay_name">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="ofw_zipcode" name="ofw_zipcode">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Number, Email, Facebook -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" placeholder="ex. 09123456768" name="ofw_phone" value="{{ session('general_form_data.ofw_phone') }}" disabled>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="ex. sample@email.com" name="ofw_email">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Facebook/Messenger Acc.</label>
                            <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_facebook">
                        </div>
                    </div>

                    <!-- Passport and Return Date -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Passport / Travel Document No.</label>
                            <input type="text" class="form-control" placeholder="24-4645781-7" name="ofw_passport">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pinakahuling Petsa ng Pagbalik sa Pilipinas</label>
                            <input type="date" class="form-control" name="ofw_return_date">
                        </div>
                    </div>

                    <!-- Years and Jobsite -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kabuuang bilang ng Taon bilang OFW</label>
                            <input type="text" class="form-control" placeholder="ex. 6" name="ofw_years">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jobsite / Bansang Pinagtatrabahuhan</label>
                            <input type="text" class="form-control" name="ofw_country" id="ofw_country" value=" {{ session('general_form_data.ofw_country_name') }}">
                        </div>
                    </div>

                    <!-- Complete Address Abroad and Job Position -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kompletong Address sa Abroad</label>
                            <input type="text" class="form-control" placeholder="Abu Dhabi, United Arab Emirates" name="ofw_address_abroad">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Job Position</label>
                            <input type="text" class="form-control disabled" placeholder="Factory Worker" name="ofw_job_position" value="{{ session('general_form_data.ofw_job') }}">
                        </div>
                    </div>

                    <!-- Agency and Return Reason -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Agency / Employer</label>
                            <input type="text" class="form-control disabled" placeholder="JS Contractor Inc." name="ofw_agency" value="{{ session('general_form_data.ofw_agency') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kadahilanan ng Pagbalik sa Pilipinas</label>
                            <select class="form-select" name="ofw_return_reason">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>

                    <!-- OWWA Member -->
                    <div class="mb-3">
                        <label class="form-label">OWWA Member</label>
                        <select class="form-select" name="ofw_owwa_member">
                            <option value="">Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <!-- Maikling Salaysay -->
                    <div class="mb-3">
                        <label class="form-label">Maikling Salaysay ng Pagbalik</label>
                        <textarea class="form-control" rows="4" name="ofw_brief_description"></textarea>
                    </div>

                    <!-- Programs -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nakapag-avail ka na ba ng alinman sa mga sumusunod na programa o tulong?</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="program_owwa" id="program_owwa" value="1">
                            <label class="form-check-label" for="program_owwa">
                                Nakakapag-avail na ako ng OWWA Balik Pinas, Balik Hanapbuhay Program
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="program_nrco" id="program_nrco" value="1">
                            <label class="form-check-label" for="program_nrco">
                                Nakakapag-avail na ako ng NRCO Livelihood Program para sa Reintegration ng mga OFW
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="program_aksyon" id="program_aksyon" value="1">
                            <label class="form-check-label" for="program_aksyon">
                                Nakakapag-avail na ako ng AKSYON Fund sa Jobsite / Pagdating sa Pilipinas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="program_none" id="program_none" value="1">
                            <label class="form-check-label" for="program_none">
                                Hindi pa.
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section B: OFW Family Information -->
        <div class="accordion-item aksyon-accordion-item">
            <h2 class="accordion-header" id="headingB">
                <button 
                    class="accordion-button aksyon-accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseB" 
                    aria-expanded="false" 
                    aria-controls="collapseB">
                    B. IMPORMASYON NG KAMAG-ANAK NG OFW NA HUMIHINGING NG TULONG
                </button>
            </h2>
            <div 
                id="collapseB" 
                class="accordion-collapse collapse aksyon-accordion-collapse" 
                aria-labelledby="headingB" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body aksyon-accordion-body aksyon-section-content">
                    <p class="mb-3">Paalala: Sagutan lamang ang bahagang ito kung ang kamag-anak ng OFW ang humihiling ng tulong. Maaaari itong laktawan kung ang mismong OFW ang nagsususumiite ng form.</p>

                    <!-- Pangalan ng Kamag-anak -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Pangalan ng Kamag-anak</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control disabled" placeholder="Dela Cruz" name="party_lname" value="{{ session('general_form_data.party_lname') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control disabled" placeholder="Juan" name="party_fname" value="{{ session('general_form_data.party_fname') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name extension</label>
                                <input type="text" class="form-control disabled" placeholder="Jr/Sr/III" name="party_ename" value="{{ session('general_form_data.party_ename') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control disabled" placeholder="Santos" name="party_mname" value="{{ session('general_form_data.party_mname') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Birthday, Relationship -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control disabled" name="party_bday" value="{{ session('general_form_data.party_bday') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Relationship to OFW</label>
                            <input type="text" class="form-control disabled" name="party_relationship" value="{{ session('general_form_data.party_relationship') }}">
                        </div>

                    </div>

                    <!-- Government ID -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Valid Government ID and ID No.</label>
                            <input type="text" class="form-control" name="party_gov_id">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control disabled" placeholder="ex. sample@email.com" name="party_email" value="{{ session('general_form_data.party_email') }}">
                        </div>
                    </div>

                    <!-- Address in the Philippines -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Kompletong Address sa Pilipinas</h6>
                        <div class="mb-2">
                            <label class="form-label">Unit/Room/House Number/Street name</label>
                            <input type="text" class="form-control disabled" name="party_address_street" value="{{ session('general_form_data.party_address_street') }}">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Province</label>
                                <input type="text" class="form-control disabled" name="party_province" value="{{ session('general_form_data.province_name') }}"> 
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City/ Municipality</label>

                                <input type="text" class="form-control disabled" name="party_municipality" value="{{ session('general_form_data.municipality_name') }}"> 

                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barangay</label>
                                <input type="text" class="form-control disabled" name="party_barangay" value="{{ session('general_form_data.barangay_name') }}"> 
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control disabled" placeholder="ex. 2016" name="party_zip_code" value="{{ session('general_form_data.zip_code') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Contact and Social Media -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number (Mobile/ Phone)</label>
                            <input type="text" class="form-control disabled" placeholder="ex. 09123456768" name="party_phone" value="{{ session('general_form_data.party_phone') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Facebook/Messenger Account</label>
                            <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="party_facebook" value="{{ session('general_form_data.party_facebook') }}" {{ session()->has('general_form_data.party_facebook') ? 'disabled' : '' }}>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section C: Type of Assistance -->
        <div class="accordion-item aksyon-accordion-item">
            <h2 class="accordion-header" id="headingC">
                <button 
                    class="accordion-button aksyon-accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseC" 
                    aria-expanded="false" 
                    aria-controls="collapseC">
                    C. URI NG TULONG NA HINIHINGI
                </button>
            </h2>
            <div 
                id="collapseC" 
                class="accordion-collapse collapse aksyon-accordion-collapse" 
                aria-labelledby="headingC" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body aksyon-accordion-body aksyon-section-content">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="assistance_type" id="assistance_medical" value="Medical Assistance">
                        <label class="form-check-label" for="assistance_medical">
                            <strong>Medical Assistance</strong> - para sa pagtugon sa gastusing ng pagpapagamot at pagpapabuti ng kalusugan ng OFW na hindi sakop ng employer o health insurance.
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="assistance_type" id="assistance_financial" value="Financial Assistance">
                        <label class="form-check-label" for="assistance_financial">
                            <strong>Financial Assistance</strong> - para sa agarang tulong pinansyal sa OFW at kaniyang pamilya upang maibsan ang epekto ng krisis o pagkawala ng hanapbuhay.
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="assistance_type" id="assistance_welfare" value="Welfare Assistance">
                        <label class="form-check-label" for="assistance_welfare">
                            <strong>Welfare Assistance</strong> - para sa pagbibigay ng tulong pinansyal o medikal sa mga nakakatandang OFW na may edad 60 pataas na pauwi na sa Pilipinas.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="assistance_type" id="assistance_repatriation" value="Repatriation Assistance">
                        <label class="form-check-label" for="assistance_repatriation">
                            <strong>Repatriation Assistance</strong> - para sa pagbibigay ng tulong sa agarang pagpapauwi ng OFW sa Pilipinas mula sa ibang bansa, kabilang ang koordinasyon sa mga kaukulang ahensya at pagsagot sa kinakailangang gastusin sa repatriation sa panahon ng krisis, emergency, o iba pang hindi inaasahang sitwasyon.
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section D: Brief Description -->
        <div class="accordion-item aksyon-accordion-item">
            <h2 class="accordion-header" id="headingD">
                <button 
                    class="accordion-button aksyon-accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseD" 
                    aria-expanded="false" 
                    aria-controls="collapseD">
                    D. MAIKLING SALAYSAY TUNGKOL SA HINIHINGING TULONG
                </button>
            </h2>
            <div 
                id="collapseD" 
                class="accordion-collapse collapse aksyon-accordion-collapse" 
                aria-labelledby="headingD" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body aksyon-accordion-body aksyon-section-content">
                    <p class="mb-3">Ilahad dito ang maikling paliwanag kung anong uri ng tulong ang inyong hinihingi, kasama ang mahahalagang detalye tulad ng dahilan, kailan at saan ito kinakailangan.</p>
                    <textarea class="form-control" rows="7" placeholder="Text here..." name="brief_description"></textarea>
                </div>
            </div>
        </div>

        <!-- Section E: Bank Account Information -->
        <div class="accordion-item aksyon-accordion-item">
            <h2 class="accordion-header" id="headingE">
                <button 
                    class="accordion-button aksyon-accordion-button collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#collapseE" 
                    aria-expanded="false" 
                    aria-controls="collapseE">
                    E. ACCOUNT KUNG SAAN IDEDEPOSITO ANG PINANSYAL NA TULONG
                </button>
            </h2>
            <div 
                id="collapseE" 
                class="accordion-collapse collapse aksyon-accordion-collapse" 
                aria-labelledby="headingE" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body aksyon-accordion-body aksyon-section-content">
                    <p class="mb-3">Sa pamamagitan ng paglalagay ng inyong bank details, pinahihintulutan ninyo ang Department of Migrant Workers (DMW) na ipasok o i-credit ang aprubadong tulong pinansyal sa inyong inilagay na account.</p>
                    <div class="mb-3">
                        <label class="form-label">Bank Name</label>
                        <input type="text" class="form-control" placeholder="ex. BDO, BPI, etc." name="bank_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bank Branch</label>
                        <input type="text" class="form-control" placeholder="ex. BDO Dolores Branch" name="bank_branch">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Account Number</label>
                        <input type="text" class="form-control" placeholder="ex. 123456789" name="account_number">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Account Name</label>
                        <input type="text" class="form-control" placeholder="Juan Dela Cruz" name="account_name">
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!-- <div class="d-grid gap-2 mt-4">
        <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Next</button>
    </div> -->

    <div class="d-flex justify-content-between mt-4">
        <a href="{{ $previousStep ? url('/forms/step/' . $previousStep) : '#' }}"
          class="btn btn-back {{ $previousStep ? '' : 'disabled' }}">
            ← BACK
        </a>

        <button type="submit" class="btn btn-next">
            NEXT →
        </button>
    </div>
    </form>
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelect = document.getElementById('ofw_province');
        const municipalitySelect = document.getElementById('ofw_municipality');
        const barangaySelect = document.getElementById('ofw_barangay');

        function resetSelect(selectEl, text) {
        selectEl.innerHTML = `<option selected disabled>${text}</option>`;
        selectEl.disabled = true;
      }

      function populateSelect(selectEl, items, valueKey, labelKey) {
        const defaultText = selectEl === provinceSelect
            ? 'Province'
            : selectEl === municipalitySelect
            ? 'City / Municipality'
            : selectEl === barangaySelect
            ? 'Barangay'
            : 'Select';

        resetSelect(selectEl, defaultText);
        items.forEach(item => {
          const option = document.createElement('option');
          option.value = item[valueKey];
          option.textContent = item[labelKey];
          selectEl.appendChild(option);
        });
        selectEl.disabled = false;
        }

        resetSelect(provinceSelect, 'Loading provinces...');
        resetSelect(municipalitySelect, 'City / Municipality');
        resetSelect(barangaySelect, 'Barangay');
  

        // Load country list from first.org (free, no payment, good CORS)
    //   console.log('Loading countries from first.org API...');
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
            populateSelect(countrySelect, fallbackCountries, 'code', 'name');
        });


        const staticRegion3Provinces = [
        { code: '030800000', name: 'Bataan' },
        { code: '031400000', name: 'Bulacan' },
        { code: '034900000', name: 'Nueva Ecija' },
        { code: '035400000', name: 'Pampanga' },
        { code: '036900000', name: 'Tarlac' },
        { code: '037100000', name: 'Zambales' },
        { code: '037700000', name: 'Aurora' }
        ];

        fetch('https://psgc.gitlab.io/api/provinces/')
        .then(response => response.json())
        .then(data => {
            const provinceData = Array.isArray(data)
            ? data
            : (Array.isArray(data.value) ? data.value : []);

            const region3Provinces = provinceData.filter(p => {
            if (!p || !p.regionCode) return false;
            // Accept exact Region 3 code or prefix style
            return p.regionCode === '030000000' || String(p.regionCode).startsWith('030');
            });

            if (!region3Provinces.length) {
            console.warn('PSGC returned no Region 3 provinces, using static fallback');
            populateSelect(provinceSelect, staticRegion3Provinces, 'code', 'name');
            return;
            }

            populateSelect(provinceSelect, region3Provinces, 'code', 'name');
        })
        .catch(error => {
            console.error('Error fetching provinces:', error);
            populateSelect(provinceSelect, staticRegion3Provinces, 'code', 'name');
        });

        provinceSelect.addEventListener('change', function() {
            const provinceCode = this.value;
            const provinceName = this.options[this.selectedIndex].text;
            document.getElementById('ofw_province_name').value = provinceName;
            
            resetSelect(municipalitySelect, 'Loading municipalities...');
            resetSelect(barangaySelect, 'Barangay');

            if (!provinceCode) {
                resetSelect(municipalitySelect, 'City / Municipality');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
                .then(response => response.json())
                .then(data => {
                if (!Array.isArray(data) || !data.length) {
                    throw new Error('No municipalities found');
                }
                populateSelect(municipalitySelect, data, 'code', 'name');
                })
                .catch(error => {
                console.error('Error fetching municipalities:', error);
                resetSelect(municipalitySelect, 'City / Municipality');
                });
        });

        municipalitySelect.addEventListener('change', function() {
        const cityCode = this.value;
        const cityName = this.options[this.selectedIndex].text;
        document.getElementById('ofw_municipality_name').value = cityName;
        
        resetSelect(barangaySelect, 'Loading barangays...');

        if (!cityCode) {
            resetSelect(barangaySelect, 'Barangay');
            return;
        }

        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
            .then(response => response.json())
            .then(data => {
            if (!Array.isArray(data) || !data.length) {
                throw new Error('No barangays found');
            }
            populateSelect(barangaySelect, data, 'code', 'name');
            })
            .catch(error => {
            console.error('Error fetching barangays:', error);
            resetSelect(barangaySelect, 'Barangay');
            });
        });

        // Sync barangay name when selected
        barangaySelect.addEventListener('change', function() {
        const barangayName = this.options[this.selectedIndex].text;
        document.getElementById('ofw_barangay_name').value = barangayName;
        });
    });






  </script>
@endsection
