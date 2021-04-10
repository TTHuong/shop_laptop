 @extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_coupon') }} / {{ trans('home.up_date') }}
@endsection
 @section('content-ad')    

<h1 class="h3 mb-2 text-gray-800">{{ trans('home.up_date') }}</h1><br>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"><a href="{{route('quanlycoupon')}}">
            <button class="btn btn-primary"  type="button">
                <i class="fas fa-reply-all" aria-hidden="true"></i> {{ trans('home_ad.return') }}
            </button></a><br>
        </div>
        <div class="card-body">
           <form action="{{route('update_coupon', $update_coupon->coupon_id)}}" method="post">
                @csrf

                @if(count($errors)>0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $err)
                    {{$err}}<br>
                    @endforeach
                </div>
                @endif
                @if(Session::has('thongbao'))
                    <div class="alert alert-success alert-dismissible" role="alert">{{Session::get('thongbao')}}</div> 
                @endif

                <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.namecoupon') }}</label>
                            <input type="text" id="coupon_name" name="coupon_name" class="form-control" value="{{$update_coupon->coupon_name}}"  />

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.qtycoupon') }}</label>
                            <input type="text" id="coupon_time" name="coupon_time" class="form-control" multiple value="{{$update_coupon->coupon_time}}"/>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Ngày Bắt Đầu</label>
                            <input type="text" id="coupon_date_start" name="coupon_date_start" class="form-control" multiple value="{{$update_coupon->coupon_date_start}}"/>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Ngày Kết Thúc</label>
                            <input type="text" id="coupon_date_end" name="coupon_date_end" class="form-control" multiple value="{{$update_coupon->coupon_date_end}}"/>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.sophamtram') }}</label>
                            <input type="text" id="coupon_number" name="coupon_number" class="form-control" multiple value="{{$update_coupon->coupon_number}}"/>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.codecoupon') }}</label>
                            <input type="text" id="coupon_code" name="coupon_code" class="form-control" multiple value="{{$update_coupon->coupon_code}}"/>
                        </div>
                        <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tinhnang') }}</label>
                            <select name="coupon_condition" class="form-control">
                                <option <?php if($update_coupon->coupon_condition==0)echo 'selected' ?> value="0">{{ trans('Ql_sp.tinhnangphantram') }}</option>
                                <option <?php if($update_coupon->coupon_condition==1)echo 'selected' ?> value="1">{{ trans('Ql_sp.tinhnangtien') }}</option>
                            </select>
                        </div>
                   
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
                        
                    </div>

                </div>
                
            </form>
        </div>
    </div>


@endsection

