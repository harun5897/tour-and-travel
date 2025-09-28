<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('criterias')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('criterias')->insert([
            [
                'id' => 1,
                'created_at' => '2025-09-21 23:52:46',
                'updated_at' => '2025-09-21 23:52:46',
                'criteria' => 'Lokasi',
                'value' => 35.00,
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 23:53:01',
                'updated_at' => '2025-09-21 23:53:01',
                'criteria' => 'Harga',
                'value' => 30.00,
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 23:53:19',
                'updated_at' => '2025-09-21 23:53:19',
                'criteria' => 'Lama Perjalanan',
                'value' => 20.00,
            ],
            [
                'id' => 4,
                'created_at' => '2025-09-21 23:53:35',
                'updated_at' => '2025-09-21 23:53:35',
                'criteria' => 'Jumlah Peserta',
                'value' => 15.00,
            ],
        ]);
    }
}