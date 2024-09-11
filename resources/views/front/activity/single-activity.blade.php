@extends('layout.front.app')
@section('title', $activity->translation->title)

@section('description', $activity->translation->description)
@section('page_img', $activity->news_img)

@section('content')

<section class="breadcrumb  mt-4 p-5">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{ langUrl('/activities') }}">{{__('front.activities')}}</a></li>
        <li class="breadcrumb-item active">{{ $activity->category->name }}</li>
      </ol>
    </nav>
</section>

<section class="activies-sec mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_detaisl_area">
                    <h4 class="text-center p-2 pb-4 fw-bolder">{{ $activity->translation->title }}</h4>
                    <div class="blog_full_content">
                    <img class="box" data-src="{{$activity->news_img}}" data-srcset="{{$activity->news_img}} 2x" alt="{{ $activity->translation->title }}" src="{{$activity->news_img}}" srcset="{{$activity->news_img}} 2x">
                        <small>
                            <i class="fas fa-calendar"></i>
                            {{ formatDate($activity->created_at) }}
                        </small>
                    </div>
                    <div>{!! $activity->translation->content !!}</div>
                    @if (!empty($activity->url))
                        <br>
                        <a href="{{ $activity->url }}" class="btn btn-info" data-fancybox>
                            {{__('front.watch_seminar')}}
                        </a>
                    @endif
                </div>
                <br>
                <hr>

                <ul class="releated mt-3">
                    @if (!empty($activity->translation->tags))
                        @php
                            $tags = explode(',', $activity->translation->tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ langUrl('/activities/tag/'.$tag) }}">
                                    {{$tag}}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>

            <div class="col-lg-1">
            </div>

            <div class="col-lg-3">

                <div class="form-group">
                    {{-- @include('front.events') --}}

                  <div class="widget_raper blue mt-3">
                    <p>{{ __('front.latest_activities') }}</p>
                    <div class="recent_post">
                        @foreach ($latestNews as $latest)
                            <a href="{{ langUrl('/activity/'.$latest->slug) }}" class="single_recent_post">
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
                            <a href="{{ langUrl('/activity/'.$most->slug) }}" class="single_recent_post">
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
