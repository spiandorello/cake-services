<?php

namespace App\Repositories\UserRepository;

use App\Models\User;
use App\Repositories\AbstractRepository;
use Illuminate\Contracts\Pagination\Paginator;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(User::class);
    }

    public function listPaginated(array $params = []): Paginator
    {
        $queryBuilder = User::query();

        if (! empty($params['name'])) {
            $queryBuilder->orWhere(
                column: 'name',
                operator: 'like',
                value: '%'.$params['name'].'%',
            );
        }

        return $queryBuilder
            ->orderBy(column: 'name')
            ->simplePaginate();
    }
}
