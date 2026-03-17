<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">

    <style>
        /* ===== Page Setup ===== */
       

        body {
            font-family: 'amiri', serif;
            direction: rtl;
            text-align: right;
            font-size: 16px;
            line-height: 2;
        }

        /* ===== General Tables ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        td, th {
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
        }

        /* ===== Title ===== */
        .title {
            background-color: #e9e2c7;
            font-size: 26px;
            font-weight: bold;
            text-align: center;
            padding: 15px;
        }

        /* ===== Intro ===== */
        .intro-text {
            border: 1px solid #000;
            padding: 18px;
            text-align: justify;
            margin-bottom: 25px;
        }

        /* ===== Info Table ===== */
        .info-table td:first-child {
            background-color: #f3f0e4;
            font-weight: bold;
            width: 30%;
        }

        /* ===== Spacer to push signatures ===== */
        .page-spacer {
            height: 180px;
        }

        /* ===== Signature Table ===== */
        .signature-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .signature-table td {
            border: 1px solid #000;
            text-align: center;
            vertical-align: bottom;
            padding: 12px;
            font-size: 15px;
        }

        .signature-header td {
            background-color: #e9e2c7;
            font-weight: bold;
            font-size: 16px;
        }

        .signature-space {
            height: 120px;
        }
    </style>
</head>

<body>

@php
use Carbon\Carbon;
Carbon::setLocale('ar');
$today = Carbon::now();
$dayName = $today->translatedFormat('l');
$dateFormatted = $today->translatedFormat('d/m/Y');
@endphp

<!-- ===== Title ===== -->
<table>
    <tr>
        <td class="title" colspan="3">
            عقد تسليم الموقع
        </td>
    </tr>
</table>



<!-- ===== Project Info ===== -->
<table class="info-table">
    <tr>
        <td>فيلا السيدة</td>
        <td>{{ $project->ownerUser->name ?? '—' }}</td>
    </tr>
    <tr>
        <td>رقم القسيمة</td>
        <td>{{ $project->qasmia_number ?? '—' }}</td>
    </tr>
    <tr>
        <td>الإمارة</td>
        <td>{{ $project->city->Region ?? '—' }}</td>
    </tr>
    <tr>
        <td>المنطقة</td>
        <td>{{ $project->projectRegion->name_ar ?? '—' }}</td>
    </tr>
</table>
<!-- ===== Intro ===== -->
<div class="intro-text">
    انه في يوم <strong>{{ $dayName }}</strong> الموافق
    <strong>{{ $dateFormatted }}</strong>
    تم تسليم الموقع المذكور ادناه الى المقاول خالياً من العوائق وصالحاً للبناء فيه،
    ويبدأ احتساب مدة التنفيذ من يوم    تسليم الموقع شاملة فترة التحضير.
    <!-- <br><br>
    ولا مانع من تقديم الدفعة الأولى للبدء في الأعمال. -->
</div>
<!-- ===== Spacer ===== -->
<div class="page-spacer"></div>

<!-- ===== Signatures ===== -->

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
