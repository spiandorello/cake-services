<?php

namespace App\Repositories\CakeRepository;

use App\Models\Cake;
use App\Repositories\AbstractRepository;

class CakeRepository extends AbstractRepository implements CakeRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Cake::class);
    }
}