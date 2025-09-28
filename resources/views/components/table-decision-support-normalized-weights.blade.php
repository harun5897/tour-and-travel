{{-- Step 1: Normalized Weights Table --}}
<div class="mb-8">
    <h2 class="text-xl font-semibold mb-3">Step 1: Criteria Weight Normalization</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="w-[30px] border-2 border-gray-300 px-4 py-2">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Criteria</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Initial Weight</th>
                    <th class="border-2 border-gray-300 px-4 py-2">Normalized Weight</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp
                @foreach($normalizedWeights as $data)
                    @php $i++; @endphp
                    <tr class="bg-white">
                        <td class="w-[30px] border-2 border-gray-300 px-4 py-2">{{ $i }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $data['name'] }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $data['weight'] }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ number_format($data['normalized'], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>