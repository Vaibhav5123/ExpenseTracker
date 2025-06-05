<x-app-layout>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <h4>Category Information</h4><br>
                    <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Name:</strong> {{ $category->name }}</li>
                        <li class="list-group-item"><strong>Type:</strong> {{ $category->type }}</li>
                        <li class="list-group-item">
                            <strong>Defined Budget:</strong>
                            {{ $category->budget ? $category->budget->budget : 'No budget defined' }}
                        </li>
                    </ul>

                    <h4>Transactions</h4>
                    @if ($category->transactions->isEmpty())
                        <p class="text-muted">No transactions found under this category.</p>
                    @else
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->transactions as $index => $transaction)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <a href="{{ route('category.index') }}" class="btn btn-secondary mt-3">Back</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
