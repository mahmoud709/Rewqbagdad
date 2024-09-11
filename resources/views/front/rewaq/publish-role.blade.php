@extends('layout.front.app')
@section('title', __('front.publish_role'))

@section('content')

<section class="breadcrumb-btns grad mt-5">
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="btn"><a href="{{langUrl('/rewaq/publish/role')}}">{{__('front.publish_role')}}</a></li>
          <li class="btn"><a href="{{langUrl('/rewaq/editorial-board')}}">{{__('front.project_management')}}</a></li>
          <li class="btn"><a href="{{langUrl('/rewaq/contact-us')}}">{{ __('front.contact_us') }}</a></li>
        </ul>
      </nav>
</section>


<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
                <li class="breadcrumb-item"><a href="{{ langUrl('/rewaq') }}">{{__('front.rewaq')}}</a></li>
                <li class="breadcrumb-item active">@yield('title')</li>
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
                    <div class="title-page title-page2 green">
                        {{__('front.book_guide')}} :
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