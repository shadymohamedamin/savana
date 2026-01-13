<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Owner Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner_id', 'Owner Id:') !!}
    {!! Form::number('owner_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_type_id', 'Status Type Id:') !!}
    {!! Form::number('status_type_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Case Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('case_number', 'Case Number:') !!}
    {!! Form::text('case_number', null, ['class' => 'form-control', 'required', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Opened At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('opened_at', 'Opened At:') !!}
    {!! Form::text('opened_at', null, ['class' => 'form-control','id'=>'opened_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#opened_at').datepicker()
    </script>
@endpush

<!-- Approved At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approved_at', 'Approved At:') !!}
    {!! Form::text('approved_at', null, ['class' => 'form-control','id'=>'approved_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#approved_at').datepicker()
    </script>
@endpush

<!-- Days Diff Field -->
<div class="form-group col-sm-6">
    {!! Form::label('days_diff', 'Days Diff:') !!}
    {!! Form::number('days_diff', null, ['class' => 'form-control']) !!}
</div>

<!-- Reason Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('reason', 'Reason:') !!}
    {!! Form::textarea('reason', null, ['class' => 'form-control', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>