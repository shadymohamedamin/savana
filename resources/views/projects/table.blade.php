<style>
    /* .table-bordered > :not(caption) > * > * {
        border: 1px solid #d4af37;
    }
    thead th {
        font-weight: 700;
        border-bottom: 2px solid #b89b2e;
    }

    tbody tr:hover {
        background-color: #efe8c8 !important;
    }


.custom-table {
    border: 2px solid #000;
    border-collapse: collapse;
}

.custom-table th,
.custom-table td {
    border: 1px solid #000 !important;
}


.custom-header {
  
    background: #d4af37;

    color: #1f2937;
    font-weight: 700;
}

.custom-header th {
   
    background: #d4af37;
    border: 1px solid #000 !important;
    text-align: center;
}


.custom-table tbody tr {
    background-color: #f5f5dc;
}


.custom-table tbody tr:hover {
    background-color: #ece2b6;
}


    .custom-header {
    background-color: #2f3a1f;
    color: #f9e076;
}






.filter-card {
    border: 1px solid #000;
    border-radius: 4px;
}

.filter-header {
    background-color: #2f3a1f;
    color: #d4af37;
    padding: 12px 18px;
    font-weight: 600;
    font-size: 15px;
    border-bottom: 2px solid #000;
}

.filter-body {
    background-color: #f5f5dc;
}

.filter-input {
    border: 1px solid #000;
    border-radius: 3px;
    background-color: #fff;
}

.filter-input:focus {
    border-color: #2f3a1f;
    box-shadow: none;
}



.btn-apply {
    background-color: #2f3a1f;
    color: #d4af37;
    border: 1px solid #000;
    padding: 6px 20px;
    font-weight: 600;
}

.btn-apply:hover {
    background-color: #243016;
    color: #fff;
}

.btn-reset {
    background-color: #6c757d;
    color: #fff;
    border: 1px solid #000;
    padding: 6px 20px;
}

.bold-input{
    font-weight:700;
}












.form-item label{
    font-weight:1000;
}

.card-section label{
    font-weight:1000;
}

.form-label{
    font-weight:700;
    color:#2f3a1f;
    margin-bottom:4px;
    display:block;
} */
























/* =========================
   COLORS
========================= */

:root{
    --gov-primary: rgb(146 114 42 / 1);
    --gov-bg: rgb(249 247 237);
    --gov-hover: rgb(239 232 200);
    --gov-text: rgb(146 114 42 / 1);
    --gov-border: rgb(146 114 42 / 1);
}

/* =========================
   GENERAL
========================= */

body,
html{
    font-family:'Alexandria', sans-serif !important;
    background:#fff;
}

/* =========================
   MAIN CARD
========================= */

.card{
    background-color: var(--gov-bg) !important;
    border: 2px solid var(--gov-border) !important;
    border-radius: 14px !important;
    overflow: hidden;
}

/* =========================
   HEADER
========================= */

.card-header{
    background-color: var(--gov-bg) !important;
    border-bottom: 2px solid var(--gov-border) !important;
    color: var(--gov-text) !important;
    font-weight: 800;
}

/* =========================
   BUTTONS
========================= */

.btn-olive,
.btn-apply,
.btn-reset,
.btn-success{
    background-color: var(--gov-primary) !important;
    border: 1px solid var(--gov-primary) !important;
    color: #fff !important;
    font-weight: 700;
    transition: .25s ease;
}

.btn-olive:hover,
.btn-apply:hover,
.btn-reset:hover,
.btn-success:hover{
    opacity:.92;
    transform:translateY(-1px);
}

/* =========================
   FILTER CARD
========================= */

.filter-card{
    background-color: var(--gov-bg) !important;
    border: 2px solid var(--gov-border) !important;
    border-radius: 12px;
}

.filter-body{
    background-color: var(--gov-bg);
}

/* =========================
   INPUTS
========================= */

.filter-input{
    border: 1px solid var(--gov-border);
    background: #fff;
    color: var(--gov-text);
    border-radius: 8px;
    height: 44px;
    font-weight: 600;
}

