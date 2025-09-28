<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('categories')->insert([
            [
                'id' => 1,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Ferry',
                'description' => 'Kategori layanan transportasi laut',
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Tour',
                'description' => 'Kategori untuk paket perjalanan wisata',
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => '2D1N',
                'description' => 'Paket perjalanan 2 hari 1 malam',
            ],
            [
                'id' => 4,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => '3D2N',
                'description' => 'Paket perjalanan 3 hari 2 malam',
            ],
        ]);
    }
}