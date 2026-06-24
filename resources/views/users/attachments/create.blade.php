@extends('layouts.app')

@section('content')


<style>
    .attachment-complete {
        background-color: #e6fffa !important; /* أخضر فاتح */
        border-left: 5px solid #198754; /* Bootstrap green */
    }

    .attachment-pending {
        background-color: #fff3cd !important; /* أصفر */
    }


    .btn-olive {
        background-color:#d4af37 ;   /*#2f3a1f زيتوني غامق */
        border: 1px solid #2f3a1f;
        color: #2f3a1f;              /* ذهبي */
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-olive:hover {
        background-color: #3e4a29;  /* زيتوني أفتح */
        border-color: #d4af37;       /* إطار ذهبي */
        color: #fff;                /* أبيض أنيق */
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(212,175,55,0.35);
    }
    .buttons_container{
        padding-bottom: 4rem;
    }


    .attachment-box input[type="file"] {
    font-size: 13px;
}

.attachment-box .btn {
    padding: 2px 8px;
    font-size: 12px;
}

.selected-file-name {
    font-size: 12px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}



/* container */

.contract-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(230px,1fr));
    gap:16px;
    background:#f5f5dc;
    padding:15px;
}

/* box */

/* .contract-box{
    background:white;
    border:1px solid #e5e5e5;
    border-radius:10px;
    padding:15px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    min-height:170px;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    transition:0.2s;
} */

.contract-box{
    background: #fff;
    border: 2px solid #D8C187;
    border-radius: 14px;
    padding: 18px;
    min-height: 220px;

    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 10px;

    box-shadow: 0 4px 12px rgba(111,90,36,.08);
    transition: all .25s ease;
}

.contract-box:hover{
    transform: translateY(-4px);
    background: #FFFDF7;
    border-color: #6F5A24;
    box-shadow: 0 8px 24px rgba(111,90,36,.15);
}

.contract-box span{
    color: #6F5A24;
    font-size: 15px;
    font-weight: 700;
    text-align: center;
    line-height: 1.6;
    min-height: 48px;
}
.edit-btn{
    background: linear-gradient(45deg,#ff9800,#ff5722);
    border: none;
    color: #fff;
    font-weight: bold;
    padding: 6px 14px;
    border-radius: 6px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.25);
    transition: all 0.2s ease;
}

.edit-btn:hover{
    transform: scale(1.05);
    box-shadow: 0 5px 12px rgba(0,0,0,0.35);
}
/* hover */

.contract-box:hover{
    transform:translateY(-2px);
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}

/* title */

.contract-box span{
    font-weight:600;
    font-size:14px;
    text-align:center;
    margin-bottom:10px;
}

/* buttons */

.contract-box .btn{
    width:100%;
}

:root{
    --gov-primary:#6F5A24;
    --gov-secondary:#F8F4E8;
    --gov-border:#C8B27A;
    --gov-text:#4B3F1F;
    --gov-bg:#F8F4E8;
    --gov-hover:#EFE8C8;
}

.card{
    background:#F8F4E8;
    border:2px solid #C8B27A;
    border-radius:14px;
}

.gov-header{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:20px;
    padding:20px;
    margin-bottom:25px;
    background:#F8F4E8;
    border:2px solid #C8B27A;
    border-radius:14px;
}

.gov-header-icon{
    width:60px;
    height:60px;
    border-radius:12px;
    background:#6F5A24;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.gov-header-title{
    font-size:24px;
    font-weight:800;
    color:#6F5A24;
}

.gov-header-subtitle{
    color:#8A7745;
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

.top-toolbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:20px;
}

.filter-input{
    border:1px solid #C8B27A;
    border-radius:8px;
    height:44px;
}

.btn-olive{
    background:#6F5A24 !important;
    border-color:#6F5A24 !important;
    color:#fff !important;
}

.contract-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
    gap:18px;
    background:#F8F4E8;
}

.contract-box{
    background:#fff;
    border:1px solid #D8C187;
    border-radius:12px;
    padding:15px;
    transition:.2s;
}

.contract-box:hover{
    background:#EFE8C8;
    transform:translateY(-2px);
}
.contract-box{
    background: #fff;
    border: 2px solid #D8C187;
    border-radius: 14px;
    padding: 18px;
    min-height: 220px;

    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 10px;

    box-shadow: 0 4px 12px rgba(111,90,36,.08);
    transition: all .25s ease;
}

.contract-box:hover{
    transform: translateY(-4px);
    background: #FFFDF7;
    border-color: #6F5A24;
    box-shadow: 0 8px 24px rgba(111,90,36,.15);
}

.contract-box span{
    color: #6F5A24;
    font-size: 15px;
    font-weight: 700;
    text-align: center;
    line-height: 1.6;
    min-height: 48px;
}
.contract-box .btn-outline-primary{
    border-color: #6F5A24;
    color: #6F5A24;
}

.contract-box .btn-outline-primary:hover{
    background: #6F5A24;
    color: #fff;
}
.contract-box .btn-success{
    background: #C8B27A;
    border-color: #C8B27A;
    color: #3F3318;
}

.contract-box .btn-success:hover{
    background: #B89E5E;
    border-color: #B89E5E;
}
.contract-box .btn-warning{
    background: #EFE8C8;
    border-color: #D8C187;
    color: #6F5A24;
}

.contract-box .btn-warning:hover{
    background: #D8C187;
}

.contract-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
    gap:20px;
    padding:20px;
    background:#F8F4E8;
}




.contract-box .btn{
    width: 100%;
    border-radius: 8px;
    font-weight: 600;
    transition: .2s;
}
.contract-icon{
    width:55px;
    height:55px;
    margin:auto;
    border-radius:12px;
    background:#6F5A24;
    color:#fff;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:22px;
}






.upload-card{
    background:#fff;
    border:2px solid #D8C187;
    border-radius:16px;
    transition:.25s ease;
    overflow:hidden;
}

.upload-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 25px rgba(111,90,36,.12);
    border-color:#6F5A24;
}

.upload-card .card-body{
    background:#FFFDF7 !important;
    padding:20px;
}
.attachment-box{
    background:#FAF7EE;
    border:2px dashed #C8B27A;
    border-radius:12px;
    padding:12px;
    transition:.3s;
}

.attachment-box:hover{
    background:#F5EFD8;
    border-color:#6F5A24;
}

.attachment-box input[type=file]{
    border:none;
    background:transparent;
}

