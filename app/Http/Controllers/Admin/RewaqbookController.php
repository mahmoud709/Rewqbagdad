<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Rewaqbook;
use App\Models\RewaqbookTranslation;
use Illuminate\Http\Request;

class RewaqbookController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:rewaqbook_show')->only('json','index');
        // $this->middleware('authadmin:rewaqbook_create')->only('create','store');
        // $this->middleware('authadmin:rewaqbook_edit')->only('edit', 'update');
        // $this->middleware('authadmin:rewaqbook_delete')->only('destroy');

        
        $this->middleware('permission:read-RewaqBooks')->only('json','index');
        $this->middleware('permission:create-RewaqBooks')->only('create','store');
        $this->middleware('permission:edit-RewaqBooks')->only('edit', 'update');
        $this->middleware('permission:delete-RewaqBooks ')->only('destroy');
    }

    public function json()
    {
        $query = Rewaqbook::select("*")->with('translation:title,parent_id')->get();
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
        return view('admin.rewaq.book.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rewaq.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRewaqbookRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'index_url'     => 'required|string|max:255',
            'promo_url'     => 'nullable|string|max:255',
            'slug'   => 'required|string|max:100|unique:rewaqbooks',
            'img'       => 'required|string|max:255',
            'created_at'  => 'required|date',
            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',
            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
       
        $row = new Rewaqbook;
        $row->index_url = $request->index_url;
        $row->promo_url = $request->promo_url;
        $row->slug = $request->slug;
        $row->img = $request->img;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->title as $key => $name) :
            $trans = new RewaqbookTranslation;
            $trans->locale = $key;
            $trans->title = $request->title[$key];
            $trans->description = $request->description[$key];
            $trans->content = $request->content[$key];
            $trans->parent_id = $row->id;
            $trans->tags = implode(',',tagify_to_array($request->tags[$key]));
            $trans->save();

            if($key== env('NEWSLETTERS', 'ar') ):
                $slug = url('rewaq/book/'.$request->slug);
                SendMailFromCreate($request->content[$key], $request->title[$key], $request->img, $slug);
            endif;

        endforeach;
        return redirect('/admin/rewaq-books')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rewaqbook  $rewaqbook
     * @return \Illuminate\Http\Response
     */
    public function show(Rewaqbook $rewaqbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rewaqbook  $rewaqbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Rewaqbook $rewaqBook)
    {
        $row = Rewaqbook::where('id',$rewaqBook->id)->with('translation','translations')->first();
        return view('admin.rewaq.book.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRewaqbookRequest  $request
     * @param  \App\Models\Rewaqbook  $rewaqbook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rewaqbook $rewaqBook)
    {
        $validatedData = $request->validate([
            'index_url'     => 'required|string|max:255',
            'promo_url'     => 'nullable|string|max:255',
            'slug'          => 'required|string|max:100|unique:rewaqbooks,slug,'.$rewaqBook->id,
            'img'       => 'required|string|max:255',
            'created_at'  => 'required|date',
            'tags' => 'nullable|array',

            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            'description' => 'required|array',
            'description.*' => 'required|string|max:255',
            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        Rewaqbook::where('id',$rewaqBook->id)->update([
            'index_url' => $request->index_url,
            'promo_url'     => $request->promo_url,
            'slug'      => $request->slug,
            'img'           => $request->img,
            'created_at'    => $request->created_at,
        ]);
        foreach (SupportedKeys() as $key) :
            RewaqbookTranslation::where(['parent_id'=>$rewaqBook->id,'locale'=>$key])
            ->update([
                'title' => $request->title[$key],
                'content' => $request->content[$key],
                'description' => $request->description[$key],
                'tags' => implode(',',tagify_to_array($request->tags[$key])),
            ]);
        endforeach;
        return redirect('/admin/rewaq-books')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rewaqbook  $rewaqbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rewaqbook $rewaqBook)
    {
        $rewaqBook->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
