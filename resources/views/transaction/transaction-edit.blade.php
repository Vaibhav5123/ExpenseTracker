<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Transaction</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <form action="{{ route('transaction.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="category_id" class="block font-medium text-sm text-gray-700">Category</label>
                        <select name="category_id" id="category_id" class="form-select mt-1 block w-full" required>
                            <option value="">-- Select Category --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $transaction->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }} ({{ $category->type }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="amount" class="block font-medium text-sm text-gray-700">Amount</label>
                        <input type="number" name="amount" id="amount" step="0.01" min="0" class="form-input mt-1 block w-full"
                            value="{{ old('amount', $transaction->amount) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="date" class="block font-medium text-sm text-gray-700">Date (MM/DD/YYYY)</label>
                        <input type="date" name="date" id="date" class="form-input mt-1 block w-full"
                            value="{{ old('date', $transaction->date->format('Y-m-d')) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-medium text-sm text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="3" class="form-textarea mt-1 block w-full">{{ old('description', $transaction->description) }}</textarea>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('transaction.index') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Update Transaction</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
</x-app-layout>
