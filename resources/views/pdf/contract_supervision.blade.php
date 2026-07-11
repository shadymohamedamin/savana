<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: 'amiri', serif;
    direction: rtl;
    font-size: 13px;
    line-height: 1.65;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 7px;
}

td, th {
    border: 1px solid #000;
    padding: 5px;
    text-align: center;
    vertical-align: middle;
}

.title {
    background: #e9e2c7;
    font-size: 18px;
    font-weight: bold;
}

.bold {
    font-weight: bold;
}

.note-box {
    border: 1.5px solid #000;
    padding: 7px;
    margin-top: 5px;
    height: 88px;
    overflow: hidden;
    text-align: right;
    page-break-inside: avoid;
}

.images-table {
    table-layout: fixed;
    margin-top: 8px;
    page-break-inside: avoid;
}

.image-cell {
    height: 130px;
    padding: 4px;
}

.image-cell img {
    max-width: 100%;
    max-height: 122px;
}

.empty-cell {
    color: #777;
    font-size: 12px;
}

.signature-table {
    margin-top: 8px;
    page-break-inside: avoid;
}
</style>

</head>

<body>

@php
    $projectValue = $project->bank_contract_value
        ? number_format($project->bank_contract_value).' درهم'
        : '-';
@endphp

<table>
    <tr>
        <td colspan="4" class="title">
            تقرير إشراف هندسي
        </td>
    </tr>

    <tr>
        <td class="bold">المالك</td>
        <td>{{ $project->ownerUser?->name ?? '-' }}</td>

        <td class="bold">المقاول</td>
        <td>{{ $project->contractorUser?->name ?? '-' }}</td>
    </tr>

    <tr>
        <td class="bold">المشروع</td>
        <td>{{ $project->projectName?->name_ar ?? '-' }}</td>

        <td class="bold">تاريخ الزيارة</td>
        <td>{{ $supervision->created_at?->format('Y-m-d') ?? '-' }}</td>
    </tr>

    <tr>
        <td class="bold">المشرف</td>
        <td>{{ $supervision->user?->name ?? '-' }}</td>

        <td class="bold">مرحلة الإشراف</td>
        <td>{{ $supervision->supervisionType?->name_ar ?? '-' }}</td>
    </tr>

    <tr>
        <td class="bold">قيمة المشروع</td>
        <td>{{ $projectValue }}</td>

        <td class="bold">تاريخ انتهاء الموقع</td>
        <td>{{ $project->contractor_contract_end_date?->format('Y-m-d') ?? '-' }}</td>
    </tr>
</table>

<div class="note-box">
    {!! nl2br(e($supervision->note)) !!}
</div>

<table class="images-table">
    @for($row = 0; $row < 2; $row++)
        <tr>
            @for($column = 0; $column < 2; $column++)
                @php
                    $index = ($row * 2) + $column;
                    $image = $imageAttachments[$index] ?? null;
                @endphp

                <td class="image-cell">
                    @if($image)
                        <img src="{{ $image['path'] }}" alt="{{ $image['name'] }}">
                    @else
                        <span class="empty-cell">لا توجد صورة</span>
                    @endif
                </td>
            @endfor
        </tr>
    @endfor
</table>

<table class="signature-table" style="width:100%; border-collapse:collapse; margin-top:0px; margin-bottom:50px;">
    <tr>
        <td class="title bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع وختم المقاول
        </td>
        <td class="title bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع المالك
        </td>
        <td class="title bold center section-title" style="text-align:center; font-weight:bold;">
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
