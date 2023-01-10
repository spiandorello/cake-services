<?php

namespace App\Services;

use App\Exceptions\CakeSubscriber\CakeUserAlreadySubscribedException;
use App\Jobs\SendingCakeSubscriptionNotification;
use App\Mail\CakeSubscription;
use App\Models\CakeSubscriber;
use App\Repositories\CakeSubscriberRepository\CakeSubscriberRepositoryInterface;
use Illuminate\Support\Facades\Mail;

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
            throw new CakeUserAlreadySubscribedException();
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

    public function sendNotification(string $userId, string $cakeId): void
    {
        $user = $this->userServices->listOne($userId);
        $cake = $this->cakeServices->listOne($cakeId);

        if ($cake->hasAvailableCakes()) {
            Mail::to($user['email'])->send(
                new CakeSubscription(
                    user: $user,
                    cake: $cake,
                ),
            );
        }
    }
}
