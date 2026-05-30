<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: 'amiri', serif;
    direction: rtl;
    text-align: right;
    font-size: 13px;
    line-height: 1.8;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
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

.group-title {
    background-color: #dcd3a8;
    font-weight: bold;
    font-size: 17px;
    text-align: center;
}

.section-title {
    background-color: #f1ead1;
    font-weight: bold;
    text-align: center;
}

.center { text-align: center; }
.bold { font-weight: bold; }

.total-row {
    background-color: #dbd0d0;
    font-weight: bold;
    font-size: 17px;
}















/* 

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    page-break-inside: avoid;
}

tbody {
    page-break-inside: avoid;
}

tr {
    page-break-inside: avoid;
    page-break-after: auto;
}

td, th {
    page-break-inside: avoid;
}
thead {
    display: table-header-group;
} 

thead {
    display: table-header-group;
} */

</style>
</head>

<body>





@php
$grandTotal = 0;
$groupsTotals = [];
$sectionsTotals = [];

foreach($groups as $group){

    $groupTotal = 0;

    foreach($group->children as $section){

        $sectionTotal = 0;

        foreach($section->children as $item){

            $pivot = $item->projectOwnerRequirements
                ->where('project_id',$project->id)
                ->first();

            $qty = $pivot->quantity ?? 0;
            $price = $pivot->unit_price ?? 0;

            $sectionTotal += $qty * $price;
        }

        $sectionsTotals[$section->id] = $sectionTotal;
        $groupTotal += $sectionTotal;
    }

    $groupsTotals[$group->id] = $groupTotal;
    $grandTotal += $groupTotal;
}
@endphp


@php

$groupsValues = array_values($groupsTotals);

$structureElectro =
    ($groupsValues[0] ?? 0) +
    ($groupsValues[1] ?? 0);

$structureWithFinishes =
    $structureElectro +
    ($groupsValues[2] ?? 0);

$approvedArea = $project->approved_area ?? 0;

$footWithoutFinishes = $approvedArea > 0 ? $structureElectro / $approvedArea : 0;
$footWithFinishes    = $approvedArea > 0 ? $structureWithFinishes / $approvedArea : 0;

$boundaryWall = end($groupsValues);

$totalVillaWithWall = $structureWithFinishes + $boundaryWall + $groupsValues[3];



$vat = $totalVillaWithWall * 0.05;

$finalTotal = $totalVillaWithWall + $vat;

@endphp

 






@include('pdf.contract_header', ['project' => $project,'isBank'=>false,'isTender' => true,'showContractor' => true,'title'=>'عقد حساب الكميات'])



{{-- ================= معلومات المشروع ================= --}}
<!-- <table>
<tr>
    <td class="title" colspan="4">حساب الكميات</td>
</tr>
<tr>
    <td class="bold" style="width: 12rem;">المالك</td>
    <td>{{ $project->ownerUser?->name }}</td>
    <td class="bold" style="width: 12rem;">المنطقة</td>
    <td>{{ $project->projectRegion?->name_ar }}</td>
</tr>
<tr>
    <td class="bold" style="width: 12rem;">وصف المشروع</td>
    <td>{{ $project->projectName?->name_ar }}</td>
    <td class="bold" style="width: 12rem;">رقم القسيمة</td>
    <td>{{ $project->qasmia_number }}</td>
</tr>

<tr>
    <td class="bold" style="width: 12rem;">مساحة السور م.طولي</td>
    <td>{{ $project->linear_meter_area }}</td>
    <td class="bold" style="width: 12rem;">مساحة البناء بالقدم المربع</td>
    <td>{{ $project->approved_area }}</td>
</tr>


</table> -->








<table class="mb-0" style="margin-bottom: 0px;">
<tr>
    <td class="title" colspan="4"> بيانات المقاول</td>
</tr>
<tr>
    <td style="width: 12rem;" class="bold">اسم الشركة</td>
    <td>{{ $project->contractorUser?->name }}</td>
    <td class="bold" style="width: 12rem;">المسؤول</td>
    <td>{{ $project->contractorUser?->responsible_name }}</td>
</tr>
<tr>
    <td class="bold" style="width: 12rem;"> التاريخ</td>
    <td>{{ $project->contract_signed_at?->format('d/m/Y')??'-' }}</td>
    <td class="bold" style="width: 12rem;">رقم الهاتف</td>
    <td>{{ $project->contractorUser?->mobile }}</td>
