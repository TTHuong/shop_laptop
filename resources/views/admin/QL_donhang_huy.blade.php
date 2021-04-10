 @extends('admin/Admin')

@section('title-ad')   
    {{ trans('home_ad.ql_dh') }}
@endsection

 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_dh') }} Hủy</h6>
        </div>
       
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT </th>
                            <th>{{ trans('Ql_sp.tenkh') }}</th>
                            <th>{{ trans('Ql_sp.gioitinh') }}</th>
                            <th>Email</th>
                            <!-- <th style="width: 15em;word-wrap:break-word;">Address</th> -->
                            <!-- <th>Phone Number</th> -->
                            
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                           <!--  <th>Created At </th>
                            <th>Total Money</th>
                            <th>Payment Methods</th>
                            <th>Note</th> -->
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT </th>
                            <th>{{ trans('Ql_sp.tenkh') }}</th>
                            <th>{{ trans('Ql_sp.gioitinh') }}</th>
                            <th>Email</th>
                            <!-- <th style="width: 15em;word-wrap:break-word;">Address</th> -->
                            <!-- <th>Phone Number</th> -->
                            
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                           <!--  <th>Created At </th>
                            <th>Total Money</th>
                            <th>Payment Methods</th>
                            <th>Note</th> -->
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($donhang_huy as $key => $dh)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$dh->name}}</td>
                            <td>{{$dh->gender}}</td>
                            <td>{{$dh->email}}</td>
                            <!-- <td style="width: 15em; word-wrap:break-word;">{{$dh->address}}</td> -->
                            <!-- <td>{{$dh->phone_number}}</td> -->
                            <td>
                                <?php
                                   if($dh->status_bill==1){
                                    ?>
                                    <span style="color: #1cc88a; font-weight: bold;"> Đang vận chuyển</span>
                                    <?php
                                     }elseif($dh->status_bill==0){
                                    ?>  
                                     <span style="color: #36b9cc; font-weight: bold;">Đang xử lý...</span>
                                    <?php
                                    }else{
                                    ?> 
                                    <a ><span style="color: #e74a3b; font-weight: bold;">Hủy đơn</span></a>
                                    <?php
                                   }
                                  ?>
                            </td>
                            <!-- <td>{{$dh->date_order}}</td>
                            <td>{{number_format($dh->total)}}</td>
                            <td>{{$dh->payment}}</td>
                            <td>{{$dh->note}}</td> -->

                            <td>
                                 <a href="{{route('donhangchitiet', $dh->id_bill)}}">
                                    <button class="btn btn-primary edit"  type="button">&nbsp;<i class="fas fa-info">&nbsp;</i></button>
                                </a><br><br>
                                <!-- <a href="{{route('deletedh', $dh->id_bill)}}"> -->
                                <button class="btn btn-danger delete" data-toggle="modal" data-target="#dhHuyDel_{{$dh->id_bill}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            <!-- Modal Delete-->
                            <div class="modal fade" id="dhHuyDel_{{$dh->id_bill}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$dh->id_bill}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ </button>
                                            
                                             <form method="" action="{{route('deletedh', $dh->id_bill)}}">

                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>                          
                                           
                                            
                                        </div>
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


@endsection