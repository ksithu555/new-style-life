<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminProductCancel extends Mailable
{
    use Queueable, SerializesModels;
    public $sellerData;
    public $product;
    public $admin;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($sellerData, $product, $admin)
    {
        $this->sellerData = $sellerData;
        $this->product = $product;
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.admin_cancel_product_registration');
    }
}
