<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BuyerCashOrderSuccess extends Mailable
{
    use Queueable, SerializesModels;
    public $orderDetails;
    public $orderedBuyer;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderDetails, $orderedBuyer)
    {
        $this->orderDetails = $orderDetails;
        $this->orderedBuyer = $orderedBuyer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.buyer_cash_order_success');
    }
}
