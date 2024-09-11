@extends('layout.front.app')
@section('title', __('front.rewaq'))

@section('description', '')
@section('page_img', '')

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

        .book a img {
            height: 400px !important;
        }

        .book .pb-3,
        .book .pt-3 {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btns a {
            background-color: var(--new-color);
            color: var(--white-color);
            transition: .2s all linear;
        }

        .book {
            position: relative;
            padding-bottom: 40px;
            height: 100%;
        }

        .btns {
            position: absolute;
            bottom: 0 !important;
            left: 0 !important;
            right: 0 !important;
        }

        .btns a:hover {
            background-color: var(--secondary-color);
        }

     
    </style>


    <section class="activies-sec">
        <div class="container">
            <a href="">
                <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                    <h2 class="font-bold p-3">{{ __('front.versions') }}</h2>
                </div>
            </a>
            <div class="row justify-content-center align-items-stretch">
                @foreach ($books as $book)
                    <div class="col-md-3 book position-relative my-3 ">
                        <a href="{{ langUrl('/rewaq/book/' . $book->slug) }}">
                            <div class="pb-3 pt-3">
                                <img src="{{ $book->img }}" alt="{{ $book->translation->title }}"
                                    class="border-0 rounded ">
                            </div>
                            <small class="title-sec mb-1">
                                <strong>{{ formatDate($book->created_at) }}</strong>
                            </small>
                            <strong class="pt-1 pb-1 d-block">{{ $book->translation->title }}</strong>
                            <p class="custom-line-clamp">{{ $book->translation->description }}</p>
                        </a>
                        <div class="btns pos-absolute d-flex justify-content-around align-items-end">
                            <a href="{{ $book->index_url }}" target="_blank"
                                class="p-2 rounded ">{{ __('front.read_more') }}</a>
                            <a href="{{ route('rewaq.bookingBook', $book->slug) }}" target="_blank"
                                class="p-2 rounded">{{ __('front.reserve_copy') }}</a>
                        </div>

                    </div>
                @endforeach
            </div>

            {{-- </div>
                </div> --}}
            {{-- <div class="col-lg-3 margin20">
                    <div class="widget_raper mt-3">
                        <p class="text-green">{{ __('front.new_site') }}</p>
                        <div class="recent_post">
                            @foreach ($latestNews as $latest)
                                <a href="{{ langUrl('/rewaq/book/'.$latest->slug) }}" class="single_recent_post">
                                    <span class="rp_img" style="background-image: url({{$latest->img}});"></span>
                                    <span>{{ formatDate($latest->created_at) }}</span>
                                    <h4>{{$latest->translation->title}}</h4>
                                </a>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                  <div class="widget_raper bg-light p-2 mt-3">
                    <p class="text-green">{{ __('front.most_watched') }}</p>
                    <div class="recent_post">
                        @foreach ($mostWatched as $most)
                            <a href="{{ langUrl('/rewaq/book/'.$most->slug) }}" class="single_recent_post">
                                <span>{{ formatDate($most->created_at) }}</span>
                                <h4>{{ $most->translation->title }}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div> --}}
            <div
                class="col-lg-12 mt-3 text-center m-auto justify-content-center  d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
                {{ $books->links() }}
            </div>
        </div>
    </section>

@endsection


@section('js')
@endsection
