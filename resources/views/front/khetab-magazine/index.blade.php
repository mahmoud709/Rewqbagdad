@extends('layout.front.app')
@section('title', __('front.khetab_magazine'))

@section('description', $magazine->translation->content)
@section('page_img', $magazine->img)

@section('content')

    {{-- bg-white-greding-browen --}}
    <section class="about-us-sec my-5 ">
        <div class="container">
            <div class="khetab-magazine row py-3  justify-content-center align-items-center">
                <div class="col-lg-8 text-white">
                    <strong class="fs-2 d-block mb-3">
                        @yield('title')
                    </strong>
                    {!! $magazine->translation->content !!}
                    @foreach ($teams as $team)
                    <div class="col-lg-6">
                        <div class="text">
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
                <div class="col-lg-4 img-container ">
                    <div class="img-box text-center shadow-sm rounded-30 ">
                        <img src="{{ $magazine->img }}" alt="@yield('title')" class="border-0 w-50 ">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="activies-sec">
        <div class="container">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.our_blogs') }}</h2>
            </div>
            <div class="row justify-content-center align-items-stretch">
                @foreach ($blogs as $blog)
                    <div class="col-md-3 book  my-3 h-full">
                        <a href="{{ langUrl('/magazine/blog/' . $blog->slug) }}">
                            <div class="pb-3 pt-3">
                                <img src="{{ $blog->img }}" alt="{{ $blog->translation->title }}"
                                    class="border-0 rounded ">
                            </div>
                            <small class="title-sec mb-1 ">
                                <strong>{{ formatDate($blog->created_at) }}</strong>
                            </small>
                            <strong class="pt-1 pb-1 d-block line-clamp-1">{{ $blog->translation->title }}</strong>
                            <p id="blog-description" class="line-clamp-2  ">{{ $blog->translation->description }}</p>
                        </a>
                        <div class="btns  d-flex justify-content-around align-items-stretch">
                            <a href="{{ $blog->pdf }}" target="_blank"
                                class="p-2 rounded special_btn">{{ __('front.read_more') }}</a>
                            <a href="{{ route('khetab.bookingBook',$blog->slug) }}" target="_blank"
                                class="p-2 rounded special_btn">{{ __('front.booking_your_copy') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div
                class="col-lg-12 mt-3 text-center m-auto justify-content-center  d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
                {{ $blogs->links() }}
            </div>
        </div>
    </section>
@endsection


@section('js')
    <script>
        const descriptionEle = document.getElementById('blog-description');
        const elementContent = descriptionEle.innerHTML;
        const newEle = elementContent.split(" ")
        console.log(newEle);
    </script>
@endsection
