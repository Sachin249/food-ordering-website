@extends('admin/layout')
@section('page_title','Edit Staff')
@section('staff_select','active')
@section('container')

<div class='container'>
    
    
     <h1>Edit Service</h1>
     <a class="btn btn-success my-2 " href="{{url('admin/staff')}}">
         <button>Back</button>
     </a>
     <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Update Staff</div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="staff_name" class="control-label mb-1">Staff Name</label>
                                                <input id="staff_name" name="staff_name" value="{{$StaffData->staff_name}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('staff_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="staff_role" class="control-label mb-1">Staff Role</label>
                                                <input id="staff_role" name="staff_role" value="{{$StaffData->staff_role}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('staff_role')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="staff_image" class="control-label mb-1">Staff Image</label>
                                                <input type="file" id="staff_image" class="form-control" value="" name="staff_image">
                                                <img src="{{url('/admin_uploads/staff_images/')}}/{{$StaffData->staff_image}}" alt="">
                                                @error('staff_image')
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