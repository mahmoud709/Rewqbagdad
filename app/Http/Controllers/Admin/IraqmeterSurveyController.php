<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin;
use Exception;
use Illuminate\Http\Request;
use App\Models\IraqmeterSurvey;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\IraqmeterSurveyTranslation;

class IraqmeterSurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:read-iraqmeterSurvey')->only('json','index');
        $this->middleware('permission:create-iraqmeterSurvey')->only('create','store');
        $this->middleware('permission:edit-iraqmeterSurvey')->only('edit', 'update');
        $this->middleware('permission:delete-iraqmeterSurvey')->only('destroy');
    }
    
    public function json()
    {
        $query = IraqmeterSurvey::select("*")->with('translation:title,iraqmeter_survey_id')->get();
        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }
    public function index()
    {
        return view('admin.iraq-meter.surveys.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.iraq-meter.surveys.create');
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
            'pdf'       => 'required|string|max:255',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
      
        try {

            DB::beginTransaction();

            $iraqmeterSurvey = IraqmeterSurvey::create([
                'photo' => $request->photo,
                'pdf' => $request->pdf,
                'slug' => $request->slug,
            ]);
    
            foreach($request->description as $key => $item) 
            {
                IraqmeterSurveyTranslation::create([
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'content' => $request->description[$key],
                    'locale' => $key,
                    'iraqmeter_survey_id' => $iraqmeterSurvey->id
                ]);
            }

            DB::commit();
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('iraqmeter-surveys.index')->with('success', __('global.alert_done_create'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IraqmeterSurvey  $iraqmeterSurvey
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = IraqmeterSurvey::findOrfail($id);

        return view('admin.iraq-meter.surveys.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IraqmeterSurvey  $iraqmeterSurvey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slug'   => "required|string|max:100|unique:iraqmeters",
            'photo'       => 'required|string|max:255',
            'pdf'       => 'required|string|max:255',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
      
        try {

            DB::beginTransaction();

            $iraqmeterSurvey = IraqmeterSurvey::findOrFail($id);;
            $iraqmeterSurvey->update([
                'photo' => $request->photo,
                'pdf' => $request->pdf,
                'slug' => $request->slug,
            ]);

            foreach($request->description as $key => $item) 
            {
                $iraqmeterSurveyTranslation = IraqmeterSurveyTranslation::
                where(['locale' => $key, 'iraqmeter_survey_id' => $iraqmeterSurvey->id])->first();
               
                $iraqmeterSurveyTranslation->update([
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'content' => $request->description[$key],
                    'locale' => $key,
                    'iraqmeter_survey_id' => $iraqmeterSurvey->id
                ]);
            }

            DB::commit();
            return redirect()->route('iraqmeter-surveys.index')->with('success', __('global.alert_done_update'));
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IraqmeterSurvey  $iraqmeterSurvey
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $iraqmeterSurvey = IraqmeterSurvey::findOrFail($id);

        $iraqmeterSurvey->delete();

        return redirect()->route('iraqmeter-surveys.index')->with('success', __('global.alert_done_delete'));
    }
}
