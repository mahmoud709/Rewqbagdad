@extends('layout.admin.app')
@section('title', __('global.magazine.blog.add'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/magazine-blog') }}">{{ __('global.magazine.blog.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/magazine-blog') }}" method="post">@csrf
    <div class="row">

        <div class="col-md-6 mb-3">
            <label>{{ __('global.magazine.blog.img') }} <strong class="text-danger">*</strong></label>
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
            <label>{{ __('global.magazine.blog.pdf') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumimg2" data-preview="holderimg2" class="btn btn-danger text-white">
                    <i class="fa-regular fa-file-pdf"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg2" required dir="ltr" class="form-control" type="text" name="pdf" value="{{ old('pdf') }}" />
            </div>
            <div id="holderimg2" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('pdf') }}" style="height: 5rem;">
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.slug') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('magazine/blog')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('slug', time())}}" name="slug" id="basic-url" required />
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.magazine.blog.promo_url') }}</label>
            <input dir="ltr" type="url" class="form-control" name="promo_url" value="{{ old("promo_url") }}" />
        </div>
        
        <div class="col-md-3 mb-3">
            <label>{{ __('global.magazine.blog.number') }} <strong class="text-danger">*</strong></label>
            <input required type="number" class="form-control" name="number" required value="{{ old("number") }}" />
        </div>
        
        <div class="col-md-3 mb-3">
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
                                        <label>{{ __('global.magazine.blog.name') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="title[{{$localeCode}}]" required value="{{ old("title")[$localeCode] ?? '' }}" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.writer') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="writer[{{$localeCode}}]" required value="{{ old("writer")[$localeCode] ?? '' }}" />
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.description') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" required name="description[{{$localeCode}}]" class="form-control" rows="5">{{ old("description")[$localeCode] ?? '' }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.tags') }} ({{ $properties['native'] }})</label>
                                        <br />
                                        <input name="tags[{{$localeCode}}]" value="{{ old("tags")[$localeCode] ?? '' }}" class="tag_{{$localeCode}}" placeholder="{{ __('global.version.news_tags') }}" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.magazine.blog.editorial') }} ({{ LangNative($localeCode) }}) <strong class="text-danger">*</strong></label>
                                        <textarea name="content[{{$localeCode}}]" class="form-control my-editor" rows="5">{!! old('content')[$localeCode] ?? '' !!}</textarea>
                                    </div>
                                    
                                    
                                    @for ($i = 1; $i < 10; $i++)
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('global.magazine.blog.input_title') }} {{$i}} ({{ LangNative($localeCode) }}) </label>
                                            <input dir="{{langDir($localeCode)}}" name="title_{{$i}}[{{$localeCode}}]" value="{{ old("title_".$i)[$localeCode] ?? '' }}" class="form-control" />
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('global.magazine.blog.input_content') }} {{$i}} ({{ LangNative($localeCode) }}) </label>
                                            <textarea name="content_{{$i}}[{{$localeCode}}]" class="form-control my-editor" rows="5">{!! old('content_'.$i)[$localeCode] ?? '' !!}</textarea>
                                        </div>
                                    @endfor
                                    
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
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}

<script>
    function getElementAfterDelay() {
    setTimeout(() => {
        $('.tox-notifications-container').css('display', 'none');
    }, 6000); 
    }
    window.onload = getElementAfterDelay;
</script>

{{-- <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'code table lists',
      license_key: 'your_free_license_key'
    });
  </script>
   --}}
  
{{-- <script src="{{ url('/admin/editor/config.js') }}"></script> --}}
<script src="{{url('admin/tagify.min.js')}}"></script>
<script>
    tagify = new Tagify(document.querySelector('.tag_ar'));
    tagify2 = new Tagify(document.querySelector('.tag_en'));
</script>
@endsection

