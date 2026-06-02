{{-- Stepper progress bar + navigation buttons --}}
{{-- Required variables (all passed by controller): --}}
{{--   $currentStep, $totalSteps, $encryptedId, $steps (array of form labels), $prevUrl --}}

@php
    // $steps, $currentStep, $totalSteps, $encryptedId, $prevUrl
    // are ALL passed directly from the controller — do NOT read from session.

    $stepLabels = collect($steps)->map(fn($s) => match(true) {
        str_contains($s, 'RFA')          => 'RFA Form',
        str_contains($s, 'VERIFICATION') => 'OFW Records',
        str_contains($s, 'SENA')         => 'SENA',
        str_contains($s, 'ELPOR')        => 'ELPOR',
        default => \Str::limit(\Str::title(\Str::lower($s)), 12),
    })->push('Requirements');

    // $prevUrl is already computed by the controller, used in ms-nav below
@endphp

<style>
.ms-stepper {
    display: flex;
    align-items: center;
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
.ms-step.active  .ms-dot { background: #1a56db; color: #fff; }
.ms-step.done    .ms-dot { background: #16a34a; color: #fff; }
.ms-label {
    font-size: 10px;
    color: #6b7280;
    text-align: center;
    margin-top: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 64px;
}
.ms-step.active .ms-label { color: #1a56db; font-weight: 700; }
.ms-step.done   .ms-label { color: #16a34a; }
.ms-step-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
}
.ms-line {
    flex: 1;
    height: 2px;
    background: #e5e7eb;
    margin: 0 4px;
    flex-shrink: 0;
    min-width: 16px;
}
.ms-step.done .ms-line { background: #16a34a; }
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
}
.ms-btn-back:hover { background: #f9fafb; color: #374151; }
.ms-btn-next {
    background: #2d7a2d;
    color: #fff;
    border: none;
    padding: 9px 24px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
}
.ms-btn-next:hover { background: #245e24; }
.ms-step-count {
    font-size: 12px;
    color: #6b7280;
}
</style>

{{-- Progress bar --}}
<div class="ms-stepper">
    @foreach ($stepLabels as $i => $label)
        @php $num = $i + 1; @endphp
        <div class="ms-step {{ $currentStep === $num ? 'active' : ($currentStep > $num ? 'done' : '') }}">
            <div class="ms-step-inner">
                <div class="ms-dot">
                    @if ($currentStep > $num)
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
            @if ($i < $stepLabels->count() - 1)
                <div class="ms-line"></div>
            @endif
        </div>
    @endforeach
</div>

{{-- Hidden fields injected into the parent <form> --}}
<input type="hidden" name="request_id"   value="{{ $encryptedId }}">
<input type="hidden" name="current_step" value="{{ $currentStep }}">