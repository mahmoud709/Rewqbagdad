@extends('layout.front.app')
@section('title', __('front.iraqmeter'))

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

        .btns {
            bottom: 0;
            right: 0;
            left: 0;
        }
    </style>

    <section class="about-us-sec my-5">
        <div class="container">
            <div class="iraq-meter row py-3 justify-content-center align-items-center">
                <div class="col-lg-8">
                    <strong class="fs-2 d-block mb-3 text-white">
                        {{ __('front.iraqmeter') }}
                    </strong>
                    {!! $iraqmeterInfo->translation->content !!}
                    <div class="col-lg-6">
                        <div class="text">
                            <figure class="admin-thumb">
                                <img width="27" height="27" src="{{ $iraqmeterInfo->proejct_manager_img }}"
                                    alt="admin-img">
                            </figure>
                            <h4>
                                <a href="#">مدير المشروع : <span
                                        class=" magazine-emp-namecolor text-white">{{ $iraqmeterInfo->translation->project_manager }}</span></a>
                            </h4>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="img-box text-center border-0 rounded-30">
                        <img src="{{ $iraqmeterInfo->img }}" alt="aboutImage" class=" w-50">
                    </div>
                </div>
            </div>
        </div>

    </section>


    <section class="title with-gold mt-2 ">
        <div class="container">
            <div class="row justify-center">
                <div class="col-lg-12 text-center section-heading mx-auto">
                    <h2 class="pb-30 text-center shadow-sm mx-auto rounded-30 my-5 p-3">
                        <a href="{{ route('iraqmeter.allsurvey') }}" class="font-bold ">{{ __('front.surveys') }}</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>


    @if (!$IraqmeterSurveys->isEmpty())
        <section class="our-surveys my-5 pb-5">
            <div class="container">
                <div class="section-title text-right pb-30">
                </div>
                <div class="row overflow-hidden" data-aos="zoom-in" data-aos-duration="1000">

                    <div class="swiper-container overflow-hidden">
                        <div class="news-block-two swiper-wrapper">

                            @foreach ($IraqmeterSurveys as $IraqmeterSurvey)
                                <div class="swiper-slide position-relative">
                                    <a class="" href="{{ route('iraqmeter.serveyDetails', $IraqmeterSurvey->slug) }}"
                                        title="{{ $IraqmeterSurvey->translation->title }}">
                                        <div class="inner-box-book">
                                            <div class="img-box">
                                                <img src="{{ $IraqmeterSurvey->photo }}"
                                                    alt="{{ $IraqmeterSurvey->translation->title }}">
                                            </div>
                                            <div class="content">
                                                <p class="py-4">{{ $IraqmeterSurvey->translation->title }}</p>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="btns d-flex justify-content-around align-items-center position-absolute ">
                                        <a href="{{ $IraqmeterSurvey->pdf }}" target="_blank" class="p-2 rounded "
                                            style="margin-left: 10px">{{ __('front.read_more') }}</a>
                                        <a href="{{ route('iraq.bookingBook', $IraqmeterSurvey->slug) }}" target="_blank"
                                            class="p-2 rounded">{{ __('front.reserve_copy') }}</a>
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




    <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-5">
        <h2 class="font-bold p-3">{{ __('front.request_questionnaire') }}</h2>
    </div>
    <section class="contact-page-section asking asking-visit">
        <div class="container p-5">
            <form class="row" action="{{ route('iraqmeter.requestQuestionnaire') }}" method="post">@csrf
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
                <div class="col-12 d-flex form-group">
                    <button class="theme-btn btn-style-two bg-green">
                        <span class="txt">{{ __('front.btn_send') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <section class="vector-about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <img src="{{ url('front') }}/assets/img/vector-bg.png" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6">
                    <img src="{{ url('front') }}/assets/img/meters.png" class="top-img img-fluid" alt="">
                    <div class="content-box">
                        <p>
                            أو يمكنكم التواصل مباشرةً معنا
                        </p>
                        <ul class="social-box">
                            <a href="https://www.facebook.com/IRAQMETER">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/facebook.png" alt="">
                                    عراق ميتر
                                </li>
                            </a>
                            <a href="https://www.instagram.com/iraq_meter24/">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/insta.png" alt="">
                                    عراق ميتر
                                </li>
                            </a>
                            <li>
                                <img src="{{ url('front') }}/assets/img/email.png" alt="">
                                <a href="mailto:iraq_meter@gamil.com">iraq_meter@gamil.com</a>
                            </li>
                            <a href="tel:+964 783 577 4084">
                                <li>
                                    <img src="{{ url('front') }}/assets/img/whatsapp.png" alt="">
                                    +964 783 577 4084
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
        var swipers = new Swiper(".our-surveys .swiper-container", {
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
@endsection
