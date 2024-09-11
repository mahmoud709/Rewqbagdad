<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Medianews;
use App\Models\MedianewsTranslation;



class KonMediaController extends Controller
{
    public function __construct()
    {
            $this->middleware('permission:read-konMedia')->only('json','index');
            $this->middleware('permission:create-konMedia')->only('create','store');
            $this->middleware('permission:edit-konMedia')->only('edit', 'update');
            $this->middleware('permission:delete-konMedia')->only('destroy');
    }

    public function json()
    {
        $query = Medianews::select("*")->with('translation:title,medianews_id')->where('kon' , 'on')->get();
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
        return view('admin.kon.news.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kon.news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMedianewsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'slug'   => 'required|string|max:100|unique:medianews',
            'img'       => 'required|string|max:255',
            'thum_img'       => 'required|string|max:255',
            'slider_img'       => 'required|string|max:255',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new Medianews;
        $row->slug = $request->slug;
        $row->img = $request->img;
        $row->thum_img = $request->thum_img;
        $row->kon = 'on';
        $row->slider_img = $request->slider_img;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new MedianewsTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->description = $request->description[$key];
            $trans->content = $request->content[$key];
            $trans->medianews_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

            if($key== env('NEWSLETTERS', 'ar') ):
                $slug = url('media/news/'.$request->slug);
                SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            endif;

        endforeach;
        return redirect('/admin/kon-news')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medianews  $medianews
     * @return \Illuminate\Http\Response
     */
    public function show(Medianews $medianews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medianews  $medianews
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Medianews::where('id',$id)->with('translation','translations')->first();
        // return $id;
        return view('admin.kon.news.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMedianewsRequest  $request
     * @param  \App\Models\Medianews  $medianews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'slug'   => 'required|string|max:100|unique:medianews,slug,'.$id,
            'img'       => 'required|string|max:255',
            'thum_img'       => 'required|string|max:255',
            'slider_img'       => 'required|string|max:255',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        Medianews::where('id',$id)->update([
            'slug'      => $request->slug,
            'img'       => $request->img,
            'thum_img'  => $request->thum_img,
            'slider_img'=> $request->slider_img,
            'created_at'=> $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            MedianewsTranslation::where(['medianews_id'=>$id,'locale'=>$key])
            ->update([
                'title'         => $request->title[$key],
                'content'       => $request->content[$key],
                'description'   => $request->description[$key],
                'tags'          => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect('/admin/kon-news')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medianews  $medianews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Medianews::where('id',$id)->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
