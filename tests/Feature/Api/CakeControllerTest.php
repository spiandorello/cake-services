<?php

namespace Tests\Feature\Api;

use App\Models\Cake;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;

class CakeControllerTest extends TestCase
{
    const BASE_URI = '/api/cakes';

    public function test_index_cake_endpoint(): void
    {
        Cake::factory(10)->create();

        $response = $this->getJson(uri: self::BASE_URI);

        $response->assertStatus(status: Response::HTTP_OK);

        $response
            ->assertJson(fn(AssertableJson $json) => $json
                ->hasAll([
                    'current_page',
                    'data',
                    'first_page_url',
                    'from',
                    'next_page_url',
                    'path',
                    'per_page',
                    'prev_page_url',
                    'to',
                ])
                ->has('data.0', fn ($json) =>
                    $json->hasAll([
                        'id',
                        'name',
                        'description',
                        'weight',
                        'price',
                        'available_quantity',
                        'created_at',
                        'updated_at',
                    ])
                )
            );
    }

    public function test_show_cake_endpoint(): void
    {
        $cake = Cake::factory(1)->createOne();

        $response = $this->getJson(uri: self::BASE_URI . '/' . $cake['id']);

        $response->assertStatus(status: Response::HTTP_OK);

        $response
            ->assertJson(function (AssertableJson $json) use ($cake) {
                $json
                    ->hasAll([
                        'id',
                        'name',
                        'description',
                        'weight',
                        'price',
                        'available_quantity',
                        'created_at',
                        'updated_at',
                    ]);

                $json
                    ->whereAll([
                        'id' => $cake['id'],
                        'name' => $cake['name'],
                        'description' => $cake['description'],
                        'weight' => $cake['weight'],
                        'price' => $cake['price'],
                        'available_quantity' => $cake['available_quantity'],
                    ])->etc();
            }
        );
    }

    public function test_store_cake_endpoint(): void
    {
        $createCakeRequestParams = [
            'name' => fake()->text(25),
            'description' => fake()->text(100),
            'weight' => fake()->numberBetween(1, 1000),
            'price' => fake()->numberBetween(1, 100),
            'available_quantity' => fake()->numberBetween(1, 100),
        ];

        $response = $this->post(uri: self::BASE_URI, data: $createCakeRequestParams);

        $response->assertStatus(status: Response::HTTP_CREATED);
    }

    public function test_update_cake_endpoint(): void
    {
        $cake = Cake::factory(1)->createOne();

        $createCakeRequestParams = [
            'name' => fake()->text(25),
            'description' => fake()->text(100),
            'weight' => fake()->numberBetween(1, 1000),
            'price' => fake()->numberBetween(1, 100),
            'available_quantity' => fake()->numberBetween(1, 100),
        ];

        $response = $this->put(uri: self::BASE_URI . '/' . $cake['id'], data: $createCakeRequestParams);

        $response->assertStatus(status: Response::HTTP_OK);
    }

    public function test_delete_cake_endpoint(): void
    {
        $cake = Cake::factory(1)->createOne();

        $response = $this->delete(uri: self::BASE_URI . '/' . $cake['id']);

        $response->assertStatus(status: Response::HTTP_NO_CONTENT);
    }
}