@extends('layouts.app')

@section('content')

<style>



@media print {

    /* ❌ اخفي كل حاجة */
    body * {
        visibility: hidden;
    }

    /* ✅ خلي الجدول يظهر بس */
    .card, .card * {
        visibility: visible;
    }

    /* حدد مكان الطباعة */
    

    /* ❌ اخفاء الهيدر والأزرار */
    .card-header,
    .floating-actions,
    .btn,
    .group-header,
    a {
        display: none !important;
    }

    /* ❌ اخفاء progress bar لو مش عايزه */
    #progress_bar {
        display: none;
    }

}

        body {
            font-family: 'amiri', serif;
            direction: rtl;
            text-align: right;
            font-size: 18px;
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

        








/* HEADER */
.group-header {
    background: linear-gradient(90deg, #2f3a1f 0%, #3e4d2a 100%);
    color: #d4af37;
    padding: 14px 20px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: bold;
}

/* TABLE */
.table thead {
    background-color: #2f3a1f;
    color: #d4af37;
}

.table td input {
    text-align: center;
}

/* BUTTON */
.main-save-btn {
    background: #2f3a1f;
    color: #d4af37;
    border-radius: 40px;
    font-weight: 600;
}

/* FLOAT BUTTON */
.floating-actions {
    position: fixed;
    bottom: 25px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
}
tfoot tr {
    background: #2f3a1f;
    color: #d4af37;
    font-size: 18px;
}
</style>

<div class="card shadow-sm rounded-4" style="background:#f5f5dc;margin:40px;">

<!-- HEADER -->
<div class="card-header d-flex justify-content-between align-items-center"
     style="background:#D4AF37;color:#2f3a1f;">

    <div>
        <h4 class="mb-0">📊 جدول الدفعات</h4>
        <small>
            المشروع: <strong>{{ $project->projectName?->name_ar }}</strong> |
            المالك: <strong>{{ $project->ownerUser?->name ?? '—' }}</strong> |
            رقم القسيمة: <strong>{{ $project->qasmia_number ?? '—' }}</strong>
        </small>
    </div>

    <div class="d-flex gap-2">
        <!-- <button onclick="loadDefault()" class="btn btn-warning btn-sm">
            📥 تحميل جدول افتراضي
        </button> -->

        <button onclick="printPage()" class="btn btn-dark btn-sm">
            🖨️ طباعة PDF
        </button>

        <a href="{{ route('projects.schedules.batches', $project->id) }}" class="btn btn-secondary btn-sm">
    رجوع
</a>
    </div>
</div>

<!-- CONTENT -->
<div class="p-4">

<form method="POST" action="{{ route('projects.schedule.store', $project->id) }}">
@csrf

<div class="group-header mb-3 text-center">
    جدول مراحل المشروع
</div>




<div class="p-4 mb-3 bg-white rounded shadow-sm">

    <h4 class="text-center mb-4" style="font-weight:bold;">
        سافانا للإستشارات الهندسية
    </h4>

    <table class="table table-bordered text-center">
        <tr>
            <th>المشروع</th>
            <td>{{ $project->projectName?->name_ar }}</td>
<th>تاريخ العقد</th>
            <td>{{ optional($project?->contract_signed_at)?->format('Y-m-d') }}</td>

            <!-- <th>نوع المشروع</th>
            <td>فيلا دور أرضي + دور أول</td> -->
        </tr>

        <tr>
            <th>المالك</th>
            <td>{{ $project->ownerUser?->name }}</td>

            <th>المقاول</th>
            <td>{{ $project->contractorUser?->name }}</td>
        </tr>

        <tr>
            <th>رقم القسيمة</th>
            <td>{{ $project->qasmia_number }}</td>

            <th>المنطقة</th>
            <td>{{ $project->projectRegion?->name_ar }}</td>
        </tr>

        <tr>
            <th>قيمة العقد</th>
            <td>{{ number_format($project->bank_contract_value ?? 0) }}</td>

            <th>دفعة المالك</th>
            <td>{{ number_format($project->project_owner_support ?? 0) }}</td>
        </tr>

        <tr>
            
            <th>رقم الدفعة</th>
            <td>{{ $batchId ?? request('batch_id') ?? '-' }}</td>
        </tr>



    </table>

</div> 





<!-- @include('pdf.contract_header', ['project' => $project,'isBank'=>false,'showContractor' => true,'title'=>' العقد الاساسي']) -->


<!-- <button type="button" onclick="autoDistribute()" class="btn btn-warning mb-3">
    ⚡ توزيع تلقائي للنسب
</button> -->

<div class="mt-3 mb-3">
    <div style="height:20px;background:#eee;border-radius:10px;overflow:hidden;">
        <div id="progress_bar"
             style="height:100%;width:0%;background:#28a745;transition:0.3s;">
        </div>
    </div>
</div>





<style>
.table-fixed {
    table-layout: fixed;
    width: 100%;
}

.table-fixed th,
.table-fixed td {
    vertical-align: middle;
    text-align: center;
}

/* inputs */
.table-fixed input {
    width: 100%;
    font-size: 14px;
}

/* title أكبر */
.table-fixed td:nth-child(2) input {
    font-size: 16px;
    font-weight: bold;
}

/* date أكبر */
.table-fixed td:nth-child(5) input {
    font-size: 14px;
    min-width: 140px;
}

/* notes أكبر */
.table-fixed td:nth-child(8) input {
    min-width: 200px;
    font-size: 14px;
}

/* الأرقام أصغر */
.table-fixed td:nth-child(1),
.table-fixed td:nth-child(3),
.table-fixed td:nth-child(4),
.table-fixed td:nth-child(6),
.table-fixed td:nth-child(7) {
    font-size: 13px;
}
</style>






<table class="table table-bordered text-center align-middle table-fixed">

<colgroup>
    <col style="width:4%;">
    <col style="width:26%;">
    <col style="width:10%;">
    <col style="width:10%;">
    <col style="width:10%;">
    <col style="width:12%;">
    <col style="width:8%;">
    <col style="width:10%;">
    <col style="width:10%;">
</colgroup>

<thead>
<tr>
    <th>رقم</th>
    <th>بيان الأعمال</th>
    <th>النسبة المحددة</th>

    <th>نسبة الدفعة %</th>
    <th>النسب المنجزة  %</th>
    <th>تاريخ البدء</th>
    <th>المدة</th>
    <th>المبلغ</th>
    <th>ملاحظات</th>
</tr>
</thead>

<tbody id="rows">

@foreach($schedules as $i => $row)
<tr>

    <td>
        <input class="form-control" readonly
               name="rows[{{ $i }}][item_no]"
               value="{{ $row->item_no }}">
    </td>

    <td>
        <input class="form-control" readonly
               name="rows[{{ $i }}][title]"
               value="{{ $row->title }}">
    </td>

    <td>
        <input type="number" class="form-control target"
               name="rows[{{ $i }}][target_percentage]"
               value="{{ $row->target_percentage }}"
               @if(!in_array(auth()->user()->role_id, [1,4,11,12])) readonly @endif
               >
    </td>

    <td>
        <input type="number" class="form-control payment"
               name="rows[{{ $i }}][payment_percentage]"
               value="{{ $row->payment_percentage ?? 0 }}">
    </td>

    <td>
    <input type="number"
           class="form-control completion"
           name="rows[{{ $i }}][completion_percentage]"
           value="{{ $row->completion_percentage ?? 0 }}"
           >
</td>

    <td>
        <input type="date" class="form-control start-date"
               name="rows[{{ $i }}][start_date]"
               value="{{ optional($row->start_date)->format('Y-m-d') }}">
    </td>


<input type="hidden" name="batch_id" value="{{ $batchId }}">
    <td>
        <input type="number" class="form-control"
               name="rows[{{ $i }}][duration_days]"
               value="{{ $row->duration_days }}">
    </td>

    <td>
        <input type="number" class="form-control amount"
               name="rows[{{ $i }}][amount]"
               value="{{ $row->amount }}" readonly>
    </td>

    <td>
        <input class="form-control"
               name="rows[{{ $i }}][notes]"
               value="{{ $row->notes }}">
    </td>

</tr>
@endforeach

</tbody>

<tfoot>

<tr style="background:#f1f3f2;font-weight:bold;">
    <td colspan="2">الإجمالي</td>

    <td id="total_target_percent">100%</td>
    <td id="total_payment_percent">0%</td>
    <td id="total_completion_percent">0%</td>
    <td>-</td>
    <td id="total_duration">المتبقي: 0</td>

    <!-- إجمالي كل المستحقات -->
    <td id="total_amount">0</td>

    <td>-</td>
</tr>

<!-- 🔥 الصف الجديد: المستلم سابقًا -->
<tr style="background:#d1ecf1;font-weight:bold;font-size:16px;">
    <td style="background:#ffe8a1;font-weight:bold;font-size:18px;" colspan="7">
        إجمالي ما تم استلامه من الدفعات السابقة
    </td>
    <td style="background:#ffe8a1;font-weight:bold;font-size:18px;" id="paid_amount">0</td>
    <td>-</td>
</tr>

<!-- 🔥 الصف الجديد: المطلوب الحالي -->
<tr style="background:#ffe8a1;font-weight:bold;font-size:18px;">
    <td style="background:#ffe8a1;font-weight:bold;font-size:18px;" colspan="7">
        إجمالي المطلوب الحالي من المالك
    </td>
    <td style="background:#ffe8a1;font-weight:bold;font-size:18px;" id="needed_from_owner">0</td>
    <td>-</td>
</tr>

</tfoot>






</table>








<table style="width:100%; border-collapse:collapse; margin-top:20px; margin-bottom:50px; table-layout: fixed;">
    <tr>

            <td class="bold center section-title" style="text-align:center; font-weight:bold; width:33%;">
                توقيع وختم المقاول
            </td>

        <td class="bold center section-title" style="text-align:center; font-weight:bold; width:33%;">
            توقيع المالك
        </td>
        <td class="bold center section-title" style="text-align:center; font-weight:bold; width:33%;">
            توقيع وختم الاستشاري
        </td>
    </tr>

    <tr>

            <td class="signature bg-white" style="height:80px; border-bottom:1px solid #000; width:33%;"></td>
   
        <td class="signature bg-white" style="height:80px; border-bottom:1px solid #000; width:33%;"></td>

        <td class="signature bg-white" style="height:80px; border-bottom:1px solid #000; text-align:center; width:33%;">
           <img src="{{ asset('images/signature.jpeg') }}" style="height:150px;">
        </td>
    </tr>
</table>







<!-- SAVE -->
<!-- <div class="floating-actions" style="margin-top:2rem;margin-bottom:3rem;">
    <button type="submit" class="btn main-save-btn px-5">
        💾 حفظ
    </button>
</div> -->


<div class="floating-actions d-flex gap-3 justify-content-center">

    <button type="submit"
            class="btn btn-olive px-4 main-save-btn">
        💾 حفظ
    </button>

    <a target="_blank"
   href="{{ route('projects.schedule.pdf', [
        'id' => $project->id,
        'action' => 'preview',
        'batch_id' => $batchId
   ]) }}"
   class="btn btn-dark px-4">
    👁 معاينة
