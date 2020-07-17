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
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal">Add Sub Category</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('save.sub-category')}}" method="post">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Sub Category</h5>

                                </div>
                                <div class="modal-body">


                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Department</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="department_id" required id="department_id" onchange="get_category(this.value);"   class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Category</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="category_id" required id="category_id"   class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Name</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <input type="text" required name="name" class="form-control" id="hEmail" placeholder="Enter Sub Category Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
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
                    <div class="modal-dialog" role="document">
                        <form action="{{route('admin.edit-sub-category')}}" method="post">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Sub Category</h5>

                                </div>
                                <div class="modal-body">
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Department</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="department_id" required id="department_id_u" onchange="get_category_u(this.value);"   class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Category</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="category_id" required id="category_id_u"   class="form-control">
                                                <option value="">Choose...</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Name</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <input type="hidden" name="sub_category_id" id="sub_category_id">
                                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Category Name">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-10">
                                            <select name="status" required id="status"  class="form-control">
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
                            <th class="text-center">Department</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Sub Category</th>

                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($subCategories as $subCategory)

                            <tr>
                                <td class="text-center">{{$subCategory->department->name}}</td>
                                <td class="text-center">{{$subCategory->category->name}}</td>
                                <td class="text-center">{{$subCategory->name}}</td>


                                <td class="text-center">
                                    <div class="t-dot {{$subCategory->status==1?'bg-primary':'bg-danger'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$subCategory->status==1?'Active':'Inactive'}}"></div>
                                </td>
                                <td class="text-center"> <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_subcategory('{{$subCategory->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
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
        function get_category(department_id) {

            $.ajax({
                url: "{{ route('admin.get-category') }}",
                method: 'get',
                data: {
                    'department_id':department_id

                },
                success: function(result){



                    $("#category_id").html(result.category_id);


                }});
        }
        function get_category_u(department_id) {

            $.ajax({
                url: "{{ route('admin.get-category') }}",
                method: 'get',
                data: {
                    'department_id':department_id

                },
                success: function(result){



                    $("#category_id_u").html(result.category_id);


                }});
        }
        setTimeout(function(){  $("#alert").fadeOut(); }, 2000);
        function edit_subcategory(sub_category_id) {



            $.ajax({
                url: "{{ route('admin.edit-sub-category') }}",
                method: 'get',
                data: {
                    'subcategory_id':sub_category_id

                },
                success: function(result){

                    $("#sub_category_id").val(result.id);
                    $("#category_id_u").html(result.categories);
                    $("#category_id_u").val(result.category_id);

                    $("#department_id_u").val(result.department_id);
                    $("#name").val(result.name);
                    $("#status").val(result.status);

                }});


        }
    </script>

@endsection
