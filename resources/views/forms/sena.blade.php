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

        <form method="POST" action="{{ url('/forms/step/' . $step) }}">
            @csrf

            <div class="sena-section">
                <h5>Name of OFW (Pangalan)</h5>
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
                        <input type="text" name="address" class="form-control disabled" value="{{ session('general_form_data.ofw_address_street') }}">
                    </div>

                    <div class="row mt-2">
                        <div class="col-6 col-md-3">
                            <label class="form-label">Province</label>
                            <input type="text" class="form-control disabled" name="ofw_province_name" id="ofw_province" value="{{ session('general_form_data.ofw_province_name') }}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">City/Municipality</label>
                            <input type="text" class="form-control disabled" name="ofw_municipality_name" id="ofw_municipality" value="{{ session('general_form_data.ofw_municipality_name') }}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Barangay</label>
                            <input type="text" class="form-control disabled" name="ofw_barangay" id="ofw_barangay" value="{{ session('general_form_data.ofw_barangay_name') }}">
                        </div>
                        <div class="col-6 col-md-3">
                            <label class="form-label">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control disabled" value="{{ session('general_form_data.ofw_zip_code') }}">
                        </div>
                    </div>

                    <div class="row g-3 mt-2">
                        <div class="col-md-6">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="ofw_phone" class="form-control disabled" placeholder="ex. 09123456768" value="{{ session('general_form_data.ofw_phone') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="ofw_email" class="form-control disabled" placeholder="ex. sample@email.com" value="{{ session('general_form_data.ofw_email') }}">
                        </div>
                    </div>
                </div>

                <div class="row g-3 mt-2 align-items-end">
    
                    <!-- Deployment Status -->
                    <div class="col-6 col-md-4">
                        <label class="form-label">Deployment Status</label>
                        <select class="form-select" name="ofw_deployment_status_deployed_mwpd_protection">
                            <option selected disabled {{ !session('forms.data.sena.ofw_deployment_status_deployed_mwpd_protection') ? 'selected' : '' }}>Select status</option>
                            <option value="deployed" {{ session('forms.data.sena.ofw_deployment_status_deployed_mwpd_protection') === 'deployed' ? 'selected' : '' }}>Deployed</option>
                            <option value="not_deployed" {{ session('forms.data.sena.ofw_deployment_status_deployed_mwpd_protection') === 'not_deployed' ? 'selected' : '' }}>Not Deployed</option>
                        </select>
                    </div>

                    <!-- Gender -->
                    <div class="col-6 col-md-4">
                        <label class="form-label">Gender</label>
                        <input type="text" name="gender" class="form-control disabled" value="{{ session('general_form_data.ofw_gender') }}">
                    </div>

                    <!-- Age -->
                    <div class="col-12 col-md-4">
                        <label class="form-label">Age</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            name="ofw_age_mwpd_protection" 
                            placeholder="ex. 20" 
                            value="{{ session('forms.data.sena.ofw_age_mwpd_protection') }}" 
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
                            <input class="form-check-input" type="radio" name="household_professional_mwpd_protection" id="household_professional_mwpd_protection" value="checked" {{ session('forms.data.sena.household_professional_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Household Service</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="seaferer_sena_mwpd_protection" id="seaferer_sena_mwpd_protection" value="checked" {{ session('forms.data.sena.seaferer_sena_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Seafarer</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="medical_professional_mwpd_protection" id="medical_professional_mwpd_protection" value="checked" {{ session('forms.data.sena.medical_professional_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Medical Professional</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="offshore_worker_mwpd_protection" id="offshore_worker_mwpd_protection" value="checked" {{ session('forms.data.sena.offshore_worker_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Offshore Worker</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="engineering_professional_mwpd_protection" id="engineering_professional_mwpd_protection" value="checked" {{ session('forms.data.sena.engineering_professional_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Engineering Professional</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="construcion_laborer_mwpd_protection" id="construcion_laborer_mwpd_protection" value="checked" {{ session('forms.data.sena.construcion_laborer_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Construction Laborer</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="caregiver_mwpd_protection" id="caregiver_mwpd_protection" value="checked" {{ session('forms.data.sena.caregiver_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Caregiver</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="plumber_mwpd_protection" id="plumber_mwpd_protection" value="checked" {{ session('forms.data.sena.plumber_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Plumber/Fitter</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="manufacturing_laborer_mwpd_protection" id="manufacturing_laborer_mwpd_protection" value="checked" {{ session('forms.data.sena.manufacturing_laborer_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Manufacturing Laborer</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="welder_mwpd_protection" id="welder_mwpd_protection" value="checked" {{ session('forms.data.sena.welder_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Welder/Cutter</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="hotel_staff_mwpd_protection" id="hotel_staff_mwpd_protection" value="checked" {{ session('forms.data.sena.hotel_staff_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Hotel Staff</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="cleaner_mwpd_protection" id="cleaner_mwpd_protection" value="checked" {{ session('forms.data.sena.cleaner_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Cleaner/Helper</span>
                        </label>

                        <label class="form-check">
                            <input class="form-check-input" type="radio" name="entertainer_mwpd_protection" id="entertainer_mwpd_protection" value="checked" {{ session('forms.data.sena.entertainer_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label">Entertainer</span>
                        </label>
                        <label class="form-check">
                            <input class="form-check-input" type="radio" id="other_professional_mwpd_protection" name="other_professional_mwpd_protection" value="checked" {{ session('forms.data.sena.other_professional_mwpd_protection') == 'checked' ? 'checked' : '' }}>
                            <span class="form-check-label"><strong>Others, specify:</strong></span>
                        </label>
                        
                    </div>
                    <div style="grid-column: 2 / span 1; margin-top: 0.3rem;">
                        <input type="text" name="other_professional_specify_mwpd_protection" class="form-control" placeholder="Specify other nature of work" id="other_professional_specify_mwpd_protection" disabled value="{{ session('forms.data.sena.ofw_nature_of_work_mwpd_protection') == 'Others' ? session('forms.data.sena.other_professional_specify_mwpd_protection') : '' }}">
                    </div>
                </div>
                

                <hr style="border-color: #b7cbef; margin: 1.5rem 0;" />

                <h5>Deployment Details</h5>

                <div class="row g-3 mb-3">
                    <div class="col-12 col-md-4">
                        <label class="form-label"><span class="d-none d-lg-inline">Jobsite/</span>Country of Deployment</label>
                        <input type="text" name="ofw_country_name" class="form-control disabled" value="{{ session('general_form_data.ofw_country_name') }}">
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="form-label">Position</label>
                        <input type="text" name="position" class="form-control disabled" placeholder="ex. Driver" value="{{ session('general_form_data.ofw_job') }}">
                    </div>

                    <div class="col-6 col-md-4">
                        <label class="form-label">Monthly Salary <span class="fst-italic">(PHP)</span></label>
                        <input type="text" name="monthly_salary_mwpd_protection" id="monthly_salary_mwpd_protection" class="form-control" placeholder="ex. 40,000">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-12 col-md-5">
                        <label class="form-label">Contract Duration</label>
                        <div class="row g-2">
                            <div class="col-6"><input type="date" name="contract_start_mwpd_protection" id="contract_start_mwpd_protection" class="form-control"></div>
                            <div class="col-6"><input type="date" name="contract_end_mwpd_protection" id="contract_end_mwpd_protection" class="form-control"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                        <label class="form-label">Length of Contract Served</label>
                        <input type="text" name="length_contract_mwpd_protection" id="length_contract_mwpd_protection" class="form-control" placeholder="ex. 18 months">
                    </div>
                </div>

                <div class="mt-3">
                    <label class="form-label">Action Taken at the Employer Level (Aksyon ng Employer)</label>
                    <textarea name="action_employer_level_mwpd_protection" id="action_employer_level_mwpd_protection" class="form-control" rows="2"></textarea>
                </div>
                <div class="mt-3">
                    <label class="form-label">Action Taken at the MWO Level (Aksyon ng ginawa ng MWO)</label>
                    <textarea name="action_mwo_level_mwpd_protection" id="action_mwo_level_mwpd_protection" class="form-control" rows="2"></textarea>
                </div>
            </div>

            <!-- merged first 3 sections -> agency section starts after this -->
            <div class="sena-section">
                <h5>Name of Philippine Recruitment Agency (Pangalan ng Agency sa Pilipinas)</h5>

                <div class="mb-3">
                    <label class="form-label mb-1">Agency Name</label>
                    <input type="text" name="ph_agency_name_mwpd_protection" id="ph_agency_name_mwpd_protection" class="form-control" placeholder="Agency Name">
                </div>
                <div class="mb-3">
                    <label class="form-label mb-1">Agency Address</label>
                    <input type="text" name="ph_agency_address_mwpd_protection" id="ph_agency_address_mwpd_protection" class="form-control" placeholder="Address (Opisina)">
                </div>

                <div class="row g-3 mb-3">

                    <div class="col-md-4">
                        <label class="form-label mb-1">Contact Person Name</label>
                        <input type="text" name="ph_contact_name_mwpd_protection" id="ph_contact_name_mwpd_protection" class="form-control" placeholder="Contact Person (Taong Kakauapin)">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1">Contact Person Position</label>
                        <input type="text" name="ph_contact_position_mwpd_protection" id="ph_contact_position_mwpd_protection" class="form-control" placeholder="ex. Manager">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label mb-1"><span class="d-none d-lg-inline">Telephone / </span>Cellphone<span class="d-none d-lg-inline">/ Fax </span> / Email Address</label>
                        <input type="text" name="ph_contact_details_mwpd_protection" id="ph_contact_details_mwpd_protection" class="form-control" placeholder="ex. sample@email.com / 09123456789 / (045) 123-4567">
                    </div>
                </div>

                
            </div>

            <div class="sena-section">
                <h5>Name of Principal (Foreign Placement of Agency or Foreign Service Contractor or Employer)</h5>

                <div class="mb-3">
                    <label class="form-label mb-1">Foreign Agency Name / Employer Name</label>
                    <input type="text" name="foreign_agency_name_mwpd_protection" id="foreign_agency_name_mwpd_protection" class="form-control" placeholder="Agency Name">
                </div>
                <div class="mb-3">
                    <label class="form-label mb-1">Foreign Agency Address</label>
                    <input type="text" name="foreign_agency_address_mwpd_protection" id="foreign_agency_address_mwpd_protection" class="form-control" placeholder="Address (Opisina)">
                </div>

                <div class="row g-3 mb-3">

                    <div class="col-md-6">
                        <label class="form-label mb-1">Contact Person Name</label>
                        <input type="text" name="foreign_contact_name_mwpd_protection" id="foreign_contact_name_mwpd_protection" class="form-control" placeholder="Contact Person (Taong Kakauapin)">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1">Contact Person Position</label>
                        <input type="text" name="foreign_contact_position_mwpd_protection" id="foreign_contact_position_mwpd_protection" class="form-control" placeholder="ex. Manager">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1"><span class="d-none d-lg-inline">Telephone / </span>Cellphone<span class="d-none d-lg-inline">/ Fax </span> / Email Address</label>
                        <input type="text" name="foreign_contact_details_mwpd_protection" id="foreign_contact_details_mwpd_protection" class="form-control" placeholder="ex. sample@email.com / 09123456789 / (045) 123-4567">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label mb-1">Nature of Business</label>
                        <input type="text" name="nature_of_business_mwpd_protection" id="nature_of_business_mwpd_protection" class="form-control" placeholder="Nature of Business">
                    </div>

                </div>

                <div class="mt-4">
                    <h6 class="fw-bold">COMPLAINTS FILED AT OTHER OFFICE/AGENCY (Reklamo na dinala sa ibang opisina)</h6>
                    <div class="row g-3 align-items-end">
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Date</label>
                            <input type="date" name="complaints_at_other_office_date_mwpd_protection" id="complaints_at_other_office_date_mwpd_protection" class="form-control">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Office</label>
                            <input type="text" name="complaints_at_other_office_name_mwpd_protection" id="complaints_at_other_office_name_mwpd_protection" class="form-control" placeholder="Office">
                        </div>
                        <div class="col-sm-4">
                            <label class="form-label mb-1">Nature of Case</label>
                            <input type="text" name="complaints_at_other_office_case__mwpd_protection" id="complaints_at_other_office_case__mwpd_protection" class="form-control" placeholder="Nature of Case">
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
                            <input class="form-check-input" type="checkbox" name="non_payment_mwpd_protection" value="non_payment" id="non_payment_mwpd_protection">
                            <label class="form-check-label" for="non_payment_mwpd_protection">Non-payment/underpayment</label>
                        </div>
                        <div class="ms-4" id="non_payment_sub">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="salary_mwpd_protection" value="salary" id="salary_mwpd_protection" disabled>
                                <label class="form-check-label" for="salary_mwpd_protection">Salary</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="overtime_mwpd_protection" value="overtime" id="overtime_mwpd_protection" disabled>
                                <label class="form-check-label" for="overtime_mwpd_protection">Overtime Pay</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="rest_day_mwpd_protection" value="rest_day" id="rest_day_mwpd_protection" disabled>
                                <label class="form-check-label" for="rest_day_mwpd_protection">Rest Day/Day-off</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sick_leave_mwpd_protection" value="sick_leave" id="sick_leave_mwpd_protection" disabled>
                                <label class="form-check-label" for="sick_leave_mwpd_protection">Sick Leave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="vacation_leave_mwpd_protection" value="vacation_leave" id="vacation_leave_mwpd_protection" disabled>
                                <label class="form-check-label" for="vacation_leave_mwpd_protection">Vacation Leave</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="holiday_pay_mwpd_protection" value="holiday_pay" id="holiday_pay_mwpd_protection" disabled>
                                <label class="form-check-label" for="holiday_pay_mwpd_protection">Holiday Pay</label>
                            </div>
                        </div>
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" name="illegal_deduct_mwpd_protection" value="illegal_deductions" id="illegal_deduct_mwpd_protection">
                            <label class="form-check-label" for="illegal_deduct_mwpd_protection">Illegal Deductions</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="non_provision_transport_mwpd_protection" value="non_provision_transport" id="non_provision_transport_mwpd_protection">
                            <label class="form-check-label" for="non_provision_transport_mwpd_protection">Non-provision of transport</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="non_provision_food_mwpd_protection" value="non_provision_food" id="non_provision_food_mwpd_protection">
                            <label class="form-check-label" for="non_provision_food_mwpd_protection">Non-provision of food accommodation or its monetary equivalent</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="others_sena_mwpd_protection" value="others" id="others_sena_mwpd_protection">
                            <label class="form-check-label" for="others_sena_mwpd_protection">Others, please specify</label>
                        </div>
                        <input type="text" name="others_specify_sena_mwpd_protection" id="others_specify_sena_mwpd_protection" class="form-control" style="margin-top: 0.5rem;">

                        <h6 class="mt-3">2.) Other Money Claims</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="end_service_benefits_mwpd_protection" value="end_service_benefits" id="end_service_benefits_mwpd_protection">
                            <label class="form-check-label" for="end_service_benefits_mwpd_protection">Claim for end service benefits</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="airfare_mwpd_protection" value="refund_airfare" id="airfare_mwpd_protection">
                            <label class="form-check-label" for="airfare_mwpd_protection">Refund of airfare/transportation/repatriation ticket</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="unexpired_contract_mwpd_protection" value="unexpired_contract" id="unexpired_contract_mwpd_protection">
                            <label class="form-check-label" for="unexpired_contract_mwpd_protection">Payment of unexpired portion of contract</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="illegal_fees_mwpd_protection" value="illegal_fees" id="illegal_fees_mwpd_protection">
                            <label class="form-check-label" for="illegal_fees_mwpd_protection">Excessive/illegally collected fees</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="disability_benefits_mwpd_protection" value="disability_benefits" id="disability_benefits_mwpd_protection">
                            <label class="form-check-label" for="disability_benefits_mwpd_protection">Payment of disability benefits</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6>3.) Delayed in Payment/Time of Payment (specify)</h6>
                        <textarea name="delayed_in_payment_mwpd_protection" id="delayed_in_payment_mwpd_protection" class="form-control" rows="3"></textarea>

                        <h6 class="mt-3">4.) Non-Monetary issues</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="holding_of_passport_mwpd_protection" value="withholding_passport" id="holding_of_passport_mwpd_protection">
                            <label class="form-check-label" for="holding_of_passport_mwpd_protection">Withholding of original passport/travel documents</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="holding_of_documents_mwpd_protection" value="withholding_documents" id="holding_of_documents_mwpd_protection">
                            <label class="form-check-label" for="holding_of_documents_mwpd_protection">Withholding of other documents (specify)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="trasfer_company_mwpd_protection" value="transfer_company" id="trasfer_company_mwpd_protection">
                            <label class="form-check-label" for="trasfer_company_mwpd_protection">Transfer to other company/employer</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="illegal_contract_termination_mwpd_protection" value="illegal_termination" id="illegal_contract_termination_mwpd_protection">
                            <label class="form-check-label" for="illegal_contract_termination_mwpd_protection">Illegal termination of contract</label>
                        </div>

                        <h6 class="mt-3">5.) Other Issues (specify)</h6>
                        <textarea name="other_issues_sena_mwpd_protection" id="other_issues_sena_mwpd_protection" class="form-control" rows="3"></textarea>
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
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

        const natureRadios = document.querySelectorAll('input[name="ofw_nature_of_work_mwpd_protection"]');
        const natureOther = document.getElementById('other_professional_mwpd_protection');
        const natureOtherText = document.getElementById('other_professional_specify_mwpd_protection');

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

        const nonPayment = document.getElementById('non_payment_mwpd_protection');
        const nonPaymentSubs = document.querySelectorAll('#non_payment_sub input[type="checkbox"]');

        function toggleNonPaymentSubs() {
            nonPaymentSubs.forEach(cb => {
                cb.disabled = !nonPayment.checked;
                if (!nonPayment.checked) cb.checked = false;
            });
        }

        nonPayment.addEventListener('change', toggleNonPaymentSubs);

        toggleNonPaymentSubs();
    });
    </script>
@endsection
