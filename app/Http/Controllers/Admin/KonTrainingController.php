<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\KonTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\konTrainingTranslation;

class KonTrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:read-konTraining')->only('json','index');
        $this->middleware('permission:create-konTraining')->only('create','store');
        $this->middleware('permission:edit-konTraining')->only('edit', 'update');
        $this->middleware('permission:delete-konTraining')->only('destroy');
    }
    
    public function json()
    {
        $query = KonTraining::select("*")->with('translation:title,kon_training_id')->get();

        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }
    
    public function index()
    {
        return view('admin.kon.trainings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        return view('admin.kon.trainings.create');
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
            'slug'   => 'required|string|max:100|unique:iraqmeters',
            'photo'       => 'required|string|max:255',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
      
        try {

            DB::beginTransaction();

            $KonTraining = KonTraining::create([
                'photo' => $request->photo,
             
                'slug' => $request->slug,
            ]);
    
            foreach($request->description as $key => $item) 
            {
                konTrainingTranslation::create([
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'content' => $request->content[$key],
                    'locale' => $key,
                    'kon_training_id' => $KonTraining->id
                ]);
            }

            DB::commit();
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('kon-trainings.index')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KonTraining  $konTraining
     * @return \Illuminate\Http\Response
     */
    public function show(KonTraining $konTraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KonTraining  $konTraining
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $row = KonTraining::findOrFail($id);

        return view('admin.kon.trainings.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KonTraining  $konTraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slug'   => "required|string|max:100|unique:iraqmeters",
            'photo'       => 'required|string|max:255',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
      
        try {

            DB::beginTransaction();

            $iraqmeterSurvey = KonTraining::findOrFail($id);;
            $iraqmeterSurvey->update([
                'photo' => $request->photo,

                'slug' => $request->slug,
            ]);

            foreach($request->description as $key => $item) 
            {
                $iraqmeterSurveyTranslation = konTrainingTranslation::
                where(['locale' => $key, 'kon_training_id' => $iraqmeterSurvey->id])->first();
               
                $iraqmeterSurveyTranslation->update([
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'content' => $request->description[$key],
                    'locale' => $key,
                    'kon_training_id' => $iraqmeterSurvey->id
                ]);
            }

            DB::commit();
            
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('kon-trainings.index')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KonTraining  $konTraining
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $konTraining = KonTraining::findOrFail($id);

        $konTraining->delete();

        return redirect()->route('kon-trainings.index')->with('success', __('global.alert_done_delete'));
    }
}
