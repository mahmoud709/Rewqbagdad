<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Activity;
use App\Models\ActivityTranslation;
use App\Models\Activitycategory;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:activity_show')->only('json','index');
        // $this->middleware('authadmin:activity_create')->only('create','store');
        // $this->middleware('authadmin:activity_edit')->only('edit', 'update');
        // $this->middleware('authadmin:activity_delete')->only('destroy');
                      
        $this->middleware('permission:read-activites')->only('json','index');
        $this->middleware('permission:create-activites')->only('create','store');
        $this->middleware('permission:edit-activites')->only('edit', 'update');
        $this->middleware('permission:delete-activites')->only('destroy');

    }

    public function json()
    {
        $query = Activity::with('translation:title,activity_id','category:name,category_id')->get();
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
        return view('admin.activity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Activitycategory::with('translation:name,category_id')->get();
        return view('admin.activity.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id'     => 'required|integer|exists:activitycategories,id',
            'slug'   => 'required|string|max:100|unique:activities',
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'url'       => 'nullable|url|max:255',

            'tags' => 'nullable|array',
            'created_at'  => 'required|date',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new Activity;
        $row->category_id = $request->category_id;
        $row->slug = $request->slug;
        $row->url = $request->url;
        $row->img = $request->img;
        $row->news_img = $request->news_img;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new ActivityTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->content = $request->content[$key];
            $trans->description = $request->description[$key];
            $trans->activity_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

            if($key== env('NEWSLETTERS', 'ar') ):
                $slug = url('activity/'.$request->slug);
                SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            endif;

        endforeach;
        return redirect('/admin/activities')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $row = Activity::where('id',$activity->id)->with('translation','translations')->first();
        $cats = Activitycategory::with('translation:name,category_id')->get();
        return view('admin.activity.edit', compact('row','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $validatedData = $request->validate([
            'category_id'     => 'required|integer|exists:activitycategories,id',
            'slug'   => 'required|string|max:100|unique:activities,slug,'.$activity->id,
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'created_at'  => 'required|date',
            'url'       => 'nullable|url|max:255',

            'tags' => 'nullable|array',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        Activity::where('id',$activity->id)->update([
            'category_id' => $request->category_id,
            'slug'      => $request->slug,
            'url'      => $request->url,
            'img'           => $request->img,
            'news_img'           => $request->news_img,
            'created_at'    => $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            ActivityTranslation::where(['activity_id'=>$activity->id,'locale'=>$key])
            ->update([
                'title' => $request->title[$key],
                'content' => $request->content[$key],
                'description' => $request->description[$key],
                'tags' => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect('/admin/activities')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
