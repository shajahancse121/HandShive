@extends('Frontend.layout')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3><i class="ion-ios-telephone"></i> Phone Verification</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>Phone Verification</li>
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
                        <div class="card">

                            <div class="card-header">
                                <h2 style="padding-top: 10px;"><i class="ion-ios-keypad"></i> Phone Verification</h2>

                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-{{session('type')}} mb-4" role="alert" id="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                        {!! session('success') !!}.
                                    </div>
                                @endif
                                    @if(session('danger'))
                                        <div class="alert alert-{{session('type')}} mb-4" role="alert" id="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                            {!! session('danger') !!}.
                                        </div>
                                    @endif
                                <form  action="{{route('customer-verify-save')}}" method="post" onsubmit="return formValidation();">
                                    @csrf


                                    <p>
                                        <label style="font-weight: bold" for="code"><i class="ion-key"></i> Enter Verification Code  <span class="text-success">*</span></label>
                                        <input type="number" name="code" id="code" placeholder="Enter 4digit code" style="font-weight: bolder;font-size: 20px;color:#40A944"  autocomplete="off">

                                        @error('code')
                                        <label style="font-weight: 400;color:red" for="code"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>


                                    <div class="login_submit">
                                       <div class="row">
                                          <div class="col-md-6"><a href="{{route('customer-resendcode')}}" style="color: #40A944;font-weight:400"> Resend Code? </a></div>
                                           <div class="col-md-6">  <button type="submit" style="font-size: 16px;background: #40a944"><i class="ion-key"></i> Apply</button></div>

                                       </div>
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
            .user_reg{margin: 0px !important;}
            .card .card-header{padding: 10px}
            .card .card-header h2{font-size: 18px}
        }
    </style>
@endsection

@section('script')
    <script>
        function formValidation() {
            var code  = $('#code').val();


            var error = 0;

            if(code=='')
            {
                error = 1;
                $('#code').css('border', 'solid 2px red');
            }else{
                error = 0;
                $('#code').css('border', 'solid 1px green');
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
