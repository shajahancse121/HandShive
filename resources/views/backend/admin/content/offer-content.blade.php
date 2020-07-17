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


                <div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{route('update.offer-content')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-content" style="width: 600px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Offer Content</h5>

                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="offer_id" id="offer_id">

                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label"> Hyper Link </label>
                                        <div class="col-xl-10 col-lg-9 col-sm-10">
                                            <input type="text"  name="url_link" id="url_link" class="form-control" id="title" placeholder="Enter URL Link">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-4">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="show_home" id="show_home" value="1" class="custom-control-input">
                                                <label class="custom-control-label" for="show_home">Show in Page</label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row mb-4">
                                        <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Upload Photo </label>
                                        <div class="col-md-10">
                                            <div class="field_wrapper">

                                                <label for="fullName">Image size:<code id="offer_image"> 540x190</code></label>
                                                <div>
                                                    <input type="file"  name="new_photo"  accept="image/*" onchange="loadFile1(event)"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8 offset-2">

                                            <img class="img-thumbnail img-fluid" src="{{asset('backend/no-image.png')}}" id="output_1">

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
                            <th class="text-center">Show</th>

                            <th class="text-center">Hyper Link</th>

                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($offers as $offer)

                            <tr>
                                <td class="text-center"><img src="{{asset($offer->image)}}" width="200" height="100"></td>
                                <td class="text-center"><span class="badge badge-{{$offer->show_home=='1'?'primary':'danger' }}"> {{$offer->show_home=='1'?'Show':'Hide' }} </span></td>

                                <td class="text-center">
                                    <a href="{{$offer->url_link?$offer->url_link:"#"}}" target="_blank"><span class="badge badge-{{$offer->url_link?'primary':'danger' }}"><i class="far fa-paper-plane"></i> {{$offer->url_link?' Enable':'Disable' }} </span></a></td>

                                <td class="text-center">

                                    <button class="btn btn-primary"  data-toggle="modal" data-target="#exampleModal_edit" onclick="edit_offer('{{$offer->id}}');"><i class="far fa-edit"></i> Edit</button>
                                </td>
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
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7,
                drawCallback: function () {
                    $('.t-dot').tooltip({ template: '<div class="tooltip status" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' })
                    $('.dataTables_wrapper table').removeClass('table-striped');
                }
            });
        } );


    </script>

    <script>
        setTimeout(function(){  $("#alert").fadeOut(); }, 2000);
        function edit_offer(offer_id) {

            $.ajax({
                url: "{{ route('admin.edit-offer') }}",
                method: 'get',
                data: {
                    'offer_id':offer_id

                },
                success: function(result){



                     if(result.show_home)
                     {

                         $( "#show_home" ).prop( "checked",true);
                     }
                     else{

                         $( "#show_home" ).prop( "checked",false);
                     }

                    $("#offer_id").val(offer_id);
                    $("#url_link").val(result.url_link);
                    if(offer_id==4)
                    {
                        $( "#offer_image" ).html("255x430");

                    }

                     $("#output_1").attr("src", '{{ URL::asset('/') }}'+result.image);


                }});


        }
    </script>
    <script>

        var loadFile1 = function(event) {
            var output = document.getElementById('output_1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };

    </script>

@endsection