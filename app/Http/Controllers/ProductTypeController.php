<?php

namespace App\Http\Controllers;

use App\Models\ProductType;
use Illuminate\Http\Request;


class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
          //
          $type_products=ProductType::orderByDesc('id')->paginate(10);
          return view('admin.type_products', ['type_products' => $type_products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,
        [
            //Kiểm tra giá trị rỗng
            'name' => 'required',
            'description' => 'required',
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ],
        [
            //Tùy chỉnh hiển thị thông báo
            'name.required' => 'Bạn chưa nhập ten!',
            'description.required' => 'Bạn chưa nhập mô tả!',
            'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
            'image_file.max' => 'Hình thẻ giới hạn dung lượng không quá 10MB',
        ]
    );
     //kiểm tra file tồn tại
     $name='';
     if($request->hasfile('image_file'))
     {
         $file = $request->file('image_file');
         $name=time().'_'.$file->getClientOriginalName();
         $destinationPath=public_path('source/image/product'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
         $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/cars
     }
    $type_product=new ProductType();
    $type_product->name=$request->input('name');
     $type_product->description=$request->input('description');
     $type_product->image=$name;
     $type_product->save();
    return redirect('type_products')->with('success','Bạn đã thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $type_products=ProductType::find($id);
        return view('admin.user-detail',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return view('admin.type_products-edit', [
            'type_product' => ProductType::firstWhere('id', $id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $name='';
        if($request->hasfile('image')){
            $this->validate($request,[

                'name'=>'required',
                'description'=>'required',
            ],[
                'image.mimes'=>'Chỉ chấp nhận file hình ảnh',
                'image.max'=>'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'name.required'=>'Bạn chưa nhập mô tả',
                'description.required'=>'Bạn chưa nhập mô tả',
            ]);
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('source/image/product'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        }
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>'Bạn chưa nhập mô tả',
            'description.required'=>'Bạn chưa nhập mô tả',
        ]);
        $type_product=ProductType::find($id);
        $type_product->name=$request->name;
        $type_product->description=$request->description;
        if($name==''){
            $name=$type_product->image;
        }
        $type_product->image=$name;
        $type_product->save();

        return redirect()->route('type_products.index')->with('success','Bạn đã cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $type_product=ProductType::find($id);
        $type_product->delete();
        return redirect()->route('type_products.index')->with('success','Bạn đã xóa thành công');
    }
}
