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


  
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&display=swap" rel="stylesheet">



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
    /* background: linear-gradient(
        270deg,
        #1f2937,
        #2f3a1f,
        #3f4f2f,
        #2f3a1f
    ); */


    background-color: rgb(249 247 237);
    color: rgb(146 114 42 / 1);
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
    /* color: #f3f4f6 !important;
    background-color: rgb(249 247 237); */
    color: rgb(146 114 42 / 1);
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
    /* color: #f3f4f6; */

    background-color: rgb(249 247 237);
    color: rgb(146 114 42 / 1);
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
    color: rgb(146 114 42 / 1);
    font-size: 21px;
}

/* Time */
.today-inline-time {
    /* color: #ffd700; */
    color:#fff;
    color: rgb(146 114 42 / 1);
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

















.project-actions-full{
    display:grid;

    grid-template-columns: repeat(6, auto); /* 6 عناصر في الصف */

    justify-content:center; /* يجعلهم في المنتصف */

    gap:25px 35px; /* مسافة بين الصفوف والأعمدة */

    padding:5px 0;
}



@media (max-width:1200px){

.project-actions-full{
    grid-template-columns: repeat(2, 1fr);
    gap:15px;
}

.panel-btn-full{
    justify-content:center;
    font-size:14px;
}

.back-projects-btn{
    position:static;
    width:100%;
    text-align:center;
    margin-top:10px;
}

}


/* CLOCK RIGHT SIDE */

.navbar-clock{
    position:absolute;
    right:10px;
    top:50%;
    transform:translateY(-50%);
    align-items:center;
}

/* remove background */

.today-inline-box{
    background:none !important;
    box-shadow:none !important;
    padding:0;
}

/* MOBILE NAVBAR FIX */

@media (max-width:991px){

.mobile-navbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.navbar-toggler{
    order:1;
}

.navbar-brand{
    order:2;
}







}








/* NAVBAR LOGO SIZE */

.navbar-logo{
    height:60px;
    width:auto;
    
    transition:0.3s ease;
}

/* تكبير بسيط عند hover */
.navbar-logo:hover{
    transform:scale(1.05);
}


/* BACK TO PROJECTS BUTTON */

.back-projects-btn{
    position:absolute;
    left:25px;
    font-size:18px;
    font-weight:700;
    padding:12px 26px;
}


.navbar-center-logo{
    position:absolute;
    left:50%;
    transform:translateX(-50%);
}

.navbar-logo{
    height:45px;
}
.navbar-center-logo{
    position:absolute;
    left:50%;
    transform:translateX(-50%);
}

.navbar-logo{
    height:55px;
}



@media (max-width: 991px){

.navbar-nav{
    align-items:flex-start !important;
}

.navbar-nav .nav-item{
    width:auto;
}

.navbar-nav .nav-link{
    padding:8px 12px;
    font-size:1.2rem;
}

.navbar-nav .dropdown-menu{
    max-width:260px;
}

.navbar-center-logo{
    position:relative;
    left:auto;
    transform:none;
    margin:10px 0;
    text-align:center;
}

.navbar-logo{
    height:40px;
}

}

.navbar-nav .dropdown{
    width:auto !important;
}

.navbar-nav .dropdown-toggle{
    display:inline-block;
}

.navbar-nav .dropdown{
    width:auto !important;
}

.navbar-nav .dropdown-toggle{
    display:inline-block;
}



@media (max-width: 991px){

.navbar-collapse{
    text-align:center;
}

.navbar-nav{
    width:100%;
    justify-content:center;
    align-items:center !important;
}

.navbar-nav .nav-item{
    text-align:center;
}

}

@media (max-width: 991px){

.navbar-nav .nav-link{
    display:inline-block;
    padding:8px 14px;
}

.dropdown-menu{
    text-align:center;
}

}


body, html {
    /* background-color: #f5f5dc !important; */
    background-color: #ffffff !important;
}

.container,
.main,
.main-content {
    background-color: transparent !important;
}
















































.project-user-card{

    min-width:250px;

    background:#fff;

    border:1px solid #ececec;

    border-radius:14px;

    padding:16px;

    display:flex;

    justify-items:center;

    align-items:center;

    gap:14px;

    cursor:pointer;

    transition:all .25s ease;

    box-shadow:0 3px 10px rgba(0,0,0,.05);
}

.project-user-card:hover{

    transform:translateY(-3px);

    box-shadow:0 8px 20px rgba(0,0,0,.12);

    border-color:#d4af37;
}

.project-user-card .icon{

    width:52px;

    height:52px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    font-size:20px;

    color:#fff;
}

.owner-icon{

    background:#2f3a1f;
}

.contractor-icon{

    background:#b8860b;
}

.consultant-icon{

    background:#4b6584;
}




body,
html {
    font-family: 'Alexandria', sans-serif !important;
}









































































/* =========================
   GOV STYLE PROJECT CARDS
========================= */

.project-cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 18px;
    margin: 25px 50px 35px;
}

