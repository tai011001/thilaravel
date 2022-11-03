@extends('admin.layout.master')
@section('content')
<div class="container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <div class="container-fluid px-4">
                <h1 class="mt-4">Quản Lý Bill</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Bill
                            </div>

                            <div class="card-body">
                            <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ngày Oder</th>
                <th>Tổng Tiền</th>
                <th>Hình Thức Thanh Toán</th>
                <th>Note</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Trạng Thái</th>

            </tr>
        </thead>
        <tbody>
            @foreach($bills as $bill)
            <form action="{{ route('bills.destroy', $bill['id']) }}" method="post">
          @method('delete') <input name="_method" type="hidden" value="DELETE">
          @csrf
            <tr class="active">
                <td>{{$bill->id_customer}}</td>
                <td>{{$bill->date_order}}</td>
                <td>{{$bill->total}}</td>
                <td>{{$bill->payment}}</td>
                <td>{{$bill->note}}</td>
                <td>{{$bill->created_at}}</td>
                <td>{{$bill->updated_at}}</td>
                <td>{{$bill->trangthai}}</td>
                <td style="width:120px"><button type="button" class="btn btn-success" onclick="window.location='{{route('bills.edit', ['bill' => $bill->id])}}'"><i class="fas fa-pen"></i></button>
                <button name="delete" class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button></form>
                </td>

            </tr>
            @endforeach
        </tbody>
                                 </table>
                                 <!-- script ajax (javascript) có thể đặt ở trong cặp thẻ head hoặc body -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script>
		$("document").ready(function(){
			$(".btn-danger").click(function(){
				return confirm("Bạn có thực sự muốn xóa?");
			});
		});

</script>
                              </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
@endsection
