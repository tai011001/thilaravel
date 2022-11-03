@extends('admin.layout.master')
@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('users.update',$user->id)}}" method="post" role="form" enctype="multipart/form-data">
        @csrf
        @method('put') <!-- <input name="_method" type="hidden" value="PATCH">  -->
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="full_name" id="" class="form-control" value="{{$user->full_name}}">
        <label for="">Email</label>
        <input type="text" name="email" id="" class="form-control" value="{{ isset($user->email)?$user->email:'' }}">
        <label for="">Phone</label>
        <input type="text" name="phone" id="" class="form-control" value="{{ isset($user->phone)?$user->phone:'' }}">
        <label for="">Address</label>
        <input type="text" name="address" id="" class="form-control" value="{{ isset($user->phone)?$user->address:'' }}">
        <label for="">Level</label>
        <input type="number" name="level" id="" class="form-control" value="{{ isset($user->level)?$user->level:'' }}">
            </div>
        <input name="btnSave" id="" class="btn btn-primary" type="submit" value="Edit">
    </div>
    </div>  
    </form>
@endsection