@extends('user/layout')
@section('page_title','Search Result')

<div class="card-header" style="margin-top:60px;">
  Search Result
</div>
<div>
<div class="container table-responsive py-5" > 
  <h3 class="heading_font">Matched Results :</h3>
<a href="{{route('homepage')}}" class="btn btn-success mb-2"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Product Id</th>
      <th scope="col">Product Image</th>
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
  @foreach($productData as $list)
    <tr>
      <th>#OFS0{{$list->id}}</th>
      <td>
        <img class="m-0 p-0" src="{{url('admin_uploads/product_images/')}}/{{$list->product_image}}"  alt="..." style="height:100px;width:150px;">
      </td>
      <td>{{$list->product_name}}</td>
      <td>Rs.{{$list->product_price}}</td>
      <td>
        <a class="btn btn-primary" href="{{url('user/homepage/product_details')}}/{{$list->id}}">View</a>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
</div>
@include('user/footer')
