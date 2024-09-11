<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Mahawir;
use Illuminate\Http\Request;
use App\Models\MahawirTranslation;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MahawirController extends Controller
{
    public function __construct()
    {
            $this->middleware('permission:read-Mahawirs')->only('json','index');
            $this->middleware('permission:create-Mahawirs')->only('create','store');
            $this->middleware('permission:edit-Mahawirs')->only('edit', 'update');
            $this->middleware('permission:delete-Mahawirs')->only('destroy');
    }

    public function json()
    {
        $query = Mahawir::with('translation')->get();
        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    public function index()
    {
        return view("admin.mahawir.index");
    }

    public function create()
    {
        return view('admin.mahawir.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string',
        ]);
        try {
            
            DB::beginTransaction();

            $mahawir = Mahawir::create([
                'photo' => $request->photo,
            ]);
    
            foreach($request->title as $key => $item)
            {
                MahawirTranslation::create([
                    'title'         => $request->title[$key],
                    'description'   => $request->description[$key],
                    'locale'      => $key,
                    'mahawir_id'    => $mahawir->id,
                ]);
            }
            DB::commit();

            return redirect()->route('mahawirs.index')->with('success', __('global.alert_done_create'));

        } catch (Exception $e) {

            DB::rollback();

            throw $e;
        }
   
    }

    public function edit($id)
    {
        $mahawir = Mahawir::with('translations')->findOrFail($id);
        
        return view('admin.mahawir.edit',compact("mahawir"));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'nullable',
            'title' => 'required|array',
            'title.*' => 'required|string|max:200',
            
            'description' => 'required|array',
            'description.*' => 'required|string',
        ]);

        $mahawir = Mahawir::findOrFail($id);

        try {
            
            DB::beginTransaction();
            
            if($request->photo) {

                $mahawir->update([
                    'photo' => $request->photo,
                ]);

            }
    
            foreach (SupportedKeys() as $key) :
                MahawirTranslation::where(['mahawir_id'=>$id,'locale'=>$key])
                ->update([
                    'title'         => $request->title[$key],
                    'description'   => $request->description[$key],
                    'locale'      => $key,
                ]);
            endforeach;
            DB::commit();

            return redirect()->route('mahawirs.index')->with('success', __('global.alert_done_update'));

        } catch (Exception $e) {

            DB::rollback();

            throw $e;
        }
        return $mahawir;
    }

    public function destroy($id)
    {
        $mahawir = Mahawir::findOrFail($id);

        $mahawir->delete();

        return back()->with('success', __('global.alert_done_delete'));
    }
}


