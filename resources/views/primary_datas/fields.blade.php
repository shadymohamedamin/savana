<!-- Accomodation Field
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('Accomodation', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('Accomodation', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('Accomodation', 'Accomodation', ['class' => 'form-check-label']) !!}
    </div>
</div>


<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('Approved', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('Approved', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('Approved', 'Approved', ['class' => 'form-check-label']) !!}
    </div>
</div>


<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('Cancel', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('Cancel', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('Cancel', 'Cancel', ['class' => 'form-check-label']) !!}
    </div>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Career', 'Career:') !!}
    {!! Form::number('Career', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('CareerAddress', 'Careeraddress:') !!}
    {!! Form::text('CareerAddress', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('CaseDate', 'Casedate:') !!}
    {!! Form::text('CaseDate', null, ['class' => 'form-control','id'=>'CaseDate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#CaseDate').datepicker()
    </script>
@endpush


<div class="form-group col-sm-6">
    {!! Form::label('DateOfBirth', 'Dateofbirth:') !!}
    {!! Form::text('DateOfBirth', null, ['class' => 'form-control','id'=>'DateOfBirth']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#DateOfBirth').datepicker()
    </script>
@endpush


<div class="form-group col-sm-6">
    {!! Form::label('Email', 'Email:') !!}
    {!! Form::email('Email', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('FamilyCount', 'Familycount:') !!}
    {!! Form::number('FamilyCount', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('FileNo', 'Fileno:') !!}
    {!! Form::number('FileNo', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('HeadRemarks', 'Headremarks:') !!}
    {!! Form::textarea('HeadRemarks', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('HouseType', 'Housetype:') !!}
    {!! Form::number('HouseType', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('IBAN', 'Iban:') !!}
    {!! Form::text('IBAN', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('IDExpiry', 'Idexpiry:') !!}
    {!! Form::text('IDExpiry', null, ['class' => 'form-control','id'=>'IDExpiry']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#IDExpiry').datepicker()
    </script>
@endpush


<div class="form-group col-sm-6">
    {!! Form::label('IDNo', 'Idno:') !!}
    {!! Form::text('IDNo', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('InSchool', 'Inschool:') !!}
    {!! Form::number('InSchool', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('LastUpdate', 'Lastupdate:') !!}
    {!! Form::text('LastUpdate', null, ['class' => 'form-control','id'=>'LastUpdate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#LastUpdate').datepicker()
    </script>
@endpush


<div class="form-group col-sm-6">
    {!! Form::label('MaritalStatus', 'Maritalstatus:') !!}
    {!! Form::number('MaritalStatus', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('mob', 'Mob:') !!}
    {!! Form::text('mob', null, ['class' => 'form-control', 'maxlength' => 10, 'maxlength' => 10]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Nam', 'Nam:') !!}
    {!! Form::text('Nam', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('NamEn', 'Namen:') !!}
    {!! Form::text('NamEn', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Nationality', 'Nationality:') !!}
    {!! Form::number('Nationality', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('Permission_Date', 'Permission Date:') !!}
    {!! Form::text('Permission_Date', null, ['class' => 'form-control','id'=>'Permission_Date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#Permission_Date').datepicker()
    </script>
@endpush

<div class="form-group col-sm-6">
    {!! Form::label('Permission_No', 'Permission No:') !!}
    {!! Form::number('Permission_No', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Region', 'Region:') !!}
    {!! Form::number('Region', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Renew_Date', 'Renew Date:') !!}
    {!! Form::text('Renew_Date', null, ['class' => 'form-control','id'=>'Renew_Date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#Renew_Date').datepicker()
    </script>
@endpush


<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('Revised', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('Revised', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('Revised', 'Revised', ['class' => 'form-check-label']) !!}
    </div>
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Section', 'Section:') !!}
    {!! Form::number('Section', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Sex', 'Sex:') !!}
    {!! Form::number('Sex', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Tel1', 'Tel1:') !!}
    {!! Form::text('Tel1', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Tel2', 'Tel2:') !!}
    {!! Form::text('Tel2', null, ['class' => 'form-control', 'maxlength' => 100, 'maxlength' => 100]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Trustee', 'Trustee:') !!}
    {!! Form::text('Trustee', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('TrusteeEn', 'Trusteeen:') !!}
    {!! Form::text('TrusteeEn', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('UserAdd', 'Useradd:') !!}
    {!! Form::number('UserAdd', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('UserEdit', 'Useredit:') !!}
    {!! Form::number('UserEdit', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('WifeAddress', 'Wifeaddress:') !!}
    {!! Form::text('WifeAddress', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('WifeCareer', 'Wifecareer:') !!}
    {!! Form::number('WifeCareer', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('WifeName', 'Wifename:') !!}
    {!! Form::text('WifeName', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('WifeNationality', 'Wifenationality:') !!}
    {!! Form::number('WifeNationality', null, ['class' => 'form-control']) !!}
</div> -->















@extends('layouts.app')

@section('content')
<div class="card container p-3">
    <div class="card-header">
        <h4 class="card-title text-center">Create Primary Data</h4>
        <div class="card-tools">
            @php
                $isSubmission = Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
                $routeBase = $isSubmission ? 'primaryDatasSubmissions' : 'primaryDatas';
                
            @endphp
            
            <a href="{{ route("{$routeBase}.index") }}" class="btn btn-primary btn-sm float-right">
                <i class="fas fa-list"></i> Back
            </a>
            <!-- <a href="{{ route('primaryDatas.create') }}" class="btn btn-success btn-sm float-right mr-2">
                <i class="fas fa-plus"></i> Create
            </a> -->
        </div>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['route' => 'primaryDatas.store']) !!}

    {{-- Personal Info --}}
    <div class="card mb-4 border-primary shadow-sm">
        <div class="card-header bg-primary text-white">Personal Information</div>
        <div class="card-body row">
            <div class="form-group col-md-4">
                {!! Form::label('Nam', 'Name (Arabic)') !!}
                {!! Form::text('Nam', null, ['class' => 'form-control' . ($errors->has('Nam') ? ' is-invalid' : '')]) !!}
                @error('Nam') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('NamEn', 'Name (English)') !!}
                {!! Form::text('NamEn', null, ['class' => 'form-control' . ($errors->has('NamEn') ? ' is-invalid' : '')]) !!}
                @error('NamEn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('Trustee', 'Trustee (Arabic)') !!}
                {!! Form::text('Trustee', null, ['class' => 'form-control' . ($errors->has('Trustee') ? ' is-invalid' : '')]) !!}
                @error('Trustee') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('TrusteeEn', 'Name (English)') !!}
                {!! Form::text('TrusteeEn', null, ['class' => 'form-control' . ($errors->has('TrusteeEn') ? ' is-invalid' : '')]) !!}
                @error('TrusteeEn') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('DateOfBirth', 'Date of Birth') !!}
                {!! Form::date('DateOfBirth', null, ['class' => 'form-control' . ($errors->has('DateOfBirth') ? ' is-invalid' : '')]) !!}
                @error('DateOfBirth') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('Sex', 'Sex') !!}
                {!! Form::select('Sex', $sexes, null, ['class' => 'form-control' . ($errors->has('Sex') ? ' is-invalid' : ''), 'placeholder' => 'Select Sex']) !!}
                @error('Sex') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('Nationality', 'Nationality') !!}
                {!! Form::select('Nationality', $nationalities, null, ['class' => 'form-control' . ($errors->has('Nationality') ? ' is-invalid' : ''), 'placeholder' => 'Select Nationality']) !!}
                @error('Nationality') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('MaritalStatus', 'Marital Status') !!}
                {!! Form::select('MaritalStatus', $maritalStatuses, null, ['class' => 'form-control' . ($errors->has('MaritalStatus') ? ' is-invalid' : ''), 'placeholder' => 'Select Status']) !!}
                @error('MaritalStatus') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('FamilyCount', 'Family Count') !!}
                {!! Form::number('FamilyCount', null, ['class' => 'form-control' . ($errors->has('FamilyCount') ? ' is-invalid' : '')]) !!}
                @error('FamilyCount') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- Contact Info --}}
    <div class="card mb-4 border-success shadow-sm">
        <div class="card-header bg-success text-white">Contact Information</div>
        <div class="card-body row">
            @foreach (['mob' => 'Mobile', 'Tel1' => 'Telephone 1', 'Tel2' => 'Telephone 2', 'Email' => 'Email'] as $field => $label)
                <div class="form-group col-md-4">
                    {!! Form::label($field, $label) !!}
                    {!! Form::text($field, null, ['class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')]) !!}
                    @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            @endforeach
        </div>
    </div>

    {{-- Spouse Info --}}
    <div class="card mb-4 border-warning shadow-sm">
        <div class="card-header bg-warning text-dark">Spouse Information</div>
        <div class="card-body row">
            <div class="form-group col-md-4">
                {!! Form::label('WifeName', 'Wife Name') !!}
                {!! Form::text('WifeName', null, ['class' => 'form-control' . ($errors->has('WifeName') ? ' is-invalid' : '')]) !!}
                @error('WifeName') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('WifeAddress', 'Wife Address') !!}
                {!! Form::text('WifeAddress', null, ['class' => 'form-control' . ($errors->has('WifeAddress') ? ' is-invalid' : '')]) !!}
                @error('WifeAddress') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('WifeCareer', 'Wife Career') !!}
                {!! Form::select('WifeCareer', $careers, null, ['class' => 'form-control' . ($errors->has('WifeCareer') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                @error('WifeCareer') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('WifeNationality', 'Wife Nationality') !!}
                {!! Form::select('WifeNationality', $nationalities, null, ['class' => 'form-control' . ($errors->has('WifeNationality') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                @error('WifeNationality') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- Location Info --}}
    <div class="card mb-4 border-info shadow-sm">
        <div class="card-header bg-info text-white">Location & Region</div>
        <div class="card-body row">
            <div class="form-group col-md-4">
                {!! Form::label('Region', 'Region') !!}
                {!! Form::select('Region', $regions, null, ['class' => 'form-control' . ($errors->has('Region') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                @error('Region') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('HouseType', 'House Type') !!}
                {!! Form::select('HouseType', $houseTypes, null, ['class' => 'form-control' . ($errors->has('HouseType') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                @error('HouseType') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('CareerAddress', 'Career Address') !!}
                {!! Form::text('CareerAddress', null, ['class' => 'form-control' . ($errors->has('CareerAddress') ? ' is-invalid' : '')]) !!}
                @error('CareerAddress') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- Career Info --}}
    <div class="card mb-4 border-secondary shadow-sm">
        <div class="card-header bg-secondary text-white">Career</div>
        <div class="card-body row">
            <div class="form-group col-md-4">
                {!! Form::label('Career', 'Career') !!}
                {!! Form::select('Career', $careers, null, ['class' => 'form-control' . ($errors->has('Career') ? ' is-invalid' : ''), 'placeholder' => 'Select Career']) !!}
                @error('Career') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('InSchool', 'In School') !!}
                {!! Form::number('InSchool', null, ['class' => 'form-control' . ($errors->has('InSchool') ? ' is-invalid' : '')]) !!}
                @error('InSchool') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        </div>
    </div>

    {{-- Government Info --}}
    <div class="card mb-4 border-danger shadow-sm">
        <div class="card-header bg-danger text-white">Government Info</div>
        <div class="card-body row">
            @foreach ([ 'IDNo', 'IDExpiry', 'IBAN', 'Permission_No', 'Permission_Date', 'Renew_Date'] as $field)
                <div class="form-group col-md-4">
                    {!! Form::label($field, str_replace('_', ' ', $field)) !!}
                    @if(str_contains($field, 'Date') || $field == 'IDExpiry')
                        {!! Form::date($field, null, ['class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')]) !!}
                    @else
                        {!! Form::text($field, null, ['class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')]) !!}
                    @endif
                    @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            @endforeach
        </div>
    </div>

    {{-- Administrative Info --}}
    <div class="card mb-4 border-dark shadow-sm">
        <div class="card-header bg-dark text-white">Administrative Info</div>
        <div class="card-body row">
            <div class="form-group col-md-4">
                {!! Form::label('Section', 'Section') !!}
                {!! Form::select('Section', ['1' => 'مواطن', '0' => 'وافد'], null, ['class' => 'form-control' . ($errors->has('Section') ? ' is-invalid' : '')]) !!}
                @error('Section') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="form-group col-md-6">
                {!! Form::label('HeadRemarks', 'Head Remarks') !!}
                {!! Form::text('HeadRemarks', null, ['class' => 'form-control' . ($errors->has('HeadRemarks') ? ' is-invalid' : '')]) !!}
                @error('HeadRemarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            @foreach (['Approved', 'Accomodation', 'Revised' ,'Cancel'] as $checkbox)
                <div class="form-group col-md-4">
                    <div class="form-check mt-4">
                        {!! Form::hidden($checkbox, 0) !!}
                        {!! Form::checkbox($checkbox, 1, null, ['class' => 'form-check-input' . ($errors->has($checkbox) ? ' is-invalid' : '')]) !!}
                        {!! Form::label($checkbox, $checkbox, ['class' => 'form-check-label']) !!}
                        @error($checkbox)
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="card-footer form-group text-center">
        <!-- {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!} -->
         {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route("{$routeBase}.index") }}" class="btn btn-secondary">Cancel</a>
    </div>

    {!! Form::close() !!}
</div>
@endsection


