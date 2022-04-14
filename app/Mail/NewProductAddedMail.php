<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProductAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product_code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product_code)
    {
        //
        $this->product_code = $product_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails');
    }
}
