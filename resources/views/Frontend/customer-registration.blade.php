@extends('Frontend.layout')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3><i class="ion-person-add"></i> Customer Registration</h3>
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>Customer Registration</li>
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
                                <h2 style="padding-top: 10px;"><i class="ion-ios-people"></i> Customer Registration</h2>

                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-primary mb-4" role="alert" id="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
                                        {{session('success')}}.
                                    </div>
                                @endif
                                <form  action="{{route('customer-register')}}" method="post" onsubmit="return formValidation();">
                                    @csrf
                                    <p>
                                        <label style="font-weight: bold" for="name"><i class="ion-person"></i> Your Name  <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" placeholder="Enter Your Name" value="{{old('name')}}">
                                        @error('name')
                                        <label style="font-weight: 400;color:red" for="name"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>
                                    <p>
                                        <label style="font-weight: bold" for="phone"><i class="ion-android-call"></i> Phone   <span class="text-danger">*</span></label>
                                        <input type="text" name="phone" id="phone" value="{{old('phone')}}" placeholder="Your Mobile : 01xxxxxxxxx">
                                        @error('phone')
                                        <label style="font-weight: 400;color:red" for="phone"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>
                                    <p>
                                        <label style="font-weight: bold" for="email"><i class="ion-email"></i> Email   <span class="text-success" style="font-size: 11px;font-weight: normal;font-family: Arial;color: #95bd97">(Optional)</span></label>
                                        <input type="text" name="email" id="email" value="{{old('email')}}" placeholder="Enter Your Email">
                                        @error('email')
                                        <label style="font-weight: 400;color:red" for="email"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>
                                    <p>
                                        <label style="font-weight: bold" for="password"><i class="ion-android-unlock"></i> Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" placeholder="Enter Password">
                                        @error('password')
                                        <label style="font-weight: 400;color:red" for="password"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>
                                    <p>
                                        <label style="font-weight: bold" for="password_confirmation"><i class="ion-key"></i> Confirm Password <span class="text-success">*</span></label>
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter Password again">
                                        @error('password_confirmation')
                                        <label style="font-weight: 400;color:red" for="password_confirmation"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </p>
                                    <div class="login_submit">
                                        <button type="submit" style="font-size: 16px;background: #40a944"><i class="ion-person-add"></i> Create Account</button>
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
    .account_form button {
        background: #cce5ff;
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
            var email  = $('#email').val();
            var name  = $('#name').val();
            var phone  = $('#phone').val();
            var password  = $('#password').val();
            var password_confirm  = $('#password_confirmation').val();
            var error = 0;

            if(phone=='')
            {
                error = 1;
                $('#phone').css('border', 'solid 3px #40a944');
            }else{
                error = 0;
                $('#phone').css('border', 'solid 1px green');
            }
            if(name=='')
            {
                error = 1;
                $('#name').css('border', 'solid 3px #40a944');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#name').css('border', 'solid 1px green');
            }

            if(password=='')
            {
                error = 1;
                $('#password').css('border', 'solid 3px #40a944');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#password').css('border', 'solid 1px green');
            }
            if(password_confirm=='')
            {
                error = 1;
                $('#password_confirmation').css('border', 'solid 3px #40a944');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#password_confirmation').css('border', 'solid 1px green');
            }
            if(email=='')
            {

                $('#email').css('border', 'solid 3px #8CBD8B');
            }else{

                $('#email').css('border', 'solid 1px green');
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
