<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Report Booking</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            background: #fff;
            padding: 0px;
        }
        h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 8px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background: #f3f4f6;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background: #fafafa;
        }
        .text-center {
            text-align: center;
        }
        .text-muted {
            color: #777;
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ public_path('assets/logo.jpg') }}" alt="Logo" width="100px">
        <h2 style="margin: 0px;">Tour And Travel</h2>
        <h4 style="margin: 5px;">Jalan Raya Dompak, Komplek Ruko D'Green City Block D No 8A, Tanjungpinang, Kepulauan Riau</h4>
        <hr>
    </div>
    <h6>From {{ \Carbon\Carbon::parse($start_date)->format('d F Y') }} to {{ \Carbon\Carbon::parse($end_date)->format('d F Y') }} </h6>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Booking Code</th>
                <th>Guest Name</th>
                <th>Adult</th>
                <th>Child</th>
                <th>Sales Name</th>
                <th>Package Name</th>
                <th>Booking Date</th>
                <th>Arrival Date</th>
                <th>Departure Date</th>
                <th>Price</th>
                <th>Platform</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->booking_code }}</td>
                    <td>{{ $booking->guest_name }}</td>
                    <td>{{ $booking->total_adult }}</td>
                    <td>{{ $booking->total_child }}</td>
                    <td>{{ $booking->sales->name ?? '-' }}</td>
                    <td>{{ $booking->package->name ?? '-' }}</td>
                    <td>{{ $booking->booking_date->format('d F Y') }}</td>
                    <td>{{ $booking->arrival_date->format('d F Y') }}</td>
                    <td>{{ $booking->departure_date->format('d F Y') }}</td>
                    <td>Rp {{ number_format($booking->price, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($booking->platform) }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="13" class="text-center text-muted">Data report not found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
