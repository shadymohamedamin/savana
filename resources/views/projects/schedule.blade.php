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

        <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm">
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






<table class="table table-bordered text-center align-middle">
<thead>
<tr>
    <th>رقم</th>
    <th>بيان الأعمال</th>
    <th>النسبة المحددة</th>
    <!-- <th>النسبة المدخلة</th> -->
    <th>نسبة الإنجاز %</th>
    <th>نسبة الدفعة %</th>
    <th>المدة</th>
    <th>المبلغ</th>
    <th>ملاحظات</th>
</tr>
</thead>

<tbody id="rows">

@foreach($schedules as $i => $row)
<tr>
    <td><input class="form-control" readonly name="rows[{{ $i }}][item_no]" value="{{ $row->item_no }}"></td>
    <td><input class="form-control" readonly style="font-size: 18px;" name="rows[{{ $i }}][title]" value="{{ $row->title }}"></td>


    <td>
        <input readonly type="number" class="form-control target "
               name="rows[{{ $i }}][target_percentage]"
               value="{{ $row->target_percentage }}">
    </td>


    <td>
        <!-- <input readonly type="number" class="form-control percent completion"
               name="rows[{{ $i }}][completion_percentage]"
               value="{{ $row->completion_percentage }}"> -->

        <input readonly type="number" class="form-control completion"
            name="rows[{{ $i }}][completion_percentage]"
            value="0">
    </td>


    <td>
        <!-- <input type="number" class="form-control percent "
               name="rows[{{ $i }}][payment_percentage]"
               value="{{ $row->payment_percentage }}"> -->

               <input type="number" class="form-control payment"
       name="rows[{{ $i }}][payment_percentage]"
       value="{{ $row->payment_percentage ?? 0 }}">
    </td>

    

    <td><input type="number" class="form-control" name="rows[{{ $i }}][duration_days]" value="{{ $row->duration_days }}"></td>

    <td>
        <input type="number" class="form-control amount"
               name="rows[{{ $i }}][amount]"
               value="{{ $row->amount }}" readonly>
    </td>

    <td><input class="form-control" name="rows[{{ $i }}][notes]" value="{{ $row->notes }}"></td>
</tr>
@endforeach

</tbody>




<tfoot>
<tr style="background:#f1f3f2;font-weight:bold;">
    <td colspan="2">الإجمالي</td>

    <td id="total_target_percent">100%</td>
    <td id="total_completion_percent">0%</td>


    <td id="total_payment_percent">0%</td>

    

    <td id="total_duration"> المتبقي: 0</td>

<!-- <td colspan="7" class="text-center">
        ⏳ إجمالي المدة: 
        <strong id="total_duration">0</strong>
        | المتبقي:
        <strong id="remaining_duration">0</strong> يوم
    </td> -->
 

    <td id="total_amount">0</td>

    <td>-</td>
</tr>
</tfoot>



</table>

<!-- <button type="button" onclick="addRow()" class="btn btn-secondary">
    ➕ إضافة صف
</button> -->

<!-- SUMMARY -->
<!-- <div class="mt-4 p-3 bg-white rounded shadow-sm">

    <h5>📊 الملخص</h5>

    <p>إجمالي الدفعات: <strong id="total">0</strong></p>

    <p>قيمة الضريبة (5%):
        <strong id="vat">0</strong>
    </p>

    <p>الإجمالي النهائي:
        <strong id="grand_total">0</strong>
    </p>

    <p>إجمالي نسبة الدفعات:
        <strong id="percent_total">0%</strong>
    </p>

</div> -->






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
<div class="floating-actions" style="margin-top:2rem;margin-bottom:3rem;">
    <button type="submit" class="btn main-save-btn px-5">
        💾 حفظ
    </button>
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

/* ================= CALCULATIONS ================= */
/*function calculate() {

    let total = 0;
    let percentTotal = 0;

    document.querySelectorAll('.amount').forEach(el => {
        total += parseFloat(el.value) || 0;
    });

    document.querySelectorAll('.payment').forEach(el => {
        percentTotal += parseFloat(el.value) || 0;
    });

    // منع > 100%
    if (percentTotal > 100) {
        alert('⚠️ مجموع نسب الدفعات لا يجب أن يتجاوز 100%');
    }

    let vat = total * 0.05;
    let grand = total + vat;

    document.getElementById('total').innerText = total.toLocaleString();
    document.getElementById('vat').innerText = vat.toLocaleString();
    document.getElementById('grand_total').innerText = grand.toLocaleString();
    document.getElementById('percent_total').innerText = percentTotal + '%';
}*/




