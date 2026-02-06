




















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
            'route' => [
                'projects.project-payments.update',
                'project' =>$projectPayment->id,
                'id' => $projectPayment->id,
            ],
            'method' => 'PUT',
            'files' => true
        ]) !!}


        <input type="hidden" name="project_id" value="{{ $projectPayment->project_id }}">

        <div class="card-body d-flex flex-wrap gap-3">

            {{-- Payment No (display only) --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('payment_no_display', __('رقم الدفعة')) !!}
                <input type="number"
                       class="form-control"
                       value="{{ $projectPayment->payment_no }}"
                       disabled>
            </div>
            <input type="hidden" name="payment_no" value="{{ $projectPayment->payment_no }}">

            {{-- Payer Type --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('payer_type', __('نوع الممول')) !!}
                {!! Form::select('payer_type', [
                    'bank' => 'البنك',
                    'owner' => 'المالك'
                ], null, [
                    'class' => 'form-control',
                    'required'
                ]) !!}
            </div>

            {{-- Total --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('total_amount', __('إجمالي الدفعة (شامل الضريبة)')) !!}
                {!! Form::number('total_amount', null, [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'required',
                    'id' => 'total_amount'
                ]) !!}
            </div>

            {{-- VAT --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('vat_amount', __('قيمة الضريبة (5%)')) !!}
                {!! Form::number('vat_amount', null, [
                    'class' => 'form-control',
                    'step' => '0.01',
                    'readonly',
                    'id' => 'vat_amount'
                ]) !!}
            </div>

            {{-- Net --}}
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
                {!! Form::date(
                    'payment_date',
                    optional($projectPayment->payment_date)->format('Y-m-d'),
                    ['class' => 'form-control']
                ) !!}
            </div>

            {{-- Attachment 1 --}}
            <div class="col-md-3">
                <div class="border rounded p-2 small bg-light attachment-box">
                    <input type="hidden" name="attachments[1][delete]" value="0" class="delete-flag">
                    <input type="file" name="attachments[1][file]"
                           class="form-control form-control-sm attachment-input mb-1">

                    <div class="text-truncate selected-file-name d-none"></div>

                    @if($projectPayment->attachment)
                        <a href="{{ asset('Files/'.$projectPayment->attachment) }}"
                           target="_blank"
                           class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 View File
                        </a>
                    @endif

                    <a href="#" target="_blank"
                       class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
                        👁 Preview
                    </a>

                    <button type="button"
                            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
                        🗑 Remove
                    </button>
                </div>
            </div>

            {{-- Attachment 2 & 3 --}}
            @for($i = 2; $i <= 3; $i++)
            <div class="col-md-3">
                <div class="border rounded p-2 small bg-light attachment-box">
                    <input type="hidden" name="attachments[{{ $i }}][delete]" value="0" class="delete-flag">
                    <input type="file" name="attachments[{{ $i }}][file]"
                           class="form-control form-control-sm attachment-input mb-1">

                    <div class="text-truncate selected-file-name d-none"></div>

                    @php $file = $projectPayment->{'attachment_'.$i}; @endphp
                    @if($file)
                        <a href="{{ asset('Files/'.$file) }}"
                           target="_blank"
                           class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 View File
                        </a>
                    @endif

                    <a href="#" target="_blank"
                       class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
                        👁 Preview
                    </a>

                    <button type="button"
                            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
                        🗑 Remove
                    </button>
                </div>
            </div>
            @endfor

        </div>

        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('حفظ'), [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color:#2f3a1f;color:#d4af37'
            ]) !!}

            <a href="{{ route('projects.project-payments.index', $projectPayment->project_id) }}"
               class="btn btn-secondary btn-sm">
                {{ __('القائمة') }}
            </a>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection









@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    function calculateFromTotal() {
        let total = parseFloat(document.getElementById('total_amount').value) || 0;
        let vat   = total / 21;
        let net   = total - vat;

        document.getElementById('vat_amount').value = vat.toFixed(2);
        document.getElementById('net_amount').value = net.toFixed(2);
    }

    document.getElementById('total_amount')
        ?.addEventListener('input', calculateFromTotal);

    document.querySelectorAll('.attachment-input').forEach(input => {
        input.addEventListener('change', function () {
            const box = this.closest('.attachment-box');
            const name = box.querySelector('.selected-file-name');
            const preview = box.querySelector('.preview-file');
            const stored = box.querySelector('.stored-file');

            if (!this.files.length) return;

            const file = this.files[0];
            name.textContent = file.name;
            name.classList.remove('d-none');

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
               .forEach(el => el.classList.add('d-none'));
        });
    });

    calculateFromTotal(); // initial calc
});
</script>
@endpush
