@extends('user/layout')
@section('page_title','Account Setting')
@section('account_setting_select','active')

<div class="container light-style flex-grow-1 container-p-y" style="margin-bottom:100px;margin-top:100px;">

    <h4 class="font-weight-bold" >
      Account settings
    </h4>

    <div class="card overflow-hidden">
      <div class="row no-gutters row-bordered row-border-light">
        <div class="col-md-3 pt-0">
          <div class="list-group list-group-flush account-settings-links">
            <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
            <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
          </div>
        </div>
        <div class="col-md-9">
          <div class="tab-content">
            @if(session()->has('status'))
            <div class="alert alert-success alert-dismissible fade show alertbox" role="alert">
              {{session('status')}}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            
            <div class="tab-pane fade active show" id="account-general">
            <form action="{{url('user/homepage/account_setting/update_profile')}}/{{$Userdata->id}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body media align-items-center">
                
                @if($Userdata->user_image)
                <img src="{{url('/user_uploads/profile_images/')}}/{{$Userdata->user_image}}" alt="" class="d-block ui-w-80">
                @else
                <img src="{{url('/user_uploads/profile_images/dummy.jpg')}}" alt="" class="d-block ui-w-80">
                @endif
                <div class="media-body ml-4">
                  <label class="btn btn-outline-primary">
                    Upload new photo
                    <input type="file" class="account-settings-fileinput" name="user_image">
                  </label> &nbsp;
                  <!-- <button type="button" class="btn btn-default md-btn-flat">Reset</button> -->

                  <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                </div>
              </div>
              <hr class="border-light m-0">

              <div class="card-body">
                
                  <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control mb-1" value="{{$Userdata->name}}" name="user_name">
                  </div>
                  <div class="form-group">
                    <label class="form-label">E-mail</label>
                    <input type="text" class="form-control mb-1" value="{{$Userdata->email}}" name="user_email">
                    <!-- <div class="alert alert-warning mt-3">
                      Your email is not confirmed. Please check your inbox.<br>
                      <a href="javascript:void(0)">Resend confirmation</a>
                    </div> -->
                  </div>
                  <div class="form-group">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control" value="{{$Userdata->address}}" name="user_address">
                  </div>
                
              </div>
              <div class="text-right mt-3">
                <input type="submit" class="btn btn-primary" value="Save changes">&nbsp;
                
                <a href="{{route('homepage')}}" class="btn btn-dark text-light">Cancel</a>
              </div>
              </form>
            </div>
            <div class="tab-pane fade" id="account-change-password">
              <form action="{{url('user/homepage/account_setting/change_password')}}/{{$Userdata->id}}" method="POST">
                @csrf
              <div class="card-body pb-2">
                
                <div class="form-group">
                  <label class="form-label">Current password</label>
                  <input type="password" class="form-control" value="{{old('current_pwd')}}" name="current_pwd">
                </div>

                <div class="form-group">
                  <label class="form-label">New password</label>
                  <input type="password" class="form-control" value="{{old('new_pwd')}}" name='new_pwd'>
                </div>

                <div class="form-group">
                  <label class="form-label">Confirm new password</label>
                  <input type="password" class="form-control" value="{{old('confirm_pwd')}}" name='confirm_pwd'>
                </div>

              </div>
              <div class="text-right mt-3">
                <input type="submit" class="btn btn-primary" value="Change Password">&nbsp;
                
                <a href="{{route('homepage')}}" class="btn btn-dark text-light">Cancel</a>
              </div>
            </form>
            </div>
            
      </div>
    </div>

    

  </div>
@include('user/footer')