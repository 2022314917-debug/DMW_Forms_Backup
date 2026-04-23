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
                                <input type="text" class="form-control disabled" name="ofw_lname" value="{{ $ofw->ofw_lname }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control disabled" name="ofw_fname" value="{{ $ofw->ofw_fname }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name extension</label>
                                <input type="text" class="form-control disabled" name="ofw_ename" value="{{ $ofw->ofw_ename }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control disabled" name="ofw_mname" value="{{ $ofw->ofw_mname }}">
                            </div>
                        </div>
                    </div>

                    <!-- Birthday, Sex, Civil Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control disabled" name="ofw_bday" value="{{ $ofw->ofw_bday }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sex</label>
                            <!-- <select class="form-select disabled" name="ofw_sex" value="{{ session('general_form_data.ofw_sex') }}">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select> -->
                            <input type="text" class="form-control disabled" name="ofw_gender" value="{{ $ofw->ofw_gender }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Civil Status</label>
                            <!-- <select class="form-select" name="ofw_civil_status">
                                <option value="Select" {{ session('forms.data.aksyon.ofw_civil_status') == 'Select' ? 'selected' : '' }} disabled>Select</option>
                                <option value="Single" {{ session('forms.data.aksyon.ofw_civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                                <option value="Married" {{ session('forms.data.aksyon.ofw_civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Widowed" {{ session('forms.data.aksyon.ofw_civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                            </select> -->
                            <input type="text" class="form-control disabled" name="ofw_civil_status" value="{{ $ofw->ofw_civil_status }}">
                        </div>
                    </div>

                    <!-- Address in the Philippines -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Address in the Philippines</h6>
                        <div class="mb-2">
                            <label class="form-label">Unit/Room/House Number/Street name</label>
                            <input type="text" class="form-control disabled" name="ofw_address_street" value="{{ $ofw_address->house_no }}">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Province</label>
                                <!-- <select class="form-select" name="ofw_province" id="ofw_province">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" name="ofw_province_name" id="ofw_province_name"> -->
                                <input type="text" class="form-control disabled" name="ofw_province_name" id="ofw_province_name" value="{{ $ofw_address->province }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City/ Municipality</label>
                                <!-- <select class="form-select" name="ofw_municipality" id="ofw_municipality">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" name="ofw_municipality_name" id="ofw_municipality_name"> -->
                                <input type="text" class="form-control disabled" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ $ofw_address->municipality }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barangay</label>
                                <!-- <select class="form-select" name="ofw_barangay" id="ofw_barangay">
                                    <option value="">Select</option>
                                </select>
                                <input type="hidden" name="ofw_barangay_name" id="ofw_barangay_name"> -->
                                <input type="text" class="form-control disabled" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ $ofw_address->brgy }}">

                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control disabled" id="ofw_zipcode" name="ofw_zipcode" value="{{ $ofw_address->zip_code }}">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Number, Email, Facebook -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control disabled" name="ofw_phone" value="{{ $ofw->ofw_phone }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control disabled" name="ofw_email" value="{{ $ofw->ofw_email }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Facebook/Messenger Acc.</label>
                            <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_fb_msgr_acc_wrsd" value="{{ $entries['ofw_fb_msgr_acc_wrsd'] ?? '' }}">
                        </div>
                    </div>

                    <!-- Passport and Return Date -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Passport / Travel Document No.</label>
                            <input type="text" class="form-control disabled" placeholder="24-4645781-7" name="ofw_passport" value="{{ $ofw->ofw_passport }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Pinakahuling Petsa ng Pagbalik sa Pilipinas</label>
                            <input type="date" class="form-control" name="ofw_latest_return_ph_wrsd" value="{{ $entries['ofw_latest_return_ph_wrsd'] ?? '' }}">
                        </div>
                    </div>

                    <!-- Years and Jobsite -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kabuuang bilang ng Taon bilang OFW</label>
                            <input type="text" class="form-control" placeholder="ex. 6" name="ofw_years_wrsd" value="{{ $entries['ofw_years_wrsd'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jobsite / Bansang Pinagtatrabahuhan</label>
                            <input type="text" class="form-control disabled" name="ofw_country" id="ofw_country" value=" {{ $ofw->ofw_country }} ">
                        </div>
                    </div>

                    <!-- Complete Address Abroad and Job Position -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Kompletong Address sa Abroad</label>
                            <input type="text" class="form-control" placeholder="Abu Dhabi, United Arab Emirates" name="ofw_address_abroad_wrsd" value="{{ $entries['ofw_address_abroad_wrsd'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Job Position</label>
                            <input type="text" class="form-control disabled" placeholder="Factory Worker" name="ofw_job_position" value="{{ $ofw->ofw_job }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Agency / Employer</label>
                        <input type="text" class="form-control disabled" placeholder="JS Contractor Inc." name="ofw_agency" value="{{ $ofw->ofw_agency }}">
                    </div>

                    <!-- Agency and Return Reason -->
                    <div class="row g-3 mb-3">

                        <div class="col-md-6"> 
                            <label class="form-label">OWWA Member</label>
                            <select class="form-select" name="ofw_owwa_member_wrsd">
                                <option value="" disabled>Select</option>
                                <option value="Yes" {{ $entries['ofw_owwa_member_wrsd'] ?? '' == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ $entries['ofw_owwa_member_wrsd'] ?? '' == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
 
                        <div class="col-md-6">
                            <label class="form-label">Kadahilanan ng Pagbalik sa Pilipinas</label>
                            <select class="form-select" name="ofw_return_reason" id="ofw_return_reason">
                                <option value="" disabled>Select</option>
                                <option value="Natapos ang Kontrata" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Natapos ang Kontrata' ? 'selected' : '' }}>Natapos ang Kontrata</option>
                                <option value="Dahilan sa Kalusugan" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Dahilan sa Kalusugan' ? 'selected' : '' }}>Dahilan sa Kalusugan</option>
                                <option value="Paglabag sa Kontrata" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Paglabag sa Kontrata' ? 'selected' : '' }}>Paglabag sa Kontrata</option>
                                <option value="Ilegal na Pagre-recruit / Pag-deploy" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Ilegal na Pagre-recruit / Pag-deploy' ? 'selected' : '' }}>Ilegal na Pagre-recruit / Pag-deploy</option>
                                <option value="Inabuso" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Inabuso' ? 'selected' : '' }}>Inabuso</option>
                                <option value="Digmaan / Kaguluhang Sibil" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Digmaan / Kaguluhang Sibil' ? 'selected' : '' }}>Digmaan / Kaguluhang Sibil</option>
                                <option value="Pagkatanggal sa Trabaho" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Pagkatanggal sa Trabaho' ? 'selected' : '' }}>Pagkatanggal sa Trabaho</option>
                                <option value="Active OFW" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Active OFW' ? 'selected' : '' }}>Active OFW</option>
                                <option value="Others / Iba pang Kadahilanan ng Pagbalik" {{ $entries['ofw_return_reason_wrsd'] ?? '' == 'Others / Iba pang Kadahilanan ng Pagbalik' ? 'selected' : '' }}>Others / Iba pang Kadahilanan ng Pagbalik</option>
                            </select>
                        </div>

                    </div>


                    <!-- Maikling Salaysay -->
                    <div class="mb-3">
                        <label class="form-label">Maikling Salaysay ng Pagbalik</label>
                        <textarea class="form-control" rows="4" id="ofw_return_reason_specify_wrsd" name="ofw_return_reason_specify_wrsd" disabled>{{ $entries['ofw_return_reason_specify_wrsd'] ?? '' }}</textarea>
                    </div>

                    <!-- Programs -->
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nakapag-avail ka na ba ng alinman sa mga sumusunod na programa o tulong?</label>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="ofw_hanapbuhay_program_wrsd" id="program_owwa" value="checked" {{ $entries['ofw_hanapbuhay_program_wrsd'] ?? '' == 'checked' ? 'checked' : '' }}>
                            <label class="form-check-label" for="program_owwa">
                                Nakakapag-avail na ako ng OWWA Balik Pinas, Balik Hanapbuhay Program
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="ofw_livelihood_program_wrsd" id="program_nrco" value="checked" {{ $entries['ofw_livelihood_program_wrsd'] ?? '' == 'checked' ? 'checked' : '' }}>
                            <label class="form-check-label" for="program_nrco">
                                Nakakapag-avail na ako ng NRCO Livelihood Program para sa Reintegration ng mga OFW
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="ofw_aksyon_fund_wrsd" id="program_aksyon" value="checked" {{ $entries['ofw_aksyon_fund_wrsd'] ?? '' == 'checked' ? 'checked' : '' }}>
                            <label class="form-check-label" for="program_aksyon">
                                Nakakapag-avail na ako ng AKSYON Fund sa Jobsite / Pagdating sa Pilipinas
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="ofw_no_program_wrsd" id="program_none" value="checked" {{ $entries['ofw_no_program_wrsd'] ?? '' == 'checked' ? 'checked' : '' }}>
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
                                <input type="text" class="form-control disabled" name="party_lname" value="{{ $party->party_lname }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control disabled" name="party_fname" value="{{ $party->party_fname }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name extension</label>
                                <input type="text" class="form-control disabled" name="party_ename" value="{{ $party->party_ename }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control disabled" name="party_mname" value="{{ $party->party_mname }}">
                            </div>
                        </div>
                    </div>

                    <!-- Birthday, Relationship -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control disabled" name="party_bday" value="{{ $party->party_bday }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Relationship to OFW</label>
                            <input type="text" class="form-control disabled" name="party_relationship" value="{{ $party->party_relationship }}">
                        </div>

                    </div>

                    <!-- Government ID -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Valid Government ID and ID No.</label>
                            <input type="text" class="form-control" name="party_valid_id_wrsd" value="{{ $entries['party_valid_id_wrsd'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control disabled" placeholder="ex. sample@email.com" name="party_email" value="{{ $party->party_email }}">
                        </div>
                    </div>

                    <!-- Address in the Philippines -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Kompletong Address sa Pilipinas</h6>
                        <div class="mb-2">
                            <label class="form-label">Unit/Room/House Number/Street name</label>
                            <input type="text" class="form-control disabled" name="party_address_street" value="{{ $party_address->house_no }}">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Province</label>
                                <input type="text" class="form-control disabled" name="party_province" value="{{ $party_address->province }}"> 
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City/ Municipality</label>

                                <input type="text" class="form-control disabled" name="party_municipality" value="{{ $party_address->municipality }}"> 

                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barangay</label>
                                <input type="text" class="form-control disabled" name="party_barangay" value="{{ $party_address->brgy }}"> 
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control disabled" placeholder="ex. 2016" name="party_zip_code" value="{{ $party_address->zip_code }}">
                            </div>
                        </div>
                    </div>

                    <!-- Contact and Social Media -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number (Mobile/ Phone)</label>
                            <input type="text" class="form-control disabled" placeholder="ex. 09123456768" name="party_phone" value="{{ $party->party_phone }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Facebook/Messenger Account</label>
                            <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="party_fb_msgr_acc_wrsd" value="{{ $entries['party_fb_msgr_acc_wrsd'] ?? '' }}">
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
                        <input class="form-check-input" type="radio" name="medical_assistance_wrsd" id="medical_assistance_wrsd" value="checked" {{ ($entries['medical_assistance_wrsd'] ?? '') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="medical_assistance_wrsd">
                            <strong>Medical Assistance</strong> - para sa pagtugon sa gastusing ng pagpapagamot at pagpapabuti ng kalusugan ng OFW na hindi sakop ng employer o health insurance.
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="financial_assistance_wrsd" id="financial_assistance_wrsd" value="checked" {{ ($entries['financial_assistance_wrsd'] ?? '') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="financial_assistance_wrsd">
                            <strong>Financial Assistance</strong> - para sa agarang tulong pinansyal sa OFW at kaniyang pamilya upang maibsan ang epekto ng krisis o pagkawala ng hanapbuhay.
                        </label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="radio" name="welfare_assistance_wrsd" id="welfare_assistance_wrsd" value="checked" {{ ($entries['welfare_assistance_wrsd'] ?? '') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="welfare_assistance_wrsd">
                            <strong>Welfare Assistance</strong> - para sa pagbibigay ng tulong pinansyal o medikal sa mga nakakatandang OFW na may edad 60 pataas na pauwi na sa Pilipinas.
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="repatriation_assistance_wrsd" id="repatriation_assistance_wrsd" value="checked" {{ ($entries['repatriation_assistance_wrsd'] ?? '') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="repatriation_assistance_wrsd">
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
                    <textarea class="form-control" rows="7" placeholder="Text here..." name="assistance_reason_wrsd" >{{ $entries['assistance_reason_wrsd'] ?? '' }}</textarea>
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
                            <input type="text" class="form-control" placeholder="ex. BDO, BPI, etc." name="bank_name_wrsd" value="{{ $entries['bank_name_wrsd'] ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bank Branch</label>
                            <input type="text" class="form-control" placeholder="ex. BDO Dolores Branch" name="bank_branch_wrsd" value="{{ $entries['bank_branch_wrsd'] ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Number</label>
                            <input type="text" class="form-control" placeholder="ex. 123456789" name="bank_acc_no_wrsd" value="{{ $entries['bank_acc_no_wrsd'] ?? '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control" placeholder="Juan Dela Cruz" name="bank_acc_name_wrsd" value="{{ $entries['bank_acc_name_wrsd'] ?? '' }}">
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



    </form>
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // ENABLE AND DISABLED TEXT AREA WHEN "OTHERS" IS SELECTED IN RETURN REASON
        const reasonSelect = document.getElementById("ofw_return_reason");
        const descriptionTextarea = document.getElementById("ofw_brief_description");

        function toggleTextarea() {
            if (reasonSelect.value === "Others / Iba pang Kadahilanan ng Pagbalik") {
                descriptionTextarea.disabled = false;
            } else {
                descriptionTextarea.disabled = true;
                descriptionTextarea.value = "";
            }
        }

        // run on change
        reasonSelect.addEventListener("change", toggleTextarea);

        // run on page load (for session restore)
        toggleTextarea();

    });






  </script>
@endsection
