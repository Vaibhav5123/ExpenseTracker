<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Users</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white shadow-sm rounded-lg p-6">

                <!-- Optional Add User Button -->
                <div class="flex justify-end mb-4">
                    {{-- <a href="{{ route('users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded text-sm hover:bg-blue-700 transition">+ Add User</a> --}}
                </div>

                <!-- Users Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 font-medium text-gray-600">#</th>
                                <th class="px-4 py-2 font-medium text-gray-600">Name</th>
                                <th class="px-4 py-2 font-medium text-gray-600">Email</th>
                                <th class="px-4 py-2 font-medium text-gray-600">Role</th>
                                <th class="px-4 py-2 font-medium text-gray-600">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @foreach($users as $index => $user)
                                <tr>
                                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $user->name }}</td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                    <td class="px-4 py-2">{{ $user->role->name ?? '-' }}</td>
                                    <td class="px-4 py-2 space-x-1">
                                        <a href="{{ route('users.show', $user->id) }}"
                                           class="inline-block px-3 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600">View</a>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="inline-block px-3 py-1 text-xs text-white bg-yellow-500 rounded hover:bg-yellow-600">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                              class="inline-block"
                                              onsubmit="return confirm('Are you sure you want to delete this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
