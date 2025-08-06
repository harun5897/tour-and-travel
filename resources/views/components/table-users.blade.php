<div class="p-6 mx-6 bg-white mt-5">
    <div class="flex justify-end mb-3">
        <a href="/create-user"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg cursor-pointer text-sm flex items-center gap-2"
        >
            Create User
        </a>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="min-w-full border-2 border-gray-300 text-sm">
            <thead class="bg-gray-200 text-left text-black font-semibold">
                <tr>
                    <th class="border-2 border-gray-300 px-4 py-2 w-[30px]">No</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[200px]">Name</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[250px]">Email</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[150px]">Role</th>
                    <th class="border-2 border-gray-300 px-4 py-2 min-w-[200px]">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $index => $user)
                    <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-100' }}">
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $index + 1 }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2">{{ $user->role }}</td>
                        <td class="border-2 border-gray-300 px-4 py-2 space-x-2">
                            <a  href="{{ url('/detail-user/' . $user->id) }}"
                                class="bg-blue-500 text-white text-xs px-3 py-1 rounded hover:bg-blue-600">
                                Edit
                            </a>
                            <form action="{{ url('/delete-user/' . $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button
                                    type="submit"
                                    class="bg-red-500 text-white text-xs px-3 py-1 rounded hover:bg-red-600">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">Data user not found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
