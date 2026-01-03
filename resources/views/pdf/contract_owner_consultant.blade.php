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

    $today = Carbon::now();
    $dayName = $today->translatedFormat('l'); // اسم اليوم بالعربي
    $dateFormatted = $today->format('Y/m/d');
@endphp



<table style="width:100%; border-collapse: collapse;">
    <tr>
        <td class="title" colspan="3" style="text-align:center; font-weight:bold; font-size:22px;">
            عقد اتفاق بين المالك و الاستشاري
        </td>
    </tr>

    <tr>
        <td colspan="3" style="text-align:center; padding:10px;">
            انه في يوم <strong>{{ $dayName }}</strong> بتاريخ <strong>{{ $dateFormatted }}</strong><br>
            حرر بين كل من:
        </td>
    </tr>
</table>

<table style="width:100%; border-collapse: collapse; margin-top:10px;">
    <tr>
        <td colspan="3" style="padding:8px;">
            • الطرف الأول السيد:
            <strong>{{ $project->ownerUser->name ?? '—' }}</strong>
            مالك المشروع، قسيمة رقم
            <strong>{{ $project->qasmia_number ?? '—' }}</strong>
            منطقة
            <strong>{{ $project->area ?? '—' }}</strong>
        </td>
    </tr>

    <tr>
        <td colspan="3" style="padding:8px;">
            • الطرف الثاني: شركة
            <strong>سافانا ديزاين للاستشارات الهندسية والتصميم الداخلي</strong>،
            رخصة رقم <strong>(48818)</strong>،
            وعنوانها مكتب رقم <strong>(407)</strong> بأبراج جلفار،
            في إمارة رأس الخيمة،
            ويمثلها المدير / المهندس <strong>أيمن بن حمادي</strong>.
        </td>
    </tr>
</table>

<table>
    <tr><td class="section-title" colspan="3">بنود الاتفاق</td></tr>

    <tr><td colspan="3">1 - قبل الطرف الثاني بموجب هذا العقد أن يقوم بأعمال التصميم الهندسي والإشراف على مشروع الفيلا الخاصة بالطرف الأول، وذلك حسب المعايير والمواصفات المحددة من قبل الجهات المختصة.</td></tr>

    <tr><td colspan="3">2 - يلتزم الطرف الأول بدفع مبلغ وقدره 0 درهم غير شامل الضريبة، للطرف الثاني مقابل أعمال التصاميم.</td></tr>

    <tr><td colspan="3">3 - يلتزم الطرف الأول بدفع كافة رسوم الجهات الحكومية أو الخاصة، والمطلوبة لفتح معاملات اعتماد المخططات والرسومات الهندسية، أو التعديل عليها.</td></tr>

    <tr><td colspan="3">4 - لا يتحمل الطرف الثاني أي تأخير حاصل من قبل أي جهات أخرى، وتكون حدود مسؤوليته في العمل المنوط به فقط.</td></tr>

    <tr><td colspan="3">5 - يقر الطرف الأول بأن كل الأفكار والمخططات والتصاميم المقدمة من الطرف الثاني تعتبر حقًا من حقوق ملكيته الفكرية، ولا يمكن نقلها لأي جهة مهما كانت أو التنازل عنها إلا بكتاب خطي موقع ومختوم من الطرف الثاني.</td></tr>

    <tr><td colspan="3">6 - أي مبالغ مدفوعة في أي مرحلة من مراحل تصميم المشروع والإشراف عليه، تكون نظيرًا للأفكار والجهد والوقت والخدمة المقدمة من قبل الطرف الثاني، ولا يحق للطرف الأول المطالبة باسترجاع تلك المبالغ.</td></tr>

    <tr><td colspan="3">7 - يستحق الطرف الثاني نسبة من القيمة الإجمالية لعقد المقاولة، يدفعها مقاول المشروع أو الطرف الأول.</td></tr>

    <tr><td colspan="3">8 - يلتزم الطرف الأول بدفع مبلغ مقابل إشراف الطرف الثاني على تنفيذ المشروع، وتدفع كمبلغ مقطوع على دفعات شهرية، غير شامل الضريبة، من بداية التنفيذ وحتى الانتهاء.</td></tr>

    <tr><td colspan="3">9 - يلتزم الطرف الثاني بأن تكون الزيارات الإشرافية بمعدل أربع زيارات شهريًا، وفي حال توقف الأشغال لمدة ثلاثة أشهر أو أكثر لا يحق للطرف الثاني المطالبة بمبلغ الإشراف.</td></tr>

    <tr><td colspan="3">10 - إذا وجد أي عائق من عوائق الأرض (دفان – كابل كهرباء – تعديل تحت المنسوب) فإن الطرف الأول يتحمل تسوية الموضوع.</td></tr>

    <tr><td colspan="3">11 - يلتزم المالك بدفع رسوم إضافية يحددها الاستشاري في حال طلب أي تعديل بعد بدء التنفيذ.</td></tr>

    <tr><td colspan="3">12 - يلتزم المالك بدفع رسوم إدخال الكهرباء ورسوم الإنجاز في نهاية المشروع.</td></tr>

    <tr><td colspan="3">13 - يحق للطرف الثاني (الاستشاري) نشر صور وفيديوهات المشروع.</td></tr>

    <tr><td colspan="3">14 - يحق للطرف الأول تغيير الاستشاري أثناء التنفيذ فقط، وفي حال الإنهاء قبل التنفيذ يلتزم بدفع المستحقات الخاصة بأعمال التصميم.</td></tr>
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
