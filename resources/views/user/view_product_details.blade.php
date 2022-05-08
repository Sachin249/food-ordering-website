@extends('user/layout')
@section('page_title','Order Product')
<!-- <div class="container my-md-5 ">
    <div class="text-center bg-danger rounded">
        <h3 class="text-white pt-md-3 pb-md-3">Product Details</h3>
    </div>
</div>
<div class="container">
    <div class="row container">
            <div class="col-md-6">
                <img class="rounded" src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" style="width:350px;height:380px;" alt="">
            </div>
            <div class="col-md-6">
                <h3><span>Product Name : </span>{{$ProductDetails->product_image}}</h3>
            </div>
    </div>
</div> -->
<div class="container" style="margin-top:100px;">
    <div class="card">
        <div class="container-fliud">
            <div class="wrapper row">
                <div class="preview col-md-6">
                    
                    <div class="preview-pic tab-content">
                      <div class="tab-pane active" id="pic-1"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" /></div>
                      <!-- <div class="tab-pane" id="pic-2"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" /></div>
                      <div class="tab-pane" id="pic-3"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" /></div>
                      <div class="tab-pane" id="pic-4"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" /></div>
                      <div class="tab-pane" id="pic-5"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" /></div> -->
                    </div>
                    <!-- <ul class="preview-thumbnail nav nav-tabs">
                      <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" style="width: 200px;height: 80px;"/></a></li>
                      <li><a data-target="#pic-2" data-toggle="tab"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" style="width: 200px;height: 80px;" /></a></li>
                      <li><a data-target="#pic-3" data-toggle="tab"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" style="width: 200px;height: 80px;"/></a></li>
                      <li><a data-target="#pic-4" data-toggle="tab"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" style="width: 200px;height: 80px;"/></a></li>
                      <li><a data-target="#pic-5" data-toggle="tab"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" style="width: 200px;height: 80px;"/></a></li>
                    </ul> -->
                    
                </div>
                <div class="details col-md-6">
                    <h3 class="product-title">{{$ProductDetails->product_name}}</h3>
                    <p class="product-description">{{$ProductDetails->product_desc}}</p>
                    <p class="text-muted"></p>
                    <h4 class="price">current price: <span>Rs.{{$ProductDetails->product_price}}</span></h4>
                    <p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
                    <p class="product-description text-muted">
                        Category &nbsp;: <span class="text-success text-capitalize"> {{$category_data->category_name}}</span><br>
                        Avalibility : <span class="text-success">In Stock</span>
                    </p>
                    <div class="d-inline">
                   @for($i=1;$i<=$ProductDetails->product_category;$i++)
                    <i class="fa fa-star text-warning" aria-hidden="true"></i>
                   @endfor
                   <small class="text-primary mx-2">Star Rating</small>
                    </div>
                
                    <div class="action">
                        <a onclick="addtoCart()" class="add-to-cart btn btn-warning" href="javascript:void(0)" type="button">add to cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <form action="{{url('user/homepage/purchase_order')}}/{{$ProductDetails->id}}" method="POST">
    @csrf
