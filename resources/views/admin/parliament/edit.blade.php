@extends('layout.admin.app')
@section('title', __('global.parliament.title'))

@section('breadcrumb')
<li class="breadcrumb-item">@yield('title')</li>
@endsection


@section('content')
<form action="{{ url()->current() }}" method="post">@csrf
    <div class="row">

        <div class="col-md-6 mb-3">
            <label>{{ __('global.parliament.google_url') }} <strong class="text-danger">*</strong></label>
            <input dir="ltr" type="url" required name="google_url" value="{{old('google_url',$row->google_url)}}" class="form-control" />
        </div>
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.parliament.apple_url') }} <strong class="text-danger">*</strong></label>
            <input dir="ltr" type="url" required name="apple_url" value="{{old('apple_url',$row->apple_url)}}" class="form-control" />
        </div>

        <div class="col-md-5 mb-3">
            <label>{{ __('global.parliament.logo') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" required dir="ltr" class="form-control text-left" type="text" name="img" value="{{ old('img', $row->img) }}" />
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img', $row->img)))
                    <img src="{{ old('img', $row->img) }}" style="height: 5rem;">
                @endif
            </div>
        </div>
        
        <div class="col-md-5 mb-3">
            <label>{{ __('global.parliament.img_app') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail2" required dir="ltr" class="form-control text-left" type="text" name="img_app" value="{{ old('img_app', $row->img_app) }}" />
            </div>
            <div id="holder2" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img_app', $row->img_app)))
                    <img src="{{ old('img_app', $row->img_app) }}" style="height: 5rem;">
                @endif
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
                                    
                                    <div class="col-md-8 mb-3">
                                        <label>{{ __('global.parliament.description') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" name="description[{{$val->locale}}]" class="form-control" rows="5">{!! old('description')[$val->locale] ?? $val->description !!}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.parliament.content') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" name="content[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('content')[$val->locale] ?? $val->content !!}</textarea>
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
<script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('/admin/editor/config.js') }}"></script>
@endsection