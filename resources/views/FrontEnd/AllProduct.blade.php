@extends('Layout')
@section('title')    
All Product
@endsection
@section('content-layout')
<!-- Breadcrumb Start -->
<div class="breadcrumb-area mt-30">
    <div class="container">
        <div class="breadcrumb">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('trang-chu')}}">{{ trans('home.home') }}</a></li>
                <li class="active"><a href="{{$url_canonical}}">Product</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
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
                    <style type="text/css">
                        .style-range p {
                            float: left;
                            width: 37%;
                        }
                    </style>
                    <div class="search-filter mb-40">
                        <h3 class="sidebar-title">filter by price</h3>
                        <form class="sidbar-style">
                            <div id="slider-range"></div>
                            <div class="style-range">
                                <p><input type="text" id="amount_start" class="amount-range" ></p>
                                <p><input type="text" id="amount_end" class="amount-range" ></p>
                            </div>
                            
                            
                            <input type="hidden" id="start_price" name="start_price">
                            <input type="hidden" id="end_price" name="end_price">
                            <div class="clearfix"></div>
                            <input type="submit" name="filter_price" class="btn btn-default" value="Filter">
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
                                            <span class="price">{{number_format($new_pr->unit_price,0,',','.')}} VNĐ</span>
                                            @else
                                            <span class="price">{{number_format($new_pr->promotion_price,0,',','.')}} VNĐ</span>
                                            <del class="prev-price">{{number_format($new_pr->unit_price,0,',','.')}} VNĐ</del>
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
                        <div class="toolbar-sorter d-flex align-items-center" >
                            <label>Sort By:</label>
                            <form style="width: 165.66px;">
                            @csrf
                            <select class="sorter wide" id="sort">
                                @if(isset($_GET['sort_by'])){
                                    {{$sort_by = $_GET['sort_by']}}
                                    @if($sort_by=='giam_dan')
                                    <option style="vertical-align: middle;" value="{{Request::url()}}">----- Filter By -----</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_az">Neme, A to Z</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_za">Neme, Z to A</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan">Price low to heigh</option>
                                    <option selected value="{{Request::url()}}?sort_by=giam_dan">Price heigh to low</option>
                                    @elseif($sort_by=='tang_dan')
                                    <option style="vertical-align: middle;" value="{{Request::url()}}">----- Filter By -----</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_az">Neme, A to Z</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_za">Neme, Z to A</option>
                                    <option selected value="{{Request::url()}}?sort_by=tang_dan">Price low to heigh</option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan">Price heigh to low</option>
                                    @elseif($sort_by=='kytu_az')
                                    <option style="vertical-align: middle;" value="{{Request::url()}}">-----Filter By-----</option>
                                    <option selected value="{{Request::url()}}?sort_by=kytu_az">Neme, A to Z</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_za">Neme, Z to A</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan">Price low to heigh</option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan">Price heigh to low</option>
                                    @elseif($sort_by=='kytu_za')
                                    <option style="vertical-align: middle;" value="{{Request::url()}}">----- Filter By -----</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_az">Neme, A to Z</option>
                                    <option selected value="{{Request::url()}}?sort_by=kytu_za">Neme, Z to A</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan">Price low to heigh</option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan">Price heigh to low</option>
                                    @else
                                    <option style="vertical-align: middle;" selected value="{{Request::url()}}">--- Filter By ---</option>
                                    <option value="{{Request::url()}}?sort_by=kytu_az">Neme, A to Z</option>
                                    <option  value="{{Request::url()}}?sort_by=kytu_za">Neme, Z to A</option>
                                    <option value="{{Request::url()}}?sort_by=tang_dan">Price low to heigh</option>
                                    <option value="{{Request::url()}}?sort_by=giam_dan">Price heigh to low</option>
                                    @endif
                                @else
                                <option style="vertical-align: middle;" selected value="{{Request::url()}}">----- Filter By -----</option>
                                <option value="{{Request::url()}}?sort_by=kytu_az">Neme, A to Z</option>
                                <option  value="{{Request::url()}}?sort_by=kytu_za">Neme, Z to A</option>
                                <option value="{{Request::url()}}?sort_by=tang_dan">Price low to heigh</option>
                                <option value="{{Request::url()}}?sort_by=giam_dan">Price heigh to low</option>
                                @endif

                            </select>
                            </form>
                        </div>
                    </div>
                    <!-- Toolbar Short Area End -->
                    <!-- Toolbar Short Area Start -->
                    <form method="post" action="">
                        @csrf
                        <div class="main-toolbar-sorter clearfix">
                            <div class="toolbar-sorter d-flex align-items-center">
                                <label>Show:</label>
                                <select class="sorter wide show_product" name="show_product" id="show_product">
                                    <!-- <option value="0">---Choose---</option> -->
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <!-- Toolbar Short Area End -->
                </div>
                <!-- Grid & List View End -->
                @if(count($tacca_sanpham) > 0)
                <div class="main-categorie mb-all-40">
                    <!-- Grid & List Main Area End -->
                    <div class="tab-content fix">
                        <div id="grid-view" class="tab-pane fade show active">
                            <div class="row">
                                <!-- Single Product Start -->
                                @foreach($tacca_sanpham as $all_pro)
                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                    <div class="single-product">
                                        <!-- Product Image Start -->
                                        <div class="pro-img">
                                            <a href="{{route('chitietsanpham',['id'=> $all_pro->id, 'product_slug'=>$all_pro->product_slug])}}">
                                                <img class="primary-img" src="source/image/product/{{$all_pro->image}}" alt="single-product" height="268px" width="268px">
                                                <img class="secondary-img" src="source/image/product/{{$all_pro->image}}" alt="single-product" height="268px" width="268px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$all_pro->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                        </div>
                                        <!-- Product Image End -->
                                        <!-- Product Content Start -->
                                        <div class="pro-content">
                                            <div class="pro-info">
                                                <h4><a href="{{route('chitietsanpham',['id'=> $all_pro->id, 'product_slug'=>$all_pro->product_slug])}}">{{$all_pro->$multisp}}</a></h4>
                                                <p>
                                                    @if($all_pro->promotion_price == 0)
                                                    <span class="price">{{number_format($all_pro->unit_price,0,',','.')}} VNĐ</span>
                                                    @else
                                                    <span class="price">{{number_format($all_pro->promotion_price,0,',','.')}} VNĐ</span>
                                                    <del class="prev-price">{{number_format($all_pro->unit_price,0,',','.')}} VNĐ</del>
                                                    @endif
                                                </p>
                                                @if($all_pro->promotion_price != 0)
                                                <div class="label-product l_sale">{{number_format(100-($all_pro->promotion_price/$all_pro->unit_price)*100)}}<span class="symbol-percent">%</span></div>
                                                @endif
                                            </div>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($all_pro->product_quantity>0)
                                                    <a @if(Auth::check()) href="{{route('themgiohang',$all_pro->id)}}" @else href="{{route('dangnhap')}}" @endif title="Add to Cart"> + Add To Cart</a>
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
                            @foreach($tacca_sanpham as $all_pro)
                            <div class="single-product"> 
                                <div class="row">        
                                    <!-- Product Image Start -->
                                    <div class="col-lg-4 col-md-5 col-sm-12">
                                        <div class="pro-img">
                                            <a href="{{route('chitietsanpham',['id'=> $all_pro->id, 'product_slug'=>$all_pro->product_slug])}}">
                                                <img class="primary-img" src="source/image/product/{{$all_pro->image}}" alt="single-product" height="270px" width="270px">
                                                <img class="secondary-img" src="source/image/product/{{$all_pro->image}}" alt="single-product" height="270px" width="270px">
                                            </a>
                                            <a href="#" class="quick_view" data-toggle="modal" data-target="#myModal_{{$all_pro->id}}" title="Quick View"><i class="lnr lnr-magnifier"></i></a>
                                             @if($all_pro->promotion_price != 0)
                                             <span class="sticker-new">{{ trans('home.sale') }}</span>
                                             @endif
                                        </div>
                                    </div>
                                    <!-- Product Image End -->
                                    <!-- Product Content Start -->
                                    <div class="col-lg-8 col-md-7 col-sm-12">
                                        <div class="pro-content hot-product2">
                                            <h4><a href="{{route('chitietsanpham',['id'=> $all_pro->id, 'product_slug'=>$all_pro->product_slug])}}">{{$all_pro->$multisp}}</a></h4>
                                            <p>
                                                @if($all_pro->promotion_price == 0)
                                                <span class="price">{{number_format($all_pro->unit_price,0,',','.')}} VNĐ</span>
                                                @else
                                                <span class="price">{{number_format($all_pro->promotion_price,0,',','.')}} VNĐ</span>
                                                @endif
                                            </p>
                                            <p>{!! $all_pro->description !!}</p>
                                            <div class="pro-actions">
                                                <div class="actions-primary">
                                                    @if($all_pro->product_quantity>0)
                                                    <a @if(Auth::check()) href="{{route('themgiohang',$all_pro->id)}}" @else href="{{route('dangnhap')}}" @endif title="" data-original-title="Add to Cart"> + Add To Cart</a>
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
                        {!! $tacca_sanpham->render('FrontEnd.name')  !!}

                        </div>
                        <!-- Product Pagination Info -->
                    </div>
                    <!-- Grid & List Main Area End -->
                </div>
                @endif
            </div>
            <!-- product Categorie List End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->
@endsection