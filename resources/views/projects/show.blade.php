@extends('layouts.app')

@section('content')

<style>
    .btn-olive {
        background-color: #d4af37;   
        border: 1px solid #2f3a1f;
        color: #2f3a1f;              
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

<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;padding:0px;">

 
    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">
        <h4 class="card-title mb-0">
            {{ __('تفاصيل الملاك والمساحات') }}
        </h4>

        <a href="{{ route('projects.index') }}" class="btn btn-olive btn-sm">
            انتقل إلى الجدول
        </a>
    </div>

    {{-- Table --}}
    <div class="table-responsive p-3">
        <table class="table table-hover align-middle text-nowrap" style="border:1px solid #D4AF37; background-color:#f5f5dc;">
            <thead>
            <tr>
                <th>الرقم التسلسلي</th>
                <th>اسم المالك</th>
                <th>المساحة الإجمالية</th>
            </tr>
            </thead>
            <tbody>
            @php
    $totalArea = 0;//   <!-- @include('projects.partials.project-actions', ['project' => $project]) -->

@endphp

@foreach($ownersData as $index => $owner)
<tr>
    <td>{{ $index + 1 }}</td>
    <td>{{ $owner->ownerUser->name ?? '—' }}</td>
    <td>{{ number_format($owner->total_area, 2) }} م²</td>
</tr>

@php
    $totalArea += $owner->total_area;
@endphp
@endforeach
            </tbody>
            <tfoot>
<tr>
    <td colspan="2" style="text-align:right;font-weight:bold;">
        إجمالي المساحات
    </td>
    <td>{{ number_format($totalArea, 2) }} م²</td>
</tr>
</tfoot>
        </table>
    </div>

</div>

@endsection