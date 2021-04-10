@extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_tk') }}
@endsection

@section('content-ad')





<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_tk') }}</h6>

    </div>
    @if(Session::has('thongbao')) 
        <div class="alert alert-success" style="width: 100%">{{Session::get('thongbao')}}</div> 
    @endif

    <div class="card-body">
        <div class="table-responsive">
            <button class="btn btn-primary" data-toggle="modal" data-target="#userAdd" type="button">
                <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
            </button><br>
            <form>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.tenkh') }}</th>
                            <th>Email </th>
                            <th>{{ trans('Ql_sp.sdt') }}</th>
                            <th>{{ trans('Ql_sp.diachi') }}</th>
                            <th>{{ trans('Ql_sp.quyenhan') }}</th>
                            <!-- <th>{{ trans('Ql_sp.tenkh') }}</th> -->
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.tenkh') }}</th>
                            <th>Email </th>
                            <th>{{ trans('Ql_sp.sdt') }}</th>
                            <th>{{ trans('Ql_sp.diachi') }}</th>
                            <th>{{ trans('Ql_sp.quyenhan') }}</th>
                            <!-- <th>{{ trans('Ql_sp.tenkh') }}</th> -->
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <br>
                    <tbody style="text-align: center;">
                        @foreach($user as $key => $usr)
                        <tr>
                            <td>{{$key++}}</td>
                            <td>{{$usr->full_name}}</td>
                            <td>{{$usr->email}}</td>
                            <td>{{$usr->phone}}</td>
                            <td>{{$usr->address}}</td>
                            <td>
                                <?php
                                   if($usr->level==1){
                                    ?>
                                    <a href="{{url('/active-user/'.$usr->id)}}"><span class="fas fa-user-secret"></span></a>
                                    <?php
                                     }else{
                                    ?>  
                                     <a href="{{url('/unactive-user/'.$usr->id)}}"><span style="color: #e74a3b;" class="fas fa-user"></span></a>
                                    <?php
                                   }
                                  ?>
                            </td>
                            <!-- <td>{{$usr->updated_at}}</td> -->

<!--                             <td>
                                <a href="{{route('update_admin',$usr->id)}}" class="btn btn-primary edit" type="button"><i class="fas fa-edit"></i></a><br><br>

                                <a href="{{route('delete',$usr->id)}}">
                                <button class="btn btn-danger delete" type="button"><i class="fas fa-trash-alt"></i></button>

                                </a>
            

                            </td> -->
                             <td>
                                <!-- <a href="{{route('update_admin',$usr->id)}}"> -->
                                    <button class="btn btn-primary edit" data-toggle="modal" data-target="#alluserUpdate_{{$usr->id}}" type="button"><i class="fas fa-edit"></i></button>
                                <!-- </a><br><br> -->
                                <!-- <a href="{{route('delete',$usr->id)}}"> -->
                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#allDel_{{$usr->id}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            
                            <!-- Modal Delete-->
                            <div class="modal fade" id="allDel_{{$usr->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$usr->full_name}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                              
                                            <form method="" action="{{route('delete',$usr->id)}}">
                                                
                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Update-->
                            <div class="modal fade" id="alluserUpdate_{{$usr->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_admin', $usr->id)}}" method="post">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <input type="text" hidden class="col-sm-9 form-control" id="idUpdate_{{$usr->id}}" name="idUpdate" value="{{$usr->id}}" />
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
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tenkh') }}</label>
                                                    <input type="text" id="e_name_{{$usr->id}}" name="name" class="form-control" value="{{$usr->full_name}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.diachi') }}</label>
                                                    <input type="text" id="e_adress_{{$usr->id}}" required name="adress" class="form-control" value="{{$usr->address}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">Email</label>
                                                    <input type="text" id="e_email_{{$usr->id}}" required name="email" class="form-control" value="{{$usr->email}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.sdt') }}</label>
                                                    <input type="text" id="e_phone_{{$usr->id}}" required name="phone" class="form-control" value="{{$usr->phone}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">Password</label>
                                                    <input type="text" id="e_password_{{$usr->id}}" name="password" class="form-control" />
                                                </div>
                                                <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.quyenhan') }}</label>
                                                    <select name="level" class="form-control">
                                                        <option <?php if($usr->level==1)echo 'selected' ?> value="1">Administrator</option>
                                                        <option <?php if($usr->level==2)echo 'selected' ?> value="2">User</option>
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                                                <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </tr>
                        @endforeach
                    </tbody>
                    
                </table>

            </form>
        </div>
    </div>
 
</div>

<!-- Modal Add-->
<div class="modal fade" id="userAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-write">
                <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                </button>
            </div>
            <form action="{{route('addnew')}}" method="post">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <!-- <input type="text" hidden class="col-sm-9 form-control" id="idUpdate" name="idUpdate" value="" /> -->
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
                <div class="modal-body">
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">Full Name</label>
                        <input type="text" id="e_name" name="name" class="form-control" />

                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">Address</label>
                        <input type="text" id="e_adress" required name="adress" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">Email address</label>
                        <input type="text" id="e_email" required name="email" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">Phone</label>
                        <input type="text" id="e_phone" required name="phone" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">Password</label>
                        <input type="password" id="e_password" required name="password" class="form-control" />
                    </div>
                    <div class="form-group">
                        <label style="font-weight: bold; color: #000">Re password</label>
                        <input type="password" id="e_re_password" required name="re_password" class="form-control" />
                    </div>
                    <div class="form-group" style="font-weight: bold; color: #000">
                        <label style="font-weight: bold; color: #000">Level</label>
                        <select name="level" class="form-control">
                            <option value="2">User</option>
                            <option value="1">Administrator</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icofont icofont-eye-alt"></i>Close</button>
                    <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>Add</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection