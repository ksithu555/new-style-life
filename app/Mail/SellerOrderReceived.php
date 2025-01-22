<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerOrderReceived extends Mailable
{
    use Queueable, SerializesModels;
    public $orderDetails;
    public $seller;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $seller)
    {
        $this->orderDetails = $orderDetails;
        $this->seller = $seller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.seller_order_received');
    }
}
