<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: 'amiri', serif;
    direction: rtl;
    text-align: right;
    font-size: 14px;
    line-height: 1.8;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 18px;
}
th, td {
    border: 1px solid #000;
    padding: 6px 8px;
}
.title {
    background-color: #e9e2c7;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
}
.section-title {
    background-color: #e9e2c7;
    font-weight: bold;
    text-align: center;
    font-size: 16px;
}
.center { text-align: center; }
.bold { font-weight: bold; }
</style>
</head>

<body>

{{-- ================= معلومات المشروع ================= --}}
<table>
<tr>
    <td class="title" colspan="4">عقد أسعار التوريد</td>
</tr>
<tr>
    <td class="bold">المالك</td>
    <td>{{ $project->ownerUser?->name }}</td>
    <td class="bold">المنطقة</td>
    <td>{{ $project->projectRegion?->name_ar }}</td>
</tr>
<tr>
    <td class="bold">وصف المشروع</td>
    <td>{{ $project->projectName?->name_ar }}</td>
    <td class="bold">رقم القسيمة</td>
    <td>{{ $project->qasmia_number }}</td>
</tr>

<tr>
    <td class="bold" > التاريخ</td>
    <td >{{ $project->contract_signed_at->format('d/m/Y')??'-' }}</td>
        <td class="bold">الطرف الثاني</td>
        <td >{{ $project->contractorUser->name ?? 'المقاول' }}</td>
</tr>
</table>

{{-- ================= أسعار توريد التشطيبات ================= --}}
<!-- @foreach($items as $category => $rows)
<table>
<tr>
    <td class="section-title" colspan="6">{{ $category }}</td>
</tr>
<tr class="bold center">
    <td>البند</td>
    <td>الوحدة</td>
    <td>الكمية</td>
    <td>سعر الوحدة</td>
    <td>الإجمالي</td>
    <td>ملاحظات</td>
</tr>

@php $total = 0; @endphp

@foreach($rows as $requirement)

    @php
        $pivot = $requirement->projectOwnerRequirements->first();
        $total = $pivot->quantity * $pivot->unit_price;
    @endphp

    <tr class="center">
        <td>{{ $requirement->name }}</td>
        <td>{{ $requirement->unit }}</td>
        <td>{{ $pivot->quantity }}</td>
        <td>{{ number_format($pivot->unit_price) }}</td>
        <td>{{ number_format($total) }}</td>
        <td>{{ $pivot->notes }}</td>
    </tr>

@endforeach


<tr class="bold center">
    <td colspan="4">إجمالي {{ $category }}</td>
    <td colspan="2">{{ number_format($total) }}</td>
</tr>
</table>
@endforeach -->













@php
$grandTotal = 0;
$groupsTotals = [];
$sectionsTotals = [];
@endphp

{{-- ================= الجروبات ================= --}}
@foreach($groups as $group)

<table>
<tr>
    <td class="group-title" colspan="6">
        {{ $group->name_ar }}
    </td>
</tr>

@php $groupTotal = 0; @endphp

@foreach($group->children as $section)

<tr>
    <td class="section-title" colspan="6">
        {{ $section->name_ar }}
    </td>
</tr>

<tr class="bold center">
    <td>البند</td>
    <td>الوحدة</td>
    <td>الكمية</td>
    <td>سعر الوحدة</td>
    <td>الإجمالي</td>
    <td>ملاحظات</td>
</tr>

@php $sectionTotal = 0; @endphp

@foreach($section->children as $item)

@php
$pivot = $item->projectOwnerRequirements
              ->where('project_id',$project->id)
              ->first();

$qty = $pivot->quantity ?? 0;
$price = $pivot->unit_price ?? 0;
$total = $qty * $price;
$sectionTotal += $total;
@endphp

<tr class="center">
    <td>{{ $item->name_ar }}</td>
    <td>{{ $item->unit }}</td>
    <td>{{ $qty }}</td>
    <td>{{ number_format($price,2) }}</td>
    <td>{{ number_format($total,2) }}</td>
    <td>{{ $pivot->notes ?? '' }}</td>
</tr>

@endforeach

<tr class="total-row center">
    <td colspan="4">مجموع {{ $section->name_ar }}</td>
    <td colspan="2">{{ number_format($sectionTotal,2) }}</td>
</tr>

@php
$sectionsTotals[$section->id] = $sectionTotal;
$groupTotal += $sectionTotal;
@endphp

@endforeach

<tr class="total-row center">
    <td colspan="4">إجمالي {{ $group->name_ar }}</td>
    <td colspan="2">{{ number_format($groupTotal,2) }}</td>
</tr>

</table>


@endforeach














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
'car_electric_point' => 'نقطة كهرباء سيارة',
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
];
@endphp




{{-- <label class="fw-bold d-block mb-2">
    {{ $fieldLabels[$field] ?? $field }}
</label> --}}

{{-- ================= مواصفات من اختيار المالك ================= --}}
@if($specs)
<table>
<tr>
    <td class="section-title" colspan="2">مواصفات من اختيار المالك</td>
</tr>

@foreach($specs->getAttributes() as $key => $value)
    @continue(in_array($key, ['id','project_id','created_at','updated_at']))
    @if(!is_null($value))
    <tr>
        <td class="bold center">{{ $fieldLabels[$key] ?? $key }}</td>
        <td class="center">{{ $value }}</td>
    </tr>
    @endif
@endforeach
</table>
@endif

{{-- ================= التوقيعات ================= --}}

<table style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:50px;">
    <tr>
       <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع وختم المقاول
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع المالك
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع وختم الاستشاري
        </td>
    </tr>

    <tr>
        <td class="signature" style="height:80px; border-bottom:1px solid #000;"></td>

        <td class="signature" style="height:80px; border-bottom:1px solid #000;"></td>

        <td class="signature" style="height:80px; border-bottom:1px solid #000; text-align:center;">
           <img src="{{ public_path('images/signature.jpeg') }}" style="height:100px;">
        </td>
    </tr>
</table>



</body>
</html>
