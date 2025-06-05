<x-app-layout>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4">
            
            <!-- Date Filter Form -->
            <form method="GET" action="{{ route('summary.index') }}" class="mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 items-end">
                    
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                               value="{{ request('start_date') }}"
                               class="w-full rounded-md shadow-sm h-9 text-sm border-gray-300">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="end_date" id="end_date"
                               value="{{ request('end_date') }}"
                               class="w-full rounded-md shadow-sm h-9 text-sm border-gray-300">
                    </div>

                    <div class="flex gap-2 mt-1">
                        <button type="submit"
                                class="bg-gray-800 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                            Filter
                        </button>
                        <a href="{{ route('summary.index') }}"
                           class="bg-gray-500 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            <!-- Summary Table -->
            <div class="bg-white shadow-sm rounded-lg overflow-x-auto">
                <table class="table-auto w-full text-sm border-collapse border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Category</th>
                            <th class="border px-4 py-2 text-left">Type</th>
                            <th class="border px-4 py-2 text-right">Total Amount</th>
                            <th class="border px-4 py-2 text-right">Transactions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categorySummaries as $summary)
                            <tr>
                                <td class="border px-4 py-2">{{ $summary['category_name'] }}</td>
                                <td class="border px-4 py-2">{{ $summary['category_type'] }}</td>
                                <td class="border px-4 py-2 text-right">₹{{ number_format($summary['total_amount'], 2) }}</td>
                                <td class="border px-4 py-2 text-right">{{ $summary['transaction_count'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="border px-4 py-2 text-center text-gray-500">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
