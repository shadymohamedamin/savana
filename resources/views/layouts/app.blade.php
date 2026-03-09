<!doctype html>
<!-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> -->
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>



@include('partials.toast')

    
    <!-- PWA Meta Tags -->
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="theme-color" content="#4CAF50">

    <link rel="apple-touch-icon" href="/icons/icon-192x192.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">






    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Savana') }}</title>
<!-- <link rel="stylesheet" href="{{ asset('css/app-custom.css') }}"> -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->


    @if(app()->getLocale() == 'ar')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    @else
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    @endif









     

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">


  
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])



    <style>



        body[dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        body[dir="rtl"] .navbar-nav {
            margin-right: auto;
            margin-left: 0;
        }
        /* remove bootstrap py-4 padding dddddddddddddddddddddddddddddd */
        main.py-4 {
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }

        /* full height for guest pages (login) */
        body.guest-page,
        body.guest-page #app,
        body.guest-page main {
            min-height: 100vh;
            height: 100vh;
        }





        /* ===== OLIVE GOLD ANIMATED NAVBAR ===== */

.olive-navbar {
    background: linear-gradient(
        270deg,
        #1f2937,
        #2f3a1f,
        #3f4f2f,
        #2f3a1f
    );
    background-size: 600% 600%;
    animation: oliveGradient 12s ease infinite;
    padding: 0.9rem 0;
}

/* Gradient animation */
@keyframes oliveGradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

/* Brand */
.olive-navbar .navbar-brand {
    color: #f9e076 !important;
    font-weight: 700;
    letter-spacing: 1px;
    text-shadow: 0 2px 8px rgba(212, 175, 55, 0.6);
    transition: all 0.3s ease;
}

.olive-navbar .navbar-brand:hover {
    color: #ffd700 !important;
    transform: scale(1.05);
}

/* Links */
.olive-navbar .nav-link {
    color: #f3f4f6 !important;
    font-weight: 600;
    margin: 0 6px;
    position: relative;
    transition: all 0.3s ease;
}

/* Gold underline animation */
.olive-navbar .nav-link::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -6px;
    width: 0%;
    height: 2px;
    background: linear-gradient(90deg, #f9e076, #d4af37);
    transition: width 0.4s ease;
}

.olive-navbar .nav-link:hover::after {
    width: 100%;
}

.olive-navbar .nav-link:hover {
    color: #f9e076 !important;
}

/* Active link */
.olive-navbar .nav-link.active {
    color: #f9e076 !important;
}

/* Toggler */
.olive-navbar .navbar-toggler {
    border: 1px solid rgba(249, 224, 118, 0.6);
}

.olive-navbar .navbar-toggler-icon {
    filter: brightness(0) invert(1);
}

/* Dropdown   #2f3a1f; #f9e076 #d4af37 */
.olive-navbar .dropdown-menu {
    background: #2f3a1f;
    border: 1px solid rgba(212, 175, 55, 0.4);
}

.olive-navbar .dropdown-item {
    color: #f3f4f6;
    transition: all 0.3s ease;
}

.olive-navbar .dropdown-item:hover {
    background: linear-gradient(90deg, #f9e076, #d4af37);
    color: #1f2937;
}

/* Shadow glow */
.olive-navbar {
    box-shadow: 0 10px 30px rgba(47, 58, 31, 0.7);
}

.navbar-rtl .navbar-nav > li {
    margin-left: 0.75rem;
    margin-right: 0.75rem;
}

.navbar-rtl .dropdown-menu {
    text-align: right;
}













/* ===== TODAY HEADER BOX ===== */
.today-box {
    background: linear-gradient(135deg, #f9e076, #d4af37);
    padding: 8px 18px;
    border-radius: 16px;
    text-align: center;
    min-width: 160px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
    animation: fadeInScale 0.6s ease;
}

.today-day {
    font-weight: 700;
    font-size: 0.9rem;
    color: #1f2937;
}

.today-date {
    font-size: 0.8rem;
    color: #2f3a1f;
}

.today-time {
    font-weight: 700;
    font-size: 1rem;
    color: #000;
    margin-top: 2px;
}

@keyframes fadeInScale {
    from { opacity: 0; transform: scale(0.8); }
    to { opacity: 1; transform: scale(1); }
}











.loader-overlay {
    position: fixed;
    inset: 0;
    background: rgba(255, 250, 238, 0.85); /* #D4AF37 Gold */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

/* Spinner color */
/*.loader-overlay .spinner-border {
    width: 3.2rem;
    height: 3.2rem;
    color: #2f3a1f;
    border-width: 0.35em;
}*/


.loader-overlay .spinner-border {
    width: 3.5rem;
    height: 3.5rem;
    border: 0.35em solid #2f3a1f;
    border-top-color: #D4AF37;
    border-right-color: #D4AF37;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}






.dot-loader {
    display: flex;
    gap: 10px;
}

.dot-loader span {
    width: 14px;
    height: 14px;
    background: #fff;
    border-radius: 50%;
    animation: pulse 1.4s infinite ease-in-out both;
}

.dot-loader span:nth-child(1) { animation-delay: -0.32s; }
.dot-loader span:nth-child(2) { animation-delay: -0.16s; }

@keyframes pulse {
    0%, 80%, 100% { transform: scale(0); }
    40% { transform: scale(1); }
}

.today-inline-box {
    display: flex;
    align-items: center;
    gap: 18px;
    padding: 10px 22px;
    /* background: linear-gradient(135deg, #2f3a1f, #1f2937);
    border: 1px solid rgba(212, 175, 55, 0.4); */
    border-radius: 40px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* Day */
.today-inline-day {
    color: #d4af37;
    font-size: 14px;
}

/* Date */
.today-inline-date {
    color:#fff;
    font-size: 21px;
}

/* Time */
.today-inline-time {
    /* color: #ffd700; */
    color:#fff;
    font-size: 22px;
    font-weight: 700;
}

/* separator */
.today-separator {
    width: 1px;
    height: 18px;
    background: rgba(212,175,55,0.5);
}














/* ===== FULL WIDTH PROJECT PANEL ===== */

.project-panel-full {
    width: 100%;
    background: #d4af37;
    padding: 15px 30px;
    margin: 0;
}

.project-panel-header-full {
    font-size: 22px;
    font-weight: 700;
    color: #2f3a1f;
    margin-bottom: 25px;
}

.project-back-btn {
    background: transparent;
    border: none;
    color: #2f3a1f;
    font-weight: 600;
    text-decoration: none;
}

.project-back-btn:hover {
    text-decoration: underline;
}

.project-panel-body-full {
    width: 100%;
}

.owner-box-full {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
}

.owner-box-full i {
    font-size: 26px;
    color: #2f3a1f;
}

.owner-label {
    font-size: 14px;
    opacity: 0.7;
}

.owner-name {
    font-size: 22px;
    font-weight: 700;
    color: #2f3a1f;
}

/* .project-actions-full {
    display: flex;
    flex-wrap: wrap;
    
    gap: 35px;
} */




/* 🔥 الأزرار بدون خلفية */
.panel-btn-full {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: none;
    color: #2f3a1f;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.panel-btn-full i {
    font-size: 18px;
}

.panel-btn-full:hover {
    color: #000;
    transform: translateX(5px);
}


.panel-btn-full.active {
    background: #556b2f;
    color: #fff !important;
    border-radius: 50px;
    padding: 8px 18px;
}








/* ===== TOP GOLD BAR ===== */

.project-panel-full {
    width: 100%;
    background: #d4af37;
    padding: 10px 20px;
    margin: 0;
}

/* شريط الثلاث أزرار */
.project-top-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

/* شكل الزر الدائري */
.top-pill {
    display: flex;
    align-items: center;
    gap: 8px;
    background: #d4af37;
    /* background: #2f3a1f; */
    color: #2f3a1f;
    padding: 10px 22px;
    /* border-radius: 50px; */
    font-weight: 600;
    font-size: 14px;
    transition: 0.2s ease;
}

/* زر الرابط */
.link-pill {
    text-decoration: none;
}

.link-pill:hover {
    background: #243016;
    transform: translateY(-2px);
}

/* زر المنتصف */
.center-pill {
    background: #d4af37;
    /* background: #ffffff; */
    color: #2f3a1f;
}

/* باقي الأزرار */
.panel-btn-full {
    display: flex;
    align-items: center;
    gap: 8px;
    background: transparent;
    border: none;
    color: #2f3a1f;
    font-weight: 600;
    text-decoration: none;
    transition: 0.2s ease;
}

.panel-btn-full:hover {
    transform: translateX(5px);
}










.owner-title{
    text-align:center;
    font-size:30px;
    font-weight:700;
    margin:25px 0 30px 0;
    color:#2f3a1f;
}

.owner-title i{
    color:#d4af37;
}









/* .project-actions-full{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:35px;

    flex-wrap:nowrap;

    width:100%;
    max-width:100%;
    overflow-x:auto;
    overflow-y:hidden;

    white-space:nowrap;

    padding:5px 10px;

    scrollbar-width:none;
}

.project-actions-full::-webkit-scrollbar{
    display:none;
}

.panel-btn-full{
    flex:0 0 auto;
}


.project-actions-full{
    cursor: grab;
}
.project-actions-full:active{
    cursor: grabbing;
}
 */













/*.project-actions-scroll{
    width:100%;
    overflow-x:auto;
    overflow-y:hidden;
    display:flex;
    justify-content:center;
}


.project-actions-full{
    display:flex;
    width:100%;
    overflow-x:auto;
    overflow-y:hidden;
    align-items:center;
    gap:35px;

    width:max-content;  
    padding:5px 10px;

    white-space:nowrap;
}


.panel-btn-full{
    flex:0 0 auto;
}
 .project-actions-scroll{
    display:flex;
    justify-content:center;
} 

.project-actions-scroll::-webkit-scrollbar{
    height:6px;
}

.project-actions-scroll::-webkit-scrollbar-thumb{
    background:#756a46;
    border-radius:10px;
}*/








.project-actions-full{
    display:grid;

    grid-template-columns: repeat(6, auto); /* 6 عناصر في الصف */

    justify-content:center; /* يجعلهم في المنتصف */

    gap:25px 35px; /* مسافة بين الصفوف والأعمدة */

    padding:5px 0;
}









    </style>

</head>
<body>
     @php
                    use Carbon\Carbon;
                    Carbon::setLocale(app()->getLocale());

                    $now = Carbon::now();
                    $dayName = $now->translatedFormat('l');
                    $timeFormatted = $now->format('H:i:s'); // 22:10:05

                    $dateFormatted = strtoupper($now->format('Y-M-d')); // 2026-FEB-22
                    //$dateFormatted = $now->translatedFormat('d F Y');
                    //$timeFormatted = $now->translatedFormat('h:i A');
                @endphp
    <div class="min-vh-100" id="app" style="background-color:#f5f5dc;">






            <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ url('/') }}">MyApp</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarRoutes" aria-controls="navbarRoutes" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarRoutes">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users') }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/primaryDatas') }}">Primary Data</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/otherRoute') }}">Other Route</a>
                            </li>
                        </ul>

                        
                        <ul class="navbar-nav">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                                </li>
                                
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
                                        </a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </ul>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav> -->



@if(Auth::check())
        <!-- <nav class="navbar navbar-expand-lg olive-navbar shadow-sm mb-4"> -->
        
        
        
        <nav class="navbar navbar-expand-xl olive-navbar shadow-sm  {{ app()->getLocale() == 'ar' ? 'navbar-rtl' : '' }}">

            <div class="container">
                <!-- <a class="navbar-brand ml-3" href="{{ url('/home') }}">
                    <div class="today-inline-box ml-3">
                        <div class="today-inline-day" id="liveDay"></div>
                        <div class="today-separator"></div>
                        <div class="today-inline-date" id="liveDate"></div>
                        <div class="today-separator"></div>
                        <div class="today-inline-time" id="liveClock"></div>
                    </div>

                </a> -->


                
                <a class="navbar-brand ml-3" href="{{ url('/home') }}">

                    
                <div class="today-inline-box ml-3">
                    
                    <div class="today-inline-date" id="liveDate" dir="ltr">
                        {{ $dateFormatted }}
                    </div>
                    

                    <div class="today-separator"></div>

                    <div class="today-inline-time" id="liveClock">
                        {{ $timeFormatted }}
                    </div>
                </div>
                </a>

                

               


                <a class="navbar-brand" style="margin-right: 9rem;" href="{{ url('/') }}">Home</a>


                <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- <ul class="navbar-nav me-auto mx-4">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users') }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/primaryDatas') }}">Primary Data</a>
                            </li>
                            
                            
                        </ul>
                    </ul> -->
                    @auth
                    <!-- <ul class="navbar-nav me-auto mx-4">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users') }}">Users</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/primaryDatas') }}">Primary Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/primaryDatasSubmissions') }}">submissions</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('primary_datas.mySubmissions') }}">My Submissions</a>
                            </li>
                            @if(Auth::user()->email == "it@rakcharity.ae")
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/logs') }}">logs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/audit-logs') }}">actions</a>
                                </li>

                            @endif
                        </ul>
                    </ul> -->




                        @auth
                            <ul class="navbar-nav me-auto mx-4">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                    {{-- Only for admins or researchers --}}
                                    @if(Auth::user()->role !== 'public_user')
                                       @if(in_array(Auth::user()->role_id, [1,4,11,12]))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/users') }}">{{ __('Users') }}</a>
                                        </li>
                                        @endif


                                            <div class="mx-auto text-center">
                                                <a href="{{ url('/') }}">
                                                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" style="height:50px;">
                                                </a>
                                            </div>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/projects') }}">{{ __('Projects') }}</a>
                                        </li>
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/primaryDatas') }}">Primary Data</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/primaryDatasSubmissions') }}">Submissions</a>
                                        </li> -->
                                    @endif

                                    {{-- For public users --}}
                                    @if(Auth::user()->role === 'public_user')
                                        <!-- <li class="nav-item">
                                            <a class="nav-link" href="{{ route('primary_datas.mySubmissions') }}">My Submissions</a>
                                        </li> -->
                                    @endif

                                    {{-- Admin-only --}}
                                    @if(Auth::user()->email == "it@rakcharity.ae")
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/logs') }}">Logs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ url('/audit-logs') }}">Actions</a>
                                        </li>
                                    @endif

                                </ul>
                            </ul>
                            @endauth

                    @endauth



                    <!-- <ul class="navbar-nav ms-auto">

                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            <!--@if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif-->
                        <!-- @else
                            <li class="nav-item dropdown mx-4">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul> -->
                    <!-- <ul class="navbar-nav ms-auto"> -->
                    <ul class="navbar-nav {{ app()->getLocale() == 'ar' ? 'me-auto' : 'ms-auto' }}"></ul>
                            <li class="nav-item dropdown mx-2">
                                <a class="nav-link dropdown-toggle btn btn-sm btn-outline-warning px-3"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown">
                                    🌐 {{ strtoupper(app()->getLocale()) }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <form method="POST" action="{{ route('change.lang') }}">
                                            @csrf
                                            <input type="hidden" name="lang" value="en">
                                            <button class="dropdown-item">🇬🇧 English</button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="POST" action="{{ route('change.lang') }}">
                                            @csrf
                                            <input type="hidden" name="lang" value="ar">
                                            <button class="dropdown-item">🇦🇪 العربية</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>



                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            <!-- Uncomment if you want to enable register -->
                            <!-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif  -->
                        @else



                            @auth
                            <li class="nav-item dropdown mx-2">
                                <a class="nav-link position-relative"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown">

                                    🔔

                                    @if((isset($expiringAttachments) && $expiringAttachments->count())||(isset($expiringProjects) && $expiringProjects->count()))
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{ ($expiringAttachments->count() ?? 0) + ($expiringProjects->count() ?? 0) }}
                                        </span>
                                    @endif

                                    
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow" style="width:320px">
                                    <li><hr class="dropdown-divider"></li>

                                        <li class="dropdown-header fw-bold">
                                            {{ __('Expiring Projects') }}
                                        </li>

                                        @forelse($expiringProjects as $projected)
                                        @php
                                            $endDate = \Carbon\Carbon::parse($projected->contractor_contract_end_date);
                                            $daysLeft = now()->diffInDays($endDate, false);
                                        @endphp
                                            <li>
    <a class="dropdown-item small flex flex-row"
       href="{{ url('/projects?project_code=' . $projected->project_code) }}">
        
        📁 <strong style="color:#d4af37;">{{ $projected->project_code }}</strong><br>

        <span class="text-mute" style="color:#d4af37; font-weight:600;">
            {{ $endDate->format('d M Y')  }} ---
        </span>         
      
        

        <span style="color:#d4af37; font-weight:600;">
            متبقي {{ $daysLeft }} يوم
        </span>

    </a>
