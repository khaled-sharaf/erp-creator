<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMultiMails extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $subject;
    public $data;

    public function __construct($view, $subject, $data = [])
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->data = $data;
    }


    public function build()
    {
        return $this->subject($this->subject)
                    ->view($this->view)
                    ->with([
                        'subject' => $this->subject,
                        'data' => $this->data,
                        'settings' => getSettings()
                    ]);
    }
}
