<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $products=Product::orderByDesc('id')->paginate(10);
          return view('admin.product_list', ['products' => $products]);
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
        $product=Product::find($id); //trước đó phải khai báo namespace tới model Product
        return view('banhang.product',compact('product'));
        // ['product'=>$product])
        $products=Product::find($id);
        return view('admin.product-detail',compact('products'));
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
        return view('admin.product_edit', [
            'product' => Product::firstWhere('id', $id)
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
                'unit_price'=>'required',
                'promotion_price'=>'required',
            ],[
                'image.mimes'=>'Chỉ chấp nhận file hình ảnh',
                'image.max'=>'Chỉ chấp nhận hình ảnh dưới 2Mb',
                'name.required'=>'Bạn chưa nhập mô tả',
                'description.required'=>'Bạn chưa nhập mô tả',
                'unit_price.required'=>'Bạn chưa nhập giá',
                'promotion_price.required'=>'Bạn chưa nhập giá khuyến mãi',
            ]);
            $file = $request->file('image');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('source/image/product'); //project\public\car, public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/car
        }
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'unit_price'=>'required',
            'promotion_price'=>'required',
            'unit'=>'required',
            'new'=>'required',

        ],[
            'name.required'=>'Bạn chưa nhập mô tả',
            'description.required'=>'Bạn chưa nhập mô tả',
            'unit_price.required'=>'Bạn chưa nhập giá',
            'promotion_price.required'=>'Bạn chưa nhập giá khuyến mãi',
            'unit.required'=>'Bạn chưa nhập unit',
            'new.required'=>'Bạn chưa nhập new',

        ]);
        $product=Product::find($id);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->unit_price=$request->unit_price;
        $product->promotion_price=$request->promotion_price;
        if($name==''){
            $name=$product->image;
        }
        $product->image=$name;
        $product->save();

        return redirect()->route('products.index')->with('success','Bạn đã cập nhật thành công');

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
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('products.index')->with('success','Bạn đã xóa thành công');
    }
}
