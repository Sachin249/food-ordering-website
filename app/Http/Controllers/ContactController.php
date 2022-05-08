<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;
class ContactController extends Controller
{
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $GetContactData=DB::table('contact')->get();
        return view('admin/contact',['ContactData'=>$GetContactData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }

    public function edit($id)
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $contactData=DB::table('contact')->where('id',$id)->first();
        return view('admin/edit_contact',['ContactData'=>$contactData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    
    public function update(Request $req,$id)
    {
        
            $UpdateContactData=DB::table('contact')->where('id',$id)->update(
                [
                    'company_mobile'=>$req->company_mobile,
                    'company_email'=>$req->company_email,
                    'company_address'=>$req->company_address,
                ]
                );
        
            
        return redirect (route('contact_view'))->with('status','Contact Updated Successfully');
    }
}
