<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderAdmin extends Mailable
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
        $subject="Neue Bestellung #".$this->account_data['order_id'];
        return $this->subject($subject)->view('orders.order_admin_mail');

    }
}
