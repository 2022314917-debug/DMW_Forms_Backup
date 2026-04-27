@extends('layouts.app')

@section('content')

<style>
    .upload-section{
        background:#f8f9fa;
        border:1px solid #dee2e6;
        padding:15px;
        border-radius:8px;
    }

    .drop-area{
        /* border:2px dashed #ced4da;
        border-radius:8px; */
        min-height:120px;
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        padding:10px;
        cursor:pointer;
        /* background:#fff; */
    }

    .drop-area.drag-over{
        background:#f1f3f5;
        border-color:#0d6efd;
    }

    .drop-placeholder{
        width:100px;
        height:120px;
        border:2px dashed #dee2e6;
        border-radius:6px;
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
    }

    .file-preview{
        width:100px;
        border:1px solid #dee2e6;
        border-radius:6px;
        padding:8px;
        text-align:center;
        position:relative;
        background:#fff;
    }

    .preview-image{
        max-width:100%;
        max-height:60px;
    }

    .remove-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        width: 20px;
        height: 20px;
        border: none;
        background: red;
        color: white;
        border-radius: 50%;
        display: flex;               
        align-items: center;        
        justify-content: center;     
        font-size: 14px;             
        cursor: pointer;             
        padding: 0;                  
        line-height: 1;              
    }

    .file-name{
        display:block;
        max-width:100%;
        white-space:nowrap;
        overflow:hidden;
        text-overflow:ellipsis;
        font-size:11px;
    }

    .pagination .completed .page-link {
        background-color: #198754;
        color: white;
        border-color: #198754;
    }

    .pagination .active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .page-item.completed .page-link {
        /* background-color: #6c757d;
        color: white; */
        background-color: white;
        border-color: #DEE2E6;
        color: #0d6efd;

    }

    .page-item.active .page-link {
        background-color: #0d6efd; /* blue for current step */
        color: white;
    }
