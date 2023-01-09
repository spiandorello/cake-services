<?php

namespace App\Services;

use App\Jobs\SendingCakeSubscriptionNotification;
use App\Models\CakeSubscriber;
use App\Repositories\CakeSubscriberRepository\CakeSubscriberRepositoryInterface;

class CakeSubscriberServices
{
    public function __construct(
        private readonly UserServices $userServices,
        private readonly CakeServices $cakeServices,
        private readonly CakeSubscriberRepositoryInterface $cakeSubscriberRepository,
    ) {
    }

    public function subscribe(string $userId, string $cakeId): CakeSubscriber
    {
        $user = $this->userServices->listOne($userId);
        $cake = $this->cakeServices->listOne($cakeId);

        $userAlreadySubscriber = $this->cakeSubscriberRepository
            ->findBy([
                'user_id' => $user['id'],
                'cake_id' => $cake['id'],
            ]);

        if ($userAlreadySubscriber) {
            throw new \Exception('User already subscriber');
        }

        $cakeSubscriber = $this->cakeSubscriberRepository->create([
            'user_id' => $user['id'],
            'cake_id' => $cake['id'],
        ]);

        SendingCakeSubscriptionNotification::dispatch($user['id'], $cake['id']);

        return $cakeSubscriber;
    }

    public function unsubscribe(string $userId, string $cakeId): bool
    {
        $user = $this->userServices->listOne($userId);
        $cake = $this->cakeServices->listOne($cakeId);

        $cakeSubscriber = $this->cakeSubscriberRepository
            ->findBy([
                'user_id' => $user['id'],
                'cake_id' => $cake['id'],
            ]);

        if (! $cakeSubscriber) {
            throw new \Exception('User doesn\'t subscribed');
        }

        return $this->cakeSubscriberRepository
            ->delete($cakeSubscriber);
    }
}
