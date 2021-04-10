<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\Slide;
use App\Models\Bill;
use App\Models\BillDetail;
use App\Models\Customer;
use App\Models\Post;
use App\Models\Statistical;
use App\Models\Coupon;

use App\Models\Visitors;
use Auth;
use DB;
use Session;
use Hash;
use File;
use PDF;
use Carbon\Carbon;
use DNS1D;
use DNS2D;
use Mail;


class admincontroller extends Controller
{

    public function getIndexAdminDash(Request $req){
    	if (Auth::check() && Auth::user()->level == 1) {
            
            $user_ip_address = $req->ip();
            $url_canonical = $req->url();
            // $user_ip_address = '192.168.1.42';

            $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
            $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
            $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
            $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
            $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

            //tong thang truoc
            $tong_thangtruoc = Visitors::whereBetween('date_visitor', [$dau_thangtruoc,$cuoi_thangtruoc])->get();
            $tong_thangtruoc_count = $tong_thangtruoc->count();

            //tong thang nay
            $tong_thangnay = Visitors::whereBetween('date_visitor', [$dauthangnay,$now])->get();
            $tong_thangnay_count = $tong_thangnay->count();

            //tong 1 nam
            $tong_motnam = Visitors::whereBetween('date_visitor', [$sub365ngay,$now])->get();
            $tong_motnam_count = $tong_motnam->count();

            //tat ca
            $tatca_count = Visitors::all()->count();

            //online hien tai
            $visitor_current = Visitors::where('ip_address', $user_ip_address)->get();
            $visitor_count = $visitor_current->count();

            if ($visitor_count<1) {
                $visitor = new Visitors();
                $visitor->ip_address = $user_ip_address;
                $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                $visitor->save();
            }

    		return view('admin.Dashboard', compact('tatca_count',  'visitor_count', 'tong_thangtruoc_count', 'tong_thangnay_count', 'tong_motnam_count', 'url_canonical'));
    	}
    	else
    		return redirect()->route('trang-chu');
    }

  

/*-----------------------------------------------User--------------------------------------------------------------------*/
    public function getQL_NguoiDung(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $user = User::all();
            $url_canonical = $req->url();

            return view('admin.QL_nguoidung', compact('user','url_canonical' ));
        }
        else{
            return redirect()->route('trang-chu');
        }
        
    }

    public function getQL_NguoiDung_user(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            
            $taikhoan_user = User::where('level',2)->get();
            $url_canonical = $req->url();

            return view('admin.QL_nguoidung_user', compact('taikhoan_user','url_canonical'));
        }
        else{
            return redirect()->route('trang-chu');
        }
        
    }
    public function getQL_NguoiDung_ad(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            
            $taikhoan_ad = User::where('level',1)->get();
            $url_canonical = $req->url();

            return view('admin.QL_nguoidung_ad', compact('taikhoan_ad', 'url_canonical'));
        }
        else{
            return redirect()->route('trang-chu');
        }
        
    }

    public function DelAdmin($id)
    {
        $user = User::where('id', $id)->delete();

        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    public function AddAdmin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'name'=>'required',
                're_password'=>'required|same:password'

            ],
            [
                'name.required'=>'Vui lòng nhập full name',

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
        $user->full_name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->phone = $req->phone;
        $user->address = $req->adress;
        $user->level = $req->level;
        $user->save();
        return redirect()->back()->with('thongbaoadd', 'Add New Successful'); 
    }


    // public function getUpdateAdmin($id){
    //     if (Auth::check() && Auth::user()->level == 1) {
    //         $user_up=User::where('id',$id)->first();
            

    //         return view('admin.Update_user',compact('user_up'));
    //     }else{
    //         return redirect()->route('trang-chu');
    //     }
    // }
    
    public function postUpdateAdmin(Request $req,$id){

        $this->validate($req,
        [
            'email'=>'required|email',
            // 'password'=>'min:6|max:500',
            'name'=>'required',

        ],
        [
            'name.required'=>'Vui lòng nhập full name',

            'email.required'=>'Vui lòng nhập email',
            'email.email'=>'Email không đúng định dạng',

            
            // 'password.min'=>'Mật khẩu ít nhất 6 ký tự',
            // 'password.max'=>'Mật khẩu không quá 50 ký tự',

        ]);
        $user_up=User::where('id',$id)->first();
        $user_up->full_name = $req->name;
        $user_up->email = $req->email;
        if ($req->password) {
            $user_up->password = Hash::make($req->password);
        }else{
            $user_up->password =$user_up->password;
        }
        $user_up->phone = $req->phone;
        $user_up->address = $req->adress;
        $user_up->level = $req->level;

        $user_up->save();
        return redirect()->back()->with('thongbaoupdate', 'Update Successful');
    }

    public function active_user($id){
        User::where('id',$id)->update(['level'=>2]);
        return redirect()->back();
    }
    public function unactive_user($id){
        User::where('id',$id)->update(['level'=>1]);
        return redirect()->back();
    }

