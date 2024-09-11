<?php

namespace App\Http\Controllers\Admin;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FaqTranslations;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:read-faqs')->only('json','index');
        $this->middleware('permission:create-faqs')->only('create','store');
        $this->middleware('permission:edit-faqs')->only('edit', 'update');
        $this->middleware('permission:delete-faqs')->only('destroy');
    }

    public function json()
    {
        $query = Faq::with('translation')->get();
        return datatables($query)
        ->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->editColumn('translation.question', function ($row) {
            return strip_tags(html_entity_decode($row->translation->question));
        })->editColumn('translation.answer', function ($row) {
            return strip_tags(html_entity_decode($row->translation->answer));
        })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
 
        return view('admin.faq.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.faq.create');
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

            'question'  => 'required|array',
            'question.*' => 'required|string|',
            
            'answer'  => 'required|array',
            'answer.*' => 'required|string',
        ]);
        $faq = new Faq;
        $faq->save();
        foreach ($request->question as $key => $name) :
            $trans = new FaqTranslations();
            $trans->locale = $key;
            $trans->question = $request->question[$key];
            $trans->answer = $request->answer[$key];
            $trans->parent_id = $faq->id;
            $trans->save();
        endforeach;
        return redirect('/admin/faq')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $faq)
    {
        
        $row = Faq::where('id',$faq->id)->with('translation','translations')->first();
        return view('admin.faq.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([

            'question'  => 'required|array',
            'question.*' => 'required|string',
            
            'answer'  => 'required|array',
            'answer.*' => 'required|string',
        ]);
        Faq::where('id',$faq->id)->first();
        foreach (SupportedKeys() as $key) :
            FaqTranslations::where(['parent_id'=>$faq->id,'locale'=>$key])
            ->update([
                'question' => $request->question[$key],
                'answer' => $request->answer[$key],
            ]);
        endforeach;
        return redirect('/admin/faq')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faq  $faq
     * @return \Illuminate\Http\Response
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
