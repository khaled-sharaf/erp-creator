<?php

namespace Modules\CRM\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $attachInvoice;
    public $attachReceipt;

    public function __construct($data = [], $attachInvoice = null, $attachReceipt = null)
    {
        $this->data = $data;
        $this->attachInvoice = $attachInvoice;
        $this->attachReceipt = $attachReceipt;
    }


    public function build()
    {
        $settings = getSettings();

        return $this->subject('A new payment in your contract')
                    ->view('emails.send.send_payment_to_lead')
                    ->with([
                        'subject' => 'A new payment in your contract',
                        'data' => $this->data,
                        'settings' => $settings
                    ])
                    ->attachData($this->attachInvoice, 'invoice.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->attachData($this->attachReceipt, 'receipt.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
