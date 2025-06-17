<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $variables;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($variables)
    {
        $this->variables=$variables;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('frontend.email.new')->with('variables',$this->variables);
    }
}
