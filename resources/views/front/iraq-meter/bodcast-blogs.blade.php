@extends('layout.front.app')
@section('title', __('front.bodcast_fakar'))

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
        <div class="title-page text-center d-block">{{__('front.bodcast_fakar')}}</div>
    </div>
</section>

<section class="activies-sec">
    <div class="container">
        <a href="">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.our_blogs') }}</h2>
            </div>
        </a>
        <div class="row justify-content-center align-items-center">
            @foreach ($blogs as $blog)
                <div class="col-md-3 book">
                    <a href="{{ route('bodcast.blog-details', $blog->slug) }}">
                        <div class="pb-3 pt-3">
                            <img src="{{ $blog->img }}" alt="{{ $blog->translation->title }}"
                                class="border-0 rounded ">
                        </div>
                        <small class="title-sec mb-1">
                            <strong>{{ formatDate($blog->created_at) }}</strong>
                        </small>
                        <strong class="pt-1 pb-1 d-block">{{ $blog->translation->title }}</strong>
                        <p>{{ $blog->translation->description }}</p>
                 
                    </a>

                </div>
            @endforeach
        </div>

  
        <div class="col-lg-12 mt-3 text-center m-auto justify-content-center  d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
            {{ $blogs->links() }}
        </div>
    </div>
</section>

@endsection

