




@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        {{-- Change Password Card --}}
        <div class="col-md-8 mb-4">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="card shadow rounded-4">
                <div class="card-header text-center fw-bold fs-4">Change Password</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.changePassword') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" required>
                            @error('old_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- 2FA Card --}}
        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
        <div class="col-md-8 mb-4">
            <div class="card shadow rounded-4">
                <div class="card-header text-center fw-bold fs-4">Two-Factor Authentication (2FA)</div>

                <div class="card-body text-center">
                    @if (! auth()->user()->two_factor_secret)
                        <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                            @csrf
                            <button type="submit" class="btn btn-success">Enable 2FA</button>
                        </form>
                    @else
                        <p class="mb-3">Scan this QR code using your Authenticator App (e.g., Microsoft Authenticator or Google Authenticator):</p>
                        <div class="mb-4">{!! auth()->user()->twoFactorQrCodeSvg() !!}</div>

                        <form method="POST" action="{{ url('/user/confirmed-two-factor-authentication') }}" class="mb-3">
                            @csrf
                            <input type="text" name="code" placeholder="Enter 6-digit code" class="form-control mb-2 w-50 mx-auto" required>
                            <button type="submit" class="btn btn-primary">Confirm 2FA</button>
                        </form>

                        <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Disable 2FA</button>
                        </form>
                    @endif
                </div>


                @if (session('status'))
                    <div class="text-center alert alert-success">{{ session('status') }}</div>
                @endif

                @if ($errors->any())
                    <div class="text-center alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

            </div>
        </div>
        @endif
    </div>
</div>
@endsection
