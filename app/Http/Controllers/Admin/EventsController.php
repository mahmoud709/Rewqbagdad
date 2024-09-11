<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Events;
use App\Models\EventsTranslation;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read-events')->only('json','index');
        $this->middleware('permission:create-events')->only('create','store');
        $this->middleware('permission:edit-events')->only('edit', 'update');
        $this->middleware('permission:delete-events')->only('destroy');
    }

    public function json()
    {
        $query = Events::with('translation')->get();
        return datatables($query)
        ->editColumn('created_at', function ($row) {
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
        return view('admin.events.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
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
            'created_at'  => 'required|date',
            'url'   => 'required|string|max:100|unique:events',
            'img'   => 'required|string|max:255',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:150',
            
            'content'  => 'required|array',
            'content.*' => 'required|string',
        ]);
        $row = new Events;
        $row->url = $request->url;
        $row->img = $request->img;
        $row->created_at = $request->created_at;
        $row->save();
        foreach ($request->name as $key => $name) :
            $trans = new EventsTranslation;
            $trans->locale = $key;
            $trans->name = $request->name[$key];
            $trans->content = $request->content[$key];
            $trans->parent_id = $row->id;
            $trans->save();
        endforeach;
        return redirect('/admin/events')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function show(Events $events)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function edit(Events $event)
    {
        $row = Events::where('id',$event->id)->with('translation','translations')->first();
        return view('admin.events.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Events $event)
    {
        $validatedData = $request->validate([
            'created_at'  => 'required|date',
            'url'   => 'required|string|max:100|unique:events,url,'.$event->id,
            'img'   => 'required|string|max:255',

            'name'  => 'required|array',
            'name.*' => 'required|string|max:150',
            
            'content'  => 'required|array',
            'content.*' => 'required|string',
        ]);
        Events::where('id',$event->id)->update([
            'created_at' => $request->created_at,
            'url' => $request->url,
            'img' => $request->img,
        ]);
        foreach (SupportedKeys() as $key) :
            EventsTranslation::where(['parent_id'=>$event->id,'locale'=>$key])
            ->update([
                'name' => $request->name[$key],
                'content' => $request->content[$key],
            ]);
        endforeach;
        return redirect('/admin/events')->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Events  $events
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $event)
    {
        $event->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }
}
