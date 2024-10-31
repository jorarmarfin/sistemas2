<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistroMatricula extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $texto;
    public $subject;
    public $email;


    public function __construct($texto,$subject,$email)
    {
        //
        $this->texto = $texto;
        $this->subject = $subject;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->from($this->email)
                    ->subject($this->subject)
                    ->view('pages.extras.informacion_enviada',['texto'=>$this->texto]);
    }
}
