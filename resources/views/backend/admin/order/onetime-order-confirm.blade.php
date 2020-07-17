@extends('backend.admin.admin-layout')

@section('content')

    @if(session('success'))
        <div class="alert alert-primary mb-4" role="alert" id="alert" style="margin-top: 20px">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
            {{session('success')}}.
        </div>
    @endif
    <div class="layout-px-spacing">

        <div class="row invoice layout-top-spacing">

            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="app-hamburger-container">
                    <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                </div>
                <div class="doc-container">
                    <div class="invoice-00001" style="padding-bottom: 100px">
                        <div class="content-section  animated animatedFadeInUp fadeInUp">

                            <div class="row inv--head-section">

                                <div class="col-sm-6 col-12">
                                    <h3 class="in-heading"><i class="ion-ios-cart" style="font-size: 30px"></i> Confirm Order</h3>
                                </div>
                                <div class="col-sm-6 col-12 align-self-center text-sm-right">
                                    <div class="company-info">

                                        <h5 class="inv-brand-name" style="text-transform: uppercase;padding-left: 10px"><i class="ion-ios-pricetag-outline"></i> ID#BS{{$order->invoice_no}}</h5>
                                    </div>
                                </div>

                            </div>

                            <div class="row inv--detail-section">

                                <div class="col-sm-4 align-self-center">
                                    <p class="inv-to" style=""><i class="ion-cash" style="font-size: 20px"></i> Billing Address</p>

                                </div>
                                <div class="col-sm-4 align-self-center  text-sm-left order-sm-0 order-1">
                                    <p class="inv-detail-title"><i class="ion-android-car" style="font-size: 20px"></i> Shipping Address</p>
                                </div>
                                <div class="col-sm-4 align-self-center  text-sm-right order-sm-0 order-1">
                                    <p class="inv-detail-title"><i class="ion-ios-cart" style="font-size: 20px"></i> Order Info</p>
                                </div>

                                <div class="col-sm-4 align-self-center">
                                    <p class="inv-customer-name" style="font-size: 16px"><b><i class="ion-ios-contact-outline"></i></b> {{$order->blling->name}}</p>
                                    <p class="inv-street-addr"  style="font-size: 16px"><b><i class="ion-ios-home"></i></b> {{$order->blling->address}}</p>
                                    <p class="inv-email-address"  style="font-size: 16px"><b><i class="ion-email"></i></b>  {{$order->blling->email}}<br><b><i class="ion-ios-telephone"></i> </b>{{$order->blling->mobile}}</p>
                                </div>
                                <div class="col-sm-4 align-self-center">
                                    <p class="inv-customer-name" style="font-size: 16px"><b><i class="ion-ios-contact-outline"></i></b> {{isset($order->other_shipping->name)?$order->other_shipping->name:$order->blling->name}}</p>
                                    <p class="inv-street-addr" style="font-size: 16px"><b><i class="ion-ios-home"></i></b> {{isset($order->other_shipping->address)?$order->other_shipping->address:$order->blling->address}}</p>
                                    <p class="inv-email-address" style="font-size: 16px"><b><i class="ion-email"></i></b> {{isset($order->other_shipping->email)?$order->other_shipping->email:$order->blling->email}}<br><b><i class="ion-ios-telephone"></i> </b>{{isset($order->other_shipping->mobile)?$order->other_shipping->mobile:$order->blling->mobile}}</p>
                                </div>
                                <div class="col-sm-4 align-self-center  text-sm-right order-2">
                                    <p class="inv-list-number"><span class="inv-title">Invoice Number : </span> <span class="inv-number">[BS{{$order->invoice_no}}]</span></p>
                                    <p class="inv-created-date"><span class="inv-title">Order Date : </span> <span class="inv-date">{{date("d M,Y",strtotime($order->order_date))}}</span></p>
                                    <p class="inv-due-date"><span class="inv-title">Order Type : </span> <span class="inv-date">{{$order->order_type==1?'One Time Order':'Registered Order'}}</span></p>
                                    <p class="inv-created-date"><span class="inv-title">Order Status : </span> <span class="inv-date" style="color:green">
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

                                </div>
                            </div>

                            <div class="row inv--product-table-section">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-4">
                                            <thead class="">
                                            <tr>
                                                <th scope="col">SL</th>
                                                <th scope="col">Items</th>

                                                <th class="text-center" scope="col" width="130px">Sale Rate</th>
                                                <th class="text-center" scope="col" width="130px">Discount</th>
                                                <th class="text-center" scope="col" width="200px">Qty</th>
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
                                                $product_image = \App\ProductImage::where('product_id',$detail->product_id)->first();

                                                ?>
                                        <form action="{{route('onetime-order-confirm-update',['order_id'=>$order->id,'detail_id'=>$detail->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                            <tr>
                                                <td>{{$sl++}}</td>
                                                <td><img src="{{asset($product_image->name)}}" width="50px"> <span style="margin-left: 20px">{{$product->name}}</span>-<span style="font-weight: bold;color: blue">{{$detail->weight}}{{$unit->name}}</span></td>

                                                <td class="text-center">
                                                    <input type="number" name="rate_<?php echo $detail->id;?>" class="form-control" value="{{$detail->sales_rate+$detail->discount_amount}}">

                                                    </td>
                                                <td class="text-center">

                                                    <input class="form-control" type="number" name="discount_<?php echo $detail->id;?>" value="{{$detail->discount_amount}}" min="0" style="font-weight: bold">

                                                </td>
                                                <td class="text-center">

                                                    <div class="btn-group btn-group-sm">
                                                        <input class="form-control" type="number" name="qty_<?php echo $detail->id;?>" value="{{$detail->qty}}" min="1" style="font-weight: bold">
                                                        <button type="submit" name="action_btn" value="update" class="btn btn-primary"><i class="ion-android-checkmark-circle" style="font-size: 20px"></i></button>
                                                        <button type="submit" name="action_btn" value="delete" class="btn btn-danger"><i class="ion-android-delete" style="font-size: 20px"></i></button>

                                                    </div>
                                                    </form>

                                                </td>
                                                <td class="text-center">{{$detail->sales_rate*$detail->qty}}</td>
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
                                                <h6 class=" inv-title"><i class="ion-checkmark-circled"></i> Product & Billing Update :<br><br>
                                                    <span class="pull-right" style="font-size: 15px;color: #0e1726">&nbsp;&nbsp;&nbsp; <a href="javascript:void(0)"  data-toggle="modal" data-target="#add_item" onclick="payment_confirm({{$order->id}})" class="pull-right"><span class="badge badge-primary "><i class="ion-ios-plus-outline" style="font-size: 16px"></i> ADD ITEM</span></a></span>
                                                    <span class="pull-right" style="font-size: 15px;color: #0e1726">&nbsp;&nbsp;&nbsp; <a href="javascript:void(0)"  data-toggle="modal" data-target="#update_billing" onclick="payment_confirm({{$order->id}})" class="pull-right"><span class="badge badge-primary "><i class="ion-android-home" style="font-size: 16px"></i> Update Address</span></a></span>
                                                </h6>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-12">
                                                <h6 class=" inv-title"><i class="ion-checkmark-circled"></i> Payment & Shipping :</h6>
                                            <hr>
                                            </div>

                                            <div class="col-sm-4 col-12">
                                                <p class=" inv-subtitle" style="font-size: 15px;color: #0e1726"><i class="ion-card" style="font-size: 20px"></i> Payment  : </p>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <p class="pull-right" style="font-size: 15px;color: #0e1726">{{$order->payment_type->name}} &nbsp;&nbsp;&nbsp; <a href="javascript:void(0)"  data-toggle="modal" data-target="#payment_confirm_id" onclick="payment_confirm({{$order->id}})" class="pull-right"><span class="badge badge-primary "><i class="ion-ios-checkmark-outline" style="font-size: 16px"></i> Update </span></a></p>
                                            </div>
                                            <div class="col-sm-4 col-12">
                                                <p class=" inv-subtitle" style="font-size: 15px;color: #0e1726"><i class="ion-bag" style="font-size: 20px"></i> Courier : </p>
                                            </div>
                                            <div class="col-sm-8 col-12">
                                                <p class="" style="font-size: 15px;color: #0e1726">{{isset($order->courier->name)?$order->courier->name:'No Courer Confirm'}}  &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#courier_confirm_id"><span class="badge badge-secondary" ><i class="ion-ios-checkmark-outline" style="font-size: 16px"></i> Update </span></a></p>
                                            </div>
                                            <div class="col-sm-5 col-12">
                                                <p class=" inv-subtitle" style="font-size: 14px;color: #0e1726"><i class="ion-android-car" style="font-size: 20px"></i> Shipping Area : </p>
                                            </div>
                                            <div class="col-sm-7 col-12">
                                                <p class="" style="font-size: 15px;color: #0e1726">{{$order->shipping_title}} &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" data-toggle="modal" data-target="#update_shipping_id"><span class="badge badge-primary "><i class="ion-ios-checkmark-outline" style="font-size: 16px"></i> Update </span></a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-7 col-12 order-sm-1 order-0">
                                    <div class="inv--total-amounts text-sm-right">
                                        <div class="row">
                                            <div class="col-sm-8 col-7">
                                                <p class="" style="font-size: 15px;color: #0e1726">Total Amount : </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold"><?php echo number_format($order->total_amount+$order->total_discount_product);?> Tk.</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="" style="font-size: 15px;color: #0e1726">Total Discount :  </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold">-<?php echo number_format($order->total_discount_product);?> Tk.</p>
                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="discount-rate" style="font-size: 15px;color: #0e1726">Subtotal :  </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold"> <?php echo number_format($order->total_amount);?> Tk.</p>
                                            </div>
                                            @if(!empty($order->cupon_amount))
                                            <div class="col-sm-8 col-7 grand-total-title">
                                                <h4 class="" style="font-size: 15px;color: #0e1726">Get Cupon Discount : </h4>
                                            </div>
                                            <div class="col-sm-4 col-5 grand-total-amount">
                                                <h4 class="" style="font-weight: bold">-<?php echo number_format($order->cupon_amount);?> Tk.</h4>
                                            </div>
                                            @endif
                                            <div class="col-sm-8 col-7">
                                                <p class="" style="font-size: 15px;color: #0e1726">Shipping Charge : </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold">+<?php echo number_format($order->shipping_amount);?> Tk.</p>

                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="" style="font-size: 15px;color: #0e1726">Payable Amount : </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold"><?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);?> Tk.</p>

                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="" style="font-size: 15px;color: #0e1726">Paid Amount : </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold"><?php echo number_format($order->total_paid_amount);?> Tk.</p>

                                            </div>
                                            <div class="col-sm-8 col-7">
                                                <p class="" style="font-size: 15px;color: #0e1726">Due Amount : </p>
                                            </div>
                                            <div class="col-sm-4 col-5">
                                                <p class="" style="font-weight: bold"> <?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount-$order->total_paid_amount);?> Tk.</p>

                                            </div>
                                            <div class="col-9">
                                                <p class=""> </p>
                                            </div>
                                            <form action="{{route('onetime-order-confirm-save',['order_id'=>$order->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                            <div class="col-3">
                                                <button type="submit" style="width: 220px" class="btn btn-primary btn-rounded mb-2"><i class="ion-ios-cart" style="font-size: 18px;font-weight: bold"></i> Confirm Order</button>
                                            </div>
                                            </form>



                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="update_billing" tabindex="-1" role="dialog" aria-labelledby="update_billing" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('update-confirm-order-address',['order_id'=>$order->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="ion-android-home" style="font-size: 25px"></i> Update Billing & Shipping Address </h5>

                    </div>
                    <div class="modal-body">
                        <h6 class="" style="color: blue"><i class="ion-edit"></i> Update Billing Address</h6>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Name</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text"  name="name" required class="form-control" value="{{$order->blling->name}}"  placeholder="Enter Billing Name">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Email</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text"  name="email"  class="form-control"  value="{{$order->blling->email}}"   placeholder="Enter Billing Email">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Mobile</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text"  name="mobile"  class="form-control"  value="{{$order->blling->mobile}}"  required  placeholder="Enter Billing Mobile">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Address</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <textarea class="form-control" name="address"  required placeholder="Enter Billing Address">{{$order->blling->address}}</textarea>
                            </div>
                        </div>

                        <br>
                        @if(isset($order->other_shipping->name))

                         <hr>
                        <h6 class="" style="color: blue"><i class="ion-edit"></i> Update Shipping Address</h6>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Name</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text"  name="other_name" required class="form-control" value="{{$order->other_shipping->name}}"  placeholder="Enter Shipping Name">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Email</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text"  name="other_email"  class="form-control"  value="{{$order->other_shipping->email}}"   placeholder="Enter Shipping Email">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Mobile</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text"  name="other_mobile"  class="form-control"  value="{{$order->other_shipping->mobile}}"  required  placeholder="Enter Shipping Mobile">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Update Address</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <textarea class="form-control" name="other_address"  required placeholder="Enter Shipping Address">{{$order->other_shipping->address}}</textarea>
                            </div>
                        </div>

                            @endif



                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary"><i class="ion-android-checkmark-circle"></i> Address Confirm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="add_item" tabindex="-1" role="dialog" aria-labelledby="add_item" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('update-confirm-order-product',['order_id'=>$order->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="ion-ios-cart-outline" style="font-size: 25px"></i> Add Items</h5>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Add New Item</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <div class="form-group mb-3">
                                    <select class="chzn-select custom-select" name="product_id" required>
                                        <option value="">Choose....</option>

                                        @foreach($products as $product)
                                            <option value="{{$product->id}}">{{$product->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Enter Qty</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="number" min="1" name="qty" required class="form-control"  placeholder="Enter Qty">
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Unit</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <div class="form-group mb-3">
                                    <select class="custom-select " onchange="confirm_unit();" name="unit_id" id="unit_id" required>
                                        <option value="">Choose....</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach

                                    </select>

                                </div>
                            </div>
                        </div>



                        <div class="form-group row mb-4">
                            <label for="fullName" id="unit_confirm" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Weight</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="text" name="weight" class="form-control" id="weight" placeholder="Product Weight" value="" required>
                            </div>

                        </div>
                        <div class="form-group row mb-4">
                            <label for="discount_amount" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Discount Amount</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="number"  name="discount_amount" value="0"  class="form-control"  placeholder="Enter Discount Amount">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="sales_rate" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Sales Rate </label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="number" min="1" name="sales_rate" required class="form-control"  placeholder="Enter Sales Rate">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary"><i class="ion-android-checkmark-circle"></i> Product Confirm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="payment_confirm_id" tabindex="-1" role="dialog" aria-labelledby="payment_confirm_id" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('update-onetime-order-payment')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="ion-cash" style="font-size: 25px"></i> Update Payment Info</h5>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Payment Type</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <select name="payment_type_id" required id="payment_type_id"  class="form-control">
                                    <option value="">Choose...</option>
                                    @foreach($payment_types as $payment_type)

                                        <option value="{{$payment_type->id}}"{{$order->payment_type_id==$payment_type->id?'selected=""':''}}>{{$payment_type->name}}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Paid Amount</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <input type="hidden" name="order_id" value="{{$order->id}}">
                                <input type="number" min="0" name="total_paid_amount" required class="form-control" id="total_paid_amount" placeholder="Enter Paid Amount">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary"><i class="ion-android-checkmark-circle"></i> Payment Confirm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="courier_confirm_id" tabindex="-1" role="dialog" aria-labelledby="courier_confirm_id" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('update-courer-info',['order_id'=>$order->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="ion-android-car" style="font-size: 25px"></i> Confirm Courier</h5>

                    </div>
                    <div class="modal-body">

                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Select Courier</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">
                                <select name="courier_id" required id="courier_id"  class="form-control">
                                    <option value="">Choose...</option>
                                    @foreach($couriers as $courier)

                                        <option value="{{$courier->id}}" {{$courier->id==$order->courier_id?'selected=""':""}}>{{$courier->name}}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary"><i class="ion-android-checkmark-circle"></i> Payment Confirm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" id="update_shipping_id" tabindex="-1" role="dialog" aria-labelledby="update_shipping_id" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{route('update-onetime-order-shipping')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="ion-android-car" style="font-size: 25px"></i> Update Shipping Info</h5>

                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="order_id" value="{{$order->id}}">

                        <div class="form-group row mb-4">
                            <label for="hPassword" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Payment Type</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">

                                <select class="form-control" required name="shipping_id" id="shipping_confirm" onchange="confirm_shipping(this.value)" style="width: 100%;font-weight: bold">
                                    <option  value="" style="font-weight: bold">Select Location</option>
                                    <?php $i=1;?>
                                    @foreach($shipping as $value)
                                        <?php if($i<3){ ?>
                                        <option  value="{{$value->id}}" {{$value->id==$order->shipping_id?'selected=""':''}}>{{$value->title}}  = {{$value->amount}}Tk</option>
                                        <?php } $i++;?>
                                    @endforeach


                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Shipping Charge</label>
                            <div class="col-xl-8 col-lg-9 col-sm-10">

                                <input type="number" min="0" name="shipping_amount" required class="form-control" id="shipping_amount" value="{{$order->shipping_amount}}" placeholder="Shipping charge Applied">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                        <button type="submit" class="btn btn-primary"><i class="ion-android-checkmark-circle"></i> Shipping Confirm </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('style')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="{{ asset('backend/assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">


    <!-- END PAGE LEVEL STYLES -->
    <style>
        .form-group label, label {
            font-size: 15px;
            color: #64646f;
            letter-spacing: 1px;
        }

        .invoice .content-section {
            height: 1050px;
        }
        hr {
            margin-top: 20px;
            margin-bottom: 20px;
            border-top: 1px solid #d9e1f5;
        }
        .btn-group>.btn, .btn-group .btn {
            padding: 0px 10px;
        }


    </style>

@endsection
@section('script')

    <script src="{{ asset('backend/assets/js/apps/invoice.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>


    <script>
        function confirm_unit() {
            var unit_id = $('#unit_id').val();
            if(unit_id==5){
                $('#unit_confirm').html("Qty");
                $('#weight').attr("placeholder", "Product Quantity");
            }else{
                $('#unit_confirm').html("Weight");
                $('#weight').attr("placeholder", "Product Weight");
            }
        }
        $(function() {
            $('select').chosen({ width: "290px" });
        });

        {{--function payment_confirm(order_id) {--}}


            {{--$.ajax({--}}
                {{--url: "{{ route('admin.edit-category') }}",--}}
                {{--method: 'get',--}}
                {{--data: {--}}
                    {{--'category_id':category_id--}}

                {{--},--}}
                {{--success: function(result){--}}



                    {{--if(result.popular_category)--}}
                    {{--{--}}

                        {{--$( "#popular_category1" ).prop( "checked",true);--}}
                    {{--}--}}
                    {{--else{--}}

                        {{--$( "#popular_category1" ).prop( "checked",false);--}}
                    {{--}--}}

                    {{--$("#category_id").val(result.id);--}}
                    {{--$("#name").val(result.name);--}}
                    {{--$("#status").val(result.status);--}}

                    {{--$("#output_1").attr("src", '{{ URL::asset('/') }}'+result.category_image);--}}


                {{--}});--}}


        {{--}--}}
    </script>




@endsection
