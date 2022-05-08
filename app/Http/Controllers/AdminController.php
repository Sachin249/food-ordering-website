<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class AdminController extends Controller
{
   
    public function index(Request $req)
    {
        if($req->session()->has('ADMIN_LOGIN'))
        {
            return redirect('admin/dashboard');
        }else
        {
            return view('admin.admin_login'); 
        }
        return view('admin.admin_login');
        
    }
    public function auth(Request $req)
    {
        $email=$req->post('email');
        $password=$req->post('password');
        $result=DB::table('admins')->where(['email'=>$email,'password'=>$password])->get();
        if(isset($result['0']->id))
        {
            $req->session()->put('ADMIN_LOGIN',true);
            $req->session()->put('ADMIN_ID',$result['0']->id);
            $req->session()->put('ADMIN_EMAIL',$result['0']->email);
            return redirect('admin/dashboard');
        }
        else
        {
            $req->session()->flash('error','Please Enter Valid Login Details');
            return redirect('admin'); 
        }
    } 

    public function dashboard()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $usersData=DB::table('users')->where('user_status','1')->get();
        return view('admin.dashboard',['noti'=>$countNotification,'Admin'=>$sessionData,'users'=>$usersData]);
    }

    public function getLogout(Request $req)
    {
        $req->session()->flush();
        return redirect('/admin');
    }

    public function users()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $usersData=DB::table('users')->get();
        return view('admin/users',['users'=>$usersData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    
    public function updateUserStatus(Request $req,$status_value,$id)
    {
        $updateCategoryStatus=DB::table('users')->where('id',$id)->update(
            [
               'user_status'=>$req->status_value,
            ]
            );
    return redirect (route('users_view'))->with('status','User Status Updated Successfully');
    }

    public function notification()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $updateNotification=DB::table('orders_details')->where('notification','1')->update(
            ['notification'=>'0']
        );
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $Data = DB::table('orders_details')
                ->select('orders_details.*','orders.customer_id','orders.name','orders.email','orders.mobile','orders.address','products.product_name','products.product_desc','products.product_price','products.product_image')
                ->join('orders', 'orders.id', '=', 'orders_details.order_id')
                ->join('products', 'products.id', '=', 'orders_details.product_id')
                ->get();
        return view('admin/orders',['noti'=>$countNotification,'OrderData'=>$Data,'Admin'=>$sessionData]);
    }

}
