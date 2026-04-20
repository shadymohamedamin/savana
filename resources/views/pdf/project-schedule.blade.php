<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>

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
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    padding: 15px;
    margin-bottom: 10px;
}

.sub-header {
    text-align: center;
    margin-bottom: 20px;
    font-size: 15px;
}

/* ================= TABLE ================= */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #000;
    padding: 8px;
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
    height: 30px;
    vertical-align: bottom;
}

.signature-title {
    font-weight: bold;
    background-color: #e9e2c7;
}

</style>

</head>

<body>

@php
use Carbon\Carbon;
Carbon::setLocale('ar');
@endphp

@include('pdf.contract_header', [
    'project' => $project,
    'isBank'=>false,
    'showContractor' => true,
    'title'=>' الجدول الزمني'
])

<!-- ================= TABLE ================= -->
<table>

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
        </tr>
    </thead>

    <tbody>

        @php
            $totalTarget = 0;
            $totalPercent = 0;
            $totalDuration = 0;
            $totalAmount = 0;
            $totalCompletion = 0;

            $projectValue = $project->project_owner_support ?? 0;
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
            </tr>

        @endforeach

        <tr class="total-row">
            <td colspan="2">الإجمالي</td>

            <td>{{ $totalTarget }}%</td> <!-- ✅ جديد -->
            

            <td>{{ $totalPercent }}%</td>
            <td>{{ $totalCompletion }}%</td>

            <td>-</td>
            <td>{{ $totalDuration }} / {{ $project->bank_contract_duration * 31 }}</td>

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
        <td></td>
        <td>
            <img src="{{ public_path('images/signature.jpeg') }}" style="height:80px;">
        </td>
    </tr> 


    <!-- <tr>
    <td>
        @if($approval?->contractor_approved && $project->contractorUser?->signature)
            <img src="{{ public_path('storage/' . $project->contractorUser->signature) }}" style="height:80px;">
        @endif
    </td>

    <td>
        @if($approval?->owner_approved && $project->ownerUser?->signature)
            <img src="{{ asset($project?->ownerUser?->signature) }}"  style="height:80px;">
        @endif
    </td>

    <td>
       
        @if($approval?->consultant_approved && $project->consultantUser?->signature)
           <img src="{{ public_path('images/signature.jpeg') }}" style="height:80px;">                  <img src="{{ public_path('storage/' . $project->consultantUser->signature) }}" style="height:80px;"> 
        @endif
    </td>
</tr> -->

</table>

</body>
</html>