<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Booking</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 10px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .header-left h2 {
            margin: 0;
            font-size: 20px;
        }
        .header-right img {
            width: 120px;
        }
        .info {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
        .info div {
            width: 48%;
        }
        .bold {
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            border: 1px solid #ccc;
            font-size: 12px;
        }
        th {
            background-color: #f3f4f6;
            text-align: left;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <div class="header-left">
            <img src="{{ public_path('assets/logo.jpg') }}" alt="Logo" width="150px">
            <h2>PRATAMA TOUR AND TRAVEL INVOICE</h2>
            <p>REFERENCE: <span class="bold">{{ $booking->booking_code }}</span></p>
            <p>DATE: {{ now()->format('d F Y') }}</p>
            <p>SALES REP: {{ $booking->sales->name ?? '-' }}</p>
            <p>CUSTOMER NAME: <span class="bold">{{ $booking->guest_name }}</span></p>
            <p>TRAVEL DATE: {{ $booking->arrival_date->format('d/m/Y') }}</p>
            <p>PAGE 1/1</p>
        </div>
    </div>
    <div class="info">
        <div>
            <p class="bold">FROM</p>
            <p>PRATAMA TOUR AND TRAVEL</p>
            <p class="text-muted">Jalan Raya Dompak, Komplek Ruko D'Green City Block D No 8A, Tanjungpinang, Kepulauan Riau</p>
        </div>
        <div>
            <p class="bold">TO</p>
            <p>{{ $booking->guest_name }}</p>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Amount</th>
                <th>Price</th>
                <th>Status</th>
                <th>SubTotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->package->name ?? 'Travel Package' }}</td>
                <td>1</td>
                <td>Rp {{ number_format($booking->price, 0, ',', '.') }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>Rp {{ number_format($booking->price, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    <p class="total">TOTAL: Rp {{ number_format($booking->price, 0, ',', '.') }}</p>
</div>
</body>
</html>
