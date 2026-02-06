<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>تكليف</title>
    <style>
        body {
            font-family: 'Amiri', serif;
            direction: rtl;
            text-align: right;
            font-size: 15px;
            line-height: 1.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        td, th {
            border: 1px solid #000;
            padding: 10px;
            vertical-align: top;
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
            height: 6rem;
            vertical-align: bottom;
            font-weight: bold;
            text-align: center;
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

<table>
    <tr>
        <td class="section-title">الموضوع: تكليف</td>
    </tr>
</table>

<table>
    <tr>
        <td>
             التاريخ: {{ $project->start_date->format('Y/m/d') }}
            <!-- التاريخ: {{ now()->format('Y/m/d') }} -->
        </td>
    </tr>

    <tr>
        <td>
            يسرنا الموقع ادناه 
            <strong>{{ $project->ownerUser->name ?? 'المالك' }}</strong>
            بصفتي مالك المشروع على القسيمة رقم 
            <strong>{{ $project->qasmia_number ?? '—' }}</strong>
            منطقة 
            <strong>{{ $project->projectRegion?->name_ar ?? '-' }}</strong>
            وهو عبارة عن 
            <strong>{{ $project->projectName->name_ar }}</strong>
            تكليف مكتب 
            <strong>سافانا ديزاين</strong>
            للاستشارات الهندسية بأعمال التصميم والاشراف حتى استخراج شهادة الإنجاز وارساء المناقصة على المقاول.
        </td>
    </tr>
</table>


<table>
    <tr>
        <td class="bold section-title">المرحلة الأولى:</td>
    </tr>
    <tr>
        <td>
            دراسة الموقع ، حركة الشمس ، مخططات مبدئية مقترحة من الاستشاري
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="bold section-title">المرحلة الثانية:</td>
    </tr>
    <tr>
        <td>
            بعد اعتماد المرحلة الأولى يتم تجهيز المخططات التنفيذية للمشروع (مخططات معماري مع جميع التفاصيل)
            <br>• مخططات الإنشائي مع التفاصيل  
            <br>• مخططات الكهرباء  
            <br>• مخططات الماء  
            <br>• مخططات الصرف الصحي  
            <br>• مخططات الاتصالات
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="bold section-title">المرحلة الثالثة:</td>
    </tr>
    <tr>
        <td>
            تقديم المخططات التنفيذية للمشروع للبلدية.
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="bold section-title">المرحلة الرابعة:</td>
    </tr>
    <tr>
        <td>
            تحضير الشروط والمواصفات بالتشاور مع المالك وطرح المشروع للمناقصة وتجهيز العقود.
        </td>
    </tr>
</table>

<table>
    <tr>
        <td class="bold section-title">المرحلة الخامسة:</td>
    </tr>
    <tr>
        <td>
            الاشراف على تنفيذ المشروع في الموقع حتى الإنجاز.
        </td>
    </tr>
</table>

<table>
    <tr>
        <td>
            • كل الأفكار والمخططات والتصاميم المقدمة من سافانا ديزاين تعتبر حق من حقوق ملكيتها الفكرية، ولا يمكن نقلها لأي جهة مهما كانت أو التنازل عنها إلا بكتاب خطي موقع ومختوم من سافانا ديزاين.<br>
            • يتحمل مالك المشروع كافة الرسوم المتعلقة بالمشروع ورسوم الدوائر الحكومية، وتحدد رسوم الرخصة لاحقاً بعد اعتماد المخططات.<br>
            • يستحق الاستشاري بعد اعتماد المرحلة الأولى نسبة من القيمة الإجمالية لعقد المقاولة يدفعها المقاول المنفذ أو المالك حسب الحالة.
        </td>
    </tr>
</table>

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
