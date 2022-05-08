<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Session;
use Cookie;
use Mail;
class UserController extends Controller
{
    public function index(Request $req)
    {
        if($req->session()->has('USER_LOGIN'))
        {
            return redirect('user/homepage');
        }else
        {
            return view('user.user_login'); 
        }
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        return view('user/layout',['Userdata'=>$userData]);
        
    }
    public function auth(Request $req)
    {
        $email=$req->post('user_email');
        $password=$req->post('user_password');
        $result=DB::table('users')->select('*')->where(['email'=>$email,'password'=>$password])->get();
        if(isset($result['0']->id))
        {
                if($req->rememberme===null)
                {
                    Cookie::queue('login_email','', 10);
                    Cookie::queue('login_pwd','', 10);
                }
                else
                {
                    Cookie::queue('login_email', $req->post('user_email'), 10);
                    Cookie::queue('login_pwd', $req->post('user_password'), 10);
                }
            if($result['0']->user_status==1)
            {
                if($result['0']->is_verify==1)
                {
                    $req->session()->put('USER_LOGIN',true);
                    $req->session()->put('USER_ID',$result['0']->id);
                    $req->session()->put('USER_NAME',$result['0']->name);
                    $req->session()->put('USER_EMAIL',$result['0']->email);
                    $req->session()->put('USER_IMAGE',$result['0']->user_image);
                    $req->session()->put('USER_ADDRESS',$result['0']->address);
                    return redirect('user/homepage');
                }
                else{
                    $req->session()->flash('error','Account not verified !');
                    return redirect('/user_login'); 
                }
            }
            else
            {
                $req->session()->flash('error','Account deactivated !');
                return redirect('/user_login'); 
            }   
        }
        else
        {
            $req->session()->flash('error','Please Enter Valid Login Details');
            return redirect('/user_login'); 
        }
    } 

    public function user_registration(Request $req)
    {
        $req->validate(
            [
                'u_name'=>'required',
                'u_password'=>'required',
                'u_repeat_password'=>'required',
                'u_email'=>'required|unique:users,email',
            ]
            );
        
         if($req->post('u_password')==$req->post('u_repeat_password'))
         {
            $rand_id=rand(111111111,999999999);
            $registration=DB::table('users')->insert(
                [
                   'name'=>$req->post('u_name'),
                   'email'=>$req->post('u_email'),
                   'password'=>$req->post('u_password'),
                   'is_verify'=>0,
                   'rand_id'=>$rand_id,
                ]
                );
                if($registration)
                {
                    $data=['name'=>$req->post('u_name'),'rand_id'=>$rand_id];
                    $user['to']=$req->post('u_email');
                    Mail::send('user/email_verification',$data,function($messages) use 
                    ($user)
                    {
                       $messages->to($user['to']);
                       $messages->subject('Email Id Verification');
   
                    });
                
                }
                $req->session()->flash('status','Registered Successfully, Please check your gmail for verification.');
                return redirect('/user_login');
         }
         else
         {
            $req->session()->flash('error','Password & confirm password must be same');
            return redirect('/user_login');
         }
         
    }