.filter-input:focus{
    border-color: var(--gov-primary);
    box-shadow: 0 0 0 0.1rem rgba(146,114,42,.15);
}

/* =========================
   LABELS
========================= */

.form-label,
.form-item label,
.card-section label{
    color: var(--gov-text);
    font-weight: 800;
}

/* =========================
   TABLE
========================= */

.custom-table{
    border-collapse: collapse !important;
    border: 2px solid var(--gov-border) !important;
    overflow: hidden;
}

/* HEADER */
.custom-header{
    background-color: var(--gov-bg) !important;
}

.custom-header th{
    background-color: var(--gov-bg) !important;
    color: var(--gov-text) !important;
    border: 1px solid var(--gov-border) !important;
    font-weight: 800;
    text-align: center;
    padding: 16px 10px;
    white-space: nowrap;
}

/* BODY */

.custom-table tbody tr{
    background-color: #fff !important;
    transition: .2s ease;
}

.custom-table tbody td{
    border: 1px solid rgba(146,114,42,.25) !important;
    color: var(--gov-text);
    font-weight: 600;
    padding: 14px 10px;
    vertical-align: middle;
}

/* HOVER */

.custom-table tbody tr:hover{
    background-color: var(--gov-hover) !important;
}

/* TABLE WRAPPER */

.table-responsive{
    background-color: var(--gov-bg) !important;
    border-top: 1px solid rgba(146,114,42,.15);
}

/* =========================
   PROJECT CARDS
========================= */

.project-cards-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(170px,1fr));
    gap:20px;
    margin:25px 50px 35px;
}

.project-card{
    background-color: var(--gov-bg);
    border: 2px solid var(--gov-border);
    border-radius: 16px;
    padding: 26px 18px;
    text-align:center;
    text-decoration:none;
    transition:.25s ease;
    position:relative;
    overflow:hidden;
    box-shadow:0 4px 14px rgba(0,0,0,.04);
}

.project-card i{
    color: var(--gov-primary);
    font-size:32px;
    margin-bottom:14px;
}

.project-card span{
    color: var(--gov-text);
    font-size:17px;
    font-weight:800;
}

.project-card:hover{
    background-color: var(--gov-hover);
    transform:translateY(-4px);
    box-shadow:0 10px 24px rgba(146,114,42,.12);
}

/* ACTIVE */

.project-card.active{
    background-color: var(--gov-primary);
}

.project-card.active span,
.project-card.active i{
    color:#fff;
}

/* =========================
   USER CARDS
========================= */

.project-user-card{
    min-width:250px;
    background-color: var(--gov-bg);
    border:2px solid var(--gov-border);
    border-radius:14px;
    padding:16px;
    display:flex;
    align-items:center;
    gap:14px;
    cursor:pointer;
    transition:.25s ease;
}

.project-user-card:hover{
    transform:translateY(-3px);
    background-color: var(--gov-hover);
    box-shadow:0 8px 20px rgba(146,114,42,.08);
}

.project-user-card .icon{
    width:52px;
    height:52px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:20px;
    background-color: var(--gov-primary);
    color:#fff;
}

/* =========================
   PAGINATION
========================= */

.page-link{
    color: var(--gov-primary);
    border-color: rgba(146,114,42,.3);
}

.page-item.active .page-link{
    background-color: var(--gov-primary);
    border-color: var(--gov-primary);
}

/* =========================
   BADGES
========================= */

.badge{
    border-radius: 8px;
    padding: 8px 10px;
    font-weight: 700;
}

/* =========================
   ANIMATION
========================= */

.card,
.project-card,
.project-user-card{
    animation:fadeInUp .45s ease;
}

