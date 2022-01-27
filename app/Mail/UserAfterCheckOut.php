<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserAfterCheckOut extends Mailable
{
    use Queueable, SerializesModels;

    private $checkout;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($checkout)
    {
        $this->checkout = $checkout;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Register Camp: {$this->checkout->camp->title}")
            ->markdown('emails.user.afterCheckOut', [
                'checkout'  => $this->checkout
            ]);
    }
}
