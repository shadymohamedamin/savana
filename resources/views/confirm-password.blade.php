@extends('layouts.app')

@section('content')
<div class="container mt-5">             
    <div class="row justify-content-center">         
        <div class="col-md-6">
            <div class="card shadow rounded-4">
                <div class="card-header text-center fw-bold fs-4">Confirm Your Password</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" name="password" required class="form-control @error('password') is-invalid @enderror">

                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
