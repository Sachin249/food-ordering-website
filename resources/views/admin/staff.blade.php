@extends('admin/layout')
@section('page_title','Staff')
@section('staff_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <h1>All Staff</h1>
     <a class="btn btn-success my-2 " href='staff/manage_staff'>
         <button class="text-white"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Staff</button>
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
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($StaffData as $Data)
                                            <tr>
                                                <td>{{$Data->staff_id}}</td>
                                                <td class="text-capitalize">{{$Data->staff_name}}</td>
                                                <td class="text-capitalize">{{$Data->staff_role}}</td>
                                                <td>
                                                    <img src="{{url('/admin_uploads/staff_images/')}}/{{$Data->staff_image}}" alt="" style="width:100px;height:80px;border-radius:10px;">
                                                </td>
                                                <td>
                                                    @if($Data->staff_status==0)
                                                        <a href="{{url('/admin/staff/staff_status/1')}}/{{$Data->staff_id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($Data->staff_status==1)
                                                        <a href="{{url('/admin/staff/staff_status/0')}}/{{$Data->staff_id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    
                                                    <a href="{{url('/admin/staff/edit/')}}/{{$Data->staff_id}}">
                                                        <button class="btn btn-success btn-sm">Edit <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                    </a>
                                                    <a href="{{url('/admin/staff/delete/')}}/{{$Data->staff_id}}">
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