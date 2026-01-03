@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>
                    
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        @php
            $isSubmission = Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
            $routeBase = $isSubmission ? 'primaryDatasSubmissions' : 'primaryDatas';
        @endphp
        <div class="card">
            
            <div class="card-header">
                <h3 class="card-title">Create Primary Data</h3>
                <div class="card-tools">
                    <a href="{{ route("{$routeBase}.index") }}" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-list"></i> Back
                    </a>
                    <!-- <a href="{{ route('primaryDatas.create') }}" class="btn btn-success btn-sm float-right mr-2">
                        <i class="fas fa-plus"></i> Create
                    </a> -->
                </div>
            </div>

            {!! Form::open(['route' => 'primaryDatas.store']) !!}
            
            <div class="card-body">

                <div class="row">
                    @include('primary_datas.fields')
                </div>

            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route("{$routeBase}.index") }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection 


