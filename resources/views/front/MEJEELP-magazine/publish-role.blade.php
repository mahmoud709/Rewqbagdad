@extends('layout.front.app')
@section('title', __('front.publication_rules'))

@section('content')

<section class="breadcrumb-btns mt-5">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/MEJEELP-magazine/publish/role') }}">{{__('front.publication_rules')}}</a></li>
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/MEJEELP-magazine/editorial-board') }}">{{ __('front.editorial_board') }}</a></li>
            <li class="btn border-breadcrumb-magazine"><a href="{{ langUrl('/MEJEELP-magazine/contact-us')}}">{{__('front.contact_us')}}</a></li>
        </ul>
      </nav>
</section>

<section class="breadcrumb  mt-4">
    <div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item text-brown"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
            <li class="breadcrumb-item text-brown"><a href="{{ langUrl('/MEJEELP-magazine') }}">{{__('front.magazine_archive')}}</a></li>
            <li class="breadcrumb-item text-brown active">@yield('title')</li>
        </ol>
    </nav>
    </div>
</section>


<section class="ask-adding mt-5 grey-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="title-page">@yield('title')</div>
            </div>
            <div class="col-lg-12">
               <div class="box">
                    <div class="title-page title-page2">
                        {{__('front.author_guide')}} :
                    </div>
                    <div>{!! $data->translation->content !!}</div>
               </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
@endsection