</li>
                                        @empty
                                            <li class="dropdown-item text-muted small">
                                                {{ __('No expiring projects') }}
                                            </li>
                                        @endforelse
                                    
                                    
                                    
                                    <li class="dropdown-header fw-bold">
                                        {{ __('Expiring Documents') }}
                                    </li>

                                    @forelse($expiringAttachments as $file)
                                        <li>
                                            <a class="dropdown-item small"
                                            href="{{ url('/users/' . Auth::id() . '/attachments/create?type=users') }}">
                                                📄 <strong>{{ $file->file_name }}</strong><br>
                                                <span class="text-muted">
                                                    {{ optional($file->expiration_date)->format('d M Y') }}
                                                </span>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="dropdown-item text-muted small">
                                            {{ __('No expiring documents') }}
                                        </li>
                                    @endforelse
                                </ul>
                            </li>
                            @endauth




                            <a id="navbarDropdown" class="nav-link dropdown-toggle mx-4" href="{{ route('profile') }}" role="button">
                                {{ Auth::user()->name }}
                            </a>

                            <li class="nav-item mx-4">
                                <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>



                            
                        @endguest
                    </ul>

                </div>
            </div>
        </nav>

@endif

    <!-- <div id="global-loader" class="loader-overlay d-none">
        <div class="spinner-border text-[#2f3a1f]" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div> -->






































