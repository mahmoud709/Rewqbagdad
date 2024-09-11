<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Mediavideo;
use App\Models\MediavideoTranslation;
use App\Models\Mediavideocategory;
use Illuminate\Http\Request;

class MediavideoController extends Controller
{

    public function __construct()
    {
        // $this->middleware('authadmin:mediavideo_show')->only('json','index');
        // $this->middleware('authadmin:mediavideo_create')->only('create','store');
        // $this->middleware('authadmin:mediavideo_edit')->only('edit', 'update');
        // $this->middleware('authadmin:mediavideo_delete')->only('destroy');

        $this->middleware('permission:read-libraryVideo')->only('json','index');
        $this->middleware('permission:create-libraryVideo')->only('create','store');
        $this->middleware('permission:edit-libraryVideo')->only('edit', 'update');
        $this->middleware('permission:delete-libraryVideo')->only('destroy');
    }

    public function json()
    {
        $query = Mediavideo::with('translation')->get();
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
        return view('admin.media.video.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Mediavideocategory::with('translation')->get();
        return view('admin.media.video.create', compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMediavideoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'img'  => 'required|string|max:255',
            'video_url'  => 'required|string|max:255',
            'category_id'     => 'required|integer|exists:mediavideocategories,id',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:200',
        ]);
        
        $row = new Mediavideo;
        $row->img = $request->img;
        $row->video_url = $request->video_url;
        $row->category_id = $request->category_id;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new MediavideoTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->video_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/media-videos')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mediavideo  $mediavideo
     * @return \Illuminate\Http\Response
     */
    public function show(Mediavideo $mediavideo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mediavideo  $mediavideo
     * @return \Illuminate\Http\Response
     */
    public function edit(Mediavideo $mediaVideo)
    {
        $row = Mediavideo::where('id',$mediaVideo->id)->with('translation','translations')->first();
        $cats = Mediavideocategory::with('translation')->get();
        return view('admin.media.video.edit', compact('row','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediavideoRequest  $request
     * @param  \App\Models\Mediavideo  $mediavideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mediavideo $mediaVideo)
    {
        $validatedData = $request->validate([
            'img'  => 'required|string|max:255',
            'video_url'  => 'required|string|max:255',
            'category_id'     => 'required|integer|exists:mediavideocategories,id',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:200',
        ]);
        Mediavideo::where('id',$mediaVideo->id)->update([
            'img' => $request->img,
            'video_url' => $request->video_url,
            'category_id' => $request->category_id,
        ]);
        foreach (SupportedKeys() as $key) :
            MediavideoTranslation::where(['video_id'=>$mediaVideo->id,'locale'=>$key])
            ->update([
                'name' => $request->name[$key],
            ]);
        endforeach;
        return redirect('/admin/media-videos')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mediavideo  $mediavideo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mediavideo $mediaVideo)
    {
        $mediaVideo->delete();
        return redirect('/admin/media-videos')->with('success', __('global.alert_done_delete'));
    }
}
