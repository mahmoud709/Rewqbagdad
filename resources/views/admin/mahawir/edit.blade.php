@extends('layout.admin.app')
@section('title', __('global.edit').': '.$mahawir->translation->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('mahawirs.index') }}">{{ __('global.mahwiers') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ route('mahawirs.update', $mahawir->id)}}" method="post">
    @csrf 
    {{ method_field('PUT') }}
    <div class="row">

 
        
        <div class="col-md-6 mb-3">
            <label>{{ __('global.media.news.img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumimg1" data-preview="holderimg1" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg1" required dir="ltr" class="form-control" type="text" name="photo" value="{{ old('photo', $mahawir->photo) }}" />
            </div>
            <div id="holderimg1" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('photo', $mahawir->photo) }}" style="height: 5rem;">
            </div>
        </div>
        
        <div class="col-12">
            <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <ul class="nav panel-tabs">
                            @foreach($mahawir->translations as $val)
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

                        @foreach($mahawir->translations as $val)
                            <div class="tab-pane {{ ($val->locale==appLangKey())? 'active' : '' }}" id="tab-{{$val->locale}}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.mahwier_title') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="title[{{$val->locale}}]" required value="{{ old("title")[$val->locale] ?? $val->title }}" />
                                    </div>
                                    

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.mahwier_description') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" required name="description[{{$val->locale}}]" class="form-control" rows="5">{{ old("description")[$val->locale] ?? $val->description }}</textarea>
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

