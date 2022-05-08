<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Session;
class ServiceController extends Controller
{
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $GetserviceData=DB::table('services')->get();
        return view('admin/service',['ServiceData'=>$GetserviceData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    public function manage_service()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        return view('admin/manage_service',['noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    public function create(Request $req)
    {
        $req->validate(
            [
                'service_name'=>'required',
                'service_desc'=>'required',
                'service_image'=>'required|image',
            ]
            );
            $req->flash();
            if($req->service_image)
            {
                $file= $req->service_image;
                $extension= $file->getClientOriginalExtension();
                $filename = time().".".$extension;
                $file->move('admin_uploads/service_images/',$filename);
                DB::table('services')->insert(
                    [
                        'service_name'=>$req->service_name,
                        'service_desc'=>$req->service_desc,
                        'service_image'=>$filename,
                    ]
                    );
            }
            $req->session()->flash('status','Service Added Successfully');
            return redirect('admin/service');
    }
    public function delete($id)
    {
        $OldtData=DB::table('services')->where('service_id',$id)->first('service_image');
        $destination='admin_uploads/service_images/'.$OldtData->service_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        DB::table('services')->where('service_id',$id)->delete();
        return redirect (route('service_view'))->with('status','Service Deleted Successfully');
    }
    public function updateServiceStatus($service_value,$id)
    {
        $updateServiceStatus=DB::table('services')->where('service_id',$id)->update(
            [
               'service_status'=>$service_value,
            ]
            );
    return redirect (route('service_view'))->with('status','Service Status Updated Successfully');
    }
    public function edit($id)
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $ServiceData=DB::table('services')->where('service_id',$id)->first();
        return view('admin/edit_service',['ServiceData'=>$ServiceData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    public function update(Request $req,$id)
    {
        $UserOldtData=DB::table('services')->where('service_id',$id)->first();
        if($req->hasfile('service_image'))
        {
            $destination='admin_uploads/service_images/'.$UserOldtData->service_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file= $req->service_image;
            $extension= $file->getClientOriginalExtension();
            $filename = time().".".$extension;
            $file->move('admin_uploads/service_images/',$filename);
            $UserUpdateData=DB::table('services')->where('service_id',$id)->update(
                [
                    'service_name'=>$req->service_name,
                    'service_desc'=>$req->service_desc,
                    'service_image'=>$filename,
                ]
                );
        }
        else {
            $UpdateServiceData=DB::table('services')->where('service_id',$id)->update(
                [
                    'service_name'=>$req->service_name,
                    'service_desc'=>$req->service_desc,
                ]
                );
        }    
        return redirect (route('service_view'))->with('status','Service Updated Successfully');
    }
}
