<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Laundry Bills') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">{{ session('error') }}</div> @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('bills.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ New Bill</a>
                
                <table class="w-full text-left border-collapse mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b p-3">ID</th>
                            <th class="border-b p-3">Customer</th>
                            <th class="border-b p-3">Service</th>
                            <th class="border-b p-3">Units</th>
                            <th class="border-b p-3">Charged</th>
                            <th class="border-b p-3">Status</th>
                            <th class="border-b p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bills as $b)
                        <tr class="hover:bg-gray-50">
                            <td class="border-b p-3 font-mono"><a href="{{ route('bills.show', $b) }}" class="text-blue-600 hover:underline">#{{ $b->id }}</a></td>
                            <td class="border-b p-3">{{ $b->customer->name }}</td>
                            <td class="border-b p-3">{{ $b->service->name }}</td>
                            <td class="border-b p-3 text-right">{{ $b->units }}</td>
                            <td class="border-b p-3 text-right font-semibold">Rp {{ number_format($b->charged, 0, ',', '.') }}</td>
                            <td class="border-b p-3">
                                <span class="px-2 py-1 rounded text-xs font-bold uppercase
                                    {{ $b->status === 'queued' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $b->status === 'finished' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $b->status === 'departed' ? 'bg-green-100 text-green-800' : '' }}">
                                    {{ $b->status }}
                                </span>
                            </td>
                            <td class="border-b p-3 space-x-2">
                                @if($b->status !== 'departed')
                                <form method="POST" action="{{ route('bills.advance', $b) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:underline">Advance Status</button>
                                </form>
                                @endif
                                
                                @if($b->status === 'queued')
                                <form method="POST" action="{{ route('bills.destroy', $b) }}" class="inline" onsubmit="return confirm('Delete this bill?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $bills->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>