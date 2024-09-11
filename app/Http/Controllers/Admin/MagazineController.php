<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Magazine;
use App\Models\MagazineTranslation;
use App\Models\Magazineteam;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    
    public function __construct()
    {
        // $this->middleware('authadmin:magazine_edit')->only('edit', 'update');
        
        $this->middleware('permission:edit-MagazineInfo')->only('edit', 'update');
    }

    public function edit()
    {
        $teams = Magazineteam::select('id')->with('translation:name,parent_id,job_title')->get();
        
        $row = Magazine::with('translations')->first();

        return view('admin.magazine.edit', compact('row','teams'));
    }

    public function update(Request $request)
    {
    
       $validatedData = $request->validate([
            'contact_email' => 'required|email|string|max:50',
            'img' => 'required|string|max:255',

            'team_ids' => "required|array",
            'team_ids.*' => "nullable|exists:magazineteams,id",

            'facebook'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'whatsapp'  => 'nullable|url|max:255',
            'telegram'  => 'nullable|url|max:255',
            'tiktok'    => 'nullable|url|max:255',

            'content' => 'required|array',
            'content.*' => 'required|string',
        ]);

        $teams_id = $validatedData['team_ids'];

        $teams_id = array_filter($teams_id, function ($element) {
            return $element !== null;
        });

        $teams_id = array_values($teams_id);

        $teams_id = json_encode($teams_id);

        Magazine::where('id', 1)->update([
            'img' => $request->img,
            'contact_email' => $request->contact_email,
            'team_ids' => $teams_id,
            'facebook'  => $request->facebook,
            'twitter'   => $request->twitter,
            'instagram' => $request->instagram,
            'youtube'   => $request->youtube,
            'linkedin'  => $request->linkedin,
            'whatsapp'  => $request->whatsapp,
            'telegram'  => $request->telegram,
            'tiktok'    => $request->tiktok,
        ]);
        foreach (SupportedKeys() as $key) :
            MagazineTranslation::where(['parent_id'=>1,'locale'=>$key])
            ->update([
                'content' => $request->content[$key],
            ]);
        endforeach;
        return back()->with('success', __('global.alert_done_update'));
    }

}
