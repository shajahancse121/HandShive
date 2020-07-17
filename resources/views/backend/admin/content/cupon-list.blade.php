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
                <div class="row">
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal">Add Cupon</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" >
                        <form action="{{route('save.cupon')}}" method="post">
                            @csrf
                            <div class="modal-content" style="width: 600px !important;" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Cupon Code</h5>

                                </div>
                                <div class="modal-body">

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Cupon Code</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="code" class="form-control"  autocomplete="off" placeholder="Enter Cupon Code">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Start Date</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="start_date" class="form-control" id="start_date" autocomplete="off" placeholder="Enter Start Date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">End Date</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="end_date" class="form-control" id="end_date" autocomplete="off" placeholder="Enter End Date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Discount Type</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <select name="discount_type" required   class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="1">(%) Parcent Discount</option>
                                                <option value="2">(Tk) Flat Discount</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Amount</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="amount" class="form-control" autocomplete="off" placeholder="Enter Amount">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Status</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <select name="status" required   class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document" >
                        <form action="{{route('admin.edit-cupon')}}" method="post">
                            @csrf
                            <div class="modal-content" style="width: 600px !important;" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Cupon Code</h5>

                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="cupon_id" id="cupon_id">

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Cupon Code</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="code" id="code" class="form-control"  autocomplete="off" placeholder="Enter Cupon Code">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Start Date</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="start_date" class="form-control" id="start_date1" autocomplete="off" placeholder="Enter Start Date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">End Date</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="end_date" class="form-control" id="end_date1" autocomplete="off" placeholder="Enter End Date">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Discount Type</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <select name="discount_type" id="discount_type" required   class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="1">(%) Parcent Discount</option>
                                                <option value="2">(Tk) Flat Discount</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Amount</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <input type="text" required name="amount" id="amount" class="form-control" autocomplete="off" placeholder="Enter Amount">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Status</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">
                                            <select name="status" id="status" required   class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">Cupon</th>
                            <th class="text-center">Discout Type</th>
                            <th class="text-center">Amount</th>
                            <th class="text-center">Start Date</th>
                            <th class="text-center">End Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($cupons as $cupon)

                            <tr>
                                <td class="text-center">{{$cupon->code}}</td>
                                <td class="text-center">{{$cupon->discount_type==1?'Parcent(%) Discount':'Flat Discount' }}</td>
                                <td class="text-center">{{$cupon->amount}}{{$cupon->discount_type==1?'%':' Tk' }}</td>
                                <td class="text-center">{{date("d M,Y",strtotime($cupon->start_date))}}</td>
                                <td class="text-center">{{date("d M,Y",strtotime($cupon->end_date))}}</td>

                                <td class="text-center">
                                    <div class="t-dot {{$cupon->status==1?'bg-primary':'bg-danger'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$cupon->status==1?'Active':'Inactive'}}"></div>
                                </td>
                                <td class="text-center"> <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_cupon('{{$cupon->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
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


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( "#start_date" ).datepicker({
                dateFormat: 'dd-mm-yy'
            });
        } );
        $( function() {
            $( "#end_date" ).datepicker({
                dateFormat: 'dd-mm-yy'
            });
        } );
        $( function() {
            $( "#start_date1" ).datepicker({
                dateFormat: 'dd-mm-yy'
            });
        } );
        $( function() {
            $( "#end_date1" ).datepicker({
                dateFormat: 'dd-mm-yy',
                minDate: '0',
                onSelect: function(selected) {
                    $("#end_date1").datepicker("option","minDate", selected)
                }
            });
        } );
    </script>
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

    <script>
        setTimeout(function(){  $("#alert").fadeOut(); }, 2000);
        function edit_cupon(cupon_id) {



            $.ajax({
                url: "{{ route('admin.edit-cupon') }}",
                method: 'get',
                data: {
                    'cupon_id':cupon_id

                },
                success: function(result){

                    $("#cupon_id").val(cupon_id);
                    $("#code").val(result.code);
                    $("#status").val(result.status);
                    $("#start_date1").val(result.start_date);
                    $("#end_date1").val(result.end_date);
                    $("#discount_type").val(result.discount_type);
                    $("#amount").val(result.amount);

                }});


        }
    </script>

@endsection