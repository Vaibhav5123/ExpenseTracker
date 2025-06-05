<x-app-layout>

    <div class="py-12 space-y-6">
        {{-- Summary Cards --}}
        <div class="max-w-7xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 px-4">
            <div class="bg-green-100 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold text-green-800">Income</h3>
                <p class="text-2xl font-bold text-green-700">₹{{ number_format($totalIncome, 2) }}</p>
            </div>
            <div class="bg-red-100 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold text-red-800">Expense</h3>
                <p class="text-2xl font-bold text-red-700">₹{{ number_format($totalExpense, 2) }}</p>
            </div>
            <div class="bg-blue-100 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold text-blue-800">Saving</h3>
                <p class="text-2xl font-bold text-blue-700">₹{{ number_format($totalSaving, 2) }}</p>
            </div>
            <div class="bg-yellow-100 p-6 rounded-lg shadow text-center">
                <h3 class="text-lg font-semibold text-yellow-800">Funds Remaining</h3>
                <p class="text-2xl font-bold text-yellow-700">₹{{ number_format($remainignFunds, 2) }}</p>
            </div>
        </div>

        {{-- Latest Transactions --}}
        <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow px-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Latest Transactions</h3>
                <form action="{{ route('mail.report') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                        Get Monthly Report
                    </button>
                </form>
            </div>

            <ul class="divide-y divide-gray-200">
                @forelse($latestTransactions as $txn)
                    <li class="py-3 flex justify-between text-sm sm:text-base">
                        <span>{{ $txn->date->format('d M Y') }} - {{ $txn->category->name }}</span>
                        <span class="font-semibold {{ $txn->category->type === 'Income' ? 'text-green-700' : 'text-red-700' }}">
                            ₹{{ number_format($txn->amount, 2) }}
                        </span>
                    </li>
                @empty
                    <li class="py-3 text-gray-500 text-center">No transactions found.</li>
                @endforelse
            </ul>
        </div>      
    </div>
</x-app-layout>
