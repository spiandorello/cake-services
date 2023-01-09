<?php

namespace App\Services;

use App\Models\Cake;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use Illuminate\Pagination\AbstractPaginator;

class CakeServices
{
    public function __construct(
        private readonly CakeRepositoryInterface $cakeRepository,
    ) {
    }

    public function list(array $queryParams = []): AbstractPaginator
    {
        return $this->cakeRepository
            ->listPaginated($queryParams);
    }

    public function listOne(string $id): Cake
    {
        return $this->cakeRepository
            ->find($id);
    }

    public function create(array $cakeParams): Cake
    {
        return $this->cakeRepository
            ->create($cakeParams);
    }

    public function edit(string $id, array $cakeParams): Cake
    {
        $cake = $this->listOne($id);

        foreach ($cakeParams as $key => $value) {
            $cake->$key = $value;
        }

        $this->cakeRepository
            ->flush($cake);

        return $cake;
    }

    public function delete(string $id): bool
    {
        $cake = $this->listOne($id);

        return $this->cakeRepository
            ->delete($cake);
    }
}
