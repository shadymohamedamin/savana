@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 mx-0 align-items-center">
                <div class="col-sm-6">
                    <h4 class="mb-0">Primary Data Details</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a class="btn btn-secondary" href="{{ route('primaryDatas.index') }}">Back</a>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        <div class="card shadow-sm">
            <div class="card-body">
                @include('primary_datas.show_fields')
            </div>
        </div>
    </div>
@endsection 








