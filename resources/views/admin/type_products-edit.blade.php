@extends('admin.layout.master')
@section('content')
    <h1>Edit Type_Products</h1>
    <form action="{{ route('type_products.update',$type_product->id)}}" method="post" role="form" enctype="multipart/form-data">
        @csrf
        @method('put') <!-- <input name="_method" type="hidden" value="PATCH">  -->
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" id="" class="form-control" value="{{$type_product->name}}">
        <label for="">Description</label>
        <input type="text" name="description" id="" class="form-control" value="{{ isset($type_product->description)?$type_product->description:'' }}">
        <input type="file" class="form-control-file" id="" name="image_file" placeholder="" onchange="changeImage(event)">
        <img id="image" src="" class="img-thumnail" style="width:10rem" alt=""><br>
            <script type="text/javascript">
                const  changeImage=(e)=>{
                    const img=document.getElementById('image');
                    const file=e.target.files[0]
                    img.src=URL.createObjectURL(file);
                }
            </script>
            </div>
        <input name="btnSave" id="" class="btn btn-primary" type="submit" value="Edit">
    </div>
    </div>
    </form>
@endsection
