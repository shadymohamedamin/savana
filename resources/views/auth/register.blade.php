{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">             
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>   

                        <div class="row mb-3">
                            <label for="uae_id" class="col-md-4 col-form-label text-md-end">{{ __('UAE ID') }}</label>

                            <div class="col-md-6">
                                <input id="uae_id" type="text" class="form-control @error('uae_id') is-invalid @enderror" name="uae_id" value="{{ old('uae_id') }}" required autocomplete="uae_id">

                                @error('uae_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6 d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex_male" value="2" {{ old('sex') == 2 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="sex_male">
                                        {{ __('Male') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex_female" value="1" {{ old('sex') == 1 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="sex_female">
                                        {{ __('Female') }}
                                    </label>
                                </div>

                                @error('sex')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection  --}}





















@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
        @csrf

        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">User Information</div>
            <div class="card-body">
                @foreach ([
                    ['label' => 'Nam', 'name' => 'Nam'],
                    ['label' => 'NamEn', 'name' => 'NamEn'],
                    ['label' => 'Email Address', 'name' => 'email', 'type' => 'email'],
                    ['label' => 'UAE ID', 'name' => 'uae_id'],
                    ['label' => 'Mobile Number', 'name' => 'mobile'],
                    ['label' => 'Password', 'name' => 'password', 'type' => 'password'],
                    ['label' => 'Confirm Password', 'name' => 'password_confirmation', 'type' => 'password'],
                ] as $field)
                @php $type = $field['type'] ?? 'text'; @endphp
                <div class="mb-3">
                    <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>
                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $type }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name']) }}" {{ $type === 'password' ? '' : 'required' }}>
                    @error($field['name'])
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                @endforeach

                
                <div style="display: flex; align-items:center; gap:1rem;" class="mb-3 flex flex-row">
                    <label class="form-label">Gender</label><br>
                    <div class="form-check form-check-inline style="display: flex; align-items:center"">
                        <input class="form-check-input" type="radio" name="sex" id="male" value="2" required>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline style="display: flex; align-items:center"">
                        <input class="form-check-input" type="radio" name="sex" id="female" value="1">
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                    @error('sex')
                        <span class="invalid-feedback d-block"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div>

        
        {{-- ✅ Updated Primary Data --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Primary Data</div>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    {!! Form::label('Section', 'Section') !!}
                    {!! Form::select('Section', ['1' => 'مواطن', '0' => 'وافد'], null, ['class' => 'form-control' . ($errors->has('Section') ? ' is-invalid' : '')]) !!}
                    @error('Section') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                

                <div class="form-group col-md-4">
                    {!! Form::label('Trustee', 'Trustee (Arabic)') !!}
                    {!! Form::text('Trustee', null, ['class' => 'form-control' . ($errors->has('Trustee') ? ' is-invalid' : '')]) !!}
                    @error('Trustee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                

                <div class="form-group col-md-4">
                    {!! Form::label('TrusteeEn', 'TrusteeEn') !!}
                    {!! Form::text('TrusteeEn', null, ['class' => 'form-control' . ($errors->has('TrusteeEn') ? ' is-invalid' : '')]) !!}
                    @error('TrusteeEn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('DateOfBirth', 'Date of Birth') !!}
                    {!! Form::date('DateOfBirth', null, ['class' => 'form-control' . ($errors->has('DateOfBirth') ? ' is-invalid' : '')]) !!}
                    @error('DateOfBirth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                

                <div class="form-group col-md-4">
                    {!! Form::label('Nationality', 'Nationality') !!}
                    {!! Form::select('Nationality', $nationalities, null, ['class' => 'form-control' . ($errors->has('Nationality') ? ' is-invalid' : ''), 'placeholder' => 'Select Nationality']) !!}
                    @error('Nationality') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <div class="form-group col-md-4">
                    {!! Form::label('Career', 'Career') !!}
                    {!! Form::select('Career', $careers, null, ['class' => 'form-control' . ($errors->has('Career') ? ' is-invalid' : ''), 'placeholder' => 'Select Career']) !!}
                    @error('Career') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('CareerAddress', 'Career Address') !!}
                    {!! Form::text('CareerAddress', null, ['class' => 'form-control' . ($errors->has('CareerAddress') ? ' is-invalid' : '')]) !!}
                    @error('CareerAddress') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('FamilyCount', 'Family Count') !!}
                    {!! Form::number('FamilyCount', null, ['class' => 'form-control' . ($errors->has('FamilyCount') ? ' is-invalid' : '')]) !!}
                    @error('FamilyCount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('InSchool', 'In School') !!}
                    {!! Form::number('InSchool', null, ['class' => 'form-control' . ($errors->has('InSchool') ? ' is-invalid' : '')]) !!}
                    @error('InSchool') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <div class="form-group col-md-4">
                    {!! Form::label('MaritalStatus', 'Marital Status') !!}
                    {!! Form::select('MaritalStatus', $maritalStatuses, null, ['class' => 'form-control' . ($errors->has('MaritalStatus') ? ' is-invalid' : ''), 'placeholder' => 'Select Status']) !!}
                    @error('MaritalStatus') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                
                

                
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
            </div>
        </div>


        
        <div class="card mb-4">
            <div class="card-header bg-warning">Support Info</div>
            <div class="card-body">
                @foreach ([
                    ['label' => 'help_type', 'name' => 'help_type'],
                    ['label' => 'support_ammount_user', 'name' => 'support_ammount_user','type' => 'number'],
                    //['label' => 'support_ammount_user', 'name' => 'support_ammount_user'],
                    ['label' => 'case_description_user', 'name' => 'case_description_user', 'type' => 'textarea'],
                    //['label' => 'Case Description', 'name' => 'CaseDescription'],
                    //['label' => 'Application Date', 'name' => 'Application_Date', 'type' => 'date'],
                    //['label' => 'Note', 'name' => 'Note'],
                ] as $field)
                @php $type = $field['type'] ?? 'text'; @endphp
                <div class="mb-3">
                    <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>
                    <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $type }}" class="form-control @error($field['name']) is-invalid @enderror" value="{{ old($field['name']) }}">
                    @error($field['name'])
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                @endforeach
            </div>
        </div>



        {{-- Income Section --}}
        <!-- <div class="col-md-12 mb-4">
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
        </div> -->

        {{-- Outcome Section --}}
        <!-- <div class="col-md-12 mb-4">
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
        </div> -->

        
        {{-- <div class="card mb-4">
            <div class="card-header bg-dark text-white">Attachments</div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="attachments" class="form-label">Upload Files</label>
                    <input type="file" name="attachments[]" id="attachments" class="form-control @error('attachments') is-invalid @enderror" multiple>
                    @error('attachments')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
        </div> --}}
        <div class="alert alert-info text-right">
            <strong>تعليمات رفع الملفات:</strong><br>
            - يُسمح برفع <strong>10 ملفات كحد أقصى</strong>.<br>
            - يجب ألا يتجاوز <strong>حجم كل ملف 10 ميغابايت</strong>.<br>
            - الأنواع المسموح بها: <strong>PDF</strong> و <strong>صور (JPG, PNG)</strong>.<br>
            - اختر <strong>نوع المرفق</strong> ثم الملف المناسب، ويمكنك معاينة الملف أو حذفه قبل الإرسال.
        </div>
        <div class="card mb-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <span>Attachments</span>
                <button type="button" id="addAttachment" class="btn btn-light btn-sm">Add Attachment</button>
            </div>
            <div class="card-body" id="attachmentContainer">
                <!-- Attachment items will be inserted here -->
            </div>
        </div>

        
        <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Register</button>
        </div>
    </form>
</div>
@endsection













@push('scripts')
<script>
    let attachmentIndex = 0;//49f4cf8eece30d1f37614ec39889fd4e
    const maxAttachments = 10;
    const maxSizeMB = 10;

    document.getElementById('addAttachment').addEventListener('click', function () {
        if (attachmentIndex >= maxAttachments) {
            alert('You can upload a maximum of 10 files.');
            return;
        }

        const attachmentCard = document.createElement('div');
        attachmentCard.className = 'card mb-3 shadow-sm position-relative';
        attachmentCard.innerHTML = `
            <div class="card-body row">
                <div class="form-group col-md-5">
                    <label>Attachment Type</label>
                    <select name="attachments[${attachmentIndex}][type]" class="form-control" required>
                        @foreach ($attTypes as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label>Choose File (Max 10MB)</label>
                    <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control attachment-file" accept=".pdf,image/*" required>
                    <small class="text-muted">Allowed: images, PDF</small>
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-danger w-100 removeAttachment">X</button>
                </div>
                <div class="col-12 mt-2 preview-area"></div>
            </div>
        `;
        document.getElementById('attachmentContainer').appendChild(attachmentCard);

        // Handle remove
        attachmentCard.querySelector('.removeAttachment').addEventListener('click', function () {
            attachmentCard.remove();
            attachmentIndex--;
        });

        // Handle preview and size limit
        const fileInput = attachmentCard.querySelector('.attachment-file');
        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            const previewArea = attachmentCard.querySelector('.preview-area');
            previewArea.innerHTML = '';

            if (file) {
                if (file.size > maxSizeMB * 1024 * 1024) {
                    alert('File exceeds max size of 10 MB');
                    this.value = ''; // Clear input
                    return;
                }

                const reader = new FileReader();
                reader.onload = function (e) {
                    if (file.type.includes('image')) {
                        previewArea.innerHTML = `<img src="${e.target.result}" class="img-thumbnail mt-2" style="max-height: 150px;">`;
                    } else if (file.type === 'application/pdf') {
                        previewArea.innerHTML = `<embed src="${e.target.result}" type="application/pdf" width="100%" height="150px" class="mt-2" />`;
                    }
                };
                reader.readAsDataURL(file);
            }
        });

        attachmentIndex++;
    });
</script>
@endpush
