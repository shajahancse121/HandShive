<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>BonajiShop | Organic Food In Bangladesh </title>
    <meta name="description" content="">
    <meta name="csrf-token" content="{{csrf_token()}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/assets/img/favicon.ico')}}">
    <!-- CSS  -->
    <!--bootstrap min css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.min.css')}}">
    <!--owl carousel min css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/owl.carousel.min.css')}}">
    <!--slick min css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/slick.css')}}">

    <!--magnific popup min css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/magnific-popup.css')}}">
    <!--font awesome css-->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('frontend/assets/css/linearicons.css')}}">
    <!--animate css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/animate.css')}}">
    <!--jquery ui min css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/jquery-ui.min.css')}}">
    <!--slinky menu css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/slinky.menu.css')}}">
    <!--plugins css-->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">

    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

    <link rel="stylesheet" href="{{asset('frontend/assets/css/cart.css')}}">
    <!--modernizr min js here-->
    <script src="{{asset('frontend/assets/js/vendor/modernizr-3.7.1.min.js')}}"></script>
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('frontend/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('frontend/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('frontend/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('frontend/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('frontend/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('frontend/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('frontend/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('frontend/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('frontend/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('frontend/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('frontend/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('frontend/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('frontend/favicon-16x16.png')}}">
    <style>
        .clear{
            clear:both;
            margin-top: 20px;
        }

        #searchResult{
            list-style: none;
            padding: 0px;
            width: 250px;
            position: absolute;
            margin: 0;
        }

        #searchResult li{
            background: white;
            padding: 4px;
            margin-bottom: 1px;
        }

        #searchResult li:nth-child(even){
            background: white;
            color: white;
        }

        #searchResult li:hover{
            cursor: pointer;
        }


        .dropdown-menu {
            position: absolute !important;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 476px;
            padding: 20px;
            margin-left: 20px;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: .25rem;
        }
        /*.categories_menu_toggle > ul > li ul.categories_mega_menu > li {*/
            /*padding: 0px;*/
            /*display: block;*/
        /*}*/
        @media (max-width: 700px) {
            .dropdown-menu {
                position: absolute !important;
                top: -27px;
                left: 0;
                z-index: 999;
                display: none;
                float: left;
                min-width: 0px;
                padding: 20px;
                margin-left: 20px;
                font-size: 1rem;
                color: #212529;
                text-align: left;
                list-style: none;
                background-color: #fff;
                background-clip: padding-box;
                border: 1px solid rgba(0, 0, 0, .15);
                border-radius: .25rem;
            }
        }
        .item_count_mini_mobile{


            line-height: 4px;
            margin-top: -17px;
            position: relative;
            top: -9px;
            left: -2px;
        }
        .header_account_list span.item_count_mini {
            margin-left: 5px;
            width: 18px;
            height: 18px;
            line-height: 18px;
            background: #e6e6e6;
            color: #222222;
            border-radius: 100%;
            text-align: center;
            font-weight: 400;
            font-size: 12px;
            display: inline-block;
        }
        .btn .badge {
            position: relative;
            top: -12px;
            border: 1px solid white;
            border-radius: 50%;
        }
        .breadcrumbs_area {
            background: url({{asset('frontend/assets/img/bg/banner18.jpg')}}) no-repeat 0 0;
            background-size: cover;
            height: 200px;
            display: flex;
            align-items: center;
        }

    .categories_title h2::before {
        content: "\f0c9";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
            }

    .categories_title h2::after {
        content: "\f107";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        }



        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #40a944;
            border-color: #40a944;
        }
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #40a944;
            border-color: #40a944;
        }
        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #40a944 !important;
            border-color: #40a944 !important;
        }
        #scrollUp {
            display: none;
        }

        .btn-primary {
            color: #fff;
            background-color: #40a944;
            border:0px
        }


    </style>

    @yield('style')

</head>

<body>
<!--header area start-->
<!--offcanvas menu area start-->
<div class="off_canvars_overlay">
</div>
@include('Frontend.header')
<!--header area end-->

<!--brand area start-->
@yield('content')
<!--brand area end-->
<!--footer area start-->
@include('Frontend.footer')

