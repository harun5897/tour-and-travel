<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <body>
        <div class="flex bg-gray-100">
            <div class="w-1/4">
                @include('components.sidebar')
            </div>
            <div class="w-full">
                @include('components.navbar', ['activeMenu' => 'Data Sales'])
                @include('components.form-update-sales')
            </div>
        </div>
    </body>
</html>
