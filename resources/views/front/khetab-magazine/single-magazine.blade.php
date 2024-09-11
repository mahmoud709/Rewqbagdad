@extends('layout.front.app')
@section('title', $blog->translation->title)

@section('description', $blog->translation->description)
@section('page_img', $blog->img)

@section('content')

<section class="breadcrumb-btns mt-5">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/khetab-magazine/publish/role') }}">{{__('front.publication_rules')}}</a></li>
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/khetab-magazine/editorial-board') }}">{{ __('front.editorial_board') }}</a></li>
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/khetab-magazine/contact-us')}}">{{__('front.contact_us')}}</a></li>
        </ul>
      </nav>
</section>

<section class="breadcrumb  mt-4 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-brown"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
            <li class="breadcrumb-item text-brown"><a href="{{ langUrl('/khetab-magazine') }}">{{__('front.magazine_archive')}}</a></li>
            <li class="breadcrumb-item text-brown active">@yield('title')</li>
        </ol>
    </nav>
</section>

<section class="ruwaq-sec mt-10 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-right mb-2">
                <h3 class="title-sec fw-bolder">
                    {{-- @yield('title') --}}
                    {{__('front.content_number')}}
                </h3>
            </div>
            <div class="col-lg-6 position-relative overflow-hidden">
                
                @for ($i = 1; $i <10; $i++)
                    @php
                        $title = "title_".$i;
                        $content = "content_".$i;
                    @endphp

                    @if(!empty($blog->translation->$title))
                        <h3 class="title-sec-b bg-brown">{{$blog->translation->$title}}</h3>
                        <div class="content">{!! $blog->translation->$content !!}</div>
                    @endif
                @endfor

            </div>
            
            <div class="col-lg-2">
            </div>
            
            <div class="col-lg-4">
                <img src="{{ $blog->img }}" alt="{{ $blog->translation->title }}">
                <div class="title-page text-center d-block mt-4 text-gold">
                    {{-- {{__('front.the_number')}} {{ $blog->number }} --}}
                    @yield('title')
                </div>
                <div class="btns d-flex justify-content-between align-items-center">
                <a href="{{ $blog->pdf }}" class="btn btn">
                    {{ __('front.download_number') }} {{ $blog->number }}
                </a>
                @if (!empty($blog->promo_url))
                    <a href="{{ $blog->promo_url }}" class="btn btn" data-fancybox>
                        {{ __('front.promo_number') }} {{ $blog->number }}
                    </a>
                @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <img src="/front/assets/img/openn.png" class="img-fluid ceo-img" alt="">
            </div>
            <div class="col-lg-12 mt-2 text-center mb-5">
                <div class="desc-member">
                    {!! $blog->translation->content !!}
                    <strong class="text-left d-flex float-left name-of">
                        {{$blog->translation->writer}}
                    </strong>
                </div>
            </div>
             <div class="col-lg-8">
                <hr>
                <ul class="releated">
                    @if (!empty($blog->translation->tags))
                        @php
                            $tags = explode(',', $blog->translation->tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ langUrl('/khetab-magazine/tag/'.$tag) }}">{{$tag}}</a>
                            </li>
                        @endforeach
                    @endif
                </ul>
             </div>
        </div>
    </div>
</section>

@endsection

@section('js')
@endsection