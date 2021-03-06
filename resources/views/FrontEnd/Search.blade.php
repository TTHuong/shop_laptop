@extends('Layout')
@section('title')    
Search
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">{{ trans('home.home') }}</a></li>
                <li class="active"><a href="{{$url_canonical}}">Search</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page Start -->
<div class="main-shop-page pt-100 pb-100 ptb-sm-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
            <!-- Sidebar Shopping Option Start -->
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="sidebar">
                    <!-- Sidebar Electronics Categorie Start -->
                    <div class="electronics mb-40">
                        <h3 class="sidebar-title">Type</h3>
                        <div id="shop-cate-toggle" class="category-menu sidebar-menu sidbar-style">
                            <ul>
                                @foreach($loai_sanpham as $sl)
                                <li>
                                    <a href="{{route('loaisanpham',$sl->id)}}">{{$sl->name_type}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- category-menu-end -->
                    </div>
                    <!-- Sidebar Electronics Categorie End -->
                    <!-- Price Filter Options Start -->
                    <div class="search-filter mb-40">
                        <h3 class="sidebar-title">filter by price</h3>
                        <form action="#" class="sidbar-style">
                            <div id="slider-range"></div>
                            <input type="text" id="amount" class="amount-range" readonly>
                        </form>
                    </div>
                    <!-- Price Filter Options End -->
                    <!-- Sidebar Categorie Start -->
                    <div class="sidebar-categorie mb-40">
                        <h3 class="sidebar-title">categories</h3>
                        <ul class="sidbar-style">
                            <li class="form-check">
                                <input class="form-check-input" value="#" id="camera" type="checkbox">
                                <label class="form-check-label" for="camera">Cameras (8)</label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input" value="#" id="GamePad" type="checkbox">
                                <label class="form-check-label" for="GamePad">GamePad (8)</label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input" value="#" id="Digital" type="checkbox">
                                <label class="form-check-label" for="Digital">Digital Cameras (8)</label>
                            </li>
                            <li class="form-check">
                                <input class="form-check-input" value="#" id="Virtual" type="checkbox">
                                <label class="form-check-label" for="Virtual"> Virtual Reality (8) </label>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar Categorie Start -->
                    <!-- Product Top Start -->
                    <div class="top-new mb-40">
                        <h3 class="sidebar-title">Top New</h3>
                        <div class="side-product-active owl-carousel">
                            <!-- Side Item Start -->
                            <div class="side-pro-item">
                                <!-- Single Product Start -->
                                @foreach($sanpham_new as $new_pr)
                                <div class="single-product single-product-sidebar">
                                    <!-- Product Image Start -->
                                    <div class="pro-img">
                                        <a href="{{route('chitietsanpham',['id'=> $new_pr->id, 'product_slug'=>$new_pr->product_slug])}}">
                                            <img class="primary-img" src="source/image/product/{{$new_pr->image}}" alt="single-product" height="102.6px" width="102.6px">
                                            <img class="secondary-img" src="source/image/product/{{$new_pr->image}}" alt="single-product" height="102.6px" width="102.6px">
                                        </a>
                                        @if($new_pr->promotion_price != 0)
                                        <div class="label-product l_sale">{{number_format(100-($new_pr->promotion_price/$new_pr->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                                        @endif
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="pro-content">
                                        <h4><a href="{{route('chitietsanpham',['id'=> $new_pr->id, 'product_slug'=>$new_pr->product_slug])}}">{{$new_pr->$multisp}}</a></h4>
                                        <p>
                                            @if($new_pr->promotion_price == 0)
                                            <span class="price">{{number_format($new_pr->unit_price,0,',','.')}} VN??</span>
                                            @else
                                            <span class="price">{{number_format($new_pr->promotion_price,0,',','.')}} VN??</span>
                                            <del class="prev-price">{{number_format($new_pr->unit_price,0,',','.')}} VN??</del>
                                            @endif
                                        </p>
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                                @endforeach
                                <!-- Single Product End -->                                       
                            </div>
                            <!-- Side Item End -->
                        </div>
                    </div>
                    <!-- Product Top End -->                            
                    <!-- Single Banner Start -->
                    <div class="col-img">
                        <a href="#"><img src="{{asset('source/assets/frontend/img/banner/banner-sidebar.jpg')}}" alt="slider-banner"></a>
                    </div>
                    <!-- Single Banner End -->
                </div>
            </div>
            <!-- Sidebar Shopping Option End -->
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-1 order-lg-2">
                <!-- Grid & List View Start -->
                <div class="grid-list-top border-default universal-padding d-md-flex justify-content-md-between align-items-center mb-30">
                    <div class="grid-list-view  mb-sm-15">
                        <ul class="nav tabs-area d-flex align-items-center">
                            <li><a class="active" data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                            <li><a data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                        </ul>
                    </div>
                    <!-- Toolbar Short Area Start -->
                    <div class="main-toolbar-sorter clearfix">
                        <div class="toolbar-sorter d-flex align-items-center">
                            <label>Show:</label>
                            <select class="sorter wide" name="show">
                                <option value="12">12</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="75">75</option>
                                <option value="100">100</option>
                            </select>
                        </div>
                    </div>
                    <!-- Toolbar Short Area End -->
                </div>
                <!-- Grid & List View End -->
                <div class="main-categorie mb-all-40">
                    <!-- Grid & List Main Area End -->
                    <div class="tab-content fix">
                        <div id="grid-view" class="tab-pane fade show active">
                        	<div class="beta-products-details">
								<p class="pull-left">{{count($product)}} styles found</p>
								<div class="clearfix"></div>
							</div>
                            <div class="row">
                                <!-- Single Product Start -->
                                @foreach($product as $tksp)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{route('chitietsanpham',['id'=> $tksp->id, 'product_slug'=>$tksp->product_slug])}}">
                                                <img class="primary-img" src="source/image/product/{{$tksp->image}}" alt="single-product" height="268px" width="268px">
                                                <img class="secondary-img" src="source/image/product/{{$tksp->image}}" alt="single-product" height="268px" width="268px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$tksp->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{route('chitietsanpham',['id'=> $tksp->id, 'product_slug'=>$tksp->product_slug])}}">{{$tksp->$multisp}}</a></h4>
                                                <p>
                                                    @if($tksp->promotion_price == 0)
                                                    <span class="price">{{number_format($tksp->unit_price,0,',','.')}} VN??</span>
                                                    @else
                                                    <span class="price">{{number_format($tksp->promotion_price,0,',','.')}} VN??</span>
                                                    <del class="prev-price">{{number_format($tksp->unit_price,0,',','.')}} VN??</del>
                                                    @endif
                                                </p>
                                                @if($tksp->promotion_price != 0)
                                                <div class="label-product l_sale">{{number_format(100-($tksp->promotion_price/$tksp->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                                                @endif
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($tksp->product_quantity>0)
                                                    <a @if(Auth::check()) href="{{route('themgiohang',$tksp->id)}}" @else href="{{route('dangnhap')}}" @endif title="Add to Cart"> + Add To Cart</a>
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
                                </div>
                                @endforeach
                                <!-- Single Product End -->
                            </div>
                            <!-- Row End -->
                        </div>
                        <!-- #grid view End -->
                        <div id="list-view" class="tab-pane fade">
                            <!-- Single Product Start -->
                            @foreach($product as $tksp)
                            <div class="single-product"> 
                                <div class="row">        
                                    <!-- Product Image Start -->
                                    <div class="col-lg-4 col-md-5 col-sm-12">
                                        <div class="pro-img">
                                            <a href="{{route('chitietsanpham',['id'=> $tksp->id, 'product_slug'=>$tksp->product_slug])}}">
                                                <img class="primary-img" src="source/image/product/{{$tksp->image}}" alt="single-product" height="270px" width="270px">
                                                <img class="secondary-img" src="source/image/product/{{$tksp->image}}" alt="single-product" height="270px" width="270px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$tksp->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                             @if($tksp->promotion_price != 0)
                                             <span class="sticker-new">{{ trans('home.sale') }}</span>
                                             @endif
                                        </div>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="col-lg-8 col-md-7 col-sm-12">
                                        <div class="pro-content hot-product2">
                                            <h4><a href="{{route('chitietsanpham',['id'=> $tksp->id, 'product_slug'=>$tksp->product_slug])}}">{{$tksp->$multisp}}</a></h4>
                                            <p>
                                                @if($tksp->promotion_price == 0)
                                                <span class="price">{{number_format($tksp->unit_price,0,',','.')}} VN??</span>
                                                @else
                                                <span class="price">{{number_format($tksp->promotion_price,0,',','.')}} VN??</span>
                                                @endif
                                            </p>
                                            <p>{!! $tksp->description !!}</p>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($tksp->product_quantity>0)
                                                    <a @if(Auth::check()) href="{{route('themgiohang',$tksp->id)}}" @else href="{{route('dangnhap')}}" @endif title="" data-original-title="Add to Cart"> + Add To Cart</a>
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
                                    </div>
                                    <!-- Product Content End -->
                                </div>
                            </div>
                            @endforeach
                            <!-- Single Product End -->
                        </div>
                        <!-- #list view End -->
                    </div>
                    <!-- Grid & List Main Area End -->
                </div>
                
            </div>
            <!-- product Categorie List End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->
@endsection