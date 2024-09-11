@extends('layout.front.app')
@section('title', __('front.project_management'))

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


<section class="ask-adding mt-5 mb-5 grey-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-page">@yield('title')</div>
            </div>
            <div class="col-lg-12">
               <div class="box">
                    @foreach ($teams as $team)

                        <div class="modal fade" id="CEO-{{$team->id}}" tabindex="-1" aria-labelledby="CEO-{{$team->id}}Title"  aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered max-w-100">
                            <div class="modal-content">
                                <div class="modal-header  modal-header2 height45">
                                
                                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="/front/assets/img/close.png" class="close close-modal2" alt="close">
                                    </a>

                                </div>
                                <div class="modal-body text-center">
                                    <div class="img-box"><img src="{{ $team->img }}" class="img-model2" alt="{{ $team->translation->name }}"></div>
                                    <p class="name name-model2">{{ $team->translation->name }}</p>
                                    <a class="mailto mailto-model2" href="mailto:{{ $team->email }}">{{ $team->email }} <img class="mailto-img-model2" src="/front/assets/img/mail.png" alt=""></a>
                                    <p class="des des-model2">{{ $team->translation->description }}</p>
                                    @if (!empty($team->cv_link))
                                        <a href="{{ $team->cv_link }}" class="btn btn-info text-white">{{ __('front.to_go_to_resume') }}</a>
                                    @endif
                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="title-page title-page2 dar-color margin-bottom15">{{$team->translation->job_title}}</div>
                        <p>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#CEO-{{$team->id}}">{{$team->translation->name}}</a>
                            <br>
                            <a href="mailto:{{$team->email}}">{{$team->email}}</a>    
                        </p>
                    @endforeach
               </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('js')
@endsection