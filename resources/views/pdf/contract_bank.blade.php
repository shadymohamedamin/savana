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

        .title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }

        td,
        th {
            border: 1px solid #000;
            padding: 8px;
            vertical-align: top;
        }

        .section-title {
            background-color: #e9e2c7;
            font-weight: bold;
            text-align: center;
            font-size: 22px;
        }

        .center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .signature {
            height: 6rem;
            min-height: 6rem;
        }
    </style>
</head>

<body>

    <table>
        <tr>
            <td class="title" colspan="3" colspan="3" class="section-title">عقد الاتفاق</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                بإشرافنا نحن<br>
                سافانا ديزاين للاستشارات الهندسية والتصميم الداخلي – رأس الخيمة<br>
                مكتب 407 أبراج جلفار – رأس الخيمة<br>
                525015080
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td colspan="3" class="section-title">تم الاتفاق بين كل من</td>
        </tr>
        <tr>
            <td class="bold">الطرف الأول</td>
            <td colspan="2">{{ $project->ownerUser->name ?? 'المالك' }}</td>
        </tr>
        <tr>
            <td class="bold">الطرف الثاني</td>
            <td colspan="2">{{ $project->contractorUser->name ?? 'المقاول' }}</td>
        </tr>
        <tr>
            <td class="bold">الطرف الثالث (الاستشاري)</td>
            <td colspan="2">سافانا ديزاين للاستشارات الهندسية</td>
        </tr>
    </table>



    <table>
        <tr>
            <td colspan="3" class="section-title">المشروع</td>
        </tr>
        <tr>
            <td class="bold">وصف المشروع</td>
            <td colspan="2"> {{ $project->projectName->name_ae }}</td>
        </tr>
        <tr>
            <td class="bold">المنطقة</td>
            <td colspan="2">{{ $project->projectRegion->name_ar ?? '—' }}</td>
        </tr>
        <tr>
            <td class="bold">رقم القسيمة</td>
            <td colspan="2">{{ $project->qasmia_number ?? '—' }}</td>
        </tr>
        <tr>
            <td class="bold">سعر الفيلا مع السور (بدون الضريبة)</td>
            <td colspan="2">{{ '800,000' }}</td>
        </tr>
        @php
            use NumberToWords\NumberToWords;

            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('ar');

            $amount = 800000; // أو $project->budget
            $amountInWords = $numberTransformer->toWords($amount);
        @endphp

        <tr>
            <td colspan="3">
                يقوم الطرف الثاني بتنفيذ وانشاء وانجاز وصيانة المشروع المذكور اعلاه لقاء مبلغ وقدره
                <br><br>

                {{ number_format($amount) }} درهم
                <br>
                ( {{ $amountInWords }} درهم )

                <br><br>
                و ذلك حسب المتفق عليه والمعتمد وفق للمناقصة التي جرت
            </td>

        </tr>

    </table>


    <table>
        <tr>
            <td class="bold center section-title">توقيع وختم المقاول</td>
            <td class="bold center section-title">توقيع المالك</td>
            <td class="bold center section-title">توقيع وختم الاستشاري</td>
        </tr>
        <tr>
            <td class="signature"></td>
            <td class="signature"></td>
            <td class="signature"></td>
        </tr>
    </table>








    <table>
        <tr>
            <td colspan="3" class="section-title">بنود العقد</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                كافة مستندات المشروع و جميع متعلقاته متكاملة فيما بينها و تشمل المشروع ككل أي بحال عدم ذكر اي بند بالمواصفات او المخططات وتم ذكره بجدول الكميات او المخططات المعتمدة أو اي مستند اخر غير ذلك , والعكس صحيح على المقاول الالتزام به و العمل على تضمينه بأعمال المشروع اينما ذكر .علي المقاول ارجاع العقد موقع علي كل صفحة والمواصافات و المخططات وتوقيعه عليها يعتبر انه اطلع علي جميع تفاصيل المشروع
            </td>
        </tr>
    </table>





    <table style="width:100%; border-collapse:collapse; margin-top:90px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">1</td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                الاطلاع على جميع مخططات المشروع
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">1</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول قبل توقيع العقد الاطلاع على المخططات و المواصفات و الشروط و التأكد من تطابق جميع المخططات الانشائية والمعمارية والخدمات و المناظير 3D وتنبيه الاستشاري لأي اختلاف في تطابق المخططات وذلك لتفادي التغيير و التعديل في الموقع قبل التنفيذ و في حالة عدم تنبيه الاستشاري بوجود اختلاف قبل الشروع في العمل يتحمل المقاول كامل المسؤولية في التعديلات المطلوبة و التاخير المترتب عن ذلك و اعتبار أن توقيعه عليها يعني موافقته على جميع ما ورد بها وتعتبر المناظير المقدمة من الاستشاري في ملف المناقصة هي المعتمدة من ناحية الشكل و التشطيبات في حال اختلاف مع المخططات المعتمدة .
            </td>
        </tr>
    </table>













    <table style="width:100%; border-collapse:collapse; ">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;"></td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                إصدار التعليمات, الرسوم
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;"></td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                لا يحق للمالك اصدار اي تعليمات للمقاول تتعلق بتنفيذ المشروع الا عن طريق الاستشاري .
            </td>
        </tr>
    </table>








    <table style="width:100%; border-collapse:collapse; ">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">2</td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                مقاولي الباطن
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">2</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يجوز للطرف الثاني اسناد جزء من الاعمال الى مقاولي الباطن المعتمدين والمسجلين لدى البلدية بموجب موافقة خطية من الاستشاري
            </td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يكون المقاول مسؤول مسؤولية كاملة عن اعمال المقاول الباطن من حيث الجودة والتنفيذ واصول الصناعه والضمانات
            </td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتعهد الطرف الثاني بالتنسيق بين جميع المقاولين الباطن دون اي استثناء ودون اي احقية في المطالبة باي مبلغ اضافة نظير ذلك.
            </td>
        </tr>
    </table>




    <!-- <table>
    <tr><td colspan="3" class="section-title"> إصدار التعليمات, الرسوم  </td></tr>
    <tr><td colspan="3" class="center">
            لا يحق للمالك اصدار اي تعليمات للمقاول تتعلق بتنفيذ المشروع الا عن طريق الاستشاري       
    </td></tr>
</table>







