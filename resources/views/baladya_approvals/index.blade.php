










@extends('layouts.app')

@section('content')

<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;padding:0px;">


@include('projects.partials.project-actions', ['project' => $project])

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
            </button>    basename($row->approved_file)          -->

            <a href="{{ route('projects.baladya-approvals.create', $projectId) }}?owner_id={{ request('owner_id') }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-plus"></i> {{ __('اضافة') }}
            </a>
        </div>
    </div>

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
                <th style="background:#f5f5dc;">{{ __('فرق البلدية') }}</th>
                <th style="background:#f5f5dc;">{{ __('فرق الموقع') }}</th>
                <th style="background:#f5f5dc;">{{ __('السبب') }}</th>
                <th style="background:#f5f5dc;">{{ __('رقم الرخصة') }}</th>
                <th style="background:#f5f5dc;">{{ __('ملف اعتماد البلدية') }}</th>
                <th style="background:#f5f5dc;">{{ __('ملف رخصة البناء') }}</th>
                <th style="background:#f5f5dc;">{{ __('الإجراءات') }}</th>

            </tr>
            </thead>

            <tbody>
            @foreach($baladyaApprovals as $i => $row)
                <tr>
                    @php
                        $siteDiff = '-';

                        // لو في صف بعده
                        if (isset($baladyaApprovals[$i + 1])
                            && $row->opened_at
                            && $baladyaApprovals[$i + 1]->opened_at) {

                            $siteDiff = $row->opened_at
                                ->diffInDays($baladyaApprovals[$i + 1]->opened_at);
                        }
                    @endphp
                    <td style="background:#f5f5dc;">
                        {{ $row->statusType->name_ar ?? '-' }}
                    </td>

                    <td style="background:#f5f5dc;">{{ $row->case_number }}</td>
                    <td style="background:#f5f5dc;">{{ $row->opened_at ? $row->opened_at->format('Y-m-d') : '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $row->approved_at ? $row->approved_at->format('Y-m-d') : '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $row->days_diff ?? '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $siteDiff }}</td>


                    <td style="background:#f5f5dc;">{{ $row->reason }}</td>
                    <td style="background:#f5f5dc;">{{ $row->building_license_number }}</td>
                    <td style="background:#f5f5dc; max-width:120px;">
                        @if($row->approved_file)
                            <a href="{{ asset('Files/' . $row->approved_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ 'ملف' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc; max-width:120px;">
                        @if($row->building_license_file)
                            <a href="{{ asset('Files/' . $row->building_license_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ 'ملف' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>


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








