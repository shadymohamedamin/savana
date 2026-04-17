<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Batch Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('batch_id', 'Batch Id:') !!}
    {!! Form::number('batch_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Contractor Approved Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('contractor_approved', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('contractor_approved', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('contractor_approved', 'Contractor Approved', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Owner Approved Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('owner_approved', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('owner_approved', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('owner_approved', 'Owner Approved', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Consultant Approved Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('consultant_approved', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('consultant_approved', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('consultant_approved', 'Consultant Approved', ['class' => 'form-check-label']) !!}
    </div>
</div>