@keyframes fadeInUp{
    from{
        opacity:0;
        transform:translateY(12px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* =========================
   MOBILE
========================= */

@media(max-width:768px){

    .project-cards-grid{
        margin:20px 15px;
    }

    .custom-header th{
        font-size:13px;
    }

    .custom-table tbody td{
        font-size:13px;
    }

}











</style>





<div class="pt-4 card shadow-sm rounded-4 m-0" style="background-color: #f5f5dc;">

    {{-- Header --}}



    



   <div class="card-header d-flex justify-content-between align-items-center"
     style="background:#D4AF37; color:#2f3a1f; font-size:1.3rem; font-weight:600;">
    



    <div>
        {{ __('Projects') }}
    </div>

    <!-- User name in the center -->
    <div class="mx-auto">
        {{ Auth::user()->name }}
    </div>

    <!-- Empty div to balance flex -->
    <div></div>



        <!-- <h4 class="mx-auto">{{ __('Projects') }}</h4> -->

        <div class="d-flex gap-2">

@if(in_array(Auth::user()->role_id, [1,4,11,12,7]))
            <button onclick="exportTableToExcel('projects-table')" 
                    class="btn btn-success btn-sm">
                <i class="fas fa-file-excel"></i> تصدير Excel
            </button>
            <a href="{{ route('projects.show', 1) }}"
               class="btn btn-olive btn-sm"
               style="background:#2f3a1f;color:#d4af37;">
                <i class="fas fa-list"></i> {{ __('جدول المساحات') }}
            </a>

@endif

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



<!-- <button class="btn btn-outline-secondary btn-sm mb-3"
            data-bs-toggle="collapse"
            data-bs-target="#filterBox">
        <i class="fas fa-filter"></i> {{ __('Filter') }}
    </button> -->
<!-- 

{{-- Filter Toggle --}}
<div class="card-body border-bottom" style="background-color: #f5f5dc;">
    

    {{-- Filter Box --}}
    <div id="filterBox" class="collaps">
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


             
                <div class="col-md">
                    <input type="text" name="owner_name" class="form-control rounded-3"
                           placeholder="{{ __('اسم المالك') }}"
                           value="{{ request('owner_name') }}">
                </div>

            
                <div class="col-md">
                    <input type="text" name="owner_phone" class="form-control rounded-3"
                           placeholder="{{ __('رقم الهاتف') }}"
                           value="{{ request('owner_phone') }}">
                </div>

                

    
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

 -->


<div class="card filter-card shadow-sm mb-4 mt-0">

    {{-- <div class="filter-header">
        <i class="fas fa-search me-2"></i>
        {{ __('بحث وتصفية المشاريع') }}
    </div> --}}

    <div class="card-body filter-body">
        <form method="GET" action="{{ route('projects.index') }}">

            <div class="row g-3">

                <div class="col-md-1">
                    <label class="form-label">{{ __('كود المشروع') }}</label>
                    <input type="text" name="project_code"
                           class="form-control filter-input"
                           value="{{ request('project_code') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">{{ __('رقم القسيمة') }}</label>
                    <input type="text" name="qasmia_number"
                           class="form-control filter-input"
                           value="{{ request('qasmia_number') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label">{{ __('اسم المالك') }}</label>
                    <input type="text" name="owner_name"
                           class="form-control filter-input bold-input"
                           style="text-font:bold;"
                           value="{{ request('owner_name') }}">
                </div>

                <div class="col-md-1">
                    <label class="form-label">{{ __('رقم الحالة') }}</label>
                    <input type="text" name="case_id_number"
                           class="form-control filter-input bold-input"
                           style="text-font:bold;"
                           value="{{ request('case_id_number') }}">
                </div>


                <div class="col-md-2">
                    <label class="form-label">{{ __('رقم الهاتف') }}</label>
                    <input type="text" name="owner_phone"
                           class="form-control filter-input"
                           value="{{ request('owner_phone') }}">
                </div>



                <div class="col-md-2">
                    <label class="form-label">{{ __('المقاول') }}</label>
                    <select name="contractor_id" class="form-control filter-input">
                        <option value="">{{ __('اختر المقاول') }}</option>
                        @foreach($contractors as $contractor)
                            <option value="{{ $contractor->id }}"
                                {{ request('contractor_id') == $contractor->id ? 'selected' : '' }}>
                                {{ $contractor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
<!-- col-12 mt-3 d-flex justify-content-end gap-2 -->
                <div class="col-md-2 d-flex justify-content-end gap-2 " style="margin-top:3rem;height:2.6rem;">

                    <button type="submit" class="btn btn-apply">
                        <i class="fas fa-search me-1"></i>
                        {{ __('بحث') }}
                    </button>

                    <a href="{{ route('projects.index') }}" class="btn btn-reset">
                        <i class="fas fa-redo me-1"></i>
                        {{ __(' الرجوع الي المشاريع') }}
                    </a>

                </div>

            </div>

        </form>
    </div>
</div>





    <div class="table-responsive p-3" style="background-color:#f5f5dc;">
        <!-- <table class="table table-hover align-middle rounded-4"
               style="border:1px solid #D4AF37;"> -->

        <!-- <table class="table table-hover align-middle rounded-4 custom-table"
               style="border:1px solid #D4AF37;"> -->
        <table id="projects-table"
       class="table table-hover align-middle rounded-4 custom-table"
       style="border:1px solid #D4AF37;">
           <thead class="custom-header" style="background-color:#d4af37;color:#2f3a1f;">

            <tr class="project-roww"style="background-color:#d4af37; cursor:pointer;">
                @if(in_array(auth()->user()->role_id, [1,4,11,12,7,2]))
                    <th style="background-color:#d4af37;">{{ __('Code') }}</th>
                    <th style="background-color:#d4af37;">{{ __('Owner') }}</th>
                    <th style="background-color:#d4af37;">{{ __('رقم القسيمة') }}</th>
                    <th style="background-color:#d4af37;">{{ __('Chosen Contractor') }}</th>
                    <th style="background-color:#d4af37;">{{ __('Case #') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'نوع الحالة') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'عدد زيارات الاشراف الشهرية') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'قيمة العقد') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'تاريخ انتهاء العقد') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'المستلم من العقد') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'رقم الرخصة') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'مرحلة المشروع') }}</th>
                @else 
                    <th style="background-color:#d4af37;">{{ __(key: ' كود المشروع') }}</th>
                    <th style="background-color:#d4af37;">{{ __(key: 'اسم المالك') }}</th>
                    <th style="background-color:#d4af37;">سعر الهيكل مع الكتروميكانيكال</th>
                    <th style="background-color:#d4af37;">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</th>
                    <th style="background-color:#d4af37;">سعر الفوت بدون تشطيبات</th>
                    <th style="background-color:#d4af37;">سعر الفوت مع تشطيبات</th>
                    <th style="background-color:#d4af37;">سعر السور</th>
                    <th style="background-color:#d4af37;">  سعر الفيلا مع السور مع الواجهات </th>
                    <th style="background-color:#d4af37;">الضريبة 5%</th>
                    <th style="background-color:#d4af37;">السعر النهائي شامل الضريبة</th>
                @endif
                <!-- <th style="background-color:#d4af37;">{{ __(key: 'مدة المعاملة') }}</th> -->
                <!-- <th style="background-color:#d4af37;">{{ __('Building #') }}</th> -->
                <!-- <th style="background-color:#d4af37;">{{ __('Building #') }}</th> -->
                <!-- <th style="background-color:#d4af37;">{{ __(key: 'Case Type') }}</th> -->
                
                
                <!-- <th style="background-color:#d4af37;">{{ __('ProjectName') }}</th> -->
                <!-- <th style="background-color:#d4af37;">{{ __('Fence #') }}</th>
                    <th style="background-color:#d4af37;">{{ __('Status') }}</th>
                <th style="background-color:#d4af37;">{{ __('Start Date') }}</th>
                <th style="background-color:#d4af37;">{{ __('End Date') }}</th> -->
                <!-- <th style="background-color:#d4af37;">{{ __('Status') }}</th> -->
                <!-- <th style="width: 80px;background-color:#d4af37;" >{{ __('Action') }}</th> -->
            </tr>
            </thead>

            <tbody>
            @foreach($projects as $project)

                @php
                    $owner = $project->users->firstWhere('pivot.role_id', 1);
                    $contractor = $project->users->firstWhere('pivot.role_id', 3);
                    $targetUrl = in_array(auth()->user()->role_id, [1,4,11,12,7])
                        ? route('projects.edit', $project->id)
                        : url('users/'.$project->id.'/attachments/create?type=projects&mode=tender');
                @endphp

                <tr class="project-row"
                    data-href="{{ $targetUrl }}"
                    style="background-color:#f5f5dc; cursor:pointer;">




                @if(in_array(auth()->user()->role_id, [1,4,11,12,7,2]))
                
                    
                    <td style="background-color:#f5f5dc;">{{ $project->project_code }}</td>
                    <td style="background-color:#f5f5dc;font-weight:700;">{{ $project->ownerUser->name ?? '—' }}</td>
                    <td style="background-color:#f5f5dc;" onclick="event.stopPropagation();">{{ $project->qasmia_number ?? '—' }}</td>
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
                        $lastApproval2 = $project->baladyaApprovals->first();
                        $lastApproval = $project->baladyaApprovals
                            ->sortByDesc('id') // أو created_at
                            ->first();
                            //dd($lastApproval);
                        $daysDiff = $lastApproval && $lastApproval->opened_at && $lastApproval->approved_at
                                    ? $lastApproval->approved_at->diffInDays($lastApproval->opened_at)
                                    : null;
                    @endphp
                    
                        <td style="background-color:#f5f5dc;">
                            <!-- {{ $lastApproval->statusType->name_ar ?? '—' }} -->
                             {{ $project->baladyaStatusType->name_ar ?? '—' }}
                        </td>





                        <!-- <td style="background-color:#f5f5dc;">

    <span class="badge bg-dark">
        الكلي:
        {{ $project->total_supervisions_count ?? 0 }}
    </span>

    <br><br>

    <span class="badge bg-success">
        الشهر الحالي:
        {{ $project->current_month_supervisions_count ?? 0 }}
    </span>




