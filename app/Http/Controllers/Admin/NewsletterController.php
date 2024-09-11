<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use App\Jobs\NewsletterJob;
use Carbon\Carbon;

class NewsletterController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:read-newsLetter')->only('json','index');

        $this->middleware('permission:edit-newsLetter')->only('edit', 'update');
    }

    public function json()
    {
        $query = Newsletter::get();
        return datatables($query)->editColumn('created_at', function ($row) {
            return $row->created_at;
        })->make(true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Newsletter::whereNull('email_verified_at')
        ->whereDate('created_at','<', Carbon::today())
        ->delete();
        return view('admin.newsletter.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNewsletterRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Url = "/uploads/files/shares";
        $data = str_replace($Url,url($Url),$request->content);
        $title = $request->title;
        
        NewsLetter::whereNotNull('email_verified_at')->chunk(50, function($emails) use ($data,$title) {
            dispatch(new NewsletterJob($emails, $data, $title))->delay(now()->addSeconds(15));
        });
        return response()->json([
            'status' => 'success',
            'message' => __('global.newsletter.message_done')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function show(Newsletter $newsletter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function edit(Newsletter $newsletter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNewsletterRequest  $request
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Newsletter  $newsletter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return back()->with('success', __('global.alert_done_delete'));
    }

    public function active(Request $request)
    {
        if( isset($request->token) ):
            $row = Newsletter::where('token', $request->token);
            if($row->count() == 1):
                $row->update([
                    'email_verified_at' => now(),
                    'token' => null
                ]);
                return redirect('/')->with('success', __('global.alert_done_subscription'));
            endif;
            abort(404);
        endif;
        abort(404);
    }
}