.selected-file-name{
    background:#fff;
    border:1px solid #E5D6A5;
    border-radius:8px;
    padding:6px 10px;
    margin-top:8px;
}

.btn-add-file{
    background:linear-gradient(135deg,#D4AF37,#B8952F);
    color:#fff;
    border:none;
    border-radius:10px;
    padding:10px 18px;
    font-weight:700;
    transition:.3s;
}

.btn-add-file:hover{
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(212,175,55,.35);
    color:#fff;
}
.removeAttachment{
    border-radius:10px !important;
    font-weight:700;
    border:none !important;
    background:#FEE2E2 !important;
    color:#DC2626 !important;
    transition:.25s;
}

.removeAttachment:hover{
    background:#DC2626 !important;
    color:#fff !important;
    transform:scale(1.05);
}
.upload-ready{
    border-color:#198754 !important;
    background:#F0FFF4 !important;
}

.upload-ready .attachment-box{
    border-color:#198754;
}

.preview-file{
    border-radius:8px;
    font-weight:600;
}

.remove-file{
    border-radius:8px;
    font-weight:600;
}

.btn-save{
    background:#198754;
    color:#fff;
    border:none;
    padding:12px 30px;
    border-radius:10px;
}

.btn-save:hover{
    background:#C8B27A;
}
.upload-card{
    background: #fff;
    border: none;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 12px 35px rgba(0,0,0,.08);
}

.upload-card .card-header{
    background: linear-gradient(135deg,#6F5A24,#9D8140);
    color:#fff;
    padding:18px 24px;
    font-size:18px;
    font-weight:700;
}

.upload-card .card-body{
    background:#FDFBF5 !important;
    padding:25px;
}
.attachment-item{
    background:#fff;
    border:1px solid #E5D6A5;
    border-radius:16px;
    transition:.3s;
    overflow:hidden;
}

.attachment-item:hover{
    transform:translateY(-3px);
    box-shadow:0 12px 25px rgba(111,90,36,.12);
    border-color:#C8B27A;
}
.attachment-item select{
    border:2px solid #E5D6A5;
    border-radius:12px;
    height:48px;
}

.attachment-item select:focus{
    border-color:#6F5A24;
    box-shadow:0 0 0 .2rem rgba(111,90,36,.15);
}
.attachment-box{
    background:#FAF7EE;
    border:2px dashed #C8B27A;
    border-radius:14px;
    padding:15px;
    text-align:center;
    transition:.3s;
}

.attachment-box:hover{
    background:#FFFDF7;
    border-color:#6F5A24;
}
.upload-icon{
    font-size:35px;
    color:#C8B27A;
    margin-bottom:10px;
}
.preview-file{
    background:#C8B27A;
    color:#fff !important;
    border:none;
    border-radius:10px;
}

.preview-file:hover{
    background:#C8B27A;
}

.remove-file{
    background:#DC3545;
    color:#fff !important;
    border:none;
    border-radius:10px;
}

.remove-file:hover{
    background:#BB2D3B;
}
.btn-add-file{
    background:linear-gradient(
        135deg,
        #D4AF37,
        #B8952F
    );
    border:none;
    color:#fff;
    font-weight:700;
    border-radius:12px;
    padding:12px 20px;
    box-shadow:0 8px 18px rgba(212,175,55,.25);
}

.btn-add-file:hover{
    transform:translateY(-2px);
    box-shadow:0 12px 24px rgba(212,175,55,.35);
}
.upload-ready{
    border:2px solid #198754 !important;
    background:#F0FFF4 !important;
}

.upload-ready .upload-icon{
    color:#198754;
}
.attachment-item{
    background:#fff;
    border:1px solid #E5D6A5;
    border-radius:16px;
    padding:20px;
    box-shadow:0 4px 15px rgba(0,0,0,.06);
}

.attachment-box{
    background:#FAF7EE;
    border:2px dashed #C8B27A;
    border-radius:14px;
    padding:20px;
    text-align:center;
}

.upload-icon{
    font-size:40px;
    margin-bottom:10px;
}

.selected-file-name{
    background:#fff;
    border:1px solid #ddd;
    border-radius:8px;
    padding:8px;
    font-size:13px;
}

.attachment-item label{
    color:#6F5A24;
    font-weight:700;
}

.preview-file,
.remove-file{
    flex:1;
}
#attachmentContainer{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(350px,1fr));
    gap:20px;
}

#attachmentContainer .attachment-card{
    margin-bottom:0 !important;
}
#attachmentContainer{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(350px,1fr));
    gap:20px;
}

.attachment-card{
    width:100%;
}
.preview-file{
    background:#C8B27A;
    color:#fff !important;
}












</style>
@php
    $type = request('type');
    $isTender = request('mode') === 'tender';
    $isDesigns= request('mode') === 'designs';
    $isDesignsFiles= request('mode') === 'designs_files';
    $isCotractorFiles=request('mode') === 'contractor_files';
    $projectDocuments=request('mode') === 'project_documents';
    $isAchievements=request('mode') === 'achievements';
    

    $mode=request('mode');
    
@endphp

@php
    $isEdit = isset($attachments) && $attachments->count() > 0;
@endphp


<div class="container-fluid px-3">

    <div class="gov-header">

        <div class="d-flex align-items-center gap-3">

            <div class="gov-header-icon">
                <i class="fas fa-folder-open"></i>
            </div>

            <div>
                <div class="gov-header-title">
                    إدارة المرفقات
                </div>

                <div class="gov-header-subtitle">
                    إدارة وعرض وتحميل مستندات المشروع
                </div>
            </div>

        </div>

        <div class="gov-header-stats">

            <div class="gov-stat">
                <span>{{ count($rows ?? []) }}</span>
                <small>إجمالي المستندات</small>
            </div>

            <div class="gov-stat">
                <span>{{ $attachments->count() ?? 0 }}</span>
                <small>المرفقات</small>
            </div>

        </div>

    </div>
    <!-- <h3>{{ __('Manage Attachments for') }}: {{ $model->name }}</h3> -->


@if (in_array(auth()->user()->role_id, [1,4,11,12,7]))
    <div></div>
    <!-- <h3>
        {{ $isEdit ? __('Edit Attachments for') : __('Manage Attachments for') }}
        : {{ $model->name }}
    </h3> -->
@else <h3>
        {{-- المناقصة --}}
    </h3>
