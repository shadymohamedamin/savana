@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Hero Section --}}
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow-sm border-0 rounded-4 overflow-hidden">

                <div class="card-body p-5 text-center" style="background: linear-gradient(135deg, #f8fafc, #eef2ff);">

                    {{-- Title --}}
                    <h1 class="fw-bold mb-3" style="font-size: 28px;">
                        👋 نرحب بكم في منصة سافانا
                    </h1>

                    {{-- Subtitle --}}
                    <p class="text-muted mb-2" style="font-size: 18px;">
                        لخدمات التصميم والاستشارات الهندسية
                    </p>

                    <p class="text-secondary mb-4">
                        نبني الثقة قبل أن نبني المشاريع
                    </p>

                    {{-- Welcome user --}}
                    <div class="mb-4">
                        <span class="badge bg-dark px-3 py-2">
                            👤 مرحباً، {{ Auth::user()->name }}
                        </span>
                    </div>

                    {{-- CTA Button --}}
                    <a href="{{ url('/projects') }}"
                       class="btn btn-lg px-5 py-3 text-white rounded-pill"
                       style="background: #198754; box-shadow: 0 10px 25px rgba(25,135,84,0.25);">
                        🚀 ابدأ الخدمة
                    </a>

                </div>
            </div>

        </div>
    </div>

    {{-- Optional Info Section --}}
    <div class="row justify-content-center mt-4">
        <div class="col-md-10">

            <div class="row g-3">

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                        <h5>📁 إدارة المشاريع</h5>
                        <p class="text-muted mb-0">متابعة وتنظيم جميع مشاريعك بسهولة</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                        <h5>🧾 المستندات</h5>
                        <p class="text-muted mb-0">رفع وإدارة الملفات الخاصة بك</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 p-3 text-center">
                        <h5>⚡ سرعة التنفيذ</h5>
                        <p class="text-muted mb-0">متابعة الطلبات بسرعة وكفاءة</p>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>
@endsection