<footer class="footer_widgets">
    <div class="footer_top d-md-none collapse hide" id="demo"  style="position: fixed;bottom:66px;z-index: 99;width: 100%;background-color: white;height: 100%">

        <div class="row">
            <h3 class="bg-success col-md-12" style="padding-top: 5px;color:white;padding-left: 10px;padding-bottom: 5px">
                Your Cart  <a  id="close_btn"><span class="badge badge-light pull-right" style="margin-right: 20px"><i class="ion-android-cancel"></i></span></a>
            </h3>
            <div class="col-md-12">


                <div class="item-box1" style="max-height:500px;overflow-y:scroll ">

                </div>
            </div>
        </div>

    </div>
    <div class="footer_bottom d-md-none" style="position: fixed;bottom:0px;z-index: 99;width: 100%;padding:13px 0 12px">
        <div class="container">
            <div class="row">
                <div   style="width: 2%;height: 43px;background-color: #40A944;">
                </div>
                <div style="width: 14%;">

                    <div class="canvas_open bg-success">
                        <a href="javascript:void(0)"><i class="icon-menu"></i></a>
                    </div>

                </div>
                <div   style="width: 2%;height: 43px;background-color: #40A944;">
                </div>
                <div   style="width: 30%;height: 43px;background-color: #25710f;">
                    <a  href="{{route('cart')}}" class="btn btn-success" style="font-size: 15px;background-color: #1a732e;color: white;width:100%;height: 100%;border: 0px;padding: 6px">ORDER NOW</a>
                </div>
                <div   style="width: 2%;height: 43px;background-color: #40A944;">
                </div>
                <div  style="width: 50%;height: 43px;">
                    <a href="#demo" data-toggle="collapse" class="btn btn-success" style="font-size: 1.25rem;background-color: #1a732e;color: white"><i class="lnr lnr-cart"></i><span class="item_count_mini item_count_mini_mobile badge badge-light"></span></a>
                </div>

            </div>
        </div>
    </div>
</footer>
<!--footer area end-->
<!-- modal area start-->
<!-- modal area end-->
<!-- JS

============================================ -->

<!--------- Start Cart Aside --------->
<aside class="cart-sidebar  d-none d-md-block">
    <div class="sidebar-content">
        <div class="sidebar-content-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="p-3 text-white">
                        <h3 class="d-inline bag-text"><i class="fa fa-shopping-bag"></i> Your Bag</h3>
                        <p class="d-inline price-close" >৳ <span class="price_mini1">{{\Cart::subtotal()}}</span> <i class="ion-android-cancel"></i></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="cart-added-container">
            <div class="row">
                <div class="col-md-12">
                    <div class="item-box">

                    </div>
                </div>
            </div>
        </div>
        <div class="checkout-box p-3">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('cart')}}" class="btn btn-success btn-block btn-lg"><i class="fa fa-shopping-cart"></i> ORDER NOW</a>
                </div>
            </div>
        </div>
    </div>

    <div class="cart-btn" id="show_cart_button">
        <!-- <div class="cart-btn_open"> -->
        <div class="top">
            <i class="lnr lnr-cart" style="font-size:24px"></i> <br />
            <span><span class="item_count_mini" style="font-weight: bold">{{\Cart::content()->count()}}</span> Item</span>
        </div>
        <div class="bottom">
            <span>৳ <span class="price_mini1" >{{\Cart::subtotal()}}</span></span>
        </div>
    </div>
    <div class="close-btn">
        <!-- <div class="cart-btn_open"> -->
        <div class="close-arrow-btn">
            <i class="ion-android-arrow-dropright"></i>
        </div>
    </div>

</aside>
<!--------- End Cart Aside --------->
<!--jquery min js-->
<script src="{{asset('frontend/assets/js/vendor/jquery-3.4.1.min.js')}}"></script>
<!--popper min js-->
<script src="{{asset('frontend/assets/js/popper.js')}}"></script>
<!--bootstrap min js-->
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<!--owl carousel min js-->
<script src="{{asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
<!--slick min js-->
<script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
<!--magnific popup min js-->
<script src="{{asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
<!--counterup min js-->
<script src="{{asset('frontend/assets/js/jquery.counterup.min.js')}}"></script>
<!--jquery countdown min js-->
<script src="{{asset('frontend/assets/js/jquery.countdown.js')}}"></script>
<!--jquery ui min js-->
<script src="{{asset('frontend/assets/js/jquery.ui.js')}}"></script>
<!--jquery elevatezoom min js-->
<script src="{{asset('frontend/assets/js/jquery.elevatezoom.js')}}"></script>
<!--isotope packaged min js-->
<script src="{{asset('frontend/assets/js/isotope.pkgd.min.js')}}"></script>
<!--slinky menu js-->
<script src="{{asset('frontend/assets/js/slinky.menu.js')}}"></script>
<!-- Plugins JS -->
<script src="{{asset('frontend/assets/js/plugins.js')}}"></script>
<!-- Main JS -->
<script src="{{asset('frontend/assets/js/main.js')}}"></script>
<script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>


