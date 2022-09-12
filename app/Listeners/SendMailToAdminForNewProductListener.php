<?php

namespace App\Listeners;

use App\Mail\NewProductAddedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailToAdminForNewProductListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $product_code = $event->product->code;
        Mail::to("arashtajdar@gmail.com")->send(new NewProductAddedMail($product_code));
    }
}
