<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category Summary') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Date filter form -->
            <form method="GET" action="{{ route('summary.index') }}" class="mb-4">
                <div class="flex space-x-4 items-end">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date"
                               value="{{ request('start_date') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date"
                               value="{{ request('end_date') }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 text-white rounded shadow">
                            Filter
                        </button>
                        
                        <a href="{{ route('summary.index') }}" class="btn btn-secondary">Reset</a>
                        
                    </div>
                </div>
            </form>

            <!-- Summary Table -->
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 table-auto">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Total Amount</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Transactions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($categorySummaries as $summary)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $summary['category_name'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $summary['category_type'] }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">₹{{ number_format($summary['total_amount'], 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">{{ $summary['transaction_count'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No data found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
