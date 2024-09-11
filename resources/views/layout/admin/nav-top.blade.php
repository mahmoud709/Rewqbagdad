@php
    $admin = auth('admin')->user();   
@endphp
<div class="main-header sticky side-header nav nav-item">
    <div class="container-fluid">
        <div class="main-header-left">
            <div class="app-sidebar__toggle" data-toggle="sidebar">
                <a class="open-toggle" href="#"><i class="header-icon fe fe-align-left" ></i></a>
                <a class="close-toggle" href="#"><i class="header-icons fe fe-x"></i></a>
            </div>
            <div class="main-header-center @if(appLangKey()=='ar') mr-3 @else ml-3 @endif d-sm-none d-md-none d-lg-block">
                <h6 class="mb-0">
                    {{-- <a href="{{url('/')}}" target="_blank">{{$SiteData->name}}</a> --}}
                    <div id="time"></div>
                </h6>
            </div>
        </div>
        <div class="main-header-right">
            <ul class="nav">
                <li class="">
                    <div class="dropdown nav-itemd-none d-md-flex">
                        <a href="#" class="d-flex nav-item nav-link pl-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
                            <span class="avatar country-Flag mr-0 align-self-center bg-transparent">
                                <img src="{{url('/admin')}}/assets/img/flags/{{appLangKey()}}.jpg" alt="img">
                            </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" class="dropdown-item d-flex ">
                                    <span class="avatar @if(appLangKey()=='ar') ml-3 @else mr-3 @endif align-self-center bg-transparent">
                                        <img src="{{url('/admin')}}/assets/img/flags/{{$localeCode}}.jpg" alt="img">
                                    </span>
                                    <div class="d-flex">
                                        <span class="mt-2">{{ $properties['native'] }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </li>
            </ul>
            <div class="nav nav-item  navbar-nav-right ml-auto">
                
                <div class="dropdown main-profile-menu nav nav-item nav-link">
                    <a class="profile-user d-flex" href=""><img alt="" src="{{$admin->img}}"></a>
                    <div class="dropdown-menu">
                        <div class="main-header-profile bg-primary p-3">
                            <div class="d-flex wd-100p">
                                <div class="main-img-user"><img alt="" src="{{$admin->img}}" class=""></div>
                                <div class="@if(appLangKey()=='ar') mr-3 @else ml-3 @endif my-auto">
                                    <h6>{{$admin->name}}</h6>
                                </div>
                            </div>
                        </div>
                        <a class="dropdown-item" href="{{url('admin/profile')}}"><i class="fa-regular fa-fw fa-user"></i> {{__('global.my_account')}}</a>
                        <a class="dropdown-item" href="{{url('/admin/settings')}}"><i class="fa-solid fa-fw fa-gear"></i> {{__('global.settings')}}</a>
                        <a class="dropdown-item" href="{{url('/admin/logout')}}"><i class="fa-solid fa-fw fa-right-from-bracket"></i> {{__('global.logout')}}</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>