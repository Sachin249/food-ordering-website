@extends('user/layout')
@section('page_title','My Cart')
@section('mycart_select','active')

<!-- my cart start -->
<link rel="stylesheet" href="{{url('admin_assets/css/empty_cart.css')}}">




<div class="container padding-bottom-3x mb-1" style="margin-top:100px;">
@if(session()->has('status'))
            <div class="alert alert-success alertbox mt-2">
            {{session('status')}}
            </div>
@endif
@if(isset($cart[0]))
    <!-- Shopping Cart-->
    <form action="">
    
    <h3 class="my-4 heading_font">Shopping Cart</h3>
    <div class="table-responsive shopping-cart my-2">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Product Name</th>
                    <th class="text-center">Quantity</th>
                    <th class="text-center">Price(RS)</th>
                    <th class="text-center">Total</th>
                    <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>
                </tr>
            </thead>
            <tbody>
                @php
                $sum=0;
                @endphp
                @foreach($cart as $list)
                @php
                $sum=$sum + $list->product_price*$list->product_qty;
                
                @endphp
                <tr>
                    <td>
                        {{$list->cart_id}}
                    </td>
                    <td>
                        <div class="product-item">
                            <a class="product-thumb" href="#"><img src="{{url('/admin_uploads/product_images/')}}/{{$list->product_image}}" alt="Product"></a>
                            <div class="product-info">
                                <h4 class="product-title"><a href="#">{{$list->product_name}}</a></h4><span><em></em> {{$list->product_desc}}</span>
                                <input type="hidden" value="{{$list->product_id}}" id="pro_id">
                            </div>
                        </div>
                    </td>
                    <td class="text-center">
                            <input value="{{$list->product_qty}}" type="number" class="quantity text-center" id="quantity_val{{$list->product_id}}" onchange="updateQty('{{$list->product_id}}','{{$list->product_price}}')" style="width: 80px;" min="1">
                    </td>
                    <td class="text-center">
                        <input type="text" class="pro_price  text-center" name="pro_price" value="{{$list->product_price}}" style="width: 100px;border:none;" readonly> 
                    </td>
                    <td class="text-center">
                        <input type="text" name="total" id="total{{$list->product_id}}" class="total text-center"  value="{{$list->product_price*$list->product_qty}}" style="width: 100px;border:none;" readonly>
                    </td>
                    <td class="text-center"><a class="remove-from-cart" href="{{url('user/homepage/deleteCartProduct')}}/{{$list->cart_id}}" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
@php
$Grandtotal=$sum;
@endphp
    <div class="shopping-cart-footer">
        <!-- <div class="column">
            <form class="coupon-form" method="post">
                <input class="form-control form-control-sm" type="text" placeholder="Coupon code" required="">
                <button class="btn btn-outline-primary btn-sm" type="submit">Apply Coupon</button>
            </form>
        </div> -->
        <div class="column text-lg fs-30"><strong>Grandtotal:</strong> <span class="text-medium">Rs. <input type="text" class="" value="{{$Grandtotal}}" style="border:none;width:50px" name='grandtotal' readonly></span></div>
    </div>
    <div class="shopping-cart-footer">
        <div class="column"><a class="btn btn-outline-secondary" href="{{route('homepage')}}"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
        <div class="column"><a class="btn btn-success" href="{{route('checkout')}}">Checkout</a></div>
    </div>
    </form>

    @else
    <div class="container-fluid " style="margin-top:-50px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header" style="background:rgba(128, 128, 128, 0.069);">
                    <h5 class="">Cart</h5>
                </div>
                <div class="card-body cart">
                    <div class="col-sm-12 empty-cart-cls text-center"> <img src="https://pngpress.com/wp-content/uploads/2020/04/shopping-cart-logo.png" width="130" height="130" class="img-fluid mb-4">
                        <h3><strong>Your Cart is Empty</strong></h3>
                        <h4>Add something to make me happy :)</h4> <a href="{{route('homepage')}}" class="btn btn-primary cart-btn-transform m-3" data-abc="true">continue shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

</div>

<form id="fromAddToCart">
    <input type="hidden" name="product_id" value="" id="product_id">
    <!-- <input type="hidden" name="product_name" value="">
    <input type="hidden" name="product_desc" value=""> -->
    <input type="hidden" name="product_price" value="" id="product_price">
    <!-- <input type="hidden" name="product_image" value=""> -->
    <input type="hidden" name="pqty" id="pqty" >
    <input type="hidden" name="pqty" id="quantity_val" >
    <input type="hidden" name="total_val" id="total_val" >
    @csrf
</form>
<!-- my cart end -->
@include('user/footer')

