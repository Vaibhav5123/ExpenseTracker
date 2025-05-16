<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dynamic Report') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
            <form method="GET" action="{{ route('report.index') }}" class="mb-6 flex flex-wrap items-end gap-4">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Report Type</label>
                    <select name="type" id="type" class="form-select rounded w-48" onchange="this.form.submit()">
                        <option value="type" {{ request('type') === 'type' ? 'selected' : '' }}>By Type</option>
                        <option value="month" {{ request('type') === 'month' ? 'selected' : '' }}>By Month</option>
                        <option value="category" {{ request('type') === 'category' ? 'selected' : '' }}>By Category</option>
                    </select>
                </div>

                @if (request('type') === 'month')
                    @php
                        $selectedMonth = request('month') ?? now()->month;
                    @endphp
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                        <select name="month" id="month" class="form-select rounded w-32">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" id="year" value="{{ request('year', date('Y')) }}" class="form-input rounded w-32">
                    </div>
                @else
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="startDate" id="start_date" value="{{ request('startDate') }}" class="form-input rounded w-48">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="endDate" id="end_date" value="{{ request('endDate') }}" class="form-input rounded w-48">
                    </div>
                @endif

                <div>
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <a href="{{ route('report.index') }}" class="btn btn-secondary ml-2">Reset</a>
                </div>
            </form>

            @if (!empty($report) && count($report) > 0)
                <table class="table table-bordered mt-4 w-full text-sm text-left">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            @foreach (array_keys($report[0]) as $key)
                                <th class="py-2 px-4">{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($report as $row)
                            <tr class="border-t">
                                @foreach ($row as $value)
                                    <td class="py-2 px-4">{{ $value }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-600 mt-4">No data available for the selected criteria.</p>
            @endif
            <form method="GET" action="{{ route('pdf') }}" target="_blank">

                <label>Month:</label>
                <input type="number" name="month" value="{{ date('m') }}" min="1" max="12" required>

                <label>Year:</label>
                <input type="number" name="year" value="{{ date('Y') }}" required>

                
                <button type="submit" class="btn btn-primary">Download PDF</button>
            </form>

        </div>
    </div>
</x-app-layout>
