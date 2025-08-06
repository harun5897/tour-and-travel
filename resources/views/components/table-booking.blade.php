<div class="p-6 mx-6 bg-white mt-5">
    <div class="flex justify-end mb-3">
        <a href="/create-booking"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer text-sm flex items-center gap-2">
            Create Booking
        </a>
    </div>

    <div class="overflow-x-auto w-full">
        <table class="border-2 border-gray-300 text-sm w-full">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="border-2 border-gray-300 px-4 py-2 w-[30px]">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Booking Code</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Guest Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Adult</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Child</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Sales Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[200px]">Package Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Booking Date</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Arrival Date</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Departure Date</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Price</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Platform</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Status</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $index => $booking)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->booking_code }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->guest_name }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->total_adult }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->total_child }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->sales->name ?? '-' }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->package->name ?? '-' }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->booking_date->format('d F Y') }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->arrival_date->format('d F Y') }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $booking->departure_date->format('d F Y') }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">Rp. {{ number_format($booking->price, 0, ',', '.') }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ ucfirst($booking->platform) }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ ucfirst($booking->status) }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ url('/detail-booking/' . $booking->id) }}"
                                class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <form action="{{ url('/delete-booking/' . $booking->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white text-xs px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center text-gray-500 py-4">Data booking not found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
