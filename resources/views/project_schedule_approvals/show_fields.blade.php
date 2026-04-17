<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Id:') !!}
    <p>{{ $projectScheduleApproval->project_id }}</p>
</div>

<!-- Batch Id Field -->
<div class="col-sm-12">
    {!! Form::label('batch_id', 'Batch Id:') !!}
    <p>{{ $projectScheduleApproval->batch_id }}</p>
</div>

<!-- Contractor Approved Field -->
<div class="col-sm-12">
    {!! Form::label('contractor_approved', 'Contractor Approved:') !!}
    <p>{{ $projectScheduleApproval->contractor_approved }}</p>
</div>

<!-- Owner Approved Field -->
<div class="col-sm-12">
    {!! Form::label('owner_approved', 'Owner Approved:') !!}
    <p>{{ $projectScheduleApproval->owner_approved }}</p>
</div>

<!-- Consultant Approved Field -->
<div class="col-sm-12">
    {!! Form::label('consultant_approved', 'Consultant Approved:') !!}
    <p>{{ $projectScheduleApproval->consultant_approved }}</p>
</div>