let projectValue = {{ $project->project_owner_support ?? 0 }};

/* ================= CALCULATE ================= */
/*function calculate(changedInput = null) {

    let total = 0;
    let percentTotal = 0;

    let rows = document.querySelectorAll('#rows tr');

    rows.forEach(row => {

        let percentInput = row.querySelector('.payment');
        let amountInput  = row.querySelector('.amount');

        let percent = parseFloat(percentInput?.value) || 0;

        percentTotal += percent;

        // 🔥 حساب المبلغ
        let amount = (percent / 100) * projectValue;

        if (amountInput) {
            amountInput.value = Math.round(amount);
        }

        total += amount;

      
        percentInput.classList.remove('bg-danger','bg-warning','bg-success','text-white');

 

    });

  
    if (percentTotal > 100 && changedInput) {

        let currentVal = parseFloat(changedInput.value) || 0;
        let otherTotal = percentTotal - currentVal;
        let allowed = 100 - otherTotal;

        if (allowed < 0) allowed = 0;

        changedInput.value = allowed.toFixed(2);
        calculate();
        return;
    }

   
    let vat = total * 0.05;
    let grand = total + vat;

    document.getElementById('total').innerText = total.toLocaleString();
    document.getElementById('vat').innerText = vat.toLocaleString();
    document.getElementById('grand_total').innerText = grand.toLocaleString();
    document.getElementById('percent_total').innerText = percentTotal.toFixed(2) + '%';

   
    let bar = document.getElementById('progress_bar');

    bar.style.width = percentTotal + "%";

    if (percentTotal > 75) {
        bar.style.background = "#c44f5b"; // أحمر
    } else if (percentTotal > 50) {
        bar.style.background = "#b19c58"; // أصفر
    } else {
        bar.style.background = "#62d77e"; // أخضر
    }
}*/

/*function calculate(changedInput = null) {

    let totalAmount = 0;
    let totalPaymentPercent = 0;
    let totalCompletionPercent = 0;
    let totalDuration = 0;

    let rows = document.querySelectorAll('#rows tr');

    rows.forEach(row => {

        let paymentInput = row.querySelector('.payment');
        let completionInput = row.querySelector('.completion');
        let durationInput = row.querySelector('[name*="duration_days"]');
        let amountInput  = row.querySelector('.amount');

        let payment = parseFloat(paymentInput?.value) || 0;
        let completion = parseFloat(completionInput?.value) || 0;
        let duration = parseFloat(durationInput?.value) || 0;

        totalPaymentPercent += payment;
        totalCompletionPercent += completion;
        totalDuration += duration;

        // 🔥 حساب المبلغ
        let amount = (payment / 100) * projectValue;

        if (amountInput) {
            amountInput.value = Math.round(amount);
        }

        totalAmount += amount;

    });

   
    if (totalPaymentPercent > 100 && changedInput) {

        let currentVal = parseFloat(changedInput.value) || 0;
        let otherTotal = totalPaymentPercent - currentVal;
        let allowed = 100 - otherTotal;

        if (allowed < 0) allowed = 0;

        changedInput.value = allowed.toFixed(2);

        calculate();
        return;
    }

    
    document.getElementById('total_payment_percent').innerText =
        totalPaymentPercent.toFixed(2) + '%';

    document.getElementById('total_completion_percent').innerText =
        totalCompletionPercent.toFixed(2) + '%';

    document.getElementById('total_duration').innerText =
        totalDuration;

    document.getElementById('total_amount').innerText =
        totalAmount.toLocaleString();




        let bar = document.getElementById('progress_bar');

    bar.style.width = percentTotal + "%";

    if (percentTotal > 75) {
        bar.style.background = "#c44f5b"; // أحمر
    } else if (percentTotal > 50) {
        bar.style.background = "#b19c58"; // أصفر
    } else {
        bar.style.background = "#62d77e"; // أخضر
    }
}*/

