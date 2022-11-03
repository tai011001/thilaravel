@extends('admin.layout.master')
@section('content')
<div class="container">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        <div class="container-fluid px-4">
                <h1 class="mt-4">Tables</h1>
                <a name="btnAdd" id="" class="btn btn-success" href="{{ route('products.create') }}" role="button">Add New Type_Product</a>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                ProductList
                            </div>

                            <div class="card-body">
                            <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Thông tin</th>
                <th>Description</th>
                <th>Unit_Price</th>
                <th>Promotion_Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <!-- <tfoot>
            <tr>
                <th>ID</th>
                <th>Fullname</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Level</th>
                <th>Action</th>
            </tr>
        </tfoot> -->
        <tbody>
            @foreach($products as $pd)
            <form action="{{ route('products.destroy', $pd['id']) }}" method="post">
          @method('delete') <input name="_method" type="hidden" value="DELETE">
          @csrf
            <tr class="active">
            <td><img src="/source/image/product/{{$pd->image}}" alt="" width="200" height="200"></a></td>
                <td style="width: 150px;">
                    <p style="font-weight: bold;">
                     {{$pd->name}}</p>
                <p><b>ID: </b>{{$pd->id}}</p>
                <p><b>ID_type: </b>{{$pd->id_type}}</p>
                <p><b>Unit: </b>{{$pd->unit}}</p>
                <p><b>New: </b>{{$pd->new}}</p>
                </td>
                <td style="width:300px;">{{$pd->description}}</td>
                <td>{{$pd->unit_price}}</td>
                <td>{{$pd->promotion_price}}</td>
                <td style="width:120px"><button type="button" class="btn btn-success" onclick="window.location='{{route('products.edit',$pd->id)}}'"><i class="fas fa-pen"></i></button>
                <button name="delete" class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button></form>
                </td>
                <td>

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
