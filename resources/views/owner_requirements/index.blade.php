@extends('layouts.app')

@section('content')

<div class="card shadow-sm rounded-4"
     style="background-color:#f5f5dc;margin:40px;padding:0px;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.2rem;font-weight:600;">

        <div>
            <h4 class="mb-0">
                {{ __('متطلبات المالك') }}
            </h4>
            <small>
                المشروع: <strong>{{ $project->name }}</strong> |
                المالك: <strong>{{ $project->ownerUser?->name ?? '—' }}</strong>
            </small>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('projects.index') }}"
               class="btn btn-olive btn-sm">
                <i class="fas fa-arrow-left"></i> {{ __('العودة الي المشاريع') }}
            </a>
        </div>
    </div>

    {{-- Content --}}
    <div class="p-4" style="background:#f5f5dc;">

        <form method="POST"
              action="{{ route('projects.owner-requirements.store',$project) }}">
            @csrf

            {{-- Ground Floor --}}
            <h5 class="mb-3 fw-bold text-center">
                الدور الأرضي
            </h5>

            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle text-center"
                       style="background:#f5f5dc;border:1px solid #D4AF37;">

                    <thead>
                        <tr>
                            <th>اختيار</th>
                            <th>الاحتياج</th>
                            <th style="width:120px;">العدد</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($requirements['ground'] ?? [] as $req)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       class="form-check-input"
                                       {{ isset($selected[$req->id]) ? 'checked' : '' }}>
                            </td>
                            <td class="text-end px-3">
                                {{ $req->name }}
                            </td>
                            <td>
                                <input type="number"
                                       min="1"
                                       class="form-control text-center"
                                       name="requirements[{{ $req->id }}]"
                                       value="{{ $selected[$req->id]->pivot->quantity ?? '' }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- First Floor --}}
            <h5 class="mb-3 fw-bold text-center">
                الدور الأول
            </h5>

            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle text-center"
                       style="background:#f5f5dc;border:1px solid #D4AF37;">

                    <thead>
                        <tr>
                            <th>اختيار</th>
                            <th>الاحتياج</th>
                            <th style="width:120px;">العدد</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($requirements['first'] ?? [] as $req)
                        <tr>
                            <td>
                                <input type="checkbox"
                                       class="form-check-input"
                                       {{ isset($selected[$req->id]) ? 'checked' : '' }}>
                            </td>
                            <td class="text-end px-3">
                                {{ $req->name }}
                            </td>
                            <td>
                                <input type="number"
                                       min="1"
                                       class="form-control text-center"
                                       name="requirements[{{ $req->id }}]"
                                       value="{{ $selected[$req->id]->pivot->quantity ?? '' }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Actions --}}
            <div class="text-end">
                <button class="btn btn-olive px-4">
                    <i class="fas fa-save"></i> حفظ المتطلبات
                </button>
            </div>

        </form>
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
