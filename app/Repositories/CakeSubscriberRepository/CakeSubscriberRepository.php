<?php

namespace App\Repositories\CakeSubscriberRepository;

use App\Models\CakeSubscriber;
use App\Repositories\AbstractRepository;

class CakeSubscriberRepository extends AbstractRepository implements CakeSubscriberRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(CakeSubscriber::class);
    }
}
