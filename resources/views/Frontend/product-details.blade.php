@extends('Frontend.layout')
@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>{{$product->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product details start-->
    <div class="product_details mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product-details-tab">
                        <div id="img-1" class="zoomWrapper single-zoom">
                            <a href="javascript:void(0)">
                                <img id="zoom1" src="{{asset($productImage[0]->name)}}" data-zoom-image="{{asset($productImage[0]->name)}}" alt="{{$product->name}}">
                            </a>
                        </div>
                        <div class="single-zoom-thumb">
                            <ul class="s-tab-zoom owl-carousel single-product-active" id="gallery_01">

                                @foreach($productImage as $itme)
                                <li>
                                    <a href="javascript:void(0)" class="elevatezoom-gallery active" data-update="" data-image="{{asset($itme->name)}}" data-zoom-image="{{asset($itme->name)}}">
                                        <img src="{{asset($itme->name)}}" alt="zo-th-1"/>
                                    </a>

                                </li>

                                    @endforeach

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                        <form action="#">

                            <h1 style="font-weight: bold">{{$product->name}} <?php if($product->stock==0){ echo '<span class="text-success" style="font-size: 12px">(Out of Stock)</span>';}?></h1>



                            <?php
                            $discount_amount = 0;
                            $discount_apply = 0;
                            $product_price = 0;

                            if(!empty($product->discount_type)){

                                if($product->discount_type ==1){
                                    $discount_amount = $product->price*($product->discount/100);
                                    $product_price = $product->price-$discount_amount;
                                    $discount_apply = (int)$product->discount.'%';
                                }
                                else{
                                    $discount_amount = $product->discount;
                                    $product_price = $product->price-$discount_amount;
                                    $discount_apply = (int)$product->discount.'Tk';
                                }

                            }else{
                                $discount_amount = 0;
                                $product_price = $product->price;
                            }
                            if(!empty($product->discount_type)){
                            ?>
                            <div class="price_box">
                                <span class="current_price">Price: <span style="color: #b64500;font-weight: bold">{{number_format($product_price)}}Tk</span></span>
                                <span class="old_price" style="font-weight:500"> {{number_format($product_price+$discount_amount)}}Tk</span>

                            </div>
                            <?php } else{
                                ?>
                            <div class="price_box">
                                <span class="current_price" >Price: <span style="color: #b64500;font-weight: bold">{{number_format($product_price)}}Tk</span></span>


                            </div>

                            <?php }?>

                            <div class="product_variant color">
                            <?php if(!empty($product->discount_type)){?>
                                <h4>Discount : {{$discount_amount}}Tk</h4>
                                  <?php } ?>

                                <h3  class="outline-badge-success weight-badge" style="border: 1px solid #40A944;color: #40A944">{{$product->unit->id==5?'Qty':'Weight'}} : <span style="font-weight: bold"> {{$product->weight}}{{$product->unit->name}}</span> </h3>

                            </div>

                            <div class="product_desc">
                                <p>{!! $product->short_description !!} </p>
                            </div>

                            <div class="product_variant quantity" style="width: 100%">

                                <button class="button" type="button"  onclick="add_to_cart('{{$product->id}}')" style="font-weight:bold;font-family: Arial"><span class="lnr lnr-cart"></span> add to cart</button>

                            </div>

                            {{--<div class="product_meta">--}}
                                {{--<span>Category: <a href="javascript:void(0)">{{$product->category->name}}</a></span>--}}
                            {{--</div>--}}

                        </form>
                        {{--<div class="priduct_social">--}}
                            {{--<ul>--}}
                                {{--<li><a class="facebook" href="#" title="facebook"><i class="fa fa-facebook"></i> Like</a></li>--}}
                                {{--<li><a class="twitter" href="#" title="twitter"><i class="fa fa-twitter"></i> tweet</a></li>--}}
                                {{--<li><a class="pinterest" href="#" title="pinterest"><i class="fa fa-pinterest"></i> save</a></li>--}}
                                {{--<li><a class="google-plus" href="#" title="google +"><i class="fa fa-google-plus"></i> share</a></li>--}}
                                {{--<li><a class="linkedin" href="#" title="linkedin"><i class="fa fa-linkedin"></i> linked</a></li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info mb-65">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div id="accordion" class="card__accordion">
                        <div class="card card_dipult">
                            <div class="card-header card_accor" id="headingOne">
                                <button class="btn btn-link collapse-menu-button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="">
                                    {{$product->name}} Description

                                    <i class="fa fa-plus"></i>
                                    <i class="fa fa-minus"></i>

                                </button>

                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <div class="card-body">
                                    <p> {!! $product->long_description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    @if($related_product->count()>0)
    <section class="product_area related_products">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title">
                        <h2><i class="lnr lnr-cart"></i> Related Products	</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="product_carousel product_column5 owl-carousel">

                        @foreach($related_product as $item)

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
    </section>
    @endif
    <!--product area end-->


    @endsection
@section('style')
   <style>
       .card-header.card_accor button.btn-link {
           border: 1px solid #40A944;
           width: 100%;
           text-align: left;
           font-size: 14px;
           font-weight: 500;
           color: #ffffff;
           background: #40A944;
       }
       .s-tab-zoom.owl-carousel .owl-nav div {

           background: #ffffff;
           display: none;
       }
       .collapse-menu-button{
           background-color: #40a944;font-size: 18px;color:white
       }
       .weight-badge{
           border-radius: 30px;padding:5px 10px;width: 180px;
       }

       @media (max-width: 699px) {
           .collapse-menu-button {
               font-size: 16px;
           }
           .weight-badge{
               border-radius: 30px;padding:5px 10px;
           }
       }


   </style>
    @endsection
@section('script')
    <script type="text/javascript">


    </script>


@endsection