</td> -->


<td style="background-color:#f5f5dc;">{{ $project->current_month_supervisions_count ?? '—' }}</td> 






                        <td style="background-color:#f5f5dc;">
                            {{ $project->bank_contract_value ?? '—' }}
                            <!-- {{ $project->bank_contract_value ?? '—' }} -->
                        </td>

                        @php
                            //use Carbon\Carbon;

                            $endDate = $project->contractor_contract_end_date 
                                ? \Carbon\Carbon::parse($project->contractor_contract_end_date) 
                                : null;

                            $bgColor = '#f5f5dc';

                            if($endDate){
                                if(now()->gt($endDate)){
                                    $bgColor = '#e91e0c'; // أحمر
                                } elseif(now()->diffInDays($endDate, false) <= 30){
                                    $bgColor = '#ffe5b4'; // برتقالي
                                }
                                else $bgColor = '#f5f5dc';
                            }
                            
                        @endphp

                        <td style="background-color:{{ $bgColor }};">
                            {{ $endDate ? $endDate->format('Y-m-d') : '-' }}
                        </td>
                        {{-- <td style="background-color:#e91e0c;">
                            {{ $project->contractor_contract_end_date 
                                ? \Carbon\Carbon::parse($project->contractor_contract_end_date)->format('Y-m-d') 
                                : '-' 
                            }}
                        </td> --}}

                        <td style="background-color:#f5f5dc;">
                            {{ number_format($project->paid_with_vat ?? 0, 0) }}
                        </td>
                        <td style="background-color:#f5f5dc;">
                            {{ $lastApproval->building_license_number ?? '-' }}
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



                    <!-- <td style="background-color:#f5f5dc;">
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
                    </td> -->
