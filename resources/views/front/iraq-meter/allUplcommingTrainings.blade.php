@extends('layout.front.app')
@section('title', __('front.kon_training'))

@section('description', '')
@section('page_img', '')

@section('content')

    <style>
        .section-heading {
            width: fit-content;
        }

        .section-heading h2 {
            color: var(--new-color);
        }

        .book {
            height: auto;
            margin-bottom: 20px;
        }

        .book a img {
            height: 400px !important;
        }

        .book .pb-3,
        .book .pt-3 {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

        <section class="my-5 videos-sec">
        <a href="{{ route('bodcast.blogs') }}">
            <div class="section-heading pb-30 text-center shadow-sm mx-auto rounded-30 my-3">
                <h2 class="font-bold p-3">{{ __('front.kon_upcommingtrainings') }}</h2>
            </div>
        </a>
    </section>

    <section class="activies-sec">
        <div class="container">

            <div class="row justify-content-center align-items-start">
                @foreach ($allUpcommingTrainings as $allUpcommingTraining)
                    <div class="col-md-3 book">
                        <a href="{{ route('kon.upcommingTrainingDetails', $allUpcommingTraining->slug) }}">
                            <div class="pb-3 pt-3">
                                <img src="{{ $allUpcommingTraining->photo }}" alt="{{ $allUpcommingTraining->translation->title }}"
                                    class="border-0 rounded h-full ">
                            </div>
                            <small class="title-sec mb-1">
                                <strong>{{ formatDate($allUpcommingTraining->created_at)  }}</strong>
                            </small>
                            <strong class="pt-1 pb-1 d-block">{{ $allUpcommingTraining->translation->title }}</strong>
                            <p>{{ $allUpcommingTraining->translation->description }}</p>

                        </a>

                    </div>
                @endforeach
            </div>
            <div
            class="col-lg-12 mt-3 text-center m-auto justify-content-center  d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
            {{ $allUpcommingTrainings->links() }}
        </div>
        </div>
    </section>

@endsection


@section('js')
@endsection
