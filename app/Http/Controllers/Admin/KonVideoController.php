<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\konVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\konVideoTranslation;
use App\Http\Controllers\Controller;

class KonVideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('authadmin:profile_edit')->only('profile', 'UpdateProfile');
        
        $this->middleware('permission:read-konVideo')->only('json','index');
        $this->middleware('permission:create-konVideo')->only('create','store');
        $this->middleware('permission:edit-konVideo')->only('edit', 'update');
        $this->middleware('permission:delete-konVideo')->only('destroy');
    }

    public function json()
    {
        $query = konVideo::with('translation')->get();

        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    public function index()
    {
        return view('admin.kon.video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kon.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $request->validate([
            'img'       => 'required',
            'video_url' => ['required', 'regex:/^(https?:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+/'],
            'name'      => 'required|array',
            'name.*'    => 'required|string'
        ]);

        try {

            DB::BeginTransaction();

            $konVideo = konVideo::create([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                konVideoTranslation::create([
                    'name'      => $request->name[$key],
                    'kon_video_id'  => $konVideo->id,
                    'locale'    => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }
        return redirect()->route('kon-videos.index')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function show(konVideo $konVideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = konVideo::findOrFail($id);

        return view('admin.kon.video.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
             
        $request->validate([
            'img'       => 'required',
            'video_url' => ['required', 'regex:/^(https?:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+/'],
            'name'      => 'required|array',
            'name.*'    => 'required|string'
        ]);

        $konVideo = konVideo::findOrFail($id);

        try {

            DB::BeginTransaction();

            $konVideo->update([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                
                $rewaqVideoTranslation = konVideoTranslation::
                where(['locale' => $key, 'kon_video_id' => $konVideo->id])
                ->first();

                $rewaqVideoTranslation->update([
                    'name'      => $request->name[$key],
                    'kon_video_id'  => $konVideo->id,
                    'locale'    => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }

        return redirect()->route('kon-videos.index')->with('success', __('global.alert_done_update'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konVideo = konVideo::findOrFail($id);

        $konVideo->delete();

        return redirect()->route('kon-videos.index')->with('success', __('global.alert_done_delete'));
    }
}
