@extends('admin.layout.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-1-12">
            <h1 style="color : red">User detail</h1>
            </div>
        </div>
        <div class="row">
            <ul>
                <li>Full Name:{{$user->full_name}}</li>
                <li>Email: {{$user->email}}</li>
                <li>Phone: {{$user->phone}}</li>
                <li>Address:{{$user->address}}</li>
                <li>Level:{{$user->level}}</li>
        </div>
    </div>
    @endsection