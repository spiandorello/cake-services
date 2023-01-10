<?php

namespace Tests\Unit\Services;

use App\Exceptions\CakeSubscriber\CakeUserAlreadySubscribedException;
use App\Models\Cake;
use App\Models\CakeSubscriber;
use App\Models\User;
use App\Repositories\CakeSubscriberRepository\CakeSubscriberRepositoryInterface;
use App\Services\CakeServices;
use App\Services\CakeSubscriberServices;
use App\Services\UserServices;
use Illuminate\Support\Str;
use Tests\TestCase;

class CakeSubscriberServicesTest extends TestCase
{
    public function test_cake_subscribe(): void
    {
        $cakeSubscriber = CakeSubscriber::factory()->make();
        $user = User::factory()->createOne();
        $cake = Cake::factory()->createOne();

        $cakeServicesMock = \Mockery::mock(CakeServices::class);
        $cakeServicesMock->shouldReceive('listOne')
            ->once()
            ->with($cake->id)
            ->andReturn($cake);

        $userServicesMock = \Mockery::mock(UserServices::class);
        $userServicesMock->shouldReceive('listOne')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $cakeSubscriberRepositoryMock = \Mockery::mock(CakeSubscriberRepositoryInterface::class);
        $cakeSubscriberRepositoryMock->shouldReceive('findBy')
            ->once()
            ->andReturn(null);

        $cakeSubscriberRepositoryMock->shouldReceive('create')
            ->once()
            ->with([
                'user_id' => $user['id'],
                'cake_id' => $cake['id'],
            ])
            ->andReturn($cakeSubscriber);

        $cakeSubscriberServices = new CakeSubscriberServices(
            $userServicesMock,
            $cakeServicesMock,
            $cakeSubscriberRepositoryMock,
        );

        $cakeSubscriberServices->subscribe(
            userId: $user->id,
            cakeId: $cake->id,
        );
    }

    public function test_cake_subscribe_already_subscribed(): void
    {
        $cakeSubscriber = CakeSubscriber::factory()->make();

        $user = User::factory()->make();
        $user->id = (Str::uuid())->toString();

        $cake = Cake::factory()->make();
        $cake->id = (Str::uuid())->toString();

        $cakeServicesMock = \Mockery::mock(CakeServices::class);
        $cakeServicesMock->shouldReceive('listOne')
            ->once()
            ->with($cake->id)
            ->andReturn($cake);

        $userServicesMock = \Mockery::mock(UserServices::class);
        $userServicesMock->shouldReceive('listOne')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $cakeSubscriberRepositoryMock = \Mockery::mock(CakeSubscriberRepositoryInterface::class);
        $cakeSubscriberRepositoryMock->shouldReceive('findBy')
            ->once()
            ->andReturn($cakeSubscriber);

        $cakeSubscriberServices = new CakeSubscriberServices(
            $userServicesMock,
            $cakeServicesMock,
            $cakeSubscriberRepositoryMock,
        );

        $this->expectException(CakeUserAlreadySubscribedException::class);

        $cakeSubscriberServices->subscribe(
            userId: $user->id,
            cakeId: $cake->id,
        );
    }

    public function test_cake_unsubscribe(): void
    {
        $cakeSubscriber = CakeSubscriber::factory()->make();

        $user = User::factory()->make();
        $user->id = (Str::uuid())->toString();

        $cake = Cake::factory()->make();
        $cake->id = (Str::uuid())->toString();

        $cakeServicesMock = \Mockery::mock(CakeServices::class);
        $cakeServicesMock->shouldReceive('listOne')
            ->once()
            ->with($cake->id)
            ->andReturn($cake);

        $userServicesMock = \Mockery::mock(UserServices::class);
        $userServicesMock->shouldReceive('listOne')
            ->once()
            ->with($user->id)
            ->andReturn($user);

        $cakeSubscriberRepositoryMock = \Mockery::mock(CakeSubscriberRepositoryInterface::class);
        $cakeSubscriberRepositoryMock->shouldReceive('findBy')
            ->once()
            ->andReturn($cakeSubscriber);

        $cakeSubscriberRepositoryMock->shouldReceive('delete')
            ->once()
            ->with($cakeSubscriber)
            ->andReturn(true);

        $cakeSubscriberServices = new CakeSubscriberServices(
            $userServicesMock,
            $cakeServicesMock,
            $cakeSubscriberRepositoryMock,
        );

        $cakeSubscriberServices->unsubscribe(
            userId: $user->id,
            cakeId: $cake->id,
        );
    }
}
