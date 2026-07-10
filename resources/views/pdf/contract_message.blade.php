<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">

<style>
body {
    font-family: 'amiri', serif;
    direction: rtl;
    font-size: 14px;
    line-height: 2;
}

/* الجدول */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 10px;
}

td, th {
    border: 1px solid #000;
    padding: 6px;
    text-align: center;
}

/* العناوين */
.title {
    background: #e9e2c7;
    font-size: 18px;
    font-weight: bold;
}

.bold {
    font-weight: bold;
}

/* الرسالة */
.note-box {
    border: 1.5px solid #000;
    padding: 5px;
    margin-top: 5px;
    height:500px;
}

/* صورة */
.attachment-img {
    margin-top: 10px;
    text-align: center;
}

.attachment-img img {
    max-height: 150px;
}

/* التوقيع */
.signature-table td {
    height: 20px;
}







.signature-table {
    page-break-inside: avoid;
}

.note-box {
    page-break-inside: avoid;
}

.attachment-img {
    page-break-inside: avoid;
}






</style>

</head>

<body>

<!-- ================= HEADER =================    !$message->sender->name ??    -->
<table>






    <tr>
        <td colspan="4" class="title">
            {{ $message->messageType->name_ar ?? 'رسالة مشروع' }}
        </td>
    </tr>



    <tr>
        <td class="bold">المالك</td>
        <td>{{ $project->ownerUser?->name ?? '-' }}</td>

        <td class="bold">المقاول</td>
        <td>{{ $project->contractorUser?->name ?? '-' }}</td>
    </tr>

    <tr>
        <td class="bold">المشروع</td>
        <td>{{ $project->projectName?->name_ar }}</td>

        <td class="bold">تاريخ الرسالة</td>
        <td>{{ $message->created_at->format('Y-m-d') }}</td>
    </tr>

    <tr>
        <td class="bold">المرسل</td>
        <td>{{ 'سافانا ديزاين' }}</td>

        <td class="bold">المرسل اليه</td>
        <td>{{ $message->receiver->name ?? '-' }}</td>
    </tr>

    <tr>
        <td class="bold">CC</td>
        <td>{{ $message->ccUser->name ?? '-' }}</td>

        <td class="bold">نوع الرسالة</td>
        <td>{{ $message->messageType->name_ar ?? '-' }}</td>
    </tr>

    

    <tr>
        <td class="bold">قيمة المشروع</td>
        <td>{{ number_format($project->bank_contract_value) }} درهم</td>

        <!-- <td class="bold">تاريخ العقد</td>
        <td>{{ $project->contract_signed_at?->format('Y-m-d') ?? '-' }}</td> -->
        {{-- <td class="bold">رقم الرسالة</td>
        <td>{{ $message->id ?? '-' }}</td> --}}

        <td class="bold"> تاريخ انتهاء الموقع</td>
        <td >{{ $project->contractor_contract_end_date?->format('Y-m-d') ?? '-' }}   </td>

    </tr>


    @if($message->parent_id)

<tr>
    <td class="bold">رد على الرسالة</td>

    <td>
        #{{ $message->parent_id }}
    </td>

    <td class="bold">تاريخ الرد</td>

    <td>
        {{ $message->created_at->format('Y-m-d') }}
    </td>
</tr>

@endif



</table>

<!-- ================= MESSAGE ================= -->
<div class="note-box">
    {{-- <strong>نص الرسالة:</strong> --}}
    {{-- <br><br> --}}
    {{-- {{ $message->message }} --}}
    {!! $message->message !!}
</div>

<!-- ================= ATTACHMENT ================= -->
@if($message->attachment)
<div style="max-height:100px;">
<div  class="note-box attachment-img">


    <img src="{{ public_path('Files/'.$message->attachment) }}"
     style="height:340px; width:auto;">
</div>
</div>
@endif

<!-- ================= SIGNATURE ================= -->

@php
    $showAllSignatures = in_array($message->message_type_id, [1, 9]);
@endphp



@if($showAllSignatures)

<table style="width:100%; border-collapse:collapse; margin-top:20px;">
    <tr>
        <td class="title">توقيع وختم المقاول</td>
        <td class="title">توقيع المالك</td>
        <td class="title">توقيع الاستشاري</td>
    </tr>

    <tr>
        <td style="height:100px;"></td>

        <td style="height:100px;"></td>

        <td style="height:100px; text-align:center;">
            <img src="{{ public_path('images/signature.jpeg') }}"
                 style="height:80px;">
        </td>
    </tr>
</table>

@else

<table class="signature-table" style="margin-top:20px;">
    <tr>
        <td class="title">توقيع الاستشاري</td>
    </tr>

    <tr>
        <td style="text-align:center;">
            <img src="{{ public_path('images/signature.jpeg') }}"
                 style="height:80px;">
        </td>
    </tr>
</table>

@endif
{{-- 
 <table class="signature-table" style="margin-top:20px;">
    <tr>
        <td class="title">توقيع الاستشاري</td>
    </tr>

    <tr>
        <td>
            <img src="{{ public_path('images/signature.jpeg') }}" style="height:80px;">
        </td>
    </tr>
</table> 






 
<table style="width:100%; border-collapse:collapse; margin-top:0px; margin-bottom:50px;">
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
           <img src="{{ public_path('images/signature.jpeg') }}" style="height:100px;">
        </td>
    </tr>
</table>  --}}


</body>
</html>