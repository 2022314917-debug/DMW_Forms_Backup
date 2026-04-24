<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — DMW Forms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #eeecec;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            padding: 1rem;
        }

        .login-wrapper {
            display: flex;
            width: 100%;
            max-width: 900px;
            min-height: 520px;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 12px 48px rgba(30, 60, 120, 0.15);
        }

        /* ── LEFT PANEL ── */
        .panel-left {
            flex: 1;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 3rem 2rem;
            gap: 1.5rem;
        }

        .panel-left img.dmw-logo {
            width: 350px;
            height: 450px;
            object-fit: contain;
        }


        /* ── RIGHT PANEL ── */
        .panel-right {
            flex: 1;
            background: #dde8f5;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2.5rem 2rem;
        }

        .form-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 2.5rem 2rem;
            width: 100%;
            max-width: 360px;
            box-shadow: 0 4px 24px rgba(30, 60, 120, 0.10);
        }

        .avatar-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 0.5rem;
        }

        .avatar-icon {
            width: 64px;
            height: 64px;
            background: #b8c9e8;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .avatar-icon svg {
            width: 40px;
            height: 40px;
            fill: #7a9cc8;
        }

        .portal-title {
            font-size: 0.80rem;
            font-weight: 700;
            letter-spacing: 0.12em;
            color: #2c3e6b;
            text-transform: uppercase;
        }

        /* Fields */
        .field-label {
            font-size: 0.78rem;
            font-weight: 500;
            color: #4a5568;
            margin-bottom: 0.35rem;
            display: block;
        }

        .field-group {
            display: flex;
            align-items: center;
            border: 1.5px solid #c9d8ed;
            border-radius: 10px;
            background: #f5f8fc;
            overflow: hidden;
            transition: border-color 0.2s;
        }

        .field-group:focus-within {
            border-color: #3b6abf;
            background: #fff;
        }

        .field-icon {
            padding: 0 0.75rem;
            color: #8fa8c8;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
        }

        .field-group input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 0.65rem 0.5rem 0.65rem 0;
            font-size: 0.85rem;
            font-family: 'Poppins', sans-serif;
            color: #2c3e6b;
            outline: none;
        }

        .field-group input::placeholder {
            color: #b0bdd0;
            font-size: 0.80rem;
        }

        .toggle-pw {
            background: transparent;
            border: none;
            padding: 0 0.75rem;
            color: #8fa8c8;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .toggle-pw:hover { color: #3b6abf; }

        .mb-field { margin-bottom: 1rem; }

        /* Validation */
        .field-group.is-invalid-group {
            border-color: #e74c3c;
        }

        .invalid-msg {
            font-size: 0.75rem;
            color: #e74c3c;
            margin-top: 0.25rem;
        }

        /* Submit button */
        .btn-signin {
            width: 100%;
            padding: 0.70rem;
            background: #2c5fba;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 0.88rem;
            font-weight: 600;
            letter-spacing: 0.03em;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
            margin-top: 0.25rem;
        }

        .btn-signin:hover { background: #1e4a9a; }
        .btn-signin:active { transform: scale(0.98); }

        .forgot-link {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.78rem;
            color: #5a6a80;
        }

        .forgot-link a {
            color: #2c7be5;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link a:hover { text-decoration: underline; }



        /* Responsive — stack on mobile */
        @media (max-width: 640px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 400px;
            }

            .panel-left {
                padding: 2rem 1.5rem 1.5rem;
                gap: 1rem;
            }

            .panel-left img.dmw-logo { width: 120px; height: 120px; }

            .panel-right {
                padding: 1.5rem 1rem 2rem;
            }
        }
    </style>
</head>
<body>

<div class="login-wrapper">

    {{-- ── LEFT PANEL ── --}}
    <div class="panel-left">

        <img
            class="dmw-logo"
            src="{{ asset('images/dmwro3.jpg') }}"
            alt="Department of Migrant Workers – Region III"
            onerror="this.style.display='none'"
        >


    </div>

    {{-- ── RIGHT PANEL ── --}}
    <div class="panel-right">
        <div class="form-card">

            {{-- Avatar + title --}}
            <div class="avatar-wrap">
                <div class="avatar-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
                    </svg>
                </div>
                <span class="portal-title">Employee Portal</span>
            </div>

            {{-- Errors --}}
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show py-2 px-3 mb-3" role="alert" style="font-size:0.78rem; border-radius:10px;">
                    <i class="fas fa-exclamation-circle me-1"></i>{{ $errors->first() }}
                    <button type="button" class="btn-close btn-sm" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('login.store') }}" method="POST">
                @csrf

                {{-- Email --}}
                <div class="mb-field">
                    <label for="emp_email" class="field-label">Email Address</label>
                    <div class="field-group {{ $errors->has('emp_email') ? 'is-invalid-group' : '' }}">
                        <span class="field-icon"><i class="fas fa-envelope"></i></span>
                        <input
                            type="email"
                            id="emp_email"
                            name="emp_email"
                            placeholder="Ex. KopikoBrown@gmail.com"
                            value="{{ old('emp_email') }}"
                            required
                            autofocus
                            autocomplete="email"
                        >
                    </div>
                    @error('emp_email')
                        <div class="invalid-msg">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-field">
                    <label for="emp_password" class="field-label">Password</label>
                    <div class="field-group {{ $errors->has('emp_password') ? 'is-invalid-group' : '' }}">
                        <span class="field-icon"><i class="fas fa-lock"></i></span>
                        <input
                            type="password"
                            id="emp_password"
                            name="emp_password"
                            placeholder="••••••••••••"
                            required
                            autocomplete="current-password"
                        >
                        <button class="toggle-pw" type="button" onclick="togglePw()" tabindex="-1">
                            <i id="pw-icon" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('emp_password')
                        <div class="invalid-msg">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-signin">
                    Sign up
                </button>

            </form>

            {{-- Forgot password --}}
            @if (Route::has('password.request'))
                <div class="forgot-link">
                    Forgot password? <a href="{{ route('password.request') }}">Click here.</a>
                </div>
            @endif



        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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