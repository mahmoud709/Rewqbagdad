<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\Upcomingtraining;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\UpcomingtrainingTranslation;

class UpcomingtrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:read-Upcomingtraining')->only('json','index');
        $this->middleware('permission:create-Upcomingtraining')->only('create','store');
        $this->middleware('permission:edit-Upcomingtraining')->only('edit', 'update');
        $this->middleware('permission:delete-Upcomingtraining')->only('destroy');
    }
    
    public function json()
    {
        $query = Upcomingtraining::select("*")->with('translation:title,upcomingtraining_id')->get();

        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }
    
    public function index()
    {
        return view('admin.kon.upcomingtrainings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kon.upcomingtrainings.create');
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

            'price' => 'required|integer',
            'training_appointment' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // Check if the date is in the future
                    if (strtotime($value) <= time()) {
                        $fail($attribute.' must be a date in the future.');
                    }
                },
            ],
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
            'trainer_info.*' => 'required|string',
        ]);

        try {

            DB::beginTransaction();

            $KonTraining = Upcomingtraining::create([
                'photo' => $request->photo,
                'price' => $request->price,
                'training_appointment' => $request->training_appointment,
             
                'slug' => $request->slug,
            ]);
    
            foreach($request->description as $key => $item) 
            {
                UpcomingtrainingTranslation::create([
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'content' => $request->content[$key],
                    'trainer_info' => $request->trainer_info[$key],
                    'locale' => $key,
                    'upcomingtraining_id' => $KonTraining->id
                ]);
            }

            DB::commit();
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('kon-upcomingtrainings.index')->with('success', __('global.alert_done_create'));


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Upcomingtraining  $upcomingtraining
     * @return \Illuminate\Http\Response
     */
    public function show(Upcomingtraining $upcomingtraining)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Upcomingtraining  $upcomingtraining
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Upcomingtraining::with('translations')->findOrFail($id);

        return view('admin.kon.upcomingtrainings.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Upcomingtraining  $upcomingtraining
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slug'   => 'required|string|max:100|unique:iraqmeters',
            'photo'       => 'required|string|max:255',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'price' => 'required|integer',
            'training_appointment' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    // Check if the date is in the future
                    if (strtotime($value) <= time()) {
                        $fail($attribute.' must be a date in the future.');
                    }
                },
            ],
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
            'trainer_info.*' => 'required|string',
        ]);   
        
        try {

            DB::beginTransaction();

            $KonTraining = Upcomingtraining::findOrFail($id);
            $KonTraining->update([
                'photo' => $request->photo,
                'price' => $request->price,
                'training_appointment' => $request->training_appointment,
             
                'slug' => $request->slug,
            ]);

            foreach($request->description as $key => $item) 
            {
                $KonTrainingTranslation = UpcomingtrainingTranslation::
                where(['locale' => $key, 'upcomingtraining_id' => $KonTraining->id])->first();
               
                $KonTrainingTranslation->update([
                    'title' => $request->title[$key],
                    'description' => $request->description[$key],
                    'content' => $request->content[$key],
                    'trainer_info' => $request->trainer_info[$key],
                    'locale' => $key,
                    'upcomingtraining_id' => $KonTraining->id
                ]);
            }

            DB::commit();
            
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }

        return redirect()->route('kon-upcomingtrainings.index')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Upcomingtraining  $upcomingtraining
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $KonTraining = Upcomingtraining::findOrFail($id);

        $KonTraining->delete();

        return redirect()->route('kon-upcomingtrainings.index')->with('success', __('global.alert_done_delete'));

        
    }
}
