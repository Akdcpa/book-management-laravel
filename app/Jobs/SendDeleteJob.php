<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\BookModel;
use App\Mail\SendDeleteMail;

use Mail;
class SendDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  

    protected $details;

  

    /**

     * Create a new job instance.

     *

     * @return void

     */

    public function __construct($details )

    {

        $this->details = $details; 
    
    }

  

    /**

     * Execute the job.

     *

     * @return void

     */

    public function handle()

    {

        $email = new SendDeleteMail($this->details['data']);

        Mail::to($this->details['data']->user->email)->send($email);

    }
}
