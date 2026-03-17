<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Owner Requirement Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner_requirement_id', 'Owner Requirement Id:') !!}
    {!! Form::number('owner_requirement_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Quantity Field -->
<div class="form-group col-sm-6">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::number('quantity', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Unit Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('unit_price', 'Unit Price:') !!}
    {!! Form::number('unit_price', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Total Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total_price', 'Total Price:') !!}
    {!! Form::number('total_price', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Context Field -->
<div class="form-group col-sm-6">
    {!! Form::label('context', 'Context:') !!}
    {!! Form::text('context', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Tender User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tender_user_id', 'Tender User Id:') !!}
    {!! Form::number('tender_user_id', null, ['class' => 'form-control']) !!}
</div>