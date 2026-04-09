@extends('layouts.app')

@section('content')

<style>
/* ===== Group Header ===== */
.group-header {
    background: linear-gradient(90deg, #2f3a1f 0%, #3e4d2a 100%);
    color: #d4af37;
    padding: 14px 20px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
    box-shadow: 0 3px 8px rgba(0,0,0,0.08);
}

/* ===== Section Header ===== */
.section-header {
    background: #f5f5dc;
    background-color: #d4af37;
    text-align:center;
    border-right: 6px solid #d4af37;
    padding: 10px 15px;
    font-size: 15px;
    font-weight: 600;
    border-radius: 6px;
    color: #2f3a1f;
}

/* ===== Table Styling ===== */
.table {
    border-radius: 10px;
    overflow: hidden;
    background: #ffffff;
}

.table thead {
    background-color: #2f3a1f;
    color: #d4af37;
}

.table th {
    font-weight: 600;
    font-size: 14px;
}

.table td {
    vertical-align: middle;
}

.table-secondary {
    background-color: #f1f3f2 !important;
}

/* Input styling */
.form-control {
    border-radius: 6px;
    border: 1px solid #ced4da;
}

.form-control:focus {
    border-color: #d4af37;
    box-shadow: 0 0 0 0.15rem rgba(212,175,55,0.25);
}

/* Save Button */
.btn-primary {
    background-color: #2f3a1f;
    border-color: #2f3a1f;
}

.btn-primary:hover {
    background-color: #3e4d2a;
    border-color: #3e4d2a;
}
















/* ===== Floating Save Buttons ===== */

.floating-actions {
    position: fixed;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 15px;
    z-index: 9999;

    backdrop-filter: blur(15px);
    background: rgba(255,255,255,0.15);
    padding: 12px 20px;
    border-radius: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    border: 1px solid rgba(255,255,255,0.3);
}

/* زر الحفظ */
.main-save-btn {
    background: #2f3a1f;
    color: #d4af37;
    border-radius: 40px;
    font-weight: 600;
}

.main-save-btn:hover {
    background: #243016;
}

/* زر المعاينة */
.btn-preview {
    background: rgba(255,255,255,0.8);
    color: #2f3a1f;
    border-radius: 40px;
    font-weight: 600;
}

.btn-preview:hover {
    background: #ffffff;
}

























/* كارت ملخص البنود */
.summary-card{

position:fixed;
top:120px;
right:20px;

width:320px;

background:white;

border-radius:15px;

box-shadow:0 15px 40px rgba(0,0,0,0.2);

z-index:9999;

overflow:hidden;

}

.summary-header{

background:#212529;
color:white;

padding:10px 15px;

display:flex;

justify-content:space-between;

align-items:center;

cursor:move;

font-weight:bold;

}

.summary-buttons button{

border:none;

background:white;

color:black;

width:28px;

height:28px;

border-radius:6px;

margin-left:5px;

cursor:pointer;

}

.summary-body{

padding:10px;

max-height:400px;

overflow:auto;

}

.summary-card table td,
.summary-card table th{

font-size:13px;

padding:6px;

}

.summary-collapsed .summary-body{

display:none;

}

.summary-hidden{

width:120px;

}

.summary-hidden .summary-body{

display:none;

}

.summary-hidden .summary-header{

justify-content:center;

}
body{

/* padding-right:350px; */

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
















/* CARD STYLE */

.design-card{
    background:#fff;
    border:1px solid #e6e6e6;
    border-radius:14px;
    padding:18px 20px;
    box-shadow:0 4px 14px rgba(0,0,0,0.06);
    transition:0.25s;
    height:100%;
}

.design-card:hover{
    transform:translateY(-3px);
    box-shadow:0 10px 24px rgba(0,0,0,0.12);
}


/* TITLE */

.design-title{
    font-size:17px;
    font-weight:700;
    color:#2f3a1f;
    margin-bottom:12px;
    display:block;
    border-bottom:1px solid #eee;
    padding-bottom:6px;
}


/* OPTION */

.design-option{
    margin-bottom:8px;
}


/* TEXT */

.design-label{
    font-size:15px;
    font-weight:600;
    margin-right:6px;
}


/* RADIO STYLE */

.design-radio{
    border:2px solid #000 !important;
    width:18px;
    height:18px;
}

.design-radio:checked{
    background-color:#2f3a1f;
    border-color:#2f3a1f;
}


.row{
    row-gap:20px;
}



.supply-price{
    color: red;
    font-weight: bold;
}

.owner-title{
    text-align:center;
    font-size:30px;
    font-weight:700;
    margin:25px 0 30px 0;
    color:#2f3a1f;
}

.owner-title i{
    color:#d4af37;
}

</style>


@php
    $isOwner   = $context === 'owner';
    $isPricing = $context === 'pricing';
    $isTender  = $context === 'tender';
@endphp

<div class="card shadow-sm rounded-4"
     style="background-color:#f5f5dc;margin:40px;padding:0px;">

@php
    $contractor = \App\Models\User::find(request('contractor'));
@endphp
@if($contractor)
<div class="owner-title">
    <!-- <i class="fas fa-user-tie me-2"></i> -->
    👷 المقاول:  {{ $contractor->name ?? '—' }}
</div>
@endif

@include('projects.partials.project-actions', ['project' => $project])
    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.2rem;font-weight:600;">

        <div>
            <h4 class="mb-0">
                @if($isTender)
                    حساب الكميات
                @elseif($isPricing)
                    أسعار توريد التشطيبات
                @else
                    متطلبات المالك
                @endif

            </h4>

            <small>
                المشروع: <strong>{{ $project->projectName?->name_ar }}</strong> |
                المالك: <strong>{{ $project->ownerUser?->name ?? '—' }}</strong> |
                رقم القسيمة: <strong>{{ $project->qasmia_number ?? '—' }}</strong> |
                المنطقة: <strong>{{ $project->projectRegion?->name_ar ?? '—' }}</strong>
                
            </small>
        </div>

        
        <div class=" d-flex justify-content-between align-items-center gap-2">
            @if (in_array(auth()->user()->role_id, [1,4,11,12]))
            <a href="{{ route('projects.tender.contractors', $project->id) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
                    <i class="fas fa-users"></i> المقاولين المرشحين
            </a>

            <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'pricing']) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
                    <i class="fas fa-file-signature"></i> أسعار توريد التشطيبات
            </a>


            {{-- <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'tender']) }}"
                class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
                    <i class="fas fa-file-signature"></i> حساب الكميات
            </a> --}}

           
            
            @endif
            <div class="d-flex gap-2">
                <a  href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}"
                class="btn btn-olive px-4 btn-sm" style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
                    <i class="fas fa-arrow-left" ></i> {{ __('  المناقصة') }}
                </a>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('projects.index') }}"
                class="btn btn-olive px-4 btn-sm" style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
                    <i class="fas fa-arrow-left" ></i> {{ __('  المشاريع') }}
                </a>
            </div>
            
        </div>
        

    </div>

    {{-- Content --}}
    <div class="p-4" style="background:#f5f5dc;">



