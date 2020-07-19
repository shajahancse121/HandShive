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
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal">Add WorkFlow</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('save.work_flow')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content" style="width: 600px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add WorkFlow</h5>

                                </div>
                                <div class="modal-body">

                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Select Department</label>
                                        <div class="col-xl-7 col-lg-7 col-sm-6">
                                            <select name="department_id" required   class="selectpicker" data-live-search="true">
                                                <option value="">Choose...</option>
                                                @foreach($departments as $department)
                                                <option  value="{{$department->id}}" data-content="<span class='badge badge-primary'>{{$department->name}}</span>">{{$department->name}}</option>

                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-7 col-lg-7 col-sm-6">
                                            <select class="selectpicker" name="status" required>
                                                <option value="">Choose...</option>
                                                <option value="1">Published</option>
                                                <option value="0">Unpublished</option>

                                            </select>
                                        </div>
                                    </div>



                                    <div class="form-row">

                                      <div class="row">
                                        <div class="col-md-9">
                                           <div class="row">
                                               <label for="fullName" class="col-md-6">Add WorkFlow</label>
                                               <div class="col-md-6">

                                                   <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"> Add</a>


                                               </div>
                                           </div>
                                            <div class="col-md-12">
                                                <div class="field_wrapper" style="width:100%">

                                                </div>
                                            </div>
                                        </div>
                                          <div class="col-md-3">
                                              <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output_1" width="200" >

                                          </div>
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
                        <form action="{{route('update.work-flow')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update WorkFlow</h5>

                                </div>
                                <input type="hidden" name="work_flow_id" id="work_flow_id">
                                <div class="modal-body">
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Department</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="department_id" required id="department_id"   class="form-control"  style="font-size: 16px">
                                                <option value="">Choose...</option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="status" required id="status"  class="form-control" style="font-size: 16px">
                                                <option value="">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label"> Update WorkFlow </label>
                                        <div class="col-6">
                                            <div class="field_wrapper">


                                                <div>
                                                    <input type="file"  name="work_flow_img" accept="image/*" onchange="loadFile1(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-8 offset-4">
                                                <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output_11" width="300" >

                                            </div>


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
                            <th class="text-center" width="300px">Department</th>

                            <th class="text-center">Work Flow</th>

                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($work_flow as $item)

                            <tr>
                                <td class="text-center">{{$item->department->name}}</td>
                                <td class="text-justify"><img src="{{asset($item->work_flow_img)}}" width="150"></td>


                                <td class="text-center" width="200">

                                    <a href="{{route('admin.delete-work-flow',['id'=>$item->id])}}">
                                        <button type="submit"   name="archive" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete</button>
                                    </a>




                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_work_flow('{{$item->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
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
            color: #ffffff !important;
        }
        .form-control {
            height: auto;
            border: 1px solid #bfc9d4;
            color: #3b3f5c;
            font-size: 9px;
             padding: 8px 10px;
            letter-spacing: 1px;
            height: calc(1.4em + 1.4rem + 2px);
            /* padding: .75rem 1.25rem; */
            border-radius: 6px;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}">


@endsection
@section('script')

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er"></script>
    <script>tinymce.init({ selector:'.textarea' });  </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('backend/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var loadFile1 = function(event) {
                var output = document.getElementById('output_1');
                output.src = URL.createObjectURL(event.target.files[0]);
                output.onload = function() {
                    URL.revokeObjectURL(output.src) // free memory
                }
            };
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div style="margin-top: 10px;float: left" class="col-md-4"><input type="file"  name="work_flow_img[]" accept="image/*" onchange="loadFile(event)" class="col-md-10 form-control"   required style="display: inline-block !important;"/><a href="javascript:void(0);" class="remove_button col-md-1" style="padding-right: 0px;float: right"><i class="far fa-trash-alt" style="font-size: 17px"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
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
        function edit_work_flow(work_flow_id) {


            $("#output_11").attr("src", '{{ URL::asset('/loading.gif') }}');




            $.ajax({
                url: "{{ route('admin.edit-work-flow') }}",
                method: 'get',
                data: {
                    'work_flow_id':work_flow_id

                },
                success: function(result){

                    $("#work_flow_id").val(result.work_flow_id);
                    $("#department_id").val(result.department_id);
                    $("#status").val(result.status);



                    $("#output_11").attr("src", '{{ URL::asset('/') }}'+result.work_flow_img);



                }});


        }
    </script>
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output_1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
        var loadFile1 = function(event) {
            var output = document.getElementById('output_11');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>

@endsection
