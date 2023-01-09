<?php

namespace App\Repositories\CakeSubscriberRepository;

interface CakeSubscriberRepositoryInterface
{
    public function findBy(array $params);

    public function create(array $params);
}
