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
            margin-bottom: 5px;
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








<table>
        <tr>
            <td class="title" colspan="3" colspan="3" class="section-title">{{$title}}</td>
        </tr>
        <tr>
            <!-- <td colspan="3" class="center">
                بإشرافنا نحن<br>
                سافانا ديزاين للاستشارات الهندسية والتصميم الداخلي – رأس الخيمة<br>
                مكتب 407 أبراج جلفار – رأس الخيمة<br>
                525015080
            </td> -->
        </tr>
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
            <td class="bold">الطرف الثاني(المقاول)</td>
            <td colspan="2">{{ $project->contractorUser?->name ?? 'المقاول' }}</td>
        </tr>
        <tr>
            <td class="bold">الطرف الثالث (الاستشاري)</td>
            <!-- <td colspan="2">سافانا ديزاين للاستشارات الهندسية</td> -->
             <td colspan="2">  زين العمارة للاستشارات الهندسية </td>
        </tr>
    </table>



    <table>
        <tr>
            <td colspan="3" class="section-title">المشروع</td>
        </tr>
        <tr>
            <td class="bold">وصف المشروع</td>
            <td colspan="2"> {{ $project->projectName?->name_ar }}</td>
        </tr>

        <tr>
            <td class="bold"> مدة العقد الاساسي بالاشهر </td>
            <td colspan="2"> {{ $project->bank_contract_duration }}</td>
        </tr>

        
        <tr>
            <td class="bold">المنطقة</td>
            <td colspan="2">{{ $project->projectRegion?->name_ar ?? '—' }}</td>
        </tr>
        <tr>
            <td class="bold">رقم القسيمة</td>
            <td colspan="2">{{ $project->qasmia_number ?? '—' }}</td>
        </tr>
        <tr>
            <td class="bold">سعر الفيلا مع السور شامل الضريبة</td>
            <td colspan="2">
    {{
        (!empty($isHawya) && $isHawya)
            ? $project->container_contract_value
            : ($isBank
                ? '800,000'
                : number_format($project->bank_contract_value))
    }} درهم
</td>
</tr>

 @if(!empty($approvalCreatedAt)&&$approvalCreatedAt)
        <tr>
            <td class="bold"> تاريخ  الدفعة</td>
            <td colspan="2">{{ $approvalCreatedAt?->format('Y-m-d')??'-' }}</td>
        </tr>
@endif
        <tr>
            <td class="bold"> تاريخ توقيع العقد</td>
            <td colspan="2">{{ $project->contract_signed_at?->format('Y-m-d')??'-' }}</td>
        </tr>

        

        

       
        @php
            use NumberToWords\NumberToWords;

            $numberToWords = new NumberToWords();
            $numberTransformer = $numberToWords->getNumberTransformer('ar');

            $amount = $isBank?800000:$project->bank_contract_value; // أو $project->budget
            $amountInWords = $numberTransformer->toWords((int) ($amount ?? 0));
        @endphp

        <tr>
            
            @if(!empty($isHawya)&&$isHawya)
                <td colspan="3">
                    
            يلتزم الطرف الثاني (المقاول) بتنفيذ المشروع المذكور أعلاه وفق المخططات
            وبنود التعاقد وتعليمات الإستشاري. ويكون الإستشاري مفوضاً من قبل المالك
            للإشراف الكامل على التنفيذ، ويلتزم المقاول بتنفيذ كافة تعليماته
            والرجوع إليه في جميع الاستفسارات الفنية والتنفيذية.
            وقد تم هذا الاتفاق برضا وقبول جميع الأطراف.
                </td>
            @elseif(!empty($isSiteDelivery)&&$isSiteDelivery)
                <td colspan="3" class="intro-text" style="margin-top:3rem;">
                    
                    
                        انه في يوم <strong>{{ $dayName }}</strong> الموافق
                        <strong>{{ $dateFormatted }}</strong>
                        تم تسليم الموقع المذكور ادناه الى المقاول خالياً من العوائق وصالحاً للبناء فيه،
                        ويبدأ احتساب مدة التنفيذ من يوم    تسليم الموقع شاملة فترة التحضير.

                     يقوم الطرف الثاني بتنفيذ وانشاء وانجاز وصيانة المشروع المذكور اعلاه لقاء مبلغ وقدره
           

                {{ number_format($amount) }} درهم
      
                ( {{ $amountInWords }} درهم )

          
                و ذلك حسب المتفق عليه والمعتمد وفق للمناقصة التي جرت
                </td>
            @else
            <td colspan="3">
                يقوم الطرف الثاني بتنفيذ وانشاء وانجاز وصيانة المشروع المذكور اعلاه لقاء مبلغ وقدره
                <br><br>

                {{ number_format($amount) }} درهم
                <br>
                ( {{ $amountInWords }} درهم )

                <br><br>
                و ذلك حسب المتفق عليه والمعتمد وفق للمناقصة التي جرت
            </td>
            @endif

        </tr>

    </table>





<table style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:50px; table-layout: fixed;">
    <tr>
        @if($showContractor ?? false)
            <td class="bold center section-title" style="text-align:center; font-weight:bold; width:33%;">
                توقيع وختم المقاول
            </td>
        @endif
        <td class="bold center section-title" style="text-align:center; font-weight:bold; width:33%;">
            توقيع المالك
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold; width:33%;">
            توقيع وختم الاستشاري
        </td>
    </tr>

    <tr>
        @if($showContractor ?? false)
            <td class="signature" style="height:80px; border-bottom:1px solid #000; width:33%;"></td>
        @endif
        <td class="signature" style="height:80px; border-bottom:1px solid #000; width:33%;"></td>

        <td class="signature" style="height:80px; border-bottom:1px solid #000; text-align:center; width:33%;">
           <!-- <img src="{{ public_path('images/signature.jpeg') }}" style="height:150px;"> -->
        </td>
    </tr>
</table> 
