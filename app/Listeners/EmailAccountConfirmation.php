<?php

namespace App\Listeners;

use App\Events\UserVerified;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailAccountConfirmation
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
     * @param  UserVerified  $event
     * @return void
     */
    public function handle(UserVerified $event)
    {
        $msg_data = [
            'name' => $event->user->name,
            'email' => $event->user->email,
            'auth_key' => $event->user->auth_key
        ];

        Mail::send('emails.welcome', $msg_data, function ($message) use ($event) {
            $message->from('accounts@etxevents.com', 'ETX Events');
            $message->subject('Welcome to ETX Events - Your Account has been verified.');
            $message->to($event->user->email);
            $message->cc('jtobias@wakanpi.com');
        });
    }
}
