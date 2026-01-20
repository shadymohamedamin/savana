@extends('layouts.app')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <h3>{{ __('Create') }} {{ __('دفعة مشروع') }}</h3>
    </div>
</section>




<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color:#f5f5dc;">

        {!! Form::open([
            'route' => ['projects.project-payments.store', $project->id],
            'files' => true
        ]) !!}

        <input type="hidden" name="project_id" value="{{ $project->id }}">

        <div class="card-body d-flex flex-wrap gap-3">

            @php
                $nextPaymentNo = $project->payments()->count() + 1;

            @endphp
            {{-- Payment No (display only) --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('payment_no_display', __('رقم الدفعة')) !!}
                <input type="number"
                    class="form-control"
                    value="{{ $nextPaymentNo }}"
                    disabled>
            </div>

            {{-- Hidden field (sent to backend) --}}
            <input type="hidden" name="payment_no" value="{{ $nextPaymentNo }}">



            {{-- Payer Type --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('payer_type', __('نوع الممول')) !!}
                {!! Form::select('payer_type', [
                    'bank' => 'البنك',
                    'owner' => 'المالك'
                ], null, [
                    'class' => 'form-control',
                    'placeholder' => '-- اختر --',
                    'required'
                ]) !!}
            </div>

            
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('total_amount', __('إجمالي الدفعة (شامل الضريبة)')) !!}
                {!! Form::number('total_amount', null, [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'required',
                    'id' => 'total_amount'
                ]) !!}
            </div>

            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('vat_amount', __('قيمة الضريبة (5%)')) !!}
                {!! Form::number('vat_amount', null, [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'readonly',
                    'id' => 'vat_amount'
                ]) !!}
            </div>


            

            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('net_amount', __('قيمة الدفعة بدون ضريبة')) !!}
                {!! Form::number('net_amount', null, [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'readonly',
                    'id' => 'net_amount'
                ]) !!}
            </div>
            {{-- Payment Date --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('payment_date', __('تاريخ الدفعة')) !!}
                {!! Form::date('payment_date', null, [
                    'class' => 'form-control'
                ]) !!}
            </div>

            {{-- Attachment --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('attachment', __('المرفق')) !!}
                {!! Form::file('attachment', [
                    'class' => 'form-control'
                ]) !!}
            </div>

        </div>

        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('Save'), [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;'
            ]) !!}

            <a href="{{ route('projects.project-payments.index', $project->id) }}"
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
    function calculateFromTotal() {
        let total = parseFloat(document.getElementById('total_amount').value) || 0;

        // VAT = 5%
        let vat = total * 0.05;

        // Net = total / 1.05
        let net = total / 1.05;

        document.getElementById('vat_amount').value = vat.toFixed(2);
        document.getElementById('net_amount').value = net.toFixed(2);
    }

    document.getElementById('total_amount')
        .addEventListener('input', calculateFromTotal);
</script>
@endpush

