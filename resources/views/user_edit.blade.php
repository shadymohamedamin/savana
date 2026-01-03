





@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') {{-- important for PUT/PATCH requests --}}

                        <!-- <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nam') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name', $user->name) }}" required autocomplete="name"
                                    autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email', $user->email) }}" required
                                    autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="uae_id"
                                class="col-md-4 col-form-label text-md-end">{{ __('UAE ID') }}</label>

                            <div class="col-md-6">
                                <input id="uae_id" type="text"
                                    class="form-control @error('uae_id') is-invalid @enderror"
                                    name="uae_id" value="{{ old('uae_id', $user->uae_id) }}" required
                                    autocomplete="uae_id">

                                @error('uae_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="mobile"
                                class="col-md-4 col-form-label text-md-end">{{ __('Mobile Number') }}</label>

                            <div class="col-md-6">
                                <input id="mobile" type="text"
                                    class="form-control @error('mobile') is-invalid @enderror"
                                    name="mobile" value="{{ old('mobile', $user->mobile) }}" required
                                    autocomplete="mobile">

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label
                                class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                            <div class="col-md-6 d-flex align-items-center gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex_male"
                                        value="2" {{ old('sex', $user->sex) == 2 ? 'checked' : '' }} required>
                                    <label class="form-check-label" for="sex_male">
                                        {{ __('Male') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sex" id="sex_female"
                                        value="1" {{ old('sex', $user->sex) == 1 ? 'checked' : '' }} required>
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

                            //['label' => 'UAE ID', 'name' => 'uae_id', 'source' => 'user'],
                        </div> -->

        @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">Edit User Information</div>
            <div class="card-body">
                @foreach ([
                    ['label' => 'Name (Arabic)', 'name' => 'Nam'],
                    ['label' => 'Name (English)', 'name' => 'NamEn'],
                    ['label' => 'Email Address', 'name' => 'email', 'source' => 'user', 'type' => 'email'],
                    
                    ['label' => 'Mobile Number', 'name' => 'mobile', 'source' => 'user'],
                ] as $field)
                    @php
                        $type = $field['type'] ?? 'text';
                        $source = $field['source'] ?? 'primaryData';
                        $model = $$source; // resolves to $user or $primaryData
                    @endphp

                    <div class="mb-3">
                        <label for="{{ $field['name'] }}" class="form-label">{{ $field['label'] }}</label>
                        <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $type }}"
                            class="form-control @error($field['name']) is-invalid @enderror"
                            value="{{ old($field['name'], $model->{$field['name']} ?? '') }}">
                        @error($field['name'])
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                @endforeach




                 <div class="row mb-3">
                    <label
                        class="col-md-4 col-form-label text-md-end">{{ __('Gender') }}</label>

                    <div class="col-md-6 d-flex align-items-center gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="sex_male"
                                value="2" {{ old('sex', $user->sex) == 2 ? 'checked' : '' }} required>
                            <label class="form-check-label" for="sex_male">
                                {{ __('Male') }}
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="sex" id="sex_female"
                                value="1" {{ old('sex', $user->sex) == 1 ? 'checked' : '' }} required>
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

            </div>
        </div>









        {{-- ✅ Updated Primary Data --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Primary Data</div>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    {!! Form::label('Section', 'Section') !!}
                    {!! Form::select('Section', ['1' => 'مواطن', '0' => 'وافد'], old('Section', $primaryData->Section ?? ''), ['class' => 'form-control' . ($errors->has('Section') ? ' is-invalid' : '')]) !!}
                    @error('Section') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                

                <div class="form-group col-md-4">
                    {!! Form::label('Trustee', 'Trustee (Arabic)') !!}
                    {!! Form::text('Trustee', old('Trustee', $primaryData->Trustee ?? ''), ['class' => 'form-control' . ($errors->has('Trustee') ? ' is-invalid' : '')]) !!}
                    @error('Trustee') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                

                <div class="form-group col-md-4">
                    {!! Form::label('TrusteeEn', 'TrusteeEn') !!}
                    {!! Form::text('TrusteeEn', old('TrusteeEn', $primaryData->TrusteeEn ?? ''), ['class' => 'form-control' . ($errors->has('TrusteeEn') ? ' is-invalid' : '')]) !!}
                    @error('TrusteeEn') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('DateOfBirth', 'Date of Birth') !!}
                    {!! Form::date('DateOfBirth', old('DateOfBirth', $primaryData->DateOfBirth ?? ''), ['class' => 'form-control' . ($errors->has('DateOfBirth') ? ' is-invalid' : '')]) !!}
                    @error('DateOfBirth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                

                <div class="form-group col-md-4">
                    {!! Form::label('Nationality', 'Nationality') !!}
                    {!! Form::select('Nationality', $nationalities, old('Nationality', $primaryData->Nationality ?? ''), ['class' => 'form-control' . ($errors->has('Nationality') ? ' is-invalid' : ''), 'placeholder' => 'Select Nationality']) !!}
                    @error('Nationality') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <div class="form-group col-md-4">
                    {!! Form::label('Career', 'Career') !!}
                    {!! Form::select('Career', $careers, old('Career', $primaryData->Career ?? ''), ['class' => 'form-control' . ($errors->has('Career') ? ' is-invalid' : ''), 'placeholder' => 'Select Career']) !!}
                    @error('Career') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('CareerAddress', 'Career Address') !!}
                    {!! Form::text('CareerAddress', old('CareerAddress', $primaryData->CareerAddress ?? ''), ['class' => 'form-control' . ($errors->has('CareerAddress') ? ' is-invalid' : '')]) !!}

                    @error('CareerAddress') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('FamilyCount', 'Family Count') !!}
                    {!! Form::number('FamilyCount', old('FamilyCount', $primaryData->FamilyCount ?? ''), ['class' => 'form-control' . ($errors->has('FamilyCount') ? ' is-invalid' : '')]) !!}
                    @error('FamilyCount') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group col-md-4">
                    {!! Form::label('InSchool', 'In School') !!}
                    {!! Form::number('InSchool', old('InSchool', $primaryData->InSchool ?? ''), ['class' => 'form-control' . ($errors->has('InSchool') ? ' is-invalid' : '')]) !!}
                    @error('InSchool') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>


                <div class="form-group col-md-4">
                    {!! Form::label('MaritalStatus', 'Marital Status') !!}
                    {!! Form::select('MaritalStatus', $maritalStatuses, old('MaritalStatus', $primaryData->MaritalStatus ?? ''), ['class' => 'form-control' . ($errors->has('MaritalStatus') ? ' is-invalid' : ''), 'placeholder' => 'Select Status']) !!}
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
                    {!! Form::text('WifeName', old('WifeName', $primaryData->WifeName ?? ''), ['class' => 'form-control' . ($errors->has('WifeName') ? ' is-invalid' : '')]) !!}
                    @error('WifeName') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('WifeAddress', 'Wife Address') !!}
                    {!! Form::text('WifeAddress', old('WifeAddress', $primaryData->WifeAddress ?? ''), ['class' => 'form-control' . ($errors->has('WifeAddress') ? ' is-invalid' : '')]) !!}
                    @error('WifeAddress') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('WifeCareer', 'Wife Career') !!}
                    {!! Form::select('WifeCareer', $careers, old('WifeCareer', $primaryData->WifeCareer ?? ''), ['class' => 'form-control' . ($errors->has('WifeCareer') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                    @error('WifeCareer') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('WifeNationality', 'Wife Nationality') !!}
                    {!! Form::select('WifeNationality', $nationalities, old('WifeNationality', $primaryData->WifeNationality ?? ''), ['class' => 'form-control' . ($errors->has('WifeNationality') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
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
                    {!! Form::select('Region', $regions, old('Region', $primaryData->Region ?? ''), ['class' => 'form-control' . ($errors->has('Region') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                    @error('Region') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="form-group col-md-4">
                    {!! Form::label('HouseType', 'House Type') !!}
                    {!! Form::select('HouseType', $houseTypes, old('HouseType', $primaryData->HouseType ?? ''), ['class' => 'form-control' . ($errors->has('HouseType') ? ' is-invalid' : ''), 'placeholder' => 'Select']) !!}
                    @error('HouseType') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
        </div>







        <div class="card mb-4">
            <div class="card-header bg-warning">Support Info</div>
            <div class="card-body">
                @foreach ([
                    ['label' => 'help_type', 'name' => 'help_type'],
                    ['label' => 'support_ammount_user', 'name' => 'support_ammount_user', 'type' => 'number'],
                    ['label' => 'case_description_user', 'name' => 'case_description_user', 'type' => 'textarea'],
                ] as $field)
                    @php 
                        $type = $field['type'] ?? 'text';
                        $value = old($field['name'], $supports->{$field['name']} ?? '');
                    @endphp

                    <div class="mb-3">
                        <label for="{{ $field['name'] }}" class="form-label">{{ ucfirst(str_replace('_', ' ', $field['label'])) }}</label>

                        @if ($type === 'textarea')
                            <textarea id="{{ $field['name'] }}" name="{{ $field['name'] }}"
                                class="form-control @error($field['name']) is-invalid @enderror">{{ $value }}</textarea>
                        @else
                            <input id="{{ $field['name'] }}" name="{{ $field['name'] }}" type="{{ $type }}"
                                class="form-control @error($field['name']) is-invalid @enderror"
                                value="{{ $value }}">
                        @endif

                        @error($field['name'])
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                @endforeach
            </div>
        </div>









        
{{-- Instructions --}}
<div class="alert alert-info text-right">
    <strong>تعليمات رفع الملفات:</strong><br>
    - يُسمح برفع <strong>10 ملفات كحد أقصى</strong>.<br>
    - يجب ألا يتجاوز <strong>حجم كل ملف 10 ميغابايت</strong>.<br>
    - الأنواع المسموح بها: <strong>PDF</strong> و <strong>صور (JPG, PNG)</strong>.<br>
    - اختر <strong>نوع المرفق</strong> ثم الملف المناسب، ويمكنك معاينة الملف أو حذفه قبل الإرسال.
</div>

<!-- {{-- Attachment Section --}}
<div class="card mb-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <span>Attachments</span>
        <button type="button" id="addAttachment" class="btn btn-light btn-sm">Add Attachment</button>
    </div>
    <div class="card-body" id="attachmentContainer">

        {{-- Existing Attachments --}}
        @foreach($attachments as $index => $attachment)
            @php
                // Normalize path and generate file URL
                $filename = basename(str_replace(['\\', '$'], ['/', ''], $attachment->AttPath ?? $attachment->File));
                $fileUrl = "http://supports.rakcharity.ae:3333/Files/$filename";
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            @endphp

            <div class="card mb-3 shadow-sm position-relative attachment-item existing-attachment">
                <input type="hidden" name="attachments[{{ $index }}][id]" value="{{ $attachment->id }}">

                <div class="card-body row gy-2">
                    {{-- Attachment Type --}}
                    <div class="form-group col-md-4 col-12">
                        <label>Attachment Type</label>
                        <select name="attachments[{{ $index }}][type]" class="form-control" required>
                            @foreach ($attTypes as $key => $value)
                                <option value="{{ $key }}" {{ $attachment->AttType == $key ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- File Replace --}}
                    <div class="form-group col-md-4 col-12">
                        <label>Replace File (Optional)</label>
                        <input type="file" name="attachments[{{ $index }}][file]" class="form-control attachment-file" accept=".pdf,image/*">
                        <small class="text-muted">Leave blank to keep existing file</small>
                    </div>

                    {{-- Actions --}}
                    <div class="form-group col-md-4 col-12 d-flex align-items-end gap-2">
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-primary btn-sm w-50">
                            View
                        </a>
                        <button type="button" class="btn btn-danger btn-sm w-50 removeAttachment">
                            Remove
                        </button>
                    </div>

                    {{-- Preview --}}
                    <div class="col-12 mt-2 preview-area">
                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                            <img src="{{ $fileUrl }}" class="img-thumbnail mt-2" style="max-height: 150px;">
                        @elseif($ext === 'pdf')
                            <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="150px" class="mt-2" />
                        @else
                            <p>No preview available</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Dynamic attachments will be added here --}}
    </div>
</div>

 -->


{{-- Attachment Section --}}
<div class="card mb-4">
    <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
        <span>Attachments</span>
        <button type="button" id="addAttachment" class="btn btn-light btn-sm">Add Attachment</button>
    </div>

    <div class="card-body" id="attachmentContainer">
        {{-- Existing Attachments --}}
        @foreach($attachments as $index => $attachment)
            @php
                $filename = basename(str_replace(['\\', '$'], ['/', ''], $attachment->AttPath ?? $attachment->File));
                $fileUrl = "http://supports.rakcharity.ae:3333/Files/$filename";
                $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            @endphp

            <div class="card mb-3 shadow-sm position-relative attachment-item existing-attachment">
                {{-- Send attachment ID --}}
                <input type="hidden" name="attachments[{{ $index }}][id]" value="{{ $attachment->ID ?? $attachment->id }}">

                <div class="card-body row gy-3">
                    {{-- Attachment Type --}}
                    <div class="form-group col-md-4 col-12">
                        <label>Attachment Type</label>
                        <select name="attachments[{{ $index }}][type]" class="form-control" required>
                            <option disabled selected value="">اختر نوع المرفق</option>
                            
                            @foreach ($attTypes as $key => $value)
                                
                                <option value="{{ $key }}" {{ (isset($attachment->AttType) && $attachment->AttType == $key) ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Replace File Input --}}
                    <div class="form-group col-md-4 col-12">
                        <label>Replace File (Optional)</label>
                        <input type="hidden" name="attachments[{{ $index }}][id]" value="{{ $attachment->ID }}">
                        <!-- <select name="attachments[{{ $index }}][type]">...</select> -->


                        <input type="file" name="attachments[{{ $index }}][file]" class="form-control" accept=".pdf,image/*">
                        <small class="text-muted">Keep blank to retain current file</small>
                    </div>

                    {{-- Actions: View / Remove --}}
                    <div class="form-group col-md-4 col-12 d-flex align-items-end justify-content-between gap-2">
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm w-50">View</a>
                        <button type="button" class="btn btn-outline-danger btn-sm w-50 removeAttachment">Remove</button>
                    </div>

                    {{-- File Preview --}}
                    <div class="col-12 mt-2 preview-area">
                        @if(in_array($ext, ['jpg', 'jpeg', 'png']))
                            <img src="{{ $fileUrl }}" class="img-fluid rounded border" style="max-height: 150px;">
                        @elseif($ext === 'pdf')
                            <embed src="{{ $fileUrl }}" type="application/pdf" width="100%" height="150px" class="border" />
                        @else
                            <p class="text-muted">No preview available</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

        {{-- Dynamic attachments will be appended here via JS --}}
    </div>
</div>







        {{-- Submit --}}
        <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Update</button>
        </div>
    </form>
</div>
@endsection

















@push('scripts')
<script>
    let attachmentIndex = {{ count($attachments) }};
    const maxAttachments = 10;
    const maxSizeMB = 10;

    document.getElementById('addAttachment').addEventListener('click', function () {
        if (attachmentIndex >= maxAttachments) {
            alert('You can upload a maximum of 10 files.');
            return;
        }

        const container = document.getElementById('attachmentContainer');
        const card = document.createElement('div');
        card.className = 'card mb-3 shadow-sm position-relative attachment-item';
        card.innerHTML = `
            <div class="card-body">
                <div class="row justify-content-center align-items-center text-center">
                    <div class="form-group col-md-4 col-12">
                        <label>Attachment Type</label>
                        <select name="attachments[${attachmentIndex}][type]" class="form-control" required>
                            @foreach ($attTypes as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-12">
                        <label>Choose File (Max 10MB)</label>
                        <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control attachment-file" accept=".pdf,image/*" required>
                        <small class="text-muted">Allowed: images, PDF</small>
                    </div>
                    <div class="form-group col-md-4 col-12 d-flex align-items-end justify-content-center gap-2">
                        <button type="button" class="btn btn-outline-danger btn-sm w-50 removeAttachment">Remove</button>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 preview-area text-center"></div>
                </div>
            </div>
        `;
        container.appendChild(card);


        // Add event listeners
        card.querySelector('.removeAttachment').addEventListener('click', function () {
            card.remove();
            attachmentIndex--;
        });

        const fileInput = card.querySelector('.attachment-file');
        const previewArea = card.querySelector('.preview-area');

        fileInput.addEventListener('change', function () {
            const file = this.files[0];
            previewArea.innerHTML = '';

            if (file) {
                if (file.size > maxSizeMB * 1024 * 1024) {
                    alert('File exceeds max size of 10 MB');
                    this.value = '';
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

    // Remove existing attachments
    document.querySelectorAll('.existing-attachment .removeAttachment').forEach(button => {
        button.addEventListener('click', function () {
            this.closest('.existing-attachment').remove();
        });
    });
</script>
@endpush
