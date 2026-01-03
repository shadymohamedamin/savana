<!-- {!! Form::open(['url' => route('attachments.storeOrUpdate'), 'method' => 'POST', 'files' => true]) !!} -->
 <!-- {!! Form::open(['url' => isset($attachment) ? route('attachments.storeOrUpdate') : route('attachments.storeOrUpdate'), 'files' => true]) !!} -->
    <!-- {!! Form::hidden('CaseID', $caseId) !!}
    {!! Form::hidden('ID', $attachment->ID ?? null) !!} -->

    {{-- Attachment Type --}}
    <div class="form-group col-sm-12">
        {!! Form::label('AttID', 'Attachment Type:') !!}
        {!! Form::select('AttID', $attTypes, $attachment->AttID ?? null, ['class' => 'form-control' . ($errors->has('AttID') ? ' is-invalid' : ''), 'required']) !!}
        @error('AttID') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- File Upload --}}
    <div class="form-group col-sm-12">
        {!! Form::label('AttFile', 'Upload PDF File:') !!}
        {!! Form::file('AttFile', [
            'class' => 'form-control' . ($errors->has('AttFile') ? ' is-invalid' : ''),
            isset($attachment) ? '' : 'required',
            'accept' => 'application/pdf'
        ]) !!}

        @error('AttFile') <div class="invalid-feedback">{{ $message }}</div> @enderror

        @if (!empty($attachment?->AttPath))
            <p class="text-warning mt-2">Uploading a new file will <strong>replace</strong> the existing one.</p>
            <p class="text-muted">
                @php
                    $relativePath = str_replace('\\\\svr\\RAKcMainApp$\\', '', $attachment->AttPath);
                    $publicPath = 'storage/' . str_replace('\\', '/', $relativePath);
                @endphp
                <a href="{{ asset($publicPath) }}" target="_blank">View Current File</a>
            </p>
        @endif
    </div>


    {{-- Remarks --}}
    <div class="form-group col-sm-12">
        {!! Form::label('Remarks', 'Note:') !!}
        {!! Form::text('Remarks', $attachment->Remarks ?? null, ['class' => 'form-control' . ($errors->has('Remarks') ? ' is-invalid' : '')]) !!}
        @error('Remarks') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    {{-- Global Form Errors (e.g., session flash message or general error) --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <strong>There were some errors with your submission:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
<!-- {!! Form::close() !!} -->



<!-- {{-- resources/views/attachments/fields.blade.php --}}

{{-- Hidden CaseID field --}}
{!! Form::hidden('CaseID', $caseId ?? $attachment->CaseID ?? null) !!}
<div>
    <p><strong>Case ID:</strong> {{ $caseId ?? $attachment->CaseID ?? 'N/A' }}</p>
</div>
{{-- Attachment Type Dropdown --}}
<div class="form-group col-sm-6">
    {!! Form::label('AttID', 'Attachment Type:') !!}
    {!! Form::select('AttID', $attTypes ?? [], null, ['class' => 'form-control', 'required' => true]) !!}
</div>

{{-- File Upload --}}
<div class="form-group col-sm-6">
    {!! Form::label('AttPath', 'Upload File:') !!}
    {!! Form::file('AttPath', ['class' => 'form-control', 'required' => true]) !!}
</div>

{{-- Remarks --}}
<div class="form-group col-sm-12">
    {!! Form::label('Remarks', 'Remarks:') !!}
    {!! Form::textarea('Remarks', null, ['class' => 'form-control']) !!}
</div> -->

<!-- <div class="form-group col-sm-6">
    {!! Form::label('AttID', 'Attid:') !!}
    {!! Form::number('AttID', null, ['class' => 'form-control', 'required']) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('AttPath', 'Attpath:') !!}
    {!! Form::text('AttPath', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Remarks', 'Remarks:') !!}
    {!! Form::text('Remarks', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
</div> -->


<!-- <div class="form-group col-sm-6">
    {!! Form::label('Preview', 'Preview:') !!}
    {!! Form::text('Preview', null, ['class' => 'form-control', 'maxlength' => 10, 'maxlength' => 10]) !!}
</div>


<div class="form-group col-sm-6">
    {!! Form::label('Delete', 'Delete:') !!}
    {!! Form::text('Delete', null, ['class' => 'form-control', 'maxlength' => 10, 'maxlength' => 10]) !!}
</div> -->