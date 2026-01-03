<!-- {{-- Project Code --}}
<div class="form-group col-sm-6">
    {!! Form::label('project_code', __('Project Code')) !!}
    {!! Form::text('project_code', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 50
    ]) !!}
</div>

{{-- Name --}}
<div class="form-group col-sm-6">
    {!! Form::label('name', __('Name')) !!}
    {!! Form::text('name', null, [
        'class' => 'form-control',
        'required',
        'maxlength' => 255
    ]) !!}
</div>

{{-- Description --}}
<div class="form-group col-sm-12">
    {!! Form::label('description', __('Description')) !!}
    {!! Form::textarea('description', null, [
        'class' => 'form-control',
        'rows' => 3
    ]) !!}
</div>

{{-- Case ID Number --}}
<div class="form-group col-sm-4">
    {!! Form::label('case_id_number', __('Case #')) !!}
    {!! Form::text('case_id_number', null, [
        'class' => 'form-control',
        'maxlength' => 50
    ]) !!}
</div>

{{-- Building Number --}}
<div class="form-group col-sm-4">
    {!! Form::label('building_number', __('Building #')) !!}
    {!! Form::text('building_number', null, [
        'class' => 'form-control',
        'maxlength' => 50
    ]) !!}
</div>

{{-- Fence Number --}}
<div class="form-group col-sm-4">
    {!! Form::label('fence_number', __('Fence #')) !!}
    {!! Form::text('fence_number', null, [
        'class' => 'form-control',
        'maxlength' => 50
    ]) !!}
</div>

{{-- Status --}}
<div class="form-group col-sm-6">
    {!! Form::label('status_id', __('Status')) !!}
    {!! Form::select('status_id', $statuses, null, [
        'class' => 'form-control',
        'placeholder' => __('-- Select Status --'),
        'required'
    ]) !!}
</div>

{{-- Start Date --}}
<div class="form-group col-sm-3">
    {!! Form::label('start_date', __('Start Date')) !!}
    {!! Form::date('start_date', null, [
        'class' => 'form-control'
    ]) !!}
</div>

{{-- End Date --}}
<div class="form-group col-sm-3">
    {!! Form::label('end_date', __('End Date')) !!}
    {!! Form::date('end_date', null, [
        'class' => 'form-control'
    ]) !!}
</div> -->