@endif
    @include('flash::message')

   



    <!-- @if($type === 'projects')
        <div class="card mb-4">
            <div class="card-header text-white" style="background:#d4af37">
                {{ __('Standard Templates') }}
            </div>

            <div class="card-body" style="background-color: #f5f5dc;">
                <ul>
                    <li>
                        <a href="{{ route('projects.contract.download', $model->id) }}" target="_blank">
                            📄 عقد الاتفاق (PDF)
                        </a>
                    </li>
                    <li><a href="{{ asset('templates/assignment.pdf') }}" download>خطاب التكليف</a></li>
                    <li><a href="{{ asset('templates/form.pdf') }}" download>فورم الفيزا</a></li>
                </ul>
            </div>
        </div>
    @endif -->





@if($type === 'projects')




    @include('projects.partials.project-actions', ['project' => $model])

<div class="card shadow-sm mb-4">
    <!-- <div class="card-header text-white" style="background:#d4af37">
        {{ __('Standard Templates') }}
    </div> -->






    <div class="card-header d-flex justify-content-between align-items-center"
     style="
        background:#6F5A24;
        color:#fff;
        border-bottom:2px solid #C8B27A;">
        <span style="font-weight: 700;">{{ __('معاينة وطباعة المستندات ') }}</span>
  
        @if($isCotractorFiles&&in_array(Auth::user()->role_id, [1,4,11,12,7]))


        <div class="flex justify-start" style="gap: 1rem;">
            <a href="{{ route('projects.schedule.newBatch', $project->id) }}"
            class="btn btn-olive px-4 btn-sm"
                    style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
                <i class="fas fa-plus"></i> طلب دفعة 
            </a>
            <a href="{{ route('projects.schedules.batches', $project->id) }}"
                class="btn btn-olive px-4 btn-sm"  
                style="background:#d4af37;color:#2f3a1f;font-weight: 700; margin-right: 1rem;">
                    <i class="fas fa-users"></i>  جداول الدفوعات 
            </a>
        </div>
        @elseif($isTender&&in_array(Auth::user()->role_id, [1,4,11,12,7]))
        <div class="flex justify-start" style="gap: 1rem;">
            
            <a href="{{ route('projects.tender.contractors', $model->id) }}"
                class="btn btn-olive px-4 btn-sm"  
                style="background:#d4af37;color:#2f3a1f;font-weight: 700; margin-right: 1rem;">
                    <i class="fas fa-users"></i> المقاولين المرشحين
            </a>
            <a href="{{ route('projects.owner-requirements.index', [$model, 'context' => 'pricing']) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight: 700;margin-right: 1rem;">
                    <i class="fas fa-file-signature"></i> أسعار توريد التشطيبات
            </a>


            {{-- <a href="{{ route('projects.owner-requirements.index', [$model, 'context' => 'tender']) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight: 700;margin-right: 1rem;">
                    <i class="fas fa-file-signature"></i> حساب الكميات
            </a> --}}
        </div>
        @elseif(!$isDesignsFiles&&!$isAchievements&&!$isCotractorFiles&&!$projectDocuments&&$type='projects'&&in_array(Auth::user()->role_id, [1,4,11,12,7]))
        <a href="{{ route('projects.owner-requirements.index', ['project' => $model->id]) }}" class=" btn-add-file">
                <i class="fas fa-clipboard-list"></i>
                احتياجات المالك
            </a>
        @endif

    </div>

 





    <div class="card-body contract-grid">


        @if($isTender)

            <div class="contract-box">
                
                <span class="mb-1">{{ __('العقد الاساسي') }}</span>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>
                <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>



           <div class="contract-box">
                <span class="mb-1">{{ __('المواصفات الفنية والشروط العامة') }}</span>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
                class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'download']) }}"
                class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'print']) }}"
                class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>


            <div class="contract-box">
                <span class="mb-1">{{ __('اسعار التوريد') }}</span>

                <!-- <a target="_blank" href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a> -->


                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', [
    'id' => $model->id, 
    'action' => 'preview',
    'context'=>'pricing',
    'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
]) }}" class="btn btn-outline-primary btn-sm mb-1">
    👁 {{ __('Preview') }}
</a>

<a href="{{ route('projects.contract.pricing.pdf', [
    'id' => $model->id, 
    'action' => 'download',
    'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
]) }}" class="btn btn-success btn-sm mb-1">
    ⬇ {{ __('Download') }}
</a>

<a target="_blank" href="{{ route('projects.contract.pricing.pdf', [
    'id' => $model->id, 
    'action' => 'print',
    'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
]) }}" class="btn btn-warning btn-sm">
    🖨 {{ __('Print') }}
</a>

            </div>








@php
$lastBatchId = \App\Models\ProjectSchedule::where('project_id', $project->id)
    ->max('batch_id') ?? 1;
@endphp

<div class="contract-box">
    <span class="mb-1">📊 جدول مراحل المشروع</span>



    <a href="{{ route('projects.schedule', ['project' => $project->id, 'batch_id' => $lastBatchId]) }}"
                class="btn btn-warning btn-sm mb-1 edit-btn">
                ✏️ {{ __('تعديل') }}
                </a>




    <a target="_blank"
       href="{{ route('projects.schedule.pdf', [
        'id' => $project->id,
        'batch_id' => $lastBatchId,
        'action' => 'preview'
   ]) }}"
       class="btn btn-outline-primary btn-sm mb-1">
        👁 معاينة
    </a>

    <a href="{{ route('projects.schedule.pdf', [
        'id' => $project->id,
        'batch_id' => $lastBatchId,
        'action' => 'download'
   ]) }}"
       class="btn btn-success btn-sm mb-1">
        ⬇ تحميل
    </a>

 
</div>





            <div class="contract-box">
                <span class="mb-1">{{ __(' حساب الكميات') }}</span>


                @if(in_array(Auth::user()->role_id, [1,4,11,12]))
                



<a target="_blank" href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'preview',
    'context'=>'tender',
    'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
]) }}" class="btn btn-outline-primary btn-sm mb-1">
    👁 {{ __('Preview') }}
</a>

<a href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'download',
    'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
]) }}" class="btn btn-success btn-sm mb-1">
    ⬇ {{ __('Download') }}
</a>

<a target="_blank" href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'print',
    'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
]) }}" class="btn btn-warning btn-sm">
    🖨 {{ __('Print') }}