{{-- ✅ حط هنا كود لوحة المشروع --}}

@if(isset($project) && in_array(auth()->user()->role_id, [1,4,11,12]))
<div class="project-panel-full">

    
    <div class="project-panel-body-full">

        

        <div class="project-actions-scroll">
            <div class="project-actions-full">

            <a href="{{ route('users.index') }}" class="panel-btn-full">
                <i class="far fa-users"></i>
                المستخدمين
            </a>

            <a href="{{ route('projects.edit', $project->id) }}"
                class="panel-btn-full {{ Route::currentRouteName() == 'projects.edit' ? 'active' : '' }}">
                    <i class="far fa-folder"></i>
                    تعديل المشروع
                </a>

            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}"
                class="panel-btn-full {{ request()->is('users/*/attachments/create') && !request('mode') ? 'active' : '' }}">
                    <i class="fas fa-clipboard-list"></i>
                    عقود الاستشاري
                </a>

            

<a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}"
   class="panel-btn-full {{ Route::currentRouteName() == 'projects.baladya-approvals.index' ? 'active' : '' }}">
    <i class="fas fa-clipboard-list"></i>
    اعتمادات البلدية
</a>

            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}"
   class="panel-btn-full {{ request('mode') == 'tender' ? 'active' : '' }}">
    <i class="fas fa-clipboard-list"></i>
    المناقصة
