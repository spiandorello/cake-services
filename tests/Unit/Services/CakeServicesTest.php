<?php

namespace Tests\Unit\Services;

use App\Models\Cake;
use App\Repositories\CakeRepository\CakeRepositoryInterface;
use App\Services\CakeServices;
use Illuminate\Support\Str;
use Tests\TestCase;

class CakeServicesTest extends TestCase
{
    private readonly CakeServices $cakeServices;

    public function test_list_one_cake(): void
    {
        $cake = Cake::factory()->make();
        $cake->id = (Str::uuid())->toString();

        $cakeRepositoryMock = \Mockery::mock(CakeRepositoryInterface::class);
        $cakeRepositoryMock->shouldReceive('find')
            ->once()
            ->with($cake->id)
            ->andReturn($cake);

        $this->cakeServices = new CakeServices(
            $cakeRepositoryMock
        );

        $this->cakeServices->listOne($cake->id);
    }

    public function test_list_all_cake(): void
    {
        $cake = Cake::factory()->make();
        $cake->id = (Str::uuid())->toString();

        $cakeRepositoryMock = \Mockery::mock(CakeRepositoryInterface::class);
        $cakeRepositoryMock->shouldReceive('listPaginated')
            ->once();

        $this->cakeServices = new CakeServices(
            $cakeRepositoryMock
        );

        $this->cakeServices->list();
    }

    public function test_create_a_cake(): void
    {
        $cakeCreateParams = [
            'name' => fake()->name(),
            'description' => fake()->text(60),
            'weight' => fake()->numberBetween(1, 1000),
            'price' => fake()->numberBetween(1, 200),
            'available_quantity' => fake()->numberBetween(0, 100),
        ];

        $cake = Cake::factory()->make($cakeCreateParams);

        $cakeRepositoryMock = \Mockery::mock(CakeRepositoryInterface::class);
        $cakeRepositoryMock->shouldReceive('create')
            ->once()
            ->with($cakeCreateParams)
            ->andReturn($cake);

        $this->cakeServices = new CakeServices(
            $cakeRepositoryMock
        );

        $cake = $this->cakeServices->create($cakeCreateParams);

        $this->assertEquals(
            expected: $cakeCreateParams,
            actual: $cake->toArray(),
        );
    }

    public function test_edit_a_cake(): void
    {
        $cakeEditParams = [
            'name' => fake()->name(),
            'description' => fake()->text(60),
            'weight' => fake()->numberBetween(1, 1000),
            'price' => fake()->numberBetween(1, 200),
            'available_quantity' => fake()->numberBetween(0, 100),
        ];

        $cake = Cake::factory()->make($cakeEditParams);
        Cake::saving(fn () => false);

        $cake->id = (Str::uuid())->toString();
        $cakeEditParams['id'] = $cake->id;

        $cakeRepositoryMock = \Mockery::mock(CakeRepositoryInterface::class);
        $cakeRepositoryMock->shouldReceive('find')
            ->once()
            ->with($cake->id)
            ->andReturn($cake);

        $cakeRepositoryMock->shouldReceive('flush')
            ->once()
            ->with($cake)
            ->andReturn(true);

        $this->cakeServices = new CakeServices(
            $cakeRepositoryMock
        );

        $cake = $this->cakeServices->edit($cake->id, $cakeEditParams);

        $this->assertEquals(
            expected: $cakeEditParams,
            actual: $cake->toArray(),
        );
    }

    public function test_delete_a_cake(): void
    {
        $cake = Cake::factory()->make();
        Cake::deleting(fn () => false);

        $cake->id = (Str::uuid())->toString();

        $cakeRepositoryMock = \Mockery::mock(CakeRepositoryInterface::class);
        $cakeRepositoryMock->shouldReceive('find')
            ->once()
            ->with($cake->id)
            ->andReturn($cake);

        $cakeRepositoryMock->shouldReceive('delete')
            ->once()
            ->with($cake)
            ->andReturn(true);

        $this->cakeServices = new CakeServices(
            $cakeRepositoryMock
        );

        $cakeDeleted = $this->cakeServices->delete($cake->id);

        $this->assertTrue($cakeDeleted);
    }
}
