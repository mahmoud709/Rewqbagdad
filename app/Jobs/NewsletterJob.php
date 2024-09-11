<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\SendMailToNewsletter;
use Mail;
class NewsletterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $emails;
    public $data;
    public $title;
   
    public function __construct($mails, $data, $title)
    {
        $this->emails = $mails;
        $this->data = $data;
        $this->title = $title;
    }
    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $_mail):
            Mail::to($_mail->email)->send(new SendMailToNewsletter($this->data,$this->title));
        endforeach;
    }
}
