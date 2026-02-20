@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h3>{{ __('Edit') }} {{ __('Baladya Approval') }}</h3>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">
        {!! Form::model($baladyaApproval, ['route' => ['projects.baladya-approvals.update', $projectId, $baladyaApproval->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <input type="hidden" name="owner_id" value="{{ request('owner_id') }}">
        <input type="hidden" name="project_id" value="{{ $projectId }}">
        
        <div class="card-body d-flex flex-wrap gap-3">
            {{-- Status Type --}}
            <div style="min-width: 250px;">
                {!! Form::label('status_type_id', __('نوع الحالة')) !!}
                {!! Form::select(
                    'status_type_id',
                    $statusTypes,
                    old('status_type_id', optional($baladyaApproval)->status_type_id),
                    ['class' => 'form-control', 'required']
                ) !!}

            </div>

            {{-- Case Number --}}
            <div style="min-width: 250px;">
                {!! Form::label('case_number', __('رقم الحالة')) !!}
                {!! Form::text('case_number', $baladyaApproval->case_number, ['class' => 'form-control', 'required']) !!}
            </div>

            {{-- Opened At --}}
            <div style="min-width: 250px;">
                {!! Form::label('opened_at', __('تاريخ فتح المعاملة')) !!}
                {!! Form::date('opened_at', $baladyaApproval->opened_at?->format('Y-m-d'), ['class' => 'form-control', 'required']) !!}
            </div>

            {{-- Approved At --}}
            <div style="min-width: 250px;">
                {!! Form::label('approved_at', __('تاريخ اعتماد المعاملة')) !!}
                {!! Form::date('approved_at', $baladyaApproval->approved_at?->format('Y-m-d'), ['class' => 'form-control']) !!}
            </div>

            {{-- Reason --}}
            <div style="min-width: 250px;">
                {!! Form::label('reason', __('السبب')) !!}
                {!! Form::text('reason', $baladyaApproval->reason, ['class' => 'form-control']) !!}
            </div>

            <!-- <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('approved_file', __('الملف المعتمد')) !!}
                {!! Form::file('approved_file', ['class' => 'form-control rounded']) !!}

                @if(isset($baladyaApproval) && $baladyaApproval->approved_file)
                    <a href="{{ asset('Files/' . $baladyaApproval->approved_file) }}" target="_blank">
                        {{ __('View Current File') }}
                    </a>
                @endif
            </div> -->
            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('approved_file', __('مخططات معتمدة ')) !!}
                <input type="file" name="approved_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->approved_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->approved_file }}">
                            📄 {{ $baladyaApproval->approved_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->approved_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div>


            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('building_license_file', __('رخصة البناء')) !!}
                <input type="file" name="building_license_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->building_license_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->building_license_file }}">
                            📄 {{ $baladyaApproval->building_license_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->building_license_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div> 








<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('architect_file', __('مخطط معماري')) !!}
                <input type="file" name="architect_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->architect_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->architect_file }}">
                            📄 {{ $baladyaApproval->architect_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->architect_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div> 

<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('civil_file', __('مخطط انشائي')) !!}
                <input type="file" name="civil_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->civil_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->civil_file }}">
                            📄 {{ $baladyaApproval->civil_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->civil_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div> 
<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('electrical_file', __('مخطط كهربا')) !!}
                <input type="file" name="electrical_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->electrical_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->electrical_file }}">
                            📄 {{ $baladyaApproval->electrical_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->electrical_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div> 
<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('water_file', __('مخطط ماي')) !!}
                <input type="file" name="water_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->water_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->water_file }}">
                            📄 {{ $baladyaApproval->water_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->water_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div>
            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('etisalat_file', __('مخطط اتصالات')) !!}
                <input type="file" name="etisalat_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->etisalat_file)
                    <div class="border rounded p-2 small bg-light mt-1">
                        <div class="text-truncate" title="{{ $baladyaApproval->etisalat_file }}">
                            📄 {{ $baladyaApproval->etisalat_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->etisalat_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                            👁 {{ __('View') }}
                        </a>
                    </div>
                @endif
            </div>






            {{-- Reason --}}
            <div style="min-width: 250px;">
                {!! Form::label('building_license_number', __('رقم الرخصة')) !!}
                {!! Form::text('building_license_number', null, ['class' => 'form-control']) !!}
            </div>

        </div>

        <!-- <div class="card-footer mt-3">
            {!! Form::submit(__('Update'), ['class' => 'btn btn-olive btn-sm']) !!}
            <a href="{{ route('projects.baladya-approvals.index', $projectId) }}?owner_id={{ request('owner_id') }}"
               class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
        </div> -->

        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('حفظ'), [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;'
            ]) !!}
            <a href="{{ route('projects.baladya-approvals.index', $projectId) }}?owner_id={{ request('owner_id') }}"
               class="btn btn-secondary btn-sm">{{ __('List') }}</a>
        </div>


        {!! Form::close() !!}
    </div>
</div>
@endsection
