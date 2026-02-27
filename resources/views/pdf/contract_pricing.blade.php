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
        <td class="bold center">{{ __($key) }}</td>
        <td class="center">{{ $value }}</td>
    </tr>
    @endif
@endforeach
</table>
@endif

{{-- ================= التوقيعات ================= --}}
<table class="signature-table" style="margin-top:2rem;">
    <tr>
        <td class="section-title">المالك</td>
        <td class="section-title">الاستشاري</td>
    </tr>
    <tr>
        <td>
            <strong>{{ $project->ownerUser?->name ?? 'المالك' }}</strong>
        </td>
        <td>
            سافانا ديزاين للاستشارات الهندسية
        </td>
    </tr>
</table>

</body>
</html>
