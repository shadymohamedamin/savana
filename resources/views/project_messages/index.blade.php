@extends('layouts.app')

@section('content')




<style>

    .msg-row {
        cursor: pointer;
        transition: 0.2s;
    }

    .msg-row:hover {
        background: #f0ead6;
    }

    .replies-box {
        background: #eee;
        padding: 10px;
        margin-top: 5px;
        border-radius: 8px;
    }

    .reply-item {
        background: #fff;
        margin-bottom: 8px;
        padding: 10px;
        border-radius: 6px;
        border-right: 3px solid #2f3a1f;
    }



.replies-box {
    background: #f3f3f3;
    border-right: 4px solid #999;
}







.preview-btn {
    padding-bottom: 0px !important;
}
</style>


<div class="card shadow-sm rounded-4" style="background-color:#f5f5dc;margin:40px;">

    {{-- Header --}}
    <div class="card-header d-flex justify-content-between align-items-center"
         style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">

        <h4 class="mb-0">رسائل المشروع</h4>

        <a href="{{ route('projects.messages.create', $project->id) }}"
           class="btn btn-sm"
           style="background:#2f3a1f;color:#d4af37;">
            <i class="fas fa-plus"></i> رسالة جديدة
        </a>
    </div>

    {{-- Table --}}
    <div class="table-responsive p-3">
        <table class="table table-hover align-middle">

            <thead>
                <tr >
                    <th>#</th>
                    <th>من</th>
                    <th>إلى</th>
                    <th>CC</th>
                    <th>نوع الرسالة</th>
                    <th>الرسالة</th>
                    <th>مرفق</th>
                    <th>التاريخ</th>
                    <th>الاعدادات</th>
                </tr>
            </thead>

            <tbody>
                @forelse($messages as $i => $msg)
                    <tr class="msg-row" onclick="toggleReplies({{ $msg->id }})">
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $msg->sender->name ?? '-' }}</td>
                        <td>{{ $msg->receiver->name ?? '-' }}</td>
                        <td>{{ $msg->ccUser->name ?? '-' }}</td>
                        <td>{{ $msg->messageType->name_ar ?? '-' }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($msg->message, 40) }}</td>

                        <td>
                            @if($msg->attachment)
                                <a href="{{ asset('Files/'.$msg->attachment) }}" target="_blank">
                                    📎
                                </a>
                            @else
                                -
                            @endif
                        </td>

                        <td>{{ $msg->created_at->format('Y-m-d') }}</td>

                        <!-- <td style="background:#fff;" onclick="event.stopPropagation();">

                            <div class="dropdown">

                                <button class="btn btn-sm btn-olive dropdown-toggle"
                                        style="background:#2f3a1f;color:#d4af37;font-weight:600;"
                                        data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </button>

                                <ul class="dropdown-menu dropdown-menu-end" style="background:#f5f5dc;">

                                    {{-- 👇 رد على الرسالة --}}
                                    <li>
                                        <a class="dropdown-item"
                                        href="{{ route('projects.messages.create', $project->id) }}?reply_to={{ $msg->id }}">

                                            <i class="fas fa-reply"></i> رد
                                        </a>
                                    </li>

                                    <li><hr class="dropdown-divider"></li>

                                    {{-- ملاحظة: ممكن تخلي حذف/تعديل لو عايز --}}
                                </ul>

                            </div>

                            </td> -->


                            <td onclick="event.stopPropagation();">
    <div class="d-flex gap-1">

        {{-- 👁 معاينة --}}
        <a target="_blank"
   href="{{ route('projects.contract.message.pdf', [
        'id' => $project->id,
        'message_id' => $msg->id, // 👈 مهم جدا
        'action' => 'preview'
   ]) }}"
   class="btn btn-sm btn-dark preview-btn"
   title="معاينة">
    <i class="fas fa-eye"></i>
</a>

        {{-- ↩️ رد --}}
        <a href="{{ route('projects.messages.create', $project->id) }}?reply_to={{ $msg->id }}"
           class="btn btn-sm btn-olive"
           title="رد">
            <i class="fas fa-reply"></i>
        </a>

        {{-- 🗑 حذف --}}
        <form method="POST"
              action="{{ route('projects.messages.destroy', $msg->id) }}">
            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-sm btn-danger"
                    title="حذف"
                    onclick="return confirm('هل أنت متأكد من حذف الرسالة؟')">
                <i class="fas fa-trash"></i>
            </button>
        </form>

    </div>
</td>


                            
                    </tr>


                    <tr>
    <td colspan="9">

        <div id="replies-{{ $msg->id }}" class="replies-box" style="display:none;">

            @forelse($msg->replies as $reply)

                <!-- <div class="reply-item">

                    <div class="d-flex justify-content-between">
                        <strong>{{ $reply->sender->name ?? '-' }}</strong>
                        <small>{{ $reply->created_at->format('Y-m-d H:i') }}</small>
                    </div>

                    <div style="margin-top:5px;">
                        {{ $reply->message }}
                    </div>

                    @if($reply->attachment)
                        <a href="{{ asset('Files/'.$reply->attachment) }}" target="_blank">
                            📎 ملف
                        </a>
                    @endif

                </div> -->




                <div class="reply-item">




                <div class="d-flex justify-content-between align-items-center">
        <strong>{{ $reply->sender->name ?? '-' }}</strong>

        <div class="d-flex gap-1">

            {{-- 👁 --}}
            <a href="{{ route('projects.contract.message.pdf', [
        'id' => $project->id,
        'message_id' => $reply->id,
        'action' => 'preview'
   ]) }}"
               class="btn btn-sm btn-dark">
                <i class="fas fa-eye"></i>
            </a>

            {{-- 🗑 --}}
            <form method="POST"
                  action="{{ route('projects.messages.destroy', $reply->id) }}">
                @csrf
                @method('DELETE')

                <button class="btn btn-sm btn-danger"
                        onclick="return confirm('حذف الرد؟')">
                    <i class="fas fa-trash"></i>
                </button>
            </form>

        </div>
    </div>

    <small>{{ $reply->created_at->format('Y-m-d H:i') }}</small>

    <div class="mt-2">
        {{ $reply->message }}
    </div>

    @if($reply->attachment)
        <a href="{{ asset('Files/'.$reply->attachment) }}" target="_blank">
            📎 ملف
        </a>
    @endif

</div>

            @empty
                <div class="text-muted">لا توجد ردود</div>
            @endforelse

        </div>

    </td>
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


<script>

function showReplyForm(messageId){
    document.getElementById('parent_id').value = messageId;
    document.getElementById('message').focus();
}





</script>



<script>
function toggleReplies(id) {
    let el = document.getElementById('replies-' + id);

    if (el.style.display === 'none' || el.style.display === '') {
        el.style.display = 'block';
    } else {
        el.style.display = 'none';
    }
}
</script>