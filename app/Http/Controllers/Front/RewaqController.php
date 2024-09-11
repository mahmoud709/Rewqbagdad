<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Models\Rewaq;
use App\Models\Rewaqteam;
use App\Models\Rewaqbook;
use App\Models\RewaqbookTranslation;
use App\Models\Rewaqpublishrule;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendContactMail;
use App\Models\RewaqVideo;

class RewaqController extends Controller
{
    public function contact()
    {
        return view('front.rewaq.contact-us');
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
        $rewaq = Rewaq::select('contact_email')->first();
        $subject = $request->subject;
        Mail::to($rewaq->contact_email)->send(new SendContactMail($request->except('_token'), $subject));
        return back()->with('success', __('front.alert_send_contact_main'));
    }

    public function EditorialBoard()
    {
        $teams = Rewaqteam::with('translation')->orderBy('sort', 'ASC')->get();
        return view('front.rewaq.editorial-board', compact('teams'));
    }

    public function PublishRole()
    {
        $data = Rewaqpublishrule::with('translation')->first();
        return view('front.rewaq.publish-role', compact('data'));
    }

    public function index()
    {
        $rewaq = Rewaq::with('translation')->first();

        $team_ids = json_decode($rewaq->team_ids);

        $teams = Rewaqteam::whereIn('id', $team_ids)
        ->select('id','img')
        ->with('translation:name,job_title,rewaq_id')->get();
        $books = Rewaqbook::with('translation:title,description,parent_id')->orderBy('id', 'DESC')->get();
        $latestNews = Rewaqbook::select('id', 'slug', 'img', 'created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
        $mostWatched = Rewaqbook::select('id', 'slug', 'views', 'created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
        $videos = RewaqVideo::with('translation')->get();
        return view('front.rewaq.index', compact('rewaq', 'books', 'latestNews', 'mostWatched','videos','teams'));
    }

    public function book($slug)
    {
        $check = Rewaqbook::where('slug', $slug);
        if ($check->count() >= 1) :
            $book = $check->with('translation')->first();

            if (!Cookie::has('book-' . $slug)) :
                Cookie::queue(Cookie::make('book-' . $slug, '', (60 * 24 * 356)));
                $check->update([
                    'views' => $book->views + 1
                ]);
            endif;

            return view('front.rewaq.book', compact('book'));
        endif;
        abort(404);
    }

    public function Tag($tag)
    {
        $check = RewaqbookTranslation::where('tags', 'like', '%' . $tag . '%');
        if ($check->count() >= 1) :
            $ids = $check->pluck('parent_id')->toArray();

            $books = Rewaqbook::whereIn('id', $ids)->with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(10);
            $rewaq = Rewaq::with('translation')->with('pm', 'am', 'ps')->first();
            $latestNews = Rewaqbook::select('id', 'slug', 'img', 'created_at')->with('translation:title,parent_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Rewaqbook::select('id', 'slug', 'views', 'created_at')->with('translation:title,parent_id')->orderBy('views', 'DESC')->limit(4)->get();
            return view('front.rewaq.tag', compact('tag', 'rewaq', 'books', 'latestNews', 'mostWatched'));
        endif;
        abort(404);
    }
    public function versions()
    {
        $books = Rewaqbook::select('id', 'slug', 'img', 'index_url', 'created_at')->with('translation:title,description,parent_id')->orderBy('id', 'DESC')->paginate(20);
        
        return view('front.rewaq.versions', compact('books'));
    }

    public function reserveBook($slug)
    {
        $book = Rewaqbook::where('slug', $slug)->first();

        if (!$book)
        {
            abort(404);
        }

        return view('front.rewaq.bookingbook', compact('book'));
    }

    public function videos()
    {
        $videos = RewaqVideo::with('translation')->paginate(20);

        return view('front.rewaq.videos',compact('videos'));
    }
}
