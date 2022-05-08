<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title')</title>
    <!-- tab icon -->
    <link rel="icon" type="image/x-icon" href="{{url('favicon.ico')}}">
    <!-- CSS link -->
    <link rel="stylesheet" href="{{url('admin_assets/css/style.css')}}">
 
    <!-- CSS only -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="{{asset('admin_assets/js/custom.js')}}"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <script src="{{asset('admin_assets/js/user.js')}}"></script>

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<!-- class="body_color" -->
<body >
    <!-- Navigation -->
<div class="fixed-top" >
  
  <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
    <div class="container">
      <a class="navbar-brand" rel="nofollow" target="_blank" href="#" style="font-family: Century; font-weight:bold;"> Online Food System </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto" >

          <li class="nav-item @yield('home')">
            <a class="nav-link" href="{{url('user/homepage/')}}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item @yield('myorders_select')">
            <a class="nav-link" href="{{url('user/homepage/myorders/')}}">Myorders
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item @yield('mycart_select')">
            <a class="nav-link" href="{{url('user/homepage/mycart/')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> My Cart
              <span class="sr-only">(current)</span>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if($Userdata->user_image)
              <img src="{{url('/user_uploads/profile_images/')}}/{{$Userdata->user_image}}" width="40px" height="30px" class="rounded-circle" style="height:30px;width:40px;">
              @else
              <img src="{{url('/user_uploads/profile_images/dummy.jpg')}}" width="40px" height="30px" class="rounded-circle" style="height:30px;width:40px;">
              @endif
              <span class='text-capitalize'>{{$Userdata->name}}</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <div class="dropdown-item text-muted">
                <span class="email">{{$Userdata->email}}</span>
            </div>
            <!-- <a class="dropdown-item @yield('myorders_select')" href="{{url('user/homepage/myorders/')}}">Myorders</a> -->
              <a class="dropdown-item @yield('account_setting_select')" href="{{route('account_setting')}}">Account Setting</a>
              <a class="dropdown-item" href="{{route('userlogout')}}">Logout</a>
            </div>
          </li>   
        </ul>
      </div>
      
    </div>
  </nav>
</div>
<br><br>
</body>
</html>