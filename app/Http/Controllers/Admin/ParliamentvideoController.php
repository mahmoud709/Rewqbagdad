<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Parliamentvideo;
use App\Models\ParliamentvideoTranslation;
use Illuminate\Http\Request;

class ParliamentvideoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:parliamentvideo_show')->only('json','index');
        // $this->middleware('authadmin:parliamentvideo_create')->only('create','store');
        // $this->middleware('authadmin:parliamentvideo_edit')->only('edit', 'update');
        // $this->middleware('authadmin:parliamentvideo_delete')->only('destroy');
    }

    public function json()
    {
        $query = Parliamentvideo::with('translation')->get();
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
        $query = Parliamentvideo::with('translation')->get();
        return view('admin.parliament.video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.parliament.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParliamentvideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'img'  => 'required|string|max:255',
            'video_url'  => 'required|string|max:255',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:200',
        ]);
        $row = new Parliamentvideo;
        $row->img = $request->img;
        $row->video_url = $request->video_url;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new ParliamentvideoTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->video_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/parliament-videos')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parliamentvideo  $parliamentvideo
     * @return \Illuminate\Http\Response
     */
    public function show(Parliamentvideo $parliamentvideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Parliamentvideo  $parliamentvideo
     * @return \Illuminate\Http\Response
     */
    public function edit(Parliamentvideo $parliamentVideo)
    {
        $row = Parliamentvideo::where('id',$parliamentVideo->id)->with('translation','translations')->first();
        return view('admin.parliament.video.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParliamentvideoRequest  $request
     * @param  \App\Models\Parliamentvideo  $parliamentvideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Parliamentvideo $parliamentVideo)
    {
        $validatedData = $request->validate([
            'img'  => 'required|string|max:255',
            'video_url'  => 'required|string|max:255',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:200',
        ]);
        Parliamentvideo::where('id',$parliamentVideo->id)->update([
            'img' => $request->img,
            'video_url' => $request->video_url,
        ]);
        foreach (SupportedKeys() as $key) :
            ParliamentvideoTranslation::where(['video_id'=>$parliamentVideo->id,'locale'=>$key])
            ->update([
                'name' => $request->name[$key],
            ]);
        endforeach;
        return redirect('/admin/parliament-videos')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parliamentvideo  $parliamentvideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parliamentvideo $parliamentVideo)
    {
        $parliamentVideo->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