</style>
<div class="container py-3">

    <!-- DOCUMENT REQUIREMENTS -->
    <div class="alert alert-success shadow-sm">
        <h5 class="fw-bold mb-2">DOCUMENT REQUIREMENTS</h5>
        <p class="mb-1">
            I-upload ang kopya ng inyong mga dokumento (maaari ring scanned gamit ang cellphone).
            Hinihikayat naming palitan ang pangalan ng file ayon sa uri ng dokumento at pangalan ng OFW.
        </p>
        <p class="mb-0">Halimbawa: Passport - Juan Dela Cruz</p>
    </div>

    <form id="file-form" method="POST" action="{{ route('forms.submit.all') }}" enctype="multipart/form-data">
        @csrf

        <div class="card shadow-sm p-3 mb-5" style="background-color: #DEE9FF;">

            {{-- Assistance to National Request Form --}}
            <!-- <div class="upload-section">
                <label class="fw-semibold">Assistance to National Request Form</label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="assistance">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="assistance[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div> -->

            {{-- Passport --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Philippine Passport / Travel Document <span class="fw-lighter fst-italic">(REQUIRED)</span></label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="passport">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="passport[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>

            {{-- Boarding Pass --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Arrival Stamp / Boarding Pass</label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="boarding">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="boarding[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>

            {{-- Contract --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Employment Contract <span class="fw-lighter fst-italic">(If Available)</span></label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="contract">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="contract[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>


            {{-- Visa --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">VISA / Latest OEC <span class="fw-lighter fst-italic">(If Available)</span></label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="contract">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="visa[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>

            {{-- Medical Record --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Medical Record / Abstract (for OFWs with serious/ critical illnesses)</label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="contract">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="medical[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>

            {{-- Endorsement --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Endorsement Certificate/Letter from the Migrant Workers Office</label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="contract">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="endorsement[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>

            {{-- Proof of Distress --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Other Proof of Distressed <span class="fw-lighter fst-italic">(If Any)</span></label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="contract">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="distress[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
                </div>
            </div>

            {{-- Valid ID --}}
            <div class="upload-section mt-3">
                <label class="fw-semibold">Valid ID <span class="fw-lighter fst-italic">(Address must be within Region III)</span></label>
                <small class="text-muted d-block mb-2">
                    Upload up to 10 supported files: PDF, document or image. Max 100 MB per file.
                </small>

                <div class="drop-area empty" data-name="contract">
                    <div class="drop-placeholder">
                        <i class="fas fa-plus fa-2x text-muted"></i>
                        <p class="text-muted mb-0">Upload File</p>
                    </div>
                    <input type="file" name="valid_id[]" accept=".pdf,.jpg,.jpeg,.png" multiple hidden>
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
            @if($previousStep)
                <a href="/forms/step/{{ $previousStep }}" class="btn btn-back">← BACK</a>
            @else
                <span class="btn btn-back disabled">← BACK</span>
            @endif

            <button type="submit" name="action" value="submit" class="btn btn-next">
                SUBMIT →
            </button>
        </div>

        <div id="upload-spinner" class="text-center my-3" style="display:none;">
            <div class="spinner-border text-primary"></div>
            <p>Submitting Response...</p>
        </div>

    </form>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="confirmSubmitModal" tabindex="-1" aria-labelledby="confirmSubmitLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSubmitLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit all the documents? Please review your files and confirm that all the given information 
                is correct before proceeding.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubmitBtn">Confirm Submit</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Attach _filesArray to every drop-area section
    document.querySelectorAll('.drop-area').forEach(section => {

        const input       = section.querySelector('input[type="file"]');
        const placeholder = section.querySelector('.drop-placeholder');

        section._filesArray  = [];
        let fileIdCounter    = 0;
        const MAX_FILES      = 10;

        const allowedTypes = [
            'application/pdf',
            'image/jpeg',
            'image/png'
        ];

        // -------------------------
        // Click to open file picker
        // -------------------------
        section.addEventListener('click', (e) => {
            if (e.target.closest('.remove-btn')) return;
            input.click();
        });

        // -------------------------
        // File input change
        // -------------------------
        input.addEventListener('change', function () {
            handleFiles(this.files);
            this.value = ''; // reset so same file can be re-added after removal
        });

        // -------------------------
        // Drag & Drop
        // -------------------------
        section.addEventListener('dragover', (e) => {
            e.preventDefault();
            section.classList.add('drag-over');
        });

        section.addEventListener('dragleave', () => {
            section.classList.remove('drag-over');
        });

        section.addEventListener('drop', (e) => {
            e.preventDefault();
            section.classList.remove('drag-over');
            handleFiles(e.dataTransfer.files);
        });

        // -------------------------
        // Handle selected files
        // -------------------------
        function handleFiles(files) {
            let limitReached = false;

            Array.from(files).forEach(file => {

                // Max file count check
                if (section._filesArray.length >= MAX_FILES) {
                    if (!limitReached) {
                        alert(`You can only upload up to ${MAX_FILES} files in this section.`);
                        limitReached = true;
                    }
                    return;
                }

                // File type check
                if (!allowedTypes.includes(file.type)) {
                    alert(`File "${file.name}" is not supported. Only PDF, DOCX, JPG, and PNG are allowed.`);
                    return;
                }

                // Max file size check (100 MB)
                if (file.size > 100 * 1024 * 1024) {
                    alert(`File "${file.name}" exceeds the 100 MB limit.`);
                    return;
                }

                const fileId = fileIdCounter++;

                // Push to section's file array
                section._filesArray.push({ file, id: fileId });

                // Build preview card
                const div = document.createElement('div');
                div.classList.add('file-preview');
                div.dataset.id = fileId;

                // Remove button
                const removeBtn = document.createElement('button');
                removeBtn.innerHTML    = '&times;';
                removeBtn.classList.add('remove-btn');
                removeBtn.title        = 'Remove file';
                removeBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    section._filesArray = section._filesArray.filter(f => f.id !== fileId);
                    div.remove();
                    syncInputFiles(section, input);
                });
                div.appendChild(removeBtn);

                // Preview: image thumbnail or file icon
                if (file.type.startsWith('image/')) {
                    const img    = document.createElement('img');
                    img.src      = URL.createObjectURL(file);
                    img.classList.add('preview-image');
                    img.onload   = () => URL.revokeObjectURL(img.src); // free memory after load
                    div.appendChild(img);
                } else {
                    // Show different icons per type
                    const icon = document.createElement('i');
                    if (file.type === 'application/pdf') {
                        icon.className = 'fas fa-file-pdf fa-2x text-danger';
                    } else {
                        icon.className = 'fas fa-file-word fa-2x text-primary';
                    }
                    div.appendChild(icon);
                }

                // File name label
                const nameLabel       = document.createElement('small');
                nameLabel.classList.add('file-name');
                nameLabel.title       = file.name; // full name on hover
                nameLabel.textContent = file.name;
                div.appendChild(nameLabel);

                // Insert preview before the placeholder
                section.insertBefore(div, placeholder);

                // Sync the actual hidden input
                syncInputFiles(section, input);
            });
        }

        // -------------------------
        // Sync filesArray → input.files
        // via DataTransfer so the form
        // actually submits the files
        // -------------------------
        function syncInputFiles(section, input) {
            const dt = new DataTransfer();
            section._filesArray.forEach(f => dt.items.add(f.file));
            input.files = dt.files;
        }

    });

    // -------------------------
    // Handle submit button click
    // Show confirmation modal
    // -------------------------
    const form = document.getElementById('file-form');
    const submitBtn = form.querySelector('button[name="action"][value="submit"]');
    let isConfirmed = false;

    submitBtn.addEventListener('click', function (e) {
        if (!isConfirmed) {
            e.preventDefault();
            
            // Show modal
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmSubmitModal'));
            confirmModal.show();
        }
    });

    // -------------------------
    // Confirm Submit Button in Modal
    // -------------------------
    const confirmSubmitBtn = document.getElementById('confirmSubmitBtn');
    confirmSubmitBtn.addEventListener('click', function () {
        isConfirmed = true;

        // Final sync pass for all sections
        document.querySelectorAll('.drop-area').forEach(section => {
            const input = section.querySelector('input[type="file"]');
            if (!input || !section._filesArray) return;

            const dt = new DataTransfer();
            section._filesArray.forEach(f => dt.items.add(f.file));
            input.files = dt.files;
        });

        // Hide modal
        const confirmModal = bootstrap.Modal.getInstance(document.getElementById('confirmSubmitModal'));
        confirmModal.hide();

        // Show upload spinner
        const spinner = document.getElementById('upload-spinner');
        if (spinner) spinner.style.display = 'block';

        // Disable submit button to prevent double-submit
        if (submitBtn) {
            submitBtn.disabled    = true;
            submitBtn.textContent = 'Submitting...';
        }

        // Submit the form
        form.submit();
    });

});
</script>
@endsection