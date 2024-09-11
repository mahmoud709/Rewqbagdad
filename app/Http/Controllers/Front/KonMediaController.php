<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Medianews;
use App\Models\MedianewsTranslation;
use App\Models\Mediaphoto;
use Illuminate\Support\Facades\Cookie;

use App\Models\Mediavideo;
use App\Models\Mediavideocategory;


class KonMediaController extends Controller
{
 
    public function videos(Request $request)
    {
        $slug = $request->category ?? "";
        if(isset($request->category)):
            $check = Mediavideocategory::where('slug', $request->category);
            if( $check->count() == 1 ):
                $category = $check->first();
                $videos = Mediavideo::where('category_id',$category->id)->with('translation')->orderBy('id', 'DESC')->paginate(10);
            else:
                $videos = Mediavideo::with('translation')->orderBy('id', 'DESC')->paginate(10);
            endif;
        else:
            $videos = Mediavideo::with('translation')->orderBy('id', 'DESC')->paginate(10);
        endif;
        $categories = Mediavideocategory::with('translation')->orderBy('sort', 'ASC')->get();
        return view('front.media-center.videos', compact('videos','slug', 'categories'));
    }

    public function Gallery()
    {
        $photos = Mediaphoto::with('translation')->orderBy('id', 'DESC')->paginate(10);
        return view('front.media-center.gallery', compact('photos'));
    }

    public function news()
    {
        $news = Medianews::select('id','slug','thum_img','created_at')
        ->where('kon' , 'on')
        ->with('translation:title,description,medianews_id')
        ->orderBy('created_at', 'DESC')->paginate(10);
        return view('front.kon_media.news', compact('news'));
    }
    
    public function Tag($tag)
    {
        $check = MedianewsTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):
            $ids = $check->pluck('medianews_id')->toArray();
            $blogs = Medianews::whereIn('id',$ids)->select('id','slug','img','created_at')
            ->with('translation:title,description,medianews_id')
            ->orderBy('id','DESC')->paginate(10);
            return view('front.kon_media.tag', compact('tag','blogs'));
        endif;
        abort(404);
    }

    public function SingleNews($slug)
    {
        //SingleNews
        $check = Medianews::where('slug',$slug);
        if($check->count() == 1):
            $blog = $check->with('translation')->first();
            if (!Cookie::has('SingleNews-'.$slug) ) :
                Cookie::queue( Cookie::make('SingleNews-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $blog->views+1
                ]);
            endif;
            return view('front.kon_media.single', compact('blog'));
        endif;
        abort(404);
    }
}
