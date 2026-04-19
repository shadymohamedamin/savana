@extends('layouts.app')

@section('content')


<style>
.btn-olive {
        background-color:#d4af37 ;   /*#2f3a1f زيتوني غامق */
        border: 1px solid #2f3a1f;
        color: #2f3a1f;              /* ذهبي */
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-olive:hover {
        background-color: #3e4a29;  /* زيتوني أفتح */
        border-color: #d4af37;       /* إطار ذهبي */
        color: #fff;                /* أبيض أنيق */
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(212,175,55,0.35);
    }



</style>



<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;padding:0px;">

@include('projects.partials.project-actions', ['project' => $project])

{{-- Header --}}
<div class="card-header d-flex justify-content-between align-items-center"
     style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">

    <h4 class="card-title mb-0">
        {{ __('الجداول الزمنية') }}
    </h4>

    <div class="d-flex gap-2">

        <a href="{{ route('projects.index') }}"
           class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
            <i class="fas fa-arrow-left"></i> رجوع
        </a>

        {{-- زرار جدول جديد --}}
        <a href="{{ route('projects.schedule.newBatch', $project->id) }}"
           class="btn btn-olive px-4 btn-sm"
                style="background:#d4af37;color:#2f3a1f;font-weight:700;font-size:1rem;">
            <i class="fas fa-plus"></i> طلب دفعة 
        </a>

    </div>
</div>

{{-- Table --}}
<div class="table-responsive p-3">
    <table class="table table-hover align-middle text-nowrap"
           style="border:1px solid #D4AF37; background-color:#f5f5dc;">

        <thead>
        <tr>
            <th>رقم الدفعة</th>
            <!-- <th>عدد البنود</th>
            <th>النسبة المحددة</th> -->
            <th>نسبة الدفعات</th>
            <th>نسبة الإنجاز</th>
            <!-- <th>مبلغ الدفعة</th> -->

            <th>مبلغ الدفعة</th>
            <th> ما سبق</th>
            <th>المتبقي على المالك</th>

            <th>اعتماد المقاول</th>
            <th>اعتماد المالك</th>
            <th>اعتماد الاستشاري</th>
            <th>تاريخ الإنشاء</th>
        </tr>
        </thead>

        <tbody>
        @foreach($batchesData as $row)

            <tr class="clickable-row"
                data-href="{{ route('projects.schedule', $project->id) }}?batch_id={{ $row->batch_id }}"
                style="cursor:pointer;">

                <td>#{{ $row->batch_id }}</td>
                <!-- <td>{{ $row->rows_count }}</td>

                <td>{{ $row->total_target }}%</td> -->
                <td>{{ $row->total_payment }}%</td>
                <td>{{ $row->total_completion }}%</td>
                <!-- <td>{{ number_format($row->total_amount ?? 0, 0) }}</td> -->


                <td>{{ number_format($row->amount, 0) }}</td>

                <td>{{ number_format($row->previous_amount, 0) }}</td>

                <td>
                    {{ number_format($row->owner_remaining, 0) }}
                </td>



@php $role = auth()->user()->role; @endphp



                <td onclick="event.stopPropagation();">
    <input type="checkbox"
           class="approve-toggle"
           data-batch="{{ $row->batch_id }}"
           data-type="contractor"
           {{ $row->contractor_approved ? 'checked' : '' }}
           
           
           >
</td>

<td onclick="event.stopPropagation();">
    <input type="checkbox"
           class="approve-toggle"
           data-batch="{{ $row->batch_id }}"
           data-type="owner"
           {{ $row->owner_approved ? 'checked' : '' }}
           
           
           >
</td>

<td class="items:center;" onclick="event.stopPropagation();">
    <input type="checkbox"
           class="approve-toggle"
           data-batch="{{ $row->batch_id }}"
           data-type="consultant"
           {{ $row->consultant_approved ? 'checked' : '' }}
           
           
           >
</td>

                <td>
                    {{ $row->created_at ? $row->created_at->format('Y-m-d') : '-' }}
                </td>

            </tr>

        @endforeach
        </tbody>

    </table>
</div>

</div>

{{-- Clickable row --}}
@push('scripts')
<script>
document.querySelectorAll('.clickable-row').forEach(row => {
    row.addEventListener('click', function () {
        window.location = this.dataset.href;
    });
});
</script>



<script>
/*document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.approve-toggle').forEach(cb => {

        cb.addEventListener('change', function () {

            let batchId = this.dataset.batch;
            let type = this.dataset.type;
            let value = this.checked ? 1 : 0;



            fetch(`/projects/schedule/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    project_id: {{ $project->id }},
                    batch_id: batchId,
                    type: type,
                    value: value
                })
            })
            .then(res => res.json())
            .then(data => {
                console.log('updated');
            })
            .catch(err => {
                alert('حصل خطأ ❌');
                console.error(err);
            });

        });

    });

});*/



document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.approve-toggle').forEach(cb => {

        cb.addEventListener('change', function () {

            let checkbox = this;
            let batchId = this.dataset.batch;
            let type = this.dataset.type;
            let value = this.checked ? 1 : 0;

            fetch(`/projects/schedule/approve`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    project_id: {{ $project->id }},
                    batch_id: batchId,
                    type: type,
                    value: value
                })
            })
            .then(res => res.json())
            .then(data => {

                if (!data.success) {
                    checkbox.checked = !checkbox.checked; // يرجع الحالة
                    showToast(data.message, 'error');
                    return;
                }

                showToast(data.message, 'success');

            })
            .catch(err => {
                checkbox.checked = !checkbox.checked;
                showToast('حصل خطأ ❌', 'error');
            });

        });

    });

});
</script>
<script>
function showToast(message, type = 'success') {

    let bg = type === 'success' ? '#28a745' : '#dc3545';

    let toast = document.createElement('div');
    toast.innerText = message;
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.background = bg;
    toast.style.color = '#fff';
    toast.style.padding = '10px 20px';
    toast.style.borderRadius = '8px';
    toast.style.zIndex = '9999';

    

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.remove();
    }, 2500);
}
</script>

@endpush

{{-- نفس ستايلك --}}
@push('styles')
<style>
.btn-olive {
    background-color: #2f3a1f;
    border: 1px solid #2f3a1f;
    color: #d4af37;
    font-weight: 600;
}
.btn-olive:hover {
    background-color: #3e4a29;
    color: #fff;
}
</style>
@endpush

@endsection