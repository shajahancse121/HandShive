<?php

namespace App\Http\Controllers;
use App\Blling;
use App\BlogCategory;
use App\Category;
use App\Comment;
use App\CompanyProfile;
use App\Contact;
use App\Cupon;
use App\Customer;
use App\CustomerShare;
use App\Faq;
use App\Mail\OrderPlaceMail;
use App\MissionVision;
use App\OrderDetail;
use App\OtherShipping;
use App\Product;
use App\Shipping;
use App\Slider;
use App\SubCategory;
use App\Support;
use App\Offer;
use Illuminate\Http\Request;
use App\ProductImage;
use Cart;
use Carbon\Carbon;
use App\Order;
use Auth;
use App\Blog;
use Validator;
use DB;
use Session;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {

//        $data = [];
//        $data['slider'] = Slider::where('status',1)->get();
//        $data['support'] = Support::all();
//        $data['new_product'] = Product::where('status',1)->where('new_product',1)->get();
//        $data['popular_product'] = Product::where('status',1)->where('popular_product',1)->get();
//        $data['best_product'] = Product::where('status',1)->where('best_seller',1)->get();
//        $data['home_category'] = Category::where('popular_category',1)->get();
//        $data['offer_img'] = Offer::all();
//
//
//        return view('Frontend.home',$data);
        return "Welcome";
    }
    public function termsConditions()
    {
        return view('Frontend.terms-conditions');
    }
    public function returnRefundPolicy()
    {
        return view('Frontend.return-and-refund');
    }
    public function privacyPolicy()
    {
        return view('Frontend.privacy-policy');
    }
    public function test()
    {
        $order = Order::find(42);
        $data['order'] = $order;


        return view('Frontend.order-place-email',$data);
    }
    public function orderConfirmGet()
    {
        return redirect()->route('home');
    }
    public function emailVerify()
    {


        return view('Frontend.email-verification');


    }
    public function customerResendCode()
    {
        $sms_phone = session('phone');
        $code = session('code');
        // dd($code);

        $message = "Your Verification Code: ".$code;
        $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);
        session()->flash('success','Check Your Mobile for 4 digit code');
        session()->flash('type','success');

        return redirect()->route('customer-verify');
    }
    public function customerResendCodePassword()
    {
        $sms_phone = session('phone');
        $code = session('code');
        // dd($code);

        $message = "Your Verification Code: ".$code;
        $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);
        session()->flash('success','Check Your Mobile for 4 digit code');
        session()->flash('type','success');

        return redirect()->route('account-found',['phone'=>$sms_phone]);
    }

    public function customerVerify()
    {


        return view('Frontend.customer-verification');


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

            $request->session()->flash('code_success','Your Email is verified!Now Login');

            return redirect()->route('customer-login');
        }
        else{

            $request->session()->flash('danger','Your Code is invalid!');
            $request->session()->flash('type','danger');

            return redirect()->back();

        }

    }
    public function  customerVerifyCheck(Request $request)
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
        $phone_customer = Customer::where('code',$code)->where('verified',0)->first();

        if($phone_customer)
        {
            $phone_customer->code = null;
            $phone_customer->verified = 1;
            $phone_customer->save();

            session()->forget('phone');
            session()->forget('code');

            $request->session()->flash('code_success','Your Phone number is verified!Now Login');

            return redirect()->route('customer-login');
        }
        else{

            $request->session()->flash('danger','Your Code is invalid!');
            $request->session()->flash('type','danger');

            return redirect()->back();

        }

    }
    public function searchProductDetails(Request $request)
    {


            $data =  Product::where('name', 'LIKE', "%{$request->country_name}%")->first();
            if(isset($data)){
            $product = $data;
            $productImage = ProductImage::where('product_id',$product->id)->get();
            $data = [];
            $data['product'] = $product;
            $data['productImage'] = $productImage;
            $data['related_product'] = Product::where('status',1)->where('category_id',$product->category_id)->where('id','!=',$product->id)->get();


            return view('Frontend.product-details',$data);
        }
        else{

            return redirect()->route('home');
        }


    }

    function fetch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('products')
                ->where('name', 'LIKE', "%{$query}%")
                ->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach($data as $row)
            {
                $output .= '
       <li><a href="javascript:void(0)">'.$row->name.'</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
    public function contactUs()
    {
        return view('Frontend.contact-us');
    }
    public function contactMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:50',
            'email' =>  "required|email|unique:contacts",
            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/|digits:11|unique:contacts',
            'subject' => 'required|min:5|max:255|unique:contacts',
            'message' => 'required|min:5|max:800',

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact = new Contact();

        $contact->name = trim($request->name);
        $contact->email = trim($request->email);
        $contact->phone = trim($request->phone);
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        $request->session()->flash('success','Your message sent  successfully done!');

        return redirect()->route('contact-us');

    }
    public function aboutUs()
    {
        $data = [];
        $data['support'] = Support::all();
        $data['mission_visions'] = MissionVision::all();
        $data['faqs'] = Faq::all();
        $data['customer_shares'] = CustomerShare::all();
        return view('Frontend.about-us',$data);
    }
    public function allBlog()
    {
        $data = [];
        $data['cagetory'] = BlogCategory::where('status',1)->get();
        $data['blogs'] = Blog::where('status',1)->paginate(8);



        return view('Frontend.blog',$data);
    }
    public function blogDetails($slug)
    {

        $data = [];
        $data['cagetory'] = BlogCategory::where('status',1)->get();
        $data['blog'] = Blog::where('slug', 'like', '%' . $slug . '%')->first();
        $data['blog_cagetory'] = BlogCategory::where('id',$data['blog']->blog_category_id)->first();

        $data['blogs'] = Blog::where('status',1)->get();



        return view('Frontend.blog-details',$data);
    }
    public function commentSave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'details' => 'required|min:3|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if(Auth::guard('customer')->check())
        {
            $blog = Blog::find($request->blog_id);
            $comment = new Comment();
            $comment->customer_id = Auth::guard('customer')->user()->id;
            $comment->blog_id = $request->blog_id;
            $comment->details = $request->details;
            $comment->save();

            return redirect()->route('blog-details',['slug'=>$blog->slug]);
        }
        else{
            $request->session()->flash('success','Login to post your comment!');

            return redirect()->route('customer-login');
        }

    }
    public function blogCategory($slug)
    {
        $data = [];
        $category_id = BlogCategory::where('slug', 'like', '%' . $slug . '%')->first()->id;

        $data['cagetory_blog'] = Blog::where('blog_category_id',$category_id)->where('status',1)->get();


        $data['blogs'] = Blog::where('status',1)->get();
        $data['category_id'] = $category_id;
        $data['cagetory'] = BlogCategory::where('status',1)->get();



        return view('Frontend.blog-category',$data);
    }
    public function forgetPassword()
    {
        return view('Frontend.find-account');
    }
    public function customerFind(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'phone' => 'required|numeric|regex:/(01)[0-9]{9}/|digits:11',


        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $customer  = Customer::where('phone',$request->phone)->first();
        if($customer){
            $sms_code = mt_rand(1000,9999);
            $customer_phone = $customer->phone;
            $message = urlencode("Hello, ".$customer->name.".Your code: ".$sms_code);
            $sms_phone = $customer_phone;

            $customer->code = $customer->code?$customer->code:$sms_code;
            $customer->verified = 0;
            $customer->save();

            if($customer->code==$sms_code){
                $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);

            }

            session(['customer_found' => true]);
            $request->session()->put('phone',$customer_phone);
            $request->session()->put('code',$sms_code);

            return redirect()->route('account-found',['phone'=>$request->phone]);

        }else{
            $request->session()->flash('danger','Your Phone Number is not valid!');
            $request->session()->flash('type','danger');

            return redirect()->route('forget-password');
        }

    }
    public function passwordReset(Request $request)
    {
//        echo Session::get('customer_found');
//        //return $request->all();
        if(Session::get('customer_found')){
            $phone = $request->phone;
            $code = $request->code;

            Session::put('phone', $phone);
            Session::put('code', $code);

            return redirect()->route('password-reset-view');

        }
        else{
            return redirect()->route('customer-login');
        }

    }
    public function passwordResetView()
    {
       $customer_found = Session::get('customer_found');
       $phone = Session::get('phone');
       $code = Session::get('code');

        if($customer_found && $phone && $code)
        {
            return view('Frontend.password-reset-view');
        }else{

            return redirect()->route('customer-login');
        }

    }
    public function passwordResetConfirm(Request $request)
    {
//        $customer_found = Session::get('customer_found');
//        $phone = Session::get('phone');
//        $code = Session::get('code');

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:5',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $customer_found = Session::get('customer_found');
        $phone = Session::get('phone');
        $code = Session::get('code');
        $password = bcrypt($request->password);

        $phone_customer = Customer::where('phone',$phone)->where('code',$code)->where('verified',0)->first();

        if($phone_customer)
        {
            $phone_customer->code = null;
            $phone_customer->verified = 1;
            $phone_customer->password = $password;
            $phone_customer->save();

            Session::forget('customer_found');
            Session::forget('phone');
            Session::forget('code');

            $request->session()->flash('code_success','Your Password Change Successfully done!Now Login');

            return redirect()->route('customer-login');
        }
        else{

            $request->session()->flash('danger','Invalid Access');
            $request->session()->flash('type','danger');

            return redirect()->back();

        }


    }
    public function accountFoundView($phone)
    {
        if(Session::get('customer_found'))
        {
            return view('Frontend.account-found')->with('phone',$phone);
        }else{

            return redirect()->route('customer-login');
        }

    }
    public function newPasswordApply(Request $request)
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
        $phone_customer = Customer::where('code',$code)->where('verified',0)->where('phone',$request->phone)->first();

        if($phone_customer)
        {
            session()->forget('phone');
            session()->forget('code');


            $request->session()->flash('success','Your code is confirmed!Apply New password');


            return redirect()->route('customer-password-reset',['phone'=>$phone_customer->phone,'code'=>$code]);
        }
        else{

            $request->session()->flash('danger','Invalid Code.Try Again!');
            $request->session()->flash('type','danger');

            return redirect()->back();

        }
    }
    public function blogTag($tag)
    {
        $data = [];

        $category_id = null;


        $data['cagetory_blog'] = Blog::where('tag', 'like', '%' . str_replace("-"," ",$tag) . '%')->where('status',1)->get();


        $data['blogs'] = Blog::where('status',1)->get();
        $data['cagetory'] = BlogCategory::where('status',1)->get();
        $data['category_id'] = $category_id;



        return view('Frontend.blog-category',$data);
    }
    public function orderConfirm(Request $request)

    {

        if(Cart::count()>0) {

            $name = $request->name;
            $mobile = $request->mobile;
            $email = $request->email;
            $address = $request->address;
            $shipping_as_gift = $request->shipping_as_gift;
            $name2 = $request->name2;
            $mobile2 = $request->mobile2;
            $email2 = $request->email2;
            $address2 = $request->address2;
            $shipping_id = $request->shipping_id;
            $cupon_code = $request->cupon_code;
            $data = [];

            $lastOrder = Order::latest()->first();

            if ($lastOrder) {
                $serial = (int)$lastOrder->invoice_no + 1;
            } else {
                $serial = 1;
            }

            $invoice_no = str_pad($serial, 8, '0', STR_PAD_LEFT);
            if(Auth::guard('customer')->check()){
                $customer = Customer::find(Auth::guard('customer')->user()->id);
                $customer->name = $name;
                $customer->phone = $mobile;
                $customer->email = $email;
                $customer->address = $address;
                $customer->save();

                $billing = new Blling();
                $billing->name = $name;
                $billing->mobile = $mobile;
                $billing->email = $email;
                $billing->address = $address;
                $billing->save();


            }else{

                $billing = new Blling();
                $billing->name = $name;
                $billing->mobile = $mobile;
                $billing->email = $email;
                $billing->address = $address;
                $billing->save();


            }


            if ($shipping_as_gift) {

                $other_shipping = new OtherShipping();
                $other_shipping->name = $name2;
                $other_shipping->mobile = $mobile2;
                $other_shipping->email = $email2;
                $other_shipping->address = $address2;
                $other_shipping->save();
            }

            $total_amount = \Cart::subtotal(2, '.', '');
            $sub_total = \Cart::subtotal(2, '.', '');
            $discount_amount = 0;

            foreach (Cart::content() as $row) {

                $discount_amount += ($row->options->discount * $row->qty);
            }

            $cupon_amount = 0;

            $cupon_offer = Cupon::where('code', $cupon_code)->where('status', 1)->first();

            if ($cupon_offer) {
                $todayDate = date('Y-m-d');
                $todayDate = date('Y-m-d', strtotime($todayDate));

                $startDate = date('Y-m-d', strtotime($cupon_offer->start_date));
                $endDate = date('Y-m-d', strtotime($cupon_offer->end_date));

                if (($todayDate >= $startDate) && ($todayDate <= $endDate)) {


                    if ($cupon_offer->discount_type == 1) {

                        $cupon_amount = $total_amount * ($cupon_offer->amount / 100);

                    } else {


                        $cupon_amount = $cupon_offer->amount;
                    }

                } else {
                    $cupon_amount = 0;
                }

            }

            $get_shipping = Shipping::find($shipping_id);
            $shipping = Shipping::skip(2)->take(1)->first();


            $shipping_cost = 0;
            $shipping_title = '';


            if ($get_shipping) {

                if ($sub_total >= $shipping->amount) {


                    $shipping_cost = 0;
                    $shipping_title = $get_shipping->title;

                } else {

                    $shipping_cost = $get_shipping->amount;

                    $shipping_title = $get_shipping->title;
                }
            } else {
                $shipping_cost = 0;

                $shipping_title = $get_shipping->title;
            }



            //save order table data

            $order = new Order();
            $order->invoice_no = $invoice_no;
            $order->cupon_id = isset($cupon_offer->id) ? $cupon_offer->id : null;
            $order->cupon_amount = $cupon_amount;
            $order->shipping_id = $shipping_id;
            $order->payment_type_id = 1;
            $order->shipping_title = $shipping_title;
            $order->shipping_amount = $shipping_cost;
            $order->total_amount = $total_amount;
            $order->total_discount_product = $discount_amount;
            $order->total_paid_amount = 0;
            $order->order_date = date('Y-m-d',strtotime(Carbon::now()));
            $order->order_type = isset(Auth::guard('customer')->user()->id)?2:1;
            $order->customer_id = isset(Auth::guard('customer')->user()->id)?Auth::guard('customer')->user()->id:null;
            $order->blling_id = $billing->id;
            $order->other_shipping_id = isset($other_shipping->id) ? $other_shipping->id : null;
            $order->order_status = 1;

            $order->save();



            foreach (\Cart::content() as $row) {
                $ordertails = new OrderDetail();
                $ordertails->order_id = $order->id;
                $ordertails->product_id = $row->id;
                $ordertails->sales_rate = $row->price;
                $ordertails->discount_amount = $row->options->discount;
                $ordertails->qty = $row->qty;
                $ordertails->weight = $row->options->weight;
                $ordertails->unit_id = $row->options->unit_id;
                $ordertails->order_status = 1;
                $ordertails->order_type = isset(Auth::guard('customer')->user()->id)?2:1;
                $ordertails->order_date = date('Y-m-d',strtotime(Carbon::now()));
                $ordertails->save();

            }



            $company_profile = CompanyProfile::find(1);



            if(Auth::guard('customer')->check()){

                $customer_phone = Auth::guard('customer')->user()->phone;
                $total_amouont = number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);
                $message = urlencode("Hello ".Auth::guard('customer')->user()->name.", Your Order- BS".$order->invoice_no." is placed.Total bill is ".$total_amouont." TK. Thank you stay with Bonaji Shop.");
                $sms_phone = $customer_phone;

//                if(!empty($customer->email)){
//
//
//                  Mail::to($customer->email)->send(new OrderPlaceMail($order));
//
//
//                }





                $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);

                $message = urlencode("Hello  Admin, 1 Order- BS".$order->invoice_no." is placed.Total bill is ".$total_amouont." TK. Please Check it now!");

                $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$company_profile->mobile.'&senderid=8809612440535&msg='.$message);


            }
            else{

                $customer_phone = $billing->mobile;
                $total_amouont = number_format($order->total_amount-$order->cupon_amount+$order->shipping_amount);
                $message = urlencode("Hello ".$billing->name.", Your Order- BS".$order->invoice_no." is placed.Total bill is ".$total_amouont." TK. Thank you stay with Bonaji Shop.");
                $sms_phone = $customer_phone;

//                if(!empty($billing->email)){
//
//
//                   Mail::to($billing->email)->send(new OrderPlaceMail($order));
//
//
//                }

                $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$sms_phone.'&senderid=8809612440535&msg='.$message);
                $message = urlencode("Hello  Admin, 1 Order- BS".$order->invoice_no." is placed.Total bill is ".$total_amouont." TK. Please Check it now!");

                $response = Http::get('http://portal.metrotel.com.bd/smsapi?api_key=C20001595e4e020a2836f6.45297429&type=text&contacts=88'.$company_profile->mobile.'&senderid=8809612440535&msg='.$message);


            }

        }else{

            return redirect()->route('cart');


          }

        if($order){
            Cart::destroy();
        }

        $order = Order::find($order->id);
        $data['order'] = $order;


        return view('Frontend.invoice',$data);

    }
    public function shop()
    {
        $data = [];
        $data['total_product'] = Product::where('status',1)->count();
        $data['all_category'] = Category::where('status',1)->get();
        $data['all_product'] = Product::where('status',1)->paginate(18);
        $data['offer_img'] = Offer::all();

        return view('Frontend.shop',$data);
    }
    public function viewCart()
    {
        $shipping = Shipping::all();
        $data = [];
        $data['shipping'] = $shipping;

        return view('Frontend.cart',$data);
    }
    public function showCategoryProduct($category_slug)
    {
        $category = Category::where('slug',$category_slug)->first();
        $data = [];
        $data['total_product'] = Product::where('status',1)->where('category_id',$category->id)->count();
        $data['all_category'] = Category::all();
        $data['all_product'] = Product::where('status',1)->where('category_id',$category->id)->paginate(15);
        $data['offer_img'] = Offer::all();

        return view('Frontend.shop',$data);
    }

    public function showsubCategoryProduct($sub_cat_slug)
    {

        $subcategory = SubCategory::where('slug',$sub_cat_slug)->first();
        $data = [];
        $data['total_product'] = Product::where('status',1)->where('category_id',$subcategory->category_id)->where('sub_category_id',$subcategory->id)->count();
        $data['all_category'] = Category::all();
        $data['all_product'] = Product::where('status',1)->where('category_id',$subcategory->category_id)->where('sub_category_id',$subcategory->id)->paginate(15);
        $data['offer_img'] = Offer::all();

        return view('Frontend.shop',$data);

    }

    public function showProductDetails($slug = null)
    {
        $product = Product::where('slug',$slug)->first();
        $productImage = ProductImage::where('product_id',$product->id)->get();
        $data = [];
        $data['product'] = $product;
        $data['productImage'] = $productImage;
        $data['related_product'] = Product::where('status',1)->where('category_id',$product->category_id)->where('id','!=',$product->id)->get();



        return view('Frontend.product-details',$data);

    }
    public function deleteItemCart(Request $request)
    {


        $total_amount_final = 0;
        $shipping_id = $request->shipping_id;
        $pro_id = $request->pro_id;

        $code = $request->cupon_code;


        foreach(Cart::content() as $row)
        {
            if($row->id==$pro_id)
            {
                Cart::remove($row->rowId);
            }

        }



        $data = [];
        $cart_view = '';



        $discount_amount = 0;
        $total_amount = \Cart::subtotal(2,'.','');
        $sub_total = \Cart::subtotal(2,'.','');



        $total_amount_with_discount = \Cart::subtotal(2,'.','');



        $cupon_offer = Cupon::where('code',$code)->where('status',1)->first();



        $cupon_label='';

        $cupon_label = '<p><i class="ion-android-alert"></i> Cupon Discount</p>';



        $cupon_amount = 0;
        if($cupon_offer)
        {
            $todayDate = date('Y-m-d');
            $todayDate=date('Y-m-d', strtotime($todayDate));

            $startDate = date('Y-m-d', strtotime($cupon_offer->start_date));
            $endDate = date('Y-m-d', strtotime($cupon_offer->end_date));

            if (($todayDate >= $startDate) && ($todayDate <= $endDate)){


                if($cupon_offer->discount_type ==1){

                    $cupon_amount = $total_amount*($cupon_offer->amount/100);

                }
                else{


                    $cupon_amount = $cupon_offer->amount;
                }




                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format($cupon_amount,2).' Tk.</p>';


            }else{

                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk.</p>';

            }

        }
        else{

            $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk</p>';

        }




        $total_amount=$total_amount-$cupon_amount;





        foreach(Cart::content() as $row)
        {
            $discount_amount+=($row->options->discount*$row->qty);
        }



        $total_amount_with_discount+=$discount_amount;

        $get_shipping = Shipping::find($shipping_id);
        $shipping = Shipping::skip(2)->take(1)->first();

        $content = '';
        $shipping_cost = 0;


        if($get_shipping) {

            if ($sub_total >= $shipping->amount) {



                $shipping_cost = 0;
                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px;">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> ' . $get_shipping->title . ':</span> 00.00 TK.';
            } else {

                $shipping_cost = $get_shipping->amount;

                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i>  ' . $get_shipping->title . ':</span> <i class="ion-ios-plus" style="color: #0ba360;font-size: 18px"></i> ' . number_format($get_shipping->amount, 2) . ' TK.';
            }
        }else{
            $shipping_cost = 0;

            $content .= '<span style="font-family: Arial;color:red;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> No Destination Selected:</span> 00.00 TK.';

        }

        $total_amount = $total_amount + $shipping_cost;



        $cart_table = '';
        $discount_total_amount = 0;

        foreach(\Cart::content() as $row) {

            $cart_table .= '<tr>';

            $cart_table .= '<td ><a href="javascript:void(0)"><img src="' . asset($row->options->product_image) . '" alt="" width="50px"></a><br><a href="javascript:void(0)" onclick="delete_confirm(' . $row->id . ')"><i class="fa fa-times" style="font-size:15px;color:red"></i></a></td>';
            $cart_table .= '<td ><a href="javascript:void(0)">' . $row->name . '</a>-<span style="font-weight: bold;color: #0ba360">' . $row->options->weight ." ". $row->options->unit . '</span></td>';

            $cart_table .= '<td><div class="row">';
            if($row->options->discount){
                $cart_table.='<div class="col-md-6 text-center">' . number_format($row->price) . ' Tk</div><div class="col-md-6 text-center">';
                $cart_table .= '&nbsp;&nbsp;<del style="color:gray">' . ($row->price + $row->options->discount) . ' Tk</del>';

            }else{
                $cart_table.='<div class="col-md-12 text-center">' . number_format($row->price) . ' Tk';

            }

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td  align="center">';
            $cart_table .= '<div class="input-group mb-3">';
            $cart_table .= ' <div class="input-group-append">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="delete_cart('.$row->id.');" ><i class="fa fa-minus"></i></button>';
            $cart_table .= ' <input  type="number"  class="qty_update"  style="text-align: center;font-size: 16px;font-weight: bold;border: 1px solid gray" min="1" id="pro_'.$row->id.'" readonly="" value="'.$row->qty.'">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="update_cart('.$row->id.');"><i class="fa fa-plus"></i></button>';

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td >' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table .= '</tr>';

        }




        $cart_view.='<a href="javascript:void(0)"><i class="fa fa-cart-arrow-down" aria-hidden="true" style="color:#40A944"></i><span class="item_count">'.Cart::count().'</span></a>';

        $cart_view.='<div class="mini_cart">';
        $cart_view.=' <div class="cart_gallery">';

        foreach(Cart::content() as $row)
        {
            $cart_view.=' <div class="cart_item">';
            $cart_view.=' <div class="cart_img">';
            $cart_view.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view.=' </div>';
            $cart_view.='<div class="cart_info">';
            $cart_view.=' <a href="#">'.$row->name.'</a>';
            $cart_view.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view.='     </div>';
            $cart_view.='     <div class="cart_remove">';
            $cart_view.='         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view.='    </div>';
            $cart_view.='   </div>';
        }



        $cart_view.='</div>';
        $cart_view.=' <div class="mini_cart_table">';
        $cart_view.='  <div class="cart_table_border">';
        $cart_view.='    <div class="cart_total">';
        $cart_view.='    <span>Sub total:</span>';
        $cart_view.=' <span class="price">'.Cart::subtotal().'</span>';
        $cart_view.='  </div>';
        $cart_view.='    <div class="cart_total mt-10">';
        $cart_view.='   <span>Total:</span>';
        $cart_view.='  <span class="price">'.Cart::subtotal().'</span>';
        $cart_view.=' </div>';
        $cart_view.=' </div>';
        $cart_view.='  </div>';
        $cart_view.='  <div class="mini_cart_footer">';
        $cart_view.='  <div class="cart_button">';
        $cart_view.='  <a href="'.route('cart').'"><i class="fa fa-shopping-cart"></i> View cart</a>';
        $cart_view.='   </div>';

        $cart_view.='   </div>';
        $cart_view.='  </div>';

        $discount_total_amount = 0;
        $cart_table_final = '';

        $sl = 1;
        foreach(\Cart::content() as $row) {

            $cart_table_final .= '<tr>';
            $cart_table_final .= '<td width="50%"><strong>'.$sl++.'.</strong> '.$row->name.'-'.$row->options->weight.$row->options->unit.'</td>';

            $cart_table_final .= '<td width="20%"><span>'.number_format($row->price).' Tk</span>';
            if ($row->options->discount) {

                $cart_table_final .= '<span style="text-decoration: line-through">'.number_format($row->price+$discount_total_amount).' Tk</span>';
            }
            $cart_table_final .= '</td>';
            $cart_table_final .= '<td width="10%" style="text-align: center" >';
            $cart_table_final .= '<strong>'.$row->qty.'</strong>';
            $cart_table_final .= '</td >';

            $cart_table_final .= '<td width="20%">' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table_final .= '</tr>';

        }




        $data['cart_view'] = $cart_view;
        $data['content'] = $content;
        $data['cart_table'] = $cart_table;
        $data['cupon_label'] = $cupon_label;
        $data['shipping_amount'] = $shipping_cost;
        $data['total_amount'] = number_format($total_amount,2);
        $data['total_amount_int'] = $total_amount;
        $data['cart_total'] = number_format($total_amount_with_discount,2);
        $data['discount_total'] = number_format($discount_amount,2);
        $data['sub_total_amount'] = number_format($sub_total,2);
        $data['cart_table_final'] = $cart_table_final;

        return response()->json($data);
    }
    public function cupponConfirm(Request $request)
    {
        $code = $request->cupon_code;
        $shipping_id = $request->shipping_id;
        $cupon_offer = Cupon::where('code',$code)->where('status',1)->first();

        $data = [];
        $content = '<p><i class="ion-android-alert"></i> Cupon Discount</p>';


        $discount_amount = 0;
        $total_amount = \Cart::subtotal(2,'.','');
        $sub_total = \Cart::subtotal(2,'.','');





        $cupon_label='';

            $cupon_label = '<p><i class="ion-android-alert"></i> Cupon Discount</p>';

        foreach(Cart::content() as $row)
        {
            $discount_amount+=$row->options->discount;
        }


        $cupon_amount = 0;
        if($cupon_offer)
        {
            $todayDate = date('Y-m-d');
            $todayDate=date('Y-m-d', strtotime($todayDate));

            $startDate = date('Y-m-d', strtotime($cupon_offer->start_date));
            $endDate = date('Y-m-d', strtotime($cupon_offer->end_date));

            if (($todayDate >= $startDate) && ($todayDate <= $endDate)){


                    if($cupon_offer->discount_type ==1){

                        $cupon_amount = $total_amount*($cupon_offer->amount/100);

                    }
                    else{


                        $cupon_amount = $cupon_offer->amount;
                    }




                 $content.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format($cupon_amount,2).' Tk.</p>';
               // $total_amount = $total_amount-$cupon_amount;

            }else{

                $content.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk.</p>';

            }

        }
        else{

            $content.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk</p>';

        }

        $total_amount = $total_amount-$cupon_amount;

        $get_shipping = Shipping::find($shipping_id);
        $shipping = Shipping::skip(2)->take(1)->first();

        $shipping_content = '';
        $shipping_cost = 0;


        if($get_shipping) {

            if ($sub_total >= $shipping->amount) {



                $shipping_cost = 0;
                $shipping_content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px;">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> ' . $get_shipping->title . ':</span> 00.00 TK.';
            } else {

                $shipping_cost = $get_shipping->amount;

                $shipping_content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i>  ' . $get_shipping->title . ':</span> <i class="ion-ios-plus" style="color: #0ba360;font-size: 18px"></i> ' . number_format($get_shipping->amount, 2) . ' TK.';
            }
        }else{
            $shipping_cost = 0;

            $shipping_content .= '<span style="font-family: Arial;color:red;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> No Destination Selected:</span> 00.00 TK.';

        }

        $total_amount=$total_amount+$shipping_cost;



        $data['content'] = $content;
        $data['shipping_content'] = $shipping_content;
        $data['total_amount'] = number_format($total_amount,2);
        $data['total_amount_int'] = $total_amount;
        $data['cupon_amount'] = $cupon_amount;
        return response()->json($data);


    }
    public function deleteCart(Request $request)
    {
        $total_amount_final = 0;
        $shipping_id = $request->shipping_id;
        $pro_id = $request->pro_id;
        $qty = $request->qty;
        $code = $request->cupon_code;

        $data = [];




        $product = Product::find($pro_id);
        $productImage = ProductImage::where('product_id',$pro_id)->first();
        $iamge = $productImage->name;

        $discount_amount = 0;
        $product_price = 0;

        if(!empty($product->discount_type)){

            if($product->discount_type ==1){
                $discount_amount = $product->price*($product->discount/100);
                $product_price = $product->price-$discount_amount;
            }
            else{
                $discount_amount = $product->discount;
                $product_price = $product->price-$discount_amount;
            }

        }else{
            $discount_amount = 0;
            $product_price = $product->price;
        }



        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => -1, 'price' => $product_price, 'options' => ['product_image' => $iamge,'discount'=>$discount_amount,'unit_id'=>$product->unit_id,'unit'=>$product->unit->name,'weight'=>$product->weight]]);




        $discount_amount = 0;
        $total_amount = \Cart::subtotal(2,'.','');
        $sub_total = \Cart::subtotal(2,'.','');

        $total_amount_with_discount = \Cart::subtotal(2,'.','');



        $cupon_offer = Cupon::where('code',$code)->where('status',1)->first();



        $cupon_label='';

        $cupon_label = '<p><i class="ion-android-alert"></i> Cupon Discount</p>';



        $cupon_amount = 0;
        if($cupon_offer)
        {
            $todayDate = date('Y-m-d');
            $todayDate=date('Y-m-d', strtotime($todayDate));

            $startDate = date('Y-m-d', strtotime($cupon_offer->start_date));
            $endDate = date('Y-m-d', strtotime($cupon_offer->end_date));

            if (($todayDate >= $startDate) && ($todayDate <= $endDate)){


                if($cupon_offer->discount_type ==1){

                    $cupon_amount = $total_amount*($cupon_offer->amount/100);

                }
                else{


                    $cupon_amount = $cupon_offer->amount;
                }




                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format($cupon_amount,2).' Tk.</p>';


            }else{

                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk.</p>';

            }

        }
        else{

            $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk</p>';

        }


        $total_amount=$total_amount-$cupon_amount;


        foreach(Cart::content() as $row)
        {
            $discount_amount+=($row->options->discount*$row->qty);
        }

        //$total_amount-=$discount_amount;

        $total_amount_with_discount+=$discount_amount;

        $get_shipping = Shipping::find($shipping_id);
        $shipping = Shipping::skip(2)->take(1)->first();
        $data = [];
        $content = '';
        $shipping_cost = 0;


        if($get_shipping) {

            if ($sub_total >= $shipping->amount) {



                $shipping_cost = 0;
                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px;">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> ' . $get_shipping->title . ':</span> 00.00 TK.';
            } else {

                $shipping_cost = $get_shipping->amount;

                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i>  ' . $get_shipping->title . ':</span> <i class="ion-ios-plus" style="color: #0ba360;font-size: 18px"></i> ' . number_format($get_shipping->amount, 2) . ' TK.';
            }
        }else{
            $shipping_cost = 0;

            $content .= '<span style="font-family: Arial;color:red;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> No Destination Selected:</span> 00.00 TK.';

        }

        $total_amount=($total_amount+$shipping_cost);

        $cart_table = '';
        $discount_total_amount = 0;

        foreach(\Cart::content() as $row) {

            $cart_table .= '<tr>';

            $cart_table .= '<td ><a href="javascript:void(0)"><img src="' . asset($row->options->product_image) . '" alt="" width="50px"></a><br><a href="javascript:void(0)" onclick="delete_confirm(' . $row->id . ')"><i class="fa fa-times" style="font-size:15px;color:red"></i></a></td>';
            $cart_table .= '<td ><a href="javascript:void(0)">' . $row->name . '</a>-<span style="font-weight: bold;color: #0ba360">' . $row->options->weight ." ". $row->options->unit . '</span></td>';

            $cart_table .= '<td><div class="row">';
            if($row->options->discount){
                $cart_table.='<div class="col-md-6 text-center">' . number_format($row->price) . ' Tk</div><div class="col-md-6 text-center">';
                $cart_table .= '&nbsp;&nbsp;<del style="color:gray">' . ($row->price + $row->options->discount) . ' Tk</del>';

            }else{
                $cart_table.='<div class="col-md-12 text-center">' . number_format($row->price) . ' Tk';

            }

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td  align="center">';
            $cart_table .= '<div class="input-group mb-3">';
            $cart_table .= ' <div class="input-group-append">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="delete_cart('.$row->id.');" ><i class="fa fa-minus"></i></button>';
            $cart_table .= ' <input  type="number"  class="qty_update"  style="text-align: center;font-size: 16px;font-weight: bold;border: 1px solid gray" min="1" id="pro_'.$row->id.'" readonly="" value="'.$row->qty.'">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="update_cart('.$row->id.');"><i class="fa fa-plus"></i></button>';

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td >' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table .= '</tr>';

        }

        $cart_view= '';

        $cart_view.='<a href="javascript:void(0)"><i class="fa fa-cart-arrow-down" aria-hidden="true" style="color:#40A944"></i><span class="item_count">'.Cart::count().'</span></a>';

        $cart_view.='<div class="mini_cart">';
        $cart_view.=' <div class="cart_gallery">';

        foreach(Cart::content() as $row)
        {
            $cart_view.=' <div class="cart_item">';
            $cart_view.=' <div class="cart_img">';
            $cart_view.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view.=' </div>';
            $cart_view.='<div class="cart_info">';
            $cart_view.=' <a href="#">'.$row->name.'</a>';
            $cart_view.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view.='     </div>';
            $cart_view.='     <div class="cart_remove">';
            $cart_view.='         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view.='    </div>';
            $cart_view.='   </div>';
        }



        $cart_view.='</div>';
        $cart_view.=' <div class="mini_cart_table">';
        $cart_view.='  <div class="cart_table_border">';
        $cart_view.='    <div class="cart_total">';
        $cart_view.='    <span>Sub total:</span>';
        $cart_view.=' <span class="price">'.Cart::subtotal().'</span>';
        $cart_view.='  </div>';
        $cart_view.='    <div class="cart_total mt-10">';
        $cart_view.='   <span>Total:</span>';
        $cart_view.='  <span class="price">'.Cart::subtotal().'</span>';
        $cart_view.=' </div>';
        $cart_view.=' </div>';
        $cart_view.='  </div>';
        $cart_view.='  <div class="mini_cart_footer">';
        $cart_view.='  <div class="cart_button">';
        $cart_view.='  <a href="'.route('cart').'"><i class="fa fa-shopping-cart"></i> View cart</a>';
        $cart_view.='   </div>';

        $cart_view.='   </div>';
        $cart_view.='  </div>';

        $cart_table_final = '';
        $discount_total_amount = 0;

        $sl = 1;
        foreach(\Cart::content() as $row) {

            $cart_table_final .= '<tr>';
            $cart_table_final .= '<td width="50%"><strong>'.$sl++.'.</strong> '.$row->name.'-'.$row->options->weight.$row->options->unit.'</td>';

            $cart_table_final .= '<td width="20%"><span>'.number_format($row->price).' Tk</span>';
            if ($row->options->discount) {

                $cart_table_final .= '<span style="text-decoration: line-through">'.number_format($row->price+$discount_total_amount).' Tk</span>';
            }
            $cart_table_final .= '</td>';
            $cart_table_final .= '<td width="10%" style="text-align: center" >';
            $cart_table_final .= '<strong>'.$row->qty.'</strong>';
            $cart_table_final .= '</td >';

            $cart_table_final .= '<td width="20%">' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table_final .= '</tr>';

        }




        $data['content'] = $content;
        $data['cart_table'] = $cart_table;
        $data['cupon_label'] = $cupon_label;
        $data['shipping_amount'] = $shipping_cost;
        $data['total_amount'] = number_format($total_amount,2);
        $data['total_amount_int'] = $total_amount;
        $data['cart_total'] = number_format($total_amount_with_discount,2);
        $data['discount_total'] = number_format($discount_amount,2);
        $data['sub_total_amount'] = number_format($sub_total,2);
        $data['cart_view'] = $cart_view;
        $data['cart_table_final'] = $cart_table_final;


        return response()->json($data);
    }
    public function deleteCartQty(Request $request)
    {
        $total_amount_final = 0;

        $pro_id = $request->pro_id;


        $product = Product::find($pro_id);
        $productImage = ProductImage::where('product_id',$pro_id)->first();
        $iamge = $productImage->name;

        $discount_amount = 0;
        $product_price = 0;

        if(!empty($product->discount_type)){

            if($product->discount_type ==1){
                $discount_amount = $product->price*($product->discount/100);
                $product_price = $product->price-$discount_amount;
            }
            else{
                $discount_amount = $product->discount;
                $product_price = $product->price-$discount_amount;
            }

        }else{
            $discount_amount = 0;
            $product_price = $product->price;
        }

        foreach(Cart::content() as $row) {

                if($product->id==$row->id)
                {
                    if($row->qty>1)
                    {
                        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => -1, 'price' => $product_price, 'options' => ['product_image' => $iamge,'discount'=>$discount_amount,'unit_id'=>$product->unit_id,'unit'=>$product->unit->name,'weight'=>$product->weight]]);

                    }
                    else{

                        Cart::remove($row->rowId);
                    }

                }
        }



        //saju
        $content = '';
        $content1 = '';
        $data = [];
        $content.=' <table width="100%">';
        $content.=' <tbody>';
        foreach(Cart::content() as $row) {
            $content.=' <tr >';
            $content.='     <td class="cart-item-count p-1 text-center" style = "10%" >';
            $content.='           <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');"><i class="ion-android-arrow-dropup" style = "font-size:24px" ></i ></a>';
            $content.='             <br />';
            $content.='               <span > '.$row->qty.'</span >';
            $content.='                    <br />';
            $content.='         <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');"> <i class="ion-android-arrow-dropdown" style = "font-size:24px" ></i ></a>';
            $content.='       </td >';
            $content.='         <td class="product-thumb-sm" style = "20%" >';
            $content.='            <img src = "'.asset($row->options->product_image).'" />';
            $content.='        </td >';
            $content.='            <td class="product-details" style="padding-left: 8px">';
            $content.='          <div class="row" >';
            $content.='                 <div class="col-md-12" >';
            $content.='     <p class="title mb-0" >'.$row->name.' </p >';
            $content.='         </div >';
            $content.='    </div >';
            $content.='            <div class="row price" >';
            $content.='       <div class="col-md-6" >';
            $content.='   <span > '.$row->qty.' X ৳ '.$row->price.' </span >';
            $content.='</div >';
            $content.=' <div class="col-md-6" >';
            $content.='   <span > ৳ '.($row->price*$row->qty).' </span >';
            $content.='</div >';
            $content.='    </div >';
            $content.='</td >';
            $content.=' <td class="remove-item-btn px-2" >';
            $content.='  <button onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style = "font-size:20px" ></i ></button >';
            $content.='       </td >';
            $content.='    </tr >';
        }


        $content.='        </tbody>';
        $content.='     </table>';

        $content1.='<table width="100%">';
        $content1.='      <tbody>';
        foreach(Cart::content() as $row) {

            $content1 .= ' <tr>';
            $content1 .= ' <td class="cart-item-count p-1 text-center" style="width:10%">';
            $content1 .= '  <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropup" style="font-size:24px"></i></a>';
            $content1 .= '     <br />';
            $content1 .= '                <span>'.$row->qty.'</span>';
            $content1 .= '              <br />';
            $content1 .= '                <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropdown" style="font-size:24px"></i></a>';
            $content1 .= '           </td>';
            $content1 .= '      <td class="product-thumb-sm" style="width:20%">';
            $content1 .= '          <img src= "'.asset($row->options->product_image).'" />';
            $content1 .= '               </td>';
            $content1 .= '               <td class="product-details">';
            $content1 .= '                <div class="row">';
            $content1 .= '                   <div class="col-md-12">';
            $content1 .= '                      <p class="title mb-0">'.$row->name.' </p>';
            $content1 .= '                      </div>';
            $content1 .= '            </div>';
            $content1 .= '               <div class="row">';
            $content1 .= '               <div class="col-6">'.$row->qty.' X ৳ '.$row->price.' </div>';
            $content1 .= '                 <div class="col-6"> ৳ '.($row->price*$row->qty).' </div>';

            $content1 .= '          </div>';
            $content1 .= '       </td>';
            $content1 .= '          <td class="remove-item-btn px-2">';
            $content1 .= '         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style="font-size:20px"></i></a>';
            $content1 .= '             </td>';
            $content1 .= '           </tr>';
        }



        $content1.='        </tbody>';
        $content1.='           </table>';



        $cart_view1 ='';
        foreach(Cart::content() as $row)
        {
            $cart_view1.=' <div class="cart_item">';
            $cart_view1.=' <div class="cart_img">';
            $cart_view1.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view1.=' </div>';
            $cart_view1.='<div class="cart_info">';
            $cart_view1.=' <a href="#">'.$row->name.'</a>';
            $cart_view1.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view1.='     </div>';
            $cart_view1.='     <div class="cart_remove">';
            $cart_view1.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view1.='    </div>';
            $cart_view1.='   </div>';
        }


        $data['cart_view1'] = $cart_view1;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();

        $data['content'] = $content;
        $data['content1'] = $content1;
        return response()->json($data);
    }
    public function updateCartQty(Request $request)
    {
        $total_amount_final = 0;

        $pro_id = $request->pro_id;



        $product = Product::find($pro_id);
        $productImage = ProductImage::where('product_id', $pro_id)->first();
        $iamge = $productImage->name;

        $discount_amount = 0;
        $product_price = 0;

        if (!empty($product->discount_type)) {

            if ($product->discount_type == 1) {
                $discount_amount = $product->price * ($product->discount / 100);
                $product_price = $product->price - $discount_amount;
            } else {
                $discount_amount = $product->discount;
                $product_price = $product->price - $discount_amount;
            }

        } else {
            $discount_amount = 0;
            $product_price = $product->price;
        }


        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product_price, 'options' => ['product_image' => $iamge, 'discount' => $discount_amount, 'unit_id' => $product->unit_id, 'unit' => $product->unit->name, 'weight' => $product->weight]]);


        //saju
        $content = '';
        $content1 = '';
        $data = [];
        $content.=' <table width="100%">';
        $content.=' <tbody>';
        foreach(Cart::content() as $row) {
            $content.=' <tr >';
            $content.='     <td class="cart-item-count p-1 text-center" style = "10%" >';
            $content.='           <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');"><i class="ion-android-arrow-dropup" style = "font-size:24px" ></i ></a>';
            $content.='             <br />';
            $content.='               <span > '.$row->qty.'</span >';
            $content.='                    <br />';
            $content.='         <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');"> <i class="ion-android-arrow-dropdown" style = "font-size:24px" ></i ></a>';
            $content.='       </td >';
            $content.='         <td class="product-thumb-sm" style = "20%" >';
            $content.='            <img src = "'.asset($row->options->product_image).'" />';
            $content.='        </td >';
            $content.='            <td class="product-details" style="padding-left: 8px">';
            $content.='          <div class="row" >';
            $content.='                 <div class="col-md-12" >';
            $content.='     <p class="title mb-0" >'.$row->name.' </p >';
            $content.='         </div >';
            $content.='    </div >';
            $content.='            <div class="row price" >';
            $content.='       <div class="col-md-6" >';
            $content.='   <span > '.$row->qty.' X ৳ '.$row->price.' </span >';
            $content.='</div >';
            $content.=' <div class="col-md-6" >';
            $content.='   <span > ৳ '.($row->price*$row->qty).' </span >';
            $content.='</div >';
            $content.='    </div >';
            $content.='</td >';
            $content.=' <td class="remove-item-btn px-2" >';
            $content.='  <button onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style = "font-size:20px" ></i ></button >';
            $content.='       </td >';
            $content.='    </tr >';
        }


        $content.='        </tbody>';
        $content.='     </table>';

        $content1.='<table width="100%">';
        $content1.='      <tbody>';
        foreach(Cart::content() as $row) {

            $content1 .= ' <tr>';
            $content1 .= ' <td class="cart-item-count p-1 text-center" style="width:10%">';
            $content1 .= '  <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropup" style="font-size:24px"></i></a>';
            $content1 .= '     <br />';
            $content1 .= '                <span>'.$row->qty.'</span>';
            $content1 .= '              <br />';
            $content1 .= '                <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropdown" style="font-size:24px"></i></a>';
            $content1 .= '           </td>';
            $content1 .= '      <td class="product-thumb-sm" style="width:20%">';
            $content1 .= '          <img src= "'.asset($row->options->product_image).'" />';
            $content1 .= '               </td>';
            $content1 .= '               <td class="product-details">';
            $content1 .= '                <div class="row">';
            $content1 .= '                   <div class="col-md-12">';
            $content1 .= '                      <p class="title mb-0">'.$row->name.' </p>';
            $content1 .= '                      </div>';
            $content1 .= '            </div>';
            $content1 .= '               <div class="row">';
            $content1 .= '               <div class="col-6">'.$row->qty.' X ৳ '.$row->price.' </div>';
            $content1 .= '                 <div class="col-6"> ৳ '.($row->price*$row->qty).' </div>';

            $content1 .= '          </div>';
            $content1 .= '       </td>';
            $content1 .= '          <td class="remove-item-btn px-2">';
            $content1 .= '         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style="font-size:20px"></i></a>';
            $content1 .= '             </td>';
            $content1 .= '           </tr>';
        }



        $content1.='        </tbody>';
        $content1.='           </table>';



        $cart_view1 ='';
        foreach(Cart::content() as $row)
        {
            $cart_view1.=' <div class="cart_item">';
            $cart_view1.=' <div class="cart_img">';
            $cart_view1.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view1.=' </div>';
            $cart_view1.='<div class="cart_info">';
            $cart_view1.=' <a href="#">'.$row->name.'</a>';
            $cart_view1.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view1.='     </div>';
            $cart_view1.='     <div class="cart_remove">';
            $cart_view1.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view1.='    </div>';
            $cart_view1.='   </div>';
        }


        $data['cart_view1'] = $cart_view1;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();

        $data['content'] = $content;
        $data['content1'] = $content1;
        return response()->json($data);
    }
        public function updateCart(Request $request)
    {
        $total_amount_final = 0;
        $shipping_id = $request->shipping_id;
        $pro_id = $request->pro_id;
        $qty = $request->qty;
        $code = $request->cupon_code;


        $product = Product::find($pro_id);
        $productImage = ProductImage::where('product_id',$pro_id)->first();
        $iamge = $productImage->name;

        $discount_amount = 0;
        $product_price = 0;

        if(!empty($product->discount_type)){

            if($product->discount_type ==1){
                $discount_amount = $product->price*($product->discount/100);
                $product_price = $product->price-$discount_amount;
            }
            else{
                $discount_amount = $product->discount;
                $product_price = $product->price-$discount_amount;
            }

        }else{
            $discount_amount = 0;
            $product_price = $product->price;
        }



        Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product_price, 'options' => ['product_image' => $iamge,'discount'=>$discount_amount,'unit_id'=>$product->unit_id,'unit'=>$product->unit->name,'weight'=>$product->weight]]);




        $discount_amount = 0;
        $cuppon_amount = 0;
        $total_amount = \Cart::subtotal(2,'.','');
        $sub_total = \Cart::subtotal(2,'.','');
        $total_amount_with_discount = \Cart::subtotal(2,'.','');

        $cupon_offer = Cupon::where('code',$code)->where('status',1)->first();

        $data = [];



        $cupon_label='';

        $cupon_label = '<p><i class="ion-android-alert"></i> Cupon Discount</p>';



        $cupon_amount = 0;
        if($cupon_offer)
        {
            $todayDate = date('Y-m-d');
            $todayDate=date('Y-m-d', strtotime($todayDate));

            $startDate = date('Y-m-d', strtotime($cupon_offer->start_date));
            $endDate = date('Y-m-d', strtotime($cupon_offer->end_date));

            if (($todayDate >= $startDate) && ($todayDate <= $endDate)){


                if($cupon_offer->discount_type ==1){

                    $cupon_amount = $total_amount*($cupon_offer->amount/100);

                }
                else{


                    $cupon_amount = $cupon_offer->amount;
                }

                $total_amount=$total_amount-$cupon_amount;


                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format($cupon_amount,2).' Tk.</p>';


            }else{

                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk.</p>';

            }

        }
        else{

            $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk</p>';

        }




        foreach(Cart::content() as $row)
        {
            $discount_amount+=($row->options->discount*$row->qty);
        }
        $total_amount_with_discount+=$discount_amount;


        $get_shipping = Shipping::find($shipping_id);
        $shipping = Shipping::skip(2)->take(1)->first();
        $data = [];
        $content = '';
        $shipping_cost = 0;


        if($get_shipping) {

            if ($sub_total >= $shipping->amount) {



                $shipping_cost = 0;
                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px;">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> ' . $get_shipping->title . ':</span> 00.00 TK.';
            } else {

                $shipping_cost = $get_shipping->amount;

                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i>  ' . $get_shipping->title . ':</span> <i class="ion-ios-plus" style="color: #0ba360;font-size: 18px"></i> ' . number_format($get_shipping->amount, 2) . ' TK.';
            }
        }else{
            $shipping_cost = 0;

            $content .= '<span style="font-family: Arial;color:red;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> No Destination Selected:</span> 00.00 TK.';

        }

        $total_amount = $total_amount+$shipping_cost;

        $cart_table = '';
        $discount_total_amount = 0;

        foreach(\Cart::content() as $row) {

            $cart_table .= '<tr>';

            $cart_table .= '<td ><a href="javascript:void(0)"><img src="' . asset($row->options->product_image) . '" alt="" width="50px"></a><br><a href="javascript:void(0)" onclick="delete_confirm(' . $row->id . ')"><i class="fa fa-times" style="font-size:15px;color:red"></i></a></td>';
            $cart_table .= '<td ><a href="javascript:void(0)">' . $row->name . '</a>-<span style="font-weight: bold;color: #0ba360">' . $row->options->weight ." ". $row->options->unit . '</span></td>';

            $cart_table .= '<td><div class="row">';
            if($row->options->discount){
                $cart_table.='<div class="col-md-6 text-center">' . number_format($row->price) . ' Tk</div><div class="col-md-6 text-center">';
                $cart_table .= '&nbsp;&nbsp;<del style="color:gray">' . ($row->price + $row->options->discount) . ' Tk</del>';

            }else{
                $cart_table.='<div class="col-md-12 text-center">' . number_format($row->price) . ' Tk';

            }

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td  align="center">';
            $cart_table .= '<div class="input-group mb-3">';
            $cart_table .= ' <div class="input-group-append">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="delete_cart('.$row->id.');" ><i class="fa fa-minus"></i></button>';
            $cart_table .= ' <input  type="number"  class="qty_update"  style="text-align: center;font-size: 16px;font-weight: bold;border: 1px solid gray" min="1" id="pro_'.$row->id.'" readonly="" value="'.$row->qty.'">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="update_cart('.$row->id.');"><i class="fa fa-plus"></i></button>';

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td >' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table .= '</tr>';

        }
        $cart_view= '';

        $cart_view.='<a href="javascript:void(0)"><i class="fa fa-cart-arrow-down" aria-hidden="true" style="color:#40A944"></i><span class="item_count">'.Cart::count().'</span></a>';

        $cart_view.='<div class="mini_cart">';
        $cart_view.=' <div class="cart_gallery">';

        foreach(Cart::content() as $row)
        {
            $cart_view.=' <div class="cart_item">';
            $cart_view.=' <div class="cart_img">';
            $cart_view.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view.=' </div>';
            $cart_view.='<div class="cart_info">';
            $cart_view.=' <a href="#">'.$row->name.'</a>';
            $cart_view.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view.='     </div>';
            $cart_view.='     <div class="cart_remove">';
            $cart_view.='         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view.='    </div>';
            $cart_view.='   </div>';
        }



        $cart_view.='</div>';
        $cart_view.=' <div class="mini_cart_table">';
        $cart_view.='  <div class="cart_table_border">';
        $cart_view.='    <div class="cart_total">';
        $cart_view.='    <span>Sub total:</span>';
        $cart_view.=' <span class="price">'.Cart::subtotal().'</span>';
        $cart_view.='  </div>';
        $cart_view.='    <div class="cart_total mt-10">';
        $cart_view.='   <span>Total:</span>';
        $cart_view.='  <span class="price">'.Cart::subtotal().'</span>';
        $cart_view.=' </div>';
        $cart_view.=' </div>';
        $cart_view.='  </div>';
        $cart_view.='  <div class="mini_cart_footer">';
        $cart_view.='  <div class="cart_button">';
        $cart_view.='  <a href="'.route('cart').'"><i class="fa fa-shopping-cart"></i> View cart</a>';
        $cart_view.='   </div>';

        $cart_view.='   </div>';
        $cart_view.='  </div>';


        $cart_table_final = '';
        $discount_total_amount = 0;

        $sl = 1;
        foreach(\Cart::content() as $row) {

            $cart_table_final .= '<tr>';
            $cart_table_final .= '<td width="50%"><strong>'.$sl++.'.</strong> '.$row->name.'-'.$row->options->weight.$row->options->unit.'</td>';

            $cart_table_final .= '<td width="20%"><span>'.number_format($row->price).' Tk</span>';
            if ($row->options->discount) {

                $cart_table_final .= '<span style="text-decoration: line-through">'.number_format($row->price+$discount_total_amount).' Tk</span>';
            }
            $cart_table_final .= '</td>';
            $cart_table_final .= '<td width="10%" style="text-align: center" >';
            $cart_table_final .= '<strong>'.$row->qty.'</strong>';
            $cart_table_final .= '</td >';

            $cart_table_final .= '<td width="20%">' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table_final .= '</tr>';

        }





        $data['content'] = $content;
        $data['cart_table'] = $cart_table;
        $data['cupon_label'] = $cupon_label;
        $data['shipping_amount'] = $shipping_cost;
        $data['total_amount'] = number_format($total_amount,2);
        $data['cart_total'] = number_format($total_amount_with_discount,2);
        $data['discount_total'] = number_format($discount_amount,2);
        $data['sub_total_amount'] = number_format($sub_total,2);
        $data['total_amount_int'] = $total_amount;
        $data['cart_view'] = $cart_view;
        $data['cart_table_final'] = $cart_table_final;


        return response()->json($data);


    }
    public function shippingConfirm(Request $request)
    {
        $total_amount_final = 0;
        $shipping_id = $request->shipping_id;
        $code = $request->cupon_code;

        $shipping_id_flag = $request->shipping_id?true:false;

        $cuppon_amount=0;





        $discount_amount = 0;
        $total_amount = \Cart::subtotal(2,'.','');
        $sub_total = \Cart::subtotal(2,'.','');





        $cupon_offer = Cupon::where('code',$code)->where('status',1)->first();



        $cupon_label='';

        $cupon_label = '<p><i class="ion-android-alert"></i> Cupon Discount</p>';



        $cupon_amount = 0;
        if($cupon_offer)
        {
            $todayDate = date('Y-m-d');
            $todayDate=date('Y-m-d', strtotime($todayDate));

            $startDate = date('Y-m-d', strtotime($cupon_offer->start_date));
            $endDate = date('Y-m-d', strtotime($cupon_offer->end_date));

            if (($todayDate >= $startDate) && ($todayDate <= $endDate)){


                if($cupon_offer->discount_type ==1){

                    $cupon_amount = $total_amount*($cupon_offer->amount/100);

                }
                else{


                    $cupon_amount = $cupon_offer->amount;
                }




                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format($cupon_amount,2).' Tk.</p>';


            }else{

                $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk.</p>';

            }

        }
        else{

            $cupon_label.='<p class="cart_amount"><i class="ion-ios-minus" style="color: #0ba360;"></i> '.number_format(0,2).' Tk</p>';

        }


        $total_amount=$total_amount-$cupon_amount;



        foreach(Cart::content() as $row)
        {
            $discount_amount+=($row->options->discount*$row->qty);
        }


        $get_shipping = Shipping::find($shipping_id);
        $shipping = Shipping::skip(2)->take(1)->first();
        $data = [];
        $content = '';
        $shipping_cost = 0;


        if($get_shipping) {

            if ($sub_total >= $shipping->amount) {



                $shipping_cost = 0;
                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px;">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> ' . $get_shipping->title . ':</span> 00.00 TK.';
            } else {

                $shipping_cost = $get_shipping->amount;

                $content .= '<span style="font-family: Arial;color:#40A944;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i>  ' . $get_shipping->title . ':</span> <i class="ion-ios-plus" style="color: #0ba360;font-size: 18px"></i> ' . number_format($get_shipping->amount, 2) . ' TK.';
            }
        }else{
            $shipping_cost = 0;

            $content .= '<span style="font-family: Arial;color:red;font-size: 18px">&nbsp;&nbsp;<i class="ion-android-car" style="font-size: 25px;color:black"></i> No Destination Selected:</span> 00.00 TK.';

        }

        $total_amount=$total_amount+$shipping_cost;

        $data['content'] = $content;
        $data['cupon_label'] = $cupon_label;
        $data['shipping_amount'] = $shipping_cost;
        $data['shipping_id_flag'] = $shipping_id_flag;
        $data['total_amount'] = number_format($total_amount,2);
        $data['total_amount_int'] = $total_amount;


        return response()->json($data);


    }
    public function deleteToCartMini(Request $request)
    {
        $pro_id = $request->pro_id;

        foreach(Cart::content() as $row)
        {
            if($row->id==$pro_id)
            {
                Cart::remove($row->rowId);
            }

        }


        $content = '';
        $data = [];



        foreach(Cart::content() as $row)
        {
            $content.=' <div class="cart_item">';
            $content.=' <div class="cart_img">';
            $content.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $content.=' </div>';
            $content.='<div class="cart_info">';
            $content.=' <a href="#">'.$row->name.'</a>';
            $content.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $content.='     </div>';
            $content.='     <div class="cart_remove">';
            $content.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $content.='    </div>';
            $content.='   </div>';
        }


        $data['content'] = $content;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();

        return response()->json($data);
    }
    public function deleteToCart(Request $request)
    {
        $pro_id = $request->pro_id;

        foreach(Cart::content() as $row)
        {
            if($row->id==$pro_id)
            {
                Cart::remove($row->rowId);
            }

        }


        $content = '';
        $content1 = '';
        $data = [];

        $content.=' <table width="100%">';
        $content.=' <tbody>';
        foreach(Cart::content() as $row) {
            $content.=' <tr >';
            $content.='     <td class="cart-item-count p-1 text-center" style = "10%" >';
            $content.='            <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');"><i class="ion-android-arrow-dropup" style = "font-size:24px" ></i ></a>';
            $content.='             <br />';
            $content.='               <span > '.$row->qty.'</span >';
            $content.='                    <br />';
            $content.='         <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');"><i class="ion-android-arrow-dropdown" style = "font-size:24px" ></i ></a>';
            $content.='       </td >';
            $content.='         <td class="product-thumb-sm" style = "20%" >';
            $content.='            <img src = "'.asset($row->options->product_image).'" />';
            $content.='        </td >';
            $content.='            <td class="product-details" style="padding-left: 8px">';
            $content.='          <div class="row" >';
            $content.='                 <div class="col-md-12" >';
            $content.='     <p class="title mb-0" >'.$row->name.' </p >';
            $content.='         </div >';
            $content.='    </div >';
            $content.='            <div class="row price" >';
            $content.='       <div class="col-md-6" >';
            $content.='   <span > '.$row->qty.' X ৳ '.$row->price.' </span >';
            $content.='</div >';
            $content.=' <div class="col-md-6" >';
            $content.='   <span > ৳ '.($row->price*$row->qty).' </span >';
            $content.='</div >';
            $content.='    </div >';
            $content.='</td >';
            $content.=' <td class="remove-item-btn px-2" >';
            $content.='  <button onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style = "font-size:20px" ></i ></button >';
            $content.='       </td >';
            $content.='    </tr >';
        }


        $content.='        </tbody>';
        $content.='     </table>';

        $content1.='<table width="100%">';
        $content1.='      <tbody>';
        foreach(Cart::content() as $row) {

            $content1 .= ' <tr>';
            $content1 .= ' <td class="cart-item-count p-1 text-center" style="width:10%">';
            $content1 .= '  <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropup" style="font-size:24px"></i></a>';
            $content1 .= '     <br />';
            $content1 .= '                <span>'.$row->qty.'</span>';
            $content1 .= '              <br />';
            $content1 .= '                <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropdown" style="font-size:24px"></i></a>';
            $content1 .= '           </td>';
            $content1 .= '      <td class="product-thumb-sm" style="width:20%">';
            $content1 .= '          <img src= "'.asset($row->options->product_image).'" />';
            $content1 .= '               </td>';
            $content1 .= '               <td class="product-details">';
            $content1 .= '                <div class="row">';
            $content1 .= '                   <div class="col-md-12">';
            $content1 .= '                      <p class="title mb-0">'.$row->name.' </p>';
            $content1 .= '                      </div>';
            $content1 .= '            </div>';
            $content1 .= '               <div class="row">';
            $content1 .= '               <div class="col-6">'.$row->qty.' X ৳ '.$row->price.' </div>';
            $content1 .= '                 <div class="col-6"> ৳ '.($row->price*$row->qty).' </div>';

            $content1 .= '          </div>';
            $content1 .= '       </td>';
            $content1 .= '          <td class="remove-item-btn px-2">';
            $content1 .= '         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style="font-size:20px"></i></a>';
            $content1 .= '             </td>';
            $content1 .= '           </tr>';
        }



        $content1.='        </tbody>';
        $content1.='           </table>';

        $cart_table = '';
        $discount_total_amount = 0;

        foreach(\Cart::content() as $row) {

            $cart_table .= '<tr>';

            $cart_table .= '<td ><a href="javascript:void(0)"><img src="' . asset($row->options->product_image) . '" alt="" width="50px"></a><br><a href="javascript:void(0)" onclick="delete_confirm(' . $row->id . ')"><i class="fa fa-times" style="font-size:15px;color:red"></i></a></td>';
            $cart_table .= '<td ><a href="javascript:void(0)">' . $row->name . '</a>-<span style="font-weight: bold;color: #0ba360">' . $row->options->weight ." ". $row->options->unit . '</span></td>';

            $cart_table .= '<td><div class="row">';
            if($row->options->discount){
                $cart_table.='<div class="col-md-6 text-center">' . number_format($row->price) . ' Tk</div><div class="col-md-6 text-center">';
                $cart_table .= '&nbsp;&nbsp;<del style="color:gray">' . ($row->price + $row->options->discount) . ' Tk</del>';

            }else{
                $cart_table.='<div class="col-md-12 text-center">' . number_format($row->price) . ' Tk';

            }

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td  align="center">';
            $cart_table .= '<div class="input-group mb-3">';
            $cart_table .= ' <div class="input-group-append">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="delete_cart('.$row->id.');" ><i class="fa fa-minus"></i></button>';
            $cart_table .= ' <input  type="number"  class="qty_update"  style="text-align: center;font-size: 16px;font-weight: bold;border: 1px solid gray" min="1" id="pro_'.$row->id.'" readonly="" value="'.$row->qty.'">';
            $cart_table .= ' <button class="btn btn-secondary change_btn" type="button" onclick="update_cart('.$row->id.');"><i class="fa fa-plus"></i></button>';

            $cart_table .= '</div></div></td>';
            $cart_table .= '<td >' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table .= '</tr>';

        }
        $cart_table_final = '';
        $discount_total_amount = 0;

        $sl = 1;
        foreach(\Cart::content() as $row) {

            $cart_table_final .= '<tr>';
            $cart_table_final .= '<td width="50%"><strong>'.$sl++.'.</strong> '.$row->name.'-'.$row->options->weight.$row->options->unit.'</td>';

            $cart_table_final .= '<td width="20%"><span>'.number_format($row->price).' Tk</span>';
            if ($row->options->discount) {

                $cart_table_final .= '<span style="text-decoration: line-through">'.number_format($row->price+$discount_total_amount).' Tk</span>';
            }
            $cart_table_final .= '</td>';
            $cart_table_final .= '<td width="10%" style="text-align: center" >';
            $cart_table_final .= '<strong>'.$row->qty.'</strong>';
            $cart_table_final .= '</td >';

            $cart_table_final .= '<td width="20%">' . number_format($row->price * $row->qty) . ' Tk</td>';
            $cart_table_final .= '</tr>';

        }



        $cart_view1 ='';
        foreach(Cart::content() as $row)
        {
            $cart_view1.=' <div class="cart_item">';
            $cart_view1.=' <div class="cart_img">';
            $cart_view1.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view1.=' </div>';
            $cart_view1.='<div class="cart_info">';
            $cart_view1.=' <a href="#">'.$row->name.'</a>';
            $cart_view1.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view1.='     </div>';
            $cart_view1.='     <div class="cart_remove">';
            $cart_view1.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view1.='    </div>';
            $cart_view1.='   </div>';
        }


        $data['cart_view1'] = $cart_view1;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();

        $data['content'] = $content;
        $data['content1'] = $content1;
        $data['cart_table'] = $cart_table;
        $data['cart_table_final'] = $cart_table_final;
        return response()->json($data);
    }
    public function addToCart(Request $request)
    {
        $content = '';
        $content1 = '';
        $stock = 1;
        $data = [];
        $product = Product::where('id',$request->product_id)->where('stock',1)->first();
        if($product){
            $productImage = ProductImage::where('product_id',$request->product_id)->first();
            $iamge = $productImage->name;

            $discount_amount = 0;
            $product_price = 0;

            if(!empty($product->discount_type)){

                if($product->discount_type ==1){
                    $discount_amount = $product->price*($product->discount/100);
                    $product_price = $product->price-$discount_amount;
                }
                else{
                    $discount_amount = $product->discount;
                    $product_price = $product->price-$discount_amount;
                }

            }else{
                $discount_amount = 0;
                $product_price = $product->price;
            }



            Cart::add(['id' => $product->id, 'name' => $product->name, 'qty' => 1, 'price' => $product_price, 'options' => ['product_image' => $iamge,'discount'=>$discount_amount,'unit_id'=>$product->unit_id,'unit'=>$product->unit->name,'weight'=>$product->weight]]);

            $stock = 1;
        }
        else{
            $stock = 0;
        }


        $content.=' <table width="100%">';
        $content.=' <tbody>';
        foreach(Cart::content() as $row) {
            $content.=' <tr >';
            $content.='     <td class="cart-item-count p-1 text-center" style = "10%" >';
            $content.='            <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');"><i class="ion-android-arrow-dropup" style = "font-size:24px" ></i ></a>';
            $content.='             <br />';
            $content.='               <span > '.$row->qty.'</span >';
            $content.='                    <br />';
            $content.='        <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropdown" style = "font-size:24px" ></i ></a>';
            $content.='       </td >';
            $content.='         <td class="product-thumb-sm" style = "20%" >';
            $content.='            <img src = "'.asset($row->options->product_image).'" />';
            $content.='        </td >';
            $content.='            <td class="product-details" style="padding-left: 8px">';
            $content.='          <div class="row" >';
            $content.='                 <div class="col-md-12" >';
            $content.='     <p class="title mb-0" >'.$row->name.' </p >';
            $content.='         </div >';
            $content.='    </div >';
            $content.='            <div class="row price" >';
            $content.='       <div class="col-md-6" >';
            $content.='   <span > '.$row->qty.' X ৳ '.$row->price.' </span >';
            $content.='</div >';
            $content.=' <div class="col-md-6" >';
            $content.='   <span > ৳ '.($row->price*$row->qty).' </span >';
            $content.='</div >';
            $content.='    </div >';
            $content.='</td >';
            $content.=' <td class="remove-item-btn px-2" >';
            $content.='  <button onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style = "font-size:20px" ></i ></button >';
            $content.='       </td >';
            $content.='    </tr >';
        }


        $content.='        </tbody>';
        $content.='     </table>';

        $content1.='<table width="100%">';
        $content1.='      <tbody>';
        foreach(Cart::content() as $row) {

            $content1 .= ' <tr>';
            $content1 .= ' <td class="cart-item-count p-1 text-center" style="width:10%">';
            $content1 .= '  <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropup" style="font-size:24px"></i></a>';
            $content1 .= '     <br />';
            $content1 .= '                <span>'.$row->qty.'</span>';
            $content1 .= '              <br />';
            $content1 .= '                <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropdown" style="font-size:24px"></i></a>';
            $content1 .= '           </td>';
            $content1 .= '      <td class="product-thumb-sm" style="width:20%">';
            $content1 .= '          <img src= "'.asset($row->options->product_image).'" />';
            $content1 .= '               </td>';
            $content1 .= '               <td class="product-details">';
            $content1 .= '                <div class="row">';
            $content1 .= '                   <div class="col-md-12">';
            $content1 .= '                      <p class="title mb-0">'.$row->name.' </p>';
            $content1 .= '                      </div>';
            $content1 .= '            </div>';
            $content1 .= '               <div class="row">';
            $content1 .= '               <div class="col-6">'.$row->qty.' X ৳ '.$row->price.' </div>';
            $content1 .= '                 <div class="col-6"> ৳ '.($row->price*$row->qty).' </div>';

            $content1 .= '          </div>';
            $content1 .= '       </td>';
            $content1 .= '          <td class="remove-item-btn px-2">';
            $content1 .= '         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style="font-size:20px"></i></a>';
            $content1 .= '             </td>';
            $content1 .= '           </tr>';
        }



        $content1.='        </tbody>';
        $content1.='           </table>';

        $cart_view1 ='';
        foreach(Cart::content() as $row)
        {
            $cart_view1.=' <div class="cart_item">';
            $cart_view1.=' <div class="cart_img">';
            $cart_view1.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view1.=' </div>';
            $cart_view1.='<div class="cart_info">';
            $cart_view1.=' <a href="#">'.$row->name.'</a>';
            $cart_view1.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view1.='     </div>';
            $cart_view1.='     <div class="cart_remove">';
            $cart_view1.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view1.='    </div>';
            $cart_view1.='   </div>';
        }


        $data['cart_view1'] = $cart_view1;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();


        $data['content'] = $content;
        $data['content1'] = $content1;
        if($product) {
            $data['pro_image'] = asset($iamge);
            $data['name'] =   $product->name;
            $data['unit_name'] =  $product->unit->name;
            $data['price'] =  $product_price;
            $data['weight'] =  $product->weight;
        }

        $data['stock'] =  $stock;
        return response()->json($data);
    }

    public function addToCartFull()
    {
        $content = '';
        $content1 = '';
        $data = [];
        if(Cart::count()>0) {
            $content .= ' <table width="100%">';
            $content .= ' <tbody>';
            foreach (Cart::content() as $row) {
                $content .= ' <tr >';
                $content .= '     <td class="cart-item-count p-1 text-center" style = "10%" >';
                $content .= '           <a href="javascript:void(0)" onclick="update_cart_qty(' . $row->id . ');"><i class="ion-android-arrow-dropup" style = "font-size:24px" ></i ></a>';
                $content .= '             <br />';
                $content .= '               <span > ' . $row->qty . '</span >';
                $content .= '                    <br />';
                $content .= '        <a href="javascript:void(0)" onclick="delete_cart_qty(' . $row->id . ');"> <i class="ion-android-arrow-dropdown" style = "font-size:24px" ></i ></a>';
                $content .= '       </td >';
                $content .= '         <td class="product-thumb-sm" style = "20%" >';
                $content .= '            <img src = "' . asset($row->options->product_image) . '" />';
                $content .= '        </td >';
                $content .= '            <td class="product-details" style="padding-left: 8px">';
                $content .= '          <div class="row" >';
                $content .= '                 <div class="col-md-12" >';
                $content .= '     <p class="title mb-0" >' . $row->name . ' </p >';
                $content .= '         </div >';
                $content .= '    </div >';
                $content .= '            <div class="row price" >';
                $content .= '       <div class="col-md-6" >';
                $content .= '   <span > ' . $row->qty . ' X ৳ ' . $row->price . ' </span >';
                $content .= '</div >';
                $content .= ' <div class="col-md-6" >';
                $content .= '   <span > ৳ ' . ($row->price * $row->qty) . ' </span >';
                $content .= '</div >';
                $content .= '    </div >';
                $content .= '</td >';
                $content .= ' <td class="remove-item-btn px-2" >';
                $content .= '  <button onclick="delete_product(' . $row->id . ')"><i class="ion-android-cancel" style = "font-size:20px" ></i ></button >';
                $content .= '       </td >';
                $content .= '    </tr >';
            }


            $content .= '        </tbody>';
            $content .= '     </table>';
        }else{
            $content.='<h3 style="padding: 30px;font-size: 20px;text-align: justify-all"><i class="lnr lnr-cart"></i> Empty Shopping Cart.Please Add product</h3>';
        }
        if(Cart::count()>0) {
        $content1.='<table width="100%">';
        $content1.='      <tbody>';
        foreach(Cart::content() as $row) {

            $content1 .= ' <tr>';
            $content1 .= ' <td class="cart-item-count p-1 text-center" style="width:10%">';
            $content1 .= '  <a href="javascript:void(0)" onclick="update_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropup" style="font-size:24px"></i></a>';
            $content1 .= '     <br />';
            $content1 .= '                <span>'.$row->qty.'</span>';
            $content1 .= '              <br />';
            $content1 .= '                <a href="javascript:void(0)" onclick="delete_cart_qty('.$row->id.');">  <i class="ion-android-arrow-dropdown" style="font-size:24px"></i></a>';
            $content1 .= '           </td>';
            $content1 .= '      <td class="product-thumb-sm" style="width:20%">';
            $content1 .= '          <img src= "'.asset($row->options->product_image).'" />';
            $content1 .= '               </td>';
            $content1 .= '               <td class="product-details">';
            $content1 .= '                <div class="row">';
            $content1 .= '                   <div class="col-md-12">';
            $content1 .= '                      <p class="title mb-0">'.$row->name.' </p>';
            $content1 .= '                      </div>';
            $content1 .= '            </div>';
            $content1 .= '               <div class="row">';
            $content1 .= '               <div class="col-6">'.$row->qty.' X ৳ '.$row->price.' </div>';
            $content1 .= '                 <div class="col-6"> ৳ '.($row->price*$row->qty).' </div>';

            $content1 .= '          </div>';
            $content1 .= '       </td>';
            $content1 .= '          <td class="remove-item-btn px-2">';
            $content1 .= '         <a href="javascript:void(0)" onclick="delete_product('.$row->id.')"><i class="ion-android-cancel" style="font-size:20px"></i></a>';
            $content1 .= '             </td>';
            $content1 .= '           </tr>';
        }



        $content1.='        </tbody>';
        $content1.='           </table>';
    }else{
            $content1.='<h3 style="padding: 30px;font-size: 20px;text-align: justify-all"><i class="lnr lnr-cart"></i> Empty Shopping Cart.Please Add product</h3>';
        }

        $cart_view1 ='';
        foreach(Cart::content() as $row)
        {
            $cart_view1.=' <div class="cart_item">';
            $cart_view1.=' <div class="cart_img">';
            $cart_view1.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view1.=' </div>';
            $cart_view1.='<div class="cart_info">';
            $cart_view1.=' <a href="#">'.$row->name.'</a>';
            $cart_view1.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view1.='     </div>';
            $cart_view1.='     <div class="cart_remove">';
            $cart_view1.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view1.='    </div>';
            $cart_view1.='   </div>';
        }


        $data['cart_view1'] = $cart_view1;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();




        $data['content'] = $content;
        $data['content1'] = $content1;
        return response()->json($data);
    }

    public function addToCartMini()
    {
        $content = '';
        $data = [];



        $content.=' <a href="javascript:void(0)"><i class="fa fa-cart-arrow-down" aria-hidden="true" style="color:#40A944"></i><span class="item_count">2</span></a>';

        $content.='   <div class="mini_cart">';
        $content.='     <div class="cart_gallery">';
        $content.='     <div class="cart_item">';
        $content.='   <div class="cart_img">';
        $content.='       <a href="#"><img src="'.asset('frontend/assets/img/s-product/product.jpg').'" alt=""></a>';
        $content.='     </div>';
        $content.=' <div class="cart_info">';
        $content.='     <a href="#">Primis In Faucibus</a>';
        $content.='        <p>1 x <span> $100.00 </span></p>';
        $content.='       </div>';
        $content.='      <div class="cart_remove">';
        $content.='  <a href="#"><i class="icon-x"></i></a>';
        $content.='         </div>';
        $content.='            </div>';

        $content.='          </div>';
        $content.='       <div class="mini_cart_table">';
        $content.='       <div class="cart_table_border">';
        $content.='      <div class="cart_total">';
        $content.='         <span>Sub total:</span>';
        $content.=' <span class="price">$125.00</span>';
        $content.='   </div>';
        $content.='     <div class="cart_total mt-10">';
        $content.='     <span>total:</span>';
        $content.='     <span class="price">$125.00</span>';
        $content.='        </div>';
        $content.='             </div>';
        $content.='           </div>';
        $content.='     <div class="mini_cart_footer">';
        $content.='    <div class="cart_button">';
        $content.='    <a href="cart.html"><i class="fa fa-shopping-cart"></i> View cart</a>';
        $content.='   </div>';

        $content.='       </div>';
        $content.='     </div>';

        $cart_view1 ='';
        foreach(Cart::content() as $row)
        {
            $cart_view1.=' <div class="cart_item">';
            $cart_view1.=' <div class="cart_img">';
            $cart_view1.='  <a href="#"><img src="'.asset($row->options->product_image).'" alt=""></a>';
            $cart_view1.=' </div>';
            $cart_view1.='<div class="cart_info">';
            $cart_view1.=' <a href="#">'.$row->name.'</a>';
            $cart_view1.=' <p>'.$row->qty.' x <span> '.$row->price.' </span>= <span>'.($row->price*$row->qty).'</span></p>';
            $cart_view1.='     </div>';
            $cart_view1.='     <div class="cart_remove">';
            $cart_view1.='         <a href="javascript:void(0)" onclick="delete_product_mini('.$row->id.')"><i class="fa fa-trash"></i></a>';
            $cart_view1.='    </div>';
            $cart_view1.='   </div>';
        }


        $data['cart_view1'] = $cart_view1;
        $data['price_mini1'] = Cart::subtotal();
        $data['price_mini2'] = Cart::subtotal();
        $data['item_count_mini'] = Cart::content()->count();




        $data['content'] = $content;
        return response()->json($data);
    }


}
