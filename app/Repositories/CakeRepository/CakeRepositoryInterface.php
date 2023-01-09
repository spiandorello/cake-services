<?php

namespace App\Repositories\CakeRepository;

use App\Models\Cake;
use Illuminate\Pagination\AbstractPaginator;

interface CakeRepositoryInterface
{
    public function find(string $id);

    public function create(array $params);

    public function delete(Cake $cake);

    public function listPaginated(array $params = []): AbstractPaginator;
}
