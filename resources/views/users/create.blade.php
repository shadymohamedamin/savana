@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <!-- <h3>{{ __('Create') }} {{ __('Users') }}</h3> -->
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

   

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">
    {!! Form::open(['route' => 'users.store']) !!}

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
                {!! Form::email('email', null, ['class' => 'form-control rounded', ]) !!}
            </div>

            {{-- Password --}}
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('password', __('Password'), ['class' => 'font-semibold text-gray-600']) !!}
                {!! Form::password('password', ['class' => 'form-control rounded', ]) !!}
            </div>

            {{-- Confirm Password --}}
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('password_confirmation', __('Confirm Password'), ['class' => 'font-semibold text-gray-600']) !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control rounded', ]) !!}
            </div>

            {{-- Mobile --}}
            {{-- Mobile --}}
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('mobile', __('Mobile')) !!}
                {!! Form::text('mobile', null, [
                    'class' => 'form-control',
                    'placeholder' => '05XXXXXXXXX',
                    'inputmode' => 'numeric',
                    'autocomplete' => 'off'
                ]) !!}
            </div>

            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('uae_id', __('ID Number')) !!}
                {!! Form::text('uae_id', null, [
                    'class' => 'form-control',
                    'placeholder' => '784-XXXX-XXXXXXX-X',
                    'inputmode' => 'numeric',
                    'autocomplete' => 'off'
                ]) !!}
            </div>

{{-- Role --}}
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('role_id', __('Role'), ['class' => 'font-semibold text-gray-600']) !!}
                {!! Form::select('role_id', $roles, $roleId ?? null, ['class' => 'form-control rounded', 'placeholder' => __('-- Select Type --'), 'required']) !!}
            </div>
            
            {{-- Nationalitystyle="min-width: 250px;max-width: 250px; --}}
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('nat', __('Nationality'), ['class' => 'font-semibold text-gray-600']) !!}
                {!! Form::select('nat', $nationalities ?? [], null, ['class' => 'form-control rounded', 'placeholder' => __('-- Select Type --')]) !!}
            </div>

            {{-- City --}}
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('city', __('City'), ['class' => 'font-semibold text-gray-600']) !!}
                {!! Form::select('city', $regions, null, ['class' => 'form-control rounded', 'placeholder' => __('-- Select Type --'), 'required']) !!}
            </div>

            


            {{-- Contractor Extra Fields --}}
            {{-- Contractor Extra Fields --}}
<div id="contractor-fields"
     class="d-none w-100 flex-wrap gap-3">

    <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
        {!! Form::label('responsible_name', __('اسم المسؤول')) !!}
        {!! Form::text('responsible_name', null, ['class' => 'form-control rounded']) !!}
    </div>

    <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
        {!! Form::label('manager_name', __('اسم المدير')) !!}
        {!! Form::text('manager_name', null, ['class' => 'form-control rounded']) !!}
    </div>

    <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
        {!! Form::label('license_number', __('رقم الرخصة')) !!}
        {!! Form::text('license_number', null, ['class' => 'form-control rounded']) !!}
    </div>

</div>

            {{-- 
            <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                {!! Form::label('sex', __('Gender'), ['class' => 'font-semibold text-gray-600']) !!}
                <div class="mt-2 d-flex gap-3">
                    <label>{!! Form::radio('sex', 1, true) !!} {{ __('Male') }}</label>
                    <label>{!! Form::radio('sex', 0, false) !!} {{ __('Female') }}</label>
                </div>
            </div>--}}
            {!! Form::hidden('sex', 1) !!}
            {{-- Active --}}
            <div class="flex-grow-1 d-flex align-items-center gap-2" style="min-width: 250px;max-width: 250px;">
                {!! Form::hidden('Active', 0) !!}
                {!! Form::checkbox('Active', 1, old('Active', 1)) !!}
                <label>{{ __('Active') }}</label>
            </div>
            

        </div>
    </div>

    {{-- Buttons --}}
    <div class="card-footer d-flex justify-content-center gap-3">
        {!! Form::submit(__('Save User And Add Files'), [
            'class' => 'btn btn-olive btn-sm',
            'style' => 'background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;'
        ]) !!}
        <a href="{{ route('users.index') }}" class="btn btn-olive btn-sm"
           style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;">
            <i class="fas fa-list me-1"></i> {{ __('List') }}
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

<script>
document.querySelector('form').addEventListener('submit', function (e) {
    const formData = new FormData(this);
    for (let pair of formData.entries()) {
        console.log(pair[0]+ ': ' + pair[1]);
    }
});
</script>









<!-- <script>
document.addEventListener('input', function (e) {

    /* ================= UAE ID ================= */
    if (e.target.name === 'uae_id') {
        let v = e.target.value.replace(/\D/g, '');

        // لازم يبدأ بـ 784
        if (!v.startsWith('784')) {
            v = '784';
        }

        v = v.substring(0, 15); // 15 digits max

        let result = '';
        if (v.length > 0) result = v.substring(0,3);
        if (v.length > 3) result += '-' + v.substring(3,7);
        if (v.length > 7) result += '-' + v.substring(7,14);
        if (v.length > 14) result += '-' + v.substring(14,15);

        e.target.value = result;
    }

    /* ================= MOBILE ================= */
    if (e.target.name === 'mobile') {
        let v = e.target.value.replace(/\D/g, '');

        // لازم يبدأ بـ 05
        if (!v.startsWith('05')) {
            v = '05';
        }

        v = v.substring(0, 10); // 10 digits only
        e.target.value = v;
    }

});
</script> 
 -->









@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.querySelector('select[name="role_id"]');
    const contractorFields = document.getElementById('contractor-fields');

    function toggleFields() {
        if (roleSelect.value === '3') {
            contractorFields.classList.remove('d-none');
            contractorFields.classList.add('d-flex');
        } else {
            contractorFields.classList.remove('d-flex');
            contractorFields.classList.add('d-none');
        }
    }

    // on page load (edit)
    toggleFields();

    // on change
    roleSelect.addEventListener('change', toggleFields);
});
</script>
@endpush





@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.querySelector('select[name="role_id"]');
    const contractorFields = document.getElementById('contractor-fields');

    const nationalitySelect = document.querySelector('select[name="nat"]');
    const nationalityWrapper = nationalitySelect.closest('.form-group') 
        || nationalitySelect.closest('div');

    function toggleFields() {
        if (roleSelect.value === '3') {
            // show contractor fields
            contractorFields.classList.remove('d-none');
            contractorFields.classList.add('d-flex');

            // hide nationality + set default to 66
            nationalitySelect.value = '66';
            nationalityWrapper.classList.add('d-none');

        } else {
            // hide contractor fields
            contractorFields.classList.remove('d-flex');
            contractorFields.classList.add('d-none');

            // show nationality
            nationalityWrapper.classList.remove('d-none');
        }
    }

    // on page load (edit)
    toggleFields();

    // on change
    roleSelect.addEventListener('change', toggleFields);
});
</script>
@endpush
