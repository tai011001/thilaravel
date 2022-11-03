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
                <a name="btnAdd" id="" class="btn btn-success" href="{{ route('type_products.create') }}" role="button">Add New Type_Product</a>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                ProductType
                            </div>

                            <div class="card-body">
                            <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Create_at</th>
                <th>Update_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($type_products as $pdt)
            <form action="{{ route('type_products.destroy', $pdt['id']) }}" method="post">
          @method('delete') <input name="_method" type="hidden" value="DELETE">
          @csrf
            <tr class="active">
                <td>{{$pdt->id}}</a></td>
                <td>{{$pdt->name}}</td>
                <td>{{$pdt->description}}</td>
                <td><img src="/source/image/product/{{$pdt->image}}" alt="" style="width: 120px;"></a></td>
                <td>{{$pdt->created_at}}</td>
                <td>{{$pdt->updated_at}}</td>
                <td style="width:120px"><button type="button" class="btn btn-success" onclick="window.location='{{route('type_products.edit',$pdt->id)}}'"><i class="fas fa-pen"></i></button>
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