</tr>

<tr>
    <td class="bold" style="width: 12rem;">رقم الرخصة</td>
    <td>{{ $project->contractorUser?->license_number }}</td>
    <td class="bold" style="width: 12rem;">مدة التنفيذ</td>
    <td>{{ $project->bank_contract_duration }}</td>
</tr>


</table>


<!-- <img src="{{ public_path('images/tender_photo.jpeg') }}" style="height:1140px;"> -->






<table>

<tr>
<td class="title mb-2rem" colspan="4" style="margin-bottom: 30px;">
ملخص البنود
</td>
</tr>

<tr class="center">
<td class="bold">سعر الهيكل مع الكتروميكانيكال مع تركيب سيراميك</td>
<td>Main structure with electromechanical</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($structureElectro,2) }}</td>
</tr>

<tr class="center">
<td class="bold">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</td>
<td>Total main Structure with electromechanical with finishes</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($structureWithFinishes,2) }}</td>
</tr>

<tr class="center">
<td class="bold">سعر الفوت بدون تشطيبات</td>
<td>Foot Prices without finishes</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($footWithoutFinishes,2) }}</td>
</tr>

<tr class="center">
<td class="bold">سعر الفوت مع تشطيبات</td>
<td>Foot Prices with finishes</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($footWithFinishes,2) }}</td>
</tr>

<tr class="center">
<td class="bold">سعر السور</td>
<td>Boundary Wall Price</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($boundaryWall,2) }}</td>
</tr>

<tr class="center">
<td class="bold">سعر الفيلا مع السور مع الواجهات    </td>
<td>Total Villa Price</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($totalVillaWithWall,2) }}</td>
</tr>

<tr class="center">
<td class="bold">الضريبة 5%</td>
<td>VAT 5%</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($vat,2) }}</td>
</tr>

<tr class="total-row center">
<td class="bold">السعر النهائي للمشروع (شامل الضريبة)</td>
<td>Total Project Value with VAT</td>
<td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($finalTotal,2) }}</td>
</tr>

</table> 





@php
$grandTotal = 0;
$groupsTotals = [];
$sectionsTotals = [];
@endphp


@php
$groupColors = [
    ['group' => '#dcd3a8', 'section' => '#f1ead1'],
    ['group' => '#c8d8e4', 'section' => '#e3eff6'],
    ['group' => '#d7e4c0', 'section' => '#edf5e3'],
    ['group' => '#e4c8c8', 'section' => '#f6e3e3'],
    ['group' => '#d6c8e4', 'section' => '#eee3f6'],
    ['group' => '#e4d8c8', 'section' => '#f6efe3'],
];
@endphp


@php
$sectionLetterIndex = 0;
@endphp
                        
                        
{{-- ================= الجروبات ================= --}}
@foreach($groups as $group)


@php
$color = $groupColors[$loop->index % count($groupColors)];
@endphp

@if($loop->index==0)
<div style="height:20px; ">.</div>
@endif


@if($loop->index==3)
<div style="height:90px; ">.</div>
@endif 
<table >

<tr >
    <td class="group-title" style="background:{{ $color['group'] }}  " colspan="7">
        {{ $group->name_ar }}
    </td>
</tr>

@php $groupTotal = 0; @endphp

@foreach($group->children as $section)

<tr >
    <td class="section-title" style="background:{{ $color['section'] }}" colspan="7">
        <span style="font-weight: 700;font-size:1.2rem;">{{ chr(65 + $sectionLetterIndex++) }}</span> - 
        {{ $section->name_ar }}
    </td>
</tr>

<tr class="bold center">
    <td></td>
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
//$pivot = $item->projectOwnerRequirements->first();
$qty = $pivot->quantity ?? 0;
$price = $pivot->unit_price ?? 0;
$total = $qty * $price;
$sectionTotal += $total;
$notes = $pivot->notes ?? '';

@endphp




<tr class="center">
    <td style="font-weight: 700;font-size:1.2rem;">{{ $loop->iteration }}</td>
    <td>{{ $item->name_ar }}</td>
    <td>{{ $item->unit }}</td>
    <td>{{ $qty }}</td>
    
    <td class="{{ $loop->parent->parent->index == 2 ? 'border-danger text-danger fw-bold' : '' }}">{{ number_format($price,2) }}</td>
    <td>{{ number_format($total,2) }}</td>
    <td>{{ $notes ?? '' }}</td>
