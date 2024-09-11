<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;

use App\Models\Etmamcategory;
use App\Models\Activitycategory;
use App\Http\Controllers\Controller;
use App\Models\EtmamcategoryTranslation;
use App\Models\ActivitycategoryTranslation;


class EtmamcategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:activitycategory_show')->only('json','index');
        // $this->middleware('authadmin:activitycategory_create')->only('create','store');
        // $this->middleware('authadmin:activitycategory_edit')->only('edit', 'update');
        // $this->middleware('authadmin:activitycategory_delete')->only('destroy');

                
        $this->middleware('permission:read-etmamCategory')->only('json','index');
        $this->middleware('permission:create-etmamCategory')->only('create','store');
        $this->middleware('permission:edit-etmamCategory')->only('edit', 'update');
        $this->middleware('permission:delete-etmamCategory')->only('destroy');
    }

    public function json()
    {
        $query = Etmamcategory::with('translation')->get();
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
        
        return view('admin.etmam.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countAll = Etmamcategory::count('id');
        return view('admin.etmam.category.create', compact('countAll'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreActivitycategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'slug'  => 'required|string|max:100|unique:activitycategories,slug',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:50',
        ]);
        
        $row = new Etmamcategory;
        $row->sort = $request->sort;
        $row->slug = $request->slug;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new EtmamcategoryTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->category_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/etmam-categories')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activitycategory  $activitycategory
     * @return \Illuminate\Http\Response
     */
    public function show(Etmamcategory $activitycategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activitycategory  $activitycategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $row = Etmamcategory::where('id',$id)->with('translation','translations')->first();
        return view('admin.etmam.category.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateActivitycategoryRequest  $request
     * @param  \App\Models\Activitycategory  $activitycategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'slug'  => 'required|string|max:100|unique:activitycategories,slug,'.$id,
            'name'  => 'required|array',
            'name.*' => 'required|string|max:50',
        ]);
        Etmamcategory::where('id',$id)->update([
            'sort' => $request->sort,
            'slug' => $request->slug,
        ]);
        foreach (SupportedKeys() as $key) :
            EtmamcategoryTranslation::where(['category_id'=>$id,'locale'=>$key])
            ->update([
                'name' => $request->name[$key],
            ]);
        endforeach;
        return redirect('/admin/etmam-categories')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activitycategory  $activitycategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etmamCategory = Etmamcategory::findOrFail($id);
        $etmamCategory->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
