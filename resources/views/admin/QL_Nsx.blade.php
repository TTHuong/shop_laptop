 @extends('admin/Admin')
 @section('title-ad')
    {{ trans('home_ad.ql_nsx') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_nsx') }}</h6>
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
                <button class="btn btn-primary" data-toggle="modal"  data-target="#nsxAdd" type="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                </button><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.tenthuonghieu') }}</th>
                            <th>{{ trans('Ql_sp.ngaycapnhat') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.tenthuonghieu') }}</th>
                            <th>{{ trans('Ql_sp.ngaycapnhat') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <tbody style="text-align: center;">
                    @foreach($nsx as $key => $nsxx)
                       <tr>
                            <td>{{$key++}}</td>
                            <td>{{$nsxx->name_type}}</td>
                            <td>{{$nsxx->updated_at}}</td>

                            <td>
                                <!-- <a href="{{route('update_nsx', $nsxx->id )}}"> -->
                                    <button class="btn btn-primary edit" data-toggle="modal" data-target="#nsxUpdate_{{$nsxx->id}}" type="button"><i class="fas fa-edit"></i></button>
                                <!-- </a> -->
                                <!-- <a href="{{route('deletensx', $nsxx->id )}}"> -->
                                <button class="btn btn-danger delete" data-toggle="modal" data-target="#nsxDel_{{$nsxx->id}}"  type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            <!-- Modal Delete-->
                            <div class="modal fade" id="nsxDel_{{$nsxx->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$nsxx->id}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                          
                                            <form method="" action="{{route('deletensx', $nsxx->id )}}">
                                                
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Update-->
                            <div class="modal fade" id="nsxUpdate_{{$nsxx->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_nsx', $nsxx->id )}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.tenthuonghieu') }}</label>
                                                    <input type="text" id="e_name_{{$nsxx->id}}" name="name" class="form-control" value="{{$nsxx->name_type}}" />

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
    <div class="modal fade" id="nsxAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewnsx')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Manufacturers Name</label>
                            <input type="text" id="e_name" name="name" class="form-control"  />

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