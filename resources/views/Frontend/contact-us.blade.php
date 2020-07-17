@extends('Frontend.layout')

@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Contact Us</h3>
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li>contact us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

   <br>


    <!--contact area start-->

    <div class="about_gallery_section">
        <div class="container">
            <div class="about_gallery_container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="width:400px">
                            <div class="card-header text-center">
                                <i class="fa fa-phone" style="border: 2px solid #40A944;border-radius: 50%; height: 70px;line-height: 70px;width: 70px;text-align: center;color: #40A944 !important;margin-bottom: 10px;font-size: 2.57142857rem"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Call Us</h4>
                                <p class="card-text text-center">Support: {{$company->mobile}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width:400px;padding:6px">
                            <div class="card-header text-center">
                                <i class="fa fa-map-marker" style="border: 2px solid #40A944;border-radius: 50%; height: 70px;line-height: 70px;width: 70px;text-align: center;color: #40A944 !important;margin-bottom: 10px;font-size: 2.57142857rem"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Address</h4>
                                <p class="card-text text-center"> {{$company->address}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="width:400px">
                            <div class="card-header text-center">
                                <i class="fa fa-envelope" style="border: 2px solid #40A944;border-radius: 50%; height: 70px;line-height: 70px;width: 70px;text-align: center;color: #40A944 !important;margin-bottom: 10px;font-size: 2.57142857rem"></i>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-center">Email</h4>
                                <p class="card-text text-center">{{$company->email}}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="height: 50px"></div>
                <div class="row">

                    <div class="col-lg-7 col-md-7">
                        <div class="contact_message form" style="border:1px solid #d9e8da;padding:25px;background-color: #F7F7F7">
                            <h3><i class="ion-email"></i> Write Message </h3>
                            @if(session('success'))
                                <div class="alert alert-success mb-4" role="alert" id="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
                                    {{session('success')}}.
                                </div>
                            @endif
                            <form  action="{{route('contact-message')}}" method="post" onsubmit="return formValidation();">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label> <strong>Name</strong>  <span class="text-danger">*</span></label>
                                        <input name="name" id="name" placeholder="Enter Your Name" type="text">
                                        @error('name')
                                        <label style="font-weight: bold;color:#00c854" for="name"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label> <strong>  Phone</strong> <span class="text-danger">*</span></label>
                                        <input name="phone" id="phone" placeholder="Enter  Phone" type="text">
                                        @error('phone')
                                        <label style="font-weight: bold;color:#00c854" for="phone"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>  <strong> Email</strong> <span class="text-danger">*</span></label>
                                        <input name="email" id="email" placeholder="Enter   Email" type="email">
                                        @error('email')
                                        <label style="font-weight: bold;color:#00c854" for="email"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label> <strong> Subject</strong></label>
                                        <input name="subject" id="subject" placeholder="Enter Subject" type="text">
                                        @error('subject')
                                        <label style="font-weight: bold;color:#00c854" for="subject"><i class="ion-information-circled"></i> {{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="contact_textarea">
                                            <label><strong>  Your Message</strong><span class="text-danger">*</span></label>
                                            <textarea placeholder="Please get in touch if you have any question" name="message" id="message" style="height: 145px;"  class="form-control" ></textarea>
                                            @error('message')
                                            <label style="font-weight: bold;color:#00c854" for="message"><i class="ion-information-circled"></i> {{ $message }}</label>
                                            @enderror
                                        </div>
                                        <button type="submit" style="font-weight: bolder;height: 42px;background-color: #40a944;color: white"><i class="fa fa-envelope" style="color: wheat"></i> Send</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5">

                        <!-- Google Map HTML Codes -->
                        <h3><i class="fa fa-home"></i> Find US</h3>

                        <div id="google-maps">

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29214.805137676765!2d90.35474943182919!3d23.752704963631487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755bf961b9ebd63%3A0xbca69d102ae69885!2sBonaji%20Shop!5e0!3m2!1sen!2sbd!4v1590792575392!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>

                        <!--contact map start-->

                        <!--contact map end-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--contact area end-->

@endsection
@section('style')
    <style>
        .contact_message ul li i {
             margin-right: 0px;
        }
        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: white;
            border-bottom: 1px solid rgb(255, 255, 255);
        }
        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgb(255, 255, 255);
            border-radius: .25rem;
        }
        .card-body {
            -webkit-box-flex: 1;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 0px;
        }
        .contact_message button {
            font-weight: 400;
            /* height: 42px; */
            line-height: 42px;
            padding: 0 30px;
            text-transform: capitalize;
            border: none;
            background: #f7f7f7;
            color: #ffffff;
            cursor: pointer;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            border-radius: 4px;
        }
        .contact_message button:hover {
            background: #f7f7f7;
            font-weight: bold;
        }

    </style>


@endsection

@section('script')
    <script>
        function formValidation() {
            var email  = $('#email').val();
            var phone  = $('#phone').val();
            var name  = $('#name').val();
            var subject  = $('#subject').val();
            var message  = $('#message').val();

            var error = 0;
            if(name=='')
            {
                error = 1;
                $('#name').css('border', 'solid 2px #00c854');
            }else{
                error = 0;
                $('#name').css('border', 'solid 1px green');
            }

            if(email=='')
            {
                error = 1;
                $('#email').css('border', 'solid 2px #00c854');
            }else{

                if(error!=1) {
                    error = 0;
                }
                $('#email').css('border', 'solid 1px green');
            }


            if(phone=='')
            {
                error = 1;
                $('#phone').css('border', 'solid 2px #00c854');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#phone').css('border', 'solid 1px green');
            }
            if(subject=='')
            {
                error = 1;
                $('#subject').css('border', 'solid 2px #00c854');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#subject').css('border', 'solid 1px green');
            }
            if(message=='')
            {
                error = 1;
                $('#message').css('border', 'solid 2px #00c854');
            }else{
                if(error!=1) {
                    error = 0;
                }
                $('#message').css('border', 'solid 1px green');
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
