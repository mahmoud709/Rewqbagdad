@php
    $admin = auth('admin')->user();
    // $group = $admin->group;
@endphp
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">

    <div class="main-sidemenu">
        <div class="app-sidebar__user clearfix">
            <div class="dropdown user-pro-body">
                <div class="">
                    <img alt="user-img" class="avatar avatar-xl brround" src="{{ $admin->img ?? '' }}">
                    <span class="avatar-status profile-status bg-green"></span>
                </div>
                <div class="user-info">
                    <h4 class="font-weight-semibold mt-3 mb-0">{{ $admin->name }}</h4>
                </div>
            </div>
        </div>

        <ul class="side-menu" style="overflow: auto;height: 82vh;">


            <li class="slide">
                <a class="side-menu__item" href="{{ url('/admin/home') }}">
                    <i class="fa-solid fa-house-chimney"></i>
                    <span class="side-menu__label">{{ __('global.dashboard') }}</span>
                    {{-- <span class="badge badge-success side-badge">1</span> --}}
                </a>
            </li>

            @if ($admin->hasPermission('read-roles') || $admin->hasPermission('create-roles') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-user-gear"></i>
                        <span class="side-menu__label">{{ __('global.roles') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('read-roles') || $admin->is_superadmin)
                            <li><a class="slide-item" href="{{ url('admin/roles') }}">{{ __('global.roles') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('create-roles') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url('admin/roles/create') }}">{{ __('global.role_create') }}</a></li>
                        @endif


                    </ul>
                </li>

            @endif
            @if ($admin->hasPermission('read-admins') || $admin->hasPermission('create-admins') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-user-gear"></i>
                        <span class="side-menu__label">{{ __('global.admins') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('read-admins') || $admin->is_superadmin)
                            <li><a class="slide-item" href="{{ url('admin/admins') }}">{{ __('global.admins') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('create-admins') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url('admin/admins/create') }}">{{ __('global.admin_create') }}</a></li>
                        @endif


                    </ul>
                </li>

            @endif


            @if (
                $admin->hasPermission('read-about') ||
                    $admin->hasPermission('read-bookTeam') ||
                    $admin->hasPermission('read-centerTeam') ||
                    $admin->hasPermission('read-faqs') ||
                    $admin->hasPermission('read-Mahawirs') ||
                    $admin->hasPermission('read-headofcenter') ||
                    $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-regular fa-circle-question"></i>
                        <span class="side-menu__label">{{ __('global.about.aside_title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('read-about') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/about') }}">{{ __('global.about.title') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-centerTeam') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/center-team') }}">{{ __('global.center_member.title') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-headofcenter') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/word-headofcenter') }}">{{ __('global.Head_of_the_center') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-Mahawirs') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/mahawirs') }}">{{ __('global.mahwiers') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-bookTeam') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/book-team') }}">{{ __('global.book_team.title') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-faqs') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/faq') }}">{{ __('global.faq_title') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            @if ($admin->hasPermission('read-versionCategory') || $admin->hasPermission('edit-Medadinfo') || $admin->hasPermission('read-versionNews') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-certificate"></i>
                        <span class="side-menu__label">{{ __('global.version.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('edit-Medadinfo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('medad.editInfo') }}">{{ __('global.medadedit_info') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-versionCategory') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/version-categories') }}">{{ __('global.version.categories') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-versionNews') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/versions') }}">{{ __('global.version.news') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif
            @if ($admin->hasPermission('read-activites') || $admin->hasPermission('read-activitesCategory') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-regular fa-file"></i>
                        <span class="side-menu__label">{{ __('global.activity.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('read-activitesCategory') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/activity-categories') }}">{{ __('global.activity.categories') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-activites') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/activities') }}">{{ __('global.activity.news') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if ($admin->hasPermission('read-etmamNews') || $admin->hasPermission('edit-Etmaminfo') || $admin->hasPermission('read-etmamCategory') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-regular fa-file"></i>
                        <span class="side-menu__label">{{ __('global.etmam') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('edit-Etmaminfo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('etmam.editInfo') }}">{{ __('global.etmamedit_info') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-etmamCategory') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/etmam-categories') }}">{{ __('global.etmam_category') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-etmamNews') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/etmam-news') }}">{{ __('global.etmam_news') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (
                $admin->hasPermission('read-mediaNews') ||
                    $admin->hasPermission('read-libraryPhoto') ||
                    $admin->hasPermission('read-libraryVideo') ||
                    $admin->hasPermission('read-categoryLibraryPhoto') ||
                    $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-share-nodes"></i>
                        <span class="side-menu__label">{{ __('global.media.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">
                        @if ($admin->hasPermission('read-mediaNews') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/media-news') }}">{{ __('global.media.news.title') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-libraryPhoto') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/media-photos') }}">{{ __('global.media.photo.title') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-libraryVideo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/media-videos-categories') }}">{{ __('global.media.video.categories') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-categoryLibraryPhoto') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/media-videos') }}">{{ __('global.media.video.title') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif
            @if (
                $admin->hasPermission('edit-rewaq') ||
                    $admin->hasPermission('read-rewaqTeam') ||
                    $admin->hasPermission('read-rewaqPublishRule') ||
                    $admin->hasPermission('read-RewaqBooks') ||
                    $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-brands fa-slack"></i>
                        <span class="side-menu__label">{{ __('global.rewaq.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        @if ($admin->hasPermission('edit-rewaq') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/rewaq') }}">{{ __('global.rewaq.rewaq_edit') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-rewaqTeam') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/rewaq-team') }}">{{ __('global.rewaq.team.title') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-rewaqVideo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/rewaq-videos') }}">{{ __('global.rewaq_videos') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-rewaqPublishRule') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/rewaq/publish/rule') }}">{{ __('global.rewaq.publish_rule') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-RewaqBooks') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/rewaq-books') }}">{{ __('global.rewaq.book.title') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>
            @endif

            @if (
                $admin->hasPermission('edit-MagazineInfo') ||
                    $admin->hasPermission('read-RewaMagazineTeam') ||
                    $admin->hasPermission('read-rewaqMagazineRules') ||
                    $admin->hasPermission('read-magazineblog') ||
                    $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="side-menu__label">{{ __('global.magazine.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        @if ($admin->hasPermission('read-RewaMagazineTeam') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/magazine-team') }}">{{ __('global.magazine.team.title') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('edit-MagazineInfo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/magazine') }}">{{ __('global.magazine.magazine_edit') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('edit-rewaqMagazineRules') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/magazine/publish/rule') }}">{{ __('global.magazine.publish_rule') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-magazineblog') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/magazine-blog') }}">{{ __('global.magazine.blog.title') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>

            @endif
            @if (
                $admin->hasPermission('read-iraqMeter') ||
                    $admin->hasPermission('edit-iraqMeterInfo') ||
                    $admin->hasPermission('read-iraqmeterSurvey') ||
                    $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="side-menu__label">{{ __('global.iraqmeter.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        {{-- @if ($admin->hasPermission('read-iraqMeter') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/iraq-meter') }}">{{ __('global.iraqmeter.title') }}</a>
                            </li>
                        @endif --}}
                        @if ($admin->hasPermission('read-iraqmeterSurvey') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('iraqmeter-surveys.index') }}">{{ __('global.iraqmeter.surveys') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('edit-iraqMeterInfo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('iraqmeter.editInfo') }}">{{ __('global.iraqmeter.edit') }}</a>
                            </li>
                        @endif


                    </ul>
                </li>

            @endif
            @if ($admin->hasPermission('read-konMedia') || $admin->hasPermission('edit-konInfo') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="side-menu__label">{{ __('global.kone_media.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        @if ($admin->hasPermission('edit-konInfo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('kon.editInfo') }}">{{ __('global.kone_media.edit') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-konTraining') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('kon-trainings.index') }}">{{ __('global.kone_media.training') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-Upcomingtraining') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('kon-upcomingtrainings.index') }}">{{ __('global.kone_media.upcomingtrainings') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-konVideo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('kon-videos.index') }}">{{ __('global.kone_media.kon_videos') }}</a>
                            </li>
                        @endif


                        {{-- @if ($admin->hasPermission('edit-konMedia') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/kon-news') }}">{{ __('global.kone_media.title') }}</a>
                            </li>
                        @endif --}}


                    </ul>
                </li>

            @endif
            @if ($admin->hasPermission('read-Bodcast') || 
            $admin->hasPermission('edit-bodcastBlog') || 
            $admin->hasPermission('read-bodcastBlog') || 
            $admin->is_superadmin
            )
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="side-menu__label">{{ __('global.bodcast.title') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        @if ($admin->hasPermission('read-Bodcast') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('bodcasts-fakar.index') }}">{{ __('global.bodcast.our_episodes') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-afakar') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('afkar-fakar.index') }}">{{ __('global.bodcast.afkar') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-bodcastBlog') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('bodcast-blog.index') }}">{{ __('global.bodcast.our_blogs') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('edit-bodcastInfo') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ route('bodcast.editInfo') }}">{{ __('global.bodcast.edit_info') }}</a>
                            </li>
                        @endif

                    </ul>
                </li>

            @endif

            @if (
                $admin->hasPermission('edit-khetabmagazineedit') ||
                    $admin->hasPermission('read-khetabmagazinemteam') ||
                    $admin->hasPermission('read-khetabmagazinerulesedit') ||
                    $admin->hasPermission('read-magazineblog') ||
                    $admin->hasPermission('edit-MEJEELPMagazine') ||
                    $admin->hasPermission('read-MEJEELPTeam') ||
                    $admin->hasPermission('edit-MEJEELPMagazinerule') ||
                    $admin->hasPermission('read-MEJEELPBlog') ||
                    $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" data-toggle="slide" href="#">
                        <i class="fa-solid fa-layer-group"></i>
                        <span class="side-menu__label">{{ __('global.Special_editions') }}</span><i
                            class="angle fe fe-chevron-down"></i></a>
                    <ul class="slide-menu">

                        @if ($admin->hasPermission('read-khetabmagazinemteam') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/khetab-magazine-team') }}">{{ __('global.khetab_magazine.team.title') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('edit-khetabmagazineedit') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/khetab-magazine') }}">{{ __('global.khetab_magazine.magazine_edit') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('edit-khetabmagazinerulesedit') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/khetab-magazine/publish/rule') }}">{{ __('global.khetab_magazine.publish_rule') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-magazineblog') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/khetab-magazine-blog') }}">{{ __('global.khetab_magazine.blog.title') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-MEJEELPTeam') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/MEJEELP-magazine-team') }}">{{ __('global.MEJEELP_magazine.team.title') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-MEJEELPMagazine') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/MEJEELP-magazine') }}">{{ __('global.MEJEELP_magazine.magazine_edit') }}</a>
                            </li>
                        @endif

                        @if ($admin->hasPermission('read-MEJEELPMagazinerule') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/MEJEELP-magazine/publish/rule') }}">{{ __('global.MEJEELP_magazine.publish_rule') }}</a>
                            </li>
                        @endif
                        @if ($admin->hasPermission('read-MEJEELPBlog') || $admin->is_superadmin)
                            <li><a class="slide-item"
                                    href="{{ url(appLangKey() . '/admin/MEJEELP-magazine-blog') }}">{{ __('global.MEJEELP_magazine.blog.title') }}</a>
                            </li>
                        @endif
                    </ul>
                </li>
            @endif

            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#">
                    <i class="fa-solid fa-mobile-screen-button"></i>
                    <span class="side-menu__label">{{ __('global.parliament.title') }}</span><i
                        class="angle fe fe-chevron-down"></i></a>
                <ul class="slide-menu">


                    <li><a class="slide-item"
                            href="{{ url(appLangKey() . '/admin/parliament') }}">{{ __('global.parliament.title') }}</a>
                    </li>

                    <li><a class="slide-item"
                            href="{{ url(appLangKey() . '/admin/parliament-videos') }}">{{ __('global.parliament.video.title') }}</a>
                    </li>

                </ul>
            </li>


            @if ($admin->hasPermission('read-events') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" href="{{ url(appLangKey() . '/admin/events') }}">
                        <i class="fa-regular fa-calendar-days"></i>
                        <span class="side-menu__label">{{ __('global.event.title') }}</span>
                    </a>
                </li>
            @endif




            @if ($admin->hasPermission('read-slider') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" href="{{ url(appLangKey() . '/admin/slider') }}">
                        <i class="fa-solid fa-sliders"></i>
                        <span class="side-menu__label">{{ __('global.slider.title') }}</span>
                    </a>
                </li>
            @endif
            @if ($admin->hasPermission('read-electronicsService') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" href="{{ url(appLangKey() . '/admin/electronic-services') }}">
                        <i class="fa-solid fa-list-ul"></i>
                        <span class="side-menu__label">{{ __('global.electronic.title') }}</span>
                    </a>
                </li>
            @endif
            @if ($admin->hasPermission('read-newsLetter') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" href="{{ url(appLangKey() . '/admin/newsletters') }}">
                        <i class="fa-regular fa-paper-plane"></i>
                        <span class="side-menu__label">{{ __('global.newsletter.title') }}</span>
                    </a>
                </li>
            @endif
            @if ($admin->hasPermission('read-backup') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" href="{{ url(appLangKey() . '/admin/backup') }}">
                        <i class="fa-solid fa-database"></i>
                        <span class="side-menu__label">{{ __('global.backup') }}</span>
                    </a>
                </li>
            @endif
            @if ($admin->hasPermission('read-setting') || $admin->is_superadmin)
                <li class="slide">
                    <a class="side-menu__item" href="{{ url('/admin/settings') }}">
                        <i class="fa-solid fa-gear"></i>
                        <span class="side-menu__label">{{ __('global.settings') }}</span>
                    </a>
                </li>
            @endif

            <li class="slide">
                <a class="side-menu__item" href="{{ url('/admin/logout') }}">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span class="side-menu__label">{{ __('global.logout') }}</span>
                </a>
            </li>
            <br /><br />

        </ul>
    </div>
</aside>
<!-- main-sidebar -->
