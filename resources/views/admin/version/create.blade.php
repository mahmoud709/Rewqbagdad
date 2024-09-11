@extends('layout.admin.app')
@section('title', __('global.version.news_add'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/versions') }}">{{ __('global.version.news') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/versions') }}" method="post">@csrf
    <div class="row">

        <div class="col-md-4 mb-3">
            <label>{{ __('global.version.categor_name') }} <strong class="text-danger">*</strong></label>
            <select name="category_id" class="form-control">
                @foreach ($cats as $cat)
                    <option value="{{$cat->id}}">{{ $cat->translation->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.version.writer_name') }} <strong class="text-danger">*</strong></label>
            <select name="writer_id" class="form-control">
                @foreach ($writers as $writer)
                    <option value="{{$writer->id}}">{{ $writer->translation->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.slug') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('version')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('slug', time())}}" name="slug" id="basic-url" required />
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.version.thum_img') }} <strong class="text-danger">*</strong></label>
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
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.version.news_img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumimg2" data-preview="holderimg2" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg2" required dir="ltr" class="form-control" type="text" name="news_img" value="{{ old('news_img') }}" />
            </div>
            <div id="holderimg2" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('news_img') }}" style="height: 5rem;">
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.version.news_pdf') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img4" data-input="thumimg5" data-preview="holderimg5" class="btn btn-danger text-white">
                    <i class="fa-regular fa-file-pdf"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg5" required dir="ltr" class="form-control" type="text" name="pdf" value="{{ old('pdf') }}" />
            </div>
            <div id="holderimg5" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('pdf') }}" style="height: 5rem;">
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.version.created_at') }} <strong class="text-danger">*</strong></label>
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
                                        <label>{{ __('global.version.news_name') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="title[{{$localeCode}}]" required value="{{ old("title")[$localeCode] ?? '' }}" />
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.version.news_tags') }} ({{ $properties['native'] }})</label>
                                        <br />
                                        <input name="tags[{{$localeCode}}]" value="{{ old("tags")[$localeCode] ?? '' }}" class="tag_{{$localeCode}}" placeholder="{{ __('global.version.news_tags') }}" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.version.news_description') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" required name="description[{{$localeCode}}]" class="form-control" rows="5">{{ old("description")[$localeCode] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.version.news_content') }} ({{ LangNative($localeCode) }}) <strong class="text-danger">*</strong></label>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('/admin/editor/config.js') }}"></script> --}}
<script src="{{url('admin/tagify.min.js')}}"></script>
<script>
    $('select').select2();
    tagify = new Tagify(document.querySelector('.tag_ar'));
    tagify2 = new Tagify(document.querySelector('.tag_en'));
</script>
@endsection

