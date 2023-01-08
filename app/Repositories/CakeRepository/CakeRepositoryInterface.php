<?php

namespace App\Repositories\CakeRepository;

interface CakeRepositoryInterface
{
    public function find(string $id);

    public function list(array $params = []);
}