<table style="width:100%; border-collapse:collapse; margin-top:90px;">
    <tr class="section-title">
        <td style="width:10%; text-align:center; font-weight:bold;">2</td>
        <td style="width:80%; text-align:center; font-weight:bold;">
              مقاولي الباطن
        </td>
        <td style="width:10%; text-align:center; font-weight:bold;">2</td>
    </tr>
    <tr >
        <td colspan="3" class="center">
         يجوز للطرف الثاني اسناد جزء من الاعمال الى مقاولي الباطن المعتمدين والمسجلين لدى البلدية بموجب موافقة خطية من الاستشاري
        </td>
    </tr>
    <tr >
        <td colspan="3" class="center">
        يكون المقاول مسؤول مسؤولية كاملة عن اعمال المقاول الباطن من حيث الجودة والتنفيذ واصول الصناعه والضمانات
        </td>
    </tr>
    <tr >
        <td colspan="3" class="center">
             يتعهد الطرف الثاني بالتنسيق بين جميع المقاولين الباطن دون اي استثناء ودون اي احقية في المطالبة باي مبلغ اضافة نظير ذلك.
        </td>
    </tr>
</table> -->

    <table style="width:100%; border-collapse:collapse; ">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">3</td>
            <td class="section-title" style="width:80%; text-align:center; font-weight:bold;">
                فسخ التعاقد
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">3</td>
        </tr>
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;"></td>
            <td class="section-title" style="width:80%; text-align:center; font-weight:bold;">
                يحق للمهندس الاستشاري فسخ العقد في الحالات
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;"></td>
        </tr>



        <tr>
            <td colspan="3" class="center">
                اذا تاخر المقاول عن بدء الاعمال بعد تسليم الموقع
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                اذا تاخر المقاول في اتمام العمل وتسليمه في المواعيد المحدده لكل مرحلة في الجدول الزمني المعتمد
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                اذا اظهر المقاول بطئا في سير العمل لدرجة يرى الاستشاري منها عدم قدرة الطرف الثاني على اتمام العمل في موعده على ان يقوم الاستشاري بتنبيه المقاول خطيا
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                اذا اخل المقاول ببرنامج العمل المحدد بشكل يؤثر على مستوى التنفيذ او الاخلال بالمواصفات المتفق عليها
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                اذا انسحب المقاول عن العمل او تركه او افلس
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                اذا اسند الطرف الثاني العمل لمقاول باطن دون اخطار الاستشاري
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                في حال تاخير الطرف الاول عن سداد اي من مستحقات الطرف الثاني في موعد اقصاه 30 يوم فمن حق الطرف الثاني التوقف عن العمل وذلك بعد اخطار الاستشاري خطيا وتحسب فتره التاخير على المالك لصالح المقاول كمدة اضافية للمشروع
            </td>
        </tr>

        <tr>
            <td colspan="3" class="center">
                يحق للطرف الثاني الغاء التعاقد في حالة تاخير المالك باختيار التشطيبات مما يعود بالضرر علي المقاول
            </td>
        </tr>



    </table>






    <table style="width:100%; border-collapse:collapse;">

        <!-- البند 4 -->
        <tr class="section-title" style="margin-top: 10px;">
            <td style="width:10%; text-align:center; font-weight:bold;">4</td>
            <td style="width:80%; text-align:center; font-weight:bold; " >
                الاثار المترتبة على فسخ العقد
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">4</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding:10px;">
                حساب غرامة التاخير على الطرف الثاني طبقا للعقد حتى تاريخ ابلاغ المقاول بقرار السحب.<br><br>
                يتم تنفيذ الاعمال المتبقية كلها او بعضها على حساب المقاول على ان تطرح الاعمال المتبقية في مناقصة جديدة او يعهد بتنفيذها الى احد المقاولين بطريق الممارسة مع تحميل المقاول النتائج المترتبة عن هذا الاجراء.<br><br>
                حجز اي دفعات متبقيىة للمقاول وحجز الضمانات البنكية ومحجوزات الصيانة لحين الانتهاء من المشروع (تمويل خاص فقط).
            </td>
        </tr>

        <!-- البند 5 -->
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">5</td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                حل النزاع
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">5</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding:10px;">
                اي نزاع ينشا عن تطبيق احكام هذا العقد يكون الفصل فيه اختصاص محكم يتفق عليه الطرفان او ترشحة الجهات والدوائر المختصه.
            </td>
        </tr>

        <!-- البند 6 -->
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">6</td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                محجوزات الصيانة
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">6</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding:10px;">
                يستقطع 5% من قيمة الاعمال المنفذه بالدفعات الجارية او التي يتم صرفها بمعرفة المقرض كمحجوز صيانة وذلك ضمانا لحسن تنفيذ الاعمال وبعد الاستلام الابتدائي وحصر الاعمال نهائيا يتم صرف المستحقات الختامية للاعمال بعد استقطاع ما على المقاول من التزامات وما سبق صرفه كدفعات ويصرف له الباقي بعد حجز محجوز الصيانة من قيمة الاعمال المنفذة لمدة سنة من تاريخ الاستلام الابتدائي (تمويل خاص فقط).
            </td>
        </tr>

        <!-- البند 7 -->
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">7</td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                الاستلام الابتدائي للمشروع
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">7</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding:10px;">
                يجب على المقاول اخطار الاستشاري باليوم الذي يتم فيه انهاء الاعمال على ان يكون هذا الاخطار قبل حلول هذا اليوم باسبوع على الاقل ليتم اخطار المالك والمقاول بموجب الاستلام الابتدائي يتم بحضور المقاول او مهندسه. وفي حاله عدم حضوره يقوم الاستشاري بعمله في غيابه فاذا ثبت ان الاعمال في حاله تسمح باستلامها يتم تحرير محضرا باستلام الاعمال استلاما مبدئيا في ذات اليوم, اما اذا ثبت عكس ذلك فللاستشاري الحق في عمل محضر اثبات حاله, وفي جميع الاحوال تكون المحاضر التي يحررها الاستشاري حجة على المقاول ولو لم يحضر او يوقع على المحضر، لا يقوم الاستشاري باعادة المعاينة الا اذا اخطره المقاول بموعد انهاء الاعمال وقبل اسبوع من الحلول على الاقل وفي حال وجود ملاحظات على اعمال المشروع لا تمنع من الاستلاام الابتدائي يتم استلام المشروع ويعطى المقاول سبعه ايام لانهاء تلك الملاحظات وفي حال عدم انتهائه من هذه الملاحظات يعتبر محضر الاستلام الابتدائي لاغيا.
            </td>
        </tr>

        <!-- البند 8 -->
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">8</td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                الاشراف الهندسي من قبل الاستشاري
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;">8</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:right; padding:10px;">
                يتم دفع رسوم شهرية مقابل الاشراف (700) درهم بدون الضريبة وذلك يتضمن الزيارات الاسبوعية والمتابعة بشكل عام في حال تجاوزت مدة انتهاء المشروع على المدة المتفق عليها , يتم دفع رسوم الاشراف من قبل الطرف المتسبب في التأخير ( المالك او المقاول ) في حال كان الطرفين متسببين في التأخير ف يتم دفع الرسوم المتبقية لأشراف مناصفة بين المالك والمقاول.<br><br>

                يحق للإستشاري إيقاف المقاول عن العمل في حالة عدم التقيد بتعليمات الإستشاري ويسري هذا على المقاولين الذين يحضرهم المقاول الرئيسي أو المالك.<br><br>

                الطرف الثالث غير مسؤول إذا لم ينجز المشروع بالكامل خلال مدة التنفيذ المتعاقد عليها بين الطرف الاول والمقاول.<br><br>

                في حال طلب المالك ايقاف الاشراف على المشروع وفسخ العقد بعد انتهاء مدة التنفيذ وقبل ان ينتهي انجاز المشروع بالكامل يجب ان يكون هذا الطلب خطيا قبل شهر على الاقل من انتهاء مدة التنفيذ وبعد موافقة الطرف الثالث فانه يحق للاستشاري تحصيل اتعاب اشراف ثلاثة اشهر اضافية على مدة العقد حسب ما هو مذكور في المادة السادسة عشر من هذا العقد وذلك كتعويض عن الضرر الذي يلحق بالاستشاري نتيجة فسخ العقد واخلاء الطرف.<br><br>

                في حال طلب المالك إيقاف الاشراف خلال مدة التنفيذ دون مبرر فانه من حق الاستشاري تحصيل اتعابه كاملة حسب ما هو مذكور في هذا العقد قبل اخلاء الطرف وانهاء مهمة الاستشاري وبشرط الا يترتب على هذا الطلب اي ضرر على الطرف الثاني.<br><br>

                الاستشاري غير ملزم بالاشراف على أي أعمال خارج التصميم المعماري والإنشائي (التكيف الديكور - المسابح -المصاعد- الحديقة).
            </td>
        </tr>

    </table>










    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">9</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الإستلام النهائي للمشروع</td>
            <td style="width:10%; text-align:center; font-weight:bold;">9</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                بعد انتهاء فترة ضمان الصيانة المحددة في العقد, يصدر الاستشاري شهادة الاستلام النهائي بعد معاينة المشروع شريطة ان يكون المقاول قد قام بكل ما يترتب عليه من التزامات خلال فترة الصيانة حيث لا يوجد اي عيوب في المشروع تمنع من اصدار هذه الشهادة من اجل صرف محجوز الضمان وقدره (5%) من قيمة العقد الاجمالية .ويلتزم المقاول بدفع مبلغ 2500 درهم كاتعاب للاستشاري نظير ذلك.
            </td>
        </tr>

       

        <tr class="section-title" style="padding-top:30px;">
            <td style="width:10%; text-align:center; font-weight:bold;">10</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مدة الصيانة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">10</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                علي المقاول متابعة ملاحظات المالك والاستشاري و صيانتها بعد الاستلام الابتدائي وحتي الاستلام النهائي للمشروع و في حال عدم تجاوب المقاول يحق للمالك عدم التوقيع على التسليم النهائي حتي تتم معالجة جميع الملاحظات .
                الطرف الثاني مسؤولا عن سلامة الهيكل الخرساني للمبنى المذكور اعلاه لمدة 10 سنوات (عشر سنوات) من تاريخ الاستلام الابتدائي.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">11</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الصيانة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">11</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                تبدا اعمال الصيانة للمشروع لمدة عام كامل بعد تاريخ الاستلام الابتدائي للمشروع مباشرة.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">12</td>
            <td style="width:80%; text-align:center; font-weight:bold;">انسحاب المقاول بدون سبب</td>
            <td style="width:10%; text-align:center; font-weight:bold;">12</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                اذا انسحب المقاول من العمل بالمشروع بدون سبب مقبول من الاستشاري يقوم بدفع ما قيمته 10% من العقد لصالح المالك ودفع رسوم رسو العطاء وارساء المناقصة ونسبتها (4%) من قيمة اجمالي عقد المقاولة كاملا.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">13</td>
            <td style="width:80%; text-align:center; font-weight:bold;">امتناع المالك التسليم الابتدائي</td>
            <td style="width:10%; text-align:center; font-weight:bold;">13</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة امتناع المالك عن التوقيع على محضر الاستلام الابتدائي او النهائي سيتم اخطاره بضرورة بيان السبب خلال خمسة عشر يوما من تاريخ اخطاره، فان انتهت هذه المهلة دون بيان اسباب امتناعه او ان الاسباب التي ابداها غير مقنعه من وجهة نظر الاستشاري، فانه يجوز للاستشاري استلام المبنى وتسليم المقاول كافة مستحقاته ويعتبر المبنى في حوزة المالك وتحت مسؤوليته من تاريخ الاستلام.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">14</td>
            <td style="width:80%; text-align:center; font-weight:bold;">فسخ عقد الاستشاري</td>
            <td style="width:10%; text-align:center; font-weight:bold;">14</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة رغبة المالك في فسخ العقد مع الاستشاري بعد اعتماد المخطط لدى البلدية فعليه دفع 2% من قيمة المشروع للاستشاري كتعويض وضياع فرصة و نظير اتعابه.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">15</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اتعاب الاستشاري</td>
            <td style="width:10%; text-align:center; font-weight:bold;">15</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يلتزم الطرف الثاني دفع نسبة من قيمة عقد المقاولة كاملا مقابل المخططات المعتمدة و المناقصة كذلك الامر عن أي اعمال اضافية التي تضاف الى العقد لاحقا.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">16</td>
            <td style="width:80%; text-align:center; font-weight:bold;">التاخير عن مراحل الجدول الزمني</td>
            <td style="width:10%; text-align:center; font-weight:bold;">16</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                الطرف الثاني ملزم بتقديم جدول زمني قبل توقيع العقد ويتم اعتماده من الطرف الثالث فقط ويتم تطبيق غرامة 2000 درهم للمالك في حال تأخر المقاول عن انجاز كل مرحلة على حدى في الجدول الزمني و دون سبب مقنع للتأخير.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">17</td>
            <td style="width:80%; text-align:center; font-weight:bold;">توريد مواد خارجة عن المواصفات</td>
            <td style="width:10%; text-align:center; font-weight:bold;">17</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتم تغريم الطرف الثاني 2000 درهم في حال تم تركيب اي مادة او خامة مخالفة للمواصفات المعتمدة وغير مقبولة من الاستشاري.
            </td>
        </tr>

        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">18</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اعتماد الامر التغييري</td>
            <td style="width:10%; text-align:center; font-weight:bold;">18</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حال تم العمل على المخططات المعدلة من غير تقديم الامر التغييري من قبل الطرف الثاني للاستشاري و المالك لاعتماده فإن المقاول يتحمل مسؤوليته بذلك.
            </td>
        </tr>
    </table>








    <table style="width:100%; border-collapse:collapse; margin-top:90px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;"></td>
            <td style="width:80%; text-align:center; font-weight:bold;">
                تقرير شهري
            </td>
            <td style="width:10%; text-align:center; font-weight:bold;"></td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                الطرف الثاني ملزم بتقديم تقرير شهري كتابي عن سير الاعمال في الموقع ويتم تغريمه درهم500 بحالة عدم الالتزام يدفعها للمالك او متابعة و تقرير يومي عن طريق مجموعة الواتساب الخاصة بالمشروع. </td>
        </tr>
    </table>




    <!-- Clause 20 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">20</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الدفعات الخاصة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">20</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                الدفعات الخاصة تتم عن طريق الاستشاري فقط وفي حال تم دفع المالك الدفعة مباشرة للمقاول وبدون علم الاستشاري فإن المالك يتحمل مسؤوليته بذلك.
            </td>
        </tr>
    </table>

    <!-- Clause 21 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">21</td>
            <td style="width:80%; text-align:center; font-weight:bold;">تقرير مع كل دفعة خاصة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">21</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتم تقديم تقرير مفصل من قبل المقاول عند كل دفعة يتم تقديمها ويكون التقرير شامل لكافة الأعمال المنجزة والجارية موضحة بالصور والتفاصيل اللازمة.
            </td>
        </tr>
    </table>

    <!-- Clause 22 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">22</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اختيار مواد التشطيب</td>
            <td style="width:10%; text-align:center; font-weight:bold;">22</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يجب على المالك اختيار المواصفات المتعلقة به تجنبا للتأخير ويتم ذلك بالتنسيق مع الاستشاري لكل مرحلة وبند على حدى. في حالة تأخير المالك فإن المقاول لا يتحمل أي مسؤولية.
            </td>
        </tr>
    </table>

    <!-- Clause 23 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">23</td>
            <td style="width:80%; text-align:center; font-weight:bold;">المناقصة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">23</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتم تقديم المناقصة من قبل المقاول للاستشاري بكامل تفاصيلها من حساب كميات والمخططات و3D مع ختم وتوقيع على كل ورقة أو مخطط معرفاً بالتاريخ.
            </td>
        </tr>
    </table>

    <!-- Clause 24 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">24</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الدفعه الختامية</td>
            <td style="width:10%; text-align:center; font-weight:bold;">24</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                لا يتم اعتماد الدفعة الختامية وصرفها للمقاول إلا بعد استيفاء الاتي:
                <br>- رخصة البناء الأصلية
                <br>- مفاتيح المبنى الداخلية والخارجية
                <br>- جدول الأحمال الخاص بتوصيل الكهرباء والماء
                <br>- عدم ممانعة من البلدية بتوصيل الكهرباء والماء
                <br>- خطاب ضمان الطبقات العازلة لمدة 10 سنوات
                <br>- خطاب ضمان أعمال الدهانات لمدة 3 سنوات
                <br>- خطاب ضمان خزانات المياه لمدة 3 سنوات
                <br>- خطاب ضمان الأجهزة (سخانات + مراوح شفط + المضخات) إذا كانت ضمن الأعمال المشمولة بالعقد
            </td>
        </tr>
    </table>

    <!-- Clause 25 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">25</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الالتزام بدفع الضريبة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">25</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يلتزم كل الأطراف المساهمون في هذا المشروع بمتطلبات المرسوم بقانون اتحادي رقم (08) لسنة 2018 ولائحته التنفيذية وبتطبيق ضريبة القيمة المضافة (VAT) بنسبة 5% حيث يلتزم المالك بسداد هذه النسبة للمقاول والاستشاري مع كل دفعة مستحقة.
            </td>
        </tr>
    </table>

    <!-- Clause 26 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">26</td>
            <td style="width:80%; text-align:center; font-weight:bold;">شيك الضمان</td>
            <td style="width:10%; text-align:center; font-weight:bold;">26</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول تحرير شيك ضمان باسم المالك بقيمة الدفعة الأولى يسلم لدى الاستشاري ويحفظ عنده حتى التسليم الابتدائي.
            </td>
        </tr>
    </table>

    <!-- Clause 27 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">27</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مدة التنفيذ</td>
            <td style="width:10%; text-align:center; font-weight:bold;">27</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                مدة المشروع {{$project->duration}} شهر من تاريخ أمر المباشرة أو من تاريخ إصدار شهادة منسوب الحفر.
            </td>
        </tr>
    </table>

    <!-- Clause 28 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">28</td>
            <td style="width:80%; text-align:center; font-weight:bold;">عدم التراجع عن السعر بعد توقيع العقد</td>
            <td style="width:10%; text-align:center; font-weight:bold;">28</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتحمل المقاول كامل المسؤولية عن عرض السعر المقدم بعد توقيع العقد ويعتبر مطلعاً على جميع الشروط والأحكام والمواصفات المنصوص عليها في أوراق المناقصة، وليس له الحق في التراجع أو الاعتراض عن أي بند مهما كانت الأسباب.
            </td>
        </tr>
    </table>

    <!-- Clause 29 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">29</td>
            <td style="width:80%; text-align:center; font-weight:bold;">توفير عمالة قانونية و مهندس ذو خبرة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">29</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول الالتزام بما تشمله هذه المناقصة من مواصفات فنية ومدة زمنية وكميات، كما عليه تأمين العمالة القانونية وذات الخبرة والكفاءة لتسيير العمل دون إخلال أو توقف، ومهندس ذو خبرة كافية لإنجاز العمل حسب المواصفات ويكون متواجداً بشكل دائم.
            </td>
        </tr>
    </table>



    <!-- Clause 30 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">30</td>
            <td style="width:80%; text-align:center; font-weight:bold;">تقديم مخططات تنفيذية</td>
            <td style="width:10%; text-align:center; font-weight:bold;">30</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول تقديم مخططات تنفيذية كاملة لكافة أعمال الكهروميكانيك أو مد الاستشاري بجميع الملاحظات بما يتوافق مع متطلبات الدوائر والجهات المختصة لضمان موافقتها على الأعمال قبل البدء في التنفيذ، وإلا سيتحمل المقاول تبعات التغيير والتأجيل في الموقع. ويكون التسعير على مساحات الصبيات المنفذة المعتمدة من الاستشاري.
            </td>
        </tr>
    </table>

    <!-- Clause 31 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">31</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مواد غير موصفة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">31</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول الحصول على اعتماد المالك والاستشاري للمواد غير موصفة بالمواصفات قبل التوريد، بخلاف ذلك يتحمل وحده مسؤولية مطابقتها للمواصفات. في حالة اعتماد المالك مع المقاول مباشرة وبدون الرجوع للاستشاري فإن الطرفان يتحملان المسؤولية ويقتصر دور الاستشاري على متابعة اختيارات المالك فقط دون أدنى مسؤولية.
            </td>
        </tr>
    </table>

    <!-- Clause 32 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">32</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مدة التعديل عند الاستشاري</td>
            <td style="width:10%; text-align:center; font-weight:bold;">32</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة طلب المالك للتعديل فإنه يتم احتساب المدة التي تم فيها التعديل والإرفاق للجهات المختصة، ولا يتحمل الاستشاري مدة التأخير إن كانت خارج نطاق المكتب.
            </td>
        </tr>
    </table>

    <!-- Clause 33 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">33</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اختيار المالك شركات التشطيب</td>
            <td style="width:10%; text-align:center; font-weight:bold;">33</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يحق للمالك اختيار شركات التشطيب مع اعتبار فرق السعر سواء كان بالزيادة أو بالنقصان وتشمل شركات التشطيب: (الأبواب الخشبية - الألومينيوم - الحديد الديكوري - البورسلين - الرخام - السيراميك - الأطقم الصحية).
            </td>
        </tr>
    </table>

    <!-- Clause 34 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">34</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الزيادة في الأسعار</td>
            <td style="width:10%; text-align:center; font-weight:bold;">34</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة زيادة أسعار المواد بعد التعاقد بزيادة تتخطى قيمة 10% من السعر المتعاقد عليه، يحق للمقاول التقدم بطلب لاسترداد فرق السعر بشرط أن يكون معدل سير الأعمال طبقاً للمواعيد المتفق عليها في الجدول الزمني وخلال مدة التعاقد. وفي حالة كان المقاول هو السبب في تأخير سير الأعمال إن كانت الزيادة المذكورة ناتجة عن التأخر في العمل، يتحمل المقاول كافة تكاليف هذا التأخير من حيث زيادة أسعار المواد.
            </td>
        </tr>
    </table>

    <!-- Clause 35 -->
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr class="section-title" >
            <td style="width:10%; text-align:center; font-weight:bold;">35</td>
            <td style="width:80%; text-align:center; font-weight:bold;">احتساب قيمة التعديل</td>
            <td style="width:10%; text-align:center; font-weight:bold;">35</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة قيام المالك بالتعديل في المشروع بعد التنفيذ يتم احتساب قيمة التعديل بنفس قيمة وحدة قياس البند المعدل، بشرط تقديم عرض سعر قبل البدء في أعمال التعديل وإلا لا يحق له المطالبة بأي مبالغ مالية، ويحق للاستشاري احتساب قيمة التعديل وتقديمها للمالك.
            </td>
        </tr>
    </table>

    <!-- Clause 36 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">36</td>
            <td style="width:80%; text-align:center; font-weight:bold;">رسوم التعديل</td>
            <td style="width:10%; text-align:center; font-weight:bold;">36</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة قيام المالك أو المقاول بالتقدم بطلب للاستشاري للإجراء تعديلات على التصميم كلياً، يقوم الطرف المتسبب في التعديل بسداد رسوم للاستشاري تقدر ب2000 درهم للتعديل وتشمل التعديلات في المخططات المعماري والانشائية والمناظير والخدمات بأنواعها (الصرف، الكهرباء، المياه، الاتصالات)، وفي حال كان التعديل بسيط ولا يؤثر على باقي المخططات يتم سداد رسوم 300 درهم للاستشاري. لا يسري هذا في حالة وجود تناقض بين المخططات أو بينها وبين المنظور ويجب تعديلها لتتطابق المخططات.
            </td>
        </tr>
    </table>

    <!-- Clause 38 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">38</td>
            <td style="width:80%; text-align:center; font-weight:bold;">تقديم جدول زمني</td>
            <td style="width:10%; text-align:center; font-weight:bold;">38</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتعين تقديم جدول زمني وجدول تحليل كميات وأسعار (BOQ) كشرط للتوقيع على العقد واستكمال الرخصة.
            </td>
        </tr>
    </table>

    <!-- Clause 39 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">39</td>
            <td style="width:80%; text-align:center; font-weight:bold;">في حال تعارض بين اللغتين</td>
            <td style="width:10%; text-align:center; font-weight:bold;">39</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حال تعارض في المواصفات بين اللغة العربية والإنجليزية تعتمد اللغة العربية بعد مراجعة الاستشاري.
            </td>
        </tr>
    </table>




    <!-- Clause 40 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">40</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اختلاف في البنود</td>
            <td style="width:10%; text-align:center; font-weight:bold;">40</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حال وجود اختلاف فيما بين البنود والمخططات بما يتعلق بمستندات المشروع يكون القرار الفني وتفسير الاختلاف للاستشاري دون اعتراض الطرفين.
            </td>
        </tr>
    </table>

    <!-- Clause 41 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">41</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الرسوم</td>
            <td style="width:10%; text-align:center; font-weight:bold;">41</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                كافة الرسوم الخاصة بتحليل العينات وفحصها واختبارها تحتسب جميعها على الطرف الثاني ولا يحق له طلب أي زيادة في الأسعار.
                يحق للاستشاري طلب فحص أو تحليل أي عينة لكل مرحلة على حدى من مراحل العناصر وتقع التكلفة على عاتق الطرف الثاني دون طلب أي زيادة في الأسعار.
            </td>
        </tr>
    </table>

    <!-- Clause 42 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">42</td>
            <td style="width:80%; text-align:center; font-weight:bold;">حق المالك في الاختيار</td>
            <td style="width:10%; text-align:center; font-weight:bold;">42</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                للمالك الحق في اختيار أنسب عروض أسعار، وإن لم يكن أقلها.
            </td>
        </tr>
    </table>

    <!-- Clause 43 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">43</td>
            <td style="width:80%; text-align:center; font-weight:bold;">عدم فتح المعاملة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">43</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                لن يتم فتح أي معاملة في البلدية إلا بعد استيفاء الشروط والمواصفات الفنية واعتماد الاستشاري.
            </td>
        </tr>
    </table>

    <!-- Clause 44 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">44</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اختيار المالك لشركة التكييف والديكور</td>
            <td style="width:10%; text-align:center; font-weight:bold;">44</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يجب على المالك اختيار شركة التكييف والديكور قبل البدء في الأعمال المدنية لسقف الدور الأرضي، وإلا سيتحمل تكاليف أي تعديلات ناتجة عن أعمال التكييف والديكور.
            </td>
        </tr>
    </table>

    <!-- Clause 45 -->
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">45</td>
            <td style="width:80%; text-align:center; font-weight:bold;">سوء مصنعية</td>
            <td style="width:10%; text-align:center; font-weight:bold;">45</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يحق للاستشاري خصم أو حجز قيم مالية في حالة وجود سوء صناعة أو مصنعية في تنفيذ كافة البنود، وعلى المقاول الالتزام بالمواصفات الفنية والأسس الهندسية وتعليمات الاستشاري في معالجة هذه الملاحظات الناتجة عن سوء الصناعة.
            </td>
        </tr>
    </table>

    <!-- Clause 46 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">46</td>
            <td style="width:80%; text-align:center; font-weight:bold;">شهادة الإنجاز</td>
            <td style="width:10%; text-align:center; font-weight:bold;">46</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يشترط على المقاول الاحتفاظ بالمستندات والفواتير والمواصفات الفنية المتعلقة بالمواد المطبق عليها اشتراطات المشروع، وتقديمها للاستشاري للحصول على التسليم الابتدائي وشهادة الإنجاز.
            </td>
        </tr>
    </table>

    <!-- Clause 47 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">47</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مواد من خارج الإمارة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">47</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                المقاول غير مسؤول عن توريد المواد من خارج إمارة المشروع، في هذه الحالة يبقى دوره الاستلام والتنزيل في الموقع فقط.
            </td>
        </tr>
    </table>

    <!-- Clause 48 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">48</td>
            <td style="width:80%; text-align:center; font-weight:bold;">استرجاع قيمة البند</td>
            <td style="width:10%; text-align:center; font-weight:bold;">48</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة اختيار المالك عمل رخام أو حجر أو كسر رخام أو غير ذلك بدل البلاستر والصبغ، يتم سحب بند البلاستر من المساحات المطلوبة مع استرجاع قيمته لصالح المالك.
            </td>
        </tr>
    </table>

    <!-- Clause 49 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">49</td>
            <td style="width:80%; text-align:center; font-weight:bold;">إخطار المالك</td>
            <td style="width:10%; text-align:center; font-weight:bold;">49</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                إذا حان موعد أعمال التشطيبات، على المقاول إخطار المالك كتابياً قبل شهر من استحقاقها لتوريد التشطيبات.
            </td>
        </tr>
    </table>

    <!-- Clause 50 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">50</td>
            <td style="width:80%; text-align:center; font-weight:bold;">غرامة تأخير</td>
            <td style="width:10%; text-align:center; font-weight:bold;">50</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                تطبق على المقاول غرامة تأخير قيمتها 500 درهم عن كل يوم تأخير إذا كان هو المتسبب في تأخير العمل، بحيث لا تتجاوز الغرامة 10% من قيمة عقد المقاولة، ويقوم المقاول بدفعها للمالك.
            </td>
        </tr>
    </table>

    <!-- Clause 51 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">51</td>
            <td style="width:80%; text-align:center; font-weight:bold;">توقف العمل</td>
            <td style="width:10%; text-align:center; font-weight:bold;">51</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حال توقف العمل لمدة أسبوعين بدون سبب مبرر ولم يتم إخطار المالك والاستشاري، يحق للمالك والاستشاري سحب المشروع بعد إخطار المقاول بالسحب.
            </td>
        </tr>
    </table>

    <!-- Clause 52 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">52</td>
            <td style="width:80%; text-align:center; font-weight:bold;">متابعة الاستشاري</td>
            <td style="width:10%; text-align:center; font-weight:bold;">52</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يقوم الاستشاري بتقديم تقرير مصور عن العمل كل أسبوع عن كامل تطورات المشروع والملاحظات الفنية والتنبيهات للمرحلة. لا يتحمل الاستشاري أي مسؤولية في حالة تخاذل المقاول في تنفيذ التعليمات، ولا يتحمل الاستشاري الإشراف عن الأعمال غير المذكورة في بند التعاقد.
            </td>
        </tr>
    </table>

    <!-- Clause 53 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">53</td>
            <td style="width:80%; text-align:center; font-weight:bold;">جدول الدفعات الخاصة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">53</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                تحدد دفعات المشروع في جدول مرافق للعقد يلتزم به كامل الأطراف، ويحق للمقاول احتساب نسب جزئية من بعض الأعمال.
            </td>
        </tr>
    </table>

    <!-- Clause 54 -->
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">54</td>
            <td style="width:80%; text-align:center; font-weight:bold;">إجراءات الأمن والسلامة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">54</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                إلزامية المقاول بتأمين إجراءات الأمن والسلامة للمهندسين والعمال في الموقع على مدار مدة تنفيذ المشروع، وتأمين حمام للعمالة. المقاول هو المسؤول الوحيد عن نظافة الموقع والتنسيق مع باقي مقاولي الباطن من طرفه، ويتحمل المالك مسؤولية مقاولي الباطن من طرفه فيما يخص الأمن والسلامة والتأمين وخضوعهم لقانون العمل.
            </td>
        </tr>
    </table>

    <!-- Clause 55 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">55</td>
            <td style="width:80%; text-align:center; font-weight:bold;">حماية المواد من السرقة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">55</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول توفير الحماية للمواد الموردة للمشروع والخاصة بالبنود الملزم بتنفيذها فقط، وإلا ليس له الحق لاحقاً في مطالبة المالك بأي تعويض عن السرقة أو التلف لهذه المواد.
                على المقاول تركيب كاميرا طاقة شمسية، وعلى المالك توفير الشريحة. تنتهي مسؤولية المقاولة لهذا البند بعد استخراج شهادة الإنجاز.
            </td>
        </tr>
    </table>

    <!-- Clause 56 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">56</td>
            <td style="width:80%; text-align:center; font-weight:bold;">تكامل المخططات</td>
            <td style="width:10%; text-align:center; font-weight:bold;">56</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                جميع المخططات والتقارير والفحوصات والشكل الخارجي 3D تعتبر كتلة واحدة وجزء لا يتجزأ من المشروع ويتم التسعير عليها.
            </td>
        </tr>
    </table>

    <!-- Clause 57 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">57</td>
            <td style="width:80%; text-align:center; font-weight:bold;">دراسة الشكل الخارجي</td>
            <td style="width:10%; text-align:center; font-weight:bold;">57</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول دراسة الشكل الخارجي 3D المعتمد من قبل المالك ومطابقته مع كامل المخططات وتفادي المشاكل الممكنة وتسليم المالك المشروع كما تم اعتماده بالتصميم الثلاثي الأبعاد.
            </td>
        </tr>
    </table>

    <!-- Clause 58 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">58</td>
            <td style="width:80%; text-align:center; font-weight:bold;">بايبات الصرف</td>
            <td style="width:10%; text-align:center; font-weight:bold;">58</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                منع خروج بايبات الصرف أو بايبات تصريف المطر على الواجهة الخارجية للفيلا، وسيتم توفير حلول بديلة من قبل الاستشاري، وعلى المقاول تنفيذها بدون زيادة بالسعر.
            </td>
        </tr>
    </table>

    <!-- Clause 59 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">59</td>
            <td style="width:80%; text-align:center; font-weight:bold;">سمارت هوم</td>
            <td style="width:10%; text-align:center; font-weight:bold;">59</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                الأعمال المدنية لسمارت هوم على المالك، ويجب التعاقد مع شركة سمارت قبل تنفيذ صب الأسقف.
            </td>
        </tr>
    </table>




    <!-- Clause 60 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">60</td>
            <td style="width:80%; text-align:center; font-weight:bold;">سحب بنود</td>
            <td style="width:10%; text-align:center; font-weight:bold;">60</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يحق للمالك سحب بنود التشطيب من المناقصة بشرط ألا تزيد قيمة المواد المسحوبة عن 10% من قيمة العقد الإجمالية، وفي حال زادت قيمة الأعمال المسحوبة عن 10% يحق للمقاول المطالبة بنسبة 10% ربح من البنود المسحوبة الزائدة عن نسبة 10% المسموح سحبها للمالك. في حالة السحب يكون المالك مسؤولاً عن هذه البنود وعن تنفيذها وضمانها مستقبلاً، وإذا تأخر المالك في تنفيذ هذه البنود تحسب مدة التأخير كمدة إضافية على العقد، ويقوم بدفع قيمة الإشراف للاستشاري حسب الاتفاق. البنود المسحوبة من المالك لا تؤثر على نسبة الاستشاري الأولية.
            </td>
        </tr>
    </table>

    <!-- Clause 61 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">61</td>
            <td style="width:80%; text-align:center; font-weight:bold;">دقة التسعير وحساب الكميات</td>
            <td style="width:10%; text-align:center; font-weight:bold;">61</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                جدول الكميات المقدم من الاستشاري للتسعير ليس استرشادي، وعلى المقاول حساب الكميات بشكل دقيق، وأي كمية تفوق 5% من حق المالك استرجاعها، وإن حسب المقاول بالناقص يتحمل هو الفرق.
            </td>
        </tr>
    </table>

    <!-- Clause 62 -->
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">62</td>
            <td style="width:80%; text-align:center; font-weight:bold;">السخان المركزي</td>
            <td style="width:10%; text-align:center; font-weight:bold;">62</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                السخان المركزي LINE 3 الخط الراجع من ضمن العقد الحالي وليس خارج العقد، وطريقة التمديد حسب تعليمات الاستشاري.
            </td>
        </tr>
    </table>

    <!-- Clause 63 -->
    <table style="width:100%; border-collapse:collapse; margin-top:10px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">63</td>
            <td style="width:80%; text-align:center; font-weight:bold;">دفعة مقدمة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">63</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يجب على المقاول البدء بالأعمال على أساس وجود دفعة مقدمة لا تقل عن 15% من قيمة التعاقد (بدون ضمانات بنكية)، تدفع للمقاول من المالك أو الجهة الممولة، ولا يسري أو يستمر التعاقد بدونها.
            </td>
        </tr>
    </table>

    <!-- Clause 64 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">64</td>
            <td style="width:80%; text-align:center; font-weight:bold;">تأخر دفعات البنك</td>
            <td style="width:10%; text-align:center; font-weight:bold;">64</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                إذا تأخرت دفعات البنك أكثر من 15 يومًا سيتم إضافة المدة على المدة الزمنية الإجمالية المتفق عليها، والمصاريف البنكية على المالك في جميع المراحل.
            </td>
        </tr>
    </table>

    <!-- Clause 65 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">65</td>
            <td style="width:80%; text-align:center; font-weight:bold;">أعمال من ضمن العقد</td>
            <td style="width:10%; text-align:center; font-weight:bold;">65</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                يتم تنفيذ أعمال النعلة المخفية، السخان المركزي، الشفاط المركزي، كراسي الحمامات المعلقة، وتجويفات جدران الحمامات من قبل المقاول ضمن العقد.
            </td>
        </tr>
    </table>

    <!-- Clause 66 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">66</td>
            <td style="width:80%; text-align:center; font-weight:bold;">ضمان الهيكل</td>
            <td style="width:10%; text-align:center; font-weight:bold;">66</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                المقاول هو المسؤول الوحيد عن هيكل المبنى، وضمان الهيكل لمدة 30 سنة.
            </td>
        </tr>
    </table>

    <!-- Clause 67 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">67</td>
            <td style="width:80%; text-align:center; font-weight:bold;">إلغاء طرف من أطراف السور</td>
            <td style="width:10%; text-align:center; font-weight:bold;">67</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حال عدم تنفيذ طرف من أطراف السور، يكون سعر التخفيض نسبة وتناسب من إجمالي السعر المتفق عليه للسور.
            </td>
        </tr>
    </table>

    <!-- Clause 68 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">68</td>
            <td style="width:80%; text-align:center; font-weight:bold;">التدقيق من قبل الاستشاري</td>
            <td style="width:10%; text-align:center; font-weight:bold;">68</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                لا يسمح بتغطية أي عمل أو مادة قبل تدقيقها وفحصها من الاستشاري وموافقته عليها، ويتحمل المقاول مسؤولية وتكاليف توفير الإمكانات لفحص وقياس أي عمل قبل تغطيته.
            </td>
        </tr>
    </table>

    <!-- Clause 69 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">69</td>
            <td style="width:80%; text-align:center; font-weight:bold;">التربة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">69</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                سعر التعاقد لا يتضمن الحفر في التربة الصخرية ولا يشمل أعمال الشورينغ إذا تطلب الأمر ولا نزح المياه، ولا يتضمن الترفيع أو التنزيل من منسوب الأرض، ولا يتضمن دفان المحيط بالفيلا وخارج القسيمة.
            </td>
        </tr>
    </table>

    <!-- Clause 70 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">70</td>
            <td style="width:80%; text-align:center; font-weight:bold;">المناقصة</td>
            <td style="width:10%; text-align:center; font-weight:bold;">70</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول إرجاع جميع مستندات المناقصة موقعة في كل صفحة وتوقيعه عليها بمثابة اعتماده وموافقته على كل البنود، وأي وثيقة لا يتم إرجاعها تعتبر تسعيرة المقاول ملغية.
            </td>
        </tr>
    </table>

    <!-- Clause 71 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">71</td>
            <td style="width:80%; text-align:center; font-weight:bold;">اعتماد المالك</td>
            <td style="width:10%; text-align:center; font-weight:bold;">71</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                أي تغيير يتم الاتفاق عليه بين المقاول والاستشاري لا يصبح نافذاً إلا بعد توقيعه خطياً من المالك أو ممثله.
            </td>
        </tr>
    </table>

    <!-- Clause 72 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">72</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مساحات المشروع</td>
            <td style="width:10%; text-align:center; font-weight:bold;">72</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول تسعير المشروع بالمساحات المعتمدة من الاستشاري وهي مساحات الصبيات المنفذة، وعدم حساب فراغ الصبيات وديكورات الواجهة من ضمن الصبيات.
            </td>
        </tr>
    </table>

    <!-- Clause 73 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">73</td>
            <td style="width:80%; text-align:center; font-weight:bold;">مرجعية العمل</td>
            <td style="width:10%; text-align:center; font-weight:bold;">73</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                الاستشاري هو الطرف الوحيد الذي يحدد أصول المصنعية وهامش السماح فيها، وعلى المقاول تطبيق تعليمات الاستشاري حتى لو أدى الأمر إلى تكسير بعض الأجزاء.
            </td>
        </tr>
    </table>

    <!-- Clause 74 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">74</td>
            <td style="width:80%; text-align:center; font-weight:bold;">شركة الكهروميكانيكية</td>
            <td style="width:10%; text-align:center; font-weight:bold;">74</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول عند تقديم المناقصة أو عند اختيار شركة MEP اعتمادها من قبل الاستشاري أولاً.
            </td>
        </tr>
    </table>

    <!-- Clause 75 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">75</td>
            <td style="width:80%; text-align:center; font-weight:bold;">المالك مقاول</td>
            <td style="width:10%; text-align:center; font-weight:bold;">75</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                في حالة المالك يكون هو المقاول، تدفع نسبة الاستشاري كاملة قبل البدء في المشروع.
            </td>
        </tr>
    </table>

    <!-- Clause 76 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">76</td>
            <td style="width:80%; text-align:center; font-weight:bold;">حقوق التصميم</td>
            <td style="width:10%; text-align:center; font-weight:bold;">76</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                حقوق التصميم فقط لمكتب سافانا للاستشارات الهندسية، ولا يجوز لأي شخص تسجيلها باسمه أو النسخ عليها.
            </td>
        </tr>
    </table>

    <!-- Clause 77 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">77</td>
            <td style="width:80%; text-align:center; font-weight:bold;">الإشراف الأسبوعي</td>
            <td style="width:10%; text-align:center; font-weight:bold;">77</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على الاستشاري زيارة الموقع بمعدل مرة كل أسبوع حسب تقدم الأشغال، ولا يتحمل الاستشاري ما ينفذه المقاول في الفترة بين الزيارتين بالرغم من تنبيهات الاستشاري، وعلى المقاول تكسير أو معالجة الأخطاء.
            </td>
        </tr>
    </table>

    <!-- Clause 78 -->
    <table style="width:100%; border-collapse:collapse; margin-top:20px;">
        <tr class="section-title">
            <td style="width:10%; text-align:center; font-weight:bold;">78</td>
            <td style="width:80%; text-align:center; font-weight:bold;">استلام المستندات</td>
            <td style="width:10%; text-align:center; font-weight:bold;">78</td>
        </tr>
        <tr>
            <td colspan="3" class="center">
                على المقاول إعادة كافة المستندات المرسلة إليه من المكتب (مثل الكميات، التسعير، العقد، المخططات، عرض السعر) موقعة ومختومة من الشركة المتقدمة للمناقصة حسب الأصول. ويعتبر المقاول مستبعداً من المناقصة تلقائياً عند وجود أي نقص أو تحوير في المستندات، ما عدا البيانات التي يحق له تعديلها (بيانات الشركة، الكميات، التسعير).
            </td>
        </tr>
    </table>

    <!-- Clause 79 -->
    <!-- Agreement Header -->
