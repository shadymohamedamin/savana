
















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


                {{-- Name --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('name', __('ProjectName')) !!}
                    {!! Form::text('name', null, ['class' => 'form-control rounded', 'required']) !!}
                </div>

                {{-- Status --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('status_id', __('Status')) !!}
                    {!! Form::select('status_id', $statuses, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => __('-- Select Status --'),
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
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('budget', __('budget')) !!}
                    {!! Form::text('budget', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- Fence # --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('area', __('area')) !!}
                    {!! Form::text('area', null, ['class' => 'form-control rounded']) !!}
                </div>










                {{-- Start Date --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('start_date', __('Start Date')) !!}
                    {!! Form::date('start_date', null, ['class' => 'form-control rounded']) !!}
                </div>

                {{-- End Date --}}
                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('end_date', __('End Date')) !!}
                    {!! Form::date('end_date', null, ['class' => 'form-control rounded']) !!}
                </div>




                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('qasmia_number', __('Qasmia Number')) !!}
                    {!! Form::text('qasmia_number', null, ['class' => 'form-control rounded']) !!}
                </div>


                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('city_id', __('City')) !!}
                    {!! Form::select('city_id', $regions, null, [
                        'class' => 'form-control rounded',
                        'placeholder' => __('-- Select City --')
                    ]) !!}
                </div>


                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('owner_id', __('Owner')) !!}
                    {!! Form::select('owner_id', $owners, null, ['class'=>'form-control','placeholder'=>'-- Optional --']) !!}
                </div>

                <div class="d-flex align-items-end gap-2 flex-grow-1" style="min-width: 250px; max-width: 250px;">
                    <div class="flex-grow-1">
                        {!! Form::label('contractor_id', __('Contractor')) !!}
                        {!! Form::select('contractor_id', $contractors, null, [
                            'class' => 'form-control',
                            'placeholder' => '-- Optional --'
                        ]) !!}
                    </div>

                    <a href="{{ route('users.create') }}" 
                    class="btn btn-success mb-1"
                    title="Add New Contractor">
                        <i class="fas fa-plus"></i>
                    </a>
                </div>


                <div class="flex-grow-1" style="min-width: 250px;max-width: 250px;">
                    {!! Form::label('consultant_id', __('Consultant')) !!}
                    {!! Form::select('consultant_id', $consultants, null, ['class'=>'form-control','placeholder'=>'-- Optional --']) !!}
                </div>


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
            💾 {{ __('Save') }}
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
