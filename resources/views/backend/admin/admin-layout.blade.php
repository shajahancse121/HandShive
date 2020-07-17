<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo4/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Apr 2020 16:30:05 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}"/>
    <title>@yield('title', 'HandShive | Admin Panel')</title>

    <link href="{{ asset('backend/assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('backend/assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('backend/plugins/apex/apexcharts.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/css/dashboard/dash_1.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/font-icons/fontawesome/css/regular.css')}}">
    <link href="{{ asset('backend/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/linearicons.css')}}">

    <link  rel="icon" type="image/x-icon"  href="{{ asset('backend/assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/css/forms/switches.css')}}">
    <link  rel="icon" type="image/x-icon"  sizes="57x57" href="{{ asset('favico/apple-icon-57x57.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="60x60" href="{{ asset('favico/apple-icon-60x60.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="72x72" href="{{ asset('favico/apple-icon-72x72.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="76x76" href="{{ asset('favico/apple-icon-76x76.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="114x114" href="{{ asset('favico/apple-icon-114x114.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="120x120" href="{{ asset('favico/apple-icon-120x120.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="144x144" href="{{ asset('favico/apple-icon-144x144.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="152x152" href="{{ asset('favico/apple-icon-152x152.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="180x180" href="{{ asset('favico/apple-icon-180x180.png')}}">
    <link  rel="icon" type="image/x-icon" sizes="192x192"  href="{{ asset('favico/android-icon-192x192.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="32x32" href="{{ asset('favico/favicon-32x32.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="96x96" href="{{ asset('favico/favicon-96x96.png')}}">
    <link  rel="icon" type="image/x-icon"  sizes="16x16" href="{{ asset('favico/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('favico/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favico/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    @yield('style')

</head>
<body>
<!-- BEGIN LOADER -->
<div id="load_screen">
    <div class="loader">
        <div class="loader-content">
            <div class="spinner-grow align-self-center"></div>
        </div>
    </div>
</div>
<!--  END LOADER -->
<?php
$company = \App\CompanyProfile::first();

?>

<!--  BEGIN NAVBAR  -->
<div class="header-container fixed-top">
    <header class="header navbar navbar-expand-sm">

        <ul class="navbar-item theme-brand flex-row  text-center">
            <img src="{{asset('upload/logo_white.png')}}" class="navbar-logo" alt="logo" width="170">
        </ul>



        <ul class="navbar-item flex-row ml-md-auto">






            <li class="nav-item dropdown user-profile-dropdown">
                <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img src="{{asset(\Auth::user()->image?\Auth::user()->image:'upload/category/no-image.png')}}" alt="avatar">
                </a>
                <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                    <div class="">
                        <div class="dropdown-item">
                            <a class="" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> My Profile</a>
                        </div>
                        <div class="dropdown-item">
                            <a class="" href="{{route('admin.contact-message')}}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg> Inbox</a>
                        </div>

                        <div class="dropdown-item">
                            <a class="" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Sign Out</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </li>

        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);"><i class="ion-person" style="color:#0ba360"></i> User</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span> {{auth()->user()->role_id==1?'Admin':'Employee'}}</span></li>
                        </ol>
                    </nav>

                </div>
            </li>
        </ul>

    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
    <div class="sidebar-wrapper sidebar-theme">

     @include('backend.admin.admin-sidebar')

    </div>
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            @yield('content')

        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1" style="width: 100%;text-align: center">
                <p class="">Copyright © 2020 <a href="#" style="color: #0ba360;font-weight: bolder">{{isset($company->name)?$company->name:'Not Found'}}</a> . All Rights Reserved.</p>
            </div>

        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('backend/plugins/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/app.js')}}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{ asset('backend/assets/js/custom.js')}}"></script>
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<script src="{{ asset('backend/plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{ asset('backend/assets/js/dashboard/dash_1.js')}}"></script>
<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

@yield('script')

</body>

</html>
