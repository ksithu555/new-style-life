<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SellerContact extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        $data = $this->data;
        return $this->view('emails.admin_contact', compact('data'))
                    ->with([
                        'imagePath' => !empty($data['imgName']) ? public_path('images/' . $data['imgName']) : null,
                    ]);
    }
}

