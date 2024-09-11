@extends('layout.front.app')
@section('title', __('front.authors'))


@section('content')

<section class="breadcrumb mt-4">
    <div class="container">
     <nav aria-label="breadcrumb">
         <ol class="breadcrumb">
           <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
           <li class="breadcrumb-item"><a href="{{ url()->current() }}">{{ __('front.who_we') }}</a></li>
           <li class="breadcrumb-item active">@yield('title')</li>
         </ol>
       </nav>
    </div>
</section>


<section class="members-center bg-white">
    <div class="container mt-10 mb-5 margin-top0">
        <div class="row">
            <div class="col-lg-12">
                <div class="title-page text-center d-block">
                    @yield('title')
                </div>
                @php
                    $description = "description_".appLangKey();
                @endphp
                <p class="desc">{{ $setting->$description }}</p>
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            
            @foreach ($writers as $writer)
                <div class="modal fade" id="EMP-{{$writer->id}}" tabindex="-1" aria-labelledby="EMP-{{$writer->id}}Title"  aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered max-w-100">
                    <div class="modal-content">
                        <div class="modal-header height45">
                        
                            <a href="#" data-bs-dismiss="modal" aria-label="Close">
                                <img src="/front/assets/img/close.png" class="close" alt="close">
                            </a>
                        </div>
                        <div class="modal-body text-center modal-body-padding">
                            <div class="img-box"><img src="{{ $writer->img }}" alt="{{ $writer->translation->name }}"></div>
                            <p class="name">{{ $writer->translation->name }}</p>
                            @if(!empty($writer->email))
                                <a href="mailto:{{ $writer->email }}">{{ $writer->email }} <img src="/front/assets/img/mail.png" alt=""></a>
                            @endif
                            <div>{!! $writer->translation->description !!}</div>
                            @if (!empty($writer->cv_link))
                                <a href="{{ $writer->cv_link }}" class="btn btn-info text-white">{{ __('front.to_go_to_resume') }}</a>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-4 mt-4 text-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#EMP-{{$writer->id}}">
                <div class="img-box"><img src="{{ $writer->img }}" alt="{{ $writer->translation->name }}"></div>
                    <div class="desc-member">
                        <small>
                            <strong>{{ $writer->translation->name }}</strong>
                        </small>
                        <p>{{ $writer->translation->job_title }}</p>
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