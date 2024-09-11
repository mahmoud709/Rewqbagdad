<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Iraqmeter;
use App\Models\IraqmeterTranslation;
use Illuminate\Http\Request;

class IraqmeterController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read-iraqMeter')->only('json','index');
        $this->middleware('permission:create-iraqMeter')->only('create','store');
        $this->middleware('permission:edit-iraqMeter')->only('edit', 'update');
        $this->middleware('permission:delete-iraqMeter')->only('destroy');
    }
    
    public function json()
    {
        $query = Iraqmeter::select("*")->with('translation:title,parent_id')->get();
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
        return view('admin.iraq-meter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.iraq-meter.create');
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
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new Iraqmeter;
        $row->slug = $request->slug;
        $row->img = $request->img;
        $row->news_img = $request->news_img;
        $row->promo_url = $request->promo_url;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new IraqmeterTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->description = $request->description[$key];
            $trans->content = $request->content[$key];
            $trans->parent_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

            if($key== env('NEWSLETTERS', 'ar') ):
                $slug = url('iraq-meter/'.$request->slug);
                SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            endif;
        endforeach;
        return redirect('/admin/iraq-meter')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Iraqmeter  $iraqmeter
     * @return \Illuminate\Http\Response
     */
    public function show(Iraqmeter $iraqmeter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Iraqmeter  $iraqmeter
     * @return \Illuminate\Http\Response
     */
    public function edit(Iraqmeter $iraqMeter)
    {
        $row = Iraqmeter::where('id',$iraqMeter->id)->with('translation','translations')->first();
        return view('admin.iraq-meter.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Iraqmeter  $iraqmeter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Iraqmeter $iraqMeter)
    {
        // return $request;
        $validatedData = $request->validate([
            'slug'   => 'required|string|max:100|unique:iraqmeters,slug,'.$iraqMeter->id,
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        Iraqmeter::where('id',$iraqMeter->id)->update([
            'slug'      => $request->slug,
            'img'        => $request->img,
            'news_img'   => $request->news_img,
            'promo_url'   => $request->index_url,
            'created_at' => $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            IraqmeterTranslation::where(['parent_id'=>$iraqMeter->id,'locale'=>$key])
            ->update([
                'title'         => $request->title[$key],
                'content'       => $request->content[$key],
                'description'   => $request->description[$key],
                'tags'          => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect('/admin/iraq-meter')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Iraqmeter  $iraqmeter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Iraqmeter $iraqMeter)
    {
        $iraqMeter->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
