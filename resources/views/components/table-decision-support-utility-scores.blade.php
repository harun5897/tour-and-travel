{{-- Step 2: Utility Scores Table --}}
<div class="mb-8">
    <h2 class="text-xl font-semibold mb-3">Step 2: Alternative Utility Scores</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="w-[30px] border-2 border-gray-300 px-4 py-2">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Alternative</th>
                    @foreach($criterias as $criteria)
                        <th class="border-2 border-gray-300 px-4 py-2">{{ $criteria->criteria }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($results as $index => $result)
                    <tr class="bg-white">
                        <td class="w-[30px] border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ $result['package_name'] }}</td>
                        @foreach($criterias as $criteria)
                            <td class="border-2 border-gray-300 px-4 py-2">{{ number_format($result['utility_scores'][$criteria->id], 4) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>