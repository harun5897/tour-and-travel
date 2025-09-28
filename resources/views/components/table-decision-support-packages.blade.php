{{-- Packages Table --}}
<div class="mb-8">
    <h2 class="text-xl font-semibold mb-3">Packages to be Evaluated</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="w-[30px] border-2 border-gray-300 px-4 py-2">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Category</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Description</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Cost</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scorablePackages as $package)
                    <tr class="bg-white">
                        <td class="w-[30px] border-2 border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $package->category->name ?? '-' }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $package->name }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $package->description }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">Rp. {{ number_format($package->cost, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Form/Button to Trigger Calculation --}}
<form action="{{ url('/decision-support') }}" method="GET" class="mb-4">
    {{-- Preserve existing filters --}}
    <input type="hidden" name="category_filter" value="{{ request()->get('category_filter') }}">
    <input type="hidden" name="filter_criteria_id" value="{{ request()->get('filter_criteria_id') }}">
    <input type="hidden" name="filter_sub_criteria_id" value="{{ request()->get('filter_sub_criteria_id') }}">
    
    {{-- Add trigger for calculation --}}
    <input type="hidden" name="run_calculation" value="true">

    <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
        Calculate Decision Support Results
    </button>
</form>