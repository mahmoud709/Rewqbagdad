@extends('layout.front.app')
@section('title', __('front.contact_us').' - '.__('front.khetab_magazine'))

@section('content')

<section class="breadcrumb-btns mt-5">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/khetab-magazine/publish/role') }}">{{__('front.publication_rules')}}</a></li>
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/khetab-magazine/editorial-board') }}">{{ __('front.editorial_board') }}</a></li>
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/khetab-magazine/contact-us')}}">{{__('front.contact_us')}}</a></li>
        </ul>
      </nav>
</section>

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item text-brown"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
                <li class="breadcrumb-item text-brown"><a href="{{ langUrl('/khetab-magazine') }}">{{__('front.khetab_magazine')}}</a></li>
                <li class="breadcrumb-item text-brown active">@yield('title')</li>
            </ol>
        </nav>
    </div>
</section>

<section class="titles mt-5 mb-10">
    <div class="container">
        <div class="title-page text-center d-block">@yield('title')</div>
    </div>
</section>


<section class="contact-page-section contact contact-brown">
    <div class="container bg-light-1 raduis-35 p-5">
        <p class="text-brown fs-3 fw-400">{{(__('front.alert_fill_form'))}}</p>
        <div class="titles mb-1 bg-0">
            <div class="container">
                <div class="title mt-3">
                    <h2>{{(__('front.contact_form'))}}</h2>
                </div>
            </div>
        </div>
    
        <div class="outer-box mt-0"> 
            <form class="row clearfix" action="{{url()->current()}}" method="post"> @csrf
                <div class="col-lg-12">
                    <div class="titles">
                        <div class="img-box">
                            <img src="/front/assets/img/icon.png.png" alt="@yield('title')">
                        </div>
                        <div class="text">
                            <h3>{{(__('front.easy_access'))}}</h3>
                            <p>{{__('front.answered_quickly')}}</p>
                        </div>
                    </div>
                </div>
                <div class="form-column col-lg-9 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="contact-form mt-1">
                           
                            @if( $errors->all() )
                                @foreach ($errors->all() as $message)
                                    <div class="alert alert-warning p-1 mb-1"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                                @endforeach
                            @endif
                            <div id="contact-form" novalidate="novalidate">
                                <div class="row clearfix justify-content-center align-items-basline">
                                    <div class="col-lg-3">
                                        <label for="text">{{__('front.name')}} <span class="req">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                        <input type="text" required value="{{old('name')}}" name="name">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="text">{{__('front.email')}} <span class="req">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                        <input type="email" required value="{{old('email')}}" name="email">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="text">{{__('front.phone')}} <span class="req">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                        <input type="tel" required value="{{old('phone')}}" name="phone">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="text">{{__('front.request_type')}} <span class="req">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                        <select class="wide" required name="request_type">
                                            <option @if(old('request_type')== __('front.request_visit_center')) selected @endif value="{{__('front.request_visit_center')}}">{{__('front.request_visit_center')}}</option>
                                            <option @if(old('request_type')== __('front.request_survey')) selected @endif value="{{__('front.request_survey')}}">{{__('front.request_survey')}}</option>
                                            <option @if(old('request_type')== __('front.request_host')) selected @endif value="{{__('front.request_host')}}">{{__('front.request_host')}}</option>
                                            <option @if(old('request_type')== __('front.membership_request')) selected @endif value="{{__('front.membership_request')}}">{{__('front.membership_request')}}</option>
                                            <option @if(old('request_type')== __('front.request_participation')) selected @endif value="{{__('front.request_participation')}}">{{__('front.request_participation')}}</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="text">{{__('front.subject')}} <span class="req">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                        <input type="text" required value="{{old('subject')}}" name="subject">
                                    </div>
                                    <div class="col-lg-3">
                                        <label for="text">{{__('front.the_message')}} <span class="req">*</span></label>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-12 form-group">
                                        <textarea required name="the_message">{{old('the_message')}}</textarea>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <button class="theme-btn btn-style-two">
                        <span class="txt">{{__('front.btn_send')}}</span>
                    </button>
                    {{-- <a href="#" class="theme-btn btn-style-two"><span class="txt">ارسال</span></a> --}}
                </div>
            </form>
        </div>
    </div>
</section>


<section class="map-wrapper brown mb-5">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
                <p class="mt-5 text-black fs-3 fw-400">{{__('front.alert_contact')}}</p>
            </div>
            <div class="col-lg-12">
                <strong class="d-block fs-4 mt-3 mb-3">{{__('front.the_info')}}</strong>
                <!-- <a href="#" class="mt-3 mb-3 d-flex theme-btn btn-style-two text-black justify-content-start float-right">
                    <span>
                        المقر الرئيسي

                    </span>
                </a> -->
            </div>
               <div class="row bg-light raduis-35 p-5">
                <div class="col-lg-6">
                    <ul class="contact">
                        <li>
                            <i class="fa-solid fa-location-dot"></i>
                            {{$SiteData->translation->address}}
                        </li>

                        @php
                            $magazine = \App\Models\Magazine::first();
                        @endphp
                        <li>
                            <i class="fa-solid fa-at"></i>
                            <a href="mailto:{{ $magazine->contact_email }}">{{ $magazine->contact_email }}</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone-volume"></i>
                                
                            <a href="tel:{{ $SiteData->phone }}">{{ $SiteData->phone }}</a>
                        </li>
                        <li>
                            <i class="fa-regular fa-clock"></i>
                            {{ $SiteData->translation->work_hours }}
                        </li>
                    </ul> 
                    <ul class="d-flex social-media justify-content-end align-items-center text-center">
                        @if(!empty($magazine->facebook))
                            <li><a target="_balnak" href="{{$magazine->facebook}}"><i class="fa-brands fa-facebook"></i></a></li>
                        @endif
                        @if(!empty($magazine->twitter))
                            <li><a href="{{$magazine->twitter}}" target="_blank"><i class="fa-brands fa-twitter"></i></a><li>
                        @endif
                        
                        @if(!empty($magazine->instagram))
                            <li><a href="{{$magazine->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a><li>
                        @endif
                        @if(!empty($magazine->linkedin))
                            <li><a href="{{$magazine->linkedin}}" target="_blank"><i class="fa-brands fa-linkedin"></i></a><li>
                        @endif
                        @if(!empty($magazine->youtube))
                            <li><a href="{{$magazine->youtube}}" target="_blank"><i class="fa-brands fa-youtube"></i></a><li>
                        @endif
                        @if(!empty($magazine->telegram))
                            <li><a href="{{$magazine->telegram}}" target="_blank"><i class="fa-brands fa-telegram"></i></a><li>
                        @endif
                        @if(!empty($magazine->tiktok))
                            <li><a href="{{$magazine->tiktok}}" target="_blank"><i class="fa-brands fa-tiktok"></i></a><li>
                        @endif
                        @if(!empty($magazine->whatsapp))
                            <li><a href="{{$magazine->whatsapp}}" target="_blank"><i class="fa-brands fa-whatsapp"></i></a><li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-6">{!!$SiteData->map!!}</div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"
        integrity="sha512-NqYds8su6jivy1/WLoW8x1tZMRD7/1ZfhWG/jcRQLOzV1k1rIODCpMgoBnar5QXshKJGV7vi0LXLNXPoFsM5Zg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection