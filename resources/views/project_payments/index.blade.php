@extends('layouts.app')

@section('content')





<div style="margin-right:2rem;">
    @include('projects.partials.project-actions', ['project' => $project])
</div>

<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;padding:0px;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">
        <h4 class="card-title mb-0">
            {{ __('دفعات المشروع') }}
        </h4>

        <div class="d-flex gap-2">
            <button onclick="window.print()"
                    class="btn btn-olive btn-sm"
                    style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-print"></i> طباعة
            </button>


            <a href="{{ route('projects.index') }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-arrow-left"></i> {{ __('العودة الي المشاريع') }}
            </a>

            <a href="{{ route('projects.project-payments.create', $project->id) }}"
               class="btn btn-olive btn-sm" style="background:#2f3a1f;color:#d4af37;font-weight:600;">
                <i class="fas fa-plus"></i> {{ __('اضافة دفعة') }}
            </a>


        </div>
    </div>

    {{-- Summary --}}
    @php
    // Base values   $project->bank_contract_value_bank
    $bankLimit = $project->financing_type == 'bank' || $project->financing_type == 'bank_owner' ? 800000 : 0;//800000; // أو العمود اللي مخزن تمويل البنك
    $contractWithVat = $project->bank_contract_value; // الإجمالي (مع الضريبة)

    $vatRate = 0.05;

    // Calculate VAT & contract without VAT
    $contractWithoutVat = $contractWithVat / (1 + $vatRate);
    $vatAmount = $contractWithVat - $contractWithoutVat;

    // Owner & Bank
    $ownerTotal = $contractWithVat - $bankLimit;

    // Payments
    $bankPaid  = $payments->where('payer_type','bank')->sum('total_amount');
    $ownerPaid = $payments->where('payer_type','owner')->sum('total_amount');

    $bankVatTotal  = $payments->where('payer_type','bank')->sum('vat_amount');
    $ownerVatTotal = $payments->where('payer_type','owner')->sum('vat_amount');

    // Remaining
    $bankRemaining  = $bankLimit - $bankPaid;
    $ownerRemaining = $ownerTotal - $ownerPaid;
    $totalRemaining = $contractWithVat - ($bankPaid + $ownerPaid);
@endphp


<!-- 
 {{-- Names --}}
<div class="row mb-3 text-center mt-4 mx-2">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body fw-bold">
                {{ $project->contractorUser?->name ?? '—' }}
                <div class="text-muted small">المقاول</div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body fw-bold">
                {{ $project->ownerUser?->name ?? '—' }}
                <div class="text-muted small">المالك</div>
            </div>
        </div>
    </div>
</div>

{{-- Contract --}}
<div class="row mb-3 text-center mx-2">
    

    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>{{ number_format($contractWithoutVat,0) }}</h5>
                <small class="text-muted">قيمة العقد بدون ضريبة (AED)</small>
                <small class="text-muted">{{'الضريبة: ' . '5%' }}</small>
                
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5>{{ number_format($contractWithVat,0) }}</h5>
                <small class="text-muted">قيمة العقد بالضريبة</small>
            </div>
        </div>
    </div>


</div>


{{-- Financing --}}
<div class="row mb-3 text-center mx-2">
    <div class="col-md-6">
        <div class="card border-info shadow-sm">
            <div class="card-body">
                <h5>{{ number_format($ownerTotal,0) }}</h5>
                <small class="text-muted">تمويل المالك</small>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <h5>{{ number_format($bankLimit,0) }}</h5>
                <small class="text-muted">تمويل البنك</small>
            </div>
        </div>
    </div>

    
</div>





{{-- Remaining --}}
<div class="row text-center mb-4 mx-2">
    <div class="col-md-6">
        <div class="card border-info shadow-sm">
            <div class="card-body">
                <h5>{{ number_format($ownerRemaining,0) }}</h5>
                <small>المبلغ المطلوب / المالك</small>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-primary shadow-sm">
            <div class="card-body">
                <h5>{{ number_format($bankRemaining,0) }}</h5>
                <small>المبلغ المطلوب / البنك</small>
            </div>
        </div>
    </div>
</div>

{{-- Payments --}}
<div class="row mb-3 text-center mx-2">
    <div class="col-md-6">
        <div class="card border-success shadow-sm">
            <div class="card-body">
                <h5 class="text-success">{{ number_format($bankPaid + $ownerPaid,0) }}</h5>
                <small>المبلغ المدفوع</small>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card border-warning shadow-sm">
            <div class="card-body">
                <h5 class="text-warning">{{ number_format($totalRemaining,0) }}</h5>
                <small>المبلغ المتبقي</small>
            </div>
        </div>
    </div>
