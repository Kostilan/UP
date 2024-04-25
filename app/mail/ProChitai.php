<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProChitai extends Mailable
{
     use Queueable, SerializesModels;

    public $user;
    public $subscriptionType;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     * @param  SubscriptionType  $subscriptionType
     * @return void
     */
    public function __construct($user,$subscriptionType)
    {
        $this->user = $user;
        $this->subscriptionType = $subscriptionType;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('lonny57@ethereal.email', 'ProChitai')
                    ->view('mail.text')
                    ->with([
                        'user' => $this->user,
                        'subscriptionType' => $this->subscriptionType,
                    ]);
    }
    /* Get the message content definition.
     */

    public function envelope(){
        return new Envelope(
            subject:'Приобретение подписки',
        );
    }
    public function content(): Content
    {
        return new Content(
            view: 'text',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}