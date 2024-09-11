<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Parliament;
use App\Models\ParliamentTranslation;
use Illuminate\Http\Request;

class ParliamentController extends Controller
{
    public function __construct()
    {
        $this->middleware('authadmin:parliament_edit')->only('edit', 'update');
    }
    
    public function edit()
    {
        $row = Parliament::with('translations')->first();
        return view('admin.parliament.edit', compact('row'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'img' => 'required|string|max:255',
            'img_app' => 'required|string|max:255',
            'google_url' => 'required|string|max:255',
            'apple_url' => 'required|string|max:255',

            'description' => 'required|array',
            'description.*' => 'required|string|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);
        Parliament::where('id', 1)->update([
            'img' => $request->img,
            'img_app' => $request->img_app,
            'google_url' => $request->google_url,
            'apple_url' => $request->apple_url,
        ]);
        foreach (SupportedKeys() as $key) :
            ParliamentTranslation::where(['parent_id'=>1,'locale'=>$key])
            ->update([
                'description' => $request->description[$key],
                'content' => $request->content[$key],
            ]);
        endforeach;
        return back()->with('success', __('global.alert_done_update'));
    }
}
