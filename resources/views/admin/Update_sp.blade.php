@extends('admin/Admin')
 @section('title-ad')
     {{ trans('home_ad.ql_sp') }} / {{ trans('home.up_date') }}
@endsection
@section('content-ad')



        <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">{{ trans('home.up_date') }}</h1><br>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"><a href="{{route('quanlysanpham')}}">
            <button class="btn btn-primary"  type="button">
                <i class="fas fa-reply-all" aria-hidden="true"></i> {{ trans('home_ad.return') }}
            </button></a><br>
        </div>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        <div class="card-body">
            <form action="{{route('update_sp', $sp_update->id)}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="modal-body">
                    <div class="form-group">
<!--                         <label style="font-weight: bold; color: #000" >Name vi</label>
                        <input type="text" id="name_vi" name="name_vi" class="form-control" value="{{$sp_update->sp_vi}}" />
                        <label style="font-weight: bold; color: #000" >Name en</label>
                        <input type="text" id="name_en" name="name_en" class="form-control" value="{{$sp_update->sp_en}}" /> -->
                        <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.tensp') }} Vi</label>
                        <input type="text" id="sp_vi" name="sp_vi" class="form-control" value="{{$sp_update->sp_vi}}" onkeyup="ChangeToSlug();"/>
                        <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.tensp') }} En</label>
                        <input type="text" id="sp_en" name="sp_en" class="form-control" value="{{$sp_update->sp_en}}" />
                        <input type="hidden" id="slug" name="slug" class="form-control" value="{{$sp_update->product_slug}}" />
<!--                         <select name="name" class="form-control">
                            @foreach($nn as $key => $mt)
                                @if($mt->id_post == $sp_update->id_post)
                                    <option selected value="{{$mt->id_post}}">{{$mt->$multisp}}</option>
                                @else
                                    <option value="{{$mt->id_post}}">{{$mt->$multisp}}</option>
                                @endif
                            @endforeach
                        </select> -->


                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.mota') }}</label>
                        <textarea class="form-control" id="e_description" name="description" rows="5" cols="33">{{$sp_update->description}}</textarea>

                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.gia') }}</label>
                        <input type="text" id="e_unit_price" name="unit_price" class="form-control"  value="{{$sp_update->unit_price}}" />


                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.giauudai') }}</label>
                        <input type="text" id="e_promotion_price" name="promotion_price" class="form-control"  value="{{$sp_update->promotion_price}}" />
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.soluongdaban') }}</label>
                        <input type="text" id="product_soid" name="product_soid" class="form-control"  value="{{$sp_update->product_soid}}" />
                    </div>
                     <div class="form-group" style="font-weight: bold; color: #000">
                        <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.new_top') }}</label>
                        <select name="new" class="form-control">
                            <option value="1" <?php if($sp_update->new==1)echo 'selected' ?> >New</option>
                            <option value="0" <?php if($sp_update->new==0)echo 'selected' ?> >Not New</option>
                        </select>
                    </div>
                    <div class="form-group" style="font-weight: bold; color: #000">
                        <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hieusp') }}</label>
                        <select name="type" class="form-control">
                            @foreach($type as $key => $tpe)
                                @if($tpe->id == $sp_update->id_type)
                                    <option selected value="{{$tpe->id}}">{{$tpe->name_type}}</option>
                                @else
                                    <option value="{{$tpe->id}}">{{$tpe->name_type}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000" >Date Sake</label>
                        <input type="text" id="date_sale_product" name="date_sale" class="form-control"  value="{{$sp_update->date_sale}}"/>
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000" >Hours Sake</label><br>
                        <input type="text" id="hours_sale" name="hours_sale" class="form-control" value="{{$sp_update->hours_sale}}" />
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                        <input type="file" id="e_image" name="image" class="form-control" multiple accept="image/*"/><br>
                        <img src="source/image/product/{{$sp_update->image}}" alt="" width="200px">
                    </div>

                </div>
                <div class="modal-footer">
                    
                    <button type="submit"  class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
                   

                </div>
            </form>
        </div>
    </div>

@endsection
           