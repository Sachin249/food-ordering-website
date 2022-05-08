@extends('admin/layout')
@section('page_title','Orders')
@section('order_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <h1 class="pb-2">All Product</h1>
     <!-- DATA TABLE-->
     <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Order Id</th>
                                                <th>Order Image</th>
                                                <th>Order Details</th>
                                                <th>Delivery Details</th>
                                                <th>Order Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($OrderData as $ProductData)
                                            <tr>
                                                <td>{{$ProductData->order_id}}</td>
                                                <td>
                                                    <img src="{{url('/admin_uploads/product_images/')}}/{{$ProductData->product_image}}" alt="" style="width:100px;height:80px;border-radius:10px;">
                                                </td>
                                                <td>
                                                    <p>
                                                        <span class='text-capitalize text-success'>{{$ProductData->product_name}}</span><br>
                                                        Price : Rs.{{$ProductData->product_price}}<br>
                                                        Qty : {{$ProductData->qty}}<br>
                                                        Subtotal : Rs.{{$ProductData->product_price*$ProductData->qty}}
                                                    </p>
                                                </td>
                                                <td>
                                                    <p>
                                                      <span class='text-capitalize'> 
                                                       Recipient Name : {{$ProductData->name}}</span><br>
                                                       Recipient Email : {{$ProductData->email}}<br>
                                                       Recipient Mobile : {{$ProductData->mobile}}<br>
                                                       <span class="text-capitalize"> Delivery Address : {{$ProductData->address}}</span>
                                                    </p>
                                                </td>
                                                <td>
                                                    @if($ProductData->order_status==0)
                                                        <a href="{{url('admin/orders/order_status/1')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($ProductData->order_status==1)
                                                        <a href="{{url('admin/orders/order_status/0')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    @if($ProductData->packed_by_courier==0)
                                                        <a href="{{url('admin/orders/order_packed/1')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-danger btn-sm">Packed(No) <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($ProductData->packed_by_courier==1)
                                                        <a href="{{url('admin/orders/order_packed/0')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-success btn-sm">Packed(Yes) <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                    @if($ProductData->on_the_way==0)
                                                        <a href="{{url('admin/orders/on_the_way_status/1')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-danger btn-sm my-1">Onway(No) <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($ProductData->on_the_way==1)
                                                        <a href="{{url('admin/orders/on_the_way_status/0')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-success btn-sm my-1">Onway(Yes) <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                    @if($ProductData->delivered==0)
                                                        <a href="{{url('admin/orders/order_delivered/1')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-danger btn-sm my-1">Delivered(No) <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($ProductData->delivered==1)
                                                        <a href="{{url('admin/orders/order_delivered/0')}}/{{$ProductData->id}}">
                                                            <button class="btn btn-success btn-sm my-1">Delivered(Yes) <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                    <!-- <a href="{{url('/admin/product/edit/')}}/{{$ProductData->id}}">
                                                        <button class="btn btn-success btn-sm">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </a>
                                                    <a href="{{url('/admin/product/delete/')}}/{{$ProductData->id}}">
                                                        <button class="btn btn-danger btn-sm">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </a> -->
                                                </td>
                                              
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
</div>
@endsection