<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\About;
use App\Models\AboutTranslation;
use App\Models\AboutData;
use Illuminate\Http\Request;

class AboutController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read-about');
        $this->middleware('permission:update-about');
    }
    
    public function index()
    {   

        $row = About::with('translations','alltargets','allvisions','allmeans','ourMessage')->first();
        return view('admin.about.index', compact('row'));
    }
    
    public function update(Request $request)
    {
        
     
        $validatedData = $request->validate([
            'img1' => 'required|string|max:200',
            'img2' => 'required|string|max:200',
            
            'description' => 'array',
            'description.*' => 'required|string',
            
            'target_ar' => 'array',
            'target_ar.*' => 'required|max:255',
            'target_en' => 'array',
            'target_en.*' => 'required|max:255',

          
            'vision_ar' => 'required|max:255',

            'vision_en' => 'required|max:255',
          
            'message_ar' => 'required|max:255',

            'message_en' => 'required|max:255',
            
            'means_ar' => 'array',
            'means_ar.*' => 'required|string|max:255',
            'means_en' => 'array',
            'means_en.*' => 'required|string|max:255',
        ]);

        $id = 1;
        About::where('id',$id)->update([
            'img1' => $request->img1,
            'img2' => $request->img2,
        ]);

        AboutTranslation::where(['locale'=>'ar'])->update([
            'description' => $request->description['ar'],
        ]);
        AboutTranslation::where(['locale'=>'en'])->update([
            'description' => $request->description['en'],
        ]);
        

        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            AboutData::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($request->target_ar['content_ar'] as $index => $target) :
            $tar = new AboutData;
            $tar->type = 'targets';
            $tar->content_ar = $request->target_ar['content_ar'][$index];
            $tar->content_en = $request->target_en['content_en'][$index];
            $tar->name_ar = $request->target_ar['name_ar'][$index];
            $tar->name_en = $request->target_en['name_en'][$index];
            $tar->about_id = $id;
            $tar->save();
        endforeach;


            AboutData::firstOrCreate(['type' => 'vision'], [
                'content_ar' =>  $request->vision_ar,
                'content_en' =>  $request->vision_en,
                'type'        => 'vision',
                'about_id'      => $id
            ]);

            AboutData::firstOrCreate(['type' => 'our_message'], [
                'content_ar' =>  $request->message_ar,
                'content_en' =>  $request->message_en,
                'type'        => 'our_message',
                'about_id'      => $id
            ]);
        
        foreach ($request->means_ar as $meanKey => $means) :
            $mean = new AboutData;
            $mean->type = 'means';
            $mean->content_ar = $request->means_ar[$meanKey];
            $mean->content_en = $request->means_en[$meanKey];
            $mean->about_id = $id;
            $mean->save();
        endforeach;
        
        return back()->with('success', __('global.alert_done_update'));
    }

    
}
