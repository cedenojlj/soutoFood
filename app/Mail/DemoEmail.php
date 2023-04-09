<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class DemoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $emailData;
    public $reporte;
    public $nameReport;

    /**
     * Create a new message instance.
     */
    public function __construct($emailData, $reporte)
    {
        $this->emailData= $emailData;
        $this->reporte = $reporte;
        $this->nameReport = $emailData['customer'] . " - ". Auth::user()->name . ".xlsx";
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
            view: 'emails.demoEmail',
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

            //Attachment::fromData(fn () => $this->reporte, 'report.xlsx'),
            Attachment::fromData(fn () => $this->reporte, $this->nameReport),
        ];
    }
}
