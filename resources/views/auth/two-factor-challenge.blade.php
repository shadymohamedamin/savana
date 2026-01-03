<!-- {{-- resources/views/auth/two-factor-challenge.blade.php --}}
<form method="POST" action="{{ route('two-factor.login.store') }}">
    @csrf

    <div>
        <label for="code">Authentication Code</label>
        <input id="code" type="text" name="code" required autofocus>
    </div>

    <div class="mt-4">
        <button type="submit">Login</button>
    </div>
</form> -->
@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-6">
        <div class="card shadow rounded-4">
            <div class="card-header text-center bg-primary text-white fs-4 fw-bold">
                Two-Factor Authentication
            </div>

            <div class="card-body">
                <p class="text-center mb-4">
                    Please enter the 6-digit authentication code from your authenticator app.
                </p>

                @if (session('status'))
                    <div class="alert alert-success text-center">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger text-center">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('two-factor.login.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="code" class="form-label">Authentication Code</label>
                        <input 
                            id="code" 
                            type="text" 
                            name="code" 
                            class="form-control text-center @error('code') is-invalid @enderror" 
                            required 
                            autofocus 
                            maxlength="6" 
                            placeholder="123456"
                        >
                        @error('code')
                            <div class="invalid-feedback text-center">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            Verify & Login
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="{{ route('login') }}" class="text-decoration-none">Back to login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
