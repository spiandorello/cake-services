<?php

namespace Tests\Feature\Api;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Http\Response;

class CakeControllerTest extends TestCase
{
    const BASE_URI = '/api/cakes';

    public function test_index_cake_endpoint(): void
    {
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
        $response = $this->getJson(uri: self::BASE_URI . '/982cd9cc-fed0-4c12-b2df-db024187250');

        $response->assertStatus(status: Response::HTTP_OK);

        $response
            ->assertJson(fn(AssertableJson $json) => $json
                ->hasAll([
                    'id',
                    'name',
                    'description',
                    'weight',
                    'price',
                    'available_quantity',
                    'created_at',
                    'updated_at',
                ])
            );
    }

    public function test_store_cake_endpoint(): void
    {
        $createCakeRequestParams = [
            'name' => 'Chocolate',
            'description' => 'An delicious chocolate`s cake',
            'weight' => 200,
            'price' => 20.00,
            'available_quantity' => 10,
        ];

        $response = $this->post(uri: self::BASE_URI, data: $createCakeRequestParams);

        $response->assertStatus(status: Response::HTTP_CREATED);
    }

    public function test_update_cake_endpoint(): void
    {
        $createCakeRequestParams = [
            'name' => 'Chocolate',
            'description' => 'An delicious chocolate`s cake',
            'weight' => 200,
            'price' => 20.00,
            'available_quantity' => 10,
        ];

        $response = $this->put(uri: self::BASE_URI . '/982cdd3b-510e-4d0d-a9ca-34d76e5d933a', data: $createCakeRequestParams);

        $response->assertStatus(status: Response::HTTP_OK);
    }

    public function test_delete_cake_endpoint(): void
    {
        $response = $this->delete(uri: self::BASE_URI . '/982cdd3b-510e-4d0d-a9ca-34d76e5d933a');

        $response->assertStatus(status: Response::HTTP_OK);
    }
}