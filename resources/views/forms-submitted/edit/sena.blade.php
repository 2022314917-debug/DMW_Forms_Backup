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

    <div class="container my-4">
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
        <div class="sena-header text-center">
            <h3>SINGLE-ENTRY APPROACH (SENA)</h3>
            <p class="mb-1 sena-note">REFERENCE NO: SEAD-____</p>
            <p class="sena-note">Please provide accurate details for faster processing of your request.</p>
        </div>

        <form id="rfaForm" action="{{ route('forms-submitted.save-edit-sena', [$request->id, $formId]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="sena-section">
                <h5>Name of OFW (Pangalan)</h5>
                <div class="row g-3">
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" name="last_name " class="form-control disabled" value="{{ $ofw->ofw_lname }}" readonly>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <label class="form-label">First Name</label>
                        <input type="text" name="first_name" class="form-control disabled" value="{{ $ofw->ofw_fname }}" readonly>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <label class="form-label">Name Ext.</label>
                        <input type="text" name="name_ext" class="form-control disabled" value="{{ $ofw->ofw_ename }}" readonly>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <label class="form-label">Middle Name</label>
                        <input type="text" name="middle_name" class="form-control disabled" value="{{ $ofw->ofw_mname }}" readonly>
                    </div>
                </div>

                <div class="mt-3">
                    <label class="fw-bold">Complete Address</label>
                    <div class="">
                        <label class="form-label">House Number / Street</label>
                        <input type="text" name="ofw_house_no" class="form-control disabled" value="{{ $ofw_address->house_no }}" readonly>
                    </div>

                    <div class="row mt-2">
                        <div class="col-6 col-md-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control disabled" name="ofw_province" id="ofw_province" value="{{ $ofw_address->province }}" readonly>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">City/Municipality</label>
                            <input type="text" class="form-control disabled" name="ofw_municipality_name" id="ofw_municipality" value="{{ $ofw_address->municipality }}" readonly>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Barangay</label>
                            <input type="text" class="form-control disabled" name="ofw_barangay" id="ofw_barangay" value="{{ $ofw_address->brgy }}" readonly>
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control disabled" value="{{ $ofw_address->zip_code }}" readonly>
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="ofw_phone" class="form-control disabled" placeholder="ex. 09123456768" value="{{ $ofw->ofw_phone }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="ofw_email" class="form-control disabled" placeholder="ex. sample@email.com" value="{{ $ofw->ofw_email }}" readonly>
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-2 align-items-end">
    
                    <!-- Deployment Status -->
                    <div class="col-6 col-md-4">
                        <label class="form-label">Deployment Status</label>
                        <select class="form-select" name="sena_deployment_status">
                            <option selected disabled >Select status</option>
                            <option value="Deployed" {{ $entries['sena_deployment_status'] === 'Deployed' ? 'selected' : '' }}>Deployed</option>
                            <option value="Not Deployed" {{ $entries['sena_deployment_status'] === 'Not Deployed' ? 'selected' : '' }}>Not Deployed</option>
                        </select>
                        <!-- <input type="text" class="form-control disabled" name="sena_deployment_status" value="{{ $entries['sena_deployment_status'] }}" readonly> -->
                    </div>

                    <!-- Gender -->
                    <div class="col-6 col-md-4">
                        <label class="form-label">Gender</label>
                        <input type="text" name="gender" class="form-control disabled" value="{{ $ofw->ofw_gender }}">
                    </div>

                    <!-- Age -->
                    <div class="col-12 col-md-4">
                        <label class="form-label">Age</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="sena_ofw_age" 
                            placeholder="ex. 20" 
                            value="{{ $entries['sena_ofw_age'] }}"
                            maxlength="2"          
                            pattern="\d{2}"         
                            inputmode="numeric"     
                            oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,2);" 
                        >
                    </div>

                </div>

                <hr style="border-color: #b7cbef; margin: 1.5rem 0;" />

                <h5>Nature of Work</h5>
                <div>
                    <div class="checkbox-grid" style="grid-template-columns: repeat(2, 1fr);">
                    
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="household_professional" value="Household Service" {{ $entries['sena_nature_of_work'] == 'Household Service' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Household Service</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="seaferer_sena" value="Seafarer" {{ $entries['sena_nature_of_work'] == 'Seafarer' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Seafarer</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="medical_professional" value="Medical Professional" {{ $entries['sena_nature_of_work'] == 'Medical Professional' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Medical Professional</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="offshore_worker" value="Offshore Worker" {{ $entries['sena_nature_of_work'] == 'Offshore Worker' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Offshore Worker</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="engineering_professional" value="Engineering Professional" {{ $entries['sena_nature_of_work'] == 'Engineering Professional' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Engineering Professional</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="construcion_laborer" value="Construction Laborer" {{ $entries['sena_nature_of_work'] == 'Construction Laborer' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Construction Laborer</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="caregiver" value="Caregiver" {{ $entries['sena_nature_of_work'] == 'Caregiver' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Caregiver</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="plumber" value="Plumber/Fitter" {{ $entries['sena_nature_of_work'] == 'Plumber/Fitter' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Plumber/Fitter</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="manufacturing_laborer" value="Manufacturing Laborer" {{ $entries['sena_nature_of_work'] == 'Manufacturing Laborer' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Manufacturing Laborer</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="welder" value="Welder/Cutter" {{ $entries['sena_nature_of_work'] == 'Welder/Cutter' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Welder/Cutter</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="hotel_staff" value="Hotel Staff" {{ $entries['sena_nature_of_work'] == 'Hotel Staff' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Hotel Staff</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="cleaner" value="Cleaner/Helper" {{ $entries['sena_nature_of_work'] == 'Cleaner/Helper' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Cleaner/Helper</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="entertainer" value="Entertainer" {{ $entries['sena_nature_of_work'] == 'Entertainer' ? 'checked' : '' }} disabled>
                            <span class="form-check-label">Entertainer</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="sena_nature_of_work" id="other_professional"  value="Other Professional" {{ $entries['sena_nature_of_work'] == 'Other Professional' ? 'checked' : '' }} disabled>
                            <span class="form-check-label"><strong>Others, specify:</strong></span>
                        </label>
                        
                    </div>
                    <div style="grid-column: 2 / span 1; margin-top: 0.3rem;">
                        <input type="text" name="sena_nature_of_work_other_specify" class="form-control" placeholder="Specify other nature of work" id="sena_nature_of_work_other_specify" disabled value="{{ $entries['sena_nature_of_work_other_specify'] ?? '' }}">
                    </div>
                </div>
                

                <hr style="border-color: #b7cbef; margin: 1.5rem 0;" />

                <h5>Deployment Details</h5>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label"><span class="d-none d-lg-inline">Jobsite/</span>Country of Deployment</label>
                        <input type="text" name="sena_jobsite" class="form-control" value="{{ $entries['sena_jobsite'] }}" >
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="form-label">Position</label>
                        <input type="text" name="sena_job_position" class="form-control" placeholder="ex. Driver" value="{{ $entries['sena_job_position'] }}" >
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="form-label">Monthly Salary <span class="fst-italic">(PHP)</span></label>
                        <input type="text" name="sena_monthly_salary" id="sena_monthly_salary" class="form-control" placeholder="ex. 40,000" value="{{ $entries['sena_monthly_salary'] }}" >
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-5">
                        <label class="form-label">Contract Duration</label>
                        <div class="row g-2">
                            <div class="col-6"><input type="date" name="sena_contract_start" id="sena_contract_start" class="form-control" value="{{ $entries['sena_contract_start'] }}" ></div>
                            <div class="col-6"><input type="date" name="sena_contract_end" id="sena_contract_end" class="form-control" value="{{ $entries['sena_contract_end'] }}" ></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <label class="form-label">Length of Contract Served</label>
                        <input type="text" name="sena_length_contract_served" id="sena_length_contract_served" class="form-control" placeholder="ex. 18 months" value="{{ $entries['sena_length_contract_served'] }}" >
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label">Action Taken at the Employer Level (Aksyon ng Employer)</label>
                    <textarea name="sena_action_taken_employer_level" id="sena_action_taken_employer_level" class="form-control" rows="2" >{{ $entries['sena_action_taken_employer_level'] ?? null }}</textarea>
                </div>
                <div class="mt-3">
                    <label class="form-label">Action Taken at the MWO Level (Aksyon ng ginawa ng MWO)</label>
                    <textarea name="sena_action_taken_mwo" id="sena_action_taken_mwo" class="form-control" rows="2" >{{ $entries['sena_action_taken_mwo'] ?? null }}</textarea>
                </div>
            </div>

            <!-- merged first 3 sections -> agency section starts after this -->
            <div class="sena-section">
                <h5>Name of Philippine Recruitment Agency (Pangalan ng Agency sa Pilipinas)</h5>

                <div class="mb-3">
                    <label class="form-label mb-1">Agency Name</label>
                    <input type="text" name="sena_ph_agency_name" id="sena_ph_agency_name" class="form-control" placeholder="Agency Name" value="{{ $entries['sena_ph_agency_name'] ?? null }}" >
                </div>
                <div class="mb-3">
                    <label class="form-label mb-1">Agency Address</label>
                    <input type="text" name="sena_ph_agency_address" id="sena_ph_agency_address" class="form-control" placeholder="Address (Opisina)" value="{{ $entries['sena_ph_agency_address'] ?? null }}" >
                </div>

                <div class="row g-3 mb-3">

                    <div class="col-md-4">
                        <label class="form-label mb-1">Contact Person Name</label>
                        <input type="text" name="sena_ph_contact_person_name" id="sena_ph_contact_person_name" class="form-control" placeholder="Contact Person (Taong Kakauapin)" value="{{ $entries['sena_ph_contact_person_name'] ?? null }}" >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1">Contact Person Position</label>
                        <input type="text" name="sena_ph_contact_person_position" id="sena_ph_contact_person_position" class="form-control" placeholder="ex. Manager" value="{{ $entries['sena_ph_contact_person_position'] ?? null }}" >
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1"><span class="d-none d-lg-inline">Telephone / </span>Cellphone<span class="d-none d-lg-inline">/ Fax </span> / Email Address</label>
                        <input type="text" name="sena_ph_contact_info" id="sena_ph_contact_info" class="form-control" placeholder="ex. sample@email.com / 09123456789 / (045) 123-4567" value="{{ $entries['sena_ph_contact_info'] ?? null }}" >
                    </div>
                </div>

                
            </div>

            <div class="sena-section">
                <h5>Name of Principal (Foreign Placement of Agency or Foreign Service Contractor or Employer)</h5>

                <div class="mb-3">
                    <label class="form-label mb-1">Foreign Agency Name / Employer Name</label>
                    <input type="text" name="sena_foreign_agency_name_employer_name" id="sena_foreign_agency_name_employer_name" class="form-control" placeholder="Agency Name" value="{{ $entries['sena_foreign_agency_name_employer_name'] ?? null }}" >
                </div>
                <div class="mb-3">
                    <label class="form-label mb-1">Foreign Agency Address</label>
                    <input type="text" name="sena_foreign_agency_address" id="sena_foreign_agency_address" class="form-control" placeholder="Address (Opisina)" value="{{ $entries['sena_foreign_agency_address'] ?? null }}" >
                </div>

                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label mb-1">Contact Person Name</label>
                        <input type="text" name="sena_foreign_contact_person_name" id="sena_foreign_contact_person_name" class="form-control" placeholder="Contact Person (Taong Kakauapin)" value="{{ $entries['sena_foreign_contact_person_name'] ?? null  }}" >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1">Contact Person Position</label>
                        <input type="text" name="sena_foreign_contact_person_position" id="sena_foreign_contact_person_position" class="form-control" placeholder="ex. Manager" value="{{ $entries['sena_foreign_contact_person_position'] ?? null }}" >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1"><span class="d-none d-lg-inline">Telephone / </span>Cellphone<span class="d-none d-lg-inline">/ Fax </span> / Email Address</label>
                        <input type="text" name="sena_foreign_contact_info" id="sena_foreign_contact_info" class="form-control" placeholder="ex. sample@email.com / 09123456789 / (045) 123-4567" value="{{ $entries['sena_foreign_contact_info'] ?? null }}" >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1">Nature of Business</label>
                        <input type="text" name="sena_nature_of_business" id="sena_nature_of_business" class="form-control" placeholder="Nature of Business" value="{{ $entries['sena_nature_of_business'] ?? null }}" >
                    </div>

                </div>

                <div class="mt-4">
                    <h6 class="fw-bold">COMPLAINTS FILED AT OTHER OFFICE/AGENCY (Reklamo na dinala sa ibang opisina)</h6>
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Date</label>
                            <input type="date" name="sena_complaints_other_office_date" id="sena_complaints_other_office_date" class="form-control" value="{{ $entries['sena_complaints_other_office_date'] ?? null }}" >
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Office</label>
                            <input type="text" name="sena_complaints_other_office_name" id="sena_complaints_other_office_name" class="form-control" placeholder="Office" value="{{ $entries['sena_complaints_other_office_name'] ?? null }}" >
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Nature of Case</label>
                            <input type="text" name="sena_complaints_other_office_case" id="sena_complaints_other_office_case" class="form-control" placeholder="Nature of Case" value="{{ $entries['sena_complaints_other_office_case'] ?? null }}" >
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
                            <input class="form-check-input" type="checkbox" name="sena_non_payment" value="checked" id="sena_non_payment"
                                {{ ($entries['sena_non_payment'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="non_payment">Non-payment/underpayment</label>
                        </div>
                        <div class="ms-4" id="sena_non_payment_sub">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sena_salary" value="checked" id="sena_salary" disabled
                                    {{ ($entries['sena_salary'] ?? '') == 'checked' ? 'checked' : ''}}>
                                <label class="form-check-label" for="sena_salary">Salary</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sena_overtime" value="checked" id="sena_overtime" disabled
                                    {{ ($entries['sena_overtime'] ?? '') == 'checked' ? 'checked' : ''}}>
                                <label class="form-check-label" for="sena_overtime">Overtime Pay</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sena_rest_day" value="checked" id="sena_rest_day" disabled
                                    {{ ($entries['sena_rest_day'] ?? '') == 'checked' ? 'checked' : ''}}>
                                <label class="form-check-label" for="rest_day">Rest Day/Day-off</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sena_sick_leave" value="checked" id="sena_sick_leave" disabled
                                    {{ ($entries['sena_sick_leave'] ?? '') == 'checked' ? 'checked' : ''}}>
                                <label class="form-check-label" for="sena_sick_leave">Sick Leave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sena_vacation_leave" value="checked" id="sena_vacation_leave" disabled
                                    {{ ($entries['sena_vacation_leave'] ?? '') == 'checked' ? 'checked' : ''}}>
                                <label class="form-check-label" for="sena_vacation_leave">Vacation Leave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sena_holiday_pay" value="checked" id="sena_holiday_pay" disabled
                                    {{ ($entries['sena_holiday_pay'] ?? '') == 'checked' ? 'checked' : ''}}>
                                <label class="form-check-label" for="sena_holiday_pay">Holiday Pay</label>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="sena_illegal_deduct" value="checked" id="sena_illegal_deduct"
                                {{ ($entries['sena_illegal_deduct'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_illegal_deduct">Illegal Deductions</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_non_provision_transport" value="checked" id="sena_non_provision_transport"
                                {{ ($entries['sena_non_provision_transport'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_non_provision_transport">Non-provision of transport</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_non_provision_food" value="checked" id="sena_non_provision_food"
                                {{ ($entries['sena_non_provision_food'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_non_provision_food">Non-provision of food accommodation or its monetary equivalent</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_others_contract_violations" value="checked" id="sena_others_contract_violations"
                                {{ ($entries['sena_others_contract_violations'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_others_contract_violations">Others, please specify</label>
                        </div>
                        <input type="text" name="others_specify_sena" id="sena_others_contract_violations_specify" class="form-control" style="margin-top: 0.5rem;"
                            value="{{ $entries['sena_others_contract_violations_specify'] ?? '' }}">

                        <h6 class="mt-3">2.) Other Money Claims</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_end_service_benefits" value="checked" id="sena_end_service_benefits"
                                {{ ($entries['sena_end_service_benefits'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_end_service_benefits">Claim for end service benefits</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_airfare" value="checked" id="sena_airfare"
                                {{ ($entries['sena_airfare'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_airfare">Refund of airfare/transportation/repatriation ticket</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_unexpired_contract" value="checked" id="sena_unexpired_contract"
                                {{ ($entries['sena_unexpired_contract'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_unexpired_contract">Payment of unexpired portion of contract</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_illegal_fees" value="checked" id="sena_illegal_fees"
                                {{ ($entries['sena_illegal_fees'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_illegal_fees">Excessive/illegally collected fees</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_disability_benefits" value="checked" id="disability_benefits"
                                {{ ($entries['sena_disability_benefits'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_disability_benefits">Payment of disability benefits</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>3.) Delayed in Payment/Time of Payment (specify)</h6>
                        <textarea name="sena_delayed_in_payment" id="sena_delayed_in_payment" class="form-control" rows="3">{{ $entries['sena_delayed_in_payment'] ?? ''}}</textarea>

                        <h6 class="mt-3">4.) Non-Monetary issues</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_holding_of_passport" value="checked" id="sena_holding_of_passport"
                                {{ ($entries['sena_holding_of_passport'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="holding_of_passport">Withholding of original passport/travel documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_holding_of_documents" value="checked" id="sena_holding_of_documents"
                                {{ ($entries['sena_holding_of_documents'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="holding_of_documents">Withholding of other documents (specify)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_transfer_company" value="checked" id="sena_transfer_company"
                                {{ ($entries['sena_transfer_company'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="transfer_company">Transfer to other company/employer</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="sena_illegal_contract_termination" value="checked" id="sena_illegal_contract_termination"
                                {{ ($entries['sena_illegal_contract_termination'] ?? '') == 'checked' ? 'checked' : ''}}>
                            <label class="form-check-label" for="sena_illegal_contract_termination">Illegal termination of contract</label>
                        </div>

                        <h6 class="mt-3">5.) Other Issues (specify)</h6>
                        <textarea name="sena_other_issues" id="sena_other_issues" class="form-control" rows="3">{{ $entries['sena_other_issues'] ?? ''}}</textarea>
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
        document.addEventListener('DOMContentLoaded', function() {

            const natureRadios = document.querySelectorAll('input[name="sena_nature_of_work"]');
            const natureOther = document.getElementById('other_professional');
            const natureOtherText = document.getElementById('sena_nature_of_work_other_specify');

            function toggleOther() {
                if (natureOther.checked) {
                    natureOtherText.disabled = false;
                } else {
                    natureOtherText.disabled = true;
                    natureOtherText.value = '';
                }
            }

            natureRadios.forEach(radio => {
                radio.addEventListener('change', toggleOther);
            });

            toggleOther();

            const nonPayment = document.getElementById('sena_non_payment');
            const nonPaymentSubs = document.querySelectorAll('#sena_non_payment_sub input[type="checkbox"]');

            function toggleNonPaymentSubs() {
                nonPaymentSubs.forEach(cb => {
                    cb.disabled = !nonPayment.checked;
                    if (!nonPayment.checked) cb.checked = false;
                });
            }

            nonPayment.addEventListener('change', toggleNonPaymentSubs);

            toggleNonPaymentSubs();

            const successMsg = "{{ session('success') }}";
            const errorMsg   = "{{ session('error') }}";
            if (successMsg) showToast(successMsg, 'success');
            else if (errorMsg) showToast(errorMsg, 'danger');


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
                .catch((err) => {
                    console.error(err);
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
            // if (!trim('aksyon_ofw_age'))  errors.push('Age is required.');
            if (!trim('sena_deployment_status'))  errors.push('Deployment Status is required.');
            if (!trim('sena_ofw_age'))   errors.push('Age is required.');
            if (!trim('sena_jobsite')) errors.push('Jobsite / Bansang Pinagtatrabahuhan is required.');
            if (!trim('sena_job_position')) errors.push('Job Position is required.');
            if (!trim('sena_monthly_salary'))  errors.push('Monthly Salary is required.');
            if (!trim('sena_contract_start'))  errors.push('Contract Duration (Start) is required.');
            if (!trim('sena_contract_end'))  errors.push('Contract Duration (End) is required.');
            if (!trim('sena_length_contract_served'))  errors.push('Length of Contract Served is required.');
            

            // ── Section D: Brief Description ──────────────────────────────────
            // const returnReason = (document.querySelector('[name="aksyon_return_reason_others_specify"]')?.value ?? '').trim();
            // if(returnReason.value === 'Others / Iba pang Kadahilanan ng Pagbalik is required.'){
            //     if (!returnReason) errors.push('Others / Iba pang Kadahilanan ng Pagbalik is required.');
            // }
            

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
    </script>
@endsection
