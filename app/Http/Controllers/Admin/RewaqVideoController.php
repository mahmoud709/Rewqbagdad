<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\RewaqVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Rewaq;
use App\Models\RewaqVideoTranslation;

class RewaqVideoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:profile_edit')->only('profile', 'UpdateProfile');
        
        $this->middleware('permission:read-rewaqVideo')->only('json','index');
        $this->middleware('permission:create-rewaqVideo')->only('create','store');
        $this->middleware('permission:edit-rewaqVideo')->only('edit', 'update');
        $this->middleware('permission:delete-rewaqVideo')->only('destroy');
    }

    public function json()
    {
        $query = RewaqVideo::with('translation')->get();

        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    public function index()
    {
        return view('admin.rewaq.video.index');
    }

    public function create()
    {
        return view('admin.rewaq.video.create');
    }

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

            $rewaqVideo = RewaqVideo::create([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                RewaqVideoTranslation::create([
                    'name'      => $request->name[$key],
                    'video_id'  => $rewaqVideo->id,
                    'locale'    => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }
        return redirect()->route('rewaq-videos.index')->with('success', __('global.alert_done_create'));
    }

    public function edit($id)
    {
        $row = RewaqVideo::with('translations')->findOrFail($id);

        return view('admin.rewaq.video.edit', compact('row'));
    }

    public function update(Request $request, $id)
    {
             
        $request->validate([
            'img'       => 'required',
            'video_url' => ['required', 'regex:/^(https?:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+/'],
            'name'      => 'required|array',
            'name.*'    => 'required|string'
        ]);

        $rewaqVideo = RewaqVideo::findOrFail($id);

        try {

            DB::BeginTransaction();

            $rewaqVideo->update([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                
                $rewaqVideoTranslation = RewaqVideoTranslation::
                where(['locale' => $key, 'video_id' => $rewaqVideo->id])
                ->first();

                $rewaqVideoTranslation->update([
                    'name'      => $request->name[$key],
                    'video_id'  => $rewaqVideo->id,
                    'locale'    => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }

        return redirect()->route('rewaq-videos.index')->with('success', __('global.alert_done_update'));
    }

    public function destroy($id)
    {
        $rewaqVideo = RewaqVideo::findOrFail($id);

        $rewaqVideo->delete();

        return redirect()->route('rewaq-videos.index')->with('success', __('global.alert_done_delete'));
    }
}
