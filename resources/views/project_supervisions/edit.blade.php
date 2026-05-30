@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid d-flex justify-content-center">
        <h3>تعديل إشراف</h3>
    </div>
</section>

<div class="content px-3">

    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4"
         style="background-color:#f5f5dc; border-radius:20px;">

        {!! Form::model($projectSupervision, [
    'route' => [
        'projects.supervisions.update',
        $projectSupervision->project_id,
        $projectSupervision->id
    ],
    'method' => 'patch',
    'files' => true
]) !!}

        <input type="hidden"
               name="project_id"
               value="{{ $projectSupervision->project_id }}">

        <div class="card-body d-flex flex-wrap gap-3">

            {{-- مرحلة الاشراف --}}
            <div style="min-width:250px;max-width:250px;">

                {!! Form::label('supervision_type_id', 'مرحلة الاشراف') !!}

                {!! Form::select(
                    'supervision_type_id',
                    $stages,
                    $projectSupervision->supervision_type_id,
                    [
                        'class' => 'form-control',
                        'placeholder' => '-- اختر المرحلة --',
                        'required'
                    ]
                ) !!}

            </div>

            {{-- المشرف --}}
            <div style="min-width:250px;max-width:250px;">

                {!! Form::label('user_id', 'المشرف') !!}

                {!! Form::select(
                    'user_id',
                    $users,
                    $projectSupervision->user_id,
                    [
                        'class' => 'form-control',
                        'placeholder' => '-- اختر المشرف --',
                        'required'
                    ]
                ) !!}

            </div>

            {{-- المرفق --}}
            <div class="col-md-3">

                <div class="border rounded p-2 small bg-light attachment-box">

                    <input type="file"
                           name="attachment"
                           class="form-control form-control-sm attachment-input mb-1">

                    <div class="text-truncate selected-file-name {{ $projectSupervision->attachment ? '' : 'd-none' }}">
                        {{ $projectSupervision->attachment ?? '' }}
                    </div>

                    @if($projectSupervision->attachment)
                   
                        <a href="{{ asset('Files/'.$projectSupervision->attachment) }}"
                           target="_blank"
                           class="btn btn-sm btn-outline-success w-100 mt-1 preview-file">

                            👁 Preview
                        </a>
                    @else
                        <a href="#"
                           target="_blank"
                           class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">

                            👁 Preview
                        </a>
                    @endif

                    <button type="button"
                            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">

                        🗑 Remove
                    </button>

                </div>

            </div>

            {{-- الملاحظة --}}
            <div style="min-width:100%;">

                {!! Form::label('note', 'ملاحظة الاشراف') !!}

                {!! Form::textarea(
                    'note',
                    $projectSupervision->note,
                    [
                        'class' => 'form-control',
                        'rows' => 6,
                        'required',
                        'placeholder' => 'اكتب ملاحظات الاشراف هنا...'
                    ]
                ) !!}

            </div>

        </div>

        <div class="card-footer d-flex justify-content-center gap-3">

            {!! Form::submit('تحديث الاشراف', [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color:#2f3a1f;color:#d4af37;font-weight:600;padding:10px 30px;'
            ]) !!}

            <a href="{{ route('projects.supervisions.index', $projectSupervision->project_id) }}"
               class="btn btn-secondary btn-sm">
                رجوع
            </a>

        </div>

        {!! Form::close() !!}

    </div>
</div>

@endsection