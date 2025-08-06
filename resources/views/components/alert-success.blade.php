@if (session('success'))
    <div
        id="success-alert"
        class="mx-6 mb-3 mt-4 p-3 bg-green-100 border border-green-400 text-green-700 rounded relative"
    >
        {{ session('success') }}
        <button
            type="button"
            onclick="document.getElementById('success-alert').style.display='none'"
            class="absolute top-0 right-0 mt-3 mr-3 text-green-700 hover:text-green-900 text-lg font-bold leading-none focus:outline-none"
        >
            ×
        </button>
    </div>
@endif