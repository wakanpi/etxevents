<?php

namespace App\Listeners;

use App\Events\UserCreated;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class EmailUserVerification implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {

        $msg_data = [
            'name' => $event->user->name,
            'email' => $event->user->email,
            'auth_key' => $event->user->auth_key
        ];

        Mail::send('emails.verify', $msg_data, function ($message) use ($event) {
            $message->from('accounts@etxevents.com', 'ETX Events');
            $message->subject('ETX Events Account Verification');
            $message->to($event->user->email);
            $message->cc('jtobias@wakanpi.com');
        });

//        dd($event->user);
    }
}
