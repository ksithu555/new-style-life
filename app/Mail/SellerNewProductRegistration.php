<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SellerNewProductRegistration extends Mailable
{
    use Queueable, SerializesModels;
    public $sellerData;
    public $product;
    public $seller;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sellerData, $product, $seller)
    {
        $this->sellerData = $sellerData;
        $this->product = $product;
        $this->seller = $seller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.seller_new_product_registration');
    }
}
