@extends('backend.employee.employee-layout')

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
                <div class="row" style="">
                   <h4 style="margin-left: 20px;">

                       <div class="icon-container">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg><span class="icon-name">  Pending Orders</span>
                       </div>

                   </h4>




                </div>

                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">SL</th>
                            <th class="text-center">Invoice </th>
                            <th class="text-center">Order Date </th>
                            <th class="text-center">Customer </th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Order Amount</th>

                            <th class="text-center">Order Status</th>
                            <th class="text-center" width="130px">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sl=1;
                        ?>

                        @foreach($orders as $order)

                            <tr>
                                <td class="text-center">{{$sl++}}</td>
                                <td class="text-center" style="font-weight: bold"> BS{{$order->invoice_no}}</td>
                                <td class="text-center" style="font-weight: bold"> {{date("d M,Y",strtotime($order->order_date))}}</td>
                                <td class="text-center">{{$order->blling->name}}</td>
                                <td class="text-center">{{$order->blling->mobile}}</td>
                                <td class="text-center" style="font-weight: bold">{{number_format($order->total_amount+$order->shipping_amount-$order->cupon_amount)}} Tk.</td>
                                <td class="text-center">

                                    <span class="badge badge-primary"> <i class="far fa-bell" style="color: white;font-weight: 400"></i> Pending </span>

                                </td>


                                <td>
                                    <a href="{{route('onetime-order-confirm',['id'=>$order->id])}}" ><span class="badge outline-badge-primary"  style="margin-bottom: 5px"> <i class="ion-ios-cart" style="color: green;font-weight:bold "></i> Confirm </span></a>
                                    <a href="{{route('onetime-order-view',['id'=>$order->id])}}"  style="margin-bottom: 5px"><span class="badge outline-badge-secondary"> <i class="far fa-eye" style="color: green;font-weight: 400"></i> View </span></a>
                                    <a href="{{route('onetime-order-cancel',['id'=>$order->id])}}" ><span class="badge outline-badge-warning"> <i class="ion-android-cancel" style="color: green;font-weight: 400"></i> Cancel </span></a>




                                </td>
                            </tr>

                        @endforeach





                        </tbody>
                        <tfoot>

                        </tfoot>
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
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/table/datatable/custom_dt_multiple_tables.css')}}">


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
        .btn-outline-primary:hover {
            color: #1b55e2 !important;
            background-color: #fefefe;
        }

    </style>

@endsection
@section('script')

    <script src="{{ asset('backend/plugins/table/datatable/datatables.js')}}"></script>

    <script>
        $(document).ready(function() {
            $('table.multi-table').DataTable({
                "oLanguage": {
                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                    "sInfo": "Showing page _PAGE_ of _PAGES_",
                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                    "sSearchPlaceholder": "Search...",
                    "sLengthMenu": "Results :  _MENU_",
                },
                "stripeClasses": [],
                "lengthMenu": [10, 20, 50, 100],
                "pageLength": 10,
                drawCallback: function () {
                    $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
                    $('.dataTables_wrapper table').removeClass('table-striped');
                }
            });
        } );


    </script>



@endsection