<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dynamic Report') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow-sm rounded-lg">
            <form method="GET" action="{{ route('report.index') }}" class="mb-6 flex flex-wrap items-end gap-4">
                {{-- Report Type Dropdown --}}
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Report Type</label>
                    <select name="type" id="type" class="form-select rounded w-48" onchange="this.form.submit()">
                        <option value="month" {{ request('type') === 'month' ? 'selected' : '' }}>By Month</option>
                        <option value="type" {{ request('type') === 'type' ? 'selected' : '' }}>By Type</option>
                        <option value="category" {{ request('type') === 'category' ? 'selected' : '' }}>By Category</option>
                    </select>
                </div>

                {{-- Conditional Inputs --}}
                @if (request('type') === 'month')
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Month</label>
                        <input type="number" name="month" id="month" min="1" max="12" value="{{ request('month') }}" class="form-input rounded w-48">
                    </div>
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                        <input type="number" name="year" id="year" min="2000" max="{{ date('Y') }}" value="{{ request('year') }}" class="form-input rounded w-48">
                    </div>
                @else
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date" value="{{ request('start_date') }}" class="form-input rounded w-48">
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" value="{{ request('end_date') }}" class="form-input rounded w-48">
                    </div>
                @endif

                {{-- Submit & Reset --}}
                <div>
                    <button type="submit" class="btn btn-primary">Generate</button>
                    <a href="{{ route('report.index') }}" class="btn btn-secondary ml-2">Reset</a>
                </div>
            </form>

            {{-- Report Table --}}
            @if (!empty($report) && count($report))
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
        </div>
    </div>
</x-app-layout>