</a>

                <!-- <a target="_blank" href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank" href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a> -->
                @elseif(Auth::user()->role_id==3)

















                <a href="{{ route('projects.owner-requirements.index', [
                        'project'=>$model->id,
                        'context'=>'tender',
                        'contractor'=>Auth::user()->id
                    ]) }}" 
                class="btn btn-warning btn-sm mb-1 edit-btn">
                ✏️ {{ __('تعديل') }}
                </a>

                 <a target="_blank" 

                    href="{{ route('projects.contract.tender.pdf', [
                        $model->id,
                        'action' => 'preview',
                        'contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)
                    ]) }}"
                    
                    class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('معاينة') }}
                </a>

                <a href="{{ route('projects.contract.tender.pdf', ['id' => $model->id, 'action' => 'download','contractor' => auth()->user()->role_id == 3 
    ? auth()->id() 
    : ($model->contractor_id ?? null)]) }}" class="btn btn-success btn-sm mb-1">
                    🖨 {{ __('تحميل') }}
                </a>
                @endif
            </div>
<!-- !in_array(auth()->user()->role_id, [1,4,11,12,7]) && -->
            @if($isTender||$isDesigns) 
                @foreach($rows as $row)
                    @php
                        $typeId = $row['type_id'];
                        $att = $row['attachment'];
                        //dd($row);
                    @endphp
                    <div class="contract-box">
                        
                    
                        <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 معاينة
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ تعديل
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 طباعة
                                </a>
                                @else <div>غير موجود</div>
                                @endif
                    </div>
                @endforeach


            @endif

                    <!-- @if(!in_array(auth()->user()->role_id, [1,4,11,12]) && $isTender)

                    <div class="card-body d-flex flex-wrap gap-4" style="background:#f5f5dc">

                        @foreach($rows as $row)
                            @php
                                $typeId = $row['type_id'];
                                $att = $row['attachment'];
                                //dd($row);
                            @endphp

                            <div class="d-flex flex-column border p-3 rounded bg-light" style="min-width:200px">

                                <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 Preview
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ Download
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 Print
                                </a>
                                @else <div>غير موجود</div>
                                @endif

                            </div>
                        @endforeach

                    </div>

                    @endif -->

        @elseif($isCotractorFiles)
            <div class="contract-box">
                <span class="mb-1">{{ __('العقد الاساسي') }}</span>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>
                <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>
                <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>



            <div class="contract-box">
                <span class="mb-1">{{ __('المواصفات الفنية والشروط العامة') }}</span>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
                class="btn btn-outline-primary btn-sm mb-1">
                    👁 {{ __('Preview') }}
                </a>

                <a href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'download']) }}"
                class="btn btn-success btn-sm mb-1">
                    ⬇ {{ __('Download') }}
                </a>

                <a target="_blank"
                href="{{ route('projects.contract.specs.pdf', ['id' => $model->id, 'action' => 'print']) }}"
                class="btn btn-warning btn-sm">
                    🖨 {{ __('Print') }}
                </a>
            </div>


            <div class="contract-box">
                <span class="mb-1">{{ __('اسعار التوريد') }}</span>

                <a target="_blank" href="{{ route('projects.contract.pricing.pdf', [
    'id' => $model->id, 
    'action' => 'preview',
    'context'=>'pricing',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-outline-primary btn-sm mb-1">
    👁 {{ __('Preview') }}
</a>

<a href="{{ route('projects.contract.pricing.pdf', [
    'id' => $model->id, 
    'action' => 'download',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-success btn-sm mb-1">
    ⬇ {{ __('Download') }}
</a>

<a target="_blank" href="{{ route('projects.contract.pricing.pdf', [
    'id' => $model->id, 
    'action' => 'print',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-warning btn-sm">
    🖨 {{ __('Print') }}
</a>
            </div>




            <div class="contract-box">
                <span class="mb-1">{{ __(' حساب الكميات') }}</span>

                <a target="_blank" href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'preview',
    'context'=>'tender',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-outline-primary btn-sm mb-1">
    👁 {{ __('Preview') }}
</a>

<a href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'download',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-success btn-sm mb-1">
    ⬇ {{ __('Download') }}
</a>

<a target="_blank" href="{{ route('projects.contract.tender.pdf', [
    'id' => $model->id, 
    'action' => 'print',
    'contractor'=>$model->contractor_id
]) }}" class="btn btn-warning btn-sm">
    🖨 {{ __('Print') }}
</a>
            </div>











                  {{-- Hawya Contract --}}
             <div class="contract-box">
                <span class="mb-1">{{ __('Hawya Contract') }}</span>

             <a target="_blank" href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                 👁 {{ __('Preview') }}
                </a>

            <a href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.hawya.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div> 



        
            <div class="contract-box">
            <span class="mb-1">{{ __('وثيقة تسليم الموقع') }}</span>

            <a target="_blank" href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.site_delivery.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div>





            <div class="contract-box">
            <span class="mb-1">{{ __('Bank Contract') }}</span>

            <a target="_blank" href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.bank.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div>







            <div class="contract-box">
            <span class="mb-1">{{ __('كميات البنك') }}</span>

            <a target="_blank" href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                👁 {{ __('Preview') }}
            </a>

            <a href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                ⬇ {{ __('Download') }}
            </a>

            <a target="_blank" href="{{ route('projects.contract.bank_table.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                🖨 {{ __('Print') }}
            </a>
            </div> 

            











            @foreach($rows as $row)
                    @php
                        $typeId = $row['type_id'];
                        $att = $row['attachment'];
                        //dd($row);
                    @endphp
                    <div class="contract-box">
                        
                    
                        <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 معاينة
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ تعديل
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 طباعة
                                </a>
                                @else <div>غير موجود</div>
                                @endif
                    </div>
                @endforeach





                <div class="contract-box">
    <span class="mb-1">📊 جدول مراحل المشروع</span>

    <a target="_blank"
       href="{{ route('projects.schedule.pdf', ['id' => $project->id, 'action' => 'preview']) }}"
       class="btn btn-outline-primary btn-sm mb-1">
        👁 معاينة
    </a>

    <a href="{{ route('projects.schedule.pdf', ['id' => $project->id, 'action' => 'download']) }}"
       class="btn btn-success btn-sm mb-1">
        ⬇ تحميل
    </a>

    <a target="_blank"
       href="{{ route('projects.schedule.pdf', ['id' => $project->id, 'action' => 'print']) }}"
       class="btn btn-warning btn-sm">
        🖨 طباعة
    </a>