/* CARD */
.project-card {
    background-color: rgb(249 247 237);
    border: 1.5px solid rgb(146 114 42 / 1);
    border-radius: 14px;
    padding: 28px 18px;
    text-align: center;
    text-decoration: none;
    transition: 0.25s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0,0,0,.04);
}

/* ICON */
.project-card i {
    font-size: 30px;
    color: rgb(146 114 42 / 1);
    margin-bottom: 14px;
    display: block;
    transition: .25s;
}

/* TEXT */
.project-card span {
    font-size: 17px;
    font-weight: 700;
    color: rgb(146 114 42 / 1);
    transition: .25s;
}

/* HOVER */
.project-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(146,114,42,.12);
    background-color: #fffdf7;
}

/* LIGHT EFFECT */
.project-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            120deg,
            transparent,
            rgba(255,255,255,.35),
            transparent
        );

    opacity: 0;
    transition: .4s;
}

.project-card:hover::before {
    opacity: 1;
    animation: shine 1s;
}

@keyframes shine {
    from {
        transform: translateX(-100%);
    }

    to {
        transform: translateX(100%);
    }
}

/* ACTIVE CARD */
.project-card.active {
    background-color: rgb(146 114 42 / 1);
    border-color: rgb(146 114 42 / 1);
}

/* ACTIVE ICON + TEXT */
.project-card.active i,
.project-card.active span {
    color: #fff;
}

/* =========================
   USER CARDS
========================= */

.project-user-card {

    min-width: 260px;

    background-color: rgb(249 247 237);

    border: 1.5px solid rgb(146 114 42 / 1);

    border-radius: 14px;

    padding: 16px;

    display: flex;

    align-items: center;

    gap: 14px;

    cursor: pointer;

    transition: all .25s ease;

    box-shadow: 0 3px 10px rgba(0,0,0,.04);
}

.project-user-card:hover {

    transform: translateY(-3px);

    box-shadow: 0 10px 20px rgba(146,114,42,.10);

    background: #fffdf8;
}

/* ICON CIRCLE */
.project-user-card .icon {

    width: 54px;

    height: 54px;

    border-radius: 50%;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 20px;

    background-color: rgb(146 114 42 / 1);

    color: #fff;
}

/* TITLES */
.project-user-card .small {

    color: rgb(146 114 42 / .75) !important;

    font-size: 13px;
}

/* NAMES */
.project-user-card .fw-bold {

    color: rgb(146 114 42 / 1);

    font-size: 16px;
}

/* FONT */
body,
html {
    font-family: 'Alexandria', sans-serif !important;
}


.gov-btn {
    background-color: rgb(146 114 42 / 1);
    color: #fff;
    padding: 12px 22px;
    border-radius: 7px;
    text-decoration: none;
    font-weight: 600;
    transition: .25s ease;
    border: none;
}

.gov-btn:hover {
    background-color: rgb(120 92 32 / 1);
    transform: translateY(-1px);
}












.project-cards-grid{
    grid-template-columns:repeat(auto-fit,minmax(120px,1fr));
    gap:12px;
}

.project-card{
    padding:14px 10px;
}

.project-card i{
    font-size:18px;
    margin-bottom:8px;
}

.project-card span{
    font-size:13px;
}

















.project-card{
    width:170px;
    height:130px;
}


















/* =========================================
   GOV UAE STYLE
========================================= */

