@extends('Frontend.layout')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3><i class="ion-clipboard"></i> INVOICE</h3>
                        <ul>
                            <li><a href="{{route('home')}}">home</a></li>
                            <li>INVOICE
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->


    <!--shopping cart area start -->
    <div class="shopping_cart_area mt-70">
        <div class="container mt-3">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card invoice_table">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" style="width: 120px">
                                </div>
                                <div class="col-md-6 pt-4">
                                    <h3 class="text-center font-weight-bold mb-1">{{$company->name}}</h3>
                                    <p class="text-center font-weight-normal mb-0">({{$company->title}})</p>

                                    <p class="text-center font-weight-bold"><small class="font-weight-bold">Phone : {{$company->mobile}}</small><br>
                                    <small  class="font-weight-bold">Email : {{$company->email}}</small>
                                    </p>

                                </div>

                            </div>
                            <br>
                           <div class="row pb-2 p-2">
                                <div class="col-md-6 invoice_text_right1">
                                    <p><strong>Customer name</strong>: {{$order->blling->name}}<br>
                                    <strong>Customer phone</strong>: {{$order->blling->mobile}}<br>
                                    <strong>Customer email</strong>: {{$order->blling->email}}</p>
                                </div>

                                <div class="col-md-6 invoice_text_right">
                                    <p class="mb-0"><strong>Invoice No</strong>: BS{{$order->invoice_no}}</p>
                                    <p><strong>Order Date</strong>: {{date('d M,Y',strtotime($order->order_date))}}
                                    <br>
                                        <strong>Order Status</strong>:
                                        @if($order->order_status==1)
                                          pending
                                      @elseif($order->order_status==2)
                                          Processing
                                        @elseif($order->order_status==3)
                                            Delivery processing
                                        @endif

                                        <br>
                                        <strong> Payment Type</strong>: {{$order->payment_type->name}}
                                    </p>

                                </div>
                            </div>
                            <div class="row pb-2 p-2">

                                    <div class="col-lg-5  col-md-5">
                                        <div class="contact_message content">
                                            <h4><i class="fa fa-money"></i> Billing To</h4>
                                            <ul>
                                                <li><i class="fa fa-user"></i>  {{$order->blling->name}}</li>
                                                <li><i class="ion-email"></i> <a href="#">{{$order->blling->email}}</a></li>
                                                <li><i class="fa fa-phone"></i><a href="">{{$order->blling->mobile}}</a>  </li>
                                                <li><i class="fa fa-home"></i><a href="">{{$order->blling->address}}</a>  </li>
                                            </ul>
                                            <br>
                                        </div>
                                    </div>

                                    <div class="col-md-4 offset-3">
                                        @if(!empty($order->other_shipping))
                                            <div class="contact_message content">
                                                <h4><i class="ion-android-car"></i> Shipping To</h4>
                                                <ul>
                                                    <li ><i class="fa fa-user"></i>  {{$order->other_shipping->name}}</li>
                                                    <li><i class="ion-email"></i> <a href="#">{{$order->other_shipping->email}}</a></li>
                                                    <li><i class="fa fa-phone"></i><a href="">{{$order->other_shipping->mobile}}</a>  </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </div>


                            </div>
                            <div class="col-md-12" style="padding: 0px">
                                <table width="100%" border="1" style="text-align: center">
                                    <thead>
                                    <tr>

                                        <th>Product</th>
                                        <th>Unit Price</th>
                                        <th>Discount Price	</th>
                                        <th>Qty</th>
                                        <th>Amount</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->order_details as $detail)
                                        <?php
                                         $product = \App\Product::find($detail->product_id);
                                         $unit = \App\Unit::find($detail->unit_id);

                                        ?>
                                    <tr>


                                        <td>{{$product->name}}-{{$detail->weight}}{{$unit->name}}</td>
                                        <td>{{$detail->sales_rate+$detail->discount_amount}} Tk</td>
                                        <td>{{$detail->discount_amount}} Tk</td>
                                        <td>{{$detail->qty}}</td>
                                        <td>{{$detail->sales_rate*$detail->qty}} Tk</td>

                                    </tr>
                                        @endforeach


                                    </tbody>
                                    <tfoot>

                                    <tr>
                                        <td colspan="8">
                                            <span class="float-right">Total Amount : <?php echo number_format($order->total_amount+$order->total_discount_product);?> Tk.</span><br>
                                            @if(!empty($order->total_discount_product))
                                            <span class="float-right">Total Discount : -<?php echo number_format($order->total_discount_product);?> Tk.</span><br>
                                             @endif
                                                <span class="float-right">Subtotal : <?php echo number_format($order->total_amount);?> Tk.</span><br>
                                             @if(!empty($order->cupon_amount))
                                            <span class="float-right">Get Cupon Discount : -<?php echo number_format($order->cupon_amount);?> Tk.</span><br>
                                             @endif
                                                <span class="float-right">Shipping Charge : +<?php echo number_format($order->shipping_amount);?> Tk.</span><br>
                                            <span class="float-right" style="margin-right: 70px;font-weight: 500;color: gray">({{$order->shipping_title}})</span><br>

                                        </td>

                                    </tr>
                                    <tr>
                                        <td colspan="8"><span  class="float-right">Payable Amount: <?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);?> Tk.</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div><!--table responsive end-->

                            <p class="mt-5">Thank you for choosing our service.We look forward to meet you again.</p>
                            <p>Money once paid will not we refunded. However, it can be abjected towards any services.</p>
                            <hr>
                            <p class="mt-2 text-center" id="company_profile">{{$company->name}} <i class="ion-email"></i> {{$company->email}} <i class="ion-ios-telephone"></i> {{$company->mobile}} </p>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center" style="height: 100px">

            </div>

        </div>
    </div>
        <!--shopping cart area end -->

        @endsection
        @section('style')
            <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
            <style>
                .table td, .table th {
                    padding: 0.5rem;
                    vertical-align: top;
                    border-top: 1px solid #dee2e6;
                    font-size: 14px;
                }
                .invoice_table{margin: 0px 15%;width: 70%}
                .invoice_text_right{text-align: right}
                @media (max-width: 700px) {
                    .invoice_text_right{text-align: left !important;}
                    .invoice_text_right1{text-align: left !important;}
                    h3,p{text-align: left}
                    .invoice_table{margin:0px;width: 100%}
                    #company_profile{font-size: 10px !important;}
                }
            </style>
        @endsection

 @section('script')

@endsection
