<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sub_criterias')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('sub_criterias')->insert([
            [
                'id' => 10,
                'id_criteria' => 1,
                'sub_criteria' => 'Local',
                'value' => 1.00,
                'created_at' => '2025-09-28 00:27:06',
                'updated_at' => '2025-09-28 00:27:06',
            ],
            [
                'id' => 11,
                'id_criteria' => 1,
                'sub_criteria' => 'Mancanegara',
                'value' => 2.00,
                'created_at' => '2025-09-28 00:27:14',
                'updated_at' => '2025-09-28 00:27:14',
            ],
            [
                'id' => 12,
                'id_criteria' => 2,
                'sub_criteria' => '< 1 Juta',
                'value' => 3.00,
                'created_at' => '2025-09-28 00:28:03',
                'updated_at' => '2025-09-28 00:28:03',
            ],
            [
                'id' => 13,
                'id_criteria' => 2,
                'sub_criteria' => '1 juta - 3 juta',
                'value' => 2.00,
                'created_at' => '2025-09-28 00:28:19',
                'updated_at' => '2025-09-28 00:28:19',
            ],
            [
                'id' => 14,
                'id_criteria' => 2,
                'sub_criteria' => '> 3 juta',
                'value' => 1.00,
                'created_at' => '2025-09-28 00:28:30',
                'updated_at' => '2025-09-28 00:31:29',
            ],
            [
                'id' => 15,
                'id_criteria' => 3,
                'sub_criteria' => '<= 3 Hari',
                'value' => 3.00,
                'created_at' => '2025-09-28 00:29:01',
                'updated_at' => '2025-09-28 00:29:01',
            ],
            [
                'id' => 16,
                'id_criteria' => 3,
                'sub_criteria' => '> 3 Hari & <= 10 Hari',
                'value' => 2.00,
                'created_at' => '2025-09-28 00:29:34',
                'updated_at' => '2025-09-28 00:29:34',
            ],
            [
                'id' => 17,
                'id_criteria' => 3,
                'sub_criteria' => '> 10 Hari',
                'value' => 1.00,
                'created_at' => '2025-09-28 00:29:48',
                'updated_at' => '2025-09-28 00:29:48',
            ],
            [
                'id' => 18,
                'id_criteria' => 4,
                'sub_criteria' => '1 - 3 Orang',
                'value' => 1.00,
                'created_at' => '2025-09-28 00:30:09',
                'updated_at' => '2025-09-28 00:30:09',
            ],
            [
                'id' => 19,
                'id_criteria' => 4,
                'sub_criteria' => '4 - 10 Orang',
                'value' => 2.00,
                'created_at' => '2025-09-28 00:30:27',
                'updated_at' => '2025-09-28 00:30:27',
            ],
            [
                'id' => 20,
                'id_criteria' => 4,
                'sub_criteria' => '> 10 Orang',
                'value' => 3.00,
                'created_at' => '2025-09-28 00:30:46',
                'updated_at' => '2025-09-28 00:30:46',
            ],
        ]);
    }
}