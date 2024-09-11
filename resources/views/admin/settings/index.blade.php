@extends('layout.admin.app')
@section('title', __('global.settings'))

@section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('style')
<style>
    .code,.code:focus {
        background: #303030;
        color: #fff;
        direction: ltr;
        font-size: 12px
    }
</style>
@endsection

@section('script')
@endsection

@section('content')
    @php
        $imgs = ['img_1','img_2','img_3','img_4','img_5'];
    @endphp
    <form class="row" action="{{url()->current()}}" method="post">@csrf

        <div class="col-12 mb-4">
            <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <ul class="nav panel-tabs">
                            @foreach($sc->translations as $val)
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
                        @foreach($sc->translations as $row)
                            <div class="tab-pane {{ ($row->locale==appLangKey())? 'active' : '' }}" id="tab-{{$row->locale}}">
                                <div class="row">

                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.site_name') }} ({{ LangNative($row->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($row->locale)}}" type="text" class="form-control" required name="name[{{$row->locale}}]" value="{{ $row->name }}" />
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.work_hours') }} ({{ LangNative($row->locale) }}) </label>
                                        <input dir="{{langDir($row->locale)}}" type="text" class="form-control" name="work_hours[{{$row->locale}}]" value="{{ $row->work_hours }}" />
                                    </div>

                                    <div class="col-12"></div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{__('global.site_description')}}  ({{ LangNative($row->locale) }})<strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($row->locale)}}" name="description[{{$row->locale}}]" required class="form-control" rows="3" style="resize:none">{{ $row->description }}</textarea>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.address') }} ({{ LangNative($row->locale) }})</label>
                                        <textarea dir="{{langDir($row->locale)}}" name="address[{{$row->locale}}]" required class="form-control" rows="3" style="resize:none">{{ str_replace('<br />', ' ',$row->address) }}</textarea>
                                    </div>

                                    @foreach ($imgs as $key => $img)
                                        <div class="col-md-4 mb-3">
                                            <label>{{ __('global.fot_img_name').' '.$key+1 }} ({{ LangNative($row->locale) }})<strong class="text-danger">*</strong></label>
                                            <input dir="{{langDir($row->locale)}}" required type="text" class="form-control" name="n{{$img}}[{{$row->locale}}]" value="{{ $row->$img }}" />
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.email') }} <strong class="text-danger">*</strong></label>
            <input type="email" class="form-control" name="email" value="{{ $sc->email }}" dir="ltr"/>
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.contact_email') }} <strong class="text-danger">*</strong></label>
            <input type="email" class="form-control" name="contact_email" value="{{ $sc->contact_email }}" dir="ltr"/>
        </div>
        
        <div class="col-md-4 mb-3">
            <label>{{ __('global.phone') }}</label>
            <input type="tel" class="form-control" name="phone" value="{{ $sc->phone }}" dir="ltr"/>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.timezone') }} <strong class="text-danger">*</strong></label>
            <select name="timezone" class="form-control" dir="ltr">
                @foreach ($timezone_identifiers as $item)
                    <option @if(date_default_timezone_get()==$item) selected @endif value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="col-12"></div>
        <div class="col-md-4 mb-3">
            <label>{{ __('global.site_logo_header') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" readonly="readonly" dir="ltr" class="form-control" type="text" name="logo_header" value="{{ $sc->logo_header }}" />
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                <img src="{{ $sc->logo_header }}" style="height: 5rem;">
            </div>
        </div>
           
        <div class="col-md-4 mb-3">
            <label>{{ __('global.site_logo_footer') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img3" data-input="thumbnail3" data-preview="holder3" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail3" readonly="readonly" dir="ltr" class="form-control" type="text" name="logo_footer" value="{{ $sc->logo_footer }}" />
            </div>
            <div id="holder3" style="margin-top:15px;max-height:100px;">
                <img src="{{ $sc->logo_footer }}" style="height: 5rem;">
            </div>
        </div>
            
        <div class="col-md-4 mb-3">
            <label>{{ __('global.site_icon') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img2" data-input="thumbnail2" data-preview="holder2" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail2" readonly="readonly" dir="ltr" class="form-control" type="text" name="icon" value="{{ $sc->icon }}" />
            </div>
            <div id="holder2" style="margin-top:15px;max-height:100px;">
                <img src="{{ $sc->icon }}" style="height: 5rem;">
            </div>
        </div>
        <div class="col-12">
            <hr />
        </div>

        @foreach ($imgs as $key => $item)
            <div class="col-md-4 mb-3">
                <label>{{ __('global.fot_img').' '.$key+1 }} <strong class="text-danger">*</strong></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="img{{$key+4}}" data-input="thumbnail{{$key+4}}" data-preview="holder{{$key+4}}" class="btn btn-primary text-white">
                            <i class="fas fa-image"></i> {{ __('global.choose') }}
                        </a>
                    </span>
                    <input id="thumbnail{{$key+4}}" readonly="readonly" dir="ltr" class="form-control" type="text" name="{{$item}}" value="{{ $sc->$item }}" />
                </div>
                <div id="holder{{$key+4}}" style="margin-top:15px;max-height:100px;">
                    <img src="{{ $sc->$item }}" style="height: 5rem;">
                </div>
            </div>
        @endforeach
       
        <div class="col-12">
            <hr />
        </div>
       
        @foreach ($imgs as $key => $link)
            @php $name = $link.'_link'; @endphp
            <div class="col-md-4 mb-3">
                <label>{{ __('global.fot_img_link').' '.$key+1 }} <strong class="text-danger">*</strong></label>
                <input type="text" dir="ltr" class="form-control" name="{{$name}}" value="{{ $sc->$name }}" />
            </div>
        @endforeach

        {{-- <div class="col-md-6 mb-3">
            <label>{{__('global.site_head_code')}}</label>
            <textarea class="form-control code" rows="7" name="head_code">{{ $sc->head_code }}</textarea>
        </div> --}}

        {{-- <div class="col-md-6 mb-3">
            <label>{{__('global.site_footer_code')}}</label>
            <textarea class="form-control code" rows="7" name="footer_code">{{ $sc->footer_code }}</textarea>
        </div> --}}
        
        <div class="col-md-6 mb-3">
            <label>{{__('global.map')}}</label>
            <textarea class="form-control code" rows="7" name="map">{{ $sc->map }}</textarea>
        </div>
        <div class="col-12"></div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-facebook"></i> Facebook</label>
            <input type="text" dir="ltr" class="form-control" name="facebook" value="{{ $sc->facebook }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-twitter"></i> Twitter</label>
            <input type="text" dir="ltr" class="form-control" name="twitter" value="{{ $sc->twitter }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-instagram"></i> instagram</label>
            <input type="text" dir="ltr" class="form-control" name="instagram" value="{{ $sc->instagram }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-linkedin"></i> Linkedin</label>
            <input type="text" dir="ltr" class="form-control" name="linkedin" value="{{ $sc->linkedin }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-youtube"></i> Youtube</label>
            <input type="text" dir="ltr" class="form-control" name="youtube" value="{{ $sc->youtube }}" />
        </div>
            
        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-telegram"></i> Telegram</label>
            <input type="text" dir="ltr" class="form-control" name="telegram" value="{{ $sc->telegram }}" />
        </div>
            
        <div class="col-md-4 mb-3">
            <label><i class="fa-brands fa-tiktok"></i> Tiktok</label>
            <input type="text" dir="ltr" class="form-control" name="tiktok" value="{{ $sc->tiktok }}" />
        </div>

        <div class="col-md-4 mb-3">
            <label><i class="fab fa-fw fa-whatsapp"></i> Whatsapp</label>
            <input type="text" dir="ltr" class="form-control" name="whatsapp" value="{{ $sc->whatsapp }}" placeholder="https://wa.me/+201021464469" />
        </div>

        <div class="col-12 mt-3 text-center">
            <button class="btn btn-primary" onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}">{{ __('global.btn_update') }}</button>
        </div>
    </form>
@endsection