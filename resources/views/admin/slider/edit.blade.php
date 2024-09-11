@extends('layout.admin.app')
@section('title', __('global.edit').': '.$row->translation->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/slider') }}">{{ __('global.slider.title') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')

<button class="btn btn-secondary mb-3" data-toggle="modal" data-target="#exampleModal">
    {{ __('global.slider.add_new_news') }}
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('global.slider.add_new_news') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>{{ __('global.version.news') }}</label>
                        <select name="" class="form-control ver">
                            @foreach ($versions as $ver)
                                <option value="{{$ver->id}}">{{$ver->id}}-{{$ver->translation->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div style="opacity:0">
                            <label>{{ __('global.slider.add_news') }}</label>
                        </div>
                        <span class="btn btn-primary btn-add" data-class="ver" data-slug="/version">{{ __('global.slider.add_news') }}</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>{{ __('global.activity.news') }}</label>
                        <select name="" class="form-control act">
                            @foreach ($activitys as $act)
                                <option value="{{$act->id}}">{{$act->id}}-{{$act->translation->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div style="opacity:0">
                            <label>{{ __('global.slider.add_news') }}</label>
                        </div>
                        <span class="btn btn-primary btn-add" data-class="act" data-slug="/activity">{{ __('global.slider.add_news') }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>{{ __('global.media.title') }} {{ __('global.media.news.title') }}</label>
                        <select name="" class="form-control med">
                            @foreach ($medianews as $med)
                                <option value="{{$med->id}}">{{$med->id}}-{{$med->translation->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div style="opacity:0">
                            <label>{{ __('global.slider.add_news') }}</label>
                        </div>
                        <span class="btn btn-primary btn-add" data-class="med" data-slug="/media/center/news">{{ __('global.slider.add_news') }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>{{ __('global.rewaq.book.title') }}</label>
                        <select name="" class="form-control rew">
                            @foreach ($rewaqbooks as $rew)
                                <option value="{{$rew->id}}">{{$rew->id}}-{{$rew->translation->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div style="opacity:0">
                            <label>{{ __('global.slider.add_news') }}</label>
                        </div>
                        <span class="btn btn-primary btn-add" data-class="rew" data-slug="/rewaq/book">{{ __('global.slider.add_news') }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>{{ __('global.magazine.title') }} {{ __('global.magazine.blog.title') }}</label>
                        <select name="" class="form-control mag">
                            @foreach ($magazineblogs as $mag)
                                <option value="{{$mag->id}}">{{$mag->id}}-{{$mag->translation->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div style="opacity:0">
                            <label>{{ __('global.slider.add_news') }}</label>
                        </div>
                        <span class="btn btn-primary btn-add" data-class="mag" data-slug="/magazine/blog">{{ __('global.slider.add_news') }}</span>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-8">
                        <label>{{ __('global.iraqmeter.title') }}</label>
                        <select name="" class="form-control ira">
                            @foreach ($iraqmeters as $ira)
                                <option value="{{$ira->id}}">{{$ira->id}}-{{$ira->translation->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <div style="opacity:0">
                            <label>{{ __('global.slider.add_news') }}</label>
                        </div>
                        <span class="btn btn-primary btn-add" data-class="ira" data-slug="/iraq/meter">{{ __('global.slider.add_news') }}</span>
                    </div>
                </div>
                

            </div>
            <div class="modal-footer">
                <button class="btn btn-danger Close-model" data-dismiss="modal">{{__('global.close')}}</button>
            </div>
        </div>
    </div>
</div>

<form action="{{ url('/admin/slider/'.$row->id) }}" method="post">@csrf {{ method_field('PUT') }}
    <div class="row">
        
        <div class="col-md-2 mb-3">
            <label>{{ __('global.sort') }} <strong class="text-danger">*</strong></label>
            <input type="number" min="1" class="form-control" value="{{old('sort', $row->sort)}}" name="sort" required />
        </div>

        <div class="col-md-6 mb-3">
            <label>{{ __('global.slider.btn_url') }} <strong class="text-danger">*</strong></label>
            <input type="text" dir="ltr" class="form-control url" value="{{old('btn_url', $row->btn_url)}}" name="btn_url" required />
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.slider.btn_target') }} <strong class="text-danger">*</strong></label>
            <select name="btn_target" class="form-control" >
                <option @if($row->btn_target=='_self') selected @endif value="_self">{{__('global.slider.self')}}</option>
                <option @if($row->btn_target=='_blank') selected @endif value="_blank">{{__('global.slider.blank')}}</option>
            </select>
        </div>

        <div class="col-md-5 mb-3">
            <label>{{ __('global.slider.img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" required dir="ltr" class="form-control text-left img" type="text" name="img" value="{{ old('img',$row->img) }}" />
            </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img',$row->img)))
                    <img src="{{ old('img',$row->img) }}" style="height: 5rem;">
                @endif
            </div>
        </div>

        

        <div class="col-12">
            <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <ul class="nav panel-tabs">
                            @foreach($row->translations as $val)
                                <li>
                                    <a href="#tab-{{$val->locale}}" class="{{ ($val->locale==appLangKey())? 'active' : '' }}" data-toggle="tab">
                                        {{ LangNative($val->locale) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">

                        @foreach($row->translations as $val)
                            <div class="tab-pane {{ ($val->locale==appLangKey())? 'active' : '' }}" id="tab-{{$val->locale}}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.slider.name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control title_{{$val->locale}}" name="title[{{$val->locale}}]" required value="{{ old("title")[$val->locale] ?? $val->title }}" />
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label>{{ __('global.slider.btn_name') }} ({{ LangNative($val->locale) }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($val->locale)}}" required type="text" class="form-control btnname_{{$val->locale}}" name="btn_name[{{$val->locale}}]" required value="{{ old("btn_name")[$val->locale] ?? $val->btn_name }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-12 text-center mt-3">
            <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-info">{{ __('global.btn_update') }}</button>
        </div>
    </div>{{-- End Row --}}
</form>
@endsection

@section('script')
    <script>
        $(document).on('click','.btn-add', function() {
            var slug = $(this).data('slug');
            var clas = $(this).data('class');
            var id = $('.'+clas).val();
            var that = $(this);
            $.ajax({
                type: 'post',
                url: "{{ url('admin/slider/getdata') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    model: clas,
                    id: id,
                },
                beforeSend: function() {
                    that.html(`<i class="fas fa-sync fa-spin"></i>`);
                },
            }).done(function(res) {
                if(res.status=="success"){
                    $('.img').val(res.img);
                    $('#holder').html(`<img src="`+res.img+`" style="height: 5rem;">`);
                    $('.title_ar').val(res.title_ar);
                    $('.title_en').val(res.title_en);
                    $('.url').val(slug+'/'+res.slug);
                    $('.btnname_ar').val("اقرأ المزيد");
                    $('.btnname_en').val("Read More");
                    that.html(`{{ __('global.slider.add_news') }}`);
                    $('.Close-model').trigger('click');
                }
            });

        });
    </script>
@endsection

