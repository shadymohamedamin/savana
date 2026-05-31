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
:root{
    --gov-primary:#6F5A24;      /* ذهبي غامق */
    --gov-secondary:#F8F4E8;   /* خلفية حكومية فاتحة */
    --gov-border:#C8B27A;      /* حدود */
    --gov-text:#4B3F1F;        /* نص */
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
    margin:50px;
    margin-top:100px;
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









tbody td{
 background:#fff;
}
.custom-table tbody td{
    font-size:13.5px;
    line-height:1.8;
}


.custom-header th{
    position:sticky;
    top:0;
    z-index:5;
}


.project-row{
   transition:.2s ease;
}

.project-row:hover{
   transform:scale(1.003);
}












    
/* ===== TOP ACTION BAR ===== */

.top-toolbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
    margin-bottom:25px;
    padding:12px 18px;
    background:#fff;
    border:1px solid #ececec;
    border-radius:14px;
}

/* ===== ACTION DROPDOWN ===== */

.action-dropdown{
    position:relative;
}

.action-btn{
    width:42px;
    height:42px;
    border:none;
    border-radius:12px;
    background:#f5f3ee;
    color:#6b5523;
    font-size:18px;
    transition:.2s;
}

.action-btn:hover{
    background:#e8dfc7;
}

.action-menu{
    position:absolute;
    top:50px;
    right:-180px;
    min-width:220px;
    background:#fff;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    border:1px solid #ececec;
    overflow:hidden;
    display:none;
    z-index:999;
}

.action-menu.show{
    display:block;
}

.action-menu a,
.action-menu button{
    display:flex;
    align-items:center;
    gap:10px;
    width:100%;
    padding:12px 16px;
    background:none;
    border:none;
    text-decoration:none;
    color:#444;
    font-size:14px;
    transition:.2s;
    text-align:right;
}

.action-menu a:hover,
.action-menu button:hover{
    background:#f8f6f1;
}

/* ===== FILTER BOX ===== */

.filter-panel{
    display:none;
    margin-bottom:20px;
    padding:18px;
    background:#fff;
    border-radius:14px;
    border:1px solid #ececec;
}

.filter-panel.show{
    display:block;
}

/* ===== TABLE SPACE ===== */

.table-wrapper{
    margin-top:30px;
}

/* ===== CLEAN BUTTONS ===== */

.btn{
    border-radius:10px !important;
}

/* ===== LESS VISUAL NOISE ===== */

.table th{
    background:#f7f4ec !important;
    border-color:#eee !important;
}

.table td{
    border-color:#f3f3f3 !important;
}

/* ===== SMOOTH ===== */

.card,
.table,
.btn,
.action-btn{
    transition:.2s ease;
}












.card-header{
    padding:20px 24px !important;
}

.card-body{
    padding:24px !important;
}

.table-wrapper{
    margin-top:25px;
    overflow:auto;
}

.filter-panel{
    margin-bottom:20px;
}
.card{
    background-color: var(--gov-bg) !important;
    border: 2px solid var(--gov-border) !important;
    border-radius: 14px !important;

    overflow: visible !important;
}
.action-dropdown{
    position:relative;
}

.action-menu{
    position:absolute;
    top:50px;

    left:auto;
    min-width:220px;
}
.action-menu a,
.action-menu button{
    justify-content:flex-start;
    direction:rtl;
}
.action-menu{
    position:absolute;
    top:50px;

   

    min-width:220px;
    background:#fff;
    border-radius:14px;
    z-index:9999;
}






.project-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:5px;
    background:#6F5A24;
}
.btn-olive,
.btn-success,
.btn-apply,
.btn-reset{
    background:#6F5A24 !important;
    border-color:#6F5A24 !important;
}
.project-expired{
    border-right:4px solid #B54D4D;
}
.gov-page-title{
    font-size:22px;
    font-weight:800;
    color:#6F5A24;
    border-bottom:0px solid #D8C187;
    padding-bottom:12px;
    margin-bottom:20px;
    text-align: center;
}




