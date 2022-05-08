@extends('user/layout')
@section('page_title','Order Receipt')
@section('mycart_select','active')

<link rel="stylesheet" href="{{url('admin_assets/css/order_receipt.css')}}">

<div class="container-fluid receipt mt-5 mb-3 " id="receipt">
    <div class="row d-flex justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="text-left logo p-2 px-5"> <img src="{{url('images/favicon.png')}}" width="30">
                 <span class="py-5" style="font-family: Century; font-weight:bold;">Online Food System</span> </div>
                <div class="invoice p-5">
                    <h5>Your order Confirmed!</h5> <span class="font-weight-bold d-block mt-4 text-capitalize">Hello,{{$orderData[0]->name}}</span> <span>You order has been confirmed and may be delivered in 50 mins!</span>
                    <div class="payment border-top mt-3 mb-3 border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order Date</span> <span>@php
                                            $mytime = Carbon\Carbon::now();
                                            echo $mytime->toDateString();
                                            @endphp</span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Order ID</span> <span>#OFS0{{$orderData[0]->order_id}}</span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Payment</span> <span>COD</span> </div>
                                    </td>
                                    <td>
                                        <div class="py-2"> <span class="d-block text-muted">Delivery Address</span> <span class="text-capitalize">{{$orderData[0]->address}}</span> </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="product border-bottom table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                @foreach($orderData as $list)
                                <tr>
                                    <td width="20%"> <img src="{{url('/admin_uploads/product_images/')}}/{{$list->product_image}}" width="90"> </td>
                                    <td width="60%"> <span class="font-weight-bold text-capitalize">{{$list->product_name}}</span>
                                        <div class="product-qty"> <span class="d-block">Quantity:{{$list->qty}}</span> </div>
                                    </td>
                                    <td width="20%">
                                        <div class="text-right"> <span class="font-weight-bold">INR {{$list->price*$list->qty}}</span> </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-5">
                            <table class="table table-borderless">
                                <tbody class="totals">
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Shipping Fee</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span>00 INR</span> </div>
                                        </td>
                                    </tr>
                                   
                                    <tr>
                                        <td>
                                            <div class="text-left"> <span class="text-muted">Discount</span> </div>
                                        </td>
                                        @if($couponData->type=='Value')
                                        <td>
                                            <div class="text-right"> <span class="text-success">{{$couponData->value}} INR</span> </div>
                                        </td>
                                        @else 
                                        <td>
                                            <div class="text-right"> <span class="text-success">{{$couponData->value}} Per(%)</span> </div>
                                        </td>
                                        @endif        
                                    </tr>
                                    <tr class="border-top border-bottom">
                                        <td>
                                            <div class="text-left"> <span class="font-weight-bold">Total Amount</span> </div>
                                        </td>
                                        <td>
                                            <div class="text-right"> <span class="font-weight-bold">{{$orderData[0]->total_amt}} INR</span> </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <p>We will be sending shipping confirmation email when the item shipped successfully!</p> -->
                    <p class="font-weight-bold mb-0">Thanks for shopping with us!</p> <span>OFS Team</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 text-center">
    <a href="{{route('order_placed')}}" class="print_btn btn btn-danger my-4 mx-4" >Back</a>
    <a href="#" class="print_btn btn btn-success my-4 mx-4" onclick="window.print()">Print</a>
</div>


@include('user/footer')