:root{
    --gov-gold: rgb(146 114 42 / 1);
    --gov-bg: rgb(249 247 237);
    --gov-hover: rgb(255 252 245);
}

/* FONT */
body,
html{
    font-family: 'Alexandria', sans-serif !important;
    background:#fff;
}

/* =========================================
   PROJECT GRID
========================================= */

.project-cards-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(180px,1fr));
    gap:18px;

    margin-top:25px;
    margin-bottom:35px;

    margin-right:50px;
    margin-left:50px;
}

/* =========================================
   PROJECT CARD
========================================= */

.project-card{

    background-color:var(--gov-bg);

    border:1.5px solid var(--gov-gold);

    border-radius:16px;

    padding:28px 18px;

    text-align:center;

    text-decoration:none;

    transition:.25s ease;

    position:relative;

    overflow:hidden;

    box-shadow:0 3px 10px rgba(0,0,0,.04);
}

/* ICON */
.project-card i{

    font-size:30px;

    color:var(--gov-gold);

    margin-bottom:14px;

    display:block;

    transition:.25s ease;
}

/* TEXT */
.project-card span{

    font-size:17px;

    font-weight:700;

    color:var(--gov-gold);

    transition:.25s ease;
}

/* HOVER */
.project-card:hover{

    transform:translateY(-4px);

    background-color:var(--gov-hover);

    box-shadow:0 12px 24px rgba(146,114,42,.10);
}

/* SHINE EFFECT */
.project-card::before{

    content:"";

    position:absolute;

    inset:0;

    background:
        linear-gradient(
            120deg,
            transparent,
            rgba(255,255,255,.35),
            transparent
        );

    opacity:0;

    transition:.4s;
}

.project-card:hover::before{

    opacity:1;

    animation:shine 1s;
}

@keyframes shine{

    from{
        transform:translateX(-100%);
    }

    to{
        transform:translateX(100%);
    }
}

/* ACTIVE */
.project-card.active{

    background-color:var(--gov-gold);
}

/* ACTIVE ICON + TEXT */
.project-card.active i,
.project-card.active span{

    color:#fff;
}

/* =========================================
   USER CARDS
========================================= */

.project-user-card{

    min-width:260px;

    background-color:var(--gov-bg);

    border:1.5px solid var(--gov-gold);

    border-radius:16px;

    padding:18px;

    display:flex;

    align-items:center;

    gap:14px;

    cursor:pointer;

    transition:.25s ease;

    box-shadow:0 3px 10px rgba(0,0,0,.04);
}

/* HOVER */
.project-user-card:hover{

    transform:translateY(-4px);

    background-color:var(--gov-hover);

    box-shadow:0 12px 24px rgba(146,114,42,.10);
}

/* ICON CIRCLE */
.project-user-card .icon{

    width:56px;

    height:56px;

    border-radius:50%;

    display:flex;

    align-items:center;

    justify-content:center;

    background-color:var(--gov-gold);

    flex-shrink:0;
}

/* ICON */
.project-user-card .icon i{

    color:#fff;

    font-size:22px;
}

/* SMALL TITLE */
.project-user-card .small{

    color:rgba(146,114,42,.70) !important;

    font-size:13px;

    margin-bottom:3px;
}

/* NAME */
.project-user-card .fw-bold{

    color:var(--gov-gold);

    font-size:16px;

    font-weight:700;
}

/* REMOVE OLD COLORS */
.owner-icon,
.contractor-icon,
.consultant-icon{

    background-color:var(--gov-gold) !important;
}

/* =========================================
   RESPONSIVE
========================================= */

