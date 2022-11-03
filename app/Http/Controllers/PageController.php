<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\User;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class PageController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function getIndex()
    // {
    //     $slide=Slide::all();
    //     $new_products = Product::where('new','=',1)->paginate(8,['*'],'page1')->withQueryString();
    //     $sale_products=Product::where('promotion_price','>',0)->paginate(8,['*'],'page2')->withQueryString();
    //     return view('banhang.home',compact('slide','new_products','sale_products'));
    // }
    // public function getLoaiSp($type){
    //     $type_products = Product::where('id_type',$type)->paginate(6,['*'],'page1')->withQueryString();
    //     $other_products = Product::where('id_type','<>',$type)->paginate(6,['*'],'page2')->withQueryString();
    //     $types= ProductType::all();
    //     // $type=ProductType::where('id',$type)->first();
    //     return view('banhang.product_type',compact('type_products','other_products','types'));
    // }
    // public function getChiTietSp($req){
    //     $product=Product::where('id',$req)->first();
    //     $product_tt=Product::where('id_type',$product->id_type)->paginate(6,['*'],'page1')->withQueryString();
    //     return view('banhang.product',compact('product','product_tt'));
    // }
    // public function getLienHe(){
    //     return view('banhang.contact');
    // }
    // public function getGioiThieu(){
    //     return view('banhang.about');
    // }


    public function index()
    {
    // Đổ slide ra trang chủ
        $slide=Slide::all();
    //Đổ dữ liệu sản phẩm ra trang chủ
        $new_products = Product::where('new','=',1)->paginate(8,['*'],'page1')->withQueryString();
        $sale_products=Product::where('promotion_price','>',0)->paginate(8,['*'],'page2')->withQueryString();
        return view('banhang.home',compact('slide','new_products','sale_products'));
    }
    public function producttype( $type){
        $type_products = Product::where('id_type',$type)->paginate(6,['*'],'page1')->withQueryString();
        $other_products = Product::where('id_type','<>',$type)->paginate(6,['*'],'page2')->withQueryString();
        $types= ProductType::all();
        $type=ProductType::where('id',$type)->first();
        return view('banhang.product_type',compact('type_products','other_products','types','type'));
    }

    public function productdetail( $req){
        $product=Product::where('id',$req)->first();
        $product_tt=Product::where('id_type',$product->id_type)->paginate(6,['*'],'page1')->withQueryString();
        return view('banhang.product',compact('product','product_tt'));
    }
    public function Contact(){
        return view('banhang.contact');
    }
    public function About(){
        return view('banhang.about');
    }
    public function getAddToCart(Request $req,$id){
        $product=Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->add($product,$id);
        $req->Session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getDelCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart= new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        return redirect()->back();

    }
    public function getSignup(){
        return view('banhang.signup');
    }
    public function postSignup(Request $req){
        $this->validate($req,
    	['email'=>'required|email|unique:users,email',
    		'password'=>'required|min:6|max:20',
    		'fullname'=>'required',
    		'repassword'=>'required|same:password'
    	],
    	['email.required'=>'Vui lòng nhập email',
    	'email.email'=>'Không đúng định dạng email',
    	'email.unique'=>'Email đã có người sử  dụng',
    	'password.required'=>'Vui lòng nhập mật khẩu',
    	'repassword.same'=>'Mật khẩu không giống nhau',
    	'password.min'=>'Mật khẩu ít nhất 6 ký tự'
		]);

		$user=new User();
		$user->full_name=$req->fullname;
		$user->email=$req->email;
		$user->password=Hash::make($req->password);
		$user->phone=$req->phone;
		$user->address=$req->address;
        $user->level=3;  //level=1: admin; level=2:kỹ thuật; level=3: khách hàng
		$user->save();
		return redirect()->back()->with('success','Tạo tài khoản thành công');
    }
    public function getLogin(){
        return view('banhang.login');
    }

    public function postLogin(Request $req){
        $this->validate($req,
        [
            'email'=>'required|email',
            'password'=>'required|min:6|max:20'
        ],
        [
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Không đúng định dạng email',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu ít nhất 6 ký tự',
            'password.max'=>'Mật khẩu tối đa 20 ký tự'
        ]
        );
        $credentials=['email'=>$req->email,'password'=>$req->password];
        if(Auth::attempt($credentials)){//The attempt method will return true if authentication was successful. Otherwise, false will be returned.
            return redirect('/home')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }

    public function getLogout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('trangchu');
    }
   public function getCheckout(){
       if(Session::has('cart')){
           $oldCart = session('cart');
        //    dd($oldCart->items);
           $cart= new Cart($oldCart);
            return view('banhang.checkout',['product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
        }
        else {
            return view('banhang.checkout');
        }
   }

   public function postCheckout(Request $req){
    $cart=Session::get('cart');
    // dd($cart);
    $customer = new Customer();
    $customer->name=$req->name;
    $customer->gender=$req->gender;
    $customer->email=$req->email;
    $customer->address=$req->address;
    $customer->phone_number=$req->phone;
    $customer->note=$req->note;
    $customer->save();

    $bill=new Bill;
    $bill->id_customer=$customer->id;
    $bill->date_order=date('Y-m-d');
    $bill->total=$cart->totalPrice;
    $bill->payment=$req->payment;
    $bill->note=$req->note;
    $bill->trangthai = "Đang chuẩn bị";
    $bill->save();

    foreach($cart->items as $key => $value){
    $bill_detail= new BillDetail;
    $bill_detail->id_bill=$bill->id;
    $bill_detail->id_product=$key;
    $bill_detail->quantity=$value['qty'];
    $bill_detail->unit_price=($value['price']/$value['qty']);
    $bill_detail->save();
    }
Session::forget('cart');
return  redirect()->back()->with('thongbao','Đặt hàng thành công ');

   }
   public function Search(Request $req){
    $product=Product::where('name','like','%'.$req->key.'%')
    ->orWhere('unit_price',$req->key)
    ->get();
    return view('banhang.search',compact('product'));
   }
}
