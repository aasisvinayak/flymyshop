<?php

namespace App\Jobs;

use Illuminate\Mail\Mailer;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateThumbnail extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        //        $mailer->send(
//            [],
//            [],
//            function ($message) {
//                $message->from(env('MAIL_FROM'));
//                $message->to(env('MAIL_TO'));
//                $message->subject("Test");
//                $message->setBody('Test message');
//            }
//        );
    }
}
