@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h4>
                        
                    </h4>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3 m-4">

        @include('adminlte-templates::common.errors')

        @php
            $isSubmission = Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
            $routeBase = $isSubmission ? 'primaryDatasSubmissions' : 'primaryDatas';
        @endphp
        
        <div class="card shadow-sm m-3">

            <div class="card-header">
                <h4 class="card-title text-center">Edit Primary Data</h4>
                <div class="card-tools">
                    <a href="{{ route("{$routeBase}.index") }}" class="btn btn-primary btn-sm float-right">
                        <i class="fas fa-list"></i> List
                    </a>
                    <a href="{{ route("{$routeBase}.create") }}" class="btn btn-success btn-sm float-right mr-2">
                        <i class="fas fa-plus"></i> Create
                    </a>
                </div>
            </div>
           
            {!! Form::model($primaryData, ['route' => [$routeBase . '.update', $primaryData->ID], 'method' => 'patch']) !!}


            <div class="card-body m-4">
                <div class="row">
                    @include('primary_datas.edit_fields')
                </div>
            </div>

            <div class="card-footer text-center items-center">
                {{-- This is for flash messages --}}
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route("{$routeBase}.index") }}" class="btn btn-default"> Cancel </a>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
