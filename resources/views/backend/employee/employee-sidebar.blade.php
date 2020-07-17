<nav id="sidebar">
    <div class="shadow-bottom"></div>
    <ul class="list-unstyled menu-categories" id="accordionExample">
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
        <li class="menu">
            <a href="#pages" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                    <span>OneTime Order</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="pages" data-parent="#accordionExample">
                <li class="{{ (Route::currentRouteName() == 'admin.view-onetime-order') ? 'active' : '' }}">
                    <a href="{{route('admin.view-onetime-order')}}"> Pending Order </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.view-confirm-order') ? 'active' : '' }}">
                    <a href="{{route('admin.view-confirm-order')}}"> Confirm Order </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.view-delivery-order') ? 'active' : '' }}">
                    <a href="{{route('admin.view-delivery-order')}}"> Delivered Order </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.view-cancel-order') ? 'active' : '' }}">
                    <a href="{{route('admin.view-cancel-order')}}"> Cancel Order </a>
                </li>


            </ul>
        </li>
        <?php
        $subMenu = [
            'admin.registered-pending-order',
            'admin.registered-confirm-order',
            'admin.registered-delivery-order',
            'admin.registered-cancel-order'



        ];
        ?>
        <li class="menu">
            <a href="#elements" data-active="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" data-toggle="collapse" aria-expanded="{{ in_array(Route::currentRouteName(), $subMenu) ? 'true' : 'false' }}" class="dropdown-toggle {{ in_array(Route::currentRouteName(), $subMenu) ? '' : 'collapse' }}">
                <div class="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-zap"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                    <span>Register  Order</span>
                </div>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </div>
            </a>
            <ul class="collapse submenu list-unstyled  {{ in_array(Route::currentRouteName(), $subMenu) ? 'show' : '' }}" id="elements" data-parent="#accordionExample">
                <li  class="{{ (Route::currentRouteName() == 'admin.registered-pending-order') ? 'active' : '' }}">
                    <a href="{{route('admin.registered-pending-order')}}"> Pending Order </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.registered-confirm-order') ? 'active' : '' }}">
                    <a href="{{route('admin.registered-confirm-order')}}"> Confirm Order </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.registered-delivery-order') ? 'active' : '' }}">
                    <a href="{{route('admin.registered-delivery-order')}}"> Delivered Order </a>
                </li>
                <li class="{{ (Route::currentRouteName() == 'admin.registered-cancel-order') ? 'active' : '' }}">
                    <a href="{{route('admin.registered-cancel-order')}}"> Cancel Order </a>
                </li>
            </ul>
        </li>


        <li class="menu">
        </li>
        <li class="menu">
        </li>






    </ul>
    <!-- <div class="shadow-bottom"></div> -->

</nav>