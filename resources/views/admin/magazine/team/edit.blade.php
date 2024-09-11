@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/magazine-team') }}">{{ __('global.magazine.team.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/magazine-team/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">

        <div class="col-md-2 mb-3">
            <label>{{ __('global.sort') }} <strong class="text-danger">*</strong></label>
            <input type="number" required name="sort" value="{{old('sort', $row->sort)}}" class="form-control" />
        </div>
        
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.magazine.team.email') }} <strong class="text-danger">*</strong></label>
            <input type="email" required name="email" value="{{old('email',$row->email)}}" class="form-control" />
        </div>
        
        <div class="col-md-3 mb-3">
            <label>{{ __('global.magazine.team.cv_link') }} </label>
            <input type="url" name="cv_link" value="{{old('cv_link',$row->cv_link)}}" class="form-control" />
        </div>

        <div class="col-md-3 mb-3">
            <label>{{ __('global.magazine.team.img') }} <strong class="text-danger">*</strong></label>
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

        <div class="col-md-4 mb-3">
            <label>{{ __('global.magazine.team.job_title') }} <strong class="text-danger">*</strong></label>
            <select name="job_title" required class="form-control">
                @foreach (__('global.magazine.team.jobs_titles')[appLangKey()] as $key => $job)
                    <option @if($row->type == $key) selected @endif value="{{$key}}">{{$job}}</option>
                @endforeach
            </select>
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
                                        <label>{{ __('global.magazine.team.name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control" name="name[{{$val->locale}}]" required value="{{ old("name")[$val->locale] ?? $val->name }}" />
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.team.desc') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" required name="description[{{$val->locale}}]" class="form-control" rows="5">{{ old('description')[$val->locale] ?? $val->description }}</textarea>
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

@endsection

