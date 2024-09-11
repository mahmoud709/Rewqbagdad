<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Versioncategory;
use App\Models\Version;
use App\Models\VersionTranslation;
use App\Models\Bookteam;
use Illuminate\Http\Request;

class VersionController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:version_show')->only('json','index');
        // $this->middleware('authadmin:version_create')->only('create','store');
        // $this->middleware('authadmin:version_edit')->only('edit', 'update');
        // $this->middleware('authadmin:version_delete')->only('destroy');

        $this->middleware('permission:read-versionNews')->only('json','index');
        $this->middleware('permission:create-versionNews')->only('create','store');
        $this->middleware('permission:edit-versionNews')->only('edit', 'update');
        $this->middleware('permission:delete-versionNews')->only('destroy');

        
    }

    public function json()
    {
        $selected = ['id','category_id','writer_id','slug','created_at'];
        $query = Version::select($selected)->with('translation:title,version_id','category:name,category_id','writer:name,bookteam_id')->get();
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
        return view('admin.version.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Versioncategory::with('translation:name,category_id')->get();
        $writers = Bookteam::select('id')->with('translation:name,bookteam_id')->get();
        return view('admin.version.create', compact('cats','writers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVersionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id'     => 'required|integer|exists:versioncategories,id',
            'writer_id'     => 'required|integer|exists:bookteams,id',
            'slug'   => 'required|string|max:100|unique:versions',
            'img'       => 'required|string|max:255',
            'news_img'       => 'required|string|max:255',
            'pdf'       => 'required|string|max:255',
            'tags' => 'nullable|array',
            'created_at'  => 'required|date',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new Version;
        $row->category_id = $request->category_id;
        $row->writer_id = $request->writer_id;
        $row->slug = $request->slug;
        $row->pdf = $request->pdf;
        $row->img = $request->img;
        $row->news_img = $request->news_img;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new VersionTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->description = $request->description[$key];
            $trans->content = $request->content[$key];
            $trans->version_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

            if($key== env('NEWSLETTERS', 'ar') ):
                $slug = url('version/'.$request->slug);
                SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            endif;

        endforeach;
        return redirect('/admin/versions')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function show(Version $version)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function edit(Version $version)
    {
        $row = Version::where('id',$version->id)->with('translation','translations')->first();
        $cats = Versioncategory::with('translation:name,category_id')->get();
        $writers = Bookteam::select('id')->with('translation:name,bookteam_id')->get();
        return view('admin.version.edit', compact('row','cats','writers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVersionRequest  $request
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Version $version)
    {
        $validatedData = $request->validate([
            'category_id'     => 'required|integer|exists:versioncategories,id',
            'writer_id'     => 'required|integer|exists:bookteams,id',
            'slug'          => 'required|string|max:100|unique:versions,slug,'.$version->id,
            'img'           => 'required|string|max:255',
            'news_img'           => 'required|string|max:255',
            'pdf'           => 'required|string|max:255',
            'created_at'  => 'required|date',
            
            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',

            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        Version::where('id',$version->id)->update([
            'category_id' => $request->category_id,
            'writer_id'     => $request->writer_id,
            'slug'      => $request->slug,
            'pdf'       => $request->pdf,
            'img'           => $request->img,
            'news_img'           => $request->news_img,
            'created_at'    => $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            VersionTranslation::where(['version_id'=>$version->id,'locale'=>$key])
            ->update([
                'title' => $request->title[$key],
                'content' => $request->content[$key],
                'description' => $request->description[$key],
                'tags' => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect('/admin/versions')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Version  $version
     * @return \Illuminate\Http\Response
     */
    public function destroy(Version $version)
    {
        $version->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