</a>

</div>

</form>
</div>
</div>

<script>

/* ================= ADD ROW ================= */
function addRow() {
    let index = document.querySelectorAll('#rows tr').length;

    let row = `
    <tr>
        <td><input name="rows[${index}][item_no]" class="form-control" ></td>
        <td><input name="rows[${index}][title]" class="form-control" ></td>

        <td><input name="rows[${index}][payment_percentage]" class="form-control percent payment"></td>
        <td><input name="rows[${index}][completion_percentage]" class="form-control percent completion"></td>

        <td><input name="rows[${index}][duration_days]" class="form-control"></td>
        <td><input name="rows[${index}][amount]" class="form-control amount"></td>
        <td><input name="rows[${index}][notes]" class="form-control"></td>
    </tr>
    `;

    document.getElementById('rows').insertAdjacentHTML('beforeend', row);
}





let projectValue = {{ $project->bank_contract_value ?? 0 }};//{{ $project->project_owner_support ?? 0 }};
let originalTotalAmount = {{ $schedules->sum('amount') }};
function calculate(e = null) {

    let rows = document.querySelectorAll('#rows tr');

    let totalPaymentPercent = 0;
    let totalCompletionPercent = 0;
    let totalAmount = 0;
    let totalDuration = 0;

    let projectValue = {{ $project->bank_contract_value ?? 0 }};//{{ $project->project_owner_support ?? 0 }};
    let contractMonths = {{ $project->bank_contract_duration ?? 0 }};
    let totalContractDays = contractMonths * 30;

    rows.forEach(row => {

        let paymentInput = row.querySelector('.payment');
        let targetInput = row.querySelector('.target');
        let completionInput = row.querySelector('.completion');
        let durationInput = row.querySelector('[name*="duration_days"]');
        let amountInput = row.querySelector('.amount');

        if (!paymentInput || !completionInput) return;

        let payment = parseFloat(paymentInput.value) || 0;
        let target = parseFloat(targetInput?.value) || 0;
        let completion = parseFloat(completionInput.value) || 0;
        let duration = parseFloat(durationInput?.value) || 0;

        // 🔒 منع تجاوز target
        if (payment > target) {
            payment = target;
            paymentInput.value = target;
        }

        if (completion > target) {
            completion = target;
            completionInput.value = target;
        }

        // 💰 حساب المبلغ
        let amount = (payment / 100) * projectValue;

        if (amountInput) {
            amountInput.value = Math.round(amount);
        }

        totalPaymentPercent += payment;
        totalCompletionPercent += completion;
        totalAmount += amount;
        totalDuration += duration;
    });

    // 🔒 منع تجاوز 100% للدفعات
    if (e?.target?.classList.contains('payment')) {

        let current = e.target;
        let otherTotal = 0;

        rows.forEach(row => {
            let inp = row.querySelector('.payment');
            if (inp !== current) {
                otherTotal += parseFloat(inp.value) || 0;
            }
        });

        let maxAllowed = 100 - otherTotal;

        if (parseFloat(current.value) > maxAllowed) {
            current.value = maxAllowed > 0 ? maxAllowed.toFixed(2) : 0;
        }
    }

    // 🔒 منع تجاوز المدة
    if (e?.target?.name?.includes('duration_days')) {

        let current = e.target;
        let otherTotal = 0;

        rows.forEach(row => {
            let inp = row.querySelector('[name*="duration_days"]');
            if (inp !== current) {
                otherTotal += parseFloat(inp.value) || 0;
            }
        });

        let maxAllowed = totalContractDays - otherTotal;

        if (parseFloat(current.value) > maxAllowed) {
            current.value = maxAllowed > 0 ? maxAllowed : 0;
        }
    }

    // =========================
    // 📊 UI UPDATES
    // =========================

    document.getElementById('total_payment_percent').innerText =
        totalPaymentPercent.toFixed(2) + '%';

    document.getElementById('total_completion_percent').innerText =
        totalCompletionPercent.toFixed(2) + '%';

    document.getElementById('total_amount').innerText =
        totalAmount.toLocaleString();





let tableTotal = totalAmount;

// 🔥 جاية من Laravel
let previousCumulative = {{ $previousCumulative ?? 0 }};

// =========================
// 💰 الإجمالي الكلي
// =========================
let totalAll = tableTotal-previousCumulative ;

// =========================
// 💰 المطلوب (بدون مدفوع يدوي هنا)
// =========================
let neededFromOwner = totalAll;

// =========================
// 📊 عرض
// =========================
document.getElementById('total_amount').innerText =
    tableTotal.toLocaleString();

document.getElementById('paid_amount').innerText =
    previousCumulative.toLocaleString();

document.getElementById('needed_from_owner').innerText =
    neededFromOwner.toLocaleString();

document.getElementById('total_duration').innerText =
    totalDuration + ' / ' + totalContractDays;








    // =========================
    // 📈 PROGRESS BAR (FIXED - REAL TOTAL)
    // =========================

    // استخدم الإجمالي الحقيقي
    let progressPercent = totalCompletionPercent;

    // حماية
    progressPercent = Math.min(Math.max(progressPercent, 0), 100);

    let bar = document.getElementById('progress_bar');

    bar.style.width = progressPercent + '%';

    // الرقم داخل البار
    bar.innerText = 'النسب المنجزة             ' + '  ' + progressPercent.toFixed(1) + '%';

    bar.style.display = 'flex';
    bar.style.alignItems = 'center';
    bar.style.justifyContent = 'center';
    bar.style.color = '#fff';
    bar.style.fontWeight = 'bold';

    // الألوان
    bar.style.background =
        progressPercent >= 90 ? "#dc3545" :
        progressPercent >= 60 ? "#ffc107" :
        "#28a745";
}

function printPage() {
    window.print();
}



document.addEventListener('input', function(e) {

    // 🔥 منع إدخال لو disabled
    if (e.target.disabled) {
        e.preventDefault();
        return false;
    }

    calculate(e);
});


document.addEventListener('input', function(e) {
    if (e.target.classList.contains('target')) {
        calculate(e);
    }
});

/* INIT */
calculate();

</script>

@endsection