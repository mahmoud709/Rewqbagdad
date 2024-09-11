<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\About;
use App\Models\AboutData;
use App\Models\Centerteam;
use App\Models\Bookteam;
use App\Models\Teamsetting;
use App\Models\Setting;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;
use App\Models\CenterTeamData;
use App\Models\Mahawir;

class AboutController extends Controller
{
    public function ContactUs()
    {
        return view('front.about.contact-us');
    }
    public function sendMail(Request $request)
    {
        $validatedData = $request->validate([
            'name'      => 'required|string|max:50',
            'email'     => 'required|email|max:50',
            'phone'     => 'required|numeric|digits_between:1,12',
            'request_type'  => 'required|string|max:50',
            'subject'       => 'required|string|max:50',
            'the_message'   => 'required|string|max:900',
        ]);
        $setting = Setting::select('contact_email')->first();
        $subject = $request->subject;
        Mail::to($setting->contact_email)->send(new SendContactMail($request->except('_token'),$subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }

    public function AboutUs()
    {
        $about = About::with('translation')->first();
        $targets = AboutData::where('type','targets')->get();
        $visions = AboutData::where('type','vision')->get();
        $means = AboutData::where('type','means')->get();
        return view('front.about.index', compact('about', 'targets', 'visions','means'));
    }
    
    public function EmployeeCenter()
    {
        $teamsEMP = Centerteam::where('type','emp')->with('translation')->get();
        $teamsMEM = Centerteam::where('type','mem')->with('translation')->get();
        $teamsCEO = Centerteam::where('type','ceo')->with('translation')->get();
        $teamsCBD = Centerteam::where('type','cbd')->with('translation')->get();
        $setting = Teamsetting::where('slug','center-team')->first();
        $mahawirs = Mahawir::with('translation')->get();
        $headOfcenterWord = CenterTeamData::with('translation')->first();
        return view('front.about.employee-center', compact('setting','teamsEMP','teamsCBD','teamsCEO','teamsMEM','mahawirs','headOfcenterWord'));
    }
    
    public function CenterWriters()
    {
        $writers = Bookteam::with('translation')->get();
        $setting = Teamsetting::where('slug','book-team')->first();
        return view('front.about.writers', compact('setting','writers'));
    }
}
