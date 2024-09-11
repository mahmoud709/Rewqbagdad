@extends('layout.front.app')
@section('title', __('front.videos'))

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


<section class="gallery-area videos mt-10">
    <div class="container bg-light raduis-35 p-5">

        <div class="row">
            <ul class="nav nav-pills mb-5" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">

                    <a class="nav-link @if(empty($slug)) active @endif" href="{{langUrl('/media/center/videos')}}">
                        {{__('front.all')}}
                    </a>
                </li>

                @foreach ($categories as $cat)
                    <li class="nav-item" role="presentation">
                        <a href="?category={{$cat->slug}}" class="nav-link @if($cat->slug ==$slug) active @endif">
                            {{ $cat->translation->name }}
                        </a>
                    </li>
                @endforeach

              </ul>
                <div class="tab-content mt-3" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                        <div class="row">

                            @if($videos->isEmpty())
                                <div class="col-md-12">
                                    <h3 class="text-center">{{__('front.no_videos')}}</h3>
                                </div>
                            @endif

                            @foreach ($videos as $video)
                                <div class="col-lg-3 col-6">
                                    <div class="meeting-event-box">
                                        <div class="content justify-content-left">
                                        <a id="copyVideo" data-videoUrl="{{$video->video_url }}" class="share-btn copyVideo">
                                            <i class="fas fa-share"></i>
                                        </a>
                                        </div>
                                        <figure class="reveal-effect animated"><a href="{{ $video->video_url }}" data-fancybox>
                                            <i class="fas fa-play"></i></a>
                                            <img width="100%" height="100%" src="{{ $video->img }}" alt="{{ $video->translation->name }}"></a>
                                        </figure>
                                        <div class="content">
                                        <h5>
                                            {{ $video->translation->name }}
                                        </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>

                    </div>
                </div>
              </div>


            <div class="col-lg-12 mt-3 text-center">
                {!! $videos->appends(['category'=>$slug])->links() !!}
            </div>
        </div>
    </div>
</section>

@endsection

