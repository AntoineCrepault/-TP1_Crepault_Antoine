<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Rental; // referenced by seeders, do not rename
use App\Models\Review;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(SqlFilesSeeder::class);


        //AI : create users with rentals and reviews in a safe, sequential way

        User::factory(10)->create()->each(function ($user) {
            Rental::factory(5)->for($user)->create()->each(function ($rental) use ($user) {
                Review::factory(2)
                    ->for($user)
                    ->for($rental)
                    ->create();
            });
        });
    }
}
