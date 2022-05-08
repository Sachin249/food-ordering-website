@extends('user/layout')
@section('page_title','Order Status')
@section('myorders_select','active')

<div class="container order_status_main_div">
    <article class="card">
        <header class="card-header"> My Orders / Tracking </header>
        <div class="card-body">
            <h6>Order ID: #OFS0{{$OrderData['0']->id}} </h6>
            <article class="card m-0 p-0 ">
                <div class="card-body row">
                    <div class="col"> <strong>Estimated Delivery time:</strong> <br>30 mins To 1 hour</div>
                    <div class="col"> <strong>Delivery BY:</strong> <br> Food System, | <i class="fa fa-phone"></i> +1598675986 </div>
                    <div class="col"> <strong>Status:</strong> <br> 
                       @php 
                        if($OrderData['0']->order_status == '1')
                        {
                            @endphp
                            <a href="#" class="btn btn-success" data-abc="true"> Confirmed</a> 
                            @php
                        }
                        else
                        {
                            @endphp
                            <a href="#" class="btn btn-danger" data-abc="true"> Pending</a>
                            @php
                        }

                        @endphp
                         
                    </div>
                    <div class="col"> <strong>Tracking :</strong> <br> #BD045903594059OFS0{{$OrderData['0']->order_id}} </div>
                </div>
            </article>
            <div class="track pb-2">
            <?php
                if($OrderData['0']->order_status == '1')
                {
                 ?>
                 <div class="step active"> <span class="icon"> <i class="fa fa-spinner fa-2x mt-1" aria-hidden="true"></i> </span> <span class="text">Processing </span> </div>
                 <div class="step active"> <span class="icon"> <i class="fa fa-check fa-2x mt-1"></i> </span> <span class="text">Order confirmed</span> </div>
                 <?php
                }
                else
                {
                  ?>
                  <div class="step active"> <span class="icon"> <i class="fa fa-spinner fa-2x mt-1" aria-hidden="true"></i> </span> <span class="text">Processing </span> </div>
                  <div class="step"> <span class="icon"> <i class="fa fa-check fa-2x mt-1"></i> </span> <span class="text">Order confirmed</span> </div>
                  <?php
                }
                ?>
                <?php 
                 if($OrderData['0']->packed_by_courier == '1' && $OrderData['0']->order_status == '1')
                  {
                    ?>
                    <div class="step active"> <span class="icon"> <i class="fa fa-user fa-2x mt-1"></i> </span> <span class="text"> Picked successfully</span> </div>
                   <?php
                  }
                  else
                  {
                    ?>
                    <div class="step"> <span class="icon"> <i class="fa fa-user fa-2x mt-1"></i> </span> <span class="text"> Picked by courier</span> </div>
                    <?php
                  }
                 if($OrderData['0']->on_the_way == '1' && $OrderData['0']->order_status == '1')
                  {
                    ?>
                     <div class="step active"> <span class="icon"> <i class="fa fa-truck fa-2x mt-1"></i> </span> <span class="text"> On the way </span> </div>
                   <?php
                  }
                  else
                  {
                    ?>
                    <div class="step"> <span class="icon"> <i class="fa fa-truck fa-2x mt-1"></i> </span> <span class="text"> On the way </span> </div>
                    <?php
                  }
                 if($OrderData['0']->delivered == '1' && $OrderData['0']->order_status == '1')
                  {
                    ?>
                     <div class="step active"> <span class="icon"><i class="fa fa-thumbs-o-up fa-2x pt-1" aria-hidden="true"></i></span> <span class="text">Delivered Successfully</span>
                     </div>
                   <?php
                  }
                  else
                  {
                    ?>
                    <div class="step"> <span class="icon"> <i class="fa fa-thumbs-o-up fa-2x pt-1" aria-hidden="true"></i></span> <span class="text">Delivered</span></div>
                    <?php
                  }
                  
                ?>
            </div>
            <br>
            <hr>
            <ul class="row">
                     <li class="col-md-4 mt-3">
                        <figure class="itemside mb-3">
                            <div class="aside"><img src="{{url('admin_uploads/product_images/')}}/{{$OrderData['0']->product_image}}" class="img-sm border" style ="height: 150px;width: 150px;"></div>
                            <figcaption class="info align-self-center">
                                <strong class="title mt-2 text-capitalize" style="font-family: sans-serif;"><?= $OrderData['0']->product_name; ?> <br> </strong>
                                 <span class="text-muted">
                                    <small>
                                     Quantity <?= $OrderData['0']->qty.' pcs'; ?>
                                   </small> 
                                 </span> <br> 
                                 <small class="text-muted" style="">
                                    Price   <?= 'Rs.'.$OrderData['0']->price; ?> 
                                </small><br>
                                 <small class="text-muted" style="">Subtotal  <?= 'Rs.'.$OrderData['0']->price*$OrderData['0']->qty; ?> 
                             </small>

                            </figcaption>
                        </figure>
                     </li>
                  
             
   
     

                
            
            </ul>
            <hr> <a href="{{route('homepage')}}" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to Home</a>
        </div>
    </article>
</div>