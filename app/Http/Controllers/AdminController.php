<?php

namespace App\Http\Controllers;

use App\Mail\AdminVerification;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Session;
use Validator;
class AdminController extends Controller
{

    public function index()
    {
        $data = [];
        $data['onetime_pending'] = Order::where('order_type',1)->where('order_status',1)->count();
        $data['onetime_confirm'] = Order::where('order_type',1)->where('order_status',2)->count();
        $data['onetime_delivery'] = Order::where('order_type',1)->where('order_status',3)->count();

        $data['registered_pending'] = Order::where('order_type',2)->where('order_status',1)->count();
        $data['registered_confirm'] = Order::where('order_type',2)->where('order_status',2)->count();
        $data['registered_delivery'] = Order::where('order_type',2)->where('order_status',3)->count();
        $data['orders'] = Order::orderBy('order_date', 'desc')->limit(10)->get();


        return view('backend.admin.dashboard',$data);


    }
    public function forgetPassword()
    {
        return view('auth.forget-passowrd');
    }
    public function checkAdminEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $email = $request->email;
        $user =  User::where('email',$email)->first();
        if($user)
        {
            $code =  mt_rand(1000,9999);
            $user->remember_token = $code;
            $user->save();
            if($user){
                session(['code' => $code]);
                session(['email' => $user->email]);


                Mail::to($user->email)->send(new AdminVerification($user));


            }
            $request->session()->flash('success','Check Your Email for verification code!');
            return redirect()->route('admin.user-verify');
        }else{
            $request->session()->flash('success','Invalid Email.User Not Found');
            return redirect()->back();
        }

    }
    public function userVerify()
    {
        if(Session::get('email') && Session::get('code')){
            return view('auth.user-verify');
        }
        else{
            return redirect()->route('login');
        }


    }
    public function savePasswordReset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5',
            'password_confirmation' => 'required|min:5|same:password',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if(Session::get('email') && Session::get('code')){

            $user = User::where('remember_token',Session::get('code'))->where('email',Session::get('email'))->first();
            if($user){

                $user->remember_token=null;
                $user->password=bcrypt($request->password);
                $user->save();
                Session::forget('code');
                Session::forget('email');
                $request->session()->flash('success','Your Password Successfully Updated!Now Login.');
                return redirect()->route('login');
            }else{

                $request->session()->flash('danger','Invalid Access!');


                return redirect()->back();
            }


        }
        else{
            return redirect()->route('login');
        }
    }
    public function passwordReset(Request $request)
    {
        if(Session::get('email') && Session::get('code')){

            $user = User::where('remember_token',Session::get('code'))->where('email',Session::get('email'))->first();
            if($user){

                return view('auth.password-reset');

            }else{

                $request->session()->flash('danger','Invalid Access!');


                return redirect()->back();
            }


        }
        else{
            return redirect()->route('login');
        }
    }
    public function checkAdminEmailCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:4|digits:4',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $code = $request->code;
        $email = Session::get('email');
        $session_code = Session::get('code');

        if($session_code==$code && Session::get('email') && Session::get('code')){

            $user = User::where('remember_token',$code)->where('email',$email)->first();
            if($user){

                return redirect()->route('admin.password-reset');

            }else{

                $request->session()->flash('danger','Invalid Code!');


                return redirect()->back();
            }


        }
        else{
            return redirect()->route('login');
        }

    }
}
