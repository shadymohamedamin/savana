<!-- Atttype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AttType', 'Atttype:') !!}
    {!! Form::text('AttType', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Prefix Field -->
<div class="form-group col-sm-6">
    {!! Form::label('Prefix', 'Prefix:') !!}
    {!! Form::text('Prefix', null, ['class' => 'form-control', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Maxsizekb Field -->
<div class="form-group col-sm-6">
    {!! Form::label('MaxSizeKB', 'Maxsizekb:') !!}
    {!! Form::number('MaxSizeKB', null, ['class' => 'form-control']) !!}
</div>