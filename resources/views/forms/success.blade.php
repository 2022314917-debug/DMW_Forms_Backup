@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg border-0 text-center" style="max-width: 500px; width: 100%;">
        
        <div class="card-body p-5">
            
            <div class="mb-4">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            </div>

            <h3 class="fw-bold text-success">Request Submitted Successfully!</h3>
            <p class="text-muted mt-3">
                Your request has been received. Would you like to submit another request?
            </p>

            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('forms.index') }}" class="btn btn-success px-4">
                    Yes, Submit Another
                </a>

                <a href="{{ route('about') }}" class="btn btn-outline-secondary px-4">
                    No, Go to About
                </a>
            </div>

        </div>
    </div>
</div>
@endsection