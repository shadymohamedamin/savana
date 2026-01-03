{{-- resources/views/primary_datas/edit_fields.blade.php --}}


{{-- Personal Info --}}
<div class="card mb-4 border-primary shadow-sm">
    <div class="card-header bg-primary text-white">Personal Information</div>
    <div class="card-body row">
        <div class="form-group col-md-4">
            {!! Form::label('Nam', 'Nam') !!}
            {!! Form::text('Nam', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('NamEn', 'NamEn') !!}
            {!! Form::text('NamEn', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('DateOfBirth', 'Date of Birth') !!}
            {!! Form::date('DateOfBirth', isset($primaryData) ? \Carbon\Carbon::parse($primaryData->DateOfBirth)->format('Y-m-d') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Sex', 'Sex') !!}
            {!! Form::select('Sex', $sexes, null, ['class' => 'form-control', 'placeholder' => 'Select sex']) !!}
            <!-- {!! Form::text('Sex', null, ['class' => 'form-control']) !!} -->
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Nationality', 'Nationality') !!}
            {!! Form::select('Nationality', $nationalities, null, ['class' => 'form-control', 'placeholder' => 'Select nationality']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('MaritalStatus', 'Marital Status') !!}
            {!! Form::select('MaritalStatus', $maritalStatuses, null, ['class' => 'form-control', 'placeholder' => 'Select marital status']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('FamilyCount', 'Family Count') !!}
            {!! Form::number('FamilyCount', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

{{-- Contact Info --}}
<div class="card mb-4 border-success shadow-sm">
    <div class="card-header bg-success text-white">Contact Information</div>
    <div class="card-body row">
        <div class="form-group col-md-4">
            {!! Form::label('Email', 'Email') !!}
            {!! Form::email('Email', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Mob', 'Mobile') !!}
            {!! Form::text('mob', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Tel1', 'Telephone 1') !!}
            {!! Form::text('Tel1', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Tel2', 'Telephone 2') !!}
            {!! Form::text('Tel2', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

{{-- Spouse Info --}}
<div class="card mb-4 border-warning shadow-sm">
    <div class="card-header bg-warning text-dark">Spouse Information</div>
    <div class="card-body row">
        <div class="form-group col-md-4">
            {!! Form::label('WifeName', 'Wife Name') !!}
            {!! Form::text('WifeName', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('WifeCareer', 'Wife Career') !!}
            {!! Form::select('WifeCareer', $careers, null, ['class' => 'form-control', 'placeholder' => 'Select  career']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('WifeAddress', 'Wife Address') !!}
            {!! Form::text('WifeAddress', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('WifeNationality', 'Wife Nationality') !!}
            {!! Form::select('WifeNationality', $nationalities, null, ['class' => 'form-control', 'placeholder' => 'Select  career']) !!}
        </div>
    </div>
</div>

{{-- Location Info --}}
<div class="card mb-4 border-info shadow-sm">
    <div class="card-header bg-info text-white">Location & Region</div>
    <div class="card-body row">
        <div class="form-group col-md-4">
            {!! Form::label('Region', 'Region') !!}
            {!! Form::select('Region', $regions, null, ['class' => 'form-control', 'placeholder' => 'Select  career']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('HouseType', 'House Type') !!}
            {!! Form::select('HouseType', $houseTypes, null, ['class' => 'form-control', 'placeholder' => 'Select  career']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('CareerAddress', 'Career Address') !!}
            {!! Form::text('CareerAddress', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

{{-- Career Info --}}
<div class="card mb-4 border-secondary shadow-sm">
    <div class="card-header bg-secondary text-white">Career</div>
    <div class="card-body row">
        <div class="form-group col-md-4">
            {!! Form::label('Career', 'Career') !!}
            {!! Form::select('Career', $careers, null, ['class' => 'form-control', 'placeholder' => 'Select  career']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('InSchool', 'In School') !!}
            {!! Form::text('InSchool', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

{{-- Government Info --}}
<div class="card mb-4 border-danger shadow-sm">
    <div class="card-header bg-danger text-white">Government Info</div>
    <div class="card-body row">
        <!-- <div class="form-group col-md-4">
            {!! Form::label('FileNo', 'File No') !!}
            {!! Form::text('FileNo', null, ['class' => 'form-control']) !!}
        </div> -->
        <div class="form-group col-md-4">
            {!! Form::label('IDNo', 'ID No') !!}
            {!! Form::text('IDNo', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('IDExpiry', 'ID Expiry') !!}
            {!! Form::date('IDExpiry', isset($primaryData) ? \Carbon\Carbon::parse($primaryData->IDExpiry)->format('Y-m-d') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('IBAN', 'IBAN') !!}
            {!! Form::text('IBAN', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Permission_No', 'Permission No') !!}
            {!! Form::text('Permission_No', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Permission_Date', 'Permission Date') !!}
            {!! Form::date('Permission_Date', isset($primaryData) ? \Carbon\Carbon::parse($primaryData->Permission_Date)->format('Y-m-d') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Renew_Date', 'Renew Date') !!}
            {!! Form::date('Renew_Date', isset($primaryData) ? \Carbon\Carbon::parse($primaryData->Renew_Date)->format('Y-m-d') : null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>

{{-- Administrative Info --}}
<div class="card mb-4 border-dark shadow-sm">
    <div class="card-header bg-dark text-white">Administrative Info</div>
    <div class="card-body row">
        <div class="form-group col-md-4">
            {!! Form::label('Approved', 'Approved') !!}
            {!! Form::checkbox('Approved', $primaryData->Section, null) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Cancel', 'Cancel') !!}
            {!! Form::checkbox('Cancel', $primaryData->Section, null) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Revised', 'Revised') !!}
            {!! Form::checkbox('Revised', $primaryData->Section, null) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('Accomodation', 'Accomodation') !!}
            {!! Form::checkbox('Accomodation', $primaryData->Accomodation, null) !!}
            <!-- <div>{{ $primaryData->Accomodation == 1 ? 'yes' : ($primaryData->Accomodation == 0 ? 'no' : '') }}</div> -->
        </div>
        <div class="form-group col-md-4">
                {!! Form::label('Section', 'Section') !!}
                {!! Form::select('Section', ['1' => 'مواطن', '0' => 'وافد'], null, ['class' => 'form-control' . ($errors->has('Section') ? ' is-invalid' : '')]) !!}
                @error('Section') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('CaseDate', 'Case Date') !!}
            {!! Form::date('CaseDate', isset($primaryData) ? \Carbon\Carbon::parse($primaryData->CaseDate)->format('Y-m-d') : null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('HeadRemarks', 'Head Remarks') !!}
            {!! Form::text('HeadRemarks', null, ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group col-md-4">
            {!! Form::label('Trustee', 'Trustee') !!}
            {!! Form::text('Trustee', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group col-md-4">
            {!! Form::label('TrusteeEn', 'TrusteeEn') !!}
            {!! Form::text('TrusteeEn', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('request_status_user_id', 'Request Status (Assigned to)') !!}
            {!! Form::select('request_status_user_id', 
                ['completed' => '✓ Completed'] + $users->toArray(), 
                optional($primaryData)->request_status_user_id, 
                ['class' => 'form-control']) !!}
        </div>

        <div class="form-group col-md-4">
            {!! Form::label('is_completed', 'is_completed') !!}
            {!! Form::checkbox('is_completed', 1, $primaryData->is_completed == 1) !!}

        </div>



        @php
            $isSubmission = Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
        @endphp

        @if ($isSubmission)
            <div class="form-group col-md-4">
                {!! Form::label('request_status', 'حالة الطلب') !!}
                {!! Form::select('request_status', [
                    'تم الارسال' => 'تم الارسال',
                    'يرجي تعديل الطلب' => 'يرجي تعديل الطلب',
                    'تم الارسال للمراجعة' => 'تم الارسال للمراجعة',
                    'تم استلام الطلب' => 'تم استلام الطلب',
                    'تحت الدراسة' => 'تحت الدراسة',
                    'غير مكتمل' => 'غير مكتمل',
                    'مقبول' => 'مقبول',
                    'اعتذار' => 'اعتذار',
                    'تأجيل' => 'تأجيل',
                    'قيد الإجراء' => 'قيد الإجراء'
                ], null, ['class' => 'form-control']) !!}
                <small class="text-muted">ملاحظة جاهزة تظهر للمتعامل</small>
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('request_reply', 'الرد على الطلب') !!}
                {!! Form::select('request_reply', [
                    ' ' <= null,
                    'يرجى استكمال الطلب' => 'يرجى استكمال الطلب',
                    'يرجى ارفاق كافة المستندات' => 'يرجى ارفاق كافة المستندات',
                    'طلب مخالف الشروط' => 'طلب مخالف الشروط',
                    'تم استلام الطلب' => 'تم استلام الطلب'
                ], null, ['class' => 'form-control']) !!}
                <small class="text-muted">ملاحظة جاهزة تظهر للمتعامل</small>
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('request_custom_reply', 'رد خاص') !!}
                {!! Form::text('request_custom_reply', null, ['class' => 'form-control']) !!}
                <small class="text-muted">ملاحظة خاصة تظهر للمتعامل</small>
            </div>

            <div class="form-group col-md-4">
                {!! Form::label('request_transfer_to_admin', 'تحويل لقسم الدعم؟') !!}
                {!! Form::checkbox('request_transfer_to_admin', 1, $primaryData->request_transfer_to_admin == 1) !!}
            </div>
        @endif



        <!-- <div class="form-group col-md-4">
            {!! Form::label('LastUpdate', 'Last Update') !!}
            {!! Form::date('LastUpdate', isset($primaryData) ? \Carbon\Carbon::parse($primaryData->LastUpdate)->format('Y-m-d') : null, ['class' => 'form-control']) !!}
        </div> -->
    </div>
</div>