</div> -->





<table class="table table-bordered table-sm text-center align-middle ">
    <tbody>

        {{-- الأطراف --}}
        <tr class="table-light fw-bold">
            <td>المقاول</td>
            <td>{{ $project->contractorUser?->name ?? '—' }}</td>
            <td>المالك</td>
            <td>{{ $project->ownerUser?->name ?? '—' }}</td>
        </tr>


        <tr class="table-light fw-bold">
            <td>المنطقة</td>
            <td>{{ $project->projectRegion->name_ar ?? '—' }}</td>
            <td>رقم القسيمة</td>
            <td>{{ $project->qasmia_number ?? '—' }}</td>
        </tr>

        {{-- العقد --}}
        <tr>
            <td>قيمة العقد بدون ضريبة</td>
            <td>{{ number_format($contractWithoutVat,0) }}</td>
            <td>قيمة العقد بالضريبة</td>
            <td>{{ number_format($contractWithVat,0) }}</td>
        </tr>

        {{-- التمويل --}}
        <tr class="table-info">
            <td>تمويل المالك</td>
            <td>{{ number_format($ownerTotal,0) }}</td>
            <td>تمويل البنك</td>
            <td>{{ number_format($bankLimit,0) }}</td>
        </tr>

        {{-- الضرائب --}}
        <tr class="table-warning">
            <td>مجموع ضرائب المالك</td>
            <td>{{ number_format($ownerVatTotal,0) }}</td>
            <td>مجموع ضرائب البنك</td>
            <td>{{ number_format($bankVatTotal,0) }}</td>
        </tr>

        {{-- المتبقي --}}
        <tr>
            <td>المبلغ المطلوب / المالك</td>
            <td>{{ number_format($ownerRemaining,0) }}</td>
            <td>المبلغ المطلوب / البنك</td>
            <td>{{ number_format($bankRemaining,0) }}</td>
        </tr>

        <tr class="table-success fw-bold">
            <td>المبلغ المدفوع من المالك</td>
            <td>{{ number_format($ownerPaid,0) }}</td>

            <td>المبلغ المدفوع من البنك</td>
            <td>{{ number_format($bankPaid,0) }}</td>
        </tr>

        {{-- المدفوع والمتبقي --}}
        <tr class="table-success fw-bold">
            <td>المبلغ المدفوع</td>
            <td>{{ number_format($bankPaid + $ownerPaid,0) }}</td>
            <td>المبلغ المتبقي</td>
            <td>{{ number_format($totalRemaining,0) }}</td>
        </tr>

    </tbody>
</table>





















{{-- Payments Table --}}
@php
    $bankRunningPaid = 0;
    $ownerRunningPaid = 0;
    $bankRunningRemaining  = $bankLimit;
    $ownerRunningRemaining = $ownerTotal;

    // totals
    $bankTotalGross = 0;
    $bankTotalNet   = 0;
    $bankTotalVat   = 0;

    $ownerTotalGross = 0;
    $ownerTotalNet   = 0;
    $ownerTotalVat   = 0;
@endphp




<hr class="my-4">




{{-- Owner Payments Table --}}
<table class="table table-bordered text-center mt-4">
    <thead class="table-warning text-center align-middle fw-bold">
        <tr><th colspan="7" style="text-align: center; margin:auto;">دفعات المالك</th></tr>
        <tr>
            <th>رقم الدفعة</th>
            <th>التاريخ</th>
            <!-- <th class="table-info">بالضريبة</th>
            <th class="table-info">الضريبة</th> -->
            <th class="table-info">بدون ضريبة</th>
            <th class="table-info">المدفوع</th>
            <th class="table-info">المتبقي</th>
        </tr>
    </thead>

    <tbody>
        @php $index = 0; @endphp

        @foreach($payments->where('payer_type','owner')->groupBy('payment_no') as $paymentNo => $group)
            @php
                $index++;
                $ownerPayment = $group->first();

                $ownerGross = $ownerPayment->total_amount ?? 0;
                $ownerNet   = $ownerPayment->net_amount ?? 0;
                $ownerVat   = $ownerGross - $ownerNet;

                $ownerRunningRemaining -= $ownerGross;
                $ownerRunningPaid += $ownerGross;

                // totals
                $ownerTotalGross += $ownerGross;
                $ownerTotalNet   += $ownerNet;
                $ownerTotalVat   += $ownerVat;
            @endphp

            <tr>
                <td class="fw-bold">{{ $index }}</td>
                <td>{{ optional($ownerPayment->payment_date)->format('d/m/Y') }}</td>
                <!-- <td class="table-info">{{ number_format($ownerGross,2) }}</td>
                <td class="table-info">{{ number_format($ownerVat,2) }}</td> -->
                <td class="table-info">{{ number_format($ownerNet,2) }}</td>
                <td class="table-info">{{ number_format($ownerRunningPaid,2) }}</td>
                <td class="table-info fw-bold">{{ number_format($ownerRunningRemaining,2) }}</td>
            </tr>
        @endforeach

        {{-- Total Row --}}
        <tr class="table-secondary fw-bold">
            <td colspan="2">المجموع</td>
            <td>{{ number_format($ownerTotalGross,2) }}</td>
            <td>{{ number_format($ownerTotalVat,2) }}</td>
            <td>{{ number_format($ownerTotalNet,2) }}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>



