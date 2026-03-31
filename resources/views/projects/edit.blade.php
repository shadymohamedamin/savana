@extends('layouts.app')

@section('content')

{{-- 🔹 Olive + Gold Button Style --}}
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








.card-section{
    border:1px solid #e5e5c8;
    border-radius:10px;
    margin-bottom:20px;
    background:#fdfdf4;
}

.card-section .card-header{
    background:#2f3a1f;
    color:#d4af37;
    font-weight:600;
    font-size:16px;
}

.form-grid{
    display:flex;
    flex-wrap:wrap;
    gap:15px;
}

.form-item{
    min-width:250px;
    max-width:250px;
}



.card-section label{
    font-weight:700;
}

.form-item label{
    font-weight:700;
}

.flex-grow-1 label{
    font-weight:700;
}




</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <!-- <h3>{{ __('Edit Project') }}</h3> -->
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">

        {!! Form::model($project, [
    'route' => ['projects.update', $project->id],
    'method' => 'patch',
    'files' => true
]) !!}





@include('projects.partials.project-actions', ['project' => $project])

        <!-- <div class="card shadow-sm mb-4" style="background-color:#f5f5dc;">


    <div class="card-header fw-bold" style="background:#2f3a1f;color:#d4af37;">
        <i class="fas fa-cogs me-1"></i> {{ __('إدارة المشروع') }}
    </div>

    <div class="card-body p-2">
        <div class="list-group list-group-flush">

            <a href="{{ route('projects.edit', $project->id) }}"
               class="list-group-item list-group-item-action">
                <i class="far fa-edit me-2"></i> {{ __('Edit Project') }}
            </a>

            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}"
               class="list-group-item list-group-item-action">
                <i class="fas fa-folder-open me-2"></i> {{ __('عقود الاستشاري') }}
            </a>

            @if($project->owner_id)
                <a href="{{ route('users.edit', $project->owner_id) }}"
                   class="list-group-item list-group-item-action">
                    <i class="fas fa-user me-2"></i> {{ __('Edit Owner') }}
                </a>
            @else
                <div class="list-group-item text-muted">
                    <i class="fas fa-user-slash me-2"></i> {{ __('No Owner') }}
                </div>
            @endif

            @if($project->contractor_id)
                <a href="{{ route('users.edit', $project->contractor_id) }}"
                   class="list-group-item list-group-item-action">
                    <i class="fas fa-hard-hat me-2"></i> {{ __('Edit Contractor') }}
                </a>
            @else
                <div class="list-group-item text-muted">
                    <i class="fas fa-user-clock me-2"></i> {{ __('Not Chosen Yet') }}
                </div>
            @endif

            <div class="list-group-item fw-bold text-muted mt-2">
                {{ __('مراحل المشروع') }}
            </div>

            <a href="{{ route('projects.owner-requirements.index', ['project' => $project->id]) }}"
               class="list-group-item list-group-item-action">
                <i class="fas fa-file-signature me-2"></i> {{ __('احتياجات المالك') }}
            </a>

            <a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}"
               class="list-group-item list-group-item-action">
                <i class="fas fa-file-signature me-2"></i> {{ __('اعتمادات البلدية') }}
            </a>

            <a href="{{ route('projects.project-payments.index', ['project' => $project->id]) }}"
               class="list-group-item list-group-item-action">
                <i class="fas fa-money-check-alt me-2"></i> {{ __('دفعات المشروع') }}
            </a>

            

        </div>
    </div>
