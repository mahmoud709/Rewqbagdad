@extends('layout.front.app')
@section('title', __('front.activities'))

@section('content')

@if(!$activities->isEmpty())
{{-- bg-white-greding --}}
<section class="about-us-sec my-5">
    <div class="container">
        <div class="row pt-5 justify-content-center align-items-basline">
            <div class="col-lg-5">
                {{-- <h2 class="title-sec">@yield('title')</h2> --}}
                <div class="img-box text-center pb-3 border-0">
                    <img src="{{ $activities[0]->img }}" alt="{{ $activities[0]->translation->title }}" class="border-0">
                </div>
            </div>
            <div class="col-lg-1">
            </div>

            <div class="col-lg-6 pt-5">
                <small class="title-sec mb-2">
                    <strong>{{ formatDate($activities[0]->created_at) }}</strong>
                </small>
                {{-- <strong class="pt-3 pb-3 d-block title-activite">{{ $activities[0]->translation->title }}</strong> --}}
                <div class="sub-title color-black py-4">{{ $activities[0]->translation->description }}</div>
                <br>
              <div class="row align-items-center">
                <div class="col-lg-12 ">
                    <div class="text float-right">
                        <a href="{{ langUrl('/activity/'.$activities[0]->slug) }}" class="btn btn text-white">
                            {{__('front.for_more')}}
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
            <div class="col-lg-8">

                <div class="d-grid justify-content-start align-items-center">
                    <p class="text-blue py-2">{{__('front.select_type_activity')}}</p>
                    <select class="mb-4 ">
                        <option selected value="{{langUrl('/activities')}}" data-display="{{__('front.all_results')}}">{{__('front.all_results')}}</option>
                        @foreach ($ActivityCats as $cat)
                            <option value="{{langUrl('/activities/category/'.$cat->slug)}}">{{ $cat->translation->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row justify-content-center align-items-center">
                    @foreach ($activities as $key => $row)
                        @if ($key == 0)
                            @php continue @endphp
                        @endif

                        <div class="col-lg-4">
                            <a href="{{ langUrl('/activity/'.$row->slug) }}">
                                <div class="img-box pb-3 pt-3">
                                    <img src="{{ $row->img }}" alt="{{ $row->translation->title }}" class="border-0">
                                </div>
                            </a>
                            </div>
                            <div class="col-lg-8">
                            <a href="{{ langUrl('/activity/'.$row->slug) }}">
                                <small class="title-sec mb-1">
                                    <strong>{{ formatDate($row->created_at) }}</strong>
                                </small>
                                <strong class="pt-1 pb-1 d-block">{{ $row->translation->title }}</strong>
                                <div>{{ $row->translation->description }}</div>
                                <strong class="department-name mb-4">{{ $row->category->name }}</strong>
                            </a>
                        </div>
                        <hr>
                    @endforeach


                </div>
            </div>
            {{-- <div class="col-lg-3 margin20">

                <div class="form-group">

                    @include('front.events')


                    <div class="widget_raper mt-3">
                      <p>{{ __('front.latest_activities') }}</p>
                      <div class="recent_post">
                        @foreach ($latestNews as $latest)
                            <a href="{{ langUrl('/activity/'.$latest->slug) }}" class="single_recent_post">
                                <span class="rp_img" style="background-image: url({{ $latest->img }});"></span>
                                <span>{{ formatDate($latest->created_at) }}</span>
                                <h4>{{ $latest->translation->title }}</h4>
                            </a>
                            <hr>
                        @endforeach
                      </div>

                  </div>
                  <div class="widget_raper bg-light p-2 mt-3">
                    <p>{{ __('front.most_watched') }}</p>

                    <div class="recent_post">
                        @foreach ($mostWatched as $most)
                            <a href="{{ langUrl('/activity/'.$most->slug) }}" class="single_recent_post">
                                <span>{{ formatDate($most->created_at) }}</span>
                                <h4>{{$most->translation->title}}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>

                </div>
            </div> --}}
            <div class="col-lg-12 mt-3 text-center">{!! $activities->links() !!}</div>
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
