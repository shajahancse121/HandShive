@extends('backend.admin.admin-layout')
@section('title')
    <?php
    $product = \App\Product::find($product_id);
    echo isset($product->name)?$product->name:'All '.' Sale Report';
    ?>
@endsection
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
                            <span class="ion-document-text"> Product  Sale Report</span>
                        </div>

                    </h4>




                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card component-card_1" style="min-width: 100%">
                            <div class="card-body">
                                <form style="width: 100%" action="{{route('search.product-sale-report')}}" method="post">

                                    @csrf
                                    <div class="row">


                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <select class="chzn-select custom-select" name="product_id" required>
                                                    <option value="">Choose....</option>
                                                    <option value="all" {{$product_id=='all'?'selected=""':''}}>ALL</option>
                                                    @foreach($products as $product)
                                                        <option value="{{$product->id}}" {{$product_id==$product->id?'selected=""':''}}>{{$product->name}}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <input type="text" required class="form-control" name="start_date" id="start_date" value="{{date("d-m-Y",strtotime($start_date))}}" autocomplete="off" placeholder="Enter Start Date">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mb-3">
                                                <input type="text" required class="form-control" name="end_date" id="end_date" value="{{date("d-m-Y",strtotime($end_date))}}" autocomplete="off" placeholder="Enter End Date">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
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
                            <th width="230px">Product</th>
                            <th>Sale Rate</th>
                            <th>Qty</th>
                            <th>Weight</th>

                            <th>Total Weight</th>
                            <th>Total Discount</th>
                            <th>Total Amount</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl = 1;

                        ?>
                        @foreach($order_details as $details)
                            <?php



//                            $unit = \App\Unit::find($details->unit_id);
//                            $unit_name = $unit->name=='gm'?'Kg':'ltr';

//                            if($unit->id==1 || $unit->id==3)
//                            {
//                                $total_weight+=($details->weight/1000);
//
//                            }else{
//
//                                $total_weight+=$details->weight;
//                            }

                            $product = \App\Product::find($details->product_id);
                             $sales_rate_details = \App\OrderDetail::where('product_id',$details->product_id)->where('order_status',3)->first();

                             $unit = \App\Unit::find($sales_rate_details->unit_id);
                            ?>
                            <tr>
                                <td>{{$sl++}}</td>


                                <td>{{$product->name}}</td>
                                <td>{{$sales_rate_details->sales_rate}}</td>
                                <td>{{$details->total_qty}}</td>
                                <td>{{$sales_rate_details->weight}} {{$unit->name}}</td>
                                <Td>
                                    <?php
                                    $total_weight = 0;
                                    $unit_name = '';
                                    if($unit->name=='gm')
                                        {
                                            $unit_name = 'kg';
                                        }
                                     else if($unit->name=='kg'){
                                         $unit_name = 'kg';
                                     }
                                     else if($unit->name=='ml'){
                                         $unit_name = 'ltr';
                                     }
                                     else if($unit->name=='ltr')
                                         {
                                             $unit_name = 'ltr';
                                         }
                                    if($unit->id==1 || $unit->id==3)
                                    {
                                        $total_weight+=($sales_rate_details->weight/1000);

                                    }else{

                                        $total_weight+=$sales_rate_details->weight;
                                    }
                                    echo ($total_weight*$details->total_qty).$unit_name;
                                    ?>
                                </Td>
                                <td>{{$details->total_discount}}</td>
                                <td>{{$details->total_amount}}</td>


                            </tr>
                        @endforeach


                        </tbody>
                        {{--<tfoot>--}}
                        {{--<tr style="font-weight: bolder">--}}
                            {{--<Td colspan="3" style="text-align: right">Total  : </Td>--}}
                            {{--<Td>{{$total_qty}} </Td>--}}
                            {{--<Td>{{$total_weight}} {{$unit_name}}</Td>--}}
                            {{--<Td></Td>--}}
                            {{--<Td></Td>--}}
                            {{--<Td>{{$total_amount}} Tk.</Td>--}}
                        {{--</tr>--}}
                        {{--</tfoot>--}}
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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css">

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
        .chosen-container-single .chosen-single {
            position: relative;
            display: block;
            overflow: hidden;
            padding: 0 0 0 8px;
            font-weight: bold;
            height: 40px;
            font-size: 20px;
            border: 1px solid #aaa;
            border-radius: 5px;
            background-color: #fff;
            background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(20%, #ffffff), color-stop(50%, #f6f6f6), color-stop(52%, #eeeeee), color-stop(100%, #f4f4f4));
            background: -webkit-linear-gradient(top, #ffffff 20%, #f6f6f6 50%, #eeeeee 52%, #f4f4f4 100%);
            background: -moz-linear-gradient(top, #ffffff 20%, #f6f6f6 50%, #eeeeee 52%, #f4f4f4 100%);
            background: -o-linear-gradient(top, #ffffff 20%, #f6f6f6 50%, #eeeeee 52%, #f4f4f4 100%);
            background: linear-gradient(top, #ffffff 20%, #f6f6f6 50%, #eeeeee 52%, #f4f4f4 100%);
            background-clip: padding-box;
            box-shadow: 0 0 3px white inset, 0 1px 1px rgba(0, 0, 0, 0.1);
            color: #444;
            text-decoration: none;
            white-space: nowrap;
            line-height: 24px;
        }
        .chosen-container-single .chosen-single span {
            display: block;
            overflow: hidden;
            margin-right: 26px;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 7px;
        }
    </style>

@endsection
@section('script')
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.js"></script>

    <script src="{{ asset('backend/plugins/table/datatable/datatables.js')}}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('backend/plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script>
        $(function() {
            $(".chzn-select").chosen();
        });
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
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 10
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
