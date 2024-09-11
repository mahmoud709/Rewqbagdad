<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\KhetabMagazinerules;
use App\Models\KhetabMagazinerulesTranslation;
use Illuminate\Http\Request;

class KhetabMagazinerulesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:khetab_magazinerules_edit')->only('edit', 'update');
        $this->middleware('permission:edit-khetabmagazinerulesedit')->only('edit', 'update');
    }
    
    public function edit()
    {
        $row = KhetabMagazinerules::where('id',1)->with('translations')->first();
        return view('admin.khetab_magazine.publish-rule', compact('row'));
    }

    
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        foreach (SupportedKeys() as $key) :
            KhetabMagazinerulesTranslation::where(['parent_id'=>1,'locale'=>$key])
            ->update([
                'content' => $request->content[$key],
            ]);
        endforeach;
        return back()->with('success', __('global.alert_done_update'));
    }
}
