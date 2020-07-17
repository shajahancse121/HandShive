<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use App\Order;
use App\CompanyProfile;
use App\User;
use Str;
use Auth;
class RegisteredOrderController extends Controller
{
    public function allPendingOrder()
    {
        $orders = Order::where('order_type',2)->where('order_status',1)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;

            return view('backend.admin.order.onetime-pending-order',$data);



    }

    public function allConfirmOrder()
    {
        $orders = Order::where('order_type',2)->where('order_status',2)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;


            return view('backend.admin.order.onetime-confirm-order',$data);


    }
    public function allDeliveryOrder()
    {
        $orders = Order::where('order_type',2)->where('order_status',3)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;

            return view('backend.admin.order.onetime-delivery-order',$data);


    }
    public function allCancelOrder()
    {
        $orders = Order::where('order_type',2)->where('order_status',4)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;

            return view('backend.admin.order.onetime-cancel-order',$data);


    }

}
