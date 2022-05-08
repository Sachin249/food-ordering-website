@extends('admin/layout')
@section('page_title','Add Product')
@section('product_select','active')
@section('container')

<div class='container'>
    
    
     <h1>Product</h1>
     <a class="btn btn-success my-2 " href="{{url('admin/product')}}">
         <button>Back</button>
     </a>
     <br>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">Add Category</div>
                                    <div class="card-body">
                                        <form action="{{route('product.insert')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="category" class="control-label mb-1">Product Name</label>
                                                <input id="category" name="product_name" value="{{old('product_name')}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('product_name')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Product Slug</label>
                                                <input id="category_slug" name="product_slug" value="{{old('product_slug')}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('product_slug')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_category" class="control-label mb-1">Product Category</label>
                                                <select id="product_category" name="product_category"  value="{{old('product_category')}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    <option value="">Select Category</option>
                                                    @foreach($CategoryData as $list)
                                                    <option value="{{$list->id}}">{{$list->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                    @error('product_category')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Product Description</label>
                                                <textarea id="category_slug" name="product_desc" value="{{old('product_desc')}}" class="form-control" aria-required="true" aria-invalid="false"></textarea>
                                                    @error('product_price')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="category_slug" class="control-label mb-1">Product Price</label>
                                                <input id="category_slug" name="product_price" value="{{old('product_price')}}" type="text" class="form-control" aria-required="true" aria-invalid="false">
                                                    @error('product_price')
                                                    <span class="text-danger">{{$message}}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="product_image" class="control-label mb-1">Product Image</label>
                                                <input type="file" id="product_image" class="form-control"  name="product_image">
                                                @error('product_image')
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