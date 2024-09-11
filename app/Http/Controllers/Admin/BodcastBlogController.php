<?php

namespace App\Http\Controllers\Admin;

use App\Models\BodcastBlog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BodcastBlogTranslation;

class BodcastBlogController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:read-bodcastBlog')->only('json','index');
        $this->middleware('permission:create-bodcastBlog')->only('create','store');
        $this->middleware('permission:edit-bodcastBlog')->only('edit', 'update');
        $this->middleware('permission:delete-bodcastBlog')->only('destroy');
    }

    public function json()
    {
        $query = BodcastBlog::select("*")->with('translation:title,bodcast_blog_id')->get();
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
        return view('admin.bodcasts.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bodcasts.blog.create');
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
            'pdf'       => 'required|string|max:255',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new BodcastBlog;
        $row->slug = $request->slug;
        $row->img = $request->img;
        $row->pdf = $request->pdf;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new BodcastBlogTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->description = $request->description[$key];
            $trans->content = $request->content[$key];
            $trans->bodcast_blog_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

        endforeach;
        return redirect()->route('bodcast-blog.index')->with('success', __('global.alert_done_create'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medianews  $medianews
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = BodcastBlog::where('id',$id)->with('translation','translations')->first();

        return view('admin.bodcasts.blog.edit',  compact('row'));
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
            'slug'   => "required|string|max:100|unique:bodcast_blogs,id,$id",
            'img'       => 'required|string|max:255',
            'pdf'       => 'required|string|max:255',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        BodcastBlog::where('id',$id)->update([
            'slug'      => $request->slug,
            'img'       => $request->img,
            'pdf'  => $request->pdf,

            'created_at'=> $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            BodcastBlogTranslation::where(['bodcast_blog_id'=>$id,'locale'=>$key])
            ->update([
                'title'         => $request->title[$key],
                'content'       => $request->content[$key],
                'description'   => $request->description[$key],
                'tags'          => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect()->route('bodcast-blog.index')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medianews  $medianews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bodcastBlog = BodcastBlog::findOrFail($id);

        $bodcastBlog->delete();

        return back()->with('success', __('global.alert_done_delete'));
    }
}
