<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Attachment;

class RebateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    public $reporte;
   
    /**
     * Create a new message instance.
     */


    public function __construct($emailData, $reporte)
    {
        $this->emailData= $emailData;
        $this->reporte = $reporte;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'SoutoFoods',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.rebateEmail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [

            // Attachment::fromData(fn () => $this->reporte, 'rebate.xlsx'),
        ];
    }
}
