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
                <form class="select mt-4"  action="{{route('admin.add-product')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="col-md-4 mb-4">
                            <label for="fullName">Product Name</label>
                            <input type="text"  name="name" class="form-control" id="fullName" placeholder="Enter Product Name" value="" required>

                        </div>
                        <div class="col-md-2 mb-4">
                            <label for="fullName">Price</label>
                            <input type="text" name="price" class="form-control" id="fullName" placeholder="Sales Rate" value="" required>

                        </div>
                        <div class="col-md-3">
                            <div id="select_menu" class="form-group mb-4">
                                <label for="fullName">Unit</label>
                                <select class="custom-select" onchange="confirm_unit();" name="unit_id" id="unit_id" required>
                                    <option value="">Choose....</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="fullName" id="unit_confirm">Weight</label>
                            <input type="text" name="weight" class="form-control" id="weight" placeholder="Product Weight" value="" required>

                        </div>


                    </div>
                    <div class="form-row">
                        <div class="col-md-3">
                            <div id="select_menu" class="form-group mb-4">
                                <label for="fullName">Category</label>
                                <select class="custom-select" name="category_id" required onchange="get_sub_category(this.value);">
                                    <option value="">Choose....</option>
                                  @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                      @endforeach

                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="select_menu" class="form-group mb-4">
                                <label for="fullName">Sub Category</label>
                                <select name="sub_category_id" id="sub_category_id" class="custom-select">
                                    <option value="">Choose....</option>


                                </select>

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div id="select_menu" class="form-group mb-4">
                                <label for="fullName">Discount Type</label>
                                <select class="custom-select" name="discount_type">
                                    <option value="">Choose...</option>
                                    <option value="1">(%) Parcent Discount</option>
                                    <option value="2">(Tk) Flat Discount</option>

                                </select>

                            </div>
                        </div>
                        <div class="col-md-3 mb-4">
                            <label for="fullName">Amount</label>
                            <input type="text" name="discount" class="form-control" id="fullName" placeholder="Enter  Amount" value="" >

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-2 mb-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" name="stock" value="1" checked="" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline1">In Stock</label>
                            </div>
                        </div>
                         <div class="col-md-2 mb-4">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" name="stock" value="0" class="custom-control-input">
                                <label class="custom-control-label" for="customRadioInline2">Out of Stock</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="new_product" value="1" class="custom-control-input" id="customCheck1">
                                <label class="custom-control-label" for="customCheck1">New Product</label>
                            </div>
                        </div>
                        <div class="col-md-2 mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="popular_product"value="1" class="custom-control-input" id="customCheck2">
                                <label class="custom-control-label" for="customCheck2">Popular Product</label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="best_seller" value="1" class="custom-control-input" id="customCheck3">
                                <label class="custom-control-label" for="customCheck3">Best Seller  Product</label>
                            </div>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="fullName">Product Short Description</label>
                            <textarea class="textarea" name="short_description" style="height: 200px;" required>Product Short Descriptions</textarea>

                        </div>

                    </div>
                    <div class="form-row">
                        <div class="col-md-12 mb-4">
                            <label for="fullName">Product Long Description</label>
                            <textarea class="textarea" name="long_description" style="height: 400px;" required>Product Long Descriptions</textarea>

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
                        <div class="col-md-6">
                            <div class="field_wrapper">
                                <label for="fullName">Image size:<code> 600x600</code></label>
                                <div>

                                    <input type="file"  name="field_name[]" required accept="image/*" onchange="loadFile(event)" class="col-md-8" value=""/>
                                    <a href="javascript:void(0);" class="add_button col-md-4" title="Add field"><i class="far fa-edit" style="font-size: 20px"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">

                                <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output" width="173" height="173" >

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
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML = '<div style="margin-top: 10px"><input type="file" class="col-md-8" accept="image/*" onchange="loadFile(event)" name="field_name[]" required value=""/><a href="javascript:void(0);" class="remove_button col-md-4"><i class="far fa-trash-alt" style="font-size: 17px"></i></a></div>'; //New input field html
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
    <script>
        var loadFile = function(event) {
            var output = document.getElementById('output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
    </script>
    <script>
        function get_sub_category(category_id) {

            $.ajax({
                url: "{{ route('admin.get-sub-category') }}",
                method: 'get',
                data: {
                    'category_id':category_id

                },
                success: function(result){



                    $("#sub_category_id").html(result.sub_category_id);


                }});
        }
        function confirm_unit() {
          var unit_id = $('#unit_id').val();
          if(unit_id==5){
              $('#unit_confirm').html("Qty");
              $('#weight').attr("placeholder", "Product Quantity");
          }else{
              $('#unit_confirm').html("Weight");
              $('#weight').attr("placeholder", "Product Weight");
          }
        }
    </script>

@endsection
