<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('bookings')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('bookings')->insert([
            [
                'id' => 1,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'booking_code' => 'HU0BMWCB',
                'guest_name' => 'John Doe',
                'total_adult' => 2,
                'total_child' => 1,
                'package_id' => 1,
                'booking_date' => '2025-08-01',
                'arrival_date' => '2025-08-10',
                'departure_date' => '2025-08-15',
                'price' => 3000000.00,
                'platform' => 'whatsapp',
                'sales_id' => 1,
                'status' => 'cancel',
            ],
            [
                'id' => 2,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'booking_code' => 'BSNDYCKZ',
                'guest_name' => 'Jane Smith',
                'total_adult' => 1,
                'total_child' => 2,
                'package_id' => 2,
                'booking_date' => '2025-08-02',
                'arrival_date' => '2025-08-12',
                'departure_date' => '2025-08-14',
                'price' => 3000000.00,
                'platform' => 'email',
                'sales_id' => 2,
                'status' => 'not_paid',
            ],
            [
                'id' => 3,
                'created_at' => '2025-09-21 21:40:07',
                'updated_at' => '2025-09-21 21:40:07',
                'booking_code' => 'RZTDZSNX',
                'guest_name' => 'Alice Johnson',
                'total_adult' => 3,
                'total_child' => 0,
                'package_id' => 3,
                'booking_date' => '2025-08-03',
                'arrival_date' => '2025-08-20',
                'departure_date' => '2025-08-22',
                'price' => 3000000.00,
                'platform' => 'facebook',
                'sales_id' => 3,
                'status' => 'completed',
            ],
        ]);
    }
}