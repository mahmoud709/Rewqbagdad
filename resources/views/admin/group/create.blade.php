@extends('layout.admin.app')
@section('title', __('global.group_create'))

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/groups') }}">{{__('global.groups')}}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection


@section('content')
<form action="{{ url('admin/groups') }}" method="post">@csrf
        
    <div class="row">
        <div class="col-md-6">
            <label>{{__('global.group_name')}} <strong class="text-danger">*</strong></label>
            <input type="text" class="form-control" required name="name" value="{{ old('name') }}" />
            <br />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <input type="checkbox" id="checkall" class="ml-1" />
            <label for="checkall">{{ __('global.select_all') }}</label>
        </div>
    </div>

            
    <div class="row">
        <div class="col-12">

            <div class="table-responsive">
                <table class="table table-bordered text-md-nowrap table-hover">
                    <thead>
                        <tr class="thead-dark">
                            <th style="font-size:14px">{{ __('global.page_name') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-eye"></i> {{ __('global.show') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-plus"></i> {{ __('global.create') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-edit"></i> {{ __('global.edit') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-trash-alt"></i>  {{ __('global.delete') }}</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td scope="row">{{__('global.dashboard')}}</td>
                            <td><input type="checkbox" name="home_show" value="on" @if( old('home_show') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.admins')}}</td>
                            <td><input type="checkbox" name="admin_show" value="on" @if( old('admin_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="admin_create" value="on" @if( old('admin_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="admin_edit" value="on" @if( old('admin_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="admin_delete" value="on" @if( old('admin_delete') ) checked @endif /></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.groups')}}</td>
                            <td><input type="checkbox" name="group_show" value="on" @if( old('group_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="group_create" value="on" @if( old('group_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="group_edit" value="on" @if( old('group_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="group_delete" value="on" @if( old('group_delete') ) checked @endif /></td>
                        </tr>
        

                        <tr>
                            <td scope="row">{{__('global.settings')}}</td>
                            <td><input type="checkbox" name="setting_show" value="on" @if( old('setting_show') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="setting_edit" value="on" @if( old('setting_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.admin_data')}}</td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="profile_edit" value="on" @if( old('profile_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.filemanager')}}</td>
                            <td><input type="checkbox" name="filemanager_show" value="on" @if( old('filemanager_show') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        {{-- |||||||||||||||||||||||||||||||||||| --}}
                        
                        <tr>
                            <td scope="row">{{__('global.about.aside_title')}}</td>
                            <td><input type="checkbox" name="about_show" value="on" @if( old('about_show') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.center_member.title')}}</td>
                            <td><input type="checkbox" name="centerteam_show" value="on" @if( old('centerteam_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="centerteam_create" value="on" @if( old('centerteam_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="centerteam_edit" value="on" @if( old('centerteam_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="centerteam_delete" value="on" @if( old('centerteam_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.book_team.title')}}</td>
                            <td><input type="checkbox" name="bookteam_show" value="on" @if( old('bookteam_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="bookteam_create" value="on" @if( old('bookteam_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="bookteam_edit" value="on" @if( old('bookteam_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="bookteam_delete" value="on" @if( old('bookteam_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.version.categories')}}</td>
                            <td><input type="checkbox" name="versioncategory_show" value="on" @if( old('versioncategory_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="versioncategory_create" value="on" @if( old('versioncategory_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="versioncategory_edit" value="on" @if( old('versioncategory_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="versioncategory_delete" value="on" @if( old('versioncategory_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.version.title')}}</td>
                            <td><input type="checkbox" name="version_show" value="on" @if( old('version_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="version_create" value="on" @if( old('version_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="version_edit" value="on" @if( old('version_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="version_delete" value="on" @if( old('version_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.activity.categories')}}</td>
                            <td><input type="checkbox" name="activitycategory_show" value="on" @if( old('activitycategory_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="activitycategory_create" value="on" @if( old('activitycategory_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="activitycategory_edit" value="on" @if( old('activitycategory_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="activitycategory_delete" value="on" @if( old('activitycategory_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.activity.title')}}</td>
                            <td><input type="checkbox" name="activity_show" value="on" @if( old('activity_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="activity_create" value="on" @if( old('activity_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="activity_edit" value="on" @if( old('activity_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="activity_delete" value="on" @if( old('activity_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.news.title')}}</td>
                            <td><input type="checkbox" name="medianews_show" value="on" @if( old('medianews_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="medianews_create" value="on" @if( old('medianews_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="medianews_edit" value="on" @if( old('medianews_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="medianews_delete" value="on" @if( old('medianews_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.photo.title')}}</td>
                            <td><input type="checkbox" name="mediaphoto_show" value="on" @if( old('mediaphoto_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediaphoto_create" value="on" @if( old('mediaphoto_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediaphoto_edit" value="on" @if( old('mediaphoto_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediaphoto_delete" value="on" @if( old('mediaphoto_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.video.categories')}}</td>
                            <td><input type="checkbox" name="mediavideocategory_show" value="on" @if( old('mediavideocategory_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideocategory_create" value="on" @if( old('mediavideocategory_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideocategory_edit" value="on" @if( old('mediavideocategory_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideocategory_delete" value="on" @if( old('mediavideocategory_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.video.title')}}</td>
                            <td><input type="checkbox" name="mediavideo_show" value="on" @if( old('mediavideo_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideo_create" value="on" @if( old('mediavideo_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideo_edit" value="on" @if( old('mediavideo_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideo_delete" value="on" @if( old('mediavideo_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.electronic.title')}}</td>
                            <td><input type="checkbox" name="electronic_show" value="on" @if( old('electronic_show') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="electronic_edit" value="on" @if( old('electronic_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.newsletter.title')}}</td>
                            <td><input type="checkbox" name="newsletter_show" value="on" @if( old('newsletter_show') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="newsletter_delete" value="on" @if( old('newsletter_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.rewaq.team.title')}}</td>
                            <td><input type="checkbox" name="rewaqteam_show" value="on" @if( old('rewaqteam_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqteam_create" value="on" @if( old('rewaqteam_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqteam_edit" value="on" @if( old('rewaqteam_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqteam_delete" value="on" @if( old('rewaqteam_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.rewaq.book.title')}}</td>
                            <td><input type="checkbox" name="rewaqbook_show" value="on" @if( old('rewaqbook_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqbook_create" value="on" @if( old('rewaqbook_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqbook_edit" value="on" @if( old('rewaqbook_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqbook_delete" value="on" @if( old('rewaqbook_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.rewaq.title')}} {{__('global.rewaq.publish_rule')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="rewaqpublishrule_edit" value="on" @if( old('rewaqpublishrule_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        <tr>
                            <td scope="row">{{__('global.rewaq.rewaq_edit')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="rewaq_edit" value="on" @if( old('rewaq_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.magazine.team.title')}}</td>
                            <td><input type="checkbox" name="magazineteam_show" value="on" @if( old('magazineteam_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineteam_create" value="on" @if( old('magazineteam_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineteam_edit" value="on" @if( old('magazineteam_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineteam_delete" value="on" @if( old('magazineteam_delete') ) checked @endif /></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.magazine.title')}} {{__('global.magazine.blog.title')}}</td>
                            <td><input type="checkbox" name="magazineblog_show" value="on" @if( old('magazineblog_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineblog_create" value="on" @if( old('magazineblog_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineblog_edit" value="on" @if( old('magazineblog_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineblog_delete" value="on" @if( old('magazineblog_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.magazine.title')}} {{__('global.magazine.publish_rule')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="magazinerules_edit" value="on" @if( old('magazinerules_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.magazine.magazine_edit')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="magazine_edit" value="on" @if( old('magazine_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        {{-- مجلة الخطاب --}}
                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.team.title')}}</td>
                            <td><input type="checkbox" name="khetab_magazineteam_show" value="on" @if( old('khetab_magazineteam_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineteam_create" value="on" @if( old('khetab_magazineteam_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineteam_edit" value="on" @if( old('khetab_magazineteam_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineteam_delete" value="on" @if( old('khetab_magazineteam_delete') ) checked @endif /></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.title')}} {{__('global.khetab_magazine.blog.title')}}</td>
                            <td><input type="checkbox" name="khetab_magazineblog_show" value="on" @if( old('khetab_magazineblog_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineblog_create" value="on" @if( old('khetab_magazineblog_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineblog_edit" value="on" @if( old('khetab_magazineblog_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineblog_delete" value="on" @if( old('khetab_magazineblog_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.title')}} {{__('global.khetab_magazine.publish_rule')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="khetab_magazinerules_edit" value="on" @if( old('khetab_magazinerules_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.magazine_edit')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="khetab_magazine_edit" value="on" @if( old('khetab_magazine_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        
                        <tr>
                            <td scope="row">{{__('global.parliament.title')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="parliament_edit" value="on" @if( old('parliament_edit') ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.parliament.title')}} {{__('global.parliament.video.title')}}</td>
                            <td><input type="checkbox" name="parliamentvideo_show" value="on" @if( old('parliamentvideo_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="parliamentvideo_create" value="on" @if( old('parliamentvideo_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="parliamentvideo_edit" value="on" @if( old('parliamentvideo_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="parliamentvideo_delete" value="on" @if( old('parliamentvideo_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.iraqmeter.title')}}</td>
                            <td><input type="checkbox" name="iraqmeter_show" value="on" @if( old('iraqmeter_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="iraqmeter_create" value="on" @if( old('iraqmeter_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="iraqmeter_edit" value="on" @if( old('iraqmeter_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="iraqmeter_delete" value="on" @if( old('iraqmeter_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.event.title')}}</td>
                            <td><input type="checkbox" name="events_show" value="on" @if( old('events_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="events_create" value="on" @if( old('events_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="events_edit" value="on" @if( old('events_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="events_delete" value="on" @if( old('events_delete') ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.slider.title')}}</td>
                            <td><input type="checkbox" name="slider_show" value="on" @if( old('slider_show') ) checked @endif /></td>
                            <td><input type="checkbox" name="slider_create" value="on" @if( old('slider_create') ) checked @endif /></td>
                            <td><input type="checkbox" name="slider_edit" value="on" @if( old('slider_edit') ) checked @endif /></td>
                            <td><input type="checkbox" name="slider_delete" value="on" @if( old('slider_delete') ) checked @endif /></td>
                        </tr>


                    </tbody>

                    <tfoot>
                        <tr class="thead-dark">
                            <th style="font-size:14px">{{ __('global.page_name') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-eye"></i> {{ __('global.show') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-plus"></i> {{ __('global.create') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-edit"></i> {{ __('global.edit') }}</th>
                            <th style="font-size:14px"><i class="fas fa-fw fa-trash-alt"></i>  {{ __('global.delete') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div> {{-- End Col-12 --}}
    </div>{{-- End Row --}}

    <div class="row">
        <div class="col-12 mt-2">
            <button class="btn btn-info">{{ __('global.btn_save') }}</button>
        </div>
    </div>

</form>
@endsection

@section('script')
<script>        
    $('#checkall').on('change', function() {

        if( $(this).is(":checked") )
        {
            $('input[type=checkbox]').prop('checked', true);
        }
        else {
            $('input[type=checkbox]').prop('checked', false);
        }            
    });
</script>

@endsection

@section('style')
    <style>
        input[type=checkbox], input[type=radio] {
            transform: scale(1.3);
        }
    </style>
@endsection