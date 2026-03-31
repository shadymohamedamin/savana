@extends('layouts.app')

@section('content')

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix mb-3"></div>
@include('projects.partials.project-actions', ['project' => $project])
    <!-- <form method="POST" action="{{ route('projects.tender.contractors.store', $project->id) }}">
        @csrf -->


    <form method="POST" 
      action="{{ route('projects.tender.contractors.store', $project->id) }}"
      id="contractorsForm">
        @csrf

        <div class="card shadow-sm rounded-4 m-0" style="background-color:#f5f5dc;">

            {{-- Header --}}
            <div class="card-header d-flex justify-content-between align-items-center"
                 style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">

                <h4 class="card-title mb-0">
                    اختيار المقاولين المرشحين للمناقصة
                </h4>

                <div class="d-flex gap-2">

                
                    <button type="button"
        onclick="document.getElementById('contractorsForm').submit();"
                            class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;">
                        <i class="fas fa-save me-1"></i> حفظ الاختيار
                    </button>

                </div>
            </div>


            {{-- Table --}}
            <div class="table-responsive p-3"
                 style="background-color:#f5f5dc; max-height:550px; overflow-y:auto;">

                <table class="table table-hover align-middle text-nowrap rounded-4"
                       style="border:1px solid #D4AF37;">

                    <thead style="background:#D4AF37;color:#000;">
                        <tr>
                            <th width="40"></th>
                            <th>#</th>
                            <th>الاسم</th>
                            <!-- <th>البريد</th>
                            <th>الموبايل</th>
                            <th>رقم الرخصة</th> -->


                            <th>الهيكل + الكتروميكانيكال</th>
                            <th>الهيكل +الكتروميكانيكال+ التشطيبات</th>
                            <th>سعر الفوت بدون تشطيبات </th>
                            <th> سعر الفوت مع تشطيبات</th>
                            <th>سعر السور</th>
                            <th>الفيلا مع السور</th>
                            <th>الضريبة</th>
                            <th>الإجمالي النهائي</th>




                            <th>نوعه</th>
                            <th>حالة الطلب</th>
                            <th width="80">الإجراءات</th>
                        </tr>
                    </thead>

                    <tbody>

                    @forelse($contractors as $contractor)

                        @php
                            $isSelected = in_array($contractor->id, $selected);
                        @endphp

                        <tr class="contractor-row"
                            data-href="{{ route('projects.owner-requirements.index', [
                                'project'=>$project->id,
                                'context'=>'tender',
                                'contractor'=>$contractor->id
                            ]) }}"
                            style="cursor:pointer;">

                            {{-- Checkbox --}}
                            <td onclick="event.stopPropagation();">
                                <input type="checkbox"
                                       name="contractors[]"
                                       value="{{ $contractor->id }}"
                                       {{ $isSelected ||$awardedContractorId == $contractor->id ? 'checked' : '' }}>
                            </td>

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $contractor->name }}</td>
                            <!-- <td>{{ $contractor->email }}</td>
                            <td>{{ $contractor->mobile }}</td>
                            <td>{{ $contractor->license_number }}</td> -->


                            <td>AED {{ number_format($contractor->structureElectro,2) }}</td>
                            <td>AED {{ number_format($contractor->structureWithFinishes,2) }}</td>
                            <td>AED {{ number_format($contractor->footWithout,2) }}</td>
                            <td>AED {{ number_format($contractor->footWith,2) }}</td>
                            <td>AED {{ number_format($contractor->boundaryWall,2) }}</td>
                            <td>AED {{ number_format($contractor->villaWithWall,2) }}</td>
                            <td>AED {{ number_format($contractor->vat,2) }}</td>
                            {{-- <td class="{{ $contractor->finalTotal == $lowestPrice ? 'text-success fw-bold' : '' }}">
                                AED {{ number_format($contractor->finalTotal,2) }}
                            </td> --}}
                            <td class="{{ $contractor->finalTotal == $lowestPrice ? 'text-success fw-bold' : '' }}">AED {{ number_format($contractor->finalTotal,2) }}</td>

                            <td>
                                @if($awardedContractorId == $contractor->id||$contractor->project_status == 'awarded')
                                    <span class="badge bg-success">متعين</span>

                                @elseif($contractor->project_status == 'candidate')
                                    <span class="badge bg-warning text-dark">مرشح</span>

                                @else
                                    <span class="badge bg-secondary">غير مرشح</span>
                                @endif
                            </td>


                            <td> <!-- لم يبدا -غير مكتمل -مكتمل -->
                                @if($contractor->tender_status == 'draft')
                                    <span class="badge bg-info">مسودة</span>

                                @elseif($contractor->tender_status == 'submitted')
                                    <span class="badge bg-primary">مرسل</span>

                                @elseif($contractor->tender_status == 'approved')
                                    <span class="badge bg-success">معتمد</span>

                                @elseif($contractor->tender_status == 'rejected')
                                    <span class="badge bg-danger">مرفوض</span>

                                @else
                                    <span class="badge bg-secondary">لم يبدأ</span>
                                @endif
                            </td>



                            

                            <!-- {{-- Status --}}
                            <td>
                                @if($isSelected)
                                    <span class="badge bg-success">
                                        مرشح
                                    </span>
                                @else
                                    <span class="badge bg-secondary">
                                        غير مرشح
                                    </span>
                                @endif
                            </td> -->

                            {{-- Actions --}}
                            <td onclick="event.stopPropagation();">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-olive dropdown-toggle rounded-3"
                                            style="background:#2f3a1f;color:#d4af37;"
                                            type="button"
                                            data-bs-toggle="dropdown">
                                        <i class="fas fa-cog"></i>
                                    </button>

                                    <ul class="dropdown-menu dropdown-menu-end">

                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('users.edit',$contractor->id) }}">
                                                <i class="far fa-edit me-1"></i>
                                                تعديل
                                            </a>
                                        </li>



