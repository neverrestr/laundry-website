<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create New Bill') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('bills.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Customer</label>
                        <select name="customer_id" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm w-full p-2 border" required>
                            <option value="">-- Select Customer --</option>
                            @foreach($customers as $c)
                                <option value="{{ $c->id }}" {{ old('customer_id') == $c->id ? 'selected' : '' }}>{{ $c->name }} ({{ $c->phone }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Service</label>
                        <select name="service_id" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm w-full p-2 border" required>
                            <option value="">-- Select Service --</option>
                            @foreach($services as $s)
                                <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }} - Rp {{ number_format($s->price_per_unit, 0, ',', '.') }}/{{ $s->unit }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-medium text-sm text-gray-700">Quantity (Units)</label>
                        <input type="number" name="units" value="{{ old('units', 1) }}" class="border-gray-300 focus:border-indigo-500 rounded-md shadow-sm w-full p-2 border" required min="1" max="100">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Bill</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>