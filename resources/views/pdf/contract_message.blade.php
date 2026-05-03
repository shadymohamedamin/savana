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
    line-height: 2;
}

/* نفس ستايلك */
table {
    width: 100%;
    border-collapse: collapse;
}

td, th {
    border: 1px solid #000;
    padding: 5px;
    text-align: center;
}

.title {
    background-color: #e9e2c7;
    font-size: 20px;
    font-weight: bold;
}

.section-title {
    background-color: #e9e2c7;
    font-weight: bold;
}

.note-box {
    border: 1px solid #000;
    padding: 10px;
    margin-top: 10px;
}

.signature-table td {
    height: 80px;
}
</style>

</head>

<body>

<!-- ================= HEADER ================= -->
<table>
    <tr>
        <td colspan="4" class="title">📩 رسالة مشروع</td>
    </tr>

    <tr>
        <td><strong>المشروع</strong></td>
        <td>{{ $project->projectName?->name_ar }}</td>

        <td><strong>التاريخ</strong></td>
        <td>{{ now()->format('Y-m-d') }}</td>
    </tr>

    <tr>
        <td><strong>من</strong></td>
        <td>{{ $sender }}</td>

        <td><strong>إلى</strong></td>
        <td>{{ $receiver }}</td>
    </tr>

    <tr>
        <td><strong>CC</strong></td>
        <td>{{ $cc ?? '-' }}</td>

        <td><strong>نوع الرسالة</strong></td>
        <td>{{ $type }}</td>
    </tr>
</table>

<!-- ================= MESSAGE ================= -->
<div class="note-box">
    <strong>نص الرسالة:</strong>
    <br><br>
    {{ $messageText }}
</div>

<!-- ================= ATTACHMENT ================= -->
@if(!empty($attachmentName))
<div class="note-box">
    <strong>المرفق:</strong> {{ $attachmentName }}
</div>
@endif

<!-- ================= SIGNATURE ================= -->
<table class="signature-table" style="margin-top:30px;">
    <tr>
        <td class="section-title">توقيع المرسل</td>
        <td class="section-title">توقيع المستلم</td>
        <td class="section-title">توقيع الاستشاري</td>
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