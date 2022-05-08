<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
class CouponController extends Controller
{
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $GetCouponData=DB::table('coupons')->get();
        return view('admin/coupon',['coupon_data'=>$GetCouponData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }

    public function manage_coupon()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        return view('admin/manage_coupon',['noti'=>$countNotification,'Admin'=>$sessionData]);
    }

    public function create(Request $req)
    {
        $req->validate(
            [
                'coupon_title'=>'required',
                'coupon_code'=>'required|unique:coupons,code',
                'coupon_value'=>'required|numeric',
                'coupon_type'=>'required',
                'min_order_amt'=>'required|numeric',
                'is_one_time'=>'required',
            ]
            );
                DB::table('coupons')->insert(
                    [
                        'title'=>$req->coupon_title,
                        'code'=>$req->coupon_code,
                        'value'=>$req->coupon_value,
                        'type'=>$req->coupon_type,
                        'min_order_amt'=>$req->min_order_amt,
                        'is_one_time'=>$req->is_one_time,
                    ]
                    );

            $req->session()->flash('status','Coupon Added Successfully');
            return redirect('admin/coupon');
    }

    public function updateCouponStatus($status_value,$id)
    {
        $updateCouponStatus=DB::table('coupons')->where('id',$id)->update(
            [
               'status'=>$status_value,
            ]
            );
    return redirect (route('coupon_view'))->with('status','Coupon Status Updated Successfully');
    }

    public function delete(Request $request,$id)
    {
        DB::table('coupons')->where('id',$id)->delete();
        return redirect (route('coupon_view'))->with('status','Coupon Deleted Successfully');
    }

    public function edit($id)
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $CouponData=DB::table('coupons')->find($id);
        return view('admin/edit_coupon',['CouponData'=>$CouponData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    
    public function update(Request $req,$id)
    {
        
            $UpdateCouponData=DB::table('coupons')->where('id',$id)->update(
                [
                    'title'=>$req->coupon_title,
                    'code'=>$req->coupon_code,
                    'value'=>$req->coupon_value,
                    'type'=>$req->coupon_type,
                    'min_order_amt'=>$req->min_order_amt,
                    'is_one_time'=>$req->is_one_time,
                ]
                );
        
        return redirect (route('coupon_view'))->with('status','Coupon Updated Successfully');
    }
}