@media(max-width:768px){

    .project-cards-grid{

        margin-right:15px;
        margin-left:15px;

        grid-template-columns:
            repeat(auto-fit,minmax(150px,1fr));
    }

    .project-card{

        padding:22px 14px;
    }

    .project-card span{

        font-size:15px;
    }

    .project-user-card{

        width:100%;
        min-width:100%;
    }
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
    <div class="" id="app" style="background-color:#f5f5dc;">






            



@if(Auth::check())
        <!-- <nav class="navbar navbar-expand-lg olive-navbar shadow-sm mb-4"> -->
        
        
        
        <nav class="navbar navbar-expand-xxl olive-navbar shadow-sm  {{ app()->getLocale() == 'ar' ? 'navbar-rtl' : '' }}">


            <div class="navbar-clock d-none d-xxl-flex {{ app()->getLocale() == 'ar' ? 'order-3 ms-auto' : 'order-1 me-auto' }}">
                <div class="today-inline-box">
                    <div class="today-inline-date" id="liveDate" dir="ltr">
                        {{ $dateFormatted }}
                    </div>

                    <div class="today-separator"></div>

                    <div class="today-inline-time" id="liveClock">
                        {{ $timeFormatted }}
                    </div>
                </div>
            </div>
            {{-- <div class="container mobile-navbar">
                <div class="navbar-clock d-none d-xl-flex">
                    <div class="today-inline-box">
                        <div class="today-inline-date" id="liveDate" dir="ltr">
                            {{ $dateFormatted }}
                        </div>

                        <div class="today-separator"></div>

                        <div class="today-inline-time" id="liveClock">
                            {{ $timeFormatted }}
                        </div>
                    </div>
                </div> --}}

                

               


                {{-- <a class="navbar-brand" style="margin-right: 9rem;" href="{{ url('/') }}">Home</a> --}}


                <button class="navbar-toggler mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">


                    @auth
    



                    {{-- <div class="mx-auto text-center">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('images/logo-white.png') }}" alt="Logo" class="navbar-logo">
                        </a>
                    </div> --}}

                        @auth
                            {{-- <ul class="navbar-nav mx-auto align-items-center"> --}}
                                {{-- <ul class="navbar-nav me-auto mb-2 mb-lg-0"> --}}
                                <ul class="navbar-nav mx-auto align-items-center d-flex">

                                    {{-- Only for admins or researchers --}}
                                    {{-- @if(Auth::user()->role !== 'public_user')
                                       @if(in_array(Auth::user()->role_id, [1,4,11,12,7]))
                                        <li class="nav-item">
                                            <a style="font-size: 1.4rem;" class="nav-link" href="{{ url('/users') }}">{{ __('Users') }}</a>
                                        </li>
                                        @endif


                                            <div class="navbar-center-logo">
                                                <a href="{{ url('/') }}">
                                                    <img src="{{ asset('images/logo-white.png') }}" class="navbar-logo">
                                                </a>
                                            </div>
                                        <li class="nav-item">
                                            <a style="font-size: 1.4rem;" class="nav-link" href="{{ url('/projects') }}">{{ __('Projects') }}</a>
                                        </li>

                                    @endif --}}



                                    

                                    <div class="navbar-center-logo">
                                        <a href="{{ url('/') }}">
                                            <img src="{{ asset('images/logo-white.png') }}" class="navbar-logo">
                                        </a>
                                    </div>

                                    <li class=" text-center navbar-brand">
                                        <a style="font-size: 1.4rem;" class="text-center nav-link" href="{{ url('/') }}">
                                            {{ __('Home') }}
                                        </a>
                                    </li>

                                    @if(in_array(Auth::user()->role_id, [1,4,11,12,7]))
                                        <li class="nav-item text-center">
                                            <a style=" font-size: 1.4rem;" class="text-center nav-link" href="{{ url('/users') }}">{{ __('Users') }}</a>
                                        </li>

                                        <li class="nav-item text-center">
                                            <a style=" font-size: 1.4rem;" class="text-center nav-link" href="{{ url('/users/' . Auth::id() . '/attachments/create?type=users') }}">{{ __('اوراق المكتب') }}</a>
                                        </li>

                                        
                                        @endif

                                    <li class=" text-center nav-item">
                                        <a style="font-size: 1.4rem;" class="text-center nav-link" href="{{ url('/projects') }}">
                                            {{ __('مشاريعنا') }}
                                        </a>
                                    </li>




                                    @auth
                                        @if(!in_array(Auth::user()->role_id, [1,4,11,12,7]))
                                            <li class="nav-item mx-2">
                                                <a class="nav-link" 
                                                href="{{ route('users.attachments.create', ['id' => Auth::id(), 'type' => 'users']) }}">
                                                    📁 مستنداتي
                                                </a>
                                            </li>
                                        @endif
                                    @endauth


                                    


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
                            {{-- </ul> --}}
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
                                style="font-size: 1.3rem;"
                                data-bs-toggle="dropdown">
                                    🌐 {{ strtoupper(app()->getLocale()) }}
                                </a>

                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li>
                                        <form method="POST" action="{{ route('change.lang') }}">
                                            @csrf
                                            <input type="hidden" name="lang" value="en">
                                            <button  class="dropdown-item">🇬🇧 English</button>
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
                                    <a style="font-size: 1.3rem;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
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
                            <li class="nav-item dropdown items-center mx-2">
                                <a class="nav-link position-relative"
                                href="#"
                                role="button"
                                data-bs-toggle="dropdown">

                                    🔔

                                    @if(
                                        (isset($expiringAttachments) && $expiringAttachments->count())
                                        ||
                                        (isset($expiringProjects) && $expiringProjects->count())
                                        ||
                                        (isset($messageNotifications) && $messageNotifications->count())
                                    )
                                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                            {{
    ($expiringAttachments->count() ?? 0)
    +
    ($expiringProjects->count() ?? 0)
    +
    ($messageNotifications->count() ?? 0)
}}
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
    <a class="dropdown-item small flex justify-center flex-row"
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
                                    
                                    
                                    


