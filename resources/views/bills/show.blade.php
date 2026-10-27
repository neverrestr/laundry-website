<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Bill Details') }} #{{ $bill->id }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">{{ session('error') }}</div> @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <div class="flex justify-between items-start border-b pb-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Customer</p>
                        <p class="text-lg font-bold">{{ $bill->customer->name }}</p>
                        <p class="text-sm text-gray-600">{{ $bill->customer->phone }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-gray-500 text-sm">Status</p>
                        <span class="px-3 py-1 rounded text-sm font-bold uppercase
                            {{ $bill->status === 'queued' ? 'bg-yellow-100 text-yellow-800' : '' }}
                            {{ $bill->status === 'finished' ? 'bg-blue-100 text-blue-800' : '' }}
                            {{ $bill->status === 'departed' ? 'bg-green-100 text-green-800' : '' }}">
                            {{ $bill->status }}
                        </span>
                    </div>
                </div>
                <div class="space-y-2 mb-6">
                    <p><strong>Service:</strong> {{ $bill->service->name }}</p>
                    <p><strong>Unit:</strong> {{ $bill->service->unit }}</p>
                    <p><strong>Quantity:</strong> {{ $bill->units }}</p>
                    <p><strong>Price per Unit:</strong> Rp {{ number_format($bill->service->price_per_unit, 0, ',', '.') }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded text-right">
                    <p class="text-sm text-gray-600">Total Charged</p>
                    <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($bill->charged, 0, ',', '.') }}</p>
                </div>
                <div class="mt-8 flex justify-end space-x-4">
                    <a href="{{ route('bills.index') }}" class="text-gray-600 hover:underline">Back to list</a>
                    @if($bill->status !== 'departed')
                    <form method="POST" action="{{ route('bills.advance', $bill) }}">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Mark as {{ $bill->status === 'queued' ? 'Finished' : 'Departed' }}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>