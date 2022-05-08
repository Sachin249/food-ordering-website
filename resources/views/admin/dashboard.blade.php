@extends('admin/layout')
@section('page_title','Dashboard')
@section('dashboard_select','active')
@section('container')

<div class='container'>
            @if(session()->has('status'))
            <div class="alert alert-success alertbox">
            {{session('status')}}
            </div>
            @endif
     <br>
     
@endsection