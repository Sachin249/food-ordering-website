@extends('admin/layout')
@section('page_title','Users')
@section('user_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <br>
     <!-- DATA TABLE-->
      
                                    <table class="table table-borderless table-data3">
                                        <div class="card-header bg-dark text-white container">Active Users</div>
                                        <thead class=" bg-white table-bordered">
                                            <tr>
                                                <th class="text-dark">Id</th>
                                                <th class="text-dark">Name</th>
                                                <th class="text-dark">Email</th>
                                                <th class="text-dark">Image</th>
                                                <th class="text-dark">Verification</th>
                                                <th class="text-dark">Status</th>
                                            </tr>
                                        </thead>
                                      
                                        <tbody>
                                            @foreach($users as $Data)
                                            <tr>
                                                <td>{{$Data->id}}</td>
                                                <td>{{$Data->name}}</td>
                                                <td>{{$Data->email}}</td>
                                                <td>
                                                    <img src="{{url('/user_uploads/profile_images/')}}/{{$Data->user_image}}" alt="" style="width:100px;height:80px;border-radius:10px;">
                                                </td>
                                                <td>
                                                    @if($Data->is_verify==0)
                                                        <a href="javascript:void(0)">
                                                            <button class="btn btn-danger btn-sm">Not verified <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($Data->is_verify==1)
                                                        <a href="javascript:void(0)">
                                                            <button class="btn btn-success btn-sm">Verified <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                            
                                                </td>
                                                <td>
                                                    @if($Data->user_status==0)
                                                        <a href="{{url('/admin/user/user_status/1')}}/{{$Data->id}}">
                                                            <button class="btn btn-danger btn-sm">Deactive <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                        </a>
                                                        @elseif($Data->user_status==1)
                                                        <a href="{{url('/admin/user/user_status/0')}}/{{$Data->id}}">
                                                            <button class="btn btn-success btn-sm">Active <i class="fa fa-check" aria-hidden="true"></i></button>
                                                        </a>
                                                    @endif
                                            
                                                </td>
                                              
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
</div>
@endsection