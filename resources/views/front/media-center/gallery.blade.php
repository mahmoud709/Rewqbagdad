@extends('layout.front.app')
@section('title', __('front.gallery'))


@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('front.media_center')}}</li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>
</section>

<section class="titles mt-5">
    <div class="container">
        <div class="title-page text-center d-block">@yield('title')</div>
    </div>
</section>

<section class="gallery-area mt-10">
    <div class="container bg-light raduis-35 p-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <p>{{ __('front.number_items') }}</p>
                    <p class="elements-num">
                        {{ $photos->count() }}
                        <img src="/front/assets/img/span.png" alt="">    
                    </p>
                </div>
            </div>
            @foreach ($photos as $photo)
                <div class="col-lg-3 col-6">
                    <div class="meeting-event-box">
                        <figure class="reveal-effect animated">
                            
                            <a href="{{ $photo->img }}" data-fancybox="images-{{$photo->id}}">
                                <i class="fas fa-search"></i>
                                <img width="100%" height="100%" src="{{ $photo->img }}" alt="{{ $photo->translation->title }}">
                            </a>

                            @if (!empty($photo->imgs))
                                @php
                                    $imgs = explode(',', $photo->imgs);
                                @endphp
                                @foreach ($imgs as $img)
                                    <a href="{{$img}}" data-fancybox="images-{{$photo->id}}"></a>
                                @endforeach
                            @endif
                        </figure>
                        <div class="content">
                            <h5>{{ $photo->translation->title }}</h5>
                        </div>
                        <!-- end content --> 
                    </div>
                </div>
            @endforeach

            
            <div class="col-lg-12 mt-3 text-center">{!! $photos->links() !!}</div>
        </div>
    </div>
</section>


@endsection

