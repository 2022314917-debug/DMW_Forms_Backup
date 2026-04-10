@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f3f7fb; font-family: 'Assistant', Arial, sans-serif; }
        .sena-header { background-color: #f9f2dc; border: 1px solid #e3d3b3; border-radius: .35rem; padding: 1rem 1.25rem; margin-bottom: 1rem; }
        .sena-header h3 { margin: 0; font-weight: 700; letter-spacing: .025em; }
        .sena-note { font-size: .9rem; color: #3c3c3c; }
        .sena-section { background: rgba(219, 232, 255, 0.9); border: 1px solid #c8d9f1; border-radius: .35rem; padding: 1rem; margin-bottom: 1rem; }
        .sena-section h5 { font-weight: 700; margin-bottom: .8rem; }
        .form-label { font-weight: 600; }
        .checkbox-grid { display: grid; grid-template-columns: repeat(4,minmax(0,1fr)); gap: .7rem; }
        .checkbox-grid .form-check { margin-bottom: 0.25rem; }

        @media (max-width: 1200px) {
            .checkbox-grid { grid-template-columns: repeat(3,minmax(0,1fr)); gap: .6rem; }
        }

        @media (max-width: 768px) {
            .checkbox-grid { grid-template-columns: repeat(2,minmax(0,1fr)); gap: .5rem; }
            .checkbox-grid input.form-check-input { transform: scale(1.2); }
            .checkbox-grid .form-check-label { font-size: 1rem; }
        }

        @media (max-width: 425px) {
            .checkbox-grid { grid-template-columns: repeat(2,minmax(0,1fr)); gap: .4rem; }
            .checkbox-grid .form-check-label { font-size: .95rem; }
            .checkbox-grid input.form-check-input { transform: scale(1.15); }
        }
    </style>

    <div class="container my-4">
        <div class="sena-header text-center">
            <h3>SINGLE-ENTRY APPROACH (SENA)</h3>
            <p class="mb-1 sena-note">REFERENCE NO: SEAD-____</p>
            <p class="sena-note">Please provide accurate details for faster processing of your request.</p>
        </div>

        <form method="POST" action="">
            @csrf

            <div class="sena-section">
                <h5>Name of Requesting Party (Pangalan)</h5>
                <div class="row g-3">
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name " class="form-control disabled" value="{{ session('general_form_data.ofw_lname') }}">
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control disabled" value="{{ session('general_form_data.ofw_fname') }}">
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label class="form-label">Name Ext.</label>
                        <input type="text" name="name_ext" class="form-control disabled" value="{{ session('general_form_data.ofw_ename') }}">
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control disabled" value="{{ session('general_form_data.ofw_mname') }}">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Complete Address</label>
                    <div class="">
                        <label class="form-label">House Number / Street</label>
                        <input type="text" name="address" class="form-control" placeholder="Unit/Room/House Number/Street name">
                    </div>

                    <div class="row mt-2">
                        <div class="col-6 col-md-3">
                            <label class="form-label">Province</label>
                            <select id="province" name="province" class="form-select">
                                <option selected disabled>Select</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">City/Municipality</label>
                            <select id="municipality" name="municipality" class="form-select" disabled>
                                <option selected disabled>Select</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Barangay</label>
                            <select id="barangay" name="barangay" class="form-select" disabled>
                                <option selected disabled>Select</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" placeholder="ex. 2016">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_number" class="form-control" placeholder="ex. 09123456768" value="{{ session('general_form_data.ofw_phone') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="ex. sample@email.com" value="{{ session('general_form_data.ofw_email') }}">
                        </div>
                    </div>
                </div>

                

                

                <div class="row g-3 mt-2 align-items-end">
    
                    <!-- Deployment Status -->
                    <div class="col-6 col-md-4">
                        <label class="form-label">Deployment Status</label>
                        <select class="form-select" name="deployment_status">
                            <option selected disabled>Select status</option>
                            <option value="deployed">Deployed</option>
                            <option value="not_deployed">Not Deployed</option>
                        </select>
                    </div>

                    <!-- Gender -->
                    <div class="col-6 col-md-4">
                        <label class="form-label">Gender</label>
                        <!-- <select class="form-select" name="gender">
                            <option selected disabled>Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select> -->
                        <input type="text" name="gender" class="form-control disabled" value="{{ session('general_form_data.ofw_gender') }}">
                    </div>

                    <!-- Age -->
                    <div class="col-12 col-md-4">
                        <label class="form-label">Age</label>
                        <input type="number" name="age" id="age" class="form-control" placeholder="Age">
                    </div>

                </div>

                <hr style="border-color: #b7cbef; margin: 1.5rem 0;" />

                <h5>Nature of Work</h5>
                <div>
                    <div class="checkbox-grid" style="grid-template-columns: repeat(2, 1fr);">
                        
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Household Service">
                            <span class="form-check-label">Household Service</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Seafarer">
                            <span class="form-check-label">Seafarer</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Medical Professional">
                            <span class="form-check-label">Medical Professional</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Offshore Worker">
                            <span class="form-check-label">Offshore Worker</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Engineering Professional">
                            <span class="form-check-label">Engineering Professional</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Construction Laborer">
                            <span class="form-check-label">Construction Laborer</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Caregiver">
                            <span class="form-check-label">Caregiver</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Plumber/Fitter">
                            <span class="form-check-label">Plumber/Fitter</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Manufacturing Laborer">
                            <span class="form-check-label">Manufacturing Laborer</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Welder/Cutter">
                            <span class="form-check-label">Welder/Cutter</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Hotel Staff">
                            <span class="form-check-label">Hotel Staff</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Cleaner/Helper">
                            <span class="form-check-label">Cleaner/Helper</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="nature_of_work[]" value="Entertainer">
                            <span class="form-check-label">Entertainer</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" id="nature_other" name="nature_of_work[]" value="Others">
                            <span class="form-check-label"><strong>Others, specify:</strong></span>
                        </label>
                        
                    </div>
                    <div style="grid-column: 2 / span 1; margin-top: 0.3rem;">
                        <input type="text" name="nature_of_work_others" class="form-control" placeholder="Specify other nature of work" id="nature_other_text" disabled>
                    </div>
                </div>
                

                <hr style="border-color: #b7cbef; margin: 1.5rem 0;" />

                <h5>Deployment Details</h5>
                

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label"><span class="d-none d-lg-inline">Jobsite/</span>Country of Deployment</label>
                        <input type="text" name="jobsite_country" class="form-control" placeholder="ex. Dubai, UAE">
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control disabled" placeholder="ex. Driver" value="{{ session('general_form_data.ofw_job') }}">
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="form-label">Monthly Salary <span class="fst-italic">(PHP)</span></label>
                        <input type="text" name="monthly_salary" class="form-control" placeholder="ex. 40,000">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-5">
                        <label class="form-label">Contract Duration</label>
                        <div class="row g-2">
                            <div class="col-6"><input type="date" name="contract_start" class="form-control"></div>
                            <div class="col-6"><input type="date" name="contract_end" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <label class="form-label">Length of Contract Served</label>
                        <input type="text" name="contract_length" class="form-control" placeholder="ex. 18 months">
                    </div>
                </div>


                <div class="mt-3">
                    <label class="form-label">Action Taken at the Employer Level (Aksyon ng Employer)</label>
                    <textarea name="action_employer" class="form-control" rows="2"></textarea>
                </div>
                <div class="mt-3">
                    <label class="form-label">Action Taken at the MWO Level (Aksyon ng ginawa ng MWO)</label>
                    <textarea name="action_mwo" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <!-- merged first 3 sections -> agency section starts after this -->
            <div class="sena-section">
                <h5>Name of Philippine Recruitment Agency (Pangalan ng Agency sa Pilipinas)</h5>

                <div class="mb-3">
                    <label class="form-label mb-1">Agency Name</label>
                    <input type="text" name="agency_name_ph" class="form-control" placeholder="Agency Name">
                </div>
                <div class="mb-3">
                    <label class="form-label mb-1">Agency Address</label>
                    <input type="text" name="agency_address" class="form-control" placeholder="Address (Opisina)">
                </div>
                <div class="row g-3 mb-3">
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label mb-1">Province</label>
                        <select id="agency_province" name="agency_province" class="form-select">
                            <option selected disabled>Province</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label mb-1">City/Municipality</label>
                        <select id="agency_municipality" name="agency_municipality" class="form-select" disabled>
                            <option selected disabled>City/Municipality</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label mb-1">Barangay</label>
                        <select id="agency_barangay" name="agency_barangay" class="form-select" disabled>
                            <option selected disabled>Barangay</option>
                        </select>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label mb-1">Zip Code</label>
                        <input type="text" name="agency_zip_code" class="form-control" placeholder="ex. 2016">
                    </div>
                </div>

                

                <div class="row g-3 mb-3">

                    <div class="col-md-4">
                        <label class="form-label mb-1">Contact Person Name</label>
                        <input type="text" name="agency_contact_person" class="form-control" placeholder="Contact Person (Taong Kakauapin)">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1">Contact Person Position</label>
                        <input type="text" name="agency_contact_position" class="form-control" placeholder="ex. Manager">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1"><span class="d-none d-lg-inline">Telephone / </span>Cellphone<span class="d-none d-lg-inline">/ Fax </span> / Email Address</label>
                        <input type="text" name="agency_contact_info" class="form-control" placeholder="ex. sample@email.com / 09123456789 / (045) 123-4567">
                    </div>
                </div>

                
            </div>

            <div class="sena-section">
                <h5>Name of Principal (Foreign Placement of Agency or Foreign Service Contractor or Employer)</h5>

                <div class="mb-3">
                    <label class="form-label mb-1">Foreign Agency Name / Employer Name</label>
                    <input type="text" name="agency_name_ph" class="form-control" placeholder="Agency Name">
                </div>
                <div class="mb-3">
                    <label class="form-label mb-1">Foreign Agency Address</label>
                    <input type="text" name="foreign_agency_address" class="form-control" placeholder="Address (Opisina)">
                </div>


                <div class="mb-3">
                    <label class="form-label mb-1">Contact Person Name</label>
                    <input type="text" name="agency_contact_person" class="form-control" placeholder="Contact Person (Taong Kakauapin)">
                </div>

                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label mb-1">Contact Person Name</label>
                        <input type="text" name="foreign_agency_contact_person" class="form-control" placeholder="Contact Person (Taong Kakauapin)">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1">Contact Person Position</label>
                        <input type="text" name="foreign_agency_contact_position" class="form-control" placeholder="ex. Manager">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1"><span class="d-none d-lg-inline">Telephone / </span>Cellphone<span class="d-none d-lg-inline">/ Fax </span> / Email Address</label>
                        <input type="text" name="foreign_agency_contact_info" class="form-control" placeholder="ex. sample@email.com / 09123456789 / (045) 123-4567">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1">Nature of Business</label>
                        <input type="text" name="foreign_agency_business_nature" class="form-control" placeholder="Nature of Business">
                    </div>

                </div>




                <div class="mt-4">
                    <h6 class="fw-bold">COMPLAINTS FILED AT OTHER OFFICE/AGENCY (Reklamo na dinala sa ibang opisina)</h6>
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Date</label>
                            <input type="date" name="complaint_date" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Office</label>
                            <input type="text" name="complaint_office" class="form-control" placeholder="Office">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Nature of Case</label>
                            <input type="text" name="complaint_nature" class="form-control" placeholder="Nature of Case">
                        </div>
                    </div>
                </div>
                
            </div>

            <div class="sena-section">
                <h5>CLAIMS/ISSUES (Mga Karaingan)</h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <h6>1.) Contract Violations</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="contract_violations[]" value="non_payment" id="non_payment">
                            <label class="form-check-label" for="non_payment">Non-payment/underpayment</label>
                        </div>
                        <div class="ms-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contract_violations[]" value="salary" id="salary">
                                <label class="form-check-label" for="salary">Salary</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contract_violations[]" value="overtime" id="overtime">
                                <label class="form-check-label" for="overtime">Overtime Pay</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contract_violations[]" value="rest_day" id="rest_day">
                                <label class="form-check-label" for="rest_day">Rest Day/Day-off</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contract_violations[]" value="sick_leave" id="sick_leave">
                                <label class="form-check-label" for="sick_leave">Sick Leave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contract_violations[]" value="vacation_leave" id="vacation_leave">
                                <label class="form-check-label" for="vacation_leave">Vacation Leave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="contract_violations[]" value="holiday_pay" id="holiday_pay">
                                <label class="form-check-label" for="holiday_pay">Holiday Pay</label>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="contract_violations[]" value="illegal_deductions" id="illegal_deductions">
                            <label class="form-check-label" for="illegal_deductions">Illegal Deductions</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="contract_violations[]" value="non_provision_transport" id="non_provision_transport">
                            <label class="form-check-label" for="non_provision_transport">Non-provision of transport</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="contract_violations[]" value="non_provision_food" id="non_provision_food">
                            <label class="form-check-label" for="non_provision_food">Non-provision of food accommodation or its monetary equivalent</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="contract_violations[]" value="others" id="contract_others">
                            <label class="form-check-label" for="contract_others">Others, please specify</label>
                        </div>
                        <input type="text" name="contract_violations_others" class="form-control" style="margin-top: 0.5rem;">

                        <h6 class="mt-3">2.) Other Money Claims</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="other_money_claims[]" value="end_service_benefits" id="end_service_benefits">
                            <label class="form-check-label" for="end_service_benefits">Claim for end service benefits</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="other_money_claims[]" value="refund_airfare" id="refund_airfare">
                            <label class="form-check-label" for="refund_airfare">Refund of airfare/transportation/repatriation ticket</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="other_money_claims[]" value="unexpired_contract" id="unexpired_contract">
                            <label class="form-check-label" for="unexpired_contract">Payment of unexpired portion of contract</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="other_money_claims[]" value="illegal_fees" id="illegal_fees">
                            <label class="form-check-label" for="illegal_fees">Excessive/illegally collected fees</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="other_money_claims[]" value="disability_benefits" id="disability_benefits">
                            <label class="form-check-label" for="disability_benefits">Payment of disability benefits</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>3.) Delayed in Payment/Time of Payment (specify)</h6>
                        <textarea name="delayed_payment" class="form-control" rows="3"></textarea>

                        <h6 class="mt-3">4.) Non-Monetary issues</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="non_monetary_issues[]" value="withholding_passport" id="withholding_passport">
                            <label class="form-check-label" for="withholding_passport">Withholding of original passport/travel documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="non_monetary_issues[]" value="withholding_documents" id="withholding_documents">
                            <label class="form-check-label" for="withholding_documents">Withholding of other documents (specify)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="non_monetary_issues[]" value="transfer_company" id="transfer_company">
                            <label class="form-check-label" for="transfer_company">Transfer to other company/employer</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="non_monetary_issues[]" value="illegal_termination" id="illegal_termination">
                            <label class="form-check-label" for="illegal_termination">Illegal termination of contract</label>
                        </div>

                        <h6 class="mt-3">5.) Other Issues (specify)</h6>
                        <textarea name="other_issues" class="form-control" rows="3"></textarea>
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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const provinceSelect = document.getElementById('province');
            const municipalitySelect = document.getElementById('municipality');
            const barangaySelect = document.getElementById('barangay');
            const agencyProvinceSelect = document.getElementById('agency_province');
            const agencyMunicipalitySelect = document.getElementById('agency_municipality');
            const agencyBarangaySelect = document.getElementById('agency_barangay');

            function resetSelect(selectEl, text) {
                selectEl.innerHTML = `<option selected disabled>${text}</option>`;
                selectEl.disabled = true;
            }

            function sortItems(items, labelKey) {
                return [...items].sort((a, b) => {
                    const aVal = String(a[labelKey] || '').toLowerCase();
                    const bVal = String(b[labelKey] || '').toLowerCase();
                    return aVal.localeCompare(bVal, undefined, { sensitivity: 'base' });
                });
            }

            function populateSelect(selectEl, items, valueKey, labelKey, defaultText) {
                const sorted = sortItems(items, labelKey);
                resetSelect(selectEl, defaultText);
                sorted.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item[valueKey];
                    option.textContent = item[labelKey];
                    selectEl.appendChild(option);
                });
                selectEl.disabled = false;
            }

            function setupProvinceToCityToBarangay(provinceEl, municipalityEl, barangayEl) {
                provinceEl.addEventListener('change', function() {
                    const provinceCode = this.value;
                    resetSelect(municipalityEl, 'Loading municipalities...');
                    resetSelect(barangayEl, 'Barangay');
                    if (!provinceCode) return;
                    fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
                        .then(r => r.json())
                        .then(data => {
                            if (Array.isArray(data) && data.length) {
                                populateSelect(municipalityEl, data, 'code', 'name', 'City / Municipality');
                            } else {
                                resetSelect(municipalityEl, 'City / Municipality');
                            }
                        })
                        .catch(() => resetSelect(municipalityEl, 'City / Municipality'));
                });

                municipalityEl.addEventListener('change', function() {
                    const cityCode = this.value;
                    resetSelect(barangayEl, 'Loading barangays...');
                    if (!cityCode) return;
                    fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
                        .then(r => r.json())
                        .then(data => {
                            if (Array.isArray(data) && data.length) {
                                populateSelect(barangayEl, data, 'code', 'name', 'Barangay');
                            } else {
                                resetSelect(barangayEl, 'Barangay');
                            }
                        })
                        .catch(() => resetSelect(barangayEl, 'Barangay'));
                });
            }

            const staticRegion3Provinces = [
                { code: '030800000', name: 'Bataan' },
                { code: '031400000', name: 'Bulacan' },
                { code: '034900000', name: 'Nueva Ecija' },
                { code: '035400000', name: 'Pampanga' },
                { code: '036900000', name: 'Tarlac' },
                { code: '037100000', name: 'Zambales' },
                { code: '037700000', name: 'Aurora' }
            ];

            resetSelect(provinceSelect, 'Loading provinces...');
            resetSelect(municipalitySelect, 'City / Municipality');
            resetSelect(barangaySelect, 'Barangay');
            resetSelect(agencyProvinceSelect, 'Loading provinces...');
            resetSelect(agencyMunicipalitySelect, 'City / Municipality');
            resetSelect(agencyBarangaySelect, 'Barangay');

            // Register cascading listeners for both sets
            setupProvinceToCityToBarangay(provinceSelect, municipalitySelect, barangaySelect);
            setupProvinceToCityToBarangay(agencyProvinceSelect, agencyMunicipalitySelect, agencyBarangaySelect);

            fetch('https://psgc.gitlab.io/api/provinces/')
                .then(resp => resp.json())
                .then(data => {
                    const provinceData = Array.isArray(data) ? data : Array.isArray(data.value) ? data.value : [];
                    const region3 = provinceData.filter(p => p && (p.regionCode === '030000000' || String(p.regionCode).startsWith('030')));
                    const provincesToUse = region3.length ? region3 : staticRegion3Provinces;
                    populateSelect(provinceSelect, provincesToUse, 'code', 'name', 'Province');
                    populateSelect(agencyProvinceSelect, provinceData, 'code', 'name', 'Province');
                })
                .catch(() => {
                    populateSelect(provinceSelect, staticRegion3Provinces, 'code', 'name', 'Province');
                    populateSelect(agencyProvinceSelect, staticRegion3Provinces, 'code', 'name', 'Province');
                });

            
            const natureRadios = document.querySelectorAll('input[name="nature_of_work[]"]');
            const natureOther = document.getElementById('nature_other');
            const natureOtherText = document.getElementById('nature_other_text');

            natureRadios.forEach(radio => {
                radio.addEventListener('change', function () {
                    if (natureOther.checked) {
                        natureOtherText.disabled = false;
                        natureOtherText.focus();
                    } else {
                        natureOtherText.disabled = true;
                        natureOtherText.value = '';
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {

            // Get birthday from Laravel session
            let bday = "{{ session('general_form_data.party_bday') }}";

            if (bday) {
                let birthDate = new Date(bday);
                let today = new Date();

                let age = today.getFullYear() - birthDate.getFullYear();
                let monthDiff = today.getMonth() - birthDate.getMonth();

                // adjust if birthday not yet reached this year
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                document.getElementById("age").value = age;
                console.log(bday);
            }

        });
    </script>
@endsection
