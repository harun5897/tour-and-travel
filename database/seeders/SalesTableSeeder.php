<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sales')->insert([
            [
                'name' => 'Ahmad',
                'phone_number' => '08123456789',
                'email' => 'ahmad@example.com',
                'address' => 'Jl. Mawar No. 123',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Dina',
                'phone_number' => '08987654321',
                'email' => 'dina@example.com',
                'address' => 'Jl. Melati No. 456',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Bayu',
                'phone_number' => '08561234567',
                'email' => 'bayu@example.com',
                'address' => 'Jl. Kenanga No. 789',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
