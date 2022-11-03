@extends('admin.layout.master')
@section('content')
    <h1>Edit User</h1>
    <form action="{{ route('bills.update',$bill->id)}}" method="post" role="form" enctype="multipart/form-data">
        @csrf
        @method('put') <!-- <input name="_method" type="hidden" value="PATCH">  -->
    <div class="form-group">
        <label for="">ID</label>
        <input type="text" name="id_customer" id="" class="form-control" value="{{$bill->id_customer}}">
        <label for="">Date_Order</label>
        <input type="text" name="date_order" id="" class="form-control" value="{{ isset($bill->date_order)?$bill->date_order:'' }}">
        <label for="">Total</label>
        <input type="text" name="total" id="" class="form-control" value="{{ isset($bill->total)?$bill->total:'' }}">
        <label for="">Payment</label>
        <input type="text" name="payment" id="" class="form-control" value="{{ isset($bill->payment)?$bill->payment:'' }}">
        <label for="">Note</label>
        <input type="text" name="note" id="" class="form-control" value="{{ isset($bill->note)?$bill->note:'' }}">
        <label for="">Created_AT</label>
        <input type="text" name="created_at" id="" class="form-control" value="{{ isset($bill->created_at)?$bill->created_at:'' }}">
        <label for="">Updated_at</label>
        <input type="text" name="updated_at" id="" class="form-control" value="{{ isset($bill->updated_at)?$bill->updated_at:'' }}">
        <label for="">Trang Thai</label>
        <input type="text" name="trangthai" id="" class="form-control" value="{{ isset($bill->trangthai)?$bill->trangthai:'' }}">
            </div>
        <input name="btnSave" id="" class="btn btn-primary" type="submit" value="Edit">
    </div>
    </div>  
    </form>
@endsection