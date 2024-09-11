@extends('layout.front.app')
@section('title', $text)

@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
                <li class="breadcrumb-item active">{{__('front.search_results')}}: {{$text}}</li>
            </ol>
       </nav>
    </div>
</section>

<section class="activies-sec mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">

                @if(!$versions->isEmpty())
                    <h2 style="background: #f5f5f5">{{__('front.versions')}}</h2>
                    @foreach ($versions as $version)
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4">
                                <a href="{{ langUrl('/version/'.$version->slug) }}">
                                    <div class="img-box pb-3 pt-3">
                                        <img src="{{$version->img}}" height="250" alt="{{$version->translation->title}}" class="border-0">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{ langUrl('/version/'.$version->slug) }}">
                                    <small class="title-sec mb-1"><strong>{{ formatDate($version->created_at) }}</strong></small>
                                    <strong class="pt-1 pb-1 d-block">{{$version->translation->title}}</strong>
                                    <p>{{$version->translation->description}}</p>
                                    <strong class="department-name mb-4">{{__('front.versions')}} - {{$version->category->name}}</strong>
                                </a>
                            </div>
                            <hr> 
                        </div>
                    @endforeach
                @endif
                {{-- |||||||||||||||||||||||||||||||||||||||||||||||||||| --}}
                
                @if(!$activities->isEmpty())
                    <h2 style="background: #f5f5f5">{{__('front.activities')}}</h2>
                    @foreach ($activities as $activite)
                    <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4">
                                <a href="{{langUrl('/activity/'.$activite->slug)}}">
                                    <div class="img-box pb-3 pt-3">
                                        <img src="{{$activite->img}}" height="250" alt="{{$activite->translation->title}}" class="border-0">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{langUrl('/activity/'.$activite->slug)}}">
                                    <small class="title-sec mb-1"><strong>{{ formatDate($activite->created_at) }}</strong></small>
                                    <strong class="pt-1 pb-1 d-block">{{$activite->translation->title}}</strong>
                                    <p>{{$activite->translation->description}}</p>
                                    <strong class="department-name mb-4">{{__('front.activities')}} - {{$activite->category->name}}</strong>
                                </a>
                            </div>
                            <hr> 
                        </div>
                    @endforeach
                @endif
                

                @if(!$books->isEmpty())
                    <h2 style="background: #f5f5f5">{{__('front.activities')}}</h2>
                    @foreach ($books as $book)
                    <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4">
                                <a href="{{langUrl('/rewaq/book/'.$book->slug)}}">
                                    <div class="img-box pb-3 pt-3">
                                        <img src="{{$book->img}}" height="250" alt="{{$book->translation->title}}" class="border-0">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{langUrl('/rewaq/book/'.$book->slug)}}">
                                    <small class="title-sec mb-1"><strong>{{ formatDate($book->created_at) }}</strong></small>
                                    <strong class="pt-1 pb-1 d-block">{{$book->translation->title}}</strong>
                                    <p>{{$book->translation->description}}</p>
                                    <strong class="department-name mb-4">{{__('front.rewaq')}}</strong>
                                </a>
                            </div>
                            <hr> 
                        </div>
                    @endforeach
                @endif
                

                @if(!$magazines->isEmpty())
                    <h2 style="background: #f5f5f5">{{__('front.magazine')}}</h2>
                    @foreach ($magazines as $magazin)
                    <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4">
                                <a href="{{langUrl('/magazine/blog/'.$magazin->slug)}}">
                                    <div class="img-box pb-3 pt-3">
                                        <img src="{{$magazin->img}}" height="250" alt="{{$magazin->translation->title}}" class="border-0">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{langUrl('/magazine/blog/'.$magazin->slug)}}">
                                    <small class="title-sec mb-1"><strong>{{ formatDate($magazin->created_at) }}</strong></small>
                                    <strong class="pt-1 pb-1 d-block">{{$magazin->translation->title}}</strong>
                                    <p>{{$magazin->translation->description}}</p>
                                    <strong class="department-name mb-4">{{__('front.magazine')}}</strong>
                                </a>
                            </div>
                            <hr> 
                        </div>
                    @endforeach
                @endif
                

                @if(!$magazines->isEmpty())
                    <h2 style="background: #f5f5f5">{{__('front.iraqmeter')}}</h2>
                    @foreach ($iraqmeters as $iraqmeter)
                    <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4">
                                <a href="{{langUrl('/iraq/meter/'.$iraqmeter->slug)}}">
                                    <div class="img-box pb-3 pt-3">
                                        <img src="{{$iraqmeter->img}}" height="250" alt="{{$iraqmeter->translation->title}}" class="border-0">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{langUrl('/iraq/meter/'.$iraqmeter->slug)}}">
                                    <small class="title-sec mb-1"><strong>{{ formatDate($iraqmeter->created_at) }}</strong></small>
                                    <strong class="pt-1 pb-1 d-block">{{$iraqmeter->translation->title}}</strong>
                                    <p>{{$iraqmeter->translation->description}}</p>
                                    <strong class="department-name mb-4">{{__('front.iraqmeter')}}</strong>
                                </a>
                            </div>
                            <hr> 
                        </div>
                    @endforeach
                @endif
               
                @if(!$medianews->isEmpty())
                    <h2 style="background: #f5f5f5">{{__('front.media_center')}}</h2>
                    @foreach ($medianews as $media)
                    <div class="row justify-content-center align-items-center">
                            <div class="col-lg-4">
                                <a href="{{langUrl('/media/center/news/'.$media->slug)}}">
                                    <div class="img-box pb-3 pt-3">
                                        <img src="{{$media->img}}" height="250" alt="{{$media->translation->title}}" class="border-0">
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-8">
                                <a href="{{langUrl('/media/center/news/'.$media->slug)}}">
                                    <small class="title-sec mb-1"><strong>{{ formatDate($media->created_at) }}</strong></small>
                                    <strong class="pt-1 pb-1 d-block">{{$media->translation->title}}</strong>
                                    <p>{{$media->translation->description}}</p>
                                    <strong class="department-name mb-4">{{__('front.media_center')}}</strong>
                                </a>
                            </div>
                            <hr> 
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</section>

@endsection


@section('js')
@endsection