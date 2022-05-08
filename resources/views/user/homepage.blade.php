    @extends('user/layout')
    @section('page_title','Homepage')
    @section('home','active')
    
    <!-- crousel start -->
    <!-- <div style="margin-top:60px;background:#0F322F"></div> -->
<div  id="carouselExampleIndicators" class="carousel slide mt-3 " data-bs-ride="carousel" >
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="https://sulaindianrestaurant.com/wp-content/uploads/2021/01/Indian-restaurant-near-me.jpg" class="d-block w-100 img-fluid"  alt="..."/>
    </div>

    <div class="carousel-item ">
      <img src="https://media.istockphoto.com/photos/assorted-indian-dish-picture-id868408746?k=20&m=868408746&s=170667a&w=0&h=UouUKHgmO666lED12Ohqqtf2ftom6rg8aRoSAkP3HfE=" class="d-block w-100" alt="..."/>
    </div>
    
    <div class="carousel-item">
      <img src="https://mediacloud.theweek.co.uk/image/private/s--tX4wczJv--/v1604723331/theweek/2017/02/hoppers1.jpg" class="d-block w-100"  alt="..."/>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<!-- crousel end -->
@if(session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show alertbox" role="alert">
            {{session('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
            <div class="container mt-3 text-center">
                <div class="btn-group">
                    <a href="#about">
                        <button>About</button> 
                    </a>
                    <a href="#service">
                        <button>Service</button> 
                    </a>
                    <a href="#staff">
                        <button>Staff</button> 
                    </a>
                    <a href="#contact">
                        <button>Contact</button> 
                    </a>
                  </div>
            </div>
<!-- search bar -->
<div class="container-fluid w-50 my-5">
<form action="{{route('searchProduct')}}" class="d-flex" method="POST">
  @csrf
    <input name="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <input type="submit" value="Search" class="btn btn-success">
</form>
</div>
<!-- search bar end -->
<!-- product categories start-->
<nav>
    <h3 class="text-center heading_font">Food Categories</h3><br>
  <div class=" container nav nav-tabs nav-justified  w-50 justify-content-center" id="nav-tab" role="tablist">
    @foreach($product_categories as $Category)
      <button class="mx-4 my-1 mb-3 btn btn-outline-info text-capitalize" id="#cat{{$Category->id}}" data-bs-toggle="tab" data-bs-target="#cat{{$Category->id}}" type="button" >{{$Category->category_name}}</button>
    @endforeach
</div>
</nav>
<div class="tab-content" id="nav-tabContent" style="margin-bottom: 70px;">
  @php
  $loop_count=1;
  @endphp
  @foreach($product_categories as $Category)
  @php
  $cat_class='';
  if($loop_count==1)
  {
    $cat_class='active';
    $loop_count++;
  }
  @endphp
    
    <div class="tab-pane fade show {{$cat_class}}" id="cat{{$Category->id}}" >
      <div class="container">
        <div class="row">
      @foreach($product_data[$Category->id] as $product)
    <div class="col-md-4 ">
        <div class="card pl-0 pr-0 pt-0" style="padding-bottom: 10px;margin-bottom: 10px;"> 
            <img src="{{url('admin_uploads/product_images/')}}/{{$product->product_image}}" class="card-img-top" alt="..." style="height:300px;">
            <div class="card-body">
                <h5 class="card-title text-capitalize">{{$product->product_name}}</h5>
                <!-- <small><span class="">Price :Rs.{{$product->product_price}}</span></small> -->
                <p class="card-text text-capitalize">{{$product->product_desc}}</p>
                <a href="{{url('user/homepage/product_details')}}/{{$product->id}}" class="btn btn-warning">Order Now</a>
                <span class="position-absolute top-0 translate-middle badge rounded-pill bg-danger" style="left:90%;z-index: 1;">
                    Price :Rs.{{$product->product_price}}
                <span class="visually-hidden">unread messages</span>
            </div>
        </div>
    </div>
      @endforeach
    </div>
  </div>
    </div>
 
  @endforeach
</div>
<section class="bg-section" id="about">
    <h1 class="container-h1 text-center pb-3" style="padding-top:70px;">About</h1>
        <div class="container-fluid bg-about col-11"  style="border-radius: 10px; padding-top:30px;">   
            <div class="row">
                <div class="col-sm-5">

                    <div class="hov-img">
                        <img src="https://res.cloudinary.com/dbte0ueti/image/upload/v1536951746/new/warm_welcome.jpg" alt="Warm welcome" class="hov-img-bottom img-fluid">
                        <div class="hov-img-top hov-img-slideup">
                            <div class="hov-img-text">
                                <h5>Warm welcome</h5>
                                <p>It had separate tables, a menu, and specialized in soups made with a base of meat and eggs, which were said to be restaurants or, in English "restoratives".</p>
                            </div>
                        </div>
                    </div>                    

                    <div class="hov-img">
                        <img src="https://res.cloudinary.com/dbte0ueti/image/upload/v1536951746/new/delicious_meals.jpg" alt="Delicious meals" class="hov-img-bottom img-fluid">
                        <div class="hov-img-top hov-img-slideup">
                            <div class="hov-img-text">
                                <h5>Delicious meals</h5>
                                <p> In about 1765 a new kind of eating establishment, called a "Bouillon", was opened on rue des Poulies, near the Louvre, by a man named Boulanger.</p>
                            </div>
                        </div>
                    </div>
                   
                </div>

                <div class="col-sm-6">
                    <div class="row ">
                        <div class="restaurant-history slideanim text-center">
                            <h3 class="section-heading">Restaurant Northstreet</h3>
                            <p class="about-history first">
                            Our sincere effort is to make your dining experience memorable by bringing to you centuries old Cuisine, and recipes from our mother’s kitchen.
                            As a part of the Main Street hub for the food enthusiast, our sole effort is to present you with fresh food, new savors and various robust flavors from turmeric, zeera (cumin), ginger, carom seeds and an array of unique spices which will be a treat to your palate.
                            We specialize in Indian breads(Naan), meats grilled in tandoor, variety of curries,and biryani.
                            We provide an excellent choice of various exotic vegetables, lentils, breads, aromatic rice, meat and much more.
                            Our extensive menu includes a fine collection of wine and spirits in addition to well-known traditional Indian dishes.
                            We take pride in our well experienced team which has become a part of our family and business over the years of working together.
                            For us meal time is more than food-it's about connection and sharing love. We believe in supporting other local businesses as well. Our mission is to provide you with the deepest pleasure of quality dining and exceptional service.
                            </p>

                            <button type="button" class="btn more btn-dark" id="more" data-toggle="collapse" data-target="#demo">More</button>
                            <div id="demo" class="collapse">  
                                <p class="about-history"> Thanks to Boulanger and his imitators, these soups moved from the category of remedy into the category of health food and ultimately into the category of ordinary food. Their existence was predicated on health, not gustatory, requirements.</p>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>     
        </div>
    </section>

    <section class="bg-service bg-section pb-3" id="service" style="margin-bottom:50px;padding-top:100px;">
        <div class="container-fluid text-center">
            <h1 class="container-h1 pt-2 mb-5">Service</h1>

            <div class="row service-round-3 slideanim">
                @foreach($service as $servicedata)
                <div class="col-sm-4 text-center round">
                    <div class="service-round b-party">
                        <!-- <i class="fa fa-4x fa fa-birthday-cake sr-icons"></i> -->
                        <img src="{{url('admin_uploads/service_images/')}}/{{$servicedata->service_image}}" class="card-img-top" alt="..." style="border-radius:10px">
                    </div>
                    <h4 style="color:skyblue;">{{$servicedata->service_name}}</h4>
                    <p>{{$servicedata->service_desc}}</p>
                </div>
                @endforeach
                <!-- <div class="col-sm-4 text-center round">
                    <div class="service-round wedding">
                        <i class="fa fa-4x fa fa-heart sr-icons"></i>
                    </div>    
                    <h4>Wedding</h4>
                    <p>For more information please contact us</p>
                </div>
                <div class="col-sm-4 text-center round">
                    <div class="service-round b-dinner">
                        <i class="fa fa-4x fa fa-suitcase  sr-icons"></i>
                    </div>
                    <h4>Business dinner</h4>
                    <p>For more information please contact us.</p>
                </div> -->
            </div>
            <a href="#contact" class="btn " style="background-color:#212529;color:white;">Contact us</a>
        </div>
    </section>
   
    <section class="bg-staff" id="staff" style="padding-top:80px;">
        <div class="container-fluid text-center ">
            <h1 class="container-h1 mb-5 ">Our staff</h1>
                <div class="row text-center slideanim thumbnail-row">
                    @foreach($staff as $staffData)
                    <div class="col-sm-3">
                        <div class="staff">
                            <img src="{{url('admin_uploads/staff_images/')}}/{{$staffData->staff_image}}" class="" alt="chef-img" style="width:170px; height: 170px">
                            <h5 class="text-light">{{$staffData->staff_name}}</h5>
                            <h6>{{$staffData->staff_role}}</h6>    
                        </div>
                     </div>
                     @endforeach
                     <!-- <div class="col-sm-3">  
                        <div class="staff">
                            <img src="https://res.cloudinary.com/dbte0ueti/image/upload/v1536952565/new/chef1.jpg" class="" alt="chef-img" style="width:170px; height: 170px">
                            <h5 class="">Anna Schmidt</h5>
                            <h6>Chef</h6>         
                        </div>
                    </div>  
                    <div class="col-sm-3">  
                        <div class="staff">
                            <img src="https://res.cloudinary.com/dbte0ueti/image/upload/v1536952566/new/chef3.jpg" class="" alt="chef-img" style="width:170px; height: 170px">
                            <h5 class="">Ivan Gonzales</h5>
                            <h6>Chef</h6>
                        </div>
                    </div>
                      <div class="col-sm-3">  
                        <div class="staff">
                            <img src="https://res.cloudinary.com/dbte0ueti/image/upload/v1536952566/new/chef2.jpg" class="" alt="chef-img" style="width:170px; height: 170px">
                            <h5 class="">Joseph Martinez</h5>
                            <h6>Chef</h6>
                        </div>
                    </div> -->
                </div>
        </div>
    </section>
    <section class="bg-testimonials text-center" id="testimonials">
        <div class="container-fluid">
            <h3 class="" style="color:skyblue;">What people say about us</h3>
            <hr class="hr-testimonials">
            <div class="row slideanim">    
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ul class="carousel-indicators">
                      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <li data-target="#myCarousel" data-slide-to="1"></li>
                      <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ul>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                      <div class="carousel-item active">
                            <h4>The atmosphere in restaurant is friendly, and the
                            dishes are delicious.</h4>
                            <h5>Sachin Sen Sks</h5>
                      </div>

                      <div class="carousel-item">
                            <h4>Delicious meals, warm welcome, excellent service.</h4>
                            <h5>Sandeep Kumar</h5>
                      </div>
                    
                      <div class="carousel-item">
                            <h4>Definitely my favourite restaurant, friendly, clean, 
                            delicious meals.</h4>
                            <h5>Ravindra Kushwaha</h5>
                      </div>
                    </div>

                    <!-- Left and right controls -->
                    <a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" data-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </a>
                </div>
            </div>
        </div>       
    </section>
    <section class="bg-contact bg-section pb-3" id="contact" style="padding-top:100px;">
        <div class="container-fluid">
            <h1 class="container-h1 text-center pb-2 mb-5">Contact us</h1>
            <div class="row slideanim">
                <div class="col-md-6 col-sm-6 contact-left">
                    <div class="left-box">
                        <address class="contact">
                            <span class="span-contact">Call:</span>
                            <br>
                            {{$contact[0]->company_mobile}}
                            <br> 
                            <span class="span-contact">Email:</span> 
                            <br>
                            {{$contact[0]->company_email}}
                            <br>
                            <span class="span-contact">Visit:</span>  
                            <br>
                            {{$contact[0]->company_address}}
                        </address>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6 contact-right my-1" >
                            
                            <form  action="mailto:sachinsen249@gmail.com" name="frm" method="post" enctype="text/plain">
                                 <div class="form-group has-feedback">
                                    <label class="sr-only">First name:</label>
                                    <input type="text" name="Name" class="form-control" placeholder="First name" required>
                                    
                                </div>
                                 <div class="form-group has-feedback">
                                    <label class="sr-only">Last name:</label>
                                    <input type="text" name="Surname" class="form-control" placeholder="Last name" required>
                                    
                                </div>
                                <div class="form-group has-feedback">
                                    <label class="sr-only">Email:</label>
                                    <input type="email" name="Email" class="form-control"  placeholder="Email" required>
                                    
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" name="comment" for="comment">Comment:</label>
                                    <textarea class="form-control" rows="4" id="comment" name="Description" placeholder="Description" required></textarea>
                                </div>
                                <div class="contact-buttons pull-left">
                                    <input type="submit"  value="Send" />
                                    <input type="reset"  value="Reset" />
                                </div>
                            </form>
                            
                </div>
            </div>
            
    </section>
    <div  style="margin-bottom:50px; margin-left: 15px; margin-right: 15px; border-radius: 10px;"><iframe style="border-radius: 10px;" border-radius: 10px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3680.37593822426!2d75.86684851744386!3d22.71426420000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962fd1094ac41e1%3A0xab23549077cbb09b!2sShree%20Guru%20Kripa%20Hotel!5e0!3m2!1sen!2sin!4v1648933020882!5m2!1sen!2sin" width="100%" height="300"  allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
@include('user/footer')
