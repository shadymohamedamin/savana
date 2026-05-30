<!-- Project Id Field -->
<div class="col-sm-12">
    {!! Form::label('project_id', 'Project Id:') !!}
    <p>{{ $projectMessage->project_id }}</p>
</div>

<!-- Sender Id Field -->
<div class="col-sm-12">
    {!! Form::label('sender_id', 'Sender Id:') !!}
    <p>{{ $projectMessage->sender_id }}</p>
</div>

<!-- Receiver Id Field -->
<div class="col-sm-12">
    {!! Form::label('receiver_id', 'Receiver Id:') !!}
    <p>{{ $projectMessage->receiver_id }}</p>
</div>

<!-- Cc User Id Field -->
<div class="col-sm-12">
    {!! Form::label('cc_user_id', 'Cc User Id:') !!}
    <p>{{ $projectMessage->cc_user_id }}</p>
</div>

<!-- Message Type Id Field -->
<div class="col-sm-12">
    {!! Form::label('message_type_id', 'Message Type Id:') !!}
    <p>{{ $projectMessage->message_type_id }}</p>
</div>

<!-- Message Field -->
<div class="col-sm-12">
    {!! Form::label('message', 'Message:') !!}
    <p>{{ $projectMessage->message }}</p>
</div>

<!-- Attachment Field -->
<div class="col-sm-12">
    {!! Form::label('attachment', 'Attachment:') !!}
    <p>{{ $projectMessage->attachment }}</p>
</div>

