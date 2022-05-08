@extends('user/layout')
@section('page_title','Order Summary')
@section('mycart_select','active')
<link rel="stylesheet" href="{{url('admin_assets/css/order_placed.css')}}">
@if(session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show alertbox" role="alert">
            {{session('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
@endif
<!-- <div class="text-center mt-5">
    <h2>Your order has been placed</h2>
    <h3>Order Id : {{session()->get('ORDER_ID')}}</h3>
</div> -->
<!-- <button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop"> <i class="fa fa-info"></i> Get information
</button> -->
<!-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"> -->
    <div class="modal-dialog"  style="width:500px;padding-top:20px">
        <div class="modal-content">
            <div class="modal-body ">
                <!-- <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div> -->
                <div class="px-4">
                    
                    <h4 class="mt-5 theme-color">Thanks for your order</h4>
                    <a href="{{url('/order_receipt')}}/{{session()->get('ORDER_ID')}}" class="btn btn-sm btn-success mb-5">Download receipt</a>
                    <br>
                    <span class="theme-color">Payment Summary</span>
                    <div class="mb-3">
                        <hr class="new1">
                    </div>
                    @php
                    $grandtotal=0;
                    @endphp
                    @foreach($orderData as $orderData)
                    @php
                    $grandtotal=$grandtotal+$orderData->price*$orderData->qty;
                    @endphp
                    <div class="d-flex justify-content-between">
                         <span class="font-weight-bold text-capitalize">{{$orderData->product_name}}(Qty:{{$orderData->qty}})</span>
                         <span class="text-muted">{{$orderData->price*$orderData->qty}} INR</span>
                    </div>
                    <div class="d-flex justify-content-between ">
                        <span><small class="font-weight-bold">({{$orderData->qty}} x {{$orderData->price}})</small></span>
                    </div>
                    
                    @endforeach
                    @if($orderData->coupon_code!='')
                        <div class="d-flex justify-content-between "> 
                            <small><strong>Coupon code</strong></small> <small>
                                <strong class="text-success">{{$orderData->coupon_code}}</strong>
                            </small> 
                        </div>
                        @if($couponData[0]->type=='Value')
                        <div class="d-flex justify-content-between "> 
                            <small><strong>Coupon discount</strong></small> <small>
                                <span class="text-primary"> {{$couponData[0]->value}}.00 INR </span>
                            </small> 
                        </div>
                        @else
                        <div class="d-flex justify-content-between "> 
                            <small><strong>Coupon discount</strong></small> <small>
                                <span class="text-primary"> {{$couponData[0]->value}}.00 PER(%)</span>
                            </small> 
                        </div>
                        @endif
                    @endif
                    <div class="d-flex justify-content-between"> <small>Shipping</small> <small class="text-muted"> 00.00 INR</small> </div>
                    <div class="d-flex justify-content-between"> <small>Tax</small> <small class="text-muted"> 00.00 INR</small> </div>
                    <div class="d-flex justify-content-between mt-3"> <span class="font-weight-bold theme-color">Total</span> <span class="font-weight-bold theme-color fw-bold ">INR {{$orderData->total_amt}}</span> </div>
                    

                    <div class="text-center mt-5"> <a href="{{route('myorders')}}" class="btn btn-primary">Track your order</a> </div>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->
@include('user/footer')
