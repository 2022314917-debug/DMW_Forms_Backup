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

    /* ─── Canvas Wrapper ─── */
    .canvas-wrapper {
        background-color: #d9e4f5;
        border: 1px solid #b0c4de;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }

    .canvas-title {
        text-align: center;
        font-weight: bold;
        font-size: 1rem;
        letter-spacing: 0.06em;
        margin-bottom: 0.75rem;
    }

    /* ─── Individual Cell ─── */
    .canvas-cell {
        background-color: #d9e4f5;
        border: 1px solid #b0c4de;
        border-radius: 0.25rem;
        padding: 0.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .canvas-cell .cell-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #222;
        line-height: 1.2;
    }

    .canvas-cell textarea {
        width: 100%;
        flex: 1;
        min-height: 55px;
        border: 1px solid #b0c4de;
        background-color: #fff;
        border-radius: 0.2rem;
        font-size: 0.8rem;
        padding: 0.3rem;
        resize: none;
    }

    /* Business Idea needs taller textarea */
    .cell-business-idea textarea {
        /* min-height: 170px; */
    }



    /* ─── Signature Row ─── */
    .signature-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 1rem;
        margin-top: 0.75rem;
        flex-wrap: wrap;
    }

    .signature-field {
        flex: 0 0 200px;
        text-align: center;
    }

    .signature-field input[type="text"] {
        width: 100%;
        border: none;
        border-bottom: 1px solid #444;
        background: transparent;
        text-align: center;
        font-size: 0.8rem;
        padding: 0.2rem 0;
        outline: none;
    }

    .signature-field .sig-label {
        font-size: 0.68rem;
        color: #555;
        margin-top: 0.2rem;
        display: block;
        text-align: center;
        letter-spacing: 0.04em;
    }

    /* ─── Upload Section ─── */
    .upload-wrapper {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 0.375rem;
        padding: 1.5rem;
        text-align: center;
    }

    .upload-box {
        border: 2px dashed #aaa;
        border-radius: 0.375rem;
        padding: 2.5rem 1rem;
        background-color: #fafafa;
        cursor: pointer;
        transition: border-color 0.2s;
        display: block;
        margin: 0 auto;
        max-width: 340px;
    }

    .upload-box:hover {
        border-color: #4a90d9;
    }

    .upload-box p {
        font-size: 0.85rem;
        color: #666;
        margin: 0.4rem 0 0;
    }

    .upload-title {
        font-weight: bold;
        font-size: 0.95rem;
        margin-top: 1rem;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

    /* ─── Responsive: stack columns on mobile ─── */
    @media (max-width: 767.98px) {
        .canvas-main-row {
            flex-direction: column !important;
        }

        .canvas-col {
            width: 100% !important;
        }

        .cell-business-idea textarea {
            min-height: 90px;
        }

        .signature-field {
            flex: 1 1 100%;
        }
    }
</style>



<div class="container py-4">

    {{-- ═══════════════════════════════════════ --}}
    {{--              BUSINESS CANVAS            --}}
    {{-- ═══════════════════════════════════════ --}}

    <form method="POST" action="{{ route('forms.step.store', $step) }}" enctype="multipart/form-data">
        @csrf
        <div class="canvas-wrapper">
            <div class="canvas-title">BUSINESS CANVAS</div>

            {{-- Three-column flex layout --}}
            <div class="d-flex gap-2 canvas-main-row">

                {{-- ── Column 1: MARKETING ── --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell">
                        <span class="cell-label">2. Marketing</span>
                        <span class="cell-label" style="font-weight:500;">2.1 Customer</span>
                        <textarea name="elpor_bc_customer">{{ session('forms.data.business_canvas.elpor_bc_customer') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.2 Pwesto o Lugar</span>
                        <textarea name="elpor_bc_place">{{ session('forms.data.business_canvas.elpor_bc_place') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.3 Promotions</span>
                        <textarea name="elpor_bc_promotions">{{ session('forms.data.business_canvas.elpor_bc_promotions') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.4 Presyo</span>
                        <textarea name="elpor_bc_price">{{ session('forms.data.business_canvas.elpor_bc_price') }}</textarea>
                    </div>

                </div>

                {{-- ── Column 2: BUSINESS IDEA + OPERATIONS ── --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell cell-business-idea">
                        <span class="cell-label">1. Business Idea</span>
                        <textarea name="elpor_bc_idea">{{ session('forms.data.business_canvas.elpor_bc_idea') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3. Business Operations</span>
                        <span class="cell-label" style="font-weight:500;">3.1 Proseso</span>
                        <textarea name="elpor_bc_process">{{ session('forms.data.business_canvas.elpor_bc_process') }}</textarea>
                    </div>

                    <div class="canvas-cell highlighted">
                        <span class="cell-label">3.2 Resources</span>
                        <textarea name="elpor_bc_resources">{{ session('forms.data.business_canvas.elpor_bc_resources') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3.3 Key Partners</span>
                        <textarea name="elpor_bc_partners">{{ session('forms.data.business_canvas.elpor_bc_partners') }}</textarea>
                    </div>

                </div>

                {{-- ── Column 3: FINANCE ── --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell">
                        <span class="cell-label">4. Finance</span>
                        <span class="cell-label" style="font-weight:500;">4.1 Start Up Cost</span>
                        <textarea name="elpor_bc_cost">{{ session('forms.data.business_canvas.elpor_bc_cost') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.2 Pagkukuhanan ng Puhunan</span>
                        <textarea name="elpor_bc_investment">{{ session('forms.data.business_canvas.elpor_bc_investment') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.3 Budget</span>
                        <textarea name="elpor_bc_budget">{{ session('forms.data.business_canvas.elpor_bc_budget') }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.4 Kita</span>
                        <textarea name="elpor_bc_profit">{{ session('forms.data.business_canvas.elpor_bc_profit') }}</textarea>
                    </div>

                </div>

            </div>
            {{-- end canvas-main-row --}}


        </div>
        {{-- end canvas-wrapper --}}


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

        <div class="modal fade" id="senaValidationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #2F5BB7; color: white;">
                        <h5 class="modal-title text-uppercase">Required Field Missing!</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Please fill up all required fields before proceeding.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                style="background-color: #2F5BB7; border: none;">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    

</div>
@endsection