<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\SliderTranslation;

use App\Models\Version;
use App\Models\Activity;
use App\Models\Medianews;
use App\Models\Rewaqbook;
use App\Models\Magazineblog;
use App\Models\Iraqmeter;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read-slider')->only('json','index');
        $this->middleware('permission:create-slider')->only('create','store');
        $this->middleware('permission:edit-slider')->only('edit', 'update');
        $this->middleware('permission:delete-slider')->only('destroy');
    }

    public function json()
    {
        $query = Slider::with('translation')->get();
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
        return view('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countAll = Slider::count();
        $versions = Version::select('id')->with('translation:title,version_id')->orderBy('id','DESC')->limit(100)->get();
        $activitys = Activity::select('id')->with('translation:title,activity_id')->orderBy('id','DESC')->limit(100)->get();
        $medianews = Medianews::select('id')->with('translation:title,medianews_id')->orderBy('id','DESC')->limit(100)->get();
        $rewaqbooks = Rewaqbook::select('id')->with('translation:title,parent_id')->orderBy('id','DESC')->limit(100)->get();
        $magazineblogs = Magazineblog::select('id')->with('translation:title,parent_id')->orderBy('id','DESC')->limit(100)->get();
        $iraqmeters = Iraqmeter::select('id')->with('translation:title,parent_id')->orderBy('id','DESC')->limit(100)->get();
        return view('admin.slider.create', compact('countAll','versions','activitys','medianews','rewaqbooks','magazineblogs','iraqmeters'));
    }
    
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSliderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'btn_url'  => 'required|string|max:255',
            'img'  => 'required|string|max:255',
            'btn_target'  => 'required|in:_blank,_self',

            'title'  => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'btn_name'  => 'required|array',
            'btn_name.*' => 'required|string|max:50',
        ]);
        
        $row = new Slider;
        $row->sort = $request->sort;
        $row->btn_url = $request->btn_url;
        $row->img = $request->img;
        $row->btn_target = $request->btn_target;
        $row->save();
        foreach ($request->title as $key => $title) :
            $trans = new SliderTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->btn_name = $request->btn_name[$key];
            $trans->parent_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/slider')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        $row = Slider::where('id',$slider->id)->with('translation','translations')->first();
        $versions = Version::select('id')->with('translation:title,version_id')->orderBy('id','DESC')->limit(100)->get();
        $activitys = Activity::select('id')->with('translation:title,activity_id')->orderBy('id','DESC')->limit(100)->get();
        $medianews = Medianews::select('id')->with('translation:title,medianews_id')->orderBy('id','DESC')->limit(100)->get();
        $rewaqbooks = Rewaqbook::select('id')->with('translation:title,parent_id')->orderBy('id','DESC')->limit(100)->get();
        $magazineblogs = Magazineblog::select('id')->with('translation:title,parent_id')->orderBy('id','DESC')->limit(100)->get();
        $iraqmeters = Iraqmeter::select('id')->with('translation:title,parent_id')->orderBy('id','DESC')->limit(100)->get();
        return view('admin.slider.edit', compact('row','versions','activitys','medianews','rewaqbooks','magazineblogs','iraqmeters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSliderRequest  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validatedData = $request->validate([
            'sort'  => 'required|integer|min:1',
            'btn_url'  => 'required|string|max:255',
            'img'  => 'required|string|max:255',
            'btn_target'  => 'required|in:_blank,_self',

            'title'  => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'btn_name'  => 'required|array',
            'btn_name.*' => 'required|string|max:50',
        ]);

        Slider::where('id',$slider->id)->update([
            'sort'     => $request->sort,
            'btn_url'   => $request->btn_url,
            'img'       => $request->img,
            'img'      => $request->img,
            'btn_target'      => $request->btn_target,
        ]);
        foreach (SupportedKeys() as $key) :
            SliderTranslation::where(['parent_id'=>$slider->id,'locale'=>$key])
            ->update([
                'title'    => $request->title[$key],
                'btn_name' => $request->btn_name[$key],
            ]);
        endforeach;
        return redirect('/admin/slider')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }

    public function ajax(Request $request)
    {
        if($request->ajax()):
            if ($request->model == 'ver'):
                $data = Version::where('id',$request->id)->select('id','img','slug')->with('translations:title,version_id')->first();
                return response()->json([
                    'status' => 'success',
                    'img' => $data->img,
                    'slug' => $data->slug,
                    'title_ar' => $data->translations[0]->title,
                    'title_en' => $data->translations[1]->title,
                ]);
            endif;
            
            if ($request->model == 'act'):
                $data = Activity::where('id',$request->id)->select('id','img','slug')->with('translations:title,activity_id')->first();
                return response()->json([
                    'status' => 'success',
                    'img' => $data->img,
                    'slug' => $data->slug,
                    'title_ar' => $data->translations[0]->title,
                    'title_en' => $data->translations[1]->title,
                ]);
            endif;
            
            if ($request->model == 'med'):
                $data = Medianews::where('id',$request->id)->select('id','slider_img','slug')->with('translations:title,medianews_id')->first();
                return response()->json([
                    'status' => 'success',
                    'img' => $data->slider_img,
                    'slug' => $data->slug,
                    'title_ar' => $data->translations[0]->title,
                    'title_en' => $data->translations[1]->title,
                ]);
            endif;
            
            if ($request->model == 'rew'):
                $data = Rewaqbook::where('id',$request->id)->select('id','img','slug')->with('translations:title,parent_id')->first();
                return response()->json([
                    'status' => 'success',
                    'img' => $data->img,
                    'slug' => $data->slug,
                    'title_ar' => $data->translations[0]->title,
                    'title_en' => $data->translations[1]->title,
                ]);
            endif;
            
            if ($request->model == 'mag'):
                $data = Magazineblog::where('id',$request->id)->select('id','img','slug')->with('translations:title,parent_id')->first();
                return response()->json([
                    'status' => 'success',
                    'img' => $data->img,
                    'slug' => $data->slug,
                    'title_ar' => $data->translations[0]->title,
                    'title_en' => $data->translations[1]->title,
                ]);
            endif;
            
            if ($request->model == 'ira'):
                $data = Iraqmeter::where('id',$request->id)->select('id','img','slug')->with('translations:title,parent_id')->first();
                return response()->json([
                    'status' => 'success',
                    'img' => $data->img,
                    'slug' => $data->slug,
                    'title_ar' => $data->translations[0]->title,
                    'title_en' => $data->translations[1]->title,
                ]);
            endif;
        endif; // Check If Request Ajax
    }

}
