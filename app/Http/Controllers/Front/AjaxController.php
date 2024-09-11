<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookteam;

class AjaxController extends Controller
{
    
    public function getWriterVersion(Request $request)
    {

        $data = Bookteam::with('translation')->where('id', $request->id)->first();
        return response()->json($data);
    }

}
