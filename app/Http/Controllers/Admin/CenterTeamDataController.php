<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Models\CenterTeamData;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\CenterTeamDataTranslation;

class CenterTeamDataController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:edit-headofcenter')->only('edit', 'update');
    }

    public function edit()
    {
        $row = CenterTeamData::with('translations')->first();

        return view('admin.about.wordheadofteam',compact('row'));
    }

    public function update(Request $request)
    {   
        $request->validate([
            'photo'     => 'required',
            'content'   => 'required|array',
            'content.*' => 'required|string',
        ]);
     
        $row = CenterTeamData::with('translations')->first();

       try {

        DB::beginTransaction();

        if($request->photo) {

            $row->update([
                'photo' => $request->photo,
            ]);
        }
      
        foreach($request->content as $key => $val)
        {
            CenterTeamDataTranslation::where('locale',$key)->where('center_team_data_id', $row->id)
            ->update([
                'content' => $request->content[$key],
                'center_team_data_id' => $row->id,
            ]);
        }

        DB::commit();

        return back()->with('success', __('global.alert_done_update'));

       } catch (Exception $e) {
        DB::rollback();
        
        // and throw the error again.
        throw $e;
       }
  

    }
}
