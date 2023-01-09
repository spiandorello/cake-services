<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URI = '/api/users';

    public function test_index_user_endpoint(): void
    {
        User::factory(10)->create();

        $response = $this->getJson(uri: self::BASE_URI);

        $response->assertStatus(status: Response::HTTP_OK);

        $response
            ->assertJson(fn (AssertableJson $json) => $json
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
                        'email',
                        'created_at',
                        'updated_at',
                    ])
                )
            );
    }

    public function test_show_user_endpoint(): void
    {
        $user = User::factory(1)->createOne();

        $response = $this->getJson(uri: self::BASE_URI . '/' . $user->id);

        $response->assertStatus(status: Response::HTTP_OK);

        $response
            ->assertJson(function (AssertableJson $json) use ($user) {
                $json->hasAll([
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ]);

                $json->whereAll([
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                ])->etc();
            });
    }

    public function test_store_user_endpoint(): void
    {
        $createCakeRequestParams = [
            'name' => fake()->name,
            'email' => fake()->email,
        ];

        $response = $this->post(uri: self::BASE_URI, data: $createCakeRequestParams);

        $response->assertStatus(status: Response::HTTP_CREATED);

        $response
            ->assertJson(function (AssertableJson $json) use ($createCakeRequestParams) {
                $json->hasAll([
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                ]);

                $json->whereAll([
                    'name' => $createCakeRequestParams['name'],
                    'email' => $createCakeRequestParams['email'],
                ])->etc();
            });
    }

    public function test_update_user_endpoint(): void
    {
        $user = User::factory(1)->createOne();

        $createCakeRequestParams = [
            'name' => fake()->name,
            'email' => fake()->email,
        ];

        $response = $this->put(uri: self::BASE_URI . '/'. $user['id'], data: $createCakeRequestParams);

        $response->assertStatus(status: Response::HTTP_OK);
    }

    public function test_delete_user_endpoint(): void
    {
        $user = User::factory(1)->createOne();

        $response = $this->delete(uri: self::BASE_URI . '/'. $user['id']);

        $response->assertStatus(status: Response::HTTP_NO_CONTENT);
    }
}