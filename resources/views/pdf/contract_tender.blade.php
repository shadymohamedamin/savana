<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: 'amiri', serif;
    direction: rtl;
    text-align: right;
    font-size: 13px;
    line-height: 1.8;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #000;
    padding: 6px 8px;
}

.title {
    background-color: #e9e2c7;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
}

.group-title {
    background-color: #dcd3a8;
    font-weight: bold;
    font-size: 17px;
    text-align: center;
}

.section-title {
    background-color: #f1ead1;
    font-weight: bold;
    text-align: center;
}

.center { text-align: center; }
.bold { font-weight: bold; }

.total-row {
    background-color: #f5f5f5;
    font-weight: bold;
}
</style>
</head>

<body>

{{-- ================= معلومات المشروع ================= --}}
<table>
<tr>
    <td class="title" colspan="4">حساب الكميات</td>
</tr>
<tr>
    <td class="bold">المالك</td>
    <td>{{ $project->ownerUser?->name }}</td>
    <td class="bold">المنطقة</td>
    <td>{{ $project->projectRegion?->name_ar }}</td>
</tr>
<tr>
    <td class="bold">وصف المشروع</td>
    <td>{{ $project->projectName?->name_ar }}</td>
    <td class="bold">رقم القسيمة</td>
    <td>{{ $project->qasmia_number }}</td>
</tr>

<tr>
    <td class="bold">مساحة السور م.طولي</td>
    <td>{{ $project->area }}</td>
    <td class="bold">مساحة البناء بالقدم المربع</td>
    <td>{{ $project->linear_meter_area }}</td>
</tr>


</table>


@php $grandTotal = 0; @endphp

{{-- ================= الجروبات ================= --}}
@foreach($groups as $group)

<table>
<tr>
    <td class="group-title" colspan="6">
        {{ $group->name_ar }}
    </td>
</tr>

@php $groupTotal = 0; @endphp

@foreach($group->children as $section)

<tr>
    <td class="section-title" colspan="6">
        {{ $section->name_ar }}
    </td>
</tr>

<tr class="bold center">
    <td>البند</td>
    <td>الوحدة</td>
    <td>الكمية</td>
    <td>سعر الوحدة</td>
    <td>الإجمالي</td>
    <td>ملاحظات</td>
</tr>

@php $sectionTotal = 0; @endphp

@foreach($section->children as $item)

@php
$pivot = $item->projectOwnerRequirements->first();
$qty = $pivot->quantity ?? 0;
$price = $pivot->unit_price ?? 0;
$total = $qty * $price;
$sectionTotal += $total;
@endphp

<tr class="center">
    <td>{{ $item->name_ar }}</td>
    <td>{{ $item->unit }}</td>
    <td>{{ $qty }}</td>
    <td>{{ number_format($price,2) }}</td>
    <td>{{ number_format($total,2) }}</td>
    <td>{{ $pivot->notes ?? '' }}</td>
</tr>

@endforeach

<tr class="total-row center">
    <td colspan="4">مجموع {{ $section->name_ar }}</td>
    <td colspan="2">{{ number_format($sectionTotal,2) }}</td>
</tr>







@php
$groupTotal += $sectionTotal;
@endphp

@endforeach

<tr class="total-row center">
    <td colspan="4">إجمالي {{ $group->name_ar }}</td>
    <td colspan="2">{{ number_format($groupTotal,2) }}</td>
</tr>

</table>

@php
$grandTotal += $groupTotal;
@endphp

@endforeach







{{-- ================= بنود على المالك ================= --}}
<table>

<tr>
    <td class="group-title" colspan="10">
        رابعا: بنود على المالك
    </td>
</tr>

<tr class="bold center">
    <td>الرقم</td>
    <td>البند</td>
    <td>English</td>
    <td>الرقم</td>
    <td>البند</td>
    <td>English</td>
    <td>الوحدة</td>
    <td>الكمية</td>
    <td>السعر</td>
    <td>الإجمالي</td>
</tr>

