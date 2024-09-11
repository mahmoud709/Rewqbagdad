<?php

namespace App\Http\Controllers\Front;

use App\Models\MEJEELP;
use App\Models\MEJEELPblog;


use App\Models\MEJEELPRule;
use App\Models\MEJEELPTeam;

use Illuminate\Http\Request;
use App\Mail\SendContactMail;

use App\Models\MEJEELPTranslation;
use App\Models\MEJEELPTransalation;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\MEJEELPblogTranslation;
use App\Models\MEJEELPRuleTranslation;
use Illuminate\Support\Facades\Cookie;

class MEJEELPController extends Controller
{

    public function contact()
    {
        return view('front.magazine.contact-us');
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
        $Magazine = MEJEELP::select('contact_email')->first();
        $subject = $request->subject;
        Mail::to($Magazine->contact_email)->send(new SendContactMail($request->except('_token'),$subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }

    public function PublishRole()
    {
        $data = MEJEELPRule::with('translation')->first();
        return view('front.MEJEELP--magazine.publish-role', compact('data'));
    }

    public function EditorialBoard()
    {
        $teams = MEJEELPTeam::with('translation')->orderBy('sort','ASC')->get();
        return view('front.MEJEELP--magazine.editorial-board', compact('teams'));
    }

    public function index()
    {
        $magazine = MEJEELP::with('translation')->first();
        $team_ids = json_decode($magazine->team_ids);

        $teams = MEJEELPTeam::whereIn('id', $team_ids)
        ->select('id','img')
        ->with('translation:name,job_title,parent_id')
        ->get();
       
        $blogs = MEJEELPblog::with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
        $latestBlogs = MEJEELPblog::select('id','slug','img','created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
        $mostWatched = MEJEELPblog::select('id','slug','views','created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
        return view('front.MEJEELP-magazine.index', compact('magazine','latestBlogs','mostWatched','blogs','teams'));
    }
    
    public function Tag($tag)
    {
        $check = MEJEELPblogTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):
            $ids = $check->pluck('parent_id')->toArray();

            $magazine = MEJEELP::with('translation')->first();
            $cbd = MEJEELPTeam::where('id', $magazine->cbd_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $ec = MEJEELPTeam::where('id', $magazine->ec_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $dec = MEJEELPTeam::where('id', $magazine->dec_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $me = MEJEELPTeam::where('id', $magazine->me_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            
            $blogs = MEJEELPblog::whereIn('id', $ids)->with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
            $latestBlogs = MEJEELPblog::select('id','slug','img','created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = MEJEELPblog::select('id','slug','views','created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
            return view('front.MEJEELP-magazine.tag', compact('tag','magazine','latestBlogs','mostWatched','blogs','cbd','ec','dec','me'));
        endif;
        abort(404);
    }

    public function SingleMagazine($slug)
    {
        $check = MEJEELPblog::where('slug',$slug);
        if($check->count() == 1):
            $blog = $check->with('translation')->first();
            if (!Cookie::has('Magazine-'.$slug) ) :
                Cookie::queue( Cookie::make('Magazine-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $blog->views+1
                ]);
            endif;
            return view('front.MEJEELP-magazine.single-magazine', compact('blog'));
        endif;
        abort(404);
    }

    public function reserveBook($slug)
    {
        $blog = MEJEELPblog::with('translation:title,description,parent_id')
        ->where('slug', $slug)->first();

        if (!$blog)
        {
            abort(404);
        }

        return view('front.MEJEELP-magazine.bookingbook', compact('blog'));
    }

    

}
