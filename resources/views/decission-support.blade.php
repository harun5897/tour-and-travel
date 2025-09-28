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

                    {{-- Dynamic Filter Form --}}
                    <form action="{{ url('/decision-support') }}" method="GET" class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-end space-x-4 flex-wrap">
                            {{-- Main Criteria Filter --}}
                            <div>
                                <label for="filter_criteria_id" class="block text-sm font-medium text-gray-700">Filter by Criterion</label>
                                <select id="filter_criteria_id" name="filter_criteria_id" class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">-- Select Criterion --</option>
                                    @if(isset($criteriaForFilter))
                                        @foreach($criteriaForFilter as $criterion)
                                            <option value="{{ $criterion->id }}" {{ request()->get('filter_criteria_id') == $criterion->id ? 'selected' : '' }}>
                                                {{ $criterion->criteria }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            {{-- Sub Criteria Filter (Dynamic) --}}
                            <div>
                                <label for="filter_sub_criteria_id" class="block text-sm font-medium text-gray-700">Filter by Value</label>
                                <select id="filter_sub_criteria_id" name="filter_sub_criteria_id" class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" disabled>
                                    <option value="">-- Select Criterion First --</option>
                                </select>
                            </div>

                            {{-- Category Filter --}}
                            <div>
                                <label for="category_filter" class="block text-sm font-medium text-gray-700">Filter by Category</label>
                                <select id="category_filter" name="category_filter" class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value="">All Categories</option>
                                    @if(isset($categoryOptions))
                                        @foreach($categoryOptions as $option)
                                            <option value="{{ $option->id }}" {{ request()->get('category_filter') == $option->id ? 'selected' : '' }}>
                                                {{ $option->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Apply Filters
                            </button>
                            <a href="{{ url('/decision-support') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Reset
                            </a>
                        </div>
                    </form>

                    <div id="criteria-data-container" data-criteria='@json($criteriaForFilter ?? [])'></div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const dataContainer = document.getElementById('criteria-data-container');
                            const criteriaData = JSON.parse(dataContainer.getAttribute('data-criteria'));
                            
                            const criteriaSelect = document.getElementById('filter_criteria_id');
                            const subCriteriaSelect = document.getElementById('filter_sub_criteria_id');
                            const selectedSubCriteria = "{{ request()->get('filter_sub_criteria_id') }}";

                            function populateSubCriteria(criterionId) {
                                // Clear previous options
                                subCriteriaSelect.innerHTML = '<option value="">-- Select Value --</option>';

                                if (!criterionId) {
                                    subCriteriaSelect.disabled = true;
                                    subCriteriaSelect.innerHTML = '<option value="">-- Select Criterion First --</option>';
                                    return;
                                }

                                const selectedCriterion = criteriaData.find(c => c.id == criterionId);

                                if (selectedCriterion && selectedCriterion.sub_criterias) {
                                    selectedCriterion.sub_criterias.forEach(sub => {
                                        const option = document.createElement('option');
                                        option.value = sub.id;
                                        option.textContent = sub.sub_criteria;
                                        if (sub.id == selectedSubCriteria) {
                                            option.selected = true;
                                        }
                                        subCriteriaSelect.appendChild(option);
                                    });
                                    subCriteriaSelect.disabled = false;
                                } else {
                                    subCriteriaSelect.disabled = true;
                                }
                            }

                            // Event listener for main criteria dropdown
                            criteriaSelect.addEventListener('change', function() {
                                populateSubCriteria(this.value);
                            });

                            // Initial population on page load if a criterion was already selected
                            if (criteriaSelect.value) {
                                populateSubCriteria(criteriaSelect.value);
                            }
                        });
                    </script>


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
