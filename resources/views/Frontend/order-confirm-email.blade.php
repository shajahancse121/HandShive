<!DOCTYPE html>
<html lang="en">
<head>
    <title>BS{{$order->invoice_no}}-invoice printing </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('backend/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" id="bootstrap-css">
    <script src="{{ asset('backend/bootstrap/js/bootstrap.min.js')}}"></script>

    <style>
        .invoice-title h2, .invoice-title h3 {
            display: inline-block;
        }

        .table > tbody > tr > .no-line {
            border-top: none;
        }

        .table > thead > tr > .no-line {
            border-bottom: none;
        }

        .table > tbody > tr > .thick-line {
            border-top: 2px solid;
        }
    </style>

</head>
<body>
<?php
$company = \App\CompanyProfile::find(1);
?>

<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h3 class="pull-left"><img src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" width="150px"></h3>
                <br>
                <h3 class="text-left"><strong>Hello, {{$order->blling->name}} </strong></h3>
                <h4 class="text-left"><strong>Your Order#BS{{$order->invoice_no}} is Confirmed. </strong></h4>

            </div>
            <br>
            <br>


        </div>
    </div>

    <div class="row">
        <div class="table-responsive">
            <table class="table table-condensed" style="margin-bottom:0px;">

                <tr>
                    <th scope="col" colspan="6" class="text-left"> <h3 class="text-left"><strong>Order summary</strong></h3>

                        <table style="width: 100% !important;" border="0">
                            <tr>
                                <td  style="text-align: left">
                                    <address style="font-weight: normal">
                                        <strong>Billing To:</strong><br>
                                        <strong>{{$order->blling->name}}</strong><br>
                                        {{$order->blling->address}}<br>
                                        {{$order->blling->email}}<br>
                                        {{$order->blling->mobile}}<br>
                                    </address>
                                </td>
                                <td style="text-align: right">
                                    <address style="font-weight: normal">
                                        <strong>Shipping To:</strong><br>
                                        <strong>{{isset($order->other_shipping->name)?$order->other_shipping->name:$order->blling->name}}</strong><br>
                                        {{isset($order->other_shipping->address)?$order->other_shipping->address:$order->blling->address}}<br>
                                        {{isset($order->other_shipping->email)?$order->other_shipping->email:$order->blling->email}}<br>
                                        {{isset($order->other_shipping->mobile)?$order->other_shipping->mobile:$order->blling->mobile}}<br>
                                    </address>
                                </td>
                            </tr>
                        </table>
                    </th>

                </tr>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Items</th>

                    <th class="text-center" scope="col">Unit Price</th>
                    <th class="text-center" scope="col">Discount</th>
                    <th class="text-center" scope="col">Qty</th>
                    <th class="text-center" scope="col">Amount</th>
                </tr>


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
                        <td class="text-center">@if(!empty($detail->discount_amount))
                                ৳
                            @endif
                            {{($detail->discount_amount)?$detail->discount_amount:''}}</td>
                        <td class="text-center">{{$detail->qty}}</td>
                        <td class="text-center">৳ {{$detail->sales_rate*$detail->qty}}</td>
                    </tr>
                @endforeach


            </table>

        </div>
    </div>

    <br>

    <div class="row">
        <table style="width: 100%" border="0">
            <tr>
                <td style="text-align: left">
                    <address>
                        <strong>Payment & Shipping Info:</strong><br>
                        <strong>Payment : </strong>{{$order->payment_type->name}}<br>
                        <strong>Courier : </strong>{{isset($order->courier->name)?$order->courier->name:'No Courer Confirm'}}<br>
                        <strong>Shipping Area : </strong>{{$order->shipping_title}}<br>

                    </address>
                </td>
                <td style="text-align: right">
                    <address>
                        <strong>Total : </strong>৳ <?php echo number_format($order->total_amount+$order->total_discount_product);?><br>
                        @if(!empty($order->total_discount_product))
                            <strong>Discount : </strong>৳ <?php echo number_format($order->total_discount_product);?><br>
                        @endif
                        <strong>Subtotal : </strong>৳  <?php echo number_format($order->total_amount);?><br>
                        @if(!empty($order->cupon_amount))
                            <strong>Cupon Discount : </strong>৳ <?php echo number_format($order->cupon_amount);?><br>
                        @endif
                        <strong>Shipping Charge : </strong>৳  <?php echo number_format($order->shipping_amount);?><br>
                        <strong>Payable Amount : </strong>৳  <?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);?><br>
                        @if(!empty($order->total_paid_amount))
                            <strong>Paid Amount : </strong>৳  <?php echo number_format($order->total_paid_amount);?><br>
                        @endif
                        @if(!empty($order->total_paid_amount))
                            <strong>Due Amount : </strong>৳  <?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount-$order->total_paid_amount);?><br>
                        @endif

                    </address>
                </td>
            </tr>

       </table>




    </div>
    <br>
    <br>
    <hr style="border-top: 2px double #bbb5b5">
    <div class="row mt-4">

        <p class="mt-2 col-6 offset-3" style="text-align: center"><strong>{{$company->name}} : </strong><i class="ion-email"></i> {{$company->email}}  <i class="ion-ios-telephone"></i> {{$company->mobile}} </p>
    </div>
</div>


</body>
</html>
