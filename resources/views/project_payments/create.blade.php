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

            <!-- {{-- Attachment --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('attachment', __('المرفق')) !!}
                {!! Form::file('attachment', [
                    'class' => 'form-control'
                ]) !!}
            </div> -->


            <div class="col-md-3">
                <div class="border rounded p-2 small bg-light attachment-box">
                    <input type="hidden" name="attachments[1][delete]" value="0" class="delete-flag">
                    <input type="file" name="attachments[1][file]" class="form-control form-control-sm attachment-input mb-1">
                    <div class="text-truncate selected-file-name d-none"></div>

                    @if(isset($projectPayment) && $projectPayment->attachment)
                        <a href="{{ asset('Files/'.$projectPayment->attachment) }}"
                        target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 View File
                        </a>
                    @endif

                    <a href="#" target="_blank" class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">👁 Preview</a>

                    <button type="button" class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">🗑 Remove</button>
                </div>
            </div>

            {{-- الملف 2 و 3 --}}
            @for($i = 2; $i <= 3; $i++)
            <div class="col-md-3">
                <div class="border rounded p-2 small bg-light attachment-box">
                    <input type="hidden" name="attachments[{{ $i }}][delete]" value="0" class="delete-flag">
                    <input type="file" name="attachments[{{ $i }}][file]" class="form-control form-control-sm attachment-input mb-1">
                    <div class="text-truncate selected-file-name d-none"></div>

                    @php $file = $projectPayment->{'attachment_'.$i} ?? null; @endphp
                    @if($file)
                        <a href="{{ asset('Files/'.$file) }}"
                        target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 View File
                        </a>
                    @endif

                    <a href="#" target="_blank" class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">👁 Preview</a>

                    <button type="button" class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">🗑 Remove</button>
                </div>
            </div>
            @endfor


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

document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.attachment-input').forEach(input => {
        input.addEventListener('change', function () {
            const box = this.closest('.attachment-box');
            const fileName = box.querySelector('.selected-file-name');
            const preview = box.querySelector('.preview-file');
            const stored = box.querySelector('.stored-file');

            if (!this.files.length) return;

            const file = this.files[0];
            fileName.textContent = file.name;
            fileName.classList.remove('d-none');

            if (stored) stored.classList.add('d-none');

            preview.href = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        });
    });

    document.querySelectorAll('.remove-file').forEach(btn => {
        btn.addEventListener('click', function () {
            const box = this.closest('.attachment-box');
            box.querySelector('.attachment-input').value = '';
            box.querySelector('.delete-flag').value = 1;

            box.querySelectorAll('.preview-file,.stored-file,.selected-file-name')
               .forEach(el => el?.classList.add('d-none'));
        });
    });

});



    function calculateFromTotal() {
        let total = parseFloat(document.getElementById('total_amount').value) || 0;

        // VAT = 5%
        let vat = total/21; //* 0.05;

        // Net = total / 1.05
        let net = total-vat;//total / 1.05;

        document.getElementById('vat_amount').value = vat.toFixed(2);
        document.getElementById('net_amount').value = net.toFixed(2);
    }

    document.getElementById('total_amount')
        .addEventListener('input', calculateFromTotal);
</script>
@endpush

