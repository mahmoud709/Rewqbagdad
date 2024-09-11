@extends('layout.admin.app')
@section('title', __('global.alert_error_403'))

@section('breadcrumb')
    <li class="breadcrumb-item">@yield('title')</li>
@endsection

@section('style')@endsection

@section('script')@endsection

@section('content')

    <h1 class="text-center py-5">{{ __('global.alert_error_403') }}</h1>

    @empty(!$url)
        <h5 class="text-center text-danger">{{ $url }}</h5> 
    @endempty

@endsection