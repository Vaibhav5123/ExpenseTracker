<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Category') }}
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

                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" name="name" class="form-control" id="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" class="form-select" id="type" required>
                                <option value="">Select type</option>
                                <option value="Income">Income</option>
                                <option value="Saving">Saving</option>
                                <option value="Expense">Expense</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="budget" class="form-label">Budget</label>
                            <input type="number" name="budget" class="form-control" id="budget" step="0.01" min="0">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
