<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Rewaqteam;
use App\Models\RewaqteamTranslation;

use Illuminate\Http\Request;

class RewaqteamController extends Controller
{

    public function __construct()
    {
        // $this->middleware('authadmin:rewaqteam_show')->only('json','index');
        // $this->middleware('authadmin:rewaqteam_create')->only('create','store');
        // $this->middleware('authadmin:rewaqteam_edit')->only('edit', 'update');
        // $this->middleware('authadmin:rewaqteam_delete')->only('destroy');

        $this->middleware('permission:read-rewaqTeam')->only('json','index');
        $this->middleware('permission:create-rewaqTeam')->only('create','store');
        $this->middleware('permission:edit-rewaqTeam')->only('edit', 'update');
        $this->middleware('permission:delete-rewaqTeam')->only('destroy');
    }

    public function json()
    {
        $query = Rewaqteam::with('translation')->get();
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
        return view('admin.rewaq.team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AllCount = Rewaqteam::count();
        return view('admin.rewaq.team.create', compact('AllCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRewaqteamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort'     => 'required|integer', 
            'email'     => 'required|email|string|max:50',
            'cv_link'   => 'nullable|string|max:255',
            'img'       => 'required|string|max:255',
            'job_title' => 'required|in:pm,am,ps',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:900',
        ]);
        
        $row = new Rewaqteam;
        $row->sort = $request->sort;
        $row->email = $request->email;
        $row->cv_link = $request->cv_link;
        $row->img = $request->img;
        $row->type = $request->job_title;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new RewaqteamTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->job_title = __('global.rewaq.team.jobs_titles')[$key][$request->job_title];
            $trans->description = $request->description[$key];
            $trans->rewaq_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/rewaq-team')->with('success', __('global.alert_done_create'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rewaqteam  $rewaqteam
     * @return \Illuminate\Http\Response
     */
    public function show(Rewaqteam $rewaqteam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rewaqteam  $rewaqteam
     * @return \Illuminate\Http\Response
     */
    public function edit(Rewaqteam $rewaqTeam)
    {
        $row = Rewaqteam::where('id',$rewaqTeam->id)->with('translation','translations')->first();
        return view('admin.rewaq.team.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRewaqteamRequest  $request
     * @param  \App\Models\Rewaqteam  $rewaqteam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rewaqteam $rewaqTeam)
    {
        $validatedData = $request->validate([
            'sort'     => 'required|integer', 
            'email'     => 'required|email|string|max:50',
            'cv_link'   => 'nullable|string|max:255',
            'img'       => 'required|string|max:255',
            'job_title' => 'required|in:pm,am,ps',
            
            'name' => 'required|array',
            'name.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:900',
        ]);

        Rewaqteam::where('id',$rewaqTeam->id)->update([
            'sort'      => $request->sort,
            'email'     => $request->email,
            'cv_link'   => $request->cv_link,
            'img'       => $request->img,
            'type'      => $request->job_title,
        ]);
        foreach (SupportedKeys() as $key) :
            RewaqteamTranslation::where(['rewaq_id'=>$rewaqTeam->id,'locale'=>$key])
            ->update([
                'name'          => $request->name[$key],
                'description'   => $request->description[$key],
                'job_title'     => __('global.rewaq.team.jobs_titles')[$key][$request->job_title],
            ]);
        endforeach;
        return redirect('/admin/rewaq-team')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rewaqteam  $rewaqteam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rewaqteam $rewaqTeam)
    {
        $rewaqTeam->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
