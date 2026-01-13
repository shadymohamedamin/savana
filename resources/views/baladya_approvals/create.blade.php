@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h3>{{ __('Create') }} {{ __('اعتماد البلدية') }}</h3>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">
        {!! Form::open([
            'route' => ['projects.baladya-approvals.store', $projectId],
            'enctype' => 'multipart/form-data',
            'files' => true
        ]) !!}
        <input type="hidden" name="owner_id" value="{{ request('owner_id') }}">
        <input type="hidden" name="project_id" value="{{ $projectId }}">

        <div class="card-body d-flex flex-wrap gap-3">

            {{-- Status Type --}}
            <div style="min-width: 250px;">
                {!! Form::label('status_type_id', __('نوع الحالة')) !!}
                {!! Form::select('status_type_id', $statusTypes, null, ['class' => 'form-control', 'placeholder' => __('-- Select Type --'), 'required']) !!}
            </div>

            {{-- Case Number --}}
            <div style="min-width: 250px;">
                {!! Form::label('case_number', __('رقم الحالة')) !!}
                {!! Form::text('case_number', null, ['class' => 'form-control', 'required']) !!}
            </div>

            {{-- Opened At --}}
            <div style="min-width: 250px;">
                {!! Form::label('opened_at', __('تاريخ فتح المعاملة')) !!}
                {!! Form::date('opened_at', null, ['class' => 'form-control', 'required']) !!}
            </div>

            {{-- Approved At --}}
            <div style="min-width: 250px;">
                {!! Form::label('approved_at', __('تاريخ اعتماد المعاملة')) !!}
                {!! Form::date('approved_at', null, ['class' => 'form-control']) !!}
            </div>

            {{-- Reason --}}
            <div style="min-width: 250px;">
                {!! Form::label('reason', __('السبب')) !!}
                {!! Form::text('reason', null, ['class' => 'form-control']) !!}
            </div>


            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('approved_file', __('Approved File')) !!}
                {!! Form::file('approved_file', ['class' => 'form-control rounded']) !!}

                @if(isset($baladyaApproval) && $baladyaApproval->approved_file)
                    <a href="{{ asset('Files/' . $baladyaApproval->approved_file) }}" target="_blank">
                        {{ __('View Current File') }}
                    </a>
                @endif
            </div>

        </div>

        

        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('Save'), [
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
