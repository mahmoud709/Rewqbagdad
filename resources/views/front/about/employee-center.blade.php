@extends('layout.front.app')
@section('title', __('front.center_members'))

<style>
    .center-cards {
        margin-bottom: 6rem !important;
        margin-top: 3rem !important;
    }

    .members-center .text-heading h1 {
        color: var(--new-color);
        width: 50%;
    }

    .center-cards .card-title {
        color: var(--new-color);
    }

    .center-cards .card-title img {
        width: 70px;
        height: 60px;
    }

    .center-cards .row div div {
        background-color: var(--new-color)
    }

    .ceo-speech {
        background-color: var(--new-color)
    }

    .speech-info .content {
        flex: 3
    }

    /* .ceo-img img {
        width: 100%;
    } */

    @media (max-width:767px) {
        .members-center .text-heading h1 {
            width: 100%;
        }
    }
@media (min-width: 768px) {
    .ceo-img {
        position: absolute;
        right: 0;
        top: -20px;
        bottom: -20px;
    }

    :lang(ar) .ceo-img {
        left: 0;
    }
}

</style>

@section('content')

    <section class="breadcrumb mt-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{ __('front.home') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url()->current() }}">{{ __('front.who_we') }}</a></li>
                    <li class="breadcrumb-item active">@yield('title')</li>
                </ol>
            </nav>
        </div>
    </section>


    <section class="members-center bg-white">
        <div class="container my-5 mb-5 ">
            <div class="text-heading text-center">
                <h1 class="mx-auto md:w-50">
                    {{ __('front.mahawir_section_title') }}
                </h1>
            </div>
            <div class="center-cards">
                <div class="row justify-content-center align-items-start">
                    @foreach ($mahawirs as $mahawir)
                        <div class="col-md-4 pb-5 pt-2 ">
                            <div class="p-2 py-3 rounded h-full">
                                <div
                                    class="card-title py-1 rounded d-flex justify-content-center align-items-center bg-white">
                                    <img src="{{ $mahawir->photo }}" alt="title-img" />
                                    <h3 class="font-bold p-2">{{ $mahawir->translation->title }} </h3>
                                </div>
                                <div class="card-body">
                                    <p class="text-white p-2 pt-4 font-bold">
                                        {{ $mahawir->translation->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div class="ceo-speech container rounded my-5">
                <div class="speech-info py-5 px-4 my-5 d-flex justify-content-between position-relative">
                    <div class="content flex-grow-1">
                        <h3 class="font-bold text-white">{{ __('front.speech_of_the_center_president') }}</h3>
                        <p class="text-white" style="font-size: 21px"> {!! $headOfcenterWord->translation->content !!} </p>
                    </div>
                    {{-- <div class="ceo-img" style="width: 280px">
                        <img src="{{ $headOfcenterWord->photo }}" alt="ceo-img" class="mx-auto rounded-30" />
                    </div> --}}
                </div>
            </div>

            <div class="row justify-content-center align-items-center">

                @if (!$teamsCEO->isEmpty())
                    <div class="col-md-4">
                        @if (appLangKey() == 'ar')
                            <img src="/front/assets/img/cto.png" class="img-fluid ceo-img" alt="">
                        @else
                            <img src="/front/assets/img/ctoEn.png" class="img-fluid ceo-img" alt="">
                        @endif

                    </div>
                @endif

                @foreach ($teamsCEO as $CEO)
                    <div class="modal fade my-3" id="CEO-{{ $CEO->id }}" tabindex="-1"
                        aria-labelledby="CEO-{{ $CEO->id }}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered max-w-100">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="/front/assets/img/close.png" class="close" alt="close">
                                    </a>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="img-box"><img src="{{ $CEO->img }}"
                                            alt="{{ $CEO->translation->name }}">
                                    </div>
                                    <p class="name">{{ $CEO->translation->name }}</p>
                                    <a href="mailto:{{ $CEO->email }}">{{ $CEO->email }} <img
                                            src="/front/assets/img/mail.png" alt=""></a>
                                    <p>{!! $CEO->translation->description !!}</p>
                                    @if (!empty($CEO->cv_link))
                                        <a href="{{ $CEO->cv_link }}"
                                            class="btn btn-info text-white">{{ __('front.to_go_to_resume') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#CEO-{{ $CEO->id }}">
                            <div class="img-box"><img src="{{ $CEO->img }}" alt="{{ $CEO->translation->name }}"></div>
                            <div class="desc-member">
                                <small>
                                    <strong>{{ $CEO->translation->name }}</strong>
                                </small>
                                <p>{{ $CEO->translation->job_title }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach

                <div class="my-5 text-center">
                    <h3 class="font-bold">{{ __('front.board_members') }}</h3>
                </div>


                @foreach ($teamsMEM as $MEM)
                    <div class="modal fade" id="MEM-{{ $MEM->id }}" tabindex="-1"
                        aria-labelledby="MEM-{{ $MEM->id }}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered max-w-100">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="/front/assets/img/close.png" class="close" alt="close">
                                    </a>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="img-box"><img src="{{ $MEM->img }}"
                                            alt="{{ $MEM->translation->name }}"></div>
                                    <p class="name">{{ $MEM->translation->name }}</p>
                                    <a href="mailto:{{ $MEM->email }}">{{ $MEM->email }} <img
                                            src="/front/assets/img/mail.png" alt=""></a>
                                    <p>{!! $MEM->translation->description !!}</p>
                                    @if (!empty($MEM->cv_link))
                                        <a href="{{ $MEM->cv_link }}"
                                            class="btn btn-info text-white">{{ __('front.to_go_to_resume') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#MEM-{{ $MEM->id }}">
                            <div class="img-box"><img src="{{ $MEM->img }}" alt="{{ $MEM->translation->name }}">
                            </div>
                            <div class="desc-member">
                                <small>
                                    <strong>{{ $MEM->translation->name }}</strong>
                                </small>
                                <p>{{ $MEM->translation->job_title }}</p>
                            </div>
                        </a>

                    </div>
                @endforeach

                <div class="my-5 text-center">
                    <h3 class="font-bold">{{ __('front.staff_corridor') }}</h3>
                </div>

                @foreach ($teamsEMP as $EMP)
                    <div class="modal fade" id="EMP-{{ $EMP->id }}" tabindex="-1"
                        aria-labelledby="EMP-{{ $EMP->id }}Title" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered max-w-100">
                            <div class="modal-content">
                                <div class="modal-header">

                                    <a href="#" data-bs-dismiss="modal" aria-label="Close">
                                        <img src="/front/assets/img/close.png" class="close" alt="close">
                                    </a>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="img-box"><img src="{{ $EMP->img }}"
                                            alt="{{ $EMP->translation->name }}"></div>
                                    <p class="name">{{ $EMP->translation->name }}</p>
                                    <a href="mailto:{{ $EMP->email }}">{{ $EMP->email }} <img
                                            src="/front/assets/img/mail.png" alt=""></a>
                                    <p>{!! $EMP->translation->description !!}</p>
                                    @if (!empty($EMP->cv_link))
                                        <a href="{{ $EMP->cv_link }}"
                                            class="btn btn-info text-white">{{ __('front.to_go_to_resume') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#EMP-{{ $EMP->id }}">
                            <div class="img-box"><img src="{{ $EMP->img }}" alt="{{ $EMP->translation->name }}">
                            </div>
                            <div class="desc-member">
                                <small>
                                    <strong>{{ $EMP->translation->name }}</strong>
                                </small>
                                <p>{{ $EMP->translation->job_title }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
        {{-- <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle"  aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered max-w-100">
          <div class="modal-content">
            <div class="modal-header">

                <a href="#" data-bs-dismiss="modal" aria-label="Close">
                    <img src="/front/assets/img/close.png" class="close" alt="close">
                </a>
            </div>
            <div class="modal-body text-center">
                <div class="img-box"><img src="/front/assets/img/5395fd71-b01b-45fa-9cd7-f1746ca09a01.jpg" alt="members"></div>
                <p class="name">
                    عباس العنبوري
                </p>
                <a href="mailto:abbas_alanbory@gmail.com">abbas_alanbory@gmail.com <img src="/front/assets/img/mail.png" alt=""></a>
                <p>
                    الأستاذ المتمرس د. كامل علاوي كاظم تعرف قاعدة القيمة أو معيار القيمة بأنها الوحدة الأساس الذي يتخذها البلد في قياس القيم الاقتصادية، وتنجز الالتزامات المالية بها فضلاً عن إجراء المقارنة بين قيم السلع، لكونها وحدة الحساب الة في النظام النقدي للبلد، ويجري تعيين معيار القيمة من قبل الدولة. وبشكل عام يوجد نوعين من القواعد هما؛ القواعد المعدنية والقواعد الورقية( ). وتشكل قاعدة القيمة محور القاعدة النقدية التي تعد الأساس الذي يقوم عليه النظام النقدي، ويتوقف نجاح النظام النقدي على تحقيق النمو الاقتصادي وتوفير عرض نقد كاف يسهل عملية التبادل التجاري.
                </p>
                <a href="#" class="btn btn-info text-white">للذهاب للسيرة الذاتية</a>
            </div>
          </div>
        </div>
    </div> --}}
    </section>



@endsection
