<?php

namespace App\Http\Controllers;

use App\Blling;
use App\Contact;
use App\Cupon;
use App\Order;
use App\OrderDetail;
use App\Product;
use Illuminate\Http\Request;
use DB;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('CheckAdmin');
    }

    public function dailySaleReport()
    {

        return view('backend.admin.report.daily-sale-report');
    }

    public function cuponReport()
    {
        return view('backend.admin.report.cupon-report');
    }

    public function productSaleReportSearch(Request $request)
    {
        if ($request->product_id == 'all') {
            $product_id = $request->product_id;
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
            $order_details = DB::select(DB::raw("SELECT product_id,SUM(qty) as total_qty,sum(qty*sales_rate) as total_amount,sum(qty*discount_amount) as total_discount FROM `order_details` WHERE order_date>='$start_date' AND order_date<='$end_date' AND order_status=3 GROUP BY product_id"));
            $data = [];

            $data['products'] = Product::all();
            $data['order_details'] = $order_details;
            $data['product_id'] = 'all';
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            return view('backend.admin.report.product-sale-report-all', $data);

        } else {

            $product_id = $request->product_id;
            $start_date = date('Y-m-d', strtotime($request->start_date));
            $end_date = date('Y-m-d', strtotime($request->end_date));
            $order_details = OrderDetail::where('order_date', '>=', $start_date)
                ->where('order_date', '<=', $end_date)
                ->where('product_id', $product_id)
                ->where('order_status', 3)
                ->get();
            $data = [];
            $data['products'] = Product::all();
            $data['order_details'] = $order_details;
            $data['product_id'] = $product_id;
            $data['start_date'] = $start_date;
            $data['end_date'] = $end_date;
            return view('backend.admin.report.product-sale-report-view', $data);

        }

    }

    public function cuponReportView(Request $request)
    {

        $cupon =  Cupon::where('code',$request->code)->first();
        $data = [];
        $data['cupon'] = $cupon;
        $data['code'] = $request->code;

        return view('backend.admin.report.cupon-report-view',$data);
    }
    public function contactReport()
    {

        $billings =   DB::select(DB::raw("select distinct mobile from bllings"));
        $customers =   DB::select(DB::raw("select * from customers where phone NOT IN(select distinct mobile from bllings)"));


        $shipping =   DB::select(DB::raw("select distinct mobile from other_shippings"));
        $data = [];

        $data['billings'] = $billings;
        $data['shipping'] = $shipping;
        $data['customers'] = $customers;

        return view('backend.admin.report.contact-report',$data);
    }
    public function dailySaleReportSearch(Request $request)
    {
        $start_date = date('Y-m-d',strtotime($request->start_date));
        $end_date = date('Y-m-d',strtotime($request->end_date));
        $orders =  Order::where('delivery_date', '>=', $start_date)
            ->where('delivery_date', '<=', $end_date)
            ->where('order_status',3)
            ->get();
        $data = [];
        $data['orders'] = $orders;
        $data['start_date'] = $start_date;
        $data['end_date'] = $end_date;
        return view('backend.admin.report.daily-sale-report-view',$data);

    }
    public function productSaleReport()
    {
        $data = [];
        $data['products'] = Product::all();
        return view('backend.admin.report.product-sale-report',$data);
    }
}