</div>



        @else
        
                {{--    Owner And Consultant Contract عقد المالك والاستشاري والمقاول --}}
                <!-- <div class="d-flex flex-column">
                    <span class="mb-1">{{ __('Owner And Consultant Contract') }}</span>
                    <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                        👁 {{ __('Preview') }}
                    </a>
                    <a href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                        ⬇ {{ __('Download') }}
                    </a>
                    <a target="_blank" href="{{ route('projects.contract.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                        🖨 {{ __('Print') }}
                    </a>
                </div>  -->

                {{-- عقد المالك والاستشاري --}}
                @if(!$projectDocuments&&!$isDesigns&&!$isDesignsFiles&&!$isAchievements)
                    <div class="contract-box">
                        <span class="mb-1">{{ __('Owner And Consultant And Contractor Contract') }}</span>
                        <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                            👁 {{ __('Preview') }}
                        </a>
                        <a href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                            ⬇ {{ __('Download') }}
                        </a>
                        <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                            🖨 {{ __('Print') }}
                        </a>
                    </div>

                    {{-- خطاب التكليف --}}
                    <div class="contract-box">
                        <span class="mb-1">{{ __('Takleef Contract') }}</span>

                        <a target="_blank"
                        href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'preview']) }}"
                        class="btn btn-outline-primary btn-sm mb-1">
                            👁 {{ __('Preview') }}
                        </a>

                        <a href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'download']) }}"
                        class="btn btn-success btn-sm mb-1">
                            ⬇ {{ __('Download') }}
                        </a>

                        <a target="_blank"
                        href="{{ route('projects.contract.takleef.pdf', ['id' => $model->id, 'action' => 'print']) }}"
                        class="btn btn-warning btn-sm">
                            🖨 {{ __('Print') }}
                        </a>
                    </div>


                    <div class="contract-box">
                        <span class="mb-1">{{ __('احتياجات المالك') }}</span>

                        <a target="_blank" href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                            👁 {{ __('Preview') }}
                        </a>

                        <a href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                            ⬇ {{ __('Download') }}
                        </a>

                        <a target="_blank" href="{{ route('projects.contract.owner-requirements.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                            🖨 {{ __('Print') }}
                        </a>
                    </div>
                @endif








                @foreach($rows as $row)
                    @php
                        $typeId = $row['type_id'];
                        $att = $row['attachment'];
                        //dd($row);
                    @endphp
                    <div class="card mb-3 shadow-sm attachment-card contract-box">
                        <div class="attachment-item p-3">
                    
                        <span class="mb-2 fw-bold">
                                    {{ $attTypes[$typeId] ?? 'File '.$typeId }}
                                </span>

                                @if($att)
                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-outline-primary btn-sm mb-1">
                                    👁 معاينة
                                </a>

                                <a href="{{ asset($att->web_path) }}"
                                class="btn btn-success btn-sm mb-1">
                                    ⬇ تعديل
                                </a>

                                <a target="_blank"
                                href="{{ asset($att->web_path) }}"
                                class="btn btn-warning btn-sm">
                                    🖨 طباعة
                                </a>
                                @else <div>غير موجود</div>
                                @endif
                        </div>
                    </div>
                @endforeach


          


                <!--{{-- فورم الفيوا --}}
                <div class="d-flex flex-column">
                    <span class="mb-1">{{ __('Fiwa Form') }}</span>
                    <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'preview']) }}" class="btn btn-outline-primary btn-sm mb-1">
                        👁 {{ __('Preview') }}
                    </a>
                    <a href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'download']) }}" class="btn btn-success btn-sm mb-1">
                        ⬇ {{ __('Download') }}
                    </a>
                    <a target="_blank" href="{{ route('projects.contract.owner_consultant.pdf', ['id' => $model->id, 'action' => 'print']) }}" class="btn btn-warning btn-sm">
                        🖨 {{ __('Print') }}
                    </a>
                </div> -->
    @endif
       
    </div>
</div>
@endif




@if(
    auth()->user()->role_id == 3 &&
    request('type') == 'projects' &&
    request('mode') == 'tender'
)
<div style="border:2px solid #0d6efd; background:#f8fbff; padding:20px; border-radius:10px; margin-bottom:20px;">
    
    <h3 style="margin-bottom:15px; color:#0d6efd; text-align: center;">
        توضيح طريقة التسعير
    </h3>

    <ol style="line-height:1.9; padding-right:20px; font-size:17px;">
        
        <li>
            حرصًا من مكتب سافانا على التطوير المستمر وتحسين جودة خدماته، فقد تم اعتماد نظام المناقصات عبر النظام الداخلي للمكتب، وذلك بهدف تنظيم العمل وتسهيل إجراءات الاطلاع والتسعير.
        </li>

        <li>
            بعد استلام المقاول اسم المستخدم وكلمة المرور الخاصة به، يمكنه الدخول إلى صفحة المناقصة عبر النظام، حيث ستظهر له جميع مستندات المناقصة.
        </li>

        <li>
            جميع المستندات متاحة للاطلاع والتحميل فقط، باستثناء مستند الكميات، حيث يكون متاحًا للتعديل.
        </li>

        <li>
            يقوم المقاول بالدخول إلى مستند الكميات، ويكون مخولًا بإدخال الاسعار و الكميات فقط، بالإضافة إلى إمكانية إضافة الملاحظات إن وجدت.
        </li>

        <li>
            بعد الانتهاء من إدخال الأسعار والملاحظات، يقوم المقاول بحفظ الملف، وبذلك تكون عملية التسعير قد اكتملت.
        </li>

        <li> يلتزم المقاول بالاطلاع الكامل والدقيق على جميع عناصر ومستندات المناقصة.</li>

    </ol>

</div>
@endif



@php
    $canUpload = in_array(auth()->user()->role_id, [1,4,11,12,7]) 
        || auth()->id() == $model->id;
@endphp

@if(in_array(auth()->user()->role_id, [1,4,11,12,7]))
    {{-- Upload attachments --}}
    
    
    @if($canUpload)
    <form class="opacity: {{ $canUpload ? 1 : 0 }}" action="{{ route('users.attachments.store', ['id' => $model->id, 'type' => $type]) }}"
          method="POST"
          enctype="multipart/form-data">
