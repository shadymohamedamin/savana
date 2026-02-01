@extends('layouts.app')

@section('content')

<div class="card shadow-sm rounded-4"
     style="background-color:#f5f5dc;margin:40px;padding:0px;">
@include('projects.partials.project-actions', ['project' => $project])
    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.2rem;font-weight:600;">

        <div>
            <h4 class="mb-0">
                {{ __('متطلبات المالك') }}
            </h4>
            <small>
                المشروع: <strong>{{ $project->name }}</strong> |
                المالك: <strong>{{ $project->ownerUser?->name ?? '—' }}</strong> |
                رقم القسيمة: <strong>{{ $project->qasmia_number ?? '—' }}</strong> |
                المنطقة: <strong>{{ $project->projectRegion?->name_ar ?? '—' }}</strong>
                
            </small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('projects.index') }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;">
                <i class="fas fa-arrow-left" ></i> {{ __('العودة الي المشاريع') }}
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-4" style="background:#f5f5dc;">

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
    <label class="fw-bold d-block mb-2">بانتي</label>
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
            <input class="form-check-input" required type="radio" name="design[skirting_type]" value="{{ $opt }}" {{ ($design?->skirting_type == $opt) ? 'checked' : '' }}>
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
                    👁  المتطلبات المعاينة
                </a>

            </div>



        </form>
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





