@extends('layout.admin.app')
@section('title', __('global.edit').': '.$group->name)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ url('/admin/groups') }}">{{__('global.groups')}}</a></li>
    <li class="breadcrumb-item">@yield('title')</li>
@endsection


@section('content')
<form action="{{ url('admin/groups/'.$group->id) }}" method="post">@csrf
    {{ method_field('PUT') }}

    <div class="row">
        <div class="col-md-6">
            <label>{{__('global.group_name')}} <strong class="text-danger">*</strong></label>
            <input type="text" class="form-control" required name="name" value="{{ $group->name }}" />
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
                            <td><input type="checkbox" name="home_show" value="on" @if( $group->home_show=='on') checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.admins')}}</td>
                            <td><input type="checkbox" name="admin_show" value="on" @if( $group->admin_show=='on') checked @endif /></td>
                            <td><input type="checkbox" name="admin_create" value="on" @if( $group->admin_create=='on') checked @endif /></td>
                            <td><input type="checkbox" name="admin_edit" value="on" @if( $group->admin_edit=='on') checked @endif /></td>
                            <td><input type="checkbox" name="admin_delete" value="on" @if( $group->admin_delete=='on') checked @endif /></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.groups')}}</td>
                            <td><input type="checkbox" name="group_show" value="on" @if( $group->group_show=='on') checked @endif /></td>
                            <td><input type="checkbox" name="group_create" value="on" @if( $group->group_create=='on') checked @endif /></td>
                            <td><input type="checkbox" name="group_edit" value="on" @if( $group->group_edit=='on') checked @endif /></td>
                            <td><input type="checkbox" name="group_delete" value="on" @if( $group->group_delete=='on') checked @endif /></td>
                        </tr>
        

                        <tr>
                            <td scope="row">{{__('global.settings')}}</td>
                            <td><input type="checkbox" name="setting_show" value="on" @if( $group->setting_show=='on') checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="setting_edit" value="on" @if( $group->setting_edit=='on') checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.admin_data')}}</td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="profile_edit" value="on" @if( $group->profile_edit=='on') checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.filemanager')}}</td>
                            <td><input type="checkbox" name="filemanager_show" value="on" @if( $group->filemanager_show=='on') checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.about.aside_title')}}</td>
                            <td><input type="checkbox" name="about_show" value="on" @if( $group->about_show=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.center_member.title')}}</td>
                            <td><input type="checkbox" name="centerteam_show" value="on" @if( $group->centerteam_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="centerteam_create" value="on" @if( $group->centerteam_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="centerteam_edit" value="on" @if( $group->centerteam_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="centerteam_delete" value="on" @if( $group->centerteam_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.book_team.title')}}</td>
                            <td><input type="checkbox" name="bookteam_show" value="on" @if( $group->bookteam_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="bookteam_create" value="on" @if( $group->bookteam_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="bookteam_edit" value="on" @if( $group->bookteam_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="bookteam_delete" value="on" @if( $group->bookteam_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.version.categories')}}</td>
                            <td><input type="checkbox" name="versioncategory_show" value="on" @if( $group->versioncategory_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="versioncategory_create" value="on" @if( $group->versioncategory_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="versioncategory_edit" value="on" @if( $group->versioncategory_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="versioncategory_delete" value="on" @if( $group->versioncategory_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.version.title')}}</td>
                            <td><input type="checkbox" name="version_show" value="on" @if( $group->version_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="version_create" value="on" @if( $group->version_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="version_edit" value="on" @if( $group->version_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="version_delete" value="on" @if( $group->version_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.activity.categories')}}</td>
                            <td><input type="checkbox" name="activitycategory_show" value="on" @if( $group->activitycategory_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="activitycategory_create" value="on" @if( $group->activitycategory_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="activitycategory_edit" value="on" @if( $group->activitycategory_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="activitycategory_delete" value="on" @if( $group->activitycategory_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.activity.title')}}</td>
                            <td><input type="checkbox" name="activity_show" value="on" @if( $group->activity_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="activity_create" value="on" @if( $group->activity_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="activity_edit" value="on" @if( $group->activity_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="activity_delete" value="on" @if( $group->activity_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.news.title')}}</td>
                            <td><input type="checkbox" name="medianews_show" value="on" @if( $group->medianews_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="medianews_create" value="on" @if( $group->medianews_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="medianews_edit" value="on" @if( $group->medianews_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="medianews_delete" value="on" @if( $group->medianews_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.photo.title')}}</td>
                            <td><input type="checkbox" name="mediaphoto_show" value="on" @if( $group->mediaphoto_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediaphoto_create" value="on" @if( $group->mediaphoto_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediaphoto_edit" value="on" @if( $group->mediaphoto_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediaphoto_delete" value="on" @if( $group->mediaphoto_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.video.categories')}}</td>
                            <td><input type="checkbox" name="mediavideocategory_show" value="on" @if( $group->mediavideocategory_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideocategory_create" value="on" @if( $group->mediavideocategory_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideocategory_edit" value="on" @if( $group->mediavideocategory_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideocategory_delete" value="on" @if( $group->mediavideocategory_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.media.title')}} {{__('global.media.video.title')}}</td>
                            <td><input type="checkbox" name="mediavideo_show" value="on" @if( $group->mediavideo_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideo_create" value="on" @if( $group->mediavideo_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideo_edit" value="on" @if( $group->mediavideo_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="mediavideo_delete" value="on" @if( $group->mediavideo_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.electronic.title')}}</td>
                            <td><input type="checkbox" name="electronic_show" value="on" @if( $group->electronic_show=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="electronic_edit" value="on" @if( $group->electronic_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.newsletter.title')}}</td>
                            <td><input type="checkbox" name="newsletter_show" value="on" @if( $group->newsletter_show=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="newsletter_delete" value="on" @if( $group->newsletter_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.rewaq.team.title')}}</td>
                            <td><input type="checkbox" name="rewaqteam_show" value="on" @if( $group->rewaqteam_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqteam_create" value="on" @if( $group->rewaqteam_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqteam_edit" value="on" @if( $group->rewaqteam_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqteam_delete" value="on" @if( $group->rewaqteam_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.rewaq.book.title')}}</td>
                            <td><input type="checkbox" name="rewaqbook_show" value="on" @if( $group->rewaqbook_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqbook_create" value="on" @if( $group->rewaqbook_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqbook_edit" value="on" @if( $group->rewaqbook_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="rewaqbook_delete" value="on" @if( $group->rewaqbook_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.rewaq.title')}} {{__('global.rewaq.publish_rule')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="rewaqpublishrule_edit" value="on" @if( $group->rewaqpublishrule_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        <tr>
                            <td scope="row">{{__('global.rewaq.rewaq_edit')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="rewaq_edit" value="on" @if( $group->rewaq_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>


                        <tr>
                            <td scope="row">{{__('global.magazine.team.title')}}</td>
                            <td><input type="checkbox" name="magazineteam_show" value="on" @if( $group->magazineteam_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineteam_create" value="on" @if( $group->magazineteam_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineteam_edit" value="on" @if( $group->magazineteam_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineteam_delete" value="on" @if( $group->magazineteam_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.magazine.title')}} {{__('global.magazine.blog.title')}}</td>
                            <td><input type="checkbox" name="magazineblog_show" value="on" @if( $group->magazineblog_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineblog_create" value="on" @if( $group->magazineblog_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineblog_edit" value="on" @if( $group->magazineblog_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="magazineblog_delete" value="on" @if( $group->magazineblog_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.magazine.title')}} {{__('global.magazine.publish_rule')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="magazinerules_edit" value="on" @if( $group->magazinerules_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.magazine.magazine_edit')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="magazine_edit" value="on" @if( $group->magazine_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                         {{-- مجلة الخطاب --}}

                         
                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.team.title')}}</td>
                            <td><input type="checkbox" name="khetab_magazineteam_show" value="on" @if( $group->khetab_magazineteam_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineteam_create" value="on" @if( $group->khetab_magazineteam_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineteam_edit" value="on" @if( $group->khetab_magazineteam_edit=='on' ) checked @endif/></td>
                            <td><input type="checkbox" name="khetab_magazineteam_delete" value="on"@if( $group->khetab_magazineteam_delete=='on' ) checked @endif /></td>
                        </tr>


                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.title')}} {{__('global.khetab_magazine.blog.title')}}</td>
                            <td><input type="checkbox" name="khetab_magazineblog_show" value="on" @if( $group->khetab_magazineblog_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineblog_create" value="on" @if( $group->khetab_magazineblog_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineblog_edit" value="on" @if( $group->khetab_magazineblog_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="khetab_magazineblog_delete" value="on" @if( $group->khetab_magazineblog_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.title')}} {{__('global.khetab_magazine.publish_rule')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="khetab_magazinerules_edit" value="on" @if( $group->khetab_magazinerules_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.khetab_magazine.khetab_magazine_edit')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="khetab_magazine_edit" value="on" @if( $group->khetab_magazine_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        
                        <tr>
                            <td scope="row">{{__('global.parliament.title')}}</td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                            <td><input type="checkbox" name="parliament_edit" value="on" @if( $group->parliament_edit=='on' ) checked @endif /></td>
                            <td><i class="fa-fw far fa-star"></i></td>
                        </tr>

                        <tr>
                            <td scope="row">{{__('global.parliament.title')}} {{__('global.parliament.video.title')}}</td>
                            <td><input type="checkbox" name="parliamentvideo_show" value="on" @if( $group->parliamentvideo_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="parliamentvideo_create" value="on" @if( $group->parliamentvideo_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="parliamentvideo_edit" value="on" @if( $group->parliamentvideo_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="parliamentvideo_delete" value="on" @if( $group->parliamentvideo_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.iraqmeter.title')}}</td>
                            <td><input type="checkbox" name="iraqmeter_show" value="on" @if( $group->iraqmeter_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="iraqmeter_create" value="on" @if( $group->iraqmeter_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="iraqmeter_edit" value="on" @if( $group->iraqmeter_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="iraqmeter_delete" value="on" @if( $group->iraqmeter_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.event.title')}}</td>
                            <td><input type="checkbox" name="events_show" value="on" @if( $group->events_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="events_create" value="on" @if( $group->events_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="events_edit" value="on" @if( $group->events_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="events_delete" value="on" @if( $group->events_delete=='on' ) checked @endif /></td>
                        </tr>
                        
                        <tr>
                            <td scope="row">{{__('global.slider.title')}}</td>
                            <td><input type="checkbox" name="slider_show" value="on" @if( $group->slider_show=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="slider_create" value="on" @if( $group->slider_create=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="slider_edit" value="on" @if( $group->slider_edit=='on' ) checked @endif /></td>
                            <td><input type="checkbox" name="slider_delete" value="on" @if( $group->slider_delete=='on' ) checked @endif /></td>
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
            {{-- <input type="hidden" name="id" value="{{$group->id}}"> --}}
            <button onclick="if(confirm(`{{__('global.alert_update')}}`)){return true;}else{return false;}" class="btn btn-info">{{__('global.btn_update')}}</button>
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