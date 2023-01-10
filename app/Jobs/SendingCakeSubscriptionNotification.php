<?php

namespace App\Jobs;

use App\Services\CakeSubscriberServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendingCakeSubscriptionNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly string $userId,
        public readonly string $cakeId,
    ) {
    }

    public function handle(CakeSubscriberServices $cakeSubscriberServices): void
    {
        $cakeSubscriberServices
            ->sendNotification(
                userId: $this->userId,
                cakeId: $this->cakeId,
            );
    }
}