</tr>

@endforeach

<tr class="total-row center">
    <td colspan="4" class="total-row center">مجموع {{ $section->name_ar }}</td>
    <td colspan="3" class="total-row center">{{ number_format($sectionTotal,2) }}</td>
</tr>

@php
$sectionsTotals[$section->id] = $sectionTotal;
$groupTotal += $sectionTotal;
@endphp

@endforeach

<tr class="total-row center" style="background:{{ $color['section'] }}">
    <td colspan="4" class="total-row center" style="background:{{ $color['section'] }}">إجمالي {{ $group->name_ar }}</td>
    <td colspan="3" class="total-row center" style="background:{{ $color['section'] }}">{{ number_format($groupTotal,2) }}</td>
</tr>

</table>

@php
$groupsTotals[$group->id] = $groupTotal;
$grandTotal += $groupTotal;
@endphp

@endforeach

<!-- {{-- ================= بنود على المالك ================= --}}
<table>

<tr>
    <td class="group-title" colspan="10">
        رابعا: بنود على المالك
    </td>
</tr>

<tr class="bold center">
    <td>الرقم</td>
    <td>البند</td>
    <td>English</td>
    <td>الرقم</td>
    <td>البند</td>
    <td>English</td>
    <td>الوحدة</td>
    <td>الكمية</td>
    <td>السعر</td>
    <td>الإجمالي</td>
</tr>


</table> -->



























{{--style="page-break-before: always;" ================= ملخص أسعار المشروع ================= --}}
<div ></div>

<table style="width:100%; border-collapse:collapse; page-break-inside: avoid;">

<tr>
    <td class="title" colspan="5">
        ملخص أسعار المشروع
    </td>
</tr>
@php
$groupColors = [
    ['group' => '#dcd3a8', 'section' => '#f1ead1'],
    ['group' => '#c8d8e4', 'section' => '#e3eff6'],
    ['group' => '#d7e4c0', 'section' => '#edf5e3'],
    ['group' => '#e4c8c8', 'section' => '#f6e3e3'],
    ['group' => '#d6c8e4', 'section' => '#eee3f6'],
    ['group' => '#e4d8c8', 'section' => '#f6efe3'],
];
$sectionLetterIndex2=0;

@endphp

<!--@foreach($groups as $group)
@php
$color = $groupColors[$loop->index % count($groupColors)];

$groupTotal = 0;
$sectionCount = count($group->children);

foreach ($group->children as $section) {
    $groupTotal += $sectionsTotals[$section->id] ?? 0;
}

@endphp
<tr>
    <td class="group-title" colspan="6" style="background:{{ $color['group'] }}">
        {{ $group->name_ar }}
    </td>
</tr>

@foreach($group->children as $index => $section)

<tr class="center">
    <td style="background:{{ $color['section'] }}">{{ $section->name_ar }}</td>
    <td style="background:{{ $color['section'] }}"> {{ chr(65 + $sectionLetterIndex2++) }} </td>
    <td colspan="3" style="background:{{ $color['section'] }}; font-size: 18px;font-weight: bold;">
        AED {{ number_format($sectionsTotals[$section->id] ?? 0,2) }}
    </td>
</tr>

@endforeach

@endforeach -->





@foreach($groups as $group)

@php
$color = $groupColors[$loop->index % count($groupColors)];

$groupTotal = 0;
$sectionCount = count($group->children);

foreach ($group->children as $section) {
    $groupTotal += $sectionsTotals[$section->id] ?? 0;
}
@endphp

<tr>
    <td class="group-title" colspan="7" style="background:{{ $color['group'] }}">
        {{ $group->name_ar }}
    </td>
</tr>

@foreach($group->children as $index => $section)

<tr class="center">

    <td style="background:{{ $color['section'] }}">
        {{ $section->name_ar }}
    </td>

    <td style="background:{{ $color['section'] }}">
        {{ chr(65 + $sectionLetterIndex2++) }}
    </td>

    <td style="background:{{ $color['section'] }}; font-weight:bold;">
        AED {{ number_format($sectionsTotals[$section->id] ?? 0, 2) }}
    </td>

    @if($index == 0)
        <td rowspan="{{ $sectionCount }}"
            style="background:#ffe8a1; font-weight:bold; vertical-align: middle; text-align:center;">
            AED {{ number_format($groupTotal, 2) }}
        </td>
    @endif

