<?php

namespace App\Http\Controllers\Front;

use App\Models\konVideo;
use App\Models\Iraqmeter;
use App\Models\Rewaqbook;

use App\Models\AfkarFakar;
use App\Models\BodcastBlog;
use App\Models\KonTraining;
use App\Models\KunInfoEdit;
use App\Models\OurEpisodes;
use Illuminate\Http\Request;
use App\Models\BodcastInfoEdit;
use App\Models\IraqmeterSurvey;
use App\Models\Upcomingtraining;
use App\Models\IraqmeterInfoEdit;
use App\Http\Controllers\Controller;
use App\Models\IraqmeterTranslation;
use Illuminate\Support\Facades\Cookie;

class IraqmeterController extends Controller
{
    public function boadcast()
    {
        $bodcastInfo        = BodcastInfoEdit::with('translation')->first();
        $ourEpisodes         = OurEpisodes::with('translation')->get(); 
        $afkarFakar         = AfkarFakar::with('translation')->get(); 
        $blogs         = BodcastBlog::with('translation')->get(); 
        return view('front.iraq-meter.boadcast', compact('bodcastInfo','ourEpisodes','afkarFakar','blogs'));
    }
    
    public function boadcastBlogDetails($slug)
    {
        $blog = BodcastBlog::with('translation')->where('slug', $slug)->first();

        return view('front.iraq-meter.bodcastblog-details', compact('blog'));
    }
    public function bodcastBlogs()
    {
        $blogs = BodcastBlog::with('translation')->paginate(20);

        return view('front.iraq-meter.bodcast-blogs', compact('blogs'));
    }


    public function boadcastDetails()
    {
        return view('front.iraq-meter.boadcast-details');
    }
    
    public function kon()
    {

        $kon = KunInfoEdit::with('translation')->first();
        $konTrainings = KonTraining::with('translation')->get();
        $upcomingtrainings = Upcomingtraining::with('translation')->get();
        $videos = konVideo::with('translation')->get();
        return view('front.iraq-meter.kon',compact('kon','konTrainings','videos','upcomingtrainings'));
    }
    
    public function Tag($tag)
    {
        $check = IraqmeterTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):
            $ids = $check->pluck('parent_id')->toArray();
            $blogs = Iraqmeter::whereIn('id',$ids)->select('id','slug','img','created_at')
            ->with('translation:title,description,parent_id')
            ->orderBy('id','DESC')->paginate(10);
            return view('front.iraq-meter.tag', compact('tag','blogs'));
        endif;
        abort(404);
    }
    
    public function Info()
    {
        $iraqmeterInfo = IraqmeterInfoEdit::with('translation')->first();

        $IraqmeterSurveys = IraqmeterSurvey::with('translation')->get();
        
        return view('front.iraq-meter.info',compact('IraqmeterSurveys', 'iraqmeterInfo'));
    }
    
    public function blogs()
    {
        $blogs = Iraqmeter::select('id','slug','img','created_at')
        ->with('translation:title,description,parent_id')
        ->orderBy('id', 'DESC')->paginate(10);
        return view('front.iraq-meter.blogs', compact('blogs'));
    }
    
    public function SingleBlog($slug)
    {
        $check = Iraqmeter::where('slug',$slug);
        if($check->count() == 1):
            $blog = $check->with('translation')->first();
            if (!Cookie::has('Iraqmeter-'.$slug) ) :
                Cookie::queue( Cookie::make('Iraqmeter-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $blog->views+1
                ]);
            endif;
            return view('front.iraq-meter.single', compact('blog'));
        endif;
        abort(404);

    }

    public function serveyDetails($slug)
    {
        $check = IraqmeterSurvey::where('slug', $slug);
        if ($check->count() >= 1) :
            $iraqmeterSurvey = $check->with('translation')->first();

            if (!Cookie::has('survey-' . $slug)) :

                Cookie::queue(Cookie::make('survey-' . $slug, '', (60 * 24 * 356)));
                $check->update([
                    'views' => $iraqmeterSurvey->views + 1
                ]);
            endif;

            return view('front.iraq-meter.surveydetails', compact('iraqmeterSurvey'));
        endif;
        abort(404);
    }
    public function trainingDetails($slug)
    {
        $check = KonTraining::where('slug', $slug);
        if ($check->count() >= 1) :
            $kontraining = $check->with('translation')->first();

            if (!Cookie::has('training-' . $slug)) :

                Cookie::queue(Cookie::make('training-' . $slug, '', (60 * 24 * 356)));

                $check->update([
                    'views' => $kontraining->views + 1
                ]);

            endif;

            return view('front.iraq-meter.kondetails', compact('kontraining'));
        endif;
        abort(404);
    }
    public function upcommingTrainingDetails($slug)
    {
        $check = Upcomingtraining::where('slug', $slug);
        if ($check->count() >= 1) :
            $upcommingTraining = $check->with('translation')->first();

            if (!Cookie::has('upcommingtraining-' . $slug)) :

                Cookie::queue(Cookie::make('upcommingtraining-' . $slug, '', (60 * 24 * 356)));

                $check->update([
                    'views' => $upcommingTraining->views + 1
                ]);

            endif;

            return view('front.iraq-meter.upcommingTraning-details', compact('upcommingTraining'));
        endif;
        abort(404);
    }

    public function ourEpisodes()
    {
        $videos =  OurEpisodes::with('translation')->paginate(20);

        return view('front.iraq-meter.bodcast-ourepisode',compact('videos'));
    }
    public function afkarFakar()
    {
        $videos =  AfkarFakar::with('translation')->paginate(20);

        return view('front.iraq-meter.bodcast-afakarfakar',compact('videos'));
    }

    public function allsurvey()
    {
        $iraqmeterSurveys = IraqmeterSurvey::select('id', 'slug', 'photo', 'created_at')->with('translation:title,description,iraqmeter_survey_id')->orderBy('id', 'DESC')->paginate(20);
        return view('front.iraq-meter.all-surveys', compact('iraqmeterSurveys'));
    }
    public function allKon()
    {
        $konTrainings = KonTraining::select('id', 'slug', 'photo', 'created_at')->with('translation:title,description,kon_training_id')->orderBy('id', 'DESC')->paginate(12);
        return view('front.iraq-meter.all-kon', compact('konTrainings'));
    }
    public function allUpcommingTrainings()
    {
        $allUpcommingTrainings = Upcomingtraining::select('id', 'slug', 'photo', 'created_at')
        ->with('translation:title,description,upcomingtraining_id')
        ->orderBy('id', 'DESC')->paginate(12);
        return view('front.iraq-meter.allUplcommingTrainings', compact('allUpcommingTrainings'));
    }

    
    public function reserveBook($slug)
    {

        $survey = IraqmeterSurvey::where('slug', $slug)->first();

        if (!$survey)
        {
            abort(404);
        }

        return view('front.iraq-meter.bookingbook', compact('survey'));
    }

    public function konVideos()
    {
        $videos =  konVideo::with('translation')->paginate(20);

        return view('front.iraq-meter.konVideos',compact('videos'));
    }

}
