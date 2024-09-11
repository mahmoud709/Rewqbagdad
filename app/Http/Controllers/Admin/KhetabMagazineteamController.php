<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KhetabMagazineteam;
use App\Models\KhetabMagazineteamTranslation;


class KhetabMagazineteamController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:read-khetabmagazinemteam')->only('json','index');
        $this->middleware('permission:create-khetabmagazinemteam')->only('create','store');
        $this->middleware('permission:edit-khetabmagazinemteam')->only('edit', 'update');
        $this->middleware('permission:delete-khetabmagazinemteam')->only('destroy');
    }

    public function json()
    {
        $query = KhetabMagazineteam::with('translation')->get();
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
        $query = KhetabMagazineteamTranslation::all();

        // return $query;
        return view('admin.khetab_magazine.team.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $AllCount = KhetabMagazineteam::count();
        return view('admin.khetab_magazine.team.create', compact('AllCount'));
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
        
        $row = new KhetabMagazineteam;
        $row->sort = $request->sort;
        $row->email = $request->email;
        $row->cv_link = $request->cv_link;
        $row->img = $request->img;
        $row->type = $request->job_title;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new KhetabMagazineteamTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->job_title = __('global.khetab_magazine.team.jobs_titles')[$key][$request->job_title];
            $trans->description = $request->description[$key];
            $trans->parent_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/khetab-magazine-team')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function show(KhetabMagazineteam $magazineteam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = KhetabMagazineteam::where('id',$id)->with('translation','translations')->first();
        // return $id ;
        return view('admin.khetab_magazine.team.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMagazineteamRequest  $request
     * @param  \App\Models\KhetabMagazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KhetabMagazineteam $magazineTeam , $id)
    {
        // return $magazineTeam;
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

        KhetabMagazineteam::where('id',$id)->update([
            'sort'     => $request->sort,
            'email'     => $request->email,
            'cv_link'   => $request->cv_link,
            'img'       => $request->img,
            'type'      => $request->job_title,
        ]);
        foreach (SupportedKeys() as $key) :
            KhetabMagazineteamTranslation::where(['parent_id'=>$id,'locale'=>$key])
            ->update([
                'name'          => $request->name[$key],
                'description'   => $request->description[$key],
                'job_title'     => __('global.khetab_magazine.team.jobs_titles')[$key][$request->job_title],
            ]);
        endforeach;
        return redirect('/admin/khetab-magazine-team')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magazineteam  $magazineteam
     * @return \Illuminate\Http\Response
     */
    public function destroy(KhetabMagazineteam $magazineTeam , $id)
    {
        KhetabMagazineteam::where('id',$id)->delete();
        // $magazineTeam->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
