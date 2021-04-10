@extends('Layout')
@section('title')    
Order Cart
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li class="active"><a href="">Checkout</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- coupon-area start -->
<div class="coupon-area pt-100 pt-sm-60">
    <div class="container">
		@if(count($errors)>0)
        <div class="alert alert-danger" style="width: 100%">
            @foreach($errors->all() as $err)
            {{$err}}<br>
            @endforeach
        </div>
        @endif
		@if(Session::has('thongbao'))
			<div class="alert alert-success" style="width: 100%">{{Session::get('thongbao')}}</div> 
		@endif
	    @if(Session::has('message'))
		    <div style="height: 50px" class="alert alert-success form-control" style="width: 100%">{{Session::get('message')}}</div> 
		@elseif(Session::has('message_err'))
		    <div style="height: 50px" class="alert alert-danger form-control" style="width: 100%">{{Session::get('message_err')}}</div> 
		@endif
        <div class="row">
            <div class="col-md-12">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    @if(!Session::get('coupon') && Session::has('cart'))
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form method="post" action="{{url('/check-coupon')}}">
                            	@csrf
                                <p class="checkout-coupon">
                                    <input type="text" class="code" name="coupon_code" placeholder="Coupon code" />
                                    <input type="submit" name="check_coupon" value="Apply Coupon" />
                                </p>
                            </form>
                        </div>
                    </div>
                    @endif
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->
<!-- checkout-area start -->
<div class="checkout-area pb-100 pt-15 pb-sm-60">
    <div class="container">
    	<form action="{{route('dathang')}}" method="post" class="beta-form-checkout">
        <div class="row">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
	            <div class="col-lg-6 col-md-6">
	                <div class="checkbox-form mb-sm-40">
	                    <h3>Billing Details</h3>
	                    <div class="row">
	                        <div class="col-md-12">
	                            <div class="checkout-form-list mb-30">
	                                <label>Họ và tên <span class="required">*</span></label>
	                                <input type="text" name="name23131" placeholder="Họ tên" required value="{{$user_dh->full_name}}">
	                            </div>
	                        </div>
	                        <div class="col-md-12">
	                            <div class="checkout-form-list mb-30">
	                                <label>Giới Tính <span class="required">*</span></label>
	                                <input id="gender" type="radio" class="input-radio" name="gender" value="nam" checked="checked" style="width: 10%"><span style="margin-right: 10%">Nam</span>
									<input id="gender" type="radio" class="input-radio" name="gender" value="nữ" style="width: 10%"><span>Nữ</span>
	                            </div>
	                        </div>
	                        <div class="col-md-12">
	                        	<div class="order-notes">
	                            <div class="checkout-form-list">
	                                <label>Address <span class="required">*</span></label>
	                                <textarea  name="address11223" id="address11223" placeholder="Street Address"rows="4" cols="50">{{$user_dh->address}}</textarea>
	                            </div>
	                        </div>
	                        </div><br><br><br><br><br><br><br>
	                        <div class="col-md-6">
	                            <div class="checkout-form-list mb-30">
	                                <label>Email Address <span class="required">*</span></label>
	                                <input type="email" id="email" name="email" required value="{{$user_dh->email}}">
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                            <div class="checkout-form-list mb-30">
	                                <label>Phone  <span class="required">*</span></label>
	                                <input type="text" id="phone" name="phone" required value="{{$user_dh->phone}}">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="different-address">
	                        <div class="order-notes">
	                            <div class="checkout-form-list">
	                                <label>Order Notes</label>
	                                <textarea id="notes" name="notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-6 col-md-6">
	                <div class="your-order">
	                    <h3>Your order</h3>
	                    <div class="your-order-table table-responsive">
	                        <table>
	                            <thead>
	                                <tr>
	                                    <th class="product-name">Product</th>
	                                    <th class="product-total">Total</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                            	@if(Session::has('cart'))
									@foreach($product_cart as $cart)
	                                <tr class="cart_item">
	                                    <td class="product-name">
	                                        {{$cart['item']->$multisp}} <span class="product-quantity"> × {{$cart['qty']}}</span>
	                                    </td>
	                                    <td class="product-total">

	                                        <span class="amount">{{number_format($cart['price'],0,',','.')}} VNĐ</span>
	                                    </td>
	                                </tr>
									@endforeach
									@endif
	                            </tbody>
	                            <tfoot>
	                            	@if(!Session::get('coupon'))
	                                <tr class="cart-subtotal">
	                                    <th>Cart Total</th>
	                                    <td>
	                                    	<span class="amount">
	                                    		@if(Auth::check() && Session('cart'))
													{{number_format($totalPrice,0,',','.')}} VNĐ
												@else
													0 VNĐ
												@endif
											</span>
	                                    </td>
	                                </tr>
	                                @else
	                                <tr class="cart-subtotal">
	                                    <th>Subtotal</th>
	                                    <td>
	                                    	<span class="amount">
	                                    		@if(Auth::check() && Session('cart'))
													{{number_format($totalPrice,0,',','.')}} VNĐ
												@else
													0 VNĐ
												@endif
											</span>
	                                    </td>
	                                </tr>
	                                <tr class="cart-subtotal">
	                                    <th>Cart Total</th>
	                                    <td>
	                                    	<span class="amount">
	                                    		@foreach(Session::get('coupon') as $key => $coun)
		                                    		@if(Session::get('coupon') && $coun['coupon_condition']==0)
													@php
														$total_coupon = ($totalPrice*$coun['coupon_number'])/100;
														$total_pre = $totalPrice-$total_coupon;
														$totalPrice = $total_pre;
													@endphp
														{{number_format($totalPrice,0,',','.')}} VNĐ
													@elseif(Session::get('coupon') && $coun['coupon_condition']==1)
														@php
															$total_coupon = $totalPrice-$coun['coupon_number'];
															$totalPrice = $total_coupon;
														@endphp
														{{number_format($totalPrice,0,',','.')}} VNĐ
													@endif
												@endforeach
	                                    	</span>
	                                    </td>
	                                </tr>
	                                @endif
	                            </tfoot>
	                        </table>
	                    </div>
	                    <div class="payment-method">
	                        <div id="accordion">
	                            <div class="card">
	                                <div class="card-header" id="headingone">
	                                    <h5 class="mb-0">
	                                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	                                          Thanh toán khi nhận hàng
	                                        </a>
	                                    </h5>
	                                </div>

	                                <div id="collapseOne" class="collapse show" aria-labelledby="headingone" data-parent="#accordion">
	                                	<input id="payment_method_bacs" type="radio" class="input-radio" name="payment_method" value="COD" checked="checked" data-order_button_text="" hidden="">
	                                    <div class="card-body">
	                                        <p>Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng.</p>
	                                    </div>
	                                    <div class="card-body">
	                                    	@if(Session::has('cart'))
	                                    		<div class="buttons-cart">
	                                    			<input type="submit" name="check_coupon" value="Đặt hàng" style="text-align: center;">
												</div>
											@else
				                                <div class="buttons-cart">
				                                    <a href="{{route('trang-chu')}}"><i class="fa fa-angle-left movleft"></i> Tiếp tục mua sắm</a>
				                                </div>
											@endif
	                                    </div>
	                                </div>
	                            </div>
	                            <div class="card">
	                                <div class="card-header" id="headingthree">
	                                	<input id="payment_method_cheque" type="radio" class="input-radio" name="payment_method" value="ATM" data-order_button_text="" hidden="">
	                                    <h5 class="mb-0">
	                                        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	                                  PayPal
	                                </a>
	                                    </h5>
	                                </div>
	                                <div id="collapseThree" class="collapse" aria-labelledby="headingthree" data-parent="#accordion">
										@if(Session::has('cart'))
											@php
												$vn_to_usd = $totalPrice/22986;
											@endphp
										<input type="hidden" id="vn_to_usd" value="{{round($vn_to_usd,2)}}">
										@endif
	                                    <div class="card-body">
	                                         <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
	                                    </div>
	                                    <div class="card-body">
	                                    	@if(Session::has('cart'))
	                                    		<div class="buttons-cart">
	                                    			<button class="paypal_dathang"  type="submit"  style="background-color: #fff"><i id="paypal-button"></i></button>
												</div>
											@else
				                                <div class="buttons-cart">
				                                    <a href="{{route('trang-chu')}}"><i class="fa fa-angle-left movleft"></i> Tiếp tục mua sắm</a>
				                                </div>
											@endif
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
        </div>
        </form>
    </div>
</div>
<!-- checkout-area end -->
@endsection