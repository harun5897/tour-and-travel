<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <body>
        <div class="flex bg-gray-100">
            <div class="w-1/4">
                @include('components.sidebar')
            </div>
            <div class="w-full overflow-x-auto h-screen">
                @include('components.navbar', ['activeMenu' => 'Decission Support'])
                @include('components.alert-success')
            </div>
        </div>
        @stack('scripts')
    </body>
</html>
