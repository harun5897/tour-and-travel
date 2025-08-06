<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('components.head')
    <body>
        @include('components.alert-success')
        @include('components.form-login')
    </body>
</html>
