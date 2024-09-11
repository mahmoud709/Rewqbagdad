@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/parliament-videos') }}">{{ __('global.parliament.video.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/parliament-videos/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.parliament.video.thum') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumimg2" data-preview="holderimg2" class="btn btn-danger text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg2" required dir="ltr" class="form-control" type="text" name="img" value="{{ old('img',$row->img) }}" />
            </div>
            <div id="holderimg2" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('img',$row->img) }}" style="height: 5rem;">
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.parliament.video.video_url') }} <strong class="text-danger">*</strong></label>
            <input required dir="ltr" class="form-control" type="url" name="video_url" value="{{ old('video_url',$row->video_url) }}" />
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
                                        <label>{{ __('global.parliament.video.video_name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
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

