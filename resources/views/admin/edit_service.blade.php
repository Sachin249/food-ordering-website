@extends('admin/layout')
@section('page_title','Edit Services')
@section('service_select','active')
@section('container')

<div class='container'>
    
    
     <h1>Edit Service</h1>
     <a class="btn btn-success my-2 " href="{{url('admin/service')}}">
         <button>Back</button>
     </a>
     <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Update Service</div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="service_name" class="control-label mb-1">Service Name</label>
                                                <input id="service_name" name="service_name" value="{{$ServiceData->service_name}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('service_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="service_desc" class="control-label mb-1">Description</label>
                                                <input id="service_desc" name="service_desc" value="{{$ServiceData->service_desc}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('service_desc')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="service_image" class="control-label mb-1">Service Image</label>
                                                <input type="file" id="service_image" class="form-control" value="" name="service_image">
                                                <img src="{{url('/admin_uploads/service_images/')}}/{{$ServiceData->service_image}}" alt="">
                                                @error('service_image')
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