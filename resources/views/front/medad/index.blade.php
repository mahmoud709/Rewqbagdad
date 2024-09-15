@extends('layout.front.app')
@section('title', __('front.medad'))

{{-- @section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection --}}

{{-- @section('style')@endsection --}}

@section('js')
    <script>
        $(document).ready(function() {
            @if (!$versioncategory->isEmpty())


                @foreach ($versioncategory as $index => $versionCategory)

                    var swiper = new Swiper(".versions{{ $index }} .swiper-container", {
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

    <section class="about-us-sec my-5">
        <div class="container">
            <div class="iraq-meter row py-3 justify-content-center align-items-center">
                <div class="col-lg-8">
                    <strong class="fs-2 d-block mb-3 text-white">
                        {{ __('front.medad') }}
                    </strong>
                    {!! $medadInfo->translation->content !!}
                    <div class="col-lg-6">
                        <div class="text">
                            <figure class="admin-thumb">
                                <img width="27" height="27" src="{{ $medadInfo->proejct_manager_img }}"
                                    alt="admin-img">
                            </figure>
                            <h4>
                                <a href="#">{{__('front.project_manager')}} : <span
                                        class=" magazine-emp-namecolor text-white">{{ $medadInfo->translation->project_manager }}</span></a>
                            </h4>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">
                    <div class="img-box text-center border-0 rounded-30">
                        <img src="{{ $medadInfo->img }}" alt="aboutImage" class=" w-50">
                    </div>
                </div>
            </div>
        </div>

    </section>
    @if (!$versioncategory->isEmpty())
        @foreach ($versioncategory as $index => $versioncategory)
            <section class="mt-6 versions{{ $index }} activties-category">
                <div class="container">
                    <a href="/versions/category/{{$versioncategory->slug}}">
                        <div class="section-title text-right pb-30">
                            <h2 class="title">{{ $versioncategory->translation->name }}</h2>
                        </div>
                    </a>
                    <div class="row d-flex align-items-center news-sction">
                        <div class="col-12 ">
                            <div class="swiper-container ">
                                <div class="swiper-wrapper">
                                    @foreach ($versioncategory->versions as $key => $row)
                                        <div class="swiper-slide">
                                            <div class="card" style="border: none ">
                                                <a href="{{ langUrl('/version/' . $row->slug) }}">
                                                    <div class="img-box">
                                                        <img style="height: 380px" class="card-img-top"
                                                            src="{{ $row->img }}" alt="{{ $row->translation->title }}"
                                                            class="border-0">
                                                    </div>
                                                </a>

                                                <div class="card-body">
                                                    <a href="{{ langUrl('/version/' . $row->slug) }}">
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
    <section class="my-5 videos-sec">
        <a href="">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.request_publish') }}</h2>
            </div>
        </a>
    </section>
    <section class="contact-page-section asking asking-visit">
        <div class="container p-5">
            <form class="row justify-content-start align-items-start" action="{{ route('medad.request.publish') }}"
                method="post" enctype="multipart/form-data">
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
                                        <label for="name"> <span class="req">*</span>
                                            {{ __('front.job_title') }}</label>
                                        <input type="text" name="job_title" required value="{{ old('job_title') }}"
                                            placeholder="{{ __('front.job_title') }}">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="email"> <span class="req">*</span>
                                            {{ __('front.email') }}</label>
                                        <input type="email" name="email" required value="{{ old('email') }}"
                                            placeholder="{{ __('front.email') }}">
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                        <label for="text"> <span class="req">*</span>
                                            {{ __('front.subject_research') }}</label>
                                        <textarea name="subject_research" required placeholder="{{ __('front.subject_research') }}">{{ old('list_visitors') }}</textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <label for="text"> <span class="req">*</span>
                                            {{ __('front.request_publish') }}</label>
                                        <input type="file" accept="application/pdf" name="request_publish[]" required
                                            value="{{ old('request_publish') }}"
                                            placeholder="{{ __('front.request_publish') }}">
                                    </div>
                                    <div class="d-flex col-lg-12 col-md-12 col-sm-12 form-group my-3">
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

@endsection
