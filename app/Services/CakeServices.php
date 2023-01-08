<?php

namespace App\Services;

use App\Models\Cake;
use App\Repositories\CakeRepository\CakeRepositoryInterface;

class CakeServices
{
    public function __construct(
        private readonly CakeRepositoryInterface $cakeRepository,
    ) {}

    public function list(array $queryParams = [])
    {
        return $this->cakeRepository
            ->list($queryParams)
            ->simplePaginate($queryParams['limit'] ?? 5)
            ->withQueryString();
    }

    public function listOne(string $id): Cake
    {
        return $this->cakeRepository
            ->find($id);
    }

    public function create(array $cakeParams): Cake
    {
        return Cake::create($cakeParams);
    }

    public function edit(string $id, array $cakeParams): Cake
    {
        $cake = $this->listOne($id);

        foreach ($cakeParams as $key => $value) {
            $cake->$key = $value;
        }

        $cake->save();

        return $cake;
    }

    public function delete(string $id): bool
    {
        $cake = $this->listOne($id);

        return $cake->delete();
    }
}