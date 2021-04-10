 @extends('admin/Admin')
 @section('title-ad')
    {{ trans('home_ad.ql_lang') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_lang') }}</h6>
        </div>
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
        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-primary" data-toggle="modal"  data-target="#nnAdd" type="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                </button><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('home.languagevi') }}</th>
                            <th>{{ trans('home.languageen') }}</th>
                            <th>Url</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                            
                        </tr>
                    </thead>
                    <tfoot style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('home.languagevi') }}</th>
                            <th>{{ trans('home.languageen') }}</th>
                            <th>Url</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>

                        </tr>
                    </tfoot>
                    <tbody style="text-align: center;">
                    @foreach($ngonngu as $key => $nnnn)
                       <tr>
                            <td>{{$key++}}</td>
                            <td>{{$nnnn->sp_vi}}</td>
                            <td>{{$nnnn->sp_en}}</td>
                            <td>{{$nnnn->product_slug}}</td>

                            <td>
                                <!-- <a href="{{route('update_lang',$nnnn->id_post)}}"> -->
                                    <button class="btn btn-primary edit" data-toggle="modal" data-target="#NnUpdate_{{$nnnn->id_post}}" type="button"><i class="fas fa-edit"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deletenn',$nnnn->id_post)}}"> -->
                                <button class="btn btn-danger delete" data-toggle="modal" data-target="#NnDel_{{$nnnn->id_post}}"  type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            <!-- Modal Del -->
                            <div class="modal fade" id="NnDel_{{$nnnn->id_post}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$nnnn->id_post}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                           
                                            <form method="" action="{{route('deletenn',$nnnn->id_post)}}">

                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update-->
                            <div class="modal fade" id="NnUpdate_{{$nnnn->id_post}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <input type="hidden" name="post_name_id_post" value="{{$nnnn->id_post}}">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_lang', $nnnn->id_post)}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Name Product_vi</label>
                                                    <input type="text" id="sp_vi_{{$nnnn->id_post}}" name="sp_vi" class="form-control" value="{{$nnnn->sp_vi}}" 
                                                    />

                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Name Product_en</label>
                                                    <input type="text" id="sp_en_{{$nnnn->id_post}}" name="sp_en" class="form-control"  value="{{$nnnn->sp_en}}"/>

                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Url</label>
                                                    <input type="text" id="slug_{{$nnnn->id_post}}" name="slug" class="form-control" value="{{$nnnn->product_slug}}" />
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
    <div class="modal fade" id="nnAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewnn')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Name Product_vi</label>
                            <input type="text" id="sp_vi" name="sp_vi" class="form-control"  onkeyup="ChangeToSlug();"/>

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Name Product_en</label>
                            <input type="text" id="sp_en" name="sp_en" class="form-control"  />

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Url</label>
                            <input type="text" id="slug" name="slug" class="form-control"/>
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