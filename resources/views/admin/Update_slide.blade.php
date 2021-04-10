@extends('admin/Admin')
 @section('title-ad')
    {{ trans('home_ad.ql_slide') }} / {{ trans('home.up_date') }}
@endsection
@section('content-ad')

	 <h1 class="h3 mb-2 text-gray-800">{{ trans('home.up_date') }}</h1><br>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"><a href="{{route('quanlyslide')}}">
            <button class="btn btn-primary"  type="button">
                <i class="fas fa-reply-all" aria-hidden="true"></i> {{ trans('home_ad.return') }}
            </button></a><br>
        </div>
        <div class="card-body">
           <form action="{{route('update_slide', $slide_update->id )}}" method="post" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                        <label class="control-label">Url</label>
                        <input type="text" id="e_link" name="link_slide" class="form-control" value="{{$slide_update->link}}" />

                    </div>
                     <div class="form-group" style="font-weight: bold; color: #000">
                        <label style="font-weight: bold; color: #000">{{ trans('Ql_sp.trangthai') }}</label>
                        <select name="status_slide" class="form-control">
                            <option value="0" <?php if($slide_update->status_slide==0)echo 'selected' ?> >Hiển Thị</option>
                            <option value="1" <?php if($slide_update->status_slide==1)echo 'selected' ?> >Ẩn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">{{ trans('Ql_sp.hinhanh') }}</label><br>
                        <input type="file" id="e_image" name="image" class="form-control" multiple/><br>
                        <img src="source/image/slide/{{$slide_update->image}}" alt="" width="200px">
                    </div>
                    <div class="modal-footer">
	                    <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
                       
	                </div>

                </div>
                
            </form>
        </div>
    </div>

@endsection