<!-- onsubmit="return confirm('هل تريد ترسية المناقصة على هذا المقاول؟');" -->
                                        
                                        <!-- <li>
                                            <button type="button"
                                                    class="dropdown-item text-success award-btn"
                                                    data-project="{{ $project->id }}"
                                                    data-contractor="{{ $contractor->id }}">
                                                <i class="fas fa-check me-1"></i>
                                                تعيين
                                            </button>
                                        </li> -->
                                        @if($awardedContractorId == $contractor->id )
                                            <li>
                                            <button type="button"
                                                class="dropdown-item text-danger unaward-btn"
                                                data-project="{{ $project->id }}" >
                                                <i class="fas fa-times me-1"></i>
                                                إلغاء التعيين
                                            </button>
                                            </li>
                                        @elseif(!$awardedContractorId && $isSelected)
                                            <li>
                                            <button type="button"
                                                class="dropdown-item text-success award-btn"
                                                data-project="{{ $project->id }}"
                                                data-contractor="{{ $contractor->id }}">
                                                <i class="fas fa-check me-1"></i>
                                                تعيين
                                            </button>
                                            </li>
                                        @endif
                                        


                                    @php
                                    $allowed = ['candidate','awarded'];
                                    @endphp

                                    @if(in_array($contractor->project_status,$allowed))
                                    
                                        <li>
                                            <a class="dropdown-item"
                                               href="{{ route('projects.owner-requirements.index', [
                                                    'project'=>$project->id,
                                                    'context'=>'tender',
                                                    'contractor'=>$contractor->id
                                                ]) }}">
                                                <i class="fas fa-calculator me-1"></i>
                                                حساب الكميات
                                            </a>
                                        </li>

                                        <li>
                                            <a class="dropdown-item" target="_blank"
                                        href="{{ route('projects.contract.tender.pdf', [
                                                'id' => $project->id,
                                                'contractor' => $contractor->id,
                                                'action' => 'preview'
                                        ]) }}">
                                                <i class="fas fa-calculator me-1"></i>
                                                👁 معاينة العقد
                                            </a>
                                        </li>
                                    @endif
                                        

                                    </ul>
                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                لا يوجد مقاولين
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if(method_exists($contractors,'links'))
            <div class="card-footer rounded-bottom-4"
                 style="background-color:#f5f5dc;">
                <div class="float-end">
                    {{ $contractors->links() }}
                </div>
            </div>
            @endif

        </div>

    </form>

</div>


{{-- Custom CSS --}}
@push('styles')
<style>

.btn-olive {
    background-color:#2f3a1f;
    border:1px solid #2f3a1f;
    color:#d4af37;
    font-weight:600;
    transition:all 0.3s ease;
}

.btn-olive:hover {
    background-color:#3e4a29;
    border-color:#d4af37;
    color:#fff;
    transform:translateY(-1px);
    box-shadow:0 6px 18px rgba(212,175,55,0.35);
}




.table-hover tbody tr:hover {
    background-color:#fff8dc;
}

</style>
@endpush


{{-- Row Click --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.contractor-row').forEach(row => {
        row.addEventListener('click', function (e) {

            if (
                e.target.closest('a') ||
                e.target.closest('button') ||
                e.target.closest('.dropdown') ||
                e.target.closest('input')
            ) {
                return;
            }

            window.location = this.dataset.href;
        });
    });

});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.award-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            if (!confirm('هل تريد تعيين المناقصة على هذا المقاول؟')) {
                return;
            }

            let projectId = this.dataset.project;
            let contractorId = this.dataset.contractor;

            let form = document.getElementById('awardForm');
            form.action = `/projects/${projectId}/tender/${contractorId}/award`;
            form.submit();
        });
    });

});
</script>


<form id="awardForm" method="POST" style="display:none;">
    @csrf
</form>




<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.unaward-btn').forEach(btn => {
        btn.addEventListener('click', function () {

            if (!confirm('هل تريد إلغاء التعيين؟')) return;

            let projectId = this.dataset.project;

            let form = document.getElementById('awardForm');
            form.action = `/projects/${projectId}/tender/unaward`;
            form.submit();
        });
    });

});
</script>

@endsection