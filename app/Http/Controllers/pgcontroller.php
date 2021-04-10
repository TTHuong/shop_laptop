<?php

namespace App\Http\Controllers;
use App\Models\Slide;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\User;
use App\Models\Post;
use App\Models\Visitors;
use App\Models\Coupon;

use Session;
use Hash;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;
use App;


use Illuminate\Http\Request;

class pgcontroller extends Controller
{
    public function getIndex(Request $req){

        // $checkout_code = substr(md5(microtime()),rand(0,26),5);
        // $cart = Session::get('cart');

        // foreach ($cart->items as $key => $value) {
           
        //     dd($value['item']['id_post']);
        // }
        // dd(Auth::user()->id);
        $nowSale_hours = date('H:m:s');
        $nowSale = date('Y/m/d');
        $all_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->get();
        
        $new_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->get();
        $top_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',0)->get();

    	$slide = Slide::where('status_slide',0)->inRandomOrder()->get();

        $sanpham_khuyenmai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('promotion_price','<>',0)->where('date_sale','>=' ,$nowSale)->get();

        $user_ip_address = $req->ip();
        //online hien tai
        $visitor_current = Visitors::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_current->count();

        if ($visitor_count<1) {
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitor->save();
        }

        // $url_canonical = $req->url();
        foreach ($new_product as $key => $value) {
            # code...
            $meta_desc = $value->description;
            $url_canonical = $req->url();
            $image_og = url('public/source/image/product/'.$value->image);
        }


    	return view('FrontEnd.TrangChu',compact('slide','new_product', 'sanpham_khuyenmai', 'url_canonical', 'image_og', 'top_product', 'all_product', 'nowSale_hours'


        ));
    }


    public function getLoaiSP(Request $req, $typesanpham){

        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();


        
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy('id','DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='tang_dan') {
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy('id','ASC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_za') {
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy($multisp,'DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_az') {
                $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->orderBy($multisp,'ASC')->paginate(6)->appends(request()->query());

            }

        }elseif (isset($_GET['start_price']) && $_GET['end_price'] ) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->whereBetween('unit_price',[$min_price,$max_price])->orderBy('unit_price','ASC')->paginate(6);
            
        }else{
            $sanpham_theoloai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$typesanpham)->paginate(6);
        }

