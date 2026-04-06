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

    .accordion-button {
        background-color: #EFF2FF !important;
        color: #000 !important;
        border: 1px solid #b0c4de !important;
        font-weight: 500;
    }

    .accordion-button[aria-expanded="true"],
    .accordion-button:not(.collapsed),
    .accordion-button.show {
        background-color: #D9E4F5 !important;
        color: #000 !important;
        box-shadow: none;
    }

    .accordion-button:focus {
        border-color: #b0c4de !important;
        box-shadow: none;
    }

    .accordion-item {
        margin-bottom: 0.5rem;
    }

    .accordion-body,
    .accordion-collapse .accordion-body,
    .accordion-collapse.show .accordion-body,
    .accordion-collapse.collapsing .accordion-body {
        background-color: #D9E4F5 !important;
        border-top: 1px solid #b0c4de;
    }

    .section-content {
        background-color: transparent;
    }

    .upload-card {
        border: 1px dashed #8eaed9;
        border-radius: 0.75rem;
        background-color: #f7fbff;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .upload-card-header {
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .upload-drop {
        border: 1px dashed #b0c4de;
        border-radius: 0.75rem;
        min-height: 8rem;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #fff;
        color: #6c757d;
        cursor: pointer;
    }

    .upload-drop span {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.95rem;
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
        <div class="accordion" id="requestAccordion">
        <!-- Section A: Personal Information -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingA">
                <button 
                    class="accordion-button collapsed" 
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
                class="accordion-collapse collapse" 
                aria-labelledby="headingA" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body section-content">
                    <!-- Pangalan ng OFW -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Pangalan ng OFW</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Dela Cruz" name="ofw_lname">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="Juan" name="ofw_fname">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name extension</label>
                                <input type="text" class="form-control" placeholder="Jr/Sr/III" name="ofw_ename">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Santos" name="ofw_mname">
                            </div>
                        </div>
                    </div>

                    <!-- Birthday, Sex, Civil Status -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control" name="ofw_bday">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sex</label>
                            <select class="form-select" name="ofw_sex">
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
                                <select class="form-select" name="ofw_province">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City/ Municipality</label>
                                <select class="form-select" name="ofw_municipality">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barangay</label>
                                <select class="form-select" name="ofw_barangay">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control" placeholder="ex. 2016" name="ofw_zip_code">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Number, Email, Facebook -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Contact Number</label>
                            <input type="text" class="form-control" placeholder="ex. 09123456768" name="ofw_phone">
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
                            <select class="form-select" name="ofw_country">
                                <option value="">Select</option>
                            </select>
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
                            <input type="text" class="form-control" placeholder="Factory Worker" name="ofw_job_position">
                        </div>
                    </div>

                    <!-- Agency and Return Reason -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Agency / Employer</label>
                            <input type="text" class="form-control" placeholder="JS Contractor Inc." name="ofw_agency">
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
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingB">
                <button 
                    class="accordion-button collapsed" 
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
                class="accordion-collapse collapse" 
                aria-labelledby="headingB" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body section-content">
                    <p class="mb-3">Paalala: Sagutan lamang ang bahagang ito kung ang kamag-anak ng OFW ang humihiling ng tulong. Maaaari itong laktawan kung ang mismong OFW ang nagsususumiite ng form.</p>

                    <!-- Pangalan ng Kamag-anak -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Pangalan ng Kamag-anak</h6>
                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Dela Cruz" name="relative_lname">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" placeholder="Juan" name="relative_fname">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Name extension</label>
                                <input type="text" class="form-control" placeholder="Jr/Sr/III" name="relative_ename">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Middle Name</label>
                                <input type="text" class="form-control" placeholder="Santos" name="relative_mname">
                            </div>
                        </div>
                    </div>

                    <!-- Birthday, Relationship -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label class="form-label">Birthday</label>
                            <input type="date" class="form-control" name="relative_bday">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Relationship to OFW</label>
                            <select class="form-select" name="relative_relationship">
                                <option value="">Select</option>
                                <option value="Mother">Mother</option>
                                <option value="Father">Father</option>
                                <option value="Spouse">Spouse</option>
                                <option value="Child">Child</option>
                                <option value="Sibling">Sibling</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Relationship to OFW (Others)</label>
                            <input type="text" class="form-control" name="relative_relationship_others">
                        </div>
                    </div>

                    <!-- Government ID -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Valid Government ID and ID No.</label>
                            <input type="text" class="form-control" name="relative_gov_id">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" class="form-control" placeholder="ex. sample@email.com" name="relative_email">
                        </div>
                    </div>

                    <!-- Address in the Philippines -->
                    <div class="mb-3">
                        <h6 class="fw-bold mb-3">Kompletong Address sa Pilipinas</h6>
                        <div class="mb-2">
                            <label class="form-label">Unit/Room/House Number/Street name</label>
                            <input type="text" class="form-control" name="relative_address_street">
                        </div>
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Province</label>
                                <select class="form-select" name="relative_province">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">City/ Municipality</label>
                                <select class="form-select" name="relative_municipality">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Barangay</label>
                                <select class="form-select" name="relative_barangay">
                                    <option value="">Select</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Zip Code</label>
                                <input type="text" class="form-control" placeholder="ex. 2016" name="relative_zip_code">
                            </div>
                        </div>
                    </div>

                    <!-- Contact and Social Media -->
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number (Mobile/ Phone)</label>
                            <input type="text" class="form-control" placeholder="ex. 09123456768" name="relative_phone">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Facebook/Messenger Account</label>
                            <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="relative_facebook">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section C: Type of Assistance -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingC">
                <button 
                    class="accordion-button collapsed" 
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
                class="accordion-collapse collapse" 
                aria-labelledby="headingC" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body section-content">
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
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingD">
                <button 
                    class="accordion-button collapsed" 
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
                class="accordion-collapse collapse" 
                aria-labelledby="headingD" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body section-content">
                    <p class="mb-3">Ilahad dito ang maikling paliwanag kung anong uri ng tulong ang inyong hinihingi, kasama ang mahahalagang detalye tulad ng dahilan, kailan at saan ito kinakailangan.</p>
                    <textarea class="form-control" rows="7" placeholder="Text here..." name="brief_description"></textarea>
                </div>
            </div>
        </div>

        <!-- Section E: Bank Account Information -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingE">
                <button 
                    class="accordion-button collapsed" 
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
                class="accordion-collapse collapse" 
                aria-labelledby="headingE" 
                data-bs-parent="#requestAccordion">
                <div class="accordion-body section-content">
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

    <div class="d-grid gap-2 mt-4">
        <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Submit</button>
    </div>
    </form>
</div>

<script>
    function updateUploadLabel(labelId, input) {
        const label = document.getElementById(labelId);
        if (!label) return;
        if (!input.files || input.files.length === 0) {
            label.textContent = '+ Upload File';
            return;
        }
        const names = Array.from(input.files).map(file => file.name);
        label.textContent = names.join(', ');
    }
</script>
@endsection
