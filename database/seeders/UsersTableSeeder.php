<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('users')->insert([
            [
                'id' => 1,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Jhon',
                'email' => 'john@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'joe',
                'email' => 'joe@example.com',
                'password' => Hash::make('password123'),
                'role' => 'super_admin',
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Rudi',
                'email' => 'rudi@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'id' => 4,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Customer User',
                'email' => 'customer@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ],
        ]);
    }
}