<li><hr class="dropdown-divider"></li>

<li class="dropdown-header fw-bold">
    الرسائل
</li>

@forelse($messageNotifications as $notification)

<li>

    <a class="dropdown-item small"
       

       href="{{ route('projects.messages.create', $notification->project_id) }}?reply_to={{ $notification->id }}"
       
       
       >

        📩

        <strong style="color:#d4af37;">
            {{ $notification->sender->name ?? '-' }}
        </strong>

        <br>

        <span style="color:#d4af37;">

            {{ $notification->messageType->name_ar ?? 'رسالة' }}

        </span>

        <br>

        <small class="text-mutedd" style="color:#d4af37;">

            {{ $notification->created_at->diffForHumans() }}

        </small>

    </a>

</li>

@empty

<li class="dropdown-item text-mutedd small" style="color:#d4af37;">
    لا توجد رسائل جديدة
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
                                                <span class="text-mutedd" style="color:#d4af37;">
                                                    {{ optional($file->expiration_date)->format('d M Y') }}
                                                </span>
                                            </a>
                                        </li>
                                    @empty
                                        <li class="dropdown-item text-mutedd small" style="color:#d4af37;">
                                            {{ __('No expiring documents') }}
                                        </li>
                                    @endforelse
                                </ul>
                            </li>
                            @endauth




                            <a id="navbarDropdown" class="nav-link text-center dropdown-toggle mx-4" href="{{ route('profile') }}" role="button">
                                {{ Auth::user()->name }}
                            </a>

                            <li class="nav-item mx-4 text-center">
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































































