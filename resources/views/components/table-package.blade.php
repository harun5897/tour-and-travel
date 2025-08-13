<div class="p-6 mx-6 bg-white overflow-y-scroll h-3/4 mt-5">
    <div class="flex justify-end mb-3">
        <a href="/create-package"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer text-sm flex items-center gap-2">
            Create Package
        </a>
    </div>
    <div class="overflow-x-auto w-full">
        <table id="table-package" class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="border-2 border-gray-300 px-4 py-2 w-[30px]">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Package Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Category Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Description</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[100px]">Cost</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($packages as $index => $package)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $package->name }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $package->category->name ?? '-' }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $package->description }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">Rp. {{ number_format($package->cost, 0, ',', '.') }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 space-x-2">
                            <a href="{{ url('/detail-package/' . $package->id) }}"
                                class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <form action="{{ url('/delete-package/' . $package->id) }}" method="POST" class="inline">
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
                        <td colspan="6" class="text-center text-gray-500 py-4">Data package not found</td>
                    </tr>
                @endforelse
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
        new DataTable('#table-package', {
            dom: '<"flex justify-between items-center mb-3"lf>rt<"flex justify-between items-center mt-3"ip>',
            scrollX: true,
            searchable: true,
            paging: true,
            pageLength: 10,
            autoFill: false,
            select: false
        });
    });
    </script>
@endpush