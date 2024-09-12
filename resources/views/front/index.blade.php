@extends('layout.front.app')
{{-- @section('title', 'صفحة فارغة') --}}

{{-- @section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection --}}

{{-- @section('style')@endsection --}}

@section('js')
    <script>
        $(document).ready(function() {
            @if (!$activitiesCategory->isEmpty())


                @foreach ($activitiesCategory as $index => $activityCategory)

                    var swiper = new Swiper(".activities{{ $index }} .swiper-container", {
                        spaceBetween: 30,
                        centeredSlides: true,
                        slidesPerView: 3,
                        draggable: true,
                        loop: true,
                        rtl: true,
                        keyboard: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                        },
                        navigation: {
                            nextEl: '.swiper-button-next1',
                            prevEl: '.swiper-button-prev1',
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
                @endforeach
            @endif
        })
    </script>
@endsection

@section('content')
    <style>
        .news-section .card-body p {
            color: var(--new-color);
            font-size: 20px !important;
        }

        .slide-image {
            position: relative;
        }


        .slider_button {
            position: absolute;
            bottom: 0;
            left: 0;
            margin: 10px;
            background: rgb(141, 232, 255);
            border-radius: 4px;
            color: rgba(101, 101, 101, 0.784);
        }

        .inner-box .lower-content h5 {
            color: var(--new-color) !important;
        }

        .activties-category .swiper-wrapper {
            position: relative !important;
        }

        .swiper-button-next1 i {

            z-index: 2;
            background-color: #808080;
            border-radius: 50%;
            height: 45px;
            width: 45px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;

        }


        .swiper-button-prev1 i {

            z-index: 2;
            background-color: #808080;
            border-radius: 50%;
            height: 45px;
            width: 45px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;

        }

        .swiper-button-next1 {
            z-index: 2;
            position: absolute;
            top: 40%;
            transform: translate(0, -50%);

        }

        .swiper-button-prev1 {
            z-index: 2;
            position: absolute;
            top: 40%;
            transform: translate(0, -50%);
            left: 0;

        }
    </style>
    <div class="banner container-fluid">
        <div class="swiper-container">
            <div class="swiper mySwiper swiper-h">
                <div class="swiper-wrapper">
                    @foreach ($sliders as $slider)
                        <div class="swiper-slide">
                            @if (!empty($slider->btn_url))
                                <a target="{{ $slider->btn_target }}" href="{{ $slider->btn_url }}">
                                    <div class="slide-image">
                                        <img src="{{ $slider->img }}" alt="{{ $slider->translation->title }}">
                                        <button style="position: absolute" class="slider_button">عرض المزيد</button>
                                    </div>
                                </a>
                            @else
                                <div class="slide-image">
                                    <img src="{{ $slider->img }}" alt="{{ $slider->translation->title }}">
                                    <button style="position: absolute" class="slider_button">عرض المزيد</button>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    @if (!$Medianews->isEmpty())
        <section class="center-blogs mt-10">
            <div class="container">
                <div class="section-title justify-content-center text-center pb-30">
                    <a href="/media/center/news">
                        <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                            <h2 class="font-bold p-3">{{ __('front.center_news') }}</h2>
                        </div>
                    </a>
                </div>
                <div class="row d-flex align-items-center news-section" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="col-12 ">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($Medianews as $Medianew)
                                    <a href="{{ langUrl('/media/center/news/' . $Medianew->slug) }}">
                                        <div class="swiper-slide ">
                                            <div class="card border-0 shadow-none rounded">
                                                <img class="card-img-top" height="332" src="{{ $Medianew->slider_img }}"
                                                    alt="{{ $Medianew->translation->title }}">
                                                <div class="card-img-overlay">
                                                    <a href="{{ langUrl('/media/center/news/' . $Medianew->slug) }}"
                                                        class="btn btn-dark btn-sm text-white">{{ __('front.latest_news') }}</a>
                                                    <a href="{{ langUrl('/media/center/news/' . $Medianew->slug) }}"
                                                        class="btn btn-light btn-sm">{{ formatDate($Medianew->created_at) }}</a>
                                                </div>
                                                <div class="card-body">
                                                    {{-- <h4 class="card-title">{{$Medianew->translation->title}}</h4> --}}
                                                    {{-- card-text --}}
                                                    <p class="py-2">{{ $Medianew->translation->description }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="nexts"></div>
                        <div class="prevs"></div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="center-activity mt-8">
        <div class="container">
            <div class="section-title justify-content-center pb-30 ">
                <a href="/activities">
                    <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                        <h2 class="font-bold p-3">{{ __('front.activities') }}</h2>
                    </div>
                </a>
            </div>
        </div>
    </section>
    @if (!$activitiesCategory->isEmpty())
        @foreach ($activitiesCategory as $index => $activityCategory)
            <section class="mt-6 activities{{ $index }} activties-category">
                <div class="container">
                    <a href="/activities">
                        <div class="section-title text-right pb-30">
                            <h2 class="title">{{ $activityCategory->translation->name }}</h2>
                        </div>
                    </a>
                    <div class="row d-flex align-items-center news-section">
                        <div class="col-12 ">
                            <div class="swiper-container ">
                                <div class="swiper-wrapper">
                                    @foreach ($activityCategory->activites as $key => $row)
                                        <div class="swiper-slide">
                                            <div class="card" style="border: none ">
                                                <a href="{{ langUrl('/activity/' . $row->slug) }}">
                                                    <div class="img-box">
                                                        <img style="height: 380px" class="card-img-top"
                                                            src="{{ $row->img }}" alt="{{ $row->translation->title }}"
                                                            class="border-0">
                                                    </div>
                                                </a>

                                                <div class="card-body">
                                                    <a href="{{ langUrl('/activity/' . $row->slug) }}">
                                                        <small class="title-sec mb-1">
                                                            <strong>{{ formatDate($row->created_at) }}</strong>
                                                        </small>
                                                        <strong
                                                            class="pt-1 pb-1 d-block">{{ $row->translation->title }}</strong>
                                                        <div>{{ $row->translation->description }}</div>
                                                        <strong
                                                            class="department-name mb-4">{{ $row->category->name }}</strong>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-button-next1"> <i class="fa-solid fa-chevron-right"></i></i></div>
                                <div class="swiper-button-prev1"> <i class="fa-solid fa-chevron-left"></i></div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endforeach
    @endif


    {{-- Projects Section --}}
    <section class="container">
        <div class="section-title justify-content-center text-right pb-30">
                <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                    <h2 class="font-bold p-3">{{ __('front.project_marakaz') }}</h2>
                </div>
        </div>
        <div class="projects row justify-content-center align-items-center">
            <div class="col-6 col-md-3 my-2">
                <a href="/magazine">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/alrewaq.png') }}" alt="project-img1">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="https://www.iamtheparliament.com" target="_self">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/img2.png') }}" alt="project-img2">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="/rewaq">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/img3.png') }}" alt="project-img3">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="/medad">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/img4.png') }}" alt="project-img4">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="/etmam">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/img5.png') }}" alt="project-img5">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="/iraq/meter">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/img6.png') }}" alt="project-img6">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="/boadcast">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/img7.png') }}" alt="project-img7">
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 my-2">
                <a href="/kon">
                    <div class="project-img mx-auto">
                        <img src="{{ asset('images/projects/kun.png') }}" alt="project-img8">
                    </div>
                </a>
            </div>
        </div>
    </section>

@endsection
