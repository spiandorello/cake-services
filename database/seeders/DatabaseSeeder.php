<?php

namespace Database\Seeders;

use App\Models\Cake;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory(10)->create();
        Cake::factory(10)->create();
    }
}
