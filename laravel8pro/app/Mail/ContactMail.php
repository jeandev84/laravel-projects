<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * @var
    */
    public $details;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $details)
    {
         $this->details = $details;
    }



    /**
     * Build the message.
     *
     * @return $this
    */
    public function build()
    {
        /* return $this->view('view.name'); */

        return $this->subject('Contact Message')
                    ->view('form.emails.ContactMail');
    }
}
