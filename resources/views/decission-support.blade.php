<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <body>
        <div class="flex bg-gray-100">
            <div class="w-1/4">
                @include('components.sidebar')
            </div>
            <div class="w-full">
                @include('components.navbar', ['activeMenu' => 'Decision Support'])

                <div class="p-6 mx-6 bg-white mt-5">
                    <h1 class="text-2xl font-semibold mb-6">SMART Decision Support Results</h1>

                    @if(isset($results) && isset($normalizedWeights))
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
                                        @foreach($normalizedWeights as $index => $data)
                                            <tr class="bg-white">
                                                <td class="w-[30px] border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                                <td class="border-2 border-gray-300 px-4 py-2">{{ $data['name'] }}</td>
                                                <td class="border-2 border-gray-300 px-4 py-2">{{ $data['weight'] }}</td>
                                                <td class="border-2 border-gray-300 px-4 py-2">{{ number_format($data['normalized'], 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

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
                                                    <td class="border-2 border-gray-300 px-4 py-2">{{ $result['utility_scores'][$criteria->id] }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Step 3: Final Ranking Table --}}
                        <div class="mb-8">
                            <h2 class="text-xl font-semibold mb-3">Step 3: Final Ranking Results</h2>
                            <div class="overflow-x-auto">
                                <table class="min-w-full border-2 border-gray-300 text-sm">
                                    <thead class="bg-gray-200 text-left text-black font-semibold">
                                        <tr>
                                            <th class="w-[30px] border-2 border-gray-300 px-4 py-2">No</th>
                                            <th class="border-2 border-gray-300 px-4 py-2">Rank</th>
                                            <th class="border-2 border-gray-300 px-4 py-2">Alternative (Package)</th>
                                            <th class="border-2 border-gray-300 px-4 py-2">Final Score</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($results as $index => $result)
                                            <tr class="{{ $index == 0 ? 'bg-green-100' : 'bg-white' }}">
                                                <td class="w-[30px] border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                                                <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ $index + 1 }}</td>
                                                <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ $result['package_name'] }}</td>
                                                <td class="border-2 border-gray-300 px-4 py-2 font-semibold">{{ number_format($result['final_score'], 4) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @elseif(isset($error))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Error!</strong>
                            <span class="block sm:inline">{{ $error }}</span>
                        </div>
                    @else
                        <p>No data available to display.</p>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
