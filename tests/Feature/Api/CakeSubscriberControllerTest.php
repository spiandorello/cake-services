<?php

namespace Tests\Feature\Api;

use App\Models\Cake;
use App\Models\CakeSubscriber;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CakeSubscriberControllerTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URI = '/api/cakes-subscriber';

    public function test_cake_subscribe_endpoint(): void
    {
        $user = User::factory(1)->createOne();
        $cake = Cake::factory(1)->createOne();

        $response = $this->post(uri: sprintf('/%s/%s/%s',
            self::BASE_URI,
            $user['id'],
            $cake['id'],
        ));

        $response->assertStatus(status: Response::HTTP_CREATED);
    }

    public function test_cake_unsubscribe_endpoint(): void
    {
        $cakeSubscriber = CakeSubscriber::factory(1)->createOne();

        $user = $cakeSubscriber->user();
        $cake = $cakeSubscriber->cake();

        $response = $this->delete(uri: sprintf('/%s/%s/%s',
            self::BASE_URI,
            $user['id'],
            $cake['id'],
        ));

        $response->assertStatus(status: Response::HTTP_OK);
    }
}