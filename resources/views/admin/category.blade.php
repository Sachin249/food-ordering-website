@extends('admin/layout')
@section('page_title','Category')
@section('category_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <h1>Category</h1>
     <a class="btn btn-success my-2 " href='category/manage_category'>
         <button class="text-white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Category</button>
     </a>
     <br>
     <!-- DATA TABLE-->
     <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Category Name</th>
                                                <th>Category Slug</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($category_data as $cData)
                                            <tr>
                                                <td>{{$cData->id}}</td>
                                                <td>{{$cData->category_name}}</td>
                                                <td>{{$cData->category_slug}}</td>
                                                <td>
                                                    @if($cData->status==0)
                                                        <a href="{{url('/admin/category/status/1')}}/{{$cData->id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($cData->status==1)
                                                        <a href="{{url('/admin/category/status/0')}}/{{$cData->id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                    <a href="{{url('/admin/category/edit/')}}/{{$cData->id}}">
                                                        <button class="btn btn-success btn-sm">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </a>
                                                    <a href="{{url('/admin/category/delete/')}}/{{$cData->id}}">
                                                        <button class="btn btn-danger btn-sm">Delete <i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
</div>
@endsection