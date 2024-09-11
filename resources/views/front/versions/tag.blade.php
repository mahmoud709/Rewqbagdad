@extends('layout.front.app')
@section('title', $tag)

@section('content')

@if(!$versions->isEmpty())
<section class="about-us-sec bg-white-greding-blue mb-5">
    <div class="container">
        <div class="row pt-5 justify-content-center align-items-basline">
            <div class="col-lg-5">
                <h2 class="title-sec text-white">
                    @yield('title')
                </h2>
                <div class="img-box text-center pb-3">
                    <img src="{{ $versions[0]->img }}" alt="{{$versions[0]->translation->title}}" class="border-0">
                </div>
            </div>
            
            <div class="col-lg-1">
            </div>
            
            <div class="col-lg-6 pt-5   ">
                <small class="title-sec mb-2">
                    <strong>{{ formatDate($versions[0]->created_at) }}</strong>
                </small>
                <strong class="pt-3 pb-3 d-block title-activite">{{$versions[0]->translation->title}}</strong>
                <p class="sub-title">{{$versions[0]->translation->description}}</p>
                <br>
              <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="text">
                        <figure class="admin-thumb">
                            <img src="{{ $versions[0]->writermain->img }}" width="27" height="27" alt="{{ $versions[0]->writer->name }}">
                        </figure>
                        <h4><a href="{{ langUrl('/version/'.$versions[0]->slug) }}">{{ $versions[0]->writer->name }}</a></h4>
                    </div>
                </div> 
                 <div class="col-lg-4"></div>
                <div class="col-lg-1">
                    <div class="text">
                        <figure class="admin-thumb">
                            <a href="{{ $versions[0]->pdf }}">
                                <img class="border-0" src="/front/assets/img/a.png" alt="{{$versions[0]->translation->title}}">
                            </a>
                        </figure>
                        
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="text">
                        <a href="{{ langUrl('/version/'.$versions[0]->slug) }}" class="btn btn">
                            {{ __('front.for_more') }}
                        </a>
                    </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</section>
@endif


<section class="activies-sec mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="d-grid justify-content-start align-items-center">
                <p class="text-blue">{{ __('front.select_version_type') }}</p>
                <select class="mb-4">
                    @php
                        $VersionsCats = \App\Models\Versioncategory::with('translation')->orderBy('sort','asc')->get();
                    @endphp
                    <option value="{{langUrl('/versions')}}" data-display="{{__('front.all_results')}}">{{__('front.all_results')}}</option>
                    <option selected value="{{langUrl('/version/tag/'.$tag)}}" data-display="{{$tag}}">{{$tag}}</option>
                    @foreach ($VersionsCats as $VS)
                        <option value="{{langUrl('/versions/category/'.$VS->slug)}}" data-display="{{$VS->translation->name}}">{{$VS->translation->name}}</option>
                    @endforeach
                  </select>
                </div>
               
                <div class="row justify-content-center align-items-center">
                    @foreach ($versions as $key => $row)
                        @if ($key == 0) 
                            @php continue @endphp
                        @endif
                        <div class="col-lg-4">
                        <a href="{{ langUrl('/version/'.$row->slug) }}">
                            <div class="img-box pb-3 pt-3">
                                <img src="{{ $row->img }}" alt="{{$row->translation->title}}" class="border-0">
                            </div>
                        </a>
                        </div>
                        <div class="col-lg-8">
                        <a href="{{ langUrl('/version/'.$row->slug) }}">
                            <small class="title-sec mb-1">
                                <strong>{{ formatDate($row->created_at) }}</strong>
                            </small>
                            <strong class="pt-1 pb-1 d-block">{{$row->translation->title}}</strong>
                            <p>{{$row->translation->description}}</p>
                            <strong class="department-name">{{$row->category->name}}</strong>
                            <hr>
                        <div class="row">
                            <div class="col-6">
                                <div class="text">
                                <figure class="admin-thumb">
                                    <img src="{{ $row->writermain->img }}" width="27" height="27" alt="{{ $row->writer->name }}">
                                </figure>
                                <h4><a href="{{ langUrl('/version/'.$row->slug) }}">{{ $row->writer->name }}</a></h4>
                            </div>
                            </div>
                            <div class="col-6">
                            <div class="text pdf-left">
                                    <a href="{{ $row->pdf }}">
                                        <figure class="admin-thumb">
                                            {{__('front.view_full_article')}}
                                            <img class="border-0" src="/front/assets/img/a.png" alt="LogoImage">
                                        </figure>
                                    </a>
                                </div>
                            </div>
                        </div>
                        </a>
                        </div>
                        <hr>
                    @endforeach

                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    @include('front.events')
                    <div class="widget_raper mt-3">
                        <p>{{ __('front.latest_versions') }}</p>
                        <div class="recent_post">
                            @foreach ($latestNews as $item)
                                <a href="{{ langUrl('/version/'.$item->slug) }}" class="single_recent_post">
                                    <span class="rp_img" style="background-image: url({{$item->img}});"></span>
                                    <span>{{ formatDate($item->created_at) }}</span>
                                    <h4>{{$item->translation->title}}</h4>
                                </a>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                  <div class="widget_raper bg-light p-2 mt-3">
                    <p>{{ __('front.most_watched') }}</p>

                    <div class="recent_post">

                        @foreach ($mostWatched as $most)
                            <a href="{{ langUrl('/version/'.$most->slug) }}" class="single_recent_post">
                                <span>{{ formatDate($most->created_at) }}</span>
                                <h4>{{$most->translation->title}}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-lg-12 mt-3 text-center">
                {!! $versions->links() !!}
            </div>
        </div>
    </div>
</section>

@endsection


@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('select').niceSelect();
        $('select').on('change', function() {
            window.location.href = $(this).val();
        });
    });
    $(document).ready(function(){
        $('#datepicker').datepicker(); 
    });
</script>
@endsection