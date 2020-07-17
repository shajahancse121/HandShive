@extends('Frontend.layout')
@section('style')
    <style>
        .widget_list.widget_categories > ul > li.widget_sub_categories > .test::before{
            display: none;

        }
    </style>
    @endsection
@section('content')

    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Shop</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->
    <!--shop  area start-->
    <div class="shop_area shop_reverse mt-70 mb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <!--sidebar widget start-->
                    <aside class="sidebar_widget">
                        <div class="widget_inner">

                            <div class="widget_list widget_categories">
                                <h3><i class="fa fa-th" style="font-size:14px"></i> Product Category</h3>
                                <ul>
                                    <?php $i=1; ?>
                                    @foreach($all_category as $value)
                                    <li class="widget_sub_categories sub_categories<?php echo $i;?>" >
                                        <a href="<?php if($value->sub_categories->count()>0){echo 'javascript:void(0)';}else{ ?>{{route('category_product',['slug'=>$value->slug])}}<?php } ?>" class="<?php echo $value->sub_categories->count()<=0?'test':'' ?>">{{$value->name}}</a>
                                        @if($value->sub_categories->count()>0)
                                        <ul class="widget_dropdown_categories dropdown_categories<?php echo $i;?>" style="display: block">

                                            @foreach($value->sub_categories as $sub_category)
                                            <li><a href="{{route('subcategory_product',['sub_cat_slug'=>$sub_category->slug])}}"><i class="ion-ios-arrow-forward"></i> {{$sub_category->name}}</a></li>
                                                @endforeach

                                        </ul>
                                            @endif
                                        <?php $i++ ?>
                                    </li>

                                    @endforeach

                                </ul>
                            </div>

                            <?php if(isset($offer_img[3]) && $offer_img[3]->show_home==1){ ?>
                            <div class="widget_list banner_widget">
                                <div class="banner_thumb">
                                    <a href="{{$offer_img[3]->url_link}}"><img src="{{asset($offer_img[3]->image)}}" alt=""></a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </aside>
                    <!--sidebar widget end-->
                </div>
                <div class="col-lg-9 col-md-12">
                    <!--shop wrapper start-->
                    <!--shop toolbar start-->
                    <div class="shop_toolbar_wrapper">
                        <div class="shop_toolbar_btn">
                            <button data-role="grid_3" type="button" class="active btn-grid-3" data-toggle="tooltip" title="3"></button>
                            <!-- <button data-role="grid_4" type="button"  class=" btn-grid-4" data-toggle="tooltip" title="4"></button> -->
                            <button data-role="grid_list" type="button" class="btn-list" data-toggle="tooltip" title="List"></button>
                        </div>
                        <div class="page_amount">
                            <p>Showing {{$all_product->count()}} of {{$total_product}} results</p>
                        </div>
                    </div>
                    <!--shop toolbar end-->
                    <div class="row shop_wrapper">
                        @foreach($all_product as $item)

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
                                      $discount_apply = number_format((int)$item->discount).'Tk';
                                  }

                               }

                            @endphp

                        <div class="col-lg-4 col-md-4 col-sm-6 col-6 ">
                            <div class="single_product">
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
                                <div class="product_content grid_content">
                                    <h4 class="product_name" style="font-weight: bold;height: 30px"><a href="{{route('product-details',['slug'=>$item->slug])}}">{{$item->name}}</a></h4>
                                    <p><a href="javascript:void(0)"><span class="badge-success" style="padding:3px 20px;border-radius: 20px;font-weight: bold;">{{$item->weight}} {{$item->unit->name}}</span></a></p>

                                    <div class="price_box" style="font-weight: bold;">
                                        @if(!empty($item->discount_type))
                                            <span class="current_price"  style="color: #b64500;font-weight: bold"> {{number_format($item->price - $discount_amount)}}Tk</span>
                                            <span class="old_price" style="font-weight: bold"> {{number_format($item->price)}}Tk</span>
                                        @else
                                            <span class="current_price" style="color: #b64500;font-weight: bold"> {{number_format($item->price)}}Tk</span>
                                        @endif
                                        <br>

                                            <button class="btn btn-sm" id="add_to_cart" onclick="add_to_cart('{{$item->id}}')" style="border-radius: 5px;padding: 5px 10px;border: 1px solid #40a944;background-color: white;font-weight: bold;color: #40a944"><span class="lnr lnr-cart"></span> Add To Cart</button>


                                    </div>
                                </div>
                                <div class="product_content list_content">
                                    <h4 class="product_name" style="font-weight: bold"><a href="{{route('product-details',['slug'=>$item->slug])}}">{{$item->name}}</a></h4>
                                    <p ><a href="javascript:void(0)"><span class="badge-success" style="padding:3px 20px;border-radius: 20px;">{{$item->weight}} {{$item->unit->name}}</span></a></p>

                                    <div class="price_box" style="font-weight: bold">
                                        @if(!empty($item->discount_type))
                                            <span class="current_price" style="color: #b64500;font-weight: bold"> {{number_format($item->price - $discount_amount)}}Tk</span>
                                            <span class="old_price" style="font-weight: bold"> {{number_format($item->price)}}Tk</span>
                                        @else
                                            <span class="current_price" style="color: #b64500;font-weight: bold"> {{number_format($item->price)}}Tk</span>
                                        @endif

                                    </div>


                                    <div class="product_desc">
                                        <p>{!! $item->short_description !!}</p>
                                    </div>
                                    <div class="action_links list_action_right">
                                        <button class="btn btn-sm " id="add_to_cart" onclick="add_to_cart('{{$item->id}}')" style="border-radius: 5px;padding: 5px 10px;border: 1px solid #40a944;background-color: white;font-weight: bold;color: #40a944"><span class="lnr lnr-cart"></span> Add To Cart</button>

                                    </div>
                                </div>
                            </div>
                        </div>

                            @endforeach

                    </div>

                    <div class="shop_toolbar t_bottom">
                        <div class="pagination">
                            <?php echo $all_product->render(); ?>
                        </div>
                    </div>

                    <!--shop toolbar end-->
                    <!--shop wrapper end-->
                </div>
            </div>
        </div>
    </div>
    <!--shop  area end-->

    @endsection

@section('style')


    <style>



    </style>

    @endsection

@section('script')

    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>

    <script type="text/javascript">



    </script>


@endsection
