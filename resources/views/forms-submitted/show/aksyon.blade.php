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
        font-weight: 500;
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
        <h4>Agarang Kalinga at Saklolo para sa mga OFW's na Nangangailangan (AKSYON)</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-section mb-5">
            <h5 class="fw-bold mb-4">OFW's PERSONAL INFORMATION</h5>

            <div class="aksyon-section-content">
                <!-- Pangalan ng OFW -->
                <div class="mb-3"> 
                    <h6 class="fw-bold mb-3">Pangalan ng OFW</h6>
                    <div class="row g-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" name="ofw_lname" value="{{ $ofw->ofw_lname ?? null }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control" name="ofw_fname" value="{{ $ofw->ofw_fname ?? null }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Name extension</label>
                            <input type="text" class="form-control" name="ofw_ename" value="{{ $ofw->ofw_ename ?? null }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control" name="ofw_mname" value="{{ $ofw->ofw_mname ?? null }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Birthday, Sex, Civil Status -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Birthday</label>
                        <input type="date" class="form-control" name="ofw_bday" value="{{ $ofw->ofw_bday ?? null }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="aksyon_ofw_age" value="{{ $entries['aksyon_ofw_age'] ?? null }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control" name="ofw_gender" value="{{ $ofw->ofw_gender ?? null }}" readonly>
                    </div>
                    
                </div>

                <!-- Address in the Philippines -->
                <div class="mb-3">
                    <h6 class="fw-bold mb-3">Address in the Philippines</h6>
                    <div class="mb-2">
                        <label class="form-label">Unit/Room/House Number/Street name</label>
                        <input type="text" class="form-control" name="ofw_house_no" value="{{ $ofw_address->house_no  ?? null }}" readonly>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control" name="ofw_province_name" id="ofw_province_name" value="{{ $ofw_address->province  ?? null }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">City/ Municipality</label>
                            <input type="text" class="form-control" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ $ofw_address->municipality  ?? null }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Barangay</label>
                            <input type="text" class="form-control" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ $ofw_address->brgy  ?? null }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control" id="ofw_zipcode" name="ofw_zip_code" value="{{ $ofw_address->zip_code  ?? null }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- Contact Number, Email, Facebook -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control" name="ofw_phone" value="{{ $ofw->ofw_phone ?? null }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="ofw_email" value="{{ $ofw->ofw_email ?? null }}" readonly>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Facebook/Messenger Acc.</label>
                        <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_fb_acc" value="{{ $ofw->ofw_fb_acc ?? null }}" readonly>
                    </div>
                </div>

                <!-- Passport and Return Date -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Pinakahuling Petsa ng Pag-alis sa Pilipinas</label>
                        <input type="date" class="form-control" placeholder="" name="aksyon_latest_date_departure_ph" value="{{ $entries['aksyon_latest_date_departure_ph'] ?? '' }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pinakahuling Petsa ng Pagbalik sa Pilipinas</label>
                        <input type="date" class="form-control" name="aksyon_latest_date_return_ph" value="{{ $entries['aksyon_latest_date_return_ph'] ?? '' }}" readonly>
                    </div>
                </div>

                <!-- Years and Jobsite -->
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label">Jobsite / Bansang Pinagtatrabahuhan</label>
                        <input type="text" class="form-control" name="aksyon_jobsite" id="aksyon_jobsite" value="{{ $entries['aksyon_jobsite'] ?? '' }}"">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Job Position</label>
                        <input type="text" class="form-control" placeholder="Factory Worker" name="aksyon_job_position" value="{{ $entries['aksyon_job_position'] ?? '' }}" readonly>
                    </div>
                </div>

                <!-- OWWA and Return Reason -->
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Kadahilanan ng Pagbalik sa Pilipinas</label>
                        <!-- <select class="form-select" name="aksyon_return_reason" id="aksyon_return_reason">
                            <option selected disabled>Select</option>
                            <option value="Natapos ang Kontrata" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Natapos ang Kontrata' ? 'selected' : '' }}>Natapos ang Kontrata</option>
                            <option value="Dahilan sa Kalusugan" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Dahilan sa Kalusugan' ? 'selected' : '' }}>Dahilan sa Kalusugan</option>
                            <option value="Paglabag sa Kontrata" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Paglabag sa Kontrata' ? 'selected' : '' }}>Paglabag sa Kontrata</option>
                            <option value="Ilegal na Pagre-recruit / Pag-deploy" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Ilegal na Pagre-recruit / Pag-deploy' ? 'selected' : '' }}>Ilegal na Pagre-recruit / Pag-deploy</option>
                            <option value="Inabuso" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Inabuso' ? 'selected' : '' }}>Inabuso</option>
                            <option value="Digmaan / Kaguluhang Sibil" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Digmaan / Kaguluhang Sibil' ? 'selected' : '' }}>Digmaan / Kaguluhang Sibil</option>
                            <option value="Pagkatanggal sa Trabaho" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Pagkatanggal sa Trabaho' ? 'selected' : '' }}>Pagkatanggal sa Trabaho</option>
                            <option value="Active OFW" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Active OFW' ? 'selected' : '' }}>Active OFW</option>
                            <option value="Others / Iba pang Kadahilanan ng Pagbalik" {{ session('forms.data.aksyon.aksyon_return_reason') == 'Others / Iba pang Kadahilanan ng Pagbalik' ? 'selected' : '' }}>Others / Iba pang Kadahilanan ng Pagbalik</option>
                        </select> -->
                        <input type="text" class="form-control" name="aksyon_return_reason" value="{{ $entries['aksyon_return_reason'] ?? '' }}" readonly>
                    </div>
                </div>

                <!-- Maikling Salaysay -->
                <div class="mb-3">
                    <label class="form-label">Others / Iba pang Kadahilanan ng Pagbalik</label>
                    <textarea class="form-control" rows="4" id="aksyon_return_reason_others_specify" name="aksyon_return_reason_others_specify" readonly>{{ $entries['aksyon_return_reason_others_specify'] ?? '' }}</textarea>
                </div>

                <!-- Programs -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nakapag-avail ka na ba ng alinman sa mga sumusunod na programa o tulong?</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_hanapbuhay_program" id="aksyon_hanapbuhay_program" value="checked" {{ ($entries['aksyon_hanapbuhay_program']) ?? '' === 'checked' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="aksyon_hanapbuhay_program">
                            Nakakapag-avail na ako ng OWWA Balik Pinas, Balik Hanapbuhay Program
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_nrco_livehood_program" id="aksyon_nrco_livehood_program" value="checked" {{ ($entries['aksyon_nrco_livehood_program']) ?? '' === 'checked' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="aksyon_nrco_livehood_program">
                            Nakakapag-avail na ako ng NRCO Livelihood Program para sa Reintegration ng mga OFW
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_fund" id="aksyon_fund" value="checked" {{ ($entries['aksyon_fund']) ?? '' === 'checked' ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="aksyon_fund">
                            Nakakapag-avail na ako ng AKSYON Fund sa Jobsite / Pagdating sa Pilipinas
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // ENABLE AND DISABLED TEXT AREA WHEN "OTHERS" IS SELECTED IN RETURN REASON
        const reasonSelect = document.getElementById("aksyon_return_reason");
        const descriptionTextarea = document.getElementById("aksyon_return_reason_others_specify");

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

    function goBack() {
        window.history.back();
    }

    function aksyonNext() {
        const required = document.querySelectorAll('input[required], select[required], textarea[required]');
        let invalid = false;
 
        required.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = 'red';
                invalid = true;
            } else {
                field.style.borderColor = '';
            }
        });
 
        if (invalid) {
            new bootstrap.Modal(document.getElementById('senaValidationModal')).show();
            return;
        }
 
        document.querySelector('form').submit();
    }






  </script>
@endsection
