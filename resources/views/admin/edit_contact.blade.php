@extends('admin/layout')
@section('page_title','Edit Contact')
@section('contact_select','active')
@section('container')

<div class='container'>
    
    
     <h1>Edit Contact</h1>
     <a class="btn btn-success my-2 " href="{{url('admin/contact')}}">
         <button>Back</button>
     </a>
     <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Update Contact</div>
                                    <div class="card-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="company_mobile" class="control-label mb-1">Call</label>
                                                <input id="company_mobile" name="company_mobile" value="{{$ContactData->company_mobile}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('company_mobile')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="company_email" class="control-label mb-1">Email</label>
                                                <input id="company_email" name="company_email" value="{{$ContactData->company_email}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('company_email')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="company_address" class="control-label mb-1">Email</label>
                                                <input id="company_address" name="company_address" value="{{$ContactData->company_address}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('company_address')
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