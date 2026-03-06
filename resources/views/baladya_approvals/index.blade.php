










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
                {{-- <th style="background:#f5f5dc;">{{ __('مخطط صرف صحي ') }}</th>
                <th style="background:#f5f5dc;">{{ __('رخصة البناء') }}</th>
                

                <th style="background:#f5f5dc;">{{ __('مخطط معماري') }}</th>
                <th style="background:#f5f5dc;">{{ __('مخطط انشائي') }}</th>
                <th style="background:#f5f5dc;">{{ __('مخطط كهربا') }}</th>
                <th style="background:#f5f5dc;">{{ __('مخطط ماي') }}</th>
                <th style="background:#f5f5dc;">{{ __('مخطط اتصالات') }}</th> --}}

                <th style="background:#f5f5dc;">{{ __('الملفات') }}</th>
                
                <th style="background:#f5f5dc;">{{ __('الإجراءات') }}</th>

            </tr>
            </thead>

            <tbody>
            @foreach($baladyaApprovals as $i => $row)
                <tr   data-href="{{ route('projects.baladya-approvals.edit', [
                        'project' => $projectId,
                        'id' => $row->id
                    ]) }}?owner_id={{ request('owner_id') }}"
                    class="clickable-row"
                    style="cursor:pointer;">
                    




                   @php
                        $excludeTypes = ['رخصة جديدة', 'اعتماد مخطط', 'تعديل وإضافة'];
                        $siteDiff = '-';

                        if (
                            $row->opened_at &&
                            !in_array($row->statusType->name_ar ?? '', $excludeTypes)
                        ) {
                            // نلف على الحالات اللي قبلها (فوقها في الجدول)
                            for ($j = $i - 1; $j >= 0; $j--) {
                                $prev = $baladyaApprovals[$j];

                                if (
                                    $prev->opened_at &&
                                    !in_array($prev->statusType->name_ar ?? '', $excludeTypes)
                                ) {
                                    $siteDiff = $row->opened_at->diffInDays($prev->opened_at);
                                    break;
                                }
                            }
                        }
                    @endphp




                
                    <td style="background:#f5f5dc;">
                        {{ $row->statusType->name_ar ?? '-' }}
                    </td>

                    <td style="background:#f5f5dc;" onclick="event.stopPropagation();">{{ $row->case_number }}</td>
                    <td style="background:#f5f5dc;">{{ $row->opened_at ? $row->opened_at->format('Y-m-d') : '-' }}</td>
                    <td style="background:#f5f5dc;">{{ $row->approved_at ? $row->approved_at->format('Y-m-d') : '-' }}</td>
                    <!-- <td style="background:#f5f5dc;">{{ $row->days_diff ?? '-' }}</td> -->

                    <td style="background:#f5f5dc;">
                        @if(in_array($row->statusType->name_ar ?? '', $excludeTypes))
                            {{ $row->days_diff ?? '-' }}
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc;">{{ $siteDiff }}</td>


                    <td style="background:#f5f5dc;">{{ $row->reason }}</td>
                    <td style="background:#f5f5dc;">{{ $row->building_license_number }}</td>
                    
                    
                    
{{-- <td style="background:#f5f5dc;" onclick="event.stopPropagation();">

@php
    $files = [
        'مخطط صرف صحي' => $row->approved_file,
        'رخصة البناء' => $row->building_license_file,
        'مخطط معماري' => $row->architect_file,
        'مخطط انشائي' => $row->civil_file,
        'مخطط كهربا' => $row->electrical_file,
        'مخطط ماي' => $row->water_file,
        'مخطط اتصالات' => $row->etisalat_file,
    ];

    $hasFiles = collect($files)->filter()->count();
@endphp

@if($hasFiles)

<button class="btn btn-sm btn-dark"
        data-bs-toggle="modal"
        data-bs-target="#filesModal{{ $row->id }}">

📁 {{ $hasFiles }} ملف

</button>

@else
-
@endif

</td> --}}
                    
      







<td style="background:#f5f5dc;" onclick="event.stopPropagation();">

@php
$files = [
'مخطط صرف صحي' => $row->approved_file,
'رخصة البناء' => $row->building_license_file,
'مخطط معماري' => $row->architect_file,
'مخطط انشائي' => $row->civil_file,
'مخطط كهربا' => $row->electrical_file,
'مخطط ماي' => $row->water_file,
'مخطط اتصالات' => $row->etisalat_file,
];