<table style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:70px;">
    <tr>
        <td colspan="3" class="section-title" style="text-align:center; font-weight:bold; font-size:16px;">
            تم الاتفاق بين كل من
        </td>
    </tr>
    <tr>
        <td class="bold" style="width:20%; font-weight:bold; padding:5px;">الطرف الأول</td>
        <td colspan="2" style="width:80%; padding:5px;">
            {{ $project->ownerUser->name ?? 'المالك' }}
        </td>
    </tr>
    <tr>
        <td class="bold" style="font-weight:bold; padding:5px;">الطرف الثاني</td>
        <td colspan="2" style="padding:5px;">
            {{ $project->contractorUser->name ?? 'المقاول' }}
        </td>
    </tr>
    <tr>
        <td class="bold" style="font-weight:bold; padding:5px;">الطرف الثالث (الاستشاري)</td>
        <td colspan="2" style="padding:5px;">
            سافانا ديزاين للاستشارات الهندسية
        </td>
    </tr>
</table>

<!-- Signatures -->

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
           <img src="{{ public_path('images/signature.jpeg') }}" style="height:60px;">
        </td>
    </tr>
</table>











</body>

</html>











<!-- <table style="width:100%; border-collapse:collapse; margin-top:90px;">
    <tr class="section-title">
        <td style="width:10%; text-align:center; font-weight:bold;">1</td>
        <td style="width:80%; text-align:center; font-weight:bold;">
            الاطلاع على جميع مخططات المشروع
        </td>
        <td style="width:10%; text-align:center; font-weight:bold;">1</td>
    </tr>
    <tr >
        <td colspan="3" class="center">
            على المقاول قبل توقيع العقد الاطلاع على المخططات و المواصفات و الشروط  و التأكد من تطابق جميع المخططات الانشائية والمعمارية والخدمات و المناظير 3D وتنبيه الاستشاري لأي اختلاف في تطابق المخططات وذلك لتفادي التغيير و التعديل في الموقع  قبل التنفيذ و في حالة عدم تنبيه الاستشاري بوجود اختلاف قبل الشروع في العمل يتحمل المقاول كامل المسؤولية في التعديلات المطلوبة و التاخير المترتب عن ذلك   و اعتبار أن توقيعه عليها يعني موافقته على جميع ما ورد بها  وتعتبر المناظير المقدمة من الاستشاري في ملف المناقصة  هي المعتمدة من ناحية الشكل و التشطيبات  في حال اختلاف مع المخططات المعتمدة  .
        </td>
    </tr>
</table> -->