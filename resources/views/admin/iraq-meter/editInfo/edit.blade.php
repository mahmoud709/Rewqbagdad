@extends('layout.admin.app')
@section('title', __('global.iraqmeter.edit'))

@section('breadcrumb')
<li class="breadcrumb-item">@yield('title')</li>
@endsection


@section('content')
<form action="{{ url()->current() }}" method="post">@csrf
    <div class="row">

        <div class="col-md-4 mb-3">
            <label>{{ __('global.rewaq.contact_email') }} <strong class="text-danger">*</strong></label>
            <input type="email" required name="contact_email" value="{{old('contact_email',$row->contact_email)}}" class="form-control" />
        </div>

        <div class="col-md-5 mb-3">
            <label>{{ __('global.rewaq.logo') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" required dir="ltr" class="form-control text-left" type="text" name="img" value="{{ old('img', $row->img) }}" />
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img', $row->img)))
                    <img src="{{ old('img', $row->img) }}" style="height: 5rem;">
                @endif
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <label>{{ __('global.project_manager_photo') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumimg2" data-preview="holderimg2" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg2" name="project_manager_photo"  required dir="ltr" class="form-control" type="text" name="news_img"  value="{{ old('project_manager_photo', $row->proejct_manager_img ) }}" />
            </div>
            <div id="holderimg2" style="margin-top:15px;max-height:100px;">
               
                @if(!empty(old('project_manager_photo', $row->proejct_manager_img)))
                <img src="{{ old('project_manager_photo', $row->proejct_manager_img ?? "" ) }}" style="height: 5rem;">
                @endif
            </div>
        </div>

        <div class="col-12"></div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-facebook"></i> Facebook</label>
            <input type="text" dir="ltr" class="form-control" name="facebook" value="{{ $row->facebook }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-twitter"></i> Twitter</label>
            <input type="text" dir="ltr" class="form-control" name="twitter" value="{{ $row->twitter }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-instagram"></i> instagram</label>
            <input type="text" dir="ltr" class="form-control" name="instagram" value="{{ $row->instagram }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-linkedin"></i> Linkedin</label>
            <input type="text" dir="ltr" class="form-control" name="linkedin" value="{{ $row->linkedin }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-youtube"></i> Youtube</label>
            <input type="text" dir="ltr" class="form-control" name="youtube" value="{{ $row->youtube }}" />
        </div>
            
        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-telegram"></i> Telegram</label>
            <input type="text" dir="ltr" class="form-control" name="telegram" value="{{ $row->telegram }}" />
        </div>
            
        <div class="col-md-4 mb-3">
            <label><i class="fa-brands fa-tiktok"></i> Tiktok</label>
            <input type="text" dir="ltr" class="form-control" name="tiktok" value="{{ $row->tiktok }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-whatsapp"></i> Whatsapp</label>
            <input type="text" dir="ltr" class="form-control" name="whatsapp" value="{{ $row->whatsapp }}" placeholder="https://wa.me/+201021464469" />
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
                               
                                <div class="col-md-6 mb-3">
                                    <label>{{ __('global.project_manager_name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                    <input type="text" required name="project_manager[{{$val->locale}}]" value="{{(old('project_manager')[$val->locale] ?? $val->project_manager) ?? ""}}" class="form-control" />
                                </div>
                                    <div class="mb-3">
                                        <label>{{ __('global.rewaq.description') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($val->locale)}}" name="content[{{$val->locale}}]" class="form-control my-editor" rows="5">{!! old('content')[$val->locale] ?? $val->content !!}</textarea>
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