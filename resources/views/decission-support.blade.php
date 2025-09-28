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
                    <h1 class="text-2xl font-semibold mb-6">SMART Decision Support</h1>

                    {{-- Filter Form --}}
                    @include('components.form-decision-support-filter')

                    {{-- Section to show packages after filtering --}}
                    @if(isset($scorablePackages))
                        @if($scorablePackages->count() > 0)
                            @include('components.table-decision-support-packages')
                        @else
                            {{-- Message if filters return no packages --}}
                            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
                                <strong class="font-bold">No Packages Found!</strong>
                                <span class="block sm:inline">No packages with complete scoring data match the selected filters.</span>
                            </div>
                        @endif
                    @endif

                    {{-- Section to show calculation results --}}
                    @if(isset($results) && !empty($results))
                        @include('components.table-decision-support-normalized-weights')
                        @include('components.table-decision-support-utility-scores')
                        @include('components.table-decision-support-final-ranking')
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
