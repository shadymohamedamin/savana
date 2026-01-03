@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                        Edit Attachment
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($attachment, ['route' => ['attachments.update', $attachment->ID], 'method' => 'patch','files' => true]) !!}
            {!! Form::hidden('CaseID', $attachment->CaseID) !!}
            <div class="card-body">
                <div class="row">
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
                                    $publicPath =  str_replace('\\', '/', $relativePath);
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

                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('attachments.index') }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
