<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('packages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('packages')->insert([
            [
                'id' => 1,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-28 00:36:53',
                'category_id' => 1,
                'name' => 'Paket wisata 1',
                'description' => 'Layanan ferry kelas ekonomi untuk perjalanan laut.',
                'cost' => 3000000.00,
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-28 00:37:04',
                'category_id' => 2,
                'name' => 'Paket wisata 2',
                'description' => 'Paket wisata keliling kota dengan pemandu.',
                'cost' => 3000000.00,
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-28 00:37:12',
                'category_id' => 3,
                'name' => 'Paket wisata 3',
                'description' => 'Paket perjalanan menginap 1 malam, cocok untuk akhir pekan.',
                'cost' => 3000000.00,
            ],
            [
                'id' => 4,
                'created_at' => '2025-09-28 00:25:29',
                'updated_at' => '2025-09-28 00:25:29',
                'category_id' => 1,
                'name' => 'Paket wisata 4',
                'description' => 'Hanya menggunakan kapal one way',
                'cost' => 1000000.00,
            ],
            [
                'id' => 5,
                'created_at' => '2025-09-28 00:26:12',
                'updated_at' => '2025-09-28 00:26:12',
                'category_id' => 2,
                'name' => 'Paket wisata 5',
                'description' => 'Pergi ke beberapa tempat wisata',
                'cost' => 1500000.00,
            ],
        ]);
    }
}