.gov-header{
    display:flex;
    align-items:center;
    gap:18px;

    padding:20px 24px;
    margin-bottom:25px;

    background:#F8F4E8;
    border:2px solid #C8B27A;
    border-radius:14px;

    box-shadow:0 3px 10px rgba(0,0,0,.04);
}

.gov-header-icon{
    width:60px;
    height:60px;

    display:flex;
    align-items:center;
    justify-content:center;

    border-radius:12px;

    background:#6F5A24;
    color:#fff;
    font-size:24px;
}

.gov-header-title{
    font-size:24px;
    font-weight:800;
    color:#6F5A24;
}

.gov-header-subtitle{
    font-size:13px;
    color:#8A7745;
    margin-top:0px;
}
.gov-header{
    justify-content:space-between;
}

.gov-header-stats{
    display:flex;
    gap:15px;
}

.gov-stat{
    min-width:120px;
    text-align:center;

    background:#fff;
    border:1px solid #D8C187;
    border-radius:10px;

    padding:10px;
}

.gov-stat span{
    display:block;
    font-size:22px;
    font-weight:800;
    color:#6F5A24;
}

.gov-stat small{
    color:#8A7745;
}


</style>





<div class="pt-4 card shadow-sm rounded-4 m-0" style="background-color: #f5f5dc; margin-top:50px;">

  


<div class="gov-header">
    <div class="gov-header-icon">
        <i class="fas fa-building"></i>
    </div>

    <div>
        <div class="gov-header-title">
            إدارة المشاريع
        </div>

        <div class="gov-header-subtitle">
            متابعة المشاريع والمقاولين والحالات
        </div>
    </div>

    <div class="gov-header-stats">

    <div class="gov-stat">
        <span>{{ $projects->total() }}</span>
        <small>إجمالي المشاريع</small>
    </div>

    <div class="gov-stat">
        <span>{{ $activeProjects }}</span>
        <small>مشاريع نشطة</small>
    </div>

</div>
</div>
    



   <div class="card-header  justify-content-between align-items-center"
     style="background:#D4AF37; color:#2f3a1f; font-size:1.3rem; font-weight:600; " >
    



    <!-- <div>
        {{ __('Projects') }}
    </div>

  
    <div class="mx-auto">
        {{ Auth::user()->name }}
    </div>

  
    <div></div> -->


<div class="top-toolbar">

    {{-- <div>
        <div style="position:relative; min-width:260px;">

    <i class="fas fa-search"
       style="
       position:absolute;
       right:14px;
       top:50%;
       transform:translateY(-50%);
       color:#999;
       "></i>

    <input type="text"
           class="form-control"
           placeholder="بحث سريع..."
           name="search"
           value="{{ request('search') }}"
           style="
           padding-right:40px;
           border-radius:12px;
           height:42px;
           ">



</div>
    </div> --}}



<form method="GET"
      action="{{ route('projects.index') }}"
      style="margin:0;">

    <div style="position:relative; min-width:260px;">

    <i class="fas fa-search"
       style="
       position:absolute;
       right:14px;
       top:50%;
       transform:translateY(-50%);
       color:#999;
       z-index:2;">
    </i>

    <input type="text"
           name="search"
           value="{{ request('search') }}"
           class="form-control"
           placeholder="بحث سريع..."
           style="
           padding-right:40px;
           padding-left:40px;
           border-radius:12px;
           height:42px;
           "
           oninput="clearTimeout(window.searchTimer);
            window.searchTimer=setTimeout(()=>{
                this.form.submit();
            },500)"
           onkeydown="if(event.key==='Enter'){ this.form.submit(); }">

    <a href="{{ route('projects.index') }}"
       style="
       position:absolute;
       left:12px;
       top:50%;
       transform:translateY(-50%);
       text-decoration:none;
       color:#999;
       font-size:16px;
       z-index:2;">
       ✖
    </a>