</div> -->













        <!-- <div class="card-body">
            <div class="d-flex flex-wrap gap-3">

 

                {{-- Project Name --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('project_name_id', __('ProjectName')) !!}
                    {!! Form::select(
                        'project_name_id',
                        $projectNames,
                        null,
                        [
                            'class' => 'form-control rounded',
                            'placeholder' => __('-- اختر اسم المشروع --'),
                            'required'
                        ]
                    ) !!}
                </div>


                {{-- Status --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('status_id', __('Status')) !!}
                    {!! Form::select('status_id', $statuses, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => '-- اختر الحالة --',
                        'required'
                    ]) !!}
                </div>

                {{-- Case --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;">
                    {!! Form::label('case_id_number', __('Case #')) !!}
                    {!! Form::text('case_id_number', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Building --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;">
                    {!! Form::label('building_number', __('Building #')) !!}
                    {!! Form::text('building_number', null, ['class' => 'form-control rounded']) !!}
                </div>

                    <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;">
                        {!! Form::label('building_number2', __('Building #2')) !!}
                        {!! Form::text('building_number2', null, ['class' => 'form-control rounded']) !!}
                    </div>
                    <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;">
                        {!! Form::label('building_number3', __('Building #3')) !!}
                        {!! Form::text('building_number3', null, ['class' => 'form-control rounded']) !!}
                    </div>

                {{-- Fence --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;">
                    {!! Form::label('fence_number', __('Fence #')) !!}
                    {!! Form::text('fence_number', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Fees --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('design_fee', __('رسوم التصميم')) !!}
                    {!! Form::text('design_fee', null, ['class' => 'form-control rounded']) !!}
                </div>

                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('supervision_fee', __('رسوم الإشراف')) !!}
                    {!! Form::text('supervision_fee', null, ['class' => 'form-control rounded']) !!}
                </div>

    


                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('bank_contract_value', __('قيمة العقد بالضريبة')) !!}
                    {!! Form::number('bank_contract_value', null, [
                        'class' => 'form-control rounded',
                        'min' => 0,
                    ]) !!}
                </div>


                


                <div class="flex-grow-1" style="min-width:250px; max-width:250px;">
                    {!! Form::label('financing_type', __('تمويل المشروع')) !!}
                    {!! Form::select('financing_type', 
                        [
                            'bank' => __('بنك'),
                            'owner' => __('مالك'),
                            'bank_owner' => __('بنك ومالك')
                        ],
                        $project->financing_type ?? old('financing_type'), 
                        ['class' => 'form-control rounded', 'required' => true]
                    ) !!}
                </div>



                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('project_bank_support', __('تمويل البنك '))!!}
                    {!! Form::number('project_bank_support', null, [
                        'class' => 'form-control rounded',
                        'min' => 800000,
                    ]) !!}
                </div>

                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('project_owner_support', __('تمويل المالك '))!!}
                    {!! Form::number('project_owner_support', null, [
                        'class' => 'form-control rounded',
                        'id' => 'project_owner_support',
                        'readonly' => true
                    ]) !!}
                </div>










  <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
    {!! Form::label('budget', __('ميزانية المالك')) !!}
    {!! Form::text('budget', null, [
        'class' => 'form-control rounded',
        'id' => 'budget'
    ]) !!}
</div>


                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
    {!! Form::label('foot_price', __('سعر الفوت')) !!}
    {!! Form::text('foot_price', null, [
        'class' => 'form-control rounded',
        'id' => 'foot_price'
    ]) !!}
</div>



<div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
    {!! Form::label('area', __('المساحة')) !!}
    {!! Form::text('area', null, [
        'class' => 'form-control rounded',
        'id' => 'area',
        'readonly' => true
    ]) !!}
</div>











                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('approved_area', __('المساحة المعتمدة من البلدية')) !!}
                    {!! Form::text('approved_area', null, ['class' => 'form-control rounded']) !!}
                </div>

                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('linear_meter_area', __('مساحة السور بالمتر الطولي')) !!}
                    {!! Form::text('linear_meter_area', null, ['class' => 'form-control rounded']) !!}
                </div>





                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('qasmia_number', __('رقم القسيمة')) !!}
                    {!! Form::text('qasmia_number', null, ['class' => 'form-control rounded']) !!}
                </div>







                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('duration', __('مدة عقد البنك')) !!}
                    {!! Form::text('duration', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Dates --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('start_date', __('Start Date')) !!}
                    {!! Form::date(
                        'start_date',
                        optional($project->start_date)->format('Y-m-d'),
                        ['class' => 'form-control rounded']
                    ) !!}
                </div>





                



                {{-- End Date --}}
                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('end_date', __('End Date')) !!}
                    {!! Form::date(
                        'end_date',
                        optional($project->end_date)->format('Y-m-d'),
                        ['class' => 'form-control rounded', 'id' => 'end_date']
                    ) !!}
                </div>

                {{-- Contract Duration --}}
                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('bank_contract_duration', __('مدة العقد الاساسي (بالأشهر)')) !!}
                    {!! Form::number(
                        'bank_contract_duration',
                        $project->bank_contract_duration,
                        ['class' => 'form-control rounded', 'min' => 1, 'id' => 'bank_contract_duration']
                    ) !!}
                </div>

                {{-- Contractor Contract End Date (Display) --}}
                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('contractor_contract_end_date_display', __('تاريخ انتهاء عقد المقاول')) !!}
                    <input type="date"
                        id="contractor_contract_end_date_display"
                        class="form-control rounded"
                        value="{{ optional($project->contractor_contract_end_date)->format('Y-m-d') }}"
                        readonly>
                </div>

                {{-- Hidden --}}
                <input type="hidden"
                    name="contractor_contract_end_date"
                    id="contractor_contract_end_date"
                    value="{{ optional($project->contractor_contract_end_date)->format('Y-m-d') }}"/>



                {{-- Stage --}}
                <div class="flex-grow-1"
                    style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">

                    {!! Form::label('stage_id', __('Project Stage')) !!}

                    {!! Form::select('stage_id', $stages, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => __('-- اختر المرحلة --'),
                        'required'
                    ]) !!}
                </div>



                {{-- City --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('city_id', __('City')) !!}
                    {!! Form::select('city_id', $regions, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => '-- اختر الامارة --'
                    ]) !!}
                </div>


                {{-- Project Region --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('project_region_id', __('المنطقة')) !!}
                    {!! Form::select(
                        'project_region_id',
                        $projectRegions,
                        null,
                        [
                            'class' => 'form-control rounded',
                            'placeholder' => __('-- اختر  المنطقة --'),
                            
                        ]
                    ) !!}
                </div>

                {{-- Owner / Contractor / Consultant --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('owner_id', __('Owner')) !!}
                    {!! Form::select('owner_id', $owners, null, ['class'=>'form-control','placeholder'=>'-- اختياري --']) !!}
                </div>

                <div class="d-flex align-items-end gap-2 flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    
                    <div style="width: 200px;">
                        {!! Form::label('contractor_id', __('Contractor')) !!}
                        {!! Form::select('contractor_id', $contractors, null, ['class'=>'form-control','placeholder'=>'-- اختياري --']) !!}
                    </div>
                
                    
                        <a href="{{ route('users.create', [
                                'role_id' => 3,//'owner_id' => request('owner_id')
                            ]) }}"
                        class="btn btn-success mb-1"
                        title="Add New Contractor">
                            <i class="fas fa-plus"></i>
                        </a>

                    
                
                
                
                </div>



                

                {{-- Description --}}
                <div class="w-100">
                    {!! Form::label('description', __('Description')) !!}
                    {!! Form::textarea('description', null, ['class'=>'form-control rounded','rows'=>3]) !!}
                </div>

            </div>
        </div> -->


