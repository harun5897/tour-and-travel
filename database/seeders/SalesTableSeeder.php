<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sales')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('sales')->insert([
            [
                'id' => 1,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Ahmad',
                'phone_number' => '08123456789',
                'email' => 'ahmad@example.com',
                'address' => 'Jl. Mawar No. 123',
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Dina',
                'phone_number' => '08987654321',
                'email' => 'dina@example.com',
                'address' => 'Jl. Melati No. 456',
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'name' => 'Bayu',
                'phone_number' => '08561234567',
                'email' => 'bayu@example.com',
                'address' => 'Jl. Kenanga No. 789',
            ],
        ]);
    }
}