</div>

</form>


    <div class="action-dropdown">

        <button type="button" class="action-btn" id="actionToggle">
            ⚙️
        </button>

        <div class="action-menu" id="actionMenu">

            <a href="{{ route('projects.create') }}">
    <i class="fas fa-plus"></i>
    إضافة مشروع
</a>

<a href="{{ route('users.create') }}">
    <i class="fas fa-user-plus"></i>
    إضافة مستخدم
</a>

<a href="{{ route('projects.show', 1) }}">
    <i class="fas fa-list"></i>
    جدول المساحات
</a>

<button type="button"
        onclick="exportTableToExcel('projects-table')">
    <i class="fas fa-file-excel"></i>
    تصدير Excel
</button>

            <button type="button" id="toggleFilter">
                🔍 فلترة
            </button>

        </div>

    </div>

</div>
</div>

        <!-- <div class="d-flex gap-2">

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
    </div> -->



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












<div class="card-body">

<div class="filter-panel" id="filterPanel">

    {{-- الفلاتر الحالية هنا --}}



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




</div>



    <div class="table-responsive p-3" style="background-color:#f5f5dc;">
        <!-- <table class="table table-hover align-middle rounded-4"
               style="border:1px solid #D4AF37;"> -->

        <!-- <table class="table table-hover align-middle rounded-4 custom-table"
               style="border:1px solid #D4AF37;"> -->

<div class="table-wrapper">

    {{-- table here --}}



        <table id="projects-table"
       class="table table-hover align-middle rounded-4 custom-table"
       style="border:1px solid #D4AF37;">
           <thead class="custom-header" style="background-color:#d4af37;color:#2f3a1f;">

            <tr class="project-roww"style="background:#6F5A24 !important;
    color:#fff !important;">
                @if(in_array(auth()->user()->role_id, [1,4,11,12,7,2]))
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __('Code') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __('Owner') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __('رقم القسيمة') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __('Chosen Contractor') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __('Case #') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'نوع الحالة') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: '  الزيارات الشهرية ') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'قيمة العقد') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'تاريخ انتهاء العقد') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'المستلم من العقد') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'رقم الرخصة') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'مرحلة المشروع') }}</th>
                @else 
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: ' كود المشروع') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">{{ __(key: 'اسم المالك') }}</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">سعر الهيكل مع الكتروميكانيكال</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">سعر الفوت بدون تشطيبات</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">سعر الفوت مع تشطيبات</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">سعر السور</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">  سعر الفيلا مع السور مع الواجهات </th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">الضريبة 5%</th>
                    <th style="background:#6F5A24 !important;
    color:#fff !important;">السعر النهائي شامل الضريبة</th>
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


<td style="background-color:#f5f5dc; ">{{ $project->current_month_supervisions_count ?? '—' }}</td> 






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
    $bgColor = '#E8D1D1';   // أحمر هادئ
}
elseif(now()->diffInDays($endDate,false)<=30){
    $bgColor = '#F4E8C8';   // تنبيه ذهبي
}
else{
    $bgColor = '#f5f5dc';
}
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
    1 => '#F7F1DE',
    2 => '#EFE4C0',
    3 => '#E4D4A0',
    4 => '#D8C187',
    5 => '#C8AA5A',
];
@endphp

<td style="
    text-align:center;
    vertical-align:middle;
    font-weight:600;
    color:#4B3F1F;
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
</div>
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








<script>

const toggleBtn = document.getElementById('actionToggle');
const menu = document.getElementById('actionMenu');

toggleBtn?.addEventListener('click', () => {
    menu.classList.toggle('show');
});

document.getElementById('toggleFilter')?.addEventListener('click', () => {
    document.getElementById('filterPanel')
        ?.classList.toggle('show');
});

window.addEventListener('click', function(e){

    if(!e.target.closest('.action-dropdown')){
        menu?.classList.remove('show');
    }

});

</script>