</a>

            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=contractor_files') }}"
   class="panel-btn-full {{ request('mode') == 'contractor_files' ? 'active' : '' }}">
    <i class="fas fa-clipboard-list"></i>
    عقود المقاول
</a>

            <a href="{{ url('#') }}" class="panel-btn-full">
                <i class="fas fa-clipboard-list"></i>
                الاشراف
            </a>

<a href="{{ route('projects.project-payments.index', ['project' => $project->id]) }}"
   class="panel-btn-full {{ Route::currentRouteName() == 'projects.project-payments.index' ? 'active' : '' }}">
    <i class="fas fa-clipboard-list"></i>
    دفعات المشروع
</a>





            <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=project_documents') }}"
   class="panel-btn-full {{ request('mode') == 'project_documents' ? 'active' : '' }}">
    <i class="fas fa-clipboard-list"></i>
  مستندات المشروع
</a>


            <a href="{{ url('#') }}" class="panel-btn-full">
                <i class="fas fa-clipboard-list"></i>
                المخططات المعتمدة
            </a>

            <a href="{{ url('#') }}" class="panel-btn-full">
                <i class="fas fa-clipboard-list"></i>
                الرسائل والتنبيهات
            </a>

<a href="{{ route('projects.index') }}" class="top-pill link-pill">
        <i class="fas fa-arrow-left me-2"></i>
        العودة إلى المشاريع
    </a>

            </div>
        </div>

    </div>
    



