@extends('layouts.app')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Assistant:wght@400;500;600;700&display=swap" rel="stylesheet">
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

  <div class="container my-5">
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

    <!-- Section A -->
    <div class="form-section">
      <h5>A. IMPORMASYON NG HUMIHILING (Request Party)</h5>
      <form>
        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" placeholder="Dela Cruz">
          </div>
          <div class="col-md-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" placeholder="Juan">
          </div>
          <div class="col-md-2">
            <label class="form-label">Name Ext.</label>
            <input type="text" class="form-control" placeholder="Jr/Sr/III">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" placeholder="Santos">
          </div>
        </div>

        <div class="row g-3 mb-3">

          <div class="col-6 col-md-3">
            <label class="form-label">Birthday</label>
            <input type="date" class="form-control">
          </div>

          <div class="col-6 col-md-3">
            <label class="form-label">Sex</label>
            <select class="form-select">
              <option selected disabled>Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label">Relationship to OFW</label>
            <input type="text" class="form-control" placeholder="ex. Brother">
          </div>

        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" placeholder="ex. 09123456768">
          </div>
          <div class="col-md-6">
            <label class="form-label">Email Address</label>
            <input type="email" class="form-control" placeholder="ex. sample@email.com">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address in the Philippines</label>
          <input type="text" class="form-control mb-2" placeholder="Unit/Room/House Number/Street name">
          <div class="row g-3">
            <div class="col-6 col-md-3">
              <select class="form-select" id="province">
                <option selected disabled>Province</option>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <select class="form-select" id="municipality" disabled>
                <option selected disabled>City / Municipality</option>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <select class="form-select" id="barangay" disabled>
                <option selected disabled>Barangay</option>
              </select>
            </div>
            <div class="col-6 col-md-3">
              <input type="number" class="form-control" placeholder="ex. 2016">
            </div>
          </div>
        </div>
      </form>
    </div>

    <!-- Section B -->
    <div class="form-section">
      <h5>B. IMPORMASYON NG OFW (Kung Iba sa Humihiling)</h5>
      <form>
        <div class="row g-3 mb-3">
          <div class="col-md-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" placeholder="Dela Cruz">
          </div>
          <div class="col-md-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" placeholder="Juan">
          </div>
          <div class="col-md-2">
            <label class="form-label">Name Ext.</label>
            <input type="text" class="form-control" placeholder="Jr/Sr/III">
          </div>
          <div class="col-md-4">
            <label class="form-label">Middle Name</label>
            <input type="text" class="form-control" placeholder="Santos">
          </div>
        </div>

        <div class="row g-3 mb-3">

          <div class="col-md-4">
            <label class="form-label">Passport No.</label>
            <input type="text" class="form-control" placeholder="ex. 123456789">
          </div>

          <div class="col-6 col-md-4">
            <label class="form-label">Sex</label>
            <select class="form-select">
              <option selected disabled>Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>

          <div class="col-6 col-md-4">
            <label class="form-label">Date of Birth</label>
            <input type="date" class="form-control">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-6 col-md-3">
            <label class="form-label">Agency</label>
            <input type="text" class="form-control" placeholder="ex. Agency Name">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">Employer</label>
            <input type="text" class="form-control" placeholder="ex. Employer/Company Name">
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">Bansa</label>
            <select class="form-select">
              <option selected disabled>Select</option>
            </select>
          </div>
          <div class="col-6 col-md-3">
            <label class="form-label">Trabaho</label>
            <input type="text" class="form-control" placeholder="ex. Driver">
          </div>
        </div>

      </form>
    </div>

    <!-- Section C -->
    <div class="form-section">
      <h5>C. URI NG TULONG (Nature Of Request)</h5>
      <p style="font-size: 0.9rem; margin-bottom: 1rem;">
        <strong>Halagi o Naturang ng Concern:</strong> Piliin ang lahat ng bagay na sumusunod halaki handi siguruduhin sa uring <em>Concern, Pakialam ng aming PAOs information na nakahintay sa Applicant sa lahat ng impormasyon Dept. Applicant sa nakahihintay tumutulong upang makabuo at dibhiyon pura at pa maiggi oras.</em>
      </p>

      <form>
        <!-- MIGRANT WORKERS PROCESSING DIVISION -->
        <div style="border: 1px solid #b0c4de; border-radius: 0.25rem; padding: 0.75rem; margin-bottom: 1rem; background-color: #e8f1fb;">
          <h6 style="font-weight: bold; margin-bottom: 0.75rem; text-decoration: underline;">MIGRANT WORKERS PROCESSING DIVISION</h6>
          
          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="owf_records" name="mwpd" value="owf_records">
              <label class="form-check-label" for="owf_records">OFW Records/OFW Information Sheet</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="direct_hire_oec" name="mwpd" value="direct_hire_oec">
              <label class="form-check-label" for="direct_hire_oec">Direct-Hire OEC processing concerns</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="submission_gta" name="mwpd" value="submission_gta" onchange="toggleG2GCountries()">
              <label class="form-check-label" for="submission_gta">Submission of Government-to-Government application</label>
            </div>
            <div style="margin-left: 1.5rem; margin-top: 0.5rem;">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="g2g_country" id="taiwan" value="taiwan" onchange="toggleG2GOthers()" disabled>
                <label class="form-check-label" for="taiwan">Taiwan</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="g2g_country" id="moh_ksa" value="moh_ksa" onchange="toggleG2GOthers()" disabled>
                <label class="form-check-label" for="moh_ksa">MOH-KSA</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="g2g_country" id="jpepa_japan" value="jpepa_japan" onchange="toggleG2GOthers()" disabled>
                <label class="form-check-label" for="jpepa_japan">JPEPA-Japan</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="g2g_country" id="israel" value="israel" onchange="toggleG2GOthers()" disabled>
                <label class="form-check-label" for="israel">Israel</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="g2g_country" id="germany" value="germany" onchange="toggleG2GOthers()" disabled>
                <label class="form-check-label" for="germany">Germany</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="g2g_country" id="others" value="others" onchange="toggleG2GOthers()" disabled>
                <label class="form-check-label" for="others">Others:</label>
              </div>
              <input type="text" id="g2g_others_text" class="form-control" style="margin-left: 1.5rem; margin-top: 0.25rem; width: calc(100% - 1.5rem);" placeholder="Specify others" readonly>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="other_concerns_mwpd" name="mwpd" value="other_concerns" onchange="toggleTextbox('other_concerns_mwpd_text', this.checked)">
              <label class="form-check-label" for="other_concerns_mwpd">Other Concerns</label>
            </div>
            <input type="text" class="form-control" id="other_concerns_mwpd_text" placeholder="Specify other concerns" style="margin-top: 0.25rem; padding-left: 1.5rem;" readonly>
          </div>
        </div>

        <!-- WELFARE AND REINTEGRATION SERVICES DIVISION -->
        <div style="border: 1px solid #b0c4de; border-radius: 0.25rem; padding: 0.75rem; margin-bottom: 1rem; background-color: #e8f1fb;">
          <h6 style="font-weight: bold; margin-bottom: 0.75rem; text-decoration: underline;">WELFARE AND REINTEGRATION SERVICES DIVISION</h6>
          
          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="reint_services" name="wrsd" value="reint_services" onchange="toggleTextbox('reint_services_text', this.checked)">
              <label class="form-check-label" for="reint_services">Reintegration Services:</label>
            </div>
            <input type="text" id="reint_services_text" class="form-control" placeholder="Specify services" style="width: calc(100% - 1.5rem); margin-left: 1.5rem; margin-top: 0.25rem; margin-bottom: 0.75rem;" readonly>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="sa_pinas_spims" name="wrsd" value="sa_pinas_spims">
              <label class="form-check-label" for="sa_pinas_spims">Sa Pinas, Ikaw ang Ma'am at Sir (SPIMS)</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="assistance_nationals" name="wrsd" value="assistance_nationals" onchange="toggleAssistanceTypeRadios()">
              <label class="form-check-label" for="assistance_nationals">Assistance to Nationals:</label>
            </div>
            <div style="margin-left: 1.5rem; margin-top: 0.5rem;">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="assistance_type" id="shipment_remains" value="shipment_remains" onchange="toggleAssistanceOthers()" disabled>
                <label class="form-check-label" for="shipment_remains">Request for shipment or remains / belongs</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="assistance_type" id="assistance_other" value="assistance_other" onchange="toggleAssistanceOthers()" disabled>
                <label class="form-check-label" for="assistance_other">Others:</label>
              </div>
              <input type="text" id="assistance_others_text" class="form-control" placeholder="Specify others" style="margin-left: 1.5rem; margin-top: 0.25rem; width: calc(100% - 1.5rem); margin-bottom: 0.75rem;" readonly>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="repatriation" name="wrsd" value="repatriation">
              <label class="form-check-label" for="repatriation">Repatriation</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="financial_assistance" name="wrsd" value="financial_assistance">
              <label class="form-check-label" for="financial_assistance">Financial Assistance through AKSYON fund</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="other_concerns_wrsd" name="wrsd" value="other_concerns" onchange="toggleTextbox('other_concerns_wrsd_text', this.checked)">
              <label class="form-check-label" for="other_concerns_wrsd">Others</label>
            </div>
            <input type="text" class="form-control" id="other_concerns_wrsd_text" placeholder="Specify other concerns" style="margin-top: 0.25rem; padding-left: 1.5rem;" readonly>
          </div>
        </div>

        <!-- MIGRANT WORKERS PROTECTION DIVISION -->
        <div style="border: 1px solid #b0c4de; border-radius: 0.25rem; padding: 0.75rem; margin-bottom: 1rem; background-color: #e8f1fb;">
          <h6 style="font-weight: bold; margin-bottom: 0.75rem; text-decoration: underline;">MIGRANT WORKERS PROTECTION DIVISION</h6>
          
          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="request_ofw_info" name="mwpd_protection" value="request_ofw_info">
              <label class="form-check-label" for="request_ofw_info">Request for OFW Information Sheet for legal purposes</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="request_assistance" name="mwpd_protection" value="request_assistance">
              <label class="form-check-label" for="request_assistance">Request for Assistance for SEnA/Conciliation</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="request_legal_assistance" name="mwpd_protection" value="request_legal_assistance">
              <label class="form-check-label" for="request_legal_assistance">Request for legal assistance/counseling</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="request_illegal_recruitment" name="mwpd_protection" value="request_illegal_recruitment">
              <label class="form-check-label" for="request_illegal_recruitment">Request for the issuance of Illegal Recruitment Certification</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="request_disciplinary" name="mwpd_protection" value="request_disciplinary">
              <label class="form-check-label" for="request_disciplinary">Request for the issuance of Disciplinary Action Agains Employer / Work and/or Recruitment Violation</label>
            </div>
          </div>

          <div class="mb-2">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="other_concerns_mwpd_protection" name="mwpd_protection" value="other_concerns" onchange="toggleTextbox('other_concerns_mwpd_protection_text', this.checked)">
              <label class="form-check-label" for="other_concerns_mwpd_protection">Others</label>
            </div>
            <input type="text" class="form-control" id="other_concerns_mwpd_protection_text" placeholder="Specify other concerns" style="margin-top: 0.25rem; padding-left: 1.5rem;" readonly>
          </div>
        </div>

        <!-- Submit Button -->

      </form>
      
    </div>

    <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success btn-lg fw-bold" style="background-color: #2d7a2d; border-color: #2d7a2d;">Submit</button>
        </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function toggleTextbox(textboxId, isChecked) {
      const textbox = document.getElementById(textboxId);
      if (isChecked) {
        textbox.removeAttribute('readonly');
        textbox.focus();
      } else {
        textbox.setAttribute('readonly', 'readonly');
        textbox.value = '';
      }
    }

    function toggleG2GOthers() {
      const radios = document.getElementsByName('g2g_country');
      const textbox = document.getElementById('g2g_others_text');
      let selected = false;
      for (let radio of radios) {
        if (radio.checked && radio.value === 'others') {
          selected = true;
          break;
        }
      }
      if (selected) {
        textbox.removeAttribute('readonly');
      } else {
        textbox.setAttribute('readonly', true);
        textbox.value = '';
      }
    }

    function toggleG2GCountries() {
      const isChecked = document.getElementById('submission_gta').checked;
      const radios = document.getElementsByName('g2g_country');
      for (let radio of radios) {
        radio.disabled = !isChecked;
        if (!isChecked) {
          radio.checked = false;
        }
      }
      toggleG2GOthers();
    }

    function toggleAssistanceOthers() {
      const radios = document.getElementsByName('assistance_type');
      const textbox = document.getElementById('assistance_others_text');
      let selected = false;
      for (let radio of radios) {
        if (radio.checked && radio.value === 'assistance_other') {
          selected = true;
          break;
        }
      }
      if (selected) {
        textbox.removeAttribute('readonly');
      } else {
        textbox.setAttribute('readonly', true);
        textbox.value = '';
      }
    }

    function toggleAssistanceTypeRadios() {
      const isChecked = document.getElementById('assistance_nationals').checked;
      const radios = document.getElementsByName('assistance_type');
      for (let radio of radios) {
        radio.disabled = !isChecked;
        if (!isChecked) {
          radio.checked = false;
        }
      }
      toggleAssistanceOthers();
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const provinceSelect = document.getElementById('province');
      const municipalitySelect = document.getElementById('municipality');
      const barangaySelect = document.getElementById('barangay');

      function resetSelect(selectEl, text) {
        selectEl.innerHTML = `<option selected disabled>${text}</option>`;
        selectEl.disabled = true;
      }

      function populateSelect(selectEl, items, valueKey, labelKey) {
        resetSelect(selectEl, selectEl === provinceSelect ? 'Province' : selectEl === municipalitySelect ? 'City / Municipality' : 'Barangay');
        items.forEach(item => {
          const option = document.createElement('option');
          option.value = item[valueKey];
          option.textContent = item[labelKey];
          selectEl.appendChild(option);
        });
        selectEl.disabled = false;
      }

      resetSelect(provinceSelect, 'Loading provinces...');
      resetSelect(municipalitySelect, 'City / Municipality');
      resetSelect(barangaySelect, 'Barangay');

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
            populateSelect(provinceSelect, staticRegion3Provinces, 'code', 'name');
            return;
          }

          populateSelect(provinceSelect, region3Provinces, 'code', 'name');
        })
        .catch(error => {
          console.error('Error fetching provinces:', error);
          populateSelect(provinceSelect, staticRegion3Provinces, 'code', 'name');
        });

      provinceSelect.addEventListener('change', function() {
        const provinceCode = this.value;
        resetSelect(municipalitySelect, 'Loading municipalities...');
        resetSelect(barangaySelect, 'Barangay');

        if (!provinceCode) {
          resetSelect(municipalitySelect, 'City / Municipality');
          return;
        }

        fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
          .then(response => response.json())
          .then(data => {
            if (!Array.isArray(data) || !data.length) {
              throw new Error('No municipalities found');
            }
            populateSelect(municipalitySelect, data, 'code', 'name');
          })
          .catch(error => {
            console.error('Error fetching municipalities:', error);
            resetSelect(municipalitySelect, 'City / Municipality');
          });
      });

      municipalitySelect.addEventListener('change', function() {
        const cityCode = this.value;
        resetSelect(barangaySelect, 'Loading barangays...');

        if (!cityCode) {
          resetSelect(barangaySelect, 'Barangay');
          return;
        }

        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
          .then(response => response.json())
          .then(data => {
            if (!Array.isArray(data) || !data.length) {
              throw new Error('No barangays found');
            }
            populateSelect(barangaySelect, data, 'code', 'name');
          })
          .catch(error => {
            console.error('Error fetching barangays:', error);
            resetSelect(barangaySelect, 'Barangay');
          });
      });
    });
  </script>

@endsection