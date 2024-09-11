<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Models\Activity;
use App\Models\ActivityTranslation;
use App\Models\Activitycategory;

class ActivityController extends Controller
{
    public function Tag($tag)
    {
        $check = ActivityTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):
            $ids = $check->pluck('activity_id')->toArray();
            $activities = Activity::whereIn('id',$ids)->with('translation:title,description,activity_id')
            ->with('category:name,category_id')
            ->with('categorymain:id,slug')
            ->orderBy('id', 'DESC')->paginate(11);

            $latestNews = Activity::select('id','slug','img','created_at')->with('translation:title,activity_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Activity::select('id','slug','views','created_at')->with('translation:title,activity_id')->orderBy('views', 'DESC')->limit(4)->get();
            $ActivityCats = Activitycategory::with('translation')->orderBy('sort','asc')->get();
            return view('front.activity.tag', compact('tag','activities','mostWatched','latestNews','ActivityCats'));
        endif;
        abort(404);
    }

    public function All()
    {
        $activities = Activity::with('translation:title,description,activity_id')
        ->with('category:name,category_id')
        ->with('categorymain:id,slug')
        ->orderBy('id', 'DESC')->paginate(11);
        
        $latestNews = Activity::select('id','slug','img','created_at')->with('translation:title,activity_id')->orderBy('id', 'DESC')->limit(4)->get();
        $mostWatched = Activity::select('id','slug','views','created_at')->with('translation:title,activity_id')->orderBy('views', 'DESC')->limit(4)->get();
        $ActivityCats = Activitycategory::with('translation')->orderBy('sort','asc')->get();
        return view('front.activity.all', compact('activities','mostWatched','latestNews','ActivityCats'));
    }
    
    public function category($slug)
    {
        $check = Activitycategory::where('slug',$slug);
        if($check->count() >= 1):
            $category = $check->with('translation')->first();

            $activities = Activity::where('category_id',$category->id)
            ->with('translation:title,description,activity_id')
            ->with('category:name,category_id')
            ->with('categorymain:id,slug')->paginate(11);

            $latestNews = Activity::select('id','slug','img','created_at')->with('translation:title,activity_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Activity::select('id','slug','views','created_at')->with('translation:title,activity_id')->orderBy('views', 'DESC')->limit(4)->get();
            $ActivityCats = Activitycategory::with('translation')->orderBy('sort','asc')->get();
            return view('front.activity.category', compact('activities','ActivityCats','latestNews','mostWatched','category'));
        endif;
        abort(404);
    }

    public function SingleActivity($slug)
    {
        $check = Activity::where('slug',$slug);
        if($check->count() == 1):
            
            $activity = $check->with('translation')->with('category:name,category_id')->with('categorymain:id,slug')->first();
            if (!Cookie::has('Activity-'.$slug) ) :
                Cookie::queue( Cookie::make('Activity-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $activity->views+1
                ]);
            endif;
            $latestNews = Activity::select('id','slug','img','created_at')->with('translation:title,activity_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Activity::select('id','slug','views','created_at')->with('translation:title,activity_id')->orderBy('views', 'DESC')->limit(4)->get();
            return view('front.activity.single-activity', compact('activity','latestNews','mostWatched'));
        endif;
        abort(404);
    }
}
