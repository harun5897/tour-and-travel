<div class="p-6 mx-6 bg-white overflow-y-scroll h-3/4 mt-5">
    <div class="flex justify-end mb-3">
        <a
            href="/create-sales"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer text-sm flex items-center gap-2"
        >
            Create Sales
        </a>
    </div>
    <div class="overflow-x-auto w-full">
        <table id="table-sales" class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="border-2 border-gray-300 px-4 py-2 w-[30px]">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Phone Number</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Email</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Address</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $index => $sale)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $sale->name }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $sale->phone_number }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $sale->email }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $sale->address }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ url('/detail-sales/' . $sale->id) }}"
                                class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <form action="{{ url('/delete-sales/' . $sale->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-500 text-white text-xs px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.7.0/js/dataTables.autoFill.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        new DataTable('#table-sales', {
            dom: '<"flex justify-between items-center mb-3"lf>rt<"flex justify-between items-center mt-3"ip>',
            scrollX: true,
            searchable: true,
            paging: true,
            pageLength: 10,
            autoFill: false,
            select: false,
            language: {
                emptyTable: "Data sales not found"
            }
        });
    });
    </script>
@endpush
