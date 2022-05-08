@extends('admin/layout')
@section('page_title','Product')
@section('product_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <h1>All Product</h1>
     <a class="btn btn-success my-2 " href='product/manage_product'>
         <button class="text-white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product</button>
     </a>
     <br>
     <!-- DATA TABLE-->
     <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Product Name</th>
                                                <th>Product Slug</th>
                                                <th>Product Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($product_data as $ProductData)
                                            <tr>
                                                <td>{{$ProductData->id}}</td>
                                                <td>{{$ProductData->product_name}}</td>
                                                <td>{{$ProductData->product_slug}}</td>
                                                <td>
                                                    <img src="{{url('/admin_uploads/product_images/')}}/{{$ProductData->product_image}}" alt="" style="width:100px;height:80px;border-radius:10px;">
                                                </td>
                                                <td>
                                                    @if($ProductData->status==0)
                                                        <a href="{{url('/admin/product/status/1')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($ProductData->status==1)
                                                        <a href="{{url('/admin/product/status/0')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                    <a href="{{url('/admin/product/edit/')}}/{{$ProductData->id}}">
                                                        <button class="btn btn-success btn-sm">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </a>
                                                    <a href="{{url('/admin/product/delete/')}}/{{$ProductData->id}}">
                                                        <button class="btn btn-danger btn-sm">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </a>
                                                </td>
                                              
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
</div>
@endsection