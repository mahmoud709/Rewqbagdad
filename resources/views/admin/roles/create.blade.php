@extends('layout.admin.app')
@section('title', __('global.role_create'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/roles') }}">{{ __('global.roles') }}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('content')
    <form action="{{ route('roles.store') }}" method="post">@csrf
        @include('admin.roles.form')
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">{{ __('global.show') }}</span>');
        });
        $(document).on('click', '.pass_show .ptxt', function() {
            $(this).text($(this).text() == "{{ __('global.show') }}" ? "{{ __('global.hide') }}" :
                "{{ __('global.show') }}");
            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });
        });
        $('#admin-logo').filemanager('file');
    </script>
@endsection