$hasFiles = collect($files)->filter()->count();
@endphp

@if($hasFiles)

<div class="dropdown">

<button class="btn btn-sm btn-dark dropdown-toggle files-btn"
        data-bs-toggle="dropdown">

📁 {{ $hasFiles }} ملف

</button>

<ul class="dropdown-menu dropdown-menu-end glass-files">

@foreach($files as $name => $file)

@if($file)

<li>

<a href="{{ asset('Files/' . $file) }}"
   target="_blank"
   class="dropdown-item file-link">

📄 {{ $name }}

</a>

</li>

@endif

@endforeach

</ul>

</div>

@else
-
@endif

</td>





                    
                    {{-- <td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->approved_file)
                            <a href="{{ asset('Files/' . $row->approved_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ ' صرف صحي' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->building_license_file)
                            <a href="{{ asset('Files/' . $row->building_license_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ 'رخصة البناء' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>








<td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->architect_file)
                            <a href="{{ asset('Files/' . $row->architect_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ ' معماري' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->civil_file)
                            <a href="{{ asset('Files/' . $row->civil_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ ' انشائي' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->electrical_file)
                            <a href="{{ asset('Files/' . $row->electrical_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ ' كهربا' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->water_file)
                            <a href="{{ asset('Files/' . $row->water_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ '	 ماي' }}
                            </a>
                        @else
                            -
                        @endif
                    </td>
                    <td style="background:#f5f5dc; max-width:120px;" onclick="event.stopPropagation();">
                        @if($row->etisalat_file)
                            <a href="{{ asset('Files/' . $row->etisalat_file) }}"
                            target="_blank"
                            class="text-truncate text-primary fw-semibold" style="max-width:120px;">
                                📄 {{ ' اتصالات' }}
                            </a>
                        @else
                            -
                        @endif
                    </td> --}}











                    <td style="background:#f5f5dc;"  onclick="event.stopPropagation();">
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

{{-- <div class="modal fade" id="filesModal{{ $row->id }}" tabindex="-1">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">ملفات المعاملة</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>

<div class="modal-body">

@foreach($files as $name => $file)

@if($file)

<a href="{{ asset('Files/' . $file) }}"
   target="_blank"
   class="d-block mb-2 p-2 border rounded text-decoration-none">

📄 {{ $name }}

</a>

@endif

@endforeach

</div>

</div>
</div>
</div> --}}


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







@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.clickable-row').forEach(row => {
            row.addEventListener('click', function () {
                window.location.href = this.dataset.href;
            });
        });
    });
</script>
@endpush




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


.glass-dropdown {
    background: rgba(255, 255, 255, 0.4); /* لون تلجي */
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px); /* للمتصفحات القديمة */

    border-radius: 10px;
    border: 1px solid rgba(255,255,255,0.3);

    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}




.files-hover-box{
    cursor:pointer;
    position:relative;
    font-weight:600;
}

.files-popup{
    display:none;
    position:absolute;
    top:100%;
    right:0;
    background:white;
    border:1px solid #ddd;
    border-radius:10px;
    box-shadow:0 8px 20px rgba(0,0,0,0.15);
    padding:8px;
    min-width:160px;
    z-index:999;
}

.file-item{
    display:block;
    padding:6px 10px;
    color:#2f3a1f;
    text-decoration:none;
    font-size:13px;
}

.file-item:hover{
    background:#f5f5dc;
    border-radius:6px;
}

.files-hover-box:hover .files-popup{
    display:block;
}





.glass-files{

background: rgba(255,255,255,0.35);
backdrop-filter: blur(14px);
-webkit-backdrop-filter: blur(14px);

border-radius:12px;
border:1px solid rgba(255,255,255,0.4);

box-shadow:0 10px 25px rgba(0,0,0,0.15);

padding:6px;
min-width:200px;

animation: filesFade 0.25s ease;

}

.file-link{

font-weight:600;
border-radius:8px;
transition:0.25s;

}

.file-link:hover{

background:rgba(212,175,55,0.18);
transform:translateX(-3px);

}

@keyframes filesFade{

from{
opacity:0;
transform:translateY(6px);
}

to{
opacity:1;
transform:translateY(0);
}

}



</style>
@endpush








