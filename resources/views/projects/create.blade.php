
















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
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h3>{{ __('Create') }} {{ __('Projects') }}</h3>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    @include('adminlte-templates::common.errors')

    <div class="card shadow-xl p-4 m-4" style="background-color: #f5f5dc;">


        {!! Form::open(['route' => 'projects.store']) !!}

        <div class="card-body">
            {{-- FLEX layout like Users Create --}}
            <div class="d-flex flex-wrap gap-3">


                <!-- {{-- Name --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('name', __('ProjectName')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control rounded', 'required']) !!}
                </div> -->

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
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('status_id', __('Status')) !!}
                    {!! Form::select('status_id', $statuses, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => __('-- اختر الحالة --'),
                        'required'
                    ]) !!}
                </div>


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





                {{-- Case # --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('case_id_number', __('Case #')) !!}
                    {!! Form::text('case_id_number', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Building # --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('building_number', __('Building #')) !!}
                    {!! Form::text('building_number', null, ['class' => 'form-control rounded']) !!}
                </div>

                 <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('building_number2', __('Building #2')) !!}
                    {!! Form::text('building_number2', null, ['class' => 'form-control rounded']) !!}
                </div>

                 <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('building_number3', __('Building #3')) !!}
                    {!! Form::text('building_number3', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Fence # --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('fence_number', __('Fence #')) !!}
                    {!! Form::text('fence_number', null, ['class' => 'form-control rounded']) !!}
                </div>




                {{-- Case # --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('design_fee', __('design_fee')) !!}
                    {!! Form::text('design_fee', null, ['class' => 'form-control rounded']) !!}
                </div>
                {{-- Case # --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('supervision_fee', __('supervision_fee')) !!}
                    {!! Form::text('supervision_fee', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Building # --}}
                


                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
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











                {{-- Start Date --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('start_date', __('Start Date')) !!}
                    {!! Form::date('start_date', null, ['class' => 'form-control rounded']) !!}
                </div>




                <!-- {{-- End Date --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('end_date', __('End Date')) !!}
                    {!! Form::date('end_date', null, ['class' => 'form-control rounded']) !!}
                </div>

                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('bank_contract_duration', __('مدة العقد  (بالأشهر)')) !!}
                    {!! Form::number('bank_contract_duration', null, [
                        'class' => 'form-control rounded',
                        'min' => 1
                    ]) !!}
                </div>


                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('contractor_contract_end_date', __('تاريخ انتهاء عقد المقاول')) !!}
                    {!! Form::date('contractor_contract_end_date', null, [
                        'class' => 'form-control rounded'
                    ]) !!}
                </div> -->



                {{-- End Date --}}
                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('end_date', __('End Date')) !!}
                    {!! Form::date('end_date', null, [
                        'class' => 'form-control',
                        'id' => 'end_date'
                    ]) !!}
                </div>

                {{-- Contract Duration --}}
                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('bank_contract_duration', __('مدة العقد (بالأشهر)')) !!}
                    {!! Form::number('bank_contract_duration', null, [
                        'class' => 'form-control',
                        'id' => 'bank_contract_duration',
                        'min' => 1
                    ]) !!}
                </div>

                {{-- Contractor Contract End Date (Display) --}}
                <div class="flex-grow-1" style="min-width:250px;max-width:250px;">
                    {!! Form::label('contractor_contract_end_date_display', __('تاريخ انتهاء عقد المقاول')) !!}
                    <input type="date"
                        id="contractor_contract_end_date_display"
                        class="form-control"
                        readonly>
                </div>

                {{-- Hidden field (sent to backend) --}}
                <input type="hidden"
                    name="contractor_contract_end_date"
                    id="contractor_contract_end_date">



                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('duration', __('مدة عقد البنك')) !!}
                    {!! Form::text('duration', null, ['class' => 'form-control rounded']) !!}
                </div>

                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('qasmia_number', __('Qasmia Number')) !!}
                    {!! Form::text('qasmia_number', null, ['class' => 'form-control rounded']) !!}
                </div>






                

                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('approved_area ', __('المساحة المعتمدة من البلدية')) !!}
                    {!! Form::text('approved_area ', null, ['class' => 'form-control rounded']) !!}
                </div>

                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('linear_meter_area ', __('مساحة السور بالمتر الطولي')) !!}
                    {!! Form::text('linear_meter_area ', null, ['class' => 'form-control rounded']) !!}
                </div>






                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('city_id', __('City')) !!}
                    {!! Form::select('city_id', $regions, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => __('-- اختر الامارة --')
                    ]) !!}
                </div>


                {{-- Project Region //'required' --}}
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



                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('owner_id', __('Owner')) !!}
                    {!! Form::select('owner_id', $owners, $ownerId ?? null, ['class'=>'form-control','placeholder'=>'-- اختر المالك --']) !!}
                </div>

                <div class="d-flex align-items-end gap-2 flex-grow-1" style="min-width: 250px; max-width: 250px;background-color: #f5f5dc;">
                    <div class="flex-grow-1">
                        {!! Form::label('contractor_id', __('Contractor')) !!}
                        {!! Form::select('contractor_id', $contractors, $contractorId ?? null, [
                            'class' => 'form-control',
                            'placeholder' => '-- اختر المقاول --'
                        ]) !!}
                    </div>

                    <a href="{{ route('users.create', [
                            'role_id' => 3,//'owner_id' => request('owner_id')
                        ]) }}"
                    class="btn btn-success mb-1"
                    title="Add New Contractor">
                        <i class="fas fa-plus"></i>
                    </a>

                </div>




                <!-- <div class="d-flex align-items-end gap-2 flex-grow-1"
                    style="min-width: 250px; max-width: 250px; background-color: #f5f5dc;">

                    <div class="flex-grow-1">
                        {!! Form::label('consultant_id', __('Consultant')) !!}
                        {!! Form::select(
                            'consultant_id',
                            $consultants,
                            $consultantId ?? null,
                            [
                                'class' => 'form-control',
                                'placeholder' => '-- اختر الاستشاري --'
                            ]
                        ) !!}
                    </div>

                    <a href="{{ route('users.create') }}"
                    class="btn btn-success mb-1"
                    title="Add New Consultant">
                        <i class="fas fa-plus"></i>
                    </a>

                </div> -->













                <!-- <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;background-color: #f5f5dc;">
                    {!! Form::label('consultant_id', __('Consultant')) !!}
                    {!! Form::select('consultant_id', $consultants, null, ['class'=>'form-control','placeholder'=>'-- اختر الاستشاري --']) !!}
                </div> -->


