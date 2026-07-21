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
            line-height: 1.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        td, th {
            border: 1px solid #000;
            padding: 4px;
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
        margin-top: 0px;
    }

    .signature-table td {
        border: 1px solid #000;
        text-align: center;
        vertical-align: middle;
        padding: 10px;
        font-size: 12px;
    }

    .signature-header {
        background-color: #e9e2c7;
        font-weight: bold;
        font-size: 14px;
    }

    .signature-space {
        min-height: 15px;
        height: 15px;
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

// التاريخ بشكل منسق بالعربي    <!-- @include('pdf.contract_header', ['project' => $project,'isBank'=>false,'showContractor' => false,'title'=>' عقد اتفاق بين المالك و الاستشاري']) -->

$dateFormatted = $startDate->translatedFormat('d/m/Y'); // مثال: 07/01/2026
@endphp












<table>
        <tr>
            <td class="title" colspan="4" class="section-title">{{' عقد اتفاق بين المالك و الاستشاري'}}</td>
        </tr>


        
        <!-- <tr>
            <td colspan="3" class="center">
                بإشرافنا نحن<br>
                سافانا ديزاين للاستشارات الهندسية والتصميم الداخلي – رأس الخيمة<br>
                مكتب 407 أبراج جلفار – رأس الخيمة<br>
                525015080
            </td>
        </tr> -->



        
 





    <tr>
        <td class="bold">وصف المشروع</td>
        <td>{{ $project->projectName?->name_ar }}</td>

        <td class="bold">المنطقة</td>
        <td>{{ $project->projectRegion?->name_ar ?? '—' }}</td>
    </tr>

    <tr>
        <td class="bold">رقم القسيمة</td>
        <td>{{ $project->qasmia_number ?? '—' }}</td>

        <td class="bold">تاريخ العقد</td>
        <td>{{ $project->contract_signed_at?->format('Y-m-d') ?? '-' }}</td>
    </tr>

    <!-- <tr>
        <td class="bold">قيمة المشروع</td>
        <td>
            {{
                $project->bank_contract_value
            }}
        </td> -->

        <!-- <td class="bold">تاريخ الدفعة</td>
        <td>
            {{ !empty($approvalCreatedAt) ? $approvalCreatedAt->format('Y-m-d') : '-' }}
        </td> -->
    <!-- </tr> -->

</table>


<table>
        <tr>
            <td colspan="3" class="section-title">تم الاتفاق بين كل من</td>
        </tr>
        <tr>
            <td class="bold">الطرف الأول(المالك)</td>
            <td colspan="2">{{ $project->ownerUser?->name ?? 'المالك' }}</td>
        </tr>
        <tr>
            <td class="bold">الطرف الثاني (الاستشاري)</td>
            <td colspan="2">سافانا ديزاين للاستشارات الهندسية</td>
            {{-- <td colspan="2">  زين العمارة للاستشارات الهندسية </td> --}}
        </tr>
    </table>




<!-- 
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
            <strong>{{ $project->projectRegion->name_ar ?? '—' }}</strong>
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
</table> -->

<table>
    <tr><td class="section-title" colspan="3">بنود الاتفاق</td></tr>

    <tr><td colspan="3">1 - قبل الطرف الثاني بموجب هذا العقد أن يقوم بأعمال التصميم الهندسي والإشراف على مشروع الفيلا الخاصة بالطرف الأول، وذلك حسب المعايير والمواصفات المحددة من قبل الجهات المختصة.</td></tr>

    <tr><td colspan="3">2 - يلتزم الطرف الأول بدفع مبلغ وقدره {{ $project->design_fee ?? 0 }} درهم  شامل الضريبة، للطرف الثاني مقابل أعمال التصاميم.</td></tr>

    <tr><td colspan="3">3 - يلتزم الطرف الأول بدفع كافة رسوم الجهات الحكومية أو الخاصة، والمطلوبة لفتح معاملات اعتماد المخططات والرسومات الهندسية، أو التعديل عليها.</td></tr>

    <tr><td colspan="3">4 - لا يتحمل الطرف الثاني أي تأخير حاصل من قبل أي جهات أخرى، وتكون حدود مسؤوليته في العمل المنوط به فقط.</td></tr>

    <tr><td colspan="3">5 - يقر الطرف الأول بأن كل الأفكار والمخططات والتصاميم المقدمة من الطرف الثاني تعتبر حقًا من حقوق ملكيته الفكرية، ولا يمكن نقلها لأي جهة مهما كانت أو التنازل عنها إلا بكتاب خطي موقع ومختوم من الطرف الثاني.</td></tr>

    <tr><td colspan="3">6 - أي مبالغ مدفوعة في أي مرحلة من مراحل تصميم المشروع والإشراف عليه، تكون نظيرًا للأفكار والجهد والوقت والخدمة المقدمة من قبل الطرف الثاني، ولا يحق للطرف الأول المطالبة باسترجاع تلك المبالغ.</td></tr>

    <tr><td colspan="3">7 -  يستحق الطرف الثاني نسبة من القيمة الإجمالية لعقد المقاولة، يدفعها مقاول المشروع أو الطرف الأول. في حال سحب المشروع قبل تنفيذ</td></tr>

    <!-- <tr><td colspan="3">8 - يلتزم الطرف الأول بدفع مبلغ {{ $project->supervision_fee ?? 0 }} درهم مقابل إشراف الطرف الثاني على تنفيذ المشروع، وتدفع كمبلغ مقطوع على دفعات شهرية، غير شامل الضريبة، من بداية التنفيذ وحتى الانتهاء.</td></tr> -->
    <tr><td colspan="3">8 - يلتزم الطرف الأول بدفع مبلغ {{ $project->supervision_fee ?? 0 }} درهم (  شامل الضريبة) مقابل إشراف الطرف الثاني على تنفيذ المشروع، وتدفع كمبلغ مقطوع او على دفعات شهرية من بداية التنفيذ وحتى الانتهاء، وذلك بغض النظر عن استمرار أو توقف العمل في الموقع</td></tr>

    <tr><td colspan="3">9 - يلتزم الطرف الثاني بزيارات إشرافية بمعدل أربع (4) شهريًا، قابلة للزيادة أو النقصان حسب احتياجات المشروع</td></tr>

    <tr><td colspan="3">10 - إذا وجد أي عائق من عوائق الأرض (دفان – كابل كهرباء – تعديل تحت المنسوب) فإن الطرف الأول يتحمل تسوية الموضوع.</td></tr>

    <tr><td colspan="3">11 - يلتزم المالك بدفع رسوم إضافية يحددها الاستشاري في حال طلب أي تعديل بعد بدء التنفيذ.</td></tr>

    <tr><td colspan="3">12 - يلتزم المالك بدفع رسوم إدخال الكهرباء ورسوم الإنجاز في نهاية المشروع.</td></tr>

    <tr><td colspan="3">13 - يحق للطرف الثاني (الاستشاري) نشر صور وفيديوهات المشروع.</td></tr>

    <tr>
    <td colspan="3">
        14 -  يحق للطرف الأول تغيير الطرف الثاني (الاستشاري) أثناء تنفيذ مشروع البناء، وليس قبل ذلك بأي حال من الأحوال ،و في حال الطرف الاول قرر عدم مواصلة المشروع قبل 
مرحلة التنفيذ يلتزم بدفع باقي المبالغ المستحقة و يكون المبلغ المدفوع في البند 2 نظير اعمال التصاميم المبدئية فقط مع الاحتفاظ بحقوق التصميم.
    </td>

<!-- <tr><td colspan="3">15 - زيارات إشرافية بمعدل أربع (4) شهريًا، قابلة للزيادة أو النقصان حسب احتياجات المشروع والموقع ومتطلبات المقاول.</td></tr>
<tr><td colspan="3">16 - عند توقف العمل بالموقع، لا تُستحق رسوم الإشراف إلا في حال وجود أعمال مكتبية أو تنسيقية تُعد بديلاً عن الإشراف.</td></tr> -->

    
</tr>
</table>
    

<table style="width:100%; border-collapse:collapse; margin-top:0px; margin-bottom:50px;">
    <tr>
        
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع المالك
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold;">
            توقيع وختم الاستشاري
        </td>
    </tr>

    <tr>
        

        <td class="signature" style="height:80px; border-bottom:1px solid #000;"></td>

        <td class="signature" style="height:80px; border-bottom:1px solid #000; text-align:center;">
           <img src="{{ public_path('images/signature.jpeg') }}" style="height:100px;">
        </td>
    </tr>
</table>



</body>
</html>
