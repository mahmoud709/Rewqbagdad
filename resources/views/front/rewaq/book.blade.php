@extends('layout.front.app')
@section('title', $book->translation->title)

@section('description', $book->translation->description)
@section('page_img', $book->img)

@section('content')

<section class=" mt-5">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="btn"><a href="{{langUrl('/rewaq/publish/role')}}">{{__('front.publish_role')}}</a></li>
          <li class="btn"><a href="{{langUrl('/rewaq/editorial-board')}}">{{__('front.project_management')}}</a></li>
          <li class="btn"><a href="{{langUrl('/rewaq/contact-us')}}">{{ __('front.contact_us') }}</a></li>
        </ul>
      </nav>
</section>

<section class="breadcrumb  mt-4 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item text-greenn"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
          <li class="breadcrumb-item text-greenn"><a href="{{ langUrl('/rewaq') }}">{{__('front.rewaq')}}</a></li>
          <li class="breadcrumb-item text-greenn active">{{ $book->translation->title }}</li>
        </ol>
      </nav>
</section>


<section class="ruwaq-sec green mt-10 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 position-relative overflow-hidden">
                <h3 class="title-sec-b bg-green">
                    {{__('front.about_book')}}
                </h3>
                <div class="content">
                    <p>{!! $book->translation->content !!}</p>
                </div>
                <hr class="mt-5">
                 <ul class="releated">

                    @if (!empty($book->translation->tags))
                        @php
                            $tags = explode(',', $book->translation->tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ langUrl('/rewaq/book/tag/'.$tag) }}">
                                    {{$tag}}
                                </a>
                            </li>
                        @endforeach
                    @endif
                 </ul>
            </div>

            <div class="col-lg-1">
            </div>

            <div class="col-lg-4">
                <img src="{{$book->img}}" alt="{{$book->translation->title}}">
                <div class="title-page text-center d-block mt-4 text-green border-0">
                    {{$book->translation->title}}
                </div>
                <div class="btns d-flex justify-content-around align-items-center">
                   <a href="{{ $book->index_url }}" target="_blank" class="btn btn">{{__('front.book_index')}}</a>
                    <a href="{{ $book->promo_url }}" target="_blank" class="btn btn">{{__('front.book_promo')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')
@endsection