@if(isset($project))
<!-- <div class="project-cards-grid">

    @if(isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7]))
        <a href="{{ route('projects.edit', $project->id) }}" class="project-card {{ Route::currentRouteName() == 'projects.edit' ? 'active' : '' }}">
            <i class="fas fa-edit fa-2x"></i>
            <span>تعديل المشروع</span>
        </a>

        <a href="{{ url('projects/'.$project->id.'/tender-contractors') }}" class="project-card {{ Route::currentRouteName() == 'projects.tender.contractors' ? 'active' : '' }}">
            <i class="fas fa-users fa-2x"></i>
            <span>المقاولين المرشحين</span>
        </a>
    @endif

    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || (isset($project) && $project->contractor_id == auth()->user()->id))
        <a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}" class="project-card {{ Route::currentRouteName() == 'projects.baladya-approvals.index' && !request('isDesignsApproved') ? 'active' : '' }}">
            <i class="fas fa-check-circle fa-2x"></i>
            <span>اعتمادات البلدية</span>
        </a>

        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}" class="project-card {{ request('mode') == 'tender' ? 'active' : '' }}">
            <i class="fas fa-file-contract fa-2x"></i>
            <span>المناقصة</span>
        </a>

        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=contractor_files') }}" class="project-card {{ request('mode') == 'contractor_files' ? 'active' : '' }}">
            <i class="fas fa-hard-hat fa-2x"></i>
            <span>عقود المقاول</span>
        </a>

        <a href="{{ route('projects.schedules.batches', $project->id) }}" class="project-card {{ Route::currentRouteName() == 'projects.schedules.batches' ? 'active' : '' }}">
            <i class="fas fa-calendar-alt fa-2x"></i>
            <span>جداول الدفوعات</span>
        </a>

        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=project_documents') }}" class="project-card {{ request('mode') == 'project_documents' ? 'active' : '' }}">
            <i class="fas fa-folder-open fa-2x"></i>
            <span>مستندات المشروع</span>
        </a>

        <a href="{{ url('projects/'.$project->id.'/baladya-approvals?isDesignsApproved=true') }}" class="project-card {{ request('isDesignsApproved') ? 'active' : '' }}">
            <i class="fas fa-drafting-compass fa-2x"></i>
            <span>المخططات المعتمدة</span>
        </a>

          <a href="{{ route('projects.messages.index', $project->id) }}" 
        class="project-card {{ Route::currentRouteName() == 'projects.messages.index' ? 'active' : '' }}">
            <i class="fas fa-envelope fa-2x"></i>
            <span>الرسائل والتنبيهات</span>
        </a> 
    @endif

    @if(isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2]))
        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}" class="project-card {{ request()->is('users/*/attachments/create') && !request('mode') ? 'active' : '' }}">
            <i class="fas fa-file-signature fa-2x"></i>
            <span>عقود الاستشاري</span>
        </a>

        <a href="{{ url('#') }}" class="project-card">
            <i class="fas fa-cogs fa-2x"></i>
            <span>الاشراف</span>
        </a>

        <a href="{{ url('#') }}" class="project-card">
            <i class="fas fa-pencil-alt fa-2x"></i>
            <span>التصميم</span>
        </a>



        
    @endif

</div> -->


















<!-- <div onclick="window.location.href='{{ url('users/' . optional($project->ownerUser)->id . '/edit') }}'" style="cursor:pointer;" class="owner-title">
    <i class="fas fa-user-tie me-2"></i>
     المالك : {{ optional($project->ownerUser)->name ?? '—' }}
</div> -->
























