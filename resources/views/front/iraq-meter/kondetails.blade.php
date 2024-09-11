@extends('layout.front.app')
@section('title', $kontraining->translation->title)

@section('description', $kontraining->translation->description)
@section('page_img', $kontraining->img)

@section('content')

<section class="breadcrumb-btns green-2 mt-5">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="btn"><a href="#">{{__('front.publish_role')}}</a></li>
          <li class="btn"><a href="#">{{__('front.project_management')}}</a></li>
          <li class="btn"><a href="#">{{ __('front.contact_us') }}</a></li>
        </ul>
      </nav>
</section>

<section class="breadcrumb  mt-4 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item text-greenn"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
          <li class="breadcrumb-item text-greenn"><a href="{{ route('kon.allKon') }}">{{__('front.kon_training')}}</a></li>
          <li class="breadcrumb-item text-greenn active">{{ $kontraining->translation->title }}</li>
        </ol>
      </nav>
</section>


<section class="ruwaq-sec green mt-10 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 position-relative overflow-hidden">
                <h3 class="title-sec-b bg-green">
                    {{__('front.about_kontraining')}}
                </h3>
                <div class="content">
                    <p>{!! $kontraining->translation->content !!}</p>
                </div>
                <hr class="mt-5">
                 <ul class="releated">

                    @if (!empty($kontraining->translation->tags))
                        @php
                            $tags = explode(',', $kontraining->translation->tags);
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
                <img src="{{$kontraining->photo}}" alt="{{$kontraining->translation->title}}">
                <div class="title-page text-center d-block mt-4 text-green border-0">
                    {{$kontraining->translation->title}}
                </div>
                <div class="btns d-flex justify-content-around align-items-center">
                   <a href="#" target="_blank" class="btn btn">{{__('front.read_more')}}</a>
                    <a href="#" target="_blank" class="btn btn">{{__('front.book_promo')}}</a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')
@endsection