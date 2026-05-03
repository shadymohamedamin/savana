@extends('layouts.app')

@section('content')

<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">

        <h4 class="mb-0">رسائل المشروع</h4>

        <a href="{{ route('projectws.messages.create', $project->id) }}"
           class="btn btn-sm"
           style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-plus"></i> رسالة جديدة
        </a>
    </div>

    {{-- Table --}}
    <div class="table-responsive p-3">
        <table class="table table-hover align-middle">

            <thead>
                <tr>
                    <th>#</th>
                    <th>من</th>
                    <th>إلى</th>
                    <th>CC</th>
                    <th>نوع الرسالة</th>
                    <th>الرسالة</th>
                    <th>مرفق</th>
                    <th>التاريخ</th>
                </tr>
            </thead>

            <tbody>
                @forelse($messages as $i => $msg)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $msg->sender->name ?? '-' }}</td>
                        <td>{{ $msg->receiver->name ?? '-' }}</td>
                        <td>{{ $msg->cc->name ?? '-' }}</td>
                        <td>{{ $msg->type->name_ar ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($msg->message, 40) }}</td>

                        <td>
                            @if($msg->attachment)
                                <a href="{{ asset('storage/'.$msg->attachment) }}" target="_blank">
                                    📎
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $msg->created_at->format('Y-m-d') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center">لا توجد رسائل</td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>

@endsection