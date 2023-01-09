<?php

namespace App\Repositories\CakeRepository;

use App\Models\Cake;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;

class CakeRepository extends AbstractRepository implements CakeRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(Cake::class);
    }

    public function list(array $params = []): Builder
    {
        $queryBuilder = Cake::query();

        if (! empty($params['name'])) {
            $queryBuilder->orWhere(
                column: 'name',
                operator: 'like',
                value: '%'.$params['name'].'%',
            );
        }

        return $queryBuilder
            ->orderBy(column: 'name');
    }
}
