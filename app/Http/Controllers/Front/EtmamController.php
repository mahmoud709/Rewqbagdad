<?php

namespace App\Http\Controllers\Front;

use App\Models\EtmamNews;
use Illuminate\Http\Request;
use App\Models\Etmamcategory;
use App\Http\Controllers\Controller;
use App\Models\EtmamInfo;
use Illuminate\Support\Facades\Cookie;

class EtmamController extends Controller
{
    public function index()
    {
        
        $etmamCategories = Etmamcategory::with('translation','emamnews.translation')->get();
        $etmamInfo = EtmamInfo::with('translation')->first();
        return view('front.etmam.index',compact('etmamCategories','etmamInfo'));
    }

    public function SingleEtmam($slug)
    {
        $check = EtmamNews::where('slug',$slug);
        if($check->count() == 1):
            
            $EtmamNew = $check->with('translation')->with('category:name,category_id')->with('categorymain:id,slug')->first();
            if (!Cookie::has('etmam-'.$slug) ) :
                Cookie::queue( Cookie::make('etmam-'.$slug, '', (60*24*356)) );
                $check->update([
                    'views' => $EtmamNew->views+1
                ]);
            endif;
            $latestNews = EtmamNews::select('id','slug','img','created_at')->with('translation:title,etmam_id')->orderBy('id', 'DESC')->limit(4)->get();
            $mostWatched = EtmamNews::select('id','slug','views','created_at')->with('translation:title,etmam_id')->orderBy('views', 'DESC')->limit(4)->get();
            return view('front.etmam.single-etmam', compact('EtmamNew','latestNews','mostWatched'));
        endif;
        abort(404);
    }
}