@if(isset($project))
<div class="project-cards-grid">

    {{-- تعديل المشروع --}}
    @if(isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7]))
        <a href="{{ route('projects.edit', $project->id) }}"
           class="project-card {{ Route::currentRouteName() == 'projects.edit' ? 'active' : '' }}">
            <i class="fas fa-edit fa-2x"></i>
            <span>تعديل المشروع</span>
        </a>
    @endif


    {{-- مستندات المشروع --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=project_documents') }}"
           class="project-card {{ request('mode') == 'project_documents' ? 'active' : '' }}">
            <i class="fas fa-folder-open fa-2x"></i>
            <span>مستندات المشروع</span>
        </a>
    @endif


    {{-- عقود الاستشاري --}}
    @if(isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2]))
        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects') }}"
           class="project-card {{ request()->is('users/*/attachments/create') && !request('mode') ? 'active' : '' }}">
            <i class="fas fa-file-signature fa-2x"></i>
            <span>عقود الاستشاري</span>
        </a>
    @endif


    {{-- التصميم --}}
    @if(isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2]))
        <a href="{{ url('#') }}" class="project-card">
            <i class="fas fa-pencil-alt fa-2x"></i>
            <span>التصميم</span>
        </a>
    @endif


    {{-- اعتمادات البلدية --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ route('projects.baladya-approvals.index', ['project' => $project->id]) }}"
           class="project-card {{ Route::currentRouteName() == 'projects.baladya-approvals.index' && !request('isDesignsApproved') ? 'active' : '' }}">
            <i class="fas fa-check-circle fa-2x"></i>
            <span>اعتمادات البلدية</span>
        </a>
    @endif


    {{-- المخططات المعتمدة --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ url('projects/'.$project->id.'/baladya-approvals?isDesignsApproved=true') }}"
           class="project-card {{ request('isDesignsApproved') ? 'active' : '' }}">
            <i class="fas fa-drafting-compass fa-2x"></i>
            <span>المخططات المعتمدة</span>
        </a>
    @endif


    {{-- المناقصة --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=tender') }}"
           class="project-card {{ request('mode') == 'tender' ? 'active' : '' }}">
            <i class="fas fa-file-contract fa-2x"></i>
            <span>المناقصة</span>
        </a>
    @endif


    {{-- عقود المقاول --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ url('users/'.$project->id.'/attachments/create?type=projects&mode=contractor_files') }}"
           class="project-card {{ request('mode') == 'contractor_files' ? 'active' : '' }}">
            <i class="fas fa-hard-hat fa-2x"></i>
            <span>عقود المقاول</span>
        </a>
    @endif


    {{-- جدول الدفعات --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ route('projects.schedules.batches', $project->id) }}"
           class="project-card {{ Route::currentRouteName() == 'projects.schedules.batches' ? 'active' : '' }}">
            <i class="fas fa-calendar-alt fa-2x"></i>
            <span>طلبات الدفعات</span>
        </a>
    @endif


    {{-- الاشراف --}}
    @if(isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2]))
        <a href="{{ route('projects.supervisions.index', $project->id) }}"
   class="project-card {{ Route::currentRouteName() == 'projects.supervisions.index' ? 'active' : '' }}">
            <i class="fas fa-cogs fa-2x"></i>
            <span>الاشراف</span>
        </a>
    @endif


    {{-- الرسائل والتنبيهات --}}
    @if((isset($project) && in_array(auth()->user()->role_id, [1, 4, 11, 12,7,2])) || ($project->contractor_id == auth()->id()))
        <a href="{{ route('projects.messages.index', $project->id) }}"
           class="project-card {{ Route::currentRouteName() == 'projects.messages.index' ? 'active' : '' }}">
            <i class="fas fa-envelope fa-2x"></i>
            <span>الرسائل والتنبيهات</span>
        </a>
    @endif


    {{-- الانجاز --}}
    <a href="{{ url('#') }}" class="project-card">
        <i class="fas fa-chart-line fa-2x"></i>
        <span>الانجاز</span>
    </a>

</div>
@endif







<div class="d-flex flex-wrap justify-content-center gap-3 mt-3">

    {{-- المالك --}}
    <div
        onclick="window.location.href='{{ url('users/' . optional($project->ownerUser)->id . '/edit') }}'"
        class="project-user-card">

        <div class="icon owner-icon">
            <i class="fas fa-user-tie"></i>
        </div>

        <div>
            <div class="small text-muted">المالك</div>

            <div class="fw-bold">
                {{ optional($project->ownerUser)->name ?? '—' }}
            </div>
        </div>

    </div>

    {{-- المقاول --}}
    <div
        onclick="window.location.href='{{ url('users/' . optional($project->contractorUser)->id . '/edit') }}'"
        class="project-user-card">

        <div class="icon contractor-icon">
            <i class="fas fa-hard-hat"></i>
        </div>

        <div>
            <div class="small text-muted">المقاول المعتمد</div>

            <div class="fw-bold">
                {{ optional($project->contractorUser)->name ?? '—' }}
            </div>
        </div>

    </div>

    {{-- الاستشاري --}}
    <div
        onclick="window.location.href='{{ url('users/' . optional($project->consultantUser)->id . '/edit') }}'"
        class="project-user-card">

        <div class="icon consultant-icon">
            <i class="fas fa-drafting-compass"></i>
        </div>

        <div>
            <div class="small text-muted">الاستشاري</div>

            <div class="fw-bold">
                {{ optional($project->consultantUser)->name ?? '—' }}
            </div>
        </div>

    </div>

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

<!-- <script>
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
</script> -->









<script>
document.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', function () {
        if (
            this.getAttribute('href') &&
            !this.getAttribute('href').startsWith('#') &&
            !this.hasAttribute('target')
        ) {
            showLoader();
        }
    });
});

document.querySelectorAll('form').forEach(form => {
    form.addEventListener('submit', function () {
        showLoader();
    });
});

// 🔥 الحل للمشكلة بتاعتك
window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
        hideLoader();
    }
});

window.addEventListener('popstate', function () {
    hideLoader();
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
