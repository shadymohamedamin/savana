<style>
    .table-bordered > :not(caption) > * > * {
        border: 1px solid #d4af37;
    }
    thead th {
        font-weight: 700;
        border-bottom: 2px solid #b89b2e;
    }

    tbody tr:hover {
        background-color: #efe8c8 !important;
    }

</style>





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






{{-- Filter Toggle --}}
<div class="card-body border-bottom" style="background-color: #f5f5dc;">
    <button class="btn btn-outline-secondary btn-sm mb-3"
            data-bs-toggle="collapse"
            data-bs-target="#filterBox">
        <i class="fas fa-filter"></i> {{ __('Filter') }}
    </button>

    {{-- Filter Box --}}
    <div id="filterBox" class="collapse">
        <form method="GET" action="{{ route('projects.index') }}">
            <div class="row g-2">

                {{-- Project Code --}}
                <div class="col-md">
                    <input type="text" name="project_code" class="form-control rounded-3"
                           placeholder="{{ __('كود المشروع') }}"
                           value="{{ request('project_code') }}">
                </div>

                {{-- Project Qasmia --}}
                <div class="col-md">
                    <input type="text" name="qasmia_number" class="form-control rounded-3"
                           placeholder="{{ __('رقم القسيمة') }}"
                           value="{{ request('qasmia_number') }}">
                </div>


                {{-- Owner Name --}}
                <div class="col-md">
                    <input type="text" name="owner_name" class="form-control rounded-3"
                           placeholder="{{ __('اسم المالك') }}"
                           value="{{ request('owner_name') }}">
                </div>

                {{-- Owner Phone --}}
                <div class="col-md">
                    <input type="text" name="owner_phone" class="form-control rounded-3"
                           placeholder="{{ __('رقم الهاتف') }}"
                           value="{{ request('owner_phone') }}">
                </div>

                

                {{-- Buttons --}}
                <div class="col-md-2 d-grid">
                    <button class="btn btn-olive" style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;">
                        <i class="fas fa-check me-1"></i> {{ __('Apply') }}
                    </button>
                </div>
                <div class="col-md-2 d-grid">
                    <a href="{{ route('projects.index') }}" class="btn btn-secondary rounded-3">
                        <i class="fas fa-sync-alt me-1"></i> {{ __('Reset') }}
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>





    <div class="table-responsive p-3" style="background-color:#f5f5dc;">
        <!-- <table class="table table-hover align-middle rounded-4"
               style="border:1px solid #D4AF37;"> -->

        <table class="table table-hover align-middle rounded-4"
               style="border:1px solid #D4AF37;">
           <thead style="background-color:#d4af37;color:#2f3a1f;">

            <tr class="project-roww"
                
                style="background-color:#f5f5dc; cursor:pointer;">
                <th style="background-color:#f5f5dc;">{{ __('Code') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Owner') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('رقم القسيمة') }}</th>
                <!-- <th style="background-color:#f5f5dc;">{{ __('ProjectName') }}</th> -->
                <th style="background-color:#f5f5dc;">{{ __('Chosen Contractor') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Case #') }}</th>
                <!-- <th style="background-color:#f5f5dc;">{{ __('Building #') }}</th> -->
                <!-- <th style="background-color:#f5f5dc;">{{ __('Building #') }}</th> -->
                <th style="background-color:#f5f5dc;">{{ __(key: 'نوع الحالة') }}</th>
                <th style="background-color:#f5f5dc;">{{ __(key: 'عدد زيارات الاشراف') }}</th>
                <th style="background-color:#f5f5dc;">{{ __(key: 'قيمة العقد') }}</th>
                <th style="background-color:#f5f5dc;">{{ __(key: 'تاريخ انتهاء العقد') }}</th>
                
                <!-- <th style="background-color:#f5f5dc;">{{ __(key: 'مدة المعاملة') }}</th> -->
                
                <th style="background-color:#f5f5dc;">{{ __(key: 'المستلم من العقد') }}</th>
                <th style="background-color:#f5f5dc;">{{ __(key: 'رقم الرخصة') }}</th>
                
                <!-- <th style="background-color:#f5f5dc;">{{ __(key: 'Case Type') }}</th> -->
                
                 
                <!-- <th style="background-color:#f5f5dc;">{{ __('Fence #') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Status') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('Start Date') }}</th>
                <th style="background-color:#f5f5dc;">{{ __('End Date') }}</th> -->
                <!-- <th style="background-color:#f5f5dc;">{{ __('Status') }}</th> -->
                <th style="background-color:#f5f5dc;">{{ __(key: 'مرحلة المشروع') }}</th>
                <th style="width: 80px;background-color:#f5f5dc;" >{{ __('Action') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($projects as $project)

                @php
                    $owner = $project->users->firstWhere('pivot.role_id', 1);
                    $contractor = $project->users->firstWhere('pivot.role_id', 3);
                @endphp

                <tr class="project-row"
                    data-href="{{ route('projects.edit', $project->id) }}"
                    style="background-color:#f5f5dc; cursor:pointer;">
                    <td style="background-color:#f5f5dc;">{{ $project->project_code }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->ownerUser->name ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->qasmia_number ?? '—' }}</td>
                    <!-- <td style="background-color:#f5f5dc;">
                        @if($project->projectName)
                            {{ app()->getLocale() == 'ar'
                                ? $project->projectName->name_ar
                                : $project->projectName->name_en
                            }}
                        @else
                            —
                        @endif
                    </td> -->

                    

                    <td style="background-color:#f5f5dc;">{{ $project->contractorUser->name ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ $project->case_id_number ?? '—' }}</td>
                    <!-- <td style="background-color:#f5f5dc;">{{ $project->building_number ?? '—' }}</td> -->
                    
                    
                    
                    
                    
                    @php
                        $lastApproval = $project->baladyaApprovals->first();
                        $daysDiff = $lastApproval && $lastApproval->opened_at && $lastApproval->approved_at
                                    ? $lastApproval->approved_at->diffInDays($lastApproval->opened_at)
                                    : null;
                    @endphp
                    
                        <td style="background-color:#f5f5dc;">
                            {{ $lastApproval->statusType->name_ar ?? '—' }}
                        </td>
                        <td style="background-color:#f5f5dc;">
                            {{ $project->supervision_visits_count ?? '—' }}
                        </td>
                        <td style="background-color:#f5f5dc;">
                            {{ $project->bank_contract_value ?? '—' }}
                        </td>
                        <td style="background-color:#f5f5dc;">
                           
                            {{ \Carbon\Carbon::parse($project->contractor_contract_end_date)->format('Y-m-d') }}
                            <!-- {{ $daysDiff ?? '—' }} -->
                        </td>
                        <td style="background-color:#f5f5dc;">
                            {{ number_format($project->paid_with_vat ?? 0, 0) }}
                        </td>
                        <td style="background-color:#f5f5dc;">
                            {{ $lastApproval->building_license_number ?? '—' }}
                        </td>


                    
                    
                    
                    
                    
                    
                    <!-- <td style="background-color:#f5f5dc;">{{ '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ '—' }}</td>
                    <td style="background-color:#f5f5dc;">{{ '—' }}</td> -->
                    

                    <!-- <td style="background-color:#f5f5dc;">{{ $project->fence_number ?? '—' }}</td> -->
                    <!-- <td style="background-color:#f5f5dc;">
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
                    </td> -->



                    <td style="background-color:#f5f5dc;">
                        @if($project->stage)
                            <span class="badge bg-info" style="background-color:#f5f5dc;">
                                {{ app()->getLocale() === 'ar'
                                    ? $project->stage->name_ar
                                    : $project->stage->name_en
                                }}
                            </span>
                        @else
                            <span class="badge bg-secondary" style="background-color:#f5f5dc;">
                                {{ __('Not Started') }}
                            </span>
                        @endif
                    </td>



                    <!-- <td style="background-color:#f5f5dc;">
                        {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}
                    </td style="background-color:#f5f5dc;">
                    <td style="background-color:#f5f5dc;">
                        {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}
                    </td> -->

                    <td style="background-color:#f5f5dc;">

                        @php
                            $owner = $project->users->firstWhere('pivot.role', __('Owner'));
                            $contractor = $project->users->firstWhere('pivot.role', __('Contractor'));
                        @endphp

                        <div class="dropdown" >
                            <button class="btn btn-sm btn-secondary dropdown-toggle"
                                    type="button"
                                    style="background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;"
                                    data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end" style="background-color:#f5f5dc;">
                                <!-- <li>
                                    <a class="dropdown-item"
                                       href="{{ route('projects.show', $project->id) }}">
                                        <i class="far fa-eye me-1"></i> {{ __('Preview') }}
                                    </a>
                                </li> -->
                               

                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('projects.edit', $project->id) }}">
                                        <i class="far fa-edit me-1"></i> {{ __('Edit Project') }}
                                    </a>
                                </li>

                                {{-- مستندات المشروع --}}
                                <li>
                                    <a class="dropdown-item"
                                    href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}">
                                        <i class="fas fa-folder-open me-1"></i> {{ __(' عقود الاستشاري') }}
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

                                <li class="dropdown-header text-muted px-3">
                                    {{ __('مراحل المشروع') }}
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('projects.owner-requirements.index', [
                                            'project' => $project->id,
                                            //'owner_id' => $project->owner_id
                                    ]) }}">
                                        <i class="fas fa-file-signature me-1"></i>
                                        {{ __('احتياجات المالك') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-pencil-ruler me-1"></i> {{ __('التصميم') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('projects.baladya-approvals.index', [
                                            'project' => $project->id,
                                            //'owner_id' => $project->owner_id
                                    ]) }}">
                                        <i class="fas fa-file-signature me-1"></i>
                                        {{ __('اعتمادات البلدية') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-gavel me-1"></i> {{ __('المناقصة') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}">
                                        <i class="fas fa-folder-open me-1"></i> {{ __(' عقود المقاول') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user-tie me-1"></i> {{ __('الاشراف') }}
                                    </a>
                                </li>

                                <!-- <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-money-check-alt me-1"></i> {{ __('الدفعات') }}
                                    </a>
                                </li> -->

                                <li>
                                    <a class="dropdown-item"
                                    href="{{ route('projects.project-payments.index', [
                                            'project' => $project->id,
                                            //'owner_id' => $project->owner_id
                                    ]) }}">
                                        <i class="fas fa-money-check-alt me-1"></i>
                                        {{ __('دفعات المشروع') }}
                                    </a>
                                </li>


                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-folder me-1"></i> {{ __('مستندات المشروع') }}
                                    </a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-chart-line me-1"></i> {{ __('الاحصائيات') }}
                                    </a>
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




<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.project-row').forEach(row => {
        row.addEventListener('click', function (e) {

            // امنع التنقل لو الضغط على زر أو لينك أو dropdown
            if (
                e.target.closest('a') ||
                e.target.closest('button') ||
                e.target.closest('.dropdown')
            ) {
                return;
            }

            window.location = this.dataset.href;
        });
    });
});
</script>
