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
                    <h4 style="margin-left: 20px"><i class="ion-email"></i> Contact Message</h4>
                </div>


                <div class="table-responsive mb-4 mt-4">
                    <table class="multi-table table table-hover" style="width:100%">
                        <thead>
                        <tr>
                            <th class="text-center"  width="5%">SL</th>
                            <th class="text-center" width="10%">Name</th>
                            <th class="text-center" width="10%">Mobile</th>

                            <th class="text-center" width="15%">Subject</th>
                            <th class="text-center" width="15%">Date</th>
                            <th class="text-center" width="20%">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $sl = 1; ?>

                        @foreach($contacts as $contact)

                            <tr>
                                <td class="text-center">{{$sl++}}</td>
                                <td class="text-center"><i class="ion-ios-contact-outline"></i> {{$contact->name}}</td>
                                <td class="text-center">{{$contact->phone}}</td>

                                <td class="text-justify">{{$contact->subject}}</td>
                                <td class="text-center">{{date("d M,Y",strtotime($contact->created_at))}} <br>  <code style="color: grey">{{$contact->created_at->diffForHumans()}}</code></td>

                                <td class="text-center"> <a href="{{route('admin.delete-contact-message',['id'=>$contact->id])}}"><button class="btn btn-danger btn-sm"><i class="ion-ios-trash-outline" style="font-size: 22px"></i></button></a>
                                    <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal_edit" onclick="view_contact_message({{$contact->id}});"><button class="btn btn-primary btn-sm"><i class="ion-email-unread" style="font-size: 22px"></i></button></a>
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

    <div class="modal fade" id="exampleModal_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><i class="ion-email-unread" style="font-size: 20px"></i> Contact Message</h5>
                        <input type="hidden" name="blog_category_id" id="blog_category_id">
                    </div>
                    <div class="modal-body">
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Name</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="text" required name="name" id="name" class="form-control" readonly  placeholder="Enter Blog Category Name">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Email</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="text" required name="email" id="email" class="form-control" readonly  placeholder="No Email Found">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Phone</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="text" required name="phone" id="phone" class="form-control" readonly  placeholder="No Phone Number Found">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Subject</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <input type="text" required name="subject" id="subject" class="form-control" readonly  placeholder="Enter Blog Category Name">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Message</label>
                            <div class="col-xl-10 col-lg-9 col-sm-10">
                                <textarea class="form-control" id="message" rows="6px" name="message" readonly></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Discard</button>

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
        .form-control:disabled, .form-control[readonly] {
            background-color: #e9ecef;
            opacity: 1;
            color: #3b3f5c;
            cursor: pointer;
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

        function view_contact_message(contact_id) {

            $.ajax({
                url: "{{ route('admin.view-contact-message') }}",
                method: 'get',
                data: {
                    'contact_id':contact_id

                },
                success: function(result){



                    $("#phone").val(result.phone);
                    $("#name").val(result.name);
                    $("#email").val(result.email);
                    $("#subject").val(result.subject);
                    $("#message").val(result.message);


                }});
        }

    </script>

@endsection