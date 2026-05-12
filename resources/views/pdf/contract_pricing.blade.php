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




<style>
.spec-title {
    background: #e3a67b;
    color: #0b2c5f;
    font-weight: bold;
    text-align: center;
    font-size: 18px;
}

.spec-table td {
    background: #cfd8c3;
    font-weight: bold;
}

.spec-table-2 td {
    background: #e5d1c3;
}

.spec-table-3 td {
    background: #cfd9e3;
}
</style>








</style>
</head>

<body>

{{-- ================= معلومات المشروع ================= --}}
<!-- <table>
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
    <td >{{ $project->contract_signed_at?->format('d/m/Y')??'-' }}</td>
        <td class="bold">الطرف الثاني</td>
        <td >{{ $project->contractorUser->name ?? 'المقاول' }}</td>
</tr>


<tr>
        <td class="bold">  (الاستشاري)</td>
        <td colspan="4">سافانا ديزاين للاستشارات الهندسية</td>
    </tr>
 




</table> -->



@include('pdf.contract_header', ['project' => $project,'isBank'=>false,'showContractor' => true,'title'=>'عقد اسعار التوريد'])









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
<!-- <tr>
    <td class="group-title" colspan="6">
        {{ $group->name_ar }}
    </td>
</tr> -->

@php 
    $groupTotal = 0;
    $sectionIndex=0;
@endphp

@foreach($group->children as $section)
@php 

    $sectionIndex++;
@endphp


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

@if($sectionIndex == 7)
<tr class="no-border">
    <td colspan="3" style="height:120px; border: none; padding: 0;"></td>
</tr>
@endif






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



















{{-- ================= المواصفات الثابتة ================= --}}



<style>
.spec-title {
    background: #e3a67b;
    color: #0b2c5f;
    font-weight: bold;
    text-align: center;
    font-size: 18px;
}

.spec-table td {
    background: #cfd8c3;
    font-weight: bold;
}

.spec-table-2 td {
    background: #e5d1c3;
}

.spec-table-3 td {
    background: #cfd9e3;
}

.note-text {
    border: 1px solid #000;
    padding: 10px;
    font-size: 13px;
    line-height: 1.8;
}
</style>

{{-- ================= مواد الهيكل ================= --}}
<table class="spec-table">
<tr>
    <td colspan="3" class="spec-title">مواصفات مواد الهيكل</td>
</tr>

<tr>
    <td>الحديد</td>
    <td colspan="2">قطري</td>
</tr>

<tr>
    <td>الخرسانة</td>
    <td>الخليج</td>
    <td>اوريميكس</td>
</tr>

<tr>
    <td>الطابوق</td>
    <td>راكنور</td>
    <td>دبي</td>
</tr>

<tr>
    <td>الاعمدة</td>
    <td colspan="2">خرسانة ذاتية الدمج</td>
</tr>

<tr>
    <td>الخشب</td>
    <td colspan="2">من النوعية الجيدة إلى النوعية  الجديدة</td>
</tr>
</table>

{{-- ================= المواد الصحية ================= --}}
<table class="spec-table-2">
<tr>
    <td colspan="3" class="spec-title">مواصفات المواد الصحية</td>
</tr>

<tr>
    <td>نوعية تمديدات تغذية المياه</td>
    <td>اكواثرم</td>
    <td>PIX PIBE</td>
</tr>

<tr>
    <td>تركيب تحت الاسقف</td>
    <td colspan="2"></td>
</tr>

<tr>
    <td>نوعية بايبات الصرف الصحي</td>
    <td colspan="2">اطلس</td>
</tr>

<tr>
    <td>نوعية الخزان تحت الأرض</td>
    <td colspan="2">من الياف الفايبر</td>
</tr>

<tr>
    <td>نوعية الخزان  فوق الأرض</td>
    <td colspan="2">من الياف الفايبر</td>
</tr>

<tr>
    <td>نوعية السخان المركزي</td>
    <td colspan="2">ARISTON إيطالي</td>
</tr>

<tr>
    <td>نوعية مكاين الضغط</td>
    <td colspan="2">اسباني/ ايطالي</td>
</tr>
</table>

{{-- ================= المواد الكهربائية ================= --}}
<table class="spec-table-3">
<tr>
    <td colspan="3" class="spec-title">مواصفات المواد الكهرباية</td>
</tr>
</table>

<!-- {{-- ================= النص الطويل ================= --}}
<div class="note-text">
على المقاول تزويد الموقع بالكوادر الفنية والعمالة اللازمة لتنفيذ المشروع بالمستوى المطلوب مع مراعاة مايلي :<br>
1 – جميع عناصر الكادر الفني والعمالة الفنية يجب أن يكونوا من المؤهلين ومن ذوي الخبرة والكفاءة كلاً حسب اختصاصه وحسب متطلبات العمل والتنفيذ ( من حيث العدد والتوزيع ).<br>
2- يتم اعتماد الكوادر الفنية من قبل الاستشاري قبل مباشرتهم للعمل، ويجب أن تكون الكوادر الفنية من ذوي الخبرة بأعمال مماثلة.<br>
3 – يحق للإستشاري الطلب من المقاول إبعاد/استبدال أي شخص مستخدم من قبله إذا رأى الاستشاري أن ذلك الشخص ليس بالمستوى المطلوب من حيث السلوك أو الخبرة لتنفيذ الأعمال.<br>
4 – على المقاول تقديم جدول بأعداد العمالة العادية والفنية العاملة في الموقع بشكل أسبوعي.<br>
5 – يشتمل الكادر الفني (المطلوب من المقاول توفيره كحد أدنى) على :<br>
• مدير للمشروع.<br>
• مهندس موقع ( Site Engineer )مسؤول عن تنفيذ المشروع للتعامل مع الاستشاري<br>
• مراقب فني (Forman) لكل نوع من أنواع الأعمال.<br>
• أي كوادر فنية أخرى يطلبها الاستشاري ويرى أنها لازمة لتنفيذ المشروع بالمستوى المطلوب.<br>
• مقاول باطن اعمال الالكتروميكانيك يجب ان يكون معتمد من الاستشاري و الـ FEWA.
.
</div> -->

<table class="spec-table-3">

<tr>
    <td>اللوحات و الصناديق</td>
    <td colspan="2">شنايدر</td>
</tr>

<tr>
    <td>مفاتيح الانارة</td>
    <td>PANASONIC</td>
    <td>مع تيوترال</td>
</tr>

<tr>
    <td>نوع بايبات و اسلاك الكهرباء</td>
    <td colspan="2">دوكاب</td>
</tr>

<tr>
    <td>قواطع رييسية</td>
    <td>DORMAN SWITSH</td>
    <td>Abb</td>
</tr>

<tr>
    <td>الازوليتر</td>
    <td colspan="2">شنايدر</td>
</tr>

<tr>
    <td>جي اي بوكس للماخذ ومفاتيح</td>
    <td colspan="2">الفنار</td>
</tr>

</table>










{{-- ================= التوقيعات ================= --}}

<table style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:20px;">
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
           <!-- <img src="{{ public_path('images/signature.jpeg') }}" style="height:100px;"> -->
        </td>
    </tr>
</table>



</body>
</html>
