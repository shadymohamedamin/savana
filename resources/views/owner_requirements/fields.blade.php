<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Floor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('floor', 'Floor:') !!}
    {!! Form::text('floor', null, ['class' => 'form-control', 'required', 'maxlength' => 50, 'maxlength' => 50]) !!}
</div>

<!-- Is General Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('is_general', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('is_general', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('is_general', 'Is General', ['class' => 'form-check-label']) !!}
    </div>
</div>