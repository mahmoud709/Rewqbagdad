<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Magazine;
use App\Models\Magazineblog;
use App\Models\MagazineblogTranslation;
use App\Models\Magazineteam;
use App\Models\Magazinerules;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;

class MagazineController extends Controller
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
        $Magazine = Magazine::select('contact_email')->first();
        $subject = $request->subject;
        Mail::to($Magazine->contact_email)->send(new SendContactMail($request->except('_token'),$subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }

    public function PublishRole()
    {
        $data = Magazinerules::with('translation')->first();
        return view('front.magazine.publish-role', compact('data'));
    }

    public function EditorialBoard()
    {
        $teams = Magazineteam::with('translation')->orderBy('sort','ASC')->get();
        return view('front.magazine.editorial-board', compact('teams'));
    }

    public function index()
    {
        $magazine = Magazine::with('translation')->first();
        $team_ids = json_decode($magazine->team_ids);

        $teams = Magazineteam::whereIn('id', $team_ids)
        ->select('id','img')
        ->with('translation:name,job_title,parent_id')->get();
      
        $blogs = Magazineblog::with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
        $latestBlogs = Magazineblog::select('id','slug','img','created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
        $mostWatched = Magazineblog::select('id','slug','views','created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
        return view('front.magazine.index', compact('magazine','latestBlogs','mostWatched','blogs','teams'));
    }

    public function Tag($tag)
    {
        $check = MagazineblogTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):
            $ids = $check->pluck('parent_id')->toArray();

            $magazine = Magazine::with('translation')->first();
            $cbd = Magazineteam::where('id', $magazine->cbd_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $ec = Magazineteam::where('id', $magazine->ec_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $dec = Magazineteam::where('id', $magazine->dec_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();
            $me = Magazineteam::where('id', $magazine->me_id)->select('id','img')->with('translation:name,job_title,parent_id')->first();

            $blogs = Magazineblog::whereIn('id', $ids)->with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
            $latestBlogs = Magazineblog::select('id','slug','img','created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Magazineblog::select('id','slug','views','created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
            return view('front.magazine.tag', compact('tag','magazine','latestBlogs','mostWatched','blogs','cbd','ec','dec','me'));
        endif;
        abort(404);
    }

    public function SingleMagazine($slug)
    {
        $check = Magazineblog::where('slug',$slug);
        if($check->count() == 1):
            $blog = $check->with('translation')->first();
            if (!Cookie::has('Magazine-'.$slug) ) :
                Cookie::queue( Cookie::make('Magazine-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $blog->views+1
                ]);
            endif;
            return view('front.magazine.single-magazine', compact('blog'));
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

        return view('front.magazine.bookingbook', compact('blog'));
    }

}
