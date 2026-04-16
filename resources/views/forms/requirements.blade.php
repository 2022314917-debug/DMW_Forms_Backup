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
                    <input type="file" name="assistance[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="passport[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="boarding[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="contract[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="contract[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="contract[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="contract[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="contract[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
                    <input type="file" name="contract[]" accept=".docx,.pdf,.jpg,.jpeg,.png" multiple hidden>
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
            <p>Uploading files...</p>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        let sections = document.querySelectorAll('.drop-area');

        sections.forEach(section => {

            let input = section.querySelector('input[type="file"]');
            let placeholder = section.querySelector('.drop-placeholder');

            let filesArray = [];
            let fileIdCounter = 0;

            section.addEventListener('click', (e)=>{
                if(e.target.closest('.remove-btn')) return;
                input.click();
            });

            input.addEventListener('change', function(){
                handleFiles(this.files);
                this.value='';
            });

            section.addEventListener('dragover', e=>{
                e.preventDefault();
                section.classList.add('drag-over');
            });

            section.addEventListener('dragleave', ()=>{
                section.classList.remove('drag-over');
            });

            section.addEventListener('drop', e=>{
                e.preventDefault();
                section.classList.remove('drag-over');
                handleFiles(e.dataTransfer.files);
            });

            function handleFiles(files){
                Array.from(files).forEach(async file => {

                    // Allowed file types
                    const allowedTypes = [
                        'application/pdf', 
                        'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // docx
                        'image/jpeg',
                        'image/png'
                    ];

                    if(!allowedTypes.includes(file.type)){
                        alert(`File "${file.name}" is not supported!`);
                        return; // skip this file
                    }

                    const fileId = fileIdCounter++;

                    filesArray.push({file,id:fileId});

                    const div = document.createElement('div');
                    div.classList.add('file-preview');
                    div.dataset.id = fileId;

                    const remove = document.createElement('button');
                    remove.innerHTML = '×';
                    remove.classList.add('remove-btn');
                    remove.onclick = (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        filesArray = filesArray.filter(f => f.id != fileId);
                        div.remove();
                    };
                    div.appendChild(remove);

                    if(file.type.startsWith('image/')){
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.classList.add('preview-image');
                        div.appendChild(img);
                    } else {
                        const icon = document.createElement('i');
                        icon.className = 'fas fa-file fa-2x';
                        div.appendChild(icon);
                    }

                    const name = document.createElement('small');
                    name.classList.add('file-name');
                    name.title = file.name; // show full name on hover
                    name.textContent = file.name;
                    div.appendChild(name);
                    

                    section.insertBefore(div, placeholder);

                });
            }

        });

    });
</script>
@endsection