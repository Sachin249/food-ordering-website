@extends('user/login_layout')
@section('page_title','User Login')
<!-- header start -->
<!-- Navigation -->
<div class="fixed-top"> 
  <nav class="navbar navbar-expand-lg navbar-dark mx-background-top-linear">
    <div class="container">
      <a class="navbar-brand" rel="nofollow" target="_blank" href="#" style="font-family: Century; font-weight:bold;"> Online Food System </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>    
  </nav>
</div>
<br><br>

<!-- header end -->
<div class="cotainer-fluid">
    <div class="login-wrap">
	<div class="login-html">
        @if(session('error'))
            <div class="alert alert-danger" role="alert">
            {{session('error')}}
            </div>
        @endif
        @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
        @endif
		<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
		<input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Sign Up</label>
		
		<div class="login-form">
			<div class="sign-in-htm">
                <form action="user/auth" method='POST'>
                    @csrf
				<div class="group">
					<label for="user" class="label">UserEmail</label>
					<input id="user" name="user_email"  type="text" class="input" value={{ Cookie::get('login_email') }}>
				</div>
				<div class="group">
					<label for="pass" class="label">Password</label>
					<input id="pass" name="user_password"  type="password"  class="input" data-type="password" value="{{ Cookie::get('login_pwd') }}">
				</div>
				<div class="group">
					<label for="rememberme">
						<input type="checkbox" id="rememberme" name="rememberme"> <span class="text-white">Keep me Signed in</span> 
					</label>
				</div>
				<div class="group">
					<input type="submit" class="button" value="Sign In">
				</div>
				<div class="hr"></div>
				<div class="foot-lnk text-white">
					<a href="#forgot">Forgot Password?</a>
				</div>
                </form>
			</div>
			<div>
			<div class="sign-up-htm">
                <form action="user/registration" method='POST'>
                    @csrf
				<div class="group">
					<label for="user" class="label">Username</label>
					<input id="user_name" name="u_name" value="{{old('u_name')}}" type="text" class="input">
                    @error('u_name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
				<div class="group">
					<label for="email" class="label">Email Address</label>
					<input id="email" name="u_email" value="{{old('u_email')}}" type="text" class="input">
                    @error('u_email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
				<div class="group">
					<label for="pass1" class="label">Password</label>
					<input id="pass1" name="u_password" value="{{old('u_password')}}" type="password" class="input" data-type="password">
                    @error('u_password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
				<div class="group">
					<label for="pass2" class="label">Repeat Password</label>
					<input id="pass2" name="u_repeat_password" value="{{old('u_repeat_password')}}" type="password" class="input" data-type="password">
                    @error('u_repeat_password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>

				<div class="group">
					<input type="submit" class="button" value="Sign Up">
				</div>
                </form>
			</div>
        
		</div>
	</div>
</div>
	<!-- </div> -->
@include('user/footer')