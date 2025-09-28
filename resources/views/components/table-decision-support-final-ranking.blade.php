{{-- Step 3: Final Ranking Table --}}
<div class="mb-8">
    <h2 class="text-xl font-semibold mb-3">Step 3: Final Ranking Results</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="w-[30px] border-2 border-gray-300 px-4 py-2">Rank</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Alternative (Package)</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Final Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($results as $index => $result)
                    <tr class="{{ $index == 0 ? 'bg-green-100' : 'bg-white' }}">
                        <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ $index + 1 }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ $result['package_name'] }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ number_format($result['final_score'], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>