@endif
    <!-- <form action="{{ route('users.attachments.store', ['id' => $model->id, 'type' => $type]) }}"
      method="POST"
      enctype="multipart/form-data"> -->

    

<input type="hidden" name="type" value="{{ $type }}">

        @csrf

        <!-- <div class="alert alert-info text-right">
            <strong>{{ __('Instructions') }}:</strong><br>
            - {{ __('Maximum 10 files') }}.<br>
            - {{ __('Maximum 10 MB per file') }}.<br>
            - {{ __('Allowed types') }}: PDF, JPG, PNG.<br>
            - {{ __('You can add notes for each file') }}.<br>
            - {{ __('Click the X button to remove any attachment') }}.
        </div> -->


       <div class="card mb-3 upload-card">
            <div class="card-header    d-flex justify-content-between align-items-center" style="
        background:#6F5A24;
        color:#fff;
        border-bottom:2px solid #C8B27A;">
                <span>{{ __('Upload Attachments') }}</span>
                <button style="color:#fff;" type="button"
                        id="addAttachment"
                        class="btn btn-add-file d-none">
                    <i class="fas fa-plus-circle"></i>
                    إضافة مرفق جديد
                </button>

            </div>
            
            <div class="card-body" id="attachmentContainer" style="background-color: #f5f5dc;">
                
            
                {{-- @foreach($rows as $i => $row)
                @php
                    $att = $row['attachment'];
                @endphp

                <div class="contract-box attachment-card mb-3 shadow-sm">
                    <div class="attachment-item mb-3">
                    <div class="card-body row align-items-center" style="background-color:#f5f5dc;">

                        
                        @if($att)
                            <input type="hidden" name="attachments[{{ $i }}][id]" value="{{ $att->id }}">
                        @endif

                        
                        <div class="col-md-2">
                            <select name="attachments[{{ $i }}][attachment_type_id]" class="form-control">
                                @foreach($attTypes as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ $row['type_id'] == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        
                        <div class="col-md-3">
                            <div class="border rounded p-2 small bg-light">

                                <input type="file"
                                    name="attachments[{{ $i }}][file]"
                                    class="form-control form-control-sm mb-1">
                                <input type="hidden"
                                            class="delete-flag"
                                            name="attachments[{{ $i }}][delete]"
                                            value="0">
                                @if($att)
                                    <div class="text-truncate">
                                        📄 {{ $att->file_name }}
                                    </div>

                                    @if(!empty($att->web_path))
                                        <a href="{{ asset($att->web_path) }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary w-100 mt-1">
                                            👁 View
                                        </a>

                                        
                                        <button type="button" class="btn btn-danger removeAttachment">🗑</button>
                                    @endif
                                @else
                                    <div class="text-muted">
                                        {{ __('Not uploaded yet') }}
                                    </div>
                                @endif

                            </div>
                        </div>




                        

                        
                        <div class="col-md-3">
                            <input type="date"
                                name="attachments[{{ $i }}][expiration_date]"
                                value="{{ optional($att?->expiration_date)->format('Y-m-d') }}"
                                class="form-control">
                        </div>

                        
                        <div class="col-md-3">
                            <input type="text"
                                name="attachments[{{ $i }}][notes]"
                                value="{{ $att->notes ?? '' }}"
                                placeholder="{{ __('Notes') }}"
                                class="form-control">
                        </div>

                        
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="button" class="btn btn-danger removeAttachment">X</button>
                        </div>

                    </div>
                    </div>
                </div>
                @endforeach --}}

                @foreach($rows as $i => $row)
@php
    $att = $row['attachment'];
@endphp

<div class="attachment-card">

    <div class="attachment-item p-3">

        @if($att)
            <input type="hidden"
                   name="attachments[{{ $i }}][id]"
                   value="{{ $att->id }}">
        @endif

        {{-- نوع المرفق --}}
        <div class="mb-3">
            <label class="fw-bold mb-2 d-block">
                📂 نوع المرفق
            </label>

            <select
                name="attachments[{{ $i }}][attachment_type_id]"
                class="form-control">

                @foreach($attTypes as $id => $name)
                    <option value="{{ $id }}"
                        {{ $row['type_id'] == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach

            </select>
        </div>

        {{-- الملف --}}
        <div class="attachment-box mb-3">

            <input type="hidden"
                   class="delete-flag"
                   name="attachments[{{ $i }}][delete]"
                   value="0">

            <div class="upload-icon">
                ☁️
            </div>

            @if($att)

                <div class="selected-file-name mb-2">
                    📄 {{ $att->file_name }}
                </div>

                <input type="file"
                       name="attachments[{{ $i }}][file]"
                       class="form-control attachment-input">


                       
                <div class="d-flex gap-2 mt-3">

                    <a href="{{ asset($att->web_path) }}"
                       target="_blank"
                       class="btn btn-success preview-file">
                        👁 معاينة
                    </a>

                    <button type="button"
                            class="btn btn-danger removeAttachment">
                        🗑 حذف
                    </button>

                </div>

            @else

                <div class="mb-2 text-muted">
                    اسحب الملف أو اختر ملف
                </div>

                <input type="file"
                       name="attachments[{{ $i }}][file]"
                       class="form-control attachment-input">

                <div class="selected-file-name mt-2 d-none"></div>

                <div class="d-flex gap-2 mt-3">

                    <a href="#"
                       target="_blank"
                       class="btn btn-success preview-file d-none">
                        👁 معاينة
                    </a>

                    <button type="button"
                            class="btn btn-danger removeAttachment">
                        🗑 حذف
                    </button>

                </div>

            @endif

        </div>

        {{-- تاريخ الانتهاء --}}
        <div class="mb-3">
            <label class="fw-bold mb-2 d-block">
                تاريخ الانتهاء
            </label>

            <input type="date"
                   name="attachments[{{ $i }}][expiration_date]"
                   value="{{ optional($att?->expiration_date)->format('Y-m-d') }}"
                   class="form-control">
        </div>

        {{-- الملاحظات --}}
        <div>
            <label class="fw-bold mb-2 d-block">
                الملاحظات
            </label>

            <textarea
                name="attachments[{{ $i }}][notes]"
                class="form-control"
                rows="3">{{ $att->notes ?? '' }}</textarea>
        </div>

    </div>

</div>
@endforeach

            
            
            
            
            
            
            
            
       
            </div>
        </div>

        <!-- <div class="text-center">
            <button type="submit" class="btn btn-success px-5">Save Attachments</button>
        </div> -->


        <div class="opacity: {{ $canUpload ? 1 : 0 }}  buttons_container text-center mt-4 d-flex justify-content-center gap-3">

            {{-- Save --}}
<button type="submit"
        name="action"
        value="save"
        class="btn btn-olive px-4">
    💾 {{ __('حفظ') }}
</button>

{{-- Show ONLY when type != projects --}}
@if ($type !== 'projects' && !$isAdminFiles)
    <button type="submit"
            name="action"
            value="save_create_project"
            class="btn btn-olive px-4">
        ➕ {{ __('Save & Create Project') }}
    </button>
@endif

{{-- Cancel Button --}}
<a href="{{ $type === 'projects'
            ? route('projects.index')
            : route('users.index') }}"
   class="btn btn-secondary px-4">
    ✖ {{ __('Cancel') }}
</a>



        </div>
    </form>

@endif
</div>
@endsection





@push('scripts')



<script>





document.addEventListener('click', function(e){

    if(e.target.classList.contains('removeAttachment')){

        //const card = e.target.closest('.card');
        const card = e.target.closest('.attachment-card');

        const deleteFlag = card.querySelector('.delete-flag');
        const idInput = card.querySelector('input[name*="[id]"]');

        if(idInput){

            deleteFlag.value = 1;

            card.style.opacity = "0.5";
            e.target.style.display = "none";

            const msg = document.createElement("div");
            msg.innerHTML = "File will be deleted after save";
            msg.style.color = "red";

            card.querySelector('.border').appendChild(msg);

        }else{
            card.remove();
        }

    }

});






document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.attachment-input').forEach(input => {

        input.addEventListener('change', function () {
            const file = this.files[0];
            const box = this.closest('.attachment-box');
            const fileNameEl = box.querySelector('.selected-file-name');
            const previewBtn = box.querySelector('.preview-file');
            const storedBtn = box.querySelector('.stored-file');

            if (!file) return;

            // show file name
            fileNameEl.textContent = file.name;
            fileNameEl.classList.remove('d-none');

            // hide stored file button if exists
            if (storedBtn) storedBtn.classList.add('d-none');

            // create temp url
            const fileURL = URL.createObjectURL(file);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');
        });

    });

});
</script>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.attachment-box').forEach(box => {

        const input      = box.querySelector('.attachment-input');
        const fileName   = box.querySelector('.selected-file-name');
        const previewBtn = box.querySelector('.preview-file');
        const storedBtn  = box.querySelector('.stored-file');
        const removeBtn  = box.querySelector('.remove-file');
        const deleteFlag = box.querySelector('.delete-flag');

        // when select file
        input?.addEventListener('change', function () {
            if (!this.files.length) return;

            const file = this.files[0];

            fileName.textContent = '📄 ' + file.name;
            fileName.classList.remove('d-none');

            const url = URL.createObjectURL(file);
            previewBtn.href = url;
            previewBtn.classList.remove('d-none');

            if (storedBtn) storedBtn.classList.add('d-none');
            deleteFlag.value = 0;
        });

        // remove file
        removeBtn?.addEventListener('click', function () {

            // clear input
            if (input) input.value = '';

            // hide preview + name
            previewBtn?.classList.add('d-none');
            fileName?.classList.add('d-none');

            // if there was stored file → mark delete
            if (storedBtn) {
                storedBtn.classList.add('d-none');
                deleteFlag.value = 1;
            }
        });

    });

});
</script>



