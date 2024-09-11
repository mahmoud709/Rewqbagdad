<?php


namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\AfkarFakar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AfkarFakarTranslation;

class AfkarFakarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('authadmin:profile_edit')->only('profile', 'UpdateProfile');
        
        $this->middleware('permission:read-afakar')->only('json','index');
        $this->middleware('permission:create-afakar')->only('create','store');
        $this->middleware('permission:edit-afakar')->only('edit', 'update');
        $this->middleware('permission:delete-afakar')->only('destroy');
    }

    public function json()
    {
        $query = AfkarFakar::with('translation')->get();

        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    public function index()
    { 
  
        return view('admin.bodcasts.afkar_fakar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        return view('admin.bodcasts.afkar_fakar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
       
        $request->validate([
            'img'       => 'required',
            'video_url' => ['required', 'regex:/^(https?:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+/'],
            'name'      => 'required|array',
            'name.*'    => 'required|string',
            'description'      => 'required|array',
            'description.*'    => 'required|string'
        ]);

        try {

            DB::BeginTransaction();

            $afkar = AfkarFakar::create([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                AfkarFakarTranslation::create([
                    'name'      => $request->name[$key],
                    'description'      => $request->description[$key],
                    'afkar_fakar_id'  => $afkar->id,
                    'locale'    => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }
        return redirect()->route('afkar-fakar.index')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = AfkarFakar::findOrFail($id);

        return view('admin.bodcasts.afkar_fakar.edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
             
        $request->validate([
            'img'       => 'required',
            'video_url' => ['required', 'regex:/^(https?:\/\/)?(www\.youtube\.com|youtu\.?be)\/.+/'],
            'name'      => 'required|array',
            'name.*'    => 'required|string'
        ]);

        $afkar = AfkarFakar::findOrFail($id);

        try {

            DB::BeginTransaction();

            $afkar->update([
                'img'       => $request->img,
                'video_url' => $request->video_url,
            ]);
    
            foreach($request->name as $key => $item) {
                
                $afkarFakarTranslation = AfkarFakarTranslation::
                where(['locale' => $key, 'afkar_fakar_id' => $afkar->id])
                ->first();

                $afkarFakarTranslation->update([

                    'name'              => $request->name[$key],
                    'description'       => $request->description[$key],
                    'afkar_fakar_id'    => $afkar->id,
                    'locale'            => $key,
                ]);
            }

            DB::commit();

        } catch(Exception $e)
        {
            DB::rollBack();

            throw $e;
        }

        return redirect()->route('afkar-fakar.index')->with('success', __('global.alert_done_update'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\konVideo  $konVideo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $afkar = AfkarFakar::findOrFail($id);

        $afkar->delete();

        return redirect()->route('afkar-fakar.index')->with('success', __('global.alert_done_delete'));
    }
}
