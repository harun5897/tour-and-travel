<form action="{{ url('/create-scoring') }}" method="POST" class="p-6 mx-6 bg-white mt-5">
    @csrf
    <div class="w-1/2">
        <h1 class="text-xl mb-4 font-semibold">Form Create Scoring</h1>
        <label for="form-label" class="font-semibold">Package Name</label>
        <select name="id_package"
            class="rounded border focus:outline-none focus:border-blue-500 p-2 text-base w-full mb-3 mt-2 {{ $errors->has('id_package') ? 'border-red-500' : 'border-gray-300' }}">
            <option value="">-- Select Package --</option>
            @foreach ($packages as $package)
                <option value="{{ $package->id }}" {{ old('id_package') == $package->id ? 'selected' : '' }}>
                    {{ $package->name }} ({{ $package->category_name }})
                </option>
            @endforeach
        </select>
        @error('id_package')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
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
                        $old_sub_criteria_id = old('criterias.'.$loop->index.'.id_sub_criteria');
                    @endphp
                    @foreach ($subCriterias[$criteria->id] ?? [] as $subCriteria)
                        <option value="{{ $subCriteria->id }}"
                            {{ $old_sub_criteria_id == $subCriteria->id ? 'selected' : '' }}>
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
            <button type="submit" class="text-base bg-blue-500 hover:bg-blue-600 px-4 py-1 text-white rounded">Save</button>
        </div>
    </div>
</form>
