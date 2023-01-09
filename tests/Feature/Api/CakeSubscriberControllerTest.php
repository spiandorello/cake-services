<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CakeSubscriberControllerTest extends TestCase
{
    use RefreshDatabase;

    const BASE_URI = '/api/cakes-subscriber';
}