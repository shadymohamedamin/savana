<!-- Senderid Field -->
<div class="col-sm-12">
    {!! Form::label('SenderID', 'Senderid:') !!}
    <p>{{ $alert->SenderID }}</p>
</div>

<!-- Receiverid Field -->
<div class="col-sm-12">
    {!! Form::label('ReceiverID', 'Receiverid:') !!}
    <p>{{ $alert->ReceiverID }}</p>
</div>

<!-- Alertmsg Field -->
<div class="col-sm-12">
    {!! Form::label('AlertMsg', 'Alertmsg:') !!}
    <p>{{ $alert->AlertMsg }}</p>
</div>

<!-- Alertdate Field -->
<div class="col-sm-12">
    {!! Form::label('AlertDate', 'Alertdate:') !!}
    <p>{{ $alert->AlertDate }}</p>
</div>

<!-- Readstatus Field -->
<div class="col-sm-12">
    {!! Form::label('ReadStatus', 'Readstatus:') !!}
    <p>{{ $alert->ReadStatus }}</p>
</div>