</div>
{{-- 
<div class="project-top-bar">

    <!-- زر اسم المالك -->
    <div class="top-pill">
        <i class="fas fa-user-tie me-2"></i>
        {{ optional($project->ownerUser)->name ?? '—' }}
    </div>

    <!-- زر عنوان الصفحة -->
    <div class="top-pill center-pill">
        <i class="fas fa-folder-open me-2"></i>
        @php
    $routeName = Route::currentRouteName();

    $titles = [
        'projects.edit' => 'تعديل المشروع',
        'users.index' => 'المستخدمين',
        'projects.baladya-approvals.index' => 'اعتمادات البلدية',
        'projects.project-payments.index' => 'دفعات المشروع',
    ];

    // صفحات المرفقات حسب mode
    if(request()->is('users/*/attachments/create')) {
        if(request('mode') === 'tender') {
            $pageTitle = 'المناقصة';
        } elseif(request('mode') === 'contractor_files') {
            $pageTitle = 'عقود المقاول';
        } else {
            $pageTitle = 'عقود الاستشاري';
        }
    } else {
        $pageTitle = $titles[$routeName] ?? 'لوحة المشروع';
    }
@endphp
{{ $pageTitle }}
        <!-- <div class="top-pill center-pill">
            <i class="fas fa-folder-open me-2"></i>
            
        </div> -->
    </div>

    <!-- زر العودة -->
    <a href="{{ route('projects.index') }}" class="top-pill link-pill">
        <i class="fas fa-arrow-left me-2"></i>
        العودة إلى المشاريع
    </a>

</div> --}}



