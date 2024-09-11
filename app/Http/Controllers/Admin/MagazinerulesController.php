<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Magazinerules;
use App\Models\MagazinerulesTranslation;
use Illuminate\Http\Request;

class MagazinerulesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('authadmin:magazinerules_edit')->only('edit', 'update');
        $this->middleware('permission:edit-rewaqMagazineRules ')->only('edit', 'update');
    }
    
    public function edit()
    {
        $row = Magazinerules::where('id',1)->with('translations')->first();
        return view('admin.magazine.publish-rule', compact('row'));
    }

    
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        foreach (SupportedKeys() as $key) :
            MagazinerulesTranslation::where(['parent_id'=>1,'locale'=>$key])
            ->update([
                'content' => $request->content[$key],
            ]);
        endforeach;
        return back()->with('success', __('global.alert_done_update'));
    }
}
