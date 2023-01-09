<?php

namespace App\Services;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterface;

class UserServices
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function list(array $queryParams = [])
    {
        return $this->userRepository
            ->listPaginated($queryParams);
    }

    public function listOne(string $id): User
    {
        $user = $this->userRepository
            ->find($id);

        if (!$user instanceof User) {
            throw new UserNotFoundException();
        }

        return $user;
    }

    public function create(array $userParams): User
    {
        return $this->userRepository
            ->create($userParams);
    }

    public function edit(string $id, array $userParams): User
    {
        $cake = $this->listOne($id);

        foreach ($userParams as $key => $value) {
            $cake->$key = $value;
        }

        $this->userRepository
            ->flush($cake);

        return $cake;
    }

    public function delete(string $id): bool
    {
        $cake = $this->listOne($id);

        return $this->userRepository
            ->delete($cake);
    }
}
