<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\MediaUpload;
use Illuminate\Mail\Mailables\Attachment;

class OrderCompleted extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( public Order $order)
    {
       
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[Sprawki.pl] - Twoje zamówienie #'.$this->order->id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.app',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $tab = array();
        $mediaModel = new MediaUpload();
        $media = $mediaModel->getMediaForOrder($this->order->id);
        
        if(!empty($media)) {
            foreach($media as $med) {
                $tab[] = Attachment::fromPath(public_path('images').'/'.$med->filename);
            }
        }
        
        return $tab;
    }
}
