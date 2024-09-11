<?php

namespace App\Http\Controllers\Front;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
{
    public function faq()
    {
        $faqs = Faq::with('translation')->get();
        return view('front.faq.faq', compact('faqs'));
    }
}
