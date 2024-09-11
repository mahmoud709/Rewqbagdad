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

<section class="titles mt-5">
    <div class="container">
        <div class="title">
            <h2>{{__('front.contact_form')}}</h2>
        </div>
    </div>
</section>

<section class="contact-page-section asking asking-visit">
    <div class="container p-5">
        <form class="row" action="{{url()->current()}}" method="post">@csrf
            <div class="form-column col-lg-8 col-md-12 col-sm-12">
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
                                    <label for="name"> <span class="req">*</span> {{__('front.company_name')}}</label>
                                    <input type="text" name="company_name" required value="{{old('company_name')}}" placeholder="{{__('front.company_name')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.purpose_visit')}}</label>
                                    <input type="text" name="purpose_visit" value="{{old('purpose_visit')}}" required placeholder="{{__('front.purpose_visit')}}">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                    <label for="date"> <span class="req">*</span> {{__('front.date_of_visit')}}</label>
                                    <input type="date" name="date_of_visit" value="{{old('date_of_visit')}}" required placeholder="{{__('front.date_of_visit')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.visitor_name')}}</label>
                                    <input type="text" name="visitor_name" value="{{old('visitor_name')}}" required placeholder="{{__('front.visitor_name')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="email"> <span class="req">*</span> {{__('front.email')}}</label>
                                    <input type="email" name="email" required value="{{old('email')}}" placeholder="{{__('front.email')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.position')}}</label>
                                    <input type="text" name="position" required value="{{old('position')}}" placeholder="{{__('front.position')}}">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <label for="text"> <span class="req">*</span> {{__('front.list_visitors')}}</label>
                                    <textarea name="list_visitors" required placeholder="{{__('front.list_visitors')}}">{{old('list_visitors')}}</textarea>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                <button class="theme-btn btn-style-two bg-green">
                    <span class="txt">{{__('front.btn_send')}}</span>
                </button>
            </div>
        </form>
    </div>
</section>

@endsection


