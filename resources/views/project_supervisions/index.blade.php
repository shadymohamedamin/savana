@extends('layouts.app')

@section('content')

<style>

    .supervision-row{
        cursor:pointer;
        transition:0.2s;
    }

    .supervision-row:hover{
        background:#f0ead6;
    }

    .preview-btn{
        padding-bottom:0px !important;
    }

</style>

<div class="card shadow-sm rounded-4"
     style="background-color:#f5f5dc;margin:40px;">

    {{-- Header --}}
<div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2"
     style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">

    <div class="d-flex align-items-center gap-3 flex-wrap">

        <h4 class="mb-0">
            الاشراف الهندسي
        </h4>

        {{-- عدد الزيارات --}}
        <div class="d-flex gap-2 flex-wrap">

            <span class="badge bg-dark p-2" style="font-size:14px;">
                إجمالي الزيارات:
                {{ $project->total_supervisions_count ?? 0 }}
            </span>

            <span class="badge bg-success p-2" style="font-size:14px;">
                زيارات الشهر الحالي:
                {{ $project->current_month_supervisions_count ?? 0 }}
            </span>

        </div>

    </div>

    {{-- زر الإضافة --}}
    <a href="{{ route('projects.supervisions.create', $project->id) }}"
       class="btn btn-sm"
       style="background:#2f3a1f;color:#d4af37;">

        <i class="fas fa-plus"></i>
        إضافة إشراف

    </a>

</div>

    {{-- Table --}}
    <div class="table-responsive p-3">

        <table class="table table-hover align-middle">

            <thead>

                <tr>

                    <th>#</th>

                    <th>المهندس</th>

                    <th>مرحلة الاشراف</th>

                    <th>الملاحظة</th>

                    <th>المرفق</th>

                    <th>التاريخ</th>

                    <th width="180">
                        الإعدادات
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($supervisions as $i => $supervision)

                    <tr class="supervision-row">

                        {{-- رقم --}}
                        <td>
                            {{ $i + 1 }}
                        </td>

                        {{-- المهندس --}}
                        <td>
                            {{ $supervision->user->name ?? '-' }}
                        </td>

                        {{-- المرحلة --}}
                        <td>

                            <span class="badge bg-dark">

                                {{ $supervision->supervisionType->name_ar ?? '-' }}

                            </span>

                        </td>

                        {{-- الملاحظة --}}
                        <td>

                            {{ \Illuminate\Support\Str::limit($supervision->note, 60) }}

                        </td>

                        {{-- المرفق --}}
                        <td>

                            @if($supervision->attachment)

                                <a href="{{ asset('Files/'.$supervision->attachment) }}"
                                   target="_blank">

                                    📎 عرض

                                </a>

                            @else

                                -

                            @endif

                        </td>

                        {{-- التاريخ --}}
                        <td>

                            {{ $supervision->created_at->format('Y-m-d') }}

                        </td>

                        {{-- الاعدادات --}}
                        <td onclick="event.stopPropagation();">

                            <div class="d-flex gap-1">

                                {{-- معاينة --}}
                                <a target="_blank"
                                   href="{{ asset('Files/'.$supervision->attachment) }}"
                                   class="btn btn-sm btn-dark preview-btn"
                                   title="معاينة">

                                    <i class="fas fa-eye"></i>

                                </a>

                                {{-- تعديل --}}
                                <a href="{{ route('projects.supervisions.edit', [
                                        $project->id,
                                        $supervision->id
                                    ]) }}"
                                   class="btn btn-sm btn-primary"
                                   title="تعديل">

                                    <i class="fas fa-edit"></i>

                                </a>

                                {{-- حذف --}}
                                <form method="POST"
                                      action="{{ route('projects.supervisions.destroy', [
                                                $project->id,
                                                $supervision->id
                                            ]) }}">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="حذف"
                                            onclick="return confirm('هل أنت متأكد من الحذف؟')">

                                        <i class="fas fa-trash"></i>

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="7" class="text-center">

                            لا توجد بيانات إشراف

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection