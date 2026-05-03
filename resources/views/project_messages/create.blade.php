@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <h3>إنشاء رسالة جديدة</h3>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color:#f5f5dc;">

        {!! Form::open([
            'route' => ['projects.messages.store', $project->id],
            'files' => true
        ]) !!}

        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <input type="hidden" name="sender_id" value="{{ auth()->id() }}">

        <div class="card-body d-flex flex-wrap gap-3">

            {{-- نوع الرسالة --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('message_type_id', 'نوع الرسالة') !!}
                {!! Form::select('message_type_id', $types, null, [
                    'class' => 'form-control',
                    'placeholder' => '-- اختر --',
                    'required'
                ]) !!}
            </div>

            {{-- المرسل إليه --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('receiver_id', 'إلى') !!}
                {!! Form::select('receiver_id', $users, null, [
                    'class' => 'form-control',
                    'placeholder' => '-- اختر --',
                    'required'
                ]) !!}
            </div>

            {{-- CC (اختياري) --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('cc_id', 'CC (اختياري)') !!}
                {!! Form::select('cc_id', $users, null, [
                    'class' => 'form-control',
                    'placeholder' => '-- بدون'
                ]) !!}
            </div>

            {{-- عنوان --}}
            <div style="min-width:250px;max-width:250px;">
                {!! Form::label('subject', 'عنوان الرسالة') !!}
                {!! Form::text('subject', null, [
                    'class' => 'form-control'
                ]) !!}
            </div>



            {{-- مرفق واحد --}}
            <div class="col-md-3">
                <div class="border rounded p-2 small bg-light attachment-box">

                    <input type="file" name="attachment" class="form-control form-control-sm attachment-input mb-1">

                    <div class="text-truncate selected-file-name d-none"></div>

                    <a href="#" target="_blank"
                       class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
                        👁 Preview
                    </a>

                    <button type="button"
                            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
                        🗑 Remove
                    </button>

                </div>
            </div>

            {{-- الرسالة --}}
            <div style="min-width:100%;">
                {!! Form::label('message', 'نص الرسالة') !!}
                {!! Form::textarea('message', null, [
                    'class' => 'form-control',
                    'rows' => 5,
                    'required'
                ]) !!}
            </div>

            

        </div>

        {{-- Footer --}}
        <div class="card-footer d-flex justify-content-center gap-3">

            {!! Form::submit('إرسال', [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color:#2f3a1f;color:#d4af37;font-weight:600;'
            ]) !!}

            <a href="{{ route('projects.messages.index', $project->id) }}"
               class="btn btn-secondary btn-sm">
                رجوع
            </a>

        </div>

        {!! Form::close() !!}
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const input = document.querySelector('.attachment-input');
    const box = document.querySelector('.attachment-box');

    input.addEventListener('change', function () {
        const fileName = box.querySelector('.selected-file-name');
        const preview = box.querySelector('.preview-file');

        if (!this.files.length) return;

        const file = this.files[0];

        fileName.textContent = file.name;
        fileName.classList.remove('d-none');

        preview.href = URL.createObjectURL(file);
        preview.classList.remove('d-none');
    });

    document.querySelector('.remove-file').addEventListener('click', function () {
        input.value = '';

        box.querySelectorAll('.preview-file,.selected-file-name')
            .forEach(el => el.classList.add('d-none'));
    });

});
</script>
@endpush