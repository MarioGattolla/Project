<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentReminderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var User
     */
    public User $user;

    /**
     * Create a new message instance.
     *
     * @return void
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */


    public function build(): static
    {
        return $this->from('admin@sitoprova.com','Payment Reminder')->markdown('emails.payment-reminder');
    }
}
