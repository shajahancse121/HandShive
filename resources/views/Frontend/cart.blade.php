@extends('Frontend.layout')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3>Cart</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <!--shopping cart area start -->
    <?php
      if(Cart::count()>0){
    ?>
    <div class="shopping_cart_area mt-70">
        <div class="container">

            <ul class="nav nav-tabs">
                <li class=" order_menu" style="width: 25%;text-align: center;font-weight: bold;font-family: 'Raleway';padding: 5px 2px"><a  href="#home" class="active"><span style="background-color:#40a944;color: white;border: 1px #40a944 ;border-radius:50%;padding: 1px 5px">1</span> SHOPPING CART</a></li>
                <li class=" order_menu" style="width: 5%"></li>
                <li class=" order_menu" style="width: 25%;text-align: center;font-weight: bold;font-family: 'Raleway';padding: 5px 2px"><a  href="#menu1" ><span style="background-color:#40a944;color: white;border: 1px #40a944 ;border-radius:50%;padding: 1px 5px">2</span> BILLING &
                        SHIPPING </a></li>
                <li class="order_menu" style="width: 5%"></li>
                <li class="order_menu" style="width: 25%;text-align: center;font-weight: bold;font-family: 'Raleway';padding: 5px 2px"><a  href="#menu2" ><span style="background-color:#40a944;color: white;border: 1px #40a944 ;border-radius:50%;padding: 1px 5px">3</span> CONFIRMATION
                        & PAYMENT</a></li>

            </ul>
            <div class="tab-content" style="margin-top: 40px">

                <div id="home" class="tab-pane fade in active">

                    <div class="row">
                        <div class="col-12">
                            <div class="table_desc">
                                <div class="cart_page">
                                    <table  width="100%">
                                        <thead>
                                        <tr>

                                            <th class="">Image</th>
                                            <th class="">Product</th>

                                            <th class="">Price</th>
                                            <th class="qty_column">Qty</th>
                                            <th class="">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody id="cart_table">
                                        <?php
                                        $discount_total_amount = 0;
                                        ?>

                                        <?php foreach(Cart::content() as $row) :?>

                                        <?php $discount_total_amount+=($row->options->discount*$row->qty) ?>

                                        <tr>

                                            <td ><a href="javascript:void(0)"><img src="{{asset($row->options->product_image)}}" alt="" width="50px"></a><br>
                                                <a href="javascript:void(0)" onclick="delete_confirm('{{$row->id}}')"><i class="fa fa-times" style="font-size:15px;color:red"></i></a>
                                            </td>
                                            <td><a href="javascript:void(0)">{{$row->name}}-<span style="font-weight: bold;color: #0ba360">{{$row->options->weight}} {{$row->options->unit}}</span></a>

                                            </td>

                                            <td>
                                                <div class="row">
                                                    <?php

                                                     if($row->options->discount){
                                                         ?>
                                                        <div class="col-md-6 text-center">
                                                            {{number_format($row->price)}} Tk
                                                        </div>

                                                        <div class="col-md-6  text-center">
                                                            @if($row->options->discount)

                                                                <del style="color:gray"> {{$row->price+$row->options->discount}}Tk</del>
                                                            @endif
                                                        </div>
                                                    <?php
                                                     }else{
                                                         ?>
                                                        <div class="col-md-12 text-center">
                                                            {{number_format($row->price)}} Tk
                                                        </div>
<?php
                                                        }
                                                    ?>

                                                </div>


                                            </td>
                                            <td>


                                               <div class="row">
                                                   <div class="col-md-12">
                                                       <div class="input-group mb-3" style="text-align: center">
                                                           <div class="input-group-append">
                                                               <button class="btn btn-secondary change_btn" onclick="delete_cart('{{$row->id}}');" type="button"><i class="fa fa-minus"></i></button>

                                                               <input class="qty_update"  type="number" style="text-align: center;font-weight: bold;border: 1px solid gray;" min="1" id="pro_{{$row->id}}"  readonly="" value="{{$row->qty}}">
                                                               <button class="btn btn-secondary change_btn" type="button" onclick="update_cart('{{$row->id}}');"><i class="fa fa-plus"></i></button>
                                                           </div>
                                                       </div>
                                                   </div>
                                               </div>


                                            </td>
                                            <td >{{number_format($row->price*$row->qty)}} Tk</td>
                                        </tr>

                                        <?php endforeach;?>

                                        <?php $cart_grand_total = \Cart::subtotal(2,'.',''); ?>



                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <Td colspan="2" style="text-align: left;padding: 20px">

                                                <a data-toggle="tab" href="#menu1" onclick="tab_menu_active('menu1')" class="btn btn-success" style="font-family:'Raleway';font-weight: bold;color: white"><i class="ion-android-arrow-dropright"></i> Next</a>


                                            </Td>
                                            <td colspan="5" class="table_footer"  style="">
                                                <p><i class="ion-android-alert"></i> Subtotal :
                                                    <span id="cart_grand_total1" style="margin-right: 0px"><?php echo number_format($cart_grand_total); ?></span> Tk.</p>
                                                <p><i class="ion-android-alert"></i> Grand Total :
                                                    <span id="cart_grand_total2" style="margin-right: 0px"><?php echo number_format($cart_grand_total); ?></span> Tk.</p>

                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>


                                </div>
                                <div class="cart_submit">

                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div id="menu1" class="tab-pane fade">

                    <div class="row">


                            <div class="user-actions col-md-7">
                                <h3 class="bg bg-success text-white" style="border: 1px solid green;border-radius: 20px" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true" >


                                    <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true"  style="font-size: 20px;font-weight: bold;color:white;font-family: Raleway"><i class="ion-ios-cart"></i> BILLING & SHIPPING <i class="ion-android-arrow-down float-right" style="font-size: 20px"></i></a>

                                </h3>
                                <form  action="{{route('order-confirm')}}" method="post" onsubmit="return validate_form()" novalidate>
                                    @csrf
                                <div id="checkout_login" class="collapse show" data-parent="#accordion">
                                    <div class="checkout_info">
                                        <p class="billing_msg"><i class="ion-ios-information" style="font-size: 18px"></i> If you want to place one time order , Please enter Billing & Shipping Address.</p>

                                            <div class="form_group">
                                                <label><i class="ion-android-contact" style="font-size: 20px;"></i> Name<span>*</span></label>
                                                <input type="text" placeholder="Your Name" style="width: 90%" name="name" value="{{isset(\Auth::guard('customer')->user()->name)?\Auth::guard('customer')->user()->name:''}}" id="name">
                                            </div>

                                            <div class="form_group">
                                                <label><i class="ion-ios-telephone" style="font-size: 20px;"></i> Mobile  <span>*</span></label>
                                                <input type="text" placeholder="Your Mobile : 01xxxxxxxxx" name="mobile" id="mobile" value="{{isset(Auth::guard('customer')->user()->phone)?\Auth::guard('customer')->user()->phone:''}}"  style="width: 90%">
                                            </div>
                                            <div class="form_group">
                                                <label><i class="ion-ios-email" style="font-size: 20px;"></i> Email  <span style="color: grey;font-size: 10px">(Optional)</span></label>
                                                <input type="text"  name="email" id="email" value="{{isset(\Auth::guard('customer')->user()->email)?\Auth::guard('customer')->user()->email:''}}" placeholder="Your Email Address"  style="width: 90%">
                                            </div>
                                            <div class="form_group">
                                                <label><i class="ion-android-home" style="font-size: 20px;"></i> Address  <span></span></label>
                                                <textarea rows="4" cols="46"  name="address" id="address" placeholder="Type Your Billing & Shipping Address" style="width: 90%;">{{isset(\Auth::guard('customer')->user()->address)?Auth::guard('customer')->user()->address:''}}</textarea>
                                            </div>
                                            <div class="form_group">
                                                <label for="remember_box1">
                                                    <input id="shipping_as_gift" type="checkbox" name="shipping_as_gift" value="1" onchange="valueChanged()">
                                                    <span>  Send this product as gift</span>
                                                </label>

                                                <div class="row">
                                                    <div class="col-12" id="shipping_div" style="border:solid 1px #ece3e3;padding: 0px;display: none">
                                                        <h3>SHIPPING INFORMATION </h3>
                                                        <div class="form_group" style="padding: 10px">
                                                            <label><i class="ion-android-contact" style="font-size: 20px;"></i> Name<span>*</span></label>
                                                            <input type="text" name="name2" id="name2" placeholder="Your Name" style="width: 90%">
                                                        </div>

                                                        <div class="form_group" style="padding: 10px">
                                                            <label><i class="ion-ios-telephone" style="font-size: 20px;"></i> Mobile  <span>*</span></label>
                                                            <input type="text" name="mobile2" id="mobile2" placeholder="Your Mobile Number" style="width: 90%">
                                                        </div>
                                                        <div class="form_group" style="padding: 10px">
                                                            <label><i class="ion-ios-email" style="font-size: 20px;"></i> Email  <span style="color: grey;font-size: 10px">(Optional)</span></label>
                                                            <input type="text"  name="email2" id="email2" placeholder="Your Email Address" style="width: 90%">
                                                        </div>
                                                        <div class="form_group" style="padding: 10px">
                                                            <label><i class="ion-android-home" style="font-size: 20px;"></i> Address  <span></span></label>
                                                            <textarea rows="4" cols="40" name="address2" id="address2" placeholder="Type Your Billing & Shipping Address" style="width: 90%;"></textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class="form_group group_3 ">
                                                <a data-toggle="tab" href="#home" onclick="tab_menu_active('home')" class="btn btn-danger mr-2" style="font-family: Raleway;font-weight:bold;color:white"><i class="ion-android-arrow-dropright"></i> Prev</a>
                                                <a data-toggle="tab" href="#menu2"  onclick="tab_menu_active_menu2('menu2')" class="btn btn-success" style="font-family: Raleway;font-weight:bold;color:white"><i class="ion-android-arrow-dropright"></i> Next</a>


                                            </div>


                                    </div>
                                </div>
                            </div>
                        <div class="user-actions col-md-5">
                            <a class="d-md-none" id="mobile_link" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true" style="font-size: 20px;font-weight: bold;color:white;font-family: Raleway"><i class="ion-ios-contact-outline"></i> Registered customer?  <i class="ion-android-arrow-down float-right" style="font-size: 20px"></i></a>

                            <h3 class="bg bg-success text-white d-none d-md-block" style="border: 1px solid green;border-radius: 20px" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">


                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true" style="font-size: 20px;font-weight: bold;color:white;font-family: Raleway"><i class="ion-ios-contact-outline"></i> Registered customer?  <i class="ion-android-arrow-down float-right" style="font-size: 20px"></i></a>

                            </h3>
                            <div id="checkout_coupon" class="checkout_info collapse {{\Auth::guard('customer')->check()?'show':''}} " style=" margin-bottom: 30px;height: 675px" data-parent="#accordion">

                                <div class="container mt-3">

                                    <p><i class="ion-ios-information" style="font-size: 18px"></i> If you have shopped with us before, please enter your details in the boxes below.</p>


                                    <br>
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">

                                        <li class="nav-item" style="width: 100%">
                                            <a class="nav-link active" data-toggle="tab" href="#email_menu" onclick="email_click();" style="font-weight: bold"><i class="ion-ios-contact-outline" style="font-size: 18px"></i> Customer {{\Auth::guard('customer')->check()?'Dashboard':'Login'}}</a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">


                                            @if(\Auth::guard('customer')->check())
                                            <div id="email_menu" class="container"><br>
                                                <a href="{{route('my-dashboard')}}"><h4 style="font-family:'Raleway';font-size: 22px"><i class="ion-android-playstore" style="font-size: 24px"></i> My Dashboard</h4></a>
                                            </div>

                                                @else

                                            <div id="email_menu" class="container tab-pane active"><br>

                                                <div class="form_group">
                                                    <label><i class="ion-ios-email-outline" ></i> Phone or Email <span>*</span></label>
                                                    <input type="email"  id="customer_email"  autocomplete="off" class="form-control" placeholder="Enter your phone or email">
                                                </div>
                                                <div class="form_group">
                                                    <label><i class="ion-locked" ></i> Password  <span>*</span></label>
                                                    <input type="password" id="customer_password"   autocomplete="off" class="form-control" placeholder="Enter Password">
                                                </div>
                                                <div class="form_group group_3 ">
                                                    <button type="button" id="submitBtn"><i class="ion-ios-download-outline" style="font-size: 17px"></i> Login</button>

                                                </div>


                                                <a href="{{route('customer-login')}}"  style="color:green"><i class="ion-android-unlock"></i> Forget  password?</a>
                                                <a href="{{route('customer-register')}}"  style="color:green"><i class="ion-person-stalker"></i> New Customer? Register Here!</a>



                                            </div>

                                                @endif



                                    </div>
                                </div>

                            </div>
                        </div>




                    </div>

                </div>

                <div id="menu2" class="tab-pane fade">



                    <div class="row">
                        <div class="col-12">
                            <div class="user-actions">

                                <h3 class="bg bg-success text-white" style="border: 1px solid green;border-radius: 20px" data-toggle="collapse" data-target="#order_details" aria-expanded="true"  >
                                    <i class="ion-search" aria-hidden="true"></i>
                                    See more?
                                    <a class="Returning" href="#" data-toggle="collapse" data-target="#order_details" aria-expanded="true"  style="font-size: 20px;font-weight: bold;color:white;font-family:'Raleway'">Order details <i class="ion-android-cart"></i> <i class="ion-android-arrow-down float-right" style="font-size: 20px"></i></a>

                                </h3>
                                <div id="order_details" class="collapse" data-parent="#accordion">
                                    <div class="row">
                                        <div class="checkout_info col-md-8">
                                            <p><i class="ion-android-cart"></i> Your order  details.</p>
                                            <table>
                                                <thead>
                                                <tr>


                                                    <th width="50%">Item</th>
                                                    <th width="20%">Price</th>
                                                    <th width="10%" style="text-align: center">Qty</th>
                                                    <th width="20%">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody id="cart_table_final" border="1">
                                                <?php
                                                $discount_total_amount = 0;
                                                $sl = 1;
                                                ?>

                                                <?php foreach(Cart::content() as $row) :?>

                                                <?php $discount_total_amount+=($row->options->discount*$row->qty) ?>

                                                <tr>
                                                    <td width="50%">
                                                       <strong>{{$sl++}}.</strong> {{$row->name}}-{{$row->options->weight}} {{$row->options->unit}}
                                                    </td>

                                                    <td width="20%">

                                                            <span>{{number_format($row->price)}} Tk</span>
                                                            <span style="text-decoration: line-through">{{number_format($row->price+$row->options->discount)}} Tk</span>


                                                    </td>
                                                    <td width="10%" style="text-align: center">


                                                        <strong>{{$row->qty}}</strong>

                                                    </td>
                                                    <td width="20%">{{number_format($row->price*$row->qty)}} Tk</td>
                                                </tr>

                                                <?php endforeach;?>





                                                </tbody>


                                            </table>
                                        </div>
                                        <div class="checkout_info col-md-4">
                                            <p style="font-weight: bold"><i class="fa fa-money"></i> Your billing details.</p>
                                            <hr>
                                            <table border="0">
                                                <tr>
                                                    <th style="border:0px;">Name : </th>
                                                    <td style="border:0px;"> <span id="name_label"></span></td>
                                                </tr>
                                                <tr>
                                                    <th style="border:0px;">Mobile : </th>
                                                    <td style="border:0px;"> <span id="mobile_label"></span></td>
                                                </tr>
                                                <tr>
                                                    <th style="border:0px;">Email : </th>
                                                    <td style="border:0px;"><span id="email_label"></span> </td>
                                                </tr>
                                                <tr>
                                                    <th style="border:0px;">Address : </th>
                                                    <td style="border:0px;"> <span id="address_label"></span> </td>
                                                </tr>
                                            </table>

                                            <hr>

                                           <div id="shipping_data" style="display: none">
                                               <p style="font-weight: bold"><i class="ion-android-car"></i> Your Shipping details.</p>
                                               <hr>
                                               <table>
                                                   <tr>
                                                       <th style="border:0px;">Name : </th>
                                                       <td style="border:0px;"> <span id="name_label2"></span></td>
                                                   </tr>
                                                   <tr>
                                                       <th style="border:0px;">Mobile : </th>
                                                       <td style="border:0px;"> <span id="phone_label2"></span></td>
                                                   </tr>
                                                   <tr>
                                                       <th style="border:0px;">Email : </th>
                                                       <td style="border:0px;"> <span id="email_label2"></span></td>
                                                   </tr>
                                                   <tr>
                                                       <th style="border:0px;">Address : </th>
                                                       <td style="border:0px;"> <span id="address_label2"></span></td>
                                                   </tr>
                                               </table>

                                           </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                            <!--coupon code area start-->
                            <div class="coupon_area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">


                                        <div class="coupon_code left">
                                            <h3><i class="ion-android-car"></i> Confirm Shipping</h3>
                                            <div class="coupon_inner">
                                                <p style="font-weight: bold">Where To Shipping <i class="ion-ios-help" style="font-size: 20px;font-weight: bold"></i></p>

                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <?php $i=1;?>
                                                        <select class="form-control" name="shipping_id" id="shipping_confirm" onchange="confirm_shipping(this.value)" style="width: 100%;font-weight: bold">
                                                            <option  value="" style="font-weight: bold">Select Location</option>
                                                            @foreach($shipping as $value)
                                                                <?php if($i<3){ ?>
                                                                <option  value="{{$value->id}}">{{$value->title}}  = {{$value->amount}}Tk</option>
                                                                <?php } $i++;?>
                                                            @endforeach


                                                        </select>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                        <br>
                                        <div class="coupon_code left">
                                            <a href="javascript:void(0)" data-toggle="collapse" data-target="#demo"><h3><i class="ion-android-alarm-clock"></i> Coupon <i class="ion-android-arrow-down pull-right"></i></h3></a>
                                            <div class="coupon_inner collapse"  id="demo">
                                                <p style="font-weight: bold">Have You Any Cupon Code <i class="ion-ios-help" style="font-size: 20px"></i></p>
                                                <input placeholder="Enter Coupon code" type="number" min="1" name="cupon_code" id="cupon_code" style="font-weight: bold;color:green;font-size: 20px">
                                                <button type="button" onclick="apply_cupon();">Apply coupon</button>


                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-md-6" style="max-width: 100%">
                                        <div class="coupon_code right">
                                            <h3>Cart Totals</h3>
                                            <div class="coupon_inner">
                                                <div class="cart_subtotal">
                                                    <?php




                                                    $cart_sub_total =\Cart::subtotal(2,'.','');
                                                    ?>

                                                    <p><i class="ion-android-alert"></i> Total</p>
                                                    <p class="cart_amount" ><span id="cart_total" style="margin-right: 0px"><?php echo number_format($cart_sub_total+$discount_total_amount); ?></span> Tk.</p>
                                                </div>

                                                <div class="cart_subtotal">

                                                    <p><i class="ion-android-alert"></i> Discount</p>

                                                    <p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360"></i> <span id="discount_total" style="margin-right: 0px"><?php echo number_format($discount_total_amount,2); ?></span> Tk.</p>
                                                </div>
                                                <div class="cart_subtotal">

                                                    <p><i class="ion-android-alert"></i> Subtotal</p>
                                                    <p class="cart_amount"><span id="sub_total_amount" style="margin-right: 0px"><?php echo Cart::subtotal(); ?></span> Tk.</p>
                                                </div>
                                                <input type="hidden" id="cupon_amount" placeholder="cupon amount">
                                                <div class="cart_subtotal" id="cupon_div" style="display: none">



                                                    <p><i class="ion-android-alert"></i> Cupon Discount</p>

                                                    <p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> <?php echo number_format(0,2); ?> Tk.</p>
                                                </div>
                                                <input type="hidden" id="shipping_amount" placeholder="shipping amount" value="no amount">
                                                <div class="cart_subtotal ">
                                                    <p><i class="ion-android-alert"></i>  Shipping Charge</p>

                                                    <p class="shipping_amount_label"><span style="font-weight: bold">&nbsp;&nbsp; <i class="ion-android-car" style="font-size: 22px"></i> No Destination Selected:</span> 00.00 Tk.</p>
                                                </div>


                                                <div class="cart_subtotal">
                                                    <p><i class="fa fa-money" style="color:#40A944;font-size: 20px"></i> Payable Amount</p>
                                                    <p class="cart_amount"><span id="total_amount_cart" style="margin-right: 0px"><?php echo \Cart::subtotal(2,'.','');?></span> Tk.</p>
                                                </div>
                                                <input type="hidden" id="total_amount" >
                                                <div class="checkout_btn">
                                                    <a data-toggle="tab" onclick="tab_menu_active('menu1')" class="btn btn-danger" style="font-family: Raleway;font-weight:bold;color:white"><i class="ion-android-arrow-dropright"></i> Prev</a>
                                                    <button type="submit" name="btn"   class="btn btn-success">Place Order</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--coupon code area end-->








            </div>




        </div>
    </div>
        <?php }else {
          ?>
        <div class="shopping_cart_area mt-70" style="margin-bottom: 100px">
            <div class="container">
                <div class="card">
                    <div class="card-body col-md-8 offset-2">
                        <h2 class="emty_card"><i class="ion-android-cart"></i> No Product Found in Cart</h2>
                        <a href="{{route('shop')}}" class="text-center" style="font-weight: bold;color: #0ba360">Shop Now!</a>

                    </div>
                </div>
            </div>
        </div>

        <?php }?>
    <!--shopping cart area end -->

