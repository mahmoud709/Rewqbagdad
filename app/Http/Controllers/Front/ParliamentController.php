<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Parliament;
use App\Models\Parliamentvideo;

class ParliamentController extends Controller
{
    public function index()
    {
        $videos = Parliamentvideo::with('translation')->orderBy('id', 'DESC')->paginate(10);
        $data = Parliament::with('translation')->first();
        return view('front.parliament.index', compact('data','videos'));
    }
}