/*-----------------------------------------------Slide-------------------------------------------------------------------*/
    public function getQL_Slide(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $slide = Slide::all();
            // $slide = Slide::where('status_slide',0)->get();
            $url_canonical = $req->url();
        


            return view('admin.QL_slide', compact('slide', 'url_canonical'));
        }else{
            return redirect()->route('trang-chu');
            
        }
    }

    public function DelAdmin_Slide($id)
    {
        $slide = Slide::where('id', $id)->first();

        $image_path = "public/source/image/slide/" . $slide->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $slide = Slide::where('id', $id)->first()->delete();


        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    public function AddAdmin_Slide(Request $req){
        $slide = new Slide();
        $this->validate($req,
        [
            // 'link_slide'=>'required',
            'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

        ],
        [
            // 'link_slide.required'=>'Vui lòng nhập link',

            'image_file.required'=>'Vui lòng chọn hình',
            'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
            'image_file.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

        ]);

        $slide->link = $req->link_slide;
        $slide->status_slide = $req->status_slide;

        if ($req->hasFile('image_file')) {
            $file = $req->file('image_file');
            $get_name_img = $file->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));  
            $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
            $filename =time() .'.'. $new_img;
            $file->move('public/source/image/slide/', $filename);
            $slide->image = $filename;
        }else{
            return $req;
            $slide->image = '';
        }
        $slide->status_slide = $req=0;
        

        $slide->save();
        return redirect()->back()->with('thongbaoadd', 'Add New Successful');
    }

    // public function getUpdateSlide($id){
    //     if (Auth::check() && Auth::user()->level == 1) {
    //         $slide_update = Slide::where('id',$id)->first();
            


    //         return view('admin.Update_slide',compact('slide_update'));
    //     }else{
    //         return redirect()->route('trang-chu');
    //     }
    // }
    public function postUpdateSlide(Request $req, $id){
        if (Auth::check() && Auth::user()->level == 1) {
            $slide_update = Slide::where('id',$id)->first();
            $slide_update->link = $req->link_slide;
            $slide_update->status_slide = $req->status_slide;

            if($req->hasFile('image')){
                $this->validate($req, 
                [
                    
                    'image' => 'mimes:jpg,jpeg,png,gif|max:4096',
                ],          
                [
                    
                    // 'image.required' => 'Vui lòng chọn hình',
                    'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'image.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',
                ]);

            }
            if ($req->hasFile('image')) {
                $getHA = Slide::select('image')->where('id',$req->id)->first();
                // if($getHA[0]->image != '' && file_exists(public_path('public/source/image/slide/'.$getHA[0]->image)))
                // {
                //     unlink(public_path('public/source/image/slide/'.$getHA[0]->image));
                // }

                $image_path = "public/source/image/slide/" . $getHA->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                if ($req->hasFile('image')) {
                    $file = $req->file('image');
                    $get_name_img = $file->getClientOriginalName();
                    $name_img = current(explode('.', $get_name_img));  
                    $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
                    $filename =time() .'.'. $new_img;
                    $file->move('public/source/image/slide/', $filename);
                    $slide_update->image = $filename;
                }else{
                    return $req;
                    $slide_update->image = '';
                }

                $slide_update->save();

            }
            $slide_update->save();

            return redirect()->route('quanlyslide')->with('thongbaoupdate', 'Update Successful');
        }else{
            return redirect()->route('trang-chu');
        }
        
    }

    public function active_slide($id){
        Slide::where('id',$id)->update(['status_slide'=>1]);
        return redirect()->back();
    }
    public function unactive_slide($id){
        Slide::where('id',$id)->update(['status_slide'=>0]);
        return redirect()->back();
    }

