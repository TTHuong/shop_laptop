@extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_slide') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_slide') }}</h6>
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
                <button class="btn btn-primary" data-toggle="modal"  data-target="#slideAdd" type="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                </button><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>Url</th>
                            <th>{{ trans('Ql_sp.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>Url</th>
                            <th>{{ trans('Ql_sp.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.trangthai') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <br>
                    <tbody style="text-align: center;">
                    @foreach($slide as $key => $sl)
                       <tr>
                            <td>{{$key++}}</td>
                            <td>{{$sl->link }}</td>
                            <td><img src="source/image/slide/{{$sl->image}}" alt="" width="200px"></td>
                            <td>
                                <?php
                                   if($sl->status_slide==0){
                                    ?>
                                    <a href="{{url('/active-slide/'.$sl->id)}}"><span class="fas fa-eye"></span></a>
                                    <?php
                                     }else{
                                    ?>  
                                     <a href="{{url('/unactive-slide/'.$sl->id)}}"><span style="color: #e74a3b;" class="fas fa-eye-slash"></span></a>
                                    <?php
                                   }
                                  ?>
                            </td>

                            <td>
                                <!-- <a href="{{route('update_slide',$sl->id )}}"> -->
                                    <button class="btn btn-primary edit" data-toggle="modal" data-target="#slideUpdate_{{$sl->id}}" type="button"><i class="fas fa-edit"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deleteslide',$sl->id )}}"> -->
                                <button class="btn btn-danger delete" data-toggle="modal" data-target="#slideDel_{{$sl->id}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>
                            

                            <!-- Modal Delete-->
                            <div class="modal fade" id="slideDel_{{$sl->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$sl->id}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>

                                            <form method="" action="{{ route('deleteslide', $sl->id  )}}">
                                                
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update-->
                            <div class="modal fade" id="slideUpdate_{{$sl->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_slide', $sl->id )}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Url</label>
                                                    <input type="text" id="e_link_{{$sl->id}}" name="link_slide" class="form-control" value="{{$sl->link}}" />

                                                </div>
                                                <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.trangthai') }}</label>
                                                    <select name="status_slide" class="form-control">
                                                        <option value="0" <?php if($sl->status_slide==0)echo 'selected' ?> >Hiển Thị</option>
                                                        <option value="1" <?php if($sl->status_slide==1)echo 'selected' ?> >Ẩn</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                                                    <input type="file" id="e_image_{{$sl->id}}" name="image" class="form-control" multiple/><br>
                                                    <img src="source/image/slide/{{$sl->image}}" alt="" width="200px">
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
    <div class="modal fade" id="slideAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewslide')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Url</label>
                            <input type="text" id="e_link" name="link_slide" class="form-control"  />

                        </div>
                        <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.trangthai') }}</label>
                            <select name="status_slide" class="form-control">
                                <option value="0">Hiển Thị</option>
                                <option value="1">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                            <input type="file" id="e_image" name="image_file" class="form-control" multiple onchange="ImageFileUrl()"/>
                            <div id="displayimg"></div>
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