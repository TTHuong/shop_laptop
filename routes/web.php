<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',['as'=>'trang-chu','uses'=>'pgcontroller@getIndex']);

//chuyen ngon ngu
Route::get('language/{locale}', function($locale){
	Session::put('locale', $locale);
	return redirect()->back();
});


//loai san pham & chi tiet san pham & tim kiem & tat ca san pham
Route::get('loai-san-pham-{typesanpham}',['as'=>'loaisanpham','uses'=>'pgcontroller@getLoaiSP']);
Route::get('tim-kiem',[	'as'=>'timkiem','uses'=>'pgcontroller@getTimKiem']);
Route::get('chi-tiet-san-pham-{id}/{product_slug?}',['as'=>'chitietsanpham','uses'=>'pgcontroller@getChitiet']);
Route::get('san-pham',['as'=>'allproduct','uses'=>'pgcontroller@getAllproduct']);

//lien he & gioi thieu
Route::get('lien-he',['as'=>'lienhe','uses'=>'pgcontroller@getLienHe']);
Route::post('lien-he',[	'as'=>'lienhe','uses'=>'pgcontroller@postLienHe']);
Route::get('gioi-thieu',['as'=>'gioithieu','uses'=>'pgcontroller@getGioiThieu']);

//ma giam gia
Route::post('/check-coupon','pgcontroller@check_coupon');



//gio hang
Route::get('add-to-cart/{id}',['as'=>'themgiohang','uses'=>'pgcontroller@getAddToCart']);
Route::get('del-cart/{id}',['as'=>'xoagiohang','uses'=>'pgcontroller@getDelCart']);
Route::get('update-cart/{id}',['as'=>'capnhatgiohang','uses'=>'pgcontroller@getUpCart_qty']);

Route::get('shopping-cart',['as'=>'shoppingcart','uses'=>'pgcontroller@getshoppingcart']);

// Route::get('gio-hang-chi-tiet',['as'=>'chitietgiohang','uses'=>'pgcontroller@getGioHangChiTiet']);

//dat hang
Route::get('dat-hang',['as'=>'dathang','uses'=>'pgcontroller@getDatHang']);
Route::post('dat-hang',['as'=>'dathang','uses'=>'pgcontroller@postDatHang']);

//tai khoan
Route::get('dang-nhap',['as'=>'dangnhap','uses'=>'TaiKhoan_Controller@getDangNhap']);
Route::post('dang-nhap',['as'=>'dangnhap','uses'=>'TaiKhoan_Controller@postDangNhap']);

Route::get('dang-ky',['as'=>'dangky','uses'=>'TaiKhoan_Controller@getDangKy']);
Route::post('dang-ky',['as'=>'dangky','uses'=>'TaiKhoan_Controller@postDangKy']);
Route::get('dang-xuat',['as'=>'dangxuat','uses'=>'TaiKhoan_Controller@postDangXuat']);
Route::post('userUpdate1',['as'=>'userupdate1','uses'=>'TaiKhoan_Controller@userUpdate1']);

//quen mat khau
Route::get('/quen-mat-khau','passController@quen_mat_khau');
Route::post('/recover-pass','passController@recover_pass');
Route::get('update-new-pass',['as'=>'updatenewpass','uses'=>'passController@getupdate_new_pass']);
Route::post('update-new-pass',['as'=>'updatenewpass','uses'=>'passController@postupdate_new_pass']);


/*---------------------------------------------------ADMIN---------------------------------------------------------------*/


//dashboard
Route::get('index-admin',['as'=>'trang-chu-admin','uses'=>'admincontroller@getIndexAdminDash']);
Route::post('/filter-by-date','admincontroller@filter_by_date');
Route::post('/dashboard-filter','admincontroller@dashboard_filter');
Route::post('/days-order','admincontroller@days_order');

//user
Route::get('ql-nguoi-dung',['as'=>'quanlynguoidung','uses'=>'admincontroller@getQL_NguoiDung']);
Route::get('ql-nguoi-dung-user',['as'=>'quanlynguoidung_user','uses'=>'admincontroller@getQL_NguoiDung_user']);
Route::get('ql-nguoi-dung-ad',['as'=>'quanlynguoidung_ad','uses'=>'admincontroller@getQL_NguoiDung_ad']);
Route::get('user/{id}/delete',['as'=>'delete','uses'=>'admincontroller@DelAdmin']);
// Route::get('update-user/{id}',['as'=>'update_admin','uses'=>'admincontroller@getUpdateAdmin']);
Route::post('update-user/{id}',['as'=>'update_admin','uses'=>'admincontroller@postUpdateAdmin']);
Route::post('add-ad',['as'=>'addnew','uses'=>'admincontroller@AddAdmin']);
Route::get('/active-user/{id}','admincontroller@active_user');
Route::get('/unactive-user/{id}','admincontroller@unactive_user');

