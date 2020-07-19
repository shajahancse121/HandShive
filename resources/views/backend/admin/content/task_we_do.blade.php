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
                    <button class="btn btn-outline-primary mb-2 ml-4 float-right"  data-toggle="modal" data-target="#exampleModal">Add Task</button>


                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('save.courier')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content" style="width: 500px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Task We Do</h5>

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
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Add Task</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">

                                               <div class="field_wrapper_1 row" style="width:100%;margin-left: 0px;max-height:400px;overflow-y: auto;">
                                                   <input type="text" name ="tag[]"  class="form-control col-md-4" placeholder="Enter Tag">
                                                   <input type="text" name="tag_url[]" class="form-control  col-md-6" placeholder="Enter Hyper Link">
                                                   <label class="col-md-1 text-left">
                                                       <a href="javascript:void(0);" class="add_button_1" title="Add more"><i class="ion-plus-circled" style="font-size: 20px;"></i></a>

                                                   </label>
                                               </div>

                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                 
                                                    <label for="fullName" class="col-md-6">Add icon</label>
                                                    <div class="col-md-6">

                                                        <a href="javascript:void(0);" class="add_button btn btn-primary text-bold" title="Add field"><i class="ion-image" style="font-size: 18px"></i> ADD</a>


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
                        <form action="{{route('admin.edit-task')}}" method="post">
                            @csrf
                            <div class="modal-content" style="width: 500px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Task We Do</h5>

                                </div>
                                <div class="modal-body">

                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Select Department</label>
                                        <div class="col-xl-7 col-lg-7 col-sm-6">
                                            <select name="department_id" required  style="font-size: 14px"  class="form-control" id="department_id" >
                                                <option value="">Choose...</option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Status</label>
                                        <div class="col-xl-7 col-lg-7 col-sm-6">
                                            <select style="font-size: 14px"  class="form-control" name="status" id="status" required>
                                                <option value="">Choose...</option>
                                                <option value="1">Published</option>
                                                <option value="0">Unpublished</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-4">
                                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-3 col-form-label">Add Task</label>
                                        <div class="col-xl-9 col-lg-9 col-sm-9">

                                               <div class="field_wrapper_1 row" style="width:100%;margin-left: 0px;max-height:400px;overflow-y: auto;">
                                                   <input type="text" name ="tag[]"  class="form-control col-md-4" placeholder="Enter Tag">
                                                   <input type="text" name="tag_url[]" class="form-control  col-md-6" placeholder="Enter Hyper Link">
                                                   <label class="col-md-1 text-left">
                                                       <a href="javascript:void(0);" class="add_button_1" title="Add more"><i class="ion-plus-circled" style="font-size: 20px;"></i></a>

                                                   </label>
                                               </div>

                                        </div>
                                    </div>

                                    <div class="form-row">

                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="row">
                                                  
                                                    <div class="col-md-12" style="margin-bottom: 20px">
                                                        <button type="button" data-toggle="collapse" class="btn btn-outline-primary btn-sm col-md-4 offset-4" data-target="#demo1">Previous icon</button>

                                                            <div id="demo1" class="collapse">
                                                               <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="media" style="border: #ffffff">
                                                                        <img src="https://via.placeholder.com/40" alt="John Doe" class="rounded-circle" style="width:40px;">
                                                                        <div class="media-body">
                                                                            <div class="custom-control custom-checkbox">
                                                                                <input type="checkbox" name="previous_image[]" value="1"  class="custom-control-input" id="customCheckProduct1">
                                                                                <label class="custom-control-label" for="customCheckProduct1" style="color: #1212f1;font-size:12px">Delete</label>
                                                                            </div>
                                                                        </div>
                                                                      </div>
                                                                   </div>
                                                                
                                                               </div>
                                                            </div>
                                                     </div>
                                                    
                                                    <label for="fullName" class="col-md-6">Add icon</label>
                                                    <div class="col-md-6">

                                                        <a href="javascript:void(0);" class="add_button btn btn-primary text-bold" title="Add field"><i class="ion-image" style="font-size: 18px"></i> ADD</a>


                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="field_wrapper" style="width:100%;" >

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

                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center">Department</th>
                            <th class="text-center" width="285px">Task</th>
                            <th class="text-center" style="width: 122px">Icon</th>

                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($task_we_do))

                        @foreach($task_we_do as $item)

                            <tr>
                                <td class="text-center">{{$item->department->name}}</td>
                                <td class="text-center">
                                    @foreach(json_decode($item->tag_url) as $value)

                                   <a href="{{$value->url}}" target="_blank"> <span class="badge badge-primary"> {{$value->tag}} </span></a>
                                @endforeach
                                </td>
                                <td>
                                    @foreach(json_decode($item->icon) as $value)
                                    <img src="{{asset('upload/task_icon/'.$value)}}" width="50px">

                                 @endforeach
                                </td>
                                

                                <td class="text-center">
                                    <div class="t-dot {{$item->status==1?'bg-primary':'bg-danger'}}" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{$item->status==1?'Active':'Inactive'}}"></div>
                                </td>
                                <td class="text-center"> <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_task('{{$item->id}}');"><i class="far fa-edit"></i> Edit</button> </td>
                            </tr>

                        @endforeach

                            @endif



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

