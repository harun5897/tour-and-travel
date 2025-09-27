<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function createReport(Request $request){

        $request->validate([
            'start_date' => 'required|date_format:Y-m-d',
            'end_date'   => 'required|date_format:Y-m-d|after_or_equal:start_date',
        ]);
        $startDate = $request->input('start_date');
        $endDate   = $request->input('end_date');
        $bookings = Booking::with(['sales', 'package'])
            ->select(
                'id',
                'booking_code',
                'guest_name',
                'total_adult',
                'total_child',
                'package_id',
                'sales_id',
                'booking_date',
                'arrival_date',
                'departure_date',
                'price',
                'platform',
                'status',
                'created_at',
                'updated_at'
            )
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('booking_date', [
                    $startDate . ' 00:00:00',
                    $endDate . ' 23:59:59'
                ]);
            })
            ->get();

        $bookings->each(function ($booking) {
            $booking->sales_name = $booking->sales->name ?? '-';
            $booking->package_name = $booking->package->name ?? '-';
        });

        $pdf = Pdf::loadView('pdf.bookingReport', [
            'bookings' => $bookings,
            'start_date' => $startDate,
            'end_date' => $endDate
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('report-booking.pdf');
    }
}
