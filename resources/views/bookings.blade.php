<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <body>
        <div class="flex bg-gray-100">
            <div class="w-1/4">
                @include('components.sidebar')
            </div>
            <div class="w-full overflow-x-auto">
                @include('components.navbar', ['activeMenu' => 'Data Bookings'])
                @include('components.alert-success')
                @include('components.table-booking', ['bookings' => $bookings])
            </div>
        </div>
    </body>
</html>
