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

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .signature {
            height: 90px;
            vertical-align: bottom;
            text-align: center;
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

// ضبط اللغة العربية
Carbon::setLocale('ar');

// تحويل تاريخ المشروع إلى كائن Carbon
$startDate = Carbon::parse($project->start_date);

// اسم اليوم بالعربي
$dayName = $startDate->translatedFormat('l');

// التاريخ بشكل منسق بالعربي
$dateFormatted = $startDate->translatedFormat('d/m/Y'); // مثال: 07/01/2026
@endphp
<!-- عنوان العقد -->
<table>
    <tr>
        <td class="title" colspan="3">{{ __('Hawya Contract') /* ar.json: "عقد الحاوية" */ }}</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align:center; padding:10px;">
            انه في يوم <strong>{{ $dayName }}</strong> بتاريخ <strong>{{ $dateFormatted }}</strong><br>
            حرر بين كل من:
        </td>
    </tr>
</table>


<!-- بيانات المشروع -->
<table>
    <tr>
        <td colspan="2" class="section-header" style="padding:15px;">
            بيانات المشروع
        </td>
    </tr>

    <tr>
        <td class="label" style="width:35%;">موضوع التعاقد</td>
        <td class="value" style="width:65%;">{{ $project->name }}</td>
    </tr>

    <tr>
        <td class="label">قيمة التعاقد</td>
        <td class="value">
            {{ $project->budget }} ألف درهم إماراتي فقط لا غير
        </td>
    </tr>

    <tr>
        <td class="label">الموقع</td>
        <td class="value">
            {{ optional($project->projectRegion)->name_ar ?? '-' }}
        </td>
    </tr>

    <tr>
        <td class="label">قسيمة رقم</td>
        <td class="value">
            {{ $project->qasmia_number ?? '-' }}
        </td>
    </tr>

    <tr>
        <td class="label">مدة التنفيذ</td>
        <td class="value">
            {{ $project->duration ?? 0 }} شهر من تاريخ أمر المباشرة
        </td>
    </tr>
</table>


<!-- بيانات الأطراف -->
<table>
    <tr>
        <td colspan="2" class="section-header" style="padding:15px;">
            بيانات الأطراف
        </td>
    </tr>

    <tr>
        <td class="label" style="width:35%;">الطرف الأول (المالك)</td>
        <td class="value" style="width:65%;">
            {{ optional($project->ownerUser)->name ?? '-' }} <br>
            موبايل: {{ optional($project->ownerUser)->mobile ?? '-' }}
        </td>
    </tr>

    <tr>
        <td class="label">الطرف الثاني (المقاول)</td>
        <td class="value">
            {{ optional($project->contractorUser)->name ?? '-' }} <br>
            موبايل: {{ optional($project->contractorUser)->mobile ?? '-' }}
        </td>
    </tr>

    <tr>
        <td class="label">الإستشاري</td>
        <td class="value">
            سافانا ديزاين للإستشارات الهندسية<br>
            أبراج جلفار – الطابق الرابع – مكتب 407<br>
            هاتف: 2273478/07 – متحرك: 0525015080
        </td>
    </tr>
</table>


<!-- نص التعاقد -->
<table>
    <tr>
        <td class="section-header" style="padding:15px;">
            نص التعاقد
        </td>
    </tr>

    <tr>
        <td class="text-block" style="padding:25px; line-height:2.4;">
            يلتزم الطرف الثاني (المقاول) بتنفيذ المشروع المذكور أعلاه وفق المخططات
            وبنود التعاقد وتعليمات الإستشاري. ويكون الإستشاري مفوضاً من قبل المالك
            للإشراف الكامل على التنفيذ، ويلتزم المقاول بتنفيذ كافة تعليماته
            والرجوع إليه في جميع الاستفسارات الفنية والتنفيذية.
            وقد تم هذا الاتفاق برضا وقبول جميع الأطراف.
        </td>
    </tr>
</table>


<!-- التوقيعات -->
<table class="signature-table">
    <tr>
        <td class="signature-header" style="padding:15px;">المالك</td>
        <td class="signature-header" style="padding:15px;">المقاول</td>
        <td class="signature-header" style="padding:15px;">الإستشاري</td>
    </tr>

    <tr>
        <td style="height:50px; vertical-align:bottom; text-align:center;">
            {{ optional($project->ownerUser)->name ?? '-' }}
        </td>

        <td style="height:50px; vertical-align:bottom; text-align:center;">
            {{ optional($project->contractorUser)->name ?? '-' }}
        </td>

        <td style="height:50px; vertical-align:bottom; text-align:center;">
            سافانا ديزاين للإستشارات الهندسية
        </td>
    </tr>
</table>


</body>
</html>
