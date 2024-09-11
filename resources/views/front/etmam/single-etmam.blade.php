@extends('layout.front.app')
@section('title', $EtmamNew->translation->title)

@section('description', $EtmamNew->translation->description)
@section('page_img', $EtmamNew->news_img)

@section('content')

<section class="breadcrumb  mt-4 p-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('etmam') }}">{{__('front.etmam')}}</a></li>
        <li class="breadcrumb-item active">{{ $EtmamNew->category->name }}</li>
      </ol>
    </nav>
</section>

<section class="activies-sec mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_detaisl_area">
                    <h4 class="text-center p-2 pb-4 fw-bolder">{{ $EtmamNew->translation->title }}</h4>
                    <div class="blog_full_content">
                    <img class="box" data-src="{{$EtmamNew->news_img}}" data-srcset="{{$EtmamNew->news_img}} 2x" alt="{{ $EtmamNew->translation->title }}" src="{{$EtmamNew->news_img}}" srcset="{{$EtmamNew->news_img}} 2x">
                        <small>
                            <i class="fas fa-calendar"></i>
                            {{ formatDate($EtmamNew->created_at) }}
                        </small>
                    </div>
                    <div>{!! $EtmamNew->translation->content !!}</div>   
                    @if (!empty($EtmamNew->url))
                        <br>
                        <a href="{{ $EtmamNew->url }}" class="btn btn-info" data-fancybox>
                            {{__('front.watch_seminar')}}
                        </a>
                    @endif
                </div>
                <br>
                <hr>
            
                {{-- <ul class="releated mt-3">
                    @if (!empty($EtmamNew->translation->tags))
                        @php
                            $tags = explode(',', $EtmamNew->translation->tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ langUrl('/etmam/tag/'.$tag) }}">
                                    {{$tag}}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul> --}}
            </div>
            
            <div class="col-lg-1">
            </div>
            
            <div class="col-lg-3">
                
                <div class="form-group">
                    @include('front.events')
              
                  <div class="widget_raper blue mt-3">
                    <p>{{ __('front.the_most_recent') }}</p>
                    <div class="recent_post">
                        @foreach ($latestNews as $latest)
                            <a href="{{ langUrl('/etmam/'.$latest->slug) }}" class="single_recent_post">
                                <span class="rp_img" style="background-image: url({{ $latest->img }});"></span>
                                <span>{{ formatDate($latest->created_at) }}</span>
                                <h4>{{ $latest->translation->title }}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>

                </div>
                  <div class="widget_raper blue bg-light p-2 mt-3">
                    <p>{{__('front.latest_seminars')}}</p>
                    <div class="recent_post">
                        @foreach ($mostWatched as $most)
                            <a href="{{ langUrl('/etmam/'.$most->slug) }}" class="single_recent_post">
                                <h4>{{ $most->translation->title }}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    
    </div>
</section>


@endsection



@section('js')
@endsection