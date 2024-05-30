<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $view = isset($this->data["view"]) ? $this->data["view"]: 'emails.sendmail';
        $subject = isset($this->data["subject"]) ? $this->data["subject"]: ' AEIA EMPIEZA A INVERTIR [REGISTRO]';
        return $this->from("no-reply@aeia.capital")->subject($subject)->view($view);

    }
}