<tr class="center">
<td>T1</td>
<td>توريد وتركيب اعمال الاكساءات الخارجية المحيطة بالفيلا والكربستون الخارجي</td>
<td>supply and install interlock and kerbstone</td>
<td>U1</td>
<td>عزل الأسقف نوعية ألتك للمتر المربع</td>
<td>Altic for ceiling by M2</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T2</td>
<td>التكييف ، ونظام Smart Home</td>
<td>AC and Smart home</td>
<td></td>
<td></td>
<td>Altic for ceiling by M2</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T3</td>
<td>الديكورات الجبسية والاسقف المستعارة</td>
<td>internal decoration and false ceiling</td>
<td>U2</td>
<td>الأسمنت بلاستر للحوائط الداخلية. للمتر المربع</td>
<td>Internal plaster by M2</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T4</td>
<td>توريد وتركيب خزائن الملابس والمطابخ</td>
<td>supply and install wardrobe and kitchen cabinet</td>
<td></td>
<td></td>
<td>Internal plaster by M2</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T5</td>
<td>الدش والانتركوم والكميرات</td>
<td>Satellite, intercom and cameras</td>
<td>U3</td>
<td>الباب المنزلق FOLDING DOOR للمتر المربع</td>
<td>slidding / folding doors by M2</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T6</td>
<td>قروفات السور</td>
<td>Grooves boundary wall</td>
<td></td>
<td></td>
<td>slidding / folding doors by M2</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T7</td>
<td>دفان قطعة الارض او تخفيض منسوبها للوصول للمنسوب التصميمي</td>
<td>Backfilling or cut and fill to reach for design level</td>
<td>U4</td>
<td>تغيير من فول امبريلا للكيرتن وول للمتر المربع</td>
<td>changing aluminum to curtain wall instead of full umbrella</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T8</td>
<td>رسوم توصيل الخدمات والدوائر الحكومية</td>
<td>government connection fees</td>
<td></td>
<td></td>
<td>changing aluminum to curtain wall instead of full umbrella</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T9</td>
<td>ضريبة القيمة المضافة</td>
<td>VAT</td>
<td>U5</td>
<td>الأعمال التمديدات حالة رغبة المالك في إضافة سمارت هوم للستاير و التكييف و لاقط حركة</td>
<td>pipes works in case of client want to add smart for curtains , AC , moving sensor</td>
<td>M3</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T10</td>
<td>الكراج و المظلات واحواض الزهور والنوافير و الحديقة</td>
<td>Garage , Car parking pergola , flower boxes , water fountains and garden</td>
<td></td>
<td></td>
<td>pipes works in case of client want to add smart for curtains , AC , moving sensor</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T11</td>
<td>المصعد "عن طريق شركة متخصصة "الاعمال المدنية على المقاول"</td>
<td>Lift with special company , civil works by main contractor</td>
<td>U6</td>
<td>الأعمال الخراسانية بسماكة 10 سم للاارضيات لتركيب البورسولان دور اول و ارضي باللاصق</td>
<td>Concrete 10 cm for porcelain for GF & 1st by glue</td>
<td>M2</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T12</td>
<td>الإنارة الداخلية "توريد وتركيب المالك "</td>
<td>internal lights ( supply and installation by client )</td>
<td></td>
<td></td>
<td>Concrete 10 cm for porcelain for GF & 1st by glue</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T13</td>
<td>الإنارة الخارجية "توريد المالك وتركيب المقاول"</td>
<td>External lights ( supply by client and installation by Contractor )</td>
<td>U7</td>
<td>تنفيذ بيتومين عازلة للجدران الخارجية في حالة تركيب للحجر الخارجي</td>
<td>bitumen painting for external elevations for stone works</td>
<td>L.M</td><td>1</td><td>1</td><td>1</td>
</tr>

<tr class="center">
<td>T14</td>
<td>اعمال الكهروميكانيكية و المكاين و التشغيل و صندوق الكهرباء للمسبح ان وجد</td>
<td>Electromechanical, pumps, operation and Electrical DB for swimming pool if any</td>
<td></td>
<td></td>
<td>bitumen painting for external elevations for stone works</td>
<td></td><td></td><td></td><td></td>
</tr>

<tr class="center">
<td>T13</td>
<td>مصاريف تخص المعاملات البنكية</td>
<td>Banks fees</td>
<td colspan="7"></td>
</tr>

<tr class="total-row center">
<td colspan="8">
إجمالي سعر اعمال خارج العقد اذا رغب المالك في اضافتها
<br>
Total pices for works out of contract if client want to add
</td>
<td colspan="2">7</td>
</tr>

</table>



<!-- {{-- ================= ملخص أسعار المشروع ================= --}}
<div style="page-break-before: always;"></div>

<table>

<tr>
    <td class="title" colspan="5">
        ملخص أسعار المشروع
    </td>
