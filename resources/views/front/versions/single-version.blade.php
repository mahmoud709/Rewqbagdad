@extends('layout.front.app')
@section('title', $row->translation->title)

@section('description', $row->translation->description)
@section('page_img', $row->news_img)

@section('content')

<section class="breadcrumb  mt-4 p-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ langUrl() }}">{{__('front.home')}}</a></li>
          <li class="breadcrumb-item"><a href="{{ langUrl('/versions') }}">{{__('front.versions')}}</a></li>
          <li class="breadcrumb-item active">{{ $row->category->name }}</li>
        </ol>
      </nav>
</section>


<section class="activies-sec mb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blog_detaisl_area">
                    <h4 class="text-center p-2 pb-4 fw-bolder">@yield('title')</h4>
                    <div class="blog_full_content">
                    <img class="box" data-src="{{ $row->news_img }}" data-srcset="{{ $row->news_img }} 2x" alt="I'm an image!" src="{{ $row->news_img }}" srcset="{{ $row->news_img }} 2x">
                        <small>
                            <i class="fas fa-calendar"></i>
                            {{ formatDate($row->created_at) }}
                        </small>
                    </div>
                    <div>{!! $row->translation->content !!}</div>   
                </div>
                <br>
                <hr>
                <div class="text d-flex justify-content-between mt-3">
                    <a class="get-writer" data-id="{{$row->writer_id}}" data-bs-toggle="modal" data-bs-target="#MEM" href="#" class="d-flex">
                        <figure class="admin-thumb">
                            <img class="border-0" width="27" height="27" src="{{ $row->writermain->img }}" alt="{{ $row->writer->name }}">
                            <h4 class="fs-5 pe-2 paddung-image-name">{{ $row->writer->name }}</h4>
                        </figure>
                        
                    </a>
                    <a href="{{ $row->pdf }}">
                        <figure class="admin-thumb"> {{__('front.view_full_article')}}
                            <img class="border-0 border-radius0 object-fit0" src="/front/assets/img/a.png" alt="LogoImage">
                        </figure>
                    </a>
                    
                </div>
                <ul class="releated mt-3">
                    @if (!empty($row->translation->tags))
                        @php
                            $tags = explode(',', $row->translation->tags);
                        @endphp
                        @foreach ($tags as $tag)
                            <li>
                                <a href="{{ langUrl('/version/tag/'.$tag) }}">
                                    {{$tag}}
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            
            <div class="col-lg-1">
            </div>
            
            <div class="col-lg-3">
               
                <div class="card">
                    <img src="{{ $row->writermain->img }}" alt="{{ $row->writer->name }}" class="img-top">
                    <br>
                    <div class="card-body">
                        <h4>{{ $row->writer->name }}</h4>
                        <p>{!! $row->writer->description !!}</p>
                    </div>
                </div>
                  <div class="widget_raper mt-3">
                      <p>{{__('front.other_author_articles')}}</p>

                      <div class="recent_post">
                        @if($writerArticles->isEmpty())
                            <h2>{{ __('front.author_no_content') }}</h2>
                        @else
                            @foreach ($writerArticles as $writerArticle)
                                <a href="{{ langUrl('/version/'.$writerArticle->slug) }}" class="single_recent_post">
                                    <span class="rp_img" style="background-image: url({{ $writerArticle->img }});"></span>
                                    <span>{{formatDate($writerArticle->created_at)}}</span>
                                    <h4>{{$writerArticle->translation->title}}</h4>
                                </a>
                                <hr>
                            @endforeach
                        @endif

                    </div>

                  </div>
                  <div class="widget_raper mt-3">
                    <p>{{ __('front.related_topics') }}</p>

                    <div class="recent_post">
                        @foreach ($related_topics as $topic)
                            <a href="{{ langUrl('/version/'.$topic->slug) }}" class="single_recent_post">
                                <span class="rp_img" style="background-image: url({{ $topic->img }});"></span>
                                <span>{{formatDate($topic->created_at)}}</span>
                                <h4>{{$topic->translation->title}}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>

                </div>
                  <div class="widget_raper bg-light p-2 mt-3">
                    <p>{{__('front.recent')}} {{ $row->category->name }}</p>

                    <div class="recent_post">
                        @foreach ($mostRecent as $most)
                            <a href="{{ langUrl('/version/'.$most->slug) }}" class="single_recent_post">
                                <h4>{{ $most->translation->title }}</h4>
                            </a>
                            <hr>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="MEM" tabindex="-1" aria-labelledby="MEMTitle"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered max-w-100">
    <div class="modal-content">
        <div class="modal-header modal-header2 height45">
        
            <a href="#" data-bs-dismiss="modal" aria-label="Close">
                <img src="/front/assets/img/close.png" class="close close-modal2" alt="close">
            </a>
        </div>
        <div class="modal-body text-center"></div>
    </div>
    </div>
</div>

@endsection


@section('js')
<script>
    $('.get-writer').on('click', function() {
        var id = $(this).data('id');
        $.ajax({
            url: '/get/writer/version',
            type: 'post',
            data: {
                _token: "{{ csrf_token() }}",
                id:id,
            },
            beforeSend: function() {
                $('.modal-body').html('<i class="fas fa-3x fa-circle-notch fa-spin"></i>')
            },
        }).done(function(res) {

            $('.modal-body').html(`
                <div class="img-box">
                    <img src="`+res.img+`" class="img-model2" alt="00">
                </div>
                <p class="name name-model2">`+res.translation.name+`</p>
                <a class="mailto mailto-model2" href="mailto:`+res.email+`">`+res.email+` <img class="mailto-img-model2" src="/front/assets/img/mail.png" alt=""></a>
                <div class="des des-model2">`+res.translation.description+`</div>
            `);

            if(res.cv_link != null){
                $('.modal-body').append(`
                    <a href="`+res.cv_link+`" class="btn btn-info text-white">{{ __('front.to_go_to_resume') }}</a>
                `);
            }

        });

    });
</script>
@endsection