<style>
    .logo img {
        max-width: 160px;
    }
</style>
<div class="offcanvas_menu">
    <div class="container">
        <div class="row">
            <div class="col-12">

                <div class="offcanvas_menu_wrapper">
                    <div class="canvas_close">
                        <a href="javascript:void(0)"><i class="icon-x"></i></a>
                    </div>

                    <div class="header_account_area">
                        <div class="header_account_list register">
                            <ul>
                                @if(Auth::guard('customer')->check())
                                    <li><a href="{{route('my-dashboard')}}">My Dashboard</a></li>
                                @else
                                    <li><a href="{{route('customer-register')}}">Register</a></li>
                                @endif


                                <li><span>|</span></li>
                                @if(Auth::guard('customer')->check())
                                 <li><a href="{{route('customer.logout')}}">Logout</a></li>
                                @else
                                    <li><a href="{{route('customer-login')}}">Login</a></li>
                                @endif
                            </ul>
                        </div>

                    </div>
                    <div class="call-support">
                        <p><a href="tel:+88{{$company->mobile}}"><strong>{{$company->mobile}}</strong></a> Customer Support</p>
                    </div>
                    <div id="menu" class="text-left ">
                        <ul class="offcanvas_main_menu">

                            <li class="menu-item-has-children"><a href="{{route('home')}}">Home</a></li>
                            <li class="menu-item-has-children"><a href="{{route('shop')}}">Products</a></li>
                            <li class="menu-item-has-children"><a href="{{route('blog')}}">blog</a></li>
                            <li class="menu-item-has-children"><a href="{{route('about-us')}}"> About Us</a></li>
                            <li class="menu-item-has-children"><a href="{{route('contact-us')}}"> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--offcanvas menu area end-->
<header>
    <div class="main_header">
        <!--             <div class="header_top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6">
                    </div>
                    <div class="col-lg-6">
                        <div class="header_social text-right">
                            <ul>
                                <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-youtube-outline"></i></a></li>
                                <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <div class="header_middle">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{route('home')}}"><img src="{{asset($company->logo?$company->logo:'frontend/logo_final.png')}}" alt=""></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="header_right_info">
                            <div class="search_container">
                                <form action="{{route('search-product-details')}}" method="post">

                                    <div class="search_box">

                                        <input placeholder="Search product..." type="text" onkeyup="show_product();" name="country_name" id="country_name" required autocomplete="off" style="font-weight: bold">


                                    {{ csrf_field() }}
                                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>

                                    </div>


                                </form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="countryList">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="header_account_area">
                                <div class="header_account_list register">
                                    <ul>
                                        @if(Auth::guard('customer')->check())
                                            <li><a href="{{route('my-dashboard')}}">My Dashboard</a></li>
                                        @else
                                            <li><a href="{{route('customer-register')}}">Register</a></li>
                                        @endif

                                        <li><span>|</span></li>
                                        @if(!Auth::guard('customer')->check())
                                            <li><a href="{{route('customer-login')}}">Login</a></li>
                                        @else
                                            <li><a href="{{route('customer.logout')}}">Logout</a></li>

                                        @endif
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header_bottom sticky-header">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="categories_menu d-none d-md-block">
                            <div class="categories_title">
                                <h2 class="categori_toggle">All Categories</h2>
                            </div>
                            <div class="categories_menu_toggle">
                                <ul><?php $sl=1; ?>
                                    @foreach($categories as $category)
                                        @if($category->sub_categories->count()>0)
                                            <li class="menu_item_children"><a href="javascript:void(0)"> {{$category->name}} <i class="fa fa-angle-right"></i></a>
                                                <ul class="categories_mega_menu column_<?php echo $sl++;?>">
                                                    @foreach($category->sub_categories as $sub_category)
                                                         @if($sub_category->status==1)
                                                            <li style="padding: 0px !important;"><a href="{{route('subcategory_product',['sub_cat_slug'=>$sub_category->slug])}}">{{$sub_category->name}}</a></li>
                                                         @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                       @else

                                         <li><a href="{{route('category_product',['slug'=>$category->slug])}}"> {{$category->name}}</a></li>
                                       @endif

                                    @endforeach

                                </ul>
                            </div>



                        </div>
                        <div class="categories_menu d-md-none">
                           <div class="row" style="width: 100%">
                               <div class="col-xs-4" style="width: 10%">
                               </div>

                                  <div class="col-xs-4" style="width: 20%">
                                      <div class="categories_title categori_toggle" style="padding-top:5px;color:white;height: 36px;border-radius: 30px 0px 0px 30px">
                                          <span class="ion-android-menu" style="font-size: 22px"></span>
                                      </div>
                                  </div>

                                  <div class="col-xs-8" style="width: 70%">
                                       <div class="search_container" style="display:block;height: 36px">
                                          <form action="{{route('search-product-details')}}" method="post">
                                              {{csrf_field()}}

                                              <div class="search_box" style="border-radius: 0px">
                                                  <input placeholder="Search product..." type="text" onkeyup="show_product1();" style="font-weight: bold" name="country_name" id="country_name1" required autocomplete="off">
                                                  <button type="submit"><i class="lnr lnr-magnifier" aria-hidden="true"></i></button>
                                              </div>
                                          </form>
                                          <div class="row">
                                              <div class="col-md-12">
                                                  <div id="countryList1">
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                           </div>
                            <div class="categories_menu_toggle">
                                <ul><?php $sl=1; ?>
                                    @foreach($categories as $category)
                                        @if($category->sub_categories->count()>0)
                                            <li class="menu_item_children"><a href="javascript:void(0)"> {{$category->name}} <i class="fa fa-angle-right"></i></a>
                                                <ul class="categories_mega_menu column_<?php echo $sl++;?>">
                                                    @foreach($category->sub_categories as $sub_category)
                                                        @if($sub_category->status==1)
                                                            <li style="padding: 0px !important;"><a href="{{route('subcategory_product',['sub_cat_slug'=>$sub_category->slug])}}">{{$sub_category->name}}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else

                                            <li><a href="{{route('category_product',['slug'=>$category->slug])}}"> {{$category->name}}</a></li>
                                        @endif

                                    @endforeach

                                </ul>
                            </div>



                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!--main menu start-->
                        <div class="main_menu menu_position">
                            <nav>
                                <ul>
                                    <li><a class="active" href="{{route('home')}}">home</a></li>
                                    <li class="mega_items"><a href="{{route('shop')}}">Products</a></li>
                                    <li><a href="{{route('blog')}}">blog</a></li>
                                    <li><a href="{{route('about-us')}}"> About Us</a></li>
                                    <li><a href="{{route('contact-us')}}"> Contact Us</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!--main menu end-->
                    </div>
                    <div class="col-lg-3">
                        <div class="call-support">
                            <p><a href="tel:{{$company->mobile}}" style="text-align: left"><strong>{{$company->mobile}}</strong></a> <span style="color: #0ba360">Customer Support</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