</tr>


<tr>
    <td class="group-title" colspan="5">
        أولا : اعـــــمـــــــــال الـــــهــــيكــــــل
    </td>
</tr>

<tr class="center">
    <td>المياه الجوفية و إحلال التربة وتجهز الموقع</td>
    <td>Dewatering, Soil replacement and Mobilization</td>
    <td>AED 54,000.00</td>
    <td colspan="2">AED 843,200.00</td>
</tr>

<tr class="center">
    <td>أعمال تحت منسوب الأرض</td>
    <td>Substructure Works</td>
    <td colspan="3">AED 229,390.00</td>
</tr>

<tr class="center">
    <td>أعمال فوق منسوب الأرض</td>
    <td>Super Structure Works</td>
    <td colspan="3">AED 248,200.00</td>
</tr>

<tr class="center">
    <td>إجمالي تركيب اكساءات الارضيات و الجدران</td>
    <td>Total for installing flooring and walls</td>
    <td colspan="3">AED 48,740.00</td>
</tr>

<tr class="center">
    <td>اجمالي الطابوق</td>
    <td>Total Block Works</td>
    <td colspan="3">AED 127,250.00</td>
</tr>

<tr class="center">
    <td>إجمالي البلاستر</td>
    <td>Total Plaster</td>
    <td colspan="3">AED 100,920.00</td>
</tr>

<tr class="center">
    <td>إجمالي الطبقات العازلة</td>
    <td>Total Water Proofing</td>
    <td colspan="3">AED 34,700.00</td>
</tr>


<tr>
    <td class="group-title" colspan="5">
        ثانيا : اجمالي الالكتروميكانيكال
    </td>
</tr>

<tr class="center">
    <td>Total Electromechanical</td>
    <td></td>
    <td>AED 125,500.00</td>
    <td colspan="2">AED 125,500.00</td>
</tr>


<tr>
    <td class="group-title" colspan="5">
        ثالثا : توريد التشطيبات
    </td>
</tr>

<tr class="center">
    <td>توريد اكساءات الارضيات و الجدران</td>
    <td>Flooring and Walls</td>
    <td>AED 0.00</td>
    <td colspan="2">AED 65,400.00</td>
</tr>

<tr class="center">
    <td>توريد الألمنيوم والزجاج والهاندريل</td>
    <td>Aluminum and handrail</td>
    <td colspan="3">AED 52,400.00</td>
</tr>

<tr class="center">
    <td>توريد الأبواب الخشبية توريد و تركيب</td>
    <td>Wooden door supply and installation</td>
    <td colspan="3">AED 0.00</td>
</tr>

<tr class="center">
    <td>توريد سويتشات و سوكت</td>
    <td>Switches and sockets</td>
    <td colspan="3">AED 2,200.00</td>
</tr>

<tr class="center">
    <td>توريد الأطقم الصحية</td>
    <td>Supply sanitary wares</td>
    <td colspan="3">AED 0.00</td>
</tr>

<tr class="center">
    <td>اعمال توريد الالكتروميكانيكال</td>
    <td>Supply electromechanical items</td>
    <td colspan="3">AED 10,800.00</td>
</tr>

<tr class="center">
    <td>توريد و تركيب أبواب السور و سلم الخدمات</td>
    <td>Supply and install boundary wall gates and services steel stair</td>
    <td colspan="3">AED 0.00</td>
</tr>


<tr>
    <td class="group-title" colspan="5">
        رابعا : اجمالي أعمال الوجهات
    </td>
</tr>

<tr class="center">
    <td>Total Elevations Works</td>
    <td></td>
    <td>AED 17,550.00</td>
    <td colspan="2">AED 17,550.00</td>
</tr>


<tr>
    <td class="group-title" colspan="5">
        خامسا : أعمال السور الخارجي للفيلا
    </td>
</tr>

<tr class="center">
    <td>Boundary wall works</td>
    <td></td>
    <td>AED 98,350.00</td>
    <td colspan="2">AED 98,350.00</td>
</tr>


<tr class="total-row center">
    <td colspan="3">اجمالى سعر المشروع بدون ضريبة<br>Total Project value without VAT</td>
    <td colspan="2">AED 1,150,000.00</td>
</tr>

</table> -->





{{-- ================= ملخص أسعار المشروع ================= --}}
<div style="page-break-before: always;"></div>

<table>

