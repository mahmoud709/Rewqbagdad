<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Models\Versioncategory;
use App\Models\Version;
use App\Models\VersionTranslation;

class VersionController extends Controller
{
 
    public function All()
    {
        $versions = Version::with('translation:title,description,version_id')
        ->with('writer:name,bookteam_id')
        ->with('writermain:id,img')->with('category:name,category_id')
        ->with('categorymain:id,slug')->orderBy('id', 'DESC')->paginate(11);

        $latestNews = Version::select('id','slug','img','created_at')->with('translation:title,version_id')->orderBy('id', 'DESC')->limit(4)->get();
        $mostWatched = Version::select('id','slug','views','created_at')->with('translation:title,version_id')->orderBy('views', 'DESC')->limit(4)->get();
        $VersionsCats = Versioncategory::with('translation')->orderBy('sort','asc')->get();
        return view('front.versions.all', compact('versions','latestNews','VersionsCats','mostWatched'));
    }

    public function Tag($tag)
    {
        $check = VersionTranslation::where('tags','like','%'.$tag.'%');
        if($check->count() >= 1 ):

            $ids = $check->pluck('version_id')->toArray();
            $versions = Version::whereIn('id',$ids)
            ->with('translation:title,description,version_id')->with('writer:name,bookteam_id')
            ->with('writermain:id,img')->with('category:name,category_id')
            ->with('categorymain:id,slug')->orderBy('id', 'DESC')->paginate(11);

            $latestNews = Version::select('id','slug','img','created_at')->with('translation:title,version_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Version::select('id','slug','views','created_at')->with('translation:title,version_id')->orderBy('views', 'DESC')->limit(4)->get();
            $VersionsCats = Versioncategory::with('translation')->orderBy('sort','asc')->get();
            return view('front.versions.tag', compact('versions','latestNews','mostWatched','VersionsCats','tag'));
        endif;
        abort(404);
    }

    public function SingleVersion($slug)
    {
        $check = Version::where('slug',$slug);
        
        if($check->count() == 1 ):
            $row = $check->with('translation')
            ->with('writer')->with('writermain:id,img')
            ->with('category:name,category_id')->first();

            $related_topics = Version::where('category_id',$row->category_id)->select('id','slug','img','created_at')
            ->with('translation:title,version_id')
            ->inRandomOrder()
            ->limit(4)->get();
            
            $mostRecent = Version::where('category_id',$row->category_id)->select('id','slug')
            ->with('translation:title,version_id')
            ->orderBy('views', 'DESC')
            ->limit(4)->get();
            
            $writerArticles = Version::where('id','!=',$row->id)->where('writer_id',$row->writer_id)->select('id','slug','img','created_at')
            ->with('translation:title,version_id')
            ->orderBy('views', 'DESC')
            ->limit(4)->get();

            if (!Cookie::has('Version-'.$slug) ) :
                Cookie::queue( Cookie::make('Version-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $row->views+1
                ]);
            endif;

            return view('front.versions.single-version', compact('row','related_topics','mostRecent','writerArticles'));
        endif;
        abort(404);
    }

    public function category($slug)
    {
        $check = Versioncategory::where('slug',$slug);
        if($check->count() == 1 ):
            $category = $check->with('translation')->first();

            $versions = Version::where('category_id', $category->id)
            ->with('translation:title,description,version_id')->with('writer:name,bookteam_id')
            ->with('writermain:id,img')->with('category:name,category_id')
            ->with('categorymain:id,slug')->orderBy('id', 'DESC')->paginate(11);

            $latestNews = Version::select('id','slug','img','created_at')->with('translation:title,version_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = Version::select('id','slug','views','created_at')->with('translation:title,version_id')->orderBy('views', 'DESC')->limit(4)->get();
            $VersionsCats = Versioncategory::with('translation')->orderBy('sort','asc')->get();
            return view('front.versions.category', compact('versions','VersionsCats','latestNews','mostWatched','category'));
        endif;
        abort(404);
    }
}