</tr>

@endforeach

@endforeach



<tr class="total-row grand-total center">
<td colspan="3" class="total-row center">
اجمالى سعر المشروع بدون ضريبة
<br>
Total Project value without VAT
</td>
<td colspan="2" class="total-row grand-total center">
AED {{ number_format($grandTotal,2) }}
</td>
</tr>

</table>









{{-- ================= ملخص البنود ================= --}}
@php

$groupsValues = array_values($groupsTotals);

// جروب 1 + 2
$structureElectro =
    ($groupsValues[0] ?? 0) +
    ($groupsValues[1] ?? 0);

// أول 3 جروبات
$structureWithFinishes =
    $structureElectro +
    ($groupsValues[2] ?? 0);

// سعر الفوت
$approvedArea = $project->approved_area ?? 0;

$footWithoutFinishes = $approvedArea > 0 ? $structureElectro / $approvedArea : 0;
$footWithFinishes    = $approvedArea > 0 ? $structureWithFinishes / $approvedArea : 0;

// السور = آخر جروب
$boundaryWall = end($groupsValues);

// الفيلا مع السور
$totalVillaWithWall = $structureWithFinishes + $boundaryWall +$groupsValues[3];

// الضريبة (قسمة على 21)
$vat = $totalVillaWithWall * 0.05;

// النهائي شامل الضريبة
$finalTotal = $totalVillaWithWall + $vat;

@endphp

<div style="height:120px;">.</div>
<table style="page-break-before: always;">

<tr >
    <td class="title" colspan="4">
        ملخص البنود
    </td>
</tr>

<tr class="center">
    <td class="bold">سعر الهيكل مع الكتروميكانيكال مع تركيب سيراميك</td>
    <td>Main structure with electromechanical</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($structureElectro,2) }}</td>
</tr>

<tr class="center">
    <td class="bold">سعر الهيكل مع الكتروميكانيكال مع التشطيبات</td>
    <td>Total main Structure with electromechanical with finishes</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($structureWithFinishes,2) }}</td>
</tr>

<tr class="center">
    <td class="bold">سعر الفوت بدون تشطيبات</td>
    <td>Foot Prices without finishes</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($footWithoutFinishes,2) }}</td>
</tr>

<tr class="center">
    <td class="bold">سعر الفوت مع تشطيبات</td>
    <td>Foot Prices with finishes</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($footWithFinishes,2) }}</td>
</tr>

<tr class="center">
    <td class="bold">سعر السور</td>
    <td>Boundary Wall Price</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($boundaryWall,2) }}</td>
</tr>

<tr class="center">
    <td class="bold">  سعر الفيلا مع السور مع الواجهات  </td>
    <td>Total Villa Price</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($totalVillaWithWall,2) }}</td>
</tr>

<tr class="center">
    <td class="bold">الضريبة 5%</td>
    <td>VAT 5%</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($vat,2) }}</td>
</tr>

<tr class="total-row center">
    <td class="bold">السعر النهائي للمشروع (شامل الضريبة)</td>
    <td>Total Project Value with VAT</td>
    <td colspan="2" style="font-size: 18px;font-weight: bold;">AED {{ number_format($finalTotal,2) }}</td>
</tr>

</table>






































