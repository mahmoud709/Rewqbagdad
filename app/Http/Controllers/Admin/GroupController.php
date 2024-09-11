<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('authadmin:group_show')->only('json','index');
        $this->middleware('authadmin:group_create')->only('create','store');
        $this->middleware('authadmin:group_edit')->only('edit', 'update');
        $this->middleware('authadmin:group_delete')->only('destroy');
    }

    public function json()
    {
        $query = Group::select('id','name','main','created_at')->get();
        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.group.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreGroupRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:groups',
        ]);

        $group = new Group();
        $group->name = $request->name;

        $group->admin_show              = $request->admin_show;
        $group->admin_create            = $request->admin_create;
        $group->admin_edit              = $request->admin_edit;
        $group->admin_delete            = $request->admin_delete;
        $group->group_show              = $request->group_show;
        $group->group_create            = $request->group_create;
        $group->group_edit              = $request->group_edit;
        $group->group_delete            = $request->group_delete;
        $group->home_show               = $request->home_show;
        $group->setting_show            = $request->setting_show;
        $group->setting_edit            = $request->setting_edit;
        $group->profile_edit            = $request->profile_edit;
        $group->filemanager_show        = $request->filemanager_show;



        $group->about_show         = $request->about_show;
        $group->centerteam_show        = $request->centerteam_show;
        $group->centerteam_create      = $request->centerteam_create;
        $group->centerteam_edit        = $request->centerteam_edit;
        $group->centerteam_delete      = $request->centerteam_delete;
        $group->bookteam_show      = $request->bookteam_show;
        $group->bookteam_create        = $request->bookteam_create;
        $group->bookteam_edit      = $request->bookteam_edit;
        $group->bookteam_delete        = $request->bookteam_delete;
        $group->versioncategory_show       = $request->versioncategory_show;
        $group->versioncategory_create         = $request->versioncategory_create;
        $group->versioncategory_edit       = $request->versioncategory_edit;
        $group->versioncategory_delete         = $request->versioncategory_delete;
        $group->version_show       = $request->version_show;
        $group->version_create         = $request->version_create;
        $group->version_edit       = $request->version_edit;
        $group->version_delete         = $request->version_delete;
        $group->activitycategory_show      = $request->activitycategory_show;
        $group->activitycategory_create        = $request->activitycategory_create;
        $group->activitycategory_edit      = $request->activitycategory_edit;
        $group->activitycategory_delete        = $request->activitycategory_delete;
        $group->activity_show      = $request->activity_show;
        $group->activity_create        = $request->activity_create;
        $group->activity_edit      = $request->activity_edit;
        $group->activity_delete        = $request->activity_delete;
        $group->medianews_show         = $request->medianews_show;
        $group->medianews_create       = $request->medianews_create;
        $group->medianews_edit         = $request->medianews_edit;
        $group->medianews_delete       = $request->medianews_delete;
        $group->mediaphoto_show        = $request->mediaphoto_show;
        $group->mediaphoto_create      = $request->mediaphoto_create;
        $group->mediaphoto_edit        = $request->mediaphoto_edit;
        $group->mediaphoto_delete      = $request->mediaphoto_delete;
        $group->mediavideocategory_show        = $request->mediavideocategory_show;
        $group->mediavideocategory_create      = $request->mediavideocategory_create;
        $group->mediavideocategory_edit        = $request->mediavideocategory_edit;
        $group->mediavideocategory_delete      = $request->mediavideocategory_delete;
        $group->mediavideo_show        = $request->mediavideo_show;
        $group->mediavideo_create      = $request->mediavideo_create;
        $group->mediavideo_edit        = $request->mediavideo_edit;
        $group->mediavideo_delete      = $request->mediavideo_delete;
        $group->electronic_show        = $request->electronic_show;
        $group->electronic_edit        = $request->electronic_edit;
        $group->newsletter_show        = $request->newsletter_show;
        $group->newsletter_delete      = $request->newsletter_delete;
        $group->rewaqteam_show         = $request->rewaqteam_show;
        $group->rewaqteam_create       = $request->rewaqteam_create;
        $group->rewaqteam_edit         = $request->rewaqteam_edit;
        $group->rewaqteam_delete       = $request->rewaqteam_delete;
        $group->rewaqbook_show         = $request->rewaqbook_show;
        $group->rewaqbook_create       = $request->rewaqbook_create;
        $group->rewaqbook_edit         = $request->rewaqbook_edit;
        $group->rewaqbook_delete       = $request->rewaqbook_delete;
        $group->rewaqpublishrule_edit      = $request->rewaqpublishrule_edit;
        $group->rewaq_edit         = $request->rewaq_edit;


        $group->magazineteam_show      = $request->magazineteam_show;
        $group->magazineteam_create        = $request->magazineteam_create;
        $group->magazineteam_edit      = $request->magazineteam_edit;
        $group->magazineteam_delete        = $request->magazineteam_delete;


        $group->khetab_magazineteam_show      = $request->khetab_magazineteam_show;
        $group->khetab_magazineteam_create        = $request->khetab_magazineteam_create;
        $group->khetab_magazineteam_edit      = $request->khetab_magazineteam_edit;
        $group->khetab_magazineteam_delete        = $request->khetab_magazineteam_delete;


        $group->magazineblog_show      = $request->magazineblog_show;
        $group->magazineblog_create        = $request->magazineblog_create;
        $group->magazineblog_edit      = $request->magazineblog_edit;
        $group->magazineblog_delete        = $request->magazineblog_delete;

        $group->khetab_magazineblog_show      = $request->khetab_magazineblog_show;
        $group->khetab_magazineblog_create        = $request->khetab_magazineblog_create;
        $group->khetab_magazineblog_edit      = $request->khetab_magazineblog_edit;
        $group->khetab_magazineblog_delete        = $request->khetab_magazineblog_delete;


        $group->parliamentvideo_show       = $request->parliamentvideo_show;
        $group->parliamentvideo_create         = $request->parliamentvideo_create;
        $group->parliamentvideo_edit       = $request->parliamentvideo_edit;
        $group->parliamentvideo_delete         = $request->parliamentvideo_delete;
        $group->iraqmeter_show         = $request->iraqmeter_show;
        $group->iraqmeter_create       = $request->iraqmeter_create;
        $group->iraqmeter_edit         = $request->iraqmeter_edit;
        $group->iraqmeter_delete       = $request->iraqmeter_delete;
        $group->events_show        = $request->events_show;
        $group->events_create      = $request->events_create;
        $group->events_edit        = $request->events_edit;
        $group->events_delete      = $request->events_delete;
        $group->slider_show        = $request->slider_show;
        $group->slider_create      = $request->slider_create;
        $group->slider_edit        = $request->slider_edit;
        $group->slider_delete      = $request->slider_delete;
        $group->parliament_edit        = $request->parliament_edit;
        $group->magazinerules_edit         = $request->magazinerules_edit;
        $group->magazine_edit      = $request->magazine_edit;

        $group->khetab_magazinerules_edit         = $request->khetab_magazinerules_edit;
        $group->khetab_magazine_edit      = $request->khetab_magazine_edit;


        $group->save();
        return redirect('/admin/groups')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {
        if($group->id==1):
            return redirect('/admin/groups')->with('error', __('global.alert_main_group'));
        endif;
        return view('admin.group.edit', compact('group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateGroupRequest  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        if($group->id==1):
            return redirect('/admin/groups')->with('error', __('global.alert_main_group'));
        endif;
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|unique:groups,id,'.$group->id,
        ]);

        Group::where('id', $group->id)->update([
            'name' => $request->name,

            'admin_show'=> $request->admin_show,
            'admin_create'=> $request->admin_create,
            'admin_edit'=> $request->admin_edit,
            'admin_delete'=> $request->admin_delete,
            'group_show'=> $request->group_show,
            'group_create'=> $request->group_create,
            'group_edit'=> $request->group_edit,
            'group_delete'=> $request->group_delete,

            'home_show' => $request->home_show,
            'setting_show'=> $request->setting_show,
            'setting_edit'=> $request->setting_edit,
            'profile_edit'=> $request->profile_edit,
            'filemanager_show'=> $request->filemanager_show,

            'about_show' => $request->about_show,
            'centerteam_show' => $request->centerteam_show,
            'centerteam_create' => $request->centerteam_create,
            'centerteam_edit' => $request->centerteam_edit,
            'centerteam_delete' => $request->centerteam_delete,
            'bookteam_show' => $request->bookteam_show,
            'bookteam_create' => $request->bookteam_create,
            'bookteam_edit' => $request->bookteam_edit,
            'bookteam_delete' => $request->bookteam_delete,
            'versioncategory_show' => $request->versioncategory_show,
            'versioncategory_create' => $request->versioncategory_create,
            'versioncategory_edit' => $request->versioncategory_edit,
            'versioncategory_delete' => $request->versioncategory_delete,
            'version_show' => $request->version_show,
            'version_create' => $request->version_create,
            'version_edit' => $request->version_edit,
            'version_delete' => $request->version_delete,
            'activitycategory_show' => $request->activitycategory_show,
            'activitycategory_create' => $request->activitycategory_create,
            'activitycategory_edit' => $request->activitycategory_edit,
            'activitycategory_delete' => $request->activitycategory_delete,
            'activity_show' => $request->activity_show,
            'activity_create' => $request->activity_create,
            'activity_edit' => $request->activity_edit,
            'activity_delete' => $request->activity_delete,
            'medianews_show' => $request->medianews_show,
            'medianews_create' => $request->medianews_create,
            'medianews_edit' => $request->medianews_edit,
            'medianews_delete' => $request->medianews_delete,
            'mediaphoto_show' => $request->mediaphoto_show,
            'mediaphoto_create' => $request->mediaphoto_create,
            'mediaphoto_edit' => $request->mediaphoto_edit,
            'mediaphoto_delete' => $request->mediaphoto_delete,
            'mediavideocategory_show' => $request->mediavideocategory_show,
            'mediavideocategory_create' => $request->mediavideocategory_create,
            'mediavideocategory_edit' => $request->mediavideocategory_edit,
            'mediavideocategory_delete' => $request->mediavideocategory_delete,
            'mediavideo_show' => $request->mediavideo_show,
            'mediavideo_create' => $request->mediavideo_create,
            'mediavideo_edit' => $request->mediavideo_edit,
            'mediavideo_delete' => $request->mediavideo_delete,
            'electronic_show' => $request->electronic_show,
            'electronic_edit' => $request->electronic_edit,
            'newsletter_show' => $request->newsletter_show,
            'newsletter_delete' => $request->newsletter_delete,
            'rewaqteam_show' => $request->rewaqteam_show,
            'rewaqteam_create' => $request->rewaqteam_create,
            'rewaqteam_edit' => $request->rewaqteam_edit,
            'rewaqteam_delete' => $request->rewaqteam_delete,
            'rewaqbook_show' => $request->rewaqbook_show,
            'rewaqbook_create' => $request->rewaqbook_create,
            'rewaqbook_edit' => $request->rewaqbook_edit,
            'rewaqbook_delete' => $request->rewaqbook_delete,
            'rewaqpublishrule_edit' => $request->rewaqpublishrule_edit,
            'rewaq_edit' => $request->rewaq_edit,
            'magazineteam_show' => $request->magazineteam_show,
            'magazineteam_create' => $request->magazineteam_create,
            'magazineteam_edit' => $request->magazineteam_edit,
            'magazineteam_delete' => $request->magazineteam_delete,
            'magazineblog_show' => $request->magazineblog_show,
            'magazineblog_create' => $request->magazineblog_create,
            'magazineblog_edit' => $request->magazineblog_edit,
            'magazineblog_delete' => $request->magazineblog_delete,
            'parliamentvideo_show' => $request->parliamentvideo_show,
            'parliamentvideo_create' => $request->parliamentvideo_create,
            'parliamentvideo_edit' => $request->parliamentvideo_edit,
            'parliamentvideo_delete' => $request->parliamentvideo_delete,
            'iraqmeter_show' => $request->iraqmeter_show,
            'iraqmeter_create' => $request->iraqmeter_create,
            'iraqmeter_edit' => $request->iraqmeter_edit,
            'iraqmeter_delete' => $request->iraqmeter_delete,
            'events_show' => $request->events_show,
            'events_create' => $request->events_create,
            'events_edit' => $request->events_edit,
            'events_delete' => $request->events_delete,
            'slider_show' => $request->slider_show,
            'slider_create' => $request->slider_create,
            'slider_edit' => $request->slider_edit,
            'slider_delete' => $request->slider_delete,
            'parliament_edit' => $request->parliament_edit,
            'magazinerules_edit' => $request->magazinerules_edit,
            'magazine_edit' => $request->magazine_edit,

            'khetab_magazineteam_show' => $request->khetab_magazineteam_show,
            'khetab_magazineteam_create' => $request->khetab_magazineteam_create,
            'khetab_magazineteam_edit' => $request->khetab_magazineteam_edit,
            'khetab_magazineteam_delete' => $request->khetab_magazineteam_delete,

            'khetab_magazineblog_show' => $request->khetab_magazineblog_show,
            'khetab_magazineblog_create' => $request->khetab_magazineblog_create,
            'khetab_magazineblog_edit' => $request->khetab_magazineblog_edit,
            'khetab_magazineblog_delete' => $request->khetab_magazineblog_delete,

            'khetab_magazinerules_edit' => $request->khetab_magazinerules_edit,
            'khetab_magazine_edit' => $request->khetab_magazine_edit,
        ]);
        return back()->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        if ( $group->id==1):
            return redirect('/admin/groups')->with('error', __('global.alert_main_group'));
        endif;
        $group->delete();
        return redirect('/admin/groups')->with('success', __('global.alert_done_delete'));
        
    }
}
