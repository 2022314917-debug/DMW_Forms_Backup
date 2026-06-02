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

    .btn-confirm{
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
    <!-- Header Section -->
    <div class="form-header text-center">
        <h4>ONLINE REQUEST FOR ASSISTANCE</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>

    <form action="{{ route('forms.rfa.store') }}" method="POST" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="ofw_lname" value="{{ session('forms.data.rfa.ofw_lname') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="ofw_fname" value="{{ session('forms.data.rfa.ofw_fname') }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Name extension</label>
                                    <input type="text" class="form-control" name="ofw_ename" value="{{ session('forms.data.rfa.ofw_ename') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="ofw_mname" value="{{ session('forms.data.rfa.ofw_mname') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Birthday, Sex, Civil Status -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Birthday</label>
                                <input type="date" class="form-control" name="ofw_bday" value="{{ session('forms.data.rfa.ofw_bday') }}" required>
                            </div>  
                            <div class="col-md-4">
                                <label class="form-label">Sex</label>
                                <select class="form-select" name="ofw_gender" required>  
                                    <option value="" selected disabled>Select</option>
                                    <option value="Male" {{ session('forms.data.rfa.ofw_gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ session('forms.data.rfa.ofw_gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Civil Status</label>
                                <select class="form-select" name="ofw_civil_status" required>
                                    <option value="Select" selected disabled>Select</option>
                                    <option value="Single" {{ session('forms.data.rfa.ofw_civil_status') === 'Single' ? 'selected' : '' }}>Single / Walang Asawa</option>
                                    <option value="Married" {{ session('forms.data.rfa.ofw_civil_status') === 'Married' ? 'selected' : '' }}>Married / May Asawa</option>
                                    <option value="Widowed" {{ session('forms.data.rfa.ofw_civil_status') === 'Widowed' ? 'selected' : '' }}>Widow / Widower (Balo)</option>
                                    <option value="Separated" {{ session('forms.data.rfa.ofw_civil_status') === 'Separated' ? 'selected' : '' }}>Separated / Hiwalay</option>
                                    <option value="Solo Parent" {{ session('forms.data.rfa.ofw_civil_status') === 'Solo Parent' ? 'selected' : '' }}>Solo Parent</option>
                                </select>
                            </div>
                        </div>

                        <!-- Address in the Philippines -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-3">Address in the Philippines</h6>
                            <div class="mb-2">
                                <label class="form-label">Unit/Room/House Number/Street name</label>
                                <input type="text" class="form-control" name="ofw_house_no" value="{{ session('forms.data.rfa.ofw_house_no') }}" required>
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" name="ofw_province" id="ofw_province" required>
                                        <option value="">Province</option>
                                    </select>
                                    <input type="hidden" name="ofw_province_name" id="ofw_province_name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">City/ Municipality</label>
                                <select class="form-select" name="ofw_municipality" id="ofw_municipality" disabled required>
                                        <option value="">City / Municipality</option>
                                    </select>
                                    <input type="hidden" name="ofw_municipality_name" id="ofw_municipality_name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Barangay</label>
                                    <select class="form-select" name="ofw_barangay" id="ofw_barangay" disabled required>
                                        <option value="">Barangay</option>
                                    </select>
                                    <input type="hidden" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ old('ofw_barangay_name') }}">

                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Zip Code</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="ofw_zip_code" 
                                        placeholder="ex. 2016" 
                                        value="{{ session('forms.data.rfa.ofw_zip_code') }}" 
                                        maxlength="4"          
                                        pattern="\d{4}"         
                                        inputmode="numeric"     
                                        oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);" 
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <!-- Contact Number, Email, Facebook -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Contact Number</label>
                                <input type="text" class="form-control" name="ofw_phone" value="{{ session('forms.data.rfa.ofw_phone') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="ofw_email" value="{{ session('forms.data.rfa.ofw_email') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Facebook/Messenger Acc.</label>
                                <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_fb_acc" value="{{ session('forms.data.rfa.ofw_fb_acc') }}" required>
                            </div>
                        </div>

                        <!-- Passport and Return Date -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Passport / Travel Document No.</label>
                                <input type="text" class="form-control" placeholder="24-4645781-7" name="ofw_passport_no" value="{{ session('forms.data.rfa.ofw_passport_no') }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Kumpletong Address sa Abroad</label>
                                <input type="text" class="form-control" placeholder="Abu Dhabi, United Arab Emirates" name="ofw_address_abroad" value="{{ session('forms.data.rfa.ofw_address_abroad') }}" required>
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
                                    <input type="text" class="form-control" name="party_lname" value="{{ session('forms.data.rfa.party_lname') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="party_fname" value="{{ session('forms.data.rfa.party_fname') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Name extension</label>
                                    <input type="text" class="form-control" name="party_ename" value="{{ session('forms.data.rfa.party_ename') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="party_mname" value="{{ session('forms.data.rfa.party_mname') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Birthday, Relationship -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Birthday</label>
                                <input type="date" class="form-control" name="party_bday" value="{{ session('forms.data.rfa.party_bday') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Relationship to OFW</label>
                                <select name="party_relationship" id="party_relationship" class="form-select">
                                    <option value="" selected disabled>Select</option>
                                    <option value="Spouse" {{ session('forms.data.rfa.party_relationship') === 'Spouse' ? 'selected' : '' }}>Spouse / Asawa</option>
                                    <option value="Child" {{ session('forms.data.rfa.party_relationship') === 'Child' ? 'selected' : '' }}>Child / Anak</option>
                                    <option value="Parent" {{ session('forms.data.rfa.party_relationship') === 'Parent' ? 'selected' : '' }}>Parent / Magulang</option>
                                    <option value="Sibling" {{ session('forms.data.rfa.party_relationship') === 'Sibling' ? 'selected' : '' }}>Sibling / Kapatid</option>
                                    <option value="Other" {{ session('forms.data.rfa.party_relationship') === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Others: </label>
                                <input type="text" class="form-control disabled" name="party_relationship_other" id="party_relationship_other" value="{{ session('forms.data.rfa.party_relationship_other') }}" placeholder="Please specify...">
                            </div>
                        </div>

                        <!-- Government ID -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Valid Government ID and ID No.</label>
                                <input type="text" class="form-control" name="party_valid_id" value="{{ session('forms.data.rfa.party_valid_id') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" placeholder="ex. sample@email.com" name="party_email" value="{{ session('forms.data.rfa.party_email') }}">
                            </div>
                        </div>
                        <!-- Contact and Social Media -->
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Contact Number (Mobile/ Phone)</label>
                                <input type="text" class="form-control" placeholder="ex. 09123456768" name="party_phone" value="{{ session('forms.data.rfa.party_phone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Facebook/Messenger Account</label>
                                <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="party_fb_acc" value="{{ session('forms.data.rfa.party_fb_acc') }}">
                            </div>
                        </div>
                        <!-- Address in the Philippines -->
                        <div class="mb-3">
                            <h6 class="fw-bold mb-3">Kumpletong Address sa Pilipinas</h6>
                            <div class="mb-2">
                                <label class="form-label">Unit/Room/House Number/Street name</label>
                                <input type="text" class="form-control" name="party_house_no" value="{{ session('forms.data.rfa.party_house_no') }}">
                            </div>
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <label class="form-label">Province</label>
                                    <select class="form-select" name="party_province" id="party_province">
                                        <option value="">Province</option>
                                    </select>
                                    <input type="hidden" name="party_province_name" id="party_province_name">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">City/ Municipality</label>

                                    <select class="form-select" name="party_municipality" id="party_municipality" disabled>
                                        <option value="">City / Municipality</option>
                                    </select>
                                    <input type="hidden" name="party_municipality_name" id="party_municipality_name">

                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Barangay</label>
                                    <select class="form-select" name="party_barangay" id="party_barangay" disabled>
                                        <option value="">Barangay</option>
                                    </select>
                                    <input type="hidden" name="party_barangay_name" id="party_barangay_name" value="">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Zip Code</label>
                                    <input 
                                        type="text" 
                                        class="form-control" 
                                        name="party_zip_code" 
                                        placeholder="ex. 2016" 
                                        value="{{ session('forms.data.rfa.party_zip_code') }}" 
                                        maxlength="4"          
                                        pattern="\d{4}"         
                                        inputmode="numeric"     
                                        oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);" 
                                        
                                    >
                                </div>
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
            
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="LEGAL ASSISTANCE"
                                        {{ in_array('LEGAL ASSISTANCE', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">LEGAL ASSISTANCE</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="MEDICAL ASSISTANCE"
                                        {{ in_array('MEDICAL ASSISTANCE', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">MEDICAL ASSISTANCE</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="REPATRIATION"
                                        {{ in_array('REPATRIATION', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">REPATRIATION</label>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="RESCUE / EVACUATION"
                                        {{ in_array('RESCUE / EVACUATION', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">RESCUE / EVACUATION</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES"
                                        {{ in_array('WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="COMPASSIONATE VISIT"
                                        {{ in_array('COMPASSIONATE VISIT', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">COMPASSIONATE VISIT</label>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="SHIPMENT OF HUMAN REMAINS / CREMAINS"
                                        {{ in_array('SHIPMENT OF HUMAN REMAINS / CREMAINS', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">SHIPMENT OF HUMAN REMAINS / CREMAINS</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="FOOD ASSISTANCE"
                                        {{ in_array('FOOD ASSISTANCE', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">FOOD ASSISTANCE</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="TRANSPORTATION ASSISTANCE"
                                        {{ in_array('TRANSPORTATION ASSISTANCE', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">TRANSPORTATION ASSISTANCE</label>
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox"
                                        name="uri_ng_tulong[]" value="TEMPORARY SHELTER"
                                        {{ in_array('TEMPORARY SHELTER', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">TEMPORARY SHELTER</label>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-check mb-3">
                                    <div class="d-flex align-items-center gap-2 flex-wrap">
                                        <input class="form-check-input flex-shrink-0" type="checkbox"
                                            name="uri_ng_tulong[]" id="others_uri_ng_tulong" value="others"
                                            {{ in_array('others', session('forms.data.rfa.uri_ng_tulong', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="others_uri_ng_tulong">OTHERS</label>
                                        {{-- name="others_specify" so the controller can read it --}}
                                        <input type="text" class="form-control" id="others_specify"
                                            name="others_specify_uri_ng_tulong"
                                            placeholder="Please specify..." disabled
                                            style="flex: 1; min-width: 120px;"
                                            value="{{ session('forms.data.rfa.others_specify_uri_ng_tulong') }}">
                                    </div>
                                </div>
                            </div>
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
                        <textarea class="form-control" rows="7" placeholder="Text here..." name="maikling_salaysay" required>{{ session('forms.data.rfa.maikling_salaysay') }}</textarea>
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
                        <div class="row">
                            <p class="mb-3">Sa pamamagitan ng paglalagay ng inyong bank details, pinahihintulutan ninyo ang Department of Migrant Workers (DMW) na ipasok o i-credit ang aprubadong tulong pinansyal sa inyong inilagay na account.</p>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bank Name</label>
                                <input type="text" class="form-control" placeholder="ex. BDO, BPI, etc." name="bank_name" value="{{ session('forms.data.rfa.bank_name') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Bank Branch</label>
                                <input type="text" class="form-control" placeholder="ex. BDO Dolores Branch" name="bank_branch" value="{{ session('forms.data.rfa.bank_branch') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Account Number</label>
                                <input type="text" class="form-control" placeholder="ex. 123456789" name="bank_acc_num" value="{{ session('forms.data.rfa.bank_acc_no') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Account Name</label>
                                <input type="text" class="form-control" placeholder="Juan Dela Cruz" name="bank_acc_name" value="{{ session('forms.data.rfa.bank_acc_name') }}">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="d-grid gap-2 mt-4">
            <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Submit</button>
        </div> -->
        <div class="d-grid gap-2">
            <button type="button"
                    class="btn btn-success btn-lg fw-bold"
                    style="background-color: #2d7a2d; border-color: #2d7a2d;"
                    onclick="validateAndSubmit()">
                Next
            </button>
        </div>
    </form>

    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #2F5BB7; color: white;">
                    <h5 class="modal-title text-uppercase" id="validationModalLabel">REQUIRED FIELD MISSING!</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    Please fill up all required fields before submitting the form.
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" 
                            style="background-color: #2F5BB7; border: none;">OK</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #2F5BB7; color: white;">
                    <h5 class="modal-title text-uppercase" id="confirmationModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    Are you sure you want to submit this form? Please review your information before proceeding.
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-confirm" id="confirmSubmitBtn">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>


</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const partyProvinceSelect = document.getElementById('party_province');
        const partyMunicipalitySelect = document.getElementById('party_municipality');
        const partyBarangaySelect = document.getElementById('party_barangay');

        

        function resetSelect(selectEl, text) {
            selectEl.innerHTML = '';
            
            const option = document.createElement('option');
            option.value = '';
            option.textContent = text;
            option.selected = true;
            
            selectEl.appendChild(option);
            selectEl.disabled = true;
        }

      function populateSelect(selectEl, items, valueKey, labelKey) {
          const defaultText = selectEl === partyProvinceSelect
              ? 'Province'
              : selectEl === partyMunicipalitySelect
              ? 'City / Municipality'
              : selectEl === partyBarangaySelect
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

          resetSelect(partyProvinceSelect, 'Loading provinces...');
          resetSelect(partyMunicipalitySelect, 'City / Municipality');
          resetSelect(partyBarangaySelect, 'Barangay');


        

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
            populateSelect(partyProvinceSelect, staticRegion3Provinces, 'code', 'name');
            return;
            }

            populateSelect(partyProvinceSelect, region3Provinces, 'code', 'name');
        })
        .catch(error => {
            console.error('Error fetching provinces:', error);
            populateSelect(partyProvinceSelect, staticRegion3Provinces, 'code', 'name');
        });

        partyProvinceSelect.addEventListener('change', function() {
          const provinceCode = this.value;
          const provinceName = this.options[this.selectedIndex].text;
          document.getElementById('party_province_name').value = provinceName;

          
          resetSelect(partyMunicipalitySelect, 'Loading municipalities...');
          resetSelect(partyBarangaySelect, 'Barangay');

          if (!provinceCode) {
              resetSelect(partyMunicipalitySelect, 'City / Municipality');
              return;
          }

          fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
              .then(response => response.json())
              .then(data => {
              if (!Array.isArray(data) || !data.length) {
                  throw new Error('No municipalities found');
              }
              populateSelect(partyMunicipalitySelect, data, 'code', 'name');
              })
              .catch(error => {
              console.error('Error fetching municipalities:', error);
              resetSelect(partyMunicipalitySelect, 'City / Municipality');
              });
          });

          partyMunicipalitySelect.addEventListener('change', function() {
          const cityCode = this.value;
          const cityName = this.options[this.selectedIndex].text;
          document.getElementById('party_municipality_name').value = cityName;
          
          resetSelect(partyBarangaySelect, 'Loading barangays...');

          if (!cityCode) {
              resetSelect(partyBarangaySelect, 'Barangay');
              return;
          }

          fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
              .then(response => response.json())
              .then(data => {
              if (!Array.isArray(data) || !data.length) {
                  throw new Error('No barangays found');
              }
              populateSelect(partyBarangaySelect, data, 'code', 'name');
              })
              .catch(error => {
              console.error('Error fetching barangays:', error);
              resetSelect(partyBarangaySelect, 'Barangay');
              });
        });

        // Sync barangay name when selected
        partyBarangaySelect.addEventListener('change', function() {
            const barangayCode = this.value;
            const barangayName = this.options[this.selectedIndex].text;

            document.getElementById('party_barangay_name').value = barangayName;


        });

        const ofwProvinceSelect = document.getElementById('ofw_province');
        const ofwMunicipalitySelect = document.getElementById('ofw_municipality');
        const ofwBarangaySelect = document.getElementById('ofw_barangay');
   

        // Reset & populate already exist in your code, reuse them

        // ===================== LOAD PROVINCES =====================
        const staticRegion3ProvincesOFW = [
            { code: '030800000', name: 'Bataan' },
            { code: '031400000', name: 'Bulacan' },
            { code: '034900000', name: 'Nueva Ecija' },
            { code: '035400000', name: 'Pampanga' },
            { code: '036900000', name: 'Tarlac' },
            { code: '037100000', name: 'Zambales' },
            { code: '037700000', name: 'Aurora' }
        ];

        fetch('https://psgc.gitlab.io/api/provinces/')
            .then(res => res.json())
            .then(data => {
                const provinceData = Array.isArray(data)
                    ? data
                    : (Array.isArray(data.value) ? data.value : []);

                const region3 = provinceData.filter(p =>
                    p?.regionCode &&
                    (p.regionCode === '030000000' || String(p.regionCode).startsWith('030'))
                );

                if (!region3.length) {
                    populateSelect(ofwProvinceSelect, staticRegion3ProvincesOFW, 'code', 'name');
                    return;
                }

                populateSelect(ofwProvinceSelect, region3, 'code', 'name');
            })
            .catch(err => {
                console.error('OFW province error:', err);
                populateSelect(ofwProvinceSelect, staticRegion3ProvincesOFW, 'code', 'name');
            });

        // ===================== PROVINCE CHANGE =====================
        ofwProvinceSelect.addEventListener('change', function () {
            const provinceCode = this.value;
            const provinceName = this.options[this.selectedIndex].text;

            document.getElementById('ofw_province_name').value = provinceName;

            resetSelect(ofwMunicipalitySelect, 'Loading municipalities...');
            resetSelect(ofwBarangaySelect, 'Barangay');

            if (!provinceCode) {
                resetSelect(ofwMunicipalitySelect, 'City / Municipality');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) {
                        throw new Error('No municipalities found');
                    }
                    populateSelect(ofwMunicipalitySelect, data, 'code', 'name');
                })
                .catch(err => {
                    console.error('OFW municipality error:', err);
                    resetSelect(ofwMunicipalitySelect, 'City / Municipality');
                });
        });

        // ===================== MUNICIPALITY CHANGE =====================
        ofwMunicipalitySelect.addEventListener('change', function () {
            const cityCode = this.value;
            const cityName = this.options[this.selectedIndex].text;

            document.getElementById('ofw_municipality_name').value = cityName;

            resetSelect(ofwBarangaySelect, 'Loading barangays...');

            if (!cityCode) {
                resetSelect(ofwBarangaySelect, 'Barangay');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) {
                        throw new Error('No barangays found');
                    }
                    populateSelect(ofwBarangaySelect, data, 'code', 'name');
                })
                .catch(err => {
                    console.error('OFW barangay error:', err);
                    resetSelect(ofwBarangaySelect, 'Barangay');
                });
        });

        // ===================== BARANGAY CHANGE =====================
        ofwBarangaySelect.addEventListener('change', function () {
            const barangayName = this.options[this.selectedIndex].text;
            document.getElementById('ofw_barangay_name').value = barangayName;
        });

    });

    function validateAndSubmit() {
        const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
        let hasEmptyField = false;
    
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                hasEmptyField = true;
                field.style.borderColor = 'red';
            } else {
                field.style.borderColor = '';
            }
        });
    
        if (hasEmptyField) {
            new bootstrap.Modal(document.getElementById('validationModal')).show();
            return;
        }
    
        // Show confirmation modal — on confirm, submit the form natively
        showConfirmationModal();
    }

    // Function to show confirmation modal
    function showConfirmationModal() {
        new bootstrap.Modal(document.getElementById('confirmationModal')).show();
    }

    // Event listener for confirm submit button
    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
        document.querySelector('form').submit();   // native POST → storeRFAForm
    });

    document.querySelectorAll('input[name="uri_ng_tulong[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const othersCheckbox = document.getElementById('others_uri_ng_tulong');
            const othersInput = document.getElementById('others_specify');

            if (othersCheckbox.checked) {
                othersInput.disabled = false;
                othersInput.focus();
            } else {
                othersInput.disabled = true;
                othersInput.value = '';
            }
        });
    });

    // Toggle the other input based on the selected value
    document.getElementById('party_relationship').addEventListener('change', function () {
        const otherInput = document.getElementById('party_relationship_other');

        if (this.value === 'Other') {
            otherInput.classList.remove('disabled');
            otherInput.focus();
        } else {
            otherInput.classList.add('disabled');
            otherInput.value = '';
        }
    });

    // Before form submission, set the party_relationship value
    // document.querySelector('form').addEventListener('submit', function (e) {
    //     const dropdown = document.getElementById('party_relationship');
    //     const otherInput = document.getElementById('party_relationship_other');

    //     if (dropdown.value === 'Other') {
    //         // Temporarily change the dropdown value to the textbox value
    //         dropdown.value = otherInput.value
    //     }
    // });




</script>
@endsection
