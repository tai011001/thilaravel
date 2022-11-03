<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;
use App\Models\Product;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide=Slide::all();
        $new_product = Product::where('new',1)->paginate(4,['*'],'page1')->withQueryString();
        $product=DB::table('products')->get();
        $product_promotion = Product::where('promotion_price','<>',0)->paginate(8,['*'],'page2')->withQueryString();
        return view('banhang.home',compact('product','slide','new_product','product_promotion'));
    // $index=Index::where('votes', '>', 100)->paginate(
    //     $perPage = 15, $columns = ['10'], $pageName = 'products'

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
    public function getLoginadmin(){
        return view('admin.loginadmin');
    }

    public function postLoginadmin(Request $req){
        // dd('test');
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
            return redirect('/admin1')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    public function getLogoutadmin(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.admin1');   
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
        // $home=Home::find($id);
        // return view('banhang.home',compact('home'));
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
    }
}
