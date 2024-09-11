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


    <section class="title with-gold mt-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section-heading mx-auto">
                    <h2 class="my-5 text-center shadow-sm mx-auto rounded-30 font-bold p-3">
                        <a href="#">{{ __('front.kon_training') }}</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="activies-sec">
        <div class="container">

            <div class="row justify-content-center align-items-start">
                @foreach ($konTrainings as $training)
                    <div class="col-md-3 book">
                        <a href="{{ route('kon.trainingDetails', $training->slug) }}">
                            <div class="pb-3 pt-3">
                                <img src="{{ $training->photo }}" alt="{{ $training->translation->title }}"
                                    class="border-0 rounded ">
                            </div>
                            <small class="title-sec mb-1">
                                {{-- <strong>{{ formatDate($iraqmeterSurvey->created_at)  }}</strong> --}}
                            </small>
                            <strong class="pt-1 pb-1 d-block">{{ $training->translation->title }}</strong>
                            <p>{{ $training->translation->description }}</p>

                        </a>

                    </div>
                @endforeach
            </div>

        </div>
        <div
            class="col-lg-12 mt-3 text-center m-auto justify-content-center  d-none d-xl-flex d-lg-flex d-md-flex d-sm-none d-xs-none">
            {{ $konTrainings->links() }}
        </div>
    </section>

@endsection


@section('js')
@endsection
