<x-app-layout>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
        <form action="{{ route('transaction.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }} ({{ $category->type }})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control" step="0.01" required>
            </div>

            <div class="mb-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Description</label>
                <textarea name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
        </form>
    </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
