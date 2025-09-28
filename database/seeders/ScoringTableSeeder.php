<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ScoringTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('scorings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('scorings')->insert([
            ['id' => 37, 'id_package' => 1, 'id_criteria' => 1, 'id_sub_criteria' => 10, 'created_at' => '2025-09-28 00:32:43', 'updated_at' => '2025-09-28 06:56:05'],
            ['id' => 38, 'id_package' => 1, 'id_criteria' => 2, 'id_sub_criteria' => 13, 'created_at' => '2025-09-28 00:32:43', 'updated_at' => '2025-09-28 06:56:05'],
            ['id' => 39, 'id_package' => 1, 'id_criteria' => 3, 'id_sub_criteria' => 16, 'created_at' => '2025-09-28 00:32:43', 'updated_at' => '2025-09-28 06:56:05'],
            ['id' => 40, 'id_package' => 1, 'id_criteria' => 4, 'id_sub_criteria' => 19, 'created_at' => '2025-09-28 00:32:43', 'updated_at' => '2025-09-28 06:56:05'],
            ['id' => 41, 'id_package' => 2, 'id_criteria' => 1, 'id_sub_criteria' => 11, 'created_at' => '2025-09-28 00:33:00', 'updated_at' => '2025-09-28 00:33:00'],
            ['id' => 42, 'id_package' => 2, 'id_criteria' => 2, 'id_sub_criteria' => 13, 'created_at' => '2025-09-28 00:33:00', 'updated_at' => '2025-09-28 00:33:00'],
            ['id' => 43, 'id_package' => 2, 'id_criteria' => 3, 'id_sub_criteria' => 16, 'created_at' => '2025-09-28 00:33:00', 'updated_at' => '2025-09-28 00:33:00'],
            ['id' => 44, 'id_package' => 2, 'id_criteria' => 4, 'id_sub_criteria' => 20, 'created_at' => '2025-09-28 00:33:00', 'updated_at' => '2025-09-28 00:33:00'],
            ['id' => 45, 'id_package' => 3, 'id_criteria' => 1, 'id_sub_criteria' => 11, 'created_at' => '2025-09-28 00:33:34', 'updated_at' => '2025-09-28 00:33:34'],
            ['id' => 46, 'id_package' => 3, 'id_criteria' => 2, 'id_sub_criteria' => 14, 'created_at' => '2025-09-28 00:33:34', 'updated_at' => '2025-09-28 00:33:34'],
            ['id' => 47, 'id_package' => 3, 'id_criteria' => 3, 'id_sub_criteria' => 15, 'created_at' => '2025-09-28 00:33:34', 'updated_at' => '2025-09-28 00:33:34'],
            ['id' => 48, 'id_package' => 3, 'id_criteria' => 4, 'id_sub_criteria' => 20, 'created_at' => '2025-09-28 00:33:34', 'updated_at' => '2025-09-28 00:33:34'],
            ['id' => 49, 'id_package' => 4, 'id_criteria' => 1, 'id_sub_criteria' => 10, 'created_at' => '2025-09-28 00:33:53', 'updated_at' => '2025-09-28 00:33:53'],
            ['id' => 50, 'id_package' => 4, 'id_criteria' => 2, 'id_sub_criteria' => 14, 'created_at' => '2025-09-28 00:33:53', 'updated_at' => '2025-09-28 00:33:53'],
            ['id' => 51, 'id_package' => 4, 'id_criteria' => 3, 'id_sub_criteria' => 17, 'created_at' => '2025-09-28 00:33:53', 'updated_at' => '2025-09-28 00:33:53'],
            ['id' => 52, 'id_package' => 4, 'id_criteria' => 4, 'id_sub_criteria' => 20, 'created_at' => '2025-09-28 00:33:53', 'updated_at' => '2025-09-28 00:33:53'],
            ['id' => 53, 'id_package' => 5, 'id_criteria' => 1, 'id_sub_criteria' => 10, 'created_at' => '2025-09-28 00:34:13', 'updated_at' => '2025-09-28 00:34:13'],
            ['id' => 54, 'id_package' => 5, 'id_criteria' => 2, 'id_sub_criteria' => 13, 'created_at' => '2025-09-28 00:34:13', 'updated_at' => '2025-09-28 00:34:13'],
            ['id' => 55, 'id_package' => 5, 'id_criteria' => 3, 'id_sub_criteria' => 17, 'created_at' => '2025-09-28 00:34:13', 'updated_at' => '2025-09-28 00:34:13'],
            ['id' => 56, 'id_package' => 5, 'id_criteria' => 4, 'id_sub_criteria' => 18, 'created_at' => '2025-09-28 00:34:13', 'updated_at' => '2025-09-28 00:34:13'],
        ]);
    }
}