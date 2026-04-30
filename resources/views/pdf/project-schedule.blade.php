<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>







        body {
            font-family: 'amiri', serif;
            direction: rtl;
            text-align: right;
            font-size: 11px;
            line-height: 1.9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px;
        }

        td, th {
            border: 1px solid #000;
            padding: 1px;
            vertical-align: top;
        }

        .title {
            background-color: #e9e2c7;
            font-size: 18px;
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
        padding: 5px;
        font-size: 16px;
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
  








/* ================= BASE ================= */
body {
    font-family: 'amiri', serif;
    direction: rtl;
    text-align: right;
    font-size: 16px;
    line-height: 2;
    color: #000;
}

/* ================= HEADER ================= */
.title {
    background-color: #e9e2c7;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    padding: 4px;
    margin-bottom: 2px;
}

.sub-header {
    text-align: center;
    margin-bottom: 5px;
    font-size: 13px;
}

/* ================= TABLE ================= */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}

th, td {
    border: 1px solid #000;
    padding: 4px;
    vertical-align: middle;
    text-align: center;
}

th {
    background-color: #f3f0e4;
    font-weight: bold;
}

/* ================= TOTAL ROW ================= */
.total-row {
    font-weight: bold;
    background: #eee;
}

/* ================= SIGNATURE ================= */
.signature-table td {
    height: 15px;
    vertical-align: bottom;
}

.signature-title {
    font-weight: bold;
    background-color: #e9e2c7;
}









.payments-table {
    width: 100%;
    table-layout: fixed;
}

.payments-table th,
.payments-table td {
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}



.payments-table th:nth-child(1),
.payments-table td:nth-child(1) {
    width: 4%;
}

.payments-table th:nth-child(2),
.payments-table td:nth-child(2) {
    width: 45%;
    text-align: right;
}

.payments-table th:nth-child(3),
.payments-table td:nth-child(3),
.payments-table th:nth-child(4),
.payments-table td:nth-child(4),
.payments-table th:nth-child(5),
.payments-table td:nth-child(5) {
    width: 6%;
}

.payments-table th:nth-child(6),
.payments-table td:nth-child(6) {
    width: 12%;
}

.payments-table th:nth-child(7),
.payments-table td:nth-child(7) {
    width: 5%;
}

.payments-table th:nth-child(8),
.payments-table td:nth-child(8) {
    width: 16%;
}



</style>

</head>

<body>

@php
use Carbon\Carbon;
Carbon::setLocale('ar');
@endphp

<!-- @include('pdf.contract_header', [
    'project' => $project,
    'isBank'=>false,
    'showContractor' => true,
    'approvalCreatedAt'=>$approvalCreatedAt,
    'title'=>' الجدول الزمني'
]) -->














<table>
        <tr>
            <td class="title" colspan="4" class="section-title">{{' عقد     جدول الدفعات'}}</td>
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

     <tr>
        <td class="bold">قيمة المشروع</td>
        <td>
            {{
                number_format($project->bank_contract_value);
            }} درهم
        </td>

        <td class="bold">تاريخ الدفعة</td>
        <td>
            {{ !empty($approvalCreatedAt) ? $approvalCreatedAt->format('Y-m-d') : '-' }}
        </td> 
    </tr>


    <tr>
            <td class="bold"> (المالك)</td>
            <td >{{ $project->ownerUser?->name ?? 'المالك' }}</td>
            <td class="bold">  (المقاول)</td>
            <td >  {{ $project->contractorUser?->name ?? 'المقاول' }} </td>
    </tr>
    <tr>
            <td class="bold"> تاريخ انتهاء الموقع</td>
            <td >{{ $project->contractor_contract_end_date?->format('Y-m-d') ?? '-' }}</td>
            <td class="bold">  تاريخ تسليم الموقع</td>
            <td >  {{ $project->end_date?->format('Y-m-d') ?? 'المقاول' }} </td>
    </tr>


    <tr>
        <td class="bold"> رقم الدفعة</td>
        <td colspan="3" >{{ $batchId ?? 'غير متوفر' }}</td> <!-- عرض رقم الدفعة -->


        
        

    </tr>

</table>









<!-- ================= TABLE ================= -->
<table class="payments-table">












<colgroup>
    <col style="width:5%">   <!-- رقم -->
    <col style="width:46%">  <!-- بيان الأعمال (كبرناه) -->
    <col style="width:6%">   <!-- النسبة المحددة (صغرناها) -->
    <col style="width:6%">   <!-- نسبة الدفعة -->
    <col style="width:6%">   <!-- المنجز -->
    <col style="width:12%">  <!-- تاريخ -->
    <col style="width:5%">  <!-- مدة -->
    <col style="width:14%">  <!-- مبلغ -->
</colgroup>

    <thead>
        <tr>
            <th>#</th>
            <th>بيان الأعمال</th>
            <th>النسبة المحددة</th> <!-- ✅ جديد -->
            <th>نسبة الدفعة</th>
            <th>النسب المنجزة  %</th>
            <th>تاريخ البدء</th>
            <th>المدة (يوم)</th>
            <th>المبلغ</th>
            <!-- <th>الملاحظات</th> -->
        </tr>
    </thead>

    <tbody>

        @php
            $totalTarget = 0;
            $totalPercent = 0;
            $totalDuration = 0;
            $totalAmount = 0;
            $totalCompletion = 0;

            $projectValue = $project->bank_contract_value ?? 0;//$project->project_owner_support ?? 0;
        @endphp

        @foreach($schedules as $row)

            @php
                $target = $row->target_percentage ?? 0;
                $payment = $row->payment_percentage ?? 0;
                $completion = $row->completion_percentage ?? 0;

                

                $amount = ($payment / 100) * $projectValue;

                $totalTarget += $target;
                $totalPercent += $payment;
                $totalDuration += $row->duration_days;
                $totalAmount += $amount;
                $totalCompletion +=$completion;
         
            @endphp

            <tr>
                <td>{{ $row->item_no }}</td>
                <td>{{ $row->title }}</td>

                <td>{{ $target }}%</td> <!-- ✅ جديد -->
                
                
                <td>{{ $payment }}%</td>
                <td>{{ $completion}}%</td>

<td>
    {{ $row->start_date 
        ? \Carbon\Carbon::parse($row->start_date)->format('Y-m-d') 
        : '-' }}
</td>
                <td>{{ $row->duration_days }}</td>

                <td>{{ number_format($amount) }}</td>

                <!-- <td>{{ $row->notes }}</td> -->
            </tr>

        @endforeach

        <tr class="total-row">
            <td colspan="2">الإجمالي</td>

            <td>{{ $totalTarget }}%</td> <!-- ✅ جديد -->
            

            <td>{{ $totalPercent }}%</td>
            <td>{{ $totalCompletion }}%</td>

            <td>-</td>
            <td style="font-size:0.8rem;">{{ $totalDuration }} / {{ $project->bank_contract_duration * 30 }}</td>

            <td>{{ number_format($totalAmount) }}</td>
            
        </tr>

    </tbody>

</table>

<!-- ================= SIGNATURE ================= -->
<table class="signature-table">

    <tr>
        <td class="signature-title">توقيع المقاول</td>
        <td class="signature-title">توقيع المالك</td>
        <td class="signature-title">توقيع الاستشاري</td>
    </tr>

     <tr>
        <td></td>
        <td>
        </td>


        
        <td>
            <img src="{{ public_path('images/signature.jpeg') }}" style="height:80px;">
        </td>
    </tr> 


    

</table> 
















</body>
</html>