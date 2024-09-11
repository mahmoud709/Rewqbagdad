<!DOCTYPE html>
<html lang="{{ appLangKey() }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ url($SiteData->icon) }}" type="image/x-icon" />

    <title>@yield('title', $SiteData->translation->name)</title>


    <meta name="description" content="@yield('description', $SiteData->translation->description)" />

    <link rel="canonical" href="{{ url()->current() }}" />
    <meta name="robots" content="index,follow" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta property="og:type" content="article" />
    <meta property="og:title" content="@yield('title', $SiteData->translation->name)" />
    <meta property="og:description" content="@yield('description', $SiteData->translation->description)" />
    <meta property="og:image" content="@yield('page_img', $SiteData->logo_header)" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:site_name" content="{{ $SiteData->translation->name }}" />
    <!-- Twitter Meta -->
    <meta name="twitter:title" content="@yield('title', $SiteData->translation->name)" /><!-- Required -->
    <meta name="twitter:description" content="@yield('description', $SiteData->translation->description)" />
    <meta name="twitter:image" content="@yield('page_img', $SiteData->logo_header)" />
    <meta name="twitter:card" content="summary_large_image" /><!-- Required -->

    <link rel="stylesheet" href="{{ url('front') }}/assets/css/moment.css">
    <link rel="stylesheet" href="{{ url('front') }}/assets/css/style.css">
  
    <style>
        .swal2-select {
            display: none !important
        }

        .medad-list {
            position: absolute;
            top: 0;
            right: 100px;
            background: #fff;
            border-radius: 5px;
            padding-right: 10px;
            padding-top: 10px;
            padding-bottom: 10px;
            display: none;
        }

        .medad-parent {
            position: relative;
        }

        .medad-parent:hover>.medad-list {
            display: block;
        }

        @media (max-width: 768px) {

            @if (appLangKey() == 'ar')
                .custom-top-img {
                    margin-right: 20px !important;
                }

            @else
                .custom-top-img {
                    margin: 0 !important;
                    margin-left: 20px !important;
                }
            @endif
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="top-header">
        <div class="container">
            <div class="row justify-content-between pt-4">
                <div class=" col-lg-4 logo align-items-center d-flex">
                    <button class="navbar-toggler d-flex d-xl-none d-lg-none d-md-none d-sm-flex d-xs-flex text-right"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <a class="d-inline" href="{{ langUrl('/') }}">
                        <img src="{{ url($SiteData->logo_header) }}" height="auto" width="100%"
                            alt="{{ $SiteData->translation->name }}" class="custom-top-img"
                            style="max-height: 64.65px;width: auto;" />
                    </a>
                    <a class="d-inline" href="{{ langUrl('/') }}">
                        <img src="/front/assets/img/logo2head.png" height="auto" width="100%"
                            alt="{{ $SiteData->translation->name }}" style="max-height: 64.65px;width: auto;" />
                    </a>
                </div>
                <div class="col-lg-3">
                    <div
                        class="social-header d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none justify-content-between align-items-center pb-2">
                        <div class="icons">

                            @if (!empty($SiteData->facebook))
                                <a href="{{ $SiteData->facebook }}" target="_blank">
                                    <!--<i class="fa-brands fa-facebook"></i>-->
                                    <img src="{{ url('/fb.png') }}" />
                                </a>
                            @endif

                            @if (!empty($SiteData->twitter))
                                <a href="{{ $SiteData->twitter }}" target="_blank">
                                    <!--<i class="fa-brands fa-twitter"></i>-->
                                    <img src="{{ url('/tw.png') }}" />
                                </a>
                            @endif

                            @if (!empty($SiteData->instagram))
                                <a href="{{ $SiteData->instagram }}" target="_blank">
                                    <!--<i class="fa-brands fa-instagram"></i>-->
                                    <img src="{{ url('/in.png') }}" />
                                </a>
                            @endif
                            @if (!empty($SiteData->linkedin))
                                <a href="{{ $SiteData->linkedin }}" target="_blank">
                                    <i class="fa-brands fa-linkedin"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->youtube))
                                <a href="{{ $SiteData->youtube }}" target="_blank">
                                    <!--<i class="fa-brands fa-youtube"></i>-->
                                    <img src="{{ url('/yo.png') }}" />
                                </a>
                            @endif
                            @if (!empty($SiteData->telegram))
                                <a href="{{ $SiteData->telegram }}" target="_blank">
                                    <i class="fa-brands fa-telegram"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->tiktok))
                                <a href="{{ $SiteData->tiktok }}" target="_blank">
                                    <i class="fa-brands fa-tiktok"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->whatsapp))
                                <a href="{{ $SiteData->whatsapp }}" target="_blank">
                                    <!--<i class="fa-brands fa-whatsapp"></i>-->
                                    <img src="{{ url('/wh.png') }}" />
                                </a>
                            @endif

                        </div>
                        <div class="lang d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
                            @if (appLangKey() == 'ar')
                                <a class="btn btn-warning text-white"
                                    href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">{{ __('front.en') }}</a>
                            @else
                                <a class="btn btn-warning text-white"
                                    href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">{{ __('front.ar') }}</a>
                            @endif
                        </div>
                    </div>
                    <form action="{{ langUrl('/search') }}" method="get">
                        <div class="input-group mt-2">
                            <input type="text" id="text" name="text" value="{{ request('text') }}"
                                class="form-control border-0" placeholder="{{ __('front.search') }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-warning" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                            <div class="lang d-flex d-xl-none d-lg-none d-md-none d-sm-flex d-xs-flex me-3">
                                @if (appLangKey() == 'ar')
                                    <a class="btn btn-warning text-white"
                                        href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">{{ __('front.en') }}</a>
                                @else
                                    <a class="btn btn-warning text-white"
                                        href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">{{ __('front.ar') }}</a>
                                @endif
                            </div>
                        </div>
                    </form>
                    <div
                        class="social-header d-flex d-xl-none d-lg-none d-md-none d-sm-flex d-xs-flex mt-4 justify-content-between align-items-center pb-2 border-bottom">
                        <div class="icons">
                            <!--<span>-->
                            <!--    {{ __('front.follow_us') }}-->
                            <!--    :-->
                            <!--</span>-->
                            @if (!empty($SiteData->facebook))
                                <a href="{{ $SiteData->facebook }}" target="_blank">
                                    <i class="fa-brands fa-facebook"></i>
                                </a>
                            @endif

                            @if (!empty($SiteData->twitter))
                                <a href="{{ $SiteData->twitter }}" target="_blank">
                                    <i class="fa-brands fa-twitter"></i>
                                </a>
                            @endif

                            @if (!empty($SiteData->instagram))
                                <a href="{{ $SiteData->instagram }}" target="_blank">
                                    <i class="fa-brands fa-instagram"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->linkedin))
                                <a href="{{ $SiteData->linkedin }}" target="_blank">
                                    <i class="fa-brands fa-linkedin"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->youtube))
                                <a href="{{ $SiteData->youtube }}" target="_blank">
                                    <i class="fa-brands fa-youtube"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->telegram))
                                <a href="{{ $SiteData->telegram }}" target="_blank">
                                    <i class="fa-brands fa-telegram"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->tiktok))
                                <a href="{{ $SiteData->tiktok }}" target="_blank">
                                    <i class="fa-brands fa-tiktok"></i>
                                </a>
                            @endif
                            @if (!empty($SiteData->whatsapp))
                                <a href="{{ $SiteData->whatsapp }}" target="_blank">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </a>
                            @endif

                        </div>
                        <div class="lang d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
                            @if (appLangKey() == 'ar')
                                <a class="btn btn-warning text-white"
                                    href="{{ LaravelLocalization::getLocalizedURL('en', null, [], true) }}">{{ __('front.en') }}</a>
                            @else
                                <a class="btn btn-warning text-white"
                                    href="{{ LaravelLocalization::getLocalizedURL('ar', null, [], true) }}">{{ __('front.ar') }}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <header class="menu">
        <div class="container">
            <div class="row header-nav">

                <div class="col-sm-12 col">
                    <div class="meun-left-top">
                        <nav class="navbar navbar-expand-lg px-0">

                            <!--<button class="navbar-toggler text-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">-->
                            <!--    <i class="fas fa-bars"></i>-->
                            <!--</button>-->

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{ langUrl() }}"><i
                                                class="fas fa-house"></i></a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link  dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('front.who_we') }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            {{-- <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/about-us') }}">{{ __('front.about_us') }} </a>
                                            </li> --}}
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/employee/center') }}">{{ __('front.center_members') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/ourvision') }}">{{ __('front.ourvision') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="/faq">{{ __('front.common_quesiton') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/center/writers') }}">{{ __('front.authors') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">

                                        <a class="nav-link  dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('front.project_marakaz') }} </a>
                                        <ul class="dropdown-menu">
                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/img3.png') }}"
                                                        alt="project-img1" width="38" height="38">
                                                </div>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/rewaq') }}">{{ __('front.rewaq') }}</a>
                                            </li>
                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/alrewaq.png') }}"
                                                        alt="project-img1" width="38" height="38">
                                                </div>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/magazine') }}">{{ __('front.magazine') }} </a>
                                            </li>
                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/img2.png') }}"
                                                        alt="project-img1" width="38" height="38">
                                                </div>
                                                <a class="dropdown-item" href="https://www.iamtheparliament.com"
                                                    target="_blank">{{ __('front.i_parliament') }}</a>
                                            </li>
                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/img6.png') }}"
                                                        alt="project-img1" width="20" height="20">
                                                </div>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/iraq/meter') }}">{{ __('front.iraqmeter') }}</a>
                                            </li>


                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/img7.png') }}"
                                                        alt="project-img1" width="38" height="38">
                                                </div>
                                                <a class="dropdown-item" href="{{ langUrl('/boadcast') }}">
                                                    {{ __('front.bodcast') }}
                                                </a>
                                            </li>

                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/kun.png') }}"
                                                        alt="project-img1" width="38" height="38">
                                                </div>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/kon') }}">{{ __('front.kun') }} </a>
                                            </li>

                                            <li class="position-relative  medad-parent">
                                                <span class="d-flex justify-between items-center">
                                                    <div class="project-img mx-auto">
                                                        <img src="{{ asset('images/projects/img4.png') }}"
                                                            alt="project-img1" width="38" height="38">
                                                    </div>
                                                    <a class="dropdown-item dropdown-toggle" href="/medad"
                                                        id="navbarDropdown" role="button" data-toggle="dropdown">
                                                        {{__('front.medad') }}
                                                    </a>
                                                </span>


                                                <ul class="dropdown medad-list" aria-labelledby="navbarDropdown">
                                                    @php
                                                        $VersionsCats = \App\Models\Versioncategory::with('translation')
                                                            ->orderBy('sort', 'asc')
                                                            ->get();
                                                    @endphp
                                                    @foreach ($VersionsCats as $VS)
                                                        <li>
                                                            <a class="dropdown-item"
                                                                href="{{ langUrl('/versions/category/' . $VS->slug) }}">{{ $VS->translation->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="d-flex justify-between items-center">
                                                <div class="project-img mx-auto">
                                                    <img src="{{ asset('images/projects/img5.png') }}"
                                                        alt="project-img1" width="38" height="38">
                                                </div>
                                                <a class="dropdown-item" href="/etmam">{{ __('front.etmam') }}</a>
                                            </li>

                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link  dropdown-toggle" href="{{ langUrl('/activities') }}"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('front.activities') }}
                                        </a>
                                        <ul class="dropdown-menu">
                                            @php
                                                $ActivityCats = \App\Models\Activitycategory::with('translation')
                                                    ->orderBy('sort', 'asc')
                                                    ->get();
                                            @endphp
                                            {{-- <li>
                                                <a class="dropdown-item" href="{{langUrl('/activities')}}">{{__('front.all_results')}}</a>
                                            </li> --}}
                                            @foreach ($ActivityCats as $AC)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ langUrl('/activities/category/' . $AC->slug) }}">{{ $AC->translation->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">

                                        <a class="nav-link  dropdown-toggle" href="{{ langUrl('/versions') }}"
                                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('front.spceial_version') }}
                                        </a>
                                        <ul class="dropdown-menu">

                                            {{-- <li>
                                                <a class="dropdown-item" href="{{langUrl('/versions')}}">{{__('front.all_results')}}</a>
                                            </li> --}}

                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/khetab-magazine') }}">{{ __('front.khetab_magazine') }}
                                                </a>
                                            </li>

                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/MEJEELP-magazine') }}">MEJEELP </a>
                                            </li>
                                        </ul>
                                    </li>


                                    <li class="nav-item dropdown">
                                        <a class="nav-link  dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('front.media_center') }}

                                        </a>
                                        <ul class="dropdown-menu">

                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/media/center/news') }}">{{ __('front.latest_news') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/media/center/gallery') }}">{{ __('front.gallery') }}</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ langUrl('/media/center/videos') }}">{{ __('front.videos') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link  dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ __('front.electronic_service') }}
                                        </a>
                                        <ul class="dropdown-menu">

                                            @php
                                                $pages = \App\Models\Electronicservice::with(
                                                    'translation:title,electronic_id',
                                                )->get();
                                            @endphp

                                            @foreach ($pages as $page)
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ langUrl('/' . $page->slug) }}">{{ $page->translation->title }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link"
                                            href="{{ langUrl('/contact-us') }}">{{ __('front.contact_us') }}</a>
                                    </li>
                                </ul>

                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!--@if (request()->path() == appLangKey())
