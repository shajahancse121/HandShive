@extends('backend.admin.admin-layout')

@section('content')


    <div class="row layout-top-spacing">



        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            @if(session('success'))
                <div class="alert alert-primary mb-4" role="alert" id="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button> <strong>Success!</strong>
                    {{session('success')}}.
                </div>
            @endif

            <div class="widget-content widget-content-area br-6">
                <div class="row" style="margin-bottom: 10px">
                    <h4 style="margin-left: 20px;">

                        <div class="icon-container" style="font-style: normal !important;">
                            <span class="ion-document-text"> Cupon Report</span>
                        </div>

                    </h4>




                </div>
                <div class="row">
                    <div class="col-md-9 offset-1">
                        <div class="card component-card_1" style="min-width: 100%">
                            <div class="card-body">
                                <form style="width: 100%" action="{{route('search.cupon-report-view')}}" method="post">

                                    @csrf
                                    <div class="row">


                                        <div class="col-md-8">
                                            <div class="form-group mb-3">
                                                <input type="text" required class="form-control" name="code" id="code" value="{{$code}}" style="font-weight: bolder" autocomplete="off" placeholder="Enter Cupon Code">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary btn-lg"><i class="ion-ios-search"></i> Submit</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mb-4 mt-4">

                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Invoice No</th>
                            <th> Amount</th>
                            <th> Discount</th>
                            <th>Shipping</th>
                            <th>Cupon</th>
                            <th>Final Amount</th>
                            <th id="hide1">Action</th>
                        </tr>
                        </thead>
                        <?php
                        if(!empty($cupon->orders)){
                        ?>
                        <tbody>
                        <?php

                        $sl = 1;
                        $total_amount = 0;
                        $total_discount_product = 0;
                        $total_shipping_amount = 0;
                        $total_cupon_amount = 0;
                        $total_final_amount = 0;
                        ?>
                        @foreach($cupon->orders as $order)
                            <?php
                               if($order->order_status==3){


                            $total_amount+=$order->total_amount;
                            $total_discount_product+=$order->total_discount_product;
                            $total_shipping_amount+=$order->shipping_amount;
                            $total_cupon_amount+=$order->cupon_amount;
                            $total_final_amount+=($order->total_amount+$order->shipping_amount-$order->cupon_amount);

                            ?>
                            <tr>
                                <td>{{$sl++}}</td>
                                <td>{{date('d-m-Y',strtotime($order->delivery_date))}}</td>
                                <td>BS{{$order->invoice_no}}</td>
                                <td>{{$order->total_amount}}</td>
                                <td>{{$order->total_discount_product}}</td>
                                <td>{{$order->shipping_amount}}</td>
                                <td>{{$order->cupon_amount}}</td>
                                <td>{{number_format($order->total_amount+$order->shipping_amount-$order->cupon_amount)}}</td>

                                <td  id="hide2">
                                    <a href="{{route('onetime-order-view',['id'=>$order->id])}}" target="_blank"><span class="badge outline-badge-secondary"> <i class="ion-ios-search-strong" style="color: green;font-weight: 400"></i> View </span></a>

                                </td>
                            </tr>
                            <?php
                               }
                            ?>
                        @endforeach



                        </tbody>
                        <tfoot>
                        <tr style="font-weight: bolder">
                            <Td colspan="3" style="text-align: right">Total Amount : </Td>
                            <Td>{{$total_amount}} Tk.</Td>
                            <Td>{{$total_discount_product}} Tk.</Td>
                            <Td>{{$total_shipping_amount}} Tk.</Td>
                            <Td>{{$total_cupon_amount}} Tk.</Td>
                            <Td>{{$total_final_amount}} Tk.</Td>
                        </tr>

                        </tfoot>
                        <?php } ?>
                    </table>

                </div>



            </div>
        </div>

    </div>

@endsection
@section('style')
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- END PAGE LEVEL STYLES -->
    <style>
        .form-group label, label {
            font-size: 15px;
            color: #64646f;
            letter-spacing: 1px;
        }
        .table > tbody > tr > td {
            border: none;
            color: #0e1726;
            font-size: 16px;
            letter-spacing: 1px;
        }
    </style>

@endsection
@section('script')

    <script src="{{ asset('backend/plugins/table/datatable/datatables.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [100, 200, 300, 500],
            "pageLength": 100
        } );

    </script>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>

        $( function() {
            $( "#start_date" ).datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $( "#end_date" ).datepicker({
                dateFormat: 'dd-mm-yy'
            });
        } );
    </script>


@endsection