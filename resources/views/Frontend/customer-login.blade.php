@extends('Frontend.layout')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3><i class="ion-ios-unlocked"></i> Customer Login</h3>
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Customer Login</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!-- customer login start -->
    <div class="customer_login">
        <div class="container">
            <div class="row">
                <!--login area start-->

                <!--login area start-->

                <!--register area start-->
                <div class="col-lg-6 col-md-6 offset-3 user_reg">
                    <div class="account_form register">
                        <div class="card ">

                            <div class="card-header">
                                <h2 style="padding-top: 10px;"><i class="ion-locked"></i> Customer Login</h2>

                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-danger mb-4" role="alert" id="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Faild!</strong>
                                        {{session('success')}}.
                                    </div>
                                @endif
                                    @if(session('code_success'))
                                        <div class="alert alert-success mb-4" role="alert" id="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
                                            {{session('code_success')}}.
                                        </div>
                                    @endif
                                <form  action="{{route('customer-login')}}" method="post" onsubmit="return formValidation();">
                                    @csrf


                                    <p>
                                        <label style="font-weight: bold" for="email_phone"><i class="ion-person-stalker"></i> Phone or Email   <span class="text-success">*</span></label>
                                        <input type="text" name="email_phone" id="email_phone" placeholder="Enter Phone or  Email"  autocomplete="off">
                                        @error('email_phone')
                                        <label style="font-weight: 400;color:red" for="email_phone"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>
                                    <p>
                                        <label style="font-weight: bold" for="password"><i class="ion-android-unlock"></i> Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" placeholder="Enter Password"  autocomplete="off">
                                        @error('password')
                                        <label style="font-weight: 400;color:red" for="password"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>

                                    <div class="login_submit">
                                        <a href="{{route('forget-password')}}" class="pull-left" style="color: #40a944">Forget Password?</a>
                                        <button type="submit" style="font-size: 16px;background: #40a944" class="pull-right"><i class="ion-key"></i> Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div>
    <!-- customer login end -->


@endsection


@section('style')
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
    <style>
        .account_form form {
            border: 1px solid #ffffff;
            padding: 23px 20px 29px;
            border-radius: 5px;
        }
        .card-header {
            /* padding: .75rem 1.25rem; */
            margin-bottom: 0;
            background-color: rgb(64, 169, 68);
            border-bottom: 1px solid rgba(0,0,0,.125);
            color: white;
            padding: 10px 71px;
        }
        .account_form input {
            border: 1px solid #ededed;
            height: 40px;
            max-width: 100%;
            padding: 0 20px;
            background: none;
            width: 100%;
            border-radius: 10px;
        }
        .account_form button {
            background: #f8d7da;
        }
        @media (max-width: 700px) {
            .user_reg{margin: 0px}
            .card .card-header{padding: 10px}
            .card .card-header h2{font-size: 18px}
        }
    </style>
@endsection

@section('script')
    <script>
        function formValidation() {
            var email_phone  = $('#email_phone').val();

            var password  = $('#password').val();
             var error = 0;

            if(email_phone=='')
            {
                error = 1;
                $('#email_phone').css('border', 'solid 2px red');
            }else{
                error = 0;
                $('#email_phone').css('border', 'solid 1px green');
            }

            if(password=='')
            {
                error = 1;
                $('#password').css('border', 'solid 2px red');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#password').css('border', 'solid 1px green');
            }

            if(error==0)
            {
                return true;
            }
            else{
                return false;
            }


            
        }
    </script>

@endsection