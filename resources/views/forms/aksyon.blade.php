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
    <!-- Header Section -->
    <div class="form-header text-center">
        <h4>Agarang Kalinga at Saklolo para sa mga OFW's na Nangangailangan (AKSYON)</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>

    <form action="{{ route('forms.step.store', $step) }}" method="POST" enctype="multipart/form-data">
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
                            <input type="text" class="form-control disabled" name="ofw_lname" value="{{ session('forms.data.rfa.ofw_lname') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">First Name</label>
                            <input type="text" class="form-control disabled" name="ofw_fname" value="{{ session('forms.data.rfa.ofw_fname') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Name extension</label>
                            <input type="text" class="form-control disabled" name="ofw_ename" value="{{ session('forms.data.rfa.ofw_ename') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control disabled" name="ofw_mname" value="{{ session('forms.data.rfa.ofw_mname') }}">
                        </div>
                    </div>
                </div>

                <!-- Birthday, Sex, Civil Status -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Birthday</label>
                        <input type="date" class="form-control disabled" name="ofw_bday" value="{{ session('forms.data.rfa.ofw_bday') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Age</label>
                        <input type="number" class="form-control" name="aksyon_ofw_age" value="{{ session('forms.data.aksyon.aksyon_ofw_age') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Gender</label>
                        <input type="text" class="form-control disabled" name="ofw_gender" value="{{ session('forms.data.rfa.ofw_gender') }}">
                    </div>
                    
                </div>

                <!-- Address in the Philippines -->
                <div class="mb-3">
                    <h6 class="fw-bold mb-3">Address in the Philippines</h6>
                    <div class="mb-2">
                        <label class="form-label">Unit/Room/House Number/Street name</label>
                        <input type="text" class="form-control disabled" name="ofw_house_no" value="{{ session('forms.data.rfa.ofw_house_no') }}">
                    </div>
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control disabled" name="ofw_province_name" id="ofw_province_name" value="{{ session('forms.data.rfa.ofw_province_name') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">City/ Municipality</label>
                            <input type="text" class="form-control disabled" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ session('forms.data.rfa.ofw_municipality_name') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Barangay</label>
                            <input type="text" class="form-control disabled" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ session('forms.data.rfa.ofw_barangay_name') }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" class="form-control disabled" id="ofw_zipcode" name="ofw_zip_code" value="{{ session('forms.data.rfa.ofw_zip_code') }}">
                        </div>
                    </div>
                </div>

                <!-- Contact Number, Email, Facebook -->
                <div class="row g-3 mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Contact Number</label>
                        <input type="text" class="form-control disabled" name="ofw_phone" value="{{ session('forms.data.rfa.ofw_phone') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-control disabled" name="ofw_email" value="{{ session('forms.data.rfa.ofw_email') }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Facebook/Messenger Acc.</label>
                        <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_fb_acc" value="{{ session('forms.data.rfa.ofw_fb_acc') }}">
                    </div>
                </div>

                <!-- Passport and Return Date -->
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Pinakahuling Petsa ng Pag-alis sa Pilipinas</label>
                        <input type="date" class="form-control" placeholder="" name="aksyon_latest_departure_ph" value="{{ session('forms.data.aksyon.aksyon_latest_departure_ph') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pinakahuling Petsa ng Pagbalik sa Pilipinas</label>
                        <input type="date" class="form-control" name="aksyon_latest_return_ph" value="{{ session('forms.data.aksyon.aksyon_latest_return_ph') }}">
                    </div>
                </div>

                <!-- Years and Jobsite -->
                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label">Jobsite / Bansang Pinagtatrabahuhan</label>
                        <input type="text" class="form-control" name="aksyon_jobsite" id="aksyon_jobsite" value="{{ session('forms.data.aksyon.aksyon_jobsite') }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Job Position</label>
                        <input type="text" class="form-control" placeholder="Factory Worker" name="aksyon_job_position" value="{{ session('forms.data.aksyon.aksyon_job_position') }}">
                    </div>
                </div>

                <!-- OWWA and Return Reason -->
                <div class="row g-3 mb-3">
                    <div class="col-md-12">
                        <label class="form-label">Kadahilanan ng Pagbalik sa Pilipinas</label>
                        <select class="form-select" name="aksyon_return_reason" id="aksyon_return_reason">
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
                        </select>
                    </div>
                </div>

                <!-- Maikling Salaysay -->
                <div class="mb-3">
                    <label class="form-label">Others / Iba pang Kadahilanan ng Pagbalik</label>
                    <textarea class="form-control" rows="4" id="aksyon_return_reason_others_specify" name="aksyon_return_reason_others_specify" disabled>{{ session('forms.data.aksyon.aksyon_return_reason_others_specify') }}</textarea>
                </div>

                <!-- Programs -->
                <div class="mb-3">
                    <label class="form-label fw-bold">Nakapag-avail ka na ba ng alinman sa mga sumusunod na programa o tulong?</label>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_hanapbuhay_program" id="aksyon_hanapbuhay_program" value="checked" {{ session('forms.data.aksyon.aksyon_hanapbuhay_program') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aksyon_hanapbuhay_program">
                            Nakakapag-avail na ako ng OWWA Balik Pinas, Balik Hanapbuhay Program
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_nrco_livehood_program" id="aksyon_nrco_livehood_program" value="checked" {{ session('forms.data.aksyon.aksyon_nrco_livehood_program') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aksyon_nrco_livehood_program">
                            Nakakapag-avail na ako ng NRCO Livelihood Program para sa Reintegration ng mga OFW
                        </label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="aksyon_fund" id="aksyon_fund" value="checked" {{ session('forms.data.aksyon.aksyon_fund') == 'checked' ? 'checked' : '' }}>
                        <label class="form-check-label" for="aksyon_fund">
                            Nakakapag-avail na ako ng AKSYON Fund sa Jobsite / Pagdating sa Pilipinas
                        </label>
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

    </form>

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
</div>

<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        
        // ENABLE AND DISABLED TEXT AREA WHEN "OTHERS" IS SELECTED IN RETURN REASON
        const reasonSelect = document.getElementById("aksyon_return_reason");
        const descriptionTextarea = document.getElementById("aksyon_return_reason_others_specify");

        function toggleTextarea() {
            if (reasonSelect.value === "Others / Iba pang Kadahilanan ng Pagbalik") {
                descriptionTextarea.disabled = false;
                descriptionTextarea.focus();
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
