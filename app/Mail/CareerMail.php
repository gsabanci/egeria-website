<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CareerMail extends Mailable
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
        if(isset($this->variables['attach'])) {
            return $this->markdown('frontend.email.career')->attach(storage_path('app/public/cv/'.$this->variables['attach']))->with('variables',$this->variables);
        } else {
            return $this->markdown('frontend.email.career')->with('variables',$this->variables);
        }
    }
}
