@extends('layout.admin.app')
@section('title', __('global.book_team.add_new'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/book-team') }}">{{ __('global.book_team.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/book-team') }}" method="post">@csrf
    <div class="row">
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.book_team.email') }}</label>
            <input type="email" name="email" value="{{old('email')}}" class="form-control" />
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.book_team.cv_link') }} </label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="cv_link" data-preview="cv_link2" class="btn btn-danger text-white">
                        <i class="fa-regular fa-file-pdf"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="cv_link" dir="ltr" class="form-control text-left" type="text" name="cv_link" value="{{ old('cv_link') }}" />
            </div>
            <div id="cv_link2" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('cv_link')))
                    <img src="{{ old('cv_link') }}" style="height: 5rem;">
                @endif
            </div>
        </div>


        <div class="col-md-4 mb-3">
            <label>{{ __('global.book_team.img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" required dir="ltr" class="form-control text-left" type="text" name="img" value="{{ old('img') }}" />
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img')))
                    <img src="{{ old('img') }}" style="height: 5rem;">
                @endif
            </div>
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
                                        <label>{{ __('global.book_team.name') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="name[{{$localeCode}}]" required value="{{ old("name")[$localeCode] ?? '' }}" />
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label>{{ __('global.book_team.job_title') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" readonly type="text" class="form-control" name="job_title[{{$localeCode}}]" required value="{{ __('global.book_team.jobs_titles')[$localeCode] }}" />
                                    </div>

                                    <div class="col-12"></div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.book_team.desc') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" name="description[{{$localeCode}}]" class="form-control editer" rows="5">{!! old('description')[$localeCode] ?? '' !!}</textarea>
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


