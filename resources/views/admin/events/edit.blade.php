@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/events') }}">{{ __('global.event.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/events/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">

        <div class="col-md-3 mb-3">
            <label>{{ __('global.event.created_at') }} <strong class="text-danger">*</strong></label>
            <input type="date" class="form-control" value="{{old('created_at', substr($row->created_at,0,10))}}" name="created_at" required />
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.event.url') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('event')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('url', $row->url)}}" name="url" id="basic-url" required />
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.event.img') }} <strong class="text-danger">*</strong></label>
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
                                        <label>{{ __('global.event.name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="name[{{$val->locale}}]" required value="{{ old("name")[$val->locale] ?? $val->name }}" />
                                    </div>

                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.event.content') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
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
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('/admin/editor/config.js') }}"></script> --}}
<script>
    document.getElementById('basic-url').addEventListener('input', function(){
        this.value = this.value.toLowerCase().split(" ").join("-").replace(/[^-a-z-0-9]+/ig, '');
    });
</script>
@endsection

