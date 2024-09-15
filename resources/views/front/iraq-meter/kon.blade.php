@extends('layout.front.app')
@section('title', 'Kon')

@section('content')
    <style>
        .nexts1 {
            background-color: #808080;
            width: 45px;
            height: 45px;
            z-index: 2;
            position: absolute;
            bottom: 50%;
            transform: translate(0, -50%);
            border-radius: 50%;
            right: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nexts1 i,
        .prevs1 i {
            font-size: 20px;
            color: #fff;
        }

        .prevs1 {
            background-color: #808080;
            width: 45px;
            height: 45px;
            z-index: 2;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            bottom: 50%;
            transform: translate(0, -50%);
            border-radius: 50%;
            left: 20px;
        }

        .nexts i,
        .prevs i {
            font-size: 20px;
            color: #fff;
        }

        .prevs {
            background-color: #808080;
            width: 45px;
            height: 45px;
            z-index: 2;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            bottom: 50%;
            transform: translate(0, -50%);
            border-radius: 50%;
            left: 20px;
        }

        .inner-box-book .content {
            padding: 0;

        }
        .inner-box-book .content :first-of-type {
            margin-top: 30px;

        }
    </style>

    <section class="about-us-sec my-5">
        <div class="container">
            <div class="iraq-meter row py-3 justify-content-center align-items-center">
                <div class="col-lg-8">
                    <strong class="fs-2 d-block mb-3 text-white">
                        {{__('front.about_kon')}}
                    </strong>
                    {!! $kon->translation->content !!}
                    <div class="col-lg-6">
                        <div class="text gap-1">
                            <figure class="admin-thumb">
                                <img width="27" height="27" src="{{ $kon->proejct_manager_img }}"
                                    alt="admin-img">
                            </figure>
                            <h4>
                                <a href="#"> {{ __('front.project_manager') }} : <span
                                        class=" magazine-emp-namecolor text-white">{{ $kon->translation->project_manager }}</span></a>
                            </h4>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="img-box text-center border-0 rounded-30">
                        <img src="{{ $kon->img }}" alt="aboutImage" class=" w-50">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <section class="title with-gold mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section-heading mx-auto">
                    <h2 class="shadow-sm mx-auto rounded-30 p-3 font-bold">
                        <a href="{{ route('kon.allKon') }}">{{__('front.kon_training')}}</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    @if (!$konTrainings->isEmpty())
        <section class="our-trainings mt-5">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($konTrainings as $training)
                                <div class="swiper-slide position-relative">
                                    <a class="" href="{{ route('kon.trainingDetails', $training->slug) }}"
                                        title="{{ $training->translation->title }}">
                                        <div class="inner-box-book">
                                            <div class="img-box">
                                                <img src="{{ $training->photo }}"
                                                    alt="{{ $training->translation->title }}">
                                            </div>

                                            <div class="content">
                                                <p>{{ $training->translation->title }}</p>
                                            </div>
                                            <div class="content">
                                                <p>{{ $training->translation->description }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nexts1">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="prevs1">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="title with-gold mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section-heading mx-auto">
                    <h2 class="my-5 text-center shadow-sm mx-auto rounded-30 font-bold p-3">
                        <a href="{{ route('kon.allUpcommingTrainings') }}">{{__('front.kon_upcommingtrainings')}}</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>
    @if (!$upcomingtrainings->isEmpty())
        <section class="our-trainings">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($upcomingtrainings as $upcomingtraining)

                            <div class="swiper-slide position-relative">
                                <a href="{{ route('kon.upcommingTrainingDetails', $upcomingtraining->slug) }}">
                                    <div class="pb-3 pt-3">
                                        <img src="{{ $upcomingtraining->photo }}" alt="{{ $upcomingtraining->translation->title }}"
                                            class="border-0 rounded" height="200px">
                                    </div>
                                    <small class="title-sec mb-1">
                                        <strong>{{ formatDate($upcomingtraining->created_at) }}</strong>
                                    </small>
                                    <br />
                                    <small class="title-sec mb-1">
                                        <strong>{{ __('front.priceTraining') }} : ${{ $upcomingtraining->price }} </strong>
                                    </small>
                                    <strong class="pt-1 pb-1 d-block">{{ $upcomingtraining->translation->title }}</strong>
                                    <p>{{ $upcomingtraining->translation->description }}</p>

                                </a>

                            </div>

                            @endforeach
                        </div>
                    </div>
                    <div class="nexts1">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="prevs1">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif
        {{-- videos section --}}
    <section class="my-5 videos-sec">
        <a href="{{ route('kon.videos') }}">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __("front.videos") }}</h2>
            </div>
        </a>
    </section>

    @if (!$videos->isEmpty())
        <section class="our-videos">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($videos as $video)
                                <div class="swiper-slide position-relative">
                                    <div class="meeting-event-box">
                                        <div class="content justify-content-left">
                                            <a id="copyVideo" data-videoUrl="{{ $video->video_url }}"
                                                class="share-btn copyVideo">
                                                <i class="fas fa-share"></i>
                                            </a>
                                        </div>
                                        <figure class="reveal-effect animated"><a href="{{ $video->video_url }}"
                                                data-fancybox>
                                                <i class="fas fa-play"></i></a>
                                            <img width="100%" height="100%" src="{{ $video->img }}"
                                                alt="{{ $video->translation->name }}"></a>
                                        </figure>
                                        <div class="content">
                                            <h5>
                                                {{ $video->translation->name }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nexts">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="prevs">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="title with-gold mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section-heading mx-auto">
                    <h2 class="my-5 text-center shadow-sm mx-auto rounded-30 font-bold p-3">
                        {{ __('front.requestTraining') }}
                    </h2>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-page-section asking asking-visit">
        <div class="container p-5">
            <form class="row" action="{{ route('kon.RequestTraining') }}" method="post">@csrf
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
                                        <label for="email"> <span class="req">*</span>
                                            {{ __('front.email') }}</label>
                                        <input type="email" name="email" required value="{{ old('email') }}"
                                            placeholder="{{ __('front.email') }}">
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="text"> <span class="req">*</span>
                                            {{ __('front.subject') }}</label>
                                        <textarea name="subject" required placeholder="{{ __('front.subject') }}">{{ old('list_visitors') }}</textarea>
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



    {{-- Follow-us ection --}}

    <section class="vector-about">
        <section class="my-5 videos-sec">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.follow_us') }}</h2>
            </div>
        </section>
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <img src="{{ url('front') }}/assets/img/vector-bg.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    {{-- <img src="{{ url('front') }}/assets/img" class="top-img img-fluid" alt=""> --}}
                    <div class="content-box">
                        <p>{{__('front.follow-us-text')}}</p>
                        <ul class="social-box">
                            <a href="https://www.facebook.com/profile.php?id=100090179589046">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/facebook.png" alt="">
                                    {{ __('front.kon') }}
                                </li>
                            </a>
                            <a href="https://www.instagram.com/kun_fortraining">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/insta.png" alt="">
                                    {{ __('front.kon') }}
                                </li>
                            </a>
                            <li>
                                <img src="{{ url('front') }}/assets/img/email.png" alt="">
                                <a href="mailto:zahraa@rewaqbaghdad.org">zahraa@rewaqbaghdad.org</a>
                            </li>
                            <a href="tel:+9647835776157">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/whatsapp.png" alt="">
                                    +9647835776157
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        var swipers = new Swiper(".our-trainings .swiper-container", {
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
    </script>
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
