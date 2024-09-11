<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Magazineblog;
use App\Models\MagazineblogTranslation;
use Illuminate\Http\Request;

class MagazineblogController extends Controller
{

    public function __construct()
    {
        // $this->middleware('authadmin:magazineblog_show')->only('json','index');
        // $this->middleware('authadmin:magazineblog_create')->only('create','store');
        // $this->middleware('authadmin:magazineblog_edit')->only('edit', 'update');
        // $this->middleware('authadmin:magazineblog_delete')->only('destroy');

        $this->middleware('permission:read-magazineblog')->only('json','index');
        $this->middleware('permission:create-magazineblog')->only('create','store');
        $this->middleware('permission:edit-magazineblog')->only('edit', 'update');
        $this->middleware('permission:delete-magazineblog')->only('destroy');
    }

    public function json()
    {
        $query = Magazineblog::select('id','slug','created_at')->with('translation:title,parent_id')->get();
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
        return view('admin.magazine.blog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.magazine.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMagazineblogRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'img'       => 'required|string|max:255',
            'pdf'       => 'required|string|max:255',
            'slug'   => 'required|string|max:100|unique:magazineblogs',
            'promo_url'     => 'nullable|url|string|max:255',
            'number'     => 'required|integer|max:999999999',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'writer' => 'required|array',
            'writer.*' => 'required|string|max:100',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',

            'title_1' => 'nullable|array',
            'title_1.*' => 'nullable|string|max:200',
            'content_1' => 'nullable|array',
            'content_1.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_2' => 'nullable|array',
            'title_2.*' => 'nullable|string|max:200',
            'content_2' => 'nullable|array',
            'content_2.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_3' => 'nullable|array',
            'title_3.*' => 'nullable|string|max:200',
            'content_3' => 'nullable|array',
            'content_3.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_4' => 'nullable|array',
            'title_4.*' => 'nullable|string|max:200',
            'content_4' => 'nullable|array',
            'content_4.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_5' => 'nullable|array',
            'title_5.*' => 'nullable|string|max:200',
            'content_5' => 'nullable|array',
            'content_5.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_6' => 'nullable|array',
            'title_6.*' => 'nullable|string|max:200',
            'content_6' => 'nullable|array',
            'content_6.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_7' => 'nullable|array',
            'title_7.*' => 'nullable|string|max:200',
            'content_7' => 'nullable|array',
            'content_7.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_8' => 'nullable|array',
            'title_8.*' => 'nullable|string|max:200',
            'content_8' => 'nullable|array',
            'content_8.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_9' => 'nullable|array',
            'title_9.*' => 'nullable|string|max:200',
            'content_9' => 'nullable|array',
            'content_9.*' => 'nullable|string',
            ////////////////////////////////////////////
        ]);

        $row = new Magazineblog;
        $row->img = $request->img;
        $row->pdf = $request->pdf;
        $row->slug = $request->slug;
        $row->promo_url = $request->promo_url;
        $row->number = $request->number;
        $row->created_at = $request->created_at;
        $row->save();

        foreach ($request->title as $key => $name) :
            $trans = new MagazineblogTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->writer = $request->writer[$key];
            $trans->description = $request->description[$key];
            $trans->content = $request->content[$key];
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->parent_id = $row->id;
            $trans->title_1 = $request->title_1[$key];
            $trans->content_1 = $request->content_1[$key];
            $trans->title_2 = $request->title_2[$key];
            $trans->content_2 = $request->content_2[$key];
            $trans->title_3 = $request->title_3[$key];
            $trans->content_3 = $request->content_3[$key];
            $trans->title_4 = $request->title_4[$key];
            $trans->content_4 = $request->content_4[$key];
            $trans->title_5 = $request->title_5[$key];
            $trans->content_5 = $request->content_5[$key];
            $trans->title_6 = $request->title_6[$key];
            $trans->content_6 = $request->content_6[$key];
            $trans->title_7 = $request->title_7[$key];
            $trans->content_7 = $request->content_7[$key];
            $trans->title_8 = $request->title_8[$key];
            $trans->content_8 = $request->content_8[$key];
            $trans->title_9 = $request->title_9[$key];
            $trans->content_9 = $request->content_9[$key];
            $trans->save();

