<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $ownerRequirement->name }}</p>
</div>

<!-- Floor Field -->
<div class="col-sm-12">
    {!! Form::label('floor', 'Floor:') !!}
    <p>{{ $ownerRequirement->floor }}</p>
</div>

<!-- Is General Field -->
<div class="col-sm-12">
    {!! Form::label('is_general', 'Is General:') !!}
    <p>{{ $ownerRequirement->is_general }}</p>
</div>