<!-- <div class="form-group">
                    {!! Form::label('owner_id', 'Owner') !!}
                    {!! Form::select('owner_id', $owners, null, ['class'=>'form-control','placeholder'=>'-- Select Owner --']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('contractor_id', 'Contractor') !!}
                    {!! Form::select('contractor_id', $contractors, null, ['class'=>'form-control','placeholder'=>'-- Select Contractor --']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('consultant_id', 'Consultant') !!}
                    {!! Form::select('consultant_id', $consultants, null, ['class'=>'form-control','placeholder'=>'-- Select Consultant --']) !!}
                </div> -->

                


                {{-- Description (full width) --}}
                <div class="w-100">
                    {!! Form::label('description', __('Description')) !!}
                    {!! Form::textarea('description', null, [
                        'class' => 'form-control rounded',
                        'rows' => 3
                    ]) !!}
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-center gap-3">

        <button type="submit"
                name="action"
                value="save"
                class="btn btn-olive btn-sm">
            💾 {{ __('اضافة') }}
        </button>

        <button type="submit"
                name="action"
                value="save_attachments"
                class="btn btn-olive btn-sm">
            📎 {{ __('Save & Upload Attachments') }}
        </button>

        <a href="{{ route('projects.index') }}"
        class="btn btn-secondary btn-sm">
            <i class="fas fa-list me-1"></i> {{ __('List') }}
        </a>

    </div>


        {!! Form::close() !!}
    </div>
</div>
@endsection



<script>
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















document.addEventListener('DOMContentLoaded', function () {

    function calculateArea() {
        const budget = parseFloat(document.getElementById('budget').value);
        const footPrice = parseFloat(document.getElementById('foot_price').value);

        if (!budget || !footPrice || footPrice <= 0) {
            document.getElementById('area').value = '';
            return;
        }

        const area = budget / footPrice;

        // تقريب رقمين عشريين
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