/*-----------------------------------------------NSX--------------------------------------------------------------------*/
    public function getQL_Nsx(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $nsx = ProductType::all();
            $url_canonical = $req->url();

            return view('admin.QL_Nsx', compact('nsx', 'url_canonical'));
        }else{
            return redirect()->route('trang-chu');
        }
    }

    public function DelAdmin_NSX($id, Request $req)
    {

        
        $image = ProductType::where('id', $id)->first();
        $sp1 = Product::where('id_type', $image->id)->delete();
       
        ProductType::where('id', $id)->first()->delete();
        return redirect()->back();
        

        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    public function AddAdmin_NSX(Request $req){
        $nsx = new ProductType();

        $this->validate($req,
        [
            'name'=>'required',

        ],
        [
            'name.required'=>'Vui lòng nhập tên',

        
        ]);

        $nsx->name_type  = $req->name;

        $nsx->save();
        return redirect()->route('quanlynsx')->with('thongbaoadd', 'Add New Successful'); 
    }

    // public function getUpdateNsx($id){
    //     if (Auth::check() && Auth::user()->level == 1) {
    //         $nsx_update = ProductType::where('id',$id)->first();
            

    //         return view('admin.Update_nsx', compact('nsx_update'));
    //     }else{
    //         return redirect()->route('trang-chu');
    //     }
    // }

    public function postUpdateNsx(Request $req, $id){
        $this->validate($req,
        [
            'name'=>'required',

        ],
        [
            'name.required'=>'Vui lòng nhập tên',

        ]);
        $nsx_update = ProductType::where('id',$id)->first();
        $nsx_update->name_type = $req->name;

        $nsx_update->save();

        return redirect()->route('quanlynsx')->with('thongbaoupdate', 'Update Successful'); 


    }


/*-----------------------------------------------Sản-Phẩm----------------------------------------------------------------*/
    public function getQL_Sanpham(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {


            $sanpham = Product::orderby('id', 'desc')->get();
            $type = ProductType::all();
            $url_canonical = $req->url();

            //$sanpham1 = Product::join('type_products', 'type_products.id', '=', 'products.id_type')->orderby('products.id', 'desc')->get();
            // $sanpham1 = DB::select("SELECT sp.id,sp.name,tp.name_type as loai,sp.description,sp.unit_price, sp.promotion_price,sp.image,sp.new,sp.id_post
            // FROM products as sp, type_products as tp
            // WHERE sp.id_type=tp.id");


            $sanpham1 = DB::select("SELECT sp.id,sp.sub_image, sp.product_soid ,sp.id_type, type_products.name_type as loai,sp.description,
                sp.product_quantity,sp.unit_price,sp.hours_sale,sp.date_sale, sp.promotion_price,sp.image,sp.new,sp.id_post, post.sp_vi as sp_vi,  post.sp_en as sp_en, post.product_slug 
                        FROM products as sp
                        INNER JOIN type_products ON sp.id_type = type_products.id
                        INNER JOIN post ON sp.id_post = post.id_post");

            // $sanpham1 = Product::join('post', 'products.id_post', '=', 'post.id_post')->
            // join('type_products', 'products.id_type', '=', 'type_products.id')->get();
            $nameproduct = Post::orderby('id_post', 'asc')->get();
            $type = ProductType::orderby('id', 'desc')->get();


            return view('admin.QL_sanpham', compact('sanpham','sanpham1', 'type', 'nameproduct','url_canonical'));

        }else{
            return redirect()->route('trang-chu');
        }
    }


    public function DelAdmin_Sp($id, Request $req)
    {

        $sp1 = Product::where('id', $id)->first();

        $image_path = "public/source/image/product/" . $sp1->image;
        if (File::exists($image_path)) {
            File::delete($image_path);
        }
        $sp1 = Product::where('id', $id)->first()->delete();

        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    public function AddAdmin_Sp(Request $req){
        $sp = new Product();
        $nn_add = new Post();


        $this->validate($req,
        [
            'hours_sale'=>'required|max:23|integer',
            'mins_sale'=>'required|max:60|integer',
            'secs_sale'=>'required|max:60|integer',
            'quantity'=>'required',
            'unit_price'=>'required',
            'promotion_price'=>'required',
            'image_file' => 'required|mimes:jpg,jpeg,png,gif|max:4096',

        ],
        [
            'hours_sale.required'=>'Vui lòng nhập giờ',
            'hours_sale.max'=>'Vui lòng nhập không quá 23',
            'mins_sale.required'=>'Vui lòng nhập phút',
            'mins_sale.max'=>'Vui lòng nhập không quá 60',
            'secs_sale.required'=>'Vui lòng nhập giây',
            'secs_sale.max'=>'Vui lòng nhập không quá 60',

            'hours_sale.integer'=>'Vui lòng nhập số',
            'mins_sale.integer'=>'Vui lòng nhập số',
            'secs_sale.integer'=>'Vui lòng nhập số',

            'quantity.required'=>'Vui lòng nhập tên',

            'unit_price.required'=>'Vui lòng nhập số tiền',

            'promotion_price.required'=>'Vui lòng nhập số tiền khuyến mãi',

            'image_file.required' => 'Vui lòng chọn hình',
            'image_file.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
            'image_file.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

        
        ]);


        // $sp->id_post = $req->name;
        $nn_add->sp_vi = $req->sp_vi;
        $nn_add->sp_en = $req->sp_en;
        $nn_add->product_slug = $req->slug;
        $nn_add->save();

        $sp->id_post = $nn_add->id_post;
        $sp->description = $req->description;
        $sp->product_quantity = $req->quantity;
        $sp->unit_price = $req->unit_price;
        $sp->promotion_price = $req->promotion_price;
        $sp->new = $req->new;
        $sp->product_soid = 0;
        $sp->id_type  = $req->type;
        $sp->date_sale  = $req->date_sale;
        $sp->hours_sale  = $req->hours_sale.':'.$req->mins_sale.':'.$req->secs_sale;

        if ($req->hasFile('image_file')) {

            $file = $req->file('image_file');
            $get_name_img = $file->getClientOriginalName();
            $name_img = current(explode('.', $get_name_img));  
            $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
            $filename =time() .'.'. $new_img;
            $file->move('public/source/image/product/', $filename);
            $sp->image = $filename;
        }else{
            return $req;
            $sp->image = '';
        }

        $sp->save();

        return redirect()->back()->with('thongbaoadd', 'Add New Successful');
    }

    // public function getUpdateSp($id){
    //     if (Auth::check() && Auth::user()->level == 1) {
    //         $sp_update = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id',$id)->first();
    //         $type = ProductType::orderby('id', 'desc')->get();
    //         $nn= Post::orderby('id_post', 'desc')->get();



    //         return view('admin.Update_sp', compact('type', 'sp_update', 'nn'));
    //     }else{
    //         return redirect()->route('trang-chu');
    //     }
    // }

    public function postUpdateSp(Request $req, $id){
        if (Auth::check()) {
            $sp_update = Product::join('post', 'products.id_post', '=', 'post.id_post')->where('id',$id)->first();
            $up_nn = Post::where('id_post',$sp_update->id_post)->first();
            // dd($up_nn);
            $this->validate($req,
            [
                'sp_vi'=>'required',
                'sp_en'=>'required',
                'unit_price'=>'required',
                'promotion_price'=>'required',
                'image' => 'mimes:jpg,jpeg,png,gif|max:4096',

            ],
            [
                'sp_vi.required'=>'Vui lòng nhập tên Vi',
                'sp_en.required'=>'Vui lòng nhập tên En',

                'unit_price.required'=>'Vui lòng nhập số tiền',

                'promotion_price.required'=>'Vui lòng nhập số tiền khuyến mãi',

                // 'image.required' => 'Vui lòng chọn hình',
                'image.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                'image.max' => 'Hình ảnh giới hạn dung lượng không quá 4M',

            
            ]);

            $up_nn->sp_vi = $req->sp_vi;
            $up_nn->sp_en = $req->sp_en;
            $up_nn->product_slug = $req->slug;
            $up_nn->save();

            // $sp_update->id_post = $req->name;
            $sp_update->description = $req->description;
            $sp_update->unit_price = $req->unit_price;
            $sp_update->promotion_price = $req->promotion_price;
            $sp_update->new = $req->new;
            $sp_update->product_quantity = $req->quantity;
            $sp_update->product_soid = $req->product_soid;
            $sp_update->id_type  = $req->type;
            $sp_update->date_sale  = $req->date_sale;
            $sp_update->hours_sale  = $req->hours_sale;

            if ($req->hasFile('image')) {
                $getHT = Product::select('image')->where('id',$req->id)->first();
                // if($getHT[0]->image != '' && file_exists(public_path('public/source/image/product/'.$getHT[0]->image)))
                // {
                //     unlink(public_path('public/source/image/product/'.$getHT[0]->image));
                // }
                $image_path = "public/source/image/product/" . $getHT->image;
                if (File::exists($image_path)) {
                    File::delete($image_path);
                }
                 if ($req->hasFile('image')) {

                    $file = $req->file('image');
                    $get_name_img = $file->getClientOriginalName();
                    $name_img = current(explode('.', $get_name_img));  
                    $new_img = $name_img.rand(0,99).'.'.$file->getClientOriginalExtension();
                    $filename =time() .'.'. $new_img;
                    $file->move('public/source/image/product/', $filename);
                    $sp_update->image = $filename;
                }else{
                    return $req;
                    $sp_update->image = '';
                }
                $sp_update->save();

            }

            $sp_update->save();
            return redirect()->route('quanlysanpham')->with('thongbaoupdate', 'Update Successful');
        }else {
            return redirect()->route('trang-chu');
        }
    }

    public function active_sp($id){
        Product::where('id',$id)->update(['new'=>0]);
        return redirect()->back();
    }
    public function unactive_sp($id){
        Product::where('id',$id)->update(['new'=>1]);
        return redirect()->back();
    }

/*-----------------------------------------------Đơn-Hàng----------------------------------------------------------------*/
    
    public function getDonHang(Request $req)
    {
        if (Auth::check()) {


            $donhang = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            // $donhang = DB::select("SELECT b.id as id_user,ct.name,
            //     ct.gender,ct.email,ct.address,ct.phone_number,ct.note,b.id as id_bill,
            //     b.date_order,b.total,b.payment
            //     FROM customer as ct,bills as b,products as p
            //     WHERE ct.id = b.id_customer");




            return view('admin.QL_donhang', compact('donhang','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function getDonHang_daduyet(Request $req)
    {
        if (Auth::check()) {
            
            $donhang_daduyet = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('status_bill',1)->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang_daduyet', compact('donhang_daduyet','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function getDonHang_chuaduyet(Request $req)
    {
        if (Auth::check()) {
            
            $donhang_chuaduyet = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('status_bill',0)->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang_chuaduyet', compact('donhang_chuaduyet', 'url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function getDonHang_huy(Request $req)
    {
        if (Auth::check()) {
            
            $donhang_huy = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('status_bill',2)->orderby('id_bill', 'desc')->get();
            $url_canonical = $req->url();
           

            return view('admin.QL_donhang_huy', compact('donhang_huy','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }


    public function DelAdmin_DonHang($id)
    {

        $bill = Bill::where('id_bill', $id)->first();

        Customer::where('id', $bill->id_customer)->first()->delete();

        $billdetail = BillDetail::where('id_bill', $bill->id_bill)->delete();

        
        Bill::where('id_bill',$id)->delete();

        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    public function getChiTietDonHang($id, Request $req)
    {
        if (Auth::check()) {

            // $billdetaill = BillDetail::join('bills', 'bills.id_bill', '=', 'bill_detail.id_bill')
            //     ->join('products', 'products.id', '=', 'bill_detail.id_product')->get();

            $billdetaill =DB::select("SELECT bt.id_bill_detail, bt.id_bill, bt.id_product, bt.id_post_bill_detail, bt.order_code, bt.quantity,
        bt.unit_price,p.sub_image,p.image,p.hours_sale,p.date_sale, p.product_quantity ,p.id_post, post.sp_vi as sp_vi,  post.sp_en as sp_en
        FROM bill_detail bt, products p
        INNER JOIN post ON p.id_post = post.id_post
         WHERE bt.id_product=p.id AND id_bill=$id ");
            $url_canonical = $req->url();
            // $billdetaill = BillDetail::join('products', 'bill_detail.id_product', '=', 'products.id')
            //                 ->join('bills', 'bill_detail.id_bill', '=', 'bills.id_bill ')
            //                 ->where('bill_detail.id_product','=', 'products.id' AND 'bill_detail.id_bill','=', '$id');
            $thongtin_kh = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('id_bill',$id)->get();




            return view('admin.ChitietDH', compact('billdetaill', 'thongtin_kh', 'url_canonical'));
        } else {
            return redirect()->route('trang-chu');
        }
    }
    public function postChiTietDonHang($id, Request $req){

        $qty_update = BillDetail::where('id_bill', $id)->where('order_code',$req->order_code)->first();
        // dd( $qty_update);
        $qty_update->quantity = $req->product_quantity_order;
        $qty_update->save();

        $total_update = Bill::where('id_bill', $id)->where('order_code',$req->order_code)->first();
        $total_update->total = $req->product_quantity_order * $qty_update->unit_price;
        $total_update->save();

        return redirect()->back();
    }


    public function update_order_qty(Request $req){
        $data = $req->all();

        $bill = Bill::find($data['order_id']);
        $bill->status_bill = $data['order_status'];
        $bill->save();

        if ($bill->status_bill == 1) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->product_quantity;
                $product_soid = $product->product_soid;

                foreach ($data['quantity'] as $key2 => $qty) {
                    if ($key==$key2) {
                        $pro_remain = $product_qty - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_soid = $product_soid + $qty;
                        $product->save();
                    }
                }
            }
        }else if ($bill->status_bill == 0 || $bill->status_bill == 2) {
            foreach ($data['order_product_id'] as $key => $product_id) {
                $product = Product::find($product_id);
                $product_qty = $product->product_quantity;
                $product_soid = $product->product_soid;

                if ($product->product_soid !=0) {
                    foreach ($data['quantity'] as $key2 => $qty) {
                        if ($key==$key2) {
                            $pro_remain = $product_qty + $qty;
                            $product->product_quantity = $pro_remain;
                            $product->product_soid = $product_soid - $qty;
                            $product->save();
                        }
                    }
                }
                // foreach ($data['quantity'] as $key2 => $qty) {
                //     if ($key==$key2) {
                //         $pro_remain = $product_qty + $qty;
                //         $product->product_quantity = $pro_remain;
                //         $product->product_soid = $product_soid - $qty;
                //         $product->save();
                //     }
                // }
            }
        }
    }

    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        
        $billdetaill_print = BillDetail::where('order_code',$checkout_code)->join('post', 'post.id_post', 'bill_detail.id_post_bill_detail')->get();
        $bill_print = Bill::where('order_code',$checkout_code)->get();
        // foreach ($billdetaill_print as $key11 => $value) {
        //     $product_print = Product::where('id',$value->id_product)->join('post', 'post.id_post', 'products.id_post')->get();
        // }

        $day = date('d');
        $month = date('m');
        $year = date('Y');

        $kh_print = Bill::join('customer', 'customer.id', '=', 'bills.id_customer')->where('order_code',$checkout_code)->first();

        $output = '';

        $output.='<style>
        body {
            margin: 0;
            padding: 0;
            background-color: #FAFAFA;
            font: 12pt;
            font-family: DejaVu Sans;
        }
        * {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
        }
        .page {
            width: 17cm;
            overflow:hidden;
            min-height:260mm;
            padding: 1.5cm;
            margin-left:auto;
            margin-right:auto;
            background: white;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .subpage {

            border: 5px red solid;
            outline: 2cm #FFEAEA solid;
        }
         @page {
         size: A4;
         margin: 0;
        }

        .logo {
            background-color:#FFFFFF;
            text-align:left;
            vertical-align: -50px;

        }
        .company {
            text-transform:uppercase;
            background-color:#FFFFFF;
            text-align:right;
            font-size:16px;
            vertical-align: text-top;
        }
        .title {
            text-align:center;
            position:relative;
            color:#0000FF;
            font-size: 24px;
            top:1px;
        }

        .TableData {
            background:#ffffff;
            font: 11px;
            width:100%;
            border-collapse:collapse;
            font-size:12px;
            border:1px solid #d3d3d3;
            text-align: center;
        }
        .TableData_now {
            background:#ffffff;
            font: 11px;
            width:100%;
            border-collapse:collapse;
            font-size:12px;
            border:0px solid #d3d3d3;
            text-align: center;
            vertical-align:middle;
        }

        .TableData th {
            background: rgba(0,0,255,0.1);
            text-align: center;
            font-weight: bold;
            color: #000;
            border:1px solid #d3d3d3;
            
        }
        .TableData tr {
            height: 24px;
            border:thin solid #d3d3d3;
        }
        .TableData tr td {
            padding-right: 2px;
            padding-left: 2px;
            border:thin solid #d3d3d3;
        }
        .TableData tr:hover {
            background: rgba(0,0,0,0.05);
        }
        .TableData .cotSTT {
            text-align:center;
            width: 10%;
        }
        .TableData .cotTenSanPham {
            text-align:left;
            width: 40%;
        }
        .TableData .cotHangSanXuat {
            text-align:left;
            width: 20%;
        }
        .TableData .cotGia {
            text-align:right;
            width: 120px;
        }
        .TableData .cotSoLuong {
            text-align: center;
            width: 50px;
        }
        .TableData .cotSo {
            text-align: right;
            width: 120px;
        }
        .TableData .tong {
            text-align: right;
            font-weight:bold;
            text-transform:uppercase;
            padding-right: 4px;
        }
        .TableData .cotSo {
            text-align: center;
        }
        }
        </style>
        <body>
        <div id="page" class="page">
          <table class="TableData_now" style="border-bottom: 1px solid red">
            <tbody>
                <tr>
                  
                  <td style="text-align: left;"><img src="source/assets/dest/images/logo-laptop.png" height="155px" width="155px" ></td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                  <td style="text-align: right;font-size:16px;color:#0000FF">C.TY TNHH ALONE</td>
                </tr>
            </tbody>
          </table><br>
          <div class="title">
                HÓA ĐƠN THANH TOÁN
                <br/>
                -------oOo-------
          </div>
          <br/>
          <br/>
          <table class="TableData">
            <tr>
                <td><b>ShopPv.vn</b></td>
                <td style="text-align:left; padding-left:2%;"><b>Lưu ý khi chuyển phát:</b><br>- Sau 2 lần không phát được liên hệ HTKT điện thoại để phối hợp xử lý.<br>- Sau 7 ngày không nhận được phản hồi shipper phải xử lý chuyển hoàn.</td>
                <td style="padding-left:30%">'.DNS2D :: getBarcodeHTML ( $kh_print->order_code, 'QRCODE',4,4).'</td>
            </tr>
        </table>
        <br><br>
          <table class="TableData">
            <thead>
                <tr>
                  
                  <th>Tên Khách Hàng</th>
                  <th>Địa Chỉ</th>
                  <th>Số Điện Thoại</th>
                  <th>Ghi Chú</th>
                </tr>
            </thead>
            <tbody>';
            $output.='
                <tr>
                    <td>'.$kh_print->name.'</td>
                    <td>'.$kh_print->address.'</td>
                    <td>'.$kh_print->phone_number.'</td>
                    <td>'.$kh_print->note.'</td>
                </tr>';
            $output.='
            <tbody>
          </table><br><br>
          <table class="TableData">
            <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên Sản Phẩm</th>
                  <th>Đơn Giá</th>
                  <th>Số Lượng</th>
                  <th>Thành Tiền</th>
                </tr>
            </thead>
            <tbody>';
            foreach($billdetaill_print as $key => $bd){
                foreach($bill_print as $key2 => $b_print){
            $output.='
                <tr>
                    <td>'.$key++.'</td>
                    <td>'.$bd->sp_vi.'</td>
                    <td>'.number_format($bd->unit_price,0,',','.').'</td>
                    <td>'.$bd->quantity.'</td>
                    <td>'.number_format((($bd->quantity)*($bd->unit_price)),0,',','.').'</td>
                </tr>';
                }
            }
            $output.='
                <tr>
                  <td colspan="4" class="tong">Tổng Tiền</td>
                  <td class="cotSo">'.number_format($b_print->total,0,',','.').' VNĐ</td>
                </tr>
            <tbody>
          </table><br><br>
          <table class="TableData_now">
          <thead>
                <tr>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th style="text-align:right;"> Bình Dương, ngày '.$day.' tháng '.$month.' năm '.$year.'</th>
                </tr>
          </thead>
          <tbody>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td style="padding-left:50%;">Ngưởi Nhận</td>
              </tr>
          <tbody>
          </table>
          </tbody>
        </div>
        </body>';

        return $output;


    }

 

    // public function active_donhang($id){
    //     Bill::where('id_bill',$id)->update(['status_bill'=>0]);
    //     return redirect()->back();
    // }
    // public function unactive_donhang($id){
    //     Bill::where('id_bill',$id)->update(['status_bill'=>1]);
    //     return redirect()->back();
    // }

/*-----------------------------------------------N-N----------------------------------------------------------------*/

    public function getQL_NN(Request $req){
        if (Auth::check() && Auth::user()->level == 1) {
            $ngonngu = Post::all();
            $url_canonical = $req->url();

            
            return view('admin.QL_post', compact('ngonngu','url_canonical'));
        }else{
            return redirect()->route('trang-chu');
        }
    }
    public function AddAdmin_NN(Request $req){
        $addnn = new Post();

        $this->validate($req,
        [
            'sp_vi'=>'required',
            'sp_en'=>'required',

        ],
        [
            'sp_vi.required'=>'Vui lòng nhập vi',
            'sp_en.required'=>'Vui lòng nhập en',

        
        ]);

        $addnn->sp_vi  = $req->sp_vi;
        $addnn->sp_en  = $req->sp_en;
        $addnn->product_slug  = $req->slug;

        $addnn->save();
        return redirect()->route('quanlynn')->with('thongbaoadd', 'Add New Successful'); 
    }

    public function DelAdmin_NN($id)
    {
        $delnn = Post::where('id_post', $id)->delete();

        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    // public function getUpdateNn($id){
    //      if (Auth::check() && Auth::user()->level == 1) {
    //         $update_nn = Post::where('id_post',$id)->first();


            
    //         return view('admin.Update_nn', compact('update_nn'));
    //     }else{
    //         return redirect()->route('trang-chu');
    //     }
    // }

    public function postUpdateNn(Request $req, $id){
        if (Auth::check()) {
            $this->validate($req,
            [
                'sp_vi'=>'required',
                'sp_en'=>'required',

            ],
            [

                'sp_vi.required'=>'Vui lòng nhập tên vi',
                'sp_en.required'=>'Vui lòng nhập tên en',
            ]);
            $updatenn = Post::where('id_post',$id)->first();
            $updatenn->sp_vi = $req->sp_vi;
            $updatenn->sp_en = $req->sp_en;
            $updatenn->product_slug = $req->slug;


            $updatenn->save();
            return redirect()->route('quanlynn')->with('thongbaoupdate', 'Update Successful');
        }else {
            return redirect()->route('trang-chu');
        }
    }



    public function filter_by_date(Request $req){
        $data = $req->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];

        $get = Statistical::whereBetween('order_date', [$from_date,$to_date])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->sales, 
                'profit' => $val->profit, 
                'quantity' => $val->quantity
            );
        }

        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $req){
        $data = $req->all();
        // echo $today = Carbon::now('Asia/Ho_Chi_Minh');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();

        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if ($data['dashboard_value']=='7ngay') {
            $get = Statistical::whereBetween('order_date', [$sub7ngay,$now])->orderBy('order_date','ASC')->get();

        }elseif ($data['dashboard_value']=='thangtruoc') {
            $get = Statistical::whereBetween('order_date', [$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();

        }elseif ($data['dashboard_value']=='thangnay') {
            $get = Statistical::whereBetween('order_date', [$dauthangnay,$now])->orderBy('order_date','ASC')->get();

        }else{
            $get = Statistical::whereBetween('order_date', [$sub365ngay,$now])->orderBy('order_date','ASC')->get();

        }

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->sales, 
                'profit' => $val->profit, 
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);


    }

    public function days_order(){
        $sub30ngay = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistical::whereBetween('order_date', [$sub30ngay,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date, 
                'order' => $val->total_order, 
                'sales' => $val->sales, 
                'profit' => $val->profit, 
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    // coupon
    public function getCoupon(Request $req){

        if (Auth::check()) {


            $coupon = Coupon::orderBy('coupon_id', 'desc')->get();
            $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
            $coupon_send_new = Coupon::where('coupon_status', 0)->where('coupon_date_end', '>=', $today)->first();
            $url_canonical = $req->url();

            return view('admin.QL_coupon', compact('coupon', 'today', 'coupon_send_new','url_canonical'));


        } else {
            return redirect()->route('trang-chu');
        }
    }

    public function AddAdmin_Coupon(Request $req){
        $addcoupon = new Coupon();

        $this->validate($req,
        [
            'coupon_time'=>'required',
            'coupon_number'=>'required',
            'coupon_code'=>'required|unique:coupon,coupon_code',

        ],
        [
            'coupon_time.required'=>'Vui lòng nhập coupon_time',
            'coupon_number.required'=>'Vui lòng nhập coupon_number',
            'coupon_code.required'=>'Vui lòng nhập coupon_code',
            'coupon_code.unique'=>'coupon_code đã tồn tại',
        
        ]);

        $addcoupon->coupon_name  = $req->coupon_name;
        $addcoupon->coupon_time  = $req->coupon_time;
        $addcoupon->coupon_number  = $req->coupon_number;
        $addcoupon->coupon_code  = $req->coupon_code;
        $addcoupon->coupon_condition  = $req->coupon_condition;
        $addcoupon->coupon_date_start  = $req->coupon_date_start;
        $addcoupon->coupon_date_end  = $req->coupon_date_end;
        $addcoupon->coupon_status  = $req=0;

        $addcoupon->save();
        return redirect()->route('quanlycoupon')->with('thongbaoadd', 'Add New Successful'); 
    }

    public function DelAdmin_Coupon($id)
    {   
        $delcoupon = Coupon::where('coupon_id', $id)->delete();


        return redirect()->back()->with('thongbaodel', 'Delete Successful');
    }

    // public function getUpdate_Coupon($id){
    //      if (Auth::check() && Auth::user()->level == 1) {
    //         $update_coupon = Coupon::where('coupon_id',$id)->first();
            
    //         return view('admin.Update_coupon', compact('update_coupon'));
    //     }else{
    //         return redirect()->route('trang-chu');
    //     }
    // }

    public function postUpdate_Coupon(Request $req, $id){
        if (Auth::check()) {
            $this->validate($req,
            [
                'coupon_time'=>'required',
                'coupon_number'=>'required',
                'coupon_code'=>'required',

            ],
            [
                'coupon_time.required'=>'Vui lòng nhập coupon_time',
                'coupon_number.required'=>'Vui lòng nhập coupon_number',
                'coupon_code.required'=>'Vui lòng nhập coupon_code',
                // 'coupon_code.unique'=>'coupon_code đã tồn tại',
            
            ]);
            $update_cp = Coupon::where('coupon_id',$id)->first();
            $update_cp->coupon_name  = $req->coupon_name;
            $update_cp->coupon_time  = $req->coupon_time;
            $update_cp->coupon_number  = $req->coupon_number;
            $update_cp->coupon_code  = $req->coupon_code;
            $update_cp->coupon_condition  = $req->coupon_condition;
            $update_cp->coupon_date_start  = $req->coupon_date_start;
            $update_cp->coupon_date_end  = $req->coupon_date_end;
            $update_cp->coupon_status  = $req=0;


            $update_cp->save();
            return redirect()->route('quanlycoupon')->with('thongbaoupdate', 'Update Successful');
        }else {
            return redirect()->route('trang-chu');
        }
    }

    public function active_percent($id){
        Coupon::where('coupon_id',$id)->update(['coupon_condition'=>0]);
        return redirect()->back();
    }
    public function active_money($id){
        Coupon::where('coupon_id',$id)->update(['coupon_condition'=>1]);
        return redirect()->back();
    }

    public function send_coupon(){
        $user_coupon = User::where('level', 2)->get();
        $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
        $coupon_send_new = Coupon::where('coupon_status', 0)->where('coupon_date_end', '>=', $today)->orderBy('coupon_id', 'desc')->first();
        $now_send = date('d-m-Y H:i:s');
        $to_email =  "npn020899@gmail.com";
        $title_mail = "Mã Khuyến Mãi".' '.$now_send;

        $data = [];
        foreach ($user_coupon as $key => $send) {
            $data['email'][] = $send->email;
        }
        $coupon_array =  array(
            'coupon_send_new' => $coupon_send_new, 
        );
        Mail::send('email.send_mail_coupon', ['coupon_array'=>$coupon_array]  ,function($message) use ($title_mail, $data, $to_email){
            $message->to($data['email'])->subject($title_mail);
            $message->from($to_email, $title_mail);
        });

        return redirect()->back()->with('thongbaoupdate', 'Sending Discount Code Successfully');
    }

    public function active_coupon($id){
        Coupon::where('coupon_id',$id)->update(['coupon_status'=>0]);
        return redirect()->back();
    }
    public function unactive_coupon($id){
        Coupon::where('coupon_id',$id)->update(['coupon_status'=>1]);
        return redirect()->back();
    }

}