{{-- ================= بنود على المالك ================= --}}
{{-- <table>

<tr>
    <td class="group-title" colspan="10">
        رابعا: بنود على المالك
    </td>
</tr>

<tr class="bold center">
    <td>الرقم</td>
    <td>البند</td>
    <td>English</td>
    <td>الرقم</td>
    <td>البند</td>
    <td>English</td>
    <td>الوحدة</td>
    <td>الكمية</td>
    <td>السعر</td>
    <td>الإجمالي</td>
</tr>

<tr class="center">
<td>T1</td>
<td>توريد وتركيب اعمال الاكساءات الخارجية المحيطة بالفيلا والكربستون الخارجي</td>
<td>supply and install interlock and kerbstone</td>
<td>U1</td>
<td>عزل الأسقف نوعية ألتك للمتر المربع</td>
<td>Altic for ceiling by M2</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T2</td>
<td>التكييف ، ونظام Smart Home</td>
<td>AC and Smart home</td>
<td></td>
<td></td>
<td>Altic for ceiling by M2</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T3</td>
<td>الديكورات الجبسية والاسقف المستعارة</td>
<td>internal decoration and false ceiling</td>
<td>U2</td>
<td>الأسمنت بلاستر للحوائط الداخلية. للمتر المربع</td>
<td>Internal plaster by M2</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T4</td>
<td>توريد وتركيب خزائن الملابس والمطابخ</td>
<td>supply and install wardrobe and kitchen cabinet</td>
<td></td>
<td></td>
<td>Internal plaster by M2</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T5</td>
<td>الدش والانتركوم والكميرات</td>
<td>Satellite, intercom and cameras</td>
<td>U3</td>
<td>الباب المنزلق FOLDING DOOR للمتر المربع</td>
<td>slidding / folding doors by M2</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T6</td>
<td>قروفات السور</td>
<td>Grooves boundary wall</td>
<td></td>
<td></td>
<td>slidding / folding doors by M2</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T7</td>
<td>دفان قطعة الارض او تخفيض منسوبها للوصول للمنسوب التصميمي</td>
<td>Backfilling or cut and fill to reach for design level</td>
<td>U4</td>
<td>تغيير من فول امبريلا للكيرتن وول للمتر المربع</td>
<td>changing aluminum to curtain wall instead of full umbrella</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T8</td>
<td>رسوم توصيل الخدمات والدوائر الحكومية</td>
<td>government connection fees</td>
<td></td>
<td></td>
<td>changing aluminum to curtain wall instead of full umbrella</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T9</td>
<td>ضريبة القيمة المضافة</td>
<td>VAT</td>
<td>U5</td>
<td>الأعمال التمديدات حالة رغبة المالك في إضافة سمارت هوم للستاير و التكييف و لاقط حركة</td>
<td>pipes works in case of client want to add smart for curtains , AC , moving sensor</td>
<td>M3</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T10</td>
<td>الكراج و المظلات واحواض الزهور والنوافير و الحديقة</td>
<td>Garage , Car parking pergola , flower boxes , water fountains and garden</td>
<td></td>
<td></td>
<td>pipes works in case of client want to add smart for curtains , AC , moving sensor</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T11</td>
<td>المصعد "عن طريق شركة متخصصة "الاعمال المدنية على المقاول"</td>
<td>Lift with special company , civil works by main contractor</td>
<td>U6</td>
<td>الأعمال الخراسانية بسماكة 10 سم للاارضيات لتركيب البورسولان دور اول و ارضي باللاصق</td>
<td>Concrete 10 cm for porcelain for GF & 1st by glue</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T12</td>
<td>الإنارة الداخلية "توريد وتركيب المالك "</td>
<td>internal lights ( supply and installation by client )</td>
<td></td>
<td></td>
<td>Concrete 10 cm for porcelain for GF & 1st by glue</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T13</td>
<td>الإنارة الخارجية "توريد المالك وتركيب المقاول"</td>
<td>External lights ( supply by client and installation by Contractor )</td>
<td>U7</td>
<td>تنفيذ بيتومين عازلة للجدران الخارجية في حالة تركيب للحجر الخارجي</td>
<td>bitumen painting for external elevations for stone works</td>
<td>L.M</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T14</td>
<td>اعمال الكهروميكانيكية و المكاين و التشغيل و صندوق الكهرباء للمسبح ان وجد</td>
<td>Electromechanical, pumps, operation and Electrical DB for swimming pool if any</td>
<td></td>
<td></td>
<td>bitumen painting for external elevations for stone works</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T13</td>
<td>مصاريف تخص المعاملات البنكية</td>
<td>Banks fees</td>
<td colspan="7"></td>
</tr>

<tr class="total-row center">
<td colspan="8">
إجمالي سعر اعمال خارج العقد اذا رغب المالك في اضافتها
<br>
Total pices for works out of contract if client want to add
</td>
<td colspan="2">7</td>
</tr>

</table> --}}










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
           <!-- <img src="{{ public_path('images/signature.jpeg') }}" style="height:140px;"> -->
        </td>
    </tr>
</table>



</body>
</html>
