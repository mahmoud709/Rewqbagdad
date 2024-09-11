<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Electronicservice;
use App\Models\ElectronicserviceTranslation;

class ElectronicserviceController extends Controller
{

    public function __construct()
    {

        $this->middleware('permission:read-electronicsService')->only('json','index');

        $this->middleware('permission:edit-electronicsService')->only('edit', 'update');

    }

    public function json()
    {
        $query = Electronicservice::with('translation:title,electronic_id')->get();
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
        return view('admin.electronic-service.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreElectronicserviceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreElectronicserviceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Electronicservice  $electronicservice
     * @return \Illuminate\Http\Response
     */
    public function show(Electronicservice $electronicservice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Electronicservice  $electronicservice
     * @return \Illuminate\Http\Response
     */
    public function edit(Electronicservice $electronicService)
    {
        $row = Electronicservice::where('id',$electronicService->id)->with('translation','translations')->first();
        return view('admin.electronic-service.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateElectronicserviceRequest  $request
     * @param  \App\Models\Electronicservice  $electronicservice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Electronicservice $electronicService)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|max:100',

            'title' => 'required|array',
            'title.*' => 'required|string|max:100',
            
            'description' => 'nullable|array',
            'description.*' => 'nullable|string',

            'content' => 'nullable|array',
            'content.*' => 'nullable|string',
        ]);
        Electronicservice::where('id',$electronicService->id)->update([
            'email' => $request->email,
        ]);
        foreach (SupportedKeys() as $key) :
            ElectronicserviceTranslation::where(['electronic_id'=>$electronicService->id,'locale'=>$key])
            ->update([
                'title'         => $request->title[$key],
                'content'       => $request->content[$key],
                'description'   => $request->description[$key],
            ]);
        endforeach;
        return redirect('/admin/electronic-services')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Electronicservice  $electronicservice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Electronicservice $electronicservice)
    {
        //
    }
}
