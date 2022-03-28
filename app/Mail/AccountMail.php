<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountMail extends Mailable
{
    use Queueable, SerializesModels;

    public $account_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->account_data=$mail_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject="Deine Bestellung bei Bewerbung.one wurde aufgenommen -Zahlung noch ausstehend!";
        return $this->subject($subject)->view('orders.account_mail')->attach(url('public/files/document/5d888fd68fdb7.png'))
            ->attach(url('public/files/document/5d8872b5ab18d.jpg'));
    }
}