@endsection
@section('style')
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
    <style>
    .fa{font-size:11px;}
     .fa-cart-arrow-down{font-size:inherit}
        .select_option {
            display: flex;
            align-items: center;
            width: 100%;
        }
        .nice-select.open .list {
            opacity: 1;
            pointer-events: auto;
            -webkit-transform: scale(1) translateY(0);
            transform: scale(1) translateY(0);
            width: 100%;

        }
        .nice-select .list  .option:hover{
            background: #40A944;
            color: #ffffff;
            font-weight: bold;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #ffffff;
            background-color: #40a944;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        input[type="number"] {
            -webkit-appearance: textfield;
            -moz-appearance: textfield;
            appearance: textfield;
        }
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;

        }

        .form_group label {
            font-size: 16px;
            display: block;
            line-height: 18px;
        }
        .bg-success {
            background-color: #40a944!important;
        }
        .nav-tabs {border:0px}
        .nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
            color: #555;
            cursor: default;
            /* background-color: #5cb85c; */
            border: 1px solid #fff;
            border-bottom-color: transparent;
        }
        .nav>li>a:focus, .nav>li>a:hover {
            text-decoration: none;
            background-color: #fff;
            color: #40a944;
            cursor: default;

        }
        .order_menu{
            font-size: 15px;
        }
    .qty_update{
        width: 50px;
        font-size: 16px;
    }
        #checkout_coupon input {
            background: none;
            border: 1px solid #ededed;
            width: 100%;
            height: 45px;
            font-size: 12px;
            padding: 0 20px;
            color: #222222;
        }
        .table_footer{text-align: right;padding: 20px}
        .qty_column{width: 50px}
        @media (max-width: 700px) {
            .table_desc{
                overflow: scroll
            }
            .order_menu{
                font-size: 14px;
            }
            .container{ max-width: 100%}
            .change_btn{padding: 0px}
            .qty_update{
                width: 30px;
                font-size: 13px;
            }
            .table_footer{font-size: 12px;padding: 0px}
            .table_desc .cart_page table thead tr th { font-size: 12px}
            .table_desc .cart_page table tbody tr td { font-size: 12px;padding: 4px}
            .table_desc .cart_page table tbody tr td .fa{font-size: 14px}
            .emty_card{font-size: 15px}
            .checkout_info table tbody tr td img{ margin-left: 10px}
            .pro_name_size{font-size: 12px}
            .checkout_info table tr th,td{border: 1px solid darkgray;padding: 5px}
        }
        .billing_msg{font-size: 13px}
        .form_group label{font-size: 14px !important;font-weight: bold}
        .form_group input{border:1px solid #40A944}
        .form_group textarea{border:1px solid #40A944;padding: 10px}



#show_cart_button{display: none}



    </style>

    <style>

        .form-control:focus {
            color: #495057;
            background-color: #fff;

            outline: 0;
            box-shadow: 0 0 0 1px #40a944;
        }
        table{width: 100%}



        .tab-content > .tab-pane {
            display: none;
        }

        .nav-tabs .nav-link {
            border: 1px solid #d1e0d1;
            margin-right: 1px;

        }

        .table_desc .cart_page table tbody tr td .product-price {
            min-width: 130px;
            color: #222222;
            font-size: 14px;
            font-weight: bold;
        }
        .table_desc .cart_page table tbody tr td .product-price del{
            font-weight: normal;
        }
        .table_desc .cart_page table tbody tr td code{
            font-size: 12px;

        }
        .checkout_info a {
            color: #40A944;
            margin-top: 15px;
            display: inline;
        }




        .user-actions #mobile_link{
            font-size: 18px;
            font-weight: bold;
            color: green !important;
            font-family: Raleway;
            position: relative;
            top: -50px;
            left: 20px;
            padding-bottom: 20px;
            margin-bottom: 32px;
        }



    </style>
@endsection

@section('script')

     <script>

        $(document).ready(function(){
            $("#submitBtn").click(function(){
                var customer_password = $('#customer_password').val();
                var customer_email = $('#customer_email').val();


                var csrf = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('customer-login-email') }}",
                    type: 'POST',
                    data: {
                        customer_password : customer_password,
                        customer_email : customer_email,
                        '_token': csrf
                    },
                    dataType: 'json',

                    success: function(result) {

                        if(result.status==true){
                            location.reload();
                        }
                        else{
                            swal("Cancelled", "Invalid Email or phone and password", "error");
                            //customer_email

                            $('#customer_email').css('border', 'solid 3px #40a944');
                            $('#customer_password').css('border', 'solid 3px #40a944');
                            $('#customer_email').val();
                            $('#customer_password').val();
                        }


                    }
                })




            });
        });




    </script>
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <script>
        function validate_form() {
            var shipping_id = $("#shipping_confirm").val();
            var shipping_amount = $("#shipping_amount").val();

            if(shipping_id=='' || shipping_amount=='no amount')
            {

                swal({
                    title: "confirm Shipping?",
                    text: "Confirm shipping then Place Order!",
                    type: "warning",
                    showCancelButton: true,

                    closeOnConfirm: true,
                    closeOnCancel: true
                });

                return false;
            }
            else{
                return true;
            }

        }
        function tab_menu_active(tab){

            $('.nav-tabs a[href="#'+tab+'"]').tab('show');



        }
        function tab_menu_active_menu2(tab) {
            var name = $('#name').val();
            var email = $('#email').val();
            var mobile = $('#mobile').val();
            var address = $('#address').val();

            var name2 = $('#name2').val();
            var email2 = $('#email2').val();
            var mobile2 = $('#mobile2').val();
            var address2 = $('#address2').val();

            var error = 0;
            if(name=='')
            {
                $('#name').css('border', 'solid 3px #40a944');
            }else{
                $('#name').css('border', 'solid 1px green');
            }
            if(mobile=='')
            {
                $('#mobile').css('border', 'solid 3px #40a944');
            }

            else{
                var pattern = /(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/;
                if (pattern.test(mobile)) {
                    $('#mobile').css('border', 'solid 1px green');
                }
                else{
                    $('#mobile').css('border', 'solid 3px #40a944');
                }

            }
            if(email=='')
            {
                $('#email').css('border', 'solid 3px #8CBD8B');
            }else{

                var pattern = /\S+@\S+\.\S+/;

                if (pattern.test(email)) {
                    $('#email').css('border', 'solid 1px green');
                }
                else{
                    $('#email').css('border', 'solid 3px #8CBD8B');
                }


            }
            if(address=='')
            {
                $('#address').css('border', 'solid 3px #40a944');
            }else{
                $('#address').css('border', 'solid 1px green');
            }

            if($('#shipping_as_gift').is(":checked"))
            {
                if(name2=='')
                {
                    error = 1;
                    $('#name2').css('border', 'solid 3px #40a944');
                }else{
                    error = 0;
                    $('#name2').css('border', 'solid 1px green');
                }
                if(mobile2=='')
                {
                    error = 1;
                    $('#mobile2').css('border', 'solid 3px #40a944');
                }else{
                    error = 0;
                    var pattern = /(^(\+8801|8801|01|008801))[1|5-9]{1}(\d){8}$/;
                    if (pattern.test(mobile2)) {
                        $('#mobile2').css('border', 'solid 1px green');
                    }
                    else{
                        $('#mobile2').css('border', 'solid 3px #40a944');
                    }

                }
                if(email2=='')
                {
                    error = 0;
                    $('#email2').css('border', 'solid 3px #8CBD8B');
                }else{
                    error = 0;

                    var pattern = /\S+@\S+\.\S+/;

                    if (pattern.test(email2)) {
                        $('#email2').css('border', 'solid 1px green');
                    }
                    else{
                        $('#email2').css('border', 'solid 3px #40a944');
                    }
                }
                if(address2=='')
                {
                    error = 1;
                    $('#address2').css('border', 'solid 3px #40a944');
                }else{
                    error = 0;
                    $('#address2').css('border', 'solid 1px green');
                }

                document.getElementById("shipping_data").style.display = "block";

            }
            else{
                error = 0;
                document.getElementById("shipping_data").style.display = "none";
            }

            if(name=="" || mobile==""||address=="")
            {

                error = 1;
            }
            if(error ==1)
            {

                return;

            }else{
                $('.nav-tabs a[href="#menu2"]').tab('show');
            }

            $('#name_label').html(name);
            $('#email_label').html(email);
            $('#mobile_label').html(mobile);
            $('#address_label').html(address);

            $('#name_label2').html(name2);
            $('#email_label2').html(email2);
            $('#mobile_label2').html(mobile2);
            $('#address_label2').html(address2);





        }
    </script>
    <script type="text/javascript">


        function valueChanged()
        {
            if($('#shipping_as_gift').is(":checked"))
                $("#shipping_div").show();
            else
                $("#shipping_div").hide();
        }
        function apply_cupon() {
            var cupon_code = $("#cupon_code").val();

            var shipping_id = $("#shipping_confirm").val();
            var shipping_amount = $("#shipping_amount").val();

            if(shipping_id=='' || shipping_amount=='no amount')
            {

                swal({
                    title: "confirm Shipping?",
                    text: "Confirm shipping then apply cupon",
                    type: "warning",
                    showCancelButton: true,

                    closeOnConfirm: true,
                    closeOnCancel: true
                });

                return;
            }


            if(cupon_code){
                document.getElementById("cupon_div").style.display = "flex";
            }
            else{
                document.getElementById("cupon_div").style.display = "none";
            }


            $.ajax({
                url: "{{ route('confirm-cupon-amount') }}",
                method: 'get',
                data: {
                    'cupon_code':cupon_code,
                    'shipping_id':shipping_id,


                },
                success: function(result){

                    $('#cupon_div').html(result.content);
                    $('#total_amount_cart').html(result.total_amount);
                    $('#total_amount').val(result.total_amount_int);
                    $('#cupon_amount').val(result.cupon_amount);

                    $('.shipping_amount_label').html(result.shipping_content);




                }});




        }
        function confirm_shipping(shipping_id) {
            var cupon_code = $("#cupon_code").val();
            var cuppon_amount = $("#cuppon_amount").val();

            if(cuppon_amount){
                document.getElementById("cupon_div").style.display = "flex";
            }



            $.ajax({
                url: "{{ route('confirm-shipping-amount') }}",
                method: 'get',
                data: {
                    'shipping_id':shipping_id,
                    'cupon_code':cupon_code,


                },
                success: function(result){



                    $('.shipping_amount_label').html(result.content);
                    $('#total_amount_cart').html(result.total_amount);
                    $('#total_amount').val(result.total_amount_int);
                    $('#shipping_amount').val(result.shipping_amount);
                    $('#cupon_div').val(result.cupon_label);





                }});
        }
        {{--function add_to_cart(product_id) {--}}

        {{--    $.ajax({--}}
        {{--        url: "{{ route('add-to-cart') }}",--}}
        {{--        method: 'get',--}}
        {{--        data: {--}}
        {{--            'product_id':product_id--}}

        {{--        },--}}
        {{--        success: function(result){--}}


        {{--            $('#cart_view').html(result.content);--}}


        {{--        }});--}}

        {{--}--}}
        {{--function delete_product(pro_id) {--}}


        {{--    $.ajax({--}}
        {{--        url: "{{ route('delete-to-cart') }}",--}}
        {{--        method: 'get',--}}
        {{--        data: {--}}
        {{--            'pro_id':pro_id--}}

        {{--        },--}}
        {{--        success: function(result){--}}


        {{--            $('#cart_view').html(result.content);--}}
        {{--            $('#cart_table').html(result.cart_table);--}}
        {{--            $('#cart_table_final').html(result.cart_table_final);--}}


        {{--        }});--}}
        {{--}--}}

        function delete_confirm(pro_id) {
            var cupon_code = $("#cupon_code").val();


            var shipping_id = $("#shipping_confirm").val();

            swal({
                    title: "Are you sure?",
                    text: "You Want to Delete this item form Cart!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: "{{ route('delete-cart-item') }}",
                            method: 'get',
                            data: {
                                'pro_id':pro_id,
                                'shipping_id':shipping_id,
                                'cupon_code':cupon_code

                            },
                            error: function() {
                                alert('Something is wrong');
                            },
                            success: function(result) {


                                swal("Deleted!", "Your Cart Item has been deleted.", "success");
                                $('#cart_view').html(result.cart_view);
                                $('.shipping_amount_label').html(result.content);
                                $('#total_amount_cart').html(result.total_amount);
                                $('#cart_table').html(result.cart_table);
                                $('#total_amount').val(result.total_amount_int);
                                $('#shipping_amount').val(result.shipping_amount);
                                $('#cupon_div').val(result.cupon_label);

                                $('#cart_total').html(result.cart_total);
                                $('#discount_total').html(result.discount_total);
                                $('#sub_total_amount').html(result.sub_total_amount);
                                $('#cart_grand_total1').html(result.sub_total_amount);
                                $('#cart_grand_total2').html(result.sub_total_amount);
                                $('#cart_table_final').html(result.cart_table_final);

                            }
                        });
                    } else {
                        swal("Cancelled", "Your Cart item is safe", "error");
                    }
                });
        }
        function update_cart(pro_id) {
            var qty = $('#pro_'+pro_id).val();

            var cupon_code = $("#cupon_code").val();

            var shipping_id = $("#shipping_confirm").val();


            var cuppon_amount = $("#cuppon_amount").val();

            if(cuppon_amount){
                document.getElementById("cupon_div").style.display = "flex";
            }

            $('#total_amount_cart').html('');


            $.ajax({
                url: "{{ route('update-cart') }}",
                method: 'get',
                data: {
                    'shipping_id':shipping_id,
                    'cuppon_amount':cuppon_amount,
                    'pro_id':pro_id,
                    'qty':qty,
                    'cupon_code':cupon_code,


                },
                success: function(result){



                    $('.shipping_amount_label').html(result.content);
                    $('#total_amount_cart').html(result.total_amount);
                    $('#cart_total').html(result.cart_total);
                    $('#discount_total').html(result.discount_total);
                    $('#sub_total_amount').html(result.sub_total_amount);
                    $('#cart_table').html(result.cart_table);
                    $('#total_amount').val(result.total_amount_int);
                    $('#shipping_amount').val(result.shipping_amount);
                    $('#cupon_div').val(result.cupon_label);
                    $('#cart_grand_total1').html(result.sub_total_amount);
                    $('#cart_grand_total2').html(result.sub_total_amount);
                    $('#cart_view').html(result.cart_view);
                    $('#cart_table_final').html(result.cart_table_final);

                    //document.getElementById("proceed_button").disabled = false;



                }});


        }

        function delete_cart(pro_id) {
            var qty = $('#pro_'+pro_id).val();
            var cupon_code = $("#cupon_code").val();
            if(qty==1)
            {


                delete_confirm(pro_id);
                return;
            }

            var shipping_id = $("#shipping_confirm").val();


            var cuppon_amount = $("#cuppon_amount").val();

            if(cuppon_amount){
                document.getElementById("cupon_div").style.display = "flex";
            }

            $('#total_amount_cart').html('');


            $.ajax({
                url: "{{ route('delete-cart') }}",
                method: 'get',
                data: {
                    'shipping_id':shipping_id,
                    'cuppon_amount':cuppon_amount,
                    'pro_id':pro_id,
                    'qty':qty,
                    'cupon_code':cupon_code,


                },
                success: function(result){



                    $('.shipping_amount_label').html(result.content);
                    $('#total_amount_cart').html(result.total_amount);
                    $('#cart_table').html(result.cart_table);
                    $('#total_amount').val(result.total_amount_int);
                    $('#shipping_amount').val(result.shipping_amount);
                    $('#cupon_div').val(result.cupon_label);

                    $('#cart_total').html(result.cart_total);
                    $('#discount_total').html(result.discount_total);
                    $('#sub_total_amount').html(result.sub_total_amount);
                    $('#cart_grand_total1').html(result.sub_total_amount);
                    $('#cart_grand_total2').html(result.sub_total_amount);
                    $('#cart_view').html(result.cart_view);

                    $('#cart_table_final').html(result.cart_table_final);

                   // document.getElementById("proceed_button").disabled = false;


                }});
        }

    </script>


@endsection
