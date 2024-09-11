<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Versioncategory;
use App\Models\VersioncategoryTranslation;
use Illuminate\Http\Request;

class VersioncategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:versioncategory_show')->only('json','index');
        // $this->middleware('authadmin:versioncategory_create')->only('create','store');
        // $this->middleware('authadmin:versioncategory_edit')->only('edit', 'update');
        // $this->middleware('authadmin:versioncategory_delete')->only('destroy');

        $this->middleware('permission:read-versionCategory')->only('json','index');
        $this->middleware('permission:create-versionCategory')->only('create','store');
        $this->middleware('permission:edit-versionCategory')->only('edit', 'update');
        $this->middleware('permission:delete-versionCategory')->only('destroy');
    }

    public function json()
    {
        $query = Versioncategory::with('translation')->get();
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
        return view('admin.version.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countAll = Versioncategory::count('id');
        return view('admin.version.category.create', compact('countAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'slug'  => 'required|string|max:100|unique:versioncategories,slug',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:50',
        ]);
        
        $row = new Versioncategory;
        $row->sort = $request->sort;
        $row->slug = $request->slug;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new VersioncategoryTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->category_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/version-categories')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Versioncategory  $versioncategory
     * @return \Illuminate\Http\Response
     */
    public function show(Versioncategory $versioncategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Versioncategory  $versioncategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Versioncategory $versionCategory)
    {
        $row = Versioncategory::where('id',$versionCategory->id)->with('translation','translations')->first();
        return view('admin.version.category.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVersioncategoryRequest  $request
     * @param  \App\Models\Versioncategory  $versioncategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Versioncategory $versionCategory)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'slug'  => 'required|string|max:100|unique:versioncategories,slug,'.$versionCategory->id,
            'name'  => 'required|array',
            'name.*' => 'required|string|max:50',
        ]);
        Versioncategory::where('id',$versionCategory->id)->update([
            'sort' => $request->sort,
            'slug' => $request->slug,
        ]);
        foreach (SupportedKeys() as $key) :
            VersioncategoryTranslation::where(['category_id'=>$versionCategory->id,'locale'=>$key])
            ->update([
                'name' => $request->name[$key],
            ]);
        endforeach;
        return redirect('/admin/version-categories')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Versioncategory  $versioncategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Versioncategory $versionCategory)
    {
        $versionCategory->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
