<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\OurEpisodes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\OurEpisodeTranslation;

class BodcastFakarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('authadmin:profile_edit')->only('profile', 'UpdateProfile');
        
        $this->middleware('permission:read-Bodcast')->only('json','index');
        $this->middleware('permission:create-Bodcast')->only('create','store');
        $this->middleware('permission:edit-Bodcast')->only('edit', 'update');
        $this->middleware('permission:delete-Bodcast')->only('destroy');
    }

    public function json()
    {
        $query = OurEpisodes::with('translation')->get();

        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    public function index()
    { 
  
        return view('admin.bodcasts.ourepisodes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bodcasts.ourepisodes.create');
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
            'name.*'    => 'required|string',
            'description'      => 'required|array',
            'description.*'    => 'required|string'
        ]);

        try {

            DB::BeginTransaction();

            $episode = OurEpisodes::create([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                OurEpisodeTranslation::create([
                    'name'      => $request->name[$key],
                    'description'      => $request->description[$key],
                    'our_episode_id'  => $episode->id,
                    'locale'    => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }
        return redirect()->route('bodcasts-fakar.index')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = OurEpisodes::findOrFail($id);

        return view('admin.bodcasts.ourepisodes.edit', compact('row'));
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

        $episode = OurEpisodes::findOrFail($id);

        try {

            DB::BeginTransaction();

            $episode->update([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                
                $episodeTranslation = OurEpisodeTranslation::
                where(['locale' => $key, 'our_episode_id' => $episode->id])
                ->first();

                $episodeTranslation->update([

                    'name'              => $request->name[$key],
                    'description'       => $request->description[$key],
                    'our_episode_id'    => $episode->id,
                    'locale'            => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }

        return redirect()->route('bodcasts-fakar.index')->with('success', __('global.alert_done_update'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $episode = OurEpisodes::findOrFail($id);

        $episode->delete();

        return redirect()->route('bodcasts-fakar.index')->with('success', __('global.alert_done_delete'));
    }
}