@php
    $stageColors = [
        1 => 'rgba(13, 110, 253, 0.5)',   // Design - أزرق شفاف
        2 => 'rgba(253, 126, 20, 0.5)',   // Baladia - برتقالي شفاف
        3 => 'rgba(111, 66, 193, 0.5)',   // Supervision - بنفسجي شفاف
        4 => 'rgba(255, 193, 7, 0.5)',    // Tender - أصفر شفاف
        5 => 'rgba(25, 135, 84, 0.5)',    // Completed - أخضر شفاف
    ];
@endphp

<td style="
    text-align:center;
    vertical-align:middle;
    font-weight:600;
    color: #fff;
    background-color: {{ $project->stage ? ($stageColors[$project->stage->id] ?? 'rgba(108, 117, 125,0.5)') : 'rgba(108, 117, 125,0.5)' }};
    backdrop-filter: blur(6px);
    border-radius:6px;
">

    {{ $project->stage
        ? (app()->getLocale() === 'ar' ? $project->stage->name_ar : $project->stage->name_en)
        : __('Not Started') 
    }}

</td>

    




                    <!-- <td style="background-color:#f5f5dc;">
                        {{ \Carbon\Carbon::parse($project->start_date)->format('Y-m-d') }}
                    </td style="background-color:#f5f5dc;">
                    <td style="background-color:#f5f5dc;">
                        {{ \Carbon\Carbon::parse($project->end_date)->format('Y-m-d') }}
                    </td> -->

                    <!-- <td style="background-color:#f5f5dc;">

                        @php
                            $owner = $project->users->firstWhere('pivot.role', __('Owner'));
                            $contractor = $project->users->firstWhere('pivot.role', __('Contractor'));
                        @endphp

                @else
                        @php
                            $owner = $project->users->firstWhere('pivot.role_id', 1);
                            //$contractor = $project->users->firstWhere('pivot.role_id', 3);
                            $targetUrl = in_array(auth()->user()->role_id, [1,4,11,12])
                                ? route('projects.edit', $project->id)
                                : url('users/'.$project->id.'/attachments/create?type=projects&mode=tender');
                            //$contractor = $project->users->first(function ($user) {
                            //    return in_array($user->pivot->role_id, [3, 8]);
                            //});

                            $contractor = $project->users->first(function ($user) {
                                return $user->id == auth()->id()
                                    && in_array($user->pivot->role_id, [3, 8]);
                            });

                        @endphp

              
                    
                            
                                <tr class="project-row"
                                    data-href="{{ $targetUrl }}"
                                    style="background-color:#f5f5dc; cursor:pointer;">
                                    <td style="background-color:#f5f5dc;">{{ $project->project_code?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $project->ownerUser->name ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->structureElectro ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->structureWithFinishes ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->footWithout ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->footWith ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->boundaryWall ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->villaWithWall ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->vat ?? '—' }}</td>
                                    <td style="background-color:#f5f5dc;">{{ $contractor->pivot->finalTotal ?? '—' }}</td>
                                </tr>
                            
                        
                @endif
                        
                    </td> -->
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
function exportTableToExcel(tableID, filename = 'projects') {
    let table = document.getElementById(tableID).cloneNode(true);

    // حذف أي عناصر مش عايزها (اختياري)
    table.querySelectorAll('a, button').forEach(el => el.remove());

    let html = `
    <html xmlns:o="urn:schemas-microsoft-com:office:office"
          xmlns:x="urn:schemas-microsoft-com:office:excel"
          xmlns="http://www.w3.org/TR/REC-html40">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
        ${table.outerHTML}
    </body>
    </html>`;

    let blob = new Blob(['\ufeff', html], {
        type: 'application/vnd.ms-excel'
    });

    let url = URL.createObjectURL(blob);

    let link = document.createElement("a");
    link.href = url;
    link.download = filename + '.xls';
    document.body.appendChild(link);
    link.click();

    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}
</script>





<script>
document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll(".project-row");

    rows.forEach(function(row) {
        row.addEventListener("click", function () {
            const url = this.getAttribute("data-href");
            if(url){
                window.location.href = url;
            }
        });
    });
});
</script>

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