<hr class="my-4">




{{-- Bank Payments Table --}}
<table class="table table-bordered text-center mt-4">
    <thead class="table-warning text-center align-middle fw-bold">
        <tr><th colspan="7" style="text-align: center; margin:auto;">دفعات البنك</th></tr>
        <tr>
            <th>رقم الدفعة</th>
            <th>التاريخ</th>
            <!-- <th class="table-primary">بالضريبة</th>
            <th class="table-primary">الضريبة</th> -->
            <th class="table-primary">بدون ضريبة</th>
            <th class="table-primary">المدفوع</th>
            <th class="table-primary">المتبقي</th>
        </tr>
    </thead>

    <tbody>
        @php $index = 0; @endphp

        @foreach($payments->where('payer_type','bank')->groupBy('payment_no') as $paymentNo => $group)
            @php
                $index++;
                $bankPayment  = $group->first();

                $bankGross = $bankPayment->total_amount ?? 0;
                $bankNet   = $bankPayment->net_amount ?? 0;
                $bankVat   = $bankGross - $bankNet;

                $bankRunningRemaining -= $bankGross;
                $bankRunningPaid += $bankGross;

                // totals
                $bankTotalGross += $bankGross;
                $bankTotalNet   += $bankNet;
                $bankTotalVat   += $bankVat;
            @endphp

            <tr>
                <td class="fw-bold">{{ $index }}</td>
                <td>{{ $bankPayment->payment_date->format('d/m/Y') }}</td>
                <!-- <td class="table-primary">{{ number_format($bankGross,2) }}</td>
                <td class="table-primary">{{ number_format($bankVat,2) }}</td> -->
                <td class="table-primary">{{ number_format($bankNet,2) }}</td>
                <td class="table-primary">{{ number_format($bankRunningPaid,2) }}</td>
                <td class="table-primary fw-bold">{{ number_format($bankRunningRemaining,2) }}</td>
            </tr>
        @endforeach

        {{-- Total Row --}}
        <tr class="table-secondary fw-bold">
            <td colspan="2">المجموع</td>
            <td>{{ number_format($bankTotalGross,2) }}</td>
            <td>{{ number_format($bankTotalVat,2) }}</td>
            <td>{{ number_format($bankTotalNet,2) }}</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>



















@php
    $totalVatAll = 0;
@endphp

<hr class="my-4">

<table class="table table-bordered text-center mt-4">
    <thead class="table-warning align-middle fw-bold">
        <tr>
            <th colspan="4">ملخص الضرائب</th>
        </tr>
        <tr>
            <th>رقم الدفعة</th>
            <th>التاريخ</th>
            <th>الممول</th>
            <th>الضريبة</th>
        </tr>
    </thead>

    <tbody>
        @foreach($payments->groupBy('payment_no') as $paymentNo => $group)
            @foreach($group as $payment)
                @php
                    $vat = $payment->vat_amount ?? 0;
                    $totalVatAll += $vat;
                @endphp

                <tr>
                    <td class="fw-bold">{{ $paymentNo }}</td>
                    <td>{{ optional($payment->payment_date)->format('d/m/Y') ?? '-' }}</td>
                    <td>
                        @if($payment->payer_type === 'bank')
                            <span class="badge bg-primary">البنك</span>
                        @else
                            <span class="badge bg-info text-dark">المالك</span>
                        @endif
                    </td>
                    <td class="text-danger fw-bold">
                        {{ number_format($vat,2) }}
                    </td>
                </tr>
            @endforeach
        @endforeach

        {{-- Total --}}
        <tr class="table-secondary fw-bold">
            <td colspan="3">إجمالي الضرائب</td>
            <td class="text-danger">{{ number_format($totalVatAll,2) }}</td>
        </tr>
    </tbody>
</table>

















    </div>

</div>

@endsection







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
        border-color: #d4af37;
        color: #fff;
    }
    </style>
@endpush


