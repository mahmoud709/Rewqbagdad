<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SettingTranslation;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read-setting')->only('json','index');

        $this->middleware('permission:edit-setting')->only('edit', 'update');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sc = Setting::where('id', 1)->first();
        $timezone_identifiers = \DateTimeZone::listIdentifiers();
        return view('admin.settings.index', compact('sc','timezone_identifiers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|array',
            'name.*' => 'required|string|max:100',
            'description' => 'required|array',
            'description.*' => 'required|string|max:900',

            'address' => 'required|array',
            'address.*' => 'required|string|max:200',
            
            'work_hours' => 'nullable|array',
            'work_hours.*' => 'nullable|string|max:200',
            
            'nimg_1' => 'nullable|array',
            'nimg_1.*' => 'required|string|max:50',
            'nimg_2' => 'nullable|array',
            'nimg_2.*' => 'required|string|max:50',
            'nimg_3' => 'nullable|array',
            'nimg_3.*' => 'required|string|max:50',
            'nimg_4' => 'nullable|array',
            'nimg_4.*' => 'required|string|max:50',
            'nimg_5' => 'nullable|array',
            'nimg_5.*' => 'required|string|max:50',

            'email' => 'required|email|max:100',
            'contact_email' => 'required|email|max:100',
            'phone' => 'nullable|numeric|digits_between:1,30',
            'logo_header' => 'required|string|max:200',
            'map' => 'required|string|max:900',
            'logo_footer' => 'required|string|max:200',
            'icon' => 'required|string|max:200',
            'facebook'  => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
            'whatsapp'  => 'nullable|url|max:255',
            'telegram'  => 'nullable|url|max:255',
            'tiktok'    => 'nullable|url|max:255',
            'timezone'  => 'required|timezone',

            'img_1'    => 'required|string|max:255',
            'img_2'    => 'required|string|max:255',
            'img_3'    => 'required|string|max:255',
            'img_4'    => 'required|string|max:255',
            'img_5'    => 'required|string|max:255',
            
            'img_1_link'    => 'required|string|max:255',
            'img_2_link'    => 'required|string|max:255',
            'img_3_link'    => 'required|string|max:255',
            'img_4_link'    => 'required|string|max:255',
            'img_5_link'    => 'required|string|max:255',
        ]);
        Setting::where('id', 1)
        ->update([
            'map' => $request->map,
            'email' => $request->email,
            'contact_email' => $request->contact_email,
            'phone' => $request->phone,
            'logo_header' => $request->logo_header,
            'logo_footer' => $request->logo_footer,
            'icon' => $request->icon,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'linkedin' => $request->linkedin,
            'whatsapp' => $request->whatsapp,
            'telegram' => $request->telegram,
            'tiktok' => $request->tiktok,
            'head_code' => $request->head_code,
            'footer_code' => $request->footer_code,

            'img_1' => $request->img_1,
            'img_2' => $request->img_2,
            'img_3' => $request->img_3,
            'img_4' => $request->img_4,
            'img_5' => $request->img_5,
            
            'img_1_link' => $request->img_1_link,
            'img_2_link' => $request->img_2_link,
            'img_3_link' => $request->img_3_link,
            'img_4_link' => $request->img_4_link,
            'img_5_link' => $request->img_5_link,
        ]);
        foreach (SupportedKeys() as $key) :
            SettingTranslation::where(['setting_id'=>1,'locale'=>$key])
            ->update([
                'name'          => $request->name[$key],
                'description'   => $request->description[$key],
                'address'       => $request->address[$key],
                'work_hours'    => $request->work_hours[$key],
                'img_1'    => $request->nimg_1[$key],
                'img_2'    => $request->nimg_2[$key],
                'img_3'    => $request->nimg_3[$key],
                'img_4'    => $request->nimg_4[$key],
                'img_5'    => $request->nimg_5[$key],
            ]);
        endforeach;
        set_timezone($request->timezone);
        set_app_name($request->name['en']);
        return back()->with('success',  __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
