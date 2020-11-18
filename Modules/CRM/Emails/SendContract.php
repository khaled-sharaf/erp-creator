<?php

namespace Modules\CRM\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendContract extends Mailable
{
    use Queueable, SerializesModels;

    public $view;
    public $subject;
    public $data;

    public function __construct($data = [], $attachData = null)
    {
        $this->data = $data;
        $this->attachData = $attachData;
    }


    public function build()
    {
        $settings = getSettings();

        return $this->subject('New Contract With ' . $settings['app_name_long'])
                    ->view('emails.send.send_contract_to_lead')
                    ->with([
                        'subject' => 'New Contract With ' . $settings['app_name_long'],
                        'data' => $this->data,
                        'settings' => $settings
                    ])
                    ->attachData($this->attachData, 'contract.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
