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
            vertical-align: middle;
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

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .check {
            font-size: 18px;
            font-weight: bold;
        }

        .signature-table td {
            height: 70px;
            text-align: center;
            vertical-align: bottom;
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

{{-- ================= معلومات المشروع ================= --}}
<table>
    <tr>
        <td class="title" colspan="4">معلومات المشروع</td>
    </tr>
    <tr>
        <td class="bold">المالك</td>
        <td>{{ $project->ownerUser?->name ?? '-' }}</td>
        <td class="bold">المنطقة</td>
        <td>{{ $project->projectRegion?->name_ar ?? '-' }}</td>
        
    </tr>
    <tr>
        <td class="bold">وصف المشروع</td>
        <td>{{ $project->projectName->name_ar }}</td>
        <td class="bold">رقم القسيمة</td>
        <td>{{ $project->qasmia_number ?? '-' }}</td>
        
    </tr>
    <tr>
        <td class="bold">المساحة</td>
        <td>{{ $project->area ?? '-' }}</td>
        <td class="bold">البادجت</td>
        <td>{{ $project->budget ?? '-' }}</td>
    </tr>
</table>

{{-- ================= متطلبات المالك ================= --}}
<table>
    <tr>
        <td class="section-title" colspan="4">متطلبات المالك</td>
    </tr>
</table>

{{-- ================= الدور الأرضي ================= --}}
@if(!empty($requirements['ground']))
<table>
    <tr>
        <td class="section-title" colspan="4">الدور الأرضي</td>
    </tr>
    <tr class="bold center">
        <td style="text-align:center;">الاحتياجات العامة</td>
        <td>مختار</td>
        <td>العدد</td>
        <td>ملاحظات</td>
    </tr>

    @foreach($requirements['ground'] as $req)
        @if($req->pivot?->quantity)
        <tr class="center">
            <td class="text-center" style="text-align:center;">{{ $req->name }}</td>
            <td class="check">*</td>
            <td>{{ $req->pivot->quantity }}</td>
            <td>{{ $req->pivot->notes }}</td>
        </tr>
        @endif
    @endforeach
</table>
@endif

{{-- ================= الدور الأول ================= --}}
@if(!empty($requirements['first']))
<table>
    <tr>
        <td class="section-title" colspan="4">الدور الأول</td>
    </tr>
    <tr class="bold center">
        <td style="text-align:center;">الاحتياجات العامة</td>
        <td>مختار</td>
        <td>العدد</td>
        <td>ملاحظات</td>
    </tr>

    @foreach($requirements['first'] as $req)
        @if($req->pivot?->quantity)
        <tr class="center">
            <td class="text-center" style="text-align:center;">{{ $req->name }}</td>
            <td class="check">*</td>
            <td>{{ $req->pivot->quantity }}</td>
            <td>{{ $req->pivot->notes }}</td>
        </tr>
        @endif
    @endforeach
</table>
@endif








<table>
    <tr>
        <td class="section-title" colspan="4">أفكار الاستشاري  </td>
    </tr>
</table>



@if($design)
<table>
    <tr class="bold center ">
        <td class="section-title" style="text-align:center;">البند</td>
        <td class="section-title" style="text-align:center;">الاختيار</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">تصميم الفيلا</td>
        <td style="text-align:center;">{{ $design->villa_style }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">عدد درجات البناء</td>
        <td style="text-align:center;">{{ $design->floors_count }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">باب الفيلا</td>
        <td style="text-align:center;">{{ $design->villa_door }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">موقع الفيلا</td>
        <td style="text-align:center;">{{ $design->villa_location }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">دابل هايت</td>
        <td style="text-align:center;">{{ $design->double_height ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">صالات مفتوحة</td>
        <td style="text-align:center;">{{ $design->open_living ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">اتصال الفيلا</td>
        <td style="text-align:center;">{{ $design->villa_connection }}</td>
    </tr>

    <tr>
        <td class="bold" style="text-align:center;">ارتفاع السقف</td>
        <td style="text-align:center;">{{ $design->ceiling_height }} م</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">اطلالات داخلية على الحديقة</td>
        <td style="text-align:center;">{{ $design->internal_garden_view ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">موقع الدرج</td>
        <td style="text-align:center;">{{ $design->stairs_location }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">موقع البانتي</td>
        <td style="text-align:center;">{{ $design->pantry_location }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">أبواب الخدمات</td>
        <td style="text-align:center;">{{ $design->service_doors }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">مصعد مستقبلي</td>
        <td style="text-align:center;">{{ $design->future_elevator ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">فناء داخلي</td>
        <td style="text-align:center;">{{ $design->internal_courtyard ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">شكل الفيلا</td>
        <td style="text-align:center;">{{ $design->villa_shape }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">خدمة الطعام</td>
        <td style="text-align:center;">{{ $design->dining_serves }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">نوع الدرج</td>
        <td style="text-align:center;">{{ $design->stairs_type }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">نوع التكييف</td>
        <td style="text-align:center;">{{ $design->ac_type }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">ارتفاع الأبواب</td>
        <td style="text-align:center;">{{ $design->doors_height }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">مستوى الأثاث</td>
        <td style="text-align:center;">{{ $design->furniture_level }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">كراسي الحمامات</td>
        <td style="text-align:center;">{{ $design->bathroom_chairs }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">خزان تحت الأرض</td>
        <td style="text-align:center;">{{ $design->underground_tank ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td style="text-align:center;" class="bold">النعلة</td>
        <td style="text-align:center;">{{ $design->skirting_type }}</td>
    </tr>
</table>
@endif



<div>تم الاتفاق بين الاستشاري والمالك على اعتماد الاحتياجات والمتطلبات حسب ما هو مدون في الجدول المرفق</div>




{{-- ================= التوقيعات ================= --}}
<table class="signature-table mt-4" style="margin-top:2rem;">
    <tr>
        <td class="signature-header">المالك</td>
        <td class="signature-header">الاستشاري</td>
    </tr>
    <tr>
        <td class="signature-space">
            <strong>{{ $project->ownerUser->name ?? 'المالك' }}</strong>
        </td>
        <td class="signature-space">
            سافانا ديزاين للاستشارات الهندسية
        </td>
    </tr>
</table>

</body>
</html>
