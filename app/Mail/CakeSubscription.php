<?php

namespace App\Mail;

use App\Models\Cake;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CakeSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        private readonly User $user,
        private readonly Cake $cake
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: sprintf(
                'O bolo %s está disponível!',
                $this->cake['name'],
            ),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.cake_subscription',
            with: [
                'userName' => $this->user['name'],
                'cakeName' => $this->cake['name'],
                'cakeDescription' => $this->cake['description'],
                'cakePrice' => $this->cake['price'],
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
