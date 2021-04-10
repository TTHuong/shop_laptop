 @extends('admin/Admin')
@section('title-ad')
    {{ trans('home_ad.ql_lang') }} / {{ trans('home.up_date') }}
@endsection
 @section('content-ad')    

<h1 class="h3 mb-2 text-gray-800">{{ trans('home.up_date') }}</h1><br>
    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3"><a href="{{route('quanlynn')}}">
            <button class="btn btn-primary"  type="button">
                <i class="fas fa-reply-all" aria-hidden="true"></i> {{ trans('home_ad.return') }}
            </button></a><br>
        </div>
        <div class="card-body">
           <form action="{{route('update_lang', $update_nn->id_post)}}" method="post" enctype="multipart/form-data">
                <!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> -->
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
                        <label class="control-label">Name vi</label>
                        <input type="text" id="sp_vi" name="sp_vi" class="form-control" value="{{$update_nn->sp_vi}}"  onkeyup="ChangeToSlug();"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Name en </label>
                        <input type="text" id="sp_en" name="sp_en" class="form-control" value="{{$update_nn->sp_en}}" />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Url</label>
                        <input type="text" id="slug" name="slug" class="form-control" value="{{$update_nn->product_slug}}" />
                    </div>
                   
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="icofont icofont-check-circled"></i>{{ trans('home.up_date') }}</button>
                        
                    </div>

                </div>
                
            </form>
        </div>
    </div>


@endsection

