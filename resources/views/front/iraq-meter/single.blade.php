@extends('layout.front.app')
@section('title', $blog->translation->title )


@section('description', $blog->translation->description)
@section('page_img', $blog->news_img)


@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
            <li class="breadcrumb-item"><a href="{{ langUrl('/iraq/meter') }}">{{__('front.iraqmeter')}}</a></li>
            <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>
</section>

<section class="activies-sec mb-5 mt-5">
    <div class="container bg-light raduis-35 pt-4 p-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="blog_detaisl_area">
                    <h4 class="text-center p-2 pb-4 fw-bolder">@yield('title')</h4>
                    <div class="blog_full_content">

                        <img class="box" data-src="{{ $blog->news_img }}" data-srcset="{{ $blog->news_img }} 2x" alt="@yield('title')" src="{{ $blog->news_img }}" srcset="{{ $blog->news_img }} 2x">
                        <small>
                            <i class="fas fa-calendar"></i>
                            {{ formatDate($blog->created_at) }}
                        </small>                     
                    </div>
                   
                    <div>{!! $blog->translation->title !!}</div>
                    <div>{!! $blog->translation->content !!}</div>
  
                    <a href="{{ $blog->promo_url }}" class="btn btn-2" style="background: rgb(78, 198, 189);">
                        الاستبيان
                    </a>

                </div> <br> <hr>

                <ul class="releated">
                    @if (!empty($blog->translation->tags))
                        @php
                            $tags = explode(',', $blog->translation->tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ langUrl('/iraq/meter/tag/'.$tag) }}">{{$tag}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>


            </div>
        </div>
    </div>
</section>

@endsection

