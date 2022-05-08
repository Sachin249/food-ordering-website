@extends('admin/layout')
@section('page_title','Coupon')
@section('coupon_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <h1>All Coupon</h1>
     <a class="btn btn-success my-2 " href='coupon/manage_coupon'>
         <button class="text-white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Coupon</button>
     </a>
     <br>
     <!-- DATA TABLE-->
     <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Code</th>
                                                <th>Value</th>
                                                <th>Type</th>
                                                <th>Minimum Order Amt</th>
                                                <th>Is one time</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($coupon_data as $Data)
                                            <tr>
                                                <td>{{$Data->id}}</td>
                                                <td>{{$Data->title}}</td>
                                                <td>{{$Data->code}}</td>
                                                <td>{{$Data->value}}</td>
                                                <td>{{$Data->type}}</td>
                                                <td>{{$Data->min_order_amt}}</td>
                                                <td>{{$Data->is_one_time}}</td>
                                                <td>
                                                     @if($Data->status==0)
                                                        <a href="{{url('/admin/coupon/status/1')}}/{{$Data->id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($Data->status==1)
                                                        <a href="{{url('/admin/coupon/status/0')}}/{{$Data->id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif</td>
                                                <td>
                                                    <a href="{{url('/admin/coupon/edit/')}}/{{$Data->id}}">
                                                        <button class="btn btn-success btn-sm">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </a>
                                                    <a href="{{url('/admin/coupon/delete/')}}/{{$Data->id}}">
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