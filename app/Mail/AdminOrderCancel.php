<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminOrderCancel extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $admin)
    {
        $this->order = $order;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin_order_cancel');
    }
}
