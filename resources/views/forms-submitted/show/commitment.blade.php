@extends('layouts.app')

@section('content')

<style>
    body {
        background-color: #f4f4f4;
        font-family: 'Assistant', Arial, sans-serif;
    }

    .form-label {
        font-weight: 500;
    }

    /* ─── Commitment Wrapper ─── */
    .commitment-wrapper {
        background-color: #d9e4f5;
        border: 1px solid #b0c4de;
        border-radius: 0.5rem;
        padding: 1.5rem 1.75rem;
        max-width: 680px;
        margin: 2rem auto;
    }

    .commitment-title {
        text-align: center;
        font-weight: bold;
        font-size: 1.1rem;
        letter-spacing: 0.08em;
        margin-bottom: 1.25rem;
    }

    /* ─── Intro paragraph ─── */
    .commitment-intro {
        font-size: 0.9rem;
        line-height: 2;
        margin-bottom: 1rem;
        word-break: break-word;
    }

    /*
     * Wrapper grows with typed/pre-filled text.
     * max-width: 100% prevents it from ever leaving the container.
     */
    .auto-input-wrap {
        position: relative;
        display: inline-block;
        min-width: 120px;
        max-width: 100%;
        vertical-align: bottom;
        overflow: hidden;
    }

    /* The sizer is invisible but controls the width */
    .auto-input-wrap .sizer {
        display: inline-block;
        visibility: hidden;
        white-space: pre;
        font-size: 0.9rem;
        font-family: 'Assistant', Arial, sans-serif;
        font-weight: 400;
        padding: 0 0.5rem;
        min-width: 120px;
        max-width: 100%;
        overflow: hidden;
        box-sizing: border-box;
    }

    .auto-input-wrap input {
        position: absolute;
        inset: 0;
        width: 100%;
        border: none;
        border-bottom: 1.5px solid #333;
        background: transparent;
        outline: none;
        font-size: 0.9rem;
        font-family: 'Assistant', Arial, sans-serif;
        font-weight: 400;
        padding: 0 0.5rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        box-sizing: border-box;
    }

    .auto-input-wrap.wide {
        min-width: 220px;
    }

    /* ─── Ordered list ─── */
    .commitment-list {
        padding-left: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .commitment-list li {
        font-size: 0.875rem;
        line-height: 1.65;
        margin-bottom: 0.85rem;
        text-align: justify;
    }

    .commitment-list li strong {
        font-weight: 700;
    }

    /* ─── Signature Fields ─── */
    .commitment-fields {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1rem;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .field-group input {
        width: 100%;
        border: 1px solid #b0c4de;
        background-color: #fff;
        border-radius: 0.2rem;
        padding: 0.35rem 0.5rem;
        font-size: 0.85rem;
        outline: none;
    }

    .field-group .field-label {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: #333;
        text-align: center;
    }

    .field-row {
        display: flex;
        gap: 1rem;
    }

    .field-row .field-group {
        flex: 1;
    }

    .field-group input[type="date"] {
        color: #555;
    }

    .underline-field {
        display: inline-block;
        min-width: 200px;
        border-bottom: 1.5px solid #333;
        padding: 0 0.25rem;
        font-size: 0.9rem;
        line-height: 1.5;
    }

    .underline-field.small {
        min-width: 140px;
    }

    .underline-field.date {
        min-width: 160px;
    }

    /* ─── Responsive ─── */
    @media (max-width: 575.98px) {
        .commitment-wrapper {
            padding: 1rem;
            margin: 1rem;
        }

        .auto-input-wrap {
            min-width: 80px;
        }

        .auto-input-wrap.wide {
            min-width: 120px;
        }

        .field-row {
            flex-direction: column;
        }
    }
</style>

<div class="container py-4">
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
        <div class="commitment-wrapper">
        
            {{-- Title --}}
            <div class="commitment-title">COMMITMENT</div>

            {{-- Intro Paragraph --}}
            <p class="commitment-intro">
                I,&nbsp;
                <span class="auto-input-wrap" id="wrap-name">
                    <span class="sizer" id="sizer-name"></span>
                    <input type="text" id="input-name" name="full_name_intro"
                        oninput="expandInput(this)" value="{{ $ofw->ofw_fname ?? null }} {{ $ofw->ofw_mname ?? null }} {{ $ofw->ofw_lname ?? null }} {{ $ofw->ofw_ename ?? null }}" readonly/>
                </span>
                &nbsp;of legal age, with principal address at,&nbsp;
                <span class="auto-input-wrap wide" id="wrap-address">
                    <span class="sizer" id="sizer-address"></span>
                    <input type="text" id="input-address" name="address"
                        oninput="expandInput(this)" value="{{ $ofw_address->house_no ?? null }} {{ $ofw_address->brgy ?? null }}, {{ $ofw_address->municipality ?? null }}, {{ $ofw_address->province}} {{ $ofw_address->zip_code ?? null }}" readonly/>
                </span>
                &nbsp;do hereby state and undertake:
            </p>

            {{-- Numbered Commitments --}}
            <ol class="commitment-list">
                <li>
                    That I am an eligible beneficiary of the cash livelihood development assistance
                    for reintegration under the ELPOR - Enhanced Balik Pinay! Balik Hanapbuhay Program
                    / Expanded Livelihood Development Assistance Program funded by Department of
                    Migrant Workers;
                </li>
                <li>
                    That the livelihood development assistance that I will receive from the DMW will
                    be used for the intended purpose of putting-up a small business only;
                </li>
                <li>
                    That, I will abide with the program guidelines in setting up my business; and
                </li>
                <li>
                    That, I will allow the monitoring and evaluation of the progress of my business
                    operations, and I will submit monthly a progress report and pictures on the status
                    of my business operation to DMW through email address
                    <strong>dmwro3.wrsd@dmw.gov.ph</strong>
                </li>
            </ol>

            {{-- Signature / Info Fields --}}
            <div class="commitment-fields">

                <div class="field-group">
                    <span class="underline-field text-center">
                        {{ $ofw->ofw_fname ?? null }} {{ $ofw->ofw_mname ?? null }} {{ $ofw->ofw_lname ?? null }} {{ $ofw->ofw_ename ?? null }}
                    </span>
                    <span class="field-label">Buong Pangalan</span>
                </div>

                <div class="field-row">
                    <div class="field-group text-center">
                        <span class="underline-field small">
                            {{ $ofw->ofw_passport_no ?? null }}
                        </span>
                        <span class="field-label">Passport Number</span>
                    </div>

                    <div class="field-group text-center">
                        <span class="underline-field date">
                            {{ \Carbon\Carbon::now()->format('Y-m-d') }}
                        </span>
                        <span class="field-label">Petsa</span>
                    </div>
                </div>

            </div>

            

        </div>
        
        
    </form>
</div>

<script>
    /**
     * Grows the wrapper to fit the input text, capped at the container width.
     * Works both on user input AND on page load for pre-filled values.
     *
     * @param {HTMLInputElement} input
     */
    function expandInput(input) {
        const wrap  = input.closest('.auto-input-wrap');
        const sizer = wrap.querySelector('.sizer');

        // Mirror the value (or placeholder spaces when empty)
        const EMPTY_PLACEHOLDER = '\u00a0'.repeat(20);
        sizer.textContent = input.value.length ? input.value : EMPTY_PLACEHOLDER;

        // Measure the container paragraph width (the hard boundary)
        const containerWidth = wrap.closest('.commitment-intro').clientWidth;

        // Let the sizer measure naturally first
        wrap.style.width    = '';
        sizer.style.width   = '';

        const naturalWidth = sizer.scrollWidth;

        if (naturalWidth >= containerWidth) {
            // Pin to container — input will scroll internally
            wrap.style.width  = containerWidth + 'px';
            sizer.style.width = containerWidth + 'px';
        }
        // else: natural width is fine, CSS max-width handles the rest
    }

    /**
     * On DOMContentLoaded, run expandInput on every auto-expanding input
     * so pre-filled values (via `value` attribute or server-side Blade) are
     * sized correctly without the user having to type anything.
     */
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.auto-input-wrap input').forEach(function (input) {
            expandInput(input);
        });
    });
</script>

@endsection