<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Categories</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white shadow-sm rounded-lg p-4">

                <!-- Buttons Row -->
                <div class="flex flex-col sm:flex-row justify-end gap-2 mb-4">
                    <a href="{{ route('summary.index') }}"
                       class="bg-gray-500 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                        Category Summary
                    </a>
                    <a href="{{ route('category.create') }}"
                       class="bg-blue-600 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                        + Add Category
                    </a>
                </div>

                <!-- Table Wrapper -->
                <div class="overflow-x-auto">
                    <table class="table-auto w-full text-sm border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-2 py-1">#</th>
                                <th class="border px-2 py-1">Name</th>
                                <th class="border px-2 py-1">Type</th>
                                <th class="border px-2 py-1">Budget</th>
                                <th class="border px-2 py-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $index => $category)
                                <tr>
                                    <td class="border px-2 py-1">{{ $index + 1 }}</td>
                                    <td class="border px-2 py-1">{{ $category->name }}</td>
                                    <td class="border px-2 py-1">{{ $category->type }}</td>
                                    <td class="border px-2 py-1">{{ optional($category->budgets->first())->budget ?? '-' }}</td>
                                    <td class="border px-2 py-1 space-x-1">
                                        <a href="{{ route('category.show', $category->id) }}"
                                           class="bg-blue-500 text-white px-2 py-1 rounded text-xs">View</a>
                                        <a href="{{ route('category.edit', $category->id) }}"
                                           class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                        <form action="{{ route('category.destroy', $category->id) }}"
                                              method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this category?')"
                                                    class="bg-red-500 text-white px-2 py-1 rounded text-xs">
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
                <div class="flex justify-center mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
