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