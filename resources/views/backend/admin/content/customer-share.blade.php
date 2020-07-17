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
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal">Add Testimonial</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('save.customer-share')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content" style="width: 600px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Testimonial</h5>

                                </div>
                                <div class="modal-body">

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Name </label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" required name="name" class="form-control"  placeholder="Enter Customer Name">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Message </label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <textarea class="form-control" name="message" required  rows="8"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Profile URL </label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text"  name="hyperlink" class="form-control"  placeholder="Enter Customer profile link">

                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Photo </label>
                                        <div class="col-md-4">
                                            <div class="field_wrapper">
                                                <label for="fullName">Image size:<code> 100x100</code></label>
                                                <div>
                                                    <input type="file"  name="photo" required accept="image/*" onchange="loadFile(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output" width="300">

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
                    <div class="modal-dialog" role="document">
                        <form action="{{route('update.customer-share')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content" style="width: 600px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Testimonial</h5>

                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="content_id" id="content_id">

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name </label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" required name="name" aria-invalid="name" class="form-control" id="name" placeholder="Enter Customer Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Message</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <textarea class="form-control" required name="message"  id="message" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Profile URL </label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text"  name="hyperlink" id="hyperlink" class="form-control"  placeholder="Enter Customer profile link">

                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Photo </label>
                                        <div class="col-md-4">
                                            <div class="field_wrapper">
                                                <label for="fullName">Image size:<code> 100x100</code></label>
                                                <div>
                                                    <input type="file"  name="new_photo"  accept="image/*" onchange="loadFile1(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output_1" width="300" >

                                        </div>
                                    </div>



                                </div>
                                <div class="modal-footer">
                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">Photo</th>
                            <th class="text-center" width="250px">Name</th>

                            <th class="text-center">Message</th>

                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($customer_shares as $item)

                            <tr>
                                <td class="text-center"><img width="100px" src="{{asset($item->photo)}}"></td>

                                <td class="text-center"><a href="{{$item->hyperlink}}" target="_blank">{{$item->name}}</a></td>
                                <td class="text-center" style="text-align: justify;font-size: 13px">{!! substr($item->message,0,152) !!}</td>


                                <td class="text-center" width="200">

                                    <a href="{{route('admin.delete-share',['id'=>$item->id])}}">
                                        <button type="submit"   name="archive" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                                    </a>




                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_content('{{$item->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
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

    <script>
        setTimeout(function(){  $("#alert").fadeOut(); }, 2000);
        function edit_content(content_id) {

            $.ajax({
                url: "{{ route('admin.edit-customer-share') }}",
                method: 'get',
                data: {
                    'content_id':content_id

                },
                success: function(result){

                    $("#name").val(result.name);
                    $("#content_id").val(result.id);
                    $("#message").val(result.message);
                    $("#hyperlink").val(result.hyperlink);

                    $("#output_1").attr("src", '{{ URL::asset('/') }}'+result.photo);


                }});


        }
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadFile1 = function(event) {
            var output = document.getElementById('output_1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>

@endsection