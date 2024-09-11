@extends('layout.front.app')
@section('title', __('front.iraqmeter'))

@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>
</section>


<section class="titles mt-5">
    <div class="container">
        <div class="title-page text-center d-block">{{__('front.iraqmeter')}}</div>
    </div>
</section>

<section class="blog-area mt-10 mb-5">
    <div class="container bg-light p-5">
        <div class="row justify-content-center align-items-center">

            @foreach ($blogs as $blog)
                <div class="col-lg-3 mb-xl-4 mb-lg-4 mb-md-4 mb-0">
                    <a href="{{ langUrl('/iraq/meter/'.$blog->slug) }}">
                    <img src="{{ $blog->img }}" alt="{{ $blog->translation->title }}">
                    </a>
                </div>
                <div class="col-lg-9 position-relative">
                <a href="{{ langUrl('/iraq/meter/'.$blog->slug) }}">
                    <div class="content">
                         <small class="title-sec mb-1">
                            <strong>{{ formatDate($blog->created_at) }}</strong>
                        </small>
                        <strong class="pt-1 pb-1 d-block">{{ $blog->translation->title }}</strong>
                        <p>{{ $blog->translation->description }}</p>

                        <a href="{{ langUrl('/iraq/meter/'.$blog->slug) }}" class="read-more">{{__('front.for_more')}}</a>
                    </div>
                </a>
                </div>
            @endforeach

            <div class="col-lg-12 mt-3 text-center">
                {!! $blogs->links() !!}
            </div>
        </div>
    </div>
</section>

@endsection

