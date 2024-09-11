@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/electronic-services') }}">{{ __('global.electronic.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/electronic-services/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">

        <div class="col-md-6 mb-3">
            <label>{{__('global.electronic.reception_mail')}} <strong class="text-danger">*</strong></label>
            <input type="email" name="email" value="{{ old('email', $row->email) }}" class="form-control" />
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
                                        <label>{{ __('global.electronic.page_name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="title[{{$val->locale}}]" required value="{{ old("title")[$val->locale] ?? $val->title }}" />
                                    </div>
                                    
                                    @if ($row->id == 2)
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('global.electronic.description') }} ({{ LangNative($val->locale) }}) </label>
                                            <textarea dir="{{langDir($val->locale)}}" name="description[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('description')[$val->locale] ?? $val->description !!}</textarea>
                                        </div>
                                        
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('global.electronic.description') }} 2 ({{ LangNative($val->locale) }}) </label>
                                            <textarea dir="{{langDir($val->locale)}}" name="content[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('content')[$val->locale] ?? $val->content !!}</textarea>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('global.electronic.description') }} ({{ LangNative($val->locale) }}) </label>
                                            <textarea dir="{{langDir($val->locale)}}" name="description[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('description')[$val->locale] ?? $val->description !!}</textarea>
                                            <input type="hidden" name="content[{{$val->locale}}]" />
                                        </div>
                                    @endif
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
@endsection