//slide
Route::get('ql-slide',['as'=>'quanlyslide','uses'=>'admincontroller@getQL_Slide']);
// Route::get('update-slide/{id}',['as'=>'update_slide','uses'=>'admincontroller@getUpdateSlide']);
Route::post('update-slide/{id}',['as'=>'update_slide','uses'=>'admincontroller@postUpdateSlide']);
Route::post('add-ad-slide',['as'=>'addnewslide','uses'=>'admincontroller@AddAdmin_Slide']);
Route::get('slide/{id}/delete',['as'=>'deleteslide','uses'=>'admincontroller@DelAdmin_Slide']);
Route::get('/active-slide/{id}','admincontroller@active_slide');
Route::get('/unactive-slide/{id}','admincontroller@unactive_slide');

//thuong hieu san pham
Route::get('ql-nsx',['as'=>'quanlynsx','uses'=>'admincontroller@getQL_Nsx']);
Route::post('add-ad-nsx',['as'=>'addnewnsx','uses'=>'admincontroller@AddAdmin_NSX']);
Route::get('nsx/{id}/delete',['as'=>'deletensx','uses'=>'admincontroller@DelAdmin_NSX']);
// Route::get('update-nsx/{id}',['as'=>'update_nsx','uses'=>'admincontroller@getUpdateNsx']);
Route::post('update-nsx/{id}',['as'=>'update_nsx','uses'=>'admincontroller@postUpdateNsx']);

//loai ngon ngu
Route::get('ql-lang',['as'=>'quanlynn','uses'=>'admincontroller@getQL_NN']);
Route::post('add-lang',['as'=>'addnewnn','uses'=>'admincontroller@AddAdmin_NN']);
Route::get('lang/{id}/delete',['as'=>'deletenn','uses'=>'admincontroller@DelAdmin_NN']);
// Route::get('update-lang/{id}',['as'=>'update_lang','uses'=>'admincontroller@getUpdateNn']);
Route::post('update-lang/{id}',['as'=>'update_lang','uses'=>'admincontroller@postUpdateNn']);

//san pham
Route::get('ql-san-pham',['as'=>'quanlysanpham','uses'=>'admincontroller@getQL_Sanpham']);
Route::post('add-ad-sp',['as'=>'addnewsp','uses'=>'admincontroller@AddAdmin_Sp']);
// Route::get('update-sp/{id}',['as'=>'update_sp','uses'=>'admincontroller@getUpdateSp']);
Route::post('update-sp/{id}',['as'=>'update_sp','uses'=>'admincontroller@postUpdateSp']);
Route::get('/active-sp/{id}','admincontroller@active_sp');
Route::get('/unactive-sp/{id}','admincontroller@unactive_sp');
Route::get('sp/{id}/delete',['as'=>'deletensp','uses'=>'admincontroller@DelAdmin_Sp']);


//don hang
Route::get('ql-don-hang',['as'=>'donhang','uses'=>'admincontroller@getDonHang']);
Route::get('ql-don-hang-da-duyet',['as'=>'donhang_daduyet','uses'=>'admincontroller@getDonHang_daduyet']);
Route::get('ql-don-hang-chua-duyet',['as'=>'donhang_chuaduyet','uses'=>'admincontroller@getDonHang_chuaduyet']);
Route::get('ql-don-hang-huy',['as'=>'donhang_huy','uses'=>'admincontroller@getDonHang_huy']);

Route::get('ql-don-hang-chi-tiet/{id}',['as'=>'donhangchitiet','uses'=>'admincontroller@getChiTietDonHang']);
Route::post('ql-don-hang-chi-tiet/{id}',['as'=>'donhangchitiet','uses'=>'admincontroller@postChiTietDonHang']);

Route::post('/update-order-qty','admincontroller@update_order_qty');
Route::get('dh/{id}',['as'=>'deletedh','uses'=>'admincontroller@DelAdmin_DonHang']);
Route::get('/print-order/{checkout_code}','admincontroller@print_order');



// ql ma giam gia
Route::get('ql-ma-giam-gia',['as'=>'quanlycoupon','uses'=>'admincontroller@getCoupon']);
Route::post('add-ad-coupon',['as'=>'addnewcoupon','uses'=>'admincontroller@AddAdmin_Coupon']);
Route::get('coupon/{id}/delete',['as'=>'deletecoupon','uses'=>'admincontroller@DelAdmin_Coupon']);

// Route::get('update-coupon/{id}',['as'=>'update_coupon','uses'=>'admincontroller@getUpdate_Coupon']);
Route::post('update-coupon/{id}',['as'=>'update_coupon','uses'=>'admincontroller@postUpdate_Coupon']);

Route::get('/active-percent/{id}','admincontroller@active_percent');
Route::get('/active-money/{id}','admincontroller@active_money');

Route::get('/send-coupon','admincontroller@send_coupon');

Route::get('/active-coupon/{id}','admincontroller@active_coupon');
Route::get('/unactive-coupon/{id}','admincontroller@unactive_coupon');





