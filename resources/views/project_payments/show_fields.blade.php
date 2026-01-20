<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Id:') !!}
    <p>{{ $projectPayment->project_id }}</p>
</div>

<!-- Payment No Field -->
<div class="col-sm-12">
    {!! Form::label('payment_no', 'Payment No:') !!}
    <p>{{ $projectPayment->payment_no }}</p>
</div>

<!-- Payer Type Field -->
<div class="col-sm-12">
    {!! Form::label('payer_type', 'Payer Type:') !!}
    <p>{{ $projectPayment->payer_type }}</p>
</div>

<!-- Total Amount Field -->
<div class="col-sm-12">
    {!! Form::label('total_amount', 'Total Amount:') !!}
    <p>{{ $projectPayment->total_amount }}</p>
</div>

<!-- Vat Amount Field -->
<div class="col-sm-12">
    {!! Form::label('vat_amount', 'Vat Amount:') !!}
    <p>{{ $projectPayment->vat_amount }}</p>
</div>

<!-- Net Amount Field -->
<div class="col-sm-12">
    {!! Form::label('net_amount', 'Net Amount:') !!}
    <p>{{ $projectPayment->net_amount }}</p>
</div>

<!-- Payment Date Field -->
<div class="col-sm-12">
    {!! Form::label('payment_date', 'Payment Date:') !!}
    <p>{{ $projectPayment->payment_date }}</p>
</div>

<!-- Attachment Field -->
<div class="col-sm-12">
    {!! Form::label('attachment', 'Attachment:') !!}
    <p>{{ $projectPayment->attachment }}</p>
</div>