@if($isOwner)  
        <form method="POST"
              action="{{ route('projects.owner-requirements.store',$project) }}">
            @csrf



         
            <div class="row">

    {{-- Ground Floor --}}
    <div class="col-lg-6 col-md-12 mb-4">
        <h5 class="mb-3 fw-bold text-center">
            الدور الأرضي
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center"
                   style="background:#f5f5dc;border:1px solid #D4AF37;">
                <thead>
                    <tr>
                        <th>الاحتياجات</th>
                        <th>اختيار</th>
                        <th style="width:120px;">العدد</th>
                        <th style="width:120px;">ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requirements['ground'] ?? [] as $req)
                    <tr>
                        <td>{{ $req->name }}</td>
                        <td>
                            <input type="checkbox"
                                   class="form-check-input"
                                   {{ isset($selected[$req->id]) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="number"
                                min="1"
                                class="form-control text-center"
                                name="requirements[{{ $req->id }}][quantity]"
                                value="{{ $selected[$req->id]->pivot->quantity ?? '' }}">
                        </td>

                        <td>
                            <input type="text"
                                class="form-control text-center"
                                name="requirements[{{ $req->id }}][notes]"
                                value="{{ $selected[$req->id]->pivot->notes ?? '' }}">
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- First Floor --}}
    <div class="col-lg-6 col-md-12 mb-4">
        <h5 class="mb-3 fw-bold text-center">
            الدور الأول
        </h5>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center"
                   style="background:#f5f5dc;border:1px solid #D4AF37;">
                <thead>
                    <tr>
                        <th>الاحتياجات</th>
                        <th>اختيار</th>
                        <th style="width:120px;">العدد</th>
                        <th style="width:120px;">ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($requirements['first'] ?? [] as $req)
                    <tr>
                        <td>{{ $req->name }}</td>
                        <td>
                            <input type="checkbox"
                                   class="form-check-input"
                                   {{ isset($selected[$req->id]) ? 'checked' : '' }}>
                        </td>
                        <td>
                            <input type="number"
                                min="1"
                                class="form-control text-center"
                                name="requirements[{{ $req->id }}][quantity]"
                                value="{{ $selected[$req->id]->pivot->quantity ?? '' }}">
                        </td>

                        <td>
                            <input type="text"
                                class="form-control text-center"
                                name="requirements[{{ $req->id }}][notes]"
                                value="{{ $selected[$req->id]->pivot->notes ?? '' }}">
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>






<hr class="my-4">
<h5 class="fw-bold text-center mb-4 bg-white rounded-3xl p-3">افكار الاستشاري  </h5>

<div class="row">

