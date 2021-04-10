@extends('Layout')
@section('title')    
    {{ trans('home.producttt') }}
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">Home</a></li>
                <li><a href="#">Product</a></li>
                <li class="active"><a href="{{$url_canonical}}">{{$sanpham->$multisp}}</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- Product Thumbnail Start -->
<div class="main-product-thumbnail ptb-100 ptb-sm-60">
    <div class="container">
        <div class="thumb-bg">
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5 mb-all-40">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane fade show active">
                            <a data-fancybox="images" href="source/image/product/{{$sanpham->image}}"><img src="source/image/product/{{$sanpham->image}}" alt="product-view" height="452.5px" width="452.5px"></a>
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->
                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail mt-15">
                        <div class="thumb-menu owl-carousel nav tabs-area" role="tablist">
                            <a class="active" data-toggle="tab" href="#thumb1"><img src="source/image/product/{{$sanpham->image}}" alt="product-thumbnail" height="138.83px" width="138.82px"></a>
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">{{$sanpham->$multisp}}</h3>
                        <div class="rating-summary fix mtb-10">
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="rating-feedback">
                                <a href="#">(1 review)</a>
                                <a href="#">add to your review</a>
                            </div>
                        </div>
                        <div class="pro-price mtb-30">
                            <p class="d-flex align-items-center">
                            	
                            	@if($sanpham->promotion_price == 0)
                            	<span class="price">{{number_format($sanpham->unit_price,0,',','.')}} VNĐ</span>
                            	@else
                            	<span class="prev-price">{{number_format($sanpham->unit_price,0,',','.')}} VNĐ</span>
                            	<span class="price">{{number_format($sanpham->promotion_price,0,',','.')}} VNĐ</span><span class="saving-price">save {{number_format(100-($sanpham->promotion_price/$sanpham->unit_price)*100)}} %</span>
                            	@endif
                            </p>
                        </div>
                        <div class="color clearfix mb-20">
                            <label>color</label>
                            <ul class="color-list">
                                <li>
                                    <a class="orange active" href="#"></a>
                                </li>
                                <li>
                                    <a class="paste" href="#"></a>
                                </li>
                            </ul>
                        </div>
                        <div class="box-quantity d-flex hot-product2">
                            <div class="pro-actions">
                                <div class="actions-primary">
                                	@if($sanpham->product_quantity>0)
                                    <a @if(Auth::check()) href="{{route('themgiohang',$sanpham->id)}}" @else href="{{route('dangnhap')}}" @endif title="" data-original-title="Add to Cart"> + Add To Cart</a>
                                	@else
                                    <a class="disabled-link"> + Add To Cart</a>
	                            	@endif
                                </div>
                                <div class="actions-secondary">
                                    <a href="compare.html" title="" data-original-title="Compare"><i class="lnr lnr-sync"></i> <span>Add To Compare</span></a>
                                    <a href="wishlist.html" title="" data-original-title="WishList"><i class="lnr lnr-heart"></i> <span>Add to WishList</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="pro-ref mt-20">
                            <p>
                            	@if($sanpham->product_quantity>0)
                            	<span class="in-stock"><i class="ion-checkmark-round"></i> IN STOCK</span>
                            	@else
                            	<span class="out-stock"><i class="ion-close"></i> OUT OF STOCK</span>
                            	@endif
                            </p>
                        </div>
                        <div class="socila-sharing mt-25">
                            <ul class="d-flex">
                                <li>Share</li>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"><i class="fa fa-facebook share" aria-hidden="true"></i></a></li>
                                <li><a href="http://twitter.com/share?url={{$url_canonical}}"><i class="fa fa-twitter share" aria-hidden="true"></i></a></li>
                                <li><a href="https://plus.google.com/share?url={{$url_canonical}}"><i class="fa fa-google-plus-official share" aria-hidden="true"></i></a></li>
                                <li><a href="http://pinterest.com/pin/create/button/?url={{$url_canonical}}&description={{$sanpham->description}}&media={{$image_og}}"><i class="fa fa-pinterest-p share" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail End -->
