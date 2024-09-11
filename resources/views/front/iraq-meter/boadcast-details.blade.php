@extends('layout.front.app')
@section('title', 'boadcast details')

@section('content')

<section class="parlmente-sec boadcast blue mb-5 h-auto">
        <div class="container">
            <div class="row">
              
                <div class="col-lg-12">
                    <div class="img-box text-center">
                        <img src="{{url('front')}}/assets/img/Fakkerlogo.png" alt="aboutImage">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="section-title text-center pb-1 mb-1">
                        <h2 class="title text-center m-auto">بــودكــاست فــكــر </h2>
                    </div>
                    <p class="text-center shadow-none">
                        للأستماع الى البودكاست يمكنكم زيارة الروابط التالية :-
                    </p>
                    <ul class="listen-boadcast">
                        <li>
                            على منصة <a href="https://www.apple.com/apple-podcasts/">ApplePodcast</a>
                        </li>
                        <li>
                            على منصة <a href="https://www.apple.com/apple-podcasts/">ApplePodcast</a>
                        </li>
                        <li>
                            على منصة <a href="https://www.apple.com/apple-podcasts/">ApplePodcast</a>
                        </li>
                        <li>
                            على منصة <a href="https://www.apple.com/apple-podcasts/">ApplePodcast</a>
                        </li>
                    </ul>
                    <br>
                    <p class="text-center shadow-none">
                        ويمكنكم مشاهدة  بودكاست فكر في قناتنا  على اليوتوب :-
                    </p>
                    <ul class="listen-boadcast">
                        <li>
                            قناة اليوتوب   <a href="https://www.youtube.com/channel/UCd_Jrcqu00p6Yj12w4DtshA">بــودكــاســت فــكر</a>
                        </li>
                       
                    </ul>
                </div>
            </div>
        </div>
    </section>


   <section class="vector-about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 p-0">
                <img src="{{url('/front/assets/img/vector-bg.png')}}" alt="">
            </div>
            <div class="col-lg-6">
                <img src="{{url('/front/assets/img/micknew.png')}}" class="top-img" alt="">
                <div class="content-box">
                    <p>
                        أو يمكنكم التواصل مباشرةً معنا
                    </p>
                    <ul class="social-box">
                        <li>
                            <img src="{{url('/front/assets/img/facebook.png')}}" alt="">
                            
                             <a href="https://www.youtube.com/channel/UCd_Jrcqu00p6Yj12w4DtshA/" class="underline"> Fakker-فکّر</a>
                        </li>
                        <li>
                            <img src="{{url('/front/assets/img/insta.png')}}" alt="">
                            <a href="https://www.instagram.com/podcast_fakker/" class="underline">Fakker</a>
                        </li>
                        <li>
                            <img src="{{url('/front/assets/img/email.png')}}" alt="">
                            <a href="mailto:podcastthink82@gmail.com">podcastthink82@gmail.com</a>
                        </li>
                        <li>
                            <img src="{{url('/front/assets/img/whatsapp.png')}}" alt="">
                            +9647837803788
                        </li>
                           <li>
                            <img src="{{url('/front/assets/img/Fakkernew.png')}}" alt="">
                            <a href="https://linktr.ee/fakker.podcast" class="underline">الاستماع الى البودكاست</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
   </section>
   
@endsection

