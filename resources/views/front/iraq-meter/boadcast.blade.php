@extends('layout.front.app')
@section('title', 'boadcast')

@section('content')


    <style>
        .next {
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

        .inner-box-book .content {
            padding: 0;
        }
        .inner-box-book .content :first-of-type {
            margin-top: 20px;
        }

        .next i,
        .prev i {
            font-size: 20px;
            color: #fff;
        }

        .prev {
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
        .btns a {
            background-color: var(--new-color);
            color: var(--white-color);
            transition: .2s all linear;
        }

        .btns a:hover {
            background-color: var(--secondary-color);

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
    </style>

    <section class="about-us-sec my-5">
        <div class="container">
            <div class="iraq-meter row py-3 justify-content-center align-items-center">
                <div class="col-lg-8">
                    <strong class="fs-2 d-block mb-3 text-white">
                        {{__('front.bodcast_fakar')}}
                    </strong>
                    {!! $bodcastInfo->translation->content !!}
                    <div class="col-lg-6">
                        <div class="text">
                            <figure class="admin-thumb">
                                <img width="27" height="27" src="{{ $bodcastInfo->proejct_manager_img }}"
                                    alt="admin-img">
                            </figure>
                            <h4>
                                <a href="#">مدير المشروع : <span
                                        class=" magazine-emp-namecolor text-white">{{ $bodcastInfo->translation->project_manager }}</span></a>
                            </h4>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="img-box text-center border-0 rounded-30">
                        <img src="{{ $bodcastInfo->img }}" alt="aboutImage" class=" w-50">
                    </div>
                </div>
            </div>
        </div>

    </section>

    {{-- videos section --}}
    <section class="my-5 videos-sec">
        <a href="{{ route('bodcast.ourEpisodes') }}">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.our_episodes') }}</h2>
            </div>
        </a>
    </section>

    @if ($ourEpisodes)
        <section class="our-episodes">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($ourEpisodes as $video)
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
                    <div class="nexts next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="prevs prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif
    {{-- videos section --}}
    <section class="my-5 videos-sec">
        <a href="{{ route('bodcast.afkarFakar') }}">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.our_articles') }}</h2>
            </div>
        </a>
    </section>

    @if ($afkarFakar)
        <section class="afkar-fakar">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($afkarFakar as $video)
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
                    <div class="nexts1 next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="prevs1 prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="my-5 videos-sec">
        <a href="{{ route('bodcast.blogs') }}">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.our_blogs') }}</h2>
            </div>
        </a>
    </section>
    @if ($blogs)
        <section class="our-blogs">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($blogs as $blog)
                                <div class="swiper-slide position-relative">
                                    <a class="" href="{{ route('bodcast.blog-details', $blog->slug) }}" title="{{ $blog->translation->title }}">
                                        <div class="inner-box-book">
                                            <div class="img-box">
                                                <img src="{{ $blog->img }}" alt="{{ $blog->translation->title }}">
                                            </div>
                                            <div class="content">
                                                <p class="">{{ $blog->translation->title }}</p>
                                            </div>
                                            <div class="content">
                                                <p class="">{{ $blog->translation->description }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="btns d-flex justify-content-start align-items-start">
                                        <a href="{{ $blog->pdf }}" target="_blank"
                                            class="p-2 rounded ">{{ __('front.read_more') }}</a>
                                        {{-- <a href="#" target="_blank"
                                            class="p-2 rounded">{{ __('front.reserve_copy') }}</a> --}}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="nexts-blog next">
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                    <div class="prevs-blog prev">
                        <i class="fa-solid fa-chevron-left"></i>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="my-5 videos-sec">
        <a href="">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">تواصل معنا</h2>
            </div>
        </a>
    </section>
    <section class="contact-page-section asking asking-visit">
        <div class="container p-5">
            <form class="row justify-content-start align-items-start" action="{{ route('bodcast.contactus') }}" method="post">@csrf
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
                                            placeholder="{{ __('front.company_name') }}">
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
                                    <div class="d-flex col-lg-12 col-md-12 col-sm-12 form-group">
                                        <button class="theme-btn btn-style-two bg-green">
                                            <span class="txt">{{ __('front.btn_send') }}</span>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
    <section class="vector vector-2 booking-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <img src="{{ url('/front/assets/img/micknew.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-12">
                    <p>
                        يمكنك زيارة منصتنا للأستماع الى البودكاست بكامل حلقاته , كذلك يمكنك مشاهدتها <br> على اليوتوب ايضا.
                    </p>
                    <div class="btns">
                        <a href="https://linktr.ee/fakker.podcast" class="btn btn-1">
                            للاستماع للبودكاست
                        </a>
                        <a href="https://www.youtube.com/channel/UCd_Jrcqu00p6Yj12w4DtshA/" class="btn btn-1">
                            الذهاب لليوتيوب
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="vector-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <img src="{{ url('/front/assets/img/vector-bg.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <img src="{{ url('/front/assets/img/micknew.png') }}" class="top-img img-fluid" alt="">
                    <div class="content-box">
                        <p>
                            أو يمكنكم التواصل مباشرةً معنا
                        </p>
                        <ul class="social-box">
                            <li>
                                <img src="{{ url('/front/assets/img/facebook.png') }}" alt="">

                                <a href="https://www.youtube.com/channel/UCd_Jrcqu00p6Yj12w4DtshA/" class="underline">
                                    Fakker-فکّر</a>
                            </li>
                            <li>
                                <img src="{{ url('/front/assets/img/insta.png') }}" alt="">
                                <a href="https://www.instagram.com/podcast_fakker/" class="underline">Fakker</a>
                            </li>
                            <li>
                                <img src="{{ url('/front/assets/img/email.png') }}" alt="">
                                <a href="mailto:podcastthink82@gmail.com">podcastthink82@gmail.com</a>
                            </li>
                            <li>
                                <img src="{{ url('/front/assets/img/whatsapp.png') }}" alt="">
                                +9647837803788
                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('js')
    <script>
        var swipers = new Swiper(".our-episodes .swiper-container", {
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
        var swipers2 = new Swiper(".afkar-fakar .swiper-container", {
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
                prevEl: ".prevs1",
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
        var blogs = new Swiper(".our-blogs .swiper-container", {
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
                nextEl: '.nexts-blog',
                prevEl: ".prevs-blog",
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
