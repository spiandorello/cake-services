<?php

namespace App\Repositories\UserRepository;

interface UserRepositoryInterface
{
    public function find(string $id);

    public function listPaginated(array $params = []);

    public function create(array $params);
}
