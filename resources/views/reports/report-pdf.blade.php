<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Monthly Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; line-height: 1.5; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Monthly Financial Report</h2>
    </div>

    <div class="section">
        <strong>User:</strong> {{ $user->name }}<br>
        <strong>Email:</strong> {{ $user->email }}
    </div>

    <div class="section">
        <strong>Report Month:</strong> {{ $formattedMonthYear }}

    </div>

    <div class="section">
        <h4>Summary</h4>
        <ul>
            <li><strong>Total Income:</strong> {{ number_format($totals['Income'] ?? 0, 2) }}</li>
            <li><strong>Total Expense:</strong> {{ number_format($totals['Expense'] ?? 0, 2) }}</li>
            <li><strong>Total Saving:</strong> {{ number_format($totals['Saving'] ?? 0, 2) }}</li>
        </ul>
    </div>

    <div class="section">
        <h4>Category-wise Totals</h4>
        <table>
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($report as $row)
                    <tr>
                        <td>{{ $row['category'] }}</td>
                        <td>{{ ucfirst($row['type']) }}</td>
                        <td>{{ number_format($row['total'], 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="section">
        <h4>All Transactions</h4>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{$transaction->date->format('d M Y') }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->category->name }}</td>
                        <td>{{ ucfirst($transaction->category->type) }}</td>
                        <td>{{ number_format($transaction->amount, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center;">No transactions found for this period.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
