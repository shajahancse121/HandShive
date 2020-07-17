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
                <form class="select mt-4"  action="{{route('admin.save-support-service')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <label for="hPassword" class="col-xl-3 col-sm-3 col-sm-2 col-form-label">Select Department</label>
                        <div class="col-xl-7 col-lg-7 col-sm-6">
                            <select name="department_id" required id="department_id"   class="selectpicker" data-live-search="true">
                                <option value="">Choose...</option>
                                @foreach($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="form-row">

                           <label for="fullName" class="col-md-4">Add Support & Services Tag</label>
                           <div class="col-md-8">

                               <a href="javascript:void(0);" class="add_button btn btn-primary" title="Add field"><i class="far fa-edit" style="font-size: 20px"></i> Add Tag</a>
                           </div>

                        <div class="field_wrapper" style="width: 1000px">

                        </div>


                    </div>





                    <div class="form-row" style="margin-top: 20px">
                        <div class="col-md-12 mb-4">
                            <label for="fullName">Support & Services Description</label>
                            <textarea class="textarea" name="support_message" style="height: 400px;" required placeholder="Enter Support & Services Description"><i style="color: grey">Enter Support & Services Description</i></textarea>

                        </div>

                    </div>





                    <div class="form-row">
                        <div class="col-md-12">
                            <div id="select_menu" class="form-group mb-4">
                                <label for="fullName">Status</label>
                                <select class="custom-select" name="status" required>
                                    <option value="">Choose...</option>
                                    <option value="1">Published</option>
                                    <option value="0">Unpublished</option>

                                </select>

                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 offset-3 mt-5">
                            <button class="btn btn-primary mt-2 btn-block" type="submit">Save </button>
                        </div>
                    </div>
                </form>


            </div>
        </div>

    </div>

@endsection
@section('style')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/plugins/bootstrap-select/bootstrap-select.min.css')}}">
    <style>
        .form-group label, label {
            font-size: 15px;
            color: #64646f;
            letter-spacing: 1px;
        }

           .mce-notification-inner {display:none!important;}
        .mce-notification .mce-close{display:none!important;}

    </style>

@endsection
@section('script')


    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er"></script>
    <script>tinymce.init({ selector:'.textarea' });  </script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('backend/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div style="margin-top: 10px;float: left" class="col-md-4"><input type="text" class="col-md-10 form-control"   name="support_tag[]" placeholder="Enter  Tag" required style="display: inline-block !important;"/><a href="javascript:void(0);" class="remove_button col-md-1" style="padding-right: 0px;"><i class="far fa-trash-alt" style="font-size: 17px"></i></a></div>'; //New input field html
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


@endsection
