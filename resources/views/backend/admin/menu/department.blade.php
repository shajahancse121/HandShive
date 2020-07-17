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
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal">Add Department</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('save.department')}}" method="post" enctype="multipart/form-data">
                            @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Department</h5>

                            </div>
                            <div class="modal-body">

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" required name="name" class="form-control" id="hEmail" placeholder="Enter Department Name">
                                            </div>
                                        </div>

                                        <div class="form-group row mb-4">
                                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label" style="font-size: 13px">Short Description</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                               <textarea class="form-control" name="short_description" required placeholder="Enter Department Short Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="department_video" class="col-xl-2 col-sm-3 col-sm-2 col-form-label" style="font-size: 13px">Department Video</label>
                                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                                <input type="text" required name="department_video" class="form-control"  placeholder="Enter Department Video URL">
                                            </div>
                                        </div>


                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select name="status" required   class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                       <div class="row">
                                           <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label text-center">   Logo </label>
                                           <div class="col-6">
                                               <div class="field_wrapper">
                                                   <label for="fullName">Image size:<code> 220x80</code></label>
                                                   <div>
                                                       <input type="file"  name="cover_image" accept="image/*" onchange="loadFile(event)"/>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                        <div class="row">
                                            <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label  text-center">   Icon </label>
                                            <div class="col-6">
                                                <div class="field_wrapper">
                                                    <label for="fullName">Image size:<code> 100x100</code></label>
                                                    <div>
                                                        <input type="file"  name="icon" accept="image/*" onchange="loadFile(event)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-8 offset-4">
                                                <br>
                                                <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output" width="300" >

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
                        <form action="{{route('admin.edit-department')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Department</h5>

                                </div>
                                <div class="modal-body">

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="hidden" name="id" id="department_id">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Department Name">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label" style="font-size: 13px">Short Description</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <textarea class="form-control" name="short_description" id="short_description" required placeholder="Enter Department Short Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="department_video" class="col-xl-2 col-sm-3 col-sm-2 col-form-label" style="font-size: 13px">Department Video</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" required name="department_video" id="department_video" class="form-control"  placeholder="Enter Department Video URL">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select name="status" required id="status"  class="form-control">
                                                <option value="">Choose...</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="row">
                                            <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label">  Logo </label>
                                            <div class="col-6">
                                                <div class="field_wrapper">
                                                    <label for="fullName">Image size:<code> 220x80</code></label>

                                                    <div>
                                                        <input type="file"  name="icon" accept="image/*" onchange="loadFile2(event)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label">  Icon </label>
                                            <div class="col-6">
                                                <div class="field_wrapper">
                                                    <label for="fullName">Image size:<code> 100x100</code></label>

                                                    <div>
                                                        <input type="file"  name="cover_image" accept="image/*" onchange="loadFile1(event)"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" style="margin-top: 20px">

                                            <div class="col-md-6">
                                                <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output_2" width="200" >

                                            </div>

                                            <div class="col-md-6">
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

                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                        <tr>

                            <th class="text-center">Department</th>
                            <th class="text-center"> Logo</th>
                            <th class="text-center"> Icon</th>


                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($departments as $department)

                        <tr>
                            <td class="text-center">{{$department->name}}</td>
                            <td class="text-center"><img src="{{asset($department->cover_image?$department->cover_image:'upload/department/no-image.png')}}" width="120px"></td>
                            <td class="text-center"><img src="{{asset($department->icon?$department->icon:'upload/department_icon/no-image.png')}}" width="120px"></td>



                            <td class="text-center">
                                <div class="t-dot {{$department->status==1?'bg-primary':'bg-danger'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$department->status==1?'Active':'Inactive'}}"></div>
                            </td>
                            <td class="text-center"> <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_department('{{$department->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
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
        function edit_department(department_id) {




            $.ajax({
                url: "{{ route('admin.edit-department') }}",
                method: 'get',
                data: {
                    'department_id':department_id

                },
                success: function(result){




                    $("#department_id").val(result.id);
                    $("#name").val(result.name);
                    $("#status").val(result.status);
                    $("#short_description").val(result.short_description);
                    $("#department_video").val(result.department_video);

                    $("#output_1").attr("src", '{{ URL::asset('/') }}'+result.cover_image);
                    $("#output_2").attr("src", '{{ URL::asset('/') }}'+result.icon);


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
        var loadFile2 = function(event) {
            var output = document.getElementById('output_2');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>

@endsection
