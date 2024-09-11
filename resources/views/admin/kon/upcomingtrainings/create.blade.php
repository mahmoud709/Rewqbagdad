@extends('layout.admin.app')
@section('title', __('global.kone_media.upcomingtraining_add'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('kon-upcomingtrainings.index') }}">{{ __('global.kone_media.upcomingtrainings') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ route('kon-upcomingtrainings.store') }}" method="post">
    @csrf
    <div class="row">

        <div class="col-md-6 mb-3">
            <label>{{ __('global.magazine.blog.img') }} <strong class="text-danger">*</strong></label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="img1" data-input="thumimg1" data-preview="holderimg1" class="btn btn-primary text-white">
                    <i class="fas fa-image"></i> {{ __('global.choose') }}
                </a>
                </span>
                <input id="thumimg1" required dir="ltr" class="form-control" type="text" name="photo" value="{{ old('photo') }}" />
            </div>
            <div id="holderimg1" style="margin-top:15px;max-height:100px;">
                <img src="{{ old('photo') }}" style="height: 5rem;">
            </div>
        </div>
        

        <div class="col-md-6 mb-3">
            <label>{{ __('global.slug') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">{{url('magazine/blog')}}/</span>
                </div>
                <input type="text" class="form-control" value="{{old('slug', time())}}" name="slug" id="basic-url" required />
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ __('global.kone_media.price') }} <strong class="text-danger">*</strong></label>
            <div class="input-group mb-3" dir="ltr">
          
                <input type="text" class="form-control" value="{{old('price')}}" name="price" id="basic-url" required />
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <label>{{ __('global.kone_media.training_appointment') }} <strong class="text-danger">*</strong></label>
            <input required type="datetime-local" class="form-control" name="training_appointment" required value="{{ old("training_appointment") ?? date('Y-m-d') }}" />
        </div>
        
        <div class="col-12">
            <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                <div class="tab-menu-heading">
                    <div class="tabs-menu ">
                        <ul class="nav panel-tabs">
                            @foreach(SupportedLangs() as $localeCode => $properties)
                                <li>
                                    <a href="#tab-{{$localeCode}}" class="{{ ($localeCode==appLangKey())? 'active' : '' }}" data-toggle="tab">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="panel-body tabs-menu-body">
                    <div class="tab-content">

                        @foreach(SupportedLangs() as $localeCode => $properties)
                            <div class="tab-pane {{ ($localeCode==appLangKey())? 'active' : '' }}" id="tab-{{$localeCode}}">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.name') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <input dir="{{langDir($localeCode)}}" required type="text" class="form-control" name="title[{{$localeCode}}]" required value="{{ old("title")[$localeCode] ?? '' }}" />
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label>{{ __('global.magazine.blog.description') }} ({{ $properties['native'] }}) <strong class="text-danger">*</strong></label>
                                        <textarea dir="{{langDir($localeCode)}}" required name="description[{{$localeCode}}]" class="form-control" rows="5">{{ old("description")[$localeCode] ?? '' }}</textarea>
                                    </div>

                                    
                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.kone_media.trainer_info') }}  ({{ LangNative($localeCode) }}) </label>
                                        <textarea name="trainer_info[{{$localeCode}}]" class="form-control my-editor" rows="5">{!! old('trainer_info')[$localeCode] ?? '' !!}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>{{ __('global.content') }}  ({{ LangNative($localeCode) }}) </label>
                                        <textarea name="content[{{$localeCode}}]" class="form-control my-editor" rows="5">{!! old('content')[$localeCode] ?? '' !!}</textarea>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
        
        <div class="col-12 text-center mt-3">
            <button onclick="if(confirm(`{{__('global.alert_create')}}`)){return true;}else{return false;}" class="btn btn-primary">{{ __('global.btn_create') }}</button>
        </div>
    </div>{{-- End Row --}}
</form>
@endsection

@section('style')
    <link rel="stylesheet" href="{{url('admin/tagify.css')}}">
@endsection

@section('script')
{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}

<script>
    function getElementAfterDelay() {
    setTimeout(() => {
        $('.tox-notifications-container').css('display', 'none');
    }, 6000); 
    }
    window.onload = getElementAfterDelay;
</script>

{{-- <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'code table lists',
      license_key: 'your_free_license_key'
    });
  </script>
   --}}
  
{{-- <script src="{{ url('/admin/editor/config.js') }}"></script> --}}
<script src="{{url('admin/tagify.min.js')}}"></script>
<script>
    tagify = new Tagify(document.querySelector('.tag_ar'));
    tagify2 = new Tagify(document.querySelector('.tag_en'));
</script>
@endsection

