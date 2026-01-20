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
        <td>{{ $project->name }}</td>
        <td class="bold">رقم القسيمة</td>
        <td>{{ $project->qasmia_number ?? '-' }}</td>
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
        <td>الاحتياجات العامة</td>
        <td>مختار</td>
        <td>العدد</td>
        <td>ملاحظات</td>
    </tr>

    @foreach($requirements['ground'] as $req)
        @if($req->pivot?->quantity)
        <tr class="center">
            <td>{{ $req->name }}</td>
            <td class="check">*</td>
            <td>{{ $req->pivot->quantity }}</td>
            <td></td>
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
        <td>الاحتياجات العامة</td>
        <td>مختار</td>
        <td>العدد</td>
        <td>ملاحظات</td>
    </tr>

    @foreach($requirements['first'] as $req)
        @if($req->pivot?->quantity)
        <tr class="center">
            <td>{{ $req->name }}</td>
            <td class="check">*</td>
            <td>{{ $req->pivot->quantity }}</td>
            <td></td>
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
        <td class="section-title" >البند</td>
        <td class="section-title" >الاختيار</td>
    </tr>

    <tr>
        <td class="bold">تصميم الفيلا</td>
        <td>{{ $design->villa_style }}</td>
    </tr>

    <tr>
        <td class="bold">عدد درجات البناء</td>
        <td>{{ $design->floors_count }}</td>
    </tr>

    <tr>
        <td class="bold">باب الفيلا</td>
        <td>{{ $design->villa_door }}</td>
    </tr>

    <tr>
        <td class="bold">موقع الفيلا</td>
        <td>{{ $design->villa_location }}</td>
    </tr>

    <tr>
        <td class="bold">دابل هايت</td>
        <td>{{ $design->double_height ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold">صالات مفتوحة</td>
        <td>{{ $design->open_living ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold">اتصال الفيلا</td>
        <td>{{ $design->villa_connection }}</td>
    </tr>

    <tr>
        <td class="bold">ارتفاع السقف</td>
        <td>{{ $design->ceiling_height }} م</td>
    </tr>

    <tr>
        <td class="bold">اطلالات داخلية على الحديقة</td>
        <td>{{ $design->internal_garden_view ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold">موقع الدرج</td>
        <td>{{ $design->stairs_location }}</td>
    </tr>

    <tr>
        <td class="bold">موقع البانتي</td>
        <td>{{ $design->pantry_location }}</td>
    </tr>

    <tr>
        <td class="bold">أبواب الخدمات</td>
        <td>{{ $design->service_doors }}</td>
    </tr>

    <tr>
        <td class="bold">مصعد مستقبلي</td>
        <td>{{ $design->future_elevator ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold">فناء داخلي</td>
        <td>{{ $design->internal_courtyard ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold">شكل الفيلا</td>
        <td>{{ $design->villa_shape }}</td>
    </tr>

    <tr>
        <td class="bold">خدمة الطعام</td>
        <td>{{ $design->dining_serves }}</td>
    </tr>

    <tr>
        <td class="bold">نوع الدرج</td>
        <td>{{ $design->stairs_type }}</td>
    </tr>

    <tr>
        <td class="bold">نوع التكييف</td>
        <td>{{ $design->ac_type }}</td>
    </tr>

    <tr>
        <td class="bold">ارتفاع الأبواب</td>
        <td>{{ $design->doors_height }}</td>
    </tr>

    <tr>
        <td class="bold">مستوى الأثاث</td>
        <td>{{ $design->furniture_level }}</td>
    </tr>

    <tr>
        <td class="bold">كراسي الحمامات</td>
        <td>{{ $design->bathroom_chairs }}</td>
    </tr>

    <tr>
        <td class="bold">خزان تحت الأرض</td>
        <td>{{ $design->underground_tank ? 'نعم' : 'لا' }}</td>
    </tr>

    <tr>
        <td class="bold">النعلة</td>
        <td>{{ $design->skirting_type }}</td>
    </tr>
</table>
@endif








{{-- ================= التوقيعات ================= --}}
<table class="signature-table">
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
