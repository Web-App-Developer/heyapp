<!DOCTYPE html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
    <!-- plugins:css Material design css required-->
    <link rel="stylesheet" href="{{ asset('css/backend/css/icons-css/materialdesignicons.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/all.min.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    
    
    <!-- inject:css shared-css/style.css is a like bootsrap css just some partial diffecne 
    or also you can use bootrap css ok
    -->
    <link rel="stylesheet" href="{{ asset('css/backend/css/shared-css/style.css') }}">
    <!-- <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css"> -->
    <!-- endinject -->
    <!-- Layout styles this is the main custom css-->
    <link rel="stylesheet" href="{{ asset('css/backend/css/dashboard-main/dashboard.css') }}">
    <!-- End Layout styles -->

    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/css/nav-responsive/top-nav-responsive.css') }}">

    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend/css/custom-main.css') }}">

    <link rel="shortcut icon" href="../assets/images/favicon.png" />
    
    @stack('backend_css')
  </head>
  <body>
    <div id="app">
      
    <div class="container-scroller">
      <!-- partial:../../partials/_navbar.html -->
      <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
          <a class="navbar-brand brand-logo" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="logo" /> </a>
          <a class="navbar-brand brand-logo-mini" href="#">
            <img src="{{ asset('img/logo.png') }}" alt="logo" /> </a>
        </div>
        
        <div class="navbar-menu-wrapper d-flex align-items-center">
          
          <ul class="navbar-nav" id="visile_nav_when_other_is_toggle">
            <li class="nav-item dropdown language-dropdown user_second_dropdwon">
              <a class="nav-link dropdown-toggle px-2 d-flex align-items-center" id="LanguageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="d-inline-flex mr-0 mr-md-3">
                  <div class="flag-icon-holder">
                    <!-- <i class="fas fa-user"></i> -->
                  </div>
                </div>
                <!-- <span class="profile-text font-weight-medium d-none d-md-block">Something</span> -->
              </a>
              <div class="dropdown-menu dropdown-menu-left navbar-dropdown py-2" aria-labelledby="LanguageDropdown">
                <a class="dropdown-item" href="{{ route('admin.myProfile') }}">
                  <div class="flag-icon-holder">
                  </div>My Profile
                </a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                document.getElementById('logout-form-two').submit();"
                >
                  <div class="flag-icon-holder">
                  </div>Sign Out
                </a>

                <form id="logout-form-two" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
          </ul>

          <div style="width: 100%;margin-left: 25px;">
            <form class="d-flex justify-content-between ml-auto">
              {{-- <input type="search" class="form-control"> --}}
            </form>
          </div>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
              <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <img class="img-xs rounded-circle" src="{{ asset('img/backend/images/avatar.png') }}" alt="Profile image"> </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                <div class="dropdown-header text-center">
                  <img class="img-md rounded-circle" src="{{ asset('img/backend/images/avatar.png') }}" alt="Profile image">
                  <p class="mb-1 mt-3 font-weight-semibold">{{ Auth::user()->name }}</p>
                  <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
                <a class="dropdown-item" href="{{ route('admin.myProfile') }}">My Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
                >Sign Out</a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>             
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <i class="fas fa-bars"></i>
          </button>
        </div>
      </nav>
      <!-- partial -->