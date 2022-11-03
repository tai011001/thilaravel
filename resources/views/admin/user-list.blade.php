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
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Userlist
                            </div>
                            <div class="card-body">
                            <table class="table">
        <thead>
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
        </thead>
        
        <tbody>
            @foreach($users as $user)
            <form action="{{ route('users.destroy', $user['id']) }}" method="post">
          @method('delete') <input name="_method" type="hidden" value="DELETE">
          @csrf
            <tr class="active">
                <td><a href="users/{{$user->id}}">{{$user->id}}</a></td>
                <td>{{$user->full_name}}</td>
                <td>{{$user->email}}</td>
                <!-- <td>{{$user->password}}</a></td> -->
                <td>****************</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->address}}</td>
                <td>{{$user->level}}</td>
                <td style="width:120px"><button type="button" class="btn btn-success" onclick="window.location='{{route('users.edit',$user->id)}}'"><i class="fas fa-pen"></i></button>
                <button name="delete" class="btn btn-danger" type="submit"><i class="fas fa-trash"></i></button></form>
                </td>
                <td>
                <!-- <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" value="xoa" />
                </form> -->

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
