<?php

namespace App\Http\Controllers\Admin;
use App\Models\EtmamNews;


use Illuminate\Http\Request;
use App\Models\Etmamcategory;
use App\Http\Controllers\Controller;
use App\Models\EtmamNewsTranslation;

class EtmamNewsController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:activity_show')->only('json','index');
        // $this->middleware('authadmin:activity_create')->only('create','store');
        // $this->middleware('authadmin:activity_edit')->only('edit', 'update');
        // $this->middleware('authadmin:activity_delete')->only('destroy');
                      
        $this->middleware('permission:read-etmamNews')->only('json','index');
        $this->middleware('permission:create-etmamNews')->only('create','store');
        $this->middleware('permission:edit-etmamNews')->only('edit', 'update');
        $this->middleware('permission:delete-etmamNews')->only('destroy');

    }

    public function json()
    {
        $query = EtmamNews::with('translation:title,etmam_id','category:name,category_id')->get();
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
        return view('admin.etmam.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Etmamcategory::with('translation:name,category_id')->get();
        return view('admin.etmam.create', compact('cats'));
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
            'category_id'     => 'required|integer|exists:etmamcategories,id',
            'slug'   => 'required|string|max:100|unique:etmam_news',
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'url'       => 'nullable|url|max:255',

            'tags' => 'nullable|array',
            'created_at'  => 'required|date',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new EtmamNews;
        $row->category_id = $request->category_id;
        $row->slug = $request->slug;
        $row->url = $request->url;
        $row->img = $request->img;
        $row->news_img = $request->news_img;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new EtmamNewsTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->content = $request->content[$key];
            $trans->description = $request->description[$key];
            $trans->etmam_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

            // if($key== env('NEWSLETTERS', 'ar') ):
            //     $slug = url('activity/'.$request->slug);
            //     SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            // endif;

        endforeach;
        return redirect('/admin/etmam-news')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = EtmamNews::where('id',$id)->with('translation','translations')->first();
        $cats = Etmamcategory::with('translation:name,category_id')->get();
        return view('admin.etmam.edit', compact('row','cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category_id'     => 'required|integer|exists:etmamcategories,id',
            'slug'   => 'required|string|max:100|unique:etmam_news,slug,'.$id,
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'created_at'  => 'required|date',
            'url'       => 'nullable|url|max:255',

            'tags' => 'nullable|array',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        EtmamNews::where('id',$id)->update([
            'category_id' => $request->category_id,
            'slug'      => $request->slug,
            'url'      => $request->url,
            'img'           => $request->img,
            'news_img'           => $request->news_img,
            'created_at'    => $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            EtmamNewsTranslation::where(['etmam_id'=>$id,'locale'=>$key])
            ->update([
                'title' => $request->title[$key],
                'content' => $request->content[$key],
                'description' => $request->description[$key],
                'tags' => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect('/admin/etmam-news')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etmamNews = EtmamNews::findOrFail($id);

        $etmamNews->delete();

        return back()->with('success', __('global.alert_done_delete'));
    }
}
