@extends('Frontend.layout')

@section('content')
    <!--slider area start-->
    <section class="slider_section">
        <div class="slider_area owl-carousel">
            @foreach($slider as $item)
            <div class="single_slider d-flex align-items-center" data-bgimg="{{asset($item->photo)}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="slider_content">
                                <h1>{{$item->title}}</h1>

                                <p>
                                    {{$item->description}}
                                </p>
                                <a href="{{$item->url_link}}">Read more </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach

        </div>
    </section>
    <!--slider area end-->
    <!--shipping area start-->
    <div class="shipping_area">
        <div class="container">
            <div class="row">
                @foreach($support as $item)
                <div class="col-lg-3 col-md-6">
                    <div class="single_shipping">
                        <div class="shipping_icone">
                            <img src="{{asset($item->icon)}}" alt="">
                        </div>
                        <div class="shipping_content">
                            <h3>{{$item->title}}</h3>
                            <p>{{$item->details}}</p>
                        </div>
                    </div>
                </div>
                    @endforeach



            </div>
        </div>
    </div>
    <!--shipping area end-->


    <!--product area start-->
    <div class="product_area mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">

                        <h2 class="bg-success text-white" style="border-radius: 10px;padding:5px 10px"><i class="lnr lnr-cart" style="font-size:26px"></i> New Product</h2>
                    </div>
                </div>
            </div>
            <div class="product_container">
                <div class="row">
                    <div class="col-12">
                        @if(isset($new_product[0]))
                        <div class="product_carousel product_column5 owl-carousel">

                           @foreach($new_product as $item)

                                @php

                                       $discount_amount = 0;
                                       $discount_apply = 0;
                                      if(!empty($item->discount_type)){

                                         if($item->discount_type ==1){
                                            $discount_amount = $item->price*($item->discount/100);
                                            $discount_apply = (int)$item->discount.'%';
                                         }
                                         else{
                                             $discount_amount = $item->discount;
                                             $discount_apply = (int)$item->discount.'Tk';
                                         }

                                      }

                                @endphp
                            <article class="single_product">
                                <figure>
                                    <div class="product_thumb">
                                        <a class="primary_img" href="{{route('product-details',['slug'=>$item->slug])}}"><img src="{{asset($item->product_images[0]->name)}}" alt=""></a>
                                        <a class="secondary_img" href="{{route('product-details',['slug'=>$item->slug])}}"><img src="{{asset(isset($item->product_images[1]->name)?$item->product_images[1]->name:$item->product_images[0]->name)}}" alt=""></a>
                                        <div class="label_product">

                                            @if(!empty($item->discount_type))
                                            <span class="label_new" style="font-weight: bold">
                                                   -{{$discount_apply}}
                                              </span>
                                            @endif
                                        </div>

                                    </div>
                                     @php

                                     @endphp
                                    <figcaption class="product_content">
                                        <h4 class="product_name" style="font-weight: bold;height: 30px"><a href="{{route('product-details',['slug'=>$item->slug])}}"  style="font-weight:bold">{{$item->name}}</a></h4>

                                        <p ><a href="javascript:void(0)"><span class="badge-success weight-badge">{{$item->weight}} {{$item->unit->name}}</span></a></p>

                                        <div class="price_box" style="font-weight: bold">
                                            @if(!empty($item->discount_type))
                                                <span class="current_price" style="color: #b64500;font-weight: bold"> {{$item->price - $discount_amount}}Tk</span>
                                                <span class="old_price" style="font-weight: bold"> {{$item->price}}Tk</span>
                                            @else
                                                <span class="current_price" style="color: #b64500;font-weight: bold"> {{$item->price}}Tk</span>
                                            @endif
                                            <br>

                                                <button class="btn btn-sm " onclick="add_to_cart('{{$item->id}}')" style="border-radius: 5px;padding: 5px 10px;border: 1px solid #40a944;background-color: white;font-weight: bold;color: #40a944"><span class="lnr lnr-cart"></span> Add To Cart</button>


                                        </div>
                                    </figcaption>
                                </figure>
                            </article>

                               @endforeach

                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product area end-->
    <!--banner area start-->
    @if(isset($offer_img[0])  && ($offer_img[0]->show_home==1) && ($offer_img[1]->show_home==1))
    <div class="banner_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="{{$offer_img[0]->url_link}}"><img src="{{asset($offer_img[0]->image)}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="single_banner">
                        <div class="banner_thumb">
                            <a href="{{$offer_img[1]->url_link}}"><img src="{{asset($offer_img[1]->image)}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--banner area end-->
    <!--custom product area start-->
    <div class="product_area mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">

                        <h2 class="bg-success text-white" style="border-radius: 10px;padding:5px 10px"><i class="lnr lnr-cart" aria-hidden="true" style="color:white;font-size:26px"></i> Popular Product</h2>
                    </div>
                </div>
            </div>
            <div class="product_container">
                <div class="row">
                    <div class="col-12">
                        @if(isset($popular_product[0]))
                        <div class="product_carousel product_column5 owl-carousel">

                            @foreach($popular_product as $item)

                                @php

                                    $discount_amount = 0;
                                    $discount_apply = 0;
                                   if(!empty($item->discount_type)){

                                      if($item->discount_type ==1){
                                         $discount_amount = $item->price*($item->discount/100);
                                         $discount_apply = (int)$item->discount.'%';
                                      }
                                      else{
                                          $discount_amount = $item->discount;
                                          $discount_apply = (int)$item->discount.'Tk';
                                      }

                                   }

                                @endphp


                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('product-details',['slug'=>$item->slug])}}"><img src="{{asset($item->product_images[0]->name)}}" alt=""></a>
                                            <a class="secondary_img" href="{{route('product-details',['slug'=>$item->slug])}}"><img src="{{asset(isset($item->product_images[1]->name)?$item->product_images[1]->name:$item->product_images[0]->name)}}" alt=""></a>
                                            <div class="label_product">

                                                @if(!empty($item->discount_type))
                                                    <span class="label_new" style="font-weight: bold">
                                                   -{{$discount_apply}}
                                              </span>
                                                @endif
                                            </div>

                                        </div>
                                        @php

                                                @endphp
                                        <figcaption class="product_content">
                                            <h4 class="product_name" style="font-weight: bold;height: 30px"><a href="{{route('product-details',['slug'=>$item->slug])}}" style="font-weight:bold">{{$item->name}}</a></h4>

                                            <p ><a href="javascript:void(0)"><span class="badge-success" style="padding:3px 20px;border-radius: 20px;">{{$item->weight}} {{$item->unit->name}}</span></a></p>

                                            <div class="price_box" style="font-weight: bold">
                                                @if(!empty($item->discount_type))
                                                    <span class="current_price" style="color: #b64500;font-weight: bold"> {{$item->price - $discount_amount}}Tk</span>
                                                    <span class="old_price" style="font-weight: bold"> {{$item->price}}Tk</span>
                                                @else
                                                    <span class="current_price" style="color: #b64500;font-weight: bold"> {{$item->price}}Tk</span>
                                                @endif
                                                <br>

                                                <button class="btn btn-sm " onclick="add_to_cart('{{$item->id}}')" style="border-radius: 5px;padding: 5px 10px;border: 1px solid #40a944;background-color: white;font-weight: bold;color: #40a944"><span class="lnr lnr-cart"></span> Add To Cart</button>


                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>

                            @endforeach

                        </div>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--custom product area end-->
    <!--banner fullwidth area satrt-->
    @if(isset($offer_img[2]) && ($offer_img[2]->show_home==1))
    <div class="banner_fullwidth">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="banner_full_content">
                        <a href="{{$offer_img[2]->url_link}}"><img src="{{asset($offer_img[2]->image)}}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!--banner fullwidth area end-->
    <!--product area start-->
    <div class="product_area mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">

                        <h2 class="bg-success text-white" style="border-radius: 10px;padding:5px 10px"><i class="ion-heart" aria-hidden="true" style="color:white;font-size:26px"></i> Best Seller Product</h2>
                    </div>
                </div>
            </div>
            @if(isset($best_product[0]))
            <div class="product_container">
                <div class="row">
                    <div class="col-12">
                        <div class="product_carousel product_column5 owl-carousel">
                            @foreach($best_product as $item)

                                @php

                                    $discount_amount = 0;
                                    $discount_apply = 0;
                                   if(!empty($item->discount_type)){

                                      if($item->discount_type ==1){
                                         $discount_amount = $item->price*($item->discount/100);
                                         $discount_apply = (int)$item->discount.'%';
                                      }
                                      else{
                                          $discount_amount = $item->discount;
                                          $discount_apply = (int)$item->discount.'Tk';
                                      }

                                   }

                                @endphp
                                <article class="single_product">
                                    <figure>
                                        <div class="product_thumb">
                                            <a class="primary_img" href="{{route('product-details',['slug'=>$item->slug])}}"><img src="{{asset($item->product_images[0]->name)}}" alt=""></a>
                                            <a class="secondary_img" href="{{route('product-details',['slug'=>$item->slug])}}"><img src="{{asset(isset($item->product_images[1]->name)?$item->product_images[1]->name:$item->product_images[0]->name)}}" alt=""></a>
                                            <div class="label_product">

                                                @if(!empty($item->discount_type))
                                                    <span class="label_new" style="font-weight: bold">
                                                   -{{$discount_apply}}
                                              </span>
                                                @endif
                                            </div>

                                        </div>
                                        @php

                                                @endphp
                                        <figcaption class="product_content">
                                            <h4 class="product_name" style="font-weight: bold;height: 30px"><a href="{{route('product-details',['slug'=>$item->slug])}}" style="font-weight:bold">{{$item->name}}</a></h4>

                                            <p ><a href="javascript:void(0)"><span class="badge-success" style="padding:3px 20px;border-radius: 20px;">{{$item->weight}} {{$item->unit->name}}</span></a></p>

                                            <div class="price_box" style="font-weight: bold">
                                                @if(!empty($item->discount_type))
                                                    <span class="current_price" style="color: #b64500;font-weight: bold"> {{$item->price - $discount_amount}}Tk</span>
                                                    <span class="old_price" style="font-weight: bold"> {{$item->price}}Tk</span>
                                                @else
                                                    <span class="current_price" style="color: #b64500;font-weight: bold"> {{$item->price}}Tk</span>
                                                @endif
                                                <br>

                                                <button class="btn btn-sm " onclick="add_to_cart('{{$item->id}}')" style="border-radius: 5px;padding: 5px 10px;border: 1px solid #40a944;background-color: white;font-weight: bold;color: #40a944"><span class="lnr lnr-cart"></span> Add To Cart</button>


                                            </div>
                                        </figcaption>
                                    </figure>
                                </article>

                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
                @endif
        </div>
    </div>
    <!--product area end-->
    <!--blog area start-->
    <section class="blog_section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2 class="bg-success text-white" style="border-radius: 10px;padding:5px 10px"><i class="ion-android-list" style="font-size:26px"></i>  Popular Category</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($home_category as $category)
                <div class="col-6 col-lg-4 mb-4">
                    <article class="single_blog" style="box-shadow:5px 5px 20px grey; ">
                        <figure>
                            <div class="blog_thumb">
                                <a href="{{route('category_product',['slug'=>$category->slug])}}"><img class="img-fluid"  src="{{asset($category->category_image)}}" alt=""></a>
                            </div>
                            <figcaption class="blog_content text-center">
                                <h4 class="post_title"><a href="{{route('category_product',['slug'=>$category->slug])}}">{{$category->name}}</a></h4>
                            </figcaption>
                        </figure>
                    </article>
                </div>
                    @endforeach

            </div>
        </div>
    </section>
    <!--blog area end-->

@endsection

@section('style')
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .product_content p {
            font-size: 15px;
            line-height: 10px;
            margin-bottom: 0;

        }


        .weight-badge{
            padding:3px 20px;
            border-radius: 20px;
        }

@media (max-width: 700px) {
                  .single_slider {
    background-position: 67%;
    height: 280px;
}

              }
        .ion-heart{font-size: 20px !important;}
        .ion-android-list{font-size: 20px !important;}
        .lnr-cart{font-size: 20px !important;}
    </style>
    @endsection
@section('script')

    <script type="text/javascript">


    </script>


    @endsection
