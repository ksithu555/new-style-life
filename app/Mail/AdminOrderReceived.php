<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $orderDetails;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $admin)
    {
        $this->orderDetails = $orderDetails;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin_order_received');
    }
}
