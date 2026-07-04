@extends('layouts.app')

@section('content')









<style>
/* container */
.contract-grid{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr)); /* إنشاء شبكة مرنة للكروت */
    gap: 16px;
    background: #f5f5dc;
    padding: 15px;
}

/* box */
.contract-box{
    background: white;
    border: 1px solid #e5e5e5;
    border-radius: 10px;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 170px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    transition: 0.2s;
}

.contract-box:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

/* title */
.contract-box span {
    font-weight: 600;
    font-size: 14px;
    text-align: center;
    margin-bottom: 10px;
}

/* buttons */
.contract-box .btn {
    width: 100%;
}

/* button styles */
.btn-olive {
    background-color: #d4af37; /* اللون الزيتوني */
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
    box-shadow: 0 6px 18px rgba(212, 175, 55, 0.35);
}

</style>


@if(!request('isDesignsApproved'))

<section class="content-header">
    <div class="container-fluid">
        <h3>{{ __('Edit') }} {{ __('Baladya Approval') }}</h3>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">
        {!! Form::model($baladyaApproval, ['route' => ['projects.baladya-approvals.update', $projectId, $baladyaApproval->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'files' => true]) !!}
        <input type="hidden" name="owner_id" value="{{ request('owner_id') }}">
        <input type="hidden" name="project_id" value="{{ $projectId }}">
        
        <div class="card-body d-flex flex-wrap gap-3">
            {{-- Status Type --}}
            <div style="min-width: 250px;">
                {!! Form::label('status_type_id', __('نوع الحالة')) !!}
                {!! Form::select(
                    'status_type_id',
                    $statusTypes,
                    old('status_type_id', optional($baladyaApproval)->status_type_id),
                    ['class' => 'form-control', 'required']
                ) !!}

            </div>

            {{-- Case Number --}}
            <div style="min-width: 250px;">
                {!! Form::label('case_number', __('رقم الحالة')) !!}
                {!! Form::text('case_number', $baladyaApproval->case_number, ['class' => 'form-control']) !!}
            </div>

            {{-- Opened At --}}
            <div style="min-width: 250px;">
                {!! Form::label('opened_at', __('تاريخ فتح المعاملة')) !!}
                {!! Form::date('opened_at', $baladyaApproval->opened_at?->format('Y-m-d'), ['class' => 'form-control', 'required']) !!}
            </div>

            {{-- Approved At --}}
            <div style="min-width: 250px;">
                {!! Form::label('approved_at', __('تاريخ اعتماد المعاملة')) !!}
                {!! Form::date('approved_at', $baladyaApproval->approved_at?->format('Y-m-d'), ['class' => 'form-control']) !!}
            </div>

            {{-- Reason --}}
            <div style="min-width: 250px;">
                {!! Form::label('reason', __('السبب')) !!}
                {!! Form::text('reason', $baladyaApproval->reason, ['class' => 'form-control']) !!}
            </div>

            <!-- <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('approved_file', __('الملف المعتمد')) !!}
                {!! Form::file('approved_file', ['class' => 'form-control rounded']) !!}

                @if(isset($baladyaApproval) && $baladyaApproval->approved_file)
                    <a href="{{ asset('Files/' . $baladyaApproval->approved_file) }}" target="_blank">
                        {{ __('View Current File') }}
                    </a>
                @endif
            </div> -->
            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('approved_file', __('مخطط صرف صحي  ')) !!}
                <input type="file" name="approved_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->approved_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->approved_file }}">
                            📄 {{ $baladyaApproval->approved_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->approved_file) }}" target="_blank"
                            target="_blank"
                            class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>



                        <input type="hidden" name="approved_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div>


            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('building_license_file', __('رخصة البناء')) !!}
                <input type="file" name="building_license_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->building_license_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->building_license_file }}">
                            📄 {{ $baladyaApproval->building_license_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->building_license_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="building_license_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div> 








<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('architect_file', __('مخطط معماري')) !!}
                <input type="file" name="architect_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->architect_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->architect_file }}">
                            📄 {{ $baladyaApproval->architect_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->architect_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="architect_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div> 





<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('civil_file', __('مخطط انشائي')) !!}
                <input type="file" name="civil_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->civil_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->civil_file }}">
                            📄 {{ $baladyaApproval->civil_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->civil_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="civil_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div> 
<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('electrical_file', __('مخطط كهربا')) !!}
                <input type="file" name="electrical_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->electrical_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->electrical_file }}">
                            📄 {{ $baladyaApproval->electrical_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->electrical_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="electrical_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div> 
<div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('water_file', __('مخطط ماي')) !!}
                <input type="file" name="water_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->water_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->water_file }}">
                            📄 {{ $baladyaApproval->water_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->water_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="water_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div>




            <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('etisalat_file', __('مخطط اتصالات')) !!}
                <input type="file" name="etisalat_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->etisalat_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->etisalat_file }}">
                            📄 {{ $baladyaApproval->etisalat_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->etisalat_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="etisalat_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div>







                      <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('_3d_design_file', __('مخطط 3D')) !!}
                <input type="file" name="_3d_design_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->_3d_design_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->_3d_design_file }}">
                            📄 {{ $baladyaApproval->_3d_design_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->_3d_design_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="_3d_design_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div>






                                  <div class="flex-grow-1" style="min-width: 250px; max-width: 250px;">
                {!! Form::label('manazer_file', __('مخطط مناظير')) !!}
                <input type="file" name="manazer_file" class="form-control form-control-sm mb-1">

                @if(isset($baladyaApproval) && $baladyaApproval->manazer_file)
                    <div class="border rounded p-2 small bg-light mt-1 attachment-box">
                        <div class="text-truncate" title="{{ $baladyaApproval->manazer_file }}">
                            📄 {{ $baladyaApproval->manazer_file }}
                        </div>
                        <a href="{{ asset('Files/' . $baladyaApproval->manazer_file) }}" target="_blank"
                        class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                            👁 {{ __('View') }}
                        </a>

                        <input type="hidden" name="manazer_file_delete" value="0" class="delete-flag">

    <button type="button"
            class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
        🗑 Remove
    </button>
                    </div>
                @endif
            </div>


            {{-- Reason  _3d_design_file  manazer_file --}}
            <div style="min-width: 250px;">
                {!! Form::label('building_license_number', __('رقم الرخصة')) !!}
                {!! Form::text('building_license_number', null, ['class' => 'form-control']) !!}
            </div>

        </div>

        <!-- <div class="card-footer mt-3">
            {!! Form::submit(__('Update'), ['class' => 'btn btn-olive btn-sm']) !!}
            <a href="{{ route('projects.baladya-approvals.index', $projectId) }}?owner_id={{ request('owner_id') }}"
               class="btn btn-secondary btn-sm">{{ __('Back') }}</a>
        </div> -->











        <div class="card-footer d-flex justify-content-center gap-3">
            {!! Form::submit(__('حفظ'), [
                'class' => 'btn btn-olive btn-sm',
                'style' => 'background-color: #2f3a1f;border: 1px solid #2f3a1f;color: #d4af37;font-weight:600;'
            ]) !!}
            <a href="{{ route('projects.baladya-approvals.index', $projectId) }}?owner_id={{ request('owner_id') }}"
               class="btn btn-secondary btn-sm">{{ __('List') }}</a>
        </div>


@endif


@if(request('isDesignsApproved'))
<div class="card shadow-sm rounded-4 mt-4" style="background-color:#f5f5dc;margin:40px;padding:0px;">
    <div class="card-header" style="background:#D4AF37;color:#2f3a1f;font-size:1.3rem;font-weight:600;">
        <h4 class="card-title mb-0">{{ __('الملفات المعتمدة') }}</h4>
    </div>
    <div class="card-body contract-grid" style="background-color: #f5f5dc;">
        @php
            $files = [
                'مخطط صرف صحي' => $baladyaApproval->approved_file,
                'رخصة البناء' => $baladyaApproval->building_license_file,
                'مخطط معماري' => $baladyaApproval->architect_file,
                'مخطط انشائي' => $baladyaApproval->civil_file,
                'مخطط كهربا' => $baladyaApproval->electrical_file,
                'مخطط ماي' => $baladyaApproval->water_file,
                'مخطط اتصالات' => $baladyaApproval->etisalat_file,
            ];
        @endphp

        @foreach($files as $name => $file)
            @if($file)
                <div class="contract-box">
                    <span class="mb-1">{{ $name }}</span>
                    <a target="_blank" href="{{ asset('Files/' . $file) }}" class="btn btn-outline-primary btn-sm mb-1">
                        👁 معاينة
                    </a>
                    <a href="{{ asset('Files/' . $file) }}" class="btn btn-success btn-sm mb-1">
                        ⬇ تعديل
                    </a>
                    <a target="_blank" href="{{ asset('Files/' . $file) }}" class="btn btn-warning btn-sm">
                        🖨 طباعة
                    </a>
                </div>
            @endif
        @endforeach
    </div>
</div>

@endif




        {!! Form::close() !!}
    </div>
</div>
@endsection





@push('scripts')


<script>
/*document.querySelectorAll('.remove-file').forEach(btn => {

    btn.addEventListener('click', function(){

        const field = this.dataset.target;

        const hidden = document.querySelector(
            'input[name="'+field+'_delete"]'
        );

        if(hidden){
            hidden.value = 1;
        }

        this.closest('.attachment-box')
            ?.querySelector('.stored-file')
            ?.remove();

        this.style.display = 'none';

    });

});*/
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.remove-file').forEach(btn => {

        btn.addEventListener('click', function () {

            const box = this.closest('.attachment-box');

            const flag = box.querySelector('.delete-flag');

            if(flag){
                flag.value = 1;
            }

            box.style.display = 'none';

        });

    });

});
</script>

@endpush