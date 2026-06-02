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
        <a href="{{ route('forms-submitted.show', $request->id ?? null) }}" 
          class="btn btn-secondary btn-sm position-absolute start-0 d-flex align-items-center gap-1"
          style="border-radius: 6px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back to Request
        </a>
        <h4 class="h2 mb-0 fw-bold">REQUEST #{{ $request->id ?? null }}</h4>
    </div>
    
    <!-- Header Section -->
    <div class="form-header text-center">
        <h4>ONLINE REQUEST FOR ASSISTANCE</h4>
        <p class="mb-0">Use this form to submit a request for assistance. Please ensure that all information provided is accurate and complete so that our team can process your request efficiently.</p>
    </div>

    <form id="rfaForm" action="{{ route('forms-submitted.save-edit-rfa', [$request->id ?? null, $formId ?? null]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <!-- Section A: Personal Information -->
        <div class="form-section mb-4">
            <div class="form-section-header">A. PERSONAL INFORMATION</div>

            <!-- Pangalan ng OFW -->
            <h6 class="fw-bold mb-3">Pangalan ng OFW</h6>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="ofw_lname" value="{{ $ofw->ofw_lname ?? null }}" >
                </div>
                <div class="col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="ofw_fname" value="{{ $ofw->ofw_fname ?? null }}" >
                </div>
                <div class="col-md-3">
                    <label class="form-label">Name Extension</label>
                    <input type="text" class="form-control" name="ofw_ename" value="{{ $ofw->ofw_ename ?? null }}" >
                </div>
                <div class="col-md-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="ofw_mname" value="{{ $ofw->ofw_mname ?? null }}" >
                </div>
            </div>

            <!-- Birthday, Sex, Civil Status -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Birthday</label>
                    <input type="date" class="form-control" name="ofw_bday" value="{{ $ofw->ofw_bday ?? null }}" >
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sex</label>
                    <select class="form-select" name="ofw_gender" >
                        <option value="" disabled>Select</option>
                        <option value="Male" {{ ($ofw->ofw_gender ?? null) === 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ ($ofw->ofw_gender ?? null) === 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Civil Status</label>
                    <input type="text" class="form-control" name="ofw_civil_status" value="{{ $ofw->ofw_civil_status ?? null }}" >
                </div>
            </div>

            <!-- Address in the Philippines -->
            <h6 class="fw-bold mb-3">Address in the Philippines</h6>
            <div class="mb-2">
                <label class="form-label">Unit/Room/House Number/Street Name</label>
                <input type="text" class="form-control" name="ofw_house_no" value="{{ $ofw_address->house_no ?? null }}" >
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Province</label>
                    <select class="form-select" name="ofw_province" id="ofw_province" required>
                        <option value="{{ $ofw_address->province ?? null }}">{{ $ofw_address->province ?? null }}</option>
                    </select>
                    <input type="hidden" class="form-control" name="ofw_province_name" id="ofw_province_name" value="{{ $ofw_address->province ?? null }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">City / Municipality</label>
                    <select class="form-select" name="ofw_municipality" id="ofw_municipality" required>
                        <option value="{{ $ofw_address->municipality ?? null }}">{{ $ofw_address->municipality ?? null }}</option>
                    </select>
                    <input type="hidden" class="form-control" name="ofw_municipality_name" id="ofw_municipality_name" value="{{ $ofw_address->municipality ?? null }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Barangay</label>
                    <select class="form-select" name="ofw_barangay" id="ofw_barangay" required>
                        <option value="{{ $ofw_address->brgy ?? null }}">{{ $ofw_address->brgy ?? null }}</option>
                    </select>
                    <input type="hidden" class="form-control" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ $ofw_address->brgy ?? null }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Zip Code</label>
                    <input
                        type="text"
                        class="form-control"
                        name="ofw_zip_code"
                        placeholder="ex. 2016"
                        value="{{ $ofw_address->zip_code ?? null }}"
                        maxlength="4"
                        pattern="\d{4}"
                        inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);"
                        >
                </div>
            </div>

            <!-- Contact Number, Email, Facebook -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label">Contact Number</label>
                    <input type="text" class="form-control" name="ofw_phone" value="{{ $ofw->ofw_phone ?? null }}" >
                </div>
                <div class="col-md-4">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" name="ofw_email" value="{{ $ofw->ofw_email ?? null }}" >
                </div>
                <div class="col-md-4">
                    <label class="form-label">Facebook/Messenger Acc.</label>
                    <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="ofw_fb_acc" value="{{ $ofw->ofw_fb_acc ?? null }}">
                </div>
            </div>

            <!-- Passport and Address Abroad -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Passport / Travel Document No.</label>
                    <input type="text" class="form-control" placeholder="24-4645781-7" name="ofw_passport_no" value="{{ $ofw->ofw_passport_no ?? null }}" >
                </div>
                <div class="col-md-6">
                    <label class="form-label">Kumpletong Address sa Abroad</label>
                    <input type="text" class="form-control" placeholder="Abu Dhabi, United Arab Emirates" name="ofw_address_abroad" value="{{ $ofw->ofw_address_abroad ?? null }}" >
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
                    <input type="text" class="form-control" name="party_lname" value="{{ $party->party_lname ?? null }}" >
                </div>
                <div class="col-md-3">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-control" name="party_fname" value="{{ $party->party_fname ?? null }}" >
                </div>
                <div class="col-md-3">
                    <label class="form-label">Name Extension</label>
                    <input type="text" class="form-control" name="party_ename" value="{{ $party->party_ename ?? null }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" class="form-control" name="party_mname" value="{{ $party->party_mname ?? null }}">
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
                    <select name="party_relationship" id="party_relationship" class="form-select" >
                        <option value="" disabled>Select</option>
                        <option value="Spouse" {{ ($party->party_relationship ?? null) === 'Spouse' ? 'selected' : '' }}>Spouse / Asawa</option>
                        <option value="Child" {{ ($party->party_relationship ?? null) === 'Child' ? 'selected' : '' }}>Child / Anak</option>
                        <option value="Parent" {{ ($party->party_relationship ?? null) === 'Parent' ? 'selected' : '' }}>Parent / Magulang</option>
                        <option value="Sibling" {{ ($party->party_relationship ?? null) === 'Sibling' ? 'selected' : '' }}>Sibling / Kapatid</option>
                        <option value="Other" {{ ($party->party_relationship ?? null) === 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Others:</label>
                    <input type="text"
                        class="form-control {{ (($party->party_relationship ?? null) === 'Other') ? '' : 'disabled' }}"
                        name="party_relationship_other"
                        id="party_relationship_other"
                        value="{{ (($party->party_relationship ?? null) === 'Other') ? ($party->party_relationship_other ?? null) : '' }}"
                        placeholder="Please specify..."
                    >
                </div>
            </div>

            <!-- Government ID -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Valid Government ID and ID No.</label>
                    <input type="text" class="form-control" name="party_valid_id" value="{{ $party->party_valid_id ?? null }}" >
                </div>
                <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" class="form-control" placeholder="ex. sample@email.com" name="party_email" value="{{ $party->party_email ?? null }}" >
                </div>
            </div>

            <!-- Contact and Social Media -->
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label">Contact Number (Mobile / Phone)</label>
                    <input type="text" class="form-control" placeholder="ex. 09123456768" name="party_phone" value="{{ $party->party_phone ?? null }}" >
                </div>
                <div class="col-md-6">
                    <label class="form-label">Facebook/Messenger Account</label>
                    <input type="text" class="form-control" placeholder="ex. Juan Dela Cruz" name="party_fb_acc" value="{{ $party->party_fb_acc ?? null }}" >
                </div>
            </div>

            <!-- Address in the Philippines -->
            <h6 class="fw-bold mb-3">Kumpletong Address sa Pilipinas</h6>
            <div class="mb-2">
                <label class="form-label">Unit/Room/House Number/Street Name</label>
                <input type="text" class="form-control" name="party_house_no" value="{{ $party_address->house_no ?? null }}" >
            </div>
            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="form-label">Province</label>
                    <select class="form-select" name="party_province" id="party_province" >
                         <option value="{{ $party_address->province ?? null }}">{{ $party_address->province ?? null }}</option>
                    </select>
                    <input type="hidden" class="form-control" name="party_province_name" id="party_province_name" value="{{ $party_address->province ?? null }}" >
                </div>
                <div class="col-md-3">
                    <label class="form-label">City / Municipality</label>
                    <select class="form-select" name="party_municipality" id="party_municipality" disabled >
                        <option value="{{ $party_address->municipality ?? null }}">{{ $party_address->municipality ?? null }}</option>
                    </select>
                    <input type="hidden" class="form-control" name="party_municipality_name" id="party_municipality_name" value="{{ $party_address->municipality ?? null }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Barangay</label>
                    <select class="form-select" name="party_barangay" id="party_barangay" disabled >
                        <option value="{{ $party_address->brgy ?? null }}">{{ $party_address->brgy ?? null }}</option>
                    </select>
                    <input type="hidden" class="form-control" name="party_barangay_name" id="party_barangay_name" value="{{ $party_address->brgy ?? null }}" >
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
                        >
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
            <textarea class="form-control" rows="7" placeholder="Text here..." name="maikling_salaysay" >{{ $request->maikling_salaysay ?? null }}</textarea>
        </div>

        <!-- Section E: Bank Account Information -->
        <div class="form-section mb-4">
            <div class="form-section-header">E. ACCOUNT KUNG SAAN IDEDEPOSITO ANG PINANSYAL NA TULONG</div>

            <p class="mb-3">Sa pamamagitan ng paglalagay ng inyong bank details, pinahihintulutan ninyo ang Department of Migrant Workers (DMW) na ipasok o i-credit ang aprubadong tulong pinansyal sa inyong inilagay na account.</p>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" value="{{ $bank->bank_name ?? null }}" >
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bank Branch</label>
                    <input type="text" class="form-control" name="bank_branch" value="{{ $bank->bank_branch ?? null }}" >
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Number</label>
                    <input type="text" class="form-control" name="bank_acc_num" value="{{ $bank->bank_acc_num ?? null }}" >
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Account Name</label>
                    <input type="text" class="form-control" name="bank_acc_name" value="{{ $bank->bank_acc_name ?? null }}" >
                </div>
            </div>
        </div>
        <!-- Update Button -->
        <div class="d-flex justify-content-end mt-3 mb-5">
            <button type="button" class="btn btn-confirm px-4" id="updateBtn" onclick="validateAndSubmit()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="me-1" viewBox="0 0 16 16">
                    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
                </svg>
                Update Request
            </button>
        </div>
    </form>

    

    <!-- Toast Notification -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999">
        <div id="resultToast" class="toast align-items-center border-0 text-white" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold" id="toastMessage"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Confirm Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to save the changes to this request?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-confirm btn-sm" id="confirmSubmitBtn">Yes, Update</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="me-2 mb-1" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                        </svg>
                        Incomplete Fields
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2 text-muted small">Please fill in the following required fields before submitting:</p>
                    <ul id="validationErrorList" class="mb-0 ps-3 small text-danger"></ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const successMsg = "{{ session('success') }}";
        const errorMsg   = "{{ session('error') }}";
        if (successMsg) showToast(successMsg, 'success');
        else if (errorMsg) showToast(errorMsg, 'danger');

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

        function bindProvinceChange(provinceEl, municipalityEl, barangayEl, provinceNameId) {
            provinceEl.addEventListener('change', function () {
                document.getElementById(provinceNameId).value = this.options[this.selectedIndex].text;
                const municipalityNameInput = document.getElementById(municipalityEl.id.replace('municipality', 'municipality_name'));
                document.getElementById(municipalityEl.id + '_name').value = '';
                document.getElementById(barangayEl.id + '_name').value = '';
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
                document.getElementById(barangayEl.id + '_name').value = '';
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

        async function initAddressDropdowns(provinceEl, municipalityEl, barangayEl, provinceNameId, municipalityNameId, barangayNameId) {
            const savedProvince     = document.getElementById(provinceNameId).value.trim();
            const savedMunicipality = document.getElementById(municipalityNameId).value.trim();
            const savedBarangay     = document.getElementById(barangayNameId).value.trim();

            resetSelect(provinceEl, 'Loading provinces...');
            let provinceData = [];
            try {
                const res  = await fetch('https://psgc.gitlab.io/api/provinces/');
                const data = await res.json();
                const all  = Array.isArray(data) ? data : (Array.isArray(data.value) ? data.value : []);
                provinceData = all.filter(p =>
                    p?.regionCode && (p.regionCode === '030000000' || String(p.regionCode).startsWith('030'))
                );
                if (!provinceData.length) provinceData = staticRegion3Provinces;
            } catch { provinceData = staticRegion3Provinces; }
            populateSelect(provinceEl, provinceData, 'code', 'name');

            let savedProvinceCode = null;
            if (savedProvince) {
                for (const opt of provinceEl.options) {
                    if (opt.text === savedProvince) { opt.selected = true; savedProvinceCode = opt.value; break; }
                }
            }

            bindProvinceChange(provinceEl, municipalityEl, barangayEl, provinceNameId);
            if (!savedProvinceCode) return;

            resetSelect(municipalityEl, 'Loading municipalities...');
            let munData = [];
            try {
                const res  = await fetch(`https://psgc.gitlab.io/api/provinces/${savedProvinceCode}/cities-municipalities/`);
                const data = await res.json();
                if (Array.isArray(data) && data.length) munData = data;
            } catch {}
            if (!munData.length) { resetSelect(municipalityEl, 'City / Municipality'); return; }
            populateSelect(municipalityEl, munData, 'code', 'name');

            let savedMunCode = null;
            if (savedMunicipality) {
                for (const opt of municipalityEl.options) {
                    if (opt.text === savedMunicipality) { opt.selected = true; savedMunCode = opt.value; break; }
                }
            }

            bindMunicipalityChange(municipalityEl, barangayEl, municipalityNameId);
            if (!savedMunCode) return;

            resetSelect(barangayEl, 'Loading barangays...');
            let brgyData = [];
            try {
                const res  = await fetch(`https://psgc.gitlab.io/api/cities-municipalities/${savedMunCode}/barangays/`);
                const data = await res.json();
                if (Array.isArray(data) && data.length) brgyData = data;
            } catch {}
            if (!brgyData.length) { resetSelect(barangayEl, 'Barangay'); return; }
            populateSelect(barangayEl, brgyData, 'code', 'name');

            if (savedBarangay) {
                for (const opt of barangayEl.options) {
                    if (opt.text === savedBarangay) { opt.selected = true; break; }
                }
            }

            bindBarangayChange(barangayEl, barangayNameId);
        }

        initAddressDropdowns(
            document.getElementById('ofw_province'),
            document.getElementById('ofw_municipality'),
            document.getElementById('ofw_barangay'),
            'ofw_province_name', 'ofw_municipality_name', 'ofw_barangay_name'
        );

        initAddressDropdowns(
            document.getElementById('party_province'),
            document.getElementById('party_municipality'),
            document.getElementById('party_barangay'),
            'party_province_name', 'party_municipality_name', 'party_barangay_name'
        );

        // ======================== OTHERS CHECKBOX ========================
        document.querySelectorAll('input[name="uri_ng_tulong[]"]').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const othersCheckbox = document.getElementById('others_uri_ng_tulong');
                const othersInput    = document.getElementById('others_specify');
                if (othersCheckbox.checked) { othersInput.disabled = false; othersInput.focus(); }
                else { othersInput.disabled = true; othersInput.value = ''; }
            });
        });

        // Toggle the other input based on the selected value
        document.getElementById('party_relationship').addEventListener('change', function () {
            const otherInput = document.getElementById('party_relationship_other');
            const otherInputFromDB = "{{ $party->party_relationship_other ?? null }}";

            if (this.value === 'Other') {
                otherInput.classList.remove('disabled');
                otherInput.focus();
                otherInput.value = otherInputFromDB;
            } else {
                otherInput.classList.add('disabled');
                otherInput.value = '';
            }
        });

        // ======================== AJAX SUBMIT ========================
        document.getElementById('confirmSubmitBtn').addEventListener('click', function () {
            const modal      = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
            const form       = document.getElementById('rfaForm');
            const formData   = new FormData(form);
            const submitBtn  = document.getElementById('confirmSubmitBtn');
            const updateBtn  = document.getElementById('updateBtn');

            // Disable buttons to prevent double submission
            submitBtn.disabled = true;
            updateBtn.disabled = true;
            submitBtn.innerHTML = `
                <span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>
                Updating...
            `;

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content
                                 ?? '{{ csrf_token() }}',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
                body: formData,
            })
            .then(res => res.json())
            .then(data => {
                modal.hide();

                if (data.success) {
                    showToast(data.message ?? 'Request updated successfully.', 'success');
                } else {
                    showToast(data.message ?? 'Something went wrong.', 'danger');
                }

                // Re-enable buttons regardless of outcome
                submitBtn.disabled = false;
                updateBtn.disabled = false;
                submitBtn.innerHTML = 'Yes, Update';
            })
            .catch(() => {
                modal.hide();
                showToast('A network error occurred. Please try again.', 'danger');
                submitBtn.disabled = false;
                updateBtn.disabled = false;
                submitBtn.innerHTML = 'Yes, Update';
            });
        });
    });

    // ======================== VALIDATE / OPEN MODAL ========================
    function validateAndSubmit() {
        const errors = [];

        const trim = name => (document.querySelector(`[name="${name}"]`)?.value ?? '').trim();

        // ── Section A: OFW Name ───────────────────────────────────────────
        if (!trim('ofw_lname'))  errors.push('Section A – OFW Last Name is required.');
        if (!trim('ofw_fname'))  errors.push('Section A – OFW First Name is required.');
        if (!trim('ofw_bday'))   errors.push('Section A – OFW Birthday is required.');
        if (!trim('ofw_gender')) errors.push('Section A – OFW Sex is required.');
        if (!trim('ofw_civil_status')) errors.push('Section A – OFW Civil Status is required.');

        // ── Section A: OFW Address in the Philippines ─────────────────────
        if (!trim('ofw_house_no')) errors.push('Section A – OFW Unit/House No./Street Name is required.');

        const ofwProvince     = document.getElementById('ofw_province');
        const ofwMunicipality = document.getElementById('ofw_municipality');
        const ofwBarangay     = document.getElementById('ofw_barangay');

        if (!ofwProvince.value || ofwProvince.options[ofwProvince.selectedIndex]?.text === 'Province')
            errors.push('Section A – OFW Province is required.');
        if (!ofwMunicipality.value || ofwMunicipality.disabled || ofwMunicipality.options[ofwMunicipality.selectedIndex]?.text === 'City / Municipality')
            errors.push('Section A – OFW City / Municipality is required.');
        if (!ofwBarangay.value || ofwBarangay.disabled || ofwBarangay.options[ofwBarangay.selectedIndex]?.text === 'Barangay')
            errors.push('Section A – OFW Barangay is required.');

        if (!trim('ofw_zip_code'))  errors.push('Section A – OFW Zip Code is required.');

        // ── Section A: OFW Contact Details ───────────────────────────────
        if (!trim('ofw_phone'))          errors.push('Section A – OFW Contact Number is required.');
        if (!trim('ofw_email'))          errors.push('Section A – OFW Email Address is required.');
        if (!trim('ofw_fb_acc'))         errors.push('Section A – OFW Facebook/Messenger Account is required.');
        if (!trim('ofw_passport_no'))    errors.push('Section A – OFW Passport / Travel Document No. is required.');
        if (!trim('ofw_address_abroad')) errors.push('Section A – OFW Address Abroad is required.');

        // ── Section D: Brief Description ──────────────────────────────────
        const salaysay = (document.querySelector('[name="maikling_salaysay"]')?.value ?? '').trim();
        if (!salaysay) errors.push('Section D – Maikling Salaysay / Brief Description is required.');

        // ── Show errors or proceed ────────────────────────────────────────
        if (errors.length > 0) {
            const list = document.getElementById('validationErrorList');
            list.innerHTML = errors.map(e => `<li class="mb-1">${e}</li>`).join('');
            new bootstrap.Modal(document.getElementById('validationModal')).show();
            return;
        }

        new bootstrap.Modal(document.getElementById('confirmationModal')).show();
    }

    // ======================== TOAST ========================
    function showToast(message, type = 'success') {
        const toastEl  = document.getElementById('resultToast');
        const toastMsg = document.getElementById('toastMessage');
        toastEl.classList.remove('bg-success', 'bg-danger', 'bg-warning');
        toastEl.classList.add('bg-' + type);
        toastMsg.textContent = message;
        new bootstrap.Toast(toastEl, { delay: 4000 }).show();
    }

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
</script>
@endsection