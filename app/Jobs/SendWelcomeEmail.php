<?php

namespace App\Jobs;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail;



class SendWelcomeEmail extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        //
         $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        // Send email welcome user
        Mail::to($this->user->email)
                ->send(new WelcomeEmail($this->user));
    }
}