{{--    <script src="{{ asset('backend/plugins/table/datatable/datatables.js')}}"></script>--}}

{{--    <script>--}}
{{--        $(document).ready(function() {--}}
{{--            $('table.multi-table').DataTable({--}}
{{--                "oLanguage": {--}}
{{--                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },--}}
{{--                    "sInfo": "Showing page _PAGE_ of _PAGES_",--}}
{{--                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',--}}
{{--                    "sSearchPlaceholder": "Search...",--}}
{{--                    "sLengthMenu": "Results :  _MENU_",--}}
{{--                },--}}
{{--                "stripeClasses": [],--}}
{{--                "lengthMenu": [7, 10, 20, 50],--}}
{{--                "pageLength": 7,--}}
{{--                drawCallback: function () {--}}
{{--                    $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })--}}
{{--                    $('.dataTables_wrapper table').removeClass('table-striped');--}}
{{--                }--}}
{{--            });--}}
{{--        } );--}}


{{--    </script>--}}

{{--    <script>--}}
{{--        setTimeout(function(){  $("#alert").fadeOut(); }, 2000);--}}
{{--        function edit_courier(courier_id) {--}}



{{--            $.ajax({--}}
{{--                url: "{{ route('admin.edit-courier') }}",--}}
{{--                method: 'get',--}}
{{--                data: {--}}
{{--                    'courier_id':courier_id--}}

{{--                },--}}
{{--                success: function(result){--}}

{{--                    $("#courier_id").val(courier_id);--}}
{{--                    $("#name").val(result.name);--}}
{{--                    $("#status").val(result.status);--}}

{{--                }});--}}


{{--        }--}}
{{--    </script>--}}

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
            var fieldHTML = '<div style="margin-top: 10px;float: left" class="col-md-6"><input type="file"  name="icon[]" accept="image/*" onchange="loadFile(event)" class="col-md-10 form-control"   required style="display: inline-block !important;"/><a href="javascript:void(0);" class="remove_button col-md-2" style="padding-right: 0px;float: right"><i class="far fa-trash-alt" style="font-size: 17px"></i></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x <= maxField){
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



            /////////////////////////////

            var maxField1 = 50; //Input fields increment limitation
            var addButton1 = $('.add_button_1'); //Add button selector
            var wrapper1 = $('.field_wrapper_1'); //Input field wrapper
            var fieldHTML1 = '<div style="margin-top: 10px;margin-left: 0px !important;" class="row"> <input type="text" class="form-control col-md-4" placeholder="Enter Tag" name="tag[]"> <input type="text" name="tag_url[]" class="form-control  col-md-6" placeholder="Enter Hyper Link">  <label class="col-md-1 text-left">\n' +
                '                                                   <a href="javascript:void(0);" class="remove_button" title="Add field"><i class="ion-minus-circled" style="font-size: 20px;"></i></a>\n' +
                '\n' +
                '                                               </label></div>'; //New input field html
            var x1 = 1; //Initial field counter is 1


            //Once add button is clicked
            $(addButton1).click(function(){
                //alert('test');
                //Check maximum number of input fields
                if(x1 < maxField1){
                    x1++; //Increment field counter
                    $(wrapper1).append(fieldHTML1); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper1).on('click', '.remove_button', function(e){

                e.preventDefault();
                $(this).parent('label').parent('div').remove(); //Remove field html
                x1--; //Decrement field counter
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
        function edit_task(task_id) {

           $.ajax({
                url: "{{ route('admin.edit-task') }}",
              method: 'get',
              data: {
                   'task_id':task_id

               },
              success: function(result){

                  //$("#courier_id").val(courier_id);
                  $('.field_wrapper_1').prepend(result.tag_url);
                   $("#department_id").val(result.department_id);
                   $("#status").val(result.status);

                }
                });


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
