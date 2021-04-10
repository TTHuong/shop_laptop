@extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_coupon') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_coupon') }}</h6>
        </div>
        @if(count($errors)>0)
        <div class="alert alert-danger">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </div>
        @endif
        @if(Session::has('thongbao'))
            <div class="alert alert-success" style="width: 100%">{{Session::get('thongbao')}}</div> 
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-primary" data-toggle="modal"  data-target="#couponAdd" type="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                </button>
                <a href="{{url('/send-coupon')}}" class="btn btn-primary"><i class="fas fa-mail-bulk"></i> {{ trans('Ql_sp.guimagiamgia') }}</a><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.namecoupon') }}</th>
                            <th>{{ trans('Ql_sp.qtycoupon') }}</th>
                            <th>{{ trans('Ql_sp.sophamtram') }}</th>
                            <th>{{ trans('Ql_sp.codecoupon') }}</th>
                            <th>{{ trans('Ql_sp.tinhnang') }}</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Hạn Sử Dụng</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.namecoupon') }}</th>
                            <th>{{ trans('Ql_sp.qtycoupon') }}</th>
                            <th>{{ trans('Ql_sp.sophamtram') }}</th>
                            <th>{{ trans('Ql_sp.codecoupon') }}</th>
                            <th>{{ trans('Ql_sp.tinhnang') }}</th>
                            <th>Ngày Bắt Đầu</th>
                            <th>Ngày Kết Thúc</th>
                            <th>Hạn Sử Dụng</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <br>
                    <tbody style="text-align: center;">
                    @foreach($coupon as $key => $cp)
                       <tr>
                            <td>{{$key++}}</td>
                            <td>{{$cp->coupon_name }}</td>
                            <td>{{$cp->coupon_time }}</td>
                            <td>
                                @if($cp->coupon_condition == 0)
                                    Giảm {{$cp->coupon_number }}%
                                @else
                                    Giảm {{number_format($cp->coupon_number,0,',','.') }} VNĐ
                                @endif
                            </td>
                            <td>{{$cp->coupon_code }}</td>
                            <td>
                                @if($cp->coupon_condition == 0)
                                    <a href="{{url('/active-money/'.$cp->coupon_id)}}"><span class="fas fa-percent"></span></a>
                                @else
                                    <a href="{{url('/active-percent/'.$cp->coupon_id)}}"><span style="color: #e74a3b;" class="far fa-money-bill-alt"></span></a>
                                @endif
                            </td>
                            <td>{{$cp->coupon_date_start }}</td>
                            <td>{{$cp->coupon_date_end }}</td>
                            <td>
                                 @if($cp->coupon_date_end >= $today)
                                    <span style="color: #4e73df; font-weight: bold;">Còn Hạn</span>
                                 @else
                                    <span style="color: #e74a3b; font-weight: bold;">Hết Hạn</span>
                                 @endif
                            </td>
                            <td>
                                @if($cp->coupon_status == 0)
                                <a href="{{url('/unactive-coupon/'.$cp->coupon_id )}}"><span class="fas fa-eye"></span></a>
                                @else
                                <a href="{{url('/active-coupon/'.$cp->coupon_id )}}"><span style="color: #e74a3b;" class="fas fa-eye-slash"></span></a>
                                @endif
                            </td>
                            <td>
                                <!-- <a href="{{route('update_coupon', $cp->coupon_id  )}}"> -->
                                    <button class="btn btn-primary edit" data-toggle="modal" data-target="#couponUpdate_{{$cp->coupon_id}}" type="button"><i class="fas fa-edit"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deletecoupon', $cp->coupon_id  )}}"> -->
                                <button class="btn btn-danger delete" data-toggle="modal" data-target="#couponDel_{{$cp->coupon_id}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>
                       
                            <!-- Modal Delete-->
                            <div class="modal fade" id="couponDel_{{$cp->coupon_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$cp->coupon_id}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                              
                                            <form method="" action="{{route('deletecoupon', $cp->coupon_id  )}}">
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Update  -->
                            <div class="modal fade" id="couponUpdate_{{$cp->coupon_id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <input type="hidden" name="coupon_product_id" value="{{$cp->coupon_id}}">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_coupon', $cp->coupon_id)}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.namecoupon') }}</label>
                                                    <input type="text" id="coupon_name_{{$cp->coupon_id}}" name="coupon_name" class="form-control" value="{{$cp->coupon_name}}" />

                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.qtycoupon') }}</label>
                                                    <input type="text" id="coupon_time_{{$cp->coupon_id}}" name="coupon_time" class="form-control" multiple value="{{$cp->coupon_time}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">Ngày Bắt Đầu</label>
                                                    <input type="text" id="coupon_date_start_{{$cp->coupon_id}}" name="coupon_date_start" class="form-control" multiple value="{{$cp->coupon_date_start}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">Ngày Kết Thúc</label>
                                                    <input type="text" id="coupon_date_end_{{$cp->coupon_id}}" name="coupon_date_end" class="form-control" multiple value="{{$cp->coupon_date_end}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.codecoupon') }}</label>
                                                    <input type="text" id="coupon_code_{{$cp->coupon_id}}" name="coupon_code" class="form-control" multiple value="{{$cp->coupon_code}}"/>
                                                </div>
                                                <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tinhnang') }}</label>
                                                    <select name="coupon_condition" class="form-control">
                                                        <option <?php if($cp->coupon_condition==0)echo 'selected' ?> value="0">{{ trans('Ql_sp.tinhnangphantram') }}</option>
                                                        <option <?php if($cp->coupon_condition==1)echo 'selected' ?> value="1">{{ trans('Ql_sp.tinhnangtien') }}</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.sophamtram') }}</label>
                                                    <input type="text" id="coupon_number_{{$cp->coupon_id}}" name="coupon_number" class="form-control" multiple value="{{$cp->coupon_number}}"/>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                                                <button type="submit"  class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

            <!-- Modal Add-->
    <div class="modal fade" id="couponAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewcoupon')}}" method="post">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.namecoupon') }}</label>
                            <input type="text" id="coupon_name" name="coupon_name" class="form-control"  />

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.qtycoupon') }}</label>
                            <input type="text" id="coupon_time" name="coupon_time" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Ngày Bắt Đầu</label>
                            <input type="text" id="coupon_date_start" name="coupon_date_start" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">Ngày Kết Thúc</label>
                            <input type="text" id="coupon_date_end" name="coupon_date_end" class="form-control" multiple />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.codecoupon') }}</label>
                            <input type="text" id="coupon_code" name="coupon_code" class="form-control" multiple />
                        </div>
                        <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tinhnang') }}</label>
                            <select name="coupon_condition" class="form-control">
                                <option value="0">{{ trans('Ql_sp.tinhnangphantram') }}</option>
                                <option value="1">{{ trans('Ql_sp.tinhnangtien') }}</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.sophamtram') }}</label>
                            <input type="text" id="coupon_number" name="coupon_number" class="form-control" multiple />
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                        <button type="submit"  class="btn btn-primary"><i class="icofont icofont-check-circled"></i>Add</button>

                    </div>
                </form>
            </div>
        </div>
    </div> 


@endsection