            if($key== env('NEWSLETTERS', 'ar') ):
                $slug = url('magazine/blog/'.$request->slug);
                SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            endif;
        endforeach;
        return redirect('/admin/magazine-blog')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Magazineblog  $magazineblog
     * @return \Illuminate\Http\Response
     */
    public function show(Magazineblog $magazineblog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Magazineblog  $magazineblog
     * @return \Illuminate\Http\Response
     */
    public function edit(Magazineblog $magazineBlog)
    {
        $row = Magazineblog::where('id',$magazineBlog->id)->with('translation:title,parent_id','translations')->first();
        return view('admin.magazine.blog.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMagazineblogRequest  $request
     * @param  \App\Models\Magazineblog  $magazineblog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Magazineblog $magazineBlog)
    {
        $validatedData = $request->validate([
            'slug'   => 'required|string|max:100|unique:magazineblogs,slug,'.$magazineBlog->id,
            'img'       => 'required|string|max:255',
            'pdf'       => 'required|string|max:255',
            'promo_url'     => 'nullable|url|string|max:255',
            'number'     => 'required|integer|max:999999999',
            'created_at'  => 'required|date',

            'tags' => 'nullable|array',

            'writer' => 'required|array',
            'writer.*' => 'required|string|max:100',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',

            'title_1' => 'nullable|array',
            'title_1.*' => 'nullable|string|max:200',
            'content_1' => 'nullable|array',
            'content_1.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_2' => 'nullable|array',
            'title_2.*' => 'nullable|string|max:200',
            'content_2' => 'nullable|array',
            'content_2.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_3' => 'nullable|array',
            'title_3.*' => 'nullable|string|max:200',
            'content_3' => 'nullable|array',
            'content_3.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_4' => 'nullable|array',
            'title_4.*' => 'nullable|string|max:200',
            'content_4' => 'nullable|array',
            'content_4.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_5' => 'nullable|array',
            'title_5.*' => 'nullable|string|max:200',
            'content_5' => 'nullable|array',
            'content_5.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_6' => 'nullable|array',
            'title_6.*' => 'nullable|string|max:200',
            'content_6' => 'nullable|array',
            'content_6.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_7' => 'nullable|array',
            'title_7.*' => 'nullable|string|max:200',
            'content_7' => 'nullable|array',
            'content_7.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_8' => 'nullable|array',
            'title_8.*' => 'nullable|string|max:200',
            'content_8' => 'nullable|array',
            'content_8.*' => 'nullable|string',
            ////////////////////////////////////////////
            'title_9' => 'nullable|array',
            'title_9.*' => 'nullable|string|max:200',
            'content_9' => 'nullable|array',
            'content_9.*' => 'nullable|string',
            ////////////////////////////////////////////
        ]);
        Magazineblog::where('id',$magazineBlog->id)->update([
            'img' => $request->img,
            'pdf' => $request->pdf,
            'slug'      => $request->slug,
            'promo_url'     => $request->promo_url,
            'number' => $request->number,
            'created_at'    => $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            MagazineblogTranslation::where(['parent_id'=>$magazineBlog->id,'locale'=>$key])
            ->update([
                'tags' => implode(',',tagify_to_array($request->tags[$key])),
                'writer' => $request->writer[$key],
                'title' => $request->title[$key],
                'content' => $request->content[$key],
                'description' => $request->description[$key],
                'title_1' => $request->title_1[$key],
                'content_1' => $request->content_1[$key],
                'title_2' => $request->title_2[$key],
                'content_2' => $request->content_2[$key],
                'title_3' => $request->title_3[$key],
                'content_3' => $request->content_3[$key],
                'title_4' => $request->title_4[$key],
                'content_4' => $request->content_4[$key],
                'title_5' => $request->title_5[$key],
                'content_5' => $request->content_5[$key],
                'title_6' => $request->title_6[$key],
                'content_6' => $request->content_6[$key],
                'title_7' => $request->title_7[$key],
                'content_7' => $request->content_7[$key],
                'title_8' => $request->title_8[$key],
                'content_8' => $request->content_8[$key],
                'title_9' => $request->title_9[$key],
                'content_9' => $request->content_9[$key],
            ]);
        endforeach;
        return redirect('/admin/magazine-blog')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Magazineblog  $magazineblog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Magazineblog $magazineBlog)
    {
        $magazineBlog->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
