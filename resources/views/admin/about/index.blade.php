@extends('layout.admin.app')
@section('title', __('global.about.title'))

@section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('style')
	
@endsection


@section('content')

    <form action="{{url()->current()}}" method="post">@csrf

        <div class="row">

            <div class="col-md-6 mb-3">
                <label>{{ __('global.about.img1') }} <strong class="text-danger">*</strong></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="img1" data-input="thumimg1" data-preview="holderimg1" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                    </span>
                    <input id="thumimg1" readonly dir="ltr" class="form-control" type="text" name="img1" value="{{ $row->img1 }}" />
                </div>
                <div id="holderimg1" style="margin-top:15px;max-height:100px;">
                    <img src="{{ $row->img1 }}" style="height: 5rem;">
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label>{{ __('global.about.img2') }} <strong class="text-danger">*</strong></label>
                <div class="input-group">
                    <span class="input-group-btn">
                        <a id="img1" data-input="thumimg2" data-preview="holderimg2" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                    </span>
                    <input id="thumimg2" readonly dir="ltr" class="form-control" type="text" name="img2" value="{{ $row->img2 }}" />
                </div>
                <div id="holderimg2" style="margin-top:15px;max-height:100px;">
                    <img src="{{ $row->img2 }}" style="height: 5rem;">
                </div>
            </div>


            {{-- |||||||||||||| --}}
            <div class="col-12">
                <div class="panel panel-primary tabs-style-3 p-0 pt-2">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu ">
                            <ul class="nav panel-tabs">
                                @foreach($row->translations as $val)
                                    <li>
                                        <a href="#tab-desc-{{$val->locale}}" class="{{ ($val->locale==appLangKey())? 'active' : '' }}" data-toggle="tab">
                                            {{ LangNative($val->locale) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body tabs-menu-body">
                        <div class="tab-content">
                            @foreach($row->translations as $about)
                                <div class="tab-pane {{ ($about->locale==appLangKey())? 'active' : '' }}" id="tab-desc-{{$about->locale}}">
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label>{{ __('global.about.title') }} ({{ LangNative($about->locale) }}) <strong class="text-danger">*</strong></label>
                                            <textarea dir="{{langDir($about->locale)}}" name="description[{{$about->locale}}]" class="form-control my-editor" rows="5">{!! old('description')[$about->locale] ?? $about->description !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
    
            </div>
            {{-- |||||||||||||| --}}
            
        </div>{{-- End Row --}}


        <h1 class="text-center my-3">{{ __('global.about.targets') }}</h1>
        @foreach ($row->alltargets as $targetKey => $target)
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.target_name') }} ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="target_ar[name_ar][]" required maxlength="255" class="form-control" rows="3">{{$target->name_ar ?? ""}}</textarea>
                </div>
                
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.target_name') }} ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="target_en[name_en][]" required maxlength="255" class="form-control" rows="3">{{$target->name_en ?? ""}}</textarea>
                </div>
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.target_content') }} ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="target_ar[content_ar][]" required maxlength="255" class="form-control" rows="3">{{$target->content_ar ?? ""}}</textarea>
                </div>
                
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.target_content') }} ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="target_en[content_en][]" required maxlength="255" class="form-control" rows="3">{{$target->content_en ?? ""}}</textarea>
                </div>
                @if($targetKey!=0)
                    <div class="col-md-2 mb-3">
                        <div style="opacity:0"><label>{{ __('global.delete') }}</label></div>
                        <span class="btn btn-danger del-row">{{ __('global.delete') }}</span>
                    </div>
                @endif
            </div>
        @endforeach
        <div class="targets-rows"></div>
        <div class="row">
            <div class="col-md-12">
                <span class="btn btn-primary add-row1" data-row="targets-rows" data-title="{{ __('global.about.target_name') }}" data-name="target" >{{ __('global.about.addrow') }}</span>
            </div>
        </div>{{-- End Row --}}


        <h1 class="text-center my-3">{{ __('global.about.vision') }}</h1>
 
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.vision_name') }} ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="vision_ar" required maxlength="255" class="form-control" rows="3">{{ $row->allvisions[0]->content_ar ?? "" }}</textarea>
                </div>
                
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.vision_name') }} ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="vision_en" required maxlength="255" class="form-control" rows="3">{{ $row->allvisions[0]->content_en ?? "" }}</textarea>
                </div>
            </div>
        <h1 class="text-center my-3">{{ __('global.about.our_message') }}</h1>
 
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.name_message') }} ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="message_ar" required maxlength="255" class="form-control" rows="3">{{ $row->ourMessage[0]->content_ar ?? "" }}</textarea>
                </div>
                
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.name_message') }} ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="message_en" required maxlength="255" class="form-control" rows="3">{{ $row->ourMessage[0]->content_en ?? "" }}</textarea>
                </div>
            </div>
        
        <h1 class="text-center my-3">{{ __('global.about.means') }}</h1>
        @foreach ($row->allmeans as $meansKey => $mean)
            <div class="row">
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.means_name') }} ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="means_ar[]" required maxlength="255" class="form-control" rows="3">{{$mean->content_ar}}</textarea>
                </div>
                
                <div class="col-md-5 mb-3">
                    <label>{{ __('global.about.means_name') }} ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                    <textarea name="means_en[]" required maxlength="255" class="form-control" rows="3">{{$mean->content_en}}</textarea>
                </div>
                @if($meansKey!=0)
                    <div class="col-md-2 mb-3">
                        <div style="opacity:0"><label>{{ __('global.delete') }}</label></div>
                        <span class="btn btn-danger del-row">{{ __('global.delete') }}</span>
                    </div>
                @endif
            </div>
        @endforeach
        <div class="means-rows"></div>
        <div class="row">
            <div class="col-md-12">
                <span data-row="means-rows" data-title="{{ __('global.about.means_name') }}" data-name="means" class="btn btn-primary add-row">{{ __('global.about.addrow') }}</span>
            </div>
        </div>{{-- End Row --}}
        
        
        <div class="col-12 text-center mt-3">
            <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-info">{{ __('global.btn_update') }}</button>
        </div>
        <div class="tox-notifications-container"></div>
    </form>

@endsection


@section('script')

<script>

    $('.add-row').on('click', function() {
        var row = $(this).data('row');
        var name = $(this).data('name');
        var title = $(this).data('title');
        $('.'+row).append(`
        <div class="row">
            <div class="col-md-5 mb-3">
                <label>`+title+` ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                <textarea name="`+name+`_ar[]" required maxlength="255" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="col-md-5 mb-3">
                <label>`+title+` ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                <textarea name="`+name+`_en[]" required maxlength="255" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-2 mb-3">
                <div style="opacity:0"><label>{{ __('global.delete') }}</label></div>
                <span class="btn btn-danger del-row">{{ __('global.delete') }}</span>
            </div>
        </div>
        `);
    });
    $('.add-row1').on('click', function() {
        var row = $(this).data('row');
        var name = $(this).data('name');
        var title = $(this).data('title');
        $('.'+row).append(`
        <div class="row">
            <div class="col-md-5 mb-3">
                <label>`+title+` ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                <textarea name="`+name+`_ar[name_ar][]" required maxlength="255" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="col-md-5 mb-3">
                <label>`+title+` ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                <textarea name="`+name+`_en[name_en][]" required maxlength="255" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-2 mb-3">
                <div style="opacity:0"><label>{{ __('global.delete') }}</label></div>
                <span class="btn btn-danger del-row">{{ __('global.delete') }}</span>
            </div>
            <div class="col-md-5 mb-3">
              <label>{{ __('global.about.target_content') }} ({{ LangNative('ar') }}) <strong class="text-danger">*</strong></label>
                <textarea name="`+name+`_ar[content_ar][]" required maxlength="255" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="col-md-5 mb-3">
                <label>{{ __('global.about.target_content') }} ({{ LangNative('en') }}) <strong class="text-danger">*</strong></label>
                <textarea name="`+name+`_en[content_en][]" required maxlength="255" class="form-control" rows="3"></textarea>
            </div>
        </div>
        `);
    });


    $(document).on('click','.del-row', function() {
        if(confirm("{{ __('global.about.alert_del_row') }}")){
            $(this).parent().parent().remove();
        }
    });
</script>

{{-- <script src="https://cdn.tiny.cloud/1/otxtjzn8hxfaiakhhweykeu54br83y2fv3wicdf7cekpllxi/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ url('/admin/editor/config.js') }}"></script> --}}
@endsection