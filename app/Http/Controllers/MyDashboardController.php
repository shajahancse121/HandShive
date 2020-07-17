<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use App\Order;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Validator;
class MyDashboardController extends Controller
{


    public function customerDashboard()
    {
        $customer =  Auth::guard('customer')->user();
        //return $customer->first();

        $orders = Order::where('order_type',2)->where('customer_id',$customer->id)->where('order_status','!=',4)->orderBy('order_date', 'desc')->get();


        $data = [];
        $data ['orders'] = $orders;



        return view('Frontend.my-dashboard',$data);


    }
    public function reemailVerify(Request $request)
    {
        $customer = Customer::where('phone',Auth::guard('customer')->user()->phone)->where('email',Auth::guard('customer')->user()->email)->first();

        if($customer){


            Mail::to($customer->email)->send(new VerificationEmail($customer));

            $request->session()->flash('success','Check Your Email to get Verification Code!');
            $request->session()->flash('type','success');


        }



        return view('Frontend.reemail-verification');


    }
    public function  emailVerifyCheck(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'code' => 'required|numeric|digits:4',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $code = $request->code;
        $email_customer = Customer::where('email_code',$code)->where('verified_email',0)->first();



        if($email_customer)
        {
            $email_customer->email_code = null;
            $email_customer->verified_email = 1;
            $email_customer->save();

            $request->session()->flash('success','Your Email is verified Now!');


            return redirect()->route('my-dashboard');
        }
        else{

            $request->session()->flash('danger','Your Code is invalid!');
            $request->session()->flash('type','danger');

            return redirect()->back();

        }

    }
    public function cancelOrder($order_id)
    {
        $customer =  Auth::guard('customer')->user();
        $order = Order::where('id',$order_id)->where('order_type',2)->where('customer_id',$customer->id)->where('order_status','!=',4)->orderBy('order_date', 'desc')->first();

        $order->order_status = 4;
        $order->save();

        return redirect()->route('my-dashboard');

    }
    public function showCustomerInvoice($order_id)
    {
        $customer =  Auth::guard('customer')->user();
        $order = Order::where('id',$order_id)->where('order_type',2)->where('customer_id',$customer->id)->where('order_status','!=',4)->orderBy('order_date', 'desc')->first();


        $data = [];
        $data ['order'] = $order;
        return view('Frontend.invoice',$data);
    }
    public function customerProfileUpdate(Request $request)
    {
        $customer =  Auth::guard('customer')->user();
        $oldcustomer = Customer::find($customer->id);
        $oldcustomer->name = $request->name;
        $oldcustomer->email = $request->email?$request->email:NULL;
        $oldcustomer->phone = $request->phone;
        $oldcustomer->address = $request->address;

        

        if($request->password){
            $oldcustomer->password = bcrypt($request->password);
        }
       // return $oldcustomer;
        
        $oldcustomer->save();

        return redirect()->route('my-dashboard');

    }
}
