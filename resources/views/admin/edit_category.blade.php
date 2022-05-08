@extends('admin/layout')
@section('page_title','Edit Category')
@section('category_select','active')
@section('container')

<div class='container'>
     <h1>Category</h1>
     <a class="btn btn-success my-2 " href="{{url('admin/category')}}">
         <button>Back</button>
     </a>
     <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Update Category</div>
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="category" class="control-label mb-1">Category</label>
                                                <input id="category" name="category_name" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$CategoryData->category_name}}">
                                                    @error('category_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Category Slug</label>
                                                <input id="category_slug" name="category_slug" type="text" class="form-control" aria-required="true" aria-invalid="false" value="{{$CategoryData->category_slug}}">
                                                    @error('category_slug')
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