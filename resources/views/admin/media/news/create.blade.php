@extends('layout.admin.app')
@section('title', __('global.media.news.add'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/media-news') }}">{{ __('global.media.news.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/media-news') }}" method="post">@csrf
    <div class="row">

        <div class="col-md-6 mb-3">
            <label>{{ __('global.slug') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('media/news')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('slug', time())}}" name="slug" id="basic-url" required />
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.media.news.img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumimg1" data-preview="holderimg1" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg1" required dir="ltr" class="form-control" type="text" name="img" value="{{ old('img') }}" />
            </div>
            <div id="holderimg1" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('img') }}" style="height: 5rem;">
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.media.news.thum_img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumimg2" data-preview="holderimg2" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg2" required dir="ltr" class="form-control" type="text" name="thum_img" value="{{ old('thum_img') }}" />
            </div>
            <div id="holderimg2" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('thum_img') }}" style="height: 5rem;">
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.media.news.slider_img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img3" data-input="thumimg3" data-preview="holderimg3" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg3" required dir="ltr" class="form-control" type="text" name="slider_img" value="{{ old('slider_img') }}" />
            </div>
            <div id="holderimg3" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('slider_img') }}" style="height: 5rem;">
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.media.created_at') }} <strong class="text-danger">*</strong></label>
            <input required type="date" class="form-control" name="created_at" required value="{{ old("created_at") ?? date('Y-m-d') }}" />
        </div>
        
        <div class="col-12">
            <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <ul class="nav panel-tabs">
                            @foreach(SupportedLangs() as $localeCode => $properties)
                                <li>
                                    <a href="#tab-{{$localeCode}}" class="{{ ($localeCode==appLangKey())? 'active' : '' }}" data-toggle="tab">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">

                        @foreach(SupportedLangs() as $localeCode => $properties)
                            <div class="tab-pane {{ ($localeCode==appLangKey())? 'active' : '' }}" id="tab-{{$localeCode}}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.media.news.name') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="title[{{$localeCode}}]" required value="{{ old("title")[$localeCode] ?? '' }}" />
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.media.news.tags') }} ({{ $properties['native'] }})</label>
                                        <br />
                                        <input name="tags[{{$localeCode}}]" value="{{ old("tags")[$localeCode] ?? '' }}" class="tag_{{$localeCode}}" placeholder="{{ __('global.media.news.tags') }}" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.media.news.description') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" required name="description[{{$localeCode}}]" class="form-control" rows="5">{{ old("description")[$localeCode] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.media.news.content') }} ({{ LangNative($localeCode) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" name="content[{{$localeCode}}]" class="form-control my-editor" rows="5">{!! old('content')[$localeCode] ?? '' !!}</textarea>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-12 text-center mt-3">
            <button onclick="if(confirm(`{{__('global.alert_create')}}`)){return true;}else{return false;}" class="btn btn-primary">{{ __('global.btn_create') }}</button>
        </div>
    </div>{{-- End Row --}}
</form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{url('admin/tagify.css')}}">
@endsection

@section('script')
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('/admin/editor/config.js') }}"></script> --}}
<script src="{{url('admin/tagify.min.js')}}"></script>
<script>
    tagify = new Tagify(document.querySelector('.tag_ar'));
    tagify2 = new Tagify(document.querySelector('.tag_en'));
</script>
@endsection

