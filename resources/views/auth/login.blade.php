<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — DMW Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-8 col-md-5 col-lg-4">

            {{-- Logo --}}
            <div class="text-center mb-4">
                <h4 class="fw-bold text-primary mb-0">DMW Forms</h4>
                <small class="text-muted">Department of Migrant Workers</small>
            </div>

            {{-- Card --}}
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <i class="fas fa-user-circle fa-3x text-primary"></i>
                        <h6 class="fw-semibold mt-2 mb-0">Employee Portal</h6>
                        <small class="text-muted">Sign in to your account</small>
                    </div>

                    {{-- Errors --}}
                    @if ($errors->any())
                        <!-- <div class="alert alert-danger alert-dismissible fade show py-2 px-3" role="alert">
                            <small><i class="fas fa-exclamation-circle me-1"></i>{{ $errors->first() }}</small>
                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                        </div> -->
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="emp_email" class="form-label fw-medium small">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-envelope text-muted small"></i>
                                </span>
                                <input
                                    type="email"
                                    id="emp_email"
                                    name="emp_email"
                                    class="form-control border-start-0 ps-0 @error('emp_email') is-invalid @enderror"
                                    placeholder="you@dmw.gov.ph"
                                    value="{{ old('emp_email') }}"
                                    required
                                    autofocus
                                    autocomplete="email"
                                >
                                @error('emp_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label for="emp_password" class="form-label fw-medium small">Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-lock text-muted small"></i>
                                </span>
                                <input
                                    type="password"
                                    id="emp_password"
                                    name="emp_password"
                                    class="form-control border-start-0 ps-0 border-end-0 @error('emp_password') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password"
                                >
                                <button
                                    class="input-group-text bg-light border-start-0"
                                    type="button"
                                    onclick="togglePw()"
                                    tabindex="-1"
                                >
                                    <i id="pw-icon" class="fas fa-eye text-muted small"></i>
                                </button>
                                @error('emp_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Remember + Submit --}}
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label small text-muted" for="remember">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot password?</a>
                            @endif
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-1"></i> Login
                            </button>
                        </div>

                    </form>

                </div>
            </div>

            {{-- Register link --}}
            @if (Route::has('register'))
                <p class="text-center mt-3 small text-muted">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Register here</a>
                </p>
            @endif

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-YUe2LzmU6ypSRNcCFxHFqaIFxpV3x26vVsa3qNBaFKfh0bNGEpfHOdGH3XbTXKk" crossorigin="anonymous"></script>
<script>
    function togglePw() {
        const input = document.getElementById('emp_password');
        const icon  = document.getElementById('pw-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

</body>
</html>