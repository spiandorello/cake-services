<?php

namespace App\Jobs;

use App\Mail\CakeSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendingCakeSubscriptionNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly string $userId,
        public readonly string $cakeId,
    ) {
    }

    public function handle(): void
    {
        try {
            Mail::to('eduardo.spiandorello@gmail.com')
                ->send(new CakeSubscription());
        } catch (\Exception $exc) {
            var_dump($exc->getMessage());
            exit;
        }
    }
}
