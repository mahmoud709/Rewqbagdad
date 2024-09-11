@extends('layout.front.app')
@section('title', $event->translation->name )


@section('description', $event->translation->description)
@section('page_img', $event->img)


@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('global.event.title')}}</li>
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

                        <img class="box" data-src="{{ $event->img }}" data-srcset="{{ $event->img }} 2x" alt="@yield('title')" src="{{ $event->img }}" srcset="{{ $event->img }} 2x">
                        <small>
                            <i class="fas fa-calendar"></i>
                            {{ formatDate($event->created_at) }}
                        </small>                     
                    </div>
                    <div>{!! $event->translation->content !!}</div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection

