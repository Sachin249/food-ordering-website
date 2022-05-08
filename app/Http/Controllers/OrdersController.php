<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class OrdersController extends Controller
{
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $updateNotification=DB::table('orders_details')->where('notification','1')->update(
            ['notification'=>'0']
        );
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $Data =DB::table('orders_details')
                ->select('orders_details.*','orders.customer_id','orders.name','orders.email','orders.mobile','orders.address','products.product_name','products.product_desc','products.product_price','products.product_image')
                ->join('orders', 'orders.id', '=', 'orders_details.order_id')
                ->join('products', 'products.id', '=', 'orders_details.product_id')
                ->get();
        return view('admin/orders',['noti'=>$countNotification,'OrderData'=>$Data,'Admin'=>$sessionData]);
    }
    public function updateOrderStatus($status_value,$id)
    {
        $updateOrderStatus=DB::table('orders_details')->where('id',$id)->update(
            [
               'order_status'=>$status_value,
            ]
            );
        return redirect ('admin/orders')->with('status','Order Status Updated Successfully');
    }
    public function updatePackedStatus($order_packed_value,$id)
    {
        $updatePackedStatus=DB::table('orders_details')->where('id',$id)->update(
            [
               'packed_by_courier'=>$order_packed_value,
            ]
            );
        return redirect ('admin/orders')->with('status','Packed Status Updated Successfully');
    }
    public function updateOnwayStatus($on_the_way_value,$id)
    {
        $updateOnwayStatus=DB::table('orders_details')->where('id',$id)->update(
            [
               'on_the_way'=>$on_the_way_value,
            ]
            );
        return redirect ('admin/orders')->with('status','Onway Status Updated Successfully');
    }
    public function updateDeliveredStatus($order_delivered_value,$id)
    {
        $updateDeliveredStatus=DB::table('orders_details')->where('id',$id)->update(
            [
               'delivered'=>$order_delivered_value,
            ]
            );
        return redirect ('admin/orders')->with('status','Delivered Status Updated Successfully');
    }
}
