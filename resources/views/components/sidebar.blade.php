<div
    id="sidebar"
    class="bg-white h-screen shadow-md font-semibold"
>
    <div class="py-2 flex justify-center">
        <img
            src="{{ asset('assets/logo.jpg') }}"
            class="max-auto"
            width="150"
            alt="logo-pratama"
        />
    </div>
    <hr class="border border-t border-gray-300">
    @if(Auth::user() && Auth::user()->role === 'super_admin')
    <a href="/user"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Users
    </a>
    <hr class="border border-t border-gray-300">
    @endif
    <a href="/sales"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Sales
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/categories"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Categories
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/packages"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Packages
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/bookings"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Bookings
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/criterias"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Criterias
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/sub-criterias"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Sub Criterias
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/scorings"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Scorings
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/decision-support"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Decission Support
    </a>
    <hr class="border border-t border-gray-300">
    <a href="/report"
        class="block mx-6 my-4 text-gray-700 hover:text-blue-600 transition-colors">
        Data Report
    </a>
    <hr class="border border-t border-gray-300">
</div>