<script>
let attachmentIndex =
document.querySelectorAll('#attachmentContainer .attachment-card').length; // start after default 3
const maxAttachments = 10;
const maxSizeMB = 10;

// Add remove functionality
function addRemove(button) {
    button.addEventListener('click', function() {
        button.closest('.attachment-card').remove();
        attachmentIndex--;
    });
}

// Attach remove to default 3 cards
document.querySelectorAll('.removeAttachment').forEach(btn => addRemove(btn));

// Add new attachment dynamically
document.getElementById('addAttachment').addEventListener('click', function () {
    if (attachmentIndex >= maxAttachments) { alert("{{ __('Maximum 10 files') }}"); return; }

    const card = document.createElement('div');
    card.className = 'card mb-3 shadow-sm attachment-card contract-box';
    card.querySelector('.attachment-row')?.classList.add('attachment-pending');

    /*.innerHTML = `
        <div class="card-body row">
            <div class="form-group col-md-6">
                <label>File</label>
                <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control attachment-file" required>
            </div>
            <div class="form-group col-md-5">
                <label>Notes</label>
                <input type="text" name="attachments[${attachmentIndex}][notes]" class="form-control">
            </div>
            <div class="form-group col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeAttachment">X</button>
            </div>
        </div>
    `;*/

//     card.innerHTML = `
// <div class="card-body row" style="background-color: #f5f5dc;">

//     <div class="form-group col-md-2">
//         <select name="attachments[${attachmentIndex}][attachment_type_id]" class="form-control" required>
//             <option value="">{{ __('-- Select Type --') }}</option>
//             @foreach($attTypes as $id => $name)
//                 <option value="{{ $id }}">{{ $name }}</option>
//             @endforeach
//         </select>
//     </div>

//     <div class="form-group col-md-3">

//         <div class="col-md-3">
//             <div class="border rounded p-2 small bg-light attachment-box">

//                 <input type="hidden"
//                     name="attachments[${attachmentIndex}][delete]"
//                     value="0"
//                     class="delete-flag">

//                 <input type="file"
//                     name="attachments[${attachmentIndex}][file]"
//                     class="form-control form-control-sm attachment-input mb-1">

//                 <div class="text-truncate selected-file-name d-none"></div>

//                 <a href="#"
//                     target="_blank"
//                     class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
//                     👁 Preview
//                 </a>

//                 <button type="button"
//                     class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
//                     🗑 Remove
//                 </button>

//             </div>
//         </div>

//     </div>

//     <div class="form-group col-md-3">
//         <input type="date"
//             name="attachments[${attachmentIndex}][expiration_date]"
//             class="form-control">
//     </div>

//     <div class="form-group col-md-3">
//         <input type="text"
//             name="attachments[${attachmentIndex}][notes]"
//             class="form-control"
//             placeholder="{{ __('Notes') }}">
//     </div>

//     <div class="form-group col-md-1 d-flex align-items-end">
//         <button type="button" class="btn btn-danger removeAttachment">X</button>
//     </div>
// </div>
// `;






/*card.innerHTML = `
<div class="card-body row" style="background-color: #f5f5dc;">

    <div class="form-group col-md-2">
        <select name="attachments[${attachmentIndex}][attachment_type_id]" class="form-control" required>
            <option value="">{{ __('-- Select Type --') }}</option>
            @foreach($attTypes as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <div class="border rounded p-2 small bg-light attachment-box">

            <input type="hidden"
                name="attachments[${attachmentIndex}][delete]"
                value="0"
                class="delete-flag">

            <input type="file"
                name="attachments[${attachmentIndex}][file]"
                class="form-control form-control-sm attachment-input mb-1">

            <div class="text-truncate selected-file-name d-none"></div>

            <a href="#"
                target="_blank"
                class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
                👁 Preview
            </a>

            <button type="button"
                class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
                🗑 Remove
            </button>
        </div>
    </div>

    <div class="form-group col-md-3">
        <input type="date"
            name="attachments[${attachmentIndex}][expiration_date]"
            class="form-control">
    </div>

    <div class="form-group col-md-3">
        <input type="text"
            name="attachments[${attachmentIndex}][notes]"
            class="form-control"
            placeholder="{{ __('Notes') }}">
    </div>

    <div class="form-group col-md-1 d-flex align-items-end">
        <button type="button" class="btn btn-danger removeAttachment">X</button>
    </div>

</div>
`;*/
card.innerHTML = `

<div class="attachment-item p-3">

    <div class="mb-3">
        <label class="fw-bold mb-2 d-block">
            📂 نوع المرفق
        </label>

        <select
            name="attachments[${attachmentIndex}][attachment_type_id]"
            class="form-control"
            required>
            <option value="">-- اختر النوع --</option>

            @foreach($attTypes as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <div class="attachment-box mb-3">

        <input type="hidden"
               name="attachments[${attachmentIndex}][delete]"
               value="0"
               class="delete-flag">

        <div class="upload-icon">
            ☁️
        </div>

        <div class="mb-2 text-muted">
            اسحب الملف أو اختر ملف
        </div>

        <input type="file"
               name="attachments[${attachmentIndex}][file]"
               class="form-control attachment-input">

        <div class="selected-file-name mt-2 d-none"></div>

        <div class="d-flex gap-2 mt-3">

            <a href="#"
               target="_blank"
               class="btn btn-success preview-file d-none">
                👁 معاينة
            </a>

            <button type="button"
                    class="btn btn-danger remove-file">
                🗑 حذف
            </button>

        </div>

    </div>

    <div class="mb-3">
        <label class="fw-bold mb-2 d-block">
            تاريخ الانتهاء
        </label>

        <input type="date"
               name="attachments[${attachmentIndex}][expiration_date]"
               class="form-control">
    </div>

    <div>
        <label class="fw-bold mb-2 d-block">
            الملاحظات
        </label>

        <textarea
            name="attachments[${attachmentIndex}][notes]"
            class="form-control"
            rows="3"
            placeholder="اكتب الملاحظات"></textarea>
    </div>

</div>
`;




document.getElementById('attachmentContainer').appendChild(card);
    initAttachmentBox(card);

    function initAttachmentBox(scope) {
        scope.querySelectorAll('.attachment-box').forEach(box => {

            const input      = box.querySelector('.attachment-input');
            const fileName   = box.querySelector('.selected-file-name');
            const previewBtn = box.querySelector('.preview-file');
            const removeBtn  = box.querySelector('.remove-file');
            const deleteFlag = box.querySelector('.delete-flag');

            input?.addEventListener('change', function () {
                if (!this.files.length) return;

                const file = this.files[0];
                fileName.textContent = '📄 ' + file.name;
                fileName.classList.remove('d-none');

                const url = URL.createObjectURL(file);
                previewBtn.href = url;
                previewBtn.classList.remove('d-none');

                deleteFlag.value = 0;
            });

            removeBtn?.addEventListener('click', function () {
                input.value = '';
                previewBtn.classList.add('d-none');
                fileName.classList.add('d-none');
                deleteFlag.value = 1;
            });
        });
    }

    addRemove(card.querySelector('.removeAttachment'));

    const fileInput = card.querySelector('.attachment-file');
    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        if (file.size > maxSizeMB * 1024 * 1024) {
           aalert("{{ __('File too big') }}"); this.value = '';
        }
    });

    attachmentIndex++;
});
</script>