/*function calculate(e = null) {

    let rows = document.querySelectorAll('#rows tr');

    let totalAmount = 0;
    let totalPaymentPercent = 0;
    let totalCompletionPercent = 0;
    let totalDurationUsed = 0;

    let contractMonths = {{ $project->bank_contract_duration ?? 0 }};
    let totalContractDays = contractMonths * 31;

    let projectValue = {{ $project->project_owner_support ?? 0 }};

    // ========================
    // 1️⃣ حساب القيم
    // ========================
    /*rows.forEach(row => {

        let paymentInput = row.querySelector('.payment');
        let completionInput = row.querySelector('.completion');
        let durationInput = row.querySelector('[name*="duration_days"]');
        let amountInput = row.querySelector('.amount');

        let payment = parseFloat(paymentInput?.value) || 0;
        let completion = parseFloat(completionInput?.value) || 0;
        let duration = parseFloat(durationInput?.value) || 0;

        totalPaymentPercent += payment;
        totalCompletionPercent += completion;
        totalDurationUsed += duration;

        let amount = (payment / 100) * projectValue;

        if (amountInput) {
            amountInput.value = Math.round(amount);
        }
    });*/


    /*rows.forEach(row => {

    let paymentInput = row.querySelector('.payment');
    let targetInput  = row.querySelector('.target'); // 👈 جديد
    let completionInput = row.querySelector('.completion');
    let durationInput = row.querySelector('[name*="duration_days"]');
    let amountInput = row.querySelector('.amount');

    let payment = parseFloat(paymentInput?.value) || 0;
    let target  = parseFloat(targetInput?.value) || 0; // 👈 جديد
    let completion = parseFloat(completionInput?.value) || 0;
    let duration = parseFloat(durationInput?.value) || 0;

    // ✅ منع تجاوز target (أهم سطر)
    if (payment > target) {
        payment = target;
        paymentInput.value = target;
    }

    totalPaymentPercent += payment;
    totalCompletionPercent += completion;
    totalDurationUsed += duration;

    let amount = (payment / 100) * projectValue;

    if (amountInput) {
        amountInput.value = Math.round(amount);
    }
});

    // ========================
    // 2️⃣ منع تجاوز 100% (لكن يسمح بالنقص)
    // ========================
    if (e?.target?.classList.contains('payment')) {

        let currentInput = e.target;

        let otherTotal = 0;

        rows.forEach(row => {
            let inp = row.querySelector('.payment');
            if (inp !== currentInput) {
                otherTotal += parseFloat(inp.value) || 0;
            }
        });

        let maxAllowed = 100 - otherTotal;

        if (parseFloat(currentInput.value) > maxAllowed) {
            currentInput.value = maxAllowed > 0 ? maxAllowed.toFixed(2) : 0;
        }
    }

    // ========================
    // 3️⃣ منع تجاوز المدة (لكن يسمح بالنقص)
    // ========================
    if (e?.target?.name?.includes('duration_days')) {

        let currentInput = e.target;

        let otherTotal = 0;

        rows.forEach(row => {
            let inp = row.querySelector('[name*="duration_days"]');
            if (inp !== currentInput) {
                otherTotal += parseFloat(inp.value) || 0;
            }
        });

        let maxAllowed = totalContractDays - otherTotal;

        if (parseFloat(currentInput.value) > maxAllowed) {
            currentInput.value = maxAllowed > 0 ? maxAllowed : 0;
        }
    }

    // ========================
    // 4️⃣ المتبقي
    // ========================
    let remainingDays = totalContractDays - totalDurationUsed;
    if (remainingDays < 0) remainingDays = 0;

    // ========================
    // 5️⃣ UI Update
    // ========================
    document.getElementById('total_payment_percent').innerText =
        totalPaymentPercent.toFixed(2) + '%';

    document.getElementById('total_completion_percent').innerText =
        totalCompletionPercent.toFixed(2) + '%';

    document.getElementById('total_duration').innerText =
        totalDurationUsed + ' / ' + totalContractDays;

    document.getElementById('total_amount').innerText =
        totalAmount.toLocaleString();

    let remainingEl = document.getElementById('remaining_duration');
    if (remainingEl) {
        remainingEl.innerText = remainingDays;
    }

    // ========================
    // 6️⃣ Progress Bar
    // ========================
    let bar = document.getElementById('progress_bar');

    let percent = Math.min(totalPaymentPercent, 100);

    bar.style.width = percent + "%";

    bar.style.background =
        percent > 90 ? "#dc3545" :
        percent > 60 ? "#ffc107" :
        "#28a745";
}*/


