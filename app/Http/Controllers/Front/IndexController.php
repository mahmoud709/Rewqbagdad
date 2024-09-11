<?php

namespace App\Http\Controllers\Front;

use Carbon\Carbon;
use App\Models\Events;

use App\Models\Slider;
use App\Models\Version;
use App\Models\Activity;
use App\Models\Magazine;

use App\Models\Iraqmeter;
use App\Models\Medianews;
use App\Models\Rewaqbook;
use App\Models\Newsletter;
use App\Models\Parliament;
use App\Models\Magazineblog;

use Illuminate\Http\Request;
use App\Models\Activitycategory;

use App\Models\EventsTranslation;
use App\Models\VersionTranslation;
use App\Models\ActivityTranslation;
use App\Http\Controllers\Controller;
use App\Mail\SubscriptionNewsletter;
use App\Models\IraqmeterTranslation;
use App\Models\MedianewsTranslation;
use App\Models\RewaqbookTranslation;
use Illuminate\Support\Facades\Mail;
use App\Models\MagazineblogTranslation;

class IndexController extends Controller
{

    public function ShowEvent($slug)
    {
        $event = Events::where('url',$slug)->with('translation')->first();
        if (!empty($event)):
            return view('front.event', compact('event'));
        endif;
        abort(404);
    }

    public function GetEvents(Request $request)
    {
        $events = Events::with('translation')->whereRaw('MONTH(created_at) = ?',[$request->month])->get();
        return response()->json(
            $events->map(function ($event) use($request) {
                $trans = EventsTranslation::where(['parent_id'=>$event->id,'locale'=>$request->local])->first();
                return [
                    // 'name'  => $event->translation->name,
                    'name'  => $trans->name,
                    'url'   => $event->url,
                    'date'  => $event->created_at->format('d/m/Y'),
                ];
            })
        );
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'text' => 'required|string|max:500',
        ]);
        $text = $request->text;

        /***********************************************/
        $MediaNewsIds = MedianewsTranslation::select('medianews_id')
        ->where('title','like','%'.$request->text.'%')
        ->orWhere('tags','like','%'.$request->text.'%')
        ->orWhere('description','like','%'.$request->text.'%')
        ->orWhere('content','like','%'.$request->text.'%')
        ->distinct()->limit(4)->pluck('medianews_id')->toArray();

        $medianews = Medianews::whereIn('id', $MediaNewsIds)
        ->with('translation:title,description,medianews_id')
        ->orderBy('id', 'DESC')->limit(4)->get();
        /***********************************************/


        /***********************************************/
        $IraqmeterIds = IraqmeterTranslation::select('parent_id')
        ->where('title','like','%'.$request->text.'%')
        ->orWhere('tags','like','%'.$request->text.'%')
        ->orWhere('description','like','%'.$request->text.'%')
        ->orWhere('content','like','%'.$request->text.'%')
        ->distinct()->limit(4)->pluck('parent_id')->toArray();

        $iraqmeters = Iraqmeter::whereIn('id', $IraqmeterIds)
        ->with('translation:title,description,parent_id')
        ->orderBy('id', 'DESC')->limit(4)->get();
        /***********************************************/

        /***********************************************/
        $MagazineIds = MagazineblogTranslation::select('parent_id')
        ->where('title','like','%'.$request->text.'%')
        ->orWhere('tags','like','%'.$request->text.'%')
        ->orWhere('description','like','%'.$request->text.'%')
        ->orWhere('content','like','%'.$request->text.'%')
        ->distinct()->limit(4)->pluck('parent_id')->toArray();

        $magazines = Magazineblog::whereIn('id', $MagazineIds)
        ->with('translation:title,description,parent_id')
        ->orderBy('id', 'DESC')->limit(4)->get();
        /***********************************************/


        /***********************************************/
        $RewaqbookIds = RewaqbookTranslation::select('parent_id')
        ->where('title','like','%'.$request->text.'%')
        ->orWhere('tags','like','%'.$request->text.'%')
        ->orWhere('description','like','%'.$request->text.'%')
        ->orWhere('content','like','%'.$request->text.'%')
        ->distinct()->limit(4)->pluck('parent_id')->toArray();

        $books = Rewaqbook::whereIn('id', $RewaqbookIds)
        ->with('translation:title,description,parent_id')
        ->orderBy('id', 'DESC')->limit(4)->get();
        /***********************************************/

        /***********************************************/
        $ActivityesIds = ActivityTranslation::select('activity_id')
        ->where('title','like','%'.$request->text.'%')
        ->orWhere('tags','like','%'.$request->text.'%')
        ->orWhere('description','like','%'.$request->text.'%')
        ->orWhere('content','like','%'.$request->text.'%')
        ->distinct()->limit(4)->pluck('activity_id')->toArray();

        $activities = Activity::whereIn('id',$ActivityesIds)->with('translation:title,description,activity_id')
        ->with('category:name,category_id')
        ->with('categorymain:id,slug')
        ->orderBy('id', 'DESC')->limit(4)->get();
        /***********************************************/


        /***********************************************/
        $VersionsIds = VersionTranslation::select('version_id')
        ->where('title','like','%'.$request->text.'%')
        ->orWhere('tags','like','%'.$request->text.'%')
        ->orWhere('description','like','%'.$request->text.'%')
        ->orWhere('content','like','%'.$request->text.'%')
        ->distinct()->limit(4)->pluck('version_id')->toArray();

        $versions = Version::whereIn('id',$VersionsIds)->with('translation:title,description,version_id')
        ->with('writer:name,bookteam_id')
        ->with('writermain:id,img')->with('category:name,category_id')
        ->with('categorymain:id,slug')->orderBy('id', 'DESC')->limit(4)->get();
        /***********************************************/
        
        return view('front.search', compact('versions','medianews','iraqmeters','magazines','books','activities','text'));
    }

    public function index()
    {
        $sliders = Slider::with('translation')->orderBy('sort','asc')->get();

        $Medianews = Medianews::with('translation:title,description,medianews_id')->orderBy('created_at','DESC')->limit(6)->get();
        
        $versions = Version::with('translation:title,version_id,description')
        ->with('writer:name,bookteam_id')
        ->with('writermain:id,img')->with('category:name,category_id')
        ->with('categorymain:id,slug')->orderBy('created_at', 'DESC')->limit(6)->get();
        
        $books = Rewaqbook::with('translation:title,parent_id')->orderBy('created_at', 'DESC')->limit(8)->get();


        $magazine = Magazine::select('id')->with('translation')->first();
        $magazineBlog = Magazineblog::with('translation')->orderBy('id', 'DESC')->first();
        
        $iraqmeterBlogs = Iraqmeter::select('id','slug','img','created_at')
        ->with('translation:title,description,parent_id')
        ->orderBy('created_at', 'DESC')->limit(6)->get();
        
        $parliament = Parliament::first();

        $activitiesCategory = Activitycategory::with('translation','activites.translation')->get();
        return view('front.index', compact('magazine','parliament','iraqmeterBlogs','magazineBlog','sliders','Medianews', 'versions','books','activitiesCategory'));
    }
    
    public function subscription(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|string|max:100|unique:newsletters',
        ]);
        $token = text_shuffle(60);
        $row = new Newsletter;
        $row->email = $request->email;
        $row->token = $token;
        $row->save();
        Mail::to($request->email)->send(new SubscriptionNewsletter($token));
        return back()->with('success', __('front.mail_send_activation'));
    }
}
