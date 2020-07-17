@extends('backend.admin.admin-layout')

@section('content')


    <div class="row layout-top-spacing">






        <div class="col-xl-6 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
            @if(session('success'))
                <div class="alert alert-primary mb-4" role="alert" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
                    {{session('success')}}.
                </div>
            @endif

            <div class="user-profile layout-spacing">
                <div class="widget-content widget-content-area">
                    <div class="d-flex justify-content-between">
                        <h3 class="">Company Profile</h3>
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal_edit" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
                    </div>
                    <div class="text-center user-info">
                        <img src="{{asset(isset($company->logo)?$company->logo:'frontend/logo_final.png')}}" width="200">

                        <p class=""><i class="ion-android-home" style="color: #888ea8;font-weight: bolder;font-size: 22px"></i> {{isset($company->name)?$company->name:'Not Found'}}</p>
                    </div>
                    <div class="user-info-list">

                        <div class="">
                            <ul class="contacts-block list-unstyled">
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg> {{isset($company->title)?$company->title:''}}
                                </li>
                                {{--<li class="contacts-block__item">--}}
                                    {{--<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Jan 20, 1989--}}
                                {{--</li>--}}
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>{{isset($company->address)?$company->address:''}}
                                </li>
                                <li class="contacts-block__item">
                                    <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg> {{isset($company->email)?$company->email:''}}</a>
                                </li>
                                <li class="contacts-block__item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> {{isset($company->mobile)?$company->mobile:''}}
                                </li>
                                <li class="contacts-block__item">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{isset($company->facebook)?$company->facebook:''}}" target="_blank"><div class="social-icon">
                                                    <i class="ion-social-facebook" style="font-size: 26px;color: #3578E5;font-weight: bolder"></i>
                                                </div></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{isset($company->youtube)?$company->youtube:''}}" target="_blank">
                                            <div class="social-icon">
                                                <i class="ion-social-youtube" style="font-size: 26px;color: #3578E5;font-weight: bolder"></i>
                                            </div>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{isset($company->twitter)?$company->twitter:''}}" target="_blank">
                                            <div class="social-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                            </div>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="{{isset($company->instragram)?$company->instragram:''}}" target="_blank">
                                            <div class="social-icon">

                                                <i class="ion-social-instagram-outline" style="font-size: 26px;color: #3578E5;font-weight: bolder"></i>

                                            </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form action="{{route('admin.edit-company')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-content" style="min-width: 700px">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="ion-android-home"></i> Update Company Profile</h5>

                            </div>
                            <div class="modal-body">
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Company Name</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">
                                        <input type="hidden" name="id" id="company_id" value="{{isset($company->id)?$company->id:''}}">
                                        <input type="text" name="name"  required value="{{$company->name}}" class="form-control" id="name" placeholder="Enter Company Name">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Title</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" required name="title" value="{{$company->title}}" id="title" class="form-control"  placeholder="Enter Company Title">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Address</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" required name="address" value="{{$company->address}}"  class="form-control" id="address" placeholder="Enter Company Address">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" name="email" required value="{{$company->email}}" class="form-control" id="email" placeholder="Enter Support Email">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" name="mobile" required value="{{$company->mobile}}" class="form-control" id="mobile" placeholder="Enter Support Mobile Number">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Facebook</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" name="facebook"  value="{{$company->facebook}}" class="form-control" id="facebook" placeholder="Enter Facebook URL">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Youtube</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" name="youtube"  value="{{$company->youtube}}" class="form-control" id="youtube" placeholder="Enter Youtube URL">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" name="twitter"  value="{{$company->twitter}}" class="form-control" id="twitter" placeholder="Enter twitter URL">
                                    </div>
                                </div>
                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Instagram</label>
                                    <div class="col-xl-10 col-lg-9 col-sm-10">

                                        <input type="text" name="instragram" value="{{$company->instragram}}"  class="form-control" id="instragram" placeholder="Enter instagram URL">
                                    </div>
                                </div>




                                <div class="form-group row mb-4">
                                    <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label"> Company Logo </label>
                                    <div class="col-6">
                                        <div class="field_wrapper">
                                            <div>
                                                <input type="file"  name="logo" accept="image/*" onchange="loadFile1(event)"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-8 offset-4">
                                            <img class="img-fluid" src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" id="output_1" width="300" >

                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            {{--<div class="education layout-spacing ">--}}
                {{--<div class="widget-content widget-content-area">--}}
                    {{--<h3 class="">Education</h3>--}}
                    {{--<div class="timeline-alter">--}}
                        {{--<div class="item-timeline">--}}
                            {{--<div class="t-meta-date">--}}
                                {{--<p class="">04 Mar 2009</p>--}}
                            {{--</div>--}}
                            {{--<div class="t-dot">--}}
                            {{--</div>--}}
                            {{--<div class="t-text">--}}
                                {{--<p>Royal Collage of Art</p>--}}
                                {{--<p>Designer Illustrator</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="item-timeline">--}}
                            {{--<div class="t-meta-date">--}}
                                {{--<p class="">25 Apr 2014</p>--}}
                            {{--</div>--}}
                            {{--<div class="t-dot">--}}
                            {{--</div>--}}
                            {{--<div class="t-text">--}}
                                {{--<p>Massachusetts Institute of Technology (MIT)</p>--}}
                                {{--<p>Designer Illustrator</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="item-timeline">--}}
                            {{--<div class="t-meta-date">--}}
                                {{--<p class="">04 Apr 2018</p>--}}
                            {{--</div>--}}
                            {{--<div class="t-dot">--}}
                            {{--</div>--}}
                            {{--<div class="t-text">--}}
                                {{--<p>School of Art Institute of Chicago (SAIC)</p>--}}
                                {{--<p>Designer Illustrator</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class="work-experience layout-spacing ">--}}

                {{--<div class="widget-content widget-content-area">--}}

                    {{--<h3 class="">Work Experience</h3>--}}

                    {{--<div class="timeline-alter">--}}

                        {{--<div class="item-timeline">--}}
                            {{--<div class="t-meta-date">--}}
                                {{--<p class="">04 Mar 2009</p>--}}
                            {{--</div>--}}
                            {{--<div class="t-dot">--}}
                            {{--</div>--}}
                            {{--<div class="t-text">--}}
                                {{--<p>Netfilx Inc.</p>--}}
                                {{--<p>Designer Illustrator</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="item-timeline">--}}
                            {{--<div class="t-meta-date">--}}
                                {{--<p class="">25 Apr 2014</p>--}}
                            {{--</div>--}}
                            {{--<div class="t-dot">--}}
                            {{--</div>--}}
                            {{--<div class="t-text">--}}
                                {{--<p>Google Inc.</p>--}}
                                {{--<p>Designer Illustrator</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="item-timeline">--}}
                            {{--<div class="t-meta-date">--}}
                                {{--<p class="">04 Apr 2018</p>--}}
                            {{--</div>--}}
                            {{--<div class="t-dot">--}}
                            {{--</div>--}}
                            {{--<div class="t-text">--}}
                                {{--<p>Design Reset Inc.</p>--}}
                                {{--<p>Designer Illustrator</p>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}

            {{--</div>--}}

        </div>

    </div>

@endsection
@section('style')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('backend/assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />

    <!-- END PAGE LEVEL STYLES -->
    <style>
        .user-profile .widget-content-area h3:after {
            position: absolute;
            content: "";
            height: 2px;
            width: 119px;
            background: #1b55e2;
            border-radius: 50%;
            bottom: 9px;
            left: 15px;
        }
        .user-profile .widget-content-area .user-info-list ul.contacts-block li a {
            font-weight: 600;
            font-size: 14px;
            color: #1b55e2;
        }
        .user-profile .widget-content-area .user-info-list ul.contacts-block ul.list-inline div.social-icon {
            border: 2px solid #e0e6ed;
            border-radius: 50%;
            height: 39px;
            width: 38px;
            display: flex;
            justify-content: center;
            align-self: center;
        }
    </style>

@endsection
@section('script')
<script>
    var loadFile1 = function(event) {
        var output = document.getElementById('output_1');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>



@endsection