<div class="card-section">

<div class="card-header" style="text-align: center;">
<i class="fas fa-building me-1" ></i> معلومات المشروع
</div>

<div class="card-body">

<div class="form-grid">

<div class="form-item">
{!! Form::label('project_name_id', __('ProjectName')) !!}
{!! Form::select('project_name_id',$projectNames,null,['class'=>'form-control','placeholder'=>'-- اختر اسم المشروع --']) !!}
</div>





{{-- Status --}}
<div class="flex-grow-1" style="min-width: 250px;max-width: 250px;max-width: 250px;">
    {!! Form::label('status_id', __('Status')) !!}
    {!! Form::select('status_id', $statuses, null, [
        'class' => 'form-control rounded',
        'placeholder' => '-- اختر الحالة --',
        'required'
    ]) !!}
</div>

{{-- Stage --}}
                <div class="flex-grow-1"
                    style="min-width: 250px;max-width: 250px;">

                    {!! Form::label('stage_id', __('Project Stage')) !!}

                    {!! Form::select('stage_id', $stages, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => __('-- اختر المرحلة --'),
                        'required'
                    ]) !!}
                </div>


<div class="form-item">
{!! Form::label('case_id_number', __('Case #')) !!}
{!! Form::text('case_id_number', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('building_number', __('رقم المبني 1')) !!}
{!! Form::text('building_number', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('building_number2', __('Building #2')) !!}
{!! Form::text('building_number2', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('building_number3', __('Building #3')) !!}
{!! Form::text('building_number3', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('fence_number', __('Fence #')) !!}
{!! Form::text('fence_number', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('qasmia_number', __('رقم القسيمة')) !!}
{!! Form::text('qasmia_number', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('city_id', __('City')) !!}
{!! Form::select('city_id',$regions,null,['class'=>'form-control','placeholder'=>'-- اختر الامارة --']) !!}
</div>

<div class="form-item">
{!! Form::label('project_region_id', __('المنطقة')) !!}
{!! Form::select('project_region_id',$projectRegions,null,['class'=>'form-control','placeholder'=>'-- اختر المنطقة --']) !!}
</div>

<div class="form-item">
{!! Form::label('owner_id', __('Owner')) !!}
{!! Form::select('owner_id',$owners,null,['class'=>'form-control','placeholder'=>'-- اختياري --']) !!}
</div>





<div class="form-item">
    <div class="border rounded p-2 small bg-light attachment-box">

        <input type="hidden" name="project_image_delete" value="0" class="delete-flag">

        <input type="file"
               name="project_image"
               class="form-control form-control-sm attachment-input mb-1">

        {{-- الصورة الحالية --}}
        @if($project->project_image)
            <a href="{{ asset('Files/'.$project->project_image) }}"
               target="_blank"
               class="btn btn-sm btn-outline-primary w-100 mt-1 stored-file">
                👁 عرض الصورة الحالية
            </a>
        @endif

        {{-- preview --}}
        <a href="#"
           target="_blank"
           class="btn btn-sm btn-outline-success w-100 mt-1 preview-file d-none">
            👁 معاينة
        </a>

        <button type="button"
                class="btn btn-sm btn-outline-danger w-100 mt-1 remove-file">
            🗑 حذف
        </button>

    </div>
</div>


<div class="w-100">
                    {!! Form::label('description', __('Description')) !!}
                    {!! Form::textarea('description', null, ['class'=>'form-control rounded','rows'=>3]) !!}
                </div>



</div>
</div>
</div>



<div class="card-section">

<div class="card-header" style="text-align: center;">
<i class="fas fa-user-tie me-1"></i> الاستشاري
</div>

<div class="card-body">

<div class="form-grid">

<div class="form-item">
{!! Form::label('design_fee', __('رسوم التصميم')) !!}
{!! Form::text('design_fee', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('supervision_fee', __('رسوم الإشراف')) !!}
{!! Form::text('supervision_fee', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('budget', __('ميزانية المالك')) !!}
{!! Form::text('budget', null, ['class'=>'form-control','id'=>'budget']) !!}
</div>


 <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
    {!! Form::label('foot_price', __('سعر الفوت')) !!}
    {!! Form::text('foot_price', null, [
        'class' => 'form-control rounded',
        'id' => 'foot_price'
    ]) !!}
</div>



<div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
    {!! Form::label('area', __('المساحة')) !!}
    {!! Form::text('area', null, [
        'class' => 'form-control rounded',
        'id' => 'area',
        'readonly' => true
    ]) !!}
</div>



<div class="form-item">
{!! Form::label('start_date', __('تاريخ توقيع عقد التصميم')) !!}
{!! Form::date('start_date',optional($project->start_date)->format('Y-m-d'),['class'=>'form-control']) !!}
</div>




<div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('approved_area', __('المساحة المعتمدة من البلدية')) !!}
                    {!! Form::text('approved_area', null, ['class' => 'form-control rounded']) !!}
                </div>

                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('linear_meter_area', __('مساحة السور بالمتر الطولي')) !!}
                    {!! Form::text('linear_meter_area', null, ['class' => 'form-control rounded']) !!}
                </div>

</div>
</div>
</div>


<div class="card-section">

<div class="card-header" style="text-align: center;">
<i class="fas fa-hard-hat me-1"></i> المقاول
</div>

<div class="card-body">

<div class="form-grid">

<div class="form-item">
{!! Form::label('bank_contract_value', __('قيمة العقد بالضريبة')) !!}
{!! Form::number('bank_contract_value', null, ['class'=>'form-control','min'=>0]) !!}
</div>

<div class="form-item">
{!! Form::label('duration', __('مدة عقد البنك')) !!}
{!! Form::text('duration', null, ['class'=>'form-control']) !!}
</div>



<div class="flex-grow-1" style="min-width:250px; max-width:250px;">
                    {!! Form::label('financing_type', __('تمويل المشروع')) !!}
                    {!! Form::select('financing_type', 
                        [
                            'bank' => __('بنك'),
                            'owner' => __('مالك'),
                            'bank_owner' => __('بنك ومالك')
                        ],
                        $project->financing_type ?? old('financing_type'), 
                        ['class' => 'form-control rounded', 'required' => true]
                    ) !!}
                </div>

<div class="form-item">
{!! Form::label('project_bank_support', __('تمويل البنك')) !!}
{!! Form::number('project_bank_support', null, ['class'=>'form-control']) !!}
</div>

<div class="form-item">
{!! Form::label('project_owner_support', __('تمويل المالك')) !!}
{!! Form::number('project_owner_support', null, ['class'=>'form-control','readonly'=>true]) !!}
</div>

<div class="form-item">
{!! Form::label('end_date', __('تاريخ تسليم الموقع')) !!}
{!! Form::date('end_date',optional($project->end_date)->format('Y-m-d'),['class'=>'form-control','id'=>'end_date']) !!}
</div>









<div class="form-item">
{!! Form::label('bank_contract_duration', __('مدة العقد الاساسي (بالأشهر)') )!!}
{!! Form::number('bank_contract_duration',$project->bank_contract_duration,['class'=>'form-control','id'=>'bank_contract_duration']) !!}
</div>












<div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('contractor_contract_end_date_display', __('تاريخ انتهاء عقد المقاول')) !!}
                    <input type="date"
                        id="contractor_contract_end_date_display"
                        class="form-control rounded"
                        value="{{ optional($project->contractor_contract_end_date)->format('Y-m-d') }}"
                        readonly>
                </div>

                {{-- Hidden --}}
                <input type="hidden"
                    name="contractor_contract_end_date"
                    id="contractor_contract_end_date"
                    value="{{ optional($project->contractor_contract_end_date)->format('Y-m-d') }}"/>



<div class="form-item">
    <label class="form-label">تاريخ توقيع العقود</label>
    <input type="date"
           name="contract_signed_at"
           class="form-control"
           value="{{ old('contract_signed_at', optional($project->contract_signed_at)->format('Y-m-d')) }}">
</div>



{{-- <div class="form-item">
{!! Form::label('contractor_contract_end_date_display', __('تاريخ انتهاء عقد المقاول')) !!}
<input type="date" id="contractor_contract_end_date_display" class="form-control"
value="{{ optional($project->contractor_contract_end_date)->format('Y-m-d') }}" readonly>
</div>





<input type="hidden"
name="contractor_contract_end_date"
id="contractor_contract_end_date"
value="{{ optional($project->contractor_contract_end_date)->format('Y-m-d') }}"/> --}}

<div class="form-item">
{!! Form::label('contractor_id', __('Contractor')) !!}
{!! Form::select('contractor_id',$contractors,null,['class'=>'form-control','placeholder'=>'-- اختياري --']) !!}
</div>



<div class="form-item">
{!! Form::label('container_contract_value', __('قيمة عقد الحاوية')) !!}
{!! Form::number('container_contract_value', null, ['class'=>'form-control']) !!}
</div>

</div>
</div>
</div>








        {{-- FOOTER --}}
        <div class="card-footer d-flex justify-content-center gap-3">

            <button type="submit" class="btn btn-olive btn-sm">
                💾 {{ __('حفظ') }}
            </button>

            {{-- 🔹 Edit / Upload Attachments    href="{{ url('users/'.$user->id.'/attachments/create?type=projects') }}" --}}
            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}"
               class="btn btn-olive btn-sm">
                📎 {{ __('Edit Files') }}
            </a>

            <a href="{{ route('projects.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-list"></i> {{ __('List') }}
            </a>

        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection








<script>

document.querySelectorAll('.remove-file').forEach(btn => {
    btn.addEventListener('click', function () {
        const box = this.closest('.attachment-box');
        box.querySelector('.attachment-input').value = '';
        box.querySelector('.delete-flag').value = 1;

        box.querySelectorAll('.preview-file,.stored-file')
           .forEach(el => el.classList.add('d-none'));
    });
});


document.addEventListener('DOMContentLoaded', function () {

    function calculateArea() {
        const budget = parseFloat(document.getElementById('budget')?.value);
        const footPrice = parseFloat(document.getElementById('foot_price')?.value);

        if (!budget || !footPrice || footPrice <= 0) {
            document.getElementById('area').value = '';
            return;
        }

        const area = budget / footPrice;

        // تقريب لرقمين عشريين
        document.getElementById('area').value = area.toFixed(2);
    }

    document.getElementById('budget')
        .addEventListener('input', calculateArea);

    document.getElementById('foot_price')
        .addEventListener('input', calculateArea);

    // مهم جدًا في edit
    calculateArea();
});
</script>








<script>
/*document.addEventListener('DOMContentLoaded', function () {

    function calculateArea() {
        const bank_contract_value = parseFloat(document.getElementById('bank_contract_value')?.value);
        const project_bank_support = parseFloat(document.getElementById('project_bank_support')?.value);

        if (!bank_contract_value || !project_bank_support) {
            document.getElementById('project_owner_support').value = '0';
            return;
        }

        const project_owner_support=bank_contract_value-project_bank_support;

        // تقريب لرقمين عشريين
        document.getElementById('project_owner_support').value = project_owner_support.toFixed(2);
    }

    document.getElementById('bank_contract_value')
        .addEventListener('input', calculateArea);

    document.getElementById('project_bank_support')
        .addEventListener('input', calculateArea);

    // مهم جدًا في edit
    calculateArea();
});*/


document.addEventListener('DOMContentLoaded', function () {

    function calculateArea() {
        const bank_contract_value = parseFloat(document.getElementById('bank_contract_value')?.value) || 0;
        const project_bank_support = parseFloat(document.getElementById('project_bank_support')?.value) || 0;
        const financing_type = document.getElementById('financing_type')?.value;

        let project_owner_support = 0;

        if (financing_type === 'owner') {
            // ✅ كل المبلغ على المالك
            project_owner_support = bank_contract_value;

        } else if (financing_type === 'bank') {
            // ✅ كل المبلغ على البنك
            project_owner_support = 0;

        } else if (financing_type === 'bank_owner') {
            // ✅ مشترك
            project_owner_support = bank_contract_value - project_bank_support;
        }

        document.getElementById('project_owner_support').value = project_owner_support.toFixed(2);
    }

    document.getElementById('bank_contract_value')
        ?.addEventListener('input', calculateArea);

    document.getElementById('project_bank_support')
        ?.addEventListener('input', calculateArea);

    document.getElementById('financing_type')
        ?.addEventListener('change', calculateArea);

    // تشغيل عند تحميل الصفحة
    calculateArea();
});
</script>










<script>
document.addEventListener('DOMContentLoaded', function () {

    function calculateContractorEndDate() {
        const endDate = document.getElementById('end_date').value;
        const duration = document.getElementById('bank_contract_duration').value;

        if (!endDate || !duration) {
            document.getElementById('contractor_contract_end_date_display').value = '';
            document.getElementById('contractor_contract_end_date').value = '';
            return;
        }

        let date = new Date(endDate);
        date.setMonth(date.getMonth() + parseInt(duration));

        const formattedDate = date.toISOString().split('T')[0];

        document.getElementById('contractor_contract_end_date_display').value = formattedDate;
        document.getElementById('contractor_contract_end_date').value = formattedDate;
    }

    document.getElementById('end_date')
        .addEventListener('change', calculateContractorEndDate);

    document.getElementById('bank_contract_duration')
        .addEventListener('input', calculateContractorEndDate);

    // مهم جدًا في edit
    calculateContractorEndDate();
});
</script>

