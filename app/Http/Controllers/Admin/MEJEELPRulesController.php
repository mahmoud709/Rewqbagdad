<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MEJEELP;
use App\Models\MEJEELPTransalation;

use App\Models\MEJEELPTeam;
use App\Models\MEJEELPTranslation;

use App\Models\MEJEELPblog;
use App\Models\MEJEELPblogTranslation;

use App\Models\MEJEELPRule;
use App\Models\MEJEELPRuleTranslation;


class MEJEELPRulesController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:edit-MEJEELPMagazinerule')->only('edit', 'update');
    }
    
    public function edit()
    {
        $row = MEJEELPRule::where('id',1)->with('translations')->first();
        return view('admin.MEJEELP_magazine.publish-rule', compact('row'));
    }

    
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        foreach (SupportedKeys() as $key) :
            MEJEELPRuleTranslation::where(['parent_id'=>1,'locale'=>$key])
            ->update([
                'content' => $request->content[$key],
            ]);
        endforeach;
        return back()->with('success', __('global.alert_done_update'));
    }
}