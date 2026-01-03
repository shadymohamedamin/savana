@extends('layouts.app')
@section('content')
<!-- <section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Primary Data</h1>
            </div>
        </div>
    </div>
</section> -->

<!-- <div class="d-flex justify-content-between align-items-center px-4">
    <h1 class="h3">Primary Data</h1>
    <a href="{{ route('primaryDatas.create') }}" class="btn btn-success">
        <i class="fas fa-plus-circle"></i> Add New
    </a>
</div>
<button class="btn btn-outline-primary mb-3 mx-4" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm" aria-expanded="false" aria-controls="filterForm">
    <i class="fas fa-filter"></i> Toggle Filter
</button> 

<section class="content m-4">
    <div class="card">
        <form method="GET" action="{{ route('primaryDatas.index') }}" class="mb-4 px-3 pt-3">
    @php
        $dateFields = [];
        $numberFields = [];
        $selectFields = [];
        $textFields = [];

        foreach ($columns as $column) {
            if (Str::contains($column, ['_date', 'Date','LastUpdate','IDExpiry'])) {
                $dateFields[] = $column;
            } elseif (Str::contains($column, ['id','FileNo','InSchool','IDNo','mob','Tel1','Tel2','Permission_No','count', 'Count', 'number', 'Number', '_min', '_max'])) {
                $numberFields[] = $column;
            } elseif (Str::contains($column, ['UserAdd','UserEdit','HouseType','MaritalStatus','Cancel','Approved','Nationality','WifeNationality','Section','Career','Revised','Sex','approved', 'status', 'is_'])) {
                $selectFields[] = $column;
            } else {
                $textFields[] = $column;
            }
        }
    @endphp

    <div class="row">
        {{-- Date Filters --}}
        <div class="col-md-12 mb-3">
            <div class="card border-primary">
                <div class="card-header bg-primary text-white">Date Filters</div>
                <div class="card-body row">
                    @foreach($dateFields as $column)
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 {{ (request($column . '_from') || request($column . '_to')) ? 'border-info bg-light' : '' }}">
                                <label class="form-label fw-bold">{{ ucfirst(str_replace('_', ' ', $column)) }} Range</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="{{ $column }}_from" class="form-label small">From</label>
                                        <div class="input-group">
                                            <input type="date" id="{{ $column }}_from" name="{{ $column }}_from" class="form-control" value="{{ request($column . '_from') }}">
                                            @if(request($column . '_from'))
                                                <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}_from').value='';">×</button>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="{{ $column }}_to" class="form-label small">To</label>
                                        <div class="input-group">
                                            <input type="date" id="{{ $column }}_to" name="{{ $column }}_to" class="form-control" value="{{ request($column . '_to') }}">
                                            @if(request($column . '_to'))
                                                <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}_to').value='';">×</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        {{-- Number Filters --}}
        <div class="col-md-12 mb-3">
            <div class="card border-success">
                <div class="card-header bg-success text-white">Number Filters</div>
                <div class="card-body row">
                    @foreach($numberFields as $column)
                        <div class="col-md-3 mb-3">
                            <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                            <div class="input-group {{ request($column) ? 'border border-info bg-light' : '' }}">
                                <input type="number" id="{{ $column }}" name="{{ $column }}" class="form-control" value="{{ request($column) }}">
                                @if(request($column))
                                    <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}').value='';">×</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Dropdown Filters --}}
        <div class="col-md-12 mb-3">
            <div class="card border-warning">
                <div class="card-header bg-warning text-dark">Dropdown Filters</div>
                <div class="card-body row">
                    @foreach($selectFields as $column)
                        <div class="col-md-3 mb-3">
                            <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                            <select name="{{ $column }}" id="{{ $column }}" class="form-control {{ request($column) !== null && request($column) !== '' ? 'border border-info bg-light' : '' }}">
                                <option value="">-- Select --</option>

                                @if($column === 'Sex')
                                     <option value="2" {{ request('Sex') === '2' ? 'selected' : '' }}>ذكر</option>
                                    <option value="1" {{ request('Sex') === '1' ? 'selected' : '' }}>أنثى</option>

                                @elseif(in_array($column, ['Nationality', 'WifeNationality']))
                                    @foreach($nationalities as $id => $name)
                                        <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach

                                @elseif(in_array($column, ['Career', 'WifeCareer', 'CareerAddress']))
                                    @foreach($careers as $id => $name)
                                        <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach

                                @elseif($column === 'MaritalStatus')
                                    @foreach($maritalStatuses as $id =>$name)
                                        <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                @elseif(in_array($column, ['UserAdd', 'UserEdit']))
                                    @foreach($users as $id =>$name)
                                        <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                @elseif($column === 'HouseType')
                                    @foreach($houseTypes as $id =>$name)
                                        <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach

                                @else
                                    <option value="1" {{ request($column) == '1' ? 'selected' : '' }}>Yes</option>
                                    <option value="0" {{ request($column) == '0' ? 'selected' : '' }}>No</option>
                                @endif
                            </select>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        {{-- Text Filters --}}
        <div class="col-md-12 mb-3">
            <div class="card border-secondary">
                <div class="card-header bg-secondary text-white">Text Filters</div>
                <div class="card-body row">
                    @foreach($textFields as $column)
                        <div class="col-md-3 mb-3">
                            <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                            <div class="input-group {{ request($column) ? 'border border-info bg-light' : '' }}">
                                <input type="text" id="{{ $column }}" name="{{ $column }}" class="form-control" value="{{ request($column) }}">
                                @if(request($column))
                                    <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}').value='';">×</button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="col-md-3 mb-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filter</button>
        </div>
        <div class="col-md-3 mb-2 d-flex align-items-end">
            <a href="{{ route('primaryDatas.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </div>
