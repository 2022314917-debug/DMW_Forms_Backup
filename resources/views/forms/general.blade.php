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

    .btn-confirm{
      background-color: #2F5BB7;
      color: #fff;
    }

   
 
  </style>
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
 
  <div class="container my-5">
    
    <form action="{{ route('forms.general.store') }}" method="POST">
      @csrf
      <!-- Header -->
      <div class="form-header text-center">
        <h4 class="fw-bold">ONLINE REQUEST FOR ASSISTANCE</h4>
        <p>
          Gamitin ang form na ito para humingi ng tulong. Siguraduhing tama at kumpleto ang lahat ng impormasyon ilalagay upang maproseso agad ng aming team ang inyong request.
        </p>
        <small>
          Regional Office Contact Details: (045) 963-4394 | (045) 455-0832 | pampanga@dmw.gov.ph | www.ro3.dmw.gov.ph
        </small>
      </div>

      <!-- Display Success Message -->
      @if($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Display Error Messages -->
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

      <!-- Section A -->
      
      <div class="form-section">
        <h5>A. IMPORMASYON NG OFW</h5>
          <div class="row g-3 mb-3">
            <div class="col-md-3">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control uppercase" name="ofw_lname" placeholder="Dela Cruz" value="{{ old('ofw_lname') }}" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control uppercase" name="ofw_fname" placeholder="Juan" value="{{ old('ofw_fname') }}" required>
            </div>
            <div class="col-md-2">
              <label class="form-label">Name Ext.</label>
              <input type="text" class="form-control uppercase" name="ofw_ename" placeholder="Jr/Sr/III" value="{{ old('ofw_ename') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control uppercase" name="ofw_mname" placeholder="Santos" value="{{ old('ofw_mname') }}">
            </div>
          </div>

          <div class="row g-3 mb-3">

            <div class="col-12 col-md-4">
              <label class="form-label">Passport No.</label>
              <input type="text" class="form-control uppercase" name="ofw_passport_no" placeholder="ex. 123456789" value="{{ old('ofw_passport_no') }}" required>
            </div>

            <div class="col-6 col-md-4">
              <label class="form-label">Sex</label>
              <select class="form-select" name="ofw_gender" required>
                <option selected disabled>Select</option>
                <option value="Male" {{ old('ofw_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('ofw_gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <div class="col-6 col-md-4">
                <label class="form-label">Civil Status</label>
                <select class="form-select" name="ofw_civil_status" required>
                    <option selected {{ old('ofw_civil_status') == 'Select' ? 'selected' : '' }} disabled>Select</option>
                    <option value="Single" {{ old('ofw_civil_status') == 'Single' ? 'selected' : '' }}>Single</option>
                    <option value="Married" {{ old('ofw_civil_status') == 'Married' ? 'selected' : '' }}>Married</option>
                    <option value="Widowed" {{ old('ofw_civil_status') == 'Widowed' ? 'selected' : '' }}>Widowed</option>
                </select>
            </div>

          </div>

          <div class="row g-3 mb-3">

            <div class="col-12 col-md-4">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="ofw_email" placeholder="ex. sample@email.com" value="{{ old('ofw_email') }}" required>
            </div>

            <div class="col-6 col-md-4">
              <label class="form-label">Contact Number</label>
              <input type="text" class="form-control" name="ofw_phone" placeholder="ex. 09123456768" value="{{ old('ofw_phone') }}" required>
            </div>
              
            <div class="col-6 col-md-4">
              <label class="form-label">Date of Birth</label>
              <input type="date" class="form-control" name="ofw_bday" value="{{ old('ofw_bday') }}" required>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-12 col-md-3">
              <label class="form-label">Agency</label>
              <input type="text" class="form-control uppercase" name="ofw_agency" placeholder="ex. Agency Name" value="{{ old('ofw_agency') }}" required>
            </div>
            <div class="col-12 col-md-3">
              <label class="form-label">Employer</label>
              <input type="text" class="form-control uppercase" name="ofw_employer" placeholder="ex. Employer/Company Name" value="{{ old('ofw_employer') }}" required>
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">Bansa</label>
              <select class="form-select" name="ofw_country" id="ofw_country" required>
                <option selected disabled>Select</option>
              </select>
              <input type="hidden" name="ofw_country_name" id="ofw_country_name">
            </div>
            <div class="col-6 col-md-3">
              <label class="form-label">Trabaho</label>
              <input type="text" class="form-control uppercase" name="ofw_job" placeholder="ex. Driver" value="{{ old('ofw_job') }}" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Address in the Philippines</label>
            <input type="text" class="form-control mb-2 uppercase" name="ofw_house_no" placeholder="Unit/Room/House Number/Street name" value="{{ old('ofw_house_no') }}" required>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <select class="form-select" name="ofw_province" id="ofw_province" required>
                  <option value="">Province</option>
                </select>
                <input type="hidden" name="ofw_province_name" id="ofw_province_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="ofw_municipality" id="ofw_municipality" disabled required>
                  <option value="">City / Municipality</option>
                </select>
                <input type="hidden" name="ofw_municipality_name" id="ofw_municipality_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="ofw_barangay" id="ofw_barangay" disabled required>
                  <option value="">Barangay</option>
                </select>
                <input type="hidden" name="ofw_barangay_name" id="ofw_barangay_name" value="{{ old('ofw_barangay_name') }}">
              </div>
              <div class="col-6 col-md-3">
                <input 
                    type="text" 
                    class="form-control" 
                    name="ofw_zip_code" 
                    placeholder="ex. 2016" 
                    value="{{ old('ofw_zip_code') }}" 
                    maxlength="4"          
                    pattern="\d{4}"         
                    inputmode="numeric"     
                    oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);" 
                    required
                >
              </div>
            </div>
          </div>
      </div>
      <div class="form-section">
        <h5>B. IMPORMASYON NG HUMIHILING (Kung hindi OFW ang humihiling)</h5>

          <div class="row g-3 mb-3">
            <div class="col-md-3">
              <label class="form-label">Last Name</label>
              <!-- <input type="text" class="form-control uppercase" name="party_lname" placeholder="Dela Cruz" value="{{ old('party_lname') }}" required> -->
              <input type="text" class="form-control uppercase" name="party_lname" placeholder="Dela Cruz" value="{{ old('party_lname') }}" required>
            </div>
            <div class="col-md-3">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control uppercase" name="party_fname" placeholder="Juan" value="{{ old('party_fname') }}" required>
            </div>
            <div class="col-md-2">
              <label class="form-label">Name Ext.</label>
              <input type="text" class="form-control uppercase" name="party_ename" placeholder="Jr/Sr/III" value="{{ old('party_ename') }}">
            </div>
            <div class="col-md-4">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control uppercase" name="party_mname" placeholder="Santos" value="{{ old('party_mname') }}">
            </div>
          </div>

          <div class="row g-3 mb-3">

            <div class="col-6 col-md-3">
              <label class="form-label">Birthday</label>
              <input type="date" class="form-control" name="party_bday" value="{{ old('party_bday') }}" required>
            </div>

            <div class="col-6 col-md-3">
              <label class="form-label">Sex</label>
              <select class="form-select" name="party_gender" required>
                <option selected disabled>Select</option>
                <option value="Male" {{ old('party_gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('party_gender') == 'Female' ? 'selected' : '' }}>Female</option>
              </select>
            </div>

            <div class="col-md-6">
              <label class="form-label">Relationship to OFW</label>
              <input type="text" class="form-control uppercase" name="party_relationship" placeholder="ex. Brother" value="{{ old('party_relationship') }}" required>
            </div>

          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label">Contact Number</label>
              <input type="text" class="form-control" name="party_phone" placeholder="ex. 09123456768" value="{{ old('party_phone') }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-control" name="party_email" placeholder="ex. sample@email.com" value="{{ old('party_email') }}" required>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Address in the Philippines</label>
            <input type="text" class="form-control mb-2 uppercase" name="party_house_no" placeholder="Unit/Room/House Number/Street name" value="{{ old('party_house_no') }}" required>
            <div class="row g-3">
              <div class="col-6 col-md-3">
                <select class="form-select" name="party_province" id="party_province" required>
                  <option value="">Province</option>
                </select>
                <input type="hidden" name="party_province_name" id="party_province_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="party_municipality" id="party_municipality" disabled required>
                  <option value="">City / Municipality</option>
                </select>
                <input type="hidden" name="party_municipality_name" id="party_municipality_name">
              </div>
              <div class="col-6 col-md-3">
                <select class="form-select" name="party_barangay" id="party_barangay" disabled required>
                  <option value="">Barangay</option>
                </select>
                <input type="hidden" name="party_barangay_name" id="party_barangay_name" value="{{ old('party_barangay_name') }}">
              </div>
              <div class="col-6 col-md-3">
                <input 
                    type="text" 
                    class="form-control" 
                    name="party_zip_code" 
                    placeholder="ex. 2016" 
                    value="{{ old('party_zip_code') }}" 
                    maxlength="4"          
                    pattern="\d{4}"         
                    inputmode="numeric"     
                    oninput="this.value = this.value.replace(/[^0-9]/g,'').slice(0,4);" 
                    required
                >
              </div>
            </div>
          </div>
      </div>
      <div class="form-section">
         <div class="mb-3">
              <h5>C. PALIWANAG NG HILING (Nature of Request)</h5>
                <p class="mb-3">Ilahad dito ang maikling paliwanag kung anong uri ng tulong ang inyong hinihingi, kasama ang mahahalagang detalye tulad ng dahilan, kailan at saan ito kinakailangan.</p>
                <textarea class="form-control" rows="7" placeholder="Text here..." name="nature_of_request" required></textarea>
          </div>
      </div>
     
      <div class="d-grid gap-2">
        <button type="button" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;" onclick="validateAndSubmit()">Submit</button>
      </div>
    </form>

    <!-- Validation Modal -->
    <div class="modal fade" id="validationModal" tabindex="-1" aria-labelledby="validationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #2F5BB7; color: white;">
            <h5 class="modal-title text-uppercase" id="validationModalLabel">REQUIRED FIELD MISSING!</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            Please fill up all required fields before submitting the form.
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" 
                    style="background-color: #2F5BB7; border: none;">OK</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #2F5BB7; color: white;">
            <h5 class="modal-title text-uppercase" id="confirmationModalLabel">Confirm Submission</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            Are you sure you want to submit this form? Please review your information before proceeding.
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-confirm" id="confirmSubmitBtn">Yes, Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

  <script>

    document.querySelectorAll('.uppercase').forEach(input => {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    });
    
    
    document.addEventListener('DOMContentLoaded', function() {
        const partyProvinceSelect = document.getElementById('party_province');
        const partyMunicipalitySelect = document.getElementById('party_municipality');
        const partyBarangaySelect = document.getElementById('party_barangay');

        const countrySelect = document.getElementById('ofw_country');


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
          const defaultText = selectEl === partyProvinceSelect
              ? 'Province'
              : selectEl === partyMunicipalitySelect
              ? 'City / Municipality'
              : selectEl === partyBarangaySelect
              ? 'Barangay'
              : 'Select';

          resetSelect(selectEl, defaultText);
          items.forEach(item => {
            const option = document.createElement('option');
            option.value = item[valueKey];
            option.textContent = item[labelKey];
            selectEl.appendChild(option);
          });
          selectEl.disabled = false;

      }

          resetSelect(partyProvinceSelect, 'Loading provinces...');
          resetSelect(partyMunicipalitySelect, 'City / Municipality');
          resetSelect(partyBarangaySelect, 'Barangay');
          resetSelect(countrySelect, 'Loading countries...');

          // Load country list from first.org (free, no payment, good CORS)
      //   console.log('Loading countries from first.org API...');
          fetch('https://api.first.org/data/v1/countries?limit=250')
          .then(response => {
              if (!response.ok) {
              throw new Error(`Country API status: ${response.status}`);
              }
              return response.json();
          })
          .then(data => {
              if (!data || !data.data) {
              throw new Error('No countries found');
              }

              const countries = Object.entries(data.data)
              .map(([code, value]) => {
                  let name = (value.country || '').trim();

                  // Normalize to remove parentheses/annotations and reduce to base country name
                  // Examples: "Congo (the Democratic Republic of the)" => "Congo"
                  //           "the Bahamas" => "Bahamas"
                  //           "(French Southern Territories)" => "French Southern Territories"
                  name = name.replace(/\s*\(.*?\)/g, '').trim();
                  name = name.replace(/^the\s+/i, '').trim();
                  name = name.replace(/\s{2,}/g, ' ').trim();

                  // If parentheses stripped to nothing, fallback to values from name fields
                  if (!name && value.name && typeof value.name === 'object') {
                  name = (value.name.common || value.name.official || '').trim();
                  }

                  return { code: code.toUpperCase(), name };
              })
              .filter(c => c.code && c.name)
              .reduce((acc, item) => {
                  // dedupe by normalized name
                  const found = acc.find(i => i.name.toLowerCase() === item.name.toLowerCase());
                  if (!found) acc.push(item);
                  return acc;
              }, [])
              .sort((a, b) => a.name.localeCompare(b.name, 'en', { sensitivity: 'base' }));

              if (!countries.length) {
              throw new Error('No selectable countries found after mapping');
              }

          //   console.log(`Loaded ${countries.length} countries`);
              populateSelect(countrySelect, countries, 'code', 'name');
          })
          .catch(error => {
              console.error('Error fetching countries:', error);
              const fallbackCountries = [
              { code: 'PH', name: 'Philippines' },
              { code: 'US', name: 'United States' },
              { code: 'CA', name: 'Canada' },
              { code: 'GB', name: 'United Kingdom' },
              { code: 'AU', name: 'Australia' }
              ];
              console.warn('Using fallback country list');
              populateSelect(countrySelect, fallbackCountries, 'code', 'name');
          });

          // Sync country name when selected
          countrySelect.addEventListener('change', function() {
          const countryName = this.options[this.selectedIndex].text;
          document.getElementById('ofw_country_name').value = countryName;
        });

        const staticRegion3Provinces = [
        { code: '030800000', name: 'Bataan' },
        { code: '031400000', name: 'Bulacan' },
        { code: '034900000', name: 'Nueva Ecija' },
        { code: '035400000', name: 'Pampanga' },
        { code: '036900000', name: 'Tarlac' },
        { code: '037100000', name: 'Zambales' },
        { code: '037700000', name: 'Aurora' }
        ];

        fetch('https://psgc.gitlab.io/api/provinces/')
        .then(response => response.json())
        .then(data => {
            const provinceData = Array.isArray(data)
            ? data
            : (Array.isArray(data.value) ? data.value : []);

            const region3Provinces = provinceData.filter(p => {
            if (!p || !p.regionCode) return false;
            // Accept exact Region 3 code or prefix style
            return p.regionCode === '030000000' || String(p.regionCode).startsWith('030');
            });

            if (!region3Provinces.length) {
            console.warn('PSGC returned no Region 3 provinces, using static fallback');
            populateSelect(partyProvinceSelect, staticRegion3Provinces, 'code', 'name');
            return;
            }

            populateSelect(partyProvinceSelect, region3Provinces, 'code', 'name');
        })
        .catch(error => {
            console.error('Error fetching provinces:', error);
            populateSelect(partyProvinceSelect, staticRegion3Provinces, 'code', 'name');
        });

        partyProvinceSelect.addEventListener('change', function() {
          const provinceCode = this.value;
          const provinceName = this.options[this.selectedIndex].text;
          document.getElementById('party_province_name').value = provinceName;

          
          resetSelect(partyMunicipalitySelect, 'Loading municipalities...');
          resetSelect(partyBarangaySelect, 'Barangay');

          if (!provinceCode) {
              resetSelect(partyMunicipalitySelect, 'City / Municipality');
              return;
          }

          fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
              .then(response => response.json())
              .then(data => {
              if (!Array.isArray(data) || !data.length) {
                  throw new Error('No municipalities found');
              }
              populateSelect(partyMunicipalitySelect, data, 'code', 'name');
              })
              .catch(error => {
              console.error('Error fetching municipalities:', error);
              resetSelect(partyMunicipalitySelect, 'City / Municipality');
              });
          });

          partyMunicipalitySelect.addEventListener('change', function() {
          const cityCode = this.value;
          const cityName = this.options[this.selectedIndex].text;
          document.getElementById('party_municipality_name').value = cityName;
          
          resetSelect(partyBarangaySelect, 'Loading barangays...');

          if (!cityCode) {
              resetSelect(partyBarangaySelect, 'Barangay');
              return;
          }

          fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
              .then(response => response.json())
              .then(data => {
              if (!Array.isArray(data) || !data.length) {
                  throw new Error('No barangays found');
              }
              populateSelect(partyBarangaySelect, data, 'code', 'name');
              })
              .catch(error => {
              console.error('Error fetching barangays:', error);
              resetSelect(partyBarangaySelect, 'Barangay');
              });
        });

        // Sync barangay name when selected
        partyBarangaySelect.addEventListener('change', function() {
            const barangayCode = this.value;
            const barangayName = this.options[this.selectedIndex].text;

            document.getElementById('party_barangay_name').value = barangayName;


        });

        const ofwProvinceSelect = document.getElementById('ofw_province');
        const ofwMunicipalitySelect = document.getElementById('ofw_municipality');
        const ofwBarangaySelect = document.getElementById('ofw_barangay');
   

        // Reset & populate already exist in your code, reuse them

        // ===================== LOAD PROVINCES =====================
        const staticRegion3ProvincesOFW = [
            { code: '030800000', name: 'Bataan' },
            { code: '031400000', name: 'Bulacan' },
            { code: '034900000', name: 'Nueva Ecija' },
            { code: '035400000', name: 'Pampanga' },
            { code: '036900000', name: 'Tarlac' },
            { code: '037100000', name: 'Zambales' },
            { code: '037700000', name: 'Aurora' }
        ];

        fetch('https://psgc.gitlab.io/api/provinces/')
            .then(res => res.json())
            .then(data => {
                const provinceData = Array.isArray(data)
                    ? data
                    : (Array.isArray(data.value) ? data.value : []);

                const region3 = provinceData.filter(p =>
                    p?.regionCode &&
                    (p.regionCode === '030000000' || String(p.regionCode).startsWith('030'))
                );

                if (!region3.length) {
                    populateSelect(ofwProvinceSelect, staticRegion3ProvincesOFW, 'code', 'name');
                    return;
                }

                populateSelect(ofwProvinceSelect, region3, 'code', 'name');
            })
            .catch(err => {
                console.error('OFW province error:', err);
                populateSelect(ofwProvinceSelect, staticRegion3ProvincesOFW, 'code', 'name');
            });

        // ===================== PROVINCE CHANGE =====================
        ofwProvinceSelect.addEventListener('change', function () {
            const provinceCode = this.value;
            const provinceName = this.options[this.selectedIndex].text;

            document.getElementById('ofw_province_name').value = provinceName;

            resetSelect(ofwMunicipalitySelect, 'Loading municipalities...');
            resetSelect(ofwBarangaySelect, 'Barangay');

            if (!provinceCode) {
                resetSelect(ofwMunicipalitySelect, 'City / Municipality');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) {
                        throw new Error('No municipalities found');
                    }
                    populateSelect(ofwMunicipalitySelect, data, 'code', 'name');
                })
                .catch(err => {
                    console.error('OFW municipality error:', err);
                    resetSelect(ofwMunicipalitySelect, 'City / Municipality');
                });
        });

        // ===================== MUNICIPALITY CHANGE =====================
        ofwMunicipalitySelect.addEventListener('change', function () {
            const cityCode = this.value;
            const cityName = this.options[this.selectedIndex].text;

            document.getElementById('ofw_municipality_name').value = cityName;

            resetSelect(ofwBarangaySelect, 'Loading barangays...');

            if (!cityCode) {
                resetSelect(ofwBarangaySelect, 'Barangay');
                return;
            }

            fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
                .then(res => res.json())
                .then(data => {
                    if (!Array.isArray(data) || !data.length) {
                        throw new Error('No barangays found');
                    }
                    populateSelect(ofwBarangaySelect, data, 'code', 'name');
                })
                .catch(err => {
                    console.error('OFW barangay error:', err);
                    resetSelect(ofwBarangaySelect, 'Barangay');
                });
        });

        // ===================== BARANGAY CHANGE =====================
        ofwBarangaySelect.addEventListener('change', function () {
            const barangayName = this.options[this.selectedIndex].text;
            document.getElementById('ofw_barangay_name').value = barangayName;
        });
      

    });

    // Function to validate required fields and show appropriate modal
    function validateAndSubmit() {
        const requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');
        let hasEmptyField = false;

        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                hasEmptyField = true;
                field.style.borderColor = 'red'; // Highlight empty fields
            } else {
                field.style.borderColor = ''; // Reset border if filled
            }
        });

        if (hasEmptyField) {
            const modal = new bootstrap.Modal(document.getElementById('validationModal'));
            modal.show();
        } else {
            showConfirmationModal();
        }
    }

    // Function to show confirmation modal
    function showConfirmationModal() {
        const modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
        modal.show();
    }

    // Event listener for confirm submit button
    document.getElementById('confirmSubmitBtn').addEventListener('click', function() {
        // Close the modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('confirmationModal'));
        modal.hide();
        // Submit the form
        document.querySelector('form').submit();
    });

  </script>

@endsection