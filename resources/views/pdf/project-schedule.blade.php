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
    'approvalCreatedAt'=>$approvalCreatedAt,
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













<!-- ================= SIGNATURE ================= -->
<!-- <table class="signature-table">
    <tr>
        <td class="signature-title">توقيع المقاول</td>
        <td class="signature-title">توقيع المالك</td>
        <td class="signature-title">توقيع الاستشاري</td>
    </tr>

    <tr>
        <td>
            @if($showSignature && $project->contractorUser && $project->contractorUser->signature)
                <img src="{{ public_path('images/' . $project->contractorUser->signature) }}" style="height:80px;">
            @else
                <span>لا يوجد توقيع</span>
            @endif
        </td>

        <td>
            @if($showSignature && $project->ownerUser && $project->ownerUser->signature)
                <img src="{{ public_path('images/' . $project->ownerUser->signature) }}" style="height:80px;">
            @else
                <span>لا يوجد توقيع</span>
            @endif
        </td>

        <td>
            @if($showSignature && $project->consultantUser && $project->consultantUser->signature)
                <img src="{{ public_path('images/' . $project->consultantUser->signature) }}" style="height:80px;">
            @else
                <span>لا يوجد توقيع</span>
            @endif
        </td>
    </tr>
</table> -->


<!-- 
@php
    // تأكد من أن المسار لا يحتوي على تكرار للمجلد
    $signaturePath = public_path('signatures/' . ltrim($project?->ownerUser?->signature, 'signatures/'));
    
    // تحقق من وجود الملف قبل محاولة تحميله
    if (file_exists($signaturePath)) {
        $signatureBase64 = base64_encode(file_get_contents($signaturePath));
    } else {
        $signatureBase64 = null;
    }
@endphp

@if($signatureBase64)
    <img src="data:image/png;base64,{{ $signatureBase64 }}" style="height:80px;">
@else
    <span>لا يوجد توقيع</span>
@endif -->






<!-- @php
    // تحديد مسار التوقيع لكل من المقاول، المالك، والاستشاري
    $contractorSignaturePath = public_path('signatures/' . ltrim($project?->contractorUser?->signature ?? '', 'signatures/'));
    $ownerSignaturePath = public_path('signatures/' . ltrim($project?->ownerUser?->signature ?? '', 'signatures/'));
    $consultantSignaturePath = public_path('signatures/' . ltrim($project?->consultantUser?->signature ?? '', 'signatures/'));

    // عرض المسارات لفحصها
    //dd($contractorSignaturePath, $ownerSignaturePath, $consultantSignaturePath);

    // التحقق من وجود توقيع المالك
    $ownerSignatureBase64 = null;
    if ($ownerApproved &&!empty($ownerSignaturePath) && file_exists($ownerSignaturePath) && is_file($ownerSignaturePath)) {
        $ownerSignatureBase64 = base64_encode(file_get_contents($ownerSignaturePath));
    }

    // التحقق من وجود توقيع الاستشاري
    $consultantSignatureBase64 = null;
    if ($consultantApproved &&!empty($consultantSignaturePath) && file_exists($consultantSignaturePath) && is_file($consultantSignaturePath)) {
        $consultantSignatureBase64 = base64_encode(file_get_contents($consultantSignaturePath));
    }

    // التحقق من وجود توقيع المقاول
    $contractorSignatureBase64 = null;
    if ($contractorApproved &&!empty($contractorSignaturePath) && file_exists($contractorSignaturePath) && is_file($contractorSignaturePath)) {
        $contractorSignatureBase64 = base64_encode(file_get_contents($contractorSignaturePath));
    }

@endphp


<table class="signature-table">
    <tr>
        <td class="signature-title">توقيع المقاول</td>
        <td class="signature-title">توقيع المالك</td>
        <td class="signature-title">توقيع الاستشاري</td>
    </tr>
    <tr>
        
        <td>
            @if($contractorSignatureBase64)
                <img src="data:image/png;base64,{{ $contractorSignatureBase64 }}" style="height:80px;">
            @else
                <span>  </span>
            @endif
        </td>

        
        <td>
            @if($ownerSignatureBase64)
                <img src="data:image/png;base64,{{ $ownerSignatureBase64 }}" style="height:80px;">
            @else
                <span>  </span>
            @endif
        </td>

       
        <td>
            @if($consultantSignatureBase64)
                <img src="data:image/png;base64,{{ $consultantSignatureBase64 }}" style="height:80px;">
            @elseif($consultantApproved)
                <img src="{{ public_path('images/signature.jpeg') }}" style="height:80px;">
            @else
                <span>  </span>
            @endif
        </td>
    </tr>
</table> -->






</body>
</html>