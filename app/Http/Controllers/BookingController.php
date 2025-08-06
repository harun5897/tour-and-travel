<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Package;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function getDataBooking() {
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
            ->get();

        $bookings->each(function ($booking) {
            $booking->sales_name = $booking->sales->name ?? '-';
            $booking->package_name = $booking->package->name ?? '-';
        });

        return view('bookings', [
            'bookings' => $bookings,
        ]);
    }
    public function getDetailDataBooking($id) {
        $booking = Booking::with(['sales', 'package'])->findOrFail($id);
        $sales = Sales::all();
        $packages = Package::all();

        return view('form.update-booking', compact('booking', 'sales', 'packages'));
    }

    public function showFormCreateBooking() {
        $packages = Package::select('id', 'name')->get();
        $sales = Sales::select('id', 'name')->get();

        return view('form/create-booking', [
            'packages' => $packages,
            'sales' => $sales
        ]);
    }
    public function createBooking(Request $request) {
        $request->validate([
            'booking_code'    => 'required|string|max:50|unique:bookings,booking_code',
            'guest_name'      => 'required|string|max:50',
            'total_adult'     => 'required|integer|min:0',
            'total_child'     => 'required|integer|min:0',
            'package_id'      => 'required|exists:packages,id',
            'booking_date'    => 'required|date',
            'arrival_date'    => 'required|date|after_or_equal:booking_date',
            'departure_date'  => 'required|date|after_or_equal:arrival_date',
            'price'           => 'required|numeric|min:0',
            'platform'        => 'required|string|in:whatsapp,email,facebook,instagram',
            'sales_id'        => 'required|exists:sales,id',
            'status'          => 'required|in:not_paid,completed,cancel,refund',
        ]);

        Booking::create([
            'booking_code'   => $request->booking_code,
            'guest_name'     => $request->guest_name,
            'total_adult'    => $request->total_adult,
            'total_child'    => $request->total_child,
            'package_id'     => $request->package_id,
            'booking_date'   => $request->booking_date,
            'arrival_date'   => $request->arrival_date,
            'departure_date' => $request->departure_date,
            'price'          => $request->price,
            'platform'       => $request->platform,
            'sales_id'       => $request->sales_id,
            'status'         => $request->status,
        ]);

        return redirect('/bookings')->with('success', 'Booking created successfully.');
    }
    public function updateBooking(Request $request, $id) {
        $request->validate([
            'booking_code'    => 'required|string|max:50|unique:bookings,booking_code,' . $id,
            'guest_name'      => 'required|string|max:50',
            'total_adult'     => 'required|integer|min:0',
            'total_child'     => 'required|integer|min:0',
            'package_id'      => 'required|exists:packages,id',
            'booking_date'    => 'required|date',
            'arrival_date'    => 'required|date|after_or_equal:booking_date',
            'departure_date'  => 'required|date|after_or_equal:arrival_date',
            'price'           => 'required|numeric|min:0',
            'platform'        => 'required|string|in:whatsapp,email,facebook,instagram',
            'sales_id'        => 'required|exists:sales,id',
            'status'          => 'required|in:not_paid,completed,cancel,refund',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->booking_code   = $request->booking_code;
        $booking->guest_name     = $request->guest_name;
        $booking->total_adult    = $request->total_adult;
        $booking->total_child    = $request->total_child;
        $booking->package_id     = $request->package_id;
        $booking->booking_date   = $request->booking_date;
        $booking->arrival_date   = $request->arrival_date;
        $booking->departure_date = $request->departure_date;
        $booking->price          = $request->price;
        $booking->platform       = $request->platform;
        $booking->sales_id       = $request->sales_id;
        $booking->status         = $request->status;

        $booking->save();

        return redirect('/bookings')->with('success', 'Booking updated successfully.');
    }
    public function deleteBooking($id) {
        $booking= Booking::findOrFail($id);
        $booking->delete();

        return redirect('/bookings')->with('success', 'Booking deleted successfully.');
    }
}
