<div class="card shadow-sm rounded-4 m-0" style="background-color: #f5f5dc;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">
        <h4 class="mb-0">{{ __('Projects') }}</h4>

        <div class="d-flex gap-2">
            <a href="{{ route('projects.index') }}"
               class="btn btn-olive btn-sm"
               style="background:#2f3a1f;color:#d4af37;">
                <i class="fas fa-list"></i> {{ __('List') }}
            </a>

            <a href="{{ route('projects.create') }}"
               class="btn btn-olive btn-sm"
               style="background:#2f3a1f;color:#d4af37;">
                <i class="fas fa-plus"></i> {{ __('Create Project') }}
            </a>

            <a href="{{ route('users.create') }}"
               class="btn btn-olive btn-sm"
               style="background:#2f3a1f;color:#d4af37;">
                <i class="fas fa-plus"></i> {{ __('Create User') }}
            </a>
        </div>
    </div>

    <div class="table-responsive p-3" style="background-color:#f5f5dc;">
        <table class="table table-hover align-middle rounded-4"
               style="border:1px solid #D4AF37;">
           <thead style="background-color:#f5f5dc;">
            <tr style="background-color:#f5f5dc;">
                <th style="background-color:#f5f5dc;">{{ __('Code') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Owner') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('ProjectName') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Chosen Contractor') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Case #') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Building #') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Fence #') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Status') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Start Date') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('End Date') }}</th>
                <th style="width: 80px;background-color:#f5f5dc;" >{{ __('Action') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($projects as $project)

                @php
                    $owner = $project->users->firstWhere('pivot.role_id', 1);
                    $contractor = $project->users->firstWhere('pivot.role_id', 3);
                @endphp

                <tr  style="background-color:#f5f5dc;">
                    <td style="background-color:#f5f5dc;">{{ $project->project_code }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->owner->first()?->name ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->name }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->contractor->first()?->name ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->case_id_number ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->building_number ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->fence_number ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">
                        <span class="badge
                            @if(optional($project->status)->name == 'active') bg-success
                            @elseif(optional($project->status)->name == 'pending') bg-warning
                            @elseif(optional($project->status)->name == 'closed') bg-secondary
                            @elseif(optional($project->status)->name == 'canceld') bg-danger
                            @else bg-info
                            @endif
                        ">
                            {{ optional($project->status)->name ?? __('No Status') }}

                        </span>
                    </td>


                    <td style="background-color:#f5f5dc;">
                        {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}
                    </td style="background-color:#f5f5dc;">
                    <td style="background-color:#f5f5dc;">
                        {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}
                    </td>

                    <td style="background-color:#f5f5dc;">

                        @php
                            $owner = $project->users->firstWhere('pivot.role', __('Owner'));
                            $contractor = $project->users->firstWhere('pivot.role', __('Contractor'));
                        @endphp

                        <div class="dropdown">
                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                    type="button"
                                    style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('projects.show', $project->id) }}">
                                        <i class="far fa-eye me-1"></i> {{ __('Preview') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('projects.edit', $project->id) }}">
                                        <i class="far fa-edit me-1"></i> {{ __('Edit Project') }}
                                    </a>
                                </li>

                               <li>
                                    @if($project->owner_id)
                                        <a class="dropdown-item"
                                        href="{{ route('users.edit', $project->owner_id) }}">
                                            <i class="fas fa-user me-1"></i> {{ __('Edit Owner') }}
                                        </a>
                                    @else
                                        <span class="dropdown-item text-muted">
                                            <i class="fas fa-user-slash me-1"></i> {{ __('No Owner') }}
                                        </span>
                                    @endif
                                </li>

                                <li>
                                    @if($project->contractor_id)
                                        <a class="dropdown-item"
                                        href="{{ route('users.edit', $project->contractor_id) }}">
                                            <i class="fas fa-hard-hat me-1"></i> {{ __('Edit Contractor') }}
                                        </a>
                                    @else
                                        <span class="dropdown-item text-muted">
                                            <i class="fas fa-user-clock me-1"></i> {{ __('Not Chosen Yet') }}
                                            
                                        </span>
                                    @endif
                                </li>


                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    {!! Form::open([
                                        'route' => ['projects.destroy', $project->id],
                                        'method' => 'delete'
                                    ]) !!}
                                    {!! Form::button(
                                        '<i class="far fa-trash-alt me-1"></i> ' . __('Delete'),
                                        [
                                            'type' => 'submit',
                                            'class' => 'dropdown-item text-danger',
                                            'onclick' => "return confirm('".__('Are you sure?')."')"
                                        ]
                                    ) !!}
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

    <div class="card-footer clearfix">
        <div class="float-end">
            @include('adminlte-templates::common.paginate', ['records' => $projects])
        </div>
    </div>
</div>
