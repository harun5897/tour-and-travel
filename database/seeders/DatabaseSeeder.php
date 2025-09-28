<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SalesTableSeeder::class,
            CategoryTableSeeder::class,
            CriteriaTableSeeder::class,
            PackageTableSeeder::class,
            SubCriteriaTableSeeder::class,
            BookingTableSeeder::class,
            ScoringTableSeeder::class,
        ]);
    }
}