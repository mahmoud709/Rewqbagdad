@extends('layout.front.app')
@section('title', __('front.booking_your_copy'))

@section('description')
@section('page_img')

@section('content')

 


    <section class="my-5 videos-sec">
        <a href="">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.booking_your_copy') }}</h2>
            </div>
        </a>
    </section>
    <section class="contact-page-section asking asking-visit">
        <div class="container p-5">
            <form class="row" action="{{ route('rewaq.mail.bookingBook') }}" method="post">
                @csrf
                <div class="form-column col-lg-8 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="contact-form">
                            @if ($errors->all())
                                @foreach ($errors->all() as $message)
                                    <div class="alert alert-warning p-1 mb-1"><i class="fas fa-exclamation-triangle"></i>
                                        {{ $message }}</div>
                                @endforeach
                            @endif
                            <div id="contact-form" novalidate="novalidate">
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="name"> <span class="req">*</span> {{ __('front.name') }}</label>
                                        <input type="text" name="name" required value="{{ old('name') }}"
                                            placeholder="{{ __('front.name') }}">
                                    </div>


                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="tel"> <span class="req">*</span>  {{__('front.phone')}}</label>
                                        <input type="tel" name="phone" required value="{{old('phone')}}" placeholder="{{__('front.phone')}}">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="name"> <span class="req">*</span> {{ __('front.name_version') }}</label>
                                        <input type="text" name="name_version" required value="{{ old('name_version',$survey->translation->title ) }}"
                                            placeholder="{{ __('front.name_version') }}">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="name"> <span class="req">*</span> {{ __('front.num_copies') }}</label>
                                        <input type="text" name="num_copies" required value="{{ old('num_copies') }}"
                                            placeholder="{{ __('front.num_copies') }}">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="text"> <span class="req">*</span>
                                            {{ __('front.personal_address') }}</label>
                                        <textarea name="personal_address" required placeholder="{{ __('front.personal_address') }}">{{ old('personal_address') }}</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 form-group d-flex">
                    <button class="theme-btn btn-style-two bg-green">
                        <span class="txt">{{ __('front.btn_send') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </section>




@endsection



@section('js')
<script>
    var swipers = new Swiper(".our-books .swiper-container", {
        spaceBetween: 50,
        centeredSlides: false,
        slidesPerView: 4,
        loop: true,
        rtl: true,
        keyboard: true,
        draggable: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: '.nexts1',
            prevEl: '.prevs1',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 20,
            }
        }
    });
    var swipers = new Swiper(".our-videos .swiper-container", {
        spaceBetween: 50,
        centeredSlides: false,
        slidesPerView: 4,
        loop: true,
        rtl: true,
        keyboard: true,
        draggable: true,
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: '.nexts',
            prevEl: '.prevs',
        },
        breakpoints: {
            640: {
                slidesPerView: 1,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2,
                spaceBetween: 20,
            }
        }
    });
</script>
@endsection
