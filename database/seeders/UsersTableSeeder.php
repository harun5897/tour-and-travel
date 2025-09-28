<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'password' => '$2y$10$JASLRh/dBy7G1gN1oIOtnOpuMu5Vr4QoNPcZCy/yfpazbwMeNtC66',
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'joe',
                'email' => 'joe@example.com',
                'password' => '$2y$10$ObOCslLQzWrDSSxGRJzU1.FO1IzjTUzh4Z9CU0Cy9TT9XsCT5WKSW',
                'role' => 'super_admin',
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Rudi',
                'email' => 'rudi@example.com',
                'password' => '$2y$10$aFXo0wKya9fN1PLKwO.dde//hA96xKPyfCZxi3WF86NDh.xqz5PE.',
                'role' => 'admin',
            ],
        ]);
    }
}