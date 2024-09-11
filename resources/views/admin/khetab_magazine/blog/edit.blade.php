@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/khetab-magazine-blog') }}">{{ __('global.magazine.blog.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/khetab-magazine-blog/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">

        <div class="col-md-6 mb-3">
            <label>{{ __('global.magazine.blog.img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumimg1" data-preview="holderimg1" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg1" required dir="ltr" class="form-control" type="text" name="img" value="{{ old('img', $row->img) }}" />
            </div>
            <div id="holderimg1" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('img', $row->img) }}" style="height: 5rem;">
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
                <input id="thumimg2" required dir="ltr" class="form-control" type="text" name="pdf" value="{{ old('pdf', $row->pdf) }}" />
            </div>
            <div id="holderimg2" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('pdf', $row->pdf) }}" style="height: 5rem;">
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.slug') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('khetab-magazine/blog')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('slug', $row->slug)}}" name="slug" id="basic-url" required />
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.magazine.blog.promo_url') }}</label>
            <input dir="ltr" type="url" class="form-control" name="promo_url" value="{{ old("promo_url", $row->promo_url) }}" />
        </div>
        
        <div class="col-md-3 mb-3">
            <label>{{ __('global.magazine.blog.number') }} <strong class="text-danger">*</strong></label>
            <input required type="number" class="form-control" name="number" required value="{{ old("number", $row->number) }}" />
        </div>
        
        <div class="col-md-3 mb-3">
            <label>{{ __('global.version.created_at') }} <strong class="text-danger">*</strong></label>
            <input required type="date" class="form-control" name="created_at" required value="{{ old("created_at", substr($row->created_at,0,10)) ?? date('Y-m-d') }}" />
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
                                        <label>{{ __('global.magazine.blog.name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="title[{{$val->locale}}]" required value="{{ old("title")[$val->locale] ?? $val->title }}" />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.writer') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="writer[{{$val->locale}}]" required value="{{ old("writer")[$val->locale] ?? $val->writer }}" />
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.description') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" required name="description[{{$val->locale}}]" class="form-control" rows="5">{{ old("description")[$val->locale] ?? $val->description }}</textarea>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.tags') }} ({{ LangNative($val->locale) }})</label>
                                        <br />
                                        <input name="tags[{{$val->locale}}]" value="{{ old("tags")[$val->locale] ?? $val->tags }}" class="tag_{{$val->locale}}" placeholder="{{ __('global.version.news_tags') }}" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.magazine.blog.editorial') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea name="content[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('content')[$val->locale] ?? $val->content !!}</textarea>
                                    </div>
                                    
                                    
                                    @for ($i = 1; $i < 10; $i++)
                                        @php
                                            $title = "title_".$i;
                                            $content = "content_".$i;
                                        @endphp
                                        <div class="col-md-6 mb-3">
                                            <label>{{ __('global.magazine.blog.input_title') }} {{$i}} ({{ LangNative($val->locale) }}) </label>
                                            <input dir="{{langDir($val->locale)}}" name="title_{{$i}}[{{$val->locale}}]" value="{{ old("title_".$i)[$val->locale] ?? $val->$title }}" class="form-control" />
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('global.magazine.blog.input_content') }} {{$i}} ({{ LangNative($val->locale) }}) </label>
                                            <textarea name="content_{{$i}}[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('content_'.$i)[$val->locale] ?? $val->$content !!}</textarea>
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
            <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-info">{{ __('global.btn_update') }}</button>
        </div>
    </div>{{-- End Row --}}
</form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{url('admin/tagify.css')}}">
@endsection

@section('script')
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
{{-- <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'code table lists',
      license_key: 'your_free_license_key'
    });
</script> --}}
<script>
    function getElementAfterDelay() {
    setTimeout(() => {
        $('.tox-notifications-container').css('display', 'none');
    }, 6000); 
    }
    window.onload = getElementAfterDelay;
</script>
    
    
{{-- <script src="{{ url('/admin/editor/config.js') }}"></script> --}}
<script src="{{url('admin/tagify.min.js')}}"></script>
<script>
    tagify = new Tagify(document.querySelector('.tag_ar'));
    tagify2 = new Tagify(document.querySelector('.tag_en'));
</script>
@endsection

