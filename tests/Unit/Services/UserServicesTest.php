<?php

namespace Tests\Unit\Services;

use App\Exceptions\User\UserNotFoundException;
use App\Models\User;
use App\Repositories\UserRepository\UserRepositoryInterface;
use App\Services\UserServices;
use Illuminate\Support\Str;
use Tests\TestCase;

class UserServicesTest extends TestCase
{
    private readonly UserServices $userServices;

    public function test_list_one_user(): void
    {
        $user = User::factory()->make();
        $user->id = (Str::uuid())->toString();

        $userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('find')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $this->userServices = new UserServices(
            $userRepositoryMock
        );

        $this->userServices->listOne($user->id);
    }

    public function test_list_one_user_not_found(): void
    {
        $id = (Str::uuid())->toString();

        $userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('find')
            ->once()
            ->with($id)
            ->andReturn(null);

        $this->userServices = new UserServices(
            $userRepositoryMock
        );

        $this->expectException(UserNotFoundException::class);

        $this->userServices->listOne($id);
    }

    public function test_list_all_user(): void
    {
        $user = User::factory()->make();
        $user->id = (Str::uuid())->toString();

        $userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('listPaginated')
            ->once();

        $this->userServices = new UserServices(
            $userRepositoryMock
        );

        $this->userServices->list();
    }

    public function test_create_a_user(): void
    {
        $userCreateParams = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];

        $user = User::factory()->make($userCreateParams);

        $userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('create')
            ->once()
            ->with($userCreateParams)
            ->andReturn($user);

        $this->userServices = new UserServices(
            $userRepositoryMock
        );

        $user = $this->userServices->create($userCreateParams);

        $this->assertEquals(
            expected: $userCreateParams,
            actual: $user->toArray(),
        );
    }

    public function test_edit_a_user(): void
    {
        $userEditParams = [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];

        $user = User::factory()->make($userEditParams);
        User::saving(fn () => false);

        $user->id = (Str::uuid())->toString();
        $userEditParams['id'] = $user->id;

        $userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('find')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $userRepositoryMock->shouldReceive('flush')
            ->once()
            ->with($user)
            ->andReturn(true);

        $this->userServices = new UserServices(
            $userRepositoryMock
        );

        $user = $this->userServices->edit($user->id, $userEditParams);

        $this->assertEquals(
            expected: $userEditParams,
            actual: $user->toArray(),
        );
    }

    public function test_delete_a_user(): void
    {
        $user = User::factory()->make();
        User::deleting(fn () => false);

        $user->id = (Str::uuid())->toString();

        $userRepositoryMock = \Mockery::mock(UserRepositoryInterface::class);
        $userRepositoryMock->shouldReceive('find')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $userRepositoryMock->shouldReceive('delete')
            ->once()
            ->with($user)
            ->andReturn(true);

        $this->userServices = new UserServices(
            $userRepositoryMock
        );

        $userDeleted = $this->userServices->delete($user->id);

        $this->assertTrue($userDeleted);
    }
}
