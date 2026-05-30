<!-- Project Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('project_id', 'Project Id:') !!}
    {!! Form::number('project_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Sender Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sender_id', 'Sender Id:') !!}
    {!! Form::number('sender_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Receiver Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('receiver_id', 'Receiver Id:') !!}
    {!! Form::number('receiver_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Cc User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cc_user_id', 'Cc User Id:') !!}
    {!! Form::number('cc_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Message Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('message_type_id', 'Message Type Id:') !!}
    {!! Form::number('message_type_id', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Message Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('message', 'Message:') !!}
    {!! Form::textarea('message', null, ['class' => 'form-control', 'required', 'maxlength' => 65535, 'maxlength' => 65535]) !!}
</div>

<!-- Attachment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attachment', 'Attachment:') !!}
    {!! Form::text('attachment', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>