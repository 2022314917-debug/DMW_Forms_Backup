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

    .section-divider {
        border: 1px solid #b0c4de;
        border-radius: 0.25rem;
        padding: 0.75rem;
        margin-bottom: 1rem;
        background-color: #e8f1fb;
    }

    .section-divider h6 {
        font-weight: bold;
        margin-bottom: 0.75rem;
        text-decoration: underline;
    }

    .btn-submit {
        background-color: #4e73df;
        color: #fff;
        padding: 0.5rem 2rem;
    }

    .btn-submit:hover {
        background-color: #3f60c4;
        color: #fff;
    }

    .btn-cancel {
        background-color: #6c757d;
        color: #fff;
        padding: 0.5rem 2rem;
    }

    .btn-cancel:hover {
        background-color: #5a6268;
        color: #fff;
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

    <!-- Header -->
    <div class="form-header text-center">
        <h4 class="fw-bold">ONLINE REQUEST FOR ASSISTANCE</h4>
        <p>
            Gamitin ang form na ito para humingi ng tulong. Siguraduhing tama at kumpleto ang lahat ng impormasyon
            ilalagay upang maproseso agad ng aming team ang inyong request.
        </p>
        <small>
            Regional Office Contact Details: (045) 963-4394 | (045) 455-0832 | pampanga@dmw.gov.ph | www.ro3.dmw.gov.ph
        </small>
    </div>

    <!-- Alerts -->
    @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('forms-submitted.save-edit-general', [$request->id, $form->id]) }}" method="POST">
  
        @csrf
        @method('PUT')

        <!-- ======================== SECTION A ======================== -->
        <div class="form-section">
            <h5>A. IMPORMASYON NG HUMIHILING (Request Party)</h5>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control uppercase"
                        name="party_lname" value="{{ old('party_lname', $party->party_lname) }}" required>
                    @error('party_lname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control uppercase"
                        name="party_fname" value="{{ old('party_fname', $party->party_fname) }}" required>
                    @error('party_fname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Name Ext.</label>
                    <input type="text" class="form-control uppercase" name="party_ename"
                        value="{{ old('party_ename', $party->party_ename) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control uppercase" name="party_mname"
                        value="{{ old('party_mname', $party->party_mname) }}">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6 col-md-3">
                    <label class="form-label">Birthday <span class="text-danger">*</span></label>
                    <input type="date" class="form-control @error('party_bday') is-invalid @enderror"
                        name="party_bday" value="{{ old('party_bday', $party->party_bday) }}" required>
                    @error('party_bday')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">Sex <span class="text-danger">*</span></label>
                    <select class="form-select @error('party_gender') is-invalid @enderror" name="party_gender" required>
                        <option value="">Select</option>
                        <option value="Male" {{ old('party_gender', $party->party_gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('party_gender', $party->party_gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('party_gender')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Relationship to OFW <span class="text-danger">*</span></label>
                    <input type="text" class="form-control uppercase"
                        name="party_relationship" value="{{ old('party_relationship', $party->party_relationship) }}" required>
                    @error('party_relationship')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control"
                        name="party_phone" value="{{ old('party_phone', $party->party_phone) }}" required>
                    @error('party_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                    <input type="email" class="form-control"
                        name="party_email" value="{{ old('party_email', $party->party_email) }}" required>
                    @error('party_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address in the Philippines</label>
                <input type="text" class="form-control mb-2 uppercase" name="party_house_no"
                    placeholder="Unit/Room/House Number/Street name"
                    value="{{ old('party_house_no', $party_address->house_no) }}" required>
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <select class="form-select" name="party_province" id="party_province" required>
                            <option value="{{ $party_address->province }}">{{ $party_address->province }}</option>
                        </select>
                        <input type="hidden" name="party_province_name" id="party_province_name">
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form-select" name="party_municipality" id="party_municipality" required>
                            <option value="{{ $party_address->municipality }}">{{ $party_address->municipality }}</option>
                        </select>
                        <input type="hidden" name="party_municipality_name" id="party_municipality_name">
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form-select" name="party_barangay" id="party_barangay" required>
                            <option value="{{ $party_address->brgy }}">{{ $party_address->brgy }}</option>
                        </select>
                        <input type="hidden" name="party_barangay_name" id="party_barangay_name">
                    </div>
                    <div class="col-6 col-md-3">
                        <input type="text" class="form-control" name="party_zip_code"
                            placeholder="ex. 2016"
                            value="{{ old('zip_code', $party_address->zip_code) }}"
                            minlength="4" maxlength="4" pattern="\d{4}" inputmode="numeric" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================== SECTION B ======================== -->
        <div class="form-section">
            <h5>B. IMPORMASYON NG OFW (Kung Iba sa Humihiling)</h5>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control uppercase"
                        name="ofw_lname" value="{{ old('ofw_lname', $ofw->ofw_lname) }}" required>
                    @error('ofw_lname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control uppercase"
                        name="ofw_fname" value="{{ old('ofw_fname', $ofw->ofw_fname) }}" required>
                    @error('ofw_fname')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-2">
                    <label class="form-label">Name Ext.</label>
                    <input type="text" class="form-control uppercase" name="ofw_ename"
                        value="{{ old('ofw_ename', $ofw->ofw_ename) }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control uppercase" name="ofw_mname"
                        value="{{ old('ofw_mname', $ofw->ofw_mname) }}">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <label class="form-label">Passport No.</label>
                    <input type="text" class="form-control uppercase" name="ofw_passport_no"
                        placeholder="ex. 123456789"
                        value="{{ old('ofw_passport_no', $ofw->ofw_passport_no) }}">
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label">Sex</label>
                    <select class="form-select" name="ofw_gender">
                        <option value="">Select</option>
                        <option value="Male" {{ old('ofw_gender', $ofw->ofw_gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('ofw_gender', $ofw->ofw_gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label">Civil Status</label>
                    <select class="form-select" name="ofw_civil_status">
                        <option value="" disabled>Select</option>
                        <option value="Single" {{ old('ofw_civil_status', $ofw->ofw_civil_status) == 'Single' ? 'selected' : '' }}>Single</option>
                        <option value="Married" {{ old('ofw_civil_status', $ofw->ofw_civil_status) == 'Married' ? 'selected' : '' }}>Married</option>
                        <option value="Widowed" {{ old('ofw_civil_status', $ofw->ofw_civil_status) == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                    </select>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="ofw_email"
                        placeholder="ex. sample@email.com"
                        value="{{ old('ofw_email', $ofw->ofw_email) }}">
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="ofw_phone"
                        placeholder="ex. 09123456789"
                        value="{{ old('ofw_phone', $ofw->ofw_phone) }}">
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" name="ofw_bday"
                        value="{{ old('ofw_bday', $ofw->ofw_bday) }}">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-6 col-md-3">
                    <label class="form-label">Agency <span class="text-danger">*</span></label>
                    <input type="text" class="form-control uppercase"
                        name="ofw_agency" value="{{ old('ofw_agency', $ofw->ofw_agency) }}" required>
                    @error('ofw_agency')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">Employer <span class="text-danger">*</span></label>
                    <input type="text" class="form-control uppercase"
                        name="ofw_employer" value="{{ old('ofw_employer', $ofw->ofw_employer) }}" required>
                    @error('ofw_employer')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">Bansa <span class="text-danger">*</span></label>
                    <select class="form-select" name="ofw_country" id="ofw_country" required>
                        <option value="">Select Country</option>
                    </select>

                    <input type="hidden" name="ofw_country_name" id="ofw_country_name"
                        value="{{ old('ofw_country_name', $ofw->ofw_country) }}">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">Trabaho <span class="text-danger">*</span></label>
                    <input type="text" class="form-control uppercase"
                        name="ofw_job" value="{{ old('ofw_job', $ofw->ofw_job) }}" required>
                    @error('ofw_job')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Address in the Philippines</label>
                <input type="text" class="form-control mb-2 uppercase" name="ofw_house_no" id="ofw_house_no"
                    placeholder="Unit/Room/House Number/Street name"
                    value="{{ old('ofw_address_street', $ofw_address->house_no) }}">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <select class="form-select" name="ofw_province" id="ofw_province">
                            <option value="{{ $ofw_address->province }}">{{ $ofw_address->province }}</option>
                        </select>
                        <input type="hidden" name="ofw_province_name" id="ofw_province_name">
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form-select" name="ofw_municipality" id="ofw_municipality">
                            <option value="{{ $ofw_address->municipality }}">{{ $ofw_address->municipality }}</option>
                        </select>
                        <input type="hidden" name="ofw_municipality_name" id="ofw_municipality_name">
                    </div>
                    <div class="col-6 col-md-3">
                        <select class="form-select" name="ofw_barangay" id="ofw_barangay">
                            <option value="{{ $ofw_address->brgy }}">{{ $ofw_address->brgy }}</option>
                        </select>
                        <input type="hidden" name="ofw_barangay_name" id="ofw_barangay_name">
                    </div>
                    <div class="col-6 col-md-3">
                        <input type="text" class="form-control" name="ofw_zip_code"
                            placeholder="ex. 2016"
                            value="{{ old('ofw_zip_code', $ofw_address->zip_code) }}"
                            maxlength="4" pattern="\d{4}" inputmode="numeric"
                            oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);">
                    </div>
                </div>
            </div>
        </div>

        <!-- ======================== SECTION C ======================== -->
        <div class="form-section">
            <h5>C. URI NG TULONG (Nature Of Request)</h5>

            <!-- MIGRANT WORKERS PROCESSING DIVISION -->
            <div class="section-divider">
                <h6>MIGRANT WORKERS PROCESSING DIVISION</h6>
                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ofw_info_sheet_mwpd"
                            name="mwpd[]" value="checked"
                            {{ isset($sectionC['ofw_info_sheet_mwpd']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="ofw_info_sheet_mwpd">
                            OFW Records/OFW Information Sheet
                        </label>
                    </div>
                </div>
                
            </div>

            <!-- WELFARE AND REINTEGRATION SERVICES DIVISION -->
            <div class="section-divider">
                <h6>WELFARE AND REINTEGRATION SERVICES DIVISION</h6>

                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="aksyon"
                            name="wrsd[]" value="checked"
                            {{ isset($sectionC['aksyon']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="aksyon">Financial Assistance through AKSYON fund</label>
                    </div>
                </div>
                
            </div>

            <!-- MIGRANT WORKERS PROTECTION DIVISION -->
            <div class="section-divider">
                <h6>MIGRANT WORKERS PROTECTION DIVISION</h6>
                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ofw_info_sheet_mwpd_protection"
                            name="mwpd_protection[]" value="checked"
                            {{ isset($sectionC['ofw_info_sheet_mwpd_protection']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="ofw_info_sheet_mwpd_protection">
                            Request for OFW Information Sheet for legal purposes
                        </label>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="sena"
                            name="mwpd_protection[]" value="checked"
                            {{ isset($sectionC['sena']) ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="sena">Request for Assistance for SEnA/Conciliation</label>
                    </div>
                </div>
                
            </div>
        </div>

        <!-- ACTION BUTTONS -->
        <div class="d-flex justify-content-end gap-3 mb-5">
            <a href="{{ route('forms-submitted.show', $request->id) }}" class="btn btn-cancel">
                Cancel
            </a>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#confirmEditModal">
                Update Form
            </button>
        </div>

        <!-- Confirm Edit Modal -->
        <div class="modal fade" id="confirmEditModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header bg-warning">
                        <h5 class="modal-title">
                            Confirm Update
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="mb-2">
                            You are about to modify <strong>sensitive information</strong>.
                        </p>

                        <p class="text-muted small">
                            Please make sure all details are correct before proceeding.
                            This action will update the OFW and Request Party records.
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-warning">
                            Yes, Update Information
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </form>


</div>


<script>
document.addEventListener("DOMContentLoaded", function () {

    const REGION_3_CODE = "030000000"; // Region III

    const partyProvinceSelect = document.getElementById("party_province");
    const partyMunicipalitySelect = document.getElementById("party_municipality");
    const partyBarangaySelect = document.getElementById("party_barangay");

    const partyProvinceName = document.getElementById("party_province_name");
    const partyMunicipalityName = document.getElementById("party_municipality_name");
    const partyBarangayName = document.getElementById("party_barangay_name");

    partyProvinceName.value = partyProvinceSelect.value;
    partyMunicipalityName.value = partyMunicipalitySelect.value;
    partyBarangayName.value = partyBarangaySelect.value;

    const ofwProvinceSelect = document.getElementById("ofw_province");
    const ofwMunicipalitySelect = document.getElementById("ofw_municipality");
    const ofwBarangaySelect = document.getElementById("ofw_barangay");

    const ofwProvinceName = document.getElementById("ofw_province_name");
    const ofwMunicipalityName = document.getElementById("ofw_municipality_name");
    const ofwBarangayName = document.getElementById("ofw_barangay_name");

    ofwProvinceName.value = ofwProvinceSelect.value;
    ofwMunicipalityName.value = ofwMunicipalitySelect.value;
    ofwBarangayName.value = ofwBarangaySelect.value;

    const countrySelect = document.getElementById("ofw_country");
    const ofwCountryName = document.getElementById("ofw_country_name");

    // IMPORTANT: these must come from Blade
    const dbCountry = "{{ old('ofw_country', $ofw->ofw_country) }}";

    let partyInitialized = true; // prevents reset on first load
    let ofwInitialized = true;

    fetch("https://psgc.gitlab.io/api/regions/" + REGION_3_CODE + "/provinces/")
        .then(res => res.json())
        .then(provinces => {
            const currentProvince = partyProvinceSelect.value;

            partyProvinceSelect.innerHTML = '<option value="">Province</option>';

            provinces.forEach(p => {
                partyProvinceSelect.innerHTML += `
                    <option value="${p.code}" ${p.name === currentProvince ? "selected" : ""}>
                        ${p.name}
                    </option>`;
            });

            // If province exists → load next level
            if (partyProvinceSelect.value) {
                return partyLoadMunicipalities(partyProvinceSelect.value, partyMunicipalitySelect.value);
            }
        })
        .then(() => {
            if (partyMunicipalitySelect.value) {
                return partyLoadBarangays(partyMunicipalitySelect.value, partyBarangaySelect.value);
            }
        });

    function partyLoadMunicipalities(provinceCode, selectedMunicipality = null) {
        return fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
            .then(res => res.json())
            .then(data => {
                const municipalitySelect = partyMunicipalitySelect;
                municipalitySelect.innerHTML = '<option value="">Municipality</option>';

                data.forEach(city => {
                    const selected = city.name === selectedMunicipality ? "selected" : "";
                    municipalitySelect.innerHTML += `
                        <option value="${city.code}" ${selected}>${city.name}</option>
                    `;
                });

                return data;
            });
    }

    function partyLoadBarangays(municipalityCode, selectedBarangay = null) {
        return fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalityCode}/barangays/`)
            .then(res => res.json())
            .then(data => {
                const barangaySelect = partyBarangaySelect;
                barangaySelect.innerHTML = '<option value="">Barangay</option>';

                data.forEach(brgy => {
                    const selected = brgy.name === selectedBarangay ? "selected" : "";
                    barangaySelect.innerHTML += `
                        <option value="${brgy.code}" ${selected}>${brgy.name}</option>
                    `;
                });

                return data;
            });
    }

    // party Province change
    partyProvinceSelect.addEventListener("change", function () {
        partyProvinceName.value = this.options[this.selectedIndex].text;

        partyLoadMunicipalities(this.value).then(() => {
            partyBarangaySelect.innerHTML = '<option value="">Barangay</option>';
        });
        partyMunicipalityName.value = "";
        partyBarangayName.value = "";
    });

    // party Municipality change
    partyMunicipalitySelect.addEventListener("change", function () {
        partyMunicipalityName.value = this.options[this.selectedIndex].text;

        partyLoadBarangays(this.value);
        partyBarangayName.value = "";
    });

    // party Barangay change
    partyBarangaySelect.addEventListener("change", function () {
        partyBarangayName.value = this.options[this.selectedIndex].text;
    });


    fetch("https://psgc.gitlab.io/api/regions/" + REGION_3_CODE + "/provinces/")
        .then(res => res.json())
        .then(provinces => {
            const currentProvince = ofwProvinceSelect.value;

            ofwProvinceSelect.innerHTML = '<option value="">Province</option>';

            provinces.forEach(p => {
                ofwProvinceSelect.innerHTML += `
                    <option value="${p.code}" ${p.name === currentProvince ? "selected" : ""}>
                        ${p.name}
                    </option>`;
            });

            // If province exists → load next level
            if (ofwProvinceSelect.value) {
                return ofwLoadMunicipalities(ofwProvinceSelect.value, ofwMunicipalitySelect.value);
            }
        })
        .then(() => {
            if (ofwMunicipalitySelect.value) {
                return ofwLoadBarangays(ofwMunicipalitySelect.value, ofwBarangaySelect.value);
            }
        });

    function ofwLoadMunicipalities(provinceCode, selectedMunicipality = null) {
        return fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
            .then(res => res.json())
            .then(data => {
                const municipalitySelect = ofwMunicipalitySelect;
                municipalitySelect.innerHTML = '<option value="">Municipality</option>';

                data.forEach(city => {
                    const selected = city.name === selectedMunicipality ? "selected" : "";
                    municipalitySelect.innerHTML += `
                        <option value="${city.code}" ${selected}>${city.name}</option>
                    `;
                });

                return data;
            });
    }

    function ofwLoadBarangays(municipalityCode, selectedBarangay = null) {
        return fetch(`https://psgc.gitlab.io/api/cities-municipalities/${municipalityCode}/barangays/`)
            .then(res => res.json())
            .then(data => {
                const barangaySelect = ofwBarangaySelect;
                barangaySelect.innerHTML = '<option value="">Barangay</option>';

                data.forEach(brgy => {
                    const selected = brgy.name === selectedBarangay ? "selected" : "";
                    barangaySelect.innerHTML += `
                        <option value="${brgy.code}" ${selected}>${brgy.name}</option>
                    `;
                });

                return data;
            });
    }

    // OFW Province change
    ofwProvinceSelect.addEventListener("change", function () {
        ofwProvinceName.value = this.options[this.selectedIndex].text;

        ofwLoadMunicipalities(this.value).then(() => {
            ofwBarangaySelect.innerHTML = '<option value="">Barangay</option>';
        });
        ofwMunicipalityName.value = "";
        ofwBarangayName.value = "";
    });

    // OFW Municipality change
    ofwMunicipalitySelect.addEventListener("change", function () {
        ofwMunicipalityName.value = this.options[this.selectedIndex].text;

        ofwLoadBarangays(this.value);
        ofwBarangayName.value = "";
    });

    // OFW Barangay change
    ofwBarangaySelect.addEventListener("change", function () {
        ofwBarangayName.value = this.options[this.selectedIndex].text;
    });

    fetch('https://api.first.org/data/v1/countries?limit=250')
        .then(res => {
            if (!res.ok) throw new Error(`API error ${res.status}`);
            return res.json();
        })
        .then(data => {
            if (!data?.data) throw new Error('No data');

            const countries = Object.entries(data.data)
                .map(([code, value]) => {
                    let name = (value.country || '').trim();

                    name = name.replace(/\s*\(.*?\)/g, '').trim();
                    name = name.replace(/^the\s+/i, '').trim();

                    return { code: code.toUpperCase(), name };
                })
                .filter(c => c.code && c.name)
                .sort((a, b) => a.name.localeCompare(b.name));

            countrySelect.innerHTML = `<option value="">Select Country</option>`;

            countries.forEach(c => {
            const option = document.createElement("option");
                option.value = c.name;
                option.textContent = c.name;

                if (c.name === dbCountry) {
                    option.selected = true;
                    ofwCountryName.value = c.name; // set hidden/input name
                }

                countrySelect.appendChild(option);
            });

            // SET NAME AFTER LOAD
            const selectedText = countrySelect.options[countrySelect.selectedIndex]?.text;
            // if (selectedText) {
            //     ofwCountryName.value = selectedText;
            // }
        })
        .catch(err => {
            console.error(err);

            const fallback = [
                { code: 'PH', name: 'Philippines' },
                { code: 'US', name: 'United States' },
                { code: 'CA', name: 'Canada' },
                { code: 'GB', name: 'United Kingdom' },
                { code: 'AU', name: 'Australia' }
            ];

            countrySelect.innerHTML = '<option value="">Select Country</option>';

            fallback.forEach(c => {
                const selected = (c.code === dbCountry) ? "selected" : "";

                countrySelect.innerHTML += `
                    <option value="${c.code}" ${selected}>
                        ${c.name}
                    </option>
                `;
            });

            const selectedText = countrySelect.options[countrySelect.selectedIndex]?.text;
            if (selectedText) {
                ofwCountryName.value = selectedText;
            }
        });

        countrySelect.addEventListener("change", function () {
            ofwCountryName.value = this.options[this.selectedIndex].text;
        });
});
</script>

@endsection