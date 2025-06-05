<x-app-layout>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 bg-white p-6 shadow-sm rounded-lg">

            <!-- Filter Form -->
            <form method="GET" action="{{ route('report.index') }}" class="mb-6 flex flex-wrap gap-4 items-end">
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
                    <select name="type" id="type"
                            class="form-select w-48 h-9 text-sm rounded border-gray-300 shadow-sm"
                            onchange="this.form.submit()">
                        <option value="type" {{ request('type') === 'type' ? 'selected' : '' }}>By Type</option>
                        <option value="month" {{ request('type') === 'month' ? 'selected' : '' }}>By Month</option>
                        <option value="category" {{ request('type') === 'category' ? 'selected' : '' }}>By Category</option>
                    </select>
                </div>

                @if (request('type') === 'month')
                    @php $selectedMonth = request('month') ?? now()->month; @endphp
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                        <select name="month" id="month"
                                class="form-select w-32 h-9 text-sm rounded border-gray-300 shadow-sm">
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                        <input type="number" name="year" id="year"
                               value="{{ request('year', date('Y')) }}"
                               class="form-input w-32 h-9 text-sm rounded border-gray-300 shadow-sm">
                    </div>
                @else
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                        <input type="date" name="startDate" id="start_date"
                               value="{{ request('startDate') }}"
                               class="form-input w-48 h-9 text-sm rounded border-gray-300 shadow-sm">
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                        <input type="date" name="endDate" id="end_date"
                               value="{{ request('endDate') }}"
                               class="form-input w-48 h-9 text-sm rounded border-gray-300 shadow-sm">
                    </div>
                @endif

                <div class="flex gap-2 mt-1">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                        Generate
                    </button>
                    <a href="{{ route('report.index') }}"
                       class="bg-gray-500 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </form>

            <!-- Report Table -->
            @if (!empty($report) && count($report) > 0)
                <div class="overflow-x-auto rounded-lg">
                    <table class="table-auto w-full text-sm text-left border border-gray-300">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                @foreach (array_keys($report[0]) as $key)
                                    <th class="border px-4 py-2">{{ ucwords(str_replace('_', ' ', $key)) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($report as $row)
                                <tr class="border-t">
                                    @foreach ($row as $value)
                                        <td class="border px-4 py-2">{{ $value }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-600 mt-4">No data available for the selected criteria.</p>
            @endif

            <!-- Download PDF -->
            <form method="GET" action="{{ route('pdf') }}" target="_blank" class="mt-6 flex gap-4 items-end flex-wrap">
                <div>
                    <label for="pdf_month" class="block text-sm font-medium text-gray-700 mb-1">Month</label>
                    <input type="number" id="pdf_month" name="month" value="{{ date('m') }}" min="1" max="12"
                           class="form-input w-32 h-9 text-sm rounded border-gray-300 shadow-sm" required>
                </div>

                <div>
                    <label for="pdf_year" class="block text-sm font-medium text-gray-700 mb-1">Year</label>
                    <input type="number" id="pdf_year" name="year" value="{{ date('Y') }}"
                           class="form-input w-32 h-9 text-sm rounded border-gray-300 shadow-sm" required>
                </div>

                <button type="submit"
                        class="bg-green-600 text-white px-4 h-9 rounded text-sm flex items-center justify-center">
                    Download PDF
                </button>
            </form>

        </div>
    </div>
</x-app-layout>
