<nav id="sidebar">
    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">
        @if(Auth::user()->role->id==2)
        <li class="menu">
            <a href="{{route('admin.dashboard')}}" data-active="true"  aria-expanded="true" class="dropdown-toggle">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span>Dashboard</span>
                </div>
                <div>
                </div>
            </a>

        </li>
        <?php
        $subMenu = [
            'admin.view-onetime-order',
            'admin.view-confirm-order',
            'admin.view-delivery-order',
            'admin.view-cancel-order',


        ];
        ?>
{{--        <li class="menu">--}}
{{--            <a href="#pages" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>--}}
{{--                    <span>OneTime Order</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="pages" data-parent="#accordionExample">--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.view-onetime-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.view-onetime-order')}}"> Pending Order </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.view-confirm-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.view-confirm-order')}}"> Confirm Order </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.view-delivery-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.view-delivery-order')}}"> Delivered Order </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.view-cancel-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.view-cancel-order')}}"> Cancel Order </a>--}}
{{--                </li>--}}


{{--            </ul>--}}
{{--        </li>--}}
        <?php
        $subMenu = [
            'admin.registered-pending-order',
            'admin.registered-confirm-order',
            'admin.registered-delivery-order',
            'admin.registered-cancel-order'



        ];
        ?>
{{--        <li class="menu">--}}
{{--            <a href="#elements" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>--}}
{{--                    <span>Register  Order</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled  {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="elements" data-parent="#accordionExample">--}}
{{--                <li  class="{{ (Route::currentRouteName() == 'admin.registered-pending-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.registered-pending-order')}}"> Pending Order </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.registered-confirm-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.registered-confirm-order')}}"> Confirm Order </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.registered-delivery-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.registered-delivery-order')}}"> Delivered Order </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.registered-cancel-order') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.registered-cancel-order')}}"> Cancel Order </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        @else
            <li class="menu">
                <a href="{{route('admin.dashboard')}}" data-active="true"  aria-expanded="true" class="dropdown-toggle">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span>Dashboard</span>
                    </div>
                    <div>
                    </div>
                </a>

            </li>
            <?php
            $subMenu = [
                'admin.view-onetime-order',
                'admin.view-confirm-order',
                'admin.view-delivery-order',
                'admin.view-cancel-order',


            ];
            ?>
{{--            <li class="menu">--}}
{{--                <a href="#pages" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>--}}
{{--                        <span>OneTime Order</span>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="pages" data-parent="#accordionExample">--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.view-onetime-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.view-onetime-order')}}"> Pending Order </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.view-confirm-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.view-confirm-order')}}"> Confirm Order </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.view-delivery-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.view-delivery-order')}}"> Delivered Order </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.view-cancel-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.view-cancel-order')}}"> Cancel Order </a>--}}
{{--                    </li>--}}


{{--                </ul>--}}
{{--            </li>--}}
            <?php
            $subMenu = [
                'admin.registered-pending-order',
                'admin.registered-confirm-order',
                'admin.registered-delivery-order',
                'admin.registered-cancel-order'



            ];
            ?>
{{--            <li class="menu">--}}
{{--                <a href="#elements" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                    <div class="">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>--}}
{{--                        <span>Register  Order</span>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                    </div>--}}
{{--                </a>--}}
{{--                <ul class="collapse submenu list-unstyled  {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="elements" data-parent="#accordionExample">--}}
{{--                    <li  class="{{ (Route::currentRouteName() == 'admin.registered-pending-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.registered-pending-order')}}"> Pending Order </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.registered-confirm-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.registered-confirm-order')}}"> Confirm Order </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.registered-delivery-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.registered-delivery-order')}}"> Delivered Order </a>--}}
{{--                    </li>--}}
{{--                    <li class="{{ (Route::currentRouteName() == 'admin.registered-cancel-order') ? 'active' : '' }}">--}}
{{--                        <a href="{{route('admin.registered-cancel-order')}}"> Cancel Order </a>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </li>--}}

        <?php
        $subMenu = [
            'admin.sales-report',
            'admin.product-sale-report',
            'admin.cupon-report',
            'admin.contact-report',

        ];
        ?>
{{--        <li class="menu">--}}
{{--            <a style="height: 40px" href="#report" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <i class="ion-calculator" style="font-size: 24px;color: #393c6d;margin-right: 10px"></i>--}}
{{--                    <span>Reports</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="report" data-parent="#accordionExample">--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.sales-report') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.sales-report')}}"> Daily Sale Report </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.product-sale-report') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.product-sale-report')}}"> Product Sale Report </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.cupon-report') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.cupon-report')}}"> Cupon Report </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.contact-report') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.contact-report')}}">  Contact Report </a>--}}
{{--                </li>--}}



{{--            </ul>--}}
{{--        </li>--}}




    <?php
        $subMenu = [
            'admin.category',
            'admin.department',
            'admin.sub-category'

        ];
        ?>

        <li class="menu">
            <a href="#app"  data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    <span> Services</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="app" data-parent="#accordionExample">
                <li class="{{ (Route::currentRouteName() == 'admin.department') ? 'active' : '' }}">
                    <a href="{{route('admin.department')}}"> Department </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.category') ? 'active' : '' }}">
                    <a href="{{route('admin.category')}}"> Category </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.sub-category') ? 'active' : '' }}">
                    <a href="{{route('admin.sub-category')}}">Sub Category </a>
                </li>

            </ul>
        </li>

        <?php
        $subMenu = [
            'admin.add-product',
            'admin.view-all-product'


        ];
        ?>

