<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('category.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" class="form-select" id="type" required>
                                <option value="">Select type</option>
                                <option value="Income" {{ $category->type == 'Income' ? 'selected' : '' }}>Income</option>
                                <option value="Saving" {{ $category->type == 'Saving' ? 'selected' : '' }}>Saving</option>
                                <option value="Expense" {{ $category->type == 'Expense' ? 'selected' : '' }}>Expense</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="budget" class="form-label">Budget</label>
                            <input type="number" name="budget" class="form-control" id="budget"
                                   value="{{ optional($category->budgets->first())->budget }}" step="0.01" min="0">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Update Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
