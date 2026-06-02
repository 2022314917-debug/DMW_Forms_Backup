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

    .form-header h4 {
        font-weight: bold;
        margin-bottom: 0.5rem;
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

    <form action="{{ route('forms.rfa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Section A: Personal Information -->
        <div class="form-section mb-4">
            <div class="form-section-header">A. PERSONAL INFORMATION</div>

            <!-- Pangalan ng OFW -->
            <h6 class="fw-bold mb-3">Pangalan ng OFW</h6>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="ofw_lname" value="{{ $ofw->ofw_lname }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="ofw_fname" value="{{ $ofw->ofw_fname }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Name Extension</label>
                    <input type="text" class="form-control" name="ofw_ename" value="{{ $ofw->ofw_ename }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="ofw_mname" value="{{ $ofw->ofw_mname }}" readOnly>
                </div>
            </div>

            <!-- Birthday, Sex, Civil Status -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Birthday</label>
                    <input type="date" class="form-control" name="ofw_bday" value="{{ $ofw->ofw_bday }}" readOnly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sex</label>
                    <!-- <select class="form-select" name="ofw_gender" readOnly>
                        <option value="" disabled>Select</option>
                        <option value="Male" {{ $ofw->ofw_gender === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $ofw->ofw_gender === 'Female' ? 'selected' : '' }}>Female</option>
                    </select> -->
                    <input type="text" class="form-control" value="{{ $ofw->ofw_gender ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Civil Status</label>
                    <!-- <select class="form-select" name="ofw_civil_status" readOnly>
                        <option value="" disabled>Select</option>
                        <option value="Single" {{ $ofw->ofw_civil_status === 'Single' ? 'selected' : '' }}>Single / Walang Asawa</option>
                        <option value="Married" {{ $ofw->ofw_civil_status === 'Married' ? 'selected' : '' }}>Married / May Asawa</option>
                        <option value="Widowed" {{ $ofw->ofw_civil_status === 'Widowed' ? 'selected' : '' }}>Widow / Widower (Balo)</option>
                        <option value="Separated" {{ $ofw->ofw_civil_status === 'Separated' ? 'selected' : '' }}>Separated / Hiwalay</option>
                        <option value="Solo Parent" {{ $ofw->ofw_civil_status === 'Solo Parent' ? 'selected' : '' }}>Solo Parent</option>
                    </select> -->
                    <input type="text" class="form-control" value="{{ $ofw->ofw_civil_status ?? '' }}" readonly>
                </div>
            </div>

            <!-- Address in the Philippines -->
            <h6 class="fw-bold mb-3">Address in the Philippines</h6>
            <div class="mb-2">
                <label class="form-label">Unit/Room/House Number/Street Name</label>
                <input type="text" class="form-control" name="ofw_house_no" value="{{ $ofw_address->house_no }}" readOnly>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Province</label>
                    <!-- <select class="form-select" name="ofw_province" id="ofw_province" readOnly>
                        <option value="">Province</option>
                    </select> -->
                    <input type="text" class="form-control" name="ofw_province_name" id="ofw_province_name" value="{{ $ofw_address->province }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">City / Municipality</label>
                    <!-- <select class="form-select" name="ofw_municipality" id="ofw_municipality" disabled readOnly>
                        <option value="">City / Municipality</option>
                    </select> -->
                    <input type="text" class="form-control" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ $ofw_address->municipality }}"readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Barangay</label>
                    <!-- <select class="form-select" name="ofw_barangay" id="ofw_barangay" disabled readOnly>
                        <option value="">Barangay</option>
                    </select> -->
                    <input type="text" class="form-control" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ $ofw_address->brgy }}"readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Zip Code</label>
                    <input
                        type="text"
                        class="form-control"
                        name="ofw_zip_code"
                        placeholder="ex. 2016"
                        value="{{ $ofw_address->zip_code }}"
                        maxlength="4"
                        pattern="\d{4}"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);"
                        readOnly>
                </div>
            </div>

            <!-- Contact Number, Email, Facebook -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="ofw_phone" value="{{ $ofw->ofw_phone }}" readOnly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="ofw_email" value="{{ $ofw->ofw_email }}" readOnly>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Facebook/Messenger Acc.</label>
                    <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_fb_acc" value="{{ $ofw->ofw_fb_acc }}" readOnly>
                </div>
            </div>

            <!-- Passport and Address Abroad -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Passport / Travel Document No.</label>
                    <input type="text" class="form-control" placeholder="24-4645781-7" name="ofw_passport_no" value="{{ $ofw->ofw_passport_no }}" readOnly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kumpletong Address sa Abroad</label>
                    <input type="text" class="form-control" placeholder="Abu Dhabi, United Arab Emirates" name="ofw_address_abroad" value="{{ $ofw->ofw_address_abroad }}" readOnly>
                </div>
            </div>
        </div>

        <!-- Section B: OFW Family Information -->
        <div class="form-section mb-4">
            <div class="form-section-header">B. IMPORMASYON NG KAMAG-ANAK NG OFW NA HUMIHINGING NG TULONG</div>

            <p class="mb-3">Paalala: Sagutan lamang ang bahagang ito kung ang kamag-anak ng OFW ang humihiling ng tulong. Maaaari itong laktawan kung ang mismong OFW ang nagsususumiite ng form.</p>

            <!-- Pangalan ng Kamag-anak -->
            <h6 class="fw-bold mb-3">Pangalan ng Kamag-anak</h6>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="party_lname" value="{{ $party->party_lname ?? '' }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="party_fname" value="{{ $party->party_fname ?? '' }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Name Extension</label>
                    <input type="text" class="form-control" name="party_ename" value="{{ $party->party_ename ?? '' }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="party_mname" value="{{ $party->party_mname ?? '' }}">
                </div>
            </div>

            <!-- Birthday, Relationship -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Birthday</label>
                    <input type="date" class="form-control" name="party_bday" value="{{ $party->party_bday ?? null }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Relationship to OFW</label>
                    <select name="party_relationship" id="party_relationship" class="form-select" readOnly>
                        <option value="" disabled>Select</option>
                        <option value="Spouse" {{ ($party->party_relationship ?? null) === 'Spouse' ? 'selected' : '' }}>Spouse / Asawa</option>
                        <option value="Child" {{ ($party->party_relationship ?? null) === 'Child' ? 'selected' : '' }}>Child / Anak</option>
                        <option value="Parent" {{ ($party->party_relationship ?? null) === 'Parent' ? 'selected' : '' }}>Parent / Magulang</option>
                        <option value="Sibling" {{ ($party->party_relationship ?? null)=== 'Sibling' ? 'selected' : '' }}>Sibling / Kapatid</option>
                        <option value="Other" {{ ($party->party_relationship ?? null) === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Others:</label>
                    <input type="text" class="form-control" name="party_relationship_other" id="party_relationship_other" value="{{ $party->party_relationship_other ?? null }}" disabled placeholder="Please specify...">
                </div>
            </div>

            <!-- Government ID -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Valid Government ID and ID No.</label>
                    <input type="text" class="form-control" name="party_valid_id" value="{{ $party->party_valid_id ?? null }}" readOnly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" placeholder="ex. sample@email.com" name="party_email" value="{{ $party->party_email ?? null }}" readOnly>
                </div>
            </div>

            <!-- Contact and Social Media -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Contact Number (Mobile / Phone)</label>
                    <input type="text" class="form-control" placeholder="ex. 09123456768" name="party_phone" value="{{ $party->party_phone ?? null }}" readOnly>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Facebook/Messenger Account</label>
                    <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="party_fb_acc" value="{{ $party->party_fb_acc ?? null }}" readOnly>
                </div>
            </div>

            <!-- Address in the Philippines -->
            <h6 class="fw-bold mb-3">Kumpletong Address sa Pilipinas</h6>
            <div class="mb-2">
                <label class="form-label">Unit/Room/House Number/Street Name</label>
                <input type="text" class="form-control" name="party_house_no" value="{{ $party_address->house_no ?? null }}" readOnly>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Province</label>
                    <!-- <select class="form-select" name="party_province" id="party_province" readOnly>
                        <option value="">Province</option>
                    </select> -->
                    <input type="text" class="form-control" name="party_province_name" id="party_province_name" value="{{ $party_address->province ?? null }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">City / Municipality</label>
                    <!-- <select class="form-select" name="party_municipality" id="party_municipality" disabled readOnly>
                        <option value="">City / Municipality</option>
                    </select> -->
                    <input type="text" class="form-control" name="party_municipality_name" id="party_municipality_name" value="{{ $party_address->municipality ?? null }}"readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Barangay</label>
                    <!-- <select class="form-select" name="party_barangay" id="party_barangay" disabled readOnly>
                        <option value="">Barangay</option>
                    </select> -->
                    <input type="text" class="form-control" name="party_barangay_name" id="party_barangay_name" value="{{ $party_address->brgy ?? null }}" readOnly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Zip Code</label>
                    <input
                        type="text"
                        class="form-control"
                        name="party_zip_code"
                        placeholder="ex. 2016"
                        value="{{ $party_address->zip_code ?? null }}"
                        maxlength="4"
                        pattern="\d{4}"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);"
                        readOnly>
                </div>
            </div>
        </div>

        <!-- Section C: Type of Assistance -->
        <div class="form-section mb-4">
            <div class="form-section-header">C. URI NG TULONG NA HINIHINGI</div>

            @php
                $uri_ng_tulong = (array)($request->uri_ng_tulong ?? []);
            @endphp

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="LEGAL ASSISTANCE"
                            {{ in_array('LEGAL ASSISTANCE', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">LEGAL ASSISTANCE</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="MEDICAL ASSISTANCE"
                            {{ in_array('MEDICAL ASSISTANCE', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">MEDICAL ASSISTANCE</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="REPATRIATION"
                            {{ in_array('REPATRIATION', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">REPATRIATION</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="RESCUE / EVACUATION"
                            {{ in_array('RESCUE / EVACUATION', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">RESCUE / EVACUATION</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES"
                            {{ in_array('WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">WELFARE ASSISTANCE FOR SENIOR OFW RETURNEES</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="COMPASSIONATE VISIT"
                            {{ in_array('COMPASSIONATE VISIT', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">COMPASSIONATE VISIT</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="SHIPMENT OF HUMAN REMAINS / CREMAINS"
                            {{ in_array('SHIPMENT OF HUMAN REMAINS / CREMAINS', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">SHIPMENT OF HUMAN REMAINS / CREMAINS</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="FOOD ASSISTANCE"
                            {{ in_array('FOOD ASSISTANCE', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">FOOD ASSISTANCE</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="TRANSPORTATION ASSISTANCE"
                            {{ in_array('TRANSPORTATION ASSISTANCE', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">TRANSPORTATION ASSISTANCE</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox"
                            name="uri_ng_tulong[]" value="TEMPORARY SHELTER"
                            {{ in_array('TEMPORARY SHELTER', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                        <label class="form-check-label">TEMPORARY SHELTER</label>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-check mb-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <input class="form-check-input flex-shrink-0" type="checkbox"
                                name="uri_ng_tulong[]" id="others_uri_ng_tulong" value="others"
                                {{ in_array('others', $uri_ng_tulong) ? 'checked' : '' }} disabled>
                            <label class="form-check-label" for="others_uri_ng_tulong">OTHERS</label>
                            <input type="text" class="form-control" id="others_specify"
                                name="others_specify_uri_ng_tulong"
                                placeholder="Please specify..." disabled
                                style="flex: 1; min-width: 120px;"
                                value="{{ $request->others_specify_uri_ng_tulong }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section D: Brief Description -->
        <div class="form-section mb-4">
            <div class="form-section-header">D. MAIKLING SALAYSAY TUNGKOL SA HINIHINGING TULONG</div>

            <p class="mb-3">Ilahad dito ang maikling paliwanag kung anong uri ng tulong ang inyong hinihingi, kasama ang mahahalagang detalye tulad ng dahilan, kailan at saan ito kinakailangan.</p>
            <textarea class="form-control" rows="7" placeholder="Text here..." name="maikling_salaysay" readOnly>{{ $request->maikling_salaysay }}</textarea>
        </div>

        <!-- Section E: Bank Account Information -->
        <div class="form-section mb-4">
            <div class="form-section-header">E. ACCOUNT KUNG SAAN IDEDEPOSITO ANG PINANSYAL NA TULONG</div>

            <p class="mb-3">Sa pamamagitan ng paglalagay ng inyong bank details, pinahihintulutan ninyo ang Department of Migrant Workers (DMW) na ipasok o i-credit ang aprubadong tulong pinansyal sa inyong inilagay na account.</p>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" value="{{ $bank->bank_name ?? '' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bank Branch</label>
                    <input type="text" class="form-control" name="bank_branch" value="{{ $bank->bank_branch ?? '' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="text" class="form-control" name="bank_acc_no" value="{{ $bank->bank_acc_num ?? '' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Name</label>
                    <input type="text" class="form-control" name="bank_acc_name" value="{{ $bank->bank_acc_name ?? '' }}" readonly>
                </div>
            </div>
        </div>

    </form>



</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // ======================== HELPERS ========================

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
        const defaultText = selectEl.id.includes('province')
            ? 'Province'
            : selectEl.id.includes('municipality')
            ? 'City / Municipality'
            : 'Barangay';

        resetSelect(selectEl, defaultText);
        items.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueKey];
            option.textContent = item[labelKey];
            selectEl.appendChild(option);
        });
        selectEl.disabled = false;
    }

    // ======================== PROVINCE DATA ========================

    const staticRegion3Provinces = [
        { code: '030800000', name: 'Bataan' },
        { code: '031400000', name: 'Bulacan' },
        { code: '034900000', name: 'Nueva Ecija' },
        { code: '035400000', name: 'Pampanga' },
        { code: '036900000', name: 'Tarlac' },
        { code: '037100000', name: 'Zambales' },
        { code: '037700000', name: 'Aurora' }
    ];

    function loadProvinces(selectEl, fallback) {
        resetSelect(selectEl, 'Loading provinces...');
        fetch('https://psgc.gitlab.io/api/provinces/')
            .then(res => res.json())
            .then(data => {
                const provinceData = Array.isArray(data) ? data : (Array.isArray(data.value) ? data.value : []);
                const region3 = provinceData.filter(p =>
                    p?.regionCode && (p.regionCode === '030000000' || String(p.regionCode).startsWith('030'))
                );
                populateSelect(selectEl, region3.length ? region3 : fallback, 'code', 'name');
            })
            .catch(() => populateSelect(selectEl, fallback, 'code', 'name'));
    }

    function bindProvinceChange(provinceEl, municipalityEl, barangayEl, provinceNameId) {
        provinceEl.addEventListener('change', function () {
            document.getElementById(provinceNameId).value = this.options[this.selectedIndex].text;
            resetSelect(municipalityEl, 'Loading municipalities...');
            resetSelect(barangayEl, 'Barangay');

            if (!this.value) { resetSelect(municipalityEl, 'City / Municipality'); return; }

            fetch(`https://psgc.gitlab.io/api/provinces/${this.value}/cities-municipalities/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) throw new Error();
                    populateSelect(municipalityEl, data, 'code', 'name');
                })
                .catch(() => resetSelect(municipalityEl, 'City / Municipality'));
        });
    }

    function bindMunicipalityChange(municipalityEl, barangayEl, municipalityNameId) {
        municipalityEl.addEventListener('change', function () {
            document.getElementById(municipalityNameId).value = this.options[this.selectedIndex].text;
            resetSelect(barangayEl, 'Loading barangays...');

            if (!this.value) { resetSelect(barangayEl, 'Barangay'); return; }

            fetch(`https://psgc.gitlab.io/api/cities-municipalities/${this.value}/barangays/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) throw new Error();
                    populateSelect(barangayEl, data, 'code', 'name');
                })
                .catch(() => resetSelect(barangayEl, 'Barangay'));
        });
    }

    function bindBarangayChange(barangayEl, barangayNameId) {
        barangayEl.addEventListener('change', function () {
            document.getElementById(barangayNameId).value = this.options[this.selectedIndex].text;
        });
    }

    // ======================== OFW ADDRESS ========================
    const ofwProvince     = document.getElementById('ofw_province');
    const ofwMunicipality = document.getElementById('ofw_municipality');
    const ofwBarangay     = document.getElementById('ofw_barangay');

    loadProvinces(ofwProvince, staticRegion3Provinces);
    bindProvinceChange(ofwProvince, ofwMunicipality, ofwBarangay, 'ofw_province_name');
    bindMunicipalityChange(ofwMunicipality, ofwBarangay, 'ofw_municipality_name');
    bindBarangayChange(ofwBarangay, 'ofw_barangay_name');

    // ======================== PARTY ADDRESS ========================
    const partyProvince     = document.getElementById('party_province');
    const partyMunicipality = document.getElementById('party_municipality');
    const partyBarangay     = document.getElementById('party_barangay');

    loadProvinces(partyProvince, staticRegion3Provinces);
    bindProvinceChange(partyProvince, partyMunicipality, partyBarangay, 'party_province_name');
    bindMunicipalityChange(partyMunicipality, partyBarangay, 'party_municipality_name');
    bindBarangayChange(partyBarangay, 'party_barangay_name');

    // ======================== OTHERS CHECKBOX ========================
    document.querySelectorAll('input[name="uri_ng_tulong[]"]').forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const othersCheckbox = document.getElementById('others_uri_ng_tulong');
            const othersInput    = document.getElementById('others_specify');
            if (othersCheckbox.checked) {
                othersInput.disabled = false;
                othersInput.focus();
            } else {
                othersInput.disabled = true;
                othersInput.value = '';
            }
        });
    });

    // ======================== RELATIONSHIP DROPDOWN ========================
    document.getElementById('party_relationship').addEventListener('change', function () {
        const otherInput = document.getElementById('party_relationship_other');
        otherInput.disabled = this.value !== 'Other';
        if (otherInput.disabled) otherInput.value = '';
        else otherInput.focus();
    });

    // ======================== FORM SUBMIT HOOK ========================
    document.querySelector('form').addEventListener('submit', function () {
        const dropdown   = document.getElementById('party_relationship');
        const otherInput = document.getElementById('party_relationship_other');
        if (dropdown.value === 'Other' && otherInput.value.trim() !== '') {
            dropdown.value = otherInput.value.trim();
        }
    });

    // ======================== CONFIRM SUBMIT ========================
    document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
        bootstrap.Modal.getInstance(document.getElementById('confirmationModal')).hide();
        document.querySelector('form').submit();
    });
});

// ======================== VALIDATE ========================
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

    new bootstrap.Modal(document.getElementById('confirmationModal')).show();
}
</script>
@endsection