@extends('layout.front.app')
@section('title', __('front.about_center'))

{{-- @section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection --}}

{{-- @section('style')@endsection --}}

{{-- @section('script')@endsection --}}

@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
           <li class="breadcrumb-item"><a href="{{ url()->current() }}">{{ __('front.who_we') }}</a></li>
           <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
         </ol>
       </nav>
    </div>
 </section>

 <section class="about-us-sec bg-white mt-10 mb-5">
     <div class="container">
         <div class="row">
             <div class="col-lg-8">
                 <h2 class="title-sec mb-5">@yield('title')</h2>
                 {!! $about->translation->description !!}
             </div>
             <div class="col-lg-4">
                 <div class="img-box text-center">
                        <img src="{{ $about->img1 }}" alt="@yield('title')">
                 </div>
             </div>
         </div>
     </div>
 </section>

 <section class="vission-sec bg-browns p-3">
     <div class="container">
         <div class="row">
             <div class="col-lg-12 text-center">
               
             </div>
             <div class="col-lg-3">
                 <div class="sticky-top position-sticky">
                        <div class="img-box text-center h-100">
                     <img src="{{ $about->img2 }}" alt="@yield('title')">
                 </div>
                 </div>
              
             </div>
             <div class="col-lg-9">
                <ul class="desc-text mb-5">
                    <h3 class="title-sec text-center">
                        {{ __('front.targets') }}
                    </h3>
                    @php
                        $content = "content_".appLangKey();
                    @endphp
                    @foreach ($targets as $target)
                        <li>{{ $target->$content }}</li>
                    @endforeach
                    
                    
                </ul>
                <ul class="desc-text mb-5">
                        <h3 class="title-sec text-center">
                            {{ __('front.vision') }}
                        </h3>
                        @foreach ($visions as $vision)
                            <li>{{ $vision->$content }}</li>
                        @endforeach
 
                </ul>
                      <ul class="desc-text">
                        <h3 class="title-sec text-center">
                            {{ __('front.means') }}
                        </h3>
                        @foreach ($means as $mean)
                            <li>{{ $mean->$content }}</li>
                        @endforeach
                    </ul>
             </div>
         </div>
     </div>
 </section>

@endsection