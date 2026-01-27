<div class="card shadow-sm rounded-4 m-0" style="background-color: #f5f5dc;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
     style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">
        <h4 class="card-title mb-0">{{ __('Users') }}</h4>

        <div class="d-flex gap-2">
            <a href="{{ route('users.index') }}" class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-list"></i> {{ __('List') }}
            </a>
            <a href="{{ route('users.create') }}" class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-plus"></i> {{ __('Create') }}
            </a>
        </div>
    </div>

    {{-- Filter Toggle --}}
    <div class="card-body border-bottom" style="background-color: #f5f5dc;">
        <button class="btn btn-outline-secondary btn-sm mb-3"
                data-bs-toggle="collapse"
                data-bs-target="#filterBox">
            <i class="fas fa-filter"></i> {{ __('Filter') }}
        </button>

        {{-- Filter Box --}}
        <div id="filterBox" class="collapse">
            <form method="GET" action="{{ route('users.index') }}">
                <div class="row g-2">

                    <div class="col-md">
                        <input type="text" name="name" class="form-control rounded-3"
                               placeholder="{{ __('Name') }}"
                               value="{{ request('name') }}">
                    </div>

                    <!-- <div class="col-md">
                        <input type="text" name="email" class="form-control rounded-3"
                               placeholder="{{ __('Email') }}"
                               value="{{ request('email') }}">
                    </div> -->

                    <div class="col-md">
                        <input type="text" name="mobile" class="form-control rounded-3"
                               placeholder="{{ __('Mobile') }}"
                               value="{{ request('mobile') }}">
                    </div>

                    <div class="col-md">
                        <select name="role_id" class="form-select rounded-3">
                            <option value="">{{ __('Role') }}</option>
                            @foreach($roles as $id => $role)
                                <option value="{{ $id }}" {{ request('role_id')==$id ? 'selected' : '' }}>
                                    {{ $role }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <!-- <div class="col-md">
                        <input type="text" name="uae_id" class="form-control rounded-3"
                               placeholder="{{ __('ID Number') }}"
                               value="{{ request('uae_id') }}">
                    </div>

                    {{-- Male Filter --}}
                    <div class="col-md">
                        <select name="male" class="form-select rounded-3">
                            <option value="">{{ __('Gender') }}</option>
                            <option value="1" {{ request('male')=='1'?'selected':'' }}>
                                {{ __('Male') }}
                            </option>
                            <option value="0" {{ request('male')=='0'?'selected':'' }}>
                                {{ __('Female') }}
                            </option>
                        </select>
                    </div>

                    {{-- Active --}}
                    <div class="col-md">
                        <select name="active" class="form-select rounded-3">
                            <option value="">{{ __('Active') }}</option>
                            <option value="1" {{ request('active')=='1'?'selected':'' }}>
                                {{ __('Yes') }}
                            </option>
                            <option value="0" {{ request('active')=='0'?'selected':'' }}>
                                {{ __('No') }}
                            </option>
                        </select>
                    </div>-->

                    {{-- Role --}}
                    <!-- <div class="col-md">
                        <select name="role" class="form-select rounded-3">
                            <option value="">{{ __('Role') }}</option>
                            <option value="user" {{ request('role')=='user'?'selected':'' }}>
                                {{ __('User') }}
                            </option>
                            <option value="manager" {{ request('role')=='manager'?'selected':'' }}>
                                {{ __('Manager') }}
                            </option>
                            <option value="admin" {{ request('role')=='admin'?'selected':'' }}>
                                {{ __('Admin') }}
                            </option>
                        </select>
                    </div> -->

                    {{-- Is Admin --}}
                    <!--<div class="col-md">
                        <select name="is_admin" class="form-select rounded-3">
                            <option value="">{{ __('Is Admin') }}</option>
                            <option value="1" {{ request('is_admin')=='1'?'selected':'' }}>
                                {{ __('Yes') }}
                            </option>
                            <option value="0" {{ request('is_admin')=='0'?'selected':'' }}>
                                {{ __('No') }}
                            </option>
                        </select>
                    </div> -->

                    {{-- Buttons --}}
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-olive" style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;">
                            <i class="fas fa-check me-1"></i> {{ __('Apply') }}
                        </button>
                    </div>
                    <div class="col-md-2 d-grid">
                        <a href="{{ route('users.index') }}" class="btn btn-secondary rounded-3">
                            <i class="fas fa-sync-alt me-1"></i> {{ __('Reset') }}
                        </a>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive p-3" style="background-color: #f5f5dc;">
        <table class="table table-hover align-middle text-nowrap rounded-4 overflow-hidden"
               style="border:1px solid #D4AF37">

            <thead style="background:#D4AF37;color:#000">
            <tr style="background-color: #f5f5dc;">
                <th  style="background-color: #f5f5dc;">{{ __('Name') }}</th>
                <th style="background-color: #f5f5dc;">{{ __('Email') }}</th>
                <th style="background-color: #f5f5dc;">{{ __('Mobile') }}</th>
                <th style="background-color: #f5f5dc;">{{ __('ID Number') }}</th>
                <!-- <th style="background-color: #f5f5dc;">{{ __('Gender') }}</th> -->
                <!-- <th style="background-color: #f5f5dc;">{{ __('Active') }}</th> -->
                <th style="background-color: #f5f5dc;">{{ __('Role') }}</th>
                <!-- <th style="background-color: #f5f5dc;">{{ __('Admin') }}</th> -->
                <th style="background-color: #f5f5dc;">{{ __('Actions') }}</th>
            </tr>
            </thead>

            <tbody style="background-color: #f5f5dc;">
            @foreach($users as $user)
                <tr style="background-color: #f5f5dc;">
                    <td style="background-color: #f5f5dc;">{{ $user->name }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->email }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->mobile }}</td>
                    <td style="background-color: #f5f5dc;">{{ $user->uae_id }}</td>
                    <!-- <td style="background-color: #f5f5dc;">{{ $user->male ? __('Male') : __('Female') }}</td> -->
                    <!-- <td style="background-color: #f5f5dc;">
                        <span class="badge {{ $user->Active ? 'bg-success':'bg-danger' }}">
                            {{ $user->Active ? __('Yes') : __('No') }}
                        </span>
                    </td> -->
                    <!-- <td style="background-color: #f5f5dc;">{{ $user->roleRelation->Role ?? '-' }}</td> -->
                    <td style="background-color: #f5f5dc;">
                        @if(app()->getLocale() == 'ar')
                            {{ $user->roleRelation->name_ar ?? '-' }}
                        @else
                            {{ $user->roleRelation->name_en ?? '-' }}
                        @endif
                    </td>

                    <!-- <td style="background-color: #f5f5dc;">
                        <span class="badge {{ $user->is_admin ? 'bg-warning text-dark':'bg-secondary' }}">
                            {{ $user->is_admin ? __('Yes') : __('No') }}
                        </span>
                    </td> -->
                    <td style="background-color: #f5f5dc;">
                        {{-- Actions Dropdown --}}

