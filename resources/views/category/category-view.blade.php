<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Categories</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            <div class="bg-white shadow-sm rounded-lg p-4">

            <div class="flex justify-end mb-3">
                <a href="{{ route('summary.index') }}" class="btn btn-secondary">Category summary</a>
                <a href="{{ route('category.create') }}" class="btn btn-primary ml-2">+ Add Category</a>
            </div>


                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Budget</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $index => $category)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->type }}</td>
                                <td>{{ optional($category->budgets->first())->budget ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('category.show', $category->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="d-flex justify-content-center mt-4">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