        if (count($sanpham_theoloai) >0) {
            $sanpham_new= Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->paginate(3);
            $loai = ProductType::all();
            $loaisanpham = ProductType::where('id',$typesanpham)->first();
            foreach ($sanpham_theoloai as $key => $value) {
                # code...
                $meta_desc = '$value->description';
                $url_canonical = $req->url();
                $image_og = url('source/image/product/'.$value->image);
            }
            return view('FrontEnd.TypeProduct',compact('sanpham_theoloai', 'sanpham_new', 'loai', 'loaisanpham', 'meta_desc', 'url_canonical', 'image_og'));
        }
        else{
            return redirect()->back();
        }
    	
    }
    public function getAllproduct(Request $req){
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();

        $sanpham_new = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->paginate(3);
        
        if(isset($_GET['sort_by'])){
            $sort_by = $_GET['sort_by'];

            if($sort_by=='giam_dan'){
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->orderBy('id','DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='tang_dan') {
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->orderBy('id','ASC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_za') {
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->orderBy($multisp,'DESC')->paginate(6)->appends(request()->query());

            }elseif ($sort_by=='kytu_az') {
                $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->orderBy($multisp,'ASC')->paginate(6)->appends(request()->query());

            }

        }elseif (isset($_GET['start_price']) && $_GET['end_price'] ) {
            $min_price = $_GET['start_price'];
            $max_price = $_GET['end_price'];

            $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->whereBetween('unit_price',[$min_price,$max_price])->orderBy('unit_price','ASC')->paginate(6)->appends(request()->query());
            
        }else{
            $tacca_sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->paginate(6);
        }
        foreach ($tacca_sanpham as $key => $all) {
                $meta_desc = '$all->description';
                $url_canonical = $req->url();
                $image_og = url('source/image/product/'.$all->image);
            }
        return view('FrontEnd.AllProduct', compact('tacca_sanpham','meta_desc','url_canonical','image_og','sanpham_new'));
    }

    public function getChitiet(Request $req){


        $sanpham = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id',$req->id)->first();

        $tuongtu = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id_type',$sanpham->id_type)->get();

        $new_product = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->paginate(4);

        $sanpham_khuyenmai = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('promotion_price','<>',0)->paginate(4);
        

        $sanpham_id = Product::where('id',$req->id)->get();


        foreach ($sanpham_id as $key => $value) {
            # code...
            $meta_desc = $value->description;
            $url_canonical = $req->url();
            $image_og = url('source/image/product/'.$value->image);
        }
        
    	return view('FrontEnd.DetailProduct',compact('sanpham', 'tuongtu', 'new_product', 'sanpham_khuyenmai','url_canonical', 'meta_desc', 'image_og'));
    }

    public function getLienHe(Request $req){
        if(Session::has('locale')){
            app()->setLocale(Session::get('locale'));
        }
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();
        $url_canonical = $req->url();

        $image_og = $req->url();


    	return view('FrontEnd.Contact',compact('posts', 'multisp','url_canonical', 'image_og'));
    }
    public function postLienHe(Request $req){
        $this->validate($req,
            [
                'name'=>'required',
                'email'=>'required|email'

            ],
            [
                'name.required'=>'Vui lòng nhập tên',
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',

            ]);

 
        //send mail lien he
        $to_email =  "npn020899@gmail.com";

        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $tile_mail = "Liên Hệ từ ShopPv".' '.$now;
        $data['email'] = $req->email;

        $name_mail = $req->name;
        $email_mail = $req->email;
        $content_mail = $req->content;


        Mail::send('email.contact',
            [
                'name_mail' => $name_mail,
                'email_mail' => $email_mail,
                'content_mail' => $content_mail,
            ],
            function($message) use ($tile_mail, $name_mail, $data, $content_mail, $email_mail, $to_email){
                    $message->to($to_email)->subject($tile_mail);
                    $message->from($data['email'],$tile_mail);
                });

        return redirect()->back()->with('thongbao','Gửi email thành công, Shop sẽ phản hồi trong thời gian sớm nhất có thể');


    }

    public function getGioiThieu(Request $req){

        $url_canonical = $req->url();
        $image_og = $req->url();

    	return view('FrontEnd.About',compact('url_canonical', 'image_og'));
    }

    public function getAddToCart(Request $req,$id){
    	// $product = Product::find($id);
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();

        $product = Product::join('post', 'products.id_post', '=', 'post.id_post')->find($id);


    	$oldCart = Session('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->add($product,$id);
    	$req->Session()->put('cart',$cart);
    	return redirect()->back();
    }

    public function getDelCart($id){
    	$oldCart = Session('cart')?Session::get('cart'):null;
    	$cart = new Cart($oldCart);
    	$cart->removeItem($id);
    	if(count($cart->items)>0){
    		Session::put('cart',$cart);
    	}
    	else{
            Session::forget('cart');
    		Session::forget('coupon');
    	}
    	return redirect()->back();
    }
    public function getUpCart_qty(Request $req,$id){
        $product = Product::join('post', 'products.id_post', '=', 'post.id_post')->find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);

        foreach ($cart->items as $key => $cart_up) {
            $cart_up['qty'] = $req->product_qty;
            // dd($req->product_qty);
            $cart->add($product,$id);
            $req->Session()->put('cart',$cart);

            return redirect()->back();

        }

                
        return redirect()->back();
    }

    public function getDatHang(Request $req){

        if(Auth::check()){
            $url_canonical = $req->url();
            $image_og = $req->url();
            $user_dh=  User::find(Auth::user()->id );

            return view('FrontEnd.OrderCart',compact('url_canonical', 'image_og', 'user_dh'));
        }
        else{
            return redirect()->route('trang-chu');
        }

    }
    
    public function postDatHang(Request $req){
    	$cart = Session::get('cart');
        

        $this->validate($req,[
            'name23131' => 'required',
            'email' => 'required|email',
            'address11223' => 'required',
            'phone' => 'required|min:11|numeric',
        ],
        [
            'name.required'=>'Vui lòng nhập tên',
            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',

            'address11223.required'=>'Vui lòng nhập địa chỉ',
            'phone.required'=>'Vui lòng nhập số diện thoại',

            'phone.min'=>'Số diện thoại không đúng',
            'phone.numeric'=>'Vui lòng nhập số diện thoại'

        ]);
    	$customer = new Customer();
    	$customer->name = $req->name23131;
    	$customer->gender = $req->gender;
    	$customer->email = $req->email;
    	$customer->address = $req->address11223;
    	$customer->phone_number = $req->phone;
    	$customer->note = $req->notes;
    	// $customer->save();

        $checkout_code = substr(md5(microtime()),rand(0,26),5);
    	$bill = new Bill();
    	$bill->id_customer = $customer->id;
    	$bill->date_order = date('Y-m-d');
        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $key => $coun){
                if($coun['coupon_condition']==0){
                    $total_coupon = ($cart->totalPrice*$coun['coupon_number'])/100;
                    $total_pre = $cart->totalPrice-$total_coupon;
                    $totalPrice = $total_pre;
                }else{
                    $total_coupon = $cart->totalPrice-$coun['coupon_number'];
                    $totalPrice = $total_coupon;
                }
            }
            $bill->total = $totalPrice;    
        }else{
            $bill->total = $cart->totalPrice;
        }
    	$bill->payment = $req->payment_method;
        $bill->status_bill = $req=0;
    	$bill->order_code = $checkout_code;
    	// $bill->save();

    	foreach ($cart->items as $key => $value) {
            $bill_detail = new BillDetail();
            $bill_detail->id_bill = $bill->id_bill;
            $bill_detail->id_product = $key;
            $bill_detail->id_post_bill_detail = $value['item']['id_post'];
            $bill_detail->order_code = $checkout_code;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = ($value['price'] / $value['qty']);
            // $bill_detail->save();
        }
        if (Session::get('coupon')) {
            foreach(Session::get('coupon') as $key => $coun){
                $coupon_qty = Coupon::where('coupon_code',$coun['coupon_code'])->first();
                $coupon_qty->coupon_used = ','.Auth::user()->id;
                $coupon_qty->coupon_time--;
                // $coupon_qty->save(); 
            }
        }

        //send mail xac nhan dat hang
        $now = Carbon::now('Asia/Ho_Chi_Minh');
        $to_email =  "npn020899@gmail.com";
        $title_mail = 'Xác Nhận Đơn Hàng'. ' ' .$now;
        $data['email'][] = $customer->email;

        if(Session::has('locale')){
            app()->setLocale(Session::get('locale'));
        }
        $posts = Post::get();
        $multisp = 'sp_' . app()->getLocale();


        $shipping_array = array('name' =>$customer->name,
                                'address' =>$customer->address,
                                'phone_number' =>$customer->phone_number
                                 );


        Mail::send('email.mail_oder', 
            [
                'items' => $cart->items,
                'multisp' => $multisp,
                'shipping_array' => $shipping_array
            ],
            function($message) use ($title_mail, $data, $to_email){
                    $message->to($data['email'])->subject($title_mail);
                    $message->from($to_email, $title_mail);
        });
        Session::forget('cart');
        Session::forget('coupon');
        
        return redirect()->back()->with('thongbao','Đặt hàng thành công');


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
    	if(Auth::attempt($credentials) && Auth::user()->level == 2 ){
			return redirect()->back();
    	}
    	else
    	{
    		return redirect()->route('trang-chu-admin');

    	}
    	
    }

    public function getTimKiem(Request $req){



    	$product = Product::join('post', 'products.id_post', '=', 'post.id_post')
        // ->join('type_products', 'type_products.id', '=', 'products.id_type')
        ->where('unit_price','like','%'.$req->search.'%')
    								// ->orWhere('name_type',$req->key)
                                    ->orWhere('sp_vi',$req->search)
                                    ->orWhere('sp_en',$req->search)
    								->get();
        $url_canonical = $req->url();
        $image_og = $req->url();

        $sanpham_new= Product::join('post', 'products.id_post', '=', 'post.id_post')->where('new',1)->inRandomOrder()->paginate(3);

		return view('FrontEnd.Search',compact('product', 'url_canonical', 'image_og', 'sanpham_new'));

    }


    public function getshoppingcart(Request $req){
        if(Auth::check()){
            $url_canonical = $req->url();
            $image_og = $req->url();

            return view('FrontEnd.CartDetail',compact('url_canonical','image_og'));
        }
        return redirect()->route('trang-chu');  

    }

    public function check_coupon(Request $req){
        $data = $req->all();
        $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');

        $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',0)->where('coupon_date_end', '>=', $today)->where('coupon_used', 'LIKE', '%'.Auth::user()->id.'%')->first();
        if ($used_coupon) {
            return redirect()->back()->with('message_err', 'Mã giảm giá đã sử dụng, vui lòng nhập mã khác');
        }else{

            $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',0)->where('coupon_date_end', '>=', $today)->first();
            if ($coupon) {
                $coupon_count = $coupon->count();
                if ($coupon_count>0) {
                    $coupon_session = Session::get('coupon');
                    if ($coupon_session==true) {
                        $is_avaiable = 0;
                        if ($is_avaiable==0) {
                            $coun[] = array(
                                'coupon_code' => $coupon->coupon_code, 
                                'coupon_condition' => $coupon->coupon_condition, 
                                'coupon_number' => $coupon->coupon_number, 
                            );
                            Session::put('coupon',$coun);
                        }
                    }else{
                        $coun[] = array(
                                'coupon_code' => $coupon->coupon_code, 
                                'coupon_condition' => $coupon->coupon_condition, 
                                'coupon_number' => $coupon->coupon_number, 
                            );
                        Session::put('coupon',$coun);
                    }
                    Session::save();

                    return redirect()->back()->with('message', 'Thêm Mã Giảm Giá Thành Công');

                }
            }else{
                return redirect()->back()->with('message_err', 'Mã giảm giá không đúng hoặc đã hết hạn');
            }
        }
    }


}