<!-- <button class="btn btn-sm btn-secondary dropdown-toggle"
                                    type="button"
                                    style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button> -->


                        <div class="dropdown" style="background-color: #f5f5dc;">
                            <button class="btn btn-sm btn-olive dropdown-toggle rounded-3"
                                    style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;"
                                    type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="background-color: #f5f5dc;">
                                <!-- <li>
                                    <a class="dropdown-item" href="{{ route('users.show', $user->id) }}">
                                        <i class="far fa-eye me-1"></i> {{ __('Show') }}
                                    </a>
                                </li> -->
                                <li>
                                    <a class="dropdown-item" href="{{ route('users.edit', $user->id) }}">
                                        <i class="far fa-edit me-1"></i> {{ __('Edit') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                    href="{{ url('users/'.$user->id.'/attachments/create?type=users') }}">
                                        <i class="fas fa-folder-open me-1"></i> {{ __('مستندات') }}
                                    </a>
                                </li>
                                <li>
                                    {!! Form::open(['route'=>['users.destroy',$user->id],'method'=>'delete']) !!}
                                    {!! Form::button('<i class="far fa-trash-alt me-1"></i> '. __('Delete'),
                                        ['type'=>'submit','class'=>'dropdown-item text-danger',
                                        'onclick'=>"return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    {{-- Pagination --}}
    <div class="card-footer  rounded-bottom-4" style="background-color: #f5f5dc;" >
        <div class="float-end" style="background-color: #f5f5dc;">
            @include('adminlte-templates::common.paginate',['records'=>$users])
        </div>
    </div>

</div>

{{-- Custom btn-olive CSS --}}
@push('styles')
<style>
.btn-olive {
    background-color: #2f3a1f;
    border: 1px solid #2f3a1f;
    color: #d4af37;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-olive:hover {
    background-color: #3e4a29;
    border-color: #d4af37;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(212,175,55,0.35);
}
</style>
@endpush
