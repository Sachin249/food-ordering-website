<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Session;

class ProductController extends Controller
{
  
    public function index()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $CategoryData=DB::table('categories')->where(['status'=>1])->get();
        $GetProductsData=DB::table('products')->get();
        return view('admin/product',['CategoryData'=>$CategoryData,'product_data'=>$GetProductsData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }
    
    public function manage_product()
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $CategoryData=DB::table('categories')->where(['status'=>1])->get();
        return view('admin/manage_product',['CategoryData'=>$CategoryData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }

    public function create(Request $req)
    {
        $req->validate(
            [
                'product_name'=>'required',
                'product_slug'=>'required|unique:products',
                'product_category'=>'required',
                'product_desc'=>'required',
                'product_price'=>'required|numeric',
                'product_image'=>'required|image',
            ]
            );
            $req->flash();
            if($req->product_image)
            {
                $file= $req->product_image;
                $extension= $file->getClientOriginalExtension();
                $filename = time().".".$extension;
                $file->move('admin_uploads/product_images/',$filename);
                DB::table('products')->insert(
                    [
                        'product_category'=>$req->product_category,
                        'product_desc'=>$req->product_desc,
                        'product_name'=>$req->product_name,
                        'product_slug'=>$req->product_slug,
                        'product_price'=>$req->product_price,
                        'product_image'=>$filename,
                    ]
                    );
            }
        
            $req->session()->flash('status','Product Added Successfully');
            return redirect('admin/product');
    }

    public function delete(Request $request,$id)
    {
        $UserOldtData=DB::table('products')->find($id);
        $destination='admin_uploads/product_images/'.$UserOldtData->product_image;
        if(File::exists($destination))
        {
            File::delete($destination);
        }
        DB::table('products')->where('id',$id)->delete();
        return redirect (route('products_view'))->with('status','Record Deleted Successfully');
    }
    
    public function edit($id)
    {
        $sessionData=[
            'admin_email'=>Session::get('ADMIN_EMAIL')
        ];
        $orderNotification=DB::table('orders_details')->where('notification','1')->get();
        $countNotification=count($orderNotification);
        $CategoryData=DB::table('categories')->where(['status'=>1])->get();
        $ProductData=DB::table('products')->find($id);
        return view('admin/edit_product',['ProductData'=>$ProductData,'CategoryData'=>$CategoryData,'noti'=>$countNotification,'Admin'=>$sessionData]);
    }

    public function update(Request $req, Category $category,$id)
    {
        $UserOldtData=DB::table('products')->find($id);
        if($req->hasfile('product_image'))
        {
            
            $destination='admin_uploads/product_images/'.$UserOldtData->product_image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file= $req->product_image;
            $extension= $file->getClientOriginalExtension();
            $filename = time().".".$extension;
            $file->move('admin_uploads/product_images/',$filename);
            $UserUpdateData=DB::table('products')->where('id',$id)->update(
                [
                    'product_category'=>$req->product_category,
                    'product_desc'=>$req->product_desc,
                    'product_name'=>$req->product_name,
                    'product_slug'=>$req->product_slug,
                    'product_price'=>$req->product_price,
                    'product_image'=>$filename,
                ]
                );
        }
        else {
            $UserUpdateData=DB::table('products')->where('id',$id)->update(
                [
                    'product_category'=>$req->product_category,
                    'product_desc'=>$req->product_desc,
                    'product_name'=>$req->product_name,
                    'product_slug'=>$req->product_slug,
                    'product_price'=>$req->product_price,
                ]
                );
        }
            
        return redirect (route('products_view'))->with('status','Record Updated Successfully');
    }

    public function updateProductStatus(Request $req,$status_value,$id)
    {
        $updateCategoryStatus=DB::table('products')->where('id',$id)->update(
            [
               'status'=>$req->status_value,
            ]
            );
    return redirect (route('products_view'))->with('status','Product Status Updated Successfully');
    }

}
