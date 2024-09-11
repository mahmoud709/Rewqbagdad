@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/book-team') }}">{{ __('global.center_member.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/book-team/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.center_member.email') }}</label>
            <input type="email" name="email" value="{{old('email',$row->email)}}" class="form-control" />
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.book_team.cv_link') }} </label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="cv_link" data-preview="cv_link2" class="btn btn-danger text-white">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="cv_link" dir="ltr" class="form-control text-left" type="text" name="cv_link" value="{{ old('cv_link',$row->cv_link) }}" />
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.center_member.img') }} <strong class="text-danger">*</strong> </label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" required dir="ltr" class="form-control text-left" type="text" name="img" value="{{ old('img',$row->img) }}" />
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img',$row->img)))
                    <img src="{{ old('img',$row->img) }}" style="height: 5rem;">
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
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.center_member.name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="name[{{$val->locale}}]" required value="{{ old("name")[$val->locale] ?? $val->name }}" />
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>{{ __('global.book_team.job_title') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" readonly type="text" class="form-control" name="job_title[{{$val->locale}}]" required value="{{ __('global.book_team.jobs_titles')[$val->locale] }}" />
                                    </div>

                                    <div class="col-12"></div>
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.center_member.desc') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" name="description[{{$val->locale}}]" class="form-control editer" rows="5">{!! old('description')[$val->locale] ?? $val->description !!}</textarea>
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
@endsection

@section('script')
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
<script>
    tinymce.init({
    selector: '.editer',
    height: 350,
    menubar:false,
    toolbar: 'undo redo | blocks | ' +
    'bold italic forecolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat',
    });
</script>
@endsection