<div class="container-fluid" style="margin-top:40px;">
    <div class="row">
        <aside class="col-md-8">
            <div class="card p-0">
                <div class="table-responsive">
                    <table class="table table-borderless table-shopping-cart">
                        <thead class="text-light bg-dark">
                            <tr class="small text-uppercase">
                                <th scope="col">Product</th>
                                <th scope="col" width="120">Quantity</th>
                                <th scope="col" width="120">Price (RS)</th>
                                <th scope="col" width="120">Sub Total</th>
                                <th scope="col" class="text-right d-none d-md-block" width="200">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <figure class="itemside align-items-center">
                                        <div class="aside"><img src="{{url('admin_uploads/product_images/')}}/{{$ProductDetails->product_image}}" class="img-sm mt-2" width="200px" style="border-radius: 10px;"></div>
                                        <figcaption class="info mt-2"> <a style="font-size: 20px;font-family: cursive;" href="#" class="title text-dark" data-abc="true"></a>
                                            <!-- <p class="text-muted small"> Brand: MAXTRA</p> -->
                                        <!-- </figcaption>
                                    </figure>
                                </td>
                                <td> 
                                    <select class="form-control quantity_val" id="quantity_val">
                                        @for($i=1;$i<=12;$i++)
                                        <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                    <input type="hidden" class="quantity" name="quantity" value="1">
                                     </td>
                                <td>
                                    <div class="price-wrap"> <var class="price">
                                        <input class="form-control pro_price" type="text" name="pro_price" id="pro_price" value="{{$ProductDetails->product_price}}" readonly>
                                        <input type="hidden" name="pro_price" id="pro_price" value="{{$ProductDetails->product_price}}">
                                    </var> </div>
                                </td>
                                <td><input type="text" name="subtotal" class="form-control subtotal" readonly>
                                  
                                </td>
                                <td class="text-right d-none d-md-block">
                                    <a href="{{route('homepage')}}" class="btn btn-danger" data-abc="true"> Remove</a> </td>
                            </tr>
                          
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
        <aside class="col-lg-4">
            <div class="card mb-5 p-0">
                <div class="card-body">
                  
                    <dl class="dlist-align">
                        <div class="" style="border-radius:5px;">
                            <h5 class="text-center pt-1 pb-1">Delivery Details</h5>
                        </div>
                        <hr>
                        <div class="col">
                          <dt>Full Name:</dt>
                          <input type="text" name="full_name" class="form-control">
                         
                      </div>

                      <div class="col mt-2">
                        <dt>Email:</dt>
                        <input type="email" name="user_email" class="form-control">
                        <input type="hidden" name="profile_email" class="form-control" value="{{$Userdata->email}}"> 
                      </div>


                       <div class="col mt-2">
                          <dt>Mobile No:</dt>
                          <input type="text" name="user_mobile" class="form-control">
                         <div class="text-danger">
                         
                         </div>
                        </div>
                     
                     <div class="col">
                        <dt>Address:</dt>
                        <input type="text" name="user_address" class="form-control">
                       <div class="text-danger">
                         
                       </div>
                    </div>
                    </dl>
                    <input type="submit" value="Purchase Order" class="btn btn-success">
                    <br>
                     <a href="{{route('homepage')}}" class="btn btn-out btn-primary btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                </div>
            </div>
        </aside>
    </div>
</div>
</form> --> -->
<form id="fromAddToCart">
    <input type="hidden" name="product_id" value="{{$ProductDetails->id}}">
    <input type="hidden" name="product_name" value="{{$ProductDetails->product_name}}">
    <input type="hidden" name="product_desc" value="{{$ProductDetails->product_desc}}">
    <input type="hidden" name="product_price" value="{{$ProductDetails->product_price}}">
    <input type="hidden" name="product_image" value="{{$ProductDetails->product_image}}">
    <input type="hidden" name="total" value="{{$ProductDetails->product_price}}">
    <input type="hidden" name="pqty" id="pqty" value="1">
    @csrf
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function()
    {

        var ProQuantity=$('.quantity_val').val();
        var Proprice=$('.pro_price').val();
        if(ProQuantity =='1')
        {
           $('.subtotal').val(Proprice);
        }
        $('.quantity_val').change(function()
        {
            
             var Quantity=$('.quantity_val').val();
             var pprice=$('.pro_price').val();
             var ProQuan=$('.quantity_val').val();
             var subtotal=Quantity * pprice;
             //alert(subtotal);
             $('.subtotal').val(subtotal);
             $('.quantity').val(ProQuan);


        });
        $('.pro_price').click(function(){
            alert("Sorry,You can't edit this field");
        });
        $('.subtotal').click(function(){
            alert("Sorry,You can't edit this field");
        });
    });
</script>
