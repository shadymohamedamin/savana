










@extends('layouts.app')

@section('content')

<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;padding:0px;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">
        <h4 class="card-title mb-0">
            {{ __('اعتمادات البلدية') }}
        </h4>

        <div class="d-flex gap-2">
            <a href="{{ route('projects.index') }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-arrow-left"></i> {{ __('العودة الي المشاريع') }}
            </a>

            <!-- <button class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;"
                    data-bs-toggle="collapse"
                    data-bs-target="#createBox">
                <i class="fas fa-plus"></i> {{ __('اضافة') }}
            </button>  -->

            <a href="{{ route('projects.baladya-approvals.create', $projectId) }}?owner_id={{ request('owner_id') }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-plus"></i> {{ __('اضافة') }}
            </a>
        </div>
    </div>

    {{-- Create Form createBox        collapse --}}
    <!-- <div id="" class=" card-body border-bottom">

            @if ($errors->any())
                <div class="alert alert-danger rounded-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif



        <form id="baladyaForm" 
            method="POST"
            action="{{ $editApproval ? route('projects.baladya-approvals.update', [$projectId, $editApproval->id]) 
                                    : route('projects.baladya-approvals.store', $projectId) }}">
            @csrf
            @if($editApproval)
                @method('PUT')
            @endif

            <input type="hidden" name="project_id" value="{{ $projectId }}">
            <input type="hidden" name="owner_id" value="{{ request('owner_id') }}">

            <div class="row g-2">

                <div class="col-md-3">
                    <select name="status_type_id" class="form-control" required>
                        <option value="">{{ __('نوع الحالة') }}</option>
                        @foreach($statusTypes as $id => $name_ar)
                            <option value="{{ $id }}" 
                                {{ ($editApproval->status_type_id ?? old('status_type_id')) == $id ? 'selected' : '' }}>
                                {{ $name_ar }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-2">
                    <input type="text" name="case_number"
                        class="form-control"
                        value="{{ $editApproval->case_number ?? old('case_number') }}"
                        placeholder="رقم الحالة" required>
                </div>

                <div class="col-md-2">
                    <input type="date" name="opened_at"
                        class="form-control"
                        value="{{ isset($editApproval) && $editApproval?->opened_at ? $editApproval->opened_at->format('Y-m-d') : old('opened_at') }}"
                        placeholder="{{ __('تاريخ فتح المعاملة') }}" required>
                </div>

                <div class="col-md-2">
                    <input type="date" name="approved_at"
                        class="form-control"
                        value="{{ isset($editApproval) && $editApproval?->approved_at ? $editApproval->approved_at->format('Y-m-d') : old('approved_at') }}"
                        placeholder="{{ __('تاريخ اعتماد المعاملة') }}">
                </div>

                <div class="col-md-3">
                    <input type="text" name="reason"
                        class="form-control"
                        value="{{ $editApproval->reason ?? old('reason') }}"
                        placeholder="السبب">
                </div>

            </div>

            <div class="col-md-2 d-grid mt-3 items-center mx-auto my-2" >
                <button class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                    <i class="fas fa-check"></i> {{ $editApproval ? __('Edit') : __('Save') }}
                </button>
            </div>
        </form>

    </div> -->

    {{-- Table --}}
    <div class="table-responsive p-3" style="background:#f5f5dc;">
        <table class="table table-hover align-middle text-nowrap rounded-4"
               style="border:1px solid #D4AF37; background-color:#f5f5dc;">

            <thead style="background:#f5f5dc;">
            <tr style="background:#f5f5dc;">
                <th style="background:#f5f5dc;">{{ __('نوع الحالة') }}</th>
                <th style="background:#f5f5dc;">{{ __('رقم الحالة') }}</th>
                <th style="background:#f5f5dc;">{{ __('تاريخ فتح المعاملة') }}</th>
                <th style="background:#f5f5dc;">{{ __('تاريخ اعتماد المعاملة') }}</th>
                <th style="background:#f5f5dc;">{{ __('الفرق') }}</th>
                <th style="background:#f5f5dc;">{{ __('السبب') }}</th>
                <th style="background:#f5f5dc;">{{ __('الإجراءات') }}</th>
            </tr>
            </thead>

            <tbody>
            @foreach($baladyaApprovals as $row)
                <tr>
                    <td style="background:#f5f5dc;">
                        {{ $row->statusType->name_ar ?? '-' }}
                    </td>

                    <td style="background:#f5f5dc;">{{ $row->case_number }}</td>
                    <td style="background:#f5f5dc;">{{ $row->opened_at ? $row->opened_at->format('Y-m-d') : '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $row->approved_at ? $row->approved_at->format('Y-m-d') : '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $row->days_diff ?? '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $row->reason }}</td>

                    <td style="background:#f5f5dc;">
                        <div class="dropdown" style="background:#f5f5dc;">
                            <button class="btn btn-sm btn-olive dropdown-toggle" style="background:#2f3a1f;color:#d4af37;font-weight:600;"
                                    data-bs-toggle="dropdown">
                                <i class="fas fa-cog"></i>
                            </button>

                            <ul style="background:#f5f5dc;" class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="{{ route('projects.baladya-approvals.edit', [
                                            'project' => $projectId,
                                            'id' => $row->id
                                        ]) }}?owner_id={{ request('owner_id') }}"
                                    class="dropdown-item">
                                        <i class="far fa-edit"></i> {{ __('Edit') }}
                                    </a>




                                </li>

                                <li>
                                    <form method="POST"
                                          action="{{ route('projects.baladya-approvals.destroy',
                                          [$projectId, $row->id]) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="dropdown-item text-danger"
                                                onclick="return confirm('Are you sure?')">
                                            <i class="far fa-trash-alt"></i> {{ __('Delete') }}
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    

    <div class="card-footer clearfix">
        <div class="float-end">
            @include('adminlte-templates::common.paginate', ['records' => $baladyaApprovals])
        </div>
    </div>




</div>

@endsection








{{-- Custom btn-olive CSS --}}
@push('styles')
<style>
.btn-olive {
    background-color: #2f3a1f;
    border: 1px solid #2f3a1f;
    color: #d4af37;
    font-weight: 600;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-olive:hover {
    background-color: #3e4a29;
    border-color: #d4af37;
    color: #fff;
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(212,175,55,0.35);
}
</style>
@endpush






<!-- @if(session('toast'))
<script>
document.addEventListener('DOMContentLoaded', function () {
    let toastData = @json(session('toast'));

    // Create toast element
    let toastEl = document.createElement('div');
    toastEl.className = `toast align-items-center text-bg-${toastData.type} border-0 position-fixed top-0 end-0 m-3`;
    toastEl.setAttribute('role', 'alert');
    toastEl.setAttribute('aria-live', 'assertive');
    toastEl.setAttribute('aria-atomic', 'true');
    toastEl.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">${toastData.message}</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    `;
    document.body.appendChild(toastEl);

    // Show toast
    new bootstrap.Toast(toastEl, { delay: 5000 }).show();
});
</script>
@endif
 -->




