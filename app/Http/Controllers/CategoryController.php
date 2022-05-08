<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
class CategoryController extends Controller
{
    
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('purchase_orders')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $GetCategoryData=DB::table('categories')->get();
        return view('admin/category',['category_data'=>$GetCategoryData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    
    public function manage_category()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('purchase_orders')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        return view('admin/manage_category',['noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    
    public function create(Request $req)
    {
        $req->validate(
            [
                'category_name'=>'required',
                'category_slug'=>'required|unique:categories',
            ]
            );
        
        DB::table('categories')->insert(
            [
                'category_name'=>$req->category_name,
                'category_slug'=>$req->category_slug
            ]
            );
            $req->session()->flash('status','Category Added Successfully');
            return redirect('admin/category');
    }

    public function delete(Request $request,$id)
    {
        DB::table('categories')->where('id',$id)->delete();
        return redirect (route('category_view'))->with('status','Record Deleted Successfully');
    }

    public function edit($id)
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $CategoryData=DB::table('categories')->find($id);
        return view('admin/edit_category',['CategoryData'=>$CategoryData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }

    public function update(Request $req, Category $category,$id)
    {
            $UserUpdateData=DB::table('categories')->where('id',$id)->update(
                [
                   'category_name'=>$req->category_name,
                   'category_slug'=>$req->category_slug,
                ]
                );
        return redirect (route('category_view'))->with('status','Record Updated Successfully');
    }

    public function updateCategoryStatus(Request $req,$status_value,$id)
    {
        $updateCategoryStatus=DB::table('categories')->where('id',$id)->update(
            [
               'status'=>$req->status_value,
            ]
            );
    return redirect (route('category_view'))->with('status','Category Status Updated Successfully');
    }
    
}
