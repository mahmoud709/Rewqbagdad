<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Versioncategory;
use App\Http\Controllers\Controller;
use App\Models\MedadInfo;

class MedadController extends Controller
{
    public function index()
    {

        $versioncategory = Versioncategory::with('translation','versions.translation')->get();

        $medadInfo = MedadInfo::with('translation')->first();
        
        return view('front.medad.index', compact('versioncategory', 'medadInfo'));
    }
}
