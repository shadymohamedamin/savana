<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'amiri', serif;
            direction: rtl;
            text-align: right;
            font-size: 15px;
            line-height: 1.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td, th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .title {
            background-color: #e9e2c7;
            font-size: 22px;
            font-weight: bold;
            text-align: center;
        }

        .section-title {
            background-color: #e9e2c7;
            font-weight: bold;
            text-align: center;
            font-size: 18px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .signature-table td {
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
            padding: 10px;
            font-size: 14px;
        }

        .signature-header {
            background-color: #e9e2c7;
            font-weight: bold;
            font-size: 16px;
        }

        .signature-space {
            min-height: 20px;
            height: 20px;
        }
    </style>
</head>
<body>

@php
use Carbon\Carbon;
Carbon::setLocale('ar');
$today = Carbon::now();
$dateFormatted = $today->translatedFormat('d/m/Y');
@endphp

<table style="width:100%; border-collapse: collapse;">
    <tr>
        <td class="title" colspan="3" style="text-align:center;">
            عقد الاتفاق - Agreement
        </td>
    </tr>
</table>

<p>بإشرافنا نحن:</p>
<p>سافانا ديزاين للإستشارات الهندسية والتصميم الداخلي - رأس الخيمة</p>
<p>مكتب 407 أبراج جلفار رأس الخيمة</p>
<p>525015080</p>

<p>تم الاتفاق بين كل من:</p>

<table style="width:100%; border-collapse: collapse; margin-top:10px;">
    <tr>
        <td style="padding:8px;"><strong>الطرف الأول: المالك</strong><br>{{ $project->ownerUser->name ?? '—' }}</td>
        <td style="padding:8px;"><strong>الطرف الثاني: المقاول</strong><br> {{ $project->contractorUser->name ?? '—' }}</td>
        <td style="padding:8px;"><strong>الطرف الثالث: الاستشاري</strong><br>سافانا ديزاين للاستشارات الهندسية</td>
    </tr>
</table>

<table style="width:100%; border-collapse: collapse; margin-top:10px;">
    <tr>
        <td style="padding:8px;"><strong>المشروع:</strong></td>
        <td style="padding:8px;"><strong>وصف المشروع:</strong> {{ $project->name }}</td>
    </tr>
    <tr>
        <td style="padding:8px;"><strong>المنطقة:</strong></td>
        <td style="padding:8px;">{{ $project->area }}</td>
    </tr>
    <tr>
        <td style="padding:8px;"><strong>رقم القسيمة:</strong></td>
        <td style="padding:8px;">{{ $project->qasmia_number }}</td>
    </tr>
    <tr>
        <td style="padding:8px;"><strong>سعر الفيلا مع السور (بدون الضريبة):</strong></td>
        <td style="padding:8px;">800,000 درهم</td>
    </tr>
</table>

<p>يقوم الطرف الثاني بتنفيذ وانشاء وانجاز وصيانة المشروع المذكور أعلاه لقاء مبلغ وقدره ثماني مائة ألف درهم إماراتي فقط بدون الضريبة، وذلك حسب المتفق عليه والمعتمد وفق للمناقصة التي جرت.</p>

<table class="signature-table">
    <tr>
        <td class="signature-header">توقيع وختم المقاول</td>
        <td class="signature-header">توقيع  المالك</td>
        <td class="signature-header">توقيع وختم الاستشاري</td>
    </tr>
    <tr>
        <td class="signature-space">{{ $project->contractorUser->name ?? 'المقاول' }}</td>
        <td class="signature-space">{{ $project->ownerUser->name ?? 'المالك' }}</td>
        <td class="signature-space">سافانا ديزاين للاستشارات الهندسية</td>
    </tr>
</table>

<p style="margin-top:20px;">تاريخ: {{ $project->start_date->format('d/m/Y') }}</p>

</body>
</html>
