<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Customer;

use App\Models\User;
use Session;
use Hash;
use Auth;
use DB;
use Validator;
use flash;

class TaiKhoan_Controller extends Controller
{
    public function getDangNhap(Request $req){
        $meta_desc = '';
        $url_canonical = $req->url();
        $image_og = '';

        return view('FrontEnd.SignIn', compact('meta_desc','url_canonical','image_og'));
    }
    public function postDangNhap(Request $req){

        $this->validate($req,
    		[
    			'email'=>'required|email',
    			'password'=>'required|min:6|max:20'

    		],
    		[
    			'email.required'=>'Vui lòng nhập email',
    			'email.email'=>'Email không đúng định dạng',

    			'password.required'=>'Vui lòng nhập mật khẩu',
    			'password.min'=>'Mật khẩu ít nhất 6 ký tự',
    			'password.max'=>'Mật khẩu không quá 20 ký tự'
    		]);
    	
    	$credentials = array('email'=>$req->email, 'password'=>$req->password);
    	if(Auth::attempt($credentials) && Auth::user()->level == 1 ){

            return redirect()->route('trang-chu-admin');

    	}
    	else
    	{
            return redirect()->route('trang-chu')->with('status', 'Tạo bài viết thành công!');

    	}
    	
    }
    public function getDangKy(Request $req){
        $meta_desc = '';
        $url_canonical = $req->url();
        $image_og = '';
        return view('FrontEnd.SignOut', compact('meta_desc','url_canonical','image_og'));
    }
    public function postDangKy(Request $req){
    	$this->validate($req,
    		[
    			'email'=>'required|email|unique:users,email',
    			'password'=>'required|min:6|max:20',
    			'fullname'=>'required',
    			're_password'=>'required|same:password'

    		],
    		[
    			'email.required'=>'Vui lòng nhập email',
    			'email.email'=>'Email không đúng định dạng',
    			'email.unique'=>'Email đã được sử dụng',

    			'password.required'=>'Vui lòng nhập mật khẩu',
    			'password.min'=>'Mật khẩu ít nhất 6 ký tự',
    			'password.max'=>'Mật khẩu không quá 20 ký tự',

    			're_password.required'=>'Vui lòng nhập lại mật khẩu',
    			're_password.same'=>'Mật khẩu không giống nhau'

    		]);
    	$user = new User();
    	$user->full_name = $req->fullname;
    	$user->email = $req->email;
    	$user->password = Hash::make($req->password);
		$user->phone = $req->phone;
		$user->address = $req->adress;
		$user->level = $req= 2;
		$user->save();
		return redirect()->route('dangnhap');  
    }

    public function postDangXuat(){
    	Auth::logout();
        Session::forget('cart');
        Session::forget('coupon');
    	return redirect()->route('trang-chu');
    }


    public function userUpdate1(Request $req)
    {
        if (Auth::check()) {
            $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'

            ],
            [
                'name.required'=>'Vui lòng nhập fullname',

                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',

                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 ký tự',
                'password.max'=>'Mật khẩu không quá 20 ký tự',

                're_password.required'=>'Vui lòng nhập lại mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau'

            ]);
            $userUpdate =  User::find(Auth::user()->id );
        
            $userUpdate->full_name = $req->name;
            $userUpdate->address = $req->adress;
            $userUpdate->email = $req->email;
            $userUpdate->phone = $req->phone;
            // if ($req->password != null) {
            //     $userUpdate->password = Hash::make($req->password);
            // }
            $userUpdate->password = Hash::make($req->password);

            $userUpdate->save();
            return redirect()->back()->with('thongbaoupdate', 'Update Successful');  
        }
        else{
            return redirect()->back();

        }
    }
}
