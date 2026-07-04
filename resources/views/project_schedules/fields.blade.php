<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Item No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('item_no', 'Item No:') !!}
    {!! Form::number('item_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Payment Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_percentage', 'Payment Percentage:') !!}
    {!! Form::number('payment_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Completion Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('completion_percentage', 'Completion Percentage:') !!}
    {!! Form::number('completion_percentage', null, ['class' => 'form-control']) !!}
</div>

<!-- Subsequent Percentage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subsequent_percentage', 'Subsequent Percentage:') !!}
    {!! Form::number('subsequent_percentage', null, ['class' => 'form-control', 'step' => '0.0001']) !!}
</div>

<!-- Duration Days Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration_days', 'Duration Days:') !!}
    {!! Form::number('duration_days', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::number('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Due Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('due_date', 'Due Date:') !!}
    {!! Form::text('due_date', null, ['class' => 'form-control','id'=>'due_date']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#due_date').datepicker()
    </script>
@endpush
