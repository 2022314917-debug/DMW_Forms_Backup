{{--
    resources/views/partials/multi-step-nav.blade.php
    ─────────────────────────────────────────────────
    Drop ONE line inside every form view, just before </form>:

        @include('partials.multi-step-nav')

    The controller already passes: $currentStep, $totalSteps, $steps, $prevUrl, $encryptedId
    No changes needed in the blade views beyond that one @include line.
--}}

@php
    $stepLabels = collect($steps)->map(fn($s) => match(true) {
        str_contains($s, 'RFA')          => 'RFA',
        str_contains($s, 'SENA')         => 'SENA',
        str_contains($s, 'AKSYON')       => 'Aksyon',
        str_contains($s, 'PROCESSING')   => 'Processing',
        str_contains($s, 'REQUIREMENTS') => 'Requirements',
        default => \Str::limit(\Str::title(\Str::lower($s)), 12),
    });
@endphp

<style>
/* ── Stepper ─────────────────────────────────────────────── */
.ms-stepper {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    margin-bottom: 1.5rem;
    overflow-x: auto;
    padding-bottom: 0.25rem;
}
.ms-step {
    display: flex;
    align-items: center;
    flex: 1;
    min-width: 0;
}
.ms-step-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.ms-dot {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #e5e7eb;
    color: #6b7280;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
    flex-shrink: 0;
    transition: background 0.2s;
}
.ms-step.active .ms-dot { background: #1a56db; color: #fff; }
.ms-step.done   .ms-dot { background: #16a34a; color: #fff; }
.ms-label {
    font-size: 10px;
    color: #6b7280;
    text-align: center;
    margin-top: 4px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 64px;
}
.ms-step.active .ms-label { color: #1a56db; font-weight: 700; }
.ms-step.done   .ms-label { color: #16a34a; }
.ms-line {
    flex: 1;
    height: 2px;
    background: #e5e7eb;
    margin: 0 4px;
    flex-shrink: 0;
    min-width: 16px;
    /* vertically centre the line with the dot (15px = half of 30px dot) */
    margin-bottom: calc(10px + 4px + 1em);   /* label height approx */
}
.ms-step.done + .ms-step .ms-line,
.ms-step.done .ms-line { background: #16a34a; }

/* ── Nav row ─────────────────────────────────────────────── */
.ms-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
    padding-top: 1.25rem;
    border-top: 1px solid #dee2e6;
}
.ms-btn-back {
    color: #374151;
    text-decoration: none;
    padding: 9px 20px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 14px;
    background: #fff;
    display: inline-block;
    transition: background 0.15s;
}
.ms-btn-back:hover { background: #f9fafb; color: #374151; }
.ms-step-count { font-size: 12px; color: #6b7280; }
.ms-btn-next {
    background: #2d7a2d;
    color: #fff;
    border: none;
    padding: 9px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s;
}
.ms-btn-next:hover { background: #245e24; }
</style>

{{-- ── Progress stepper ──────────────────────────────────────── --}}
<div class="ms-stepper">
    @foreach ($stepLabels as $i => $label)
        @php $num = $i + 1; @endphp
        <div class="ms-step {{ $currentStep === $num ? 'active' : ($currentStep > $num ? 'done' : '') }}">
            <div class="ms-step-inner">
                <div class="ms-dot">
                    @if ($currentStep > $num)
                        {{-- checkmark --}}
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M2.5 7L5.5 10L11.5 4" stroke="currentColor" stroke-width="2"
                                  stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @else
                        {{ $num }}
                    @endif
                </div>
                <div class="ms-label">{{ $label }}</div>
            </div>
            @if (!$loop->last)
                <div class="ms-line"></div>
            @endif
        </div>
    @endforeach
</div>

{{-- ── Hidden fields (needed by store methods that read current_step) ── --}}
<input type="hidden" name="request_id"   value="{{ $encryptedId }}">
<input type="hidden" name="current_step" value="{{ $currentStep }}">

{{-- ── Back / step-count / Next nav row ────────────────────────────── --}}
<div class="ms-nav">
    @if (!empty($prevUrl))
        <a href="{{ $prevUrl }}" class="ms-btn-back">← Back</a>
    @else
        <span></span>  {{-- keeps flexbox spacing when there is no Back button --}}
    @endif

    <span class="ms-step-count">Step {{ $currentStep }} of {{ $totalSteps }}</span>

    {{-- The submit button. Each form view wraps this partial inside its own
         <form> so type="submit" will submit that form. Each form's own JS
         (e.g. senaNext / validateAndSubmit) already handles validation
         and calls form.submit() — this button is the visible trigger. --}}
    <button type="submit" class="ms-btn-next">
        {{ $currentStep === $totalSteps ? 'Submit ✓' : 'Save & Next →' }}
    </button>
</div>