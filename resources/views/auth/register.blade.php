@extends('layouts.guest')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">

            <div class="card shadow-sm border-0 mt-4 mb-5">
                <div class="card-header bg-white border-bottom py-3">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-user-plus me-2 text-primary"></i>
                        Employee Registration
                    </h4>
                    <small class="text-muted">Fill in the details below to create a new account.</small>
                </div>

                <div class="card-body p-4">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="fas fa-exclamation-circle me-1"></i> Please fix the following errors:</strong>
                            <ul class="mb-0 mt-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register.store') }}">
                        @csrf

                        {{-- ── Personal Information ── --}}
                        <h6 class="text-uppercase text-muted fw-semibold border-bottom pb-2 mb-3"
                            style="font-size:.7rem; letter-spacing:.08em;">
                            Personal Information
                        </h6>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label for="emp_lname" class="form-label fw-medium">
                                    Last Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="emp_lname" name="emp_lname"
                                    class="form-control @error('emp_lname') is-invalid @enderror"
                                    value="{{ old('emp_lname') }}" placeholder="Dela Cruz"
                                    required autocomplete="family-name">
                                @error('emp_lname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="emp_fname" class="form-label fw-medium">
                                    First Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="emp_fname" name="emp_fname"
                                    class="form-control @error('emp_fname') is-invalid @enderror"
                                    value="{{ old('emp_fname') }}" placeholder="Juan"
                                    required autocomplete="given-name">
                                @error('emp_fname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="emp_mname" class="form-label fw-medium">
                                    Middle Name <span class="text-muted fw-normal small">(optional)</span>
                                </label>
                                <input type="text" id="emp_mname" name="emp_mname"
                                    class="form-control @error('emp_mname') is-invalid @enderror"
                                    value="{{ old('emp_mname') }}" placeholder="Santos"
                                    autocomplete="additional-name">
                                @error('emp_mname')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-3">
                                <label for="emp_ename" class="form-label fw-medium">
                                    Extension Name <span class="text-muted fw-normal small">(Jr., Sr.…)</span>
                                </label>
                                <input type="text" id="emp_ename" name="emp_ename"
                                    class="form-control @error('emp_ename') is-invalid @enderror"
                                    value="{{ old('emp_ename') }}" placeholder="Jr.">
                                @error('emp_ename')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="emp_gender" class="form-label fw-medium">
                                    Gender <span class="text-danger">*</span>
                                </label>
                                <select id="emp_gender" name="emp_gender"
                                    class="form-select @error('emp_gender') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('emp_gender') ? '' : 'selected' }}>Select…</option>
                                    <option value="Male"   {{ old('emp_gender') === 'Male'   ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('emp_gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other"  {{ old('emp_gender') === 'Other'  ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('emp_gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="emp_bday" class="form-label fw-medium">
                                    Date of Birth <span class="text-danger">*</span>
                                </label>
                                <input type="date" id="emp_bday" name="emp_bday"
                                    class="form-control @error('emp_bday') is-invalid @enderror"
                                    value="{{ old('emp_bday') }}" required>
                                @error('emp_bday')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3">
                                <label for="emp_contact_no" class="form-label fw-medium">
                                    Contact Number <span class="text-danger">*</span>
                                </label>
                                <input type="tel" id="emp_contact_no" name="emp_contact_no"
                                    class="form-control @error('emp_contact_no') is-invalid @enderror"
                                    value="{{ old('emp_contact_no') }}" placeholder="09XX-XXX-XXXX"
                                    required autocomplete="tel">
                                @error('emp_contact_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Employment Details ── --}}
                        <h6 class="text-uppercase text-muted fw-semibold border-bottom pb-2 mb-3 mt-4"
                            style="font-size:.7rem; letter-spacing:.08em;">
                            Employment Details
                        </h6>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="division_id" class="form-label fw-medium">
                                    Division <span class="text-danger">*</span>
                                </label>
                                <select id="division_id" name="division_id"
                                    class="form-select @error('division_id') is-invalid @enderror" required>
                                    <option value="" disabled {{ old('division_id') ? '' : 'selected' }}>Select division…</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}"
                                            {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                            {{ $division->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('division_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="emp_position" class="form-label fw-medium">
                                    Position <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="emp_position" name="emp_position"
                                    class="form-control @error('emp_position') is-invalid @enderror"
                                    value="{{ old('emp_position') }}" placeholder="e.g. Software Engineer"
                                    required>
                                @error('emp_position')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- ── Account Credentials ── --}}
                        <h6 class="text-uppercase text-muted fw-semibold border-bottom pb-2 mb-3 mt-4"
                            style="font-size:.7rem; letter-spacing:.08em;">
                            Account Credentials
                        </h6>

                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="emp_email" class="form-label fw-medium">
                                    Work Email <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="emp_email" name="emp_email"
                                    class="form-control @error('emp_email') is-invalid @enderror"
                                    value="{{ old('emp_email') }}" placeholder="you@company.com"
                                    required autocomplete="email">
                                @error('emp_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="emp_password" class="form-label fw-medium">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" id="emp_password" name="emp_password"
                                        class="form-control @error('emp_password') is-invalid @enderror"
                                        placeholder="Min. 8 characters"
                                        required autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePw('emp_password', this)" tabindex="-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    @error('emp_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="emp_password_confirmation" class="form-label fw-medium">
                                    Confirm Password <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="password" id="emp_password_confirmation"
                                        name="emp_password_confirmation"
                                        class="form-control"
                                        placeholder="Re-enter password"
                                        required autocomplete="new-password">
                                    <button class="btn btn-outline-secondary" type="button"
                                        onclick="togglePw('emp_password_confirmation', this)" tabindex="-1">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- ── Actions ── --}}
                        <hr class="my-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <a href="{{ route('login') }}" class="text-muted text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i> Back to Login
                            </a>
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-user-check me-2"></i> Create Account
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function togglePw(id, btn) {
        const input = document.getElementById(id);
        const icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>
@endsection