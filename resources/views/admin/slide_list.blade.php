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
                <a name="btnAdd" id="" class="btn btn-success" href="{{ route('slides.create') }}" role="button">Add New Type_Product</a>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Slide
                            </div>

                            <div class="card-body">
                            <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($slides as $slide)
            <form action="{{ route('slides.destroy', $slide['id']) }}" method="post">
          @method('delete') <input name="_method" type="hidden" value="DELETE">
          @csrf
            <tr class="active">
                <td><img src="/source/image/slide/{{$slide->image}}" alt="" height="400"></a></td>
                <td style="width:120px"><button type="button" class="btn btn-success" onclick="window.location='{{route('slides.edit',$slide->id)}}'"><i class="fas fa-pen"></i></button>
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
