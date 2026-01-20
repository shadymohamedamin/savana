@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h3>{{ __('Edit') }} {{ __('دفعة مشروع') }}</h3>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color:#f5f5dc;">

        {!! Form::model($projectPayment, [
            'route' => ['projects.project-payments.update', $projectPayment->id],
            'method' => 'PUT',
            'files' => true
        ]) !!}

        <input type="hidden" name="project_id" value="{{ $projectPayment->project_id }}">

        <div class="card-body d-flex flex-wrap gap-3">

            <div style="min-width:250px;">
                {!! Form::label('payment_no', __('رقم الدفعة')) !!}
                {!! Form::number('payment_no', null, ['class'=>'form-control','required']) !!}
            </div>

            <div style="min-width:250px;">
                {!! Form::label('payer_type', __('نوع الممول')) !!}
                {!! Form::select('payer_type', [
                    'bank'=>'البنك',
                    'owner'=>'المالك'
                ], null, ['class'=>'form-control','required']) !!}
            </div>

            <div style="min-width:250px;">
                {!! Form::label('net_amount', __('بدون ضريبة')) !!}
                {!! Form::number('net_amount', null, [
                    'class'=>'form-control',
                    'step'=>'0.01',
                    'id'=>'net_amount'
                ]) !!}
            </div>

            <div style="min-width:250px;">
                {!! Form::label('vat_amount', __('الضريبة')) !!}
                {!! Form::number('vat_amount', null, [
                    'class'=>'form-control',
                    'step'=>'0.01',
                    'id'=>'vat_amount'
                ]) !!}
            </div>

            <div style="min-width:250px;">
                {!! Form::label('total_amount', __('الإجمالي')) !!}
                {!! Form::number('total_amount', null, [
                    'class'=>'form-control',
                    'step'=>'0.01',
                    'readonly',
                    'id'=>'total_amount'
                ]) !!}
            </div>

            <div style="min-width:250px;">
                {!! Form::label('payment_date', __('تاريخ الدفعة')) !!}
                {!! Form::date('payment_date', null, ['class'=>'form-control']) !!}
            </div>

            <div style="min-width:250px;">
                {!! Form::label('attachment', __('المرفق')) !!}
                {!! Form::file('attachment', ['class'=>'form-control']) !!}

                @if($projectPayment->attachment)
                    <a href="{{ asset('Files/'.$projectPayment->attachment) }}"
                       target="_blank">
                        {{ __('View current file') }}
                    </a>
                @endif
            </div>

        </div>

        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('Update'), ['class'=>'btn btn-olive btn-sm']) !!}
            <a href="{{ route('projects.project-payments.index', $projectPayment->project_id) }}"
               class="btn btn-secondary btn-sm">
                {{ __('Back') }}
            </a>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection

@push('scripts')
<script>
    function calculateTotal() {
        let net = parseFloat(document.getElementById('net_amount').value) || 0;
        let vat = parseFloat(document.getElementById('vat_amount').value) || 0;
        document.getElementById('total_amount').value = (net + vat).toFixed(2);
    }

    document.getElementById('net_amount').addEventListener('input', calculateTotal);
    document.getElementById('vat_amount').addEventListener('input', calculateTotal);
</script>
@endpush
