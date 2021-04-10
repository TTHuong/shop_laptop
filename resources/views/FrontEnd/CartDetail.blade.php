@extends('Layout')
@section('title')    
Cart Detail
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li class="active"><a href="{{route('shoppingcart')}}">Cart</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Cart Main Area Start -->
<div class="cart-main-area ptb-100 ptb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
				    @if(Session::has('message'))
					    <div style="height: 50px" class="alert alert-success form-control" style="width: 100%">{{Session::get('message')}}</div> 
					@elseif(Session::has('message_err'))
					    <div style="height: 50px" class="alert alert-danger form-control" style="width: 100%">{{Session::get('message_err')}}</div> 
					@endif
                    <!-- Table Content Start -->
                    <div class="table-content table-responsive mb-45">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">Image</th>
                                    <th class="product-name">{{ trans('home.producttt') }}</th>
                                    <th class="product-price">{{ trans('home.gia') }}</th>
                                    <th class="product-quantity">{{ trans('home.qty') }}</th>
                                    <th class="product-subtotal">{{ trans('home.status') }}</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
        					@if(Auth::check() && Session('cart'))
                            <tbody>
								@foreach($product_cart as $cart)	
                                <tr>
                                    <td class="product-thumbnail">
                                        <a href="#"><img src="source/image/product/{{$cart['item']['image']}}" alt="cart-image" height="101.6px" width="101.6px" /></a>
                                    </td>
                                    <td class="product-name"><a href="#">{{$cart['item']->$multisp}}</a></td>
                                    <td class="product-price">
                                    	<span class="amount">
											@if($cart['item']['promotion_price']==0)
												{{number_format($cart['item']['unit_price'],0,',','.')}} VNĐ 
											@else 
												{{number_format($cart['item']['promotion_price'],0,',','.')}} VNĐ 
											@endif
                                    	</span>
                                    </td>
                                    <td class="product-quantity buttons-cart" style="padding-left: 3%">
                                    	<input style="width: 25%; text-align: center;" type="number" value="{{$cart['qty']}}" readonly="" />
                                    	<a style="width: 55%" href="{{route('capnhatgiohang',$cart['item']['id'])}}">Cập Nhật</a>
<!--                                     	<div class="buttons-cart">
                                    		<a class="buttons-cart" style="width: 10%" href="{{route('capnhatgiohang',$cart['item']['id'])}}">Cập Nhật</a>
                                    	</div> -->
                                    </td>
                                    <td class="product-subtotal">IN STOCK</td>
                                    <td class="product-remove"> <a href="{{route('xoagiohang',$cart['item']['id'])}}"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                                </tr>
            					@endforeach
                            </tbody>
                            @else
                            <tbody>
                            	<tr>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            		<td></td>
                            	</tr>
                            </tbody>
							@endif
                        </table>
                    </div>
                    <!-- Table Content Start -->
                    <div class="row">
                       <!-- Cart Button Start -->
                       	
                        <div class="col-md-8 col-sm-12">
                        	@if(!Session::get('coupon'))
							<form method="post" action="{{url('/check-coupon')}}">
                            <div class="buttons-cart">

									@csrf
									<div>
										<input type="text" name="coupon_code" placeholder="Coupon code" style="background: #fff; border: 1px solid #000; text-transform: none;color: #000"> 
										<input type="submit" name="check_coupon" value="Apply Coupon">
									</div>

                            </div>
							</form>
							@endif
                            <div class="buttons-cart">
                                <!-- <input type="submit" value="Update Cart" /> -->
                                <a href="{{route('trang-chu')}}">Continue Shopping</a>
                            </div>
                        </div>
                        <!-- Cart Button Start -->
                        <!-- Cart Totals Start -->
                        <div class="col-md-4 col-sm-12">
                            <div class="cart_totals float-md-right text-md-right">
                                <h2>Cart Totals</h2>
                                <br />
                                <table class="float-md-right">
                                    <tbody>
                                    	@if(Session::get('coupon'))
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
                                        	<th>Coupon</th>
                                        	<td>													
                                        		@foreach(Session::get('coupon') as $key => $coun)
													@if($coun['coupon_condition']==0)
														{{$coun['coupon_number']}} %
													@else
														{{number_format($coun['coupon_number'],0,',','.')}} VNĐ
													@endif
												@endforeach	
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
                                        @endif
                                        @if(!Session::get('coupon'))
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <strong>
                                                	<span class="amount">
                                                		@if(Auth::check() && Session('cart'))
															{{number_format($totalPrice,0,',','.')}} VNĐ
														@else
															0 VNĐ
														@endif</span>
												</strong>
                                            </td>
                                        </tr>
                                        @else
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td>
                                                <strong>
                                                	<span class="amount">
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
													</span>
												</strong>
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="wc-proceed-to-checkout">
                                    <a href="{{route('dathang')}}">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                        <!-- Cart Totals End -->
                    </div>
                    <!-- Row End -->
            </div>
        </div>
         <!-- Row End -->
    </div>
</div>
<!-- Cart Main Area End -->
@endsection