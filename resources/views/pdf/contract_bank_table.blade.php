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
            margin-bottom: 15px;
        }

        td, th {
            border: 1px solid #000;
            padding: 5px;
            vertical-align: top;
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
            font-size: 15px;
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
Carbon::setLocale('ar');
$today = Carbon::now();
$dayName = $today->translatedFormat('l');
$dateFormatted = $today->translatedFormat('d/m/Y');
@endphp

<table style="width:100%; border-collapse: collapse;">
    <tr>
        <td class="title" colspan="8" style="text-align:center; font-weight:bold; font-size:20px;">
            قائمة الكميات
        </td>
    </tr>
    <tr>
        <td colspan="8" style="padding:8px;">
            مشروع السيد: <strong>{{ $project->ownerUser->name ?? '—' }}</strong> |
            الموقع: <strong>{{ $project->area ?? '—' }} - {{ $project->qasmia_number ?? '—' }}</strong> |
            التاريخ: <strong>{{ $project->start_date->format('d/m/Y') }}</strong>
        </td>
    </tr>
</table>

<table style="width:100%; border-collapse: collapse; margin-top:5px;">
    <thead>
        <tr>
            <th>م</th>
            <th>البند</th>
            <th>الوحدة</th>
            <th>الكمية</th>
            <th>السعر</th>
            <th>الإجمالي</th>
            <th>ملاحظات</th>
        </tr>
    </thead>
    <tbody>
        {{-- بداية البنود --}}
        <tr><td colspan="7" class="section-title">1 - الأعمال التحضيرية</td></tr>
        <tr><td>1.1</td><td>السور المؤقت</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.2</td><td>اللوحة الخارجية (بيانات المشروع)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.3</td><td>إزالة مباني قديمة (إن وجدت)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.4</td><td>مكتب الموقع (الإشراف) حسب المواصفات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.5</td><td>الخدمات المؤقتة (كهرباء، ماء، الخ)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.6</td><td>أعمال فحص التربة (حسب المواصفات)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.7</td><td>الاختبارات واعتماد المواد حسب المواصفات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.8</td><td>المخططات التنفيذية لأعمال الخدمات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.9</td><td>المخططات الواقعية بعد التنفيذ</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
        <tr><td>1.10</td><td>تنسيق وتنظيف الموقع بعد نهاية العمل</td><td>مقطوع</td><td>1</td><td></td><td>40,000</td><td></td></tr>

        <tr><td colspan="7" class="section-title">2 - أعمال الحفر والخرسانة أسفل منسوب الدور الأرضي</td></tr>
        <tr><td>2.1</td><td>الحفر</td><td>م3</td><td>100</td><td>15</td><td>1,500</td><td></td></tr>
        <tr><td>2.2</td><td>الردم</td><td>م3</td><td>100</td><td>21</td><td>2,100</td><td></td></tr>
        <tr><td>2.3</td><td>الخرسانة العادية للفيلا والدرج الخارجي والرامب</td><td>م3</td><td>25</td><td>1,000</td><td>25,000</td><td></td></tr>
        <tr><td>2.4</td><td>القواعد المسلحة للفيلا والدرج الخارجي</td><td>م3</td><td>15</td><td>1,500</td><td>22,500</td><td></td></tr>
        <tr><td>2.5</td><td>الجسور الأرضية السفلى للفيلا</td><td>م3</td><td>20</td><td>1,000</td><td>20,000</td><td></td></tr>
        <tr><td>2.6</td><td>خرسانة مسلحة لزوم الأرضيات</td><td>م3</td><td>37</td><td>870</td><td>32,190</td><td></td></tr>
        <tr><td>2.7</td><td>طابوق 20 سم مصمت</td><td>م2</td><td>60</td><td>75</td><td>4,500</td><td></td></tr>
        <tr><td>2.8</td><td>رش المبيدات ضد النمل الأبيض</td><td>م2</td><td>250</td><td>10</td><td>2,500</td><td></td></tr>

        <tr><td colspan="7" class="section-title">3 - أعمال الخرسانة للدور الأرضي وما فوق</td></tr>
        <tr><td>3.1</td><td>الأعمدة</td><td>م3</td><td>15</td><td>1,200</td><td>18,000</td><td></td></tr>
        <tr><td>3.2</td><td>الجسور أو الكمرات</td><td>م3</td><td>25</td><td>1,200</td><td>30,000</td><td></td></tr>
        <tr><td>3.3</td><td>الأسقف</td><td>م3</td><td>100</td><td>1,000</td><td>100,000</td><td></td></tr>
        <tr><td>3.4</td><td>الدرج</td><td>م3</td><td>10</td><td>900</td><td>9,000</td><td></td></tr>
        <tr><td>3.5</td><td>أدراج خارجية</td><td>م3</td><td>5</td><td>600</td><td>3,000</td><td></td></tr>
        <tr><td>3.6</td><td>خرسانات الباربيت</td><td>م3</td><td>5</td><td>600</td><td>3,000</td><td></td></tr>
        <tr><td>3.7</td><td>خرسانات لقواعد الخزانات والتكييف</td><td>مقطوع</td><td>1</td><td>5,950</td><td>5,950</td><td></td></tr>
        <tr><td>3.8</td><td>خرسانات ديكور الأرشات والعتب</td><td>مقطوع</td><td>1</td><td>5,950</td><td>5,950</td><td></td></tr>










        {{-- استكمال البنود --}}

<tr><td colspan="7" class="section-title">4 - أعمال الطابوق</td></tr>
<tr><td>4.1</td><td>طابوق 20 سم مفرغ</td><td>م3</td><td>500</td><td>60</td><td>30,000</td><td></td></tr>
<tr><td>4.2</td><td>طابوق 20 سم معزول</td><td>م4</td><td>300</td><td>55</td><td>16,500</td><td></td></tr>
<tr><td>4.3</td><td>طابوق 10 سم مفرغ</td><td>م5</td><td>25</td><td>60</td><td>1,500</td><td></td></tr>

<tr><td colspan="7" class="section-title">5 - أعمال العزل</td></tr>
<tr><td>5.1</td><td>الأساسات</td><td>مقطوع</td><td>1</td><td>7,500</td><td>7,500</td><td></td></tr>
<tr><td>5.2</td><td>الحمامات والتواليتات</td><td>م2</td><td>25</td><td>60</td><td>1,500</td><td></td></tr>
<tr><td>5.3</td><td>نعلات الحمامات والتواليتات والمطابخ</td><td>م ط</td><td>20</td><td>50</td><td>1,000</td><td></td></tr>
<tr><td>5.4</td><td>الأسطح</td><td>م2</td><td>200</td><td>120</td><td>24,000</td><td></td></tr>
<tr><td>5.5</td><td>نعلات عند حواف الأسطح</td><td>م ط</td><td>200</td><td>30</td><td>6,000</td><td></td></tr>

<tr><td colspan="7" class="section-title">6 - أعمال التشطيب</td></tr>
<tr><td colspan="7" class="bold">أولاً: التشطيبات الداخلية</td></tr>
<tr><td>6.1</td><td>جميع أرضيات الفيلا سيراميك</td><td>م2</td><td>250</td><td>70</td><td>17,500</td><td></td></tr>
<tr><td>6.2</td><td>أرضيات رخام لبسطات الدرج الداخلي</td><td>م2</td><td>13</td><td>150</td><td>1,950</td><td></td></tr>
<tr><td>6.3</td><td>درجات قائمة ونايمة رخام للدرج الداخلي</td><td>م ط</td><td>500</td><td>60</td><td>30,000</td><td></td></tr>
<tr><td>6.4</td><td>البراطيش</td><td>م ط</td><td>21.2</td><td>40</td><td>850</td><td></td></tr>
<tr><td>6.5</td><td>نعلات جميع أرضيات الفيلا</td><td>م ط</td><td>100</td><td>20</td><td>2,000</td><td></td></tr>
<tr><td>6.6</td><td>نعلات الأدراج الداخلية للرخام</td><td>م ط</td><td>20</td><td>60</td><td>1,200</td><td></td></tr>
<tr><td>6.7</td><td>نعلات الأدراج الخارجية غرانيت</td><td>م ط</td><td>10</td><td>50</td><td>500</td><td></td></tr>
<tr><td>6.8</td><td>بلاستر داخلي للجدران</td><td>م2</td><td>500</td><td>35</td><td>17,500</td><td></td></tr>
<tr><td>6.9</td><td>صبغ الجدران الداخلية</td><td>م2</td><td>500</td><td>25</td><td>12,500</td><td></td></tr>
<tr><td>6.10</td><td>سيراميك للحمامات والمطابخ والمغاسل</td><td>م2</td><td>100</td><td>40</td><td>4,000</td><td></td></tr>
<tr><td>6.11</td><td>بلاستر الأسقف (برايمر + صبغ)</td><td>م2</td><td>200</td><td>25</td><td>5,000</td><td></td></tr>
<tr><td>6.12</td><td>الأسقف المستعارة جبس بورد لتغطية دكتات التكييف</td><td>م2</td><td>25</td><td>40</td><td>1,000</td><td></td></tr>

<tr><td colspan="7" class="bold">ثانياً: التشطيبات الخارجية</td></tr>
<tr><td>6.13</td><td>واجهات الفيلا (المحارة - البلاستر) مع صبغ</td><td>م2</td><td>450</td><td>60</td><td>27,000</td><td></td></tr>

<tr><td colspan="7" class="section-title">7 - أعمال النجارة</td></tr>
<tr><td>7.1</td><td>أبواب نموذج D1</td><td>مقطوعة</td><td>1</td><td>30,000</td><td>30,000</td><td></td></tr>

<tr><td colspan="7" class="section-title">8 - أعمال الألمنيوم والزجاج</td></tr>
<tr><td>8.1</td><td>أعمال الألمنيوم</td><td>مقطوعة</td><td>1</td><td>40,000</td><td>40,000</td><td></td></tr>

<tr><td colspan="7" class="section-title">9 - أعمال الكهرباء</td></tr>
<tr><td>9.1</td><td>المواسير</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.2</td><td>الأسلاك</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.3</td><td>علب المفاتيح والخارج</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.4</td><td>المفاتيح</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.5</td><td>سوكتات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.6</td><td>لوحات التوزيع الكهربائية</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.7</td><td>مراوح الشفط</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.8</td><td>معلقات الإنارة للسور</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.9</td><td>معلقات الإنارة للمطابخ والحمامات والمغاسل</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.10</td><td>معلقات الإنارة الخارجية للفيلا والسور</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.11</td><td>معقلات الإنارة الداخلية (نجف، ثريات)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.12</td><td>سخانات الفيلا جميع الحمامات 6 جالون والمطابخ 8 جالون</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.13</td><td>انتركوم</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.14</td><td>الجرس</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.15</td><td>نظام إطفاء الحريق</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.16</td><td>الايزوليتير</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.17</td><td>الكاميرات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.18</td><td>رسوم توصيل الكهرباء بما فيها العدادات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.19</td><td>أجهزة تقوية الوا فاي</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.20</td><td>أنظمة الصوت</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>9.21</td><td>رسوم توصيل التلفونات والاتصالات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>

<tr><td colspan="7" class="section-title">10 - أعمال الصحية</td></tr>
<tr><td>10.1</td><td>توصيلات المياه</td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>10.2</td><td>الأنابيب (المواسير) وقطع التوصيل الخارجية</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.3</td><td>الأنابيب (المواسير) وقطع التوصيل الداخلية</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.4</td><td>الخلاطات واكسسوارات الحمامات والتواليتات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.5</td><td>المضخات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.6</td><td>خزانات المياه العلوية</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.7</td><td>رسوم توصيل الخدمة (المياه)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.8</td><td>الصرف</td><td></td><td></td><td></td><td></td><td></td></tr>
<tr><td>10.9</td><td>الأنابيب (المواسير) والقطع الخاصة - خارجية</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.10</td><td>الأنابيب (المواسير) والقطع الخاصة - داخلية</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.11</td><td>جميع أطقم حمامات غرف النوم وغرفة الطعام</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.12</td><td>الجلى تراب والمنهولات</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>
<tr><td>10.13</td><td>رسوم توصيل الخدمة (الصرف)</td><td>مقطوع</td><td>1</td><td></td><td></td><td></td></tr>

<tr><td colspan="7" class="section-title">11 - الأعمال الخارجية</td></tr>
<tr><td>11.1</td><td>أعمال السور الخارجي</td><td>م ط</td><td>1</td><td>90,000</td><td>90,000</td><td></td></tr>

<tr><td colspan="7" class="bold center">إجمالي قيمة المقاولة الكلي: 800,000</td></tr>

        {{-- يمكنك متابعة إدراج كل البنود 4، 5، 6، 7، 8، 9، 10، 11 بنفس الشكل كما أرسلتها تمامًا --}}
        {{-- نظراً لطولها الكبير، يمكن أن نضعها في loop أو ننسخها بالكامل بنفس الطريقة أعلاه --}}
    </tbody>
</table>


























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


{{-- <table class="signature-table">
    <tr>
        <td class="signature-header">توقيع المقاول</td>
        <td class="signature-header">توقيع المالك</td>
        <td class="signature-header">توقيع الاستشاري</td>
    </tr>
    <tr>
        <td class="signature-space">{{ $project->contractorUser->name ?? 'المقاول' }}</td>
        <td class="signature-space">{{ $project->ownerUser->name ?? 'المالك' }}</td>
        <td class="signature-space">سافانا ديزاين للاستشارات الهندسية</td>
    </tr>
</table> --}}






<p style="margin-top:15px;">تاريخ: {{ $dateFormatted }}</p>

</body>
</html>
