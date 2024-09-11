@extends('layout.front.app')
@section('title', $data->translation->title)

@section('description', filter_var($data->translation->description, FILTER_SANITIZE_STRING))

@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{langUrl()}}">{{__('front.home')}} </a></li>
                <li class="breadcrumb-item"><a href="{{url()->current()}}">{{__('front.electronic_service')}} </a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>
</section>

<section class="ask-adding mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-page">@yield('title')</div>
            </div>
            <div class="col-lg-12">
                @if(!empty($data->translation->description))
                    <div class="box">
                        {{-- <div class="title"><p>{{__('front.tasks')}}</p></div> --}}
                        <div>{!! $data->translation->description !!}</div>
                    </div>
                @endif

                @if(!empty($data->translation->content))
                    <div class="box mt-5">
                        {{-- <div class="title"><p>{{__('front.targets')}}</p></div> --}}
                        <div>{!! $data->translation->content !!}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="titles mt-5">
    <div class="container">
        <div class="title">
            <h2>{{__('front.contact_form')}}</h2>
            <p class="text-shadow-0">{{__('front.request_survey_message')}}</p>
        </div>
    </div>
</section>


<section class="contact-page-section asking">
    <div class="container p-5">
        <form class="row" method="post" action="{{ url()->current() }}">@csrf
            <div class="form-column col-lg-8 col-md-6 col-sm-12">
                <div class="inner-column">
                    <div class="contact-form">

                        @if( $errors->all() )
                            @foreach ($errors->all() as $message)
                                <div class="alert alert-warning p-1 mb-1"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @endforeach
                        @endif

                        <div id="contact-form" novalidate="novalidate">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="survey_title"> <span class="req">*</span> {{__('front.survey_title')}}</label>
                                    <input type="text" name="survey_title" required value="{{old('survey_title')}}" placeholder="{{__('front.survey_title')}}">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.purpose_of_survey')}}</label>
                                    <input type="text" name="purpose_of_survey" required value="{{old('purpose_of_survey')}}" placeholder="{{__('front.purpose_of_survey')}}">
                                </div>
                                {{-- <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <div class="row">
                                        <div class="col-lg-3">
                                    <label for="email"> <span class="req">*</span> {{__('front.type')}} </label>
                                        </div>
                                       <div class="col-lg-3">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="type" value="ذكر" checked>{{__('front.male')}}
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                       </div>
                                       <div class="col-lg-3">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="type" value="انثى">{{__('front.female')}}
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                       </div>
                                       <div class="col-lg-3">
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="radio1" name="type" value="ذكر و انثى">{{__('front.male_female')}}
                                            <label class="form-check-label" for="radio1"></label>
                                        </div>
                                       </div>
                                    </div>

                                </div> --}}
                                {{-- <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <div class="d-flex justify-content-between">
                                        <label for="email"> <span class="req">*</span> {{__('front.age_range')}} </label>
                                        <label for="email"> {{__('front.from')}} </label>
                                        <input type="text" name="age_range_from" required value="{{old('age_range_from')}}" class="w-25">
                                        <label for="email"> {{__('front.to')}} </label>
                                        <input type="text" name="age_range_to" required value="{{old('age_range_to')}}" class="w-25">
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.number_of_sample')}}</label>
                                    <input type="text" name="number_of_sample" required value="{{old('number_of_sample')}}" placeholder="{{__('front.number_of_sample')}}">
                                </div> --}}

                                <div class="title title-before d-grid justify-content-center align-items-center mt-5">

                                    <h2>{{__('front.personal_info')}}</h2>

                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span>  {{__('front.name')}}</label>
                                    <input type="text" name="name" required value="{{old('name')}}" placeholder="{{__('front.name')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="email"> <span class="req">*</span>  {{__('front.email')}}</label>
                                    <input type="email" name="email" required value="{{old('email')}}" placeholder="{{__('front.email')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="tel"> <span class="req">*</span>  {{__('front.phone')}}</label>
                                    <input type="tel" name="phone" required value="{{old('phone')}}" placeholder="{{__('front.phone')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 form-group d-flex">
                <button class="theme-btn btn-style-two bg-green">
                    <span class="txt">{{__('front.btn_send')}}</span>
                </button>
            </div>
        </form>
    </div>
</section>


@endsection


