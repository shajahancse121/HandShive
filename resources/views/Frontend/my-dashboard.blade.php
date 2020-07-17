@extends('Frontend.layout')
@section('content')
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <h3 style="font-family: 'Raleway'">My Dashboard</h3>
                        <ul>
                            <li style="font-family: 'Raleway'"><a href="{{route('home')}}">home</a></li>
                            <li style="font-family: 'Raleway'">My Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!-- my account start  -->
    <section class="main_content_area">
        <div class="container">
            <div class="account_dashboard">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-lg-3">
                        <!-- Nav tabs -->
                        <div class="dashboard_tab_button">
                            <ul role="tablist" class="nav flex-column dashboard-list">
                                <li><a href="#dashboard" data-toggle="tab" class="nav-link active"><i class="ion-ios-person" style="color:#40a944"></i>  My Profile</a></li>
                                <li> <a href="#orders" data-toggle="tab" class="nav-link"><i class="ion-ios-cart"  style="color:#40a944"></i> Orders</a></li>
                                <li><a href="#downloads" data-toggle="tab" class="nav-link"><i class="ion-edit"  style="color:#40a944"></i> Update Profile</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-lg-9">

                        @if(session('success'))
                            <div class="alert alert-success mb-4" role="alert" id="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                                {!! session('success') !!}.
                            </div>
                    @endif
                        <!-- Tab panes -->
                        <div class="tab-content dashboard_content">
                            <div class="tab-pane fade show active" id="dashboard">
                                <h3>My Profile </h3>
                                <p>
                                 <div class="panel panel-default" style="padding: 20px;border: solid 1px #eae2e2">
                                  <h3 style="font-family: 'Raleway';font-size:18px;font-weight: bold "><i class="ion-ios-person"  style="color:#40a944"></i> Name : <small style="font-weight: bold">{{\Auth::guard('customer')->user()->name}}</small> </h3>
                                    @if(!empty(Auth::guard('customer')->user()->phone))
                                    <h3 style="font-family: 'Raleway';font-size:18px;font-weight: bold "> <i class="ion-ios-telephone"  style="color:#40a944"></i> Phone :  <small>{{\Auth::guard('customer')->user()->phone}}</small> </h3>
                                   @endif

                                  @if(!empty(Auth::guard('customer')->user()->email))
                                    <h3 style="font-size:18px;font-weight: bold;text-transform:lowercase"><i class="ion-email"  style="color:#40a944"></i > Email :  <small>{{\Auth::guard('customer')->user()->email}}</small> <?php echo Auth::guard('customer')->user()->verified_email==0?'<a href="'.route('reemail-verification').'" style="font-weight: bold;color: #0ba360;text-decoration: underline;font-size: 14px">Verify Email</a>':'' ?>  </h3>
                                  @endif
                                        <h3 style="font-family: 'Raleway';font-size:18px;font-weight: bold "><i class="ion-home"  style="color:#40a944"></i> Address :  <small>{{\Auth::guard('customer')->user()->address}}</small> </h3>

                                </div>
                                </p>


                            </div>
                            <div class="tab-pane fade" id="orders">
                                <h3><i class="ion-bag"></i> My Orders</h3>
                                @if(!empty($orders->count()))
                                <table class="table table-responsive" width="100%">
                                    <thead>
                                    <tr class="bg bg-success text-white">
                                        <th>SL</th>
                                        <th>Invoice No</th>
                                        <th> Date</th>
                                        {{--<th>Delivery Date</th>--}}
                                        <th> Status</th>
                                        <th> Amount</th>
                                        <th> Cancel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $sl = 1;?>

                                    @foreach($orders as $order)
                                        <tr>
                                            <td> <?php echo $sl++;?></td>
                                            <td><a target="_blank" style="font-weight: bold;color: #40A944" href="{{route('my-order',['id'=>$order->id])}}"><i class="ion-android-cart buy_cart" style="color: black;font-size: 18px"></i> BS{{$order->invoice_no}}</a></td>
                                            <td>{{date('d M,Y',strtotime($order->order_date))}}</td>
                                            {{--<td>--}}
                                                {{--@if(!empty($order->delivery_date))--}}
                                                {{--{{date('d M,Y',strtotime($order->delivery_date))}}--}}
                                                    {{--@endif--}}

                                            {{--</td>--}}
                                            <td><span class="success">
                                                       @if($order->order_status==1)
                                                        pending
                                                    @elseif($order->order_status==2)
                                                        Processing
                                                    @elseif($order->order_status==3)
                                                        Delivery processing
                                                    @endif
                                                </span></td>
                                            <td><?php echo number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);?> Tk.</td>
                                            <td>
                                                @if(!($order->order_status==2 || $order->order_status==3))

                                                  <a href="{{route('my-order-cancel',['id'=>$order->id])}}" class="view" style="color: #40A944;font-weight: bold"><i class="ion-backspace-outline buy_cart"></i> Cancel</a></td>


                                            @endif
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                                @else
                                    <br>
                                    <h2 style="color: gray;text-align: center"><i class="ion-android-cart"></i> No Order found!</h2>
                                    @endif

                            </div>
                            <div class="tab-pane fade" id="downloads">
                                <h3>Update Profile</h3>
                                <div class="login col-md-6">
                                    <div class="login_form_container">
                                        <div class="account_login_form">
                                            <form  action="{{route('customer-profile-update')}}" method="post">
                                                @csrf

                                                <label><i class="ion-edit"></i> Name</label>
                                                <input type="text" name="name" placeholder="Your Name" value="{{\Auth::guard('customer')->user()->name}}">
                                                <label><i class="ion-edit"></i> Email </label>
                                                <input type= text" name="email" placeholder="Your Email" value="{{\Auth::guard('customer')->user()->email}}">
                                                <label><i class="ion-edit"></i> Phone</label>
                                                <input type="text" name="phone" value="{{\Auth::guard('customer')->user()->phone}}" placeholder="Your Phone number">
                                                <label><i class="ion-edit"></i> Password</label>
                                                <input type="password" name="password" placeholder="Enter New Password">
                                                <label><i class="ion-edit"></i> Address</label>
                                                <textarea name="address" class="form-control">{{\Auth::guard('customer')->user()->address}}</textarea>
                                                <br>

                                                    <button type="submit" class="btn btn-success">Update</button>

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
    </section>
    <!-- my account end   -->


@endsection


        @section('style')
            <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />
          <style>
              .tab-content > .tab-pane {
                  display: none;
              }
              .dashboard_content button {
                  color: white;
                  font-weight: 500;
                  border: 0;
                  background:#40A944;
              }

              @media (max-width: 700px) {
                  .table-responsive{font-size: 10px}
                  .buy_cart{display: none}

              }
          </style>
        @endsection

        @section('script')

       @endsection