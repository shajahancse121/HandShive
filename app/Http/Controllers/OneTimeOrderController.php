<?php

namespace App\Http\Controllers;

use App\Blling;
use App\Courier;
use App\Order;
use App\OrderDetail;
use App\OtherShipping;
use App\PaymentType;
use App\Product;
use App\Shipping;
use App\Unit;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmMail;
class OneTimeOrderController extends Controller
{
    //
    public function oneTimeOrderConfirm($order_id)
    {

        $order = Order::find($order_id);

        $shipping = Shipping::all();
        $payment_types = PaymentType::all();
        $couriers = Courier::all();

        $data = [];
        $data ['order'] = $order;
        $data ['shipping'] = $shipping;
        $data ['payment_types'] = $payment_types;
        $data ['couriers'] = $couriers;
        $data['products'] = Product::all();
        $data['units'] = Unit::all();


            return view('backend.admin.order.onetime-order-confirm',$data);




    }
    public function  onetimeOrderShipping(Request $request)
    {
        $order = Order::find($request->order_id);
        $shipping = Shipping::find($request->shipping_id);

        $order->shipping_id = $request->shipping_id;
        $order->shipping_amount = $request->shipping_amount;
        $order->shipping_title = $shipping->title;
        $order->save();


        $request->session()->flash('success','Shipping Applied  Successfully!');



        return redirect()->route('onetime-order-confirm',['id'=>$request->order_id]);


    }
    public function  onetimeOrderConfirmUpdateAddress($order_id,Request $request)
    {
        $order = Order::find($order_id);

        $billing = Blling::find($order->blling_id);
        $billing->name = $request->name;
        $billing->email = $request->email;
        $billing->mobile = $request->mobile;
        $billing->address = $request->address;
        $billing->save();
        if(isset($order->other_shipping_id)){
            $shipping = OtherShipping::find($order->other_shipping_id);
            $shipping->name = $request->other_name;
            $shipping->email = $request->other_email;
            $shipping->mobile = $request->other_mobile;
            $shipping->address = $request->other_address;
            $shipping->save();
        }


        $request->session()->flash('success','Billing & Shipping Update Successfully!');


        return redirect()->route('onetime-order-confirm',['id'=>$order_id]);
    }
    public function  onetimeOrderConfirmUpdateProduct($order_id,Request $request)
    {
            $order = Order::find($order_id);



            $details = new OrderDetail();
            $details->order_id = $order_id;
            $details->product_id = $request->product_id;
            $details->qty = $request->qty;
            $details->weight = $request->weight;
            $details->unit_id = $request->unit_id;
            $details->sales_rate = $request->sales_rate-$request->discount_amount;
            $details->discount_amount = $request->discount_amount;
            $details->order_date = date("Y-m-d",strtotime($order->order_date));
            $details->order_status = $order->order_status;
            $details->order_type =$order->order_type;

            $details->save();


        if($order)
        {
            $order = Order::find($order_id);
            $order->total_amount = $order->total_amount+($details->sales_rate* $details->qty);
            $order->total_discount_product = $order->total_discount_product + ($details->discount_amount* $details->qty);
            $order->save();
        }


            $request->session()->flash('success','Item Add Successfully!');


        return redirect()->route('onetime-order-confirm',['id'=>$order_id]);
    }
    public function  onetimeOrderConfirmUpdate($order_id,$detail_id,Request $request)
    {
       // echo $order_id.$detail_id.$request->input('qty_'.$detail_id);

       if($request->action_btn=='update'){



           $details  = OrderDetail::where('order_id',$order_id)->where('id',$detail_id)->first();
           if($details)
           {
               $order = Order::find($order_id);
               $order->total_amount = $order->total_amount-($details->sales_rate* $details->qty);
               $order->total_discount_product = $order->total_discount_product - ($details->discount_amount* $details->qty);
               $order->save();
           }

           $details->qty = $request->input('qty_'.$detail_id);
           $details->sales_rate = $request->input('rate_'.$detail_id)-$request->input('discount_'.$detail_id);
           $details->discount_amount = $request->input('discount_'.$detail_id);
           $details->save();
           if($details){

               $order = Order::find($order_id);
               $order->total_amount = $order->total_amount+($details->sales_rate* $details->qty);
               $order->total_discount_product = $order->total_discount_product + ($details->discount_amount* $details->qty);
               $order->save();
           }




           $request->session()->flash('success','Item  Update Successfully!');

       }else{

           $details  = OrderDetail::where('order_id',$order_id)->where('id',$detail_id)->first();
           $details->delete();

           $order = Order::find($order_id);
           $order->total_amount = $order->total_amount - ($details->sales_rate* $details->qty);
           $order->total_discount_product = $order->total_discount_product - ($details->discount_amount* $details->qty);
           $order->save();

           $request->session()->flash('success','Item Deleted Successfully!');
       }

        return redirect()->route('onetime-order-confirm',['id'=>$order_id]);
    }
    public function  onetimeOrderConfirmSave($order_id,Request $request)
    {

        $order = Order::find($order_id);
        $order_details = OrderDetail::where('order_id',$order_id)->get();

        $order->order_status = 2;

        if($order->save()){
            foreach ($order_details as $order_detail)
            {
                $order_detail->order_status = 2;
                $order_detail->save();
            }

        }


        $shipping = Shipping::all();
        $payment_types = PaymentType::all();
        $couriers = Courier::all();

        $data = [];
        $data ['order'] = $order;
        $data ['shipping'] = $shipping;
        $data ['payment_types'] = $payment_types;
        $data ['couriers'] = $couriers;
        $request->session()->flash('success','Order Confirm   Successfully!');


            $customer_phone =  $order->blling->mobile;
            $total_amouont = number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);
            $message = urlencode("Hello ".$order->blling->name.", Your Order- BS".$order->invoice_no." is confirmed.Total bill is ".$total_amouont." TK. Thank you stay with Bonaji Shop.");
            $sms_phone = $customer_phone;

