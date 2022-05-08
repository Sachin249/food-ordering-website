@extends('admin/layout')
@section('page_title','Add Coupon')
@section('coupon_select','active')
@section('container')

<div class='container'>
    
    
     <h1>Coupon</h1>
     <a class="btn btn-success my-2 " href="{{url('admin/coupon')}}">
         <button>Back</button>
     </a>
     <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Add Coupon</div>
                                    <div class="card-body">
                                        <form action="{{route('coupon.insert')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="coupon_title" class="control-label mb-1">Coupon Title</label>
                                                <input id="coupon_title" name="coupon_title" value="{{old('coupon_title')}}" type="text" class="form-control text-capitalize" aria-required="true" aria-invalid="false">
                                                    @error('coupon_title')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="coupon_code" class="control-label mb-1">Coupon Code</label>
                                                <input id="coupon_code" name="coupon_code" value="{{old('coupon_code')}}" type="text" class="form-control text-capitalize" aria-required="true" aria-invalid="false">
                                                    @error('coupon_code')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="coupon_value" class="control-label mb-1">Coupon Value</label>
                                                <input id="coupon_value" name="coupon_value" value="{{old('coupon_value')}}" type="text" class="form-control text-capitalize" aria-required="true" aria-invalid="false">
                                                    @error('coupon_value')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="coupon_type" class="control-label mb-1">Coupon Type</label>
                                                <select class="form-control" name="coupon_type" value="{{old('coupon_type')}}" id="coupon_type">
                                                    <option value="">Select coupon type </option>
                                                    <option value="Value">Value</option>
                                                    <option value="Per">Per</option>
                                                </select>
                                                @error('coupon_type')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror   
                                            </div>
                                            <div class="form-group">
                                                <label for="min_order_amt" class="control-label mb-1">Minimum order amt</label>
                                                <input id="min_order_amt" name="min_order_amt" value="{{old('min_order_amt')}}" type="text" class="form-control text-capitalize" aria-required="true" aria-invalid="false">
                                                    @error('min_order_amt')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="is_one_time" class="control-label mb-1">Is one time</label>
                                                <select class="form-control" name="is_one_time"  id="is_one_time">
                                                    <option value="">Select</option>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                                @error('is_one_time')
                                                    <span class="text-danger">{{$message}}</span>
                                                @enderror   
                                            </div>
                                                <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                                    Submit
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
</div>
</div>
</div>
@endsection