<!-- Senderid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('SenderID', 'Senderid:') !!}
    {!! Form::number('SenderID', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Receiverid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ReceiverID', 'Receiverid:') !!}
    {!! Form::number('ReceiverID', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Alertmsg Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('AlertMsg', 'Alertmsg:') !!}
    {!! Form::textarea('AlertMsg', null, ['class' => 'form-control']) !!}
</div>

<!-- Alertdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('AlertDate', 'Alertdate:') !!}
    {!! Form::text('AlertDate', null, ['class' => 'form-control','id'=>'AlertDate']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#AlertDate').datepicker()
    </script>
@endpush

<!-- Readstatus Field -->
<div class="form-group col-sm-6">
    <div class="form-check">
        {!! Form::hidden('ReadStatus', 0, ['class' => 'form-check-input']) !!}
        {!! Form::checkbox('ReadStatus', '1', null, ['class' => 'form-check-input']) !!}
        {!! Form::label('ReadStatus', 'Readstatus', ['class' => 'form-check-label']) !!}
    </div>
</div>