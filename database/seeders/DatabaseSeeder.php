<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name'  => 'Mohamed Alsayed',
            'email' => 'm@m.com',
            'role'  => User::LEADER
        ]);

        User::factory(10)->create();

        $users = User::all();

        for ($i = 0; $i < 150; $i++) {
            $id = $users->random()->id;

            Product::factory()->create([
                'user_id'   => $id
            ]);
        }

        $products = Product::all();

        for ($i = 0; $i < 1000; $i++) {
            $id = $products->random()->id;

            Image::factory()->create([
                'imageable_type'    => Product::class,
                'imageable_id'      => $id
            ]);
        }
    }
}
