<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Electronicservice;
use App\Models\ElectronicserviceTranslation;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;

class ElectronicController extends Controller
{
    public function RequestInvitation()
    {
        $data = Electronicservice::where('slug', 'request-invitation')->with('translation')->first();
        return view('front.electronic.request-invitation', compact('data'));
    }
    public function RequestInvitationSendMail(Request $request)
    {
        $validatedData = $request->validate([
            'full_name'  => 'required|string|max:100',
            'email' => 'required|email|string|max:50',
            'phone' => 'required|numeric|digits_between:1,12',
            'governorate' => 'required|string|max:100',
            // 'entity_name' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            // 'job_position' => 'required|string|max:100',
            'cv' => 'required|file|mimes:pdf|max:10000',
            'files' => 'required|array',
            'files.*' => 'file|mimes:jpg,png,jpeg,pdf',
        ]);

        $files = [];
        foreach ($request->file('files') as $imagefile) {
            $path = $imagefile->store('/files/shares/forms', ['disk' => 'uploads']);
            $files[] = '/uploads/'.$path;
        }

        $cvFile = $request->file('cv');
        $pathCV = $cvFile->store('/files/shares/forms', ['disk' => 'uploads']);
        $files[] = '/uploads/'.$pathCV;

        $data = Electronicservice::where('slug', 'request-invitation')->with('translation')->first();
        $subject = $data->translation->title;
        Mail::to($data->email)->send(new SendContactMail($request->except('_token','files','cv'), $subject,$files));
        return back()->with('success', __('front.alert_send_contact_main'));
    }
    /*****************************************************/

    public function MembershipRequest()
    {
        $data = Electronicservice::where('slug', 'membership-request')->with('translation')->first();
        return view('front.electronic.membership-request', compact('data'));
    }
    public function MembershipRequestSendMail(Request $request)
    {
        $validatedData = $request->validate([
            'full_name'  => 'required|string|max:100',
            'email' => 'required|email|string|max:50',
            'phone' => 'required|numeric|digits_between:1,12',
            'governorate' => 'required|string|max:100',
            'job_position' => 'required|string|max:100',
            'cv' => 'required|file|mimes:pdf|max:10000',

            'home_adress' => 'required|string|max:100',
            'interests' => 'required|string|max:100',
            'school_studying' => 'required|string|max:100',
            'number_research' => 'required|string|max:100',
            'the_activities' => 'required|string|max:100',
            'years_service' => 'required|string|max:100',
        ]);
        
        $file = [];
        $cvFile = $request->file('cv');
        $path = $cvFile->store('/files/shares/forms', ['disk' => 'uploads']);
        $file[] = '/uploads/'.$path;

        $data = Electronicservice::where('slug', 'membership-request')->with('translation')->first();
        $subject = $data->translation->title;
        Mail::to($data->email)->send(new SendContactMail($request->except('_token','cv'), $subject,$file));
        return back()->with('success', __('front.alert_send_contact_main'));
    }
    /*****************************************************/

    public function RequestHost()
    {
        $data = Electronicservice::where('slug', 'request-host-event')->with('translation')->first();
        return view('front.electronic.request-host-event', compact('data'));
    }
    public function RequestHostSendMail(Request $request)
    {
        $validatedData = $request->validate([
            'full_name'  => 'required|string|max:100',
            'email' => 'required|email|string|max:50',
            'phone' => 'required|numeric|digits_between:1,12',
            'governorate' => 'required|string|max:100',
            'entity_name' => 'required|string|max:100',
            'subject' => 'required|string|max:100',
            'job_position' => 'required|string|max:100',
            // 'cv' => 'required|string|max:200',
            'cv' => 'required|file|mimes:pdf|max:10000',
            
        ]);

        $file = [];
        $cvFile = $request->file('cv');
        $path = $cvFile->store('/files/shares/forms', ['disk' => 'uploads']);
        $file[] = '/uploads/'.$path;
        

        $data = Electronicservice::where('slug', 'request-host-event')->with('translation')->first();
        $subject = $data->translation->title;
        Mail::to($data->email)->send(new SendContactMail($request->except('_token','cv'), $subject,$file));
        return back()->with('success', __('front.alert_send_contact_main'));
    }
    /*****************************************************/

    public function RequestSurvey()
    {
        $data = Electronicservice::where('slug', 'request-survey')->with('translation')->first();
        return view('front.electronic.request-survey', compact('data'));
    }
    public function RequestSurveySendMail(Request $request)
    {
        $validatedData = $request->validate([
            'survey_title'  => 'required|string|max:100',
            'purpose_of_survey' => 'required|string|max:100',
            // 'type' => 'required|in:ذكر,انثى,ذكر و انثى',
            // 'age_range_from'    => 'required|integer|max:100',
            // 'age_range_to'      => 'required|integer|max:100',
            // 'number_of_sample'  => 'required|string|max:50',
            'name'  => 'required|string|max:50',
            'email' => 'required|email|string|max:50',
            'phone' => 'required|numeric|digits_between:1,12',
        ]);
        $data = Electronicservice::where('slug', 'request-survey')->with('translation')->first();
        $subject = $data->translation->title;
        new SendContactMail($request->except('_token'), $subject);
        Mail::to($data->email)->send(new SendContactMail($request->except('_token'), $subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }
    /*****************************************************/

    public function VisitCenter()
    {
        $data = Electronicservice::where('slug', 'visit-center')->with('translation')->first();
        return view('front.electronic.visit-center', compact('data'));
    }
    public function VisitCenterSendMail(Request $request)
    {
        $validatedData = $request->validate([
            'company_name'  => 'required|string|max:50',
            'purpose_visit' => 'required|string|max:100',
            'date_of_visit' => 'required|date',
            'visitor_name'  => 'required|string|max:50',
            'email'         => 'required|email|string|max:50',
            'position'      => 'required|string|max:50',
            'list_visitors' => 'required|string|max:900',
        ]);
        $data = Electronicservice::where('slug', 'visit-center')->with('translation')->first();
        $subject = $data->translation->title;
        new SendContactMail($request->except('_token'), $subject);
        Mail::to($data->email)->send(new SendContactMail($request->except('_token'), $subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }
    /*****************************************************/
}