<div class="owner-title">
    <i class="fas fa-user-tie me-2"></i>
    {{ optional($project->ownerUser)->name ?? '—' }}
</div>







@endif






    
    <div id="global-loader" class="loader-overlay d-none">
        <div class="spinner-border" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

        <main class="">
            @yield('content')
        </main>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>






    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-..." crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    
    
    
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        
    
    <!-- Service Worker Registration -->
    <script>
    //https://yourdomain.com/manifest.json
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/service-worker.js')
        .then(reg => {
            console.log('✅ Service Worker registered', reg);
        })
        .catch(err => {
            console.error('❌ Service Worker registration failed', err);
        });
    }
    
    </script>

<script>
    function showLoader() {
        document.getElementById('global-loader').classList.remove('d-none');
    }

    function hideLoader() {
        document.getElementById('global-loader').classList.add('d-none');
    }
</script>

<script>
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function (e) {
            if (
                this.getAttribute('href') &&
                !this.getAttribute('href').startsWith('#') &&
                !this.hasAttribute('target')
            ) {
                showLoader();
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('form').forEach(form => {
            form.addEventListener('submit', function () {
                showLoader();
            });
        });
    });
</script>


<script>
function updateClock() {
    const now = new Date();

    // Time 24h with seconds
    const time = now.toLocaleTimeString('en-GB', { hour12: false });

    // Format date like 2026-FEB-22
    const year = now.getFullYear();
    const day = String(now.getDate()).padStart(2, '0');

    const monthNames = ["JAN","FEB","MAR","APR","MAY","JUN",
                        "JUL","AUG","SEP","OCT","NOV","DEC"];

    const month = monthNames[now.getMonth()];

    const formattedDate = `${year}-${month}-${day}`;

    document.getElementById('liveClock').textContent = time;
    document.getElementById('liveDate').textContent = formattedDate;
}

setInterval(updateClock, 1000);
updateClock();
</script>



<script>
function updateClock() {
    const now = new Date();

    const day = now.toLocaleDateString('en-US', { weekday: 'long' });
    const date = now.toLocaleDateString('en-US', { day: '2-digit', month: 'long', year: 'numeric' });
    const time = now.toLocaleTimeString('en-US');

    document.getElementById('liveDay').innerText = day;
    document.getElementById('liveDate').innerText = date;
    document.getElementById('liveClock').innerText = time;
}

setInterval(updateClock, 1000);
updateClock();
</script>





<!-- <script>
function updateClock() {
    const now = new Date();

    const optionsDay = { weekday: 'long' };
    const optionsDate = { day: '2-digit', month: 'long', year: 'numeric' };

    const locale = document.documentElement.lang === 'ar' ? 'ar-EG' : 'en-US';

    const day = now.toLocaleDateString(locale, optionsDay);
    const date = now.toLocaleDateString(locale, optionsDate);
    const time = now.toLocaleTimeString(locale);

    document.querySelector('.today-day').innerText = day;
    document.querySelector('.today-date').innerText = date;
    document.getElementById('liveClock').innerText = time;
}

setInterval(updateClock, 1000);
updateClock();
</script> -->





    @stack('scripts')



    
</body>
</html>
