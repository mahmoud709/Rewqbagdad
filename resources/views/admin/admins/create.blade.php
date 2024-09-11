@extends('layout.admin.app')
@section('title', __('global.add_admin'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/admins') }}">{{ __('global.admins') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ url('/admin/admins') }}" method="post">@csrf
    <div class="row">
        <div class="col-xl-6">
            
            <label>{{ __('global.admin_name') }} <strong class="text-danger">*</strong></label>
            <input type="text" class="form-control" name="name" required="required" value="{{ old('name') }}" />
            <br />

            <label>{{ __('global.email') }} <strong class="text-danger">*</strong></label>
            <input type="email" class="form-control" name="email" required="required" value="{{ old('email') }}" style="text-align: left;" />
            <br />

            <label>{{ __('global.password') }} <strong class="text-danger">*</strong></label>
            <div class="form-group pass_show"> 
                <input type="password" class="form-control" required="required" name="password" /> 
            </div>
            <br />

            <label>{{ __('global.groups') }}  <strong class="text-danger">*</strong></label>
            <select class="form-control" name="role_id" required="required">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
            <br />

        </div>

        <div class="col-xl-6">

            <label>{{ __('global.admin_info') }}</label>
            <textarea class="form-control" rows="5" name="info">{{ str_replace('<br />', '', old('info')) }}</textarea>
            <br />

            <label><i class="fas fa-fw fa-image"></i> {{ __('global.admin_img') }} </label>
            <div class="input-group">
                <span class="input-group-btn">
                    <a id="admin-logo" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                        <i class="fas fa-image"></i> {{ __('global.choose') }}
                    </a>
                </span>
                <input id="thumbnail" readonly="readonly" dir="ltr" class="form-control text-left" type="text" name="img" value="{{ old('img') }}" />
             </div>
            <div id="holder" style="margin-top:15px;max-height:100px;">
                @if(!empty(old('img')))
                    <img src="{{ old('img') }}" style="height: 5rem;">
                @endif
            </div>
            <br />

        </div>

        <div class="col-12 text-center">
            <button onclick="if(confirm(`{{__('global.alert_create')}}`)){return true;}else{return false;}" class="btn btn-primary">{{ __('global.btn_create') }}</button>
        </div>
    </div>{{-- End Row --}}
</form>
@endsection

@section('script')
<script>
    // $(document).ready(function(){
    //     $('.pass_show').append('<span class="ptxt">{{__('global.show')}}</span>');  
    // });
    // $(document).on('click','.pass_show .ptxt', function(){ 
    //     $(this).text($(this).text() == "{{__('global.show')}}" ? "{{__('global.hide')}}" : "{{__('global.show')}}"); 
    //     $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
    // });
    $('#admin-logo').filemanager('file');
</script>
@endsection