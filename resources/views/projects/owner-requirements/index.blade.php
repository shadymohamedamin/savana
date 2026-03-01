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
</style>


@php
    $isOwner   = $context === 'owner';
    $isPricing = $context === 'pricing';
    $isTender  = $context === 'tender';
@endphp

<div class="card shadow-sm rounded-4"
     style="background-color:#f5f5dc;margin:40px;padding:0px;">
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

            <a href="{{ route('projects.tender.contractors', $project->id) }}"
                class="btn btn-sm"
                style="background:#8B0000;color:#fff;">
                    <i class="fas fa-users"></i> المقاولين المرشحين
            </a>

            <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'pricing']) }}"
                class="btn btn-sm"
                style="background:#2f3a1f;color:#d4af37;">
                    <i class="fas fa-file-signature"></i> أسعار توريد التشطيبات
            </a>


            <a href="{{ route('projects.owner-requirements.index', [$project, 'context' => 'tender']) }}"
                class="btn btn-sm"
                style="background:#2f3a1f;color:#d4af37;">
                    <i class="fas fa-file-signature"></i> حساب الكميات
            </a>
        <div class="d-flex gap-2">
            <a href="{{ route('projects.index') }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;">
                <i class="fas fa-arrow-left" ></i> {{ __('العودة الي المشاريع') }}
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

    @foreach($groups as $group)
        <div class="group-header mt-5">
            <span>{{ $group->name_ar }}</span>
        </div>


        @foreach($group->children as $section)
            <div class="section-header w-[100%] mt-4">
                <span>{{ $section->name_ar }}</span>
            </div>


            <table class="table table-bordered text-center section-table"
                    data-section-id="{{ $section->id }}">

                <thead>
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
                            $pivot = optional($item->projectOwnerRequirements->first());
                            $qty = $pivot->quantity;
                            $price = $pivot->unit_price;
                            $total = $qty * $price;
                            $sectionTotal += $total;
                        @endphp
                        <tr>
                            <td>{{ $item->name_ar }}</td>
                            
                            <td>{{ $item->unit }}</td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][quantity]" value="{{ $qty }}" min="1" class="form-control qty" />
                            </td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][unit_price]" value="{{ $price }}" step="1" class="form-control price" />
                            </td>
                            <td class="total">{{ number_format($total, 2) }}</td>
                            <td>
                                <input type="text" name="requirements[{{ $item->id }}][notes]" value="{{ $pivot->notes ?? '' }}" class="form-control" />
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-secondary fw-bold">
                        <td colspan="4">مجموع {{ $section->name_ar }}</td>
                        <td colspan="2" class="section-total">{{ number_format($sectionTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach



        <table class="table table-bordered text-center">
            <tr class="table-warning fw-bold group-total-row">
                <td colspan="4">
                    إجمالي {{ $group->name_ar }}
                </td>
                <td colspan="2" class="group-total-value">
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




<input type="hidden" name="contractor" value="{{ $contractor }}">




<hr class="my-5">

<h4 class="text-center fw-bold mb-4">ملخص أسعار المشروع</h4>

<table class="table table-bordered text-center">



    <tr class="table-dark">
        <th style="width:60%">البند</th>
        <th style="width:40%">القيمة</th>
    </tr>

    @foreach($groups as $gIndex => $group)
        <tr class="table-secondary fw-bold">
            <td colspan="2">
                {{ $group->name_ar }}
            </td>
        </tr>

        @foreach($group->children as $section)
            <tr>
                <td class="ps-4">
                    {{ $section->name_ar }}
                </td>
                <td id="section-summary-{{ $section->id }}">
                    0.00
                </td>
            </tr>
        @endforeach



        <tr class="fw-bold bg-light">
            <td>
                إجمالي {{ $group->name_ar }}
            </td>
            <td id="group-summary-{{ $gIndex }}">
                0.00
            </td>
        </tr>


        

    @endforeach

    <tr class="table-success fw-bold">
        <td>
            اجمالى سعر المشروع بدون ضريبة <br>
            Total Project value without VAT
        </td>
        <td id="grandTotalWithoutVatDetailed">
            0.00
        </td>
    </tr>

</table>












    <hr class="my-5">

<h4 class="text-center fw-bold mb-4">ملخص البنود</h4>

<table class="table table-bordered text-center" id="summaryTable">

<tr class="table-dark">
    <th colspan="2">البند</th>
    <th>القيمة</th>
</tr>

<tr>
    <td colspan="2">سعر الهيكل مع الكتروميكانيكال</td>
    <td id="structureElectro">0.00</td>
</tr>

<tr>
    <td colspan="2">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</td>
    <td id="structureWithFinishes">0.00</td>
</tr>

<tr>
    <td colspan="2">سعر الفوت بدون تشطيبات</td>
    <td id="footWithout">0.00</td>
</tr>

<tr>
    <td colspan="2">سعر الفوت مع تشطيبات</td>
    <td id="footWith">0.00</td>
</tr>

<tr>
    <td colspan="2">سعر السور</td>
    <td id="boundaryWall">0.00</td>
</tr>

<tr>
    <td colspan="2">سعر الفيلا مع السور</td>
    <td id="villaWithWall">0.00</td>
</tr>

<tr>
    <td colspan="2">الضريبة 5%</td>
    <td id="vat">0.00</td>
</tr>

<tr class="table-success fw-bold">
    <td colspan="2">السعر النهائي شامل الضريبة</td>
    <td id="finalTotal">0.00</td>
</tr>

</table>




    <div class="text-center d-flex my-4 justify-content-center gap-2">

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


    </div>

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
                            let qty = parseFloat(qtyInput.value) || 1;
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
    let vat = villaWithWall /21;//* 0.05;
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

</script>




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






@foreach($groups as $group)
        <div class="group-header mt-5">
            <span>{{ $group->name_ar }}</span>
        </div>


        @foreach($group->children as $section)
            <div class="section-header w-[100%] mt-4">
                <span>{{ $section->name_ar }}</span>
            </div>


            <table class="table table-bordered text-center section-table"
                    data-section-id="{{ $section->id }}">

                <thead>
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
                            $pivot = optional($item->projectOwnerRequirements->first());
                            $qty = $pivot->quantity;
                            $price = $pivot->unit_price;
                            $total = $qty * $price;
                            $sectionTotal += $total;
                        @endphp
                        <tr>
                            <td>{{ $item->name_ar }}</td>
                            
                            <td>{{ $item->unit }}</td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][quantity]" value="{{ $qty }}" min="1" class="form-control qty" />
                            </td>
                            <td>
                                <input type="number" name="requirements[{{ $item->id }}][unit_price]" value="{{ $price }}" step="1" class="form-control price" />
                            </td>
                            <td class="total">{{ number_format($total, 2) }}</td>
                            <td>
                                <input type="text" name="requirements[{{ $item->id }}][notes]" value="{{ $pivot->notes ?? '' }}" class="form-control" />
                            </td>
                        </tr>
                    @endforeach
                    <tr class="table-secondary fw-bold">
                        <td colspan="4">مجموع {{ $section->name_ar }}</td>
                        <td colspan="2" class="section-total">{{ number_format($sectionTotal, 2) }}</td>
                    </tr>
                </tbody>
            </table>
        @endforeach



        <table class="table table-bordered text-center">
            <tr class="table-warning fw-bold group-total-row">
                <td colspan="4">
                    إجمالي {{ $group->name_ar }}
                </td>
                <td colspan="2" class="group-total-value">
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

    



















@foreach($designOptions as $field => $options)
    <div class="col-md-2 mb-4">
        <label class="fw-bold d-block mb-2">{{ __($field) }}</label>

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
@endforeach















</div>




















    <div class="text-center d-flex my-4 justify-content-center gap-2">

        {{-- Save --}}
        <button type="submit"
                class="btn btn-olive px-4 "
                style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-save"></i> حفظ الأسعار والكميات
        </button>

        <!-- {{-- Preview --}}
        <a target="_blank"
        href="{{ url('projects/'.$project->id.'/contract-owner-requirements?action=preview') }}"
        class="btn btn-outline-primary px-4 ">
            👁 معاينة اسعار التوريد والمواصفات 
        </a> -->


        <a target="_blank"
            href="{{ route('projects.contract.pricing.pdf', $project->id) }}?action=preview"
            class="btn btn-outline-success px-4">
                  👁 معاينة اسعار التوريد والمواصفات 
        </a>


    </div>

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
                            let qty = parseFloat(qtyInput.value) || 1;
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





