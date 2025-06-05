<x-app-layout>

    <div class="py-6">
    <div class="max-w-7xl mx-auto px-4">
        <div class="bg-white shadow-sm rounded-lg p-4">
            
            <!-- FILTER + ADD BUTTON -->
            <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-4 mb-6">


                
                <!-- Filter Form -->
                <form method="GET" action="{{ route('transaction.index') }}" class="flex flex-wrap gap-4">
    <div>
        <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
        <select name="type" id="type" class="w-36 md:w-40 rounded-md shadow-sm h-9 text-sm border-gray-300">
            <option value="">--Type--</option>
            @foreach ($types as $type)
                <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
        <select name="category_id" id="category_id" class="w-36 md:w-44 rounded-md shadow-sm h-9 text-sm border-gray-300">
            <option value="">--Category--</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="startDate" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
        <input type="date" name="startDate" value="{{ request('startDate') }}" class="w-36 md:w-44 rounded-md shadow-sm h-9 text-sm border-gray-300">
    </div>

    <div>
        <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
        <input type="date" name="endDate" value="{{ request('endDate') }}" class="w-36 md:w-44 rounded-md shadow-sm h-9 text-sm border-gray-300">
    </div>

<div class="flex gap-2 mt-1 self-end">
    <button type="submit"
        class="bg-blue-600 text-white px-3 h-9 rounded text-sm flex items-center justify-center">
        Filter
    </button>

    <a href="{{ route('transaction.index') }}"
        class="bg-gray-500 text-white px-3 h-9 rounded text-sm flex items-center justify-center">
        Reset
    </a>
</div>


</form>

                
                
                <!-- Add Transaction Button -->
                <div class="md:col-span-1 flex md:justify-end">
                    <a href="{{ route('transaction.create') }}" class="bg-gray-800 text-white px-4 py-2 rounded text-sm self-end w-full md:w-auto text-center">+ Add Transaction</a>
                </div>
            </div>
                

            <!-- Responsive Table Wrapper -->
            <div class="overflow-x-auto">
                <table class="table-auto w-full text-sm border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-2 py-1">#</th>
                            <th class="border px-2 py-1">Type</th>
                            <th class="border px-2 py-1">Amount</th>
                            <th class="border px-2 py-1">Description</th>
                            <th class="border px-2 py-1">Category</th>
                            <th class="border px-2 py-1">Date</th>
                            <th class="border px-2 py-1">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count=1; @endphp
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td class="border px-2 py-1">{{ $count++ }}</td>
                                <td class="border px-2 py-1">{{ $transaction->category->type }}</td>
                                <td class="border px-2 py-1">{{ $transaction->amount }}</td>
                                <td class="border px-2 py-1">{{ $transaction->description }}</td>
                                <td class="border px-2 py-1">{{ $transaction->category->name }}</td>
                                <td class="border px-2 py-1">{{ $transaction->date->format('M d Y') }}</td>
                                <td class="border px-2 py-1 space-x-1">
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded text-xs">View</a>
                                    <a href="{{ route('transaction.edit', $transaction->id) }}" class="bg-yellow-500 text-white px-2 py-1 rounded text-xs">Edit</a>
                                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded text-xs" onclick="return confirm('Delete this transaction?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </div>
</div>

</x-app-layout>