</form> -->






<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


<div class="card container-fluid">


            @php
                $isSubmission = Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
                $routeBase = $isSubmission ? 'primaryDatasSubmissions' : 'primaryDatas';
                
            @endphp
<div class="card shadow-sm border-0">
    <div class="card-header bg-light d-flex justify-content-between align-items-center">
        <h1 class="h4 text-danger mb-0">
            <i class="fas fa-database me-2"></i> Primary Data
        </h1>
        <a href="{{ route("{$routeBase}.create") }}" class="btn btn-danger">
            <i class="fas fa-plus-circle me-1"></i> Add New
        </a>
    </div>

    <div class="card-body px-4 py-3">
        <button class="btn btn-outline-primary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterForm" aria-expanded="true" aria-controls="filterForm">
            <i class="fas fa-filter me-1"></i> Toggle Filter
        </button>

        {{-- Collapsible Filter Form --}}
        <div class="collapse show" id="filterForm">
            {{-- Place your form here --}}
        </div>

        {{-- Table or content below --}}
    </div>
</div>




        <section class="content card m-4 id="filterForm" class="collapse show"">
            <div id="filterForm" class="collapse animate__animated animate__fadeInUp animate__faster">
                <div class="card-body border-danger shadow-sm">
                    <form method="GET" action="{{ route('primaryDatas.index') }}" class="mb-4 px-3 pt-3">

                        @php
                            $dateFields = [];
                            $numberFields = [];
                            $selectFields = [];
                            $textFields = [];

                            foreach ($columns as $column) {
                                if (Str::contains($column, ['_date', 'Date','LastUpdate','IDExpiry'])) {
                                    $dateFields[] = $column;
                                } elseif (Str::contains($column, ['id','FileNo','InSchool','IDNo','mob','Tel1','Tel2','Permission_No','count', 'Count', 'number', 'Number', '_min', '_max'])) {
                                    $numberFields[] = $column;
                                } elseif (Str::contains($column, ['UserAdd','UserEdit','HouseType','MaritalStatus','Cancel','Approved','Nationality','WifeNationality','Section','Career','Revised','Sex','approved', 'status', 'is_'])) {
                                    $selectFields[] = $column;
                                } else {
                                    $textFields[] = $column;
                                }
                            }
                        @endphp

                        <div class="row">
                            {{-- Date Filters --}}
                            <div class="col-md-12 mb-3">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">Date Filters</div>
                                    <div class="card-body row">
                                        @foreach($dateFields as $column)
                                            <div class="col-md-6 mb-3">
                                                <div class="border rounded p-3 {{ (request($column . '_from') || request($column . '_to')) ? 'border-danger bg-light' : '' }}">
                                                    <label class="form-label fw-bold">{{ ucfirst(str_replace('_', ' ', $column)) }} Range</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label for="{{ $column }}_from" class="form-label small">From</label>
                                                            <div class="input-group">
                                                                <input type="date" id="{{ $column }}_from" name="{{ $column }}_from" class="form-control" value="{{ request($column . '_from') }}">
                                                                @if(request($column . '_from'))
                                                                    <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}_from').value='';">×</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="{{ $column }}_to" class="form-label small">To</label>
                                                            <div class="input-group">
                                                                <input type="date" id="{{ $column }}_to" name="{{ $column }}_to" class="form-control" value="{{ request($column . '_to') }}">
                                                                @if(request($column . '_to'))
                                                                    <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}_to').value='';">×</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Number Filters --}}
                            <div class="col-md-12 mb-3">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">Number Filters</div>
                                    <div class="card-body row">
                                        @foreach($numberFields as $column)
                                            <div class="col-md-3 mb-3">
                                                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                                                <div class="input-group {{ request($column) ? 'border border-danger bg-light' : '' }}">
                                                    <input type="number" id="{{ $column }}" name="{{ $column }}" class="form-control" value="{{ request($column) }}">
                                                    @if(request($column))
                                                        <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}').value='';">×</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Dropdown Filters --}}
                            <div class="col-md-12 mb-3">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">Dropdown Filters</div>
                                    <div class="card-body row">
                                        @foreach($selectFields as $column)
                                            <div class="col-md-3 mb-3">
                                                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                                                <select name="{{ $column }}" id="{{ $column }}" class="form-control {{ request($column) !== null && request($column) !== '' ? 'border border-danger bg-light' : '' }}">
                                                    <option value="">-- Select --</option>
                                                    {{-- Options logic remains the same --}}
                                                    @if($column === 'Sex')
                                                        <option value="2" {{ request('Sex') === '2' ? 'selected' : '' }}>ذكر</option>
                                                        <option value="1" {{ request('Sex') === '1' ? 'selected' : '' }}>أنثى</option>
                                                    @elseif(in_array($column, ['Nationality', 'WifeNationality']))
                                                        @foreach($nationalities as $id => $name)
                                                            <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    @elseif(in_array($column, ['Career', 'WifeCareer', 'CareerAddress']))
                                                        @foreach($careers as $id => $name)
                                                            <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    @elseif($column === 'MaritalStatus')
                                                        @foreach($maritalStatuses as $id => $name)
                                                            <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    @elseif(in_array($column, ['UserAdd', 'UserEdit']))
                                                        @foreach($users as $id => $name)
                                                            <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    @elseif($column === 'HouseType')
                                                        @foreach($houseTypes as $id => $name)
                                                            <option value="{{ $id }}" {{ request($column) == $id ? 'selected' : '' }}>{{ $name }}</option>
                                                        @endforeach
                                                    @else
                                                        <option value="1" {{ request($column) == '1' ? 'selected' : '' }}>Yes</option>
                                                        <option value="0" {{ request($column) == '0' ? 'selected' : '' }}>No</option>
                                                    @endif
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Text Filters --}}
                            <div class="col-md-12 mb-3">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">Text Filters</div>
                                    <div class="card-body row">
                                        @foreach($textFields as $column)
                                            <div class="col-md-3 mb-3">
                                                <label for="{{ $column }}">{{ ucfirst($column) }}</label>
                                                <div class="input-group {{ request($column) ? 'border border-danger bg-light' : '' }}">
                                                    <input type="text" id="{{ $column }}" name="{{ $column }}" class="form-control" value="{{ request($column) }}">
                                                    @if(request($column))
                                                        <button type="button" class="btn btn-outline-danger" onclick="document.getElementById('{{ $column }}').value='';">×</button>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-danger w-100">Filter</button>
                            </div>
                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                <a href="{{ route('primaryDatas.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section> 


        <div class="card-body p-1 m-3 border border-black shadow">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover text-nowrap" id="primary-datas-table">
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="1" class="text-align text-center">Action</th>
                            @foreach($columns as $column)
                                <th>{{ $column }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($primaryDatas as $primaryData)
                            <tr>
                                <!-- <td style="width: 120px">
                                    {!! Form::open(['route' => ['primaryDatas.destroy', $primaryData->ID], 'method' => 'delete']) !!}
                                    <div class='btn-group'>
                                        <a href="{{ route('primaryDatas.show', [$primaryData->ID]) }}" class='btn btn-info btn-sm m-1'><i class="far fa-eye"></i> Show</a>
                                        <a href="{{ route('primaryDatas.edit', [$primaryData->ID]) }}" class='btn btn-warning btn-sm m-1'><i class="far fa-edit"></i> Edit</a>
                                        {!! Form::button('<i class="far fa-trash-alt btn-sm m-1"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!} 
                                    </div>
                                    {!! Form::close() !!}
                                </td> -->
                                    @php
                                        $isSubmission = Str::contains(request()->route()->getName(), 'primaryDatasSubmissions');
                                        $editRoute = $isSubmission ? 'primaryDatasSubmissions.edit' : 'primaryDatas.edit';
                                        $showRoute = $isSubmission ? 'primaryDatasSubmissions.show' : 'primaryDatas.show';
                                    @endphp

                                    <td style="width: 120px">
                                        {!! Form::open(['route' => [$isSubmission ? 'primaryDatasSubmissions.destroy' : 'primaryDatas.destroy', $primaryData->ID], 'method' => 'delete']) !!}
                                        <div class='btn-group'>
                                            <a href="{{ route($showRoute, [$primaryData->ID]) }}" class='btn btn-info btn-sm m-1'>
                                                <i class="far fa-eye"></i> Show
                                            </a>
                                            <a href="{{ route($editRoute, [$primaryData->ID]) }}" class='btn btn-warning btn-sm m-1'>
                                                <i class="far fa-edit"></i> Edit
                                            </a>
                                            <!-- {!! Form::button('<i class="far fa-trash-alt btn-sm m-1"></i> Delete', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!} -->
                                        </div>
                                        {!! Form::close() !!}
                                    </td>
                                @foreach($columns as $column)
                                <td>
                                    @switch($column)
                                        @case('Sex')
                                            {{ $primaryData->Sex == 2 ? 'Male' : ($primaryData->Sex == 1 ? 'Female' : '') }}
                                            @break
                                        @case('Nationality')
                                            {{ $primaryData->nationality->Nationality??'ll' }}
                                            @break
                                        @case('Career')
                                            {{ $primaryData->career->Career ?? '' }}
                                            @break
                                        @case('MaritalStatus')
                                            {{ $primaryData->maritalStatus->MaritalStatus ?? '' }}
                                            @break
                                        @case('WifeCareer')
                                            {{ $primaryData->wifeCareer->Career ?? '' }}
                                            @break
                                        @case('WifeNationality')
                                            {{ $primaryData->wifeNationality->Nationality ?? '' }}
                                            @break
                                        @case('HouseType')
                                            {{ $primaryData->houseType->HouseType ?? '' }}
                                            @break
                                        @case('UserAdd')
                                            {{ $primaryData->userAdd->name ?? '' }}
                                            @break
                                        @case('UserEdit')
                                            {{ optional($primaryData->userEdit)->name ?? '' }}
                                            @break
                                        @case('request_status_user_id')
                                            {{ optional($primaryData->userRequest)->name ?? '' }}
                                            @break
                                        @case('Region')
                                            {{ $primaryData->region->Region ?? '' }}
                                            @break
                                        @case('Section')
                                            {{ $primaryData->Section == 1 ? 'مواطن' : ($primaryData->Section == 0 ? 'وافد' : '') }}
                                            @break
                                        @case('Cancel')
                                            {{ $primaryData->Cancel == 1 ? 'نعم' : ($primaryData->Cancel == 0 ? 'لا' : '') }}
                                            @break
                                        @case('Approved')
                                            {{ $primaryData->Approved == 1 ? 'نعم' : ($primaryData->Approved == 0 ? 'لا' : '') }}
                                            @break
                                        @case('Revised')
                                            {{ $primaryData->Revised == 1 ? 'نعم' : ($primaryData->Revised == 0 ? 'لا' : '') }}
                                            @break
                                        @case('Accomodation')
                                            {{ $primaryData->Accomodation == 1 ? 'نعم' : ($primaryData->Accomodation == 0 ? 'لا' : '') }}
                                            @break
                                        @case('is_completed')
                                            {{ $primaryData->is_completed == 1 ? 'نعم' : ($primaryData->is_completed == 0 ? 'لا' : '') }}
                                            @break
                                        @default
                                            {{ $primaryData[$column] }}
                                    @endswitch
                                </td>
                            @endforeach
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer clearfix">
                <div class="float-right">
                    @include('adminlte-templates::common.paginate', ['records' => $primaryDatas])
                </div>
            </div>
        </div>
    </div>
</section>


</div>
@endsection
