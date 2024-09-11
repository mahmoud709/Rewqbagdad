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
                @if (!empty($data->translation->description))    
                    <div class="box">
                        <div>{!! $data->translation->description !!}</div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<section class="titles mt-10">
    <div class="container">
        <div class="title">
            <h2>{{__('front.contact_form')}}</h2>
        </div>
    </div>
</section>

<section class="contact-page-section asking">
    <div class="container">
        <div class="row">
            <div class="form-column col-lg-12 col-md-6 col-sm-12">
                <div class="inner-column">
                    <div class="contact-form">
                        @if( $errors->all() )
                            @foreach ($errors->all() as $message)
                                <div class="alert alert-warning p-1 mb-1"><i class="fas fa-exclamation-triangle"></i> {{ $message }}</div>
                            @endforeach
                        @endif
                        <form method="post" id="contact-form" action="{{url()->current()}}" enctype="multipart/form-data">@csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="name"> <span class="req">*</span> {{__('front.full_name')}}</label>
                                    <input type="text" name="full_name" value="{{old('full_name')}}" required placeholder="{{__('front.full_name')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="email"> <span class="req">*</span> {{__('front.email')}}</label>
                                    <input type="email" name="email" required value="{{old('email')}}" placeholder="{{__('front.email')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="email"> <span class="req">*</span> {{__('front.phone')}}</label>
                                    <input type="tel" name="phone" required value="{{old('phone')}}" placeholder="{{__('front.phone')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="email"> <span class="req">*</span> {{__('front.governorate')}}</label>
                                    <input type="text" name="governorate" value="{{old('governorate')}}" required placeholder="{{__('front.governorate')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.home_adress')}}</label>
                                    <input type="text" name="home_adress" required value="{{old('home_adress')}}" placeholder="{{__('front.home_adress')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span>  {{__('front.interests')}}</label>
                                    <input type="text" name="interests" required value="{{old('interests')}}" placeholder="{{__('front.interests')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.school_studying')}}</label>
                                    <input type="text" name="school_studying" required value="{{old('school_studying')}}" placeholder="{{__('front.school_studying')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.number_research')}}</label>
                                    <input type="text" name="number_research" required value="{{old('number_research')}}" placeholder="{{__('front.number_research')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.job_position')}}</label>
                                    <input type="text" name="job_position" required value="{{old('job_position')}}" placeholder="{{__('front.job_position')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.the_activities')}}</label>
                                    <input type="text" name="the_activities" required value="{{old('front.the_activities')}}" placeholder="{{__('front.the_activities')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.cv')}}</label>
                                    <input type="file" accept="application/pdf" name="cv" required value="{{old('cv')}}" placeholder="{{__('front.cv')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.years_service')}}</label>
                                    <input type="text" name="years_service" required value="{{old('years_service')}}" placeholder="{{__('front.years_service')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <button class="theme-btn btn-style-two bg-green">
                                        <span class="txt">{{__('front.btn_send')}}</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


