<?php

namespace Database\Factories;

use App\Models\Cake;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CakeSubscriberFactory extends Factory
{
    public function definition(): array
    {
        $user = User::factory(1)->createOne();
        $cake = Cake::factory(1)->createOne();

        return [
            'user_id' => $user['id'],
            'cake_id' => $cake['id'],
        ];
    }
}
