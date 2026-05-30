<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Id:') !!}
    <p>{{ $projectSupervision->project_id }}</p>
</div>

<!-- User Id Field -->
<div class="col-sm-12">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $projectSupervision->user_id }}</p>
</div>

<!-- Supervision Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('supervision_type_id', 'Supervision Type Id:') !!}
    <p>{{ $projectSupervision->supervision_type_id }}</p>
</div>

<!-- Note Field -->
<div class="col-sm-12">
    {!! Form::label('note', 'Note:') !!}
    <p>{{ $projectSupervision->note }}</p>
</div>

<!-- Attachment Field -->
<div class="col-sm-12">
    {!! Form::label('attachment', 'Attachment:') !!}
    <p>{{ $projectSupervision->attachment }}</p>
</div>

