<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminContact extends Mailable
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
        return $this->view('emails.seller_contact', compact('data'))
                    ->with([
                        'imagePath' => !empty($data['imgName']) ? public_path('images/' . $data['imgName']) : null,
                    ]);
    }
}

