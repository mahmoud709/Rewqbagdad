<?php

namespace App\Http\Controllers\Front;

use App\Models\Magazineblog;
use Illuminate\Http\Request;
use App\Mail\SendContactMail;
use App\Models\KhetabMagazine;
use App\Models\KhetabMagazineblog;
use App\Models\KhetabMagazineteam;
use App\Models\KhetabMagazinerules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;
use App\Models\KhetabMagazineblogTranslation;


class KhetabMagazineController extends Controller
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
        $Magazine = KhetabMagazine::select('contact_email')->first();
        $subject = $request->subject;
        Mail::to($Magazine->contact_email)->send(new SendContactMail($request->except('_token'),$subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }

    public function PublishRole()
    {
        $data = KhetabMagazinerules::with('translation')->first();
        return view('front.khetab-magazine.publish-role', compact('data'));
    }

    public function EditorialBoard()
    {
        $teams = KhetabMagazineteam::with('translation')->orderBy('sort','ASC')->get();
        return view('front.khetab-magazine.editorial-board', compact('teams'));
    }

    public function index()
    {
        $magazine = KhetabMagazine::with('translation')->first();
        $team_ids = json_decode($magazine->team_ids);

        $teams = KhetabMagazineteam::whereIn('id', $team_ids)
        ->select('id','img')
        ->with('translation:name,job_title,parent_id')->get();
       
       
        $blogs = Magazineblog::with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
        $latestBlogs = KhetabMagazineblog::select('id','slug','img','created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
        $mostWatched = KhetabMagazineblog::select('id','slug','views','created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
        return view('front.khetab-magazine.index', compact('magazine','latestBlogs','mostWatched','blogs','teams'));
    }
    
    public function Tag($tag)
    {
        $check = KhetabMagazineblogTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):
            $ids = $check->pluck('parent_id')->toArray();

            $magazine = KhetabMagazine::with('translation')->first();
            $cbd = KhetabMagazineteam::where('id', $magazine->cbd_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $ec = KhetabMagazineteam::where('id', $magazine->ec_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $dec = KhetabMagazineteam::where('id', $magazine->dec_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $me = KhetabMagazineteam::where('id', $magazine->me_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            
            $blogs = KhetabMagazineblog::whereIn('id', $ids)->with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
            $latestBlogs = KhetabMagazineblog::select('id','slug','img','created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = KhetabMagazineblog::select('id','slug','views','created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
            return view('front.khetab-magazine.tag', compact('tag','magazine','latestBlogs','mostWatched','blogs','cbd','ec','dec','me'));
        endif;
        abort(404);
    }

    public function SingleMagazine($slug)
    {
        $check = KhetabMagazineblog::where('slug',$slug);
        if($check->count() == 1):
            $blog = $check->with('translation')->first();
            if (!Cookie::has('Magazine-'.$slug) ) :
                Cookie::queue( Cookie::make('Magazine-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $blog->views+1
                ]);
            endif;
            return view('front.khetab-magazine.single-magazine', compact('blog'));
        endif;
        abort(404);
    }

    public function reserveBook($slug)
    {
        $blog = Magazineblog::with('translation:title,description,parent_id')
        ->where('slug', $slug)->first();

        if (!$blog)
        {
            abort(404);
        }

        return view('front.khetab-magazine.bookingbook', compact('blog'));
    }

}