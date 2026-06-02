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

    /* ─── Kasulatan Wrapper ─── */
    .kasulatan-wrapper {
        background-color: #d9e4f5;
        border: 1px solid #b0c4de;
        border-radius: 0.5rem;
        padding: 1.5rem 1.75rem;
        max-width: 680px;
        margin: 2rem auto;
    }

    .kasulatan-title {
        text-align: center;
        font-weight: bold;
        font-size: 1.1rem;
        letter-spacing: 0.08em;
        margin-bottom: 1.25rem;
    }

    /* ─── Paragraphs ─── */
    .kasulatan-intro {
        font-size: 0.9rem;
        line-height: 2;
        margin-bottom: 0.5rem;
        word-break: break-word;
        text-indent: 3rem;
    }

    .kasulatan-closing {
        font-size: 0.9rem;
        line-height: 2;
        margin-top: 1rem;
        margin-bottom: 0.25rem;
        word-break: break-word;
    }

    /* ─── Auto-expanding inline input ─── */
    /*
     * Key: the wrapper is inline-block and sized by the hidden .sizer span.
     * The <input> is absolutely positioned to fill that wrapper.
     * JS measures actual rendered text width via a temporary canvas
     * so the sizer always matches the input font exactly.
     */
    .auto-input-wrap {
        position: relative;
        display: inline-block;
        vertical-align: bottom;
        overflow: hidden;
        /* min/max set per variant below */
    }

    .auto-input-wrap .sizer {
        display: inline-block;
        visibility: hidden;
        white-space: pre;
        /* font must match the input exactly */
        font-size: 0.9rem;
        font-family: 'Assistant', Arial, sans-serif;
        font-weight: 400;
        padding: 0 0.35rem;
        box-sizing: border-box;
        pointer-events: none;
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
        padding: 0 0.35rem;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        box-sizing: border-box;
    }

    /* Variants */
    .auto-input-wrap.short  { min-width: 40px;  max-width: 100%; }
    .auto-input-wrap.medium { min-width: 140px; max-width: 100%; }
    .auto-input-wrap.wide   { min-width: 200px; max-width: 100%; }

    /* Full-line: block, stretches across remaining line */
    .auto-input-wrap.full {
        display: block;
        width: 100%;
        min-width: 0;
        max-width: 100%;
        margin-top: 0.1rem;
    }

    /* ─── Ordered list ─── */
    .kasulatan-list {
        padding-left: 1.25rem;
        margin-bottom: 1rem;
    }

    .kasulatan-list li {
        font-size: 0.875rem;
        line-height: 1.65;
        margin-bottom: 0.85rem;
        text-align: justify;
    }

    /* ─── Signature Fields ─── */
    .kasulatan-fields {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-top: 1.25rem;
    }

    .field-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.25rem;
    }

    .field-group input[type="text"] {
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

    .underline-field {
        display: inline-block;
        min-width: 160px;
        border-bottom: 1.5px solid #333;
        padding: 0 0.25rem;
        font-size: 0.9rem;
        line-height: 1.5;
        vertical-align: bottom;
    }

    .underline-field.small {
        min-width: 80px;
    }

    .underline-field.medium {
        min-width: 140px;
    }

    .underline-field.wide {
        min-width: 220px;
    }

    /* ─── Responsive ─── */
    @media (max-width: 575.98px) {
        .kasulatan-wrapper {
            padding: 1rem;
            margin: 1rem;
        }
        .kasulatan-intro {
            text-indent: 1.5rem;
        }
        .auto-input-wrap.wide {
            min-width: 120px;
        }
    }
</style>

<div class="container">
    <form method="POST" action="{{ route('forms.step.store', $step) }}" enctype="multipart/form-data">
        @csrf

        <div class="kasulatan-wrapper">

            {{-- Title --}}
            <div class="kasulatan-title">KASULATAN</div>

            {{-- Intro Paragraph --}}
            <p class="kasulatan-intro">
                Ako si,&nbsp;
                <span class="auto-input-wrap wide">
                    <span class="sizer"></span>
                    <input type="text" name="full_name_intro"
                           oninput="expandInput(this)"
                           value="{{ trim(session('forms.data.rfa.ofw_fname') . ' ' . session('forms.data.rfa.ofw_mname') . ' ' . session('forms.data.rfa.ofw_lname') . ' ' . session('forms.data.rfa.ofw_ename')) }}"
                           readonly />
                </span>
                &nbsp;, may edad na&nbsp;
                <span class="auto-input-wrap short">
                    <span class="sizer"></span>
                    <input type="text" name="edad"
                           oninput="expandInput(this)"
                           value="{{ session('forms.data.elpor.elpor_ofw_age') }}"
                           readonly />
                </span>
                &nbsp;, at naninirahan sa,&nbsp;
                <span class="auto-input-wrap wide">
                    <span class="sizer"></span>
                    <input type="text" name="address"
                           oninput="expandInput(this)"
                           value="{{ trim(session('forms.data.rfa.ofw_house_no') . ' ' . session('forms.data.rfa.ofw_barangay_name') . ', ' . session('forms.data.rfa.ofw_municipality_name') . ', ' . session('forms.data.rfa.ofw_province_name') . ' ' . session('forms.data.rfa.ofw_zip_code')) }}"
                           readonly />
                </span>
                &nbsp;ay nagpapatunay sa mga sumusunod:
            </p>

            {{-- Numbered Items --}}
            <ol class="kasulatan-list">
                <li>
                    Na sa araw na ito,&nbsp;
                    <span class="auto-input-wrap medium">
                        <span class="sizer"></span>
                        <input type="text" name="araw"
                               oninput="expandInput(this)"
                               class="js-today"
                               readonly />
                    </span>
                    &nbsp;, ay nagsumite ako ng aplikasyon para sa programang Livelihood Development
                    Program (LDAP) / Balik Pinay! Balik Hanapbuhay! (BPBH) Program (guhitan kung alin)
                    sa Department of Migrant Workers Regional Office III.
                </li>
                <li>
                    Na sa oras ng aking pagpapasa ng aplikasyon, ako ay pinaliwanagan at lubos kong
                    nauunawaan na ang nasabing programa sa rehiyon ay kasalukuyang walang pondo.
                </li>
                <li>
                    Na alam ko rin na ang DMW Region 3 ay nakatakdang humiling ng karagdagang pondo
                    mula sa pambansang tanggapan at maghihintay ako hanggang sa magkaroon na ng pondo
                    upang maproseso ang aking aplikasyon.
                </li>
                <li>
                    Na ang kasulatang ito ay aking nilagdaan nang walang sinumang pumilit o tumakot
                    sa akin at batid ko na ang lahat ng nakasaad dito ay totoo.
                </li>
            </ol>

            {{-- Closing --}}
            <p class="kasulatan-closing">
                Bilang patunay, ako ay lumagda sa ibaba nito ngayong&nbsp;
                <span class="auto-input-wrap medium">
                    <span class="sizer"></span>
                    <input type="text" name="ngayon_date"
                           oninput="expandInput(this)"
                           class="js-today"
                           readonly />
                </span>
                sa&nbsp;
            </p>
            <p class="kasulatan-closing" style="margin-top:0;">
                
                <span class="auto-input-wrap">
                    <span class="sizer"></span>
                    <input type="text" name="lugar_lumagda"
                           oninput="expandInput(this)"
                           value="{{ trim(session('forms.data.rfa.ofw_municipality_name') . ', ' . session('forms.data.rfa.ofw_province_name')) }}"
                           readonly />
                </span>&#46;
            </p>

            {{-- Signature Fields --}}
            <div class="kasulatan-fields">

                <div class="field-group">
                    <span class="underline-field wide text-center">
                        {{ session('forms.data.rfa.ofw_fname') }} {{ session('forms.data.rfa.ofw_mname') }} {{ session('forms.data.rfa.ofw_lname') }} {{ session('forms.data.rfa.ofw_ename') }}
                    </span>
                    <span class="field-label">Pangalan ng Aplikante</span>
                </div>

                <!-- <div class="field-group">
                    <span class="underline-field wide">
                        {{ old('pangalan_kinatawan') }}
                    </span>
                    <span class="field-label">Pangalan ng Kinatawan ng DMW Region3</span>
                </div> -->

            </div>

        </div>

        @php
            $steps        = session('forms.steps', []);
            $currentStep  = request()->segment(3);
            $currentIndex = array_search($currentStep, $steps);
            $previousStep = ($currentIndex !== false && $currentIndex > 0) ? $steps[$currentIndex - 1] : null;
            $nextStep     = ($currentIndex !== false && $currentIndex < count($steps) - 1) ? $steps[$currentIndex + 1] : null;
        @endphp

        <div class="step-wrapper">
            <ul class="steps">
                @foreach($steps as $index => $step)
                    <li class="step
                        {{ $step == $currentStep ? 'active' : '' }}
                        {{ array_search($step, $steps) < array_search($currentStep, $steps) ? 'completed' : '' }}">
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

<script>
    /**
     * Sizes the wrapper to fit the input text precisely.
     * Uses a hidden <canvas> to measure text width with the exact
     * font/size used by the input — more accurate than the sizer span alone.
     */
    function expandInput(input) {
        const wrap  = input.closest('.auto-input-wrap');
        const sizer = wrap.querySelector('.sizer');
        const isFull = wrap.classList.contains('full');

        // Full-width inputs always stretch to 100% — nothing to compute
        if (isFull) {
            sizer.textContent = input.value || '\u00a0';
            return;
        }

        const value = input.value;
        const PADDING = 12; // matches padding: 0 0.35rem on each side

        // Measure text width with canvas for pixel-perfect accuracy
        const canvas  = expandInput._canvas || (expandInput._canvas = document.createElement('canvas'));
        const ctx     = canvas.getContext('2d');
        const style   = window.getComputedStyle(input);
        ctx.font      = `${style.fontWeight} ${style.fontSize} ${style.fontFamily}`;
        const textWidth = value.length ? ctx.measureText(value).width : 0;

        // Desired wrapper width = text + padding, clamped to [minWidth, containerWidth]
        const minWidth     = parseFloat(window.getComputedStyle(wrap).minWidth) || 40;
        const container    = wrap.closest('p') || wrap.closest('li') || wrap.closest('.kasulatan-wrapper');
        const containerWidth = container ? container.clientWidth : wrap.parentElement.clientWidth;

        const desired = Math.min(Math.max(textWidth + PADDING * 2, minWidth), containerWidth);

        wrap.style.width  = desired + 'px';
        sizer.textContent = value || '\u00a0';
    }

    /**
     * Format a Date as "Month DD, YYYY" in Filipino/English style.
     * e.g. "Mayo 18, 2026"
     */
    function todayFormatted() {
        const months = [
            'Enero','Pebrero','Marso','Abril','Mayo','Hunyo',
            'Hulyo','Agosto','Setyembre','Oktubre','Nobyembre','Disyembre'
        ];
        const d = new Date();
        return `${months[d.getMonth()]} ${d.getDate()}, ${d.getFullYear()}`;
    }

    document.addEventListener('DOMContentLoaded', function () {
        // 1. Fill today's date into all .js-today inputs
        const today = todayFormatted();
        document.querySelectorAll('.js-today').forEach(function (input) {
            input.value = today;
        });

        // 2. Run expandInput on every auto-expanding input (including pre-filled & today fields)
        document.querySelectorAll('.auto-input-wrap input').forEach(function (input) {
            expandInput(input);
        });
    });
</script>

@endsection