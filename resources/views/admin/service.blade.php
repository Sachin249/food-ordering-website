@extends('admin/layout')
@section('page_title','Services')
@section('service_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <h1>All Services</h1>
     <a class="btn btn-success my-2 " href='service/manage_service'>
         <button class="text-white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Service</button>
     </a>
     <br>
     <!-- DATA TABLE-->
     <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ServiceData as $Data)
                                            <tr>
                                                <td>{{$Data->service_id}}</td>
                                                <td class="text-capitalize">{{$Data->service_name}}</td>
                                                <td class="text-capitalize">{{$Data->service_desc}}</td>
                                                <td>
                                                    <img src="{{url('/admin_uploads/service_images/')}}/{{$Data->service_image}}" alt="" style="width:100px;height:80px;border-radius:10px;">
                                                </td>
                                                <td>
                                                    @if($Data->service_status==0)
                                                        <a href="{{url('/admin/service/service_status/1')}}/{{$Data->service_id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($Data->service_status==1)
                                                        <a href="{{url('/admin/service/service_status/0')}}/{{$Data->service_id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                    <a href="{{url('/admin/service/edit/')}}/{{$Data->service_id}}">
                                                        <button class="btn btn-success btn-sm">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </a>
                                                    <a href="{{url('/admin/service/delete/')}}/{{$Data->service_id}}">
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