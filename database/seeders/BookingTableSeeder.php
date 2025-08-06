<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use App\Models\Package;
use App\Models\Sales;

class BookingTableSeeder extends Seeder
{
    public function run(): void
    {
        $package1 = Package::where('name', 'Paket Ferry Ekonomi')->value('id');
        $package2 = Package::where('name', 'Paket Tour City')->value('id');
        $package3 = Package::where('name', 'Paket Liburan 2D1N')->value('id');

        // Ambil sales_id dari nama sales
        $sales1 = Sales::where('name', 'Ahmad')->value('id');
        $sales2 = Sales::where('name', 'Dina')->value('id');
        $sales3 = Sales::where('name', 'Bayu')->value('id');

        DB::table('bookings')->insert([
            [
                'booking_code'   => strtoupper(Str::random(8)),
                'guest_name'     => 'John Doe',
                'total_adult'    => 2,
                'total_child'    => 1,
                'package_id'     => $package1,
                'booking_date'   => Carbon::parse('2025-08-01'),
                'arrival_date'   => Carbon::parse('2025-08-10'),
                'departure_date' => Carbon::parse('2025-08-15'),
                'price'          => 3000000,
                'platform'       => 'whatsapp',
                'sales_id'       => $sales1,
                'status'         => 'cancel',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'booking_code'   => strtoupper(Str::random(8)),
                'guest_name'     => 'Jane Smith',
                'total_adult'    => 1,
                'total_child'    => 2,
                'package_id'     => $package2,
                'booking_date'   => Carbon::parse('2025-08-02'),
                'arrival_date'   => Carbon::parse('2025-08-12'),
                'departure_date' => Carbon::parse('2025-08-14'),
                'price'          => 3000000,
                'platform'       => 'email',
                'sales_id'       => $sales2,
                'status'         => 'not_paid',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
            [
                'booking_code'   => strtoupper(Str::random(8)),
                'guest_name'     => 'Alice Johnson',
                'total_adult'    => 3,
                'total_child'    => 0,
                'package_id'     => $package3,
                'booking_date'   => Carbon::parse('2025-08-03'),
                'arrival_date'   => Carbon::parse('2025-08-20'),
                'departure_date' => Carbon::parse('2025-08-22'),
                'price'          => 3000000,
                'platform'       => 'facebook',
                'sales_id'       => $sales3,
                'status'         => 'completed',
                'created_at'     => Carbon::now(),
                'updated_at'     => Carbon::now(),
            ],
        ]);
    }
}
