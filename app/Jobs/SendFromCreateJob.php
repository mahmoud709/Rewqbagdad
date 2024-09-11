<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use App\Mail\SendFromCreateNews;
use Mail;

class SendFromCreateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $emails;
    public $content;
    public $title;
    public $img;
    public $slug;

    public function __construct($emails, $content, $title, $img, $slug)
    {
        $this->emails = $emails;
        $this->content = $content;
        $this->title = $title;
        $this->img = $img;
        $this->slug = $slug;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $_mail):
            Mail::to($_mail->email)->send(new SendFromCreateNews($this->content,$this->title,$this->img,$this->slug));
        endforeach;
    }
}
