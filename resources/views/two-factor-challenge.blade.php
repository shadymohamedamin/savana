@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h4 class="mb-4">Two-Factor Authentication</h4>
    <form method="POST" action="{{ route('two-factor.login') }}">
        @csrf

        <div class="mb-3">
            <label for="code" class="form-label">Authentication Code</label>
            <input type="text" name="code" id="code" class="form-control" required autofocus>
        </div>

        <div class="mb-3">
            <label for="recovery_code" class="form-label">Or use a recovery code</label>
            <input type="text" name="recovery_code" id="recovery_code" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Verify</button>
    </form>
</div>
@endsection
