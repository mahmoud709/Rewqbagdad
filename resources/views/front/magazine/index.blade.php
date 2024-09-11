@extends('layout.front.app')
@section('title', __('front.magazine'))

@section('description', $magazine->translation->content)
@section('page_img', $magazine->img)

@section('content')
    <style>
        .book {
            height: auto;
            margin-bottom: 20px;
        }

        .book img {
            height: 420px;
            object-fit: cover;
        }
    </style>

    <section class="about-us-sec my-5">
        <div class="container">
            <div class="row py-3 ">
                <div class="col-lg-8">
                    <strong class="fs-2 d-block mb-3 text-white">
                        @yield('title')
                    </strong>
                    <p>{!! $magazine->translation->content !!}</p>
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
                                                class=" magazine-emp-namecolor text-white">{{ $team->translation->name }}</span></a>

                                    </h4>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="img-box text-center pb-3 rounded-30">
                        <img src="{{ $magazine->img }}" alt="@yield('title')" class="border-0 w-50">
                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>



    <section class="my-5 videos-sec">
        <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
            <h2 class="font-bold p-3">{{ __('front.versions') }}</h2>
        </div>
    </section>
    <section class="activies-sec activies-brown">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-8"> --}}
            <div class="row justify-content-center align-items-start">
                @foreach ($blogs as $blog)
                    <div class="col-md-3 book">
                        <a href="{{ langUrl('/magazine/blog/' . $blog->slug) }}">
                            <div class="pb-3 pt-3">
                                <img src="{{ $blog->img }}" alt="{{ $blog->translation->title }}" class="border-0">
                            </div>
                        </a>
                        <div class="me-3">
                            <a href="{{ langUrl('/magazine/blog/' . $blog->slug) }}">
                                <small class="title-sec mb-1">
                                    <strong>
                                        {{ __('front.the_number') }} {{ $blog->number }}
                                    </strong>
                                </small>
                                <strong class="pt-1 pb-1 d-block line-clamp-1">{{ $blog->translation->title }}</strong>
                                <p class="line-clamp-2">{{ $blog->translation->description }}</p>
                            </a>
                        </div>
                        <div class="btns d-flex justify-content-around align-items-center ">
                            <a href="{{ $blog->pdf }}" target="_blank"
                                class="p-2 rounded special_btn">{{ __('front.read_more') }}</a>
                            <a href="{{ route('magazine-rewaq.bookingBook', $blog->slug) }}" target="_blank"
                                class="p-2 rounded special_btn">{{ __('front.reserve_copy') }}</a>
                        </div>
                    </div>
                @endforeach

                {{-- <hr> --}}
            </div>
            {{-- </div> --}}
            {{-- <div class="col-lg-3 margin20">
                    <div class="widget_raper mt-3">

                        <p class="text-green">{{ __('front.new_site') }}</p>
                        <div class="recent_post">
                            @foreach ($latestBlogs as $latest)
                                <a href="{{ langUrl('/magazine/blog/' . $latest->slug) }}" class="single_recent_post">
                                    <span class="rp_img" style="background-image: url({{ $latest->img }});"></span>
                                    <span>{{ formatDate($latest->created_at) }}</span>
                                    <h4>{{ $latest->translation->title }}</h4>
                                </a>
                                <hr>
                            @endforeach
                        </div>
                    </div> --}}

            {{-- <div class="widget_raper bg-light p-2 mt-3">
                        <p class="text-green">{{ __('front.most_watched') }}</p>
                        <div class="recent_post">
                            @foreach ($mostWatched as $most)
                                <a href="{{ langUrl('/magazine/blog/' . $most->slug) }}" class="single_recent_post">
                                    <span>{{ formatDate($most->created_at) }}</span>
                                    <h4>{{ $most->translation->title }}</h4>
                                </a>
                                <hr>
                            @endforeach
                        </div>
                    </div> --}}
        </div>
        <div
            class="col-lg-12 mt-3 text-center justify-content-center d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
            {!! $blogs->links() !!}</div>
        </div>
        </div>
    </section>

@endsection


@section('js')
@endsection
