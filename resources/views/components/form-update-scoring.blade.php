<form action="{{ url('/update-scoring/' . $package->id) }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    @method('PUT')
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Update Scoring</h1>
        <div class="mb-4">
            <label for="package_name" class="font-semibold">Package Name</label>
            <input type="text" id="package_name" name="package_name" value="{{ $package->name }} ({{ $package->category->name }})" disabled
                class="rounded border focus:outline-none p-2 text-base w-full mt-2 bg-gray-100 cursor-not-allowed">
        </div>

        {{-- Dynamic Inputs for Criteria --}}
        @foreach ($criterias as $criteria)
            <div class="mb-4">
                <label for="label" class="block font-semibold mb-1">
                    {{ $criteria->criteria }}
                </label>
                <input type="hidden" name="criterias[{{ $loop->index }}][id_criteria]" value="{{ $criteria->id }}">
                <select name="criterias[{{ $loop->index }}][id_sub_criteria]"
                    class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full {{ $errors->has("criterias.$loop->index.id_sub_criteria") ? 'border-red-500' : 'border-gray-300' }}">
                    <option value="">-- Select Sub Criteria --</option>
                    @php
                        $selected_sub_criteria = old('criterias.'.$loop->index.'.id_sub_criteria', $packageScorings[$criteria->id] ?? null);
                    @endphp
                    @foreach ($subCriterias[$criteria->id] ?? [] as $subCriteria)
                        <option value="{{ $subCriteria->id }}" {{ $selected_sub_criteria == $subCriteria->id ? 'selected' : '' }}>
                            {{ $subCriteria->sub_criteria }} (Value: {{ $subCriteria->value }})
                        </option>
                    @endforeach
                </select>
                @error("criterias.$loop->index.id_sub_criteria")
                    <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
        <div class="flex justify-end gap-2">
            <a href="/scorings" class="text-base bg-red-500 hover:bg-red-600 px-4 py-1 text-white rounded">Cancel</a>
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Save Changes</button>
        </div>
    </div>
</form>