    public function homepage()
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $contactData=DB::table('contact')->get();
        $userData=DB::table('users')->find($userid);
        $serviceData=DB::table('services')->where(['service_status'=>1])->get();
        $staffData=DB::table('staff')->where(['staff_status'=>1])->get();
        $productdata=DB::table('products')->get();
        $productcategory['product_categories']=DB::table('categories')
                                                   ->where(['status'=>1])
                                                   ->get();
        foreach($productcategory['product_categories'] as $list)
        {
            
            $productcategory['product_data'] [$list->id]=DB::table('products')
                ->where(['status'=>1])
                ->where(['product_category'=>$list->id])
                ->get();
           
            
        }
        return view('user.homepage',$productcategory,['ProductData'=>$productdata,'service'=>$serviceData,'staff'=>$staffData,'contact'=>$contactData,'Userdata'=>$userData]);
    }
    public function getLogout(Request $req){
        
        $req->session()->flush();
        return redirect('/user_login');
    }
    
    public function product_details($productid)
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        $product_details=DB::table('products')->find($productid);
        $category_details=DB::table('categories')->find($product_details->product_category);
        return view('user.view_product_details',['ProductDetails'=>$product_details,'category_data'=>$category_details,'Userdata'=>$userData]);
    }
    public function purchase_order(Request $req,$productid)
    {
        
        DB::table('purchase_orders')->insert(
            [
                'product_id'=>$productid,
                'quantity'=>$req->quantity,
                'price'=>$req->pro_price,
                'subtotal'=>$req->subtotal,
                'fullname'=>$req->full_name,
                'useremail'=>$req->user_email,
                'profile_email'=>$req->profile_email,
                'mobileno'=>$req->user_mobile,
                'address'=>$req->user_address,
            ]
            );
            $req->session()->flash('status','Ordered Successfully');
            return redirect('/user/homepage');
    }
    public function myorders()
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $useremail=Session::get('USER_EMAIL');
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        $Data = DB::table('orders_details')
                ->select('orders_details.*','orders.customer_id','orders.name','orders.email','orders.mobile','orders.address','orders.total_amt','orders.coupon_code','products.product_name','products.product_desc','products.product_price','products.product_image')
                ->where('customer_id',$useremail)
                ->join('orders', 'orders.id', '=', 'orders_details.order_id')
                ->join('products', 'products.id', '=', 'orders_details.product_id')
                ->get();
        return view('user/myorders',['OrderData'=>$Data,'User'=>$sessionData,'Userdata'=>$userData]);
    }
    public function searchProduct(Request $req)
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        $searchProduct=$req->input('search');
        $searchResult=DB::table('products')->where('product_name','like','%'.$searchProduct.'%')->get();
        return view('user/searchresult',['productData'=>$searchResult,'Userdata'=>$userData]);
    }
    public function order_status($orderid,$productid)
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $useremail=Session::get('USER_EMAIL');
        $userData=DB::table('users')->find($userid);
        $Data = DB::table('orders_details')
                ->select('orders_details.*','orders.customer_id','orders.name','orders.email','orders.mobile','orders.address','products.product_name','products.product_desc','products.product_price','products.product_image')
                ->where(['orders_details.id'=>$orderid,'customer_id'=>$useremail])
                ->join('orders', 'orders.id', '=', 'orders_details.order_id')
                ->join('products', 'products.id', '=', 'orders_details.product_id')
                ->get();
        return view('user/orderstatus',['OrderData'=>$Data,'User'=>$sessionData,'Userdata'=>$userData]);
    }
    public function edit_profile()
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        return view('user/account_setting',['Userdata'=>$userData,'User'=>$sessionData]);
    }
    public function update_profile(Request $req,$userid)
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $UserOldtData=DB::table('users')->find($userid);
        if($req->hasfile('user_image'))
        {
            $destination='user_uploads/profile_images/'.$UserOldtData->user_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file= $req->user_image;
            $extension= $file->getClientOriginalExtension();
            $filename = time().".".$extension;
            $file->move('user_uploads/profile_images/',$filename);
            $UserUpdateData=DB::table('users')->where('id',$userid)->update(
                [
                    'name'=>$req->user_name,
                    'email'=>$req->user_email,
                    'user_image'=>$filename,
                    'address'=>$req->user_address
                ]
                );
        }
        else {
            $UserUpdateData=DB::table('users')->where('id',$userid)->update(
                [
                    'name'=>$req->user_name,
                    'email'=>$req->user_email,
                    'address'=>$req->user_address
                ]
                );
        }   
        return redirect (route('account_setting'))->with('status','Record Updated Successfully');
    }
    public function change_password(Request $req,$userid)
    {
        $currentpwd=$req->current_pwd;
        $newpwd=$req->new_pwd;
        $confirmpwd=$req->confirm_pwd;
        if($newpwd==$confirmpwd)
        {
            $FetchOldData=DB::table('users')->find($userid);
            $oldPassword=$FetchOldData->password;
            if($currentpwd==$oldPassword)
            {
                $UserUpdateData=DB::table('users')->where('id',$userid)->update(
                    [
                        'password'=>$newpwd,
                    ]
                    );
                    return redirect (route('account_setting'))->with('status','Password Changed Successfully');
            }
            else
            {
                return redirect (route('account_setting'))->with('status','You Entered Wrong Current Password');
            }
        }
        else{
            return redirect (route('account_setting'))->with('status','You Entered Wrong Confirm Password');
        }
    }
    public function addToCart(Request $req)
    {
        $user_email=Session::get('USER_EMAIL');
        $product_id= $req->product_id;
        $product_qty= $req->pqty;
        $product_price=$req->product_price;
        $total_val=$req->total;
        $check=DB::table('cart')
                    ->where(['user_email'=>$user_email])
                    ->where(['product_id'=>$product_id])
                    ->get();
        if(isset($check[0]))
        {
            $updateid=$check[0]->cart_id;
            $Qty=$check[0]->product_qty+1;
            DB::table('cart')
                    ->where(['cart_id'=>$updateid])
                    ->update(['product_qty'=>$Qty,'total'=>$Qty * $check[0]->product_price]);
            $msg='Updated';
        }
        else{
            $id=DB::table('cart')->insertGetId([
                'user_email'=>$user_email,
                'product_id'=>$product_id,
                'product_qty'=>$product_qty,
                'product_price'=>$product_price,
                'total'=>$product_price*$product_qty
            ]);
            $msg="Added";
        }
        return response()->json([
            'msg'=>$msg,
        ]);
    }
    public function mycart()
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        $cartdata = DB::table('cart')
                ->join('products', 'products.id', '=', 'cart.product_id')
                ->get();
         return view('user/mycart',['Userdata'=>$userData,'cart'=>$cartdata]);
        
    }
    public function deleteCartProduct($id)
    {
        DB::table('cart')->where('cart_id',$id)->delete();
        return redirect (route('mycart'))->with('status','Product Deleted Successfully');
    }
    public function checkout()
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        $cartdata = DB::table('cart')
                    ->join('products', 'products.id', '=', 'cart.product_id')
                    ->get();
        $couponData=DB::table('coupons')
                    ->where('status','1')
                    ->get();
        return view('user/checkout',['Userdata'=>$userData,'Userdata'=>$userData,'cart'=>$cartdata,'couponData'=>$couponData]);
    }
    public function updateCart(Request $req)
    {
        $user_email=Session::get('USER_EMAIL');
        $product_id= $req->product_id;
        $product_qty= $req->pqty;
        $product_price=$req->product_price;
        $total_val=$req->total;
        $check=DB::table('cart')
                    ->where(['user_email'=>$user_email])
                    ->where(['product_id'=>$product_id])
                    ->get();
        if(isset($check[0]))
        {
            $updateid=$check[0]->cart_id;
            DB::table('cart')
                    ->where(['cart_id'=>$updateid])
                    ->update(['product_qty'=>$product_qty,'total'=>$product_qty*$check[0]->product_price]);
            $msg='Updated';
        }
        
        return response()->json([
            'msg'=>$msg,
        ]);
    }
    public function placeOrder(Request $req)
    {
        $payment_url='';
        $user_email=Session::get('USER_EMAIL');
           $Arr= [
                'customer_id'=>$user_email,
                'name'=>$req->uname,
                'email'=>$req->uemail,
                'country'=>$req->ucountry,
                'state'=>$req->ustate,
                'city'=>$req->ucity,
                'address'=>$req->uaddress,
                'mobile'=>$req->umobile,
                'coupon_code'=>$req->coupon_code,
                'payment_type'=>$req->payment_type,
                'payment_status'=>0,
                'payment_id'=>'',
                'total_amt'=>$req->total,
           ];
           $order_id=DB::table('orders')->insertGetId($Arr);
           if($order_id>0)
           {
                $cartData=DB::table('cart')->get();
                foreach($cartData as $list)
                {
                    $productDetails['order_id']=$order_id;
                    $productDetails['product_id']=$list->product_id;
                    $productDetails['price']=$list->product_price;
                    $productDetails['qty']=$list->product_qty;
                    DB::table('orders_details')->insert($productDetails);
                }
               
                if($req->payment_type=="Gateway")
                {
                    $ch = curl_init();

                    curl_setopt($ch, CURLOPT_URL, 'https://api.instamojo.com/v2/payment_requests/');
                    curl_setopt($ch, CURLOPT_HEADER, FALSE);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Authorization: Bearer test_777be588d8b1ffabed955603187',
                'X-Api-Key:test_8b71f71936658115f44ff8ac756',
                'X-Auth-Token:test_777be588d8b1ffabed955603187'
                ));

                    $payload = Array(
                    'purpose' => 'Buy Product',
                    'amount' => $req->total,
                    'buyer_name' => $req->uname,
                    'email' => $req->uemail,
                    'phone' => $req->umobile,
                    'redirect_url' => 'http://http://127.0.0.1:8000/payment_gateway_redirect/',
                    'send_email' => 'True',
                    'send_sms' => 'True',
                    'webhook' => 'http://www.example.com/webhook/',
                    'allow_repeated_payments' => 'False',
                    );

                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));
                    $response = curl_exec($ch);
                    curl_close($ch); 
                    $response=json_decode($response);
                    
                    print_r($response);
                    // $payment_url=$response->payment_request->longurl;
                    
                }
                DB::table('cart')->where(['user_email'=>$user_email])->delete();
                $req->session()->put('ORDER_ID',$order_id);
                $status="success";
                $msg="Order Placed";
           }
           else
           {
                $status="false";
                $msg="Please try after sometime";
           }
           return response()->json(['status'=>$status,'msg'=>$msg,'payment_url'=>$payment_url]);
    }
    public function order_placed(Request $req)
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        $order_id=session()->get('ORDER_ID');
        $orderData=DB::table('orders_details')
        ->select('orders_details.*','orders.customer_id','orders.name','orders.coupon_code','orders.total_amt','products.product_name',)
        ->where('order_id',$order_id)
        ->join('products', 'products.id', '=', 'orders_details.product_id')
        ->join('orders', 'orders.id', '=', 'orders_details.order_id')
        ->get();

        $coupon_code= $orderData[0]->coupon_code;
        $couponData=DB::table('coupons')
        ->select('orders.coupon_code','coupons.*')
        ->where('code',$coupon_code)
        ->join('orders', 'orders.coupon_code', '=', 'coupons.code')
        ->get();
        // echo "<pre>";
        // print_r($couponData);
        // die();
        if($req->session()->has('ORDER_ID'))
        {
            return view('user/order_placed',['Userdata'=>$userData,'orderData'=>$orderData,'couponData'=>$couponData]);
        }
    }
    public function apply_coupon_code(Request $req)
    {
        $totalprice=0;
        $result=DB::table('coupons')
                ->where(['code'=>$req->coupon_code])
                ->get();
        if(isset($result[0]))
        {
            if($result[0]->status==1)
            {
                $value=$result[0]->value;
                $type=$result[0]->type;
                if($result[0]->is_one_time==1)
                {
                    $status="error";
                    $msg="Coupon code already used";
                }
                else
                {
                    $min_order_amt=$result[0]->min_order_amt;
                    if($min_order_amt>0)
                    {
                        $cart=DB::table("cart")->get();
                        $totalprice=0;
                        foreach($cart as $list)
                        {
                            $totalprice=$totalprice+$list->total;
                        }
                        if($min_order_amt<$totalprice)
                        {
                            $status="success";
                            $msg="Coupon code applied";
                        }
                        else
                        {
                            $status="error";
                            $msg="Cart amount must be greater than $min_order_amt";
                        }
                    }
                    else
                    {
                        $status="success";
                        $msg="Coupon code applied";
                    }
                    
                
                }
            }
            else
            {
                $status="error";
                $msg="Coupon code deactivated";
            }
            
        }
        else
        {
            $status="error";
            $msg="Please enter valid coupon code";
        }

        if($status=="success")
        {
            $cart=DB::table("cart")->get();
                        $totalprice=0;
                        foreach($cart as $list)
                        {
                            $totalprice=$totalprice+$list->total;
                        }
            if($type=='Value')
            {
                $totalprice=$totalprice-$value;
            }
            if($type=='Per')
            {
                $newprice=$totalprice*($value/100);
                $totalprice=($totalprice-$newprice);
            }
        }
        return response()->json(['status'=>$status,'msg'=>$msg,'totalprice'=>$totalprice]);
    }
    public function remove_coupon_code(Request $req)
    {
        $totalprice=0;
        $result=DB::table('coupons')
                ->where(['code'=>$req->coupon_code])
                ->get();
        $cart=DB::table("cart")->get();
        foreach($cart as $list)
        {
            $totalprice=$totalprice+$list->total;
        }
        return response()->json(['status'=>'success','msg'=>'Coupon code removed','totalprice'=>$totalprice]);
    }
    public function payment_gateway_redirect(Request $req)
    {
        print_r($req->all());
    }
    public function order_receipt($order_id)
    {
        $sessionData=[
            'user_id'=>Session::get('USER_ID'),
            'user_name'=>Session::get('USER_NAME'),
            'user_email'=>Session::get('USER_EMAIL'),
            'user_image'=>Session::get('USER_IMAGE'),
            'user_address'=>Session::get('USER_ADDRESS')
        ];
        $userid=Session::get('USER_ID');
        $userData=DB::table('users')->find($userid);
        
        $orderData=DB::table('orders_details')
        ->select('orders_details.*','orders.customer_id','orders.name','orders.coupon_code','orders.total_amt','orders.address','products.product_name','products.product_image',)
        ->where('order_id',$order_id)
        ->join('products', 'products.id', '=', 'orders_details.product_id')
        ->join('orders', 'orders.id', '=', 'orders_details.order_id')
        ->get();
            
        $coupon_code= $orderData[0]->coupon_code;
        $couponData=DB::table('coupons')
        ->select('orders.coupon_code','coupons.*')
        ->where('code',$coupon_code)
        ->join('orders', 'orders.coupon_code', '=', 'coupons.code')
        ->get();

        return view('user/order_receipt',['Userdata'=>$userData ,'orderData'=>$orderData,'couponData'=>$couponData[0]]);
    }

    public function email_verification(Request $req,$id) 
    {
        $result=DB::table('users')
                    ->where(['rand_id'=>$id])
                    ->get();
        if(isset($result[0]))
        {
            DB::table('users')
                ->where(['id'=>$result[0]->id])
                ->update(['is_verify'=>1,'rand_id'=>'']);
            return view('user/verification');
        }
        else{
            return redirect('/');
        }
    }

}
