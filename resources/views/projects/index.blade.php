@extends('layouts.app')

@section('content')

{{-- 🔹 Olive + Gold Button Style --}}
<style>
    .btn-olive {
        background-color: #2f3a1f;   /* زيتوني غامق */
        border: 1px solid #2f3a1f;
        color: #d4af37;              /* ذهبي */
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-olive:hover {
        background-color: #3e4a29;  /* زيتوني أفتح */
        border-color: #d4af37;       /* إطار ذهبي */
        color: #fff;                /* أبيض أنيق */
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(212,175,55,0.35);
    }
    .button-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(200px, 1fr));
    gap: 12px;
    justify-content: center;
    align-items: center;
    margin: auto;
    max-width: 900px;
}

.button-grid .btn {
    text-align: center;
    white-space: nowrap;
}
@media (max-width: 768px) {
    .button-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .button-grid {
        grid-template-columns: 1fr;
    }
}

</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 ">
            <div class="col-sm-6">
                <!-- <h1>{{(__('Projects'))}}</h1> -->
            </div>
            <!-- <div class="col-sm-6 {{ app()->getLocale() == 'ar' ? 'text-end' : 'text-end' }}">
                <a class="btn btn-olive"
                   href="{{ route('projects.create') }}">
                    <i class="fas fa-plus me-1"></i> {{ __('Create') }}
                </a>
            </div> -->
        </div>




        <!-- <div style="margin-bottom: 2rem;" class="card-header margin-bottom-4 d-flex flex-wrap gap-2 justify-content-between align-items-center"
            >

            <div class="d-flex flex-wrap gap-2 items-center flex justify-center">
                <a href="{{ route('projects.create') }}" class="btn btn-olive btn-sm">
                    <i class="fas fa-folder-plus me-1"></i> {{ __('New Project') }}
                </a>

                <a href="{{ route('users.create') }}" class="btn btn-olive btn-sm">
                    <i class="fas fa-user-plus me-1"></i> {{ __('New User') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-drafting-compass me-1"></i>
                    {{ __('Frontend / Backend Designs') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-gavel me-1"></i>
                    {{ __('Tender Process') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-user-tie me-1"></i>
                    {{ __('Add Owner') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-hard-hat me-1"></i>
                    {{ __('Add Contractor') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-user-shield me-1"></i>
                    {{ __('Supervision') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-file-alt me-1"></i>
                    {{ __('Project Documents') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-chart-bar me-1"></i>
                    {{ __('Statistics') }}
                </a>

                <a href="#" class="btn btn-olive btn-sm">
                    <i class="fas fa-money-bill-wave me-1"></i>
                    {{ __('Contractor Payments') }}
                </a>
            </div>
        </div> -->

    </div>
</section>

<div class="content px-3">

    @include('flash::message')

    <div class="clearfix"></div>

    <div class="card">
        @include('projects.table')
    </div>
</div>

@endsection
