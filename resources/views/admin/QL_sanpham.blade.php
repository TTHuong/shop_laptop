 @extends('admin/Admin')
 @section('title-ad')
    {{ trans('home_ad.ql_sp') }}
@endsection
 @section('content-ad')
    <div class="card shadow mb-4" >
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ trans('home_ad.ql_sp') }}</h6>
        </div>
        @if(count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <button class="btn btn-primary" data-toggle="modal"  data-target="#spAdd" type="button">
                    <i class="fa fa-plus" aria-hidden="true"></i> {{ trans('home_ad.add') }}
                </button><br><br>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead style="text-align: center;">
                        <tr style="vertical-align: middle !important;">
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.tensp') }}</th>
                            <th>{{ trans('Ql_sp.soluong') }}</th>
                            <th>{{ trans('Ql_sp.mota') }}</th>
                            <th>{{ trans('Ql_sp.gia') }}</th>
                            <th>{{ trans('Ql_sp.giauudai') }}</th>
                            <th>{{ trans('Ql_sp.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.hieusp') }}</th>
                            <th>{{ trans('Ql_sp.new_top') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>{{ trans('Ql_sp.tensp') }}</th>
                            <th>{{ trans('Ql_sp.soluong') }}</th>
                            <th>{{ trans('Ql_sp.mota') }}</th>
                            <th>{{ trans('Ql_sp.gia') }}</th>
                            <th>{{ trans('Ql_sp.giauudai') }}</th>
                            <th>{{ trans('Ql_sp.hinhanh') }}</th>
                            <th>{{ trans('Ql_sp.hieusp') }}</th>
                            <th>{{ trans('Ql_sp.new_top') }}</th>
                            <th>{{ trans('Ql_sp.sua_xoa') }}</th>
                        </tr>
                    </tfoot>
                    <tbody style="text-align: center;">
                    @foreach($sanpham1 as $key => $sp)
                       <tr>
                            <td>{{$key++}}</td>
                            <td>
                                @if(config('app.locale') != 'vi') 
                                    {{$sp->sp_en}}
                                @else
                                    {{$sp->sp_vi}}
                                @endif
                            </td>
                            <td>{{$sp->product_quantity}}</td>
                            <td>{!! $sp->description !!}</td>
                            <td>{{number_format($sp->unit_price,0,',','.')}}</td>
                            <td>{{number_format($sp->promotion_price,0,',','.')}}</td>
                            <td><img src="source/image/product/{{$sp->image}}" alt="" width="100px"></td>

                            <td>{{$sp-> loai}}</td>

                            <td>
<!--                                 @if($sp->new == 1)
                                    {{"New"}}
                                @else
                                    {{"Not New"}}
                                @endif -->
                                <?php
                                   if($sp->new==1){
                                    ?>
                                    <a href="{{url('/active-sp/'.$sp->id)}}"><span class="far fa-thumbs-up"></span></a>
                                    <?php
                                     }else{
                                    ?>  
                                     <a href="{{url('/unactive-sp/'.$sp->id)}}"><span style="color: #e74a3b;" class="far fa-thumbs-down"></span></a>
                                    <?php
                                   }
                                  ?>

                            </td>

                            <td>
                                <!-- <a href="{{route('update_sp', $sp->id)}}"> -->
                                    <button class="btn btn-primary edit" data-toggle="modal" data-target="#spUpdate_{{$sp->id}}" type="button"><i class="fas fa-edit"></i></button>
                                <!-- </a><br><br> -->
                                <!-- <a href="{{route('deletensp', $sp->id )}}"> -->
                                <button class="btn btn-danger delete" data-toggle="modal" data-target="#spDel_{{$sp->id}}" type="button"><i class="fas fa-trash-alt"></i></button>
                                <!-- </a> -->
                            </td>

                            <!-- Modal Del -->
                            <div class="modal fade" id="spDel_{{$sp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Bạn muốn xóa?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Chọn "Delete" bên dưới nếu bạn đã chắc chắn muốn xóa.{{$sp->id}}</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ bỏ</button>
                           
                                            <form method="" action="{{ route('deletensp', $sp->id)}}">

                                                <button type="submit" class="btn btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Update-->
                            <div class="modal fade" id="spUpdate_{{$sp->id}}" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header text-write">
                                            <h4 class="modal-title">{{ trans('home.up_date') }}</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                                            </button>
                                        </div>
                                        <form action="{{route('update_sp', $sp->id)}}" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="update_product_id" value="{{$sp->id}}">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.tensp') }} Vi</label>
                                                    <input type="text" id="sp_vi_{{$sp->id}}" name="sp_vi" class="form-control" value="{{$sp->sp_vi}}" onkeyup="ChangeToSlug();"/>
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.tensp') }} En</label>
                                                    <input type="text" id="sp_en_{{$sp->id}}" name="sp_en" class="form-control" value="{{$sp->sp_en}}" />
                                                    <input type="hidden" id="slug_{{$sp->id}}" name="slug" class="form-control" value="{{$sp->product_slug}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.mota') }}</label>
                                                    
                                                    <textarea class="form-control" id="e_description_{{$sp->id}}" name="description" rows="5" cols="33">{!! $sp->description !!}</textarea>

                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.soluong') }}</label>
                                                    <input type="text" id="quantity_{{$sp->id}}" name="quantity" class="form-control"  value="{{$sp->product_quantity}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.soluongdaban') }}</label>
                                                    <input type="text" id="product_soid_{{$sp->id}}" name="product_soid" class="form-control"  value="{{$sp->product_soid}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.gia') }}</label>
                                                    <input type="text" id="e_unit_price_{{$sp->id}}" name="unit_price" class="form-control"  value="{{$sp->unit_price}}" />


                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.giauudai') }}</label>
                                                    <input type="text" id="e_promotion_price_{{$sp->id}}" name="promotion_price" class="form-control"  value="{{$sp->promotion_price}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Date Sale</label>
                                                    <input type="text" id="date_sale_product_{{$sp->id}}" name="date_sale" class="form-control"  value="{{$sp->date_sale}}"/>
                                                </div>
                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000" >Hours Sale</label><br>
                                                    <input type="text" id="hours_sale_{{$sp->id}}" name="hours_sale" class="form-control" value="{{$sp->hours_sale}}" />
                                                    <div class="container">
                                                </div>
                                                 <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.new_top') }}</label>
                                                    <select name="new" class="form-control">
                                                        <option value="1" <?php if($sp->new==1)echo 'selected' ?> >New</option>
                                                        <option value="0" <?php if($sp->new==0)echo 'selected' ?> >Not New</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" style="font-weight: bold; color: #000">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hieusp') }}</label>
                                                    <select name="type" class="form-control">
                                                        @foreach($type as $key => $tpe)
                                                            @if($tpe->id == $sp->id_type)
                                                                <option selected value="{{$tpe->id}}">{{$tpe->name_type}}</option>
                                                            @else
                                                                <option value="{{$tpe->id}}">{{$tpe->name_type}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hinhanh') }}</label>
                                                    <input type="file" id="e_image_{{$sp->id}}" name="image" class="form-control" multiple accept="image/*"/><br>
                                                    <img src="source/image/product/{{$sp->image}}" alt="" width="200px">
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

    <!-- Modal Add-->
    <div class="modal fade" id="spAdd" tabindex="-1" role="dialog" style="z-index: 1050; display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-write">
                    <h4 class="modal-title">{{ trans('home_ad.add') }}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="ti-close">&times;</i></span>
                    </button>
                </div>
                <form action="{{route('addnewsp')}}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tensp') }} Vi</label>
                            <input type="text" id="sp_vi" name="sp_vi" class="form-control"  onkeyup="ChangeToSlug();"/>

                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.tensp') }} En</label>
                            <input type="text" id="sp_en" name="sp_en" class="form-control"  />

                            <input type="hidden" id="slug" name="slug" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.mota') }}</label>
                            
                            <textarea id="e_description1" class="form-control" name="description" rows="5" cols="33"></textarea>

                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.soluong') }}</label>
                            <input type="text" id="quantity" name="quantity" class="form-control"  />


                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.gia') }}</label>
                            <input type="text" id="e_unit_price" name="unit_price" class="form-control"  />


                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >{{ trans('Ql_sp.giauudai') }}</label>
                            <input type="text" id="e_promotion_price" name="promotion_price" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Date Sake</label>
                            <input type="text" id="date_sale_product" name="date_sale" class="form-control"  />
                        </div>
                        <div class="form-group">
                            <label style="font-weight: bold; color: #000" >Hours Sake</label><br>
                            <input type="text" id="hours_sale" name="hours_sale" class="col-md-4" style="width: 32%" placeholder="Hours" />
                            <input type="text" id="mins_sale" name="mins_sale" class="col-md-4" style="width: 35%" placeholder="Mins" />
                            <input type="text" id="secs_sale" name="secs_sale" class="col-md-4" style="width: 50%" placeholder="Secs" />
                            <div class="container">
                        </div>
                         <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.new_top') }}</label>
                            <select name="new" class="form-control">
                                <option value="1">New</option>
                                <option value="0">Not New</option>
                            </select>
                        </div>
                        <div class="form-group" style="font-weight: bold; color: #000">
                            <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.hieusp') }}</label>
                            <select name="type" class="form-control">
                                @foreach($type as $key=> $tpe)
                                    <option value="{{$tpe->id}}">{{$tpe->name_type}}</option>
                                @endforeach
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
                        <button type="reset" class="btn btn-primary">Resest</button>
                        <button type="submit"  class="btn btn-primary"  onclick="incrementValue()"><i class="icofont icofont-check-circled"></i>Add</button>
                        

                    </div>
                </form>
            </div>
        </div>
    </div> 

<style type="text/css">
    .col-md-4{
        height: calc(1.5em + .75rem + 2px);
        padding: .375rem .75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #6e707e;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #d1d3e2;
        border-radius: .35rem;
        transition: border-color .15s;
        margin-bottom: 1rem;
    }
</style>
@endsection