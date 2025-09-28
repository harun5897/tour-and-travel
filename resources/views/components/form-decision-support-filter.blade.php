<form action="{{ url('/decision-support') }}" method="GET" class="mb-8 p-4 bg-gray-50 rounded-lg">
    <div class="flex items-end space-x-4 flex-wrap">
        {{-- Category Filter --}}
        <div>
            <label for="category_filter" class="block text-sm font-medium text-gray-700">Filter by Category</label>
            <select id="category_filter" name="category_filter" class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">All Categories</option>
                @foreach($categoryOptions as $option)
                    <option value="{{ $option->id }}" {{ request()->get('category_filter') == $option->id ? 'selected' : '' }}>
                        {{ $option->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Main Criteria Filter --}}
        <div>
            <label for="filter_criteria_id" class="block text-sm font-medium text-gray-700">Filter by Criterion</label>
            <select id="filter_criteria_id" name="filter_criteria_id" class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value="">-- Select Criterion --</option>
                @foreach($criteriaForFilter as $criterion)
                    <option value="{{ $criterion->id }}" {{ request()->get('filter_criteria_id') == $criterion->id ? 'selected' : '' }}>
                        {{ $criterion->criteria }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Sub Criteria Filter (Dynamic) --}}
        <div>
            <label for="filter_sub_criteria_id" class="block text-sm font-medium text-gray-700">Filter by Value</label>
            <select id="filter_sub_criteria_id" name="filter_sub_criteria_id" class="mt-1 block w-64 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" disabled>
                <option value="">-- Select Criterion First --</option>
            </select>
        </div>

        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            Apply Filter
        </button>
        <a href="{{ url('/decision-support') }}" class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Reset
        </a>
    </div>
</form>

{{-- Hidden container for criteria data for JS --}}
<div id="criteria-data-container" data-criteria='@json($criteriaForFilter)'></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dataContainer = document.getElementById('criteria-data-container');
        const criteriaData = JSON.parse(dataContainer.getAttribute('data-criteria'));
        
        const criteriaSelect = document.getElementById('filter_criteria_id');
        const subCriteriaSelect = document.getElementById('filter_sub_criteria_id');
        const selectedSubCriteria = "{{ request()->get('filter_sub_criteria_id') }}";

        function populateSubCriteria(criterionId) {
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

        criteriaSelect.addEventListener('change', function() {
            populateSubCriteria(this.value);
        });

        if (criteriaSelect.value) {
            populateSubCriteria(criteriaSelect.value);
        }
    });
</script>