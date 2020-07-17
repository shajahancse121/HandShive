<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo4/auth_login_boxed.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 08 Apr 2020 16:32:27 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>HandShive | Login Panel </title>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/authentication/form-2.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
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
   <style>
       .form-form .form-form-wrap form .field-wrapper label {
           font-size: 12px;
           font-weight: 700;
           color: #3b3f5c;
           margin-bottom: 8px;
       }
   </style>

</head>
<body class="form">


<div class="form-container outer">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <img src="{{asset('frontend/logo_final.png')}}" style="width: 250px">

                    <h1 class="pt-4">Sign In</h1>
                    <p class="">Log in to your account to continue.</p>

                    <form class="text-left" method="POST" action="{{ route('login') }}">
                        @csrf
                        @if(session('success'))
                            <div class="alert alert-success mb-4" role="alert" id="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
                                {{session('success')}}.
                            </div>
                        @endif
                        <div class="form">

                            <div id="username-field" class="field-wrapper input">
                                <label for="username">EMAIL</label>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input  id="email" type="email" placeholder="Enter Valid Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <div class="d-flex justify-content-between">
                                    <label for="password">PASSWORD</label>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary mb-3" value="">Log In</button>

                                    <a href="{{route('admin.forget-password')}}" class="pull-left mt-5" style="color: #40a944;font-weight: bold">Forget Password?</a>

                                </div>
                            </div>



                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('backend/assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<script src="{{ asset('backend/bootstrap/js/popper.min.js')}}"></script>
<script src="{{ asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- END GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('backend/assets/js/authentication/form-2.js')}}"></script>

</body>

</html>