<tr>
    <td class="title" colspan="5">
        ملخص أسعار المشروع
    </td>
</tr>

{{-- ================= أولا ================= --}}
<tr>
    <td class="group-title" colspan="5">
        أولا : اعـــــمـــــــــال الـــــهــــيكــــــل
    </td>
</tr>

@php
function sectionTotalByName($groups,$groupName,$sectionName){
    $group = $groups->where('name_ar',$groupName)->first();
    if(!$group) return 0;

    $section = $group->children->where('name_ar',$sectionName)->first();
    if(!$section) return 0;

    $total = 0;
    foreach($section->children as $item){
        $pivot = $item->projectOwnerRequirements->first();
        $total += (($pivot->quantity ?? 0) * ($pivot->unit_price ?? 0));
    }
    return $total;
}
@endphp

<tr class="center">
<td>المياه الجوفية و إحلال التربة  وتجهز الموقع</td>
<td>Dewatering, Soil replacement and Mobilization</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','المياه الجوفية و إحلال التربة  وتجهز الموقع'),2) }}
</td>
</tr>

<tr class="center">
<td>أعمال تحت منسوب الأرض</td>
<td>Substructure Works</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','أعمال تحت منسوب الأرض'),2) }}
</td>
</tr>

<tr class="center">
<td>أعمال فوق منسوب الأرض</td>
<td>Super Structure Works</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','أعمال فوق منسوب الأرض'),2) }}
</td>
</tr>

<tr class="center">
<td>إجمالي تركيب اكساءات الارضيات و الجدران</td>
<td>Total for installing flooring and walls</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','إجمالي تركيب اكساءات الارضيات و الجدران'),2) }}
</td>
</tr>

<tr class="center">
<td>اجمالي الطابوق</td>
<td>Total Block Works</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','اجمالي الطابوق'),2) }}
</td>
</tr>

<tr class="center">
<td>إجمالي البلاستر</td>
<td>Total Plaster</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','إجمالي البلاستر'),2) }}
</td>
</tr>

<tr class="center">
<td>إجمالي الطبقات العازلة</td>
<td>Total Water Proofing</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'اعمال الهيكل','إجمالي الطبقات العازلة'),2) }}
</td>
</tr>


{{-- ================= ثانيا ================= --}}
<tr>
    <td class="group-title" colspan="5">
        ثانيا : اجمالي الالكتروميكانيكال
    </td>
</tr>

<tr class="center">
<td>اجمالي الالكتروميكانيكال</td>
<td>Total Electromechanical</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'الالكتروميكانيكال','اجمالي الالكتروميكانيكال'),2) }}
</td>
</tr>


{{-- ================= ثالثا ================= --}}
<tr>
    <td class="group-title" colspan="5">
        ثالثا : توريد التشطيبات
    </td>
</tr>

<tr class="center">
<td>توريد اكساءات الارضيات و الجدران</td>
<td>Flooring and Walls</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'توريد التشطيبات','توريد اكساءات الارضيات و الجدران'),2) }}
</td>
</tr>

<tr class="center">
<td>توريد الألمنيوم والزجاج والهاندريل</td>
<td>Aluminum and handrail</td>
<td colspan="3">
AED {{ number_format(sectionTotalByName($groups,'توريد التشطيبات','توريد الألمنيوم والزجاج والهاندريل'),2) }}
</td>
</tr>

{{-- باقي البنود بنفس الطريقة --}}


{{-- ================= الإجمالي النهائي ================= --}}
<tr class="total-row center">
<td colspan="3">
اجمالى سعر المشروع بدون ضريبة
<br>
Total Project value without VAT
</td>
<td colspan="2">
AED {{ number_format($grandTotal,2) }}
</td>
</tr>

</table>





{{-- ================= الإجمالي العام ================= --}}
<table>
<tr class="total-row center">
    <td colspan="4">الإجمالي العام للمشروع</td>
    <td colspan="2">{{ number_format($grandTotal,2) }}</td>
</tr>
</table>


{{-- ================= التوقيعات ================= --}}
<table style="margin-top:40px;">
<tr>
    <td class="section-title">المالك</td>
    <td class="section-title">الاستشاري</td>
</tr>
<tr>
    <td class="center">{{ $project->ownerUser?->name ?? 'المالك' }}</td>
    <td class="center">سافانا ديزاين للاستشارات الهندسية</td>
</tr>
</table>

</body>
</html>