{{--        <li class="menu">--}}
{{--            <a href="#components"  data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>--}}
{{--                    <span> Products</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="components" data-parent="#accordionExample">--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.add-product') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.add-product')}}"> Add Product </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.view-all-product') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.view-all-product')}}"> View All Product </a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li>--}}

        <?php
        $subMenu = [
            'admin.slider',
            'admin.blog',
            'admin.offer',
            'admin.contact-message',
            'admin.mission-vision',
            'admin.add-work-flow',
            'admin.customer-share',
            'admin.courier',

        ];
        ?>

        <li class="menu">
            <a href="#forms"  data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">
                <div class="">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    <span style="font-size: 12px"> Manage Department </span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="forms" data-parent="#accordionExample">
                <li class="{{ (Route::currentRouteName() == 'admin.slider') ? 'active' : '' }}">
                    <a href="{{route('admin.slider')}}">Department Slider </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.blog') ? 'active' : '' }}">
                    <a href="{{route('admin.blog')}}"> Why Choose Us   </a>
                </li>
{{--                <li class="{{ (Route::currentRouteName() == 'admin.support') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.support')}}"> Support Content </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.offer') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.offer')}}"> Offer </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.contact-message') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.contact-message')}}"> Contact Message </a>--}}
{{--                </li>--}}

{{--                <li class="{{ (Route::currentRouteName() == 'admin.mission-vision') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.mission-vision')}}"> AboutUs Content </a>--}}
{{--                </li>--}}

                <li class="{{ (Route::currentRouteName() == 'admin.add-work-flow') ? 'active' : '' }}">
                    <a href="{{route('admin.add-work-flow')}}"> Our Workflow </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.courier') ? 'active' : '' }}">
                    <a href="{{route('admin.courier')}}"> Task We Do </a>
                </li>

{{--                <li class="{{ (Route::currentRouteName() == 'admin.customer-share') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.customer-share')}}"> Customer Testimonial </a>--}}
{{--                </li>--}}


            </ul>
        </li>
{{--        <?php--}}
{{--        $subMenu = [--}}
{{--            'admin.shipping',--}}
{{--            'admin.courier'--}}

{{--        ];--}}
{{--        ?>--}}
{{--        <li class="menu">--}}
{{--            <a href="#datatables" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers"><polygon points="12 2 2 7 12 12 22 7 12 2"></polygon><polyline points="2 17 12 22 22 17"></polyline><polyline points="2 12 12 17 22 12"></polyline></svg>--}}
{{--                    <span>Shipping</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="datatables" data-parent="#accordionExample">--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.shipping') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.shipping')}}"> Shipping </a>--}}
{{--                </li>--}}
{{--               --}}

{{--            </ul>--}}
{{--        </li>--}}

        <?php
        $subMenu = [
            'admin.cupon',

        ];
        ?>

{{--        <li class="menu">--}}
{{--            <a href="#users" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>--}}
{{--                    <span>Manage Cupon</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="users" data-parent="#accordionExample">--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.cupon') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.cupon')}}"> Cupon   </a>--}}
{{--                </li>--}}

{{--            </ul>--}}
{{--        </li>--}}

        <?php
        $subMenu = [
            'admin.blog',
            'admin.blog-category',
            'admin.blog-comments'
            ];
        ?>

{{--        <li class="menu">--}}
{{--            <a href="#blog" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">--}}
{{--                <div class="">--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-target"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>--}}
{{--                    <span>Manage Blog</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>--}}
{{--                </div>--}}
{{--            </a>--}}
{{--            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="blog" data-parent="#accordionExample">--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.blog-category') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.blog-category')}}"> Category   </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.blog') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.blog')}}"> Blog   </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (Route::currentRouteName() == 'admin.blog-comments') ? 'active' : '' }}">--}}
{{--                    <a href="{{route('admin.blog-comments')}}"> Blog Comments  </a>--}}
{{--                </li>--}}


{{--            </ul>--}}
{{--        </li>--}}

        <?php
        $subMenu = [
            'admin.profile',
            'admin.view-user',

        ];
        ?>
        <li class="menu">
            <a style="height: 40px" href="#starter-kit" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">

                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-cpu"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                    <span> Settings</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="starter-kit" data-parent="#accordionExample">
                <li class="{{ (Route::currentRouteName() == 'admin.view-user') ? 'active' : '' }}">
                    <a href="{{route('admin.view-user')}}"> Users </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.profile') ? 'active' : '' }}">
                    <a href="{{route('admin.profile')}}"> HandsHive Profile </a>
                </li>


            </ul>
        </li>

        @endif

        <li class="menu">
        </li>
        <li class="menu">
        </li>






    </ul>
    <!-- <div class="shadow-bottom"></div> -->

</nav>
