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
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal"><i class="ion-ios-contact-outline" style="font-size: 18px"></i> Add User</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('save.user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="ion-ios-people" style="font-size: 26px"></i> Add User</h5>

                                </div>
                                <div class="modal-body">



                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" required name="name" class="form-control"  placeholder="Enter User  Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="email" required name="email" class="form-control"  placeholder="Enter User  Email">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="password" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="password" required name="password" class="form-control"  placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Role</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select name="role_id" required   class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach($roles as $role)
                                                <option value="{{$role->id}}">{{$role->name}}</option>
                                                    @endforeach


                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label">   Photo </label>
                                        <div class="col-6">
                                            <div class="field_wrapper">
                                                <div>
                                                    <input type="file"  name="image" accept="image/*" onchange="loadFile(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-8 offset-4">
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
                        <form action="{{route('admin.edit-user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel"><i class="ion-ios-people" style="font-size: 24px"></i> Update User</h5>

                                </div>
                                <input type="hidden" name="user_id" id="user_id">
                                <div class="modal-body">
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text" required name="name" id="name" class="form-control"  placeholder="Enter User  Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="email" required name="email" id="email" class="form-control"  placeholder="Enter User  Email">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="password" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Password</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="password"  name="password" id="password" class="form-control" autocomplete="off"  placeholder="Enter New Password">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Role</label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <select name="role_id" id="role_id" required   class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach


                                            </select>
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
                                        <label for="hEmail" class="col-xl-4 col-sm-4  col-form-label">   Photo </label>
                                        <div class="col-6">
                                            <div class="field_wrapper">
                                                <div>
                                                    <input type="file"  name="image"  accept="image/*" onchange="loadFile1(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-md-8 offset-4">
                                                <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output_1" width="300" >

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

                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)

                            <tr>
                                <td class="text-center">{{$user->name}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">{{$user->role->name}}</td>
                                <td class="text-center"><img src="{{asset($user->image?$user->image:'upload/category/no-image.png')}}" width="120px"></td>


                                <td class="text-center">
                                    <div class="t-dot {{$user->status==1?'bg-primary':'bg-danger'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$user->status==1?'Active':'Inactive'}}"></div>
                                </td>
                                <td class="text-center"> <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_category('{{$user->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
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
        function edit_category(user_id) {



            $.ajax({
                url: "{{ route('admin.edit-user') }}",
                method: 'get',
                data: {
                    'user_id':user_id

                },
                success: function(result){

                    $("#user_id").val(result.id);
                    $("#name").val(result.name);
                    $("#email").val(result.email);
                    $("#status").val(result.status);
                    $("#role_id").val(result.role_id);

                    $("#output_1").attr("src", '{{ URL::asset('/') }}'+result.image);


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