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

   {{-- videos section --}}
   <section class="my-5 videos-sec">
    <a href="{{ route('rewaq.videos') }}">
        <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
            <h2 class="font-bold p-3">{{ __('front.videos') }}</h2>
        </div>
    </a>
</section>


<section class="gallery-area videos mt-10">
    <div class="container bg-light raduis-35 p-5">

        <div class="row">
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
                {!! $videos->links() !!}
            </div>
        </div>
    </div>
</section>

@endsection

