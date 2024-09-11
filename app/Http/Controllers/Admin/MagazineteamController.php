<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Magazineteam;
use App\Models\MagazineteamTranslation;
use Illuminate\Http\Request;

class MagazineteamController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:magazineteam_show')->only('json','index');
        // $this->middleware('authadmin:magazineteam_create')->only('create','store');
        // $this->middleware('authadmin:magazineteam_edit')->only('edit', 'update');
        // $this->middleware('authadmin:magazineteam_delete')->only('destroy');

        $this->middleware('permission:read-RewaMagazineTeam')->only('json','index');
        $this->middleware('permission:create-RewaMagazineTeam')->only('create','store');
        $this->middleware('permission:edit-RewaMagazineTeam')->only('edit', 'update');
        $this->middleware('permission:delete-RewaMagazineTeam ')->only('destroy');
    }

    public function json()
    {
        $query = Magazineteam::with('translation')->get();
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
        return view('admin.magazine.team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AllCount = Magazineteam::count();
        return view('admin.magazine.team.create', compact('AllCount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMagazineteamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort'     => 'required|integer', 
            'email'     => 'required|email|string|max:50',
            'cv_link'   => 'nullable|url|max:255',
            'img'       => 'required|string|max:255',
            'job_title' => 'required|in:cbd,ec,dec,me,es',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',
            'description' => 'required|array',
            'description.*' => 'required|string|max:900',
        ]);
        
        $row = new Magazineteam;
        $row->sort = $request->sort;
        $row->email = $request->email;
        $row->cv_link = $request->cv_link;
        $row->img = $request->img;
        $row->type = $request->job_title;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new MagazineteamTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->job_title = __('global.magazine.team.jobs_titles')[$key][$request->job_title];
            $trans->description = $request->description[$key];
            $trans->parent_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/magazine-team')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function show(Magazineteam $magazineteam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function edit(Magazineteam $magazineTeam)
    {
        $row = Magazineteam::where('id',$magazineTeam->id)->with('translation','translations')->first();
        return view('admin.magazine.team.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMagazineteamRequest  $request
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magazineteam $magazineTeam)
    {
        $validatedData = $request->validate([
            'sort'     => 'required|integer', 
            'email'     => 'required|email|string|max:50',
            'cv_link'   => 'nullable|url|max:255',
            'img'       => 'required|string|max:255',
            'job_title' => 'required|in:cbd,ec,dec,me,es',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:900',
        ]);

        Magazineteam::where('id',$magazineTeam->id)->update([
            'sort'     => $request->sort,
            'email'     => $request->email,
            'cv_link'   => $request->cv_link,
            'img'       => $request->img,
            'type'      => $request->job_title,
        ]);
        foreach (SupportedKeys() as $key) :
            MagazineteamTranslation::where(['parent_id'=>$magazineTeam->id,'locale'=>$key])
            ->update([
                'name'          => $request->name[$key],
                'description'   => $request->description[$key],
                'job_title'     => __('global.magazine.team.jobs_titles')[$key][$request->job_title],
            ]);
        endforeach;
        return redirect('/admin/magazine-team')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magazineteam $magazineTeam)
    {
        $magazineTeam->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
