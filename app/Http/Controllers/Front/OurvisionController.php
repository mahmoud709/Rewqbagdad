<?php

namespace App\Http\Controllers\Front;

use App\Models\About;
use App\Models\AboutData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OurvisionController extends Controller
{
    public function ourvision()
    {   
        $vision = AboutData::where('type','vision')->first();
        $ourMessage = AboutData::where('type','our_message')->first();

        $targets = AboutData::where('type','targets')->get();
        $targets = AboutData::where('type','targets')->get();
        $ourMeans  = AboutData::where('type','means')->get();
        
        return view('front.ourvision.ourvision', compact('vision','targets','ourMessage','ourMeans'));
    }
}
