@extends('Frontend.layout')

@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>About Us</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>about us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--services img area-->
    <!--shipping area start-->
    <div class="shipping_area">
        <div class="container">
            @if(!empty($support))
            <div class="row">
                @foreach($support as $item)
                    <div class="col-lg-3 col-md-6">
                        <div class="single_shipping">
                            <div class="shipping_icone">
                                <img src="{{asset($item->icon)}}" alt="">
                            </div>
                            <div class="shipping_content">
                                <h3 style="font-weight: bolder;color: black">{{$item->title}}</h3>
                                <p style="color: #00c854">{{$item->details}}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
                @endif
        </div>
    </div>
    <br>
    <!--shipping area end-->
    <div class="about_gallery_section">
        <div class="container">
            <div class="about_gallery_container">
                @if(!empty($mission_visions))
                <div class="row">
                    @foreach($mission_visions as $mission_vision)
                    <div class="col-lg-4 col-md-4">
                        <article class="single_gallery_section" style="box-shadow: 0 5px 12px rgba(126,142,177,.2)">
                            <figure>
                                <div class="gallery_thumb">
                                    <img src="{{asset($mission_vision->photo)}}" alt="">
                                </div>
                                <figcaption class="about_gallery_content">
                                    <h3>{{$mission_vision->title}}</h3>
                                    <p style="padding-left: 20px;padding-right: 20px;text-align:center;padding-bottom:5px">  {{substr($mission_vision->details,0,152)}}</p>
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal_box{{$mission_vision->id}}"  style="margin-bottom: 10px">Read more</button>


                                </figcaption>
                            </figure>
                        </article>
                    </div>
                        @endforeach

                </div>
                    @endif
            </div>
        </div>
    </div>
    <!--services img end-->
    <!--testimonial area start-->
    <div class="faq-client-say-area">
        <div class="container">

            <div class="row">
                @if(!empty($faqs))
                <div class="col-lg-6 col-md-6">
                    <div class="faq-client_title">
                        <h2>What can we do for you ?</h2>
                    </div>
                    <div class="faq-style-wrap" id="faq-five">
                        <!-- Panel-default -->
                        @foreach($faqs as $item)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h5 class="panel-title">
                                    <a class="collapsed" role="button" data-toggle="collapse" data-target="#faq-collapse{{$item->id}}" aria-expanded="false" aria-controls="faq-collapse{{$item->id}}"> <span class="button-faq"></span>{{$item->title}}</a>
                                </h5>
                            </div>
                            <div id="faq-collapse{{$item->id}}" class="collapse" aria-expanded="true" role="tabpanel" data-parent="#faq-five">
                                <div class="panel-body">
                                <p>
                                    {{$item->details}}
                                </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <!--// Panel-default -->


                    </div>

                </div>
                @endif
                 @if(!empty($customer_shares))
                <div class="col-lg-6 col-md-6">
                    <!--testimonial area start-->
                    <div class="testimonial_area  testimonial_about">
                        <div class="section_title">
                            <h2>What Our Customers Says ?</h2>
                        </div>
                        <div class="testimonial_container">
                            <div class="testimonial_carousel testimonial-two owl-carousel">

                                @foreach($customer_shares as $customer_share)
                                <div class="single_testimonial">
                                    <div class="testimonial_thumb">
                                        <a href="{{$customer_share->hyperlink}}" target="_blank"><img src="{{asset($customer_share->photo)}}" alt="" width="100px"></a>
                                    </div>
                                    <div class="testimonial_content">

                                        <p>{{$customer_share->message}}</p>
                                        <a href="{{$customer_share->hyperlink}}" target="_blank">{{$customer_share->name}}</a>
                                    </div>
                                </div>
                                    @endforeach

                            </div>
                        </div>
                    </div>
                    <!--testimonial area end-->
                </div>
                     @endif
            </div>

        </div>
    </div>
    <!--testimonial area end-->
    <div class="row" style="height: 50px"></div>

    <!-- modal area start-->
    @foreach($mission_visions as $mission_vision)

    <div class="modal fade" id="modal_box{{$mission_vision->id}}" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="width: 500px;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="icon-x"></i></span>
                </button>
                <div class="modal_body">
                    <div class="container">
                        <div class="row">

                            <div class="col-lg-12 col-md-12">
                                <article class="single_gallery_section" style="box-shadow: 0 5px 12px rgba(126,142,177,.2)">
                                    <figure>
                                        <div class="gallery_thumb">
                                            <img src="{{asset($mission_vision->photo)}}" alt="">
                                        </div>
                                        <figcaption class="about_gallery_content">
                                            <h3>{{$mission_vision->title}}</h3>
                                            <p style="padding-left: 20px;padding-right: 20px;text-align:center;padding-bottom:5px"> {{$mission_vision->details}}</p>


                                        </figcaption>
                                    </figure>
                                </article>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal area end-->

    @endforeach

@endsection
@section('style')
    <style>

        .testimonial_container .owl-dots .owl-dot.active {
            background: #40a944;
        }
        .testimonial_container .owl-dots .owl-dot:hover {
            background: #40a944;
        }

        .faq-style-wrap .panel-title a[aria-expanded=false] {
            border-radius: 3px 3px 0 0;
            color: #ffffff;
            background: #40A944;
        }
        .panel-heading .panel-title a::before {
            color:white;
        }

        .testimonial_container .testimonial_thumb img {
            width: 100px;
            height: 100px;
            border: 1px solid #3a3838;
            border-radius: 50%;
            margin: 0 auto;
        }
        .modal-content{margin-left: 260px}
        .modal-content button.close {
            position: absolute;
            left: 94%;
            width: 35px;
            height: 35px;
            line-height: 37px;
            display: block;
            border: 0px;
            top: 10px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            z-index: 9;
        }
        @media (max-width: 700px) {
            .modal-content{
                margin-left: 0px;
                margin-right: 20px;
            }


        }
    </style>


@endsection

@section('script')


@endsection