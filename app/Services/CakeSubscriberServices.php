<?php

namespace App\Services;

use App\Jobs\SendingCakeSubscriptionNotification;
use App\Models\CakeSubscriber;

class CakeSubscriberServices
{
    public function __construct(
        private readonly UserServices $userServices,
        private readonly CakeServices $cakeServices,
    ) {}

    public function subscribe(string $userId, string $cakeId)
    {
        $user = $this->userServices->listOne($userId);
        $cake = $this->cakeServices->listOne($cakeId);

        CakeSubscriber::create([
            'user_id' => $user['id'],
            'cake_id' => $cake['id'],
        ]);

        SendingCakeSubscriptionNotification::dispatch($user['id'], $cake['id']);
    }
}