-->
    <!--    <div class="modal fade" id="EventsModel" tabindex="-1" aria-labelledby="EventsModelTitle" aria-hidden="true">-->
    <!--        <div class="modal-dialog modal-dialog-centered  w-40">-->
    <!--            <div class="modal-content">-->
    <!--                <div class="modal-header">-->
    <!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--                </div>-->
    <!--                <div class="modal-body">-->
    <!--                    @include('front.events')-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->


    <!--    <div class="fixed-btns">-->
    <!--        <ul class="sidebar-btn">-->
    <!--            <li>-->
    <!--                <a href="{{ langUrl() }}">-->
    <!--                    <i class="fas fa-house"></i>-->
    <!--                </a>-->
    <!--            </li>-->
    <!--            <li>-->
    <!--                <a href="#" data-bs-toggle="modal" data-bs-target="#EventsModel">-->
    <!--                    <i class="fas fa-calendar"></i>-->
    <!--                </a>-->
    <!--            </li>-->
    <!--            <li>-->
    <!--                <a href="{{ langUrl('/contact-us') }}">-->
    <!--                    <i class="fas fa-clock"></i>-->
    <!--                </a>-->
    <!--            </li>-->
    <!--        </ul>-->
    <!--    </div>-->
    <!--
@endif-->


    @yield('content')

    <footer>
        <div class="container-fluid">
            <div
                class="flex-xs-row-reverse flex-sm-row-reverse flex-lg-row flex-xl-row row justify-content-center align-items-center">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="block-foot">
                        <img src="{{ url($SiteData->logo_footer) }}" alt="{{ $SiteData->translation->name }}">
                        <div class="text text-center">
                            <p>{{ $SiteData->translation->description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <ul class="custom-links">
                        <li>
                            <a href="{{ langUrl() }}">{{ __('front.home') }}</a>
                        </li>
                        <li>
                            <a href="{{ langUrl('/about-us') }}">{{ __('front.who_we') }}</a>
                        </li>
                        <li>
                            <a href="{{ langUrl('/versions') }}">{{ __('front.versions') }}</a>
                        </li>
                        <li>
                            <a href="{{ langUrl('/activities') }}">{{ __('front.activities') }}</a>
                        </li>
                        {{-- <li>
                            <a href="#">مواقع فرعية</a>
                        </li> --}}
                        <li>
                            <a href="{{ langUrl('/media/center/news') }}">{{ __('front.media_center') }}</a>
                        </li>
                        {{-- <li>
                            <a href="#">خدمة الكترونية</a>
                        </li> --}}
                        <li>
                            <a href="{{ langUrl('/contact-us') }}">{{ __('front.contact_us') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <ul class="contact padding-left0">
                        <li>
                            <span>
                                {{ __('front.address') }}
                            </span><br>
                            <a href="#">
                                {{ $SiteData->translation->address }}
                            </a>
                        </li>
                        <li>
                            <span>
                                {{ __('front.email') }}
                            </span><br>
                            <a href="mailto:{{ $SiteData->email }}">{{ $SiteData->email }}</a>
                        </li>
                        <li>
                            <span>
                                {{ __('front.phone') }}
                            </span><br>
                            <a dir="ltr" href="tel:{{ $SiteData->phone }}">{{ $SiteData->phone }}</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <form action="{{ url('subscription') }}" method="post">@csrf
                        <button type="submit" class="submit">{{ __('front.subscription') }}</button>
                        <input type="email" name="email" required placeholder="{{ __('front.enter_email') }}">
                    </form>
                    <div class="logos row justify-content-between align-items-center pb-5">
                        <div class="col-3 col-md-3 my-2">
                            <a href="/magazine">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/alrewaq.png') }}" alt="project-img1">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="https://www.iamtheparliament.com" target="_self">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/img2.png') }}" alt="project-img2">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="/rewaq">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/img3.png') }}" alt="project-img3">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="/medad">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/img4.png') }}" alt="project-img4">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="/etmam">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/img5.png') }}" alt="project-img5">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="/iraq/meter">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/img6.png') }}" alt="project-img6">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="/boadcast">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/img7.png') }}" alt="project-img7">
                                </div>
                            </a>
                        </div>
                        <div class="col-3 col-md-3 my-2">
                            <a href="/kon">
                                <div class="project-img mx-auto">
                                    <img src="{{ asset('images/projects/kun.png') }}" alt="project-img8">
                                </div>
                            </a>
                        </div>
                    </div>
                    <ul class="d-flex social-media">
                        @if (!empty($SiteData->facebook))
                            <li><a target="_balnak" href="{{ $SiteData->facebook }}"><i
                                        class="fa-brands fa-facebook"></i></a></li>
                        @endif
                        @if (!empty($SiteData->twitter))
                            <li><a href="{{ $SiteData->twitter }}" target="_blank"><i
                                        class="fa-brands fa-twitter"></i></a>
                            <li>
                        @endif

                        @if (!empty($SiteData->instagram))
                            <li><a href="{{ $SiteData->instagram }}" target="_blank"><i
                                        class="fa-brands fa-instagram"></i></a>
                            <li>
                        @endif
                        @if (!empty($SiteData->linkedin))
                            <li><a href="{{ $SiteData->linkedin }}" target="_blank"><i
                                        class="fa-brands fa-linkedin"></i></a>
                            <li>
                        @endif
                        @if (!empty($SiteData->youtube))
                            <li><a href="{{ $SiteData->youtube }}" target="_blank"><i
                                        class="fa-brands fa-youtube"></i></a>
                            <li>
                        @endif
                        @if (!empty($SiteData->telegram))
                            <li><a href="{{ $SiteData->telegram }}" target="_blank"><i
                                        class="fa-brands fa-telegram"></i></a>
                            <li>
                        @endif
                        @if (!empty($SiteData->tiktok))
                            <li><a href="{{ $SiteData->tiktok }}" target="_blank"><i
                                        class="fa-brands fa-tiktok"></i></a>
                            <li>
                        @endif
                        @if (!empty($SiteData->whatsapp))
                            <li><a href="{{ $SiteData->whatsapp }}" target="_blank"><i
                                        class="fa-brands fa-whatsapp"></i></a>
                            <li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <script src="{{ url('front') }}/assets/js/moment.js"></script>

    <script src="{{ url('front') }}/assets/js/index.js"></script>
    <script>
        $('.copyVideo').on('click', function(e) {
            e.preventDefault();

            var copyText = $(this).attr('data-videoUrl');

            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in MS Edge.
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");

            document.body.removeChild(textarea);
            alert('{{ __('front.copy_video') }}');
        })
    </script>

    @if (session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire({
                position: 'top-center',
                type: 'success',
                html: "<span style='font-size:1.5em'>{{ session('success') }}</span>",
                showConfirmButton: true,
                confirmButtonText: 'Ok'
            })
        </script>
    @endif

    @if (session('error'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script>
            Swal.fire({
                type: 'error',
                html: "<span style='font-size:1.5em'>{{ session('error') }}</span>",
                showConfirmButton: true,
                confirmButtonText: 'Ok'
            });
        </script>
    @endif

    @yield('calendar')
    @yield('js')

</body>

</html>
