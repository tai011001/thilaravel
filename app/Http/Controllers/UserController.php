<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users=User::orderByDesc('id')->paginate(10);
        return view('admin.user-list', ['users' => $users]);

    }
    public function getSignupadmin(){
        return view('admin.register');
    }
    public function postSignupadmin(Request $req){
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
    public function getLoginadmin(){
        return view('admin.loginadmin');
    }

    public function postLoginadmin(Request $req){
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
            return redirect('/administrator')->with(['flag'=>'alert','message'=>'Đăng nhập thành công']);
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }
    }
    public function getLogoutadmin(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.loginadmin');
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
        $user=User::find($id);
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
        return view('admin.user-edit', [
            'user' => User::firstWhere('id', $id)
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
        $this->validate($request,[
            'full_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'level'=>'required'

        ],[
            'full_name.required'=>'Bạn chưa nhập tên',
            'email.required'=>'Bạn chưa nhập email',
            'phone.required'=>'Bạn chưa nhập số điện thoại',
            'address.required' => 'Bạn chưa nhập  địa chỉ',
            'level.required' => 'Bạn chưa nhập  level'
        ]);
        $user=User::find($id);
        $user->full_name=$request->full_name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->address=$request->address;
        $user->level=$request->level;
        $user->save();

        return redirect()->route('users.index')->with('success','Bạn đã cập nhật thành công');
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
        $user=User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success','Bạn đã xóa thành công');
    }
}
