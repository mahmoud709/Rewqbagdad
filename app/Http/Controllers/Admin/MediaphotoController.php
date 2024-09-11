<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Mediaphoto;
use App\Models\MediaphotoTranslation;
use Illuminate\Http\Request;

class MediaphotoController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:mediaphoto_show')->only('json','index');
        // $this->middleware('authadmin:mediaphoto_create')->only('create','store');
        // $this->middleware('authadmin:mediaphoto_edit')->only('edit', 'update');
        // $this->middleware('authadmin:mediaphoto_delete')->only('destroy');

        $this->middleware('permission:read-libraryPhoto')->only('json','index');
        $this->middleware('permission:create-libraryPhoto')->only('create','store');
        $this->middleware('permission:edit-libraryPhoto')->only('edit', 'update');
        $this->middleware('permission:delete-libraryPhoto')->only('destroy');
    }

    public function json()
    {
        $query = Mediaphoto::with('translation')->get();
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
        return view('admin.media.photo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countAll = Mediaphoto::count('id');
        return view('admin.media.photo.create', compact('countAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMediaphotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'img' => 'required|string|max:255',
            'imgs' => 'required|string|max:5000',

            'title'  => 'required|array',
            'title.*' => 'required|string|max:255',
        ]);
        $row = new Mediaphoto;
        $row->sort = $request->sort;
        $row->img = $request->img;
        $row->imgs = $request->imgs;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new MediaphotoTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->mediaphoto_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/media-photos')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mediaphoto  $mediaphoto
     * @return \Illuminate\Http\Response
     */
    public function show(Mediaphoto $mediaphoto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mediaphoto  $mediaphoto
     * @return \Illuminate\Http\Response
     */
    public function edit(Mediaphoto $mediaPhoto)
    {
        $row = Mediaphoto::where('id',$mediaPhoto->id)->with('translation','translations')->first();
        return view('admin.media.photo.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMediaphotoRequest  $request
     * @param  \App\Models\Mediaphoto  $mediaphoto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mediaphoto $mediaPhoto)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'img' => 'required|string|max:255',
            'imgs' => 'required|string|max:5000',

            'title'  => 'required|array',
            'title.*' => 'required|string|max:255',
        ]);
        Mediaphoto::where('id',$mediaPhoto->id)->update([
            'sort'  => $request->sort,
            'img'   => $request->img,
            'imgs'  => $request->imgs,
        ]);
        foreach (SupportedKeys() as $key) :
            MediaphotoTranslation::where(['mediaphoto_id'=>$mediaPhoto->id,'locale'=>$key])
            ->update([
                'title' => $request->title[$key],
            ]);
        endforeach;
        return redirect('/admin/media-photos')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mediaphoto  $mediaphoto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mediaphoto $mediaPhoto)
    {
        $mediaPhoto->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
