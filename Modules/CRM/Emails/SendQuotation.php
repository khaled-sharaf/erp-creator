<?php

namespace Modules\CRM\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendQuotation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $attachQuotation;

    public function __construct($data = [], $attachQuotation = null)
    {
        $this->data = $data;
        $this->attachQuotation = $attachQuotation;
    }


    public function build()
    {
        $settings = getSettings();

        return $this->subject('A new quotation from creator advertising')
                    ->view('emails.send.send_quotation_to_lead')
                    ->with([
                        'subject' => 'A new quotation from creator advertising',
                        'data' => $this->data,
                        'settings' => $settings
                    ])
                    ->attachData($this->attachQuotation, 'quotation.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
