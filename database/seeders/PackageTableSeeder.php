<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Category;

class PackageTableSeeder extends Seeder
{
    public function run(): void
    {
        $ferryCategoryId = Category::where('name', 'Ferry')->value('id');
        $tourCategoryId = Category::where('name', 'Tour')->value('id');
        $twoDOneNCategoryId = Category::where('name', '2D1N')->value('id');

        DB::table('packages')->insert([
            [
                'category_id' => $ferryCategoryId,
                'name' => 'Paket Ferry Ekonomi',
                'description' => 'Layanan ferry kelas ekonomi untuk perjalanan laut.',
                'cost' => 3000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $tourCategoryId,
                'name' => 'Paket Tour City',
                'description' => 'Paket wisata keliling kota dengan pemandu.',
                'cost' => 3000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'category_id' => $twoDOneNCategoryId,
                'name' => 'Paket Liburan 2D1N',
                'description' => 'Paket perjalanan menginap 1 malam, cocok untuk akhir pekan.',
                'cost' => 3000000,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
