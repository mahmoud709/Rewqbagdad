@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/media-videos-categories') }}">{{ __('global.media.video.categories') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/media-videos-categories/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">
        
        <div class="col-md-2 mb-3">
            <label>{{ __('global.sort') }} <strong class="text-danger">*</strong></label>
            <input type="number" class="form-control" value="{{old('sort', $row->sort)}}" name="sort" required />
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.slug') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('media/center/videos')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('slug', $row->slug)}}" name="slug" id="basic-url" required />
            </div>
        </div>

        <div class="col-12">
            <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <ul class="nav panel-tabs">
                            @foreach($row->translations as $val)
                                <li>
                                    <a href="#tab-{{$val->locale}}" class="{{ ($val->locale==appLangKey())? 'active' : '' }}" data-toggle="tab">
                                        {{ LangNative($val->locale) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">

                        @foreach($row->translations as $val)
                            <div class="tab-pane {{ ($val->locale==appLangKey())? 'active' : '' }}" id="tab-{{$val->locale}}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.media.video.categor_name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="name[{{$val->locale}}]" required value="{{ old("name")[$val->locale] ?? $val->name }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-12 text-center mt-3">
            <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-info">{{ __('global.btn_update') }}</button>
        </div>
    </div>{{-- End Row --}}
</form>
@endsection

@section('script')
<script>
    document.getElementById('basic-url').addEventListener('input', function(){
        this.value = this.value.toLowerCase().split(" ").join("-").replace(/[^-a-z-0-9]+/ig, '');
    });
</script>
@endsection

