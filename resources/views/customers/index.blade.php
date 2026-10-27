<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Customers') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) <div class="bg-green-100 text-green-800 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-red-100 text-red-800 p-4 mb-4 rounded">{{ session('error') }}</div> @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('customers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ Add Customer</a>
                <a href="{{ route('bills.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">+ New Bill</a>
                <table class="w-full text-left border-collapse mt-4">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border-b p-3">Name</th>
                            <th class="border-b p-3">Phone</th>
                            <th class="border-b p-3">Address</th>
                            <th class="border-b p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $c)
                        <tr class="hover:bg-gray-50">
                            <td class="border-b p-3">{{ $c->name }}</td>
                            <td class="border-b p-3">{{ $c->phone }}</td>
                            <td class="border-b p-3">{{ $c->address }}</td>
                            <td class="border-b p-3 space-x-2">
                                <a href="{{ route('customers.edit', $c) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('customers.destroy', $c) }}" class="inline" onsubmit="return confirm('Delete this customer?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4">{{ $customers->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>