<script>

    (function ($) {
        "use strict";

        $( '.cart-btn' ).click( function() {
            $( '.cart-sidebar' ).addClass( 'is-vissible' );
        } );

        $( '.close-btn' ).click( function() {
            $( '.cart-sidebar' ).removeClass( 'is-vissible' );
        } );

        $( '.sidebar-content-header' ).click( function() {
            $( '.cart-sidebar' ).removeClass( 'is-vissible' );
        } );

    })(jQuery);

    $(document).ready(function(){


        $("#close_btn").click(function(){
            $("#demo").collapse('hide');
        });

        $.ajax({
            url: "{{ route('add-to-cart-full') }}",
            method: 'get',
            data: {

            },
            success: function(result){


                $('.item-box').html(result.content);
                $('.item-box1').html(result.content1);

                $('#cart_view1').html(result.cart_view1);
                $('.price_mini1').html(result.price_mini1);
                $('.price_mini2').html(result.price_mini2);
                $('.item_count_mini').html(result.item_count_mini);


            }});
    });
    function add_to_cart(product_id) {



        $.ajax({
            url: "{{ route('add-to-cart') }}",
            method: 'get',
            data: {
                'product_id':product_id

            },
            success: function(result){
                if(result.stock==1){

                    swal({
                        title: " Added To Cart",

                        text: "<img src='" + result.pro_image + "' style='width:150px;'><br>"+result.name+"("+result.weight+result.unit_name+")<br>Price : "+result.price+" TK.",
                        html: true,
                        showCancelButton: false,
                        type: "success",
                        timer: 3000,
                        closeOnConfirm: true,
                        closeOnCancel: true
                    });



                    $('.item-box').html(result.content);
                    $('.item-box1').html(result.content1);
                    $('#cart_view1').html(result.cart_view1);
                    $('.price_mini1').html(result.price_mini1);
                    $('.price_mini2').html(result.price_mini2);
                    $('.item_count_mini').html(result.item_count_mini);
                }
                else{
                    swal("Cancelled", "Item out of stock", "error");
                }

            }
        });



    }
    function delete_product(pro_id) {



        $.ajax({
            url: "{{ route('delete-to-cart') }}",
            method: 'get',
            data: {
                'pro_id':pro_id

            },
            success: function(result){


                $('.item-box').html(result.content);
                $('.item-box1').html(result.content1);


                $('#cart_view1').html(result.cart_view1);
                $('.price_mini1').html(result.price_mini1);
                $('.price_mini2').html(result.price_mini2);
                $('.item_count_mini').html(result.item_count_mini);


            }});
    }
    function update_cart_qty(pro_id) {


        $.ajax({
            url: "{{ route('update-cart-qty') }}",
            method: 'get',
            data: {

                'pro_id':pro_id,

            },
            success: function(result){


                $('.item-box').html(result.content);
                $('.item-box1').html(result.content1);


                $('#cart_view1').html(result.cart_view1);
                $('.price_mini1').html(result.price_mini1);
                $('.price_mini2').html(result.price_mini2);
                $('.item_count_mini').html(result.item_count_mini);



            }});


    }
    function delete_cart_qty(pro_id) {


        $.ajax({
            url: "{{ route('delete-cart-qty') }}",
            method: 'get',
            data: {

                'pro_id':pro_id,

            },
            success: function(result){


                $('.item-box').html(result.content);
                $('.item-box1').html(result.content1);


                $('#cart_view1').html(result.cart_view1);
                $('.price_mini1').html(result.price_mini1);
                $('.price_mini2').html(result.price_mini2);
                $('.item_count_mini').html(result.item_count_mini);



            }});


    }

    {{--$(document).ready(function(){--}}
        {{--$.ajax({--}}
            {{--url: "{{ route('add-to-cart-mini') }}",--}}
            {{--method: 'get',--}}
            {{--data: {--}}

            {{--},--}}
            {{--success: function(result){--}}
               {{--// alert(result);--}}


                {{--$('#cart_view1').html(result.content);--}}


            {{--}});--}}
    {{--});--}}
</script>
<script>


       function show_product(){


            var query = $('#country_name').val();
            if (query != '') {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('autocomplete.fetch') }}",
                    method: "POST",
                    data: {query: query, _token: _token},
                    success: function (data) {

                        $('#countryList').fadeIn();
                        $('#countryList').html(data);
                    }
                });
            }

           $(document).on('click', 'li', function(){
               $('#country_name').val($(this).text());
               $('#countryList').fadeOut();
           });
        }
       function show_product1(){


           var query = $('#country_name1').val();
           if (query != '') {
               var _token = $('input[name="_token"]').val();
               $.ajax({
                   url: "{{ route('autocomplete.fetch') }}",
                   method: "POST",
                   data: {query: query, _token: _token},
                   success: function (data) {

                       $('#countryList1').fadeIn();
                       $('#countryList1').html(data);
                   }
               });
           }

           $(document).on('click', 'li', function(){
               $('#country_name1').val($(this).text());
               $('#countryList1').fadeOut();
           });
       }


       function delete_product_mini(pro_id) {


           $.ajax({
               url: "{{ route('delete-to-cart-mini') }}",
               method: 'get',
               data: {
                   'pro_id':pro_id

               },
               success: function(result){


                   $('#cart_view1').html(result.content);
                   $('.price_mini1').html(result.price_mini1);
                   $('.price_mini2').html(result.price_mini2);
                   $('.item_count_mini').html(result.item_count_mini);


               }});
       }



</script>


@yield('script')

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5ef9ec9d9e5f694422918310/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>

</html>
