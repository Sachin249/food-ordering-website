<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Session;
class StaffController extends Controller
{
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $GetStaffData=DB::table('staff')->get();
        return view('admin/staff',['StaffData'=>$GetStaffData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    public function manage_staff()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        return view('admin/manage_staff',['noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    public function create(Request $req)
    {
        $req->validate(
            [
                'staff_name'=>'required',
                'staff_role'=>'required',
                'staff_image'=>'required|image',
            ]
            );
            $req->flash();
            if($req->staff_image)
            {
                $file= $req->staff_image;
                $extension= $file->getClientOriginalExtension();
                $filename = time().".".$extension;
                $file->move('admin_uploads/staff_images/',$filename);
                DB::table('staff')->insert(
                    [
                        'staff_name'=>$req->staff_name,
                        'staff_role'=>$req->staff_role,
                        'staff_image'=>$filename,
                    ]
                    );
            }
            $req->session()->flash('status','Staff Added Successfully');
            return redirect('admin/staff');
    }
    public function updateStaffStatus($staff_value,$id)
    {
        $updateStaffStatus=DB::table('staff')->where('staff_id',$id)->update(
            [
               'staff_status'=>$staff_value,
            ]
            );
        return redirect (route('staff_view'))->with('status','Staff Status Updated Successfully');
    }
    public function delete($id)
    {
        $OldtData=DB::table('staff')->where('staff_id',$id)->first('staff_image');
        $destination='admin_uploads/staff_images/'.$OldtData->staff_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        DB::table('staff')->where('staff_id',$id)->delete();
        return redirect (route('staff_view'))->with('status','Service Deleted Successfully');
    }
    public function edit($id)
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $staffData=DB::table('staff')->where('staff_id',$id)->first();
        return view('admin/edit_staff',['StaffData'=>$staffData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    public function update(Request $req,$id)
    {
        $StaffOldtData=DB::table('staff')->where('staff_id',$id)->first();
        if($req->hasfile('staff_image'))
        {
            $destination='admin_uploads/staff_images/'.$StaffOldtData->staff_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file= $req->staff_image;
            $extension= $file->getClientOriginalExtension();
            $filename = time().".".$extension;
            $file->move('admin_uploads/staff_images/',$filename);
            $UserUpdateData=DB::table('staff')->where('staff_id',$id)->update(
                [
                    'staff_name'=>$req->staff_name,
                    'staff_role'=>$req->staff_role,
                    'staff_image'=>$filename,
                ]
                );
        }
        else {
            $UpdateServiceData=DB::table('staff')->where('staff_id',$id)->update(
                [
                    'staff_name'=>$req->staff_name,
                    'staff_role'=>$req->staff_role,
                ]
                );
        }   
        return redirect (route('staff_view'))->with('status','Service Updated Successfully');
    }

}
