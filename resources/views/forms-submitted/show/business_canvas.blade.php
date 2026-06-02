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

    <form method="POST" action="" enctype="multipart/form-data">
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
                        <textarea name="elpor_bc_customer">{{ $entries['elpor_bc_customer'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.2 Pwesto o Lugar</span>
                        <textarea name="elpor_bc_place">{{ $entries['elpor_bc_place'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.3 Promotions</span>
                        <textarea name="elpor_bc_promotions">{{ $entries['elpor_bc_promotions'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">2.4 Presyo</span>
                        <textarea name="elpor_bc_price">{{ $entries['elpor_bc_price'] ?? null }}</textarea>
                    </div>

                </div>

                {{-- ── Column 2: BUSINESS IDEA + OPERATIONS ── --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell cell-business-idea">
                        <span class="cell-label">1. Business Idea</span>
                        <textarea name="elpor_bc_idea">{{ $entries['elpor_bc_idea'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3. Business Operations</span>
                        <span class="cell-label" style="font-weight:500;">3.1 Proseso</span>
                        <textarea name="elpor_bc_process">{{ $entries['elpor_bc_process'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell highlighted">
                        <span class="cell-label">3.2 Resources</span>
                        <textarea name="elpor_bc_resources">{{ $entries['elpor_bc_resources'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">3.3 Key Partners</span>
                        <textarea name="elpor_bc_partners">{{ $entries['elpor_bc_partners'] ?? null }}</textarea>
                    </div>

                </div>

                {{-- ── Column 3: FINANCE ── --}}
                <div class="canvas-col d-flex flex-column gap-2" style="flex:1;">

                    <div class="canvas-cell">
                        <span class="cell-label">4. Finance</span>
                        <span class="cell-label" style="font-weight:500;">4.1 Start Up Cost</span>
                        <textarea name="elpor_bc_cost">{{ $entries['elpor_bc_cost'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.2 Pagkukuhanan ng Puhunan</span>
                        <textarea name="elpor_bc_investment">{{ $entries['elpor_bc_investment'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.3 Budget</span>
                        <textarea name="elpor_bc_budget">{{ $entries['elpor_bc_budget'] ?? null }}</textarea>
                    </div>

                    <div class="canvas-cell">
                        <span class="cell-label">4.4 Kita</span>
                        <textarea name="elpor_bc_profit">{{ $entries['elpor_bc_profit'] ?? null }}</textarea>
                    </div>

                </div>

            </div>
            {{-- end canvas-main-row --}}


        </div>
        {{-- end canvas-wrapper --}}



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