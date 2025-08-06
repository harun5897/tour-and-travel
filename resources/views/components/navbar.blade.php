<div
    id="navbar"
    class="flex justify-between items-center w-full p-5 bg-white shadow-sm"
>
    <h2 class="text-2xl font-semibold">{{ $activeMenu }}</h2>
    <form action="{{ url('/logout') }}" method="POST">
        @csrf
        <button
            type="submit"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer text-sm flex gap-2"
        >
            Logout
        </button>
    </form>
</div>