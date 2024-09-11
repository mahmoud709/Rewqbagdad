@extends('layout.front.app')
@section('title', __('front.i_parliament'))

@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
            </ol>
        </nav>
    </div>
</section>
<div class="mt-5 bg-green"></div>

<section class="perlament-sec mt-10 mb-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="title-sec-b">{{__('front.about_parliament')}}</h3>
            </div>
        </div>
    </div>
</section>

<section class="parlmente-sec mb-5 h-auto">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="section-title text-right pb-1 mb-1">
                    <h2 class="title ">
                        <span class="baby-blue">{{__('front.i')}}</span> {{__('front.parliament')}}
                    </h2>
                </div>
                <div>{!! $data->translation->content !!}</div>
            </div>
            <div class="col-lg-3">
                <div class="img-box text-center">
                    <img src="{{$data->img}}" alt="@yield('title')">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="title mt-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3 class="title-sec-b">{{__('front.to_download_app')}}</h3>
            </div>
        </div>
    </div>
</section>

<section class="title mt-2 mb-30">
    <div class="container">
        <div class="section-title d-flex justify-content-start align-items-center text-right pb-30">
            <h2 class="title down-i-parliament" ><span class="baby-blue left-i-parliament">{{__('front.i')}}</span> {{__('front.parliament')}}</h2>
            <p class="pe-3 mb-0">{{ $data->translation->description }}</p>
        </div>
        
        <div class="section-title text-right pb-30">
            <img src="{{url('front/assets/img/Rectangle (2).png')}}" alt=""> <h2 class="title "><span class="baby-blue">{{__('front.i')}}</span> {{__('front.parliament')}}</h2>
        </div>
        
    </div>
</section>

    
<div class="container ">
    
	<section class="parlmente-sec bg-light pt-3">
        <div class="shape shape-one">
            <img src="/front/assets/img/shape1.png" alt="shape">
        </div>
        <div class="shape shape-tow">
            <img src="/front/assets/img/shape2.png" alt="shape">
        </div>
        <div class="shape shape-three">
            <img src="/front/assets/img/shape3.png" alt="shape">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    {{-- <img src="/front/assets/img/mokups.png" alt="mokups"> --}}
                    <img src="{{ $data->img_app }}" alt="mokups">
                </div>
                <div class="col-lg-8">
                    <div class="content_block_1">
                        <div class="content-box">
                            <div class="text">
                                <h2 class="title">
                                    {{__('front.application')}} <span class="baby-blue">{{__('front.i')}}</span> {{__('front.parliament')}}
                                </h2>
                                <p>
                                    {{__('front.par_mes1')}} <span class="baby-blue">{{__('front.par_mes2')}}</span>
                                </p>
                                <!--<div class="buttons d-xl-flex d-lg-flex justify-content-between align-items-center">-->
                                <!--    <a href="https://iamtheparliament.com/" target="_blank" class="btn m-xs-auto m-sm-auto m-md-auto m-lg-0 m-xl-0 ">-->
                                <!--        {{__('front.view_details')}}-->
                                <!--    </a>-->
                                <!--    <div class="btns d-flex justify-content-between align-items-center">-->
                                <!--        <a href="{{ $data->google_url }}" target="_blank" class="btn mt-0 margin-r-par">-->
                                <!--            {{__('front.download_google_Play')}}-->
                                <!--        </a>-->
                                <!--        <a href="{{ $data->apple_url }}" target="_blank" class="btn mt-0 margin-r-par">-->
                                <!--            {{__('front.download_apple_store')}}-->
                                <!--        </a>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <div class="buttons d-xl-flex d-lg-flex justify-content-between align-items-center">
                                <div class="btns d-flex justify-content-between align-items-center">
                                    <a href="{{langUrl('/parliament')}}" class="btn m-xs-auto m-sm-auto m-md-auto m-lg-0 m-xl-0 ">
                                       {{__('front.view_details')}}
                                    </a>
                                    <a href="https://iamtheparliament.com/" class="btn me-xl-3 m-xs-auto m-sm-auto m-md-auto m-lg-0 m-xl-0 d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
                                        {{__('front.parliament_site')}}
                                    </a>
                                </div>
                                <div class="btns">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <img src="{{url('front/assets/img/Rectangle (2).png')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="btns d-flex justify-content-between align-items-center">
                                        <a href="{{$data->google_url}}" class="btn">
                                            {{__('front.download_google_Play')}}
                                        </a>
                                        <a href="{{$data->apple_url}}" class="btn">
                                            {{__('front.download_apple_store')}}
                                        </a>
                                    </div>
                                   
                                </div>
                            </div>
                            
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<section class="title mt-2">
    <div class="container">
        <h3 class="title-sec-b">{{__('front.videos_about_application')}}</h3>
    </div>
</section>

<section class="gallery-area videos perlament mt-10">
    <div class="container raduis-35 p-5">
        <div class="row">
            
            @foreach ($videos as $video)
                <div class="col-lg-3 col-6">
                    <div class="meeting-event-box">
                        <div class="content justify-content-end">
                            <a id="copyVideo" data-videoUrl="{{$video->video_url }}" class="share-btn copyVideo">
                                <i class="bg-green fas fa-share"></i>
                            </a>
                        </div>
                        <figure class="reveal-effect animated">
                            <a href="{{ $video->video_url }}" data-fancybox><i class="fas fa-play"></i></a>
                            <img width="100%" height="100%" src="{{ $video->img }}" alt="{{ $video->translation->name }}"></a>
                        </figure>
                        <div class="content">
                            <h5>{{ $video->translation->name }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
            

            <div class="col-lg-12 mt-3 text-center">
                {!! $videos->links() !!}
            </div>
        </div>
    </div>
</section>

@endsection


@section('js')
@endsection