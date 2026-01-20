<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Id:') !!}
    <p>{{ $projectOwnerRequirement->project_id }}</p>
</div>

<!-- Owner Requirement Id Field -->
<div class="col-sm-12">
    {!! Form::label('owner_requirement_id', 'Owner Requirement Id:') !!}
    <p>{{ $projectOwnerRequirement->owner_requirement_id }}</p>
</div>

<!-- Quantity Field -->
<div class="col-sm-12">
    {!! Form::label('quantity', 'Quantity:') !!}
    <p>{{ $projectOwnerRequirement->quantity }}</p>
</div>

