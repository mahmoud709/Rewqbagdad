@extends('layout.admin.app')
@section('title', __('global.role_edit'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}">{{ __('global.roles') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
<form action="{{ route('roles.update', $role->id) }}" method="post">@csrf {{ method_field('PUT') }}
    @include('admin.roles.form')
</form>
@endsection

@section('script')
<script>
    $(document).ready(function(){
        $('.pass_show').append('<span class="ptxt">{{__('global.show')}}</span>');  
    });
    $(document).on('click','.pass_show .ptxt', function(){ 
        $(this).text($(this).text() == "{{__('global.show')}}" ? "{{__('global.hide')}}" : "{{__('global.show')}}"); 
        $(this).prev().attr('type', function(index, attr){return attr == 'password' ? 'text' : 'password'; }); 
    });
    $('#admin-logo').filemanager('file');
</script>
<script>
    $(document).ready(function(){
        $('.checkAll').click(function () {
            var selector = $(this).attr('data-selector');
            checkbox = $('.' + selector);
            checkbox.prop('checked', $(this).prop('checked'));
            console.log(checkbox);
        });
        $('.checkAllItemm').click(function () {
            var selector = $(this).attr('data-selector');
            console.log($(this));
            checkbox = $('[type=checkbox]');
            checkbox.prop('checked', $(this).prop('checked'));
        })
    });
</script>
@endsection