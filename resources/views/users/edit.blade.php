@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <!-- <h3>{{ __('Edit') }} {{ __('User') }}</h3> -->
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">
        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center gap-3">

                {{-- Name --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('name', __('Name'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::text('name', null, ['class' => 'form-control rounded', 'required']) !!}
                </div>

                {{-- Email --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('email', __('Email'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::email('email', null, ['class' => 'form-control rounded', 'required']) !!}
                </div>

                <!-- {{-- Password --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('password', __('Password'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::password('password', ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Confirm Password --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('password_confirmation', __('Confirm Password'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control rounded']) !!}
                </div> -->

                {{-- Mobile --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('mobile', __('Mobile'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::text('mobile', null, ['class' => 'form-control rounded', 'required']) !!}
                </div>

                {{-- UAE ID --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('uae_id', __('ID Number'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::text('uae_id', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Nationality --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('nat', __('Nationality'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::select('nat', $nationalities ?? [], null, ['class' => 'form-control rounded', 'placeholder' => __('-- Select Type --')]) !!}
                </div>

                {{-- City --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('city', __('City'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::select('city', $regions, null, ['class' => 'form-control rounded', 'placeholder' => __('-- Select Type --'), 'required']) !!}
                </div>

                {{-- Role --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('role_id', __('Role'), ['class' => 'font-semibold text-gray-600']) !!}
                    {!! Form::select('role_id', $roles, null, ['class' => 'form-control rounded', 'placeholder' => __('-- Select Type --'), 'required']) !!}
                </div>

                {{-- Gender --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('sex', __('Gender'), ['class' => 'font-semibold text-gray-600']) !!}
                    <div class="mt-2 d-flex gap-3">
                        <label>{!! Form::radio('sex', 1, $user->sex == 1) !!} {{ __('Male') }}</label>
                        <label>{!! Form::radio('sex', 0, $user->sex == 0) !!} {{ __('Female') }}</label>
                    </div>
                </div>

                {{-- Active --}}
                <div class="flex-grow-1 d-flex align-items-center gap-2" style="min-width: 250px;max-width: 250px;">
                    {!! Form::hidden('Active', 0) !!}
                    {!! Form::checkbox('Active', 1, old('Active', $user->Active)) !!}
                    <label>{{ __('Active') }}</label>
                </div>

            </div>
        </div>

        {{-- Buttons --}}
        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('Save'), [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;'
            ]) !!}
            <a href="{{ route('users.index') }}" class="btn btn-olive btn-sm"
               style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;">
                <i class="fas fa-list me-1"></i> {{ __('List') }}
            </a>

            {{-- Edit Files Button --}}
            <a href="{{ url('users/'.$user->id.'/attachments/create?type=users') }}"
               class="btn btn-warning btn-sm"
               style="background-color: #d4af37; color: #2f3a1f; font-weight:600;">
                <i class="fas fa-file-upload me-1"></i> {{ __('Edit Files') }}
            </a>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('styles')
<style>
.btn-olive {
    background-color: #2f3a1f;
    border: 1px solid #2f3a1f;
    color: #d4af37;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-olive:hover {
    background-color: #3e4a29;
    border-color: #d4af37;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(212,175,55,0.35);
}
</style>
@endpush

@push('scripts')
@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
});
</script>
@endif
@endpush
