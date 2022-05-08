@extends('admin/layout') @section('page_title','Contact')
@section('contact_select','active') @section('container')

<div class="container">
    @if(session()->has('status'))
    <div class="alert alert-success alertbox">
        {{ session("status") }}
    </div>
    @endif
    <h1>Contact</h1>
    <br />
    <!-- DATA TABLE-->
    <div class="table-responsive m-b-40">
        <table class="table table-borderless table-data3">
            <thead>
                <tr>
                    <th>Call</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ContactData as $Data)
                <tr>
                    <td>{{$Data->company_mobile}}</td>
                    <td>{{$Data->company_email}}</td>
                    <td class="text-capitalize">{{$Data->company_address}}</td>
                    <td>
                        <a
                            href="{{
                                url('/admin/contact/edit/')
                            }}/{{$Data->id}}"
                        >
                            <button class="btn btn-success btn-sm">
                                Edit
                                <i
                                    class="fa fa-pencil-square-o"
                                    aria-hidden="true"
                                ></i>
                            </button>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