<!-- Product Thumbnail Description Start -->
<div class="thumnail-desc pb-100 pb-sm-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <ul class="main-thumb-desc nav tabs-area" role="tablist">
                    <li><a class="active" data-toggle="tab" href="#dtail">{{ trans('home.deption') }}</a></li>
                    <li><a data-toggle="tab" href="#review">Reviews (1)</a></li>
                </ul>
                <!-- Product Thumbnail Tab Content Start -->
                <div class="tab-content thumb-content border-default">
                    <div id="dtail" class="tab-pane fade show active">
                        <p>{!! $sanpham->description !!}</p>
                    </div>
                    <div id="review" class="tab-pane fade">
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding">
                            <div class="group-title">
                                <h2>customer review</h2>
                            </div>
                            <h4 class="review-mini-title">Truemart</h4>
                            <ul class="review-list">
                                <!-- Single Review List Start -->
                                <li>
                                    <span>Quality</span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <label>Truemart</label>
                                </li>
                                <!-- Single Review List End -->
                                <!-- Single Review List Start -->
                                <li>
                                    <span>price</span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <label>Review by <a href="https://themeforest.net/user/hastech">Truemart</a></label>
                                </li>
                                <!-- Single Review List End -->
                                <!-- Single Review List Start -->
                                <li>
                                    <span>value</span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <label>Posted on 7/20/18</label>
                                </li>
                                <!-- Single Review List End -->
                            </ul>
                        </div>
                        <!-- Reviews End -->
                        <!-- Reviews Start -->
                        <div class="review border-default universal-padding mt-30">
                            <h2 class="review-title mb-30">You're reviewing: <br><span>Faded Short Sleeves T-shirt</span></h2>
                            <p class="review-mini-title">your rating</p>
                            <ul class="review-list">
                                <!-- Single Review List Start -->
                                <li>
                                    <span>Quality</span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <!-- Single Review List End -->
                                <!-- Single Review List Start -->
                                <li>
                                    <span>price</span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <!-- Single Review List End -->
                                <!-- Single Review List Start -->
                                <li>
                                    <span>value</span>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </li>
                                <!-- Single Review List End -->
                            </ul>
                            <!-- Reviews Field Start -->
                            <div class="riview-field mt-40">
                                <form autocomplete="off" action="#">
                                	<div class="fb-comments" data-href="{{$url_canonical}}" data-width="750" data-numposts="10" data-lazy="false"></div>
                                </form>
                            </div>
                            <!-- Reviews Field Start -->
                        </div>
                        <!-- Reviews End -->
                    </div>
                </div>
                <!-- Product Thumbnail Tab Content End -->
            </div>
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Product Thumbnail Description End -->
<!-- Realted Products Start Here -->
<div class="hot-deal-products off-white-bg pt-100 pb-90 pt-sm-60 pb-sm-50">
    <div class="container">
       <!-- Product Title Start -->
       <div class="post-title pb-30">
           <h2>{{ trans('home.otherproduct') }}</h2>
       </div>
       <!-- Product Title End -->
        <!-- Hot Deal Product Activation Start -->
        <div class="hot-deal-active owl-carousel">
            <!-- Single Product Start -->
            @foreach($tuongtu as $sptt)
            <div class="single-product">
                <!-- Product Image Start -->
                <div class="pro-img">
                    <a href="{{route('chitietsanpham',['id'=> $sptt->id, 'product_slug'=>$sptt->product_slug])}}">
                        <img class="primary-img" src="source/image/product/{{$sptt->image}}" alt="single-product" height="226px" width="226px">
                        <img class="secondary-img" src="source/image/product/{{$sptt->image}}" alt="single-product" height="226px" width="226px">
                    </a>
                    <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$sptt->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                </div>
                <!-- Product Image End -->
                <!-- Product Content Start -->
                <div class="pro-content">
                    <div class="pro-info">
                        <h4><a href="product.html">{{$sptt->$multisp}}</a></h4>
                        @if($sptt->promotion_price == 0)
                        <p><span class="price">{{number_format($sptt->unit_price,0,',','.')}} VNĐ</span></p>
                        @else
                        <p><span class="price">{{number_format($sptt->promotion_price,0,',','.')}} VNĐ</span></p>
                        @endif
                    </div>
                    <div class="pro-actions">
                        <div class="actions-primary">
                            @if($sptt->product_quantity>0)
                            <a @if(Auth::check()) href="{{route('themgiohang',$sptt->id)}}" @else data-toggle="modal" data-target="#staticBackdrop" @endif title="Add to Cart"> + Add To Cart</a>
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
                @if($sptt->promotion_price != 0)
                <span class="sticker-new">{{ trans('home.sale') }}</span>
                @endif
            </div>
            @endforeach
            <!-- Single Product End -->                        
        </div>                
        <!-- Hot Deal Product Active End -->

    </div>
    <!-- Container End -->
</div>
<!-- Realated Products End Here -->
@endsection