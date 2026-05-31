@extends('layouts.app')

@section('content')

<style>
    .gov-card {

    background-color: rgb(249 247 237);

    border: 1px solid rgba(146,114,42,.25);

    border-right: 5px solid rgb(146 114 42 / 1);

    border-left: 5px solid rgb(146 114 42 / 1);

    border-radius: 14px;

    margin-top: 120px;

    padding: 120px 40px;

    animation: fadeInUp 0.6s ease-out;

    box-shadow: 0 10px 30px rgba(146,114,42,.08);
}
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* النص في المنتصف */
    .gov-center {
        text-align: center;
    }

    .gov-title {
        font-size: 42px;   /* 👈 كبير جدًا */
        font-weight: 800;
        color: #111827;
        margin-bottom: 15px;
    }

    .gov-subtitle {
        font-size: 20px;
        color: #4b5563;
        margin-bottom: 8px;
    }

    .gov-desc {
        font-size: 19px;
        color: #6b7280;
        font-weight: 700;

        color: rgb(146 114 42 / 1);
    }

    /* الزر في الشمال */
    .gov-btn-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-top: 40px;
    }

    .gov-btn {
        background-color: rgb(146 114 42 / 1);
        
        color: #fff;
        padding: 12px 22px;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        transition: 0.2s ease;
    }

    .gov-btn:hover {
        background-color: rgb(120 92 32 / 1);
        transform: translateY(-1px);
    }









    .gov-card {
    background-color: rgb(249 247 237);
    border: 1px solid rgba(146,114,42,.25);
    border-right: 5px solid rgb(146 114 42);
    border-left: 5px solid rgb(146 114 42);
    border-radius: 14px;
    margin-top: 120px;
    padding: 120px 40px;

    box-shadow: 0 10px 30px rgba(146,114,42,.08);

    animation: floating 4s ease-in-out infinite;
}

@keyframes floating {
    0% {
        transform: translateY(0px);
    }

    50% {
        transform: translateY(-100px);
    }

    100% {
        transform: translateY(0px);
    }
}



.gov-card {
    animation: pulseCard 3s ease-in-out infinite;
}

@keyframes pulseCard {

    0% {
        transform: scale(1);
        box-shadow: 0 10px 30px rgba(146,114,42,.08);
    }

    50% {
        transform: scale(1.02);
        box-shadow: 0 18px 45px rgba(146,114,42,.18);
    }

    100% {
        transform: scale(1);
        box-shadow: 0 10px 30px rgba(146,114,42,.08);
    }
}



.gov-card {
    animation: luxuryMove 5s ease-in-out infinite;
}

@keyframes luxuryMove {

    0% {
        transform: translateY(0) scale(1);
        box-shadow: 0 10px 30px rgba(146,114,42,.08);
    }

    50% {
        transform: translateY(-20px) scale(1.01);
        box-shadow: 0 20px 45px rgba(146,114,42,.18);
    }

    100% {
        transform: translateY(0) scale(1);
        box-shadow: 0 10px 30px rgba(146,114,42,.08);
    }
}





.gov-title{
    font-size:42px;
    font-weight:800;

    opacity:0;
    animation:titleDrop .9s ease forwards;
}

@keyframes titleDrop{
    from{
        opacity:0;
        transform:translateY(-50px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

.gov-desc{
    font-size:19px;
    font-weight:700;
    color:rgb(146 114 42);

    opacity:0;
    animation:titleDrop .9s ease forwards;
    animation-delay:.5s;
}


.gov-btn-wrapper{
    display:flex;
    justify-content:flex-end;
    margin-top:40px;

    opacity:0;
    animation:btnSlide 1s ease forwards;
    animation-delay:1s;
}

@keyframes btnSlide{

    from{
        opacity:0;
        transform:translateX(150px);
    }

    to{
        opacity:1;
        transform:translateX(0);
    }
}



.gov-btn{
    position:relative;
    overflow:hidden;

    background:rgb(146 114 42);
    color:#fff;
}

.gov-btn::before{
    content:'';
    position:absolute;
    top:0;
    right:-120%;

    width:100%;
    height:100%;

    background:linear-gradient(
        90deg,
        transparent,
        rgba(255,255,255,.35),
        transparent
    );

    animation:shine 3s linear infinite;
}

@keyframes shine{
    100%{
        right:120%;
    }
}
</style>

<div class="container py-5">

    <div class="gov-card">

        {{-- النص في المنتصف --}}
        <div class="gov-center">

            <div class="gov-title">
                نرحب بكم في منصة سافانا
            </div>

            <!-- <div class="gov-subtitle">
                لخدمات التصميم والاستشارات الهندسية
            </div> -->

            <div class="gov-desc" >
                نبني الثقة قبل أن نبني المشاريع.
            </div>

        </div>

        {{-- الزر أسفل شمال --}}
        <div class="gov-btn-wrapper">
            <a href="{{ url('/projects') }}" class="gov-btn">
                ▶ ابدأ الخدمة
            </a>
        </div>

    </div>

</div>

@endsection