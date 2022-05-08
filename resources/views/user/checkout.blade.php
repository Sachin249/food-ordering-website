@extends('user/layout')
@section('page_title','Checkout Form')
@section('mycart_select','active')

<div class="container" style="margin-top:50px;">
  <div class="py-5 text-center">
    <h2>Checkout form</h2>
  </div>
  <form id="frmPlaceOrder" class="needs-validation" novalidate>
      @csrf
  <div class="row">
    <div class="col-md-4 order-md-2 mb-4">
      <h4 class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Your cart</span>
        <span class="badge badge-secondary badge-pill">
            @php
            $count=0;
            @endphp
            @foreach($cart as $list)
            @php
            $count=$count+1;
            @endphp
            @endforeach
            {{$count}}
        </span>
      </h4>
      <ul class="list-group mb-3">
        @php
        $grandtotal=0;
        @endphp
        @foreach($cart as $list)
        @php
        $grandtotal=$grandtotal+$list->total;
        @endphp
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div>
            <h6 class="my-0 text-capitalize ">{{$list->product_name}}</h6>
            <small class="text-success">Qty : {{$list->product_qty}}</small>
          </div>
          <span class="">{{$list->total}}</span>
        </li>
        @endforeach
        <li class="list-group-item d-flex justify-content-between lh-condensed">
          <div class="hide coupon_box">
            <h6 class="my-0 text-capitalize fw-bold">Coupon Code 
              <a href="javascript:void(0)" onclick="remove_coupon_code()" class="remove_coupon_code_link btn btn-sm btn-danger mx-4"><i class="fa fa-times" aria-hidden="true"></i></a></h6>
            <small class="text-muted"></small>
          </div>
          <div class="hide coupon_box">
            <span class="coupan_code_value text-success fw-bold"></span>
          </div>
            
        </li>
        <li class="list-group-item d-flex justify-content-between lh-condensed border">
          <div class="">
            <h6 class="my-0 text-capitalize text-success fw-bold">Total</h6>
            <small class="text-muted"></small>
          </div>
          <span class="text-success fw-bold " style="float:right">INR <input style="width:50px;border:none;" type="text" class="totalprice pl-2" name="total" value="{{$grandtotal}}" readonly></span>
        </li>
      </ul>
      
        <div class="card p-2 ">
            <div class="input-group apply_coupon_disable">
              <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Coupon code">
              <div class="input-group-append">
                <input onclick="applyCouponCode()" type="button" class="btn btn-secondary" value="Apply">
              </div>
            </div>
            <div class="my-1 mx-1" id="coupon_code_msg"></div>
            <hr>
            <div class="apply_coupon_disable">
            <p class="text-muted mx-2">Available coupons (<small>Click to apply</small>)</p> 
            <div class="container d-flex">
            @foreach($couponData as $couponData)
                
                @if($couponData->type=='Value')
                <button onclick="apply_coupon('{{$couponData->id}}')" class="text-light text-center my-1 mx-2" style="border:1px solid grey;background:rgba(0, 128, 0, 0.823);width:150px;border-radius:10px;box-shadow: 3px 5px #888888;cursor: pointer;">
                  <input id="apply_coupon{{$couponData->id}}" type="hidden" value="{{$couponData->code}}">
                  <span class="title font-weight-bold text-capitalize" style="font-size: 15px;"><i>Flat {{$couponData->value}} INR off</i></span><br>
                  <small class="text-capitalize" style="font-size: 12px;"><i>Min order amt.: {{$couponData->min_order_amt}} INR</i></small>
                  <small class="text-capitalize" style="font-size: 12px;"><i>Code : {{$couponData->code}}</i></small>
                  
                </button>
                @else
                <button onclick="apply_coupon('{{$couponData->id}}')" class=" text-light text-center my-1 mx-2" style="border:1px solid grey;background:rgba(0, 128, 0, 0.823);width:150px;border-radius:10px;box-shadow: 3px 5px #888888;cursor: pointer;">
                  <input id="apply_coupon{{$couponData->id}}" type="hidden" value="{{$couponData->code}}">
                  <span class="title font-weight-bold text-capitalize" style="font-size: 15px;"><i>Flat {{$couponData->value}} % off</i></span><br>
                  <small class="text-capitalize" style="font-size: 12px;"><i>Min order amt.: {{$couponData->min_order_amt}} INR</i></small>
                  <small class="text-capitalize" style="font-size: 12px;"><i>Code : {{$couponData->code}}</i></small>
                </button>
                @endif

            @endforeach
          </div>
        </div>
        </div>
    </div>
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Billing address</h4>
        
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="firstName">Full name</label>
            <input type="text" class="form-control" name="uname" id="firstName" placeholder="" value="" required>
            <div class="invalid-feedback">
              Valid first name is required.
            </div>
          </div>
        </div>
        <div class="mb-3">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="uemail" id="email" placeholder="abc@gmail.com" required>
          <div class="invalid-feedback">
            Please enter valid email.
          </div>
        </div>
        <div class="row">
          <div class="col-md-5 mb-3">
            <label for="country">Country</label>
            <select class="custom-select d-block w-100" name="ucountry" id="country" required>
              <option value="India">India</option>
            </select>
          </div>
          <div class="col-md-4 mb-3">
            <label for="state">State</label>
            <select class="custom-select d-block w-100" name="ustate" id="state" required>
              <option value="Madhya Pradesh">Madhya Pradesh</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="city">City</label>
            <select class="custom-select d-block w-100" name="ucity" id="city" required>
              <option value="Indore">Indore</option>
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label for="address">Address</label>
          <input type="text" class="form-control" name="uaddress" id="address" placeholder="1234 Main St" required>
          <div class="invalid-feedback">
            Please enter your shipping address.
          </div>
        </div>
        <div class="row">

          <div class="col-md-3 mb-3">
            <label for="mobile">Mobile No</label>
            <input type="text" class="form-control" name="umobile" id="mobile" required size="10" minlength="10" maxlength="10" placeholder="" required>
            <div class="invalid-feedback">
              Mobile Number required.
            </div>
          </div>
        </div>
        <hr class="mb-4">
        <h4 class="mb-3">Payment</h4>

        <div class="d-block my-3">
          <div class="custom-control custom-radio">
            <input id="COD" name="payment_type" value="COD" type="radio" class="custom-control-input" checked required>
            <label class="custom-control-label" for="COD">Cash On Delivery</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="Gateway" name="payment_type" value="Gateway" type="radio" class="custom-control-input" required>
            <label class="custom-control-label" for="Gateway">Payment Gateway</label>
          </div>
        </div>
        <hr class="mb-4">
        <div id="place_order_msg">

        </div>
        <input style="margin-bottom:100px;" type="submit" id="btnPlaceOrder" class="btn btn-primary btn-lg btn-block" value="Place Order">
    </div>
    

  </div>
  </form>
</div>
@include('user/footer')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()
</script>