@extends('backend.admin.admin-layout')

@section('content')


<div class="layout-px-spacing">
    <div class="row invoice layout-top-spacing">

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="app-hamburger-container">
                <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
            </div>
            <div class="doc-container">
                <div class="invoice-00001" style="padding-bottom: 100px">
                    <div class="content-section  animated animatedFadeInUp fadeInUp" style="height:100% !important">

                        <div class="row inv--head-section">

                            <div class="col-sm-6 col-12">
                                <h3 class="in-heading">INVOICE</h3>
                            </div>
                            <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                <div class="company-info">
                                    <img src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" width="150px">

                                </div>
                            </div>

                        </div>

                        <div class="row inv--detail-section">

                            <div class="col-sm-7 align-self-center">
                                <p class="inv-to">Invoice To</p>
                            </div>
                            <div class="col-sm-5 align-self-center  text-sm-right order-sm-0 order-1">
                                <p class="inv-detail-title">From : {{$company->name}}</p>
                            </div>

                            <div class="col-sm-7 align-self-center">
                                <p class="inv-customer-name">{{isset($order->other_shipping->name)?$order->other_shipping->name:$order->blling->name}}</p>
                                <p class="inv-street-addr">{{isset($order->other_shipping->address)?$order->other_shipping->address:$order->blling->address}}</p>
                                <p class="inv-email-address">{{isset($order->other_shipping->email)?$order->other_shipping->email:$order->blling->email}}<br>{{isset($order->other_shipping->mobile)?$order->other_shipping->mobile:$order->blling->mobile}}</p>
                            </div>
                            <div class="col-sm-5 align-self-center  text-sm-right order-2">
                                <p class="inv-list-number"><span class="inv-title">Invoice Number : </span> <span class="inv-number">BS{{$order->invoice_no}}</span></p>
                                <p class="inv-created-date"><span class="inv-title">Order Date : </span> <span class="inv-date">{{date("d M,Y",strtotime($order->order_date))}}</span></p>
                                <p class="inv-due-date"><span class="inv-title">Order Type : </span> <span class="inv-date">{{$order->order_type==1?'One Time Order':'Registered Order'}}</span></p>
                                <p class="inv-due-date"><span class="inv-title">Order Status : </span> <span class="inv-date" style="color:green">
                                        @if($order->order_status==1)
                                            Pending
                                        @elseif($order->order_status==2)
                                           Confirm
                                        @elseif($order->order_status==3)
                                            Delivered

                                        @elseif($order->order_status==4)
                                                Canceled
                                            @endif

                                    </span></p>
                                @if($order->order_status==3)
                                <p class="inv-created-date"><span class="inv-title">Delivery Date : </span> <span class="inv-date">{{date("d M,Y",strtotime($order->delivery_date))}}</span></p>
                                @endif
                                @if($order->order_status==4)
                                    <p class="inv-created-date"><span class="inv-title">Cancel Date : </span> <span class="inv-date">{{date("d M,Y",strtotime($order->delivery_date))}}</span></p>
                                @endif
                            </div>
                        </div>

                        <div class="row inv--product-table-section">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-4">
                                        <thead class="">
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">Items</th>

                                            <th class="text-center" scope="col">Unit Price</th>
                                            <th class="text-center" scope="col">Discount</th>
                                            <th class="text-center" scope="col">Qty</th>
                                            <th class="text-center" scope="col">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sl=1;
                                        ?>
                                        @foreach($order->order_details as $detail)
                                            <?php
                                            $product = \App\Product::find($detail->product_id);
                                            $unit = \App\Unit::find($detail->unit_id);

                                            ?>
                                            <tr>
                                                <td>{{$sl++}}</td>
                                                <td>{{$product->name}}-{{$detail->weight}}{{$unit->name}}</td>

                                                <td class="text-center">৳ {{$detail->sales_rate+$detail->discount_amount}}</td>
                                                <td class="text-center"> ৳{{$detail->discount_amount}}</td>
                                                <td class="text-center">{{$detail->qty}}</td>
                                                <td class="text-center">৳ {{$detail->sales_rate*$detail->qty}}</td>
                                            </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-5 col-12 order-sm-0 order-1">
                                <div class="inv--payment-info">
                                    <div class="row">
                                        <div class="col-sm-12 col-12">
                                            <h6 class=" inv-title">Payment & Shipping Info:</h6>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <p class=" inv-subtitle">Payment: </p>
                                        </div>
                                        <div class="col-sm-8 col-12">
                                            <p class="">{{$order->payment_type->name}}</p>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <p class=" inv-subtitle">Courier : </p>
                                        </div>
                                        <div class="col-sm-8 col-12">
                                            <p class="">{{isset($order->courier->name)?$order->courier->name:'No Courer Confirm'}} </p>
                                        </div>
                                        <div class="col-sm-4 col-12">
                                            <p class=" inv-subtitle">Shipping Area: </p>
                                        </div>
                                        <div class="col-sm-8 col-12">
                                            <p class="">{{$order->shipping_title}} </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-7 col-12 order-sm-1 order-0">
                                <div class="inv--total-amounts text-sm-right">
                                    <div class="row">
                                        <div class="col-sm-8 col-7">
                                            <p class=""> Total: </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳ <?php echo number_format($order->total_amount+$order->total_discount_product);?> </p>
                                        </div>
                                        <div class="col-sm-8 col-7">
                                            <p class="">Discount: </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳ <?php echo number_format($order->total_discount_product);?></p>
                                        </div>
                                        <div class="col-sm-8 col-7">
                                            <p class=" discount-rate">Subtotal : </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳  <?php echo number_format($order->total_amount);?></p>
                                        </div>
                                        @if(!empty($order->cupon_amount))
                                        <div class="col-sm-8 col-7 grand-total-title">
                                            <p class="">Cupon Discount : </p>
                                        </div>
                                        <div class="col-sm-4 col-5 grand-total-amount">
                                            <p class="">৳ <?php echo number_format($order->cupon_amount);?></p>
                                        </div>
                                        @endif
                                        <div class="col-sm-8 col-7">
                                            <p class=" discount-rate">Shipping Charge  : </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳  <?php echo number_format($order->shipping_amount);?></p>
                                        </div>
                                        <div class="col-sm-8 col-7">
                                            <p class=" discount-rate">Payable Amount  : </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳  <?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);?></p>
                                        </div>
                                        <div class="col-sm-8 col-7">
                                            <p class=" discount-rate">Paid Amount   : </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳  <?php echo number_format($order->total_paid_amount);?></p>
                                        </div>
                                        <div class="col-sm-8 col-7">
                                            <p class=" discount-rate">Due Amount  : </p>
                                        </div>
                                        <div class="col-sm-4 col-5">
                                            <p class="">৳  <?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount-$order->total_paid_amount);?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">

                        <p class="mt-2 col-6 offset-3" style="text-align: center">{{$company->name}} <i class="ion-email"></i> {{$company->email}}  <i class="ion-ios-telephone"></i> {{$company->mobile}} </p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
@section('style')
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="{{ asset('backend/assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />

<!-- END PAGE LEVEL STYLES -->
<style>
    .form-group label, label {
        font-size: 15px;
        color: #64646f;
        letter-spacing: 1px;
    }

    .invoice .content-section {
        height: 950px;
    }

</style>

@endsection
@section('script')

<script src="{{ asset('backend/assets/js/apps/invoice.js')}}"></script>





@endsection