<script>




/*document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attachment-file')) {

        const fileInput = e.target;
        const row = fileInput.closest('.attachment-row');

        const previewBtn = row.querySelector('.preview-file');
        const fileNameText = row.querySelector('.selected-file-name');

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];

            // show row as completed
            row.classList.remove('attachment-pending');
            row.classList.add('attachment-complete');

            // show file name
            fileNameText.textContent = file.name;
            fileNameText.classList.remove('d-none');

            // create preview URL
            const fileURL = URL.createObjectURL(file);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');
        } else {
            // remove highlight
            row.classList.remove('attachment-complete');
            row.classList.add('attachment-pending');

            fileNameText.classList.add('d-none');
            previewBtn.classList.add('d-none');
        }
    }
});*/






    
document.addEventListener('change', function (e) {
    if (e.target.classList.contains('attachment-file')) {
        const row = e.target.closest('.attachment-row');

        if (e.target.files.length > 0) {
            row.classList.remove('attachment-pending');
            row.classList.add('attachment-complete');
        } else {
            row.classList.remove('attachment-complete');
            row.classList.add('attachment-pending');
        }
    }
});
</script>

<script>
document.addEventListener('change', function (e) {
    if (e.target.type === 'file') {
        const fileInput = e.target;
        const row = fileInput.closest('.attachment-row');

        const previewBtn = row.querySelector('.preview-file');
        const storedBtn  = row.querySelector('.stored-file');
        if(this.files.length){

            const card = this.closest('.upload-card');

            card.classList.add('upload-ready');
        }

        if (fileInput.files.length > 0) {
            const fileURL = URL.createObjectURL(fileInput.files[0]);

            previewBtn.href = fileURL;
            previewBtn.classList.remove('d-none');

            if (storedBtn) {
                storedBtn.classList.add('d-none');
            }
        }
    }
});
</script>



@if (session('success'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    initAttachmentBox(document);

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true
    });
});
</script>
@endif



@endpush










