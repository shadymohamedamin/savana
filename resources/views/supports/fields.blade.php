<!-- 
<div class="form-group col-sm-6">
    {!! Form::label('Dat', 'Dat:') !!}
    {!! Form::text('Dat', null, ['class' => 'form-control','id'=>'Dat']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#Dat').datepicker()
    </script>
@endpush


<div class="form-group col-sm-6">
    {!! Form::label('CaseID', 'Caseid:') !!}
    {!! Form::number('CaseID', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('SupportRequiredArch', 'Supportrequiredarch:') !!}
    {!! Form::number('SupportRequiredArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('SupportType', 'Supporttype:') !!}
    {!! Form::number('SupportType', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('NeedِAmount', 'Needِamount:') !!}
    {!! Form::number('NeedِAmount', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('SupportAmount', 'Supportamount:') !!}
    {!! Form::number('SupportAmount', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('Note', 'Note:') !!}
    {!! Form::textarea('Note', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('SalaryArch', 'Salaryarch:') !!}
    {!! Form::number('SalaryArch', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('IncomeArch', 'Incomearch:') !!}
    {!! Form::number('IncomeArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('WifeSalaryArch', 'Wifesalaryarch:') !!}
    {!! Form::number('WifeSalaryArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('OfflineSalaryArch', 'Offlinesalaryarch:') !!}
    {!! Form::number('OfflineSalaryArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('SocialSalaryArch', 'Socialsalaryarch:') !!}
    {!! Form::number('SocialSalaryArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('OtherSalaryArch', 'Othersalaryarch:') !!}
    {!! Form::number('OtherSalaryArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('ChildrenInArch', 'Childreninarch:') !!}
    {!! Form::number('ChildrenInArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('LoanArch', 'Loanarch:') !!}
    {!! Form::number('LoanArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('RentArch', 'Rentarch:') !!}
    {!! Form::number('RentArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('DriverArch', 'Driverarch:') !!}
    {!! Form::number('DriverArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('FeesArch', 'Feesarch:') !!}
    {!! Form::number('FeesArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('ServantArch', 'Servantarch:') !!}
    {!! Form::number('ServantArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('EleWaterArch', 'Elewaterarch:') !!}
    {!! Form::number('EleWaterArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('HouseArch', 'Housearch:') !!}
    {!! Form::number('HouseArch', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('BankArch', 'Bankarch:') !!}
    {!! Form::number('BankArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('FurnatureArch', 'Furnaturearch:') !!}
    {!! Form::number('FurnatureArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('CarArch', 'Cararch:') !!}
    {!! Form::number('CarArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('CourtArch', 'Courtarch:') !!}
    {!! Form::number('CourtArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('ChildrenOutArch', 'Childrenoutarch:') !!}
    {!! Form::number('ChildrenOutArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('SearcherArch', 'Searcherarch:') !!}
    {!! Form::number('SearcherArch', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('CaseDescription', 'Casedescription:') !!}
    {!! Form::textarea('CaseDescription', null, ['class' => 'form-control']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Application_Date', 'Application Date:') !!}
    {!! Form::text('Application_Date', null, ['class' => 'form-control','id'=>'Application_Date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#Application_Date').datepicker()
    </script>
@endpush


<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('AppRemarks', 'Appremarks:') !!}
    {!! Form::textarea('AppRemarks', null, ['class' => 'form-control']) !!}
</div> -->





<!-- <div class="container">
    <div class="row g-3">

        {{-- ID (Hidden or readonly if auto-increment) --}}
        <div class="col-md-4">
            {!! Form::label('ID', 'ID') !!}
            {!! Form::number('ID', null, ['class' => 'form-control' . ($errors->has('ID') ? ' is-invalid' : ''), 'readonly']) !!}
            @error('ID') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Date --}}
        <div class="col-md-4">
            {!! Form::label('Dat', 'Date') !!}
            {!! Form::text('Dat', null, ['class' => 'form-control datepicker' . ($errors->has('Dat') ? ' is-invalid' : '')]) !!}
            @error('Dat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Case ID --}}
        <div class="col-md-4">
            {!! Form::label('CaseID', 'Case ID') !!}
            {!! Form::number('CaseID', null, ['class' => 'form-control' . ($errors->has('CaseID') ? ' is-invalid' : '')]) !!}
            @error('CaseID') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Support Required Type --}}
        <div class="col-md-6">
            {!! Form::label('SupportRequiredArch', 'Support Required Type') !!}
            {!! Form::number('SupportRequiredArch', null, ['class' => 'form-control' . ($errors->has('SupportRequiredArch') ? ' is-invalid' : '')]) !!}
            @error('SupportRequiredArch') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Support Provided Type --}}
        <div class="col-md-6">
            {!! Form::label('SupportType', 'Support Provided Type') !!}
            {!! Form::number('SupportType', null, ['class' => 'form-control' . ($errors->has('SupportType') ? ' is-invalid' : '')]) !!}
            @error('SupportType') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Need and Support Amount --}}
        <div class="col-md-6">
            {!! Form::label('NeedAmount', 'Need Amount') !!}
            {!! Form::number('NeedAmount', null, ['class' => 'form-control' . ($errors->has('NeedAmount') ? ' is-invalid' : '')]) !!}
            @error('NeedAmount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-6">
            {!! Form::label('SupportAmount', 'Support Amount') !!}
            {!! Form::number('SupportAmount', null, ['class' => 'form-control' . ($errors->has('SupportAmount') ? ' is-invalid' : '')]) !!}
            @error('SupportAmount') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Note --}}
        <div class="col-md-12">
            {!! Form::label('Note', 'Note') !!}
            {!! Form::textarea('Note', null, ['class' => 'form-control' . ($errors->has('Note') ? ' is-invalid' : ''), 'rows' => 3]) !!}
            @error('Note') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Income Section --}}
        <div class="col-md-12 mt-4">
            <h5 class="border-bottom pb-2">Income</h5>
        </div>

        @foreach ([
            'SalaryArch' => 'Salary',
            'IncomeArch' => 'Income',
            'WifeSalaryArch' => 'Wife Salary',
            'OfflineSalaryArch' => 'Offline Salary',
            'SocialSalaryArch' => 'Social Salary',
            'OtherSalaryArch' => 'Other Salary',
            'ChildrenInArch' => 'Children Income',
        ] as $field => $label)
            <div class="col-md-4">
                {!! Form::label($field, $label) !!}
                {!! Form::number($field, null, ['class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')]) !!}
                @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        @endforeach

        {{-- Outcome Section --}}
        <div class="col-md-12 mt-4">
            <h5 class="border-bottom pb-2">Outcome</h5>
        </div>

        @foreach ([
            'LoanArch' => 'Loan',
            'RentArch' => 'Rent',
            'DriverArch' => 'Driver',
            'FeesArch' => 'Fees',
            'ServantArch' => 'Servant',
            'EleWaterArch' => 'Electricity & Water',
            'HouseArch' => 'House',
            'BankArch' => 'Bank',
            'FurnatureArch' => 'Furniture',
            'CarArch' => 'Car',
            'CourtArch' => 'Court',
            'ChildrenOutArch' => 'Children Expenses',
        ] as $field => $label)
            <div class="col-md-4">
                {!! Form::label($field, $label) !!}
                {!! Form::number($field, null, ['class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')]) !!}
                @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
        @endforeach

        {{-- Optional Fields (e.g. Description, Application Date, App Remarks) --}}
        <div class="col-md-12 mt-4">
            <h5 class="border-bottom pb-2">Additional Info</h5>
        </div>

        <div class="col-md-6">
            {!! Form::label('CaseDescription', 'Case Description') !!}
            {!! Form::textarea('CaseDescription', null, ['class' => 'form-control', 'rows' => 2]) !!}
        </div>

        <div class="col-md-3">
            {!! Form::label('Application_Date', 'Application Date') !!}
            {!! Form::text('Application_Date', null, ['class' => 'form-control datepicker' . ($errors->has('Application_Date') ? ' is-invalid' : '')]) !!}
            @error('Application_Date') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            {!! Form::label('AppRemarks', 'App Remarks') !!}
            {!! Form::text('AppRemarks', null, ['class' => 'form-control' . ($errors->has('AppRemarks') ? ' is-invalid' : '')]) !!}
            @error('AppRemarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

    </div>
</div> -->




<div class="container">
    <div class="row g-4">

        {{-- Support Section --}}
        <div class="col-md-12">
            <div class="card border-primary shadow-sm">
                <div class="card-header bg-primary text-white">Support Required</div>
                <div class="card-body">
                    <div class="row">
                        {{-- Support Required Type --}}
                        <div class="col-md-6 mb-3">
                            {!! Form::label('SupportRequiredArch', 'Support Required Type') !!}
                            {!! Form::select('SupportRequiredArch', $supportTypes, null, [
                                'class' => 'form-control' . ($errors->has('SupportRequiredArch') ? ' is-invalid' : ''),
                                'placeholder' => 'Select Support Type'
                            ]) !!}
                            @error('SupportRequiredArch')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Support Type --}}
                        <div class="col-md-6 mb-3">
                            {!! Form::label('SupportType', 'Support Type') !!}
                            {!! Form::select('SupportType', $supportTypes, null, [
                                'class' => 'form-control' . ($errors->has('SupportType') ? ' is-invalid' : ''),
                                'placeholder' => 'Select Support Type'
                            ]) !!}
                            @error('SupportType')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Case Information --}}


        {{-- Case Details --}}
        <div class="col-md-12">
            <div class="card border-info shadow-sm">
                <div class="card-header bg-info text-white">Case Details</div>
                <div class="card-body row g-3">
                    <div class="col-md-6">
                        {!! Form::label('CaseDescription', 'Case Description') !!}
                        {!! Form::textarea('CaseDescription', null, [
                            'class' => 'form-control' . ($errors->has('CaseDescription') ? ' is-invalid' : ''),
                            'rows' => 3
                        ]) !!}
                        @error('CaseDescription') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('case_description_user', 'case_description_user') !!}
                        {!! Form::textarea('case_description_user', null, [
                            'class' => 'form-control' . ($errors->has('case_description_user') ? ' is-invalid' : ''),
                            'rows' => 3
                        ]) !!}
                        @error('case_description_user') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('help_type', 'help_type') !!}
                        {!! Form::textarea('help_type', null, [
                            'class' => 'form-control' . ($errors->has('help_type') ? ' is-invalid' : ''),
                            'rows' => 3
                        ]) !!}
                        @error('help_type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('AppRemarks', 'App Remarks') !!}
                        {!! Form::textarea('AppRemarks', null, [
                            'class' => 'form-control' . ($errors->has('AppRemarks') ? ' is-invalid' : ''),
                            'rows' => 3
                        ]) !!}
                        @error('AppRemarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        {!! Form::label('NeedAmount', 'NeedAmount') !!}
                        {!! Form::number('NeedAmount', null, [
                            'class' => 'form-control' . ($errors->has('NeedAmount') ? ' is-invalid' : ''),
                            
                        ]) !!}
                        @error('NeedAmount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        {!! Form::label('SupportAmount', 'SupportAmount') !!}
                        {!! Form::number('SupportAmount', null, [
                            'class' => 'form-control' . ($errors->has('SupportAmount') ? ' is-invalid' : ''),
                            
                        ]) !!}
                        @error('SupportAmount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        {!! Form::label('support_ammount_user', 'support_ammount_user') !!}
                        {!! Form::number('support_ammount_user', null, [
                            'class' => 'form-control' . ($errors->has('support_ammount_user') ? ' is-invalid' : ''),
                            
                        ]) !!}
                        @error('support_ammount_user') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>


                    
                   <div class="form-group col-md-6">
                        {!! Form::label('Application_Date', 'Application Date') !!}

                        {!! Form::date('Application_Date',
                            isset($support) && $support->Application_Date
                                ? \Carbon\Carbon::parse($support->Application_Date)->format('Y-m-d')
                                : null,
                            ['class' => 'form-control' . ($errors->has('Application_Date') ? ' is-invalid' : '')]
                        ) !!}

                        @error('Application_Date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror     
                    </div>





                    <div class="col-md-6">
                        {!! Form::label('Note', 'Note') !!}
                        {!! Form::text('Note', null, [
                            'class' => 'form-control' . ($errors->has('Note') ? ' is-invalid' : '')
                        ]) !!}
                        @error('Note') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Income Section --}}
        <div class="col-md-12">
            <div class="card border-success shadow-sm">
                <div class="card-header bg-success text-white">Income</div>
                <div class="card-body row g-3">
                    @foreach ([
                        'SalaryArch' => 'Salary',
                        'IncomeArch' => 'Income',
                        'WifeSalaryArch' => 'Wife Salary',
                        'OfflineSalaryArch' => 'Offline Salary',
                        'SocialSalaryArch' => 'Social Salary',
                        'OtherSalaryArch' => 'Other Salary',
                        'ChildrenInArch' => 'Children Income',
                    ] as $field => $label)
                        <div class="col-md-4">
                            {!! Form::label($field, $label) !!}
                            {!! Form::number($field, null, [
                                'class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')
                            ]) !!}
                            @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Outcome Section --}}
        <div class="col-md-12">
            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger text-white">Outcome</div>
                <div class="card-body row g-3">
                    @foreach ([
                        'LoanArch' => 'Loan',
                        'RentArch' => 'Rent',
                        'DriverArch' => 'Driver',
                        'FeesArch' => 'Fees',
                        'ServantArch' => 'Servant',
                        'EleWaterArch' => 'Electricity & Water',
                        'HouseArch' => 'House',
                        'BankArch' => 'Bank',
                        'FurnatureArch' => 'Furniture',
                        'CarArch' => 'Car',
                        'CourtArch' => 'Court',
                        'ChildrenOutArch' => 'Children Expenses',
                    ] as $field => $label)
                        <div class="col-md-4">
                            {!! Form::label($field, $label) !!}
                            {!! Form::number($field, null, [
                                'class' => 'form-control' . ($errors->has($field) ? ' is-invalid' : '')
                            ]) !!}
                            @error($field) <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

