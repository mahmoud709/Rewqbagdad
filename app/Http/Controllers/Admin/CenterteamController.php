<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Teamsetting;
use App\Models\Centerteam;
use App\Models\CenterteamTranslation;
use Illuminate\Http\Request;

class CenterteamController extends Controller
{
    public function __construct()
    {

        // Old Permission
        // $this->middleware('authadmin:centerteam_show')->only('json','index','UpdateDescription');
        // $this->middleware('authadmin:centerteam_create')->only('create','store');
        // $this->middleware('authadmin:centerteam_edit')->only('edit', 'update');
        // $this->middleware('authadmin:centerteam_delete')->only('destroy');

        $this->middleware('permission:read-centerTeam')->only('json','index','UpdateDescription');
        $this->middleware('permission:update-centerTeam')->only('create','store');
        $this->middleware('permission:edit-centerTeam')->only('edit', 'update');
        $this->middleware('permission:delete-centerTeam')->only('destroy');
    }

    public function UpdateDescription(Request $request)
    {
        $validatedData = $request->validate([
            'description_ar' => 'required|string|max:900',
            'description_en' => 'required|string|max:900',
        ]);
        Teamsetting::where('slug','center-team')->update([
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);
        return back()->with('success', __('global.alert_done_update'));
    }

    public function json()
    {
        $query = Centerteam::select('id','email','created_at')->with('translation:name,job_title,centerteam_id')->get();
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
        $teamSetting = Teamsetting::where('slug','center-team')->first();
        return view('admin.about.center-team.index', compact('teamSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.center-team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCenterteamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email'     => 'required|email|string|max:50',
            'cv_link'   => 'nullable|string|max:255',
            'img'       => 'required|string|max:255',
            'job_title' => 'required|in:cbd,ceo,mem,emp',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:900',
        ]);
        
        $row = new Centerteam;
        $row->email = $request->email;
        $row->cv_link = $request->cv_link;
        $row->img = $request->img;
        $row->type = $request->job_title;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new CenterteamTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->job_title = __('global.center_member.jobs_titles')[$key][$request->job_title];
            $trans->description = nl2br($request->description[$key]);
            $trans->centerteam_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/center-team')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Centerteam  $centerteam
     * @return \Illuminate\Http\Response
     */
    public function show(Centerteam $centerteam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Centerteam  $centerteam
     * @return \Illuminate\Http\Response
     */
    public function edit(Centerteam $centerTeam)
    {
        $row = Centerteam::where('id',$centerTeam->id)->with('translation','translations')->first();
        return view('admin.about.center-team.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCenterteamRequest  $request
     * @param  \App\Models\Centerteam  $centerteam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'email'     => 'required|email|string|max:50',
            'cv_link'   => 'nullable|string|max:255',
            'img'       => 'required|string|max:255',
            'job_title' => 'required|in:cbd,ceo,mem,emp',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:900',
        ]);

        Centerteam::where('id',$id)->update([
            'email'     => $request->email,
            'cv_link'   => $request->cv_link,
            'img'       => $request->img,
            'type'      => $request->job_title,
        ]);
        foreach (SupportedKeys() as $key) :
            CenterteamTranslation::where(['centerteam_id'=>$id,'locale'=>$key])
            ->update([
                'name'          => $request->name[$key],
                'description'   => nl2br($request->description[$key]),
                'job_title'     => __('global.center_member.jobs_titles')[$key][$request->job_title],
            ]);
        endforeach;
        return redirect('/admin/center-team')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Centerteam  $centerteam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Centerteam $centerTeam)
    {
        $centerTeam->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
