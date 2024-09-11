@extends('layout.front.app')
@section('title', __('front.rewaq'))

@section('description', $rewaq->translation->content)
@section('page_img', $rewaq->img)

@section('content')

    <style>
        .section-heading {
            width: fit-content;
        }

        .section-heading h2 {
            color: var(--new-color);
        }

        .book {
            height: auto;
            margin-bottom: 20px;
        }

        .inner-box-book .content {
            line-clamp: 3 !important;
        }


        .book a img {
            height: 400px !important;
        }

        .book .pb-3,
        .book .pt-3 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

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

        .prevs1,
        .nexts {
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

        .nexts {
            right: 20px;
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


        @media (max-width:767px) {
            .content p {
                padding: 0px !important;
            }

            .inner-box-book .content {
                padding-bottom: 0px !important;
            }
        }
    </style>

    {{-- bg-white-greding-green --}}
    <section class="about-us-sec my-5  ">
        <div class="container">
            <div class="row py-3 justify-content-center align-items-center">
                <div class="col-lg-8">
                    <strong class="fs-2 d-block mb-3 text-white">
                        @yield('title')
                    </strong>
                    <p>{!! $rewaq->translation->content !!}</p>
                    <div class="row">

                        @foreach ($teams as $team)
                            <div class="col-lg-6">
                                <div class="text gap-1">
                                    <figure class="admin-thumb">

                                        <img width="27" height="27" src="{{ $team->img }}"
                                            alt="{{ $team->translation->name }}">

                                    </figure>
                                    <h4>
                                        <a href="#">{{ $team->translation->job_title }}: <span
                                                class="magazine-emp-namecolor text-white">{{ $team->translation->name }}</span></a>
                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="img-box text-center shadow-sm rounded-30">
                        <img src="{{ $rewaq->img }}" alt="{{ __('front.rewaq') }}" class="border-0 w-50">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <a href="{{ route('rewaq.versions') }}">
        <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
            <h2 class="font-bold p-3">{{ __('front.versions') }}</h2>
        </div>
    </a>
    @if (!$books->isEmpty())
        <section class="our-books">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($books as $book)
                                <div class="swiper-slide position-relative">
                                    <a class="" href="{{ langUrl('/rewaq/book/' . $book->slug) }}"
                                        title="{{ $book->translation->title }}">
                                        <div class="inner-box-book">
                                            <div class="img-box">
                                                <img src="{{ $book->img }}" alt="{{ $book->translation->title }}">
                                            </div>
                                            <div class="content">
                                                <p class="py-4">{{ $book->translation->title }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="btns d-flex justify-content-around align-items-center position-absolute ">
                                        <a href="{{ $book->index_url }}" target="_blank"
                                            class="p-2 rounded special_btn">{{ __('front.read_more') }}</a>
                                        <a href="{{ route('rewaq.bookingBook', $book->slug) }}" target="_blank"
                                            class="p-2 rounded special_btn">{{ __('front.reserve_copy') }}</a>
                                    </div>
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
        <a href="{{ route('rewaq.videos') }}">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.videos') }}</h2>
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

    <section class="my-5 videos-sec">
        <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
            <h2 class="font-bold p-3">{{ __('front.contact_us') }}</h2>
        </div>
    </section>
    <section class="contact-page-section asking asking-visit">
        <div class="container p-5">
            <form class="row" action="{{ route('rewaq.contact') }}" method="post">
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
                                        <label for="name"> <span class="req">*</span>
                                            {{ __('front.name') }}</label>
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
                                            {{ __('front.how_help') }}</label>
                                        <textarea name="how_help" required placeholder="{{ __('front.how_help') }}">{{ old('list_visitors') }}</textarea>
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
                        <p>{{ __('front.follow-us-text') }}</p>

                        <ul class="social-box">
                            <a href="https://www.facebook.com/alrewaqpublishinghouse">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/facebook.png" alt="facebook">
                                    {{ __('front.rewaq') }}
                                </li>
                            </a>
                            <a href="https://www.instagram.com/daralrewaqiq/">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/insta.png" alt="instgram">
                                    {{ __('front.rewaq') }}
                                </li>
                            </a>
                            <li>
                                <img src="{{ url('front') }}/assets/img/email.png" alt="email">
                                <a href="mailto:dar@rewaqbaghdad.org">dar@rewaqbaghdad.org</a>
                            </li>
                            <a href="tel:+9647835774081">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/whatsapp.png" alt="phone-num">
                                    +9647835774081
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