            $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);

               if(!empty($order->blling->email)){


                  Mail::to($order->blling->email)->send(new OrderConfirmMail($order));


                }


        if($order->order_type==1)
        {
            return redirect()->route('admin.view-confirm-order');
        }
        else{
            return redirect()->route('admin.registered-confirm-order');

        }

    }
    public function  onetimeOrderCourer($order_id,Request $request)
    {
        $order = Order::find($order_id);

        $order->courier_id = $request->courier_id;
        $order->save();


        $request->session()->flash('success','Courier Applied  Successfully!');


        $request->session()->flash('success','Billing & Shipping Update Successfully!');


        return redirect()->route('onetime-order-confirm',['id'=>$order_id]);


    }
    public function oneTimeOrderPayment(Request $request)
    {
        $order_id = $request->order_id;
        $payment_type_id = $request->payment_type_id;
        $total_paid_amount = $request->total_paid_amount;


        $order = Order::find($order_id);
        $order->payment_type_id = $payment_type_id;
        $order->total_paid_amount = $total_paid_amount;
        $order->save();

        $request->session()->flash('success','Payment Apply  Successfully!');



        return redirect()->route('onetime-order-confirm',['id'=>$order_id]);

    }
    public function oneTimeOrderView($order_id)
    {
        $order = Order::find($order_id);
        $shipping = Shipping::all();
        $payment_types = PaymentType::all();

        $data = [];
        $data ['order'] = $order;
        $data ['shipping'] = $shipping;
        $data ['payment_types'] = $payment_types;

            return view('backend.admin.order.onetime-order-view',$data);

    }
    public function allOneTimePendingOrder()
    {
        $orders = Order::where('order_type',1)->where('order_status',1)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;



            return view('backend.admin.order.onetime-pending-order',$data);


    }
    public function allOneTimeConfirmOrder()
    {
        $orders = Order::where('order_type',1)->where('order_status',2)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;


            return view('backend.admin.order.onetime-confirm-order',$data);



    }
    public function oneTimeOrderDelivery($order_id)
    {
        $order = Order::find($order_id);
        $shipping = Shipping::all();
        $payment_types = PaymentType::all();
        $couriers = Courier::all();

        $data = [];
        $data ['order'] = $order;
        $data ['shipping'] = $shipping;
        $data ['payment_types'] = $payment_types;
        $data ['couriers'] = $couriers;




            return view('backend.admin.order.onetime-order-delivery',$data);



    }
    public function  onetimeOrderDeliverySave($order_id,Request $request)
    {
        $order = Order::find($order_id);
        $order_details = OrderDetail::where('order_id',$order_id)->get();

        $order->order_status = 3;
        $order->delivery_date = date("Y-m-d",strtotime($request->delivery_date));

        if($order->save()){
            foreach ($order_details as $order_detail)
            {
                $order_detail->order_status = 3;
                $order_detail->save();
            }

        }


        $shipping = Shipping::all();
        $payment_types = PaymentType::all();
        $couriers = Courier::all();

        $data = [];
        $data ['order'] = $order;
        $data ['shipping'] = $shipping;
        $data ['payment_types'] = $payment_types;
        $data ['couriers'] = $couriers;
        $request->session()->flash('success','Order Delivery   Successfully!');

        if($order->order_type==1){

            return redirect()->route('admin.view-delivery-order');

        }else{

            return redirect()->route('admin.registered-delivery-order');
        }




    }
    public function allOneTimeDeliveryOrder()
    {
        $orders = Order::where('order_type',1)->where('order_status',3)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;


            return view('backend.admin.order.onetime-delivery-order',$data);


    }
    public function allOneTimeCancelOrder()
    {
        $orders = Order::where('order_type',1)->where('order_status',4)->orderBy('order_date', 'desc')->get();
        $data = [];
        $data ['orders'] = $orders;


            return view('backend.admin.order.onetime-cancel-order',$data);


    }
    public function confirmCancelOrder(Request $request)
    {

        $order_id = $request->id;
        $order = Order::find($order_id);
        $order_details = OrderDetail::where('order_id',$order_id)->get();

        $order->order_status = 4;
        $order->delivery_date = date("Y-m-d",strtotime(date("Y-m-d")));
        $order->save();


        if($order->save()){
            foreach ($order_details as $order_detail)
            {
                $order_detail->order_status = 4;
                $order_detail->save();
            }

        }


        $request->session()->flash('success','Order Cancel   Successfully!');

        if($order->order_type==1){

            return redirect()->route('admin.view-cancel-order');

        }else{

            return redirect()->route('admin.registered-cancel-order');
        }



    }
    public function onetimeOrderPrint($order_id)
    {
        $order = Order::find($order_id);
        $shipping = Shipping::all();
        $payment_types = PaymentType::all();

        $data = [];
        $data ['order'] = $order;
        $data ['shipping'] = $shipping;
        $data ['payment_types'] = $payment_types;

            return view('backend.admin.order.onetime-invoice-print',$data);


    }
}
