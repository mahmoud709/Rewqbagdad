<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\MedadInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\MedadInfoTranslation;

class MedadInfoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:edit-Medadinfo')->only('edit', 'update');
    }

    public function edit()
    {
        $row = MedadInfo::with('translations')->first();

        return view('admin.version.editInfo.edit', compact('row'));
    }

    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'contact_email' => 'required|email|string|max:50',
            'img' => 'required|string|max:255',
            'project_manager_photo' => 'required|string|max:255',
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
            'project_manager' => 'required|array',
            'project_manager.*' => 'required|string',
        ]);
        try {

            DB::beginTransaction();
            $medadInfo = MedadInfo::first();
            $id = $medadInfo->id;
            if ($medadInfo) {
        
                $medadInfo = $medadInfo->update([
                    'img' => $request->img,
                    'contact_email' => $request->contact_email,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'linkedin' => $request->linkedin,
                    'whatsapp' => $request->whatsapp,
                    'telegram' => $request->telegram,
                    'tiktok' => $request->tiktok,
                    'proejct_manager_img' => $request->project_manager_photo,
                ]);
               
            } else {

                $medadInfo = MedadInfo::create([
                    'img' => $request->img,
                    'contact_email' => $request->contact_email,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'linkedin' => $request->linkedin,
                    'whatsapp' => $request->whatsapp,
                    'telegram' => $request->telegram,
                    'tiktok' => $request->tiktok,
                    'project_manager_photo' => $request->project_manager_photo,
                ]);
                $id = $medadInfo->id;
            }
        
    
            foreach (SupportedKeys() as $key) :
                MedadInfoTranslation::where(['parent_id'=>$id ,'locale'=>$key])
                ->update([
                    'content' => $request->content[$key],
                    'project_manager' => $request->project_manager[$key],
                ]);
            endforeach;
            DB::commit();
        } catch (Exception $e)  {
            DB::rollback();

            throw $e;
        }


        return back()->with('success', __('global.alert_done_update'));

    }
}