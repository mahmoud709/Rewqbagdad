<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Teamsetting;
use App\Models\Bookteam;
use App\Models\BookteamTranslation;
use Illuminate\Http\Request;

class BookteamController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:bookteam_show')->only('json','index','UpdateDescription');
        // $this->middleware('authadmin:bookteam_create')->only('create','store');
        // $this->middleware('authadmin:bookteam_edit')->only('edit', 'update');
        // $this->middleware('authadmin:bookteam_delete')->only('destroy');

        
        $this->middleware('permission:read-bookTeam')->only('json','index','UpdateDescription');
        $this->middleware('permission:update-bookTeam')->only('create','store');
        $this->middleware('permission:edit-bookTeam')->only('edit', 'update');
        $this->middleware('permission:delete-bookTeam')->only('destroy');
    }

    public function UpdateDescription(Request $request)
    {
        $validatedData = $request->validate([
            'description_ar' => 'required|string|max:900',
            'description_en' => 'required|string|max:900',
        ]);
        Teamsetting::where('slug','book-team')->update([
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
        ]);
        return back()->with('success', __('global.alert_done_update'));
    }

    public function json()
    {
        $query = Bookteam::select('id','email','created_at')->with('translation:name,job_title,bookteam_id')->get();
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
        $teamSetting = Teamsetting::where('slug','book-team')->first();
        return view('admin.about.book-team.index', compact('teamSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.book-team.create');
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
            'email'     => 'nullable|email|string|max:50',
            'cv_link'   => 'nullable|string|max:255',
            'img'       => 'nullable|string|max:255',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',
            
            'job_title' => 'required|array',
            'job_title.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:55000',
        ]);
        
        $row = new Bookteam;
        $row->email = $request->email;
        $row->cv_link = $request->cv_link;
        $row->img = $request->img;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new BookteamTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->job_title = $request->job_title[$key];
            $trans->description = $request->description[$key];
            $trans->bookteam_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/book-team')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bookteam  $bookteam
     * @return \Illuminate\Http\Response
     */
    public function show(Bookteam $bookteam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bookteam  $bookteam
     * @return \Illuminate\Http\Response
     */
    public function edit(Bookteam $bookTeam)
    {
        $row = Bookteam::where('id',$bookTeam->id)->with('translation','translations')->first();
        return view('admin.about.book-team.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Bookteam  $bookteam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bookteam $bookTeam)
    {
        $validatedData = $request->validate([
            'email'     => 'nullable|email|string|max:50',
            'cv_link'   => 'nullable|string|max:255',
            'img'       => 'nullable|string|max:255',

            'name' => 'required|array',
            'name.*' => 'required|string|max:50',
            
            'job_title' => 'required|array',
            'job_title.*' => 'required|string|max:50',

            'description' => 'required|array',
            'description.*' => 'required|string|max:55000',
        ]);

        Bookteam::where('id',$bookTeam->id)->update([
            'email'     => $request->email,
            'cv_link'   => $request->cv_link,
            'img'       => $request->img,
        ]);
        foreach (SupportedKeys() as $key) :
            BookteamTranslation::where(['bookteam_id'=>$bookTeam->id,'locale'=>$key])
            ->update([
                'name'          => $request->name[$key],
                'description'   => $request->description[$key],
                'job_title'     => $request->job_title[$key],
            ]);
        endforeach;
        return redirect('/admin/book-team')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bookteam  $bookteam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bookteam $bookTeam)
    {
        $bookTeam->delete();
        return redirect('/admin/book-team')->with('success', __('global.alert_done_delete'));
    }
}