function calculate(e = null) {

    let rows = document.querySelectorAll('#rows tr');

    let totalPaymentPercent = 0;
    let totalCompletionPercent = 0;
    let totalAmount = 0;
    let totalDuration = 0;

    let projectValue = {{ $project->project_owner_support ?? 0 }};
    let contractMonths = {{ $project->bank_contract_duration ?? 0 }};
    let totalContractDays = contractMonths * 30;

    rows.forEach(row => {

        let paymentInput = row.querySelector('.payment');
        let targetInput  = row.querySelector('.target');
        let completionInput = row.querySelector('.completion');
        let durationInput = row.querySelector('[name*="duration_days"]');
        let amountInput = row.querySelector('.amount');

        let payment = parseFloat(paymentInput.value) || 0;
        let target  = parseFloat(targetInput.value) || 0;
        let duration = parseFloat(durationInput.value) || 0;

        // ✅ 1. منع تجاوز target
        if (payment > target) {
            payment = target;
            paymentInput.value = target;
        }

        // ✅ 2. حساب نسبة الإنجاز
        let completion = 0;
        if (target > 0) {
            completion = (payment / target) * 100;
        }

        completionInput.value = completion.toFixed(2);

        // ✅ 3. حساب المبلغ
        let amount = (payment / 100) * projectValue;
        amountInput.value = Math.round(amount);

        totalPaymentPercent += payment;
        totalCompletionPercent += completion;
        totalAmount += amount;
        totalDuration += duration;
    });

    // ✅ 4. منع تجاوز 100% إجمالي
    if (e?.target?.classList.contains('payment')) {

        let currentInput = e.target;

        let otherTotal = 0;

        rows.forEach(row => {
            let inp = row.querySelector('.payment');
            if (inp !== currentInput) {
                otherTotal += parseFloat(inp.value) || 0;
            }
        });

        let maxAllowed = 100 - otherTotal;

        if (parseFloat(currentInput.value) > maxAllowed) {
            currentInput.value = maxAllowed > 0 ? maxAllowed.toFixed(2) : 0;
        }
    }

    // ✅ 5. تحديث الـ UI
    document.getElementById('total_payment_percent').innerText =
        totalPaymentPercent.toFixed(2) + '%';

    document.getElementById('total_completion_percent').innerText =
        totalCompletionPercent.toFixed(2) + '%';

    document.getElementById('total_amount').innerText =
        totalAmount.toLocaleString();

    document.getElementById('total_duration').innerText =
        totalDuration + ' / ' + totalContractDays;

    // ✅ 6. Progress Bar
    let bar = document.getElementById('progress_bar');
    let percent = Math.min(totalPaymentPercent, 100);

    bar.style.width = percent + "%";

    bar.style.background =
        percent > 90 ? "#dc3545" :
        percent > 60 ? "#ffc107" :
        "#28a745";
}
/* ================= DEFAULT DATA ================= */
// function loadDefault() {

//     let data = [
//         {no:1,title:'دفعة مقدمة',p:18,c:38,d:0,a:265999},
//         {no:2,title:'تجهيز الموقع',p:0,c:15,d:15,a:0},
//         {no:3,title:'الحفر',p:0,c:5,d:5,a:0},
//         {no:4,title:'صب القواعد',p:0,c:20,d:20,a:0},
//         {no:5,title:'صب الجسور',p:0,c:20,d:20,a:0},
//         {no:6,title:'صب سقف الأرضي',p:6,c:48,d:48,a:42000},
//     ];

//     let rows = '';

//     data.forEach((r,i)=>{
//         rows += `
//         <tr>
//             <td><input class="form-control" name="rows[${i}][item_no]" value="${r.no}"></td>
//             <td><input class="form-control" name="rows[${i}][title]" value="${r.title}"></td>
//             <td><input class="form-control percent payment" name="rows[${i}][payment_percentage]" value="${r.p}"></td>
//             <td><input class="form-control percent completion" name="rows[${i}][completion_percentage]" value="${r.c}"></td>
//             <td><input class="form-control" name="rows[${i}][duration_days]" value="${r.d}"></td>
//             <td><input class="form-control amount" name="rows[${i}][amount]" value="${r.a}"></td>
//             <td><input class="form-control" name="rows[${i}][notes]"></td>
//         </tr>
//         `;
//     });

//     document.getElementById('rows').innerHTML = rows;

//     calculate();
// }

/* ================= PRINT ================= */
function printPage() {
    window.print();
}

/* ================= EVENTS ================= */
/*document.addEventListener('input', function(e) {
    if (
        e.target.classList.contains('amount') ||
        e.target.classList.contains('percent')
    ) {
        calculate();
    }
});*/

document.addEventListener('input', function(e) {

    // 🔥 منع إدخال لو disabled
    if (e.target.disabled) {
        e.preventDefault();
        return false;
    }

    calculate(e);
});

/* INIT */
calculate();

</script>

@endsection