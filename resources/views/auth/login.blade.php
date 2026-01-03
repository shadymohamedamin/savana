@extends('layouts.app')

@section('content')

<style>
/* ================== GLOBAL ================== */
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
}

/* ================== WRAPPER ================== */
.login-wrapper {
    display: flex;
    height: 100vh;
    width: 100%;
}

/* ================== LEFT IMAGE ================== */
.login-image-section {
    position: relative;
    width: 50%;
    height: 100vh;
    overflow: hidden;
}

.login-image-section img {
    width: 100%;
    height: 100%;
    object-fit: fit;
    animation: zoomMove 12s ease-in-out infinite;
}

.login-image-section::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
        rgba(0,0,0,0.4),
        rgba(0,0,0,0.6)
    );
}

/* Image animation */
@keyframes zoomMove {
    0%   { transform: scale(1); }
    50%  { transform: scale(1.8); }
    100% { transform: scale(1); }
}

/* ================== RIGHT FORM ================== */
.login-form-section {
    width: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    /*background: #f5f7fb;*/
    background:#f5f5dc;
}

/* ================== CARD ================== */
.login-card {
    width: 100%;
    max-width: 420px;
    padding: 40px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 25px 50px rgba(0,0,0,.12);
    animation: fadeUp .8s ease;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* ================== LOGO ================== */
.login-logo {
    max-width: 140px;
    max-height: 80px;
    object-fit: contain;
}

/* ================== INPUTS ================== */
.login-card label {
    font-weight: 500;
}

.login-card .form-control {
    border-radius: 12px;
    padding: 12px;
}

/* ================== BUTTON ================== */
.login-btn {
    padding: 12px;
    border-radius: 12px;
    font-weight: 600;
}

/* ================== LINKS ================== */
.forgot {
    font-size: 14px;
    text-decoration: none;
}

/* ================== RESPONSIVE ================== */
@media (max-width: 992px) {
    .login-image-section {
        display: none;
    }
    .login-form-section {
        width: 100%;
    }
}






/* ===== GOLD THEME ===== */

.login-btn {
    background: linear-gradient(135deg, #f9e076, #d4af37);
    border: none;
    color: #1f2937;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(212, 175, 55, 0.35);
}

.login-btn:hover {
    background: linear-gradient(135deg, #ffd700, #b8962e);
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(212, 175, 55, 0.5);
    color: #000;
}

/* Remember me checkbox */
.form-check-input {
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #d4af37;
    border-color: #d4af37;
}

.form-check-input:focus {
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.4);
}

/* Remember me text */
.form-check-label {
    color: #d4af37;
    font-weight: 500;
}

/* Forgot password */
.forgot {
    color: #d4af37;
    font-weight: 500;
    text-decoration: none;
    transition: color 0.3s ease;
}

.forgot:hover {
    color: #b8962e;
    text-decoration: underline;
}








</style>

<div class="login-wrapper">

    {{-- LEFT IMAGE --}}
    <div class="login-image-section">
        <img src="{{ asset('images/login-bg.jpg') }}" alt="Login Image">
    </div>

    {{-- RIGHT FORM --}}
    <div class="login-form-section">
        <div class="login-card">

            {{-- LOGO --}}
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" class="login-logo" alt="Logo">
                <h3 class="mt-3">Welcome Back</h3>
                <p class="text-muted">Login to your account</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password"
                           name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input">
                        <label class="form-check-label">Remember me</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn w-100 login-btn">
                    Login
                </button>

            </form>

        </div>
    </div>
</div>

@endsection
