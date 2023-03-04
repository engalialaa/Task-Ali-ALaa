<?php

namespace Modules\TaskModule\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $meseeage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($meseeage)
    {
        $this->meseeage = $meseeage;
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('taskmodule::mails.send_mail');
    }
}
