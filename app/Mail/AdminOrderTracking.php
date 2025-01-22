<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderTracking extends Mailable
{
    use Queueable, SerializesModels;
    public $orderItems;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderItems, $admin)
    {
        $this->orderItems = $orderItems;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin_order_tracking');
    }
}
