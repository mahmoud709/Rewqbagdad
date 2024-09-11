@extends('layout.admin.app')
@section('title', __('global.MEJEELP_magazine.team.add'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/MEJEELP-magazine-team') }}">{{ __('global.MEJEELP_magazine.team.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/MEJEELP-magazine-team') }}" method="post">@csrf
    <div class="row">

        <div class="col-md-2 mb-3">
            <label>{{ __('global.sort') }} <strong class="text-danger">*</strong></label>
            <input type="number" required name="sort" value="{{old('sort', $AllCount+1)}}" class="form-control" />
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.MEJEELP_magazine.team.email') }} <strong class="text-danger">*</strong></label>
            <input type="email" required name="email" value="{{old('email')}}" class="form-control" />
        </div>
        
        <div class="col-md-3 mb-3">
            <label>{{ __('global.MEJEELP_magazine.team.cv_link') }} </label>
            <input type="url" name="cv_link" value="{{old('cv_link')}}" class="form-control" />
        </div>

        <div class="col-md-3 mb-3">
            <label>{{ __('global.MEJEELP_magazine.team.img') }} <strong class="text-danger">*</strong></label>
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

        <div class="col-md-4 mb-3">
            <label>{{ __('global.MEJEELP_magazine.team.job_title') }} <strong class="text-danger">*</strong></label>
            <select name="job_title" required class="form-control">
                @foreach (__('global.MEJEELP_magazine.team.jobs_titles')[appLangKey()] as $key => $job)
                    <option value="{{$key}}">{{$job}}</option>
                @endforeach
            </select>
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
                                        <label>{{ __('global.MEJEELP_magazine.team.name') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="name[{{$localeCode}}]" required value="{{ old("name")[$localeCode] ?? '' }}" />
                                    </div>
                                    <div class="col-12"></div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.MEJEELP_magazine.team.desc') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" required name="description[{{$localeCode}}]" class="form-control" rows="5">{!! old('description')[$localeCode] ?? '' !!}</textarea>
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

@endsection