{{-- تصميم الفيلا --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">تصميم الفيلا</label>
    @foreach(['مودرن','كلاسيك','نيو كلاسيك'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[villa_style]" value="{{ $opt }}"  {{ ($design?->villa_style == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- عدد درجات البناء --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">عدد درجات البناء</label>
    @foreach(['3','5'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[floors_count]" value="{{ $opt }}" {{ ($design?->floors_count == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- باب الفيلا --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">باب الفيلا</label>
    @foreach(['مرتفع','عادي'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[villa_door]" value="{{ $opt }}" {{ ($design?->villa_door == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- موقع الفيلا --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">موقع الفيلا</label>
    @foreach(['ورا','النص','قدام'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[villa_location]" value="{{ $opt }}" {{ ($design?->villa_location == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- دابل هايت --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">دابل هايت</label>
    @foreach(['نعم','لا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[double_height]" value="{{ $opt=='نعم' ? 1 : 0 }}" {{ ($design?->double_height == ($opt == 'نعم')) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- صالات مفتوحة --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">صالات مفتوحة</label>
    @foreach(['نعم','لا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[open_living]" value="{{ $opt == 'نعم' ? 1 : 0 }}" {{ ($design?->open_living == ($opt == 'نعم')) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- فيلا --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">فيلا</label>
    @foreach(['متصل مع الملحق','غير متصل'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[villa_connection]" value="{{ $opt }}" {{ ($design?->villa_connection == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- ارتفاع السقف --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">ارتفاع السقف</label>
    @foreach(['3.5','4','4.5'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[ceiling_height]" value="{{ $opt }}" {{ ($design?->ceiling_height == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- اطلالات داخلية علي الحديقة --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">اطلالات داخلية علي الحديقة</label>
    @foreach(['نعم','لا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[internal_garden_view]" value="{{ $opt=='نعم' ? 1 : 0 }}" {{ ($design?->internal_garden_view == ($opt == 'نعم')) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- الدرج --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">الدرج</label>
    @foreach(['مقابل','علي جنب','مخفي'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[stairs_location]" value="{{ $opt }}" {{ ($design?->stairs_location == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- بانتي --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">بانتري</label>
    @foreach(['مع الطعام','في الصالة'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[pantry_location]" value="{{ $opt }}" {{ ($design?->pantry_location == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- أبواب الخدمات --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">أبواب الخدمات</label>
    @foreach(['خارجية','داخلية'] as $opt)
        <div class="form-check"> 
            <input class="form-check-input" required type="radio" name="design[service_doors]" value="{{ $opt }}" {{ ($design?->service_doors == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- مصعد مستقبلي --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">مصعد مستقبلي</label>
    @foreach(['نعم','لا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[future_elevator]" value="{{ $opt=='نعم' ? 1 : 0 }}" {{ ($design?->future_elevator == ($opt == 'نعم')) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- فناء داخل البيت --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">فناء داخل البيت</label>
    @foreach(['نعم','لا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[internal_courtyard]" value="{{ $opt=='نعم' ? 1 : 0 }}" {{ ($design?->internal_courtyard == ($opt == 'نعم')) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- شكل الفيلا --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">شكل الفيلا</label>
    @foreach(['U','L'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[villa_shape]" value="{{ $opt }}" {{ ($design?->villa_shape == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- طعام تخدم --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">طعام تخدم</label>
    @foreach(['الصالة + المجلس معا','الصالة و طعام المجلس'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[dining_serves]" value="{{ $opt }}" {{ ($design?->dining_serves == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- درج --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">درج</label>
    @foreach(['منشار','عادي'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[stairs_type]" value="{{ $opt }}" {{ ($design?->stairs_type == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- التكيف --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">التكيف</label>
    @foreach(['مركزي','سبلت'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[ac_type]" value="{{ $opt }}" {{ ($design?->ac_type == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- الأبواب --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">الأبواب</label>
    @foreach(['مرتفعة لسقف','عادية'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[doors_height]" value="{{ $opt }}" {{ ($design?->doors_height == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- نوعية الاطقم --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">نوعية الاطقم</label>
    @foreach(['وسط','ممتاز','ممتاز جدا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[furniture_level]" value="{{ $opt }}" {{ ($design?->furniture_level == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- كراس حمامات --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">كراس حمامات</label>
    @foreach(['معلقة','عادية'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[bathroom_chairs]" value="{{ $opt }}" {{ ($design?->bathroom_chairs == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- خزان تحت الأرض --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">خزان تحت الأرض</label>
    @foreach(['نعم','لا'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[underground_tank]" value="{{ $opt=='نعم' ? 1 : 0 }}" {{ ($design?->underground_tank == ($opt == 'نعم')) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

{{-- نعلة --}}
<div class="col-md-2 mb-4">
    <label class="fw-bold d-block mb-2">نعلة</label>
    @foreach(['مخفية','عادية','مخفية مع سندل'] as $opt)
        <div class="form-check">
            <input class="form-check-input" required type="radio" name="design[insulation]" value="{{ $opt }}" {{ ($design?->insulation == $opt) ? 'checked' : '' }}>
            <label class="form-check-label">{{ $opt }}</label>
        </div>
    @endforeach
</div>

</div>

















            {{-- Actions --}}
            <!-- <div class="text-center">
                <button class="btn btn-olive px-4" style="background:#2f3a1f;color:#d4af37;">
                    <i class="fas fa-save" ></i> حفظ المتطلبات
                </button>
            </div> -->

            <input type="hidden" name="context" value="{{ $context }}">



            <div class="text-center d-flex justify-content-center gap-2">

                {{-- Save --}}
                <button type="submit"
                        class="btn btn-olive px-4"
                        style="background:#2f3a1f;color:#d4af37;">
                    <i class="fas fa-save"></i> حفظ المتطلبات
                </button>

                {{-- Preview --}}
                <a target="_blank"
                href="{{ url('projects/'.$project->id.'/contract-owner-requirements?action=preview') }}"
                class="btn btn-outline-primary px-4">
                    👁  معاينة المتطلبات
                </a>

            </div>



        </form>






@endif










@if($context === 'tender')

<!-- <h5 class="text-center fw-bold mb-3">حساب الكميات  </h5> -->

<form action="{{ route('projects.owner-requirements.saveTender', $project->id) }}" method="POST">

    @csrf
@php
$sectionLetterIndex = 0;
$groupIndex=0;

@endphp
    @foreach($groups as $group)
        <div class="group-header mt-5 text-center">
            <span style="font-weight: 700;font-size:1.6rem;">{{ $group->name_ar }}</span>
        </div>

        @php
            $groupIndex++;
            $sectionIndex=0;
        @endphp
        @foreach($group->children as $section)
            <div  class="section-header w-[100%] mt-4">
                <span style="font-weight: 700;font-size:1.4rem;">{{ $section->name_ar }}</span>
            </div>

            {{-- @php
                $colors = ['#EFEFEF','#FFF3E0','#E0F7FA','#F3E5F5']; 
                $color = $colors[$loop->index % count($colors)];
                $sectionIndex++;
            @endphp
            <div style="background-color:{{ $color }}; padding:8px; font-weight:bold; text-align:center;" class="section-header w-[100%] mt-4">
                <span>{{ $section->name_ar }}</span>
            </div> --}}


            <table class="table table-bordered text-center section-table"
                    data-section-id="{{ $section->id }}">

                <thead>
                    <tr>
                        <th style="font-weight: 700;font-size:1.2rem;">{{ chr(65 + $sectionLetterIndex++) }}</th>
                        <th style="font-weight: 700;font-size:1.2rem;">البند</th>
                        <th style="font-weight: 700;font-size:1.2rem;">الوحدة</th>
                        <th style="font-weight: 700;font-size:1.2rem;">الكمية</th>
                        <th style="font-weight: 700;font-size:1.2rem;">سعر الوحدة</th>
                        <th style="font-weight: 700;font-size:1.2rem;">الإجمالي</th>
                        <th style="font-weight: 700;font-size:1.2rem;">ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $sectionTotal = 0;
                        $sectionIndex++;
                    @endphp
                    @foreach($section->children as $item)
                        @php
                            $pivot = optional($item->projectOwnerRequirements->first());
                            $qty = $pivot->quantity;
                            $price = $pivot->unit_price;
                            $total = $qty * $price;
                            //if($loop->iteration==1)dd()
                            $sectionTotal += $total;
                        @endphp
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- الرقم -->
                            <td style="font-weight: 700;font-size:1.1rem; text-align: start;">{{ $item->name_ar }}</td>
                            
                            <td>{{ $item->unit }}</td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][quantity]" value="{{ $qty }}"  class="form-control qty" />
                            </td>

                            <td>
                            <input 
                                type="number"
                                name="requirements[{{ $item->id }}][unit_price]"
                                value="{{ $price }}"
                                step="1"
                                class="form-control price {{ $group->slug == 'supply-finishings' ? 'supply-price' : '' }}"
                                {{ $group->slug == 'supply-finishings' ? 'readonly' : '' }}
                            />
                            </td>
                            {{-- <td>
                                <input type="number" name="requirements[{{ $item->id }}][unit_price]" value="{{ $price }}" step="1" class="form-control price" />
                            </td> --}}
                            <td class="total">{{ number_format($total, 2) }}</td>
                            <td>
                                <input type="text" name="requirements[{{ $item->id }}][notes]" value="{{ $pivot->notes ?? '' }}" class="form-control" />
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-secondary fw-bold">
                        <td style="font-weight: 700;font-size:1.2rem;" colspan="4">مجموع {{ $section->name_ar }}</td>
                        <td style="font-weight: 700;font-size:1.2rem;" colspan="2" class="section-total">{{ number_format($sectionTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach



        <table class="table table-bordered text-center">
            <tr class="table-warning fw-bold group-total-row">
                <td style="font-weight: 700;font-size:1.2rem;" colspan="4">
                    إجمالي {{ $group->name_ar }}
                </td>
                <td style="font-weight: 700;font-size:1.2rem;" colspan="2" class="group-total-value">
                    0.00
                </td>
            </tr>
        </table>


        <!-- <tr class="table-warning fw-bold group-total-row">
            <td colspan="4">
                إجمالي {{ $group->name_ar }}
            </td>
            <td class="group-total-value">
                0.00
            </td>
            <td></td>
        </tr> -->

    @endforeach




<input type="hidden" name="contractor" value="{{ $contractor->id }}">




<hr class="my-5">

<h4 class="text-center fw-bold mb-4">ملخص أسعار المشروع</h4>

<table class="table table-bordered text-center">



    <tr class="table-dark">
        <th style="width:60% font-weight: 700;font-size:1.4rem;" >البند</th>
        <th style="width:40% font-weight: 700;font-size:1.4rem;">القيمة</th>
    </tr>

    @foreach($groups as $gIndex => $group)
        <tr class="table-secondary fw-bold">
            <td colspan="2" style="font-weight: 700;font-size:1.4rem;">
                {{ $group->name_ar }}
            </td>
        </tr>

        @foreach($group->children as $section)
            <tr>
                <td class="ps-4" style="font-weight: 700;font-size:1.4rem;">
                    {{ $section->name_ar }}
                </td>
                <td id="section-summary-{{ $section->id }}" style="font-weight: 700;font-size:1.4rem;">
                    0.00
                </td>
            </tr>
        @endforeach



        <tr class="fw-bold bg-light">
            <td style="font-weight: 700;font-size:1.4rem;">
                إجمالي {{ $group->name_ar }}
            </td>
            <td id="group-summary-{{ $gIndex }}" style="font-weight: 700;font-size:1.4rem;">
                0.00
            </td>
        </tr>


        

    @endforeach

    <tr class="table-success fw-bold">
        <td style="font-weight: 700;font-size:1.4rem;">
            اجمالى سعر المشروع بدون ضريبة <br>
            Total Project value without VAT
        </td>
        <td id="grandTotalWithoutVatDetailed" style="font-weight: 700;font-size:1.4rem;">
            0.00
        </td>
    </tr>

</table>




<div class="summary-card" id="summaryCard">

<div class="summary-header" id="summaryHeader">

ملخص البنود

<div class="summary-buttons">

<button type="button" id="toggleSummary">−</button>

<button type="button" id="hideSummary">×</button>

</div>

</div>

<div class="summary-body">

<table class="table table-bordered text-center">

<tr class="table-dark">
<th colspan="2">البند</th>
<th>القيمة</th>
</tr>

<tr>
<td colspan="2">سعر الهيكل مع الكتروميكانيكال</td>
<td id="structureElectroCard">0.00</td>
</tr>

<tr>
<td colspan="2">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</td>
<td id="structureWithFinishesCard">0.00</td>
</tr>

<tr>
<td colspan="2">سعر الفوت بدون تشطيبات</td>
<td id="footWithoutCard">0.00</td>
</tr>

<tr>
<td colspan="2">سعر الفوت مع تشطيبات</td>
<td id="footWithCard">0.00</td>
</tr>

<tr>
<td colspan="2">سعر السور</td>
<td id="boundaryWallCard">0.00</td>
</tr>

<tr>
<td colspan="2">سعر الفيلا مع السور مع الواجهات </td>
<td id="villaWithWallCard">0.00</td>
</tr>

<tr>
<td colspan="2">الضريبة 5%</td>
<td id="vatCard">0.00</td>
</tr>

<tr class="table-success fw-bold">
<td colspan="2">السعر النهائي شامل الضريبة</td>
<td id="finalTotalCard">0.00</td>
</tr>

</table>

</div>

</div>




    <hr class="my-5">

<h4 class="text-center fw-bold mb-4" style="font-weight: 700;font-size:1.4rem;">ملخص البنود</h4>

<table class="table table-bordered text-center" id="summaryTable">

<tr class="table-dark">
    <th colspan="2" style="font-weight: 700;font-size:1.4rem;">البند</th>
    <th style="font-weight: 700;font-size:1.4rem;">القيمة</th>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">سعر الهيكل مع الكتروميكانيكال</td>
    <td id="structureElectro" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</td>
    <td id="structureWithFinishes" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">سعر الفوت بدون تشطيبات</td>
    <td id="footWithout" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">سعر الفوت مع تشطيبات</td>
    <td id="footWith" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">سعر السور</td>
    <td id="boundaryWall" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">سعر الفيلا مع السور مع الواجهات </td>
    <td id="villaWithWall" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr>
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">الضريبة 5%</td>
    <td id="vat" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

<tr class="table-success fw-bold">
    <td colspan="2" style="font-weight: 700;font-size:1.4rem;">السعر النهائي شامل الضريبة</td>
    <td id="finalTotal" style="font-weight: 700;font-size:1.4rem;">0.00</td>
</tr>

</table>







<!-- Hidden inputs موجودة مع الفورم الرئيسي -->
<input type="hidden" name="structureElectro" id="hiddenStructureElectro" value="0.00">
<input type="hidden" name="structureWithFinishes" id="hiddenStructureWithFinishes" value="0.00">
<input type="hidden" name="footWithout" id="hiddenFootWithout" value="0.00">
<input type="hidden" name="footWith" id="hiddenFootWith" value="0.00">
<input type="hidden" name="boundaryWall" id="hiddenBoundaryWall" value="0.00">
<input type="hidden" name="villaWithWall" id="hiddenVillaWithWall" value="0.00">
<input type="hidden" name="vat" id="hiddenVat" value="0.00">
<input type="hidden" name="finalTotal" id="hiddenFinalTotal" value="0.00">
<input type="hidden" name="context" value="{{ $context }}">






<div class="floating-actions">

    <button type="submit"
            class="btn btn-olive px-4 main-save-btn">
        <i class="fas fa-save"></i> حفظ حساب الكميات 
    </button>

    <a target="_blank"
        href="{{ route('projects.contract.tender.pdf', [
                $project->id,
                'action' => 'preview',
                'contractor' => request('contractor')
        ]) }}"
        class="btn btn-preview px-4">
            👁 معاينة حساب الكميات
    </a>

    {{-- <a target="_blank"
        href="{{ route('projects.contract.tender.pdf', $project->id) }}?action=preview"
        class="btn btn-preview px-4">
        👁 معاينة حساب الكميات
    </a> --}}

</div>
    <!-- <div class="text-center d-flex my-4 justify-content-center gap-2">

        {{-- Save --}}
        <button type="submit"
                class="btn btn-olive px-4 "
                style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-save"></i> حفظ حساب الكميات 
        </button>


        <a target="_blank"
            href="{{ route('projects.contract.tender.pdf', $project->id) }}?action=preview"
            class="btn btn-outline-success px-4">
                  👁 معاينة حساب الكميات   
        </a>


    </div> -->

    <!-- <button type="submit" class="btn btn-primary mt-3">حفظ</button> -->
</form>

<!-- <script>
document.querySelectorAll('table').forEach(table => {
    table.addEventListener('input', e => {
        if(e.target.classList.contains('qty') || e.target.classList.contains('price')) {
            let tr = e.target.closest('tr');
            let qty = parseFloat(tr.querySelector('.qty').value) || 0;
            let price = parseFloat(tr.querySelector('.price').value) || 0;
            let total = qty * price;
            tr.querySelector('.total').textContent = total.toLocaleString(undefined, {minimumFractionDigits: 2});
            
            // تحديث إجمالي القسم
            let sectionTotal = 0;
            table.querySelectorAll('tbody tr').forEach(r => {
                let t = parseFloat(r.querySelector('.total')?.textContent.replace(/,/g, '')) || 0;
                sectionTotal += t;
            });
            table.querySelector('.section-total').textContent = sectionTotal.toLocaleString(undefined, {minimumFractionDigits: 2});
        }
    });
});
</script> -->


<script>

const card = document.getElementById("summaryCard");
const header = document.getElementById("summaryHeader");

const toggleBtn = document.getElementById("toggleSummary");
const hideBtn = document.getElementById("hideSummary");


// collapse
toggleBtn.onclick = function(){

card.classList.toggle("summary-collapsed");

};


// hide
hideBtn.onclick = function(){

card.style.display="none";

};


// drag
let isDragging = false;
let offsetX, offsetY;

header.addEventListener("mousedown",function(e){

isDragging = true;

offsetX = e.clientX - card.offsetLeft;
offsetY = e.clientY - card.offsetTop;

});


document.addEventListener("mousemove",function(e){

if(!isDragging) return;

card.style.left = (e.clientX - offsetX) + "px";
card.style.top = (e.clientY - offsetY) + "px";

});


document.addEventListener("mouseup",function(){

isDragging = false;

});

</script>



<script>

function calculateAll() {

    let approvedArea = {{ $project->approved_area ?? 0 }};
    let grandTotalWithoutVat = 0;
    let groupsTotals = [];

    document.querySelectorAll('.group-header').forEach((groupHeader, gIndex) => {

        let groupTotal = 0;
        let next = groupHeader.nextElementSibling;

        while(next && !next.classList.contains('group-header')) {

            if(next.classList.contains('section-header')) {

                let table = next.nextElementSibling;

                if(table && table.classList.contains('section-table')) {

                    let sectionTotal = 0;

                    //table.querySelectorAll('.total').forEach(cell => {
                    //    sectionTotal += parseFloat(cell.textContent.replace(/,/g,'')) || 0;
                    //});
                    table.querySelectorAll('tbody tr').forEach(row => {

                        let qtyInput = row.querySelector('.qty');
                        let priceInput = row.querySelector('.price');

                        if(qtyInput && priceInput){
                            let qty = parseFloat(qtyInput.value) || 0;
                            let price = parseFloat(priceInput.value) || 0;
                            sectionTotal += qty * price;
                        }

                    });


                    let sectionId = table.dataset.sectionId;

                    let sectionCell = document.getElementById('section-summary-' + sectionId);
                    if(sectionCell){
                        sectionCell.textContent =
                            sectionTotal.toLocaleString(undefined,{minimumFractionDigits:2});
                    }

                    groupTotal += sectionTotal;
                }
            }

            next = next.nextElementSibling;
        }

        groupsTotals.push(groupTotal);
        grandTotalWithoutVat += groupTotal;

       let groupTotalRow = groupHeader
            .closest('form')
            .querySelectorAll('.group-total-row .group-total-value')[gIndex];


        if(groupTotalRow){
            groupTotalRow.textContent =
                groupTotal.toLocaleString(undefined,{minimumFractionDigits:2});
        }



        let groupCell = document.getElementById('group-summary-' + gIndex);
        if(groupCell){
            groupCell.textContent =
                groupTotal.toLocaleString(undefined,{minimumFractionDigits:2});
        }

    });

    document.getElementById('grandTotalWithoutVatDetailed').textContent =
        grandTotalWithoutVat.toLocaleString(undefined,{minimumFractionDigits:2});

    /* ===== باقي الحسابات ===== */

    let structureElectro = (groupsTotals[0] || 0) + (groupsTotals[1] || 0);
    let structureWithFinishes = structureElectro + (groupsTotals[2] || 0);
    let boundaryWall = groupsTotals[groupsTotals.length - 1] || 0;
    let villaWithWall = structureWithFinishes + boundaryWall + groupsTotals[3];
    let vat = villaWithWall * 0.05;
    let finalTotal = villaWithWall + vat;

    let footWithout = approvedArea > 0 ? structureElectro / approvedArea : 0;
    let footWith    = approvedArea > 0 ? structureWithFinishes / approvedArea : 0;

    document.getElementById('structureElectro').textContent =
        structureElectro.toLocaleString(undefined,{minimumFractionDigits:2});
document.getElementById('structureElectroCard').textContent =
        structureElectro.toLocaleString(undefined,{minimumFractionDigits:2});
        
    document.getElementById('structureWithFinishes').textContent =
        structureWithFinishes.toLocaleString(undefined,{minimumFractionDigits:2});

document.getElementById('structureWithFinishesCard').textContent =
        structureWithFinishes.toLocaleString(undefined,{minimumFractionDigits:2});


    document.getElementById('footWithout').textContent =
        footWithout.toLocaleString(undefined,{minimumFractionDigits:2});

document.getElementById('footWithoutCard').textContent =
        footWithout.toLocaleString(undefined,{minimumFractionDigits:2});

    document.getElementById('footWith').textContent =
        footWith.toLocaleString(undefined,{minimumFractionDigits:2});

document.getElementById('footWithCard').textContent =
        footWith.toLocaleString(undefined,{minimumFractionDigits:2});

    document.getElementById('boundaryWall').textContent =
        boundaryWall.toLocaleString(undefined,{minimumFractionDigits:2});

document.getElementById('boundaryWallCard').textContent =
        boundaryWall.toLocaleString(undefined,{minimumFractionDigits:2});

    document.getElementById('villaWithWall').textContent =
        villaWithWall.toLocaleString(undefined,{minimumFractionDigits:2});

document.getElementById('villaWithWallCard').textContent =
        villaWithWall.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('vat').textContent =
        vat.toLocaleString(undefined,{minimumFractionDigits:2});

document.getElementById('vatCard').textContent =
        vat.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('finalTotal').textContent =
        finalTotal.toLocaleString(undefined,{minimumFractionDigits:2});
document.getElementById('finalTotalCard').textContent =
        finalTotal.toLocaleString(undefined,{minimumFractionDigits:2});
}


document.addEventListener('input', function(e) {

    if(e.target.classList.contains('qty') || e.target.classList.contains('price')) {

        let tr = e.target.closest('tr');
        let qty = parseFloat(tr.querySelector('.qty').value) || 0;
        let price = parseFloat(tr.querySelector('.price').value) || 0;
        let total = qty * price;

        tr.querySelector('.total').textContent =
            total.toLocaleString(undefined,{minimumFractionDigits:2});

        let table = tr.closest('.section-table');
        let sectionTotal = 0;

        table.querySelectorAll('.total').forEach(cell => {
            sectionTotal += parseFloat(cell.textContent.replace(/,/g,'')) || 0;
        });

        table.querySelector('.section-total').textContent =
            sectionTotal.toLocaleString(undefined,{minimumFractionDigits:2});

        calculateAll();
    }

});

calculateAll();



function prepareHiddenInputs() {
    document.getElementById('hiddenStructureElectro').value =
        document.getElementById('structureElectro').textContent.replace(/,/g,'');
    document.getElementById('hiddenStructureWithFinishes').value =
        document.getElementById('structureWithFinishes').textContent.replace(/,/g,'');
    document.getElementById('hiddenFootWithout').value =
        document.getElementById('footWithout').textContent.replace(/,/g,'');
    document.getElementById('hiddenFootWith').value =
        document.getElementById('footWith').textContent.replace(/,/g,'');
    document.getElementById('hiddenBoundaryWall').value =
        document.getElementById('boundaryWall').textContent.replace(/,/g,'');
    document.getElementById('hiddenVillaWithWall').value =
        document.getElementById('villaWithWall').textContent.replace(/,/g,'');
    document.getElementById('hiddenVat').value =
        document.getElementById('vat').textContent.replace(/,/g,'');
    document.getElementById('hiddenFinalTotal').value =
        document.getElementById('finalTotal').textContent.replace(/,/g,'');
}


document.querySelector('.main-save-btn').addEventListener('click', function(e){
    prepareHiddenInputs();
});

</script>


<style>
    /* كل section-table */
.section-table {
    table-layout: fixed; /* هذا يفرض توزيع الأعمدة حسب العرض المحدد */
    width: 100%;
}

/* تحديد عرض كل عمود */
.section-table th, .section-table td {
    white-space: nowrap;          /* لا يلتف النص */
    overflow: hidden;             /* يخفي النص الزائد */
    text-overflow: ellipsis;      /* يظهر ... للنص الطويل */
    text-align: center;
}

/* عرض مخصص لكل عمود */
.section-table th:nth-child(1),
.section-table td:nth-child(1) { width: 4%; }   /* البند */
.section-table th:nth-child(2),
.section-table td:nth-child(2) { width: 30%; }   /* البند */
.section-table th:nth-child(3),
.section-table td:nth-child(3) { width: 10%; }   /* الوحدة */
.section-table th:nth-child(4),
.section-table td:nth-child(4) { width: 14%; }   /* الكمية */
.section-table th:nth-child(5),
.section-table td:nth-child(5) { width: 14%; }   /* سعر الوحدة */
.section-table th:nth-child(6),
.section-table td:nth-child(6) { width: 14%; }   /* الإجمالي */
.section-table th:nth-child(7),
.section-table td:nth-child(7) { width: 14%; }   /* ملاحظات */
</style>

@endif










@if($context === 'pricing')

<h5 class="text-center fw-bold mb-3">أسعار توريد التشطيبات</h5>

<form action="{{ route('projects.owner-requirements.savePricing', $project->id) }}" method="POST">
    @csrf

    <!-- @foreach($groups as $group)

    <div class="mt-5">
        <h3 class="fw-bold text-primary border-bottom pb-2">
            {{ $group->name_ar }}
        </h3>
    </div>

    @foreach($group->children as $section)

        <div class="mt-4">
            <h5 class="fw-bold text-dark">
                {{ $section->name_ar }}
            </h5>
        </div>

        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>البند</th>
                    <th>الوحدة</th>
                    <th>الكمية</th>
                    <th>سعر الوحدة</th>
                    <th>الإجمالي</th>
                    <th>ملاحظات</th>
                </tr>
            </thead>
            <tbody>

                @php $sectionTotal = 0; @endphp

                @foreach($section->children as $item)

                    @php
                        $pivot = optional(
                            $item->projectOwnerRequirements
                                ->where('pivot.context','tender')
                                ->first()
                        );

                        $qty = $pivot->quantity ?? 0;
                        $price = $pivot->unit_price ?? 0;
                        $total = $qty * $price;
                        $sectionTotal += $total;
                    @endphp

                    <tr>
                        <td class="text-start">{{ $item->name_ar }}</td>
                        <td>{{ $item->unit }}</td>

                        <td>
                            <input type="number"
                                   name="requirements[{{ $item->id }}][quantity]"
                                   value="{{ $qty }}"
                                   class="form-control qty">
                        </td>

                        <td>
                            <input type="number"
                                   name="requirements[{{ $item->id }}][unit_price]"
                                   value="{{ $price }}"
                                   step="0.01"
                                   class="form-control price">
                        </td>

                        <td class="total">
                            {{ number_format($total,2) }}
                        </td>

                        <td>
                            <input type="text"
                                   name="requirements[{{ $item->id }}][notes]"
                                   value="{{ $pivot->notes ?? '' }}"
                                   class="form-control">
                        </td>
                    </tr>

                @endforeach

                <tr class="table-secondary fw-bold">
                    <td colspan="4">
                        مجموع {{ $section->name_ar }}
                    </td>
                    <td colspan="2" class="section-total">
                        {{ number_format($sectionTotal,2) }}
                    </td>
                </tr>

            </tbody>
        </table>

    @endforeach

@endforeach -->



@php
    $contractor1 = \App\Models\User::find(request('contractor'));
@endphp


@foreach($groups as $group)
        {{-- <div class="group-header mt-5 text-center">
            <span>{{ $group->name_ar }}</span>
        </div> --}}


        @foreach($group->children as $section)
            <div class="section-header w-[100%] mt-4" style="font-weight: 700;">
                <span style="font-weight: 700;font-size:1.4rem;">{{ $section->name_ar }}</span>
            </div>


            <table class="table table-bordered text-center section-table"
                    data-section-id="{{ $section->id }}">

                <thead>
                    <tr>
                        <th style="font-weight: 700;font-size:1.3rem;">{{ chr(64 + $loop->iteration) }}</th>
                       
                        <th style="font-weight: 700;font-size:1.3rem;">البند</th>
                        <th style="font-weight: 700;font-size:1.3rem;">الوحدة</th>
                        <th style="font-weight: 700;font-size:1.3rem;">الكمية</th>
                        <th style="font-weight: 700;font-size:1.3rem;">سعر الوحدة</th>
                        <th style="font-weight: 700;font-size:1.3rem;">الإجمالي</th>
                        <th style="font-weight: 700;font-size:1.3rem;">ملاحظات</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sectionTotal = 0; @endphp
                    @foreach($section->children as $item)
                        @php
                            $pivot = optional($item->projectOwnerRequirements->first());
                            $qty = $pivot->quantity;
                            $price = $pivot->unit_price;
                            $total = $qty * $price;
                            $sectionTotal += $total;
                        @endphp
                        <tr>
                            <td style="font-size: 1.2rem;font-weight: 700;">{{ $loop->iteration }}</td> <!-- الرقم -->
                            <td style="font-weight: 700;font-size:1.2rem;">{{ $item->name_ar }}</td>
                            
                            <td style="font-weight: 700;font-size:1.2rem;">{{ $item->unit }}</td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][quantity]" value="{{ $qty }}"  class="form-control qty" {{ $contractor1 ? '' : 'readonly' }}/>
                            </td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][unit_price]" value="{{ $price }}"  class="form-control price"  {{ $contractor1 ? 'readonly' : '' }}/>
                            </td>
                            <td style="font-weight: 700;font-size:1.2rem;" class="total">{{ number_format($total, 2) }}</td>
                            <td>
                                <input type="text" name="requirements[{{ $item->id }}][notes]" value="{{ $pivot->notes ?? '' }}" class="form-control" />
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-secondary fw-bold">
                        <td style="font-weight: 700;font-size:1.3rem;" colspan="4">مجموع {{ $section->name_ar }}</td>
                        <td style="font-weight: 700;font-size:1.3rem;" colspan="2" class="section-total">{{ number_format($sectionTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach



        <table class="table table-bordered text-center">
            <tr class="table-warning fw-bold group-total-row">
                <td style="font-weight: 700;font-size:1.3rem;" colspan="4">
                    إجمالي {{ $group->name_ar }}
                </td>
                <td style="font-weight: 700;font-size:1.3rem;" colspan="2" class="group-total-value">
                    0.00
                </td>
            </tr>
        </table>


        <!-- <tr class="table-warning fw-bold group-total-row">
            <td colspan="4">
                إجمالي {{ $group->name_ar }}
            </td>
            <td class="group-total-value">
                0.00
            </td>
            <td></td>
        </tr> -->

    @endforeach






    <input type="hidden" name="context" value="{{ $context }}">













<hr class="my-4">
<h5 class="fw-bold text-center mb-4 bg-white rounded-3xl p-3">مواصفات من اختيار المالك </h5>






<div class="row">

    















@php
$fieldLabels = [
'water_heater' => 'السخان',
'bathroom_chairs' => 'كراسي الحمامات',
'exhaust_fan' => 'الشفط',
'insulation' => 'النعلة',
'aluminum' => 'الألمنيوم',
'water_tank' => 'خزان المياه',
'main_door' => 'الباب الرئيسي كاست المنيوم',
'paint_type' => 'نوع الصبغ',
'hot_cold_water_for_bidet' => 'الماء الحار والبارد للشطاف',
'car_electric_point' => 'نقطة شحن سيارة',
'facade_lighting_points' => 'نقاط اضاءة بالواجهات',
'pantry_plumbing_first_floor' => 'نقطة صرف وتغذية للبانتري في الدور الأول',
'roof_electric_point' => 'نقطة كهرباء السطح',
'roof_water_point' => 'نقطة مياه السطح',
'feeding_pipe_install' => 'تركيب تمديدات التغذية',
'ac_civil_works' => 'اعمال مدنية للتكييف',
'front_stairs' => 'الدرج الامامي لمدخل الفيلا',
'floor_protection' => 'حماية الارضيات بعد تركيب البورسلان',
'ac_water_recovery_tank' => 'خزان استرجاع مياه التكييف',
'washroom_faucets' => 'مكسرات المغاسل والحمامات',
'sanitary_drainage' => 'نظام الصرف الصحي',
'ceramic_tiles' => 'حبات السيراميك',
'water_tank_capacity' => 'سعة خزان المياه',
'door_heights' => 'ارتفاعات الأبواب',
'fence_water_points' => 'نقاط مياه في السور',
'fence_electric_points' => 'نقاط كهرباء في السور',
'exterior_stone_tiles' => 'الحجر والبورسلان الخارجي',
'camera_points' => 'نقاط الكاميرا',
'annex_ceramic_price' => 'سعر سيراميك الملاحق',
'planting_basins' => 'أحواض الزراعة',
'hidden_plaster_beam' => 'نعلة مخفية للجبس بلاستر',
'first_floor_bath_drainage' => 'صرف الحمامات الدور الاول',
'central_exhaust_fans' => 'مراوح الشفاط المركزي',
'bath_wall_niches' => 'تجويفات جدران الحمامات',
'garage_door_electric_point' => 'نقطة كهرباء ماكينة باب الكراج',
'curb_grooves' => 'توريد و تركيب رداد للكلين اوت',
'fence_grooves' => 'تركيب قروفات بالسور',
'window_electric_points' => 'نقاط كهرباء لشبابيك الصالة',
'sound_system_pipes' => 'تركيب بايبات ساوند سيستم',
'cleanout_rebates' =>'توريد و تركيب رداد للكلين اوت',
'feeding_pipe_routing' => 'بايبات الصرف'
];
@endphp




@foreach($designOptions as $field => $options)
<div class="col-md-3 mb-4">

    <div class="design-card">

        <label class="design-title rounded-xl "  style="background:#d4af37; color:#2f3a1f;  text-align: center">
            {{ $fieldLabels[$field] ?? $field }}
        </label>

        @foreach($options as $opt)
        <div class="form-check design-option">

            <input class="form-check-input design-radio"
                   type="radio"
                   name="designs[{{ $field }}]"
                   value="{{ $opt }}"
                   {{ ($designs?->$field == $opt) ? 'checked' : '' }}>

            <label class="form-check-label design-label">
                {{ $opt }}
            </label>

        </div>
        @endforeach

    </div>

</div>
@endforeach


{{-- @foreach($designOptions as $field => $options)
    <div class="col-md-2 mb-4">
        <label class="fw-bold d-block mb-2">{{ $fieldLabels[$field] ?? $field }}</label>

        @foreach($options as $opt)
            <div class="form-check">
                <input class="form-check-input"
                       type="radio"
                       name="designs[{{ $field }}]"
                       value="{{ $opt }}"
                       {{ ($designs?->$field == $opt) ? 'checked' : '' }}>

                <label class="form-check-label">{{ $opt }}</label>
            </div>
        @endforeach
    </div>
@endforeach --}}















</div>
















<div class="floating-actions">

    <button type="submit"
            class="btn btn-olive px-4 main-save-btn">
        <i class="fas fa-save"></i> حفظ الأسعار والكميات
    </button>

    <a target="_blank"
        href="{{ route('projects.contract.pricing.pdf', $project->id) }}?action=preview"
        class="btn btn-preview px-4">
        👁 معاينة اسعار التوريد والمواصفات 
    </a>

</div>



    {{-- <div class="text-center d-flex my-4 justify-content-center gap-2">

     
        <button type="submit"
                class="btn btn-olive px-4 "
                style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-save"></i> حفظ الأسعار والكميات
        </button>


        <a target="_blank"
            href="{{ route('projects.contract.pricing.pdf', $project->id) }}?action=preview"
            class="btn btn-outline-success px-4">
                  👁 معاينة اسعار التوريد والمواصفات 
        </a>


    </div> --}}

</form>












<script>








function calculateAll() {

    let approvedArea = {{ $project->approved_area ?? 1 }};
    let grandTotalWithoutVat = 0;
    let groupsTotals = [];

    document.querySelectorAll('.group-header').forEach((groupHeader, gIndex) => {

        let groupTotal = 0;
        let next = groupHeader.nextElementSibling;

        while(next && !next.classList.contains('group-header')) {

            if(next.classList.contains('section-header')) {

                let table = next.nextElementSibling;

                if(table && table.classList.contains('section-table')) {

                    let sectionTotal = 0;

                    //table.querySelectorAll('.total').forEach(cell => {
                    //    sectionTotal += parseFloat(cell.textContent.replace(/,/g,'')) || 0;
                    //});
                    table.querySelectorAll('tbody tr').forEach(row => {

                        let qtyInput = row.querySelector('.qty');
                        let priceInput = row.querySelector('.price');

                        if(qtyInput && priceInput){
                            let qty = parseFloat(qtyInput.value) || 0;
                            let price = parseFloat(priceInput.value) || 0;
                            sectionTotal += qty * price;
                        }

                    });


                    let sectionId = table.dataset.sectionId;

                    let sectionCell = document.getElementById('section-summary-' + sectionId);
                    if(sectionCell){
                        sectionCell.textContent =
                            sectionTotal.toLocaleString(undefined,{minimumFractionDigits:2});
                    }

                    groupTotal += sectionTotal;
                }
            }

            next = next.nextElementSibling;
        }

        groupsTotals.push(groupTotal);
        grandTotalWithoutVat += groupTotal;

       let groupTotalRow = groupHeader
            .closest('form')
            .querySelectorAll('.group-total-row .group-total-value')[gIndex];


        if(groupTotalRow){
            groupTotalRow.textContent =
                groupTotal.toLocaleString(undefined,{minimumFractionDigits:2});
        }



        let groupCell = document.getElementById('group-summary-' + gIndex);
        if(groupCell){
            groupCell.textContent =
                groupTotal.toLocaleString(undefined,{minimumFractionDigits:2});
        }

    });

    document.getElementById('grandTotalWithoutVatDetailed').textContent =
        grandTotalWithoutVat.toLocaleString(undefined,{minimumFractionDigits:2});

    /* ===== باقي الحسابات ===== */

    let structureElectro = (groupsTotals[0] || 0) + (groupsTotals[1] || 0);
    let structureWithFinishes = structureElectro + (groupsTotals[2] || 0);
    let boundaryWall = groupsTotals[groupsTotals.length - 1] || 0;
    let villaWithWall = structureWithFinishes + boundaryWall;
    let vat = villaWithWall * 0.05;
    let finalTotal = villaWithWall + vat;

    let footWithout = approvedArea > 0 ? structureElectro / approvedArea : 0;
    let footWith    = approvedArea > 0 ? structureWithFinishes / approvedArea : 0;

    document.getElementById('structureElectro').textContent =
        structureElectro.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('structureWithFinishes').textContent =
        structureWithFinishes.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('footWithout').textContent =
        footWithout.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('footWith').textContent =
        footWith.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('boundaryWall').textContent =
        boundaryWall.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('villaWithWall').textContent =
        villaWithWall.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('vat').textContent =
        vat.toLocaleString(undefined,{minimumFractionDigits:2});
    document.getElementById('finalTotal').textContent =
        finalTotal.toLocaleString(undefined,{minimumFractionDigits:2});
}


document.addEventListener('input', function(e) {

    if(e.target.classList.contains('qty') || e.target.classList.contains('price')) {

        let tr = e.target.closest('tr');
        let qty = parseFloat(tr.querySelector('.qty').value) || 0;
        let price = parseFloat(tr.querySelector('.price').value) || 0;
        let total = qty * price;

        tr.querySelector('.total').textContent =
            total.toLocaleString(undefined,{minimumFractionDigits:2});

        let table = tr.closest('.section-table');
        let sectionTotal = 0;

        table.querySelectorAll('.total').forEach(cell => {
            sectionTotal += parseFloat(cell.textContent.replace(/,/g,'')) || 0;
        });

        table.querySelector('.section-total').textContent =
            sectionTotal.toLocaleString(undefined,{minimumFractionDigits:2});

        calculateAll();
    }

});

calculateAll();




document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.category-table').forEach(function(table) {
        const updateTotals = () => {
            let categoryTotal = 0;
            table.querySelectorAll('tbody tr').forEach(function(row) {
                const qtyInput = row.querySelector('.qty');
                const priceInput = row.querySelector('.price');
                const totalCell = row.querySelector('.total');

                if (qtyInput && priceInput && totalCell) {
                    const qty = parseFloat(qtyInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    const total = qty * price;
                    totalCell.textContent = total ? total.toLocaleString() : '';
                    categoryTotal += total;
                }
            });
            const categoryTotalRow = table.querySelector('.category-total td[colspan="2"]');
            if(categoryTotalRow) {
                categoryTotalRow.textContent = categoryTotal.toLocaleString();
            }
        };

        table.addEventListener('input', updateTotals);
        updateTotals(); // initial calculation
    });
});
</script>






<style>
    /* كل section-table */
.section-table {
    table-layout: fixed; /* هذا يفرض توزيع الأعمدة حسب العرض المحدد */
    width: 100%;
}

/* تحديد عرض كل عمود */
.section-table th, .section-table td {
    white-space: nowrap;          /* لا يلتف النص */
    overflow: hidden;             /* يخفي النص الزائد */
    text-overflow: ellipsis;      /* يظهر ... للنص الطويل */
    text-align: center;
}

/* عرض مخصص لكل عمود */
.section-table th:nth-child(1),
.section-table td:nth-child(1) { width: 4%; }   /* البند */
.section-table th:nth-child(2),
.section-table td:nth-child(2) { width: 30%; }   /* البند */
.section-table th:nth-child(3),
.section-table td:nth-child(3) { width: 10%; }   /* الوحدة */
.section-table th:nth-child(4),
.section-table td:nth-child(4) { width: 14%; }   /* الكمية */
.section-table th:nth-child(5),
.section-table td:nth-child(5) { width: 14%; }   /* سعر الوحدة */
.section-table th:nth-child(6),
.section-table td:nth-child(6) { width: 14%; }   /* الإجمالي */
.section-table th:nth-child(7),
.section-table td:nth-child(7) { width: 14%; }   /* ملاحظات */
</style>




@endif
















    </div>

</div>

@endsection



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





