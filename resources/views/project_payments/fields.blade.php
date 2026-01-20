<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Payment No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_no', 'Payment No:') !!}
    {!! Form::number('payment_no', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Payer Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payer_type', 'Payer Type:') !!}
    {!! Form::text('payer_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Total Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    {!! Form::number('total_amount', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Vat Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vat_amount', 'Vat Amount:') !!}
    {!! Form::number('vat_amount', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Net Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('net_amount', 'Net Amount:') !!}
    {!! Form::number('net_amount', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Payment Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_date', 'Payment Date:') !!}
    {!! Form::text('payment_date', null, ['class' => 'form-control','id'=>'payment_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#payment_date').datepicker()
    </script>
@endpush

<!-- Attachment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attachment', 'Attachment:') !!}
    {!! Form::text('attachment', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>