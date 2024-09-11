<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Mediavideocategory;
use App\Models\MediavideocategoryTranslation;
use Illuminate\Http\Request;

class MediavideocategoryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('authadmin:mediavideocategory_show')->only('json','index');
        // $this->middleware('authadmin:mediavideocategory_create')->only('create','store');
        // $this->middleware('authadmin:mediavideocategory_edit')->only('edit', 'update');
        // $this->middleware('authadmin:mediavideocategory_delete')->only('destroy');

        
        $this->middleware('permission:read-categoryLibraryPhoto')->only('json','index');
        $this->middleware('permission:create-categoryLibraryPhoto')->only('create','store');
        $this->middleware('permission:edit-categoryLibraryPhoto')->only('edit', 'update');
        $this->middleware('permission:delete-categoryLibraryPhoto')->only('destroy');
    }

    public function json()
    {
        $query = Mediavideocategory::with('translation')->get();
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
        return view('admin.media.video-category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countAll = Mediavideocategory::count('id');
        return view('admin.media.video-category.create',compact('countAll'));
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
            'sort'  => 'required|integer|min:1',
            'slug'  => 'required|string|max:100|unique:mediavideocategories,slug',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:50',
        ]);
        
        $row = new Mediavideocategory;
        $row->sort = $request->sort;
        $row->slug = $request->slug;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new MediavideocategoryTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->category_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/media-videos-categories')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mediavideocategory  $mediavideocategory
     * @return \Illuminate\Http\Response
     */
    public function show(Mediavideocategory $mediavideocategory)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mediavideocategory  $mediavideocategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Mediavideocategory::where('id',$id)->with('translation','translations')->first();
        return view('admin.media.video-category.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Mediavideocategory  $mediavideocategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'slug'  => 'required|string|max:100|unique:mediavideocategories,slug,'.$id,
            'name'  => 'required|array',
            'name.*' => 'required|string|max:50',
        ]);
        Mediavideocategory::where('id',$id)->update([
            'sort' => $request->sort,
            'slug' => $request->slug,
        ]);
        foreach (SupportedKeys() as $key) :
            MediavideocategoryTranslation::where(['category_id'=>$id,'locale'=>$key])
            ->update([
                'name' => $request->name[$key],
            ]);
        endforeach;
        return redirect('/admin/media-videos-categories')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mediavideocategory  $mediavideocategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Mediavideocategory::where('id',$id)->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
