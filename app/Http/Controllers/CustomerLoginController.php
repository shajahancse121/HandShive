<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Auth;
use Session;
use Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
class CustomerLoginController extends Controller
{

    public function customerLoginEmail(Request $request)
    {
        $customer_password = $request->get('customer_password');
        $customer_email = $request->get('customer_email');

        $data = [];



        if(Auth::guard('customer')->attempt(['email'=>$customer_email, 'password'=>$customer_password,'verified_email'=>1])){

            $data['status']=true;
        }
        else if(Auth::guard('customer')->attempt(['phone'=>$customer_email, 'password'=>$customer_password,'verified'=>1])){


            $data['status']=true;
        }

        else {
            $data['status'] = false;
        }

        return response()->json($data);

    }
    public function customerLogOut()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('home');
    }
    public function customerRegistration()
    {
        if (Auth::guard('customer')->check()) {

            return redirect()->back();

        }

        return view('Frontend.customer-registration');
    }
    public function customerLogin()
    {
        if (Auth::guard('customer')->check()) {

            return redirect()->back();

        }
        return view('Frontend.customer-login');
    }
    public function customerRegistrationSave(Request $request)
    {
        $customer = Customer::where('email',$request->email)->first();
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' =>  "nullable|email|unique:customers",
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/|digits:11|unique:customers',
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5|same:password',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer = new Customer();
        $sms_code = mt_rand(1000,9999);
        $email_code = mt_rand(1000,9999);

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->code = $sms_code;
        $customer->verified = 0;

        $customer->email_code = $email_code;
        $customer->verified_email = 0;

        $customer->password = bcrypt($request->password);
        $customer->save();
        $message = urlencode("Welcome to Bonaji Shop,Your Code: ".$sms_code);
        $sms_phone = $customer->phone;

        $request->session()->put('phone',$customer->phone);
        $request->session()->put('code',$sms_code);

        if(!empty($request->email)){


           Mail::to($request->email)->send(new VerificationEmail($customer));


        }

        $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);

        $request->session()->flash('success','Check Your Phone <i class="fa fa-phone"></i> to get Verification Code');
        $request->session()->flash('type','success');

        return redirect()->route('customer-verify');

    }
    public function customerLoginCheck(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5',
            'email_phone' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer_password = $request->get('password');
        $customer_email = $request->get('email_phone');
        $customer_phone = $request->get('email_phone');


        if (Auth::guard('customer')->attempt(['email' => $customer_email, 'password' => $customer_password,'verified_email'=>1])) {

            return redirect()->route('my-dashboard');

        } else if (Auth::guard('customer')->attempt(['phone' => $customer_phone, 'password' => $customer_password,'verified'=>1])) {


            return redirect()->route('my-dashboard');


        } else
            {

            $request->session()->flash('success','Invalid  Phone or Email and password!');



            return redirect()->back();
        }
    }
}
