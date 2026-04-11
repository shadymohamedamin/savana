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

/* ================= INFO BOX (like contract style) ================= */
.info-box {
    border: 1px solid #000;
    padding: 15px;
    margin-bottom: 25px;
}

/* ================= INTRO TEXT ================= */
.intro-text {
    border: 1px solid #000;
    padding: 18px;
    margin-top: 20px;
    margin-bottom: 25px;
    text-align: right;
}

/* ================= TOTAL ROW ================= */
.total-row {
    font-weight: bold;
    background: #eee;
}

/* ================= SIGNATURE ================= */
.signature-table td {
    height: 80px;
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





@include('pdf.contract_header', ['project' => $project,'isBank'=>false,'showContractor' => true,'title'=>' الجدول الزمني'])



<!-- ================= TABLE ================= -->
<table>

    <thead>
        <tr>
            <th>#</th>
            <th>بيان الأعمال</th>
            <th>نسبة الدفعة</th>
            <th>نسبة الإنجاز</th>
            <th>المدة (يوم)</th>
            <th>المبلغ</th>
        </tr>
    </thead>

    <tbody>

        @php
            $totalPercent = 0;
            $totalDuration = 0;
            $totalAmount = 0;
            $projectValue = $project->project_owner_support ?? 0;
        @endphp

        @foreach($schedules as $row)

            @php
                $amount = ($row->payment_percentage / 100) * $projectValue;
                $totalPercent += $row->payment_percentage;
                $totalDuration += $row->duration_days;
                $totalAmount += $amount;
            @endphp

            <tr>
                <td>{{ $row->item_no }}</td>
                <td>{{ $row->title }}</td>
                <td>{{ $row->payment_percentage }}%</td>
                <td>{{ $row->completion_percentage }}%</td>
                <td>{{ $row->duration_days }}</td>
                <td>{{ number_format($amount) }}</td>
            </tr>

        @endforeach

        <tr class="total-row">
            <td colspan="2">الإجمالي</td>
            <td>{{ $totalPercent }}%</td>
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

</table>

</body>
</html>