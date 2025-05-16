<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">All Transactions</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            
            <div class="bg-white shadow-sm rounded-lg p-4">
                <div class="flex flex-col md:flex-row md:justify-between md:items-end mb-6 space-y-4 md:space-y-0">

                    <!-- Filter Form -->
                    <form method="GET" action="{{ route('transaction.index') }}" class="flex flex-wrap gap-4 items-end">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Type</label>
                            <select name="type" id="type" class="form-select rounded-md shadow-sm w-40 h-9 text-sm">
                                <option value="">--Type--</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                            <select name="category_id" id="category_id" class="form-select rounded-md shadow-sm w-44 h-9 text-sm">
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
                            <input type="date" name="startDate" value="{{ request('startDate') }}" class="form-input rounded-md shadow-sm h-9 text-sm w-44">
                        </div>
                        <div>
                            <label for="endDate" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="endDate" value="{{ request('endDate') }}" class="form-input rounded-md shadow-sm h-9 text-sm w-44">
                        </div>

                        <div class="flex gap-2 mt-1">
                            <button type="submit" class="btn btn-primary btn-sm h-9 px-3 text-sm">Filter</button>
                            <a href="{{ route('transaction.index') }}" class="btn btn-secondary btn-sm h-9 px-3 text-sm">Reset</a>
                        </div>
                    </form>

                    <!-- Add Transaction Button -->
                    <div>
                        <a href="{{ route('transaction.create') }}" class="btn btn-dark h-9 px-4 text-sm">+ Add Transaction</a>
                    </div>
                    </div>

                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Description</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $count=1; @endphp
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $count++ }}</td>
                                <td>{{ $transaction->category->type }}</td>
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->category->name }}</td>
                                <td>{{ $transaction->date->format('M d Y') }}</td>
                                <td>
                                    <a href="{{ route('transaction.show', $transaction->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('transaction.edit', $transaction->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('transaction.destroy', $transaction->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this transaction?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
                <div class="d-flex justify-content-center mt-4">
                    {{ $transactions->links() }}
                </div>
        </div>
    </div>
</x-app-layout>
