@extends('layout.front.app')
@section('title', $upcommingTraining->translation->title)

@section('description', $upcommingTraining->translation->description)
@section('page_img', $upcommingTraining->img)

@section('content')

<section class="breadcrumb-btns green-2 mt-5">
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
          <li class="breadcrumb-item text-greenn"><a href="{{ route('kon.allUpcommingTrainings') }}">{{__('front.kon_upcommingtrainings')}}</a></li>
          <li class="breadcrumb-item text-greenn active">{{ $upcommingTraining->translation->title }}</li>
        </ol>
      </nav>
</section>


<section class="ruwaq-sec green mt-10 mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 position-relative overflow-hidden">
                <h3 class="title-sec-b bg-green">
                    {{__('front.kon_about_upcommingtrainings')}}
                </h3>
                <div class="content">
                    <p>{!! $upcommingTraining->translation->content !!}</p>
                </div>
                <hr class="mt-5">
                 <ul class="releated">

                    @if (!empty($upcommingTraining->translation->tags))
                        @php
                            $tags = explode(',', $upcommingTraining->translation->tags);
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
                <img src="{{$upcommingTraining->photo}}" alt="{{$upcommingTraining->translation->title}}">
                <div class="title-page text-center d-block mt-4 text-green border-0">
                    {{$upcommingTraining->translation->title}}
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