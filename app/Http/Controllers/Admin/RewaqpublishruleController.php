<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Rewaqpublishrule;
use App\Models\RewaqpublishruleTranslation;
use Illuminate\Http\Request;

class RewaqpublishruleController extends Controller
{

    public function __construct()
    {
        // $this->middleware('authadmin:rewaqpublishrule_edit')->only('edit', 'update');
        $this->middleware('permission:edit-rewaqPublishRule')->only('edit', 'update');
        
    }
    
    public function edit()
    {
        $row = Rewaqpublishrule::where('id',1)->with('translations')->first();
        return view('admin.rewaq.publish-rule', compact('row'));
    }

    
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        foreach (SupportedKeys() as $key) :
            RewaqpublishruleTranslation::where(['parent_id'=>1,'locale'=>$key])
            ->update([
                'content' => $request->content[$key],
            ]);
        endforeach;
        return back()->with('success', __('global.alert_done_update'));
    }

}
