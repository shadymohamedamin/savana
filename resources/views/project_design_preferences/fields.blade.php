<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Villa Style Field -->
<div class="form-group col-sm-6">
    {!! Form::label('villa_style', 'Villa Style:') !!}
    {!! Form::text('villa_style', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Floors Count Field -->
<div class="form-group col-sm-6">
    {!! Form::label('floors_count', 'Floors Count:') !!}
    {!! Form::number('floors_count', null, ['class' => 'form-control']) !!}
</div>

<!-- Villa Door Field -->
<div class="form-group col-sm-6">
    {!! Form::label('villa_door', 'Villa Door:') !!}
    {!! Form::text('villa_door', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Villa Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('villa_location', 'Villa Location:') !!}
    {!! Form::text('villa_location', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Double Height Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('double_height', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('double_height', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('double_height', 'Double Height', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Open Living Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('open_living', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('open_living', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('open_living', 'Open Living', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Villa Connection Field -->
<div class="form-group col-sm-6">
    {!! Form::label('villa_connection', 'Villa Connection:') !!}
    {!! Form::text('villa_connection', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Ceiling Height Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ceiling_height', 'Ceiling Height:') !!}
    {!! Form::number('ceiling_height', null, ['class' => 'form-control']) !!}
</div>

<!-- Internal Garden View Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('internal_garden_view', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('internal_garden_view', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('internal_garden_view', 'Internal Garden View', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Stairs Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stairs_location', 'Stairs Location:') !!}
    {!! Form::text('stairs_location', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Pantry Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('pantry_location', 'Pantry Location:') !!}
    {!! Form::text('pantry_location', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Service Doors Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_doors', 'Service Doors:') !!}
    {!! Form::text('service_doors', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Future Elevator Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('future_elevator', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('future_elevator', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('future_elevator', 'Future Elevator', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Internal Courtyard Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('internal_courtyard', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('internal_courtyard', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('internal_courtyard', 'Internal Courtyard', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Villa Shape Field -->
<div class="form-group col-sm-6">
    {!! Form::label('villa_shape', 'Villa Shape:') !!}
    {!! Form::text('villa_shape', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Dining Serves Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dining_serves', 'Dining Serves:') !!}
    {!! Form::text('dining_serves', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Stairs Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stairs_type', 'Stairs Type:') !!}
    {!! Form::text('stairs_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Ac Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ac_type', 'Ac Type:') !!}
    {!! Form::text('ac_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Doors Height Field -->
<div class="form-group col-sm-6">
    {!! Form::label('doors_height', 'Doors Height:') !!}
    {!! Form::text('doors_height', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Furniture Level Field -->
<div class="form-group col-sm-6">
    {!! Form::label('furniture_level', 'Furniture Level:') !!}
    {!! Form::text('furniture_level', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Bathroom Chairs Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bathroom_chairs', 'Bathroom Chairs:') !!}
    {!! Form::text('bathroom_chairs', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>

<!-- Underground Tank Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('underground_tank', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('underground_tank', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('underground_tank', 'Underground Tank', ['class' => 'form-check-label']) !!}
    </div>
</div>

<!-- Skirting Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('skirting_type', 'Skirting Type:') !!}
    {!! Form::text('skirting_type', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>