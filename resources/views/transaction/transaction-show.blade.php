<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Transaction Details</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-4 text-gray-900">

                <h4 class="text-lg font-semibold mb-4">Transaction Information</h4>
                <ul class="list-group mb-4">
                    <li class="list-group-item"><strong>Category:</strong> {{ $transaction->category->name ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Type:</strong> {{ $transaction->category->type ?? 'N/A' }}</li>
                    <li class="list-group-item"><strong>Amount:</strong> {{ $transaction->amount }}</li>
                    <li class="list-group-item"><strong>Date:</strong> {{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</li>
                    <li class="list-group-item"><strong>Description:</strong> {{ $transaction->description }}</li>
                </ul>

                <a href="{{ route('transaction.index') }}" class="btn btn-secondary mt-3">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
