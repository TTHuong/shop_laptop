<!doctype html>
<html class="no-js" lang="vi">

<head>
    <title>{{ trans('home.home') }} || ShopPv</title>
    @include('FrontEnd.Style.Link')
</head>

<body>
    <!--[if lte IE 9]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
	<![endif]-->

    <!-- Main Wrapper Start Here -->
    <div class="wrapper">
        <!-- Banner Popup Start -->
        @include('FrontEnd.Header')
        <!-- Main Header Area End Here -->
        <!-- Categorie Menu & Slider Area Start Here -->
        <div class="main-page-banner pb-50 off-white-bg">
            <div class="container">
                <div class="row">
                    <!-- Vertical Menu Start Here -->
                    @include('FrontEnd.Menu')
                    <!-- Vertical Menu End Here -->
                    <!-- Slider Area Start Here -->
                    @include('FrontEnd.Slider')
                    <!-- Slider Area End Here -->
                </div>
                <!-- Row End -->
            </div>
            <!-- Container End -->
        </div>
        <!-- Categorie Menu & Slider Area End Here -->
        <!-- Brand Banner Area Start Here -->
        <div class="image-banner pb-50 off-white-bg">
            <div class="container">
                <div class="col-img">
                    <a href="#"><img src="{{asset('source/assets/frontend/img/banner/h1-banner.jpg')}}" alt="image banner"></a>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Brand Banner Area End Here -->
        <!-- Hot Deal Products Start Here -->
        <div class="hot-deal-products off-white-bg pb-90 pb-sm-50">
            <div class="container">
               <!-- Product Title Start -->
               <div class="post-title pb-30">
                   <h2>hot deals</h2>
               </div>
               <!-- Product Title End -->
                <!-- Hot Deal Product Activation Start -->
                <div class="hot-deal-active owl-carousel">
                    <!-- Single Product Start -->
                    @foreach($sanpham_khuyenmai as $product_km)
                    <div class="single-product">
                        <!-- Product Image Start -->
                        <div class="pro-img">
                            <a href="{{ route( 'chitietsanpham',['id'=> $product_km->id, 'product_slug'=>$product_km->product_slug]) }}">
                                <img class="primary-img" src="source/image/product/{{$product_km->image}}" alt="single-product" height="226px" width="226px">
                                <img class="secondary-img" src="source/image/product/{{$product_km->image}}" alt="single-product" height="226px" width="226px">
                            </a>
                            
                            <div class="countdown" data-countdown="{{ $product_km->date_sale}} {{ $product_km->hours_sale}}"></div>
                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$product_km->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                        </div>
                        <!-- Product Image End -->
                        <!-- Product Content Start -->
                        <div class="pro-content">
                            <div class="pro-info">
                                <h4><a href="{{ route( 'chitietsanpham',['id'=> $product_km->id, 'product_slug'=>$product_km->product_slug]) }}">{{$product_km->$multisp}}</a></h4>
                                <p><span class="price">{{number_format($product_km->promotion_price,0,',','.')}} VNĐ</span><del class="prev-price">{{number_format($product_km->unit_price,0,',','.')}} VNĐ</del></p>
                                <div class="label-product l_sale">{{number_format(100-($product_km->promotion_price/$product_km->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                            </div>
                            <div class="pro-actions">
                                <div class="actions-primary">
                                     @if($product_km->product_quantity>0)
                                    <a @if(Auth::check()) href="{{route('themgiohang',$product_km->id)}}" @else href="{{route('dangnhap')}}" @endif title="Add to Cart"> + Add To Cart</a>
                                    @else
                                    <a class="disabled-link"> + Add To Cart</a>
                                    @endif
                                </div>
                                <div class="actions-secondary">
                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                </div>
                            </div>
                        </div>
                        <!-- Product Content End -->
                    </div>
                    @endforeach
                    <!-- Single Product End -->
                </div>
                <!-- Hot Deal Product Active End -->

            </div>
            <!-- Container End -->
        </div>
        <!-- Hot Deal Products End Here -->
        <!-- Hot Deal Products End Here -->

        <!-- Big Banner Start Here -->
        <div class="big-banner mt-100 pb-85 mt-sm-60 pb-sm-45">
            <div class="container banner-2">
                <div class="banner-box">
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-1.jpg')}}" alt="banner 3"></a>
                    </div>
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-2.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-3.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-4.jpg')}}" alt="banner 3"></a>
                    </div>
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-5.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-6.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
                <div class="banner-box">
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-7.jpg')}}" alt="banner 3"></a>
                    </div>
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner3-8.jpg')}}" alt="banner 3"></a>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Big Banner End Here -->
        <!-- Arrivals Products Area Start Here -->
        <div class="arrivals-product pb-85 pb-sm-45">
            <div class="container">
                <div class="main-product-tab-area">
                    <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>{{ trans('home.newproduct') }}</h2>
                       </div>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#laptop">New</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#topLaptop-1">Top</a>
                            </li>
                        </ul>                       

                    </div> 

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        
                        <div id="laptop" class="tab-pane fade show active">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="electronics-pro-active owl-carousel">
                                @foreach($new_product as $new)
                                <!-- Double Product Start -->
                                <div class="double-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <input type="hidden" id="wishList_product_name{{$new->id}}" value="{{$new->$multisp}}" >
                                        <input type="hidden" id="wishList_price{{$new->id}}" value="@if($new->promotion_price == 0)
                                        {{number_format($new->unit_price,0,',','.')}} VNĐ
                                        @else
                                        {{number_format($new->promotion_price,0,',','.')}} VNĐ
                                        @endif" >

                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a id="wishList_producturl{{$new->id}}" href="{{ route( 'chitietsanpham',['id'=> $new->id, 'product_slug'=>$new->product_slug]) }}">
                                                <img id="wishList_image{{$new->id}}" class="primary-img" src="source/image/product/{{$new->image}}" alt="single-product" height="276.45px">
                                                <img class="secondary-img" src="source/image/product/{{$new->image}}" alt="single-product" height="276.45px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$new->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{ route( 'chitietsanpham',['id'=> $new->id, 'product_slug'=>$new->product_slug]) }}">{{$new->$multisp}}</a></h4>
                                                <p>
                                                    @if($new->promotion_price == 0)
                                                    <span class="price">{{number_format($new->unit_price,0,',','.')}} VNĐ</span>
                                                    @else
                                                    <span class="price">{{number_format($new->promotion_price,0,',','.')}} VNĐ</span>
                                                    <del class="prev-price">{{number_format($new->unit_price,0,',','.')}} VNĐ</del>
                                                    @endif
                                                </p>
                                                @if($new->promotion_price != 0)
                                                <div class="label-product l_sale">{{number_format(100-($new->promotion_price/$new->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                                                @endif
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($new->product_quantity>0)
                                                    <a @if(Auth::check()) href="{{route('themgiohang',$new->id)}}" @else href="{{route('dangnhap')}}" @endif title="Add to Cart"> + Add To Cart</a>
                                                    @else
                                                    <a class="disabled-link"> + Add To Cart</a>
                                                    @endif
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a style="cursor: pointer;" id="{{$new->id}}" onclick="add_wishList(this.id)"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        @if($new->promotion_price != 0)
                                        <span class="sticker-new">{{ trans('home.sale') }}</span>
                                        @endif
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                @endforeach
                                <!-- Double Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                        <!-- #newLaptop End Here -->
                        <!-- #topLaptop-1 Start Here -->
                        <div id="topLaptop-1" class="tab-pane fade">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="electronics-pro-active owl-carousel">
                                @foreach($top_product as $top)
                                <!-- Double Product Start -->
                                <div class="double-product">
                                    <!-- Single Product Start -->
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{ route( 'chitietsanpham',['id'=> $top->id, 'product_slug'=>$top->product_slug]) }}">
                                                <img class="primary-img" src="source/image/product/{{$top->image}}" alt="single-product" height="276.45px">
                                                <img class="secondary-img" src="source/image/product/{{$top->image}}" alt="single-product" height="276.45px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$top->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{ route( 'chitietsanpham',['id'=> $top->id, 'product_slug'=>$top->product_slug]) }}">{{$top->$multisp}}</a></h4>
                                                <p>
                                                    @if($top->promotion_price == 0)
                                                    <span class="price">{{number_format($top->unit_price,0,',','.')}} VNĐ</span>
                                                    @else
                                                    <span class="price">{{number_format($top->promotion_price,0,',','.')}} VNĐ</span>
                                                    <del class="prev-price">{{number_format($top->unit_price,0,',','.')}} VNĐ</del>
                                                    @endif
                                                </p>
                                                @if($top->promotion_price != 0)
                                                <div class="label-product l_sale">{{number_format(100-($top->promotion_price/$top->unit_price)*100)}}<span class="symbol-percent"></span>%</div>
                                                @endif
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($top->product_quantity>0)
                                                    <a @if(Auth::check()) href="{{route('themgiohang',$top->id)}}" @else href="{{route('dangnhap')}}" @endif title="Add to Cart"> + Add To Cart</a>
                                                    @else
                                                    <a class="disabled-link"> + Add To Cart</a>
                                                    @endif
                                                </div>
                                                <div class="actions-secondary">
                                                    <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                    <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product Content End -->
                                        @if($top->promotion_price != 0)
                                        <span class="sticker-new">{{ trans('home.sale') }}</span>
                                        @endif
                                    </div>
                                    <!-- Single Product End -->
                                </div>
                                @endforeach
                                <!-- Double Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
        <!-- Arrivals Products Area Start Here -->
        <div class="second-arrivals-product pb-45 pb-sm-5">
            <div class="container">
                <div class="main-product-tab-area">
                    <div class="tab-menu mb-25">
                        <div class="section-ttitle">
                            <h2>{{ trans('home.topproduct') }}</h2>
                       </div>
                        <!-- Nav tabs -->
                        <ul class="nav tabs-area" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#topLaptop">Top </a>
                            </li>
                        </ul>                       

                    </div> 

                    <!-- Tab Contetn Start -->
                    <div class="tab-content">
                        <div id="topLaptop" class="tab-pane fade show active">
                            <!-- Arrivals Product Activation Start Here -->
                            <div class="best-seller-pro-active owl-carousel">
                                <!-- Single Product Start -->
                                @foreach($top_product as $top_pr)
                                <div class="single-product">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a href="{{ route( 'chitietsanpham',['id'=> $top_pr->id, 'product_slug'=>$top_pr->product_slug]) }}">
                                            <img class="primary-img" src="source/image/product/{{$top_pr->image}}" alt="single-product" height="154.8px">
                                            <img class="secondary-img" src="source/image/product/{{$top_pr->image}}" alt="single-product" height="154.8px">
                                        </a>
                                        <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$top_pr->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content">
                                        <div class="pro-info">
                                            <h4><a href="{{ route( 'chitietsanpham',['id'=> $top_pr->id, 'product_slug'=>$top_pr->product_slug]) }}">{{$top_pr->$multisp}}</a></h4>
                                            <p>
                                                @if($top_pr->promotion_price == 0)
                                                <span class="price">{{number_format($top_pr->unit_price,0,',','.')}} VNĐ</span>
                                                @else
                                                <span class="price">{{number_format($top_pr->promotion_price,0,',','.')}} VNĐ</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div class="pro-actions">
                                            <div class="actions-primary">
                                                @if($top_pr->product_quantity>0)
                                                <a @if(Auth::check()) href="{{route('themgiohang',$new->id)}}" @else href="{{route('dangnhap')}}" @endif title="Add to Cart"> + Add To Cart</a>
                                                @else
                                                <a class="disabled-link"> + Add To Cart</a>
                                                @endif
                                            </div>
                                            <div class="actions-secondary">
                                                <a href="compare.html" title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                                <a href="wishlist.html" title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                @endforeach
                                <!-- Single Product End -->
                            </div>
                            <!-- Arrivals Product Activation End Here -->
                        </div>
                        <!-- #electronics End Here -->
                    </div>
                    <!-- Tab Content End -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Arrivals Products Area End Here -->
        <!-- Like Products Area Start Here -->
        <div class="like-product ptb-95 off-white-bg pt-sm-50 pb-sm-55 ">
            <div class="container">
                <div class="like-product-area"> 
                    <h2 class="section-ttitle2 mb-30">You May Like </h2>
                    <!-- Arrivals Product Activation Start Here -->
                    <div>
                        <!-- Double Product Start -->
                        <!-- @foreach($top_product as $top) -->
                        <div class="double-product" id="single_product_like" style="height: 100%;
                        overflow: hidden; width: 100%; ">
                            <!-- Single Product Start -->
                            
                            <!-- Single Product End -->
                        </div>   
                        <!-- @endforeach                   -->
                    </div>
                    <!-- Arrivals Product Activation End Here -->
                </div>
                <!-- main-product-tab-area-->
            </div>
            <!-- Container End -->
        </div>
        <!-- Lile Products Area End Here -->
        <!-- Brand Banner Area Start Here -->
        <div class="main-brand-banner pt-95 pb-100 pt-sm-55 pb-sm-60">
            <div class="container">
                <div class="section-ttitle mb-20">
                    <h2>Best Seller</h2>
               </div>
                <div class="row no-gutters">
                    <div class="col-lg-3">
                        <div class="col-img">
                            <img src="{{asset('source/assets/frontend/img/banner/h1-band1.jpg')}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <!-- Brand Banner Start -->
                        <div class="brand-banner owl-carousel">
                            <div class="single-brand">
                                <a href="#"><img class="img" src="{{asset('source/assets/frontend/img/brand/1.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img class="img" src="{{asset('source/assets/frontend/img/brand/1.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/1.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>

                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                            </div>
                            <div class="single-brand">
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/2.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/3.jpg')}}" alt="brand-image"></a>
                                <a href="#"><img src="{{asset('source/assets/frontend/img/brand/4.jpg')}}" alt="brand-image"></a>
                            </div>
                        </div>
                        <!-- Brand Banner End -->                        

                    </div>
                    <div class="col-lg-3">
                        <div class="col-img">
                            <img src="{{asset('source/assets/frontend/img/banner/h1-band2.jpg')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container End -->
        </div>
        <!-- Brand Banner Area End Here -->
        <div class="big-banner pb-100 pb-sm-60">
            <div class="container big-banner-box">
                <div class="col-img">
                    <a href="#">
                    <img src="{{asset('source/assets/frontend/img/banner/5.jpg')}}" alt="">
                    </a>
                </div>
                <div class="col-img">
                    <a href="#">
                    <img src="{{asset('source/assets/frontend/img/banner/h1-banner3.jpg')}}" alt="">
                    </a>
                </div>
            </div>
            <!-- Container End -->
        </div>
        @include('FrontEnd.Footer')
    </div>
    <!-- Main Wrapper End Here -->

    @include('FrontEnd.Style